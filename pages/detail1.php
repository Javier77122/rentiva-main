<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Jeep Wrangler 4x4</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
    --primary-blue: #2c7be5;
    --dark-blue: #1a5cb8;
    --light-blue: #e6f0fd;
}
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
.btn-booking {
    background-color: white; /* warna default putih */
    color: var(--primary-blue); /* teks biru */
    border: 2px solid var(--primary-blue); /* garis tepi biru */
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(44, 123, 229, 0.25);
    cursor: pointer;
}

.btn-booking:hover {
    background-color: var(--primary-blue); /* berubah biru */
    color: white; /* teks putih */
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(44, 123, 229, 0.3);
}


.modal-header {
    border-bottom: none;
}

.section-title-blue {
    color: var(--primary-blue);
    font-weight: 600;
    font-size: 16px;
    position: relative;
    padding-left: 8px;
}

.section-title-blue::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    height: 70%;
    width: 3px;
    background-color: var(--primary-blue);
    border-radius: 3px;
}

/* Equipment Grid */
.equipment-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 16px;
}

.equipment-item {
    position: relative;
}

.equipment-item input[type="checkbox"] {
    position: absolute;
    opacity: 0;
}

.equipment-item label {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
}

.equipment-item label:hover {
    border-color: var(--primary-blue);
}

.equipment-item input[type="checkbox"]:checked + label {
    background-color: var(--light-blue);
    border-color: var(--primary-blue);
}

.equipment-icon {
    width: 40px;
    height: 40px;
    background-color: #f0f7ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    color: var(--primary-blue);
}

.equipment-item small {
    color: #666;
    font-size: 12px;
}

/* Payment Summary */
.payment-summary {
    background-color: #f9fbfd;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e0e8f5;
    height: 100%;
}

.summary-title {
    color: var(--primary-blue);
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px dashed #d0e0f8;
}

.summary-details {
    margin-bottom: 20px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 14px;
}

.summary-item span:first-child {
    color: #555;
}

.summary-value {
    font-weight: 500;
    color: #333;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px dashed #d0e0f8;
    font-weight: 600;
}

.total-amount {
    color: var(--primary-blue);
    font-size: 18px;
}

.payment-note {
    margin-top: 20px;
    padding: 10px;
    background-color: #f0f7ff;
    border-radius: 6px;
    font-size: 13px;
    color: var(--dark-blue);
}

/* Floating Labels */
.form-floating label {
    color: #666;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 0.25rem rgba(44, 123, 229, 0.25);
}   
     
        
/* Breadcrumb */
    .breadcrumb-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #eff6ff;
      padding: 20px 40px;
      transition: var(--transition);
      padding-bottom:30px;
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

        /* Product Detail */
    .product-detail {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    background: white;
    border-radius: 12px;
    padding: 20px 130px 0 130px; /* atas, kanan, bawah, kiri */
    margin-bottom: 10px;
}

        .product-gallery {
            flex: 1;
            min-width: 300px;
        }
        
      .main-image {
    width: 100%;
    height: 400px;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    position: relative;
}

.main-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease, transform-origin 0.3s ease;
    will-change: transform;
}

/* Zoom saat hover */
.main-image:hover img {
    transform: scale(1.3);
}

        
        .thumbnail-container {
            display: flex;
            gap: 10px;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 4px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
        }
        
        .thumbnail:hover {
            border-color: #3a86ff;
        }
        
        .thumbnail.active {
            border-color: #3a86ff;
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info {
            flex: 1;
            min-width: 300px;
        }
        
        .product-badge {
            display: inline-block;
            padding: 4px 10px;
            background-color: #3a86ff;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .badge-primary {
            background-color: #3a86ff;
        }
        
        .badge-secondary {
            background-color: #6c757d;
        }
        
        .badge-accent {
            background-color: #ff6b6b;
        }
        
        .product-title {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }
        
        .product-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .product-location i {
            color: #3a86ff;
        }
        
        .product-price {
            font-size: 28px;
            font-weight: bold;
            color: #3a86ff;
            margin-bottom: 20px;
        }
        
        .product-price span {
            font-size: 16px;
            font-weight: normal;
            color: #666;
        }
        
        .product-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .product-rating .stars {
            color: #ffb703;
        }
        
        .product-rating .count {
            color: #666;
            font-size: 14px;
        }
        
        .product-description {
            margin-bottom: 25px;
        }
        
        .product-description h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        
        .product-description p {
            color: #666;
            line-height: 1.6;
        }
        
        .product-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .feature {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
        }
        
        .feature i {
            color: #3a86ff;
            width: 20px;
            text-align: center;
        }
        
        /* Product Actions */
        .product-actions {
            margin-top: 30px;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }
        
        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-left: none;
            border-right: none;
            font-size: 16px;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: #3a86ff;
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background: #2667cc;
        }
    .btn-custom {
    background: #ffffff;
    color: #2667cc;
    border: 2px solid #1e40af;  /* border biru */
    border-radius: 8px;          /* bulatan tombol */
    padding: 10px 20px;
    margin-left:10px;
    font-weight: bold;
    font-size: 16px;
    transition: 0.3s;
}

