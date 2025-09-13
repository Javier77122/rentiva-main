<?php
// Connect to database to handle contact form submissions
try {
    $host = 'localhost';
    $dbname = 'rentiva_admin';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_message'])) {
    try {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $message = trim($_POST['message']);
        
        if (!empty($name) && !empty($email) && !empty($message)) {
            $insert_query = "INSERT INTO contact_messages (name, email, phone, message, status, created_at) VALUES (?, ?, ?, ?, 'unread', NOW())";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->execute([$name, $email, $phone, $message]);
            
            $success_message = "Terima kasih! Pesan Anda telah dikirim. Kami akan segera menghubungi Anda.";
        } else {
            $error_message = "Mohon lengkapi nama, email, dan pesan.";
        }
    } catch (PDOException $e) {
        $error_message = "Terjadi kesalahan. Silakan coba lagi.";
        error_log("Contact form submission error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hubungi Kami - Rentiva</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <style>
    :root {
      --primary: #4a89dc;
      --text: #1f2937;
      --text-light: #4b5563;
      --bg-card: #fff;
      --border-color: #d1d5db;
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
      --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
      --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
      --shadow-around: 0 2px 8px rgba(0, 0, 0, 0.1);
      --transition: all 0.4s ease; /* Slower transition */
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
    
    .breadcrumb-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #eff6ff;
      padding: 20px 40px;
      transition: var(--transition);
    }

    .breadcrumb-title {
      font-weight: 500;
      font-size: 24px;
      color: var(--text);
      padding-bottom: 0;
      position: relative;
      padding-left: 57px;
      transition: var(--transition);
    }

    .breadcrumb-title::after {
      display: none;
    }

    .breadcrumb-links {
      display: flex;
      align-items: center;
      font-size: 17px;
      padding-right: 45px;
      transition: var(--transition);
    }

    .breadcrumb-links a:first-child {
      color: var(--primary);
    }

    .breadcrumb-links a:last-child {
      color: var(--text);
    }

    .breadcrumb-links a {
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
    }

    .breadcrumb-links a:hover {
      opacity: 0.8;
    }

    .breadcrumb-links span {
      margin: 0 8px;
      color: #94a3b8;
    }

    .contact-main {
      padding: 60px 30px;
      background-color: #fff;
    }

    .contact-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .contact-header h2 {
      font-size: 32px;
      color: var(--text);
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
      font-weight: 700;
      transition: var(--transition);
    }

    .contact-header p {
      color: var(--text-light);
      max-width: 700px;
      margin: 0 auto;
      transition: var(--transition);
    }

    .contact-methods {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto 60px;
    }

    .contact-card,
    .contact-map,
    .message-form {
      border-radius: 12px;
      box-shadow: var(--shadow-around);
      background-color: var(--bg-card);
      transition: var(--transition);
      border: none;
    }

    .contact-card {
      padding: 40px 30px;
      text-align: center;
      position: relative;
      overflow: hidden;
      color: var(--text);
    }

    .contact-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .contact-card i {
      font-size: 40px;
      color: #4a89dc; 
      margin-bottom: 20px;
      transition: var(--transition);
    }

    .contact-card h4 {
      margin: 10px 0 15px;
      color: var(--text);
      font-size: 20px;
      font-weight: 600;
      transition: var(--transition);
    }

    .contact-card p {
      font-size: 15px;
      color: var(--text-light);
      line-height: 1.6;
      transition: var(--transition);
    }

    .map-form-wrapper {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .contact-map {
      height: 100%;
      min-height: 500px;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      transition: var(--transition);
    }

    .contact-map iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .message-form {
      padding: 40px;
      display: flex;
      flex-direction: column;
      color: var(--text);
    }

    .message-form h3 {
      margin-bottom: 25px;
      font-size: 24px;
      position: relative;
      padding-bottom: 15px;
      color: var(--text);
      font-weight: 700;
      transition: var(--transition);
    }

    .message-form h3::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 3px;
      background: var(--primary);
      opacity: 0.3;
      transition: var(--transition);
    }

    .form-fields {
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .form-row {
      margin-bottom: 20px;
    }

    .message-form input,
    .message-form textarea {
      width: 100%;
      padding: 12px 15px;
      border-radius: 8px;
      border: 1px solid var(--border-color);
      font-size: 15px;
      background-color: #f9fafb;
      color: var(--text);
      transition: var(--transition);
    }

    .message-form input:focus,
    .message-form textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
      background-color: #fff;
    }

    .message-form textarea {
      min-height: 150px;
      resize: vertical;
    }

    .submit-button {
      background: #4a89dc;
      color: #fff;
      padding: 14px 30px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      width: 100%;
      box-shadow: var(--shadow-sm);
      margin-top: auto;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .submit-button:hover {
      background: #4a89dc;
      box-shadow: var(--shadow-md);
      transform: translateY(-2px);
    }

    @media (max-width: 992px) {
      .breadcrumb-nav {
        padding: 30px 40px 0;
      }
      .contact-methods,
      .map-form-wrapper {
        grid-template-columns: 1fr;
      }
      .contact-map {
        min-height: 400px;
      }
    }

    @media (max-width: 768px) {
      .breadcrumb-nav {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        padding: 25px 30px 0;
      }
      .breadcrumb-title {
        padding-bottom: 15px;
      }
      .breadcrumb-links {
        padding-bottom: 20px;
      }
      .contact-main {
        padding: 40px 20px;
      }
      .contact-header h2 {
        font-size: 28px;
      }
    }

    @media (max-width: 480px) {
      .breadcrumb-nav {
        padding: 20px 20px 0;
      }
      .breadcrumb-title {
        font-size: 24px;
      }
      .map-form-wrapper {
        grid-template-columns: 1fr;
      }
      .message-form {
        padding: 30px 20px;
      }
      .contact-map {
        min-height: 300px;
      }
    }
  </style>
</head>
<body>

  <!-- Breadcrumb Navigation -->
  <div class="breadcrumb-nav" data-aos="fade-down" data-aos-duration="500">
    <div class="breadcrumb-title"> Kontak</div>
    <div class="breadcrumb-links">
      <a href="#"> Beranda</a>
      <span>/</span>
      <a href="#">Kontak</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="contact-main">
    <div class="contact-header" data-aos="fade-up" data-aos-duration="500" data-aos-delay="500">
      <h2>Kami Siap Membantu Anda</h2>
      <p>Tim kami siap menjawab pertanyaan dan membantu kebutuhan rental Anda. Hubungi kami melalui berbagai cara berikut:</p>
    </div>

    <div class="contact-methods">
      <div class="contact-card" data-aos="fade-up" data-aos-duration="500" data-aos-delay="500">
        <i class="fa-solid fa-phone-volume"></i>
        <h4>Telepon</h4>
        <p>Hubungi kami langsung melalui nomor 0812-3456-7890 untuk informasi dan pemesanan. Layanan tersedia 24/7.</p>
      </div>
      <div class="contact-card" data-aos="fade-up" data-aos-duration="500" data-aos-delay="500">
        <i class="fa-solid fa-envelope"></i>
        <h4>Email</h4>
        <p>Kirim pertanyaan atau permintaan penawaran ke email kami di info@rentiva.com. Kami akan membalas dalam 1x24 jam.</p>
      </div>
      <div class="contact-card" data-aos="fade-up" data-aos-duration="500" data-aos-delay="500">
        <i class="fa-solid fa-location-dot"></i>
        <h4>Lokasi Kantor</h4>
        <p>Jl. Mawar No. 10, Malang. Silakan kunjungi kami secara langsung pada jam kerja (Senin-Jumat, 08:00-17:00).</p>
      </div>
    </div>

    <div class="map-form-wrapper">
      <div class="contact-map" data-aos="fade-right" data-aos-duration="500" data-aos-delay="500">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.624634293502!2d112.63003221433189!3d-7.825211779182996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd628212f4a23cf%3A0x8914bdb1b0f7ecf6!2sMalang!5e0!3m2!1sid!2sid!4v1590390054892!5m2!1sid!2sid"
          allowfullscreen=""
          loading="lazy"></iframe>
      </div>

      <div class="message-form" data-aos="fade-left" data-aos-duration="500" data-aos-delay="500">
        <h3>Kirim Pesan Langsung</h3>
        
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
        
        <form class="form-fields" method="POST" action="">
          <div class="form-row">
            <input type="text" name="name" placeholder="Masukkan nama lengkap Anda" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
          </div>
          <div class="form-row">
            <input type="email" name="email" placeholder="Masukkan alamat email Anda" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
          </div>
          <div class="form-row">
            <input type="tel" name="phone" placeholder="Masukkan nomor telepon Anda" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" />
          </div>
          <div class="form-row">
            <textarea name="message" placeholder="Tulis pesan Anda di sini..." required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
          </div>
          <button type="submit" name="submit_message" class="submit-button">
            <i class="fas fa-paper-plane"></i> Kirim Pesan
          </button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 500, // Default animation duration (1 second)
      easing: 'ease-in-out', // Smoother easing
      once: false, // Whether animation should happen only once
      mirror: true, // Whether elements should animate out while scrolling past them
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