<?php
session_start();

echo "<h2>Debug Form Submission</h2>";
echo "<p>Current Time: " . date('Y-m-d H:i:s') . "</p>";

// Show all request data
echo "<h3>Request Method: " . $_SERVER['REQUEST_METHOD'] . "</h3>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h3>✓ POST Request Received</h3>";
    echo "<h4>POST Data:</h4>";
    echo "<pre>" . print_r($_POST, true) . "</pre>";
    
    echo "<h4>Raw POST Data:</h4>";
    echo "<pre>" . file_get_contents('php://input') . "</pre>";
    
    // Test login logic
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        echo "<h4>Extracted Data:</h4>";
        echo "Username: '" . htmlspecialchars($username) . "'<br>";
        echo "Password: '" . htmlspecialchars($password) . "'<br>";
        
        // Test database connection
        try {
            require_once 'config/database.php';
            $database = new Database();
            $pdo = $database->getConnection();
            
            if ($pdo) {
                echo "<h4>✓ Database Connection OK</h4>";
                
                $stmt = $pdo->prepare("SELECT id, username, email, password, full_name, role, is_active FROM admin_users WHERE username = ? AND is_active = 1");
                $stmt->execute([$username]);
                
                if ($user = $stmt->fetch()) {
                    echo "<h4>✓ User Found</h4>";
                    echo "DB Username: " . $user['username'] . "<br>";
                    echo "DB Password Hash: " . substr($user['password'], 0, 20) . "...<br>";
                    
                    if (password_verify($password, $user['password'])) {
                        echo "<h4 style='color: green;'>✓ Password Correct!</h4>";
                        
                        // Set session
                        $_SESSION['admin_id'] = $user['id'];
                        $_SESSION['admin_username'] = $user['username'];
                        $_SESSION['admin_email'] = $user['email'];
                        $_SESSION['admin_full_name'] = $user['full_name'];
                        $_SESSION['admin_role'] = $user['role'];
                        
                        echo "<h4>Session Set:</h4>";
                        echo "<pre>" . print_r($_SESSION, true) . "</pre>";
                        
                        echo "<p><a href='dashboard.php'>Go to Dashboard</a></p>";
                    } else {
                        echo "<h4 style='color: red;'>✗ Password Incorrect</h4>";
                        
                        // Try different passwords
                        $test_passwords = ['admin123', 'password', 'admin'];
                        foreach ($test_passwords as $test_pass) {
                            if (password_verify($test_pass, $user['password'])) {
                                echo "Correct password is: '$test_pass'<br>";
                                break;
                            }
                        }
                    }
                } else {
                    echo "<h4 style='color: red;'>✗ User Not Found</h4>";
                    
                    // Show all users
                    $all_users = $pdo->query("SELECT username, is_active FROM admin_users")->fetchAll();
                    echo "Available users:<br>";
                    foreach ($all_users as $u) {
                        echo "- " . $u['username'] . " (active: " . ($u['is_active'] ? 'yes' : 'no') . ")<br>";
                    }
                }
            } else {
                echo "<h4 style='color: red;'>✗ Database Connection Failed</h4>";
            }
        } catch (Exception $e) {
            echo "<h4 style='color: red;'>Database Error: " . $e->getMessage() . "</h4>";
        }
    } else {
        echo "<h4 style='color: red;'>✗ Username or Password not received</h4>";
    }
} else {
    echo "<h3>No POST request received</h3>";
}

echo "<h3>Current Session:</h3>";
echo "<pre>" . print_r($_SESSION, true) . "</pre>";
?>

<hr>
<h3>Test Form</h3>
<form method="POST" action="">
    <p>
        <label>Username:</label><br>
        <input type="text" name="username" value="admin" required style="padding: 8px; width: 200px;">
    </p>
    <p>
        <label>Password:</label><br>
        <input type="password" name="password" value="admin123" required style="padding: 8px; width: 200px;">
    </p>
    <p>
        <button type="submit" name="login" style="padding: 10px 20px; background: #007cba; color: white; border: none;">Debug Login</button>
    </p>
</form>

<hr>
<h3>Server Info:</h3>
<p>PHP Version: <?php echo phpversion(); ?></p>
<p>Session ID: <?php echo session_id(); ?></p>
<p>Session Status: <?php echo session_status(); ?></p>
