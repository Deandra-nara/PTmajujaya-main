-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2026 at 11:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sales_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`, `created_at`) VALUES
(1, 'PT Maju Jaya', 'Jakarta', '081234567890', '2026-06-23 09:08:04'),
(2, 'CV Sukses Bersama', 'Bandung', '082345678901', '2026-06-23 09:08:04'),
(3, 'Toko Makmur', 'Tangerang', '083456789012', '2026-06-23 09:08:04'),
(4, 'PT Sumber Makmur', 'Jakarta', '081111111111', '2026-06-23 09:11:11'),
(5, 'CV Jaya Abadi', 'Bandung', '082222222222', '2026-06-23 09:11:11'),
(6, 'PT Berkah Sejahtera', 'Tangerang', '083333333333', '2026-06-23 09:11:11'),
(7, 'Toko Maju Terus', 'Bekasi', '084444444444', '2026-06-23 09:11:11'),
(8, 'PT Cahaya Nusantara', 'Bogor', '085555555555', '2026-06-23 09:11:11'),
(9, 'CV Global Mandiri', 'Depok', '086666666666', '2026-06-23 09:11:11'),
(10, 'PT Sentosa Jaya', 'Serang', '087777777777', '2026-06-23 09:11:11'),
(11, 'Toko Berkah', 'Cilegon', '088888888888', '2026-06-23 09:11:11'),
(12, 'PT Maju Bersama', 'Jakarta', '089999999999', '2026-06-23 09:11:11'),
(13, 'CV Nusantara', 'Bandung', '081234567890', '2026-06-23 09:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga`, `stok`, `created_at`) VALUES
(1, 'PRD001', 'Laptop ASUS', '8500000.00', 20, '2026-06-23 08:56:12'),
(2, 'PRD002', 'Printer Epson', '2500000.00', 15, '2026-06-23 08:56:12'),
(3, 'PRD003', 'Mouse Logitech', '150000.00', 50, '2026-06-23 08:56:12'),
(4, 'PRD004', 'Keyboard Mechanical', '350000.00', 40, '2026-06-23 08:56:12'),
(5, 'PRD005', 'Monitor LG 24 Inch', '2500000.00', 20, '2026-06-23 09:11:11'),
(6, 'PRD006', 'Laptop Lenovo Thinkpad', '9500000.00', 15, '2026-06-23 09:11:11'),
(7, 'PRD007', 'Flashdisk Sandisk 64GB', '120000.00', 50, '2026-06-23 09:11:11'),
(8, 'PRD008', 'Harddisk External 1TB', '850000.00', 25, '2026-06-23 09:11:11'),
(9, 'PRD009', 'Webcam Logitech C270', '350000.00', 30, '2026-06-23 09:11:11'),
(10, 'PRD010', 'Headset Gaming', '450000.00', 18, '2026-06-23 09:11:11'),
(11, 'PRD011', 'Mouse Wireless Logitech', '250000.00', 40, '2026-06-23 09:11:11'),
(12, 'PRD012', 'Keyboard Mechanical', '650000.00', 20, '2026-06-23 09:11:11'),
(13, 'PRD013', 'Printer Epson L3210', '2800000.00', 12, '2026-06-23 09:11:11'),
(14, 'PRD014', 'SSD Samsung 500GB', '950000.00', 30, '2026-06-23 09:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL,
  `kode_sales` varchar(20) NOT NULL,
  `nama_sales` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sales`, `kode_sales`, `nama_sales`) VALUES
(1, 'SLS001', 'Deandra Alika Putri'),
(2, 'SLS002', 'Nathania Reva'),
(3, 'SLS003', 'Muhammad Adi'),
(6, 'SLS006', 'Rina Septiani'),
(7, 'SLS007', 'Andi Saputra');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id_order` int(11) NOT NULL,
  `no_order` varchar(30) NOT NULL,
  `tanggal_order` datetime NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` enum('draft','dikirim','selesai','dibatalkan') DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id_order`, `no_order`, `tanggal_order`, `id_pelanggan`, `id_user`, `total_harga`, `status`) VALUES
