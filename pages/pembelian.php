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
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #10B981;
            --accent-color: #F59E0B;
            --danger-color: #EF4444;
            --light-color: #F8FAFC;
            --dark-color: #1F2937;
            --text-color: #374151;
            --text-light: #6B7280;
            --gray-light: #E5E7EB;
            --white: #FFFFFF;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 12px;
            --border-radius-sm: 8px;
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
      padding: 40px 30px;
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

    

     

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            outline: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-icon {
            padding: 0.75rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .badge-secondary {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .badge-accent {
            background-color: var(--accent-color);
            color: var(--dark-color);
        }

        /* Header */
        .header {
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 10;
        }

        .logo-icon {
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            letter-spacing: -0.5px;
        }

        .logo-text span {
            color: var(--primary-color);
        }

        /* Navigasi Utama */
        .main-nav-simplified {
            flex: 1;
            margin: 0 2rem;
        }

        .nav-list-simplified {
            display: flex;
            list-style: none;
            gap: 2rem;
            justify-content: center;
        }

        .nav-item-simplified {
            display: flex;
            align-items: center;
        }

        .nav-link-simplified {
            font-weight: 500;
            font-size: 1rem;
            color: var(--text-light);
            transition: var(--transition);
            padding: 0.5rem 0;
            position: relative;
        }

        .nav-link-simplified:hover,
        .nav-link-simplified.active {
            color: var(--primary-color);
        }

        .nav-link-simplified.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
        }

        /* Elemen Kanan Header */
        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        /* Search Bar */
        .search-bar {
            position: relative;
            width: 240px;
        }

        .search-input {
            width: 100%;
            padding: 0.7rem 1.25rem;
            padding-right: 40px;
            border: 1px solid var(--gray-light);
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            transition: var(--transition);
            background-color: var(--light-color);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 5px;
            bottom: 5px;
            width: 32px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-btn:hover {
            background: var(--primary-dark);
        }

        /* Grup Ikon */
        .icon-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-icon {
            position: relative;
            font-size: 18px;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: var(--transition);
        }

        .nav-icon:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .nav-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: var(--danger-color);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 50%;
        }

        /* Cart Dropdown Styles */
        .cart-dropdown {
            position: fixed;
            top: 80px;
            right: 20px;
            width: 350px;
            max-height: 80vh;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            display: none;
            padding: 1rem;
            overflow-y: auto;
            border: 1px solid var(--gray-light);
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .cart-dropdown.active {
            display: block;
            transform: translateY(0);
            opacity: 1;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-light);
            margin-bottom: 1rem;
        }

        .cart-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark-color);
        }

        .close-cart {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
        }

        .close-cart:hover {
            color: var(--danger-color);
        }

        .cart-items {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 1rem;
        }

        .empty-cart {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
        }

        .empty-cart i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--gray-light);
        }

        .empty-cart p {
            margin: 0;
        }

        .cart-item {
            display: flex;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-img {
            width: 80px;
            height: 60px;
            border-radius: var(--border-radius-sm);
            object-fit: cover;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            color: var(--dark-color);
        }

        .cart-item-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        .cart-item-price {
            font-weight: 600;
            color: var(--primary-color);
        }

        .rental-period {
            margin-top: 0.5rem;
        }

        .period-label {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
            display: block;
        }

        .period-select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--gray-light);
            border-radius: var(--border-radius-sm);
            font-size: 0.9rem;
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid var(--gray-light);
            border-radius: var(--border-radius-sm);
        }

        .quantity-btn {
            background: none;
            border: none;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-color);
        }

        .quantity-input {
            width: 30px;
            text-align: center;
            border: none;
            border-left: 1px solid var(--gray-light);
            border-right: 1px solid var(--gray-light);
            padding: 0.25rem;
        }

        .remove-item {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            font-size: 1rem;
        }

        .cart-summary {
            border-top: 1px solid var(--gray-light);
            padding-top: 1rem;
            display: none;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .summary-label {
            color: var(--text-light);
        }

        .summary-value {
            font-weight: 600;
        }

        .total-row {
            font-size: 1.1rem;
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid var(--gray-light);
        }

        .total-value {
            color: var(--primary-color);
        }

        .cart-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            display: none;
        }
