<?php
require_once __DIR__ . '/../vendor/autoload.php'; // arahkan ke vendor

// Konfigurasi Midtrans
require_once 'config.php'; // Gunakan konfigurasi dari config.php

// Buat detail transaksi
$params = [
    'transaction_details' => [
        'order_id' => 'ORDER-' . time(),
        'gross_amount' => 150000, // nominal pembayaran
    ],
    'customer_details' => [
        'first_name' => "Budi",
        'last_name' => "Santoso",
        'email' => "budi@example.com",
        'phone' => "081234567890",
    ],
];

// Dapatkan Snap Token
try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Jeep Wrangler 4x4</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Include Midtrans Snap -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-gnoFJ4rU72pmn1J5">
    </script>
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
                    <img src="gambar/hu.jpg" alt="Jeep Wrangler 4x4">
                </div>
                <div class="thumbnail-container">
                    <div class="thumbnail active">
                        <img src="gambar/hu.jpg" alt="Thumbnail 1">
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
                <span class="product-badge badge-primary">Populer</span>
                <h1 class="product-title">Jeep Wrangler </h1>
                
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
                    <p>Jeep Wrangler 4x4 dengan kondisi prima, siap menemani petualangan offroad Anda. Dilengkapi dengan fitur keselamatan lengkap dan performa mesin yang tangguh untuk medan berat. Kapasitas 4 penumpang dengan kenyamanan maksimal.</p>
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
<button class="btn btn-booking" data-bs-toggle="modal" data-bs-target="#bookingModal">
    <i class="fas fa-calendar-check"></i> Booking Sekarang
</button>


