<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rentiva</title>

<link rel="icon" type="image/png" sizes="512x512" href="gambar/putih.png">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"  />
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


  <style>
.notification {
    position: fixed;
    top: -80px; /* sembunyikan di atas layar */
    left: 50%;
    transform: translateX(-50%);
    background: #4CAF50;
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1050;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: top 0.5s ease; /* animasi turun */
}

.notification.show {
    top: 20px; /* muncul dari atas ke bawah */
}

.cart-drawer {
  position: fixed;
  top: 0;
  right: -400px; /* tersembunyi */
  width: 400px;
  height: 100%;
  background: #fff;
  box-shadow: -2px 0 8px rgba(0,0,0,0.2);
  display: flex;
  flex-direction: column;
  transition: right 0.3s ease;
  z-index: 1050;
}

.cart-drawer.open {
  right: 0; /* muncul */
}

.cart-header {
  background-color: var(--primary);
  color: #fff;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.cart-body {
  flex: 1;
  overflow-y: auto;
  padding: 1rem;
}

.cart-summary {
  padding: 1rem;
  border-top: 1px solid #ddd;
}

.close-btn {
  background: none;
  border: none;
  color: #fff;
  font-size: 1.5rem;
  cursor: pointer;
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #eee;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item-img {
    width: 80px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 1rem;
}

.cart-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-item-details {
    flex-grow: 1;
}

.cart-item-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.cart-item-price {
    color: var(--primary);
    font-weight: 600;
}

.cart-item-quantity {
    display: flex;
    align-items: center;
    margin-top: 0.5rem;
}

.quantity-btn {
    width: 25px;
    height: 25px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.quantity-input {
    width: 40px;
    height: 25px;
    text-align: center;
    border: 1px solid #ddd;
    border-left: none;
    border-right: none;
    margin: 0 5px;
}

.cart-item-remove {
    color: #e74c3c;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    margin-left: 1rem;
}

.cart-summary {
    padding: 1.5rem;
    border-top: 1px solid #eee;
}

.cart-total {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    font-weight: 600;
    font-size: 1.1rem;
}

.empty-cart {
    text-align: center;
    padding: 2rem;
    color: #777;
}

.empty-cart i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #ddd;
}


.profile-dropdown {
    position: relative;
    display: inline-block;
    font-family: 'Poppins', sans-serif;
}

.dropdown-menu-custom h6 {
    margin-bottom: 4px;
    font-weight: 600;
    font-size: 20px;
    line-height: 1.1;
}

.dropdown-menu-custom small {
    display: block;
    margin-bottom: 16px;
    color: #666;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.2;
}

.dropdown-menu-custom {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background-color: white;
    min-width: 320px; /* card lebih lebar */
    box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
    z-index: 1000;
    border-radius: 10px;
    padding: 20px 24px; /* padding lebih besar */
    margin-top: 10px;
    font-family: 'Poppins', sans-serif;
}

/* styling h4 di dalam link */
.dropdown-menu-custom a h4 {
    font-size: 18px;  /* teks lebih besar */
    font-weight: 400;
    margin: 0 0 6px 0; /* jarak bawah */
    display: inline-block;
    font-family: 'Poppins', sans-serif;
}

.dropdown-menu-custom a {
    display: flex;
    align-items: center;
    padding: 13px 0; /* tinggi item lebih besar */
    color: #333;
    text-decoration: none;
    border-bottom: 1px solid #eee;
}

.dropdown-menu-custom a:last-child {
    border-bottom: none;
}

.dropdown-menu-custom a i {
    margin-right: 12px;
    width: 20px;
    font-size: 16px;
    color: #555;
}
.dropdown-menu-custom button {
    all: unset; /* reset semua style bawaan bootstrap */
    display: block;
    width: 100%;
    padding: 10px 0;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    text-align: center;
    box-sizing: border-box;
}

/* tombol Sign In */
.dropdown-menu-custom .btn-primary {
    background-color: #4a89dc;
    border: 1.5px solid #4a89dc;
    color: white;
    margin-top: 12px;  /* jarak dari atas */
    margin-bottom: 8px; /* jarak ke tombol register */
}

/* tombol Register */
.dropdown-menu-custom .btn-outline-primary {
    border: 1.5px solid #4a89dc;
    background-color: transparent;
    color: #4a89dc;
}

/* efek hover */
.dropdown-menu-custom .btn-primary:hover {
    background-color: #4a89dc;
}

.dropdown-menu-custom .btn-outline-primary:hover {
    background-color: #e6f0ff;
}


.profile-dropdown:hover .dropdown-menu-custom {
    display: block;
}

.mobile-menu {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background: white;
  z-index: 999;
  transform: translateX(100%);
  transition: transform 0.3s ease;
  padding: 5rem 2rem 2rem;
  display: flex;
  flex-direction: column;
}

.mobile-menu.active {
  transform: translateX(0);
}

.mobile-nav-list {
  list-style: none;
  margin: 0;
  padding: 0;
}

.mobile-judul {
  margin-bottom: 1.5rem;
}

.mobile-nav-link {
  display: flex;
  align-items: center;
  gap: 1rem;
  color: #4a89dc;
  text-decoration: none;
  font-size: 1.1rem;
  font-weight: 500;
}

.mobile-nav-link i {
  color: #4a89dc;
  width: 24px;
  text-align: center;
}

