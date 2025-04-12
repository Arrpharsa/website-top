<?php
include 'koneksi.php';

?>
<html>
    <head>
        <title>Tambah</title>
</head>
<body>
<form action="tambahaksi.php" method="post" class="form" enctype="multipart/form-data">
                <label for="Item">&nbsp;Item</label>
                <input
                    id="Item"
                    class="form-content"
                    type="number"
                    name="Item"
                    autocomplete="on"
                    required />
                <div class="form-border"></div>

                <label for="Harga">&nbsp;Harga</label>
                <input
                    id="Harga"
                    class="form-content"
                    type="text"
                    name="Harga"
                    autocomplete="on"
                    required />
                <div class="form-border"></div>

                <div class="buttons-container">
                <a href="databarang.php"><input id="submit-btn" type="submit" name="submit" value="KONFIRMASI" /></a>
                </div>
            </form>
</body>
</html>