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
      font-size: 18px;
    }
    
    .breadcrumb-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #eff6ff;
      padding: 20px 16px;
    }

    .breadcrumb-title {
      font-weight: 500;
      font-size: 28px;
      color: var(--text);
      padding-bottom: 0;
      position: relative;
      padding-left: 57px;
    }

    .breadcrumb-title::after {
      display: none;
    }

    .breadcrumb-links {
      display: flex;
      align-items: center;
      font-size: 20px;
      padding-right: 45px;
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
  font-size: 17px; /* ubah dari 20px ke 14px */
      transition: var(--transition);
      padding-right:15px;
    }

    .breadcrumb-links a:hover {
      opacity: 0.8;
    }
    

    .breadcrumb-links span {
      margin: 0 8px;
      color: #94a3b8;
    }

    /* Info Section */
    .info-section {
      padding: 80px 0;
      background: white;
    }

    .info-section a {
      text-decoration: none;
    }

    .info-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 16px;
    }

    .info-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      margin-bottom: 80px;
    }

    .info-left h2 {
      font-size: 40px;
      font-weight: 700;
      line-height: 1.2;
      margin-bottom: 24px;
      color: var(--text);
    }

    .info-left p,
    .info-right p {
      color: var(--text-light);
      font-size: 18px;
      line-height: 1.8;
      margin-bottom: 20px;
    }

    /* Highlight Cards */
    .highlight-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 24px;
    }

    .highlight-item {
      background: var(--bg-card);
      padding: 40px 24px;
      border-radius: 12px;
      border: 1px solid #f1f5f9;
      text-align: center;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.14);
    }

    .highlight-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: var(--primary);
      border-radius: 0 0 4px 4px;
    }

    .highlight-item:hover {
      transform: translateY(-4px);
      border-color: var(--primary);
      box-shadow: 0 8px 25px rgba(30, 64, 175, 0.08);
    }

    .highlight-icon {
      width: 80px;
      height: 80px;
      background: rgba(30, 64, 175, 0.08);
      color: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
      margin: 0 auto 24px;
      transition: var(--transition);
    }

    .highlight-item:hover .highlight-icon {
      background: var(--primary);
      color: white;
      transform: scale(1.05);
    }

    .highlight-text h3 {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 16px;
      color: var(--text);
    }

    .highlight-text p {
      font-size: 16px;
      color: var(--text-light);
      line-height: 1.6;
      margin: 0;
    }

    /* Why Choose Section */
    .why-choose-section {
      background: var(--bg-card);
      padding: 10px 0;
      position: relative;
    }

    .why-choose-section::before {
      display: none;
    }

    .why-choose-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 16px;
    }

    .why-choose-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
    }

    .section-label {
      display: inline-block;
      background: rgba(30, 64, 175, 0.1);
      color: var(--primary);
      font-weight: 600;
      font-size: 15px;
      letter-spacing: 0.05em;
      padding: 8px 16px;
      border-radius: 50px;
      margin-bottom: 20px;
      text-transform: uppercase;
    }

    .why-choose-text h2 {
      font-size: 42px;
      font-weight: 700;
      line-height: 1.2;
      margin-bottom: 1px;
      color: var(--text);
    }

    .why-choose-text h2 em {
      font-style: italic;
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .why-choose-text > p {
      color: var(--text-light);
      font-size: 18px;
      line-height: 1.7;
      margin-bottom: 32px;
    }

    .features-list {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      margin-bottom: 20px;
    }

    .features-list ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .features-list li {
      margin-bottom: 16px;
      font-size: 18px;
      font-weight: 500;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .check-icon {
      width: 24px;
      height: 24px;
      background: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
    }

    .check-icon svg {
      width: 12px;
      height: 12px;
      stroke: white;
      stroke-width: 2.5;
      fill: none;
    }

    .why-choose-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      color: white;
      padding: 16px 32px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 18px;
      text-decoration: none;
      transition: var(--transition);
      box-shadow: 0 4px 16px rgba(30, 64, 175, 0.3);
    }

    .why-choose-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(30, 64, 175, 0.4);
    }

    /* Image with badges */
    .image-container {
      position: relative;
      display: inline-block;
    }

    .why-choose-image img {
      width: 100%;
      height: auto;
      border-radius: 12px;
    }
