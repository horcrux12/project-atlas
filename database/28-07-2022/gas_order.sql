-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 04:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gas_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `harga`, `deleted`) VALUES
(1, 'Gas Elpiji 3 Kg', 896, 50000, 0),
(2, 'Gas Elpiji 12 Kg', 1427, 120000, 0),
(3, 'Gas Bright 12 Kg', 22, 130000, 1),
(4, 'Gas Ease 9 Kg', 1930, 80000, 0),
(5, 'Gas Ease 12 Kg', 600, 125000, 0),
(6, 'Gas Bright 9 Kg', 100, 82000, 0),
(7, 'Gas Bright 3 Kg', 0, 48000, 1),
(8, 'Gas Ease 3 Kg', 150, 45000, 0),
(9, 'Test', 0, 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggan`
--

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pelanggan`
--

INSERT INTO `data_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`) VALUES
(1, 'Warung Jambu Biji', 'Alamat Warung Jambu'),
(2, 'Warung Jambu Air', 'alamat warung jambu air'),
(3, 'Warung Nasi', 'Alamat Warung Nasi'),
(4, 'Warung Mie Indomie', 'Alamat warung mie Indomie'),
(5, 'Toko Ucok', 'Alamat Toko Ucok');

-- --------------------------------------------------------

--
-- Table structure for table `data_pembelian`
--

CREATE TABLE `data_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('Sedang Proses','Menunggu Konfirmasi Pembayaran','Ditolak','Menunggu Pembayaran','Selesai','Menunggu Konfirmasi') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `tanggal_pembelian` datetime NOT NULL,
  `tanggal_persetujuan` datetime NOT NULL,
  `pesan` varchar(250) NOT NULL,
  `bukti_pembayaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pembelian`
--

INSERT INTO `data_pembelian` (`id_pembelian`, `id_user`, `status`, `tanggal_pembelian`, `tanggal_persetujuan`, `pesan`, `bukti_pembayaran`) VALUES
(1, 2, 'Selesai', '2022-07-08 19:04:52', '2022-07-09 15:13:31', '', NULL),
(2, 2, 'Ditolak', '2022-07-08 20:27:25', '2022-07-09 21:24:07', 'Males ah', NULL),
(4, 4, 'Selesai', '2022-07-08 20:46:15', '2022-07-11 09:02:49', '', NULL),
(6, 4, 'Menunggu Pembayaran', '2022-07-08 21:55:46', '2022-07-15 11:15:48', '', NULL),
(7, 2, 'Selesai', '2022-07-09 19:55:13', '2022-07-15 12:46:11', '', 'download.jfif'),
(8, 2, 'Menunggu Konfirmasi', '2022-07-15 07:54:43', '0000-00-00 00:00:00', '', NULL),
(14, 2, 'Selesai', '2022-07-28 09:37:40', '2022-07-28 09:38:04', '', 'Untitled.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_barang`
--

CREATE TABLE `detail_transaksi_barang` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi_barang`
--

INSERT INTO `detail_transaksi_barang` (`id_detail_transaksi`, `id_transaksi`, `id_barang`, `jumlah`) VALUES
(1, 1, 1, 233),
(2, 2, 1, 33),
(3, 3, 2, 23),
(4, 4, 1, 500),
(5, 4, 2, 500),
(6, 5, 4, 500),
(7, 5, 5, 400),
(8, 6, 1, 150),
(9, 6, 4, 450),
(10, 6, 5, 200),
(11, 7, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_pembelian`
--