.mobile-nav-link.active {
  color: #4a89dc;
  font-weight: 600;
}
#backToTopBtn {
  display: none;
  position: fixed;
  bottom: 40px;
  right: 40px;
  z-index: 99;
  font-size: 24px;
  border: none;
  outline: none;
  background-color: #4a89dc;
  color: white;
  cursor: pointer;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  transition: background-color 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}


#backToTopBtn:hover {
  background-color: #f5c7a6ff;
}

    :root {
  --primary: #798ce2ff;
  --text-dark: #2c3e50;
}

.highlight-green {
  color: #798ce2ff; /* Hijau */
}

.contact-section {
  padding: 6rem 2rem;
  background: #ffffffff;
  font-family: 'Poppins', sans-serif;
  position: relative;
  overflow: hidden;
}


.contact-container {
  display: flex;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: 0 auto;
  gap: 2.5rem;
  position: relative;
  z-index: 1;
}

.contact-info {
  flex: 1 1 45%;
  background: linear-gradient(135deg, #4a89dc 0%, #4a89dc 100%);
  padding: 3rem;
  border-radius: 16px;
  box-shadow: 0 15px 40px rgba(210, 120, 60, 0.2);
  color: white;
  position: relative;
  overflow: hidden;
}

.info-header h3 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
}

.info-header h3::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 50px;
  height: 3px;
  background: white;
  border-radius: 3px;
}

.info-header p {
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 2.5rem;
  opacity: 0.9;
}

.info-items-container {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.info-item {
  display: flex;
  align-items: flex-start;
  gap: 1.5rem;
  transition: transform 0.3s ease;
}

.info-item:hover {
  transform: translateX(5px);
}

.icon-circle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.15);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.4rem;
  flex-shrink: 0;
  transition: all 0.3s ease;
}

.info-item:hover .icon-circle {
  background: rgba(255, 255, 255, 0.25);
  transform: scale(1.05);
}

.info-content h4 {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.info-content p {
  font-size: 1rem;
  line-height: 1.6;
  opacity: 0.9;
  margin: 0;
}

.social-links {
  display: flex;
  gap: 1rem;
  margin-top: 3rem;
}

.social-links a {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.15);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.social-links a:hover {
  background: white;
  color: #4a89dc;
  transform: translateY(-3px);
}

.contact-form {
  flex: 1 1 45%;
  background: #fff;
  padding: 3rem;
  border-radius: 16px;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
}

.form-header h3 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #333;
  position: relative;
  display: inline-block;
}

.form-header h3::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 50px;
  height: 3px;
  background: #4a89dc;
  border-radius: 3px;
}

.form-header p {
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 2rem;
  color: #666;
}

.contact-form-inner {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-row {
  display: flex;
  gap: 1.5rem;
}

.form-group {
  flex: 1;
  position: relative;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 1rem 1.2rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
  background: #f9f9f9;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #4a89dc;
  box-shadow: 0 0 0 3px rgba(228, 142, 81, 0.2);
  outline: none;
  background: white;
}

.form-group label {
  position: absolute;
  top: 1rem;
  left: 1.2rem;
  color: #999;
  transition: all 0.3s ease;
  pointer-events: none;
  background: #f9f9f9;
  padding: 0 0.2rem;
}

.form-group input:focus + label,
.form-group input:not(:placeholder-shown) + label,
.form-group textarea:focus + label,
.form-group textarea:not(:placeholder-shown) + label {
  top: -0.6rem;
  left: 0.8rem;
  font-size: 0.8rem;
  color: #4a89dc;
  background: white;
}

.form-group textarea {
  min-height: 120px;
  resize: vertical;
}

.submit-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.8rem;
  background: linear-gradient(135deg, #4a89dc 0%, #4a89dc 100%);
  color: white;
  padding: 1rem 2.5rem;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 5px 15px rgba(210, 120, 60, 0.3);
  margin-top: 0.5rem;
  align-self: flex-start;
}

.submit-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(210, 120, 60, 0.4);
}

.submit-btn:active {
  transform: translateY(0);
}

