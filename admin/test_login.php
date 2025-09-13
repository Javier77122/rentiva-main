<?php
echo "<h2>Test Login System</h2>";

// Test database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=rentiva_admin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✓ Database connection OK</p>";
    
    // Check admin user
    $stmt = $pdo->prepare("SELECT username, full_name, is_active FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    
    if ($user = $stmt->fetch()) {
        echo "<p style='color: green;'>✓ Admin user found: " . $user['full_name'] . "</p>";
        echo "<p>Status: " . ($user['is_active'] ? 'Active' : 'Inactive') . "</p>";
        
        // Test password
        $stmt = $pdo->prepare("SELECT password FROM admin_users WHERE username = 'admin'");
        $stmt->execute();
        $hash = $stmt->fetch()['password'];
        
        if (password_verify('admin123', $hash)) {
            echo "<p style='color: green;'>✓ Password verification OK</p>";
        } else {
            echo "<p style='color: red;'>✗ Password verification failed</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Admin user not found</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>Login Links:</h3>";
echo "<p><a href='login.php?logout=1'>Login Page (with logout)</a></p>";
echo "<p><a href='clear_session.php'>Clear Session</a></p>";
echo "<p><a href='reset_password.php'>Reset Password</a></p>";
?>
