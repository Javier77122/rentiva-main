<?php
// Connect to database to get approved testimonials
try {
    $host = 'localhost';
    $dbname = 'rentiva_admin';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get approved testimonials
    $testimonials_query = "SELECT * FROM testimonials WHERE status = 'approved' ORDER BY is_featured DESC, created_at DESC";
    $testimonials_stmt = $pdo->prepare($testimonials_query);
    $testimonials_stmt->execute();
    $testimonials = $testimonials_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $testimonials = [];
    error_log("Database connection error: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_testimonial'])) {
    try {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);
        $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 5;
        
        if (!empty($name) && !empty($email) && !empty($message)) {
            $insert_query = "INSERT INTO testimonials (name, email, message, rating, status, created_at) VALUES (?, ?, ?, ?, 'pending', NOW())";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->execute([$name, $email, $message, $rating]);
            
            $success_message = "Terima kasih! Testimoni Anda telah dikirim dan akan ditinjau oleh admin.";
        } else {
            $error_message = "Mohon lengkapi semua field yang diperlukan.";
        }
    } catch (PDOException $e) {
        $error_message = "Terjadi kesalahan. Silakan coba lagi.";
        error_log("Testimonial submission error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Testimoni - Rentiva</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  
  <style>
    :root {
      --primary: #4a89dc;
      --primary-light: #e6f0ff;
      --primary-dark: #3b76c4;
      --text: #1f2937;
      --text-light: #4b5563;
      --bg-card: #fff;
      --border-color: #d1d5db;
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
      --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
      --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }

    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', 'Poppins', sans-serif;
      background-color: #fff;
      color: var(--text);
      line-height: 1.6;
    }
    
    /* Breadcrumb */
    .breadcrumb-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #eff6ff;
      padding: 20px 40px;
    }
    .breadcrumb-title {
      font-weight: 500;
      font-size: 24px;
      color: var(--text);
      padding-left: 57px;
    }
    .breadcrumb-links {
      display: flex;
      align-items: center;
      font-size: 17px;
      padding-right: 45px;
    }
    .breadcrumb-links a:first-child { color: var(--primary); }
    .breadcrumb-links a:last-child { color: var(--text); }
    .breadcrumb-links a {
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
    }
    .breadcrumb-links a:hover { opacity: 0.8; }
    .breadcrumb-links span {
      margin: 0 8px;
      color: #94a3b8;
    }

    /* Section Title */
    .section-title {
      text-align: center;
      margin: 70px auto 40px;
      max-width: 800px;
      padding: 0 20px;
    }
    .section-title h2 {
      font-size: 38px;
      color: #1e293b;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }
    .section-title h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--primary);
      border-radius: 2px;
    }
    .section-title p {
      color: #64748b;
      font-size: 18px;
      margin-top: 20px;
      line-height: 1.7;
    }

    /* Container untuk testimonial */
    .testimonial-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 60px auto 0;
      padding: 0 20px;
    }

    /* Card umum */
    .testimonial-card {
      background: var(--bg-card);
      padding: 25px;
      border-radius: 15px;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
      border: 1px solid var(--border-color);
      position: relative;
      overflow: hidden;
      min-height: 280px;
      max-height: 320px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      width: 100%;
      box-sizing: border-box;
    }

    /* Icon kutip */
    .testimonial-card::before {
      content: "“";
      position: absolute;
      top: -20px;
      left: 20px;
      width: 40px;
      height: 40px;
      background: #fff;
      border-radius: 50%;
      border: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      color: #4a89dc;
      font-family: serif;
    }

    /* Card tengah */
    .testimonial-card:nth-child(2) {
      background: #f0f6ff; 
      border: 1px solid #4a89dc;
      transform: translateY(80px);
    }
    .testimonial-card:nth-child(2)::before {
      background: #f0f6ff;
      border: 1px solid #4a89dc;
    }

    /* Konten */
    .testimonial-content {
      font-size: 15px;
      line-height: 1.6;
      color: var(--text-light);
      margin-bottom: 20px;
      font-style: italic;
      position: relative;
      z-index: 1;
      flex-grow: 1;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
    }

    /* Author */
    .testimonial-author {
      display: flex;
      align-items: center;
      margin-top: auto;
      padding-top: 15px;
    }
    .author-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
    }
    .author-info h4 {
      font-size: 16px;
      font-weight: 600;
      margin: 0;
      color: #1e293b;
    }
    .author-info p {
      font-size: 14px;
      color: #64748b;
      margin: 5px 0 0;
    }

    /* Form Section */
    .form-section {
      margin-top: 120px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 50px;
      padding: 60px 40px;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Form Image (Smaller size) */
    .form-image {
      flex: 1;
      max-width: 500px;
    }
    .form-image img {
      width: 100%;
      height: auto;
      border-radius: 12px;
    }

    /* Form Box */
    .form-box {
      background: #fff;
      padding: 40px 35px;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      width: 100%;
      max-width: 540px;
      border: 1px solid #e2e8f0;
    }

    .form-box h2 {
      margin-bottom: 25px;
      color: var(--text);
      font-size: 28px;
      text-align: center;
      display: inline-block;
      padding-bottom: 6px;
    }

    /* Form Group Styling */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: var(--text);
      font-size: 15px;
      font-weight: 500;
    }

    .form-group label i {
      margin-right: 8px;
      color: var(--primary);
    }

    /* Input Container */
    .input-container {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary);
      z-index: 1;
    }

    .textarea-icon {
      top: 20px;
      transform: none;
    }

    /* Input & Textarea Styling */
    .input-container input,
    .input-container textarea {
      width: 100%;
      padding: 14px 15px 14px 45px;
      border-radius: 10px;
      border: 1px solid var(--border-color);
      font-size: 15px;
      outline: none;
      transition: 0.3s;
      font-family: inherit;
      position: relative;
      background: transparent;
    }

    .input-container textarea {
      padding-top: 15px;
      min-height: 120px;
      resize: vertical;
    }

    .input-container input:focus,
    .input-container textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(74,137,220,0.15);
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 14px 15px;
      border-radius: 10px;
      border: 1px solid var(--border-color);
      font-size: 15px;
      outline: none;
      transition: 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(74,137,220,0.15);
    }

    /* Div Kirim */
    .kirim {
      background: linear-gradient(135deg, #4a89dc 0%, #3b76c4 100%);
      color: white;
      padding: 15px 30px;
      border-radius: 50px;
      font-weight: 600;
      text-align: center;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: var(--shadow-md);
      margin-top: 20px;
    }
    .kirim:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
    }
    
    .rating-input {
      display: flex;
      flex-direction: row-reverse;
      justify-content: flex-end;
    }
    
    .rating-input input[type="radio"] {
      display: none;
    }
    
    .rating-input label {
      transition: color 0.2s;
    }
    
    .rating-input input[type="radio"]:checked ~ label,
    .rating-input label:hover,
    .rating-input label:hover ~ label {
      color: #fbbf24 !important;
    }
    
    .rating-stars {
      display: flex;
      gap: 2px;
      margin-bottom: 15px;
    }
    
    .testimonial-card .rating-stars {
      flex-shrink: 0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .testimonial-container {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
      }
    }
    
    @media (max-width: 768px) {
      .testimonial-container {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 0 15px;
      }
      
      .testimonial-card {
        padding: 20px;
        min-height: 250px;
      }
    }
    
    @media (max-width: 1024px) {
      .form-section {
        flex-direction: column;
        padding: 40px 20px;
      }
      
      .form-image {
        max-width: 300px;
        margin-bottom: 30px;
      }
    }
    
    @media (max-width: 768px) {
      .section-title h2 { font-size: 28px; }
      .section-title p { font-size: 16px; }
      .breadcrumb-nav {
        flex-direction: column;
        text-align: center;
        padding: 15px 20px;
      }
      .breadcrumb-title {
        padding-left: 0;
        margin-bottom: 10px;
      }
      .breadcrumb-links { padding-right: 0; }
      
      .form-box {
        padding: 30px 25px;
      }
    }
  </style>
