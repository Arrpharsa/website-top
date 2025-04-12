<?php
include '../crud/koneksi.php';
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$result = $koneksi->query("SELECT * FROM ml");

if (!$result) {
    die("Query gagal: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Legends Top-Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #0a0a0a;
            color: white;
            min-height: 100vh;
            position: relative;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            background: rgba(17, 17, 17, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        .back-btn {
            font-size: 20px;
            text-decoration: none;
            color: white;
            margin-right: 20px;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(147, 51, 234, 0.1);
            border-radius: 10px;
        }

        .back-btn:hover {
            background: rgba(147, 51, 234, 0.2);
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #9333ea;
        }

        .game-image {
            width: 100%;
            height: 250px;
            background-image: url('https://cdn.oneesports.id/cdn-data/sites/2/2024/12/MLBB_Joy_RoyalProtector-1024x576-1.jpg');
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            margin-bottom: 30px;
            position: relative;
        }

        .game-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            max-width: 600px;
        }

        .game-info h3 {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .game-info p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

        .input-section {
            background: rgba(17, 17, 17, 0.95);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        .input-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-field {
            flex: 1;
            padding: 15px 20px;
            border: 1px solid rgba(147, 51, 234, 0.2);
            border-radius: 10px;
            background: rgba(30, 30, 30, 0.8);
            color: white;
            font-size: 14px;
        }

        .input-field:focus {
            border-color: #9333ea;
            outline: none;
        }

        .topup-section {
            background: rgba(17, 17, 17, 0.95);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        .topup-section h2 {
            font-size: 24px;
            margin-bottom: 25px;
            text-align: center;
            color: #9333ea;
            font-weight: 600;
        }

        .topup-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .topup-item {
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid rgba(147, 51, 234, 0.2);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .topup-item:hover {
            border-color: #9333ea;
            background: rgba(40, 40, 40, 0.9);
        }

        .topup-item.active {
            background: rgba(147, 51, 234, 0.15);
            border-color: #9333ea;
            color: #9333ea;
        }

        .topup-item span {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        .diamond-icon {
            width: 25px;
            height: 25px;
            display: inline-block;
            background-image: url('diamond-removebg-preview.png');
            background-size: cover;
            background-position: center;
            vertical-align: middle;
            margin-left: 5px;
        }

        .price {
            color: #bbb;
            font-size: 14px;
            font-weight: 500;
        }

        #total-price {
            text-align: center;
            margin: 25px 0;
            font-size: 24px;
            font-weight: 600;
            color: #9333ea;
            background: rgba(147, 51, 234, 0.1);
            padding: 12px 25px;
            border-radius: 10px;
            display: inline-block;
        }

        .confirm {
            background: #9333ea;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: white;
            margin: 25px auto;
            font-family: 'Poppins', sans-serif;
            height: 50px;
            width: 200px;
            text-align: center;
            line-height: 50px;
            display: block;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .confirm:hover {
            background: #7e22ce;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(17, 17, 17, 0.95);
            padding: 25px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            border: 1px solid rgba(147, 51, 234, 0.2);
        }

        .modal-header h3 {
            color: #9333ea;
            font-size: 20px;
            margin-bottom: 15px;
            text-align: center;
        }

        .modal-body p {
            color: #bbb;
            text-align: center;
            margin-bottom: 15px;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .modal-btn {
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 140px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .modal-btn.cancel {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .modal-btn.cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .modal-btn.confirm {
            background: #9333ea;
            color: white;
            border: 2px solid #9333ea;
        }

        .modal-btn.confirm:hover {
            background: #7e22ce;
            border-color: #7e22ce;
        }

        .modal-data {
            background: rgba(30, 30, 30, 0.8);
            padding: 12px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .modal-data p {
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-data span {
            color: #9333ea;
            font-weight: 500;
        }

        /* Struk Styles */
        .struk-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1001;
        }

        .success-check {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1002;
            animation: checkAppear 0.5s ease-out;
        }

        .success-check::before {
            content: '';
            width: 50px;
            height: 50px;
            background: #9333ea;
            border-radius: 50%;
            animation: checkPulse 0.5s ease-out;
        }

        .success-check::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 35px;
            font-weight: bold;
            animation: checkMark 0.3s ease-out 0.2s forwards;
            opacity: 0;
        }

        @keyframes checkAppear {
            0% {
                transform: translate(-50%, -50%) scale(0);
                opacity: 0;
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }

        @keyframes checkPulse {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes checkMark {
            0% {
                opacity: 0;
                transform: scale(0);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .struk-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            width: 90%;
            max-width: 300px;
            color: #333;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .struk-header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }

        .struk-header h2 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #000;
        }

        .struk-header p {
            font-size: 10px;
            color: #666;
            margin: 0;
        }

        .struk-body {
            margin: 10px 0;
        }

        .struk-item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 11px;
        }

        .struk-item span {
            color: #000;
        }

        .struk-divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .struk-footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 15px;
        }

        .struk-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .struk-btn {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }

        .struk-btn.print {
            background: #9333ea;
            color: white;
        }

        .struk-btn.close {
            background: #f3f4f6;
            color: #333;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .struk-content, .struk-content * {
                visibility: visible;
            }
            .struk-content {
                position: absolute;
                left: 0;
                top: 0;
                transform: none;
                width: 100%;
                max-width: none;
                box-shadow: none;
            }
            .struk-buttons {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .input-container {
                flex-direction: column;
            }

            .topup-list {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 10px;
            }

            .game-image {
                height: 200px;
            }

            .game-info h3 {
                font-size: 20px;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }

            .modal-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .modal-btn {
                width: 100%;
                min-width: 100%;
            }
        }

        /* Payment Section Styles */
        .payment-section {
            background: rgba(17, 17, 17, 0.95);
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        .payment-section h2 {
            font-size: 24px;
            margin-bottom: 25px;
            text-align: center;
            color: #9333ea;
            font-weight: 600;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .payment-category h3 {
            font-size: 18px;
            color: #fff;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(147, 51, 234, 0.2);
        }

        .payment-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .payment-item {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(30, 30, 30, 0.8);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid rgba(147, 51, 234, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-item:hover {
            border-color: #9333ea;
            background: rgba(40, 40, 40, 0.9);
        }

        .payment-item input[type="radio"] {
            display: none;
        }

        .payment-item input[type="radio"]:checked + img + span,
        .payment-item input[type="radio"]:checked + img {
            color: #9333ea;
            filter: none;
        }

        .payment-item input[type="radio"]:checked + img {
            transform: scale(1.05);
        }

        .payment-item img {
            height: 30px;
            filter: grayscale(100%) brightness(200%);
            transition: all 0.3s ease;
        }

        .payment-item span {
            color: #fff;
            font-size: 14px;
            font-weight: 500;
        }

        .payment-item:hover img {
            filter: none;
        }

        @media (max-width: 768px) {
            .payment-list {
                grid-template-columns: 1fr;
            }
        }

        /* Payment Popup Styles */
        .payment-popup {
            max-width: 500px;
        }

        .payment-info {
            background: rgba(147, 51, 234, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
        }

        .payment-input {
            margin-bottom: 20px;
        }

        .payment-input label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }

        .payment-input input {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(147, 51, 234, 0.2);
            background: rgba(30, 30, 30, 0.8);
            color: #fff;
            font-size: 16px;
            border-radius: 8px;
        }

        .payment-result {
            background: rgba(147, 51, 234, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
        }

        /* Failed Payment Styles */
        .failed-check {
            width: 80px;
            height: 80px;
            background: #ff4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            color: white;
            animation: failedCheckAnimation 0.5s ease-out;
        }

        @keyframes failedCheckAnimation {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topupItems = document.querySelectorAll('.topup-item');
            const priceDisplay = document.getElementById('total-price');
            const form = document.querySelector('form');
            const modal = document.getElementById('confirmationModal');
            const strukModal = document.getElementById('strukModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const confirmBtn = document.getElementById('confirmBtn');
            const modalUserId = document.getElementById('modalUserId');
            const modalServerId = document.getElementById('modalServerId');
            const modalPaymentMethod = document.getElementById('modalPaymentMethod');
            const modalTotalPrice = document.getElementById('modalTotalPrice');
            const strukUserId = document.getElementById('strukUserId');
            const strukServerId = document.getElementById('strukServerId');
            const strukPaymentMethod = document.getElementById('strukPaymentMethod');
            const strukTotalPrice = document.getElementById('strukTotalPrice');
            const strukTanggal = document.getElementById('strukTanggal');
            let totalPrice = 0;

            // Fungsi untuk mendapatkan label metode pembayaran yang lebih baik
            function getPaymentMethodLabel(value) {
                const paymentMethods = {
                    'bca': 'Bank BCA',
                    'mandiri': 'Bank Mandiri',
                    'bni': 'Bank BNI',
                    'bri': 'Bank BRI',
                    'gopay': 'GoPay',
                    'ovo': 'OVO',
                    'dana': 'DANA',
                    'shopeepay': 'ShopeePay'
                };
                return paymentMethods[value] || value;
            }

            topupItems.forEach(item => {
                item.addEventListener('click', function() {
                    topupItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    const price = parseFloat(this.querySelector('.price').innerText.replace('Rp ', '').replace('.', '').replace(',', '.'));
                    const tax = price * 0.01;
                    totalPrice = price + tax;
                    priceDisplay.innerText = 'Total: Rp ' + totalPrice.toFixed(2).replace('.', ',');
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const userId = document.querySelector('input[name="user_id"]').value;
                const serverId = document.querySelector('input[name="server_id"]').value;
                const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
                
                if (!selectedPayment) {
                    alert('Silakan pilih metode pembayaran');
                    return;
                }
                
                modalUserId.textContent = userId;
                modalServerId.textContent = serverId;
                modalPaymentMethod.textContent = getPaymentMethodLabel(selectedPayment.value);
                modalTotalPrice.textContent = priceDisplay.textContent;
                
                modal.style.display = 'block';
            });

            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            function generateTransactionNumber() {
                const date = new Date();
                const year = date.getFullYear().toString().slice(-2);
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const day = date.getDate().toString().padStart(2, '0');
                const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
                return `TRX${year}${month}${day}${random}`;
            }

            confirmBtn.addEventListener('click', function() {
                modal.style.display = 'none';
                const paymentPopup = document.getElementById('paymentPopup');
                const paymentTotal = document.getElementById('paymentTotal');
                const totalPrice = parseFloat(priceDisplay.textContent.replace('Total: Rp ', '').replace(',', '.'));
                
                paymentTotal.textContent = priceDisplay.textContent.replace('Total: ', '');
                paymentPopup.style.display = 'block';
                
                document.getElementById('cashAmount').value = '';
                document.getElementById('paymentResult').style.display = 'none';
            });

            document.getElementById('cancelPayment').addEventListener('click', function() {
                document.getElementById('paymentPopup').style.display = 'none';
            });

            document.getElementById('processPayment').addEventListener('click', function() {
                const totalPrice = parseFloat(priceDisplay.textContent.replace('Total: Rp ', '').replace(',', '.'));
                const cashAmount = parseFloat(document.getElementById('cashAmount').value);
                
                if (isNaN(cashAmount) || cashAmount < totalPrice) {
                    document.getElementById('paymentPopup').style.display = 'none';
                    document.getElementById('failedPayment').style.display = 'block';
                    return;
                }
                
                const change = cashAmount - totalPrice;
                document.getElementById('paymentResult').style.display = 'block';
                document.getElementById('changeAmount').textContent = 'Rp ' + change.toFixed(2).replace('.', ',');
                
                setTimeout(() => {
                    document.getElementById('paymentPopup').style.display = 'none';
                    
                    // Menampilkan animasi sukses
                    const successCheck = document.createElement('div');
                    successCheck.className = 'success-check';
                    document.body.appendChild(successCheck);

                    // Mengisi data struk
                    strukUserId.textContent = document.querySelector('input[name="user_id"]').value;
                    strukServerId.textContent = document.querySelector('input[name="server_id"]').value;
                    strukPaymentMethod.textContent = modalPaymentMethod.textContent;
                    strukTotalPrice.textContent = priceDisplay.textContent;
                    document.getElementById('strukAmountPaid').textContent = 'Rp ' + cashAmount.toFixed(2).replace('.', ',');
                    document.getElementById('strukChange').textContent = 'Rp ' + change.toFixed(2).replace('.', ',');
                    
                    const now = new Date();
                    const options = { 
                        day: 'numeric', 
                        month: 'long', 
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    };
                    strukTanggal.textContent = now.toLocaleDateString('id-ID', options);
                    document.getElementById('strukNoTrans').textContent = generateTransactionNumber();
                    
                    setTimeout(() => {
                        successCheck.remove();
                        strukModal.style.display = 'block';
                    }, 800);
                }, 1500);
            });

            function closeFailedPayment() {
                document.getElementById('failedPayment').style.display = 'none';
                setTimeout(function() {
                    window.location.href = 'ml.php';
                }, 100);
            }

            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        function closeStruk() {
            document.getElementById('strukModal').style.display = 'none';
            window.location.href = 'ml.php';
        }

        function goBack() {
            window.location.href = '../index.html';
        }

        function printStruk() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <header>
            <a href="index.html" class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="header-content">
                <h1>Mobile Legends</h1>
            </div>
        </header>

        <div class="game-image">
            <div class="game-info">
                <h3>Mobile Legends: Bang Bang</h3>
                <p>Top up Diamond Mobile Legends dengan harga terbaik dan proses instan. Nikmati berbagai bonus dan promo menarik untuk setiap transaksi!</p>
            </div>
        </div>

        <form action="mlproses.php" method="POST">
            <div class="input-section">
                <div class="input-container">
                    <input type="text" name="user_id" placeholder="User ID" class="input-field" required>
                    <input type="text" name="server_id" placeholder="Server ID" class="input-field" required>
                </div>
                <p>Silahkan Masukkan User ID & Server Anda Dan Pastikan Benar.</p>
            </div>

            <div class="topup-section">
                <h2>Pilih Nominal Top-Up</h2>
                <div class="topup-list">
                <?php
                if ($result->num_rows > 0) { 
                    while ($row = $result->fetch_assoc()) {
                        echo "<label class='topup-item'>";
                        echo "<input type='radio' name='topup' value='" . $row['Id_game'] . "' required>";
                        echo "<span>" . $row['DM'] . " Diamonds <div class='diamond-icon'></div></span>";
                        echo "<span class='price'>Rp " . number_format($row['Harga'], 2, ',', '.') . "</span>";
                        echo "</label>";
                    }
                } else {
                    echo "<p>Belum ada data top-up yang tersedia.</p>";
                }
                ?>
                </div>
            </div>

            <!-- Metode Pembayaran Section -->
            <div class="payment-section">
                <h2>Pilih Metode Pembayaran</h2>
                <div class="payment-options">
                    <div class="payment-category">
                        <h3>Transfer Bank</h3>
                        <div class="payment-list">
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="bca" required>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA">
                                <span>Bank BCA</span>
                            </label>
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="mandiri">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" alt="Mandiri">
                                <span>Bank Mandiri</span>
                            </label>
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="bni">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/55/BNI_logo.svg" alt="BNI">
                                <span>Bank BNI</span>
                            </label>
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="bri">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" alt="BRI">
                                <span>Bank BRI</span>
                            </label>
                        </div>
                    </div>
                    <div class="payment-category">
                        <h3>E-Wallet</h3>
                        <div class="payment-list">
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="gopay">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="GoPay">
                                <span>GoPay</span>
                            </label>
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="ovo">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO">
                                <span>OVO</span>
                            </label>
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="dana">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="DANA">
                                <span>DANA</span>
                            </label>
                            <label class="payment-item">
                                <input type="radio" name="payment_method" value="shopeepay">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/85/Shopeepay_logo.svg" alt="ShopeePay">
                                <span>ShopeePay</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="total-price">Total: Rp 0,00</div>
            <button type="submit" class="confirm">Konfirmasi</button>
        </form>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Konfirmasi Pembelian</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin melanjutkan pembelian?</p>
                <div class="modal-data">
                    <p>User ID: <span id="modalUserId"></span></p>
                    <p>Server ID: <span id="modalServerId"></span></p>
                    <p>Metode Pembayaran: <span id="modalPaymentMethod"></span></p>
                    <p>Total Pembayaran: <span id="modalTotalPrice"></span></p>
                </div>
            </div>
            <div class="modal-buttons">
                <button type="button" class="modal-btn cancel" id="cancelBtn">Kembali</button>
                <button type="button" class="modal-btn confirm" id="confirmBtn">Konfirmasi</button>
            </div>
        </div>
    </div>

    <!-- Struk Modal -->
    <div id="strukModal" class="struk-modal">
        <div class="struk-content">
            <div class="struk-header">
                <h2>TOP UP GAME</h2>
                <p>Jl. Contoh No. 123, Kota Contoh</p>
                <p>Telp: (021) 1234-5678</p>
                <p>Email: info@topupgame.com</p>
                <p>Website: www.topupgame.com</p>
                <p>Jam Operasional: 08:00 - 22:00 WIB</p>
            </div>
            <div class="struk-body">
                <div class="struk-item">
                    <span>Tanggal</span>
                    <span id="strukTanggal"></span>
                </div>
                <div class="struk-item">
                    <span>No. Transaksi</span>
                    <span id="strukNoTrans"></span>
                </div>
                <div class="struk-divider"></div>
                <div class="struk-item">
                    <span>Game</span>
                    <span>Mobile Legends</span>
                </div>
                <div class="struk-item">
                    <span>User ID</span>
                    <span id="strukUserId"></span>
                </div>
                <div class="struk-item">
                    <span>Server ID</span>
                    <span id="strukServerId"></span>
                </div>
                <div class="struk-item">
                    <span>Metode Pembayaran</span>
                    <span id="strukPaymentMethod"></span>
                </div>
                <div class="struk-divider"></div>
                <div class="struk-item">
                    <span>Total Pembayaran</span>
                    <span id="strukTotalPrice"></span>
                </div>
                <div class="struk-item">
                    <span>Jumlah Dibayar</span>
                    <span id="strukAmountPaid"></span>
                </div>
                <div class="struk-item">
                    <span>Kembalian</span>
                    <span id="strukChange"></span>
                </div>
                <div class="struk-divider"></div>
                <div class="struk-item">
                    <span>Status</span>
                    <span style="color: #28a745;">Pembayaran Berhasil</span>
                </div>
                <div class="struk-item">
                    <span>Kasir</span>
                    <span>Admin</span>
                </div>
            </div>
            <div class="struk-footer">
                <p>Terima kasih atas kunjungan Anda</p>
                <p>Silahkan simpan struk ini sebagai bukti transaksi</p>
                <p>Untuk keluhan dan saran hubungi:</p>
                <p>WhatsApp: 0812-3456-7890</p>
                <p>Email: support@topupgame.com</p>
            </div>
            <div class="struk-buttons">
                <button type="button" class="struk-btn print" onclick="printStruk()">Cetak</button>
                <button type="button" class="struk-btn close" onclick="closeStruk()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Payment Popup Modal -->
    <div id="paymentPopup" class="modal">
        <div class="modal-content payment-popup">
            <div class="modal-header">
                <h3>Pembayaran</h3>
            </div>
            <div class="modal-body">
                <div class="payment-info">
                    <p>Total Pembayaran: <span id="paymentTotal"></span></p>
                </div>
                <div class="payment-input">
                    <label for="cashAmount">Masukkan Jumlah Uang:</label>
                    <input type="number" id="cashAmount" class="input-field" placeholder="Rp 0">
                </div>
                <div class="payment-result" id="paymentResult" style="display: none;">
                    <p>Kembalian: <span id="changeAmount"></span></p>
                </div>
            </div>
            <div class="modal-buttons">
                <button type="button" class="modal-btn cancel" id="cancelPayment">Batal</button>
                <button type="button" class="modal-btn confirm" id="processPayment">Bayar</button>
            </div>
        </div>
    </div>

    <!-- Failed Payment Modal -->
    <div id="failedPayment" class="modal">
        <div class="modal-content">
            <div class="failed-check">✕</div>
            <div class="modal-header">
                <h3>Pembayaran Gagal</h3>
            </div>
            <div class="modal-body">
                <p>Jumlah uang yang dimasukkan kurang dari total pembayaran.</p>
            </div>
            <div class="modal-buttons">
                <button type="button" class="modal-btn confirm" onclick="closeFailedPayment()">Tutup</button>
            </div>
        </div>
    </div>
</body>
</html>
