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
            case 'approve_testimonial':
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("UPDATE testimonials SET status = 'approved', approved_at = NOW(), approved_by = ? WHERE id = ?");
                $stmt->execute([$_SESSION['admin_id'], $id]);
                logActivity($_SESSION['admin_id'], 'testimonial_approve', "Approved testimonial ID: $id");
                break;
                
            case 'reject_testimonial':
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("UPDATE testimonials SET status = 'rejected' WHERE id = ?");
                $stmt->execute([$id]);
                logActivity($_SESSION['admin_id'], 'testimonial_reject', "Rejected testimonial ID: $id");
                break;
                
            case 'add_testimonial':
                $name = sanitizeInput($_POST['name']);
                $email = sanitizeInput($_POST['email']);
                $message = sanitizeInput($_POST['message']);
                $rating = (int)$_POST['rating'];
                $display_order = (int)$_POST['display_order'];
                
                $stmt = $db->prepare("INSERT INTO testimonials (name, email, message, rating, status, display_order, created_at, approved_by, approved_at) VALUES (?, ?, ?, ?, 'approved', ?, NOW(), ?, NOW())");
                $stmt->execute([$name, $email, $message, $rating, $display_order, $_SESSION['admin_id']]);
                
                logActivity($_SESSION['admin_id'], 'testimonial_add', "Added new testimonial from: $name");
                break;
                
            case 'edit_testimonial':
                $id = (int)$_POST['id'];
                $name = sanitizeInput($_POST['name']);
                $message = sanitizeInput($_POST['message']);
                $rating = (int)$_POST['rating'];
                $display_order = (int)$_POST['display_order'];
                
                $stmt = $db->prepare("UPDATE testimonials SET name = ?, message = ?, rating = ?, display_order = ?, updated_at = NOW() WHERE id = ?");
                $stmt->execute([$name, $message, $rating, $display_order, $id]);
                
                logActivity($_SESSION['admin_id'], 'testimonial_edit', "Edited testimonial ID: $id");
                break;
                
            case 'delete_testimonial':
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("DELETE FROM testimonials WHERE id = ?");
                $stmt->execute([$id]);
                
                logActivity($_SESSION['admin_id'], 'testimonial_delete', "Deleted testimonial ID: $id");
                break;
                
            case 'toggle_featured':
                $id = (int)$_POST['id'];
                $featured = $_POST['featured'] === '1' ? 0 : 1;
                
                $stmt = $db->prepare("UPDATE testimonials SET is_featured = ?, updated_at = NOW() WHERE id = ?");
                $stmt->execute([$featured, $id]);
                
                logActivity($_SESSION['admin_id'], 'testimonial_feature', "Toggled featured status for testimonial ID: $id");
                break;
        }
    }
}

// Get testimonials
$testimonials_query = "SELECT t.*, au.full_name as approved_by_name, t.is_featured as featured
                       FROM testimonials t 
                       LEFT JOIN admin_users au ON t.approved_by = au.id 
                       ORDER BY t.created_at DESC";
$testimonials_stmt = $db->prepare($testimonials_query);
$testimonials_stmt->execute();
$testimonials = $testimonials_stmt->fetchAll();

// Get statistics
$pending_count = count(array_filter($testimonials, function($t) { return $t['status'] === 'pending'; }));
$approved_count = count(array_filter($testimonials, function($t) { return $t['status'] === 'approved'; }));
$featured_count = count(array_filter($testimonials, function($t) { return isset($t['featured']) && $t['featured'] == 1; }));
?>

<style>
.testimonials-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    text-align: center;
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.stat-label {
    color: #718096;
    font-size: 14px;
    font-weight: 500;
}

.testimonials-grid {
    display: grid;
    gap: 25px;
}

.testimonial-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.testimonial-card.pending {
    border-left: 4px solid #ed8936;
    background: #fffbf5;
}

.testimonial-card.approved {
    border-left: 4px solid #38a169;
}

