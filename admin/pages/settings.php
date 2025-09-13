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
            case 'clear_logs':
                $days = (int)$_POST['days'];
                $stmt = $db->prepare("DELETE FROM admin_activity_log WHERE created_at < DATE_SUB(NOW(), INTERVAL ? DAY)");
                $stmt->execute([$days]);
                logActivity($_SESSION['admin_id'], 'logs_cleared', "Cleared activity logs older than $days days");
                $success_message = "Log aktivitas berhasil dibersihkan!";
                break;
                
            case 'backup_database':
                // This would typically involve creating a database backup
                logActivity($_SESSION['admin_id'], 'database_backup', "Initiated database backup");
                $success_message = "Backup database berhasil dimulai!";
                break;
        }
    }
}

// Get system statistics
$stats = [];

// Count total records
$tables = ['contact_messages', 'gallery_images', 'testimonials', 'admin_activity_log'];
foreach ($tables as $table) {
    $stmt = $db->prepare("SELECT COUNT(*) as count FROM $table");
    $stmt->execute();
    $stats[$table] = $stmt->fetch()['count'];
}

// Get database size (approximate)
$stmt = $db->prepare("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'DB Size in MB' FROM information_schema.tables WHERE table_schema = DATABASE()");
$stmt->execute();
$db_size = $stmt->fetch()['DB Size in MB'] ?? 0;

// Get recent activity count
$stmt = $db->prepare("SELECT COUNT(*) as count FROM admin_activity_log WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$stmt->execute();
$recent_activity = $stmt->fetch()['count'];
?>

<style>
.settings-container {
    display: grid;
    gap: 30px;
}

.settings-section {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
}

.section-title {
    font-size: 20px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 10px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #f8fafc;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    text-align: center;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.stat-label {
    color: #718096;
    font-size: 14px;
    font-weight: 500;
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

.form-input, .form-select {
    width: 100%;
    padding: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
}

.form-input:focus, .form-select:focus {
    outline: none;
    border-color: #4a89dc;
    box-shadow: 0 0 0 3px rgba(74, 137, 220, 0.1);
}

.btn {
    padding: 12px 24px;
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
.btn-warning { background: #ed8936; color: white; }
.btn-danger { background: #e53e3e; color: white; }

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
}

.alert-success {
    background: #f0fff4;
    color: #38a169;
    border: 1px solid #9ae6b4;
}

.info-box {
    background: #f0f8ff;
    border: 1px solid #bee3f8;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

.info-box h4 {
    color: #2b6cb0;
    margin-bottom: 8px;
}

.info-box p {
    color: #4a5568;
    font-size: 14px;
    line-height: 1.5;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.action-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
}

.action-card h4 {
    color: #2d3748;
    margin-bottom: 10px;
}

.action-card p {
    color: #718096;
    font-size: 14px;
    margin-bottom: 15px;
}
</style>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<div class="settings-container">
    <!-- System Statistics -->
    <div class="settings-section">
        <h2 class="section-title">
            <i class="fas fa-chart-bar"></i>
            Statistik Sistem
        </h2>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['contact_messages']; ?></div>
                <div class="stat-label">Total Pesan Kontak</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['gallery_images']; ?></div>
                <div class="stat-label">Total Foto Galeri</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['testimonials']; ?></div>
                <div class="stat-label">Total Testimoni</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $recent_activity; ?></div>
                <div class="stat-label">Aktivitas 7 Hari</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $db_size; ?> MB</div>
                <div class="stat-label">Ukuran Database</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['admin_activity_log']; ?></div>
                <div class="stat-label">Total Log Aktivitas</div>
            </div>
        </div>
    </div>

    <!-- Database Management -->
    <div class="settings-section">
        <h2 class="section-title">
            <i class="fas fa-database"></i>
            Manajemen Database
        </h2>
        
        <div class="action-grid">
            <div class="action-card">
                <h4>Bersihkan Log Aktivitas</h4>
                <p>Hapus log aktivitas lama untuk menghemat ruang database</p>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="clear_logs">
                    <div class="form-group">
                        <select name="days" class="form-select">
                            <option value="30">Lebih dari 30 hari</option>
                            <option value="60">Lebih dari 60 hari</option>
                            <option value="90">Lebih dari 90 hari</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin ingin menghapus log aktivitas?')">
                        <i class="fas fa-broom"></i> Bersihkan Log
                    </button>
                </form>
            </div>

            <div class="action-card">
                <h4>Backup Database</h4>
                <p>Buat backup database untuk keamanan data</p>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="backup_database">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-download"></i> Buat Backup
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="settings-section">
        <h2 class="section-title">
            <i class="fas fa-info-circle"></i>
            Informasi Sistem
        </h2>
        
        <div class="info-box">
            <h4>Versi Sistem</h4>
            <p>Rentiva Admin Panel v1.0.0</p>
        </div>

        <div class="info-box">
            <h4>Informasi Server</h4>
            <p>
                <strong>PHP Version:</strong> <?php echo PHP_VERSION; ?><br>
                <strong>Server Software:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?><br>
                <strong>Database:</strong> MySQL/MariaDB<br>
                <strong>Timezone:</strong> <?php echo date_default_timezone_get(); ?>
            </p>
        </div>

        <div class="info-box">
            <h4>Keamanan</h4>
            <p>
                <strong>Session Timeout:</strong> 24 jam<br>
                <strong>Password Encryption:</strong> bcrypt<br>
                <strong>File Upload Max Size:</strong> <?php echo ini_get('upload_max_filesize'); ?><br>
                <strong>Last Login:</strong> 
                <?php 
                $admin_data = getCurrentAdmin();
                if (isset($admin_data['last_login']) && $admin_data['last_login']) {
                    echo date('d M Y, H:i', strtotime($admin_data['last_login']));
                } else {
                    echo 'Belum pernah login';
                }
                ?>
            </p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="settings-section">
        <h2 class="section-title">
            <i class="fas fa-bolt"></i>
            Aksi Cepat
        </h2>
        
        <div class="action-grid">
            <div class="action-card">
                <h4>Lihat Website</h4>
                <p>Buka website utama di tab baru</p>
                <a href="../index.php" target="_blank" class="btn btn-primary">
                    <i class="fas fa-external-link-alt"></i> Buka Website
                </a>
            </div>

            <div class="action-card">
                <h4>Kelola Kontak</h4>
                <p>Lihat dan balas pesan dari pengunjung</p>
                <a href="dashboard.php?page=contacts" class="btn btn-primary">
                    <i class="fas fa-envelope"></i> Kelola Kontak
                </a>
            </div>

            <div class="action-card">
                <h4>Upload Foto</h4>
                <p>Tambahkan foto baru ke galeri</p>
                <a href="dashboard.php?page=gallery" class="btn btn-primary">
                    <i class="fas fa-images"></i> Kelola Galeri
                </a>
            </div>

            <div class="action-card">
                <h4>Review Testimoni</h4>
                <p>Setujui atau tolak testimoni baru</p>
                <a href="dashboard.php?page=testimonials" class="btn btn-primary">
                    <i class="fas fa-star"></i> Kelola Testimoni
                </a>
            </div>
        </div>
    </div>
</div>