/* Responsive */
@media (max-width: 768px) {
  .contact-section {
    padding: 4rem 1.5rem;
  }
  
  .contact-info,
  .contact-form {
    flex: 1 1 100%;
    padding: 2rem;
  }
  
  .form-row {
    flex-direction: column;
    gap: 1.5rem;
  }
  
  .social-links {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .info-item {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .icon-circle {
    width: 50px;
    height: 50px;
    font-size: 1.2rem;
  }
}
    :root {
      --primary: #4a89dc;
      --secondary: #4a89dc;
      --dark: #2c3e50;
      --light: #ecf0f1;
      --accent: #e74c3c;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      color: var(--dark);
      overflow-x: hidden;
    }
    
    /* Navbar Modern */
   :root {
  --primary: #4a89dc;
  --primary-dark: #4a89dc;
  --text: #2c3e50;
  --light-bg: #ffffff;
}


        /* MAIN CONTAINER */
        .content-spacer {
    height: 30px;
}

/* MAIN CONTAINER */
.top-navigation-wrapper {
    position: sticky;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    background-color: white;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

/* FIRST ROW */
.brand-search-row {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 15px 5%;
    border-bottom: 1px solid #f0f0f0;
}

.store-identity {
    font-size: 28px;
    font-weight: bold; /* Tetap bold untuk logo */
    color: #000;
    white-space: nowrap;
    text-decoration: none;
}

.product-finder {
    flex-grow: 1;
    max-width: 470px;
    margin: 0 30px;
}

.search-wrapper {
    display: flex;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    overflow: hidden;
    background-color: #f8f9fa;
}

.search-wrapper input {
    flex-grow: 1;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    outline: none;
    background-color: transparent;
}

.search-wrapper button {
    background-color: #4a89dc;
    border: none;
    padding: 0 20px;
    cursor: pointer;
    color: white;
    transition: background-color 0.3s ease;
}

.search-wrapper button:hover {
    background-color: #3a70c2;
}

.user-actions {
    display: flex;
    align-items: center;
    gap: 25px; /* Diperkecil dari 25px */
}

.user-actions a {
    color: #333;
    font-size: 23px; /* Diperkecil dari 26px */
    text-decoration: none;
    font-weight: normal; /* Tipis */
}

.shopping-indicator {
    position: relative;
}

.item-counter {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #4a89dc;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.main-menu-row {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    height: 70px;           /* tinggi fix */
    padding: 0 5%;          /* hapus padding atas/bawah */
    box-sizing: border-box;
}

.navigation-items {
    list-style: none;
    display: flex;
    gap: 30px;
    margin: 0;
    padding: 0;
    height: 100%;           /* penuh ikuti navbar */
    align-items: center;    /* item di tengah */
}

.menu-option {
    text-decoration: none;
    color: #333;
    font-weight: normal;
    font-size: 17px;
    transition: all 0.3s ease;
    padding: 0;             /* hilangkan padding vertikal */
    position: relative;
    line-height: 1;         /* cegah line-height tinggi */
    display: flex;
    align-items: center;    /* teks di tengah */
}

.menu-option:hover {
    color: #4a89dc;
}

.menu-option.active {
    color: #4a89dc;
    font-weight: normal;
}

.menu-option.active::after {
    content: '';
    position: absolute;
    bottom: -5px; /* sedikit di bawah teks */
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #4a89dc;
}

/* RESPONSIVE ADJUSTMENTS */
@media (max-width: 1200px) {
    .brand-search-row, .main-menu-row {
        padding: 15px 3%;
    }
    
    .product-finder {
        margin: 0 20px;
        max-width: 450px;
    }
}

@media (max-width: 900px) {
    .product-finder {
        display: none;
    }
    
}

@media (max-width: 600px) {
    .store-identity {
        font-size: 24px;
    }
    
    .user-actions {
        gap: 15px;
    }
    
    .user-actions a {
        font-size: 18px;
    }
    
 
    
    .menu-option {
        font-size: 14px;
    }
}
   
    /* Enhanced Hero Section */
    .hero {
      height: 100vh;
      min-height: 800px;
      position: relative;
      display: flex;
      align-items: center;
      overflow: hidden;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('gambar/b.jpg') no-repeat center center;
      background-size: cover;
      z-index: 0;
      animation: zoomInOut 20s infinite alternate;
    }

    @keyframes zoomInOut {
      0% {
        transform: scale(1);
      }
      100% {
        transform: scale(1.1);
      }
    }

    .hero-content {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      gap: 50px;
      padding-top: 80px;
      max-width: 1200px;
      margin: 0 auto;
      width: 90%;
    }

    .hero-text {
      flex: 1;
      max-width: 600px;
      color: white;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 1.5rem;
      text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .hero-subtitle {
      font-size: 1.2rem;
      line-height: 1.6;
      margin-bottom: 2.5rem;
      opacity: 0.9;
    }

    .hero-buttons {
      display: flex;
      gap: 15px;
    }

    .btn-hero {
      padding: 15px 30px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      cursor: pointer;
      border: none;
    }

    .btn-primary {
      background-color: var(--secondary);
      color: white;
      box-shadow: 0 10px 20px rgba(211, 201, 112, 0.3);
    }

    .btn-primary:hover {
      background-color: #27ae60;
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(211, 201, 112, 0.3);
    }

    .btn-outline {
      background-color: transparent;
      color: white;
      border: 2px solid white;
    }

    .btn-outline:hover {
      background-color: rgba(255,255,255,0.1);
      transform: translateY(-3px);
    }

    .hero-image {
      flex: 1;
      position: relative;
      max-width: 600px;
    }

    .hero-img {
      width: 100%;
      transform: perspective(1000px) rotateY(-15deg);
      transition: transform 0.5s ease;
    }

    .hero-image:hover .hero-img {
      transform: perspective(1000px) rotateY(-5deg);
    }

    .hero-badge {
      position: absolute;
      bottom: -30px;
      right: -30px;
      background: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      transform: rotate(5deg);
    }

    .badge-content {
      text-align: center;
    }

    .badge-content span {
      font-size: 0.9rem;
      color: #7f8c8d;
    }

    .badge-content h3 {
      font-size: 2rem;
      color: var(--primary);
      margin: 5px 0;
    }

    .badge-content small {
      font-size: 0.8rem;
      color: #95a5a6;
    }

    .scroll-indicator {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      color: white;
      text-align: center;
      z-index: 2;
      opacity: 0.8;
      animation: bounce 2s infinite;
    }

    .scroll-indicator span {
      display: block;
      margin-bottom: 10px;
      font-size: 0.9rem;
    }

    .arrow-down {
      width: 20px;
      height: 20px;
      border-left: 2px solid white;
      border-bottom: 2px solid white;
      transform: rotate(-45deg);
      margin: 0 auto;
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        transform: translateY(0) translateX(-50%);
      }
      40% {
        transform: translateY(-20px) translateX(-50%);
      }
      60% {  
        transform: translateY(-10px) translateX(-50%);
      }
    }
    
    /* Features Section */
    .tour-packages {
  padding: 6rem 0;
  background: #ffffffff;
}

.package-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  height: 100%;
  border: 1px solid #e5e7eb;
}

.package-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.package-image {
  height: 180px;
  background-size: cover;
  background-position: center;
  position: relative;
  display: flex;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 1rem;
}

.package-badge {
  background: white;
  color: #d47a3aff;
  padding: 5px 15px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 700;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.package-content {
  padding: 1.5rem;
}

.package-code {
  font-size: 1rem;
  font-weight: 400;
  color: #6b7280;
  margin-bottom: 0.5rem;
}

.package-title {
  font-size: 1.4rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: var(--dark);
}

.package-price {
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--primary);
  margin-bottom: 1rem;
}

.package-price span {
  font-size: 1rem;
  font-weight: 400;
  color: #6b7280;
}

.package-desc {
  margin-bottom: 1.5rem;
}

.package-desc p {
  color: #4b5563;
  line-height: 1.6;
  margin-bottom: 0;
}

.package-actions {
  display: flex;
  gap: 10px;
}

.btn-detail, .btn-book {
  flex: 1;
  padding: 0.8rem;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.btn-detail {
  background: white;
  color: var(--primary);
  border: 1px solid var(--primary);
}

.btn-detail:hover {
  background: #fae7daff;
}

.btn-book {
  background: var(--primary);
  color: white;
  border: 1px solid var(--primary);
}

.btn-book:hover {
  background: #c06c30ff;
  transform: translateY(-2px);
}
.section-title {
  text-align: center;
  margin-bottom: 3rem;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.section-title h2 {
  font-size: 2.2rem;
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 1rem;
}

.section-title p {
  color: #6b7280;
  font-size: 1.1rem;
  line-height: 1.6;
}


@media (max-width: 768px) {
  .tour-packages {
    padding: 4rem 0;
  }
  
  .package-actions {
    flex-direction: column;
  }
  
  .package-image {
    height: 150px;
  }
}
    /* Vehicles Section */
   .vehicles {
  padding: 6rem 0;
  background: #ffffffff;
}

.vehicle-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  margin-bottom: 2rem;
  position: relative;
  border: 1px solid #f0f0f0;
}

.vehicle-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 40px rgba(46, 204, 113, 0.15);
}

.card-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: var(--secondary);
  color: white;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 600;
  z-index: 2;
}

.vehicle-img {
  height: 200px;
  object-fit: cover;
  width: 100%;
  transition: transform 0.5s ease;
}

.vehicle-card:hover .vehicle-img {
  transform: scale(1.05);
}

.vehicle-body {
  padding: 1.5rem;
}

.vehicle-rating {
  color: #ffc107;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.vehicle-rating span {
  color: #6c757d;
  font-size: 0.8rem;
  margin-left: 5px;
}

.vehicle-body h3 {
  font-size: 1.4rem;
  margin-bottom: 0.8rem;
  color: var(--dark);
}

.price-container {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.vehicle-price {
  color: var(--primary);
  font-weight: 700;
  font-size: 1.3rem;
  margin-right: 10px;
}

.original-price {
  color: #6c757d;
  font-size: 1rem;
  text-decoration: line-through;
  margin-left: 8px;
}

.discount-badge {
  background: #ffeaea;
  color: #e74c3c;
  padding: 3px 8px;
  border-radius: 4px;
  font-size: 0.8rem;
  font-weight: 600;
}

.vehicle-specs {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 1.5rem;
}

.vehicle-specs p {
  font-size: 0.85rem;
  color: #6c757d;
  display: flex;
  align-items: center;
  margin-bottom: 0;
}

.vehicle-specs i {
  margin-right: 5px;
  color: var(--secondary);
}

.btn-vehicle {
  background: var(--primary);
  color: white;
  width: 100%;
  padding: 0.8rem;
  border-radius: 8px;
  border: none;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.btn-vehicle:hover {
  background: #2980b9;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
}

.btn-vehicle i {
  font-size: 0.9rem;
}
    /* Testimonials */
    .testimonial-slider-container {
  position: relative;
  padding-bottom: 60px; /* kasih ruang buat tombol panah di bawah */
}
.testimonial-slider-container {
  position: relative;
  padding-bottom: 60px; /* kasih ruang buat tombol panah di bawah */
}

.swiper-nav-wrapper {
  position: absolute;
  bottom: 10px;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 0 20px;
  pointer-events: none; /* biar nggak ganggu swipe */
}

.custom-nav {
  width: 40px;
  height: 40px;
  background-color: #f4a261;
  color: white;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  pointer-events: all; /* aktifkan klik */
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Hilangkan panah default swiper */
.swiper-button-prev::after,
.swiper-button-next::after {
  display: none;
}

 .swiper-pagination {
  position: absolute;
  bottom: 20px; /* geser ke bawah dari swiper */
  left: 0;
  width: 100%;
  text-align: center;
  z-index: 5;
}


.swiper-pagination-bullet {
  width: 10px;
  height: 10px;
  background: #4a89dc;
  opacity: 0.4;
  margin: 0 5px;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.swiper-pagination-bullet-active {
  opacity: 1;
  transform: scale(1.4); /* Membesar saat aktif */
}

.swiper-button-next::after,
.swiper-button-prev::after {
  display: none !important;
}
.swiper {
  position: relative;
  padding-bottom: 10px; /* kasih ruang buat pagination */
}



.swiper-wrapper {
  padding: 0 50px; /* Biar tombol panah tidak nabrak slide */
}

/* Sembunyikan icon default swiper */
.swiper-button-next::after,
.swiper-button-prev::after {
  display: none !important;
}

/* Tombol custom */
.swiper-button-next.custom-arrow,
.swiper-button-prev.custom-arrow {
  width: 48px;
  height: 48px;
  background-color: #4a89dc;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  z-index: 10;
  cursor: pointer;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
}

/* Posisi kiri & kanan */
.swiper-button-prev.custom-arrow {
  left: 0; /* di luar card */
  color: white;
}

.swiper-button-next.custom-arrow {
  right: 90; /* di luar card */
  color: white;
}

/* Ikon panah */
.swiper-button-next.custom-arrow i,
.swiper-button-prev.custom-arrow i {
  color: white;
  font-size: 18px;
}

/* Hover efek */
.swiper-button-next.custom-arrow:hover,
.swiper-button-prev.custom-arrow:hover {
  transform: translateY(-50%) scale(1.1);
}

    .testimonials {
  padding: 6rem 0;
  background: #faf3eeff; /* Soft blue background */
  position: relative;
}

.testimonial-card {
  background: white;
  border-radius: 12px;
  padding: 2.5rem 2rem;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  position: relative;
  transition: all 0.3s ease;
  height: 100%;
  border: 1px solid rgba(52, 152, 219, 0.1);
}

.testimonial-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 40px rgba(52, 152, 219, 0.1);
}

.quote-icon {
  color: var(--primary);
  font-size: 2.5rem;
  opacity: 0.2;
  margin-bottom: 1rem;
}

.testimonial-text {
  font-style: italic;
  margin-bottom: 2rem;
  position: relative;
  color: #4a5568;
  line-height: 1.7;
  font-size: 1rem;
}

.testimonial-author {
  display: flex;
  align-items: center;
  margin-top: 1.5rem;
}

.author-img {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 1.2rem;
  border: 3px solid rgba(52, 152, 219, 0.1);
}

.author-info h4 {
  margin-bottom: 0.3rem;
  font-size: 1.1rem;
  color: var(--dark);
}

.author-info p {
  color: #718096;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.author-rating {
  color: #f59e0b;
  font-size: 0.8rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .testimonials {
    padding: 4rem 0;
  }
  
  .testimonial-card {
    padding: 2rem 1.5rem;
  }
  
  .author-img {
    width: 50px;
    height: 50px;
  }
}
    
    /* CTA Section */
    .highlight-green {
  color: #4a89dc;
}

 .cta {
  padding: 8rem 0;
  background: #faf3eeff;
  position: relative;
  overflow: hidden;
}

.cta::before {
  content: '';
  position: absolute;
  top: -50px;
  right: -50px;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  z-index: 0;
}

.cta::after {
  content: '';
  position: absolute;
  bottom: -100px;
  left: -100px;
  width: 400px;
  height: 400px;
  z-index: 0;
}

.cta-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  gap: 60px;
  position: relative;
  z-index: 1;
}

.cta-text {
  flex: 1;
  position: relative;
}

.cta-image {
  flex: 1;
  position: relative;
  perspective: 1000px;
}

.cta-image::before {
  content: '';
  position: absolute;
  top: -20px;
  right: -20px;
  width: 100%;
  height: 100%;
}

.cta-image:hover::before {
  top: -15px;
  right: -15px;
}

.cta-image {
  flex: 1;
  position: relative;
  border-radius: 0; /* kalau tetap pengen full kotak, bisa ubah ke 0 */
  overflow: visible; /* biar gak motong */
  box-shadow: none; /* hilangkan efek kotak bayangan */
  transition: none; /* gak perlu transisi lagi */
}

.cta-img {
  width: 100%;
  height: auto;
  display: block;
  transform: none;
  transition: none;
}


.cta h2 {
  font-size: 2.8rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  line-height: 1.2;
  color: #2c3e50;
  position: relative;
  display: inline-block;
}

.cta h2::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 0;
  width: 80px;
  height: 4px;
  border-radius: 2px;
}

.cta p {
  font-size: 1.25rem;
  line-height: 1.7;
  margin-bottom: 2.5rem;
  color: #424242ff;
  max-width: 500px;
}

.btn-cta {
  background: linear-gradient(135deg, #4a89dc, #4a89dc);
  color: white;
  padding: 1.1rem 3.5rem;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1.2rem;
  border: none;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
  overflow: hidden;
  display: inline-flex;
  align-items: center;
  gap: 10px;
}

.btn-cta::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: 0.5s;
}

.btn-cta:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 15px 30px rgba(46, 204, 113, 0.4);
}

.btn-cta:hover::before {
  left: 100%;
}

.btn-cta i {
  font-size: 1.1rem;
  transition: transform 0.3s ease;
}

.btn-cta:hover i {
  transform: translateX(5px);
}

/* Responsive */
@media (max-width: 1200px) {
  .cta-container {
    gap: 40px;
  }
}

@media (max-width: 992px) {
  .cta {
    padding: 6rem 0;
  }
  
  .cta-container {
    flex-direction: column;
    gap: 40px;
  }
  
  .cta-text {
    text-align: center;
  }
  
  .cta h2::after {
    left: 50%;
    transform: translateX(-50%);
  }
  
  .cta p {
    margin-left: auto;
    margin-right: auto;
  }
  
  .cta-image {
    max-width: 600px;
    margin: 0 auto;
  }
  
  .cta-image::before {
    top: -15px;
    right: -15px;
  }
}

@media (max-width: 768px) {
  .cta h2 {
    font-size: 2.2rem;
  }
  
  .cta p {
    font-size: 1.1rem;
  }
  
  .btn-cta {
    padding: 1rem 3rem;
    font-size: 1.1rem;
  }
}

@media (max-width: 576px) {
  .cta {
    padding: 5rem 0;
  }
  
  .cta h2 {
    font-size: 1.8rem;
  }
  
  .btn-cta {
    width: 100%;
    justify-content: center;
  }
}


    /* Footer */
.footer {
    background: rgba(255, 255, 255, 1); /* Changed from dark to white */
    color: black; /* Changed from white to black */
    padding: 4rem 0 2rem;
    border-top: 1px solid #eee; /* Added border for separation */
}

.footer-logo {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: var(--dark); /* Changed from light to dark */
}

.footer-logo span {
    color: #4a89dc; /* Changed from secondary (brown) to blue */
}

.footer-about p {
    opacity: 0.7; /* Slightly adjusted for better readability */
    margin-bottom: 1.5rem;
    color: #555; /* Darker text for better contrast */
}

.social-icons {
    display: flex;
    gap: 1rem;
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f5f5f5; /* Light gray instead of white */
    display: flex;
    color: #4a89dc; /* Changed to blue */
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: #4a89dc; /* Changed to blue */
    color: white; /* Icon becomes white on hover */
    transform: translateY(-3px);
}

.footer-links h3 {
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
    color: #333; /* Darker heading */
}

.footer-links h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background: #4a89dc; /* Changed from secondary (brown) to blue */
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: #666; /* Changed from light white to dark gray */
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #4a89dc; /* Changed to blue on hover */
    padding-left: 5px;
}