<!-- Premium Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-car-alt me-2"></i>Booking Jeep Bromo Adventure</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Booking Form -->
                    <div class="col-md-7">
                        <form id="jeepBookingForm">
                            <div class="mb-4">
                                <h6 class="section-title-blue mb-3"><i class="fas fa-user-circle me-2"></i>Data Diri</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nama" placeholder=" " required>
                                            <label for="nama">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" placeholder=" " required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="telepon" placeholder=" " required>
                                            <label for="telepon">Nomor WhatsApp</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="section-title-blue mb-3"><i class="fas fa-calendar-alt me-2"></i>Detail Penyewaan</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="tanggal" required>
                                            <label for="tanggal">Tanggal Sewa</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="durasi" required>
                                                <option value="1">1 Hari</option>
                                                <option value="2">2 Hari</option>
                                                <option value="3">3 Hari</option>
                                            </select>
                                            <label for="durasi">Durasi Sewa</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="jumlah" min="1" value="1" required>
                                            <label for="jumlah">Jumlah Jeep</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h6 class="section-title-blue mb-3"><i class="fas fa-plus-circle me-2"></i>Tambahan Perlengkapan</h6>
                                <div class="equipment-grid">
                                    <div class="equipment-item" data-price="50000">
                                        <input type="checkbox" id="jaket" class="equipment-check">
                                        <label for="jaket">
                                            <div class="equipment-icon"><i class="fas fa-tshirt"></i></div>
                                            <span>Jaket Tebal</span>
                                            <small>+Rp 50.000</small>
                                        </label>
                                    </div>
                                    <div class="equipment-item" data-price="25000">
                                        <input type="checkbox" id="sarungTangan" class="equipment-check">
                                        <label for="sarungTangan">
                                            <div class="equipment-icon"><i class="fas fa-hand-paper"></i></div>
                                            <span>Sarung Tangan</span>
                                            <small>+Rp 25.000</small>
                                        </label>
                                    </div>
                                    <div class="equipment-item" data-price="75000">
                                        <input type="checkbox" id="sepatu" class="equipment-check">
                                        <label for="sepatu">
                                            <div class="equipment-icon"><i class="fas fa-shoe-prints"></i></div>
                                            <span>Sepatu Boot</span>
                                            <small>+Rp 75.000</small>
                                        </label>
                                    </div>
                                    <div class="equipment-item" data-price="30000">
                                        <input type="checkbox" id="kacamata" class="equipment-check">
                                        <label for="kacamata">
                                            <div class="equipment-icon"><i class="fas fa-glasses"></i></div>
                                            <span>Kacamata</span>
                                            <small>+Rp 30.000</small>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" id="catatan" placeholder=" " style="height: 100px"></textarea>
                                <label for="catatan">Catatan Tambahan/Permintaan Khusus</label>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Summary -->
                    <div class="col-md-5">
                        <div class="payment-summary">
                            <h6 class="summary-title"><i class="fas fa-receipt me-2"></i>Ringkasan Pembayaran</h6>
                            <div class="summary-details">
                                <div class="summary-item">
                                    <span>Jeep Wrangler (1.700.000/hari)</span>
                                    <span class="summary-value" id="basePrice">Rp 1.700.000</span>
                                </div>
                                <div class="summary-item">
                                    <span>Durasi</span>
                                    <span class="summary-value"><span id="durationDisplay">1</span> Hari</span>
                                </div>
                                <div class="summary-item">
                                    <span>Jumlah Jeep</span>
                                    <span class="summary-value" id="jeepQty">1</span>
                                </div>
                                <div class="summary-item">
                                    <span>Tambahan Perlengkapan</span>
                                    <span class="summary-value" id="equipmentTotal">Rp 0</span>
                                </div>
                            </div>
                            <div class="summary-total">
                                <span>Total Pembayaran</span>
                                <span class="total-amount" id="totalPayment">Rp 1.700.000</span>
                            </div>
                            <div class="payment-note">
                                <i class="fas fa-info-circle me-2"></i>DP 50% diperlukan untuk konfirmasi booking
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
                <button type="button" class="btn btn-primary" id="pay-button">
                    <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script Midtrans -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-gnoFJ4rU72pmn1J5"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = async function() {
        try {
            const button = document.getElementById('pay-button');
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';

            // Ambil nilai dari form
            const tanggalSewa = document.querySelector('input[type="date"]').value;
            const durasiSewa = document.querySelector('select').value;
            const jumlahJeep = document.querySelector('input[type="number"]').value;
            const totalPembayaran = document.getElementById('totalPayment').textContent;
            
            // Validasi input
            if (!tanggalSewa) {
                throw new Error('Mohon pilih tanggal sewa');
            }
            if (!durasiSewa) {
                throw new Error('Mohon pilih durasi sewa');
            }
            if (!jumlahJeep || jumlahJeep < 1) {
                throw new Error('Jumlah jeep tidak valid');
            }
            if (!totalPembayaran) {
                throw new Error('Total pembayaran tidak valid');
            }

        // Prepare data
        const data = {
            tanggal_sewa: tanggalSewa,
            durasi: durasiSewa,
            jumlah_jeep: jumlahJeep,
            total_pembayaran: totalPembayaran
        };

        // Tampilkan loading
        document.getElementById('pay-button').disabled = true;
        document.getElementById('pay-button').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';

            // Kirim request ke get_snap_token.php
            const response = await fetch('get_snap_token.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    tanggal_sewa: tanggalSewa,
                    durasi: durasiSewa,
                    jumlah_jeep: jumlahJeep,
                    total_pembayaran: totalPembayaran
                })
            });

            if (!response.ok) {
                throw new Error(`Error saat memproses pembayaran: ${response.status}`);
            }

            const data = await response.json();
            console.log('Server response:', data);
            
            if (!data.token) {
                throw new Error(data.message || 'Token pembayaran tidak ditemukan');
            }

            // Tampilkan Snap popup
            window.snap.pay(data.token, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    alert('Pembayaran berhasil!');
                    location.reload();
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    alert('Menunggu pembayaran Anda. Silakan selesaikan pembayaran sesuai instruksi.');
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert('Pembayaran gagal: ' + (result.status_message || 'Terjadi kesalahan'));
                },
                onClose: function() {
                    console.log('Customer closed the popup without finishing the payment');
                    if (confirm('Anda yakin ingin membatalkan pembayaran?')) {
                        location.reload();
                    }
                }
            });

        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat memproses pembayaran');
        } finally {
            const button = document.getElementById('pay-button');
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-credit-card me-2"></i>Bayar Sekarang';
        }
    };
</script>
        </div>
    </div>
