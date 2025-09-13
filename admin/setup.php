<?php
require_once 'config/database.php';

echo "<h2>Rentiva Admin Setup</h2>";

try {
    $database = new Database();
    $db = $database->getConnection();
    
    echo "<p style='color: green;'>✓ Database connection successful</p>";
    
    // Create tables
    $sql = "
    -- Admin Users Table
    CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        full_name VARCHAR(100) NOT NULL,
        role ENUM('admin', 'moderator') DEFAULT 'admin',
        is_active BOOLEAN DEFAULT TRUE,
        last_login TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    -- Contact Messages Table
    CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        message TEXT NOT NULL,
        status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
        admin_reply TEXT NULL,
        replied_by INT NULL,
        replied_at TIMESTAMP NULL,
        read_at TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (replied_by) REFERENCES admin_users(id) ON DELETE SET NULL
    );

    -- Contact Info Table
    CREATE TABLE IF NOT EXISTS contact_info (
        id INT AUTO_INCREMENT PRIMARY KEY,
        phone VARCHAR(20),
        email VARCHAR(100),
        address TEXT,
        office_hours VARCHAR(100),
        whatsapp VARCHAR(20),
        instagram VARCHAR(50),
        facebook VARCHAR(50),
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    -- Gallery Images Table
    CREATE TABLE IF NOT EXISTS gallery_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL,
        original_name VARCHAR(255) NOT NULL,
        title VARCHAR(200) NOT NULL,
        description TEXT,
        category VARCHAR(50),
        tags TEXT,
        status ENUM('active', 'inactive') DEFAULT 'active',
        uploaded_by INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (uploaded_by) REFERENCES admin_users(id) ON DELETE CASCADE
    );

    -- Testimonials Table
    CREATE TABLE IF NOT EXISTS testimonials (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100),
        message TEXT NOT NULL,
        rating INT DEFAULT 5 CHECK (rating >= 1 AND rating <= 5),
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        featured BOOLEAN DEFAULT FALSE,
        display_order INT DEFAULT 0,
        approved_by INT NULL,
        approved_at TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (approved_by) REFERENCES admin_users(id) ON DELETE SET NULL
    );

    -- Admin Activity Log Table
    CREATE TABLE IF NOT EXISTS admin_activity_log (
        id INT AUTO_INCREMENT PRIMARY KEY,
        admin_id INT NOT NULL,
        action VARCHAR(50) NOT NULL,
        description TEXT,
        record_id INT NULL,
        old_values JSON NULL,
        new_values JSON NULL,
        ip_address VARCHAR(45),
        user_agent TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE CASCADE
    );
    ";
    
    // Execute SQL commands
    $statements = explode(';', $sql);
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            $db->exec($statement);
        }
    }
    
    echo "<p style='color: green;'>✓ All tables created successfully</p>";
    
    // Check if admin user exists
    $stmt = $db->prepare("SELECT COUNT(*) as count FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    $count = $stmt->fetch()['count'];
    
    if ($count == 0) {
        // Create default admin user
        $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO admin_users (username, password, email, full_name, role, is_active) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(['admin', $password_hash, 'admin@rentiva.com', 'Administrator', 'admin', 1]);
        echo "<p style='color: green;'>✓ Default admin user created (username: admin, password: admin123)</p>";
    } else {
        echo "<p style='color: blue;'>ℹ Admin user already exists</p>";
        // Reset password for existing admin
        $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE admin_users SET password = ?, is_active = 1 WHERE username = 'admin'");
        $stmt->execute([$password_hash]);
        echo "<p style='color: green;'>✓ Admin password reset to: admin123</p>";
    }
    
    // Insert default contact info if not exists
    $stmt = $db->prepare("SELECT COUNT(*) as count FROM contact_info");
    $stmt->execute();
    $count = $stmt->fetch()['count'];
    
    if ($count == 0) {
        $stmt = $db->prepare("INSERT INTO contact_info (phone, email, address, office_hours, whatsapp, instagram, facebook) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            '+62 812-3456-7890',
            'info@rentiva.com',
            'Jl. Contoh No. 123, Jakarta Selatan',
            'Senin - Jumat: 08:00 - 17:00',
            '6281234567890',
            '@rentiva_official',
            'Rentiva Official'
        ]);
        echo "<p style='color: green;'>✓ Default contact info inserted</p>";
    }
    
    echo "<hr>";
    echo "<h3 style='color: green;'>Setup Complete!</h3>";
    echo "<p>You can now login to the admin panel:</p>";
    echo "<ul>";
    echo "<li><strong>URL:</strong> <a href='login.php'>login.php</a></li>";
    echo "<li><strong>Username:</strong> admin</li>";
    echo "<li><strong>Password:</strong> admin123</li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Setup failed: " . $e->getMessage() . "</p>";
    echo "<p>Please make sure:</p>";
    echo "<ul>";
    echo "<li>XAMPP is running</li>";
    echo "<li>MySQL service is started</li>";
    echo "<li>Database credentials are correct</li>";
    echo "</ul>";
}
?>
