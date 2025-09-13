<?php
session_start();

// Simple test - bypass database completely
if ($_POST) {
    echo "<h2>Form Data Received:</h2>";
    echo "<pre>" . print_r($_POST, true) . "</pre>";
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
            $_SESSION['admin_id'] = 1;
            $_SESSION['admin_username'] = 'admin';
            $_SESSION['admin_full_name'] = 'Administrator';
            $_SESSION['admin_email'] = 'admin@rentiva.com';
            $_SESSION['admin_role'] = 'super_admin';
            
            echo "<h2 style='color: green;'>✓ Login SUCCESS!</h2>";
            echo "<p>Session created. <a href='dashboard.php'>Go to Dashboard</a></p>";
            echo "<p>Or <a href='test_simple_login.php'>test again</a></p>";
        } else {
            echo "<h2 style='color: red;'>✗ Wrong credentials</h2>";
            echo "<p>Use: admin / admin123</p>";
        }
    }
} else {
    echo "<h2>No POST data received</h2>";
}

echo "<h3>Current Session:</h3>";
echo "<pre>" . print_r($_SESSION, true) . "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Login Test</title>
</head>
<body>
    <h1>Simple Login Test</h1>
    
    <form method="POST" action="">
        <p>
            <label>Username:</label><br>
            <input type="text" name="username" value="admin" style="padding: 8px; width: 200px;">
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="password" value="admin123" style="padding: 8px; width: 200px;">
        </p>
        <p>
            <button type="submit" name="login" style="padding: 10px 20px; background: #007cba; color: white; border: none;">Test Login</button>
        </p>
    </form>
    
    <hr>
    <p><strong>Instructions:</strong></p>
    <ol>
        <li>Click "Test Login" button</li>
        <li>Check if form data is received</li>
        <li>If login succeeds, try accessing dashboard</li>
    </ol>
</body>
</html>
