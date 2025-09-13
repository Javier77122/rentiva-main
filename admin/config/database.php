<?php
// Database configuration for Rentiva Admin System
class Database {
    private $host = 'localhost';
    private $db_name = 'rentiva_admin';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            // First try to connect to check if database exists
            $temp_conn = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $temp_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Check if database exists
            $stmt = $temp_conn->query("SHOW DATABASES LIKE '" . $this->db_name . "'");
            if ($stmt->rowCount() == 0) {
                // Create database if it doesn't exist
                $temp_conn->exec("CREATE DATABASE " . $this->db_name . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            }
            
            // Now connect to the database
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                )
            );
        } catch(PDOException $exception) {
            die("Connection error: " . $exception->getMessage() . "<br>Please make sure XAMPP MySQL is running.");
        }
        
        return $this->conn;
    }
}

// Session configuration
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Admin authentication check
function requireAuth() {
    if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_username'])) {
        header('Location: login.php');
        exit();
    }
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

// Get current admin info
function getCurrentAdmin() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['admin_id'],
            'username' => $_SESSION['admin_username'],
            'full_name' => $_SESSION['admin_full_name'] ?? '',
            'email' => $_SESSION['admin_email'] ?? '',
            'role' => $_SESSION['admin_role'] ?? 'admin'
        ];
    }
    return null;
}

// Log admin activity
function logActivity($admin_id, $action, $description, $record_id = null, $old_values = null, $new_values = null) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        if ($db) {
            $query = "INSERT INTO admin_activity_log (admin_id, action, table_name, record_id, old_values, new_values, ip_address, user_agent, created_at) 
                      VALUES (:admin_id, :action, :table_name, :record_id, :old_values, :new_values, :ip_address, :user_agent, NOW())";
            
            $stmt = $db->prepare($query);
            
            // Use bindValue instead of bindParam to avoid reference issues
            $old_values_json = json_encode($old_values);
            $new_values_json = json_encode($new_values);
            $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            
            $stmt->bindValue(':admin_id', $admin_id);
            $stmt->bindValue(':action', $action);
            $stmt->bindValue(':table_name', $description);
            $stmt->bindValue(':record_id', $record_id);
            $stmt->bindValue(':old_values', $old_values_json);
            $stmt->bindValue(':new_values', $new_values_json);
            $stmt->bindValue(':ip_address', $ip_address);
            $stmt->bindValue(':user_agent', $user_agent);
            
            $stmt->execute();
        }
    } catch (Exception $e) {
        // Log error silently, don't break the application
        error_log("Log activity error: " . $e->getMessage());
    }
}

// Handle file upload helper
function handleFileUpload($file, $upload_dir = '../gambar/') {
    try {
        if (!isset($file['error']) || is_array($file['error'])) {
            return ['success' => false, 'error' => 'Invalid file parameters'];
        }

        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return ['success' => false, 'error' => 'No file uploaded'];
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return ['success' => false, 'error' => 'File too large'];
            default:
                return ['success' => false, 'error' => 'Upload error'];
        }

        if ($file['size'] > 5000000) { // 5MB limit
            return ['success' => false, 'error' => 'File too large (max 5MB)'];
        }

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_types)) {
            return ['success' => false, 'error' => 'Invalid file type'];
        }

        // Create upload directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.' . $file_extension;
        $filepath = $upload_dir . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return ['success' => true, 'filename' => $filename, 'filepath' => $filepath];
        } else {
            return ['success' => false, 'error' => 'Failed to move uploaded file'];
        }
    } catch (Exception $e) {
        return ['success' => false, 'error' => 'Upload error: ' . $e->getMessage()];
    }
}

// Format date for display
function formatDate($date, $format = 'd/m/Y H:i') {
    return date($format, strtotime($date));
}

// Generate CSRF token
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verify CSRF token
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Upload file helper
function uploadFile($file, $upload_dir = 'uploads/', $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp']) {
    if (!isset($file['error']) || is_array($file['error'])) {
        throw new RuntimeException('Invalid parameters.');
    }

    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    if ($file['size'] > 5000000) { // 5MB limit
        throw new RuntimeException('Exceeded filesize limit.');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file['tmp_name']);
    
    $allowed_mimes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp'
    ];

    $ext = array_search($mime_type, $allowed_mimes, true);
    if ($ext === false || !in_array($ext, $allowed_types)) {
        throw new RuntimeException('Invalid file format.');
    }

    // Create upload directory if it doesn't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Generate unique filename
    $filename = sprintf('%s.%s', sha1_file($file['tmp_name']), $ext);
    $filepath = $upload_dir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    return $filepath;
}
?>
