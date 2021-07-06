-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2021 pada 08.19
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `no_nota` INT(5) NOT NULL,
  `id_produk` INT(5) NOT NULL,
  `kuantitas` INT(5) DEFAULT NULL,
  `sub_total` FLOAT DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` VARCHAR(255) NOT NULL,
  `nama_kategori` VARCHAR(20) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`) VALUES
('D002', 'Daging Matang'),
('M001', 'Makanan Basah'),
('M002', 'Makanan Kering');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nama` VARCHAR(50) DEFAULT NULL,
  `username` VARCHAR(15) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `alamat` VARCHAR(50) DEFAULT NULL,
  `telp_p` VARCHAR(15) DEFAULT NULL,
  `id_toko` INT(5) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `username`, `password`, `alamat`, `telp_p`, `id_toko`) VALUES
(1, 'Fakhri Adi Saputra', 'fakhrads', '$2y$12$YZRdXSYpOy2P5vwXcZaA2OR.ONSB7grpTnd0uPuGJkFpBOplRO1C.', 'JL. Sekeloa No.207', '081219043780', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nama_produk` VARCHAR(50) DEFAULT NULL,
  `desc_produk` VARCHAR(100) DEFAULT NULL,
  `stok` INT(5) DEFAULT NULL,
  `harga` FLOAT DEFAULT NULL,
  `id_kategori` VARCHAR(255) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` INT(5) NOT NULL,
  `nama_toko` VARCHAR(30) DEFAULT NULL,
  `alamat_toko` VARCHAR(50) DEFAULT NULL,
  `telp` VARCHAR(15) DEFAULT NULL,
  `nama_pemilik` VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `telp`, `nama_pemilik`) VALUES
(1, 'Juragan Kampung', 'Jl. Sekeloa Tengah No.207/152C', '081219043780', 'Fakhri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_nota` INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `total_harga` FLOAT DEFAULT NULL,
  `tgl_transaksi` DATE DEFAULT NULL,
  `id_pegawai` INT(20) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `no_nota` (`no_nota`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`no_nota`) REFERENCES `transaksi` (`no_nota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_produk` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
