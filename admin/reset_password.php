<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Reset Admin Password</h2>";

try {
    // Connect to database
    $pdo = new PDO("mysql:host=localhost;dbname=rentiva_admin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check current admin users
    $stmt = $pdo->query("SELECT id, username, full_name FROM admin_users");
    $users = $stmt->fetchAll();
    
    echo "<h3>Current Admin Users:</h3>";
    foreach ($users as $user) {
        echo "ID: {$user['id']}, Username: {$user['username']}, Name: {$user['full_name']}<br>";
    }
    
    // Reset password for admin user
    $new_password = 'admin123';
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'");
    $result = $stmt->execute([$password_hash]);
    
    if ($result) {
        echo "<p style='color: green;'>✓ Password berhasil direset!</p>";
        echo "<p><strong>Username:</strong> admin</p>";
        echo "<p><strong>Password baru:</strong> admin123</p>";
        
        // Test the new password
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = 'admin'");
        $stmt->execute();
        $user = $stmt->fetch();
        
        if (password_verify($new_password, $user['password'])) {
            echo "<p style='color: green;'>✓ Password verification berhasil!</p>";
        } else {
            echo "<p style='color: red;'>✗ Password verification gagal!</p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Gagal mereset password!</p>";
    }
    
    // If no admin user exists, create one
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    $count = $stmt->fetch()['count'];
    
    if ($count == 0) {
        echo "<p style='color: orange;'>Admin user tidak ditemukan. Membuat user baru...</p>";
        
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, email, full_name, role, is_active) VALUES (?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([
            'admin',
            $password_hash,
            'admin@rentiva.com',
            'Administrator',
            'admin',
            1
        ]);
        
        if ($result) {
            echo "<p style='color: green;'>✓ Admin user berhasil dibuat!</p>";
        } else {
            echo "<p style='color: red;'>✗ Gagal membuat admin user!</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?>

<hr>
<h3>Test Login:</h3>
<form method="POST" action="simple_login.php">
    <p>Username: <input type="text" name="username" value="admin" readonly></p>
    <p>Password: <input type="password" name="password" value="admin123"></p>
    <button type="submit" name="login">Test Login</button>
</form>

<p><a href="simple_login.php">Go to Simple Login</a> | <a href="debug.php">Debug Info</a></p>