.btn-custom i {
    margin-right: 8px;
}

.btn-custom:hover {
    background: #1e40af;
    color: white;
}

        
        .btn-outline {
            background: white;
            border: 1px solid #ddd;
            color: #555;
            margin-left: 10px;
        }
        
        .btn-outline:hover {
            border-color: #3a86ff;
            color: #3a86ff;
        }
        
        /* Reviews Section */
        .review-form-container {
    margin-top: 50px;
    padding: 35px;
    background-color: white; /* warna background jadi putih */
    border-radius: 10px;
    border: 1px solid #eee;
}

.review-form-title {
    font-size: 24px;
    margin-bottom: 15px; /* dikurangi supaya form-nya lebih dekat */
    color: #333;
    position: relative;
    padding-bottom: 10px;
}

.review-form-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: #0066cc;
}

.review-form {
    margin-top: 10px; /* kasih jarak kecil dari judul */
}

.form-group {
    margin-bottom: 25px;
}

.form-row {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
}

.half-width {
    flex: 1;
}

.form-label {
    display: block;
    font-size: 18px;
    margin-bottom: 12px;
    font-weight: 600;
    color: #555;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 16px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: white;
    transition: border-color 0.3s;
}

.form-input:focus, .form-textarea:focus {
    border-color: #0066cc;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

.form-textarea {
    min-height: 180px;
    resize: vertical;
}

.rating-group {
    margin-bottom: 30px;
}

.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    font-size: 0;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 36px;
    color: #ccc;
    padding: 0 8px;
    cursor: pointer;
    transition: color 0.2s;
}

.star-rating input:checked ~ label,
.star-rating input:hover ~ label {
    color: #ffc107;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #ffc107;
}

.submit-review-btn {
    background-color: #0066cc;
    color: white;
    border: none;
    padding: 16px;
    font-size: 18px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s;
    width: 100%; /* Biar full memanjang */
    display: block;
    margin-top: 30px;
}


.submit-review-btn:hover {
    background-color: #0055aa;
    transform: translateY(-2px);
}

         .product-container {
            max-width: 1300px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
        }
        
        .product-tabs {
            margin-top: 20px;
        }
        
        .tab-headers {
            display: flex;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 30px;
        }
        
        .tab-header {
            padding: 15px 30px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            color: #666;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .tab-header:hover {
            color: #0066cc;
        }
        
        .tab-header.active {
            color: #0066cc;
        }
        
        .tab-header.active:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #0066cc;
        }
        
      
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .tab-content.active {
            display: block;
        }
        
     .tab-content {
    display: none;
    padding: 0 10px;
    animation: fadeIn 0.5s ease;
    background-color: white; /* background putih */
    border-radius: 8px;       /* opsional: biar tampak rapi */
}

        
        .section-title {
            font-size: 24px;
            margin-bottom: 25px;
            color: #222;
            position: relative;
            padding-bottom: 10px;
        }
        
     
        
        /* Styles for Description Tab */
        .product-description p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.8;
        }
        
        .feature-list {
            margin: 25px 0;
            padding-left: 20px;
        }
        
        .feature-list li {
            margin-bottom: 12px;
            font-size: 16px;
            position: relative;
            padding-left: 25px;
        }
        
        .feature-list li:before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: #0066cc;
            position: absolute;
            left: 0;
            top: 2px;
        }
        
        /* Styles for Specifications Tab */
        .specs-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .spec-row {
            border-bottom: 1px solid #eee;
        }
        
        .spec-name {
            width: 30%;
            padding: 15px 0;
            font-weight: 600;
            color: #555;
            vertical-align: top;
        }
        
        .spec-value {
            padding: 15px 0 15px 20px;
        }
        
        /* Styles for Reviews Tab */
        .review-summary {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            padding: 25px;
            background-color: #f9f9f9;
            border-radius: 10px;
            border: 1px solid #eee;
        }
        
        .average-rating {
            text-align: center;
            margin-right: 50px;
            min-width: 140px;
        }
        
        .score {
            font-size: 42px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        
        .stars {
            color: #ffc107;
            margin-bottom: 8px;
            font-size: 18px;
        }
        
        .count {
            color: #666;
            font-size: 16px;
        }
        
        .rating-bars {
            flex-grow: 1;
        }
        
        .rating-bar {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .rating-bar .stars {
            width: 100px;
            font-size: 16px;
            color: #666;
            margin: 0;
        }
        
        .bar-container {
            flex-grow: 1;
            height: 12px;
            background-color: #eee;
            border-radius: 6px;
            margin: 0 15px;
        }
        
        .bar {
            height: 100%;
            background-color: #ffc107;
            border-radius: 6px;
        }
        
        .percentage {
            width: 50px;
            font-size: 16px;
            color: #666;
        }
 .review-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: 'Segoe UI', sans-serif;
}

.section-title {
    text-align: center;
    font-size: 2.2rem;
    color: #2d3748;
    margin-bottom: 10px;
}

.section-subtitle {
    text-align: center;
    color: #718096;
    margin-bottom: 40px;
    font-size: 1.1rem;
}

.review-list-horizontal {
    display: flex;
    gap: 25px;
    overflow-x: auto;
    padding: 20px 0;
    scrollbar-width: none; /* For Firefox */
}

.review-list-horizontal::-webkit-scrollbar {
    display: none; /* For Chrome/Safari */
}

.review-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    min-width: 320px;
    flex: 1;
    transition: all 0.3s ease;
    position: relative;
    border: 1px solid #f0f0f0;
}

