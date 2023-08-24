-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 16, 2023 at 06:00 PM
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
  `foto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id`, `id_user`, `nama`, `no_telpon`, `alamat`, `foto`) VALUES
('K002', 'U006', 'Tasyalia Fajrina', '083159236448', 'Banjarbaru kalimantan selatan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `pesan` varchar(50) NOT NULL,
  `detail_pesan` text NOT NULL,
  `id_transaksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('T002', 'U005', 'Muhammad Bashir Hanafi', '083159236448', '121383281', 'Banjarbaru kalimantan selatan', NULL);

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
  `klasifikasi` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_user` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`kode`, `nama`, `jenis`, `harga`, `stok`, `deskripsi`, `foto`, `klasifikasi`, `status`, `id_user`) VALUES
('B005', 'Apel 5gr', 'buah', 50000, 10, 'Apel merupakan jenis buah-buahan, atau buah yang dihasilkan dari pohon apel. Buah apel biasanya berwarna merah kulitnya jika masak dan siap dimakan, tetapi bisa juga kulitnya berwarna hijau atau kuning. Kulit buahnya agak lembek dan daging buahnya keras.', '0', 'biasa', 'tampil', '0001'),
('B006', 'Apel 1kg', 'buah', 10000, 20, 'Apel merupakan jenis buah-buahan, atau buah yang dihasilkan dari pohon apel. Buah apel biasanya berwarna merah kulitnya jika masak dan siap dimakan, tetapi bisa juga kulitnya berwarna hijau atau kuning. Kulit buahnya agak lembek dan daging buahnya keras.', '0', 'penjualan eksklusif', 'tampil', '0002'),
('B007', 'Pakcoy 1kg', 'sayur', 15000, 10, 'lorem ipsum ', '0', 'penjualan eksklusif', 'arsip', '0001'),
('B009', 'Sawi 1kg', 'sayur', 15000, 5, 'Sawi adalah sekelompok tumbuhan dari marga Brassica yang dimanfaatkan daun atau bunganya sebagai bahan pangan (sayuran), baik segar maupun diolah. Sawi mencakup beberapa spesies Brassica yang kadang-kadang mirip satu sama lain', '0', 'penjualan eksklusif', 'arsip', '0001'),
('B011', 'Selada 1kg', 'sayur', 10000, 300, 'Selada (Lactuca sativa L.) merupakan sayuran daun yang berumur semusim dan termasuk dalam famili Compositae. Lactuca sativa L. tumbuh baik di dataran tinggi, pertumbuhan optimal di lahan subur yang banyak mengandung humus, pasir atau lumpur dengan pH tanah 5-6,5.', '0', 'penjualan terbaik', 'tampil', '0003'),
('B012', 'Seledri 1kg', 'sayur', 20000, 40, 'Seledri adalah terna kecil, kurang dari 1m tingginya. Daun tersusun gemuk dengan tangkai pendek. Tangkai ini pada kultivar tertentu dapat sangat besar', '0', 'penjualan terbaik', 'arsip', '0002'),
('B013', 'Pakcoy 1/2kg', 'sayur', 25000, 20, 'Pakcoy (Brassica rapa L.) adalah jenis tanaman sayur – sayuran yang termasuk keluarga Brassicaceae. Tumbuhan pakcoy berasal dari China dan telah dibudidayakan setelah abad ke-5 secara luas di China selatan dan China pusat serta Taiwan.', '0', 'penjualan terbaik', 'tampil', '0004'),
('B014', 'Pakcoy 1/4kg', 'sayur', 12000, 100, 'Pakcoy (Brassica rapa L.) adalah jenis tanaman sayur – sayuran yang termasuk keluarga Brassicaceae. Tumbuhan pakcoy berasal dari China dan telah dibudidayakan setelah abad ke-5 secara luas di China selatan dan China pusat serta Taiwan.', '0', 'sedang laris', 'arsip', '0006'),
('B015', 'Sawi 1/2kg', 'sayur', 5000, 20, 'Sawi adalah sekelompok tumbuhan dari marga Brassica yang dimanfaatkan daun atau bunganya sebagai bahan pangan (sayuran), baik segar maupun diolah. Sawi mencakup beberapa spesies Brassica yang kadang-kadang mirip satu sama lain', '0', 'sedang laris', 'arsip', '0007'),
('B016', 'Bayam 1kg', 'sayur', 8000, 100, 'Bayam merupakan salah satu jenis tanaman hijau yang paling banyak ditemui di Indonesia. Tanaman satu ini merupakan jenis sayuran yang mudah diolah untuk makanan sehari-hari mulai dari sup, pecel, gado-gado, sampai keripik. Amaranthus dubius ; biasa disebut juga dengan bayam petik.', '0', 'sedang laris', 'tampil', '0002'),
('B017', 'Kangkung 1kg', 'sayur', 22000, 200, 'Kangkung (Ipomoea spp.) merupakan salah satu sayuran daun yang paling populer di Asia Tenggara. Kangkung dikenal juga dengan \'swamp cabbage\', \'water convolvulus\', dan \'water spinach\'. Tanaman kangkung berbunga dengan warna yang beragam dari putih sampai merah muda, dan batangnya dari warna hijau sampai ungu.', '0', 'biasa', 'arsip', '0005');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` varchar(50) NOT NULL,
  `datetime` date NOT NULL,
  `total_harga_produk` double NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` varchar(50) NOT NULL,
  `datetime` date NOT NULL,
  `total_harga_produk` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_order` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('U001', 'petanibanjarbaru', 'petanibanjarbaru@gmail.com', 'petani12', NULL, 'petani'),
('U002', 'petanikandangan', 'petanikandangan@gmail.com', '12345', NULL, 'petani'),
('U003', 'nazar', 'nazar@gmail.com', 'nazar12', NULL, 'petani'),
('U004', 'ahmad', 'ahmad@gmail.com', '12345', NULL, 'konsumen'),
('U005', 'bashir12', 'bashir@gmail.com', '12345', NULL, 'petani'),
('U006', 'tasyalia12', 'tasya@gmail.com', '12345', NULL, 'konsumen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
