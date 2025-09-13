<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_image':
                if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                    $upload_result = handleFileUpload($_FILES['image'], '../gambar/');
                    if ($upload_result['success']) {
                        $title = sanitizeInput($_POST['title']);
                        $description = sanitizeInput($_POST['description']);
                        $tags_input = sanitizeInput($_POST['tags']);
                        
                        // Convert tags string to JSON array
                        $tags_array = !empty($tags_input) ? array_map('trim', explode(',', $tags_input)) : [];
                        $tags_json = json_encode($tags_array);
                        
                        $stmt = $db->prepare("INSERT INTO gallery_images (image_path, title, description, tags, uploaded_by, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                        $stmt->execute([$upload_result['filename'], $title, $description, $tags_json, $_SESSION['admin_id']]);
                        
                        logActivity($_SESSION['admin_id'], 'gallery_add', "Added new gallery image: $title");
                    }
                }
                break;
                
            case 'edit_image':
                $id = (int)$_POST['id'];
                $title = sanitizeInput($_POST['title']);
                $description = sanitizeInput($_POST['description']);
                $tags_input = sanitizeInput($_POST['tags']);
                
                // Convert tags string to JSON array
                $tags_array = !empty($tags_input) ? array_map('trim', explode(',', $tags_input)) : [];
                $tags_json = json_encode($tags_array);
                
                $stmt = $db->prepare("UPDATE gallery_images SET title = ?, description = ?, tags = ?, updated_at = NOW() WHERE id = ?");
                $stmt->execute([$title, $description, $tags_json, $id]);
                
                logActivity($_SESSION['admin_id'], 'gallery_edit', "Edited gallery image ID: $id");
                break;
                
            case 'delete_image':
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("SELECT image_path FROM gallery_images WHERE id = ?");
                $stmt->execute([$id]);
                $image = $stmt->fetch();
                
                if ($image) {
                    // Try multiple possible file paths
                    $possible_paths = [
                        '../gambar/' . $image['image_path'],
                        '../../gambar/' . $image['image_path'],
                        __DIR__ . '/../../gambar/' . $image['image_path']
                    ];
                    
                    $file_deleted = false;
                    foreach ($possible_paths as $file_path) {
                        if (file_exists($file_path)) {
                            if (unlink($file_path)) {
                                $file_deleted = true;
                                break;
                            }
                        }
                    }
                    
                    // Delete from database regardless of file deletion success
                    $stmt = $db->prepare("DELETE FROM gallery_images WHERE id = ?");
                    $stmt->execute([$id]);
                    
                    $status = $file_deleted ? "Deleted gallery image and file ID: $id" : "Deleted gallery image ID: $id (file not found)";
                    logActivity($_SESSION['admin_id'], 'gallery_delete', $status);
                }
                break;
                
            case 'toggle_status':
                $id = (int)$_POST['id'];
                $status = $_POST['status'] === 'active' ? 'inactive' : 'active';
                
                $stmt = $db->prepare("UPDATE gallery_images SET status = ?, updated_at = NOW() WHERE id = ?");
                $stmt->execute([$status, $id]);
                
                logActivity($_SESSION['admin_id'], 'gallery_status', "Changed status of gallery image ID: $id to $status");
                break;
        }
    }
}

// Get gallery images
$images_query = "SELECT gi.*, au.full_name as uploaded_by_name 
                 FROM gallery_images gi 
                 LEFT JOIN admin_users au ON gi.uploaded_by = au.id 
                 ORDER BY gi.created_at DESC";
$images_stmt = $db->prepare($images_query);
$images_stmt->execute();
$images = $images_stmt->fetchAll();

// Get categories for filter
$categories = array_unique(array_column($images, 'category'));
?>

