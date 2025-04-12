<?php
$servername = "localhost";
$username = "username"; // Ganti dengan username database Anda
$password = "password"; // Ganti dengan password database Anda
$dbname = "db_topup"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyimpan data transaksi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_game = $_POST['Id_game'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $dm = $_POST['DM'];

    $sql = "INSERT INTO transaksi (id_game, harga, jumlah, tanggal_transaksi, DM) 
            VALUES ('$id_game', '$harga', '$jumlah', '$tanggal_transaksi', '$dm')";

    if ($conn->query($sql) === TRUE) {
        echo "Transaksi berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>