<?php
// Test database connection and check if admin user exists
try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'rentiva_admin'");
    if ($stmt->rowCount() == 0) {
        echo "Database 'rentiva_admin' does not exist. Creating...<br>";
        $pdo->exec("CREATE DATABASE rentiva_admin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Database created successfully.<br>";
    } else {
        echo "Database 'rentiva_admin' exists.<br>";
    }
    
    // Connect to the database
    $pdo = new PDO("mysql:host=localhost;dbname=rentiva_admin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if admin_users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
    if ($stmt->rowCount() == 0) {
        echo "Table 'admin_users' does not exist. Please run the database.sql file.<br>";
        echo "<a href='setup_db.php'>Click here to setup database</a>";
    } else {
        echo "Table 'admin_users' exists.<br>";
        
        // Check if admin user exists
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = 'admin'");
        $stmt->execute();
        
        if ($user = $stmt->fetch()) {
            echo "Admin user exists:<br>";
            echo "Username: " . $user['username'] . "<br>";
            echo "Email: " . $user['email'] . "<br>";
            echo "Full Name: " . $user['full_name'] . "<br>";
            echo "Role: " . $user['role'] . "<br>";
            echo "Is Active: " . ($user['is_active'] ? 'Yes' : 'No') . "<br>";
            echo "Password Hash: " . substr($user['password'], 0, 20) . "...<br>";
            
            // Test password verification
            $test_password = 'password';
            if (password_verify($test_password, $user['password'])) {
                echo "<strong>Password 'password' is correct!</strong><br>";
            } else {
                echo "<strong>Password 'password' is incorrect. Let's create a new hash...</strong><br>";
                $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
                echo "New hash for 'admin123': " . $new_hash . "<br>";
                
                // Update password
                $update_stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'");
                $update_stmt->execute([$new_hash]);
                echo "Password updated to 'admin123'<br>";
            }
        } else {
            echo "Admin user does not exist. Creating...<br>";
            $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admin_users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(['admin', 'admin@rentiva.com', $password_hash, 'Administrator', 'super_admin']);
            echo "Admin user created with username: admin, password: admin123<br>";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
