<?php
include '../crud/koneksi.php';
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$result = $koneksi->query("SELECT * FROM undawn");

if (!$result) {
    die("Query gagal: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garena Undawn Top-Up</title>
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
            background-image: url('https://www.undawn.game/images/card.png');
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
            background-image: url('undawn-removebg-preview.png');
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
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topupItems = document.querySelectorAll('.topup-item');
            const priceDisplay = document.getElementById('total-price');
            let totalPrice = 0;

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
        });

        function goBack() {
            window.location.href = '../index.html';
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
                <h1>Garena Undawn</h1>
            </div>
        </header>

        <div class="game-image">
            <div class="game-info">
                <h3>Garena Undawn</h3>
                <p>Top up RC Undawn dengan harga terbaik dan proses instan. Nikmati berbagai bonus dan promo menarik untuk setiap transaksi!</p>
            </div>
        </div>

        <form action="selesai.html" method="POST" onsubmit="return confirm('Apakah Anda Yakin ID Sudah Benar?');">
            <div class="input-section">
                <div class="input-container">
                    <input type="text" name="user_id" placeholder="User ID" class="input-field" required>
                </div>
                <p>Silahkan Masukkan User ID Anda Dan Pastikan Benar.</p>
            </div>

            <div class="topup-section">
                <h2>Pilih Nominal Top-Up</h2>
                <div class="topup-list">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                        echo "<label class='topup-item'>";
                        echo "<input type='radio' name='topup' value='" . $row['Id_game'] . "' required>";
                        echo "<span>" . $row['RC'] . " RC <div class='diamond-icon'></div></span>";
                        echo "<span class='price'>Rp " . number_format($row['Harga'], 2, ',', '.') . "</span>";
                        echo "</label>";
                    }
                } else {
                    echo "<p>Belum ada data top-up yang tersedia.</p>";
                }
                ?>
                </div>
            </div>

            <div id="total-price">Total: Rp 0,00</div>
            <button type="submit" class="confirm">Konfirmasi</button>
        </form>
    </div>
</body>
</html>
