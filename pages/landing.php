<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rentiva - Jeep Rental Bromo</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- AOS Animation CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>

    .hero {
        background-image: url('gambar/bg1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #333;
        padding: 80px 20px;
        text-align: center;
    }

    .hero h1 {
        font-size: 2.8rem;
        max-width: 1000px;
        font-weight: bold;
        margin-bottom: 10px;
        margin-top: 30px;
    }
  
    .car-image {
        max-width: 900px;
        margin-top: 10px;
        margin-bottom: 60px;
        filter: drop-shadow(0px 29px 28px rgba(0, 0, 0, 0.50));
        display: block;
    }
    
    .hero p {
        margin-bottom: 20px;
        font-size: 20px;
    }

        .how-it-works {
      padding: 100px 0;
      background: #ffffff;
    }

    .section-subtitle {
      color: #a3a3a3ff;
      font-weight: 500;
      letter-spacing: 1.5px;
      font-size: 1rem;
      margin-bottom: 15px;
      text-transform: uppercase;
    }

    .section-title {
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 60px;
      color: #333;
    }

    .steps {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      gap: 60px; /* kasih spasi antar step */
      flex-wrap: wrap;
    }

    .step-item {
      text-align: center;
      position: relative;
      z-index: 1;
      flex: 0 0 240px;
    }

    .step-icon {
      width: 110px;
      height: 110px;
      border-radius: 15px;
      background: #f5fcffff;
      color: #007BFF;
      font-size: 2.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 25px;
    }

    .step-title {
      font-size: 1.4rem;
      font-weight: 500;
      margin-bottom: 12px;
      color: #222;
    }

    .step-description {
      color: #555;
      font-size: 1.1rem;
      line-height: 1.6;
      max-width: 840px;
      margin: 0 auto;
      font-weight: normal; /* pastikan tidak bold */
    }

    .step-connector {
      flex: 0 0 100px;
      height: 3px;
      background: #8bb7e6ff;
      margin-top: 70px; /* dinaikkan biar sejajar icon */
      border-radius: 2px;
      transform: translateX(20px);
    }

    .best-services .img-fluid {
    max-width: 990px;
    height: auto;
    border-radius: 15px;
    position: relative;
}

/* Oval shadow di bawah gambar */
.best-services .img-fluid::after {
    content: '';
    position: absolute;
    left: 50%;
    bottom: -15px; /* jarak dari bawah gambar */
    transform: translateX(-50%);
    width: 60%;
    height: 20px; /* tinggi oval */
    background: rgba(0,0,0,0.25); /* warna bayangan */
    border-radius: 50%;
    filter: blur(15px);
    z-index: -1; /* agar berada di bawah gambar */
    pointer-events: none;
}

    .best-services {
  background: #fff;
}

.best-services .section-subtitle {
  color: #a3a3a3;
  font-size: 0.9rem;
  text-transform: uppercase;
  font-weight: 500;
  letter-spacing: 1px;
}

.best-services .section-title {
  color: #222;
  font-weight: 600;
  font-size: 2rem;
  text-align: left;
}

.best-services .title-underline {
  width: 60px;
  height: 3px;
  background: #007BFF;
  border: none;
  border-radius: 2px;
}

.best-services h5 {
  font-weight: 500;
  color: #333;
}

.best-services p {
  font-size: 0.95rem;
  line-height: 1.6;
}

.icon-circle {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: #f0f4ff;
  color: #007BFF;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  flex-shrink: 0;
}

    
    /* Responsive */
    @media (max-width: 992px) {
      .steps {
        flex-direction: column;
        gap: 50px;
      }
      .step-connector {
        display: none;
      }
    }

    /** RESPONSIVE DESIGN */
    @media (max-width: 1200px) {
      .horizontal-card-container {
        flex-wrap: wrap;
      }
      
      .horizontal-card {
        max-width: calc(50% - 15px);
      }
    }

    @media (max-width: 992px) {
      .property-grid {
        flex-direction: column;
      }
      
      .main-card, .side-cards {
        max-width: 100%;
      }
      
      .main-card-img-container {
        height: 350px;
      }
      
      .horizontal-card {
        max-width: 100%;
      }

      .amenities-top-cards {
        flex-direction: column;
      }

      .amenity-bottom-card {
        min-width: 100%;
      }
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.2rem;
      }
      
      .section-header h2 {
        font-size: 2rem;
      }
      
      .property-card {
        flex-direction: column;
        height: auto;
      }
      
      .side-card-img {
        width: 100%;
        height: 200px;
        border-radius: 12px 12px 0 0;
      }
      
      .main-card-img-container {
        height: 280px;
      }
      
      .main-card-title {
        font-size: 1.4rem;
      }
      
      .side-card-button {
        padding: 6px 12px;
        font-size: 0.9rem;
      }
      
      /* Adjust badges for mobile */
      .img-badge {
        padding: 4px 8px;
        font-size: 0.6rem;
      }
      
      .main-card .img-badge {
        font-size: 0.7rem;
        padding: 6px 10px;
      }
      
      .main-card .img-badge.premium {
        left: 100px;
      }

      .horizontal-card-img {
        height: 220px;
      }

      .amenities-header h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Hero Section -->
  <section class="hero" data-aos="fade-up" data-aos-delay="100">
    <h1>Temukan Layanan Rental Terbaik di Malang</h1>
    <p>Mulai perjalanan seru dari Malang menuju Bromo dengan jeep nyaman, aman, <br>dan sopir berpengalaman.</p>
 
    <img src="gambar/tiga.png" alt="Rental Jeep Bromo di Malang" class="car-image" data-aos="fade-up" data-aos-delay="300">
  </section>

  
  <!-- How It Works Section -->
  <section class="how-it-works">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <h6 class="section-subtitle">Proses Mudah</h6>
        <h2 class="section-title">Langkah-langkah Menyewa Kendaraan</h2>
      </div>

  <div class="steps">
    <!-- Step 1 -->
    <div class="step-item" data-aos="fade-up" data-aos-delay="100">
      <div class="step-icon"><i class="far fa-map"></i></div>
      <h4 class="step-title">Pilih Lokasi</h4>
      <p class="step-description">Tentukan lokasi penjemputan sesuai kebutuhan perjalanan</p>
    </div>

    <!-- Connector 1 -->
    <div class="step-connector"></div>

    <!-- Step 2 -->
    <div class="step-item" data-aos="fade-up" data-aos-delay="200">
      <div class="step-icon"><i class="far fa-calendar-days"></i></div>
      <h4 class="step-title">Tetapkan Tanggal</h4>
      <p class="step-description">Pilih tanggal serta durasi sewa sesuai jadwal liburan Anda.</p>
    </div>

    <!-- Connector 2 -->
    <div class="step-connector"></div>

    <!-- Step 3 -->
    <div class="step-item" data-aos="fade-up" data-aos-delay="300">
      <div class="step-icon"><i class="far fa-calendar-check"></i></div>
      <h4 class="step-title">Booking Mobil</h4>
      <p class="step-description">Konfirmasi pemesanan melalui website resmi kami.</p>
    </div>
</div>

    </div>
  </section>

  <!-- Best Services Section -->
<!-- Best Services Section -->
<section class="best-services py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Gambar Mobil -->
      <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
        <img src="gambar/230.png" alt="Jeep Rental" class="img-fluid">
      </div>

      <!-- Teks & Layanan -->
      <div class="col-lg-6" data-aos="fade-left">
        <h6 class="section-subtitle">Best Services</h6>
        <h2 class="section-title mb-2 text-start">Feel the best experience with our rental deals</h2>
        <hr class="title-underline mb-5">

        <!-- Service Item 1 -->
        <div class="d-flex align-items-start mb-5">
          <div class="icon-circle me-3">
           <i class="far fa-credit-card"></i>  
          </div>
          <div>
            <h5 class="mb-2">Deals for every budget</h5>
            <p class="mb-0 text-muted">Incredible prices on hotels, flights, cars, and packages worldwide.</p>
          </div>
        </div>

        <!-- Service Item 2 -->
        <div class="d-flex align-items-start mb-5">
          <div class="icon-circle me-3">
            <i class="far fa-check-circle"></i>
          </div>
          <div>
            <h5 class="mb-2">Best price guaranteed</h5>
            <p class="mb-0 text-muted">Find a lower price? We'll refund you 100% of the difference.</p>
          </div>
        </div>

        <!-- Service Item 3 -->
        <div class="d-flex align-items-start">
          <div class="icon-circle me-3">
           <i class="far fa-envelope"></i>
          </div>
          <div>
            <h5 class="mb-2">Support 24/7</h5>
            <p class="mb-0 text-muted">Real people, real support. We're available whenever you need us.</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

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
  
</body>
</html>