.review-card.highlight {
    border: 1px solid #4e73df;
    box-shadow: 0 5px 25px rgba(78, 115, 223, 0.15);
}

.review-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.review-badge {
    position: absolute;
    top: -12px;
    right: 20px;
    background: #4e73df;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    box-shadow: 0 3px 10px rgba(78, 115, 223, 0.3);
}

.review-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.reviewer-avatar {
    width: 50px;
    height: 50px;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-weight: bold;
    font-size: 20px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.reviewer-info {
    flex-grow: 1;
}

.reviewer-name {
    font-weight: 700;
    margin-bottom: 5px;
    font-size: 16px;
    color: #2d3748;
}

.review-rating {
    color: #ffc107;
    font-size: 14px;
}

.review-content {
    margin-bottom: 20px;
}

.review-content p {
    line-height: 1.6;
    font-size: 15px;
    color: #4a5568;
    font-style: italic;
    margin: 0;
}

.review-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid #edf2f7;
}

.review-date {
    color: #718096;
    font-size: 13px;
}

.review-action {
    background: none;
    border: none;
    color: #718096;
    font-size: 13px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 15px;
    transition: all 0.2s;
}

.review-action:hover {
    background: #f8f9fa;
    color: #4e73df;
}

.review-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

.control-btn {
    background: white;
    border: 1px solid #e2e8f0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #4a5568;
    transition: all 0.2s;
}

.control-btn:hover {
    background: #4e73df;
    color: white;
    border-color: #4e73df;
}

.pagination-dots {
    display: flex;
    gap: 10px;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #e2e8f0;
    cursor: pointer;
}

.dot.active {
    background: #4e73df;
}


     .view-all-reviews {
    display: inline-block;
    padding: 12px 25px;
    background-color: #ffffff;        /* background putih */
    color: #0066cc;                   /* teks biru */
    border: 2px solid #0066cc;        /* garis tepi biru */
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    font-size: 16px;
    transition: all 0.3s;
    margin: 20px auto 0;              /* atas 20px, tengah (auto) */
}

.view-all-reviews:hover {
    background-color: #0066cc;        /* pas hover jadi biru */
    color: white;                     /* teks jadi putih */
}

