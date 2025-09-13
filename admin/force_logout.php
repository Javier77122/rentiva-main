<?php
// Force complete logout and session destruction
session_start();

// Unset all session variables
$_SESSION = array();

// Delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Clear any additional cookies that might exist
setcookie('admin_session', '', time() - 3600, '/');
setcookie('PHPSESSID', '', time() - 3600, '/');

// Force browser to not cache this page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

echo "<!DOCTYPE html>
<html>
<head>
    <title>Logout Complete</title>
    <meta http-equiv='Cache-Control' content='no-cache, no-store, must-revalidate'>
    <meta http-equiv='Pragma' content='no-cache'>
    <meta http-equiv='Expires' content='0'>
</head>
<body>
    <h2>✓ Session Completely Cleared</h2>
    <p>All sessions and cookies have been destroyed.</p>
    <p><strong>Now close this browser tab and open a new incognito/private window</strong></p>
    <p>Then access: <a href='login_simple.php' target='_blank'>login_simple.php</a></p>
    
    <script>
        // Clear any JavaScript stored data
        if (typeof(Storage) !== 'undefined') {
            localStorage.clear();
            sessionStorage.clear();
        }
        
        // Force reload without cache
        if (performance.navigation.type !== performance.navigation.TYPE_RELOAD) {
            setTimeout(function() {
                window.location.reload(true);
            }, 1000);
        }
    </script>
</body>
</html>";
?>
