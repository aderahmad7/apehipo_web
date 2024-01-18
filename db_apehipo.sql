-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 12, 2023 at 04:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apehipo`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id` varchar(50) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `qty` int(50) NOT NULL,
  `id_order` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id`, `id_produk`, `harga`, `qty`, `id_order`) VALUES
('D002', 'P021', 22000, 1, 'O002'),
('D003', 'P020', 20000, 1, 'O003');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` varchar(50) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `qty` int(50) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_produk`, `harga`, `qty`, `id_transaksi`) VALUES
('S002', 'P021', 22000, 1, 'A002'),
('S003', 'P020', 20000, 1, 'A003');

-- --------------------------------------------------------

--
-- Table structure for table `kebun`
--

CREATE TABLE `kebun` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_petani` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id`, `id_user`, `nama`, `no_telpon`, `alamat`, `foto`) VALUES
('K002', 'U006', 'Tasyalia Fahrina', '083159236448', 'Jalan Banjarbaru 3 Banjarbaru, RT 3 RW 2 Kalimantan Selatan', '1695025183_7697f42586e5b54ad6f7.jpg'),
('K003', 'U008', 'Muhammad Nazar Gunawan', '083159236448', 'Jalan Banjarbaru Raya', '1696813472_63385540d25e0fa50da6.png');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `pesan` varchar(50) NOT NULL,
  `detail_pesan` text NOT NULL,
  `id_penerima` varchar(50) NOT NULL,
  `id_pengirim` varchar(50) NOT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `date_time`, `pesan`, `detail_pesan`, `id_penerima`, `id_pengirim`, `status`) VALUES
('N002', '2023-09-29 06:28:23', 'Pesanan baru dengan id: O002', 'Segera proses pesanan baru dari pelanggan ya!', 'U007', 'U006', 'true'),
('N005', '2023-10-10 02:19:28', 'Pesanan baru dengan id: O002', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N006', '2023-10-10 02:23:36', 'Pesanan baru dengan id: O003', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N007', '2023-10-10 02:30:26', 'Pesanan baru dengan id: O004', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N008', '2023-10-11 21:37:39', 'Pesanan baru dengan id: O006', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N009', '2023-10-11 22:12:03', 'Pesanan baru dengan id: O007', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N012', '2023-10-11 22:16:37', 'Pesanan dengan id: O007', 'Pesanan sudah diterima pelanggan/pembeli.', 'U005', 'U006', 'false'),
('N013', '2023-10-12 07:33:24', 'Pesanan baru dengan id: O006', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N014', '2023-10-12 09:18:31', 'Pesanan baru dengan id: O002', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N015', '2023-10-12 09:19:59', 'Pesanan dengan id: O002', 'Pesanan anda sedang diproses oleh penjual/toko', 'U006', 'U005', 'true'),
('N016', '2023-10-12 09:26:36', 'Pesanan baru dengan id: O003', 'Segera proses pesanan baru dari pelanggan ya!', 'U005', 'U006', 'false'),
('N017', '2023-10-12 09:26:59', 'Pesanan dengan id: O003', 'Pesanan anda sedang diproses oleh penjual/toko', 'U006', 'U005', 'true'),
('N018', '2023-10-12 09:27:37', 'Pesanan dengan id: O003', 'Pesanan siap untuk diantar petani.', 'U006', 'U005', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `petani`
--

CREATE TABLE `petani` (
  `id` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petani`
--