/* Buat wrapper untuk tombol supaya bisa center */
.view-all-wrapper {
    display: flex;
    justify-content: center;
}

        /* Review Form Styles */
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .product-container {
                padding: 20px;
            }
            
            .tab-header {
                padding: 12px 15px;
                font-size: 16px;
            }
            
            .review-summary {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .average-rating {
                margin-right: 0;
                margin-bottom: 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .half-width {
                width: 100%;
            }
            
            .reviewer-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .reviewer-name {
                font-size: 16px;
            }
            
            .star-rating label {
                font-size: 28px;
                padding: 0 5px;
            }
        }
        /* Responsive Design */
@media (max-width: 1024px) {
    .review-card {
        min-width: 280px;
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 1.8rem;
    }
    
    .review-list-horizontal {
        gap: 15px;
    }
    
    .review-card {
        min-width: 260px;
        padding: 20px;
    }
}
    </style>
</head>
<body>

 <div class="breadcrumb-nav" data-aos="fade-down" data-aos-duration="500">
    <div class="breadcrumb-title"> Detail Produk</div>
    <div class="breadcrumb-links">
      <a href="#"> Beranda</a>
      <span>/</span>
      <a href="#"> Detail Produk</a>
    </div>
  </div>
        
        <!-- Product Detail Section -->
        <div class="product-detail" style="padding-top:50px;">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="gambar/fj4.jpg" alt="Jeep Wrangler 4x4">
                </div>
                <div class="thumbnail-container">
                    <div class="thumbnail active">
                        <img src="gambar/fj4.jpg" alt="Thumbnail 1">
                    </div>
                    <div class="thumbnail">
                        <img src="gambar/jw1.jpg" alt="Thumbnail 2">
                    </div>
                    <div class="thumbnail">
                        <img src="gambar/jw2.jpg" alt="Thumbnail 3">
                    </div>
                </div>
            </div>
            
            <div class="product-info">
                <h1 class="product-title">Toyota Land Cruiser FJ40</h1>
                
                <div class="product-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Malang, Jawa Timur</span>
                </div>
                
                <div class="product-price">
                    Rp1.780.000 <span>/ hari</span>
                </div>
                
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="count">4.8 (128 ulasan)</span>
                </div>
                
              <div class="product-description">
    <h3>Deskripsi</h3>
    <p>Toyota Land Cruiser FJ40 legendaris, kendaraan off-road klasik yang tahan banting. Didesain untuk medan berat dengan mesin tangguh dan suspensi handal. Kapasitas 4 penumpang, kabin sederhana namun nyaman, siap menemani petualangan ekstrem dan perjalanan di alam bebas.</p>
</div>

                
                <div class="product-features">
                    <div class="feature">
                        <i class="fas fa-car"></i>
                        <span>Tahun: 2020</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-cogs"></i>
                        <span>Transmisi: Manual</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-gas-pump"></i>
                        <span>Bahan Bakar: Bensin</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-users"></i>
                        <span>Kapasitas: 4 orang</span>
                    </div>
                </div>
                
                <div class="product-actions">
                    <div class="quantity-selector">
                        <button class="quantity-btn minus"><i class="fas fa-minus"></i></button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="quantity-btn plus"><i class="fas fa-plus"></i></button>
                    </div>
                    
                    <button class="btn btn-primary add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                    </button>
<!-- Blue Themed Booking Button -->
<button class="btn btn-booking" data-bs-toggle="modal" data-bs-target="#soldOutModal">
    <i class="fas fa-calendar-check"></i> Booking Sekarang
</button>


<!-- Sold Out Modal -->
<div class="modal fade" id="soldOutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Main Content -->
            <div class="modal-body px-4 pb-4 pt-0 text-center" id="mainContent">
                <!-- Icon -->
                <div class="status-icon mb-4">
                    <i class="fas fa-calendar-times"></i>
                </div>
                
                <!-- Main Message -->
                <h5 class="fw-semibold mb-3">Jeep Bromo Tidak Tersedia</h5>
                <p class="text-muted mb-4">Maaf, semua unit untuk tanggal yang Anda pilih sudah terbooking penuh.</p>
                
                <!-- Divider -->
                <hr class="mx-auto my-4" style="width: 80px; opacity: 0.2;">
                
                <!-- Action Buttons -->
                <div class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-outline-dark px-4" id="searchOtherDates">
                        Cari Tanggal Lain
                    </button>
                    <a href="https://wa.me/6281234567890" class="btn btn-dark px-4">
                        Hubungi Kami
                    </a>
                </div>
            </div>
            
            <!-- Date Selection Content (Hidden Initially) -->
            <div class="modal-body px-4 pb-4 pt-0 text-center" id="dateSelectionContent" style="display: none;">
                <div class="status-icon mb-4">
                    <i class="fas fa-calendar-alt text-primary"></i>
                </div>
                
                <h5 class="fw-semibold mb-3">Pilih Tanggal Lain</h5>
                
                <!-- Date Picker -->
                <div class="date-picker mb-4">
                    <input type="date" class="form-control" id="alternateDate" min="">
                </div>
                
                <!-- Available Dates -->
                <div class="available-dates mb-4">
                    <p class="small text-muted mb-2">Tanggal tersedia:</p>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <button class="btn btn-sm btn-outline-success date-option">15 Juni</button>
                        <button class="btn btn-sm btn-outline-success date-option">17 Juni</button>
                        <button class="btn btn-sm btn-outline-success date-option">20 Juni</button>
                        <button class="btn btn-sm btn-outline-success date-option">22 Juni</button>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-outline-secondary px-4" id="backButton">
                        Kembali
                    </button>
                    <button class="btn btn-primary px-4" id="checkAvailability">
                        Cek Ketersediaan
                    </button>
                </div>
            </div>
            
            <!-- Footer Note -->
            <div class="modal-footer border-0 justify-content-center pt-0">
                <small class="text-muted">Stok diperbarui setiap hari pukul 08.00 WIB</small>
            </div>
        </div>
    </div>
</div>

<style>
/* Clean Modern Styles */
.modal-content {
    border-radius: 12px;
    overflow: hidden;
}

.status-icon {
    font-size: 3.5rem;
    color: #dc3545;
    margin: 0 auto;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.status-icon .text-primary {
    color: #0d6efd !important;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
    padding: 8px 16px;
}

.btn-outline-dark {
    border: 1px solid #dee2e6;
}

.btn-outline-dark:hover {
    background-color: #f8f9fa;
}

.btn-dark {
    background-color: #212529;
    border: 1px solid #212529;
}

.btn-dark:hover {
    background-color: #424649;
}

.date-picker input {
    border-radius: 8px;
    padding: 10px;
    border: 1px solid #dee2e6;
    text-align: center;
}

.date-option {
    border-radius: 20px;
    padding: 5px 15px;
}

/* Animation */
.fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set min date to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    document.getElementById('alternateDate').min = tomorrow.toISOString().split('T')[0];
    
    // Toggle between main content and date selection
    document.getElementById('searchOtherDates').addEventListener('click', function() {
        document.getElementById('mainContent').style.display = 'none';
        const dateContent = document.getElementById('dateSelectionContent');
        dateContent.style.display = 'block';
        dateContent.classList.add('fade-in');
    });
    
    document.getElementById('backButton').addEventListener('click', function() {
        document.getElementById('dateSelectionContent').style.display = 'none';
        document.getElementById('mainContent').style.display = 'block';
    });
    
    // Date selection functionality
    document.querySelectorAll('.date-option').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.date-option').forEach(btn => {
                btn.classList.remove('btn-success', 'btn-outline-success');
                btn.classList.add('btn-outline-success');
            });
            
            // Add active class to clicked button
            this.classList.remove('btn-outline-success');
            this.classList.add('btn-success');
            
            // Here you would typically update the date picker value
            // and/or check availability for the selected date
        });
    });
    
    // Check availability button
    document.getElementById('checkAvailability').addEventListener('click', function() {
        const selectedDate = document.getElementById('alternateDate').value;
        if(selectedDate) {
            alert('Memeriksa ketersediaan untuk tanggal: ' + selectedDate);
            // Here you would typically make an AJAX call to check availability
            // and then proceed with booking if available
        } else {
            alert('Silakan pilih tanggal terlebih dahulu');
        }
    });
    
    // Animation when modal appears
    document.getElementById('soldOutModal').addEventListener('shown.bs.modal', function () {
        const icon = document.querySelector('.status-icon i');
        icon.style.transform = 'scale(1.1)';
        setTimeout(() => {
            icon.style.transform = 'scale(1)';
        }, 300);
    });
});
</script>
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->

    <div class="product-container">
        <div class="product-tabs">
            <div class="tab-headers">
                <button class="tab-header active" data-tab="description">Deskripsi</button>
                <button class="tab-header" data-tab="specifications">Spesifikasi</button>
                <button class="tab-header" data-tab="reviews">Ulasan (42)</button>
            </div>
            
         <div class="tab-content active" id="description">
    <div class="product-description">
    <h2 class="section-title">Deskripsi Produk</h2>
    <p>Toyota Land Cruiser FJ40 adalah kendaraan off-road legendaris dengan desain klasik yang tangguh dan performa handal. Dikenal karena ketahanan mesinnya, suspensi kuat, dan kemampuan menjelajah medan berat. Kabin sederhana namun nyaman, FJ40 siap menemani petualangan di hutan, pegunungan, atau jalur ekstrem lainnya.</p>
    
    <h3>Fitur Utama</h3>
    <ul class="feature-list">
        <li>Mesin inline-6 bertenaga dan tahan lama</li>
        <li>Sistem penggerak 4x4 dengan diferensial kuat</li>
        <li>Desain klasik ikonik, atap dan pintu bisa dilepas (opsional)</li>
        <li>Suspensi dan ground clearance tinggi untuk medan ekstrem</li>
        <li>Kabin sederhana namun fungsional untuk 4 penumpang</li>
    </ul>
    
    <h3>Apa yang Ada di Dalam Kotak</h3>
    <ul class="feature-list">
        <li>Toyota Land Cruiser FJ40 (varian sesuai pilihan)</li>
        <li>Buku panduan pengguna dan manual servis</li>
        <li>Peralatan darurat standar & kit perawatan kendaraan</li>
        <li>Set kunci cadangan dan remote kontrol</li>
    </ul>