.top-banner {
    width: 100%;
    height: 40px;
    background-color: #2563eb; /* Changed to blue */
}

        /* Sort Dropdown */
        .sort-dropdown {
            position: relative;
        }

      .sort-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 8px 32px; /* semula 8px 12px */
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: white;
    cursor: pointer;
    min-width: 150px; /* tambahkan ini biar tombol agak panjang */
}


        .sort-btn:hover {
            border-color: var(--primary-color);
        }

        .sort-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--white);
            min-width: 200px;
            box-shadow: var(--shadow-lg);
            z-index: 1;
            border-radius: var(--border-radius-sm);
            overflow: hidden;
        }

        .sort-item {
            padding: 0.8rem 1.25rem;
            font-size: 0.95rem;
            transition: var(--transition);
            cursor: pointer;
        }

        .sort-item:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        .sort-dropdown:hover .sort-menu {
            display: block;
        }

        /* Navigasi Kategori */.category-nav {
    padding: 1.5rem 0 2rem 0;
    margin-bottom: 2rem;
}

.category-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    flex-wrap: wrap;
    gap: 10px;
}

.header-left {
    flex: 1;
    display: flex;
    align-items: flex-end;
}

.section-title {
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
        margin-left: 0;
    padding-left: 0;
    text-align: left;

    margin-bottom: 0.5rem; /* agar agak ke bawah */
}

.section-title i {
    color: var(--primary-color);
}


        /* Konten Utama */
        .main-content {
            display: flex;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            flex-shrink: 0;
            
        }

        .filter-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .filter-title {
            font-size: 1.1rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--gray-light);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-title i {
            color: var(--primary-color);
        }

        .filter-list {
            list-style: none;
        }

        .filter-item {
            margin-bottom: 0.75rem;
            color: black;
        }

        .filter-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.95rem;
            padding: 0.5rem;
            border-radius: var(--border-radius-sm);
            transition: var(--transition);
        }

        .filter-link i {
            width: 20px;
            text-align: center;
            color: var(--primary-color);
        }
        .filter-link span {
          color: black;
        }

        .filter-link:hover, .filter-link.active {
            color: var(--primary-color);
            background-color: #dbeafe;
        }

        /* Grid Produk */
        .product-grid {
            flex: 1;
        }

        .product-row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

 .product-badge {
    position: absolute;
    top: 12px;
    left: 0;
    z-index: 1;
    padding: 6px 12px;
    color: white; /* teks putih */
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    font-weight: bold;
}

/* Warna khusus */
.product-badge.tersedia {
    background-color: #2563eb; /* biru */
}

.product-badge.kosong {
    background-color: #ef4444; /* merah */
}


        .product-media {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-wishlist {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--white);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
            z-index: 1;
        }

        .product-wishlist:hover {
            color: var(--danger-color);
            transform: scale(1.1);
        }

        .product-wishlist.active {
            color: var(--danger-color);
        }

        .product-info {
            padding: 1.25rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .product-location {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 0.75rem;
        }

        .product-location i {
            color: var(--primary-color);
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: #EF4444;
            margin-bottom: 1rem;
        }

        .product-price span {
            font-size: 0.9rem;
            font-weight: 400;
            color: #EF4444
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--gray-light);
            padding-top: 0.75rem;
            margin-top: 0.75rem;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .product-rating i {
            color: var(--accent-color);
        }
/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin: 0 0.25rem;
    font-weight: 500;
    transition: var(--transition);
    border: 2px solid #2563eb; /* Changed to blue */
    color: #333; /* Warna teks awal */
    text-decoration: none;
}

.page-link:hover {
    background-color: #2563eb; /* Changed to blue */
    color: white; /* Warna teks saat hover */
}


