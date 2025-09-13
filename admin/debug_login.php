<?php
echo "<h2>Debug Login System</h2>";

// Test 1: Check if XAMPP MySQL is running
echo "<h3>1. Testing MySQL Connection</h3>";
try {
    $pdo = new PDO("mysql:host=localhost", "root", "");
    echo "✓ MySQL connection successful<br>";
} catch (Exception $e) {
    echo "✗ MySQL connection failed: " . $e->getMessage() . "<br>";
    echo "<strong>Solution: Start XAMPP MySQL service</strong><br>";
    exit;
}

// Test 2: Check if database exists
echo "<h3>2. Checking Database</h3>";
try {
    $stmt = $pdo->query("SHOW DATABASES LIKE 'rentiva_admin'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Database 'rentiva_admin' exists<br>";
    } else {
        echo "✗ Database 'rentiva_admin' does not exist<br>";
        echo "<a href='setup_db.php'>Click here to create database</a><br>";
        exit;
    }
} catch (Exception $e) {
    echo "✗ Error checking database: " . $e->getMessage() . "<br>";
    exit;
}

// Test 3: Connect to database
echo "<h3>3. Connecting to Database</h3>";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=rentiva_admin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Connected to rentiva_admin database<br>";
} catch (Exception $e) {
    echo "✗ Failed to connect to database: " . $e->getMessage() . "<br>";
    exit;
}

// Test 4: Check if admin_users table exists
echo "<h3>4. Checking Tables</h3>";
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Table 'admin_users' exists<br>";
    } else {
        echo "✗ Table 'admin_users' does not exist<br>";
        echo "<a href='setup_db.php'>Click here to create tables</a><br>";
        exit;
    }
} catch (Exception $e) {
    echo "✗ Error checking tables: " . $e->getMessage() . "<br>";
    exit;
}

// Test 5: Check admin user
echo "<h3>5. Checking Admin User</h3>";
try {
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    
    if ($user = $stmt->fetch()) {
        echo "✓ Admin user found<br>";
        echo "Username: " . $user['username'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Active: " . ($user['is_active'] ? 'Yes' : 'No') . "<br>";
        
        // Test password
        echo "<h3>6. Testing Passwords</h3>";
        $test_passwords = ['admin123', 'password', 'admin'];
        
        foreach ($test_passwords as $test_pass) {
            if (password_verify($test_pass, $user['password'])) {
                echo "✓ Password '$test_pass' is correct!<br>";
                break;
            } else {
                echo "✗ Password '$test_pass' is incorrect<br>";
            }
        }
        
        // If no password worked, create new one
        if (!password_verify('admin123', $user['password']) && 
            !password_verify('password', $user['password']) && 
            !password_verify('admin', $user['password'])) {
            
            echo "<br><strong>Creating new password 'admin123'...</strong><br>";
            $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
            $update_stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'");
            $update_stmt->execute([$new_hash]);
            echo "✓ Password updated to 'admin123'<br>";
        }
        
    } else {
        echo "✗ Admin user not found<br>";
        echo "Creating admin user...<br>";
        
        $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, email, password, full_name, role, is_active) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(['admin', 'admin@rentiva.com', $password_hash, 'Administrator', 'super_admin', 1]);
        echo "✓ Admin user created with password 'admin123'<br>";
    }
} catch (Exception $e) {
    echo "✗ Error with admin user: " . $e->getMessage() . "<br>";
    exit;
}

// Test 6: Test Database class
echo "<h3>7. Testing Database Class</h3>";
try {
    require_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    
    if ($db) {
        echo "✓ Database class working correctly<br>";
    } else {
        echo "✗ Database class failed<br>";
    }
} catch (Exception $e) {
    echo "✗ Database class error: " . $e->getMessage() . "<br>";
}

echo "<h3>8. Test Complete</h3>";
echo "<p><strong>Try logging in with:</strong></p>";
echo "<ul>";
echo "<li>Username: admin</li>";
echo "<li>Password: admin123</li>";
echo "</ul>";
echo "<a href='login.php'>Go to Login Page</a>";
?>