INSERT INTO `petani` (`id`, `id_user`, `nama`, `no_telpon`, `no_rekening`, `alamat`, `foto`) VALUES
('T002', 'U005', 'Muhammad Bashir Hanafi', '083159236448', '12243534232', 'Jalan Banjarbaru asflkasmflskdmfldsmf afkapskf\';askf aksf;askf skfap\'oekf', '1695025238_1d95e2f13de2537a42e5.jpg'),
('T003', 'U007', 'Muhammad Ramadhan Alghifari', '083159236448', '1245135689', 'Jalan Banjarbaru', '1692456913_0091f030a4aff25d18ec.jpg'),
('T004', 'U009', 'Muhammad Alif Fadhilah', '083159236449', '446618186613', 'Jalan Banjarbaru 12', NULL),
('T005', 'U010', 'Ahmad Tajali', '083159236448', '16534649796', 'Jalan Banjarbaru Kalimantan Selatan ', NULL),
('T006', 'U011', 'Raidra Zeniananto', '083159236449', '5646461949', 'Jalan Banjarbaru Raya ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `kode` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_user` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`kode`, `nama`, `jenis`, `harga`, `stok`, `deskripsi`, `foto`, `status`, `id_user`) VALUES
('B012', 'Seledri 1kg ga tuh', 'Sayuran', 20000, 40, 'Seledri adalah terna kecil, kurang dari 1m tingginya. Daun tersusun gemuk dengan tangkai pendek. Tangkai ini pada kultivar tertentu dapat sangat besar', '1692243559_627b6ee53e5075eee769.png', 'tampil', '0001'),
('P018', 'Selada 1/2kg', 'Sayuran', 12000, 12, 'Selada ini adalah hasil dari perkebunan tanpa pupuk', '1696814780_500d3511b7eae0820ea8.jpg', 'tampil', 'U005'),
('P019', 'Pakcoy 1/2kg', 'Sayuran', 14000, 12, 'Pakcoy ini adalah hasil dari perkebunan tanpa pupuk', '1696814983_ea9fffee4d489b110baf.jpg', 'tampil', 'U005'),
('P020', 'Pakcoy 1kg', 'Sayuran', 20000, 10, 'pakcoy ini adalah hasil dari perkebunan dan pertanian ', '1696815202_bbdd5de16ed038171f3c.jpg', 'tampil', 'U005'),
('P021', 'Selada 1kg', 'Sayuran', 22000, 4, 'Selada ini adalah hasil dari perkebunan dan pertanian ', '1696815291_5ab880d04abebcd6b195.jpg', 'tampil', 'U005'),
('P022', 'Apel 1/2kg', 'Buah', 40000, 20, 'Apel ini adalah hasil dari perkebunan menarik', '1696815853_ec21bc081f08127b60f9.jpg', 'tampil', 'U005'),
('P023', 'Apel 1kg', 'Buah', 60000, 12, 'Apel ini adalah hasil dari perkebunan dan pertanian sangat menarik', '1696816158_5d55aac530d1bedcdee5.jpg', 'tampil', 'U005'),
('P026', 'Apel 3kg', '', 50000, 12, 'Apel adalah buah hasil perkebunan ', '1697014102_8a96a1b084f1d05293f7.jpg', 'tampil', 'U005'),
('P027', 'Sawi 1/2kg', '', 12000, 12, 'Sawi adalah hasil perkebunan ', '1697015311_01ad3e154bab939a872c.jpg', 'arsip', 'U005');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL,
  `waktu_kedaluarsa` datetime DEFAULT NULL,
  `total_harga_produk` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `id_user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `datetime`, `waktu_kedaluarsa`, `total_harga_produk`, `status`, `bukti_pembayaran`, `id_user`) VALUES
('O002', '2023-10-12 09:13:30', '2023-10-12 11:13:30', 23000, 'sudah bayar', '1697073366_c789130cbd4ea6c36c7f.png', 'U006'),
('O003', '2023-10-12 09:24:39', '2023-10-12 11:24:39', 21000, 'sudah bayar', '1697073958_3535d7421187f665c49b.jpg', 'U006');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL,
  `total_harga_produk` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_order` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id`, `datetime`, `total_harga_produk`, `status`, `id_order`, `id_user`) VALUES
('A002', '2023-10-12 09:18:31', 23000, 'proses', 'O002', 'U006'),
('A003', '2023-10-12 09:26:36', 21000, 'antar', 'O003', 'U006');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `terakhir_login` datetime DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `terakhir_login`, `role`) VALUES
('U005', 'bashir12', 'bashir@gmail.com', '12345', NULL, 'petani'),
('U006', 'tasya12', 'tasya@gmail.com', '12345', NULL, 'konsumen'),
('U007', 'alghifari', 'alghifari@gmail.com', '12345', NULL, 'petani'),
('U008', 'nazar12', 'nazar@gmail.com', '12345', NULL, 'konsumen'),
('U009', 'alifba12', 'alifba@gmail.com', 'Alif123@', NULL, 'petani'),
('U010', 'tajali12', 'tajali12@gmail.com', 'Alifba123@', NULL, 'petani'),
('U011', 'araidra12', 'alifba12@gmail.com', 'Alifba123@', NULL, 'petani'),
('U012', 'admin', 'admin@gmail.com', 'AdminApehipo12', NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konsumen` (`id_penerima`),
  ADD KEY `id_petani` (`id_pengirim`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_pengirim` (`id_pengirim`);

--
-- Indexes for table `petani`
--
ALTER TABLE `petani`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `kode_kebun` (`id_user`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
