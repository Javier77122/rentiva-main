-- Database schema for Rentiva Admin System
-- Created for managing contacts, gallery, and testimonials

CREATE DATABASE IF NOT EXISTS rentiva_admin;
USE rentiva_admin;

-- Admin users table
CREATE TABLE admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'super_admin') DEFAULT 'admin',
    avatar VARCHAR(255) DEFAULT NULL,
    last_login DATETIME DEFAULT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact messages table
CREATE TABLE contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    subject VARCHAR(200) DEFAULT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    admin_reply TEXT DEFAULT NULL,
    replied_by INT DEFAULT NULL,
    replied_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (replied_by) REFERENCES admin_users(id) ON DELETE SET NULL
);

-- Contact information table (for website display)
CREATE TABLE contact_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    office_hours VARCHAR(100) DEFAULT NULL,
    whatsapp VARCHAR(20) DEFAULT NULL,
    facebook VARCHAR(255) DEFAULT NULL,
    instagram VARCHAR(255) DEFAULT NULL,
    twitter VARCHAR(255) DEFAULT NULL,
    updated_by INT DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (updated_by) REFERENCES admin_users(id) ON DELETE SET NULL
);

-- Gallery images table
CREATE TABLE gallery_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT DEFAULT NULL,
    image_path VARCHAR(255) NOT NULL,
    location VARCHAR(100) DEFAULT NULL,
    photographer VARCHAR(100) DEFAULT NULL,
    camera_info VARCHAR(100) DEFAULT NULL,
    date_taken DATE DEFAULT NULL,
    tags JSON DEFAULT NULL,
    is_featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    uploaded_by INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES admin_users(id) ON DELETE SET NULL
);

-- Testimonials table
CREATE TABLE testimonials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    job_title VARCHAR(100) DEFAULT NULL,
    company VARCHAR(100) DEFAULT NULL,
    message TEXT NOT NULL,
    rating INT DEFAULT 5 CHECK (rating >= 1 AND rating <= 5),
    avatar VARCHAR(255) DEFAULT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    is_featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    approved_by INT DEFAULT NULL,
    approved_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (approved_by) REFERENCES admin_users(id) ON DELETE SET NULL
);

-- Admin activity log table
CREATE TABLE admin_activity_log (
    id INT PRIMARY KEY AUTO_INCREMENT,
    admin_id INT NOT NULL,
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(50) NOT NULL,
    record_id INT DEFAULT NULL,
    old_values JSON DEFAULT NULL,
    new_values JSON DEFAULT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE CASCADE
);

