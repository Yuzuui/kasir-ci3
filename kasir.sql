-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Jul 2025 pada 11.39
-- Versi server: 8.0.30
-- Versi PHP: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_tranksaksi`
--

CREATE TABLE `detail_tranksaksi` (
  `id_dt` int NOT NULL,
  `nota` varchar(25) NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `sub_total` decimal(10,0) NOT NULL,
  `diskon` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_tranksaksi`
--

INSERT INTO `detail_tranksaksi` (`id_dt`, `nota`, `id_produk`, `jumlah`, `sub_total`, `diskon`) VALUES
(69, '202502001', 3, 1, 3000, 0.00),
(70, '202502001', 3, 1, 3000, 0.00),
(71, '202502001', 3, 1, 3000, 0.00),
(72, '202502001', 3, 1, 3000, 0.00),
(73, '202502001', 4, 2, 10000, 0.00),
(74, '202502002', 2, 1, 3000, 0.00),
(75, '202502003', 4, 1, 5000, 0.00),
(76, '202502004', 4, 1, 5000, 0.00),
(77, '202502005', 4, 1, 5000, 0.00),
(78, '202502006', 4, 2, 10000, 0.00),
(79, '202502007', 4, 3, 15000, 0.00),
(80, '202502008', 4, 3, 15000, 0.00),
(81, '202502009', 4, 4, 20000, 0.00),
(82, '202502010', 4, 10, 50000, 0.00),
(83, '202502011', 4, 2, 9980, 10.00),
(84, '202503001', 6, 2, 16000, 0.00),
(85, '202504001', 5, 5, 100000, 0.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `no_hp`, `alamat`) VALUES
(1, 'ass', '876623', 'ahsy'),
(2, 'ddss', '2322', 'ajka'),
(5, 'sdas', '8876', 'ssda'),
(6, 'ama', '9800000', 'ajaj'),
(7, 'asyaa', '09099', 'dada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `barcode` varchar(25) NOT NULL,
  `barcode_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `harga`, `stok`, `barcode`, `barcode_image`) VALUES
(5, 'buku', 20000, 45, '314030086751', 'assets/barcodes/314030086751.png'),
(6, 'bolpin', 8000, 28, '4970129029519', 'assets/barcodes/4970129029519.png'),
(7, 'pppp', 5666, 80, '6971082812956', 'assets/barcodes/6971082812956.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

CREATE TABLE `temp` (
  `id_temp` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_user` int NOT NULL,
  `diskon` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `temp`
--

INSERT INTO `temp` (`id_temp`, `id_produk`, `jumlah`, `id_pelanggan`, `id_user`, `diskon`) VALUES
(47, 7, 3, 6, 27, 0.00),
(48, 6, 3, 6, 27, 6.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `nota` varchar(25) NOT NULL,
  `id_pelanggan` int NOT NULL,
  `tagihan` int NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nota`, `id_pelanggan`, `tagihan`, `tanggal`) VALUES
(22, '202502001', 6, 10000, '2025-02-18'),
(23, '202502002', 7, 3000, '2025-02-18'),
(24, '202502003', 6, 5000, '2025-02-18'),
(25, '202502004', 6, 5000, '2025-02-18'),
(26, '202502005', 2, 5000, '2025-02-18'),
(27, '202502006', 6, 10000, '2025-02-23'),
(28, '202502007', 6, 15000, '2025-02-23'),
(29, '202502008', 2, 15000, '2025-02-23'),
(30, '202502009', 2, 20000, '2025-02-23'),
(31, '202502010', 1, 50000, '2025-02-24'),
(32, '202502011', 2, 9000, '2025-02-24'),
(33, '202503001', 7, 16000, '2025-03-16'),
(34, '202504001', 1, 100000, '2025-04-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `nama`) VALUES
(26, 'gyu', '202cb962ac59075b964b07152d234b70', 'pegawai', 'mingyu'),
(27, 'chol', '506a57518512c18d57fd3e855d23c76c', 'admin', 'schol');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_tranksaksi`
--
ALTER TABLE `detail_tranksaksi`
  ADD PRIMARY KEY (`id_dt`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_tranksaksi`
--
ALTER TABLE `detail_tranksaksi`
  MODIFY `id_dt` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id_temp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