</div>

</div>

            
            <div class="tab-content" id="specifications">
    <h2 class="section-title">Spesifikasi Teknis</h2>
  <table class="specs-table">
    <tr class="spec-row">
        <td class="spec-name">Model</td>
        <td class="spec-value">Toyota Land Cruiser FJ40 1980–1984</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Warna</td>
        <td class="spec-value">Putih, Hijau, Merah, Biru, Kuning</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Mesin</td>
        <td class="spec-value">4.2L inline-6, sekitar 135 HP, torsi 230 Nm</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Transmisi</td>
        <td class="spec-value">4-speed manual</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Sistem Penggerak</td>
        <td class="spec-value">4x4 full-time / part-time, diferensial kuat</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Suspensi</td>
        <td class="spec-value">Leaf spring, off-road ready</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Ground Clearance</td>
        <td class="spec-value">235 mm</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Kapasitas Penumpang</td>
        <td class="spec-value">4 orang</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Tangki Bahan Bakar</td>
        <td class="spec-value">76 liter</td>
    </tr>
    <tr class="spec-row">
        <td class="spec-name">Garansi</td>
        <td class="spec-value">Tidak ada (kendaraan klasik)</td>
    </tr>
</table>

</div>

            
            <div class="tab-content" id="reviews">
                <h2 class="section-title">Ulasan Pelanggan</h2>
                
                <div class="review-summary">
                    <div class="average-rating">
                        <span class="score">4.8</span>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="count">42 ulasan</span>
                    </div>
                    
                    <div class="rating-bars">
                        <div class="rating-bar">
                            <div class="stars">5 bintang</div>
                            <div class="bar-container">
                                <div class="bar" style="width: 75%"></div>
                            </div>
                            <div class="percentage">75%</div>
                        </div>
                        <div class="rating-bar">
                            <div class="stars">4 bintang</div>
                            <div class="bar-container">
                                <div class="bar" style="width: 15%"></div>
                            </div>
                            <div class="percentage">15%</div>
                        </div>
                        <div class="rating-bar">
                            <div class="stars">3 bintang</div>
                            <div class="bar-container">
                                <div class="bar" style="width: 7%"></div>
                            </div>
                            <div class="percentage">7%</div>
                        </div>
                        <div class="rating-bar">
                            <div class="stars">2 bintang</div>
                            <div class="bar-container">
                                <div class="bar" style="width: 2%"></div>
                            </div>
                            <div class="percentage">2%</div>
                        </div>
                        <div class="rating-bar">
                            <div class="stars">1 bintang</div>
                            <div class="bar-container">
                                <div class="bar" style="width: 1%"></div>
                            </div>
                            <div class="percentage">1%</div>
                        </div>
                    </div>
                </div>
              
                <div class="review-form-container">
    <h2 class="review-form-title">Tulis Ulasan</h2>

    <form class="review-form">
        <div class="form-group rating-group">
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star1" name="rating" value="1">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half-width">
                <input type="text" id="name" class="form-input" placeholder="Masukkan nama Anda">
            </div>
            <div class="form-group half-width">
                <input type="email" id="email" class="form-input" placeholder="Masukkan email Anda">
            </div>
        </div>
        
        <div class="form-group">
            <input type="text" id="title" class="form-input" placeholder="Berikan judul untuk ulasan Anda">
        </div>
        
        <div class="form-group">
            <textarea id="review" class="form-textarea" placeholder="Ceritakan pendapat Anda tentang produk ini. Jujur dan bermanfaat!"></textarea>
        </div>
        
        <button type="submit" class="submit-review-btn">Kirim Ulasan</button>
    </form>
