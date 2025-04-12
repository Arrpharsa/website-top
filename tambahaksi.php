<?php 
include 'koneksi.php';

$Id_game = $_POST['Id_game'];
$Item    = $_POST['Item'];
$Harga   = $_POST['Harga'];
mysqli_query($koneksi, "INSERT INTO lol 
(Id_game, Item, Harga) VALUES
('$Id_game', '$Item','$Harga')");


header("location: tambah.php");
?>
