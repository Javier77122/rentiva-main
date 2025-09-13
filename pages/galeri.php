<?php
// Connect to database to get gallery images (without session management)
try {
    $host = 'localhost';
    $dbname = 'rentiva_admin';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get active gallery images
    $images_query = "SELECT * FROM gallery_images WHERE status = 'active' ORDER BY display_order ASC, created_at DESC";
    $images_stmt = $pdo->prepare($images_query);
    $images_stmt->execute();
    $gallery_images = $images_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $gallery_images = [];
    error_log("Database connection error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Galeri Bromo - Rentiva</title>
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
      --transition: all 0.3s cubic-bezier(0.25, 0.1, 0.25, 1);
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

    .gallery-header {
      text-align: left;
      padding: 40px 60px 30px;
      position: relative;
    }
    
    .gallery-header h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #334e72;
      margin-bottom: 10px;
    }
    
    .gallery-header p {
      color: #4b5563;
      font-size: 1rem;
      margin-bottom: 25px;
      max-width: 600px;
    }
    
    .header-decoration {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 20px;
    }
    
    .circle {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: #4a89dc;
    }
    
    .line {
      width: 80px;
      height: 3px;
      background-color: #4a89dc;
      margin-left: 5px;
    }
    
    .photo-collection {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      padding: 0 60px 60px;
    }
    
    .photo-card {
      position: relative;
      overflow: hidden;
      border-radius: 20px;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      opacity: 0;
      transform: translateY(20px);
      transition: var(--transition);
    }
    
    .photo-card.aos-animate {
      opacity: 1;
      transform: translateY(0);
    }
    
    .photo-card img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      display: block;
      transition: transform 0.5s ease;
    }
    
    .photo-card:hover img {
      transform: scale(1.08);
    }
    
    .photo-details {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0,0,0,0.6);
      color: white;
      padding: 20px;
      opacity: 0;
      transform: translateY(100%);
      transition: all 0.3s ease;
      font-size: 0.9rem;
    }
    
    .photo-card:hover .photo-details {
      opacity: 1;
      transform: translateY(0);
    }
    
    .photo-details h3 {
      margin: 0 0 5px;
      font-size: 1.2rem;
      font-weight: 600;
    }
    
    .photo-details p {
      margin: 0 0 10px;
    }
    
    .photo-meta {
      display: flex;
      gap: 12px;
      font-size: 0.85rem;
      flex-wrap: wrap;
      align-items: center;
    }
    
    .photo-meta i {
      margin-right: 5px;
      color: #ffd700;
    }
    
    .photo-tags {
      margin-top: 10px;
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }
    
    .photo-tags span {
      background: rgba(255,255,255,0.2);
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 0.75rem;
      transition: all 0.3s ease;
    }
    
    .photo-tags span:hover {
      background: rgba(255,255,255,0.4);
      transform: translateY(-2px);
    }
    
    .detail-btn {
      margin-top: 12px;
      padding: 8px 16px;
      background-color: #4a89dc;
      color: white;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .detail-btn:hover {
      background-color: #3165a8ff;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 127, 80, 0.3);
    }
    
    /* Enhanced Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(32, 32, 32, 0.9);
      z-index: 1000;
      overflow-y: auto;
      opacity: 0;
      transition: opacity 0.4s ease;
    }
    
    .modal.show {
      opacity: 1;
    }
    
    .modal-content {
      background:white;
      margin: 5% auto;
      padding: 0;
      border-radius: 20px;
      width: 80%;
      max-width: 900px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
      position: relative;
      transform: translateY(-50px);
      transition: transform 0.4s ease, opacity 0.4s ease;
      opacity: 0;
      overflow: hidden;
      border: 1px solid #e0e0e0;
      display: flex;
      flex-direction: column;
      min-height: 80vh;
    }
    
    .modal.show .modal-content {
      transform: translateY(0);
      opacity: 1;
    }
    
    .modal-header {
      padding: 25px 30px;
      background: rgba(33, 150, 243, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #e0e0e0;
    }
    
    .modal-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #212121;
      margin: 0;
    }
    
    .close-btn {
      font-size: 1.8rem;
      color: rgba(74, 137, 220, 0.7);
      cursor: pointer;
      transition: all 0.3s ease;
      background: none;
      border: none;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }
    
    .close-btn:hover {
      color: #4a89dc;
      transform: rotate(90deg);
      background: rgba(74, 137, 220, 0.1);
    }
    
    .modal-image-container {
      position: relative;
      overflow: hidden;
      height: 100%;
      display: flex;
    }
    
    .modal-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }
    
    .modal-body {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      padding: 30px;
      flex-grow: 1;
      align-items: stretch;
    }
    
    .modal-info {
      color: #424242;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    
    .modal-description {
      line-height: 1.7;
      margin-bottom: 25px;
      font-size: 1rem;
    }
    
    .modal-meta {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-bottom: 25px;
    }
    
    .modal-meta-item {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .modal-meta-icon {
      width: 40px;
      height: 40px;
      background: rgba(74, 137, 220, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #4a89dc;
      font-size: 1.1rem;
    }
    
    .modal-meta-text {
      flex: 1;
    }
    
    .modal-meta-label {
      font-size: 0.8rem;
      color: #757575;
      margin-bottom: 3px;
    }
    
    .modal-meta-value {
      font-size: 1rem;
      font-weight: 500;
      color: #212121;
    }
    
    .modal-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: auto;
    }
    
    .modal-tag {
      background: #4a89dc;
      color: white;
      padding: 6px 15px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    
    .modal-tag:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(74, 137, 220, 0.3);
    }
    
    /* CTA Section */
    /* Responsive Design */
    @media (max-width: 1024px) {
      .photo-collection { grid-template-columns: repeat(2, 1fr); padding: 0 40px 40px; gap: 25px; }
      .photo-card img { height: 280px; }
      .modal-body { grid-template-columns: 1fr; }
      .modal-image { height: 350px; }
      .modal-content { width: 85%; min-height: auto; }
    }
    
    @media (max-width: 768px) {
      .photo-collection { grid-template-columns: 1fr; padding: 0 20px 40px; gap: 25px; }
      .photo-card img { height: 250px; }
      .modal-content { width: 90%; margin: 10% auto; min-height: auto; }
      .modal-image { height: 250px; }
      .modal-header { padding: 20px; }
      .modal-body { padding: 20px; }
      
      /* Breadcrumb adjustments */
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
      
      /* CTA adjustments */
      .cta-title {
        font-size: 1.8rem;
      }
      .cta-text {
        font-size: 1rem;
      }
    }
    
    @media (max-width: 480px) {
      .modal-content { width: 95%; margin: 15% auto; min-height: auto; }
      .modal-image { height: 200px; }
      .modal-title { font-size: 1.5rem; }
      
      .breadcrumb-nav {
        padding: 20px 20px 0;
      }
      .breadcrumb-title {
        font-size: 24px;
      }
      
      .gallery-header {
        padding: 30px 20px;
      }
      
      .cta-title {
        font-size: 1.5rem;
      }
      .cta-button {
        padding: 12px 25px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

  <!-- Breadcrumb Navigation -->
  <div class="breadcrumb-nav" data-aos="fade-down" data-aos-duration="500">
    <div class="breadcrumb-title"> Galeri Bromo</div>
    <div class="breadcrumb-links">
      <a href="#"> Beranda</a>
      <span>/</span>
      <a href="#">Galeri</a>
    </div>
  </div>

  <div class="gallery-header mt-5" data-aos="fade-up" data-aos-delay="100">
    <h2>Galeri Dokumentasi </h2>
    <p>Abadikan momen terbaik dari berbagai sudut Bromo</p>
    <div class="header-decoration">
      <div class="circle"></div>
      <div class="circle"></div>
      <div class="line"></div>
    </div>
  </div>

  <div class="photo-collection">
    <?php if (empty($gallery_images)): ?>
      <div style="grid-column: 1/-1; text-align: center; padding: 60px; color: #718096;">
        <i class="fas fa-images" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
        <h3>Belum ada foto di galeri</h3>
        <p>Foto-foto akan muncul di sini setelah ditambahkan melalui admin</p>
      </div>
    <?php else: ?>
      <?php 
      $delay = 200;
      foreach ($gallery_images as $image): 
        // Decode JSON tags
        $tags_array = [];
        if ($image['tags']) {
          $decoded_tags = json_decode($image['tags'], true);
          $tags_array = is_array($decoded_tags) ? $decoded_tags : [];
        }
        
        // Format date
        $formatted_date = date('d M Y', strtotime($image['created_at']));
      ?>
        <div class="photo-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
          <img src="gambar/<?php echo htmlspecialchars($image['image_path']); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
          <div class="photo-details">
            <h3><?php echo htmlspecialchars($image['title']); ?></h3>
            <p><?php echo htmlspecialchars($image['description'] ?: 'Dokumentasi Bromo'); ?></p>
            <div class="photo-meta">
              <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($image['location'] ?: 'Bromo'); ?>
              <i class="fas fa-camera"></i> <?php echo htmlspecialchars($image['photographer'] ?: 'Tim Dokumentasi'); ?>
            </div>
            <div class="photo-tags">
              <?php foreach ($tags_array as $tag): ?>
                <span><?php echo htmlspecialchars($tag); ?></span>
              <?php endforeach; ?>
            </div>
<?php
              // Prepare data for JavaScript - escape properly
              $js_data = [
                'title' => $image['title'],
                'description' => $image['description'] ?: 'Dokumentasi indah dari kawasan Bromo yang menakjubkan.',
                'location' => $image['location'] ?: 'Bromo',
                'photographer' => $image['photographer'] ?: 'Tim Dokumentasi',
                'date' => $formatted_date,
                'camera' => $image['camera_info'] ?: 'Kamera Digital',
                'tags' => $tags_array,
                'image' => 'gambar/' . $image['image_path']
              ];
              $js_data_json = htmlspecialchars(json_encode($js_data), ENT_QUOTES, 'UTF-8');
            ?>
            <button class="detail-btn" onclick="openModal(<?php echo $js_data_json; ?>)">
              <i class="fas fa-search"></i> Lihat Detail
            </button>
          </div>
        </div>
      <?php 
        $delay += 50; // Increment delay for staggered animation
      endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Enhanced Modal -->
  <div id="imageModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Sunrise di Bromo</h3>
        <button class="close-btn" onclick="closeModal()">&times;</button>
      </div>
      <div class="modal-body">
        <div class="modal-image-container">
          <img id="modalImage" src="gambar/1.jpg" alt="" class="modal-image">
        </div>
        <div class="modal-info">
          <p class="modal-description" id="modalDescription"></p>
          
          <div class="modal-meta">
            <div class="modal-meta-item">
              <div class="modal-meta-icon">
                <i class="fas fa-map-marker-alt" style="color: #4a89dc;"></i>
              </div>
              <div class="modal-meta-text">
                <div class="modal-meta-label">Lokasi</div>
                <div class="modal-meta-value" id="modalLocation">Pasir Berbisik</div>
              </div>
            </div>
            
            <div class="modal-meta-item">
              <div class="modal-meta-icon">
                <i class="fas fa-camera" style="color: #4a89dc;"></i>
              </div>
              <div class="modal-meta-text">
                <div class="modal-meta-label">Fotografer</div>
                <div class="modal-meta-value" id="modalPhotographer">Tim Dokumentasi</div>
              </div>
            </div>
            
            <div class="modal-meta-item">
              <div class="modal-meta-icon">
                <i class="fas fa-calendar-alt" style="color: #4a89dc;"></i>
              </div>
              <div class="modal-meta-text">
                <div class="modal-meta-label">Tanggal</div>
                <div class="modal-meta-value" id="modalDate">15 Juni 2023</div>
              </div>
            </div>
            
            <div class="modal-meta-item">
              <div class="modal-meta-icon">
                <i class="fas fa-camera-retro" style="color: #4a89dc;"></i>
              </div>
              <div class="modal-meta-text">
                <div class="modal-meta-label">Kamera</div>
                <div class="modal-meta-value" id="modalCamera">Canon EOS R5</div>
              </div>
            </div>
          </div>
          
          <div class="modal-tags" id="modalTags">
            <span class="modal-tag">#Sunrise</span>
            <span class="modal-tag">#Landscape</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CTA Section -->
<section class="cta-section"  style="background: linear-gradient(135deg, #4a89dc 0%, #3b7dd8 100%); padding: 80px 20px; text-align: center; color: white; margin-top: 40px;">
  <div style="max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 2.2rem; margin-bottom: 20px; font-weight: 700;" data-aos="fade-up" data-aos-delay="100">Sewa Jeep untuk Petualangan Bromo Anda!</h2>
    <p style="font-size: 1.1rem; margin-bottom: 30px; opacity: 0.9;" data-aos="fade-up" data-aos-delay="100">Nikmati perjalanan nyaman dengan armada jeep kami yang terawat. Dengan sopor berpengalaman, perjalanan ke Bromo akan lebih menyenangkan!</p>
   
    
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;" data-aos="fade-up" data-aos-delay="100">
      <a href="#" style="background: white; color: #4a89dc; padding: 15px 35px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center;"
         onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.15)'" 
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
        <i class="fas fa-calendar-check" style="margin-right: 10px;"></i> Tunggu apa lagi booking sekarang !!
      </a>
    
    </div>
  </div>
</section>

  <script>
    // Function to open modal with data object
    function openModal(data) {
      const modal = document.getElementById('imageModal');
      document.getElementById('modalTitle').textContent = data.title;
      document.getElementById('modalDescription').textContent = data.description;
      document.getElementById('modalLocation').textContent = data.location;
      document.getElementById('modalPhotographer').textContent = data.photographer;
      document.getElementById('modalDate').textContent = data.date;
      document.getElementById('modalCamera').textContent = data.camera;
      document.getElementById('modalImage').src = data.image;
      document.getElementById('modalImage').alt = data.title;
      
      // Clear existing tags
      const tagsContainer = document.getElementById('modalTags');
      tagsContainer.innerHTML = '';
      
      // Add new tags
      data.tags.forEach(tag => {
        const tagElement = document.createElement('span');
        tagElement.className = 'modal-tag';
        tagElement.textContent = tag;
        tagsContainer.appendChild(tagElement);
      });
      
      // Show modal with animation
      modal.style.display = 'block';
      document.body.style.overflow = 'hidden';
      
      // Trigger animations
      setTimeout(() => {
        modal.classList.add('show');
      }, 10);
    }
    
    // Function to close modal
    function closeModal() {
      const modal = document.getElementById('imageModal');
      modal.classList.remove('show');
      
      // Wait for animation to complete before hiding
      setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
      }, 400);
    }
    
    // Close modal when clicking outside of content
    window.onclick = function(event) {
      const modal = document.getElementById('imageModal');
      if (event.target == modal) {
        closeModal();
      }
    }
    
    // Close modal with Escape key
    document.onkeydown = function(evt) {
      evt = evt || window.event;
      if (evt.key === "Escape") {
        closeModal();
      }
    };
  </script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 700,
      easing: 'ease-in-out-quart',
      once: true,
      offset: 100,
      delay: 150,
      mirror: false
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