</div>

              
<div class="review-container">
    <h2 class="section-title">Testimoni Penyewa Jeep Wrangler</h2>
    <p class="section-subtitle">Cerita seru dari mereka yang sudah merasakan pengalaman naik Jeep</p>
    
<div class="review-list-horizontal">
    <!-- Review 1 -->
    <div class="review-card">
        <div class="review-header">
            <div class="reviewer-avatar" style="background-color: #4e73df;">A</div>
            <div class="reviewer-info">
                <div class="reviewer-name">Agus Santoso</div>
                <div class="review-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
        <div class="review-content">
            <p>"FJ40 klasik ini luar biasa! Mesin kuat, kabin nyaman, dan tampilannya tetap ikonik. Membawa nostalgia sekaligus pengalaman off-road yang menantang."</p>
        </div>
        <div class="review-footer">
            <span class="review-date">1 minggu yang lalu</span>
            <button class="review-action"><i class="far fa-thumbs-up"></i> 28</button>
        </div>
    </div>
    
    <!-- Review 2 -->
    <div class="review-card highlight">
        <div class="review-badge">Favorit</div>
        <div class="review-header">
            <div class="reviewer-avatar" style="background-color: #1cc88a;">R</div>
            <div class="reviewer-info">
                <div class="reviewer-name">Rina Setiawati</div>
                <div class="review-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
        <div class="review-content">
            <p>"Land Cruiser FJ40 ini keren banget! Cocok buat off-road dan perjalanan jauh. Desain klasiknya bikin foto-foto jadi aesthetic, plus mobilnya sangat reliable."</p>
        </div>
        <div class="review-footer">
            <span class="review-date">2 minggu yang lalu</span>
            <button class="review-action"><i class="far fa-thumbs-up"></i> 40</button>
        </div>
    </div>
    
    <!-- Review 3 -->
    <div class="review-card">
        <div class="review-header">
            <div class="reviewer-avatar" style="background-color: #f6c23e;">T</div>
            <div class="reviewer-info">
                <div class="reviewer-name">Teguh Wijaya</div>
                <div class="review-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
        <div class="review-content">
            <p>"Perjalanan road trip dengan FJ40 ini sangat menyenangkan! Mobil stabil, nyaman, dan mesin handal di medan berat. Sangat direkomendasikan untuk pecinta kendaraan klasik."</p>
        </div>
        <div class="review-footer">
            <span class="review-date">3 hari yang lalu</span>
            <button class="review-action"><i class="far fa-thumbs-up"></i> 15</button>
        </div>
    </div>
