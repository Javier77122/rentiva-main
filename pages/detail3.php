<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Jeep Wrangler 4x4</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
     
        
        /* Breadcrumb */
        .breadcrumb {
            padding: 20px 0;
            font-size: 14px;
            color: #666;
        }
        
        .breadcrumb a {
            color: #3a86ff;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .breadcrumb a:hover {
            color: #2667cc;
        }
        
        .breadcrumb span {
            color: #999;
        }
        
        /* Product Detail */
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 40px;
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
        }
        
        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
        .reviews-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 22px;
            margin-bottom: 20px;
            color: #333;
        }
        
        .review-summary {
            display: flex;
            gap: 40px;
            margin-bottom: 30px;
            align-items: center;
        }
        
        .average-rating {
            text-align: center;
            min-width: 120px;
        }
        
        .average-rating .score {
            font-size: 42px;
            font-weight: bold;
            display: block;
            line-height: 1;
            margin-bottom: 5px;
        }
        
        .average-rating .stars {
            color: #ffb703;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .average-rating .count {
            color: #666;
            font-size: 14px;
        }
        
        .rating-bars {
            flex: 1;
        }
        
        .rating-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        
        .rating-bar .stars {
            width: 80px;
            color: #ffb703;
        }
        
        .bar-container {
            flex: 1;
            height: 8px;
            background: #eee;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .bar {
            height: 100%;
            background: #ffb703;
        }
        
        .rating-bar .percentage {
            width: 40px;
            text-align: right;
            color: #666;
            font-size: 14px;
        }
        
        .review-list {
            margin-bottom: 20px;
        }
        
        .review-item {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        
        .reviewer {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .reviewer-avatar {
            width: 40px;
            height: 40px;
            background: #3a86ff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .reviewer-info {
            flex: 1;
        }
        
        .reviewer-name {
            font-weight: 600;
            margin-bottom: 2px;
        }
        
        .review-rating {
            color: #ffb703;
            font-size: 14px;
        }
        
        .review-content p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 5px;
        }
        
        .review-date {
            color: #999;
            font-size: 12px;
        }
        
        .view-all-reviews {
            display: block;
            text-align: center;
            padding: 12px;
            color: #3a86ff;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .view-all-reviews:hover {
            color: #2667cc;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column;
            }
            
            .main-image {
                height: 300px;
            }
            
            .product-features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb">
            <a href="#">Home</a> &gt;
            <a href="#">Sewa Kendaraan</a> &gt;
            <a href="#">Jeep</a> &gt;
            <span>Jeep Wrangler 4x4</span>
        </div>
        
        <!-- Product Detail Section -->
        <div class="product-detail">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Jeep Wrangler 4x4">
                </div>
                <div class="thumbnail-container">
                    <div class="thumbnail active">
                        <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Thumbnail 1">
                    </div>
                    <div class="thumbnail">
                        <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1583&q=80" alt="Thumbnail 2">
                    </div>
                    <div class="thumbnail">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Thumbnail 3">
                    </div>
                </div>
            </div>
            
            <div class="product-info">
                <span class="product-badge badge-primary">Populer</span>
                <h1 class="product-title">Jeep Wrangler 4x4</h1>
                
                <div class="product-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Malang, Jawa Timur</span>
                </div>
                
                <div class="product-price">
                    Rp800.000 <span>/ hari</span>
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
                    <button class="btn btn-outline wishlist-btn">
                        <i class="fas fa-heart"></i> Wishlist
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->
        <div class="reviews-section">
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
                    <span class="count">128 ulasan</span>
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
            
            <div class="review-list">
                <div class="review-item">
                    <div class="reviewer">
                        <div class="reviewer-avatar">A</div>
                        <div class="reviewer-info">
                            <div class="reviewer-name">Andi Wijaya</div>
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
                        <p>Jeepnya sangat nyaman dan performa bagus untuk offroad. Pelayanan penyewaan juga sangat memuaskan. Akan sewa lagi lain waktu!</p>
                        <div class="review-date">2 minggu yang lalu</div>
                    </div>
                </div>
                
                <div class="review-item">
                    <div class="reviewer">
                        <div class="reviewer-avatar">B</div>
                        <div class="reviewer-info">
                            <div class="reviewer-name">Budi Santoso</div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="review-content">
                        <p>Kondisi jeep bersih dan terawat. Hanya saja AC kurang dingin saat siang hari. Tapi secara keseluruhan puas dengan pelayanannya.</p>
                        <div class="review-date">1 bulan yang lalu</div>
                    </div>
                </div>
            </div>
            
            <a href="#" class="view-all-reviews">Lihat Semua Ulasan</a>
        </div>
    </div>

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
</body>
</html>