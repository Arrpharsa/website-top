<?php 

include 'koneksi.php';


$IdPaket = $_GET['IdPaket'];
 
 
mysqli_query($koneksi,"DELETE FROM diamond WHERE IdPaket='$IdPaket'");
 

header("location: dashboard.php");
 
?>