</div>

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
        <p>Jeep Wrangler adalah ikon kendaraan off-road yang legendaris, menggabungkan kemampuan menjelajah alam liar dengan desain klasik yang tangguh. Dilengkapi mesin bertenaga, sistem 4x4 canggih, dan kabin nyaman, Wrangler siap menemani petualangan di berbagai medan, dari jalanan kota hingga jalur ekstrem pegunungan.</p>
        
        <h3>Fitur Utama</h3>
        <ul class="feature-list">
            <li>Mesin bertenaga dan efisiensi tinggi</li>
            <li>Sistem 4x4 tangguh untuk medan off-road</li>
            <li>Desain ikonik Jeep dengan atap dan pintu bisa dilepas</li>
            <li>Teknologi modern: layar sentuh infotainment, konektivitas smartphone</li>
            <li>Suspensi dan ground clearance tinggi untuk perjalanan ekstrem</li>
        </ul>
        
        <h3>Apa yang Ada di Dalam Kotak</h3>
        <ul class="feature-list">
            <li>Jeep Wrangler 2025 (varian sesuai pilihan)</li>
            <li>Buku panduan pengguna dan manual servis</li>
            <li>Alat darurat standar & kit perawatan kendaraan</li>
            <li>Set kunci cadangan dan remote kontrol</li>
        </ul>
    </div>
</div>

            
            <div class="tab-content" id="specifications">
    <h2 class="section-title">Spesifikasi Teknis</h2>
    <table class="specs-table">
        <tr class="spec-row">
            <td class="spec-name">Model</td>
            <td class="spec-value">Jeep Wrangler Rubicon 2025</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Warna</td>
            <td class="spec-value">Hitam, Putih, Merah, Biru, Hijau Army</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Mesin</td>
            <td class="spec-value">3.6L V6 Pentastar, 285 HP, 260 lb-ft torsi</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Transmisi</td>
            <td class="spec-value">8-speed otomatis / 6-speed manual</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Sistem Penggerak</td>
            <td class="spec-value">4x4 Selec-Trac® II dengan Dana 44® axle</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Suspensi</td>
            <td class="spec-value">Independent front & solid rear, off-road ready</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Ground Clearance</td>
            <td class="spec-value">274 mm (10,8 inci)</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Kapasitas Penumpang</td>
            <td class="spec-value">4–5 orang</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Tangki Bahan Bakar</td>
            <td class="spec-value">71 liter</td>
        </tr>
        <tr class="spec-row">
            <td class="spec-name">Garansi</td>
            <td class="spec-value">3 tahun / 36.000 mil</td>
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
                <div class="reviewer-avatar" style="background-color: #4e73df;">R</div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Rudi Hartono</div>
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
                <p>"Gak nyesel sewa Jeep disini! Mesinnya beneran garang tapi nyaman banget buat diajak off-road. Memang spesial sih rasanya naik mobil keren begini, worth banget pokoknya!"</p>
            </div>
            <div class="review-footer">
                <span class="review-date">1 minggu yang lalu</span>
                <button class="review-action"><i class="far fa-thumbs-up"></i> 32</button>
            </div>
        </div>
        
        <!-- Review 2 -->
        <div class="review-card highlight">
            <div class="review-badge">Favorit</div>
            <div class="review-header">
                <div class="reviewer-avatar" style="background-color: #1cc88a;">D</div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Dian Sastro</div>
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
                <p>"Jeepnya keren abis! Fotonya di Bromo jadi aesthetic banget. Pelayanan ramah dan mobilnya bersih banget. Walaupun agak mahal tapi puas sih, next trip pasti sewa lagi disini!"</p>
            </div>
            <div class="review-footer">
                <span class="review-date">2 minggu yang lalu</span>
                <button class="review-action"><i class="far fa-thumbs-up"></i> 45</button>
            </div>
        </div>
        
        <!-- Review 3 -->
        <div class="review-card">
            <div class="review-header">
                <div class="reviewer-avatar" style="background-color: #f6c23e;">T</div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Tono Wijaya</div>
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
                <p>"Bawa temen-temen road trip pake Jeep ini seru banget! AC dingin, sound system oke, dan yang penting nyaman buat perjalanan jauh. Recommended banget buat yang mau liburan keren!"</p>
            </div>
            <div class="review-footer">
                <span class="review-date">3 hari yang lalu</span>
                <button class="review-action"><i class="far fa-thumbs-up"></i> 12</button>
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
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButton = document.querySelector('.add-to-cart');
    const notification = document.getElementById('notification');
    const counter = document.querySelector('.item-counter'); // untuk update counter

    addToCartButton.addEventListener('click', function() {
        const quantity = parseInt(document.querySelector('.quantity-input').value) || 1;
        const product = {
            id: 'jeep-wrangler-001',
            name: 'Jeep Wrangler 4x4',
            price: 1780000,
            quantity: quantity,
            image: 'gambar/hu.jpg'
        };
        
        // Ambil data keranjang dari localStorage
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const existingItem = cart.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity += product.quantity;
        } else {
            cart.push(product);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        window.dispatchEvent(new Event('storage'));
        
        // ✅ Update counter setelah tambah
        let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        if (counter) {
            counter.textContent = totalItems;
        }

        // ✅ Tampilkan notifikasi dari atas
        notification.classList.add('show');
        
        // Hilangkan notifikasi setelah 3 detik
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    });
});
</script>

