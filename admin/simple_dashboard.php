<?php
session_start();

// Check if logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: simple_login.php');
    exit();
}

$admin_name = $_SESSION['admin_full_name'] ?? 'Admin';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Dashboard - Rentiva Admin</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { background: #007cba; color: white; padding: 20px; margin-bottom: 20px; }
        .content { padding: 20px; }
        .logout { float: right; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rentiva Admin Dashboard</h1>
        <div class="logout">
            Welcome, <?php echo htmlspecialchars($admin_name); ?> | 
            <a href="logout.php" style="color: white;">Logout</a>
        </div>
    </div>
    
    <div class="content">
        <div class="success">✓ Login berhasil!</div>
        
        <h3>Dashboard sederhana berhasil dimuat</h3>
        
        <p>Sistem login berfungsi dengan baik. Sekarang Anda dapat:</p>
        <ul>
            <li><a href="dashboard.php">Akses Dashboard Lengkap</a></li>
            <li><a href="login.php">Kembali ke Login Utama</a></li>
            <li><a href="debug.php">Lihat Debug Info</a></li>
        </ul>
        
        <h4>Session Info:</h4>
        <ul>
            <li>Admin ID: <?php echo $_SESSION['admin_id']; ?></li>
            <li>Username: <?php echo $_SESSION['admin_username']; ?></li>
            <li>Full Name: <?php echo $_SESSION['admin_full_name']; ?></li>
            <li>Email: <?php echo $_SESSION['admin_email']; ?></li>
            <li>Role: <?php echo $_SESSION['admin_role']; ?></li>
        </ul>
    </div>
</body>
</html>
