<!DOCTYPE html>
<html>
    <head>
    <title>Barang Masuk</title>
    
    <style>
        body {
            background-color: #ad1326;
        }

        label {
            font-family: "Raleway", sans-serif;
            font-size: 13pt;
        }

        #card {
            background: #fbfbfb;
            border-radius: 8px;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
            height: auto;
            margin: 6rem auto 8.1rem auto;
            width: 329px;
            padding: 20px;
        }

        #card-content {
            padding: 15px 44px;
        }

        #card-title {
            font-family: "Raleway Thin", sans-serif;
            letter-spacing: 4px;
            padding-bottom: 23px;
            padding-top: 13px;
            text-align: center;
        }

        #submit-btn {
            border: none;
            border-radius: 21px;
            cursor: pointer;
            color: white;
            margin-top: 20px;
            font-family: "Raleway Thin", sans-serif;
            height: 42.3px;
            transition: 0.25s;
            width: 150px;
        }

        #submit-btn {
            background: -webkit-linear-gradient(right, #d00000, #d00000);
            box-shadow: 0px 1px 80px #8a7777;
        }

        #submit-btn:hover{
            box-shadow: 0px 10px 18px #8a7777;
        }

        .underline-title {
            background: orangered; 
            height: 2px;
            margin: -1.1rem auto 0 auto;
            width: 215px;
        }

        .form {
            align-items: left;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .form-border {
            background: -webkit-linear-gradient(right, #032030, #d00000);
            height: 2px;
            width: 100%;
            margin-bottom: 10px;
        }

        .form-content {
            background: #fbfbfb;
            border: none;
            outline: none;
            padding-top: 14px;
            margin-bottom: 10px;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>INPUT BARANG</h2>
                <div class="underline-title"></div>
            </div>

            <?php
	include 'koneksi.php';
	$IdPaket = $_GET['IdPaket'];
	$data = mysqli_query($koneksi,"SELECT * FROM diamond WHERE IdPaket='$IdPaket'");
	while($d = mysqli_fetch_array($data)){
		?>


    <form action="update.php" method="post" class="form">
                <input type="hidden" name="IdPaket" value="<?php echo $d['IdPaket']; ?>">
                <label for="NamaGame">&nbsp;Nama Game</label>
                <input
                    id="NamaGame"
                    class="form-content"
                    type="text"
                    name="NamaGame"
                    value="<?php echo $d['NamaGame']; ?>"
                    autocomplete="on"
                    required />
                <div class="form-border"></div>

                <label for="JumlahDiamond">&nbsp;Jumlah</label>
                <input
                    id="JumlahDiamond"
                    class="form-content"
                    type="text"
                    name="JumlahDiamond"
                    value="<?php echo $d['JumlahDiamond']; ?>"
                    autocomplete="on"
                    required />
                <div class="form-border"></div>

                <label for="Harga">&nbsp;Harga</label>
                <input
                    id="Harga"
                    class="form-content"
                    type="number"
                    name="Harga"
                    value="<?php echo $d['Harga']; ?>"
                    autocomplete="on"
                    required />
                <div class="form-border"></div>

                <div class="buttons-container">
                <a href="dashboard.php"><input id="submit-btn" type="submit" name="submit" value="KONFIRMASI" /></a>
                </div>
            </form>
            <?php
    }
    ?>
        </div>
    </div>
</body>
</html>
