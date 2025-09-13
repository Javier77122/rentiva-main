<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Tambahkan CSS untuk halaman single product */
    .product-detail-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
    }
    
    .product-gallery img {
      width: 100%;
      border-radius: 8px;
    }
    
    .product-info {
      padding: 1rem;
    }
    
    .back-button {
      display: inline-block;
      margin-bottom: 1rem;
      text-decoration: none;
      color: #3a86ff;
    }
  </style>
</head>
<body>
  <a href="index.html" class="back-button">
    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
  </a>
  
  <div class="product-detail-container">
    <div class="product-gallery">
      <img id="productImage" src="" alt="Product Image">
    </div>
    
    <div class="product-info">
      <h1 id="productTitle"></h1>
      <div class="price" id="productPrice"></div>
      <div class="location" id="productLocation"></div>
      <div class="rating" id="productRating"></div>
      
      <div class="description">
        <h3>Deskripsi Produk</h3>
        <p id="productDescription"></p>
      </div>
      
      <button class="btn btn-primary add-to-cart">
        <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
      </button>
    </div>
  </div>

  <script>
    // Ambil parameter ID dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');
    
    // Data produk (bisa diganti dengan fetch ke API)
    const products = {
      1: {
        title: "Jeep Wrangler 4x4",
        price: "Rp800.000 / hari",
        location: "Malang, Jawa Timur",
        rating: "4.8 (128 ulasan)",
        description: "Jeep Wrangler 4x4 dengan kondisi prima, siap menemani petualangan offroad Anda...",
        image: "https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
      }
      // Tambahkan data produk lainnya
    };
    
    // Tampilkan data produk
    if (products[productId]) {
      const product = products[productId];
      document.getElementById('productTitle').textContent = product.title;
      document.getElementById('productPrice').textContent = product.price;
      document.getElementById('productLocation').textContent = product.location;
      document.getElementById('productRating').textContent = product.rating;
      document.getElementById('productDescription').textContent = product.description;
      document.getElementById('productImage').src = product.image;
    }
  </script>
</body>
</html>