CREATE TABLE `keranjang_pembelian` (
  `id_keranjang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `jumlah_disetujui` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang_pembelian`
--

INSERT INTO `keranjang_pembelian` (`id_keranjang`, `id_barang`, `id_pembelian`, `jumlah_pembelian`, `jumlah_disetujui`) VALUES
(1, 2, 1, 100, 15),
(2, 4, 1, 50, 20),
(3, 3, 2, 20, 0),
(4, 7, 2, 25, 0),
(5, 3, 3, 3, 0),
(6, 4, 3, 5, 0),
(7, 6, 3, 2, 0),
(8, 2, 4, 23, 23),
(9, 1, 5, 10, 0),
(10, 2, 5, 12, 0),
(11, 2, 6, 23, 23),
(12, 1, 6, 22, 22),
(13, 1, 7, 20, 20),
(14, 2, 7, 25, 25),
(15, 2, 8, 12, 0),
(26, 2, 14, 50, 50),
(27, 4, 14, 20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id_notif` int(11) NOT NULL,
  `notif_from` int(11) NOT NULL,
  `notif_to` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `status` enum('Unread','Read') NOT NULL DEFAULT 'Unread',
  `pesan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id_notif`, `notif_from`, `notif_to`, `id_pembelian`, `status`, `pesan`) VALUES
(1, 2, 1, 7, 'Read', 'Pembelian dari Warung Jambu Air'),
(2, 1, 2, 2, 'Unread', 'Pembelian Tidak Disetujui'),
(3, 1, 4, 4, 'Unread', 'Pembelian Disetujui'),
(4, 2, 1, 8, 'Unread', 'Pembelian dari Warung Jambu Air'),
(5, 1, 4, 6, 'Unread', 'Pembelian Disetujui'),
(6, 1, 2, 7, 'Unread', 'Pembelian Menunggu Pembayaran'),
(7, 2, 1, 11, 'Unread', 'Pembelian dari Warung Jambu Air'),
(8, 2, 1, 12, 'Unread', 'Pembelian dari Warung Jambu Air'),
(9, 2, 16, 12, 'Unread', 'Pembelian dari Warung Jambu Air'),
(10, 2, 17, 12, 'Unread', 'Pembelian dari Warung Jambu Air'),
(11, 2, 1, 13, 'Unread', 'Pembelian dari Warung Jambu Air'),
(12, 2, 16, 13, 'Unread', 'Pembelian dari Warung Jambu Air'),
(13, 2, 17, 13, 'Unread', 'Pembelian dari Warung Jambu Air'),
(14, 2, 1, 14, 'Unread', 'Pembelian dari Warung Jambu Air'),
(15, 2, 16, 14, 'Unread', 'Pembelian dari Warung Jambu Air'),
(16, 2, 17, 14, 'Unread', 'Pembelian dari Warung Jambu Air'),
(17, 1, 2, 14, 'Unread', 'Pembelian Menunggu Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang`
--

CREATE TABLE `transaksi_barang` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `status_transaksi` enum('Penambahan','Pengurangan') DEFAULT NULL,
  `nomor_polisi` varchar(12) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `nomor_so_sa` varchar(15) NOT NULL,
  `nomor_do` varchar(15) NOT NULL,
  `nomor_shipment` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_barang`
--

INSERT INTO `transaksi_barang` (`id_transaksi`, `tanggal_transaksi`, `status_transaksi`, `nomor_polisi`, `nama_pengirim`, `nomor_so_sa`, `nomor_do`, `nomor_shipment`) VALUES
(1, '2022-07-15 00:00:00', 'Penambahan', 't213214', 'Siapa', '973281921', '264217836217', '7289173821'),
(2, '2022-07-15 00:00:00', 'Penambahan', 'dd22567', 'Test ngirri', '5367235', '536732', '53627253'),
(3, '2022-07-15 00:00:00', 'Penambahan', 'coba tanggal', 'coba tanggal', 'coba tanggal', 'coba tanggal', 'coba tangg'),
(4, '2022-06-01 00:00:00', 'Penambahan', 'B562665II', 'Pertamini', '32214214213', '21214421321', '2313212421'),
(5, '2022-06-23 00:00:00', 'Penambahan', 'B 5772881 I', 'Pertamini', '6672181', '5621751', '667218612'),
(6, '2022-05-05 00:00:00', 'Penambahan', 'B66721881', 'Pertamax Gan', '2728191', 'jjdwkao112', '272782399'),
(7, '2022-07-28 00:00:00', 'Penambahan', 'Test', 'Test', 'Test', 'Test', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `status` enum('Non-Aktif','Aktif') NOT NULL DEFAULT 'Non-Aktif',
  `nama` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_pelanggan`, `status`, `nama`, `level`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Aktif', 'Admin', 1),
(2, 'warungjambu', 'e10adc3949ba59abbe56e057f20f883e', 2, 'Aktif', 'Warung Jambu Air', 2),
(3, 'warungnasi', 'e10adc3949ba59abbe56e057f20f883e', 3, 'Aktif', 'Warung Nasi', 2),
(4, 'warmindo', 'e10adc3949ba59abbe56e057f20f883e', 4, 'Aktif', 'Warung Mie Indomie', 2),
(5, 'tokoucok', 'e10adc3949ba59abbe56e057f20f883e', 5, 'Aktif', 'Toko Ucok', 2),
(16, 'admin4', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 'Aktif', 'Admin Test 3', 1),
(17, 'admintest', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Aktif', 'Test', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `data_pembelian`
--
ALTER TABLE `data_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `detail_transaksi_barang`
--
ALTER TABLE `detail_transaksi_barang`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indexes for table `keranjang_pembelian`
--
ALTER TABLE `keranjang_pembelian`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uq_user_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_pembelian`
--
ALTER TABLE `data_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_transaksi_barang`
--
ALTER TABLE `detail_transaksi_barang`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `keranjang_pembelian`
--
ALTER TABLE `keranjang_pembelian`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
