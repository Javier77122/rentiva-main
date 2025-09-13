<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Jeep Wrangler 4x4</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Midtrans Snap.js CDN (Sandbox Mode) -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
    <style>
        :root {
            --primary-blue: #2c7be5;
            --dark-blue: #1a5cb8;
            --light-blue: #e6f0fd;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            display: block;
            min-height: 100vh;
        }

        .breadcrumb-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #eff6ff;
            padding: 20px 40px;
            width: 100%;
            max-width: 1300px;
            margin: 0 auto 20px;
        }

        .breadcrumb-title {
            font-weight: 500;
            font-size: 24px;
            color: #333;
            padding-left: 57px;
            position: relative;
        }

        .breadcrumb-links {
            display: flex;
            align-items: center;
            font-size: 17px;
        }

        .breadcrumb-links a {
            text-decoration: none;
            font-weight: 500;
            color: var(--primary-blue);
            transition: opacity 0.3s;
        }

        .breadcrumb-links a:hover {
            opacity: 0.8;
        }

        .breadcrumb-links span {
            margin: 0 8px;
            color: #94a3b8;
        }

        .container {
            max-width: 1300px;
            width: 100%;
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin: 0 auto;
        }

        .product-details {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .product-details img {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            margin-bottom: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-details h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .product-details .location {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .product-details .location i {
            color: var(--primary-blue);
        }

        .product-details .rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .product-details .rating .stars {
            color: #ffb703;
        }

        .product-details .rating .count {
            color: #666;
            font-size: 14px;
        }

        .section-title-blue {
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 16px;
            position: relative;
            padding-left: 8px;
            margin: 16px 0 12px;
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

        .price-detail {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-blue);
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px dashed #d0e0f8;
        }

        .specs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .payment-group {
            margin-bottom: 16px;
        }

        .payment-header {
            background-color: #f9f9fd;
            padding: 12px;
            border: 1px solid #e0e8f5;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
            color: #333;
            transition: background-color 0.3s;
        }

        .payment-header:hover {
            background-color: var(--light-blue);
        }

        .payment-header i {
            color: var(--primary-blue);
            margin-right: 8px;
        }

        .payment-options {
            display: none;
            padding: 12px 0;
            background-color: #fff;
        }

        .payment-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .payment-option:hover {
            background-color: #f5f5f5;
            border-radius: 6px;
        }

        .payment-option input {
            margin-right: 12px;
        }

        .payment-option img {
            width: 30px;
            height: auto;
            margin-right: 12px;
        }

        .btn-booking {
            background-color: white;
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(44, 123, 229, 0.25);
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        .btn-booking:hover {
            background-color: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(44, 123, 229, 0.3);
        }

        .notes {
            padding: 15px;
            background-color: var(--light-blue);
            border-radius: 8px;
            color: var(--dark-blue);
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            .product-details img {
                max-width: 300px;
            }
            .specs {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="breadcrumb-nav">
        <div class="breadcrumb-title">Pembayaran</div>
        <div class="breadcrumb-links">
            <a href="#">Beranda</a>
            <span>/</span>
            <a href="#">Pembayaran</a>
        </div>
    </div>

    <div class="container">
        <!-- Detail Produk -->
        <div class="product-details">
            <img src="https://via.placeholder.com/400x250" alt="Jeep Wrangler 4x4">
            <h2>Jeep Wrangler 4x4</h2>
            <div class="location">
                <i class="fas fa-map-marker-alt"></i>
                <span>Malang, Jawa Timur</span>
            </div>
            <div class="rating">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <span class="count">4.8 (128 ulasan)</span>
            </div>
            <div class="section-title-blue">Detail Harga</div>
            <div class="price-detail">
                <span>Harga Sewa</span>
                <span>Rp1.780.000 / hari</span>
            </div>
            <div class="price-detail">
                <span>Durasi</span>
                <span>1 Hari</span>
            </div>
            <div class="total">
                <span>Total</span>
                <span>Rp1.780.000</span>
            </div>
            <div class="specs">
                <div><span>Tahun:</span> 2020</div>
                <div><span>Bahan Bakar:</span> Bensin</div>
                <div><span>Transmisi:</span> Manual</div>
                <div><span>Kapasitas:</span> 4 orang</div>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="payment-methods">
            <div class="section-title-blue">Pilih Metode Pembayaran</div>
            
            <!-- Dompet Digital -->
            <div class="payment-group">
                <div class="payment-header" onclick="togglePayment(this)">
                    <span><i class="fas fa-wallet"></i> Dompet Digital</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment" value="ovo">
                        <img src="assets/ovo.jpg" alt="OVO">
                        OVO
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="gopay">
                        <img src="https://dashboard.midtrans.com/assets/payment_logos/gopay.png" alt="GoPay">
                        GoPay
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="dana">
                        <img src="https://dashboard.midtrans.com/assets/payment_logos/dana.png" alt="DANA">
                        DANA
                    </label>
                </div>
            </div>

            <!-- Transfer Bank -->
            <div class="payment-group">
                <div class="payment-header" onclick="togglePayment(this)">
                    <span><i class="fas fa-building-columns"></i> Transfer Bank</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment" value="bca_va">
                        <img src="assets/ovo.jpg" alt="BCA">
                        BCA
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="mandiri">
                        <img src="https://dashboard.midtrans.com/assets/payment_logos/mandiri.png" alt="Mandiri">
                        Mandiri
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="bni_va">
                        <img src="https://dashboard.midtrans.com/assets/payment_logos/bni.png" alt="BNI">
                        BNI
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="bri_va">
                        <img src="https://dashboard.midtrans.com/assets/payment_logos/bri.png" alt="BRI">
                        BRI
                    </label>
                </div>
            </div>

            <!-- Kartu Kredit -->
            <div class="payment-group">
                <div class="payment-header" onclick="togglePayment(this)">
                    <span><i class="fas fa-credit-card"></i> Kartu Kredit / Debit</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment" value="credit_card">
                        <img src="https://dashboard.midtrans.com/assets/payment_logos/visa.png" alt="Visa">
                        Visa
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="credit_card">
                        <img src="https://dashboard.midtrans.com/assets/payment_logos/mastercard.png" alt="MasterCard">
                        MasterCard
                    </label>
                </div>
            </div>

            <button class="btn-booking" onclick="startPayment()">Bayar Sekarang</button>
            <div class="notes">
                <i class="fas fa-info-circle"></i>
                <p><strong>Catatan:</strong> Pembayaran harus dilakukan dalam 24 jam setelah pemesanan. Pembatalan akan dikenakan biaya 10% jika dilakukan kurang dari 48 jam sebelum waktu sewa. Pastikan Anda memilih metode pembayaran yang sesuai.</p>
            </div>
        </div>
    </div>

    <script>
        function togglePayment(header) {
            let options = header.nextElementSibling;
            let allOptions = document.querySelectorAll('.payment-options');
            
            // Tutup semua opsi lain
            allOptions.forEach(opt => {
                if (opt !== options) opt.style.display = "none";
            });
            
            // Toggle opsi yang diklik
            options.style.display = options.style.display === "block" ? "none" : "block";
        }

        function startPayment() {
            const selectedPayment = document.querySelector('input[name="payment"]:checked');
            if (!selectedPayment) {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
                return;
            }

            const transactionDetails = {
                transaction_details: {
                    order_id: 'RENTIVA-' + Math.round(Math.random() * 1000000),
                    gross_amount: 1780000 // Harga per hari dari halaman referensi
                },
                customer_details: {
                    first_name: 'Budi',
                    last_name: 'Santoso',
                    email: 'budi.santoso@example.com',
                    phone: '081234567890'
                },
                enabled_payments: [selectedPayment.value]
            };

            snap.pay(transactionDetails, {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil! Terima kasih atas transaksi Anda.');
                    console.log('Success:', result);
                },
                onPending: function(result) {
                    alert('Pembayaran tertunda. Silakan selesaikan sesuai instruksi.');
                    console.log('Pending:', result);
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                    console.log('Error:', result);
                },
                onClose: function() {
                    alert('Anda menutup jendela pembayaran. Silakan coba lagi.');
                    console.log('Popup closed');
                }
            });
        }
    </script>
</body>
</html>