.testimonial-card.featured {
    border: 2px solid #4a89dc;
    background: linear-gradient(135deg, #f8fafc 0%, #f0f8ff 100%);
}

.testimonial-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.testimonial-author {
    font-weight: 600;
    color: #2d3748;
    font-size: 18px;
}

.testimonial-email {
    color: #718096;
    font-size: 14px;
    margin-top: 2px;
}

.testimonial-date {
    color: #718096;
    font-size: 12px;
    text-align: right;
}

.rating-stars {
    display: flex;
    gap: 2px;
    margin-bottom: 15px;
}

.star {
    color: #ffd700;
    font-size: 16px;
}

.star.empty {
    color: #e2e8f0;
}

.testimonial-message {
    color: #4a5568;
    line-height: 1.6;
    margin-bottom: 20px;
    font-style: italic;
}

.testimonial-status {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 15px;
}

.status-pending { background: #fef5e7; color: #d69e2e; }
.status-approved { background: #f0fff4; color: #38a169; }
.status-rejected { background: #fff5f5; color: #e53e3e; }

.featured-badge {
    background: #4a89dc;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 10px;
}

.testimonial-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-primary { background: #4a89dc; color: white; }
.btn-success { background: #38a169; color: white; }
.btn-warning { background: #ed8936; color: white; }
.btn-danger { background: #e53e3e; color: white; }
.btn-secondary { background: #718096; color: white; }

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

<div class="testimonials-header">
    <h2>Manajemen Testimoni</h2>
    <button onclick="openAddModal()" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Testimoni
    </button>
</div>

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-number"><?php echo $pending_count; ?></div>
        <div class="stat-label">Menunggu Persetujuan</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?php echo $approved_count; ?></div>
        <div class="stat-label">Disetujui</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?php echo $featured_count; ?></div>
        <div class="stat-label">Unggulan</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?php echo count($testimonials); ?></div>
        <div class="stat-label">Total Testimoni</div>
    </div>
</div>

<div class="testimonials-grid">
    <?php if (empty($testimonials)): ?>
        <div style="text-align: center; padding: 60px; color: #718096;">
            <i class="fas fa-star" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
            <h3>Belum ada testimoni</h3>
            <p>Testimoni dari pelanggan akan muncul di sini</p>
        </div>
    <?php else: ?>
        <?php foreach ($testimonials as $testimonial): ?>
            <div class="testimonial-card <?php echo $testimonial['status']; ?> <?php echo isset($testimonial['featured']) && $testimonial['featured'] ? 'featured' : ''; ?>">
                <div class="testimonial-header">
                    <div>
                        <div class="testimonial-author">
                            <?php echo htmlspecialchars($testimonial['name']); ?>
                            <?php if (isset($testimonial['featured']) && $testimonial['featured']): ?>
                                <span class="featured-badge">UNGGULAN</span>
                            <?php endif; ?>
                        </div>
                        <div class="testimonial-email"><?php echo htmlspecialchars($testimonial['email']); ?></div>
                    </div>
                    <div class="testimonial-date">
                        <?php echo date('d M Y', strtotime($testimonial['created_at'])); ?>
                    </div>
                </div>

                <div class="rating-stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star <?php echo $i <= $testimonial['rating'] ? '' : 'empty'; ?>">★</span>
                    <?php endfor; ?>
                </div>

                <div class="testimonial-message">
                    "<?php echo nl2br(htmlspecialchars($testimonial['message'])); ?>"
                </div>

                <span class="testimonial-status status-<?php echo $testimonial['status']; ?>">
                    <?php echo ucfirst($testimonial['status']); ?>
                </span>

                <?php if ($testimonial['approved_by_name']): ?>
                    <div style="font-size: 12px; color: #718096; margin-bottom: 15px;">
                        Disetujui oleh <?php echo htmlspecialchars($testimonial['approved_by_name']); ?>
                        pada <?php echo date('d M Y, H:i', strtotime($testimonial['approved_at'])); ?>
                    </div>
                <?php endif; ?>

                <div class="testimonial-actions">
                    <?php if ($testimonial['status'] === 'pending'): ?>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="approve_testimonial">
                            <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Setujui
                            </button>
                        </form>
                        
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="reject_testimonial">
                            <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if ($testimonial['status'] === 'approved'): ?>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="toggle_featured">
                            <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                            <input type="hidden" name="featured" value="<?php echo isset($testimonial['featured']) ? $testimonial['featured'] : 0; ?>">
                            <button type="submit" class="btn <?php echo (isset($testimonial['featured']) && $testimonial['featured']) ? 'btn-secondary' : 'btn-warning'; ?>">
                                <i class="fas fa-star"></i>
                                <?php echo (isset($testimonial['featured']) && $testimonial['featured']) ? 'Batal Unggulan' : 'Jadikan Unggulan'; ?>
                            </button>
                        </form>
                    <?php endif; ?>

                    <button onclick="editTestimonial(<?php echo $testimonial['id']; ?>)" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </button>

                    <button onclick="deleteTestimonial(<?php echo $testimonial['id']; ?>)" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Add Testimonial Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addModal')">&times;</span>
        <h3>Tambah Testimoni Baru</h3>
        <form method="POST">
            <input type="hidden" name="action" value="add_testimonial">
            
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Rating</label>
                <select name="rating" class="form-select" required>
                    <option value="">Pilih Rating</option>
                    <option value="5">5 Bintang</option>
                    <option value="4">4 Bintang</option>
                    <option value="3">3 Bintang</option>
                    <option value="2">2 Bintang</option>
                    <option value="1">1 Bintang</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Pesan Testimoni</label>
                <textarea name="message" class="form-textarea" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="display_order" class="form-input" value="0" min="0">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" onclick="closeModal('addModal')" class="btn btn-secondary">Batal</button>
        </form>
    </div>
</div>

<!-- Edit Testimonial Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h3>Edit Testimoni</h3>
        <form method="POST" id="editForm">
            <input type="hidden" name="action" value="edit_testimonial">
            <input type="hidden" name="id" id="editId">
            
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" id="editName" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Rating</label>
                <select name="rating" id="editRating" class="form-select" required>
                    <option value="5">5 Bintang</option>
                    <option value="4">4 Bintang</option>
                    <option value="3">3 Bintang</option>
                    <option value="2">2 Bintang</option>
                    <option value="1">1 Bintang</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Pesan Testimoni</label>
                <textarea name="message" id="editMessage" class="form-textarea" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="display_order" id="editDisplayOrder" class="form-input" min="0">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <button type="button" onclick="closeModal('editModal')" class="btn btn-secondary">Batal</button>
        </form>
    </div>
</div>

<script>
const testimonials = <?php echo json_encode($testimonials); ?>;

function openAddModal() {
    document.getElementById('addModal').style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function editTestimonial(id) {
    const testimonial = testimonials.find(t => t.id == id);
    if (testimonial) {
        document.getElementById('editId').value = testimonial.id;
        document.getElementById('editName').value = testimonial.name;
        document.getElementById('editRating').value = testimonial.rating;
        document.getElementById('editMessage').value = testimonial.message;
        document.getElementById('editDisplayOrder').value = testimonial.display_order;
        document.getElementById('editModal').style.display = 'block';
    }
}

function deleteTestimonial(id) {
    if (confirm('Apakah Anda yakin ingin menghapus testimoni ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="action" value="delete_testimonial">
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