.footer-contact h3 {
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    position: relative;
    font-weight: 600;
    color: #333; /* Darker heading */
}

.footer-contact p {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
    font-size: 0.95rem;
    color: #555; /* Darker text */
}

.footer-contact i {
    margin-right: 1rem;
    color: #4a89dc; /* Changed from secondary (brown) to blue */
    margin-top: 3px;
}

.footer-bottom {
    border-top: 1px solid #eee; /* Changed to light gray */
    padding-top: 2rem;
    margin-top: 2rem;
    text-align: center;
    color: #666; /* Dark gray text */
}

    /* Responsive */
    @media (max-width: 1200px) {
      .hero-content {
        flex-direction: column;
        text-align: center;
        padding-top: 120px;
      }
      
      .hero-buttons {
        justify-content: center;
      }
 
    }
    
    @media (max-width: 992px) {
      .hero-title {
        font-size: 2.8rem;
      }
      
      .navbar-nav {
        gap: 1rem;
      }
    }
    
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.2rem;
      }
      
      .hero-subtitle {
        font-size: 1rem;
      }
      
      .section-title h2 {
        font-size: 2rem;
      }
      
      .menu-container {
        flex-direction: column;
      }
      
      .nav-logo {
        margin-bottom: 1rem;
      }
      
      .hero-badge {
        bottom: -20px;
        right: -20px;
        padding: 15px;
      }
      
      .badge-content h3 {
        font-size: 1.5rem;
      }
    }
    
    @media (max-width: 576px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .hero-buttons {
        flex-direction: column;
      }
      
      .btn-hero {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Back to Top Button -->
<button onclick="scrollToTop()" id="backToTopBtn" title="Kembali ke atas">&#8679;</button>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'landing';
?>

  <!-- Navbar -->
   <div class="top-navigation-wrapper">
    <!-- FIRST ROW - BRAND & SEARCH -->
    <div class="brand-search-row">
        <!-- Store Logo -->
        <a href="#" class="store-identity" style="display: flex; align-items: center; gap: 8px; text-decoration: none; font-weight: bold; font-size: 24px; color: #000;">
            <img src="gambar/bi.png" alt="Car Icon" style="width: 40px; height: 40px;">
            Rentiva
        </a>
        
        <!-- Search Bar -->
        <div class="product-finder">
            <div class="search-wrapper">
                <input type="text" placeholder="Search for products">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
        
        <!-- User Icons - Modified with dropdown -->
        <div class="user-actions">
            <!-- Profile Dropdown -->
     <div class="profile-dropdown">
    <i class="far fa-user profile-icon" id="profileIcon" style="cursor: pointer; font-size: 22px; padding-top:7px;"></i>
    <div class="dropdown-menu-custom" id="profileMenu">
        <h6>Welcome to Rentiva</h6>
        <small>Access account & manage orders</small>
        <a href="index.php?page=profile"><i class="fas fa-user"></i> <h4>My Profile</h4></a>
        <a href="pages/wishlist.php"><i class="far fa-heart"></i> <h4>My Wishlist</h4></a>
        <a href="#"><i class="fas fa-cog"></i> <h4>Settings</h4></a>
  <button class="btn btn-primary">Sign In</button>
<button class="btn btn-outline-primary">Register</button>

    </div>
</div>

            
            <!-- Keep other icons -->
            <a href="#" class="shopping-indicator">
                <i class="fas fa-shopping-cart" style="color: transparent; -webkit-text-stroke: 1.5px #000000ff; font-size: 20px;"></i>
                <span class="item-counter">0</span>
            </a>
        </div>
    </div>
    
    <!-- SECOND ROW - MAIN MENU (unchanged) -->
    <div class="main-menu-row">
        <nav>
            <ul class="navigation-items">
                <li>
                    <a href="index.php?page=landing" class="menu-option <?= ($page == 'landing') ? 'active' : '' ?>">Beranda</a>
                </li>
                <li>
                    <a href="index.php?page=pembelian" class="menu-option <?= ($page == 'pembelian') ? 'active' : '' ?>">Penyewaan</a>
                </li>
                <li>
                    <a href="index.php?page=servis" class="menu-option <?= ($page == 'servis') ? 'active' : '' ?>">Kontak</a>
                </li>
                <li>
                    <a href="index.php?page=galeri" class="menu-option <?= ($page == 'galeri') ? 'active' : '' ?>">Galeri</a>
                </li>
                <li>
                    <a href="index.php?page=testimoni" class="menu-option <?= ($page == 'testimoni') ? 'active' : '' ?>">Testimoni</a>
                </li>
                <li>
                    <a href="index.php?page=about" class="menu-option <?= ($page == 'about') ? 'active' : '' ?>">Tentang Kami</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

    <?php
$page = $_GET['page'] ?? 'beranda';

switch ($page) {
    case 'pembelian':
        include 'pages/pembelian.php';
        break;
    case 'servis':
        include 'pages/servis.php';
        break;
    case 'galeri':
        include 'pages/galeri.php';
        break;
    case 'about':
        include 'pages/about.php';
        break;
    case 'testimoni':
        include 'pages/testimoni.php';
        break;
    case 'detail':   // ✅ Tambahin ini
        include 'pages/detail.php';
        break;
    case 'detail1':   // ✅ Tambahin ini
        include 'pages/detail1.php';
        break;
    case 'detail2':   // ✅ Tambahin ini
        include 'pages/detail2.php';
        break;
    case 'detail3':   // ✅ Tambahin ini
        include 'pages/detail3.php';
        break;
    case 'profile':   // ✅ Tambahin ini
        include 'pages/profile.php';
        break;
    default:
        include 'pages/landing.php';
        break;
}


?>




  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <a href="#" class="footer-logo">Rental<span>Bromo</span></a>
          <p class="footer-about">Kami menyediakan layanan sewa kendaraan terbaik untuk petualangan Anda di Bromo. Dengan armada lengkap dan pelayanan profesional, kami siap membuat perjalanan Anda berkesan.</p>
          <div class="social-icons">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
          <div class="footer-links">
            <h3 style="color: black;">Links</h3>
            <ul>
              <li><a href="#">Beranda</a></li>
              <li><a href="#">Pembelian</a></li>
              <li><a href="#">Servis</a></li>
              <li><a href="#">Tentang</a></li>
              <li><a href="#">Kontak</a></li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
          <div class="footer-links">
            <h3 style="color: black;">Kendaraan</h3>
            <ul>
              <li><a href="#">Jeep</a></li>
              <li><a href="#">Motor Trail</a></li>
              <li><a href="#">ATV</a></li>
              <li><a href="#">Mobil Keluarga</a></li>
              <li><a href="#">Semua Kendaraan</a></li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="footer-contact">
            <h3 style="color: black;">Kontak Kami</h3>
            <p><i class="fas fa-map-marker-alt"></i> Jl. Raya Bromo No.88, Probolinggo, Jawa Timur</p>
            <p><i class="fas fa-phone-alt"></i> +62 812-3456-7890</p>
            <p><i class="fas fa-envelope"></i> info@rentalbromo.com</p>
            <p><i class="fas fa-clock"></i> Buka 24 Jam Setiap Hari</p>
          </div>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; 2025 RentalBromo. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>
   <script>
        function setActive(clickedElement) {
            // Remove active class from all menu items
            const allMenuItems = document.querySelectorAll('.menu-option');
            allMenuItems.forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to clicked item
            clickedElement.classList.add('active');
        }
    </script>
  <script>
  // Tampilkan tombol saat scroll ke bawah
  window.onscroll = function() {
    const btn = document.getElementById("backToTopBtn");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  };

  // Scroll ke atas saat diklik
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

<!-- Swiper JS -->
 <!-- di head -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

<!-- sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.mySwiper', {
  slidesPerView: 3,
  spaceBetween: 30,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

</script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true, // biar bisa balik ke slide awal
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
</script>
<script>
  // Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.createElement('div');
mobileMenu.className = 'mobile-menu';
mobileMenu.innerHTML = `
  <ul class="mobile-nav-list">
    <li class="mobile-judul">
      <a href="index.php?page=landing" class="mobile-nav-link ${window.location.href.includes('landing') ? 'active' : ''}">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
      </a>
    </li>
    <li class="mobile-judul">
      <a href="index.php?page=pembelian" class="mobile-nav-link ${window.location.href.includes('pembelian') ? 'active' : ''}">
        <i class="fas fa-shopping-cart"></i>
        <span>Pembelian</span>
      </a>
    </li>
    <li class="mobile-judul">
      <a href="index.php?page=servis" class="mobile-nav-link ${window.location.href.includes('servis') ? 'active' : ''}">
        <i class="fas fa-tools"></i>
        <span>Servis</span>
      </a>
    </li>
  </ul>
`;

document.body.appendChild(mobileMenu);

mobileMenuBtn.addEventListener('click', function() {
  mobileMenu.classList.toggle('active');
  this.querySelector('i').classList.toggle('fa-bars');
  this.querySelector('i').classList.toggle('fa-times');
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.mobile-nav-link').forEach(link => {
  link.addEventListener('click', function() {
    mobileMenu.classList.remove('active');
    mobileMenuBtn.querySelector('i').classList.remove('fa-times');
    mobileMenuBtn.querySelector('i').classList.add('fa-bars');
  });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileIcon = document.getElementById('profileIcon');
        const profileMenu = document.getElementById('profileMenu');
        
        // Toggle dropdown on click
        profileIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.style.display = profileMenu.style.display === 'block' ? 'none' : 'block';
        });
        
        // Close when clicking outside
        document.addEventListener('click', function() {
            profileMenu.style.display = 'none';
        });
    });
