<?php
// Melakukan koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "topup");

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
