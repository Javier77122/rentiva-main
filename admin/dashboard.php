<?php
// Start session first
session_start();

// Include database configuration
require_once 'config/database.php';

// Simple auth check
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$allowed_pages = ['dashboard', 'contacts', 'gallery', 'testimonials', 'profile', 'settings'];

if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}

// Get current admin info from session
$current_admin = [
    'id' => $_SESSION['admin_id'],
    'username' => $_SESSION['admin_username'],
    'full_name' => $_SESSION['admin_full_name'] ?? 'Admin',
    'email' => $_SESSION['admin_email'] ?? '',
    'role' => $_SESSION['admin_role'] ?? 'admin'
];

// Get dashboard statistics
try {
    $database = new Database();
    $db = $database->getConnection();
    
    if (!$db) {
        throw new Exception("Database connection failed");
    }
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Count unread messages
$unread_query = "SELECT COUNT(*) as count FROM contact_messages WHERE status = 'unread'";
$unread_stmt = $db->prepare($unread_query);
$unread_stmt->execute();
$unread_messages = $unread_stmt->fetch()['count'];

// Count pending testimonials
$pending_query = "SELECT COUNT(*) as count FROM testimonials WHERE status = 'pending'";
$pending_stmt = $db->prepare($pending_query);
$pending_stmt->execute();
$pending_testimonials = $pending_stmt->fetch()['count'];

// Count active gallery images
$gallery_query = "SELECT COUNT(*) as count FROM gallery_images WHERE status = 'active'";
$gallery_stmt = $db->prepare($gallery_query);
$gallery_stmt->execute();
$gallery_count = $gallery_stmt->fetch()['count'];

// Count total testimonials
$total_testimonials_query = "SELECT COUNT(*) as count FROM testimonials WHERE status = 'approved'";
$total_testimonials_stmt = $db->prepare($total_testimonials_query);
$total_testimonials_stmt->execute();
$total_testimonials = $total_testimonials_stmt->fetch()['count'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rentiva</title>
    <link rel="icon" type="image/png" sizes="512x512" href="../gambar/putih.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            color: #2d3748;
            overflow-x: hidden;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: #ffffff;
            color: #374151;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 1px 0 3px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: #1e40af;
            color: white;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .logo-container img {
            width: 32px;
            height: 32px;
            border-radius: 6px;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 600;
            color: white;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 8px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
            color: white;
        }

        .admin-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
            color: white;
        }

        .admin-role {
            font-size: 12px;
            opacity: 0.8;
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar-nav {
            padding: 24px 0;
            flex: 1;
        }

        .nav-section {
            margin-bottom: 8px;
        }

        .nav-section-title {
            padding: 16px 24px 8px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9ca3af;
            font-weight: 600;
        }

        .nav-item {
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 14px;
            position: relative;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .nav-link.active {
            background: #eff6ff;
            color: #1e40af;
            border-left-color: #1e40af;
            font-weight: 600;
        }

        .nav-link i {
            width: 18px;
            text-align: center;
            font-size: 16px;
        }

        .nav-badge {
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 12px;
            margin-left: auto;
            font-weight: 600;
            min-width: 18px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px 0;
            border-top: 1px solid #e5e7eb;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            background: #f5f7fa;
            min-height: 100vh;
        }

        .top-bar {
            background: white;
            padding: 25px 40px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #e2e8f0;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748;
        }

        .welcome-text {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            color: #718096;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .top-bar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-btn {
            position: relative;
            background: #f7fafc;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #4a5568;
        }

        .notification-btn:hover {
            background: #edf2f7;
            color: #2d3748;
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #ff4757;
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 8px;
            font-weight: 600;
        }

        .content-area {
            padding: 40px;
        }

        /* Dashboard Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .dashboard-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .chart-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .mini-stats {
            display: grid;
            gap: 20px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .mini-stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--card-color, #4a89dc);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            background: var(--card-color, #4a89dc);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .mini-stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .mini-stat-label {
            color: #718096;
            font-size: 13px;
            font-weight: 500;
        }

        .mini-stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            background: var(--card-color, #4a89dc);
        }

        .stat-label {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-trend {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
        }

        .trend-up {
            background: #f0fff4;
            color: #38a169;
        }

        .trend-down {
            background: #fff5f5;
            color: #e53e3e;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px 24px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .action-btn i {
            font-size: 18px;
        }

        /* Recent Activity */
        .recent-activity {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
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

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .content-area {
                padding: 20px;
            }

            .top-bar {
                padding: 15px 20px;
            }
        }

        /* Color variations for cards */
        .card-messages { --card-color: #3b82f6; }
        .card-testimonials { --card-color: #10b981; }
        .card-gallery { --card-color: #f59e0b; }
        .card-total { --card-color: #8b5cf6; }
        .card-visitors { --card-color: #ef4444; }
        .card-orders { --card-color: #06b6d4; }

        /* Chart Styles */
        .chart-container {
            height: 300px;
            position: relative;
            margin-top: 20px;
        }

        .chart-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 600;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
        }

        .view-all-btn {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .view-all-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <img src="../gambar/bi.png" alt="Rentiva Logo">
                    <div class="logo-text">Rentiva</div>
                </div>
                <div class="admin-info">
                    <div class="admin-avatar">
                        <?php echo strtoupper(substr($current_admin['full_name'], 0, 1)); ?>
                    </div>
                    <div>
                        <div class="admin-name"><?php echo htmlspecialchars($current_admin['full_name']); ?></div>
                        <div class="admin-role">meet and Developer</div>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-item">
                        <a href="dashboard.php?page=dashboard" class="nav-link <?php echo $page == 'dashboard' ? 'active' : ''; ?>">
                            <i class="fas fa-th-large"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="dashboard.php?page=contacts" class="nav-link <?php echo $page == 'contacts' ? 'active' : ''; ?>">
                            <i class="fas fa-envelope"></i>
                            <span>Contacts</span>
                            <?php if ($unread_messages > 0): ?>
                                <span class="nav-badge"><?php echo $unread_messages; ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="dashboard.php?page=gallery" class="nav-link <?php echo $page == 'gallery' ? 'active' : ''; ?>">
                            <i class="fas fa-images"></i>
                            <span>Gallery</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="dashboard.php?page=testimonials" class="nav-link <?php echo $page == 'testimonials' ? 'active' : ''; ?>">
                            <i class="fas fa-star"></i>
                            <span>Reviews</span>
                            <?php if ($pending_testimonials > 0): ?>
                                <span class="nav-badge"><?php echo $pending_testimonials; ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="dashboard.php?page=profile" class="nav-link <?php echo $page == 'profile' ? 'active' : ''; ?>">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="dashboard.php?page=settings" class="nav-link <?php echo $page == 'settings' ? 'active' : ''; ?>">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="nav-item">
                    <a href="logout.php" class="nav-link" style="color: #6b7280;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-bar">
                <h1 class="page-title">
                    <?php
                    $page_titles = [
                        'dashboard' => 'Dashboard',
                        'contacts' => 'Manajemen Kontak',
                        'gallery' => 'Manajemen Galeri',
                        'testimonials' => 'Manajemen Testimoni',
                        'profile' => 'Profil Admin',
                        'settings' => 'Pengaturan Sistem'
                    ];
                    echo $page_titles[$page] ?? 'Dashboard';
                    ?>
                </h1>
                <div class="top-bar-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <?php if ($unread_messages + $pending_testimonials > 0): ?>
                            <span class="notification-badge"><?php echo $unread_messages + $pending_testimonials; ?></span>
                        <?php endif; ?>
                    </button>
                </div>
            </div>

            <div class="content-area">
                <?php
                if ($page == 'dashboard') {
                    // Dashboard content
                    ?>
                    <div class="welcome-text">Welcome back, <?php echo htmlspecialchars($current_admin['full_name']); ?>!</div>
                    <div class="welcome-subtitle">You have <?php echo $unread_messages; ?> new messages and <?php echo $pending_testimonials; ?> notifications.</div>
                    

                    <div class="dashboard-row">
                        <div class="chart-section">
                            <div class="section-header">
                                <h3 class="section-title">Recent Movement</h3>
                                <a href="#" class="view-all-btn">View All</a>
                            </div>
                            <div class="chart-container">
                                <div class="chart-placeholder">
                                    <i class="fas fa-chart-area" style="margin-right: 10px;"></i>
                                    Analytics Chart (Integration Ready)
                                </div>
                            </div>
                        </div>
                        
                        <div class="mini-stats">
                            <div class="mini-stat-card card-messages">
                                <div class="mini-stat-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-number"><?php echo $unread_messages; ?></div>
                                    <div class="mini-stat-label">New Messages</div>
                                </div>
                            </div>
                            
                            <div class="mini-stat-card card-testimonials">
                                <div class="mini-stat-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-number"><?php echo $pending_testimonials; ?></div>
                                    <div class="mini-stat-label">Pending Reviews</div>
                                </div>
                            </div>
                            
                            <div class="mini-stat-card card-gallery">
                                <div class="mini-stat-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-number"><?php echo $gallery_count; ?></div>
                                    <div class="mini-stat-label">Gallery Images</div>
                                </div>
                            </div>
                            
                            <div class="mini-stat-card card-total">
                                <div class="mini-stat-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-number"><?php echo $total_testimonials; ?></div>
                                    <div class="mini-stat-label">Approved Reviews</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="quick-actions">
                        <div class="section-header">
                            <h2 class="section-title">Quick Actions</h2>
                        </div>
                        <div class="actions-grid">
                            <a href="dashboard.php?page=contacts" class="action-btn">
                                <i class="fas fa-envelope"></i>
                                <span>Manage Contacts</span>
                            </a>
                            <a href="dashboard.php?page=gallery" class="action-btn">
                                <i class="fas fa-upload"></i>
                                <span>Upload Images</span>
                            </a>
                            <a href="dashboard.php?page=testimonials" class="action-btn">
                                <i class="fas fa-star"></i>
                                <span>Review Testimonials</span>
                            </a>
                            <a href="../index.php" target="_blank" class="action-btn">
                                <i class="fas fa-external-link-alt"></i>
                                <span>View Website</span>
                            </a>
                        </div>
                    </div>
                    <?php
                } else {
                    // Include page content
                    $content_file = __DIR__ . "/pages/$page.php";
                    if (file_exists($content_file)) {
                        include $content_file;
                    } else {
                        echo "<div class='alert alert-error'>Halaman tidak ditemukan!</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            });
        }, 5000);
    </script>
</body>
</html>
