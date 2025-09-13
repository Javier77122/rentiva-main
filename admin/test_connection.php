<?php
// Test database connection
echo "<h2>Testing Database Connection</h2>";

// Test basic connection
try {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    
    // First, try to connect without database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✓ MySQL connection successful</p>";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'rentiva_admin'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✓ Database 'rentiva_admin' exists</p>";
        
        // Connect to the database
        $pdo = new PDO("mysql:host=$host;dbname=rentiva_admin", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Check if tables exist
        $tables = ['admin_users', 'contact_messages', 'contact_info', 'gallery_images', 'testimonials', 'admin_activity_log'];
        
        foreach ($tables as $table) {
            $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
            if ($stmt->rowCount() > 0) {
                echo "<p style='color: green;'>✓ Table '$table' exists</p>";
            } else {
                echo "<p style='color: red;'>✗ Table '$table' missing</p>";
            }
        }
        
        // Check if admin user exists
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users");
        $count = $stmt->fetch()['count'];
        echo "<p style='color: " . ($count > 0 ? 'green' : 'orange') . "'>Admin users count: $count</p>";
        
        if ($count > 0) {
            $stmt = $pdo->query("SELECT username, full_name, is_active FROM admin_users");
            $users = $stmt->fetchAll();
            echo "<h3>Admin Users:</h3>";
            foreach ($users as $user) {
                $status = $user['is_active'] ? 'Active' : 'Inactive';
                echo "<p>Username: {$user['username']}, Name: {$user['full_name']}, Status: $status</p>";
            }
        }
        
    } else {
        echo "<p style='color: red;'>✗ Database 'rentiva_admin' does not exist</p>";
        echo "<p style='color: blue;'>Creating database...</p>";
        
        $pdo->exec("CREATE DATABASE rentiva_admin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "<p style='color: green;'>✓ Database 'rentiva_admin' created successfully</p>";
        echo "<p style='color: orange;'>⚠ Please run the SQL file (database.sql) to create tables</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Connection failed: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>If database doesn't exist, it has been created automatically</li>";
echo "<li>Import the database.sql file using phpMyAdmin or MySQL command line</li>";
echo "<li>Try logging in with username: <strong>admin</strong> and password: <strong>admin123</strong></li>";
echo "</ol>";

echo "<p><a href='login.php'>Go to Login Page</a></p>";
?>
