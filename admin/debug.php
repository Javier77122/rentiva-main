<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Debug Login System</h2>";

// Test 1: Basic PHP
echo "<h3>1. PHP Test</h3>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "Session status: " . session_status() . "<br>";

// Test 2: Database connection
echo "<h3>2. Database Connection Test</h3>";
try {
    $pdo = new PDO("mysql:host=localhost", "root", "");
    echo "✓ MySQL connection OK<br>";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'rentiva_admin'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Database 'rentiva_admin' exists<br>";
        
        // Connect to database
        $pdo = new PDO("mysql:host=localhost;dbname=rentiva_admin", "root", "");
        echo "✓ Connected to rentiva_admin database<br>";
        
        // Check admin_users table
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users");
            $count = $stmt->fetch()['count'];
            echo "✓ admin_users table exists with $count users<br>";
            
            if ($count > 0) {
                $stmt = $pdo->query("SELECT username, full_name FROM admin_users LIMIT 1");
                $user = $stmt->fetch();
                echo "✓ Sample user: " . $user['username'] . " (" . $user['full_name'] . ")<br>";
            }
        } catch (Exception $e) {
            echo "✗ admin_users table error: " . $e->getMessage() . "<br>";
        }
        
    } else {
        echo "✗ Database 'rentiva_admin' not found<br>";
        echo "Creating database...<br>";
        $pdo->exec("CREATE DATABASE rentiva_admin");
        echo "✓ Database created<br>";
    }
    
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "<br>";
}

// Test 3: File permissions
echo "<h3>3. File System Test</h3>";
$files = ['config/database.php', 'login.php', 'dashboard.php'];
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✓ $file exists<br>";
    } else {
        echo "✗ $file missing<br>";
    }
}

// Test 4: Session test
echo "<h3>4. Session Test</h3>";
session_start();
$_SESSION['test'] = 'working';
if (isset($_SESSION['test'])) {
    echo "✓ Sessions working<br>";
} else {
    echo "✗ Sessions not working<br>";
}

// Test 5: Simple login test
echo "<h3>5. Simple Login Test</h3>";
if (isset($_POST['test_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=rentiva_admin", "root", "");
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($user = $stmt->fetch()) {
            if (password_verify($password, $user['password'])) {
                echo "✓ Login successful for: " . $user['full_name'] . "<br>";
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                echo "✓ Session variables set<br>";
                echo "<a href='dashboard.php'>Go to Dashboard</a><br>";
            } else {
                echo "✗ Wrong password<br>";
            }
        } else {
            echo "✗ User not found<br>";
        }
    } catch (Exception $e) {
        echo "✗ Login test error: " . $e->getMessage() . "<br>";
    }
}
?>

<h3>6. Manual Login Test</h3>
<form method="POST">
    <input type="text" name="username" placeholder="Username" value="admin"><br><br>
    <input type="password" name="password" placeholder="Password" value="admin123"><br><br>
    <button type="submit" name="test_login">Test Login</button>
</form>

<hr>
<h3>Quick Actions:</h3>
<a href="setup.php">Run Setup</a> | 
<a href="login.php">Go to Login</a> | 
<a href="dashboard.php">Go to Dashboard</a>
