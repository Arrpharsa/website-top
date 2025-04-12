-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2024 pada 01.51
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topup`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `Id_user` int(11) NOT NULL,
  `No_telp` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`Id_user`, `No_telp`, `Password`) VALUES
(1, '', ''),
(2, '', ''),
(3, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aov`
--

CREATE TABLE `aov` (
  `Id_game` int(11) NOT NULL,
  `AovVouchers` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aov`
--

INSERT INTO `aov` (`Id_game`, `AovVouchers`, `Harga`) VALUES
(1, '40', '9500'),
(2, '90', '19500'),
(3, '230', '49000'),
(4, '470', '99000'),
(5, '950', '195000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cod`
--

CREATE TABLE `cod` (
  `Id_game` int(11) NOT NULL,
  `CP` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cod`
--

INSERT INTO `cod` (`Id_game`, `CP`, `Harga`) VALUES
(1, '31', '5000'),
(2, '62', '10000'),
(3, '127', '20000'),
(4, '1373', '195000'),
(5, '2059', '295000'),
(6, '3564', '480000'),
(7, '7656', '960000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `eggyparty`
--

CREATE TABLE `eggyparty` (
  `Id_game` int(11) NOT NULL,
  `ECoins` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `eggyparty`
--

INSERT INTO `eggyparty` (`Id_game`, `ECoins`, `Harga`) VALUES
(1, '10', '2200'),
(2, '60', '13000'),
(3, '120', '26000'),
(4, '300', '65000'),
(5, '700', '151670'),
(6, '1380', '299000'),
(7, '2080', '450670'),
(8, '3450', '747500'),
(9, '6880', '1490667');

-- --------------------------------------------------------

--
-- Struktur dari tabel `epep`
--

CREATE TABLE `epep` (
  `Id_game` int(11) NOT NULL,
  `FDM` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `epep`
--

INSERT INTO `epep` (`Id_game`, `FDM`, `Harga`) VALUES
(1, '2', '1500'),
(2, '12', '3500'),
(3, '50', '8000'),
(4, '70', '10000'),
(5, '100', '15000'),
(6, '140', '18000'),
(7, '355', '47000'),
(8, '720', '95000'),
(9, '1075', '150000'),
(10, '2160', '280000'),
(11, '7290', '920000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genshin`
--

CREATE TABLE `genshin` (
  `Id_game` int(11) NOT NULL,
  `Primogem` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `genshin`
--

INSERT INTO `genshin` (`Id_game`, `Primogem`, `Harga`) VALUES
(1, '60', '12000'),
(2, '330', '64000'),
(3, '1090', '192000'),
(4, '3880', '640000'),
(5, '8080', '1280000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hok`
--

CREATE TABLE `hok` (
  `Id_game` int(11) NOT NULL,
  `HokTokens` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hok`
--

INSERT INTO `hok` (`Id_game`, `HokTokens`, `Harga`) VALUES
(1, '8', '1666'),
(2, '16', '3666'),
(3, '23', '4666'),
(4, '88', '14666'),
(5, '257', '41666'),
(6, '432', '68666'),
(7, '605', '91666'),
(8, '895', '131666'),
(9, '1353', '192666'),
(10, '2724', '409666'),
(11, '4580', '683666'),
(12, '9160', '1308666');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lol`
--

CREATE TABLE `lol` (
  `Id_game` int(11) NOT NULL,
  `WildCores` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lol`
--

INSERT INTO `lol` (`Id_game`, `WildCores`, `Harga`) VALUES
(1, '425', '60000'),
(2, '1000', '125000'),
(3, '1850', '220000'),
(4, '3275', '375000'),
(5, '4800', '535000'),
(6, '6210', '750000'),
(7, '10000', '1150000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ml`
--

CREATE TABLE `ml` (
  `Id_game` int(11) NOT NULL,
  `DM` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ml`
--

INSERT INTO `ml` (`Id_game`, `DM`, `Harga`) VALUES
(4, '5', '1400'),
(5, '10', '3000'),
(6, '12', '3500'),
(7, '19', '5500'),
(8, '28', '8000'),
(9, '33', '9500'),
(10, '44', '11500'),
(11, '59', '15166'),
(12, '71', '18500'),
(13, '97', '25166'),
(14, '113', '29900'),
(15, '170', '44900'),
(16, '219', '59900'),
(17, '240', '64900'),
(18, '284', '73900'),
(19, '408', '105900'),
(20, '452', '119900'),
(21, '510', '140000'),
(22, '568', '150000'),
(23, '716', '190000'),
(24, '875', '220000'),
(25, '960', '250000'),
(26, '1045', '270000'),
(27, '1443', '370000'),
(28, '2010', '500000'),
(29, '2625', '700000'),
(30, '3453', '900000'),
(31, '4020', '1000000'),
(32, '4830', '1200000'),
(33, '6840', '1700000'),
(34, '7715', '1900000'),
(35, '8850', '2100000'),
(36, '9660', '2300000'),
(37, '11670', '2800000'),
(38, '14490', '3500000'),
(39, '16500', '4000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pubg`
--

CREATE TABLE `pubg` (
  `Id_game` int(11) NOT NULL,
  `UC` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pubg`
--

INSERT INTO `pubg` (`Id_game`, `UC`, `Harga`) VALUES
(1, '30', '7500'),
(2, '70', '14000'),
(3, '325', '70000'),
(4, '660', '140000'),
(5, '1320', '280000'),
(6, '1800', '350000'),
(7, '3850', '710000'),
(8, '8100', '1400000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `starrail`
--

CREATE TABLE `starrail` (
  `Id_game` int(11) NOT NULL,
  `OneiricShard` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `starrail`
--

INSERT INTO `starrail` (`Id_game`, `OneiricShard`, `Harga`) VALUES
(1, '60', '15000'),
(2, '330', '60000'),
(3, '1100', '185000'),
(4, '2240', '400000'),
(5, '3880', '620000'),
(6, '8080', '1210000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `undawn`
--

CREATE TABLE `undawn` (
  `Id_game` int(11) NOT NULL,
  `RC` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `undawn`
--

INSERT INTO `undawn` (`Id_game`, `RC`, `Harga`) VALUES
(1, '80', '15000'),
(2, '250', '42000'),
(3, '450', '70000'),
(4, '920', '137000'),
(5, '1850', '273000'),
(6, '2800', '409000'),
(7, '4750', '681000'),
(8, '9600', '1362000'),
(9, '22000', '4551000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `valorant`
--

CREATE TABLE `valorant` (
  `Id_game` int(11) NOT NULL,
  `VP` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `valorant`
--

INSERT INTO `valorant` (`Id_game`, `VP`, `Harga`) VALUES
(1, '475', '55000'),
(2, '950', '105000'),
(3, '1475', '160000'),
(4, '2050', '210000'),
(5, '2525', '260000'),
(6, '3050', '310000'),
(7, '3650', '360000'),
(8, '4100', '410000'),
(9, '4650', '460000'),
(10, '5350', '510000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`Id_user`);

--
-- Indeks untuk tabel `aov`
--
ALTER TABLE `aov`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `cod`
--
ALTER TABLE `cod`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `eggyparty`
--
ALTER TABLE `eggyparty`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `epep`
--
ALTER TABLE `epep`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `genshin`
--
ALTER TABLE `genshin`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `hok`
--
ALTER TABLE `hok`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `lol`
--
ALTER TABLE `lol`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `ml`
--
ALTER TABLE `ml`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `pubg`
--
ALTER TABLE `pubg`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `starrail`
--
ALTER TABLE `starrail`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `undawn`
--
ALTER TABLE `undawn`
  ADD PRIMARY KEY (`Id_game`);

--
-- Indeks untuk tabel `valorant`
--
ALTER TABLE `valorant`
  ADD PRIMARY KEY (`Id_game`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `aov`
--
ALTER TABLE `aov`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cod`
--
ALTER TABLE `cod`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `eggyparty`
--
ALTER TABLE `eggyparty`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `epep`
--
ALTER TABLE `epep`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `genshin`
--
ALTER TABLE `genshin`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `hok`
--
ALTER TABLE `hok`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `lol`
--
ALTER TABLE `lol`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ml`
--
ALTER TABLE `ml`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `pubg`
--
ALTER TABLE `pubg`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `starrail`
--
ALTER TABLE `starrail`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `undawn`
--
ALTER TABLE `undawn`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `valorant`
--
ALTER TABLE `valorant`
  MODIFY `Id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ml`
--
ALTER TABLE `ml`
  ADD CONSTRAINT `fk_game` FOREIGN KEY (`Id_game`) REFERENCES `game` (`Id_game`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