-- Insert default admin user
INSERT INTO admin_users (username, email, password, full_name, role) VALUES 
('admin', 'admin@rentiva.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'super_admin');

-- Insert default contact info
INSERT INTO contact_info (phone, email, address, office_hours, whatsapp) VALUES 
('+62 812-3456-7890', 'info@rentiva.com', 'Jl. Mawar No. 10, Malang', 'Senin-Jumat, 08:00-17:00', '+62 812-3456-7890');

-- Insert sample gallery images (matching existing website)
INSERT INTO gallery_images (title, description, image_path, location, photographer, camera_info, date_taken, tags, is_featured, display_order, status) VALUES 
('Sunrise di Bromo', 'Momen matahari terbit yang menakjubkan di kawasan Bromo dengan pemandangan yang spektakuler.', 'gambar/1.jpg', 'Pasir Berbisik', 'Tim Dokumentasi Bromo', 'Canon EOS R5', '2023-06-15', '["#Sunrise", "#Landscape", "#Nature", "#Bromo"]', TRUE, 1, 'active'),
('Pasir Berbisik', 'Hamparan pasir luas di kawasan Bromo yang terkenal dengan sebutan Pasir Berbisik.', 'gambar/2.jpg', 'Pasir Berbisik, Bromo', 'Tim Dokumentasi Bromo', 'Sony A7 IV', '2023-07-22', '["#Desert", "#Adventure", "#Sand", "#Bromo"]', TRUE, 2, 'active'),
('Gunung Batok', 'Gunung Batok yang merupakan salah satu gunung tidak aktif di kompleks Pegunungan Tengger.', 'gambar/3.jpg', 'Gunung Batok, Bromo', 'Tim Dokumentasi Bromo', 'Nikon Z7 II', '2023-08-05', '["#Mountain", "#Nature", "#Volcano", "#Bromo"]', TRUE, 3, 'active'),
('Puncak Penanjakan', 'Titik tertinggi untuk menyaksikan sunrise di kawasan Bromo dengan pemandangan yang spektakuler.', 'gambar/4.jpg', 'Penanjakan, Bromo', 'Fotografer Pro', 'Fujifilm X-T4', '2023-09-10', '["#Viewpoint", "#Sunrise", "#Panorama", "#Bromo"]', FALSE, 4, 'active'),
('Kawah Bromo', 'Kawah Gunung Bromo yang masih aktif dengan asap belerang yang terus mengepul.', 'gambar/5.jpg', 'Kawah Bromo', 'Fotografer Alam', 'Panasonic Lumix S5', '2023-10-25', '["#Volcano", "#Crater", "#Adventure", "#Bromo"]', FALSE, 5, 'active'),
('Savana Bromo', 'Hamparan padang rumput luas di sekitar kawasan Bromo yang menjadi tempat merumputnya kuda-kuda milik masyarakat Tengger.', 'gambar/6.jpg', 'Savana Bromo', 'Fotografer Wisata', 'Olympus OM-D E-M1', '2023-11-05', '["#Savanna", "#Nature", "#Landscape", "#Bromo"]', FALSE, 6, 'active');

-- Insert sample testimonials (matching existing website)
INSERT INTO testimonials (name, email, job_title, company, message, rating, avatar, status, is_featured, display_order) VALUES 
('Sarah Wijaya', 'sarah@example.com', 'Travel Blogger', 'Travel Blog Indonesia', 'Perjalanan kami ke Bromo jadi sangat nyaman berkat layanan rental mobil yang cepat dan ramah. Kendaraannya bersih dan tepat waktu!', 5, 'gambar/davina.webp', 'approved', TRUE, 1),
('Andi Pratama', 'andi@example.com', 'Fotografer Profesional', 'Studio Foto Malang', 'Sangat puas dengan pengalaman sewa jeep untuk mendaki Bromo. Driver berpengalaman dan pemandangan yang ditawarkan benar-benar menakjubkan.', 5, 'gambar/maudy.jpg', 'approved', TRUE, 2),
('Lisa Anggraeni', 'lisa@example.com', 'Digital Marketer', 'Digital Agency', 'Proses booking mudah dan respons timnya cepat. Kami bisa fokus menikmati sunrise Bromo tanpa repot mengatur kendaraan sendiri.', 5, 'gambar/davina.webp', 'approved', TRUE, 3),
('Budi Santoso', 'budi@example.com', 'Backpacker', NULL, 'Harga sewa yang terjangkau dengan kualitas layanan yang memuaskan. Sangat direkomendasikan untuk perjalanan santai maupun adventure.', 4, 'gambar/maudy.jpg', 'approved', FALSE, 4),
('Dewi Kurnia', 'dewi@example.com', 'Guru', 'SD Negeri 1 Malang', 'Driver yang ramah dan profesional membuat perjalanan sunrise Bromo jadi momen yang tak terlupakan. Layanan sangat memuaskan!', 5, 'gambar/davina.webp', 'approved', FALSE, 5),
('Rudi Hermawan', 'rudi@example.com', 'Keluarga Wisatawan', NULL, 'Sewa mobilnya mudah dan fleksibel. Bisa pilih sesuai rute perjalanan, jadi kami bisa explore Bromo lebih leluasa tanpa khawatir transportasi.', 4, 'gambar/maudy.jpg', 'approved', FALSE, 6);