</div>

    <div class="review-controls">
        <button class="control-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
        <div class="pagination-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        <button class="control-btn next-btn"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>
              <div class="view-all-wrapper">
    <a href="#" class="view-all-reviews">Lihat Semua Ulasan</a>
</div>

                
                <!-- Review Form -->
               
            </div>
        </div>
    </div>


</div>
    </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabHeaders = document.querySelectorAll('.tab-header');
            
            tabHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    // Remove active class from all headers and contents
                    document.querySelectorAll('.tab-header').forEach(h => h.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked header
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // Star rating functionality
            const stars = document.querySelectorAll('.star-rating label');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.previousElementSibling.value;
                    console.log('Rating diberikan:', rating);
                    // Anda bisa menambahkan logika untuk menyimpan rating di sini
                });
            });
            
            // Form submission handling
            const reviewForm = document.querySelector('.review-form');
            if (reviewForm) {
                reviewForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Terima kasih atas ulasan Anda!');
                    // Anda bisa menambahkan AJAX request di sini untuk mengirim data ke server
                });
            }
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const tabHeaders = document.querySelectorAll('.tab-header');
    
    tabHeaders.forEach(header => {
        header.addEventListener('click', function() {
            // Remove active class from all headers and contents
            document.querySelectorAll('.tab-header').forEach(h => h.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked header
            this.classList.add('active');
            
            // Show corresponding content
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
});
</script>

    <script>
        // JavaScript untuk interaksi halaman
        document.addEventListener('DOMContentLoaded', function() {
            // Thumbnail click handler
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    // Remove active class from all thumbnails
                    thumbnails.forEach(t => t.classList.remove('active'));
                    
                    // Add active class to clicked thumbnail
                    this.classList.add('active');
                    
                    // Update main image
                    const newImage = this.querySelector('img').src;
                    document.querySelector('.main-image img').src = newImage;
                });
            });
            
            // Quantity buttons
            const minusBtn = document.querySelector('.quantity-btn.minus');
            const plusBtn = document.querySelector('.quantity-btn.plus');
            const quantityInput = document.querySelector('.quantity-input');
            
            minusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });
            
            plusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                quantityInput.value = value + 1;
            });
            
            // Wishlist button
            const wishlistBtn = document.querySelector('.wishlist-btn');
            wishlistBtn.addEventListener('click', function() {
                this.classList.toggle('active');
                const icon = this.querySelector('i');
                icon.classList.toggle('far');
                icon.classList.toggle('fas');
                
                if (this.classList.contains('active')) {
                    this.innerHTML = '<i class="fas fa-heart"></i> Wishlisted';
                } else {
                    this.innerHTML = '<i class="far fa-heart"></i> Wishlist';
                }
            });
        });
    </script>
    <script>
