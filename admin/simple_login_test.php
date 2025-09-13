<?php
session_start();

echo "<h2>Simple Login Test</h2>";

// Test form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h3>Form Submitted!</h3>";
    echo "Username: " . ($_POST['username'] ?? 'NOT SET') . "<br>";
    echo "Password: " . ($_POST['password'] ?? 'NOT SET') . "<br>";
    echo "Login button: " . (isset($_POST['login']) ? 'YES' : 'NO') . "<br>";
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['admin_id'] = 1;
            $_SESSION['admin_username'] = 'admin';
            $_SESSION['admin_full_name'] = 'Administrator';
            $_SESSION['admin_email'] = 'admin@rentiva.com';
            $_SESSION['admin_role'] = 'super_admin';
            
            echo "<h3 style='color: green;'>Login Successful!</h3>";
            echo "<p>Session variables set:</p>";
            echo "<pre>" . print_r($_SESSION, true) . "</pre>";
            echo "<a href='dashboard.php'>Go to Dashboard</a>";
        } else {
            echo "<h3 style='color: red;'>Login Failed!</h3>";
            echo "Expected: admin / admin123<br>";
            echo "Received: $username / $password<br>";
        }
    }
} else {
    echo "<p>No form submission detected</p>";
}
?>

<form method="POST" action="">
    <h3>Test Login Form</h3>
    <p>
        <label>Username:</label><br>
        <input type="text" name="username" value="admin" required>
    </p>
    <p>
        <label>Password:</label><br>
        <input type="password" name="password" value="admin123" required>
    </p>
    <p>
        <button type="submit" name="login">Test Login</button>
    </p>
</form>

<hr>
<h3>Current Session:</h3>
<pre><?php print_r($_SESSION); ?></pre>

<h3>Server Info:</h3>
<p>Request Method: <?php echo $_SERVER['REQUEST_METHOD']; ?></p>
<p>PHP Version: <?php echo phpversion(); ?></p>
<p>Session ID: <?php echo session_id(); ?></p>