.page-link.active {
    background-color: #2563eb; /* Changed to blue */
    color: white;
    border: 2px solid #2563eb; /* Changed to blue */
}

        /* Class untuk produk yang disembunyikan */
        .product-hidden {
            display: none;
        }

        /* Highlight Effect */
        .highlight {
            animation: pulse 1s;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        /* Responsif */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-image {
                width: 40%;
            }
        }

        @media (max-width: 992px) {
            .main-content {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            .hero-container {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-content {
                margin-bottom: 2rem;
            }
            
            .hero-image {
                width: 60%;
            }

            /* Penyesuaian Navbar */
            .main-nav-simplified {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
                margin-left: 1rem;
            }

            .header-right {
                margin-left: auto;
            }

            .search-bar {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 5rem 0 3rem;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .product-row {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            /* Penyesuaian Navbar */
            .search-bar {
                order: 3;
                width: 100%;
                margin: 1rem 0;
            }

            .auth-buttons {
                display: none;
            }

            .icon-group {
                margin-left: auto;
            }

            .header-container {
                flex-wrap: wrap;
            }

            .logo {
                order: 1;
            }

            .mobile-menu-btn {
                order: 2;
            }

            .icon-group {
                order: 3;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 1.5rem;
            }
            
            .hero-title {
                font-size: 1.5rem;
            }
            
            .hero-text {
                font-size: 1rem;
            }
            
            .hero-image {
                width: 80%;
            }
            
            .product-media {
                height: 180px;
            }

            .logo-text {
                font-size: 1.3rem;
            }
            
            .nav-icon {
                font-size: 1.2rem;
            }

            .hero-cta {
                flex-direction: column;
            }

            .cart-dropdown {
                width: 300px;
                right: 10px;
            }
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



  <!-- Main Content -->
   <div class="contact-main">
   
 <section class="category-nav">
    <div class="container category-container">
        <!-- Kiri: Judul -->
        <div class="header-left">
            <h2 class="section-title">
                <span><b>Petualangan Rentiva </b></span>
            </h2>
        </div>

        <!-- Kanan: Ikon dan Sort -->
        <div class="header-right d-flex align-items-center">
            <div class="icon-group me-3">
               
            </div>
            <div class="sort-dropdown">
                <button class="sort-btn">
                    <span>Urutan Rekomendasi</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="sort-menu">
                    <div class="sort-item">Harga: Rendah ke Tinggi</div>
                    <div class="sort-item">Harga: Tinggi ke Rendah</div>
                    <div class="sort-item">Rating Tertinggi</div>
                    <div class="sort-item">Paling Populer</div>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="cart-dropdown" id="cartDropdown">
        <div class="cart-header">
            <h3 class="cart-title">Keranjang Sewa</h3>
            <button class="close-cart" id="closeCart">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="cart-items" id="cartItems">
            <!-- Item akan ditambahkan secara dinamis -->
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <p>Keranjang Anda kosong</p>
            </div>
        </div>
        
        <div class="cart-summary" id="cartSummary">
            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value" id="subtotal">Rp0</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Biaya Layanan</span>
                <span class="summary-value">Rp50.000</span>
            </div>
            <div class="summary-row total-row">
                <span class="summary-label">Total</span>
                <span class="summary-value total-value" id="total">Rp50.000</span>
            </div>
        </div>
        
        <div class="cart-actions" id="cartActions">
            <button class="btn btn-outline" id="viewCartBtn">Lihat Keranjang</button>
            <button class="btn btn-primary">Lanjut Pembayaran</button>
        </div>
    </div>

    <!-- Konten Utama -->
    <main class="container main-content" style="color: black;">
        <!-- Sidebar Filter -->
        <aside class="sidebar">
            <div class="filter-card">
                <h3 class="filter-title">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </h3>
                <div class="filter-actions">
                    <button class="btn btn-outline" id="resetFilters" style="width: 100%; margin-bottom: 1rem;">Hapus Semua</button>
                </div>
            </div>
            
            <div class="filter-card">
                <h3 class="filter-title">
                    <i class="fas fa-list"></i>
                    <span>Kategori</span>
                </h3>
                <ul class="filter-list" id="categoryFilters">
                  
                    <li class="filter-item">
                        <a href="#" class="filter-link" data-category="jeep">
                            <span>Mobil Jeep</span>
                        </a>
                    </li>
                    <li class="filter-item">
                        <a href="#" class="filter-link" data-category="motor">
                            <span>Motor Tril</span>
                        </a>
                    </li>
                </ul>
            </div>

            
            <div class="filter-card">
                <h3 class="filter-title">
                    <i class="fas fa-sliders-h"></i>
                    <span>Opsi Sewa</span>
                </h3>
                <ul class="filter-list" id="rentalOptions">
                    <li class="filter-item">
                        <a href="#" class="filter-link" data-option="daily">
                            <span>Sewa Harian</span>
                        </a>
                    </li>
                    <li class="filter-item">
                        <a href="#" class="filter-link" data-option="weekly">
                            <span>Sewa Mingguan</span>
                        </a>
                    </li>
                    <li class="filter-item">
                        <a href="#" class="filter-link" data-option="monthly">
                            <span>Sewa Bulanan</span>
                        </a>
                    </li>
                    <li class="filter-item">
                        <a href="#" class="filter-link" data-option="driver">
                            <span>Dengan Supir</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="filter-card">
                <h3 class="filter-title">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Lokasi</span>
                </h3>
                <div style="margin-bottom: 1rem;">
                    <input type="text" placeholder="Masukkan lokasi" class="search-input" id="locationInput" style="width: 100%;">
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <button class="btn btn-outline" id="currentLocation" style="flex: 1;">Lokasi Saat Ini</button>
                    <button class="btn btn-primary" id="applyLocation" style="flex: 1;">Terapkan</button>
                </div>
            </div>
        </aside>
        
        <!-- Grid Produk -->
        <div class="product-grid">
            <div class="product-row">
                <!-- Kartu Produk 1 -->

  <a href="index.php?page=detail" style="text-decoration: none; color: inherit;">
    <div class="product-card" data-category="jeep">
        <span class="product-badge tersedia">Tersedia</span>
      <div class="product-media">
        <img src="gambar/hu.jpg" alt="Sewa Jeep" class="product-image">
        <button class="product-wishlist">
          <i class="far fa-heart"></i>
        </button>
      </div>
      <div class="product-info">
        <h3 class="product-title">Jeep Wrangler</h3>
        <div class="product-location">
          <i class="fas fa-map-marker-alt"></i>
          <span>Malang, Jawa Timur</span>
        </div>
        <div class="product-price">
          Rp800.000 <span>/ hari</span>
        </div>
        <div class="product-footer">
          <div class="product-rating">
            <i class="fas fa-star"></i>
            <span>4.8 (128 ulasan)</span>
          </div>
        </div>
      </div>
    </div>
  </a>

  <a href="index.php?page=detail1" style="text-decoration: none; color: inherit;">
    <div class="product-card" data-category="jeep">
        <span class="product-badge kosong">Kosong</span>
      <div class="product-media">
        <img src="gambar/fj4.jpg" alt="Sewa Jeep" class="product-image">
        <button class="product-wishlist">
          <i class="far fa-heart"></i>
        </button>
      </div>
      <div class="product-info">
        <h3 class="product-title">Toyota Land Cruiser FJ40</h3>
        <div class="product-location">
          <i class="fas fa-map-marker-alt"></i>
          <span>Malang, Jawa Timur</span>
        </div>
        <div class="product-price">
          Rp800.000 <span>/ hari</span>
        </div>
        <div class="product-footer">
          <div class="product-rating">
            <i class="fas fa-star"></i>
            <span>4.8 (128 ulasan)</span>
          </div>
        </div>
      </div>
    </div>
  </a>


                
                <!-- Kartu Produk 4 -->
  <a href="index.php?page=detail2" style="text-decoration: none; color: inherit;">
                <div class="product-card" data-category="motor" data-price="250000" data-rating="5.0" data-location="malang">
                    <span class="product-badge kosong">Kosong</span>
                    <div class="product-media">
                        <img src="gambar/0f.jpg" alt="Motor Trail" class="product-image">
                        <button class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Honda CRF 250F</h3>
                        <div class="product-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Malang, Jawa Timur</span>
                        </div>
                        <div class="product-price">
                            Rp250.000 <span>/ hari</span>
                        </div>
                        <div class="product-footer">
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <span>5.0 (89 ulasan)</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                
                <!-- Kartu Produk 5 -->
  <a href="index.php?page=detail3" style="text-decoration: none; color: inherit;">
                <div class="product-card" data-category="motor" data-price="220000" data-rating="4.7" data-location="batu">
        <span class="product-badge tersedia">Tersedia</span>
                    <div class="product-media">
                        <img src="gambar/yamaha.jpg" alt="Motor Trail" class="product-image">
                        <button class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Yamaha WR 155cc</h3>
                        <div class="product-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Batu, Jawa Timur</span>
                        </div>
                        <div class="product-price">
                            Rp220.000 <span>/ hari</span>
                        </div>
                        <div class="product-footer">
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <span>4.7 (56 ulasan)</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
        
        </div>

        <div class="pagination" sry>
                    <a href="#" class="page-link">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" class="page-link active">1</a>
                    <a href="#" class="page-link">2</a>
                    <a href="#" class="page-link">3</a>
                    <a href="#" class="page-link">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
    </main>

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