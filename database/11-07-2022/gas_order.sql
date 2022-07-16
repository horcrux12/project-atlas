-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 09:30 AM
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
  `id` int(11) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `stok`, `harga`) VALUES
(1, 'Gas Elpiji 3 Kg', 0, 50000),
(2, 'Gas Elpiji 12 Kg', 987, 120000),
(3, 'Gas Bright 12 Kg', 22, 130000),
(4, 'Gas Ease 9 Kg', 1000, 80000),
(5, 'Gas Ease 12 Kg', 0, 125000),
(6, 'Gas Bright 9 Kg', 100, 82000),
(7, 'Gas Bright 3 Kg', 0, 48000),
(8, 'Gas Ease 3 Kg', 150, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggan`
--

CREATE TABLE `data_pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pelanggan`
--

INSERT INTO `data_pelanggan` (`id`, `nama_pelanggan`, `alamat`) VALUES
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
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('Sedang Proses','Disetujui','Ditolak') NOT NULL DEFAULT 'Sedang Proses',
  `tanggal_pembelian` datetime NOT NULL,
  `tanggal_persetujuan` datetime NOT NULL,
  `pesan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pembelian`
--

INSERT INTO `data_pembelian` (`id`, `id_user`, `status`, `tanggal_pembelian`, `tanggal_persetujuan`, `pesan`) VALUES
(1, 2, 'Disetujui', '2022-07-08 19:04:52', '2022-07-09 15:13:31', ''),
(2, 2, 'Ditolak', '2022-07-08 20:27:25', '2022-07-09 21:24:07', 'Males ah'),
(4, 4, 'Disetujui', '2022-07-08 20:46:15', '2022-07-11 09:02:49', ''),
(6, 4, 'Sedang Proses', '2022-07-08 21:55:46', '0000-00-00 00:00:00', ''),
(7, 2, 'Sedang Proses', '2022-07-09 19:55:13', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_pembelian`
--

CREATE TABLE `keranjang_pembelian` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `jumlah_disetujui` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang_pembelian`
--

INSERT INTO `keranjang_pembelian` (`id`, `id_barang`, `id_pembelian`, `jumlah_pembelian`, `jumlah_disetujui`) VALUES
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
(11, 2, 6, 23, 0),
(12, 1, 6, 22, 0),
(13, 1, 7, 20, 0),
(14, 2, 7, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `notif_from` int(11) NOT NULL,
  `notif_to` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `status` enum('Unread','Read') NOT NULL DEFAULT 'Unread',
  `pesan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `notif_from`, `notif_to`, `id_pembelian`, `status`, `pesan`) VALUES
(1, 2, 1, 7, 'Read', 'Pembelian dari Warung Jambu Air'),
(2, 1, 2, 2, 'Unread', 'Pembelian Tidak Disetujui'),
(3, 1, 4, 4, 'Unread', 'Pembelian Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `status` enum('Non-Aktif','Aktif') NOT NULL DEFAULT 'Non-Aktif',
  `nama` varchar(250) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `id_pelanggan`, `status`, `nama`, `level`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Aktif', 'Admin', 1),
(2, 'warungjambu', 'e10adc3949ba59abbe56e057f20f883e', 2, 'Aktif', 'Warung Jambu Air', 2),
(3, 'warungnasi', 'e10adc3949ba59abbe56e057f20f883e', 3, 'Aktif', 'Warung Nasi', 2),
(4, 'warmindo', 'e10adc3949ba59abbe56e057f20f883e', 4, 'Aktif', 'Warung Mie Indomie', 2),
(5, 'tokoucok', 'e10adc3949ba59abbe56e057f20f883e', 5, 'Non-Aktif', 'Toko Ucok', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pembelian`
--
ALTER TABLE `data_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang_pembelian`
--
ALTER TABLE `keranjang_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_pembelian`
--
ALTER TABLE `data_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `keranjang_pembelian`
--
ALTER TABLE `keranjang_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
