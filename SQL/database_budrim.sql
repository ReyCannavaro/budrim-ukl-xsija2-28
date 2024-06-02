-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2024 pada 02.11
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budrim`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `id_user` int(255) NOT NULL,
  `resi` int(255) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(255) NOT NULL,
  `jenis_layanan` varchar(255) NOT NULL,
  `hargaperkg` int(255) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `jenis_layanan`, `hargaperkg`, `deskripsi`) VALUES
(1, 'reguler', 10000, 'Layanan pengiriman dengan waktu tempuh standar yang biasanya memakan waktu 2-5 hari kerja, tergantung jarak dan lokasi tujuan. Cocok untuk pengiriman yang tidak terlalu mendesak namun tetap mengutamakan keandalan dan biaya yang lebih ekonomis.\r\n'),
(2, 'express', 20000, 'Layanan pengiriman dengan waktu tempuh lebih cepat dibandingkan layanan reguler, biasanya 1-2 hari kerja. Ideal untuk pengiriman yang membutuhkan waktu sampai yang lebih cepat, dengan tarif yang lebih tinggi daripada layanan reguler.'),
(3, 'kargo', 50000, 'Layanan pengiriman yang diperuntukkan bagi barang-barang berukuran besar atau berat dengan harga per kilogram yang lebih terjangkau. Pengiriman kargo biasanya memakan waktu lebih lama dan sering digunakan untuk keperluan bisnis atau pengiriman dalam jumlah besar.'),
(4, 'nextday', 40000, 'Layanan pengiriman yang menjamin barang akan sampai di tujuan pada hari kerja berikutnya setelah barang dikirim. Cocok untuk pengiriman yang sangat mendesak dan membutuhkan kecepatan tinggi dengan tarif premium.'),
(5, 'Hemat', 5000, 'Layanan pengiriman paket \"hemat\" menyediakan solusi ekonomis bagi pengguna yang mencari opsi pengiriman dengan biaya yang lebih terjangkau. Layanan ini sering kali mengutamakan waktu pengiriman yang sedikit lebih lama daripada opsi premium, namun tetap memberikan keandalan dalam pengiriman paket. Dengan fokus pada efisiensi biaya dan pengiriman yang handal, layanan ini cocok untuk pengiriman barang yang tidak memerlukan kecepatan tinggi dan siap menunggu sedikit lebih lama demi penghematan biaya.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `resi` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_layanan` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `bobotkg` int(255) NOT NULL,
  `nama_penerima` varchar(1000) NOT NULL,
  `alamat` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(5) NOT NULL,
  `no_telp` int(255) NOT NULL,
  `alamat` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `no_telp`, `alamat`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 0, 'IDN'),
(2, 'user', 'user', 'user', 'user', 2147483647, 'Indonesia');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`resi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `resi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