.image-badge {
      position: absolute;
      color: white;
      width: 100px;  /* Increased from 80px */
      height: 100px; /* Increased from 80px */
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 20px; /* Slightly larger text */
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      animation: pulse 2s infinite;
      text-align: center;
      line-height: 1.2;
      padding: 15px; /* More padding */
      box-sizing: border-box;
      z-index: 2;
    }

    .badge-top {
      top: 20px;
      right: 20px;
      background: var(--primary);
    }

    .badge-bottom {
      bottom: 20px;
      left: 20px;
      background: #4e6ed8ff;
      flex-direction: column;
      width: 150px; /* Lebar lebih besar untuk bentuk kotak */
      height: 90px; /* Tinggi lebih pendek */
      border-radius: 12px; /* Sudut melengkung */
      padding: 12px; /* Padding internal */
      text-align: center;
    }

    .badge-bottom span {
      font-size: 18px;
      font-weight: bold;
    }

    .badge-bottom small {
      font-size: 12px;
      display: block;
      margin-top: 4px;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    /* Features Grid */
    .features-grid {
      background: white;
      padding: 60px 0;
    }
    .features-container {
      max-width: 1000px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      padding: 0 16px;
    }
    .feature-item {
      display: flex;
      align-items: center;
      gap: 12px;
      justify-content: center;
    }
    .feature-item i {
      font-size: 28px;
      color: #374151;
    }
    .feature-text h3 {
      font-size: 18px;
      margin: 0;
      color: var(--text);
      font-weight: 400;
    }

    /* CTA Section */
    .full-image-section {
      position: relative;
      background: 
        linear-gradient(135deg, rgba(30, 58, 138, 0.7) 0%, rgba(59, 130, 246, 0.7) 100%), 
        url('gambar/back.jpg') no-repeat center center / cover;
      padding: 100px 0;
      overflow: hidden;
    }

    .full-image-section h2 {
      color: white;
      font-size: clamp(36px, 5vw, 52px);
      font-weight: 700;
      margin: 0;
      line-height: 1.2;
    }
    .full-image-section p {
      color: rgba(255, 255, 255, 0.9);
      font-size: 18px;
      line-height: 1.7;
      margin: 0;
      max-width: 700px;
    }

    .cta-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 16px;
      text-align: center;
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 24px;
    }

    .cta-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: white;
      color: var(--primary);
      padding: 18px 36px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 18px;
      text-decoration: none;
      transition: var(--transition);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .cta-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
      color: #1d4ed8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .breadcrumb-nav {
        flex-direction: column;
        gap: 16px;
        text-align: center;
        padding: 16px;
      }

      .info-content {
        grid-template-columns: 1fr;
        gap: 40px;
        margin-bottom: 60px;
      }

      .highlight-list {
        grid-template-columns: 1fr;
      }

      .why-choose-content {
        grid-template-columns: 1fr;
        gap: 60px;
      }

      .features-list {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .features-container {
        grid-template-columns: repeat(2, 1fr);
      }

      .info-section {
        padding: 60px 0;
      }

      .why-choose-section {
        padding: 80px 0;
      }
      
      body {
        font-size: 16px;
      }

      .why-choose-image img {
        width: 100%;
        height: auto;
      }
    }

    @media (max-width: 480px) {
      .features-container {
        grid-template-columns: 1fr;
      }

      .highlight-list {
        grid-template-columns: 1fr;
      }

      .highlight-item {
        padding: 24px;
      }

      .info-container,
      .why-choose-container,
      .features-container,
      .cta-container {
        padding: 0 12px;
      }

      .breadcrumb-links {
        padding-right: 0;
        font-size: 16px;
      }

      .breadcrumb-title {
        font-size: 24px;
        padding-left: 0;
      }
      
      .image-badge {
        width: 60px;
        height: 60px;
        font-size: 16px;
      }
      
      .badge-bottom small {
        font-size: 10px;
      }
    }

    /* Animations */
    [data-aos] {
      transition-property: opacity, transform;
      will-change: opacity, transform;
    }

    [data-aos="fade-up"] {
      transform: translate3d(0, 30px, 0);
    }
    [data-aos="fade-right"] {
      transform: translate3d(-30px, 0, 0);
    }
    [data-aos="fade-left"] {
      transform: translate3d(30px, 0, 0);
    }

    /* Custom animation timings */
    .highlight-item[data-aos] {
      transition-duration: 1s;
    }

    .why-choose-image[data-aos] {
      transition-duration: 1.2s;
    }

    .feature-item[data-aos] {
      transition-duration: 0.8s;
    }
  </style>