</script>
<!-- Cart Modal -->
<!-- Cart Drawer -->
<div class="cart-drawer" id="cartDrawer">
  <div class="cart-header">
    <h5><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h5>
    <button class="close-btn" onclick="toggleCart()">×</button>
  </div>
  <div class="cart-body" id="cartItems">
    <p class="empty-cart">Keranjang belanja Anda kosong</p>
  </div>
  <div class="cart-summary">
    <div class="cart-total">
      <span>Total:</span>
      <span id="cartTotal">Rp 0</span>
    </div>
    <button class="btn btn-primary w-100" id="checkoutBtn">
      <i class="fas fa-credit-card me-2"></i>Checkout
    </button>
  </div>
</div>

<!-- Notification -->
<div class="notification" id="notification">
    <i class="fas fa-check-circle"></i> Produk berhasil ditambahkan ke keranjang!
</div>

</body>
<script>
// Cart management
let cart = JSON.parse(localStorage.getItem('cart')) || [];
const cartCounter = document.querySelector('.item-counter');
const cartItemsContainer = document.getElementById('cartItems');
const cartTotalElement = document.getElementById('cartTotal');

// Toggle drawer
function toggleCart() {
  document.getElementById('cartDrawer').classList.toggle('open');
}

// Update cart counter
function updateCartCounter() {
  const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
  cartCounter.textContent = totalItems;
}