const container = document.querySelector('.main-image');
const img = container.querySelector('img');

container.addEventListener('mousemove', function(e) {
  const rect = container.getBoundingClientRect();
  const x = ((e.clientX - rect.left) / rect.width) * 100;
  const y = ((e.clientY - rect.top) / rect.height) * 100;

  img.style.transformOrigin = `${x}% ${y}%`;
  img.style.transform = 'scale(3)';
});

container.addEventListener('mouseleave', function() {
  img.style.transform = 'scale(1)';
  img.style.transformOrigin = 'center center';
});
</script>
<script>
// Price Calculation
const basePricePerDay = 1700000;
let totalPayment = basePricePerDay;

// DOM Elements
const durationSelect = document.getElementById('durasi');
const jumlahJeep = document.getElementById('jumlah');
const equipmentCheckboxes = document.querySelectorAll('.equipment-check');
const basePriceElement = document.getElementById('basePrice');
const durationDisplay = document.getElementById('durationDisplay');
const jeepQtyElement = document.getElementById('jeepQty');
const equipmentTotalElement = document.getElementById('equipmentTotal');
const totalPaymentElement = document.getElementById('totalPayment');

// Update payment summary
function updatePaymentSummary() {
    const duration = parseInt(durationSelect.value);
    const quantity = parseInt(jumlahJeep.value) || 1;
    
    // Calculate equipment total
    let equipmentTotal = 0;
    equipmentCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const price = parseInt(checkbox.parentElement.dataset.price);
            equipmentTotal += price;
        }
    });
    
    // Calculate total
    totalPayment = (basePricePerDay * duration * quantity) + equipmentTotal;
    
    // Update display
    durationDisplay.textContent = duration;
    jeepQtyElement.textContent = quantity;
    equipmentTotalElement.textContent = `Rp ${equipmentTotal.toLocaleString('id-ID')}`;
    totalPaymentElement.textContent = `Rp ${totalPayment.toLocaleString('id-ID')}`;
}

// Event listeners
durationSelect.addEventListener('change', updatePaymentSummary);
jumlahJeep.addEventListener('input', updatePaymentSummary);
equipmentCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updatePaymentSummary);
});

// Form submission
document.getElementById('submitBooking').addEventListener('click', function() {
    const form = document.getElementById('jeepBookingForm');
    if (form.checkValidity()) {
        // Prepare booking data
        const bookingData = {
            name: document.getElementById('nama').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('telepon').value,
            date: document.getElementById('tanggal').value,
            duration: durationSelect.value,
            quantity: jumlahJeep.value,
            equipment: Array.from(equipmentCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.id),
            notes: document.getElementById('catatan').value,
            totalPayment: totalPayment
        };
        
        console.log('Booking Data:', bookingData);
        
        // Show success message
        alert(`Booking berhasil! Total pembayaran: Rp ${totalPayment.toLocaleString('id-ID')}\nKami akan mengirim detail pembayaran ke WhatsApp Anda.`);
        
        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('bookingModal')).hide();
    } else {
        form.reportValidity();
    }
});

// Initialize with current values
updatePaymentSummary();
</script>
<script>
document.getElementById('waitingListForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Here you would typically send the form data to your server
    alert('Terima kasih! Anda telah terdaftar di waiting list. Kami akan menghubungi Anda ketika ada ketersediaan.');
    var modal = bootstrap.Modal.getInstance(document.getElementById('soldOutModal'));
    modal.hide();
});
</script>
</body>
</html>