</head>
<body>

  <!-- Breadcrumb -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="breadcrumb-title">Testimoni</div>
    <div class="breadcrumb-links">
      <a href="#">Beranda</a>
      <span>/</span>
      <a href="#">Testimoni</a>
    </div>
  </div>

  <!-- Judul + Deskripsi -->
  <div class="section-title" data-aos="fade-up">
    <h2>Testimoni Klien Kami</h2>
    <p>
      Kami selalu berkomitmen memberikan pelayanan terbaik. Berikut adalah cerita dan pengalaman nyata dari para klien yang telah mempercayakan solusi mereka kepada kami.
    </p>
  </div>

  <!-- Dynamic Testimonial Cards -->
  <div class="testimonial-container">
    <?php if (empty($testimonials)): ?>
      <div style="text-align: center; padding: 60px; color: #718096; grid-column: 1/-1;">
        <i class="fas fa-comments" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
        <h3>Belum ada testimoni</h3>
        <p>Jadilah yang pertama memberikan testimoni!</p>
      </div>
    <?php else: ?>
      <?php foreach ($testimonials as $index => $testimonial): ?>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?php echo ($index % 3) * 100; ?>">
          <div>
            <div class="rating-stars">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="fas fa-star" style="color: <?php echo $i <= $testimonial['rating'] ? '#fbbf24' : '#d1d5db'; ?>; font-size: 14px;"></i>
              <?php endfor; ?>
            </div>
            <p class="testimonial-content">
              "<?php echo htmlspecialchars($testimonial['message']); ?>"
            </p>
          </div>
          <div class="testimonial-author">
            <?php
            // Generate avatar based on user's first letter or use default images
            $default_avatars = ['davina.webp', 'maudy.jpg', 'sa.webp', 'v.webp'];
            $avatar_index = abs(crc32($testimonial['name'])) % count($default_avatars);
            $default_avatar = $default_avatars[$avatar_index];
            ?>
            <img src="gambar/<?php echo isset($testimonial['avatar']) && !empty($testimonial['avatar']) ? htmlspecialchars($testimonial['avatar']) : $default_avatar; ?>" class="author-avatar" alt="<?php echo htmlspecialchars($testimonial['name']); ?>" onerror="this.src='gambar/davina.webp'">
            <div class="author-info">
              <h4><?php echo htmlspecialchars($testimonial['name']); ?></h4>
              <p><?php echo htmlspecialchars(isset($testimonial['occupation']) ? $testimonial['occupation'] : 'Pelanggan'); ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Form Section -->
  <div class="form-section" data-aos="fade-up">
    <div class="form-image">
      <img src="gambar/n.png" alt="Gambar Testimoni">
    </div>
    <div class="form-box">
      <h2>Tuliskan Testimonimu</h2>
      
      <?php if (isset($success_message)): ?>
        <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #10b981;">
          <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        </div>
      <?php endif; ?>
      
      <?php if (isset($error_message)): ?>
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #ef4444;">
          <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
        </div>
      <?php endif; ?>
      
      <form method="POST" action="">
        <div class="form-group">
          <div class="input-container">
            <input type="text" name="name" placeholder="Masukkan nama lengkap" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-container">
            <input type="email" name="email" placeholder="Masukkan email aktif" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
          </div>
        </div>
        
        <div class="form-group">
          <label style="display: block; margin-bottom: 12px; font-weight: 500; color: var(--text); font-size: 14px;">Rating Pengalaman:</label>
          <div class="rating-input" style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="rating" value="<?php echo $i; ?>" id="star<?php echo $i; ?>" style="display: none;" <?php echo (isset($_POST['rating']) && $_POST['rating'] == $i) || (!isset($_POST['rating']) && $i == 5) ? 'checked' : ''; ?>>
              <label for="star<?php echo $i; ?>" style="color: #fbbf24; font-size: 24px; cursor: pointer; transition: all 0.2s ease; line-height: 1;">★</label>
            <?php endfor; ?>
            <span style="margin-left: 10px; font-size: 13px; color: #666;">Pilih rating Anda</span>
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-container">
            <textarea name="message" placeholder="Tulis pengalaman atau pesan Anda..." rows="5" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
          </div>
        </div>
        
        <button type="submit" name="submit_testimonial" class="kirim" style="border: none; cursor: pointer; width: 100%;">
          <i class="fa-solid fa-paper-plane"></i> Kirim Testimoni
        </button>
      </form>
    </div>
  </div>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      AOS.init({
        duration: 600,
        easing: 'ease-out-quad',
        once: false,
        offset: 120,
        delay: 100,
        mirror: true
      });
      window.addEventListener('load', function() {
        AOS.refresh();
      });
    });
  </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const counter = document.querySelector(".item-counter");

    // Ambil data keranjang dari localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Kalau keranjang masih kosong, tetap 0
    if (cart.length === 0) {
        counter.textContent = 0;
    } else {
        // Hitung total quantity dari isi keranjang
        let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        counter.textContent = totalItems;
    }
});
</script>

  <!-- AOS Animation JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 500,
      easing: 'ease-in-out',
      once: false,
      mirror: true
    });
  </script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const filterButtons = document.querySelectorAll('.btn-filter');
      const productItems = document.querySelectorAll('.col-md-3');

      // Filter products based on category
      function filterProducts(category) {
        productItems.forEach(item => {
          if (category === 'all' || item.dataset.category === category) {
            item.classList.remove('hidden');
          } else {
            item.classList.add('hidden');
          }
        });
      }

      // Add click event to filter buttons
      filterButtons.forEach(button => {
        button.addEventListener('click', function() {
          // Remove active class from all buttons
          filterButtons.forEach(btn => btn.classList.remove('active'));
          
          // Add active class to clicked button
          this.classList.add('active');
          
          // Filter products
          const category = this.dataset.category;
          filterProducts(category);
        });
      });

      // Initialize - show all products
      filterProducts('all');
    });
  </script>
</body>
</html>