<!-- Notification -->
<div class="notification" id="notification">
    <i class="fas fa-check-circle"></i> Produk berhasil ditambahkan ke keranjang!
</div>
<script type="text/javascript">
document.getElementById('pay-button').onclick = function () {
    // Validasi form terlebih dahulu
    const form = document.getElementById('jeepBookingForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Ambil data dari form booking
    const nama = document.getElementById('nama').value;
    const email = document.getElementById('email').value;
    const telepon = document.getElementById('telepon').value;
    const tanggal = document.getElementById('tanggal').value;
    const durasi = document.getElementById('durasi').value;
    const jumlah = document.getElementById('jumlah').value;
    
    // Hitung total amount
    const totalAmount = parseInt(document.getElementById('totalPayment').textContent.replace(/[^\d]/g, ''));
    
    // Siapkan data transaksi
    const transactionData = {
        'transaction_details': {
            'order_id': 'RENTIVA-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9),
            'gross_amount': totalAmount
        },
        'customer_details': {
            'first_name': nama,
            'email': email,
            'phone': telepon,
        },
        'item_details': [{
            'id': 'jeep-wrangler',
            'price': totalAmount,
            'quantity': 1,
            'name': "Sewa Jeep Wrangler 4x4 untuk " + durasi + " hari"
        }],
        'custom_field1': tanggal,
        'custom_field2': 'Jumlah: ' + jumlah + ' unit'
    };
    
    console.log('Data yang dikirim:', transactionData);
    
    // Panggil API untuk mendapatkan snap token
    fetch('get_snap_token.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(transactionData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response dari server:', data);
        
        if (data.token) {
            // Debug token
            console.log('Token from server:', data.token);
            
            // Ensure snap is loaded
            if (typeof window.snap === 'undefined') {
                console.error('Snap is not loaded');
                alert('Error: Payment system not loaded. Please refresh the page.');
                return;
            }

            try {
                // Buka popup Midtrans
                window.snap.pay(data.token, {
                    onSuccess: function(result) {
                        console.log('Payment success:', result);
                        alert('Pembayaran berhasil! ID Transaksi: ' + result.order_id);
                        location.reload();
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);
                        alert('Menunggu pembayaran Anda. Silakan selesaikan pembayaran sesuai instruksi.\nID Transaksi: ' + result.order_id);
                    },
                    onError: function(result) {
                        console.error('Payment error:', result);
                        alert('Pembayaran gagal: ' + (result.status_message || 'Terjadi kesalahan'));
                    },
                    onClose: function() {
                        console.log('Customer closed the popup without finishing payment');
                        if (confirm('Anda yakin ingin membatalkan pembayaran?')) {
                            location.reload();
                        }
                    }
                });
            } catch (e) {
                console.error('Error calling snap.pay:', e);
                alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
            }
        } else if (data.error) {
            console.error('Error dari server:', data.error);
            alert("Error: " + data.error);
        } else {
            console.error('Response tidak valid:', data);
            alert("Terjadi kesalahan tidak terduga");
        }
    })
    .catch(error => {
        console.error('Error fetch:', error);
        alert("Terjadi kesalahan saat menghubungi server: " + error.message);
    });
};
</script>
</body>
</html>