// Add item to cart
function addToCart(product) {
  const existingItem = cart.find(item => item.id === product.id);
  
  if (existingItem) {
    existingItem.quantity += product.quantity;
  } else {
    cart.push({...product});
  }
  
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCounter();
}

// Remove item from cart
function removeFromCart(productId) {
  cart = cart.filter(item => item.id !== productId);
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCounter();
  renderCartItems();
}

// Update item quantity
function updateQuantity(productId, newQuantity) {
  const item = cart.find(item => item.id === productId);
  if (item) {
    item.quantity = Math.max(1, newQuantity);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCounter();
    renderCartItems();
  }
}

// Render cart items
function renderCartItems() {
  if (cart.length === 0) {
    cartItemsContainer.innerHTML = `
      <p class="empty-cart">Keranjang belanja Anda kosong</p>
    `;
    cartTotalElement.textContent = 'Rp 0';
    return;
  }
  
  let itemsHTML = '';
  let total = 0;
  
  cart.forEach(item => {
    const itemTotal = item.price * item.quantity;
    total += itemTotal;
    
    itemsHTML += `
      <div class="cart-item">
        <div class="cart-item-img">
          <img src="${item.image}" alt="${item.name}">
        </div>
        <div class="cart-item-details">
          <div class="cart-item-title">${item.name}</div>
          <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
          <div class="cart-item-quantity">
            <button class="quantity-btn" onclick="updateQuantity('${item.id}', ${item.quantity - 1})">-</button>
            <input type="number" class="quantity-input" value="${item.quantity}" min="1" onchange="updateQuantity('${item.id}', parseInt(this.value))">
            <button class="quantity-btn" onclick="updateQuantity('${item.id}', ${item.quantity + 1})">+</button>
          </div>
        </div>
        <button class="cart-item-remove" onclick="removeFromCart('${item.id}')">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    `;
  });
  
  cartItemsContainer.innerHTML = itemsHTML;
  cartTotalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
}

// Initialize cart on page load
window.addEventListener('load', function() {
  cart = JSON.parse(localStorage.getItem('cart')) || [];
  updateCartCounter();
});

// Klik ikon keranjang → buka drawer
document.querySelector('.shopping-indicator').addEventListener('click', function(e) {
  e.preventDefault();
  renderCartItems();
  toggleCart();
});

// Checkout button
document.getElementById('checkoutBtn').addEventListener('click', function() {
  if (cart.length > 0) {
    alert('Terima kasih! Pesanan Anda sedang diproses.');
    cart = [];
    localStorage.removeItem('cart');
    updateCartCounter();
    renderCartItems();
    toggleCart();
  }
});

// Sync antar halaman/tab
window.addEventListener('storage', function(e) {
  if (e.key === 'cart') {
    cart = JSON.parse(e.newValue || '[]');
    updateCartCounter();
  }
});
</script>
</script>
</html>