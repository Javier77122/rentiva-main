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

// Get current admin data from database
$stmt = $db->prepare("SELECT * FROM admin_users WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$current_admin = $stmt->fetch();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_profile':
                $full_name = sanitizeInput($_POST['full_name']);
                $email = sanitizeInput($_POST['email']);
                
                $stmt = $db->prepare("UPDATE admin_users SET full_name = ?, email = ?, updated_at = NOW() WHERE id = ?");
                $stmt->execute([$full_name, $email, $_SESSION['admin_id']]);
                
                logActivity($_SESSION['admin_id'], 'profile_update', "Updated profile information");
                $success_message = "Profil berhasil diperbarui!";
                break;
                
            case 'change_password':
                $current_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                
                if ($new_password !== $confirm_password) {
                    $error_message = "Password baru dan konfirmasi password tidak cocok!";
                } elseif (strlen($new_password) < 6) {
                    $error_message = "Password baru minimal 6 karakter!";
                } elseif (password_verify($current_password, $current_admin['password'])) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    
                    $stmt = $db->prepare("UPDATE admin_users SET password = ?, updated_at = NOW() WHERE id = ?");
                    $stmt->execute([$hashed_password, $_SESSION['admin_id']]);
                    
                    logActivity($_SESSION['admin_id'], 'password_change', "Changed password");
                    $success_message = "Password berhasil diubah!";
                } else {
                    $error_message = "Password saat ini tidak benar!";
                }
                break;
        }
        
        // Refresh admin data
        $stmt = $db->prepare("SELECT * FROM admin_users WHERE id = ?");
        $stmt->execute([$_SESSION['admin_id']]);
        $current_admin = $stmt->fetch();
    }
}

// Get recent activity
$activity_query = "SELECT * FROM admin_activity_log WHERE admin_id = ? ORDER BY created_at DESC LIMIT 10";
$activity_stmt = $db->prepare($activity_query);
$activity_stmt->execute([$_SESSION['admin_id']]);
$recent_activities = $activity_stmt->fetchAll();
?>

<style>
.profile-container {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 30px;
}

.profile-section, .activity-section {
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
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #4a89dc 0%, #3b76c4 100%);
    border-radius: 12px;
    color: white;
}

.profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 700;
}

.profile-info h3 {
    font-size: 24px;
    margin-bottom: 5px;
}

.profile-info p {
    opacity: 0.9;
    font-size: 14px;
}

.form-section {
    margin-bottom: 30px;
}

.form-section h4 {
    font-size: 16px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 15px;
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

.form-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-input:focus {
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
.btn-success { background: #38a169; color: white; }

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

.alert-error {
    background: #fff5f5;
    color: #e53e3e;
    border: 1px solid #feb2b2;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f1f5f9;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: white;
    background: #4a89dc;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 500;
    color: #2d3748;
    margin-bottom: 2px;
}

.activity-time {
    font-size: 12px;
    color: #718096;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.stat-box {
    background: #f8fafc;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    border: 1px solid #e2e8f0;
}

.stat-number {
    font-size: 24px;
    font-weight: 700;
    color: #2d3748;
}

.stat-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@media (max-width: 1024px) {
    .profile-container {
        grid-template-columns: 1fr;
    }
}
</style>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<div class="profile-container">
    <!-- Profile Section -->
    <div class="profile-section">
        <div class="profile-header">
            <div class="profile-avatar">
                <?php echo strtoupper(substr($current_admin['full_name'], 0, 1)); ?>
            </div>
            <div class="profile-info">
                <h3><?php echo htmlspecialchars($current_admin['full_name']); ?></h3>
                <p><?php echo htmlspecialchars($current_admin['email']); ?></p>
                <p>Role: <?php echo ucfirst($current_admin['role']); ?></p>
                <p>Bergabung: <?php echo $current_admin['created_at'] ? date('d M Y', strtotime($current_admin['created_at'])) : 'Tidak diketahui'; ?></p>
            </div>
        </div>

        <!-- Update Profile Form -->
        <div class="form-section">
            <h4>Informasi Profil</h4>
            <form method="POST">
                <input type="hidden" name="action" value="update_profile">
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="full_name" class="form-input" 
                           value="<?php echo htmlspecialchars($current_admin['full_name']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" 
                           value="<?php echo htmlspecialchars($current_admin['email']); ?>" required>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Change Password Form -->
        <div class="form-section">
            <h4>Ubah Password</h4>
            <form method="POST">
                <input type="hidden" name="action" value="change_password">
                
                <div class="form-group">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="new_password" class="form-input" 
                           minlength="6" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" class="form-input" 
                           minlength="6" required>
                </div>
                
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-key"></i> Ubah Password
                </button>
            </form>
        </div>
    </div>

    <!-- Activity Section -->
    <div class="activity-section">
        <h2 class="section-title">Aktivitas Terbaru</h2>

        <?php
        // Get activity stats
        $total_activities = count($recent_activities);
        $today_activities = count(array_filter($recent_activities, function($a) {
            return $a['created_at'] && date('Y-m-d', strtotime($a['created_at'])) === date('Y-m-d');
        }));
        ?>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-number"><?php echo $today_activities; ?></div>
                <div class="stat-label">Hari Ini</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo $total_activities; ?></div>
                <div class="stat-label">Total Aktivitas</div>
            </div>
        </div>

        <div class="activity-list">
            <?php if (empty($recent_activities)): ?>
                <div style="text-align: center; padding: 40px; color: #718096;">
                    <i class="fas fa-history" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                    <p>Belum ada aktivitas</p>
                </div>
            <?php else: ?>
                <?php foreach ($recent_activities as $activity): ?>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <?php
                            $icons = [
                                'login' => 'fas fa-sign-in-alt',
                                'logout' => 'fas fa-sign-out-alt',
                                'profile_update' => 'fas fa-user-edit',
                                'password_change' => 'fas fa-key',
                                'message_read' => 'fas fa-envelope-open',
                                'message_reply' => 'fas fa-reply',
                                'gallery_add' => 'fas fa-plus',
                                'gallery_edit' => 'fas fa-edit',
                                'gallery_delete' => 'fas fa-trash',
                                'testimonial_approve' => 'fas fa-check',
                                'testimonial_reject' => 'fas fa-times'
                            ];
                            $icon = $icons[$activity['action']] ?? 'fas fa-cog';
                            ?>
                            <i class="<?php echo $icon; ?>"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title"><?php echo htmlspecialchars($activity['description']); ?></div>
                            <div class="activity-time"><?php echo $activity['created_at'] ? date('d M Y, H:i', strtotime($activity['created_at'])) : 'Tidak diketahui'; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