</head>
<body>

  <!-- Breadcrumb Navigation -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="breadcrumb-title" style="font-size:22px;">Tentang Kami</div>
    <div class="breadcrumb-links">
      <a href="#">Beranda</a>
      <span>/</span>
      <a href="#">Tentang Kami</a>
    </div>
  </div>

  <!-- Enhanced Info Section -->
  <section class="info-section">
    <div class="info-container">
      <div class="info-content">
        <div class="info-left" data-aos="fade-right" data-aos-delay="100">
          <h2>Petualangan Tak Terlupakan Bersama Rental Jeep & Trail Bromo</h2>
          <p>Kami hadir untuk mengantar Anda menjelajahi keindahan Gunung Bromo dengan pengalaman perjalanan yang aman, nyaman, dan penuh kesan. Dengan armada Jeep dan trail terbaik, kami siap membawa Anda melewati jalur menantang dan pemandangan spektakuler.</p>
        </div>
        <div class="info-right" data-aos="fade-left" data-aos-delay="200">
          <p>Tim kami terdiri dari pengemudi berpengalaman yang menguasai medan Bromo, memastikan perjalanan Anda lancar dari awal hingga akhir. Armada selalu dirawat secara rutin agar performa tetap prima di setiap petualangan.</p>
          <p>Bergabunglah dengan para wisatawan yang telah mempercayakan perjalanan Bromo mereka kepada kami. Nikmati proses booking yang mudah, harga yang transparan, dan pelayanan ramah yang akan membuat liburan Anda semakin berkesan.</p>
        </div>
      </div>

      <!-- Enhanced Highlight Cards -->
      <div class="highlight-list">
        <div class="highlight-item" data-aos="fade-up" data-aos-delay="100">
          <div class="highlight-icon"><i class="fas fa-mountain"></i></div>
          <div class="highlight-text">
            <h3>Visi & Misi Petualangan</h3>
            <p>Membawa setiap wisatawan merasakan pengalaman tak terlupakan menjelajahi Bromo dengan aman, nyaman, dan penuh kesan.</p>
          </div>
        </div>
        <div class="highlight-item" data-aos="fade-up" data-aos-delay="200">
          <div class="highlight-icon"><i class="fas fa-users"></i></div>
          <div class="highlight-text">
            <h3>Tim Berpengalaman</h3>
            <p>Dipandu oleh driver profesional yang memahami jalur dan medan Bromo, memastikan perjalanan Anda lancar dan menyenangkan.</p>
          </div>
        </div>
        <div class="highlight-item" data-aos="fade-up" data-aos-delay="300">
          <div class="highlight-icon"><i class="fas fa-route"></i></div>
          <div class="highlight-text">
            <h3>Layanan Terbaik</h3>
            <p>Menyediakan armada Jeep dan trail terawat, harga transparan, serta kemudahan booking untuk setiap rencana perjalanan yang menyenangkan.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Enhanced Why Choose Us -->
  <section class="why-choose-section">
    <div class="why-choose-container">
      <div class="why-choose-content">
        <div class="why-choose-text" data-aos="fade-right" data-aos-delay="100">
          <p class="section-label"><span style="font-size:13px;">Kenapa Memilih Kami</span></p>
          <h2>Partner Terbaik untuk Petualangan <em>Bromo yang Aman & Berkesan</em></h2>
          <p>Kami menyediakan layanan rental Jeep dan trail khusus untuk menjelajahi Bromo. Armada terawat, jalur menantang, dan pemandangan memukau akan menemani perjalanan Anda. Dipandu oleh sopir berpengalaman yang paham medan.</p>
          
          <div class="features-list">
            <ul>
              <li data-aos="fade-right" data-aos-delay="200"><span class="check-icon"><svg viewBox="0 0 12 10"><polyline points="1.5 5.5 4.5 8.5 10.5 1.5"/></svg></span> Armada Jeep & Trail</li>
              <li data-aos="fade-right" data-aos-delay="250"><span class="check-icon"><svg viewBox="0 0 12 10"><polyline points="1.5 5.5 4.5 8.5 10.5 1.5"/></svg></span> Harga Jelas</li>
            </ul>
            <ul>
              <li data-aos="fade-right" data-aos-delay="300"><span class="check-icon"><svg viewBox="0 0 12 10"><polyline points="1.5 5.5 4.5 8.5 10.5 1.5"/></svg></span> Layanan Siap 24 Jam</li>
              <li data-aos="fade-right" data-aos-delay="350"><span class="check-icon"><svg viewBox="0 0 12 10"><polyline points="1.5 5.5 4.5 8.5 10.5 1.5"/></svg></span> Sopir Ahli</li>
            </ul>
          </div>
        </div>

           <div class="why-choose-image" data-aos="fade-left" data-aos-delay="400">
          <div class="image-container">
            <img src="gambar/mob.png" alt="Layanan Premium Jeep Bromo">
            <div class="image-badge badge-top">
              <span>30% OFF</span> <!-- Tetap lingkaran -->
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Enhanced Features Grid -->
  <section class="features-grid">
    <div class="features-container" data-aos="fade-up">
      <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
        <i class="fas fa-mountain"></i>
        <div class="feature-text">
          <h3>Jeep & Trail Terawat</h3>
        </div>
      </div>
      <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
        <i class="fas fa-tags"></i>
        <div class="feature-text">
          <h3>Harga Jelas</h3>
        </div>
      </div>
      <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
        <i class="fas fa-headset"></i>
        <div class="feature-text">
          <h3>Siap 24 Jam</h3>
        </div>
      </div>
      <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
        <i class="fas fa-route"></i>
        <div class="feature-text">
          <h3>Pemandu Ahli Medan</h3>
        </div>
      </div>
    </div>
  </section>

  <!-- Enhanced CTA Section -->
  <section class="full-image-section">
    <div class="cta-container" data-aos="fade-up" data-aos-delay="100">
      <h2>Siap Menjelajah Bromo Bersama Kami?</h2>
      <p data-aos="fade-up" data-aos-delay="200">Nikmati sensasi petualangan seru dengan rental Jeep dan motor trail untuk menjelajahi keindahan Bromo. Semua bisa Anda nikmati bersama tim kami yang berpengalaman dan ramah.</p>
      <a href="#" class="cta-btn" data-aos="fade-up" data-aos-delay="300">
        <i class="fas fa-phone"></i>
        Hubungi Kami Sekarang
      </a>
    </div>
  </section>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 500,
      easing: 'ease-in-out',
      once: false,
      offset: 120,
      delay: 100,
      mirror: true
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