<style>
.gallery-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary { background: #4a89dc; color: white; }
.btn-success { background: #38a169; color: white; }
.btn-warning { background: #ed8936; color: white; }
.btn-danger { background: #e53e3e; color: white; }

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
}

.image-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.image-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.image-preview {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: #f7fafc;
}

.image-info {
    padding: 20px;
}

.image-title {
    font-size: 18px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
}

.image-description {
    color: #718096;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 15px;
}

.image-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 12px;
    color: #718096;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-active { background: #f0fff4; color: #38a169; }
.status-inactive { background: #fff5f5; color: #e53e3e; }

.image-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal-content {
    background: white;
    margin: 50px auto;
    padding: 30px;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #2d3748;
}

.form-input, .form-textarea, .form-select {
    width: 100%;
    padding: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: #4a89dc;
    box-shadow: 0 0 0 3px rgba(74, 137, 220, 0.1);
}

.close {
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    color: #718096;
}

.close:hover {
    color: #2d3748;
}
</style>

<div class="gallery-header">
    <h2>Manajemen Galeri</h2>
    <button onclick="openAddModal()" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Foto
    </button>
</div>

<div class="gallery-grid">
    <?php if (empty($images)): ?>
        <div style="grid-column: 1/-1; text-align: center; padding: 60px; color: #718096;">
            <i class="fas fa-images" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
            <h3>Belum ada foto di galeri</h3>
            <p>Klik tombol "Tambah Foto" untuk mengunggah foto pertama</p>
        </div>
    <?php else: ?>
        <?php foreach ($images as $image): ?>
            <div class="image-card">
                <img src="../gambar/<?php echo htmlspecialchars($image['image_path'] ?? ''); ?>" 
                     alt="<?php echo htmlspecialchars($image['title'] ?? ''); ?>" 
                     class="image-preview">
                
                <div class="image-info">
                    <h3 class="image-title"><?php echo htmlspecialchars($image['title'] ?? ''); ?></h3>
                    <p class="image-description"><?php echo htmlspecialchars($image['description'] ?? ''); ?></p>
                    
                    <div class="image-meta">
                        <span>Tags: <?php 
                        $tags = $image['tags'] ?? null;
                        if ($tags) {
                            $tags_array = json_decode($tags, true);
                            echo htmlspecialchars(is_array($tags_array) ? implode(', ', $tags_array) : 'Tidak ada tags');
                        } else {
                            echo 'Tidak ada tags';
                        }
                        ?></span>
                        <span class="status-badge status-<?php echo $image['status'] ?? 'inactive'; ?>">
                            <?php echo ucfirst($image['status'] ?? 'inactive'); ?>
                        </span>
                    </div>
                    
                    <div class="image-actions">
                        <button onclick="editImage(<?php echo $image['id'] ?? 0; ?>)" class="btn btn-warning" style="font-size: 12px; padding: 6px 12px;">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="toggle_status">
                            <input type="hidden" name="id" value="<?php echo $image['id'] ?? 0; ?>">
                            <input type="hidden" name="status" value="<?php echo $image['status'] ?? 'inactive'; ?>">
                            <button type="submit" class="btn <?php echo ($image['status'] ?? 'inactive') === 'active' ? 'btn-warning' : 'btn-success'; ?>" style="font-size: 12px; padding: 6px 12px;">
                                <i class="fas fa-<?php echo ($image['status'] ?? 'inactive') === 'active' ? 'eye-slash' : 'eye'; ?>"></i>
                                <?php echo ($image['status'] ?? 'inactive') === 'active' ? 'Sembunyikan' : 'Tampilkan'; ?>
                            </button>
                        </form>
                        
                        <button onclick="deleteImage(<?php echo $image['id'] ?? 0; ?>)" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Add Image Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addModal')">&times;</span>
        <h3>Tambah Foto Baru</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_image">
            
            <div class="form-group">
                <label class="form-label">Pilih Foto</label>
                <input type="file" name="image" class="form-input" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-textarea" rows="3"></textarea>
            </div>
            
            
            <div class="form-group">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" class="form-input" placeholder="Pisahkan dengan koma">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" onclick="closeModal('addModal')" class="btn btn-secondary">Batal</button>
        </form>
    </div>
</div>

<!-- Edit Image Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h3>Edit Foto</h3>
        <form method="POST" id="editForm">
            <input type="hidden" name="action" value="edit_image">
            <input type="hidden" name="id" id="editId">
            
            <div class="form-group">
                <label class="form-label">Judul</label>
                <input type="text" name="title" id="editTitle" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" id="editDescription" class="form-textarea" rows="3"></textarea>
            </div>
            
            
            <div class="form-group">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" id="editTags" class="form-input">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <button type="button" onclick="closeModal('editModal')" class="btn btn-secondary">Batal</button>
        </form>
    </div>
</div>

<script>
const images = <?php echo json_encode($images); ?>;

function openAddModal() {
    document.getElementById('addModal').style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function editImage(id) {
    const image = images.find(img => img.id == id);
    if (image) {
        document.getElementById('editId').value = image.id;
        document.getElementById('editTitle').value = image.title;
        document.getElementById('editDescription').value = image.description;
        // Convert JSON tags back to comma-separated string for editing
        let tagsValue = '';
        if (image.tags) {
            try {
                const tagsArray = JSON.parse(image.tags);
                tagsValue = Array.isArray(tagsArray) ? tagsArray.join(', ') : '';
            } catch (e) {
                tagsValue = image.tags;
            }
        }
        document.getElementById('editTags').value = tagsValue;
        document.getElementById('editModal').style.display = 'block';
    }
}

function deleteImage(id) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="action" value="delete_image">
            <input type="hidden" name="id" value="${id}">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}
</script>