(1, 'SO20260601001', '2026-06-01 10:00:00', 1, 2, '17000000.00', 'selesai'),
(2, 'SO20260602001', '2026-06-02 11:00:00', 2, 2, '2500000.00', 'dikirim'),
(3, 'SO20260603001', '2026-06-03 14:00:00', 3, 3, '300000.00', 'selesai'),
(4, 'SO20260610001', '2026-06-10 09:00:00', 1, 2, '5000000.00', 'selesai'),
(5, 'SO20260611001', '2026-06-11 10:30:00', 2, 2, '2500000.00', 'dikirim'),
(6, 'SO20260612001', '2026-06-12 14:00:00', 3, 3, '1200000.00', 'draft'),
(7, 'SO20260613001', '2026-06-13 13:15:00', 4, 2, '3500000.00', 'selesai'),
(8, 'SO20260614001', '2026-06-14 15:20:00', 5, 3, '4500000.00', 'dibatalkan'),
(9, 'SO20260615001', '2026-06-15 08:30:00', 6, 2, '2500000.00', 'selesai'),
(10, 'SO20260616001', '2026-06-16 10:15:00', 7, 3, '1200000.00', 'dikirim'),
(11, 'SO20260617001', '2026-06-17 14:45:00', 8, 2, '1800000.00', 'selesai'),
(12, 'SO20260618001', '2026-06-18 11:00:00', 9, 3, '3500000.00', 'draft'),
(13, 'SO20260619001', '2026-06-19 16:20:00', 10, 2, '4200000.00', 'selesai'),
(14, 'SO20260620001', '2026-06-20 09:00:00', 1, 5, '3200000.00', 'selesai'),
(15, 'SO20260620002', '2026-06-20 10:30:00', 2, 6, '1800000.00', 'selesai'),
(16, 'SO20260620003', '2026-06-20 13:00:00', 3, 7, '2500000.00', 'dikirim'),
(17, 'SO20260621001', '2026-06-21 08:15:00', 4, 5, '4500000.00', 'selesai'),
(18, 'SO20260621002', '2026-06-21 11:20:00', 5, 6, '900000.00', 'draft'),
(19, 'SO20260621003', '2026-06-21 15:40:00', 6, 7, '3800000.00', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_detail`
--

CREATE TABLE `sales_order_detail` (
  `id_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order_detail`
--

INSERT INTO `sales_order_detail` (`id_detail`, `id_order`, `id_produk`, `qty`, `harga`, `subtotal`) VALUES
(1, 1, 1, 2, '8500000.00', '17000000.00'),
(2, 2, 2, 1, '2500000.00', '2500000.00'),
(3, 3, 3, 2, '150000.00', '300000.00'),
(4, 1, 1, 1, '5000000.00', '5000000.00'),
(5, 2, 2, 1, '2500000.00', '2500000.00'),
(6, 3, 3, 10, '120000.00', '1200000.00'),
(7, 4, 4, 4, '875000.00', '3500000.00'),
(8, 5, 5, 10, '450000.00', '4500000.00'),
(9, 6, 6, 1, '2500000.00', '2500000.00'),
(10, 7, 7, 10, '120000.00', '1200000.00'),
(11, 8, 8, 2, '900000.00', '1800000.00'),
(12, 9, 9, 10, '350000.00', '3500000.00'),
(13, 10, 10, 6, '700000.00', '4200000.00'),
(14, 11, 1, 1, '3200000.00', '3200000.00'),
(15, 12, 3, 15, '120000.00', '1800000.00'),
(16, 13, 2, 1, '2500000.00', '2500000.00'),
(17, 14, 4, 5, '900000.00', '4500000.00'),
(18, 15, 7, 3, '300000.00', '900000.00'),
(19, 16, 5, 8, '475000.00', '3800000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('admin','sales','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `role`) VALUES
(1, 'admin1', '123456', 'Administrator', 'admin'),
(2, 'deandra', '123456', 'Deandra Alika Putri', 'sales'),
(3, 'nathania', '123456', 'Nathania Reva', 'sales'),
(4, 'manager1', '123456', 'Manager Penjualan', 'manager'),
(5, 'adi', '123456', 'Muhammad Adi', 'sales'),
(6, 'rina', '123456', 'Rina Septiani', 'sales'),
(7, 'andi', '123456', 'Andi Saputra', 'sales'),
(8, 'admin2', '123456', 'Admin 2', 'admin'),
(9, 'admin3', '123456', 'Admin 3', 'admin'),
(10, 'manager2', '123456', 'Manager marketing', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `sales_order_detail`
--
ALTER TABLE `sales_order_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sales_order_detail`
--
ALTER TABLE `sales_order_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
