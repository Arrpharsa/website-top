<?php 

include 'koneksi.php';
$IdPaket       = $_POST['IdPaket'];
$GameId        = $_POST['GameId'];
$NamaGame      = $_POST['NamaGame'];
$JumlahDiamond = $_POST['JumlahDiamond'];
$Harga         = $_POST['Harga'];
    
    
    $data = mysqli_query($koneksi,"UPDATE diamond set 
    NamaGame      ='$NamaGame', 
    harga         ='$harga', 
    JumlahDiamond ='$jumlah_stock',
    Harga         ='$Harga' WHERE IdPaket='$IdPaket'");

header("location:dashboard.php");
?>
