<?php
// Clear all sessions
session_start();
session_destroy();

// Clear session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

echo "<h2>Session Cleared</h2>";
echo "<p style='color: green;'>✓ Semua session telah dihapus</p>";
echo "<p><a href='login.php'>Kembali ke Login</a></p>";
echo "<p><a href='simple_login.php'>Login Sederhana</a></p>";
?>
