<?php
include '../crud/koneksi.php';
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$result = $koneksi->query("SELECT * FROM cod");

if (!$result) {
    die("Query gagal: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call Of Duty Top-Up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: white;
        }

        .container {
            max-width: 550px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .back-btn {
            font-size: 24px;
            text-decoration: none;
            color: white;
            margin-right: 10px;
        }

        h1 {
            font-size: 24px;
        }

        .input-section {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .input-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .input-field {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 25px;
            background-color: #555;
            color: white;
            text-align: center;
            font-size: 16px;
        }

        .input-section p {
            font-size: 14px;
            color: #bbb;
            text-align: center;
            margin-top: 10px;
        }

        .topup-section {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
        }

        .topup-section h2 {
            font-size: 18px;
            margin-bottom: 10px;
            text-align: center;
        }

        .topup-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        .topup-item {
            background-color: #555;
            border: 2px solid #666;
            border-radius: 10px;
            width: 48%;
            padding: 15px;
            text-align: center;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s, border-color 0.3s;
            font-size: 14px;
            cursor: pointer;
            position: relative;
        }

        /* radio butten hidden */
        .topup-item input[type="radio"] {
            display: none;
        }

        /* tampilan pas ga dipilih */
        .topup-item:hover {
            background-color: #666;
            border-color: #888;
        }

        /* tampilan pas dipilih */
        .topup-item.active {
            background-color: #666;
            border-color: #00b894;
            color: #00b894;
        }

        .topup-item span {
            display: block;
            margin-bottom: 5px;
        }

        .diamond-icon {
            width: 20px;
            height: 20px;
            display: inline-block;
            background-image: url('cod.png');
            background-size: cover;
            background-position: center; 
            background-repeat: no-repeat;
            vertical-align: middle; 
        }

        .price {
            color: #bbb;
        }

        .confirm {
            background-color: black;
            text-decoration: none;
            border: none;
            border-radius: 21px;
            cursor: pointer;
            color: white;
            margin-top: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 42.3px;
            width: 150px;
            text-align: center;
            line-height: 42px;
            display: block;
        }

        .confirm:hover {
            background-color: #666;
        }

        .disabled {
            background-color: #888;
            cursor: not-allowed;
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

                    // ambil harga dari item yang dipilih
                    const price = parseFloat(this.querySelector('.price').innerText.replace('Rp ', '').replace('.', '').replace(',', '.'));
                    const tax = price * 0.01; // pajak 1%
                    totalPrice = price + tax; // tambah pajak
                    priceDisplay.innerText = 'Total: Rp ' + totalPrice.toFixed(2).replace('.', ','); //  total
                });
            });
        });
        function goBack(){
            window.location.href= '../dashboard.php';
        }
        </script>
</head>
<body>
    <div class="container">
        <header>
            <a href="index.html" class="back-btn" onclick="goBack()">&lt;</a>
            <h1>Call Of Duty Mobile</h1>
        </header>

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
                        echo "<span>" . $row['CP'] . " CP <div class='diamond-icon'></div></span>";
                        echo "<span class='price'>Rp " . number_format($row['Harga'], 2, ',', '.') . "</span>";
                        echo "</label>";
                    }
                } else {
                    echo "<p>Belum ada data top-up yang tersedia.</p>";
                }
                ?>
                </div>
            </div>
            <center><div id="total-price">Total: Rp 0,00</div></center>
            
            <button type="submit" class="confirm">Konfirmasi</button>
        </form>
    </div>
</body>
</html>
