-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 04:15 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_futsal_rasunasaid`
--

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` varchar(3) NOT NULL,
  `nama_identitas` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `rekening` text NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_identitas`, `alamat`, `no_telp`, `rekening`, `email`) VALUES
('00', 'RASUNA SAID FUTSAL ', 'Jl. H. R. Rasuna Said No.22, RT.2/RW.5, Karet Kuningan, Kecamatan Setiabudi, Kota Jakarta Selatan', '02152920765', '123456', 'rasunasaid@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(5) NOT NULL,
  `id_lapangan` varchar(5) NOT NULL,
  `nama_jadwal` varchar(20) NOT NULL,
  `remark` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_lapangan`, `nama_jadwal`, `remark`) VALUES
(1, '00', '06:00 - 07:00', 1),
(2, '00', '07:00 - 08:00', 1),
(3, '00', '08:00 - 09:00', 1),
(4, '00', '09:00 - 10:00', 1),
(5, '00', '10:00 - 11:00', 1),
(6, '00', '11:00 - 12:00', 1),
(8, '00', '13:00 - 14:00', 1),
(9, '00', '14:00 - 15:00', 1),
(11, '00', '16:00 - 17:00', 1),
(12, '00', '17:00 - 18:00', 1),
(14, '00', '19:00 - 20:00', 1),
(15, '00', '20:00 - 21:00', 1),
(16, '00', '21:00 - 22:00', 1),
(18, '01', '06:00 - 07:00', 1),
(19, '01', '07:00 - 08:00', 1),
(20, '01', '08:00 - 09:00', 1),
(21, '01', '09:00 - 10:00', 1),
(22, '01', '10:00 - 11:00', 1),
(23, '01', '11:00 - 12:00', 1),
(25, '01', '13:00 - 14:00', 1),
(26, '01', '14:00 - 15:00', 1),
(28, '01', '16:00 - 17:00', 1),
(31, '01', '19:00 - 20:00', 1),
(32, '01', '20:00 - 21:00', 1),
(33, '01', '21:00 - 22:00', 1),
(42, '03', '06:00 - 07:00', 1),
(43, '03', '07:00 - 08:00', 1),
(44, '03', '08:00 - 09:00', 1),
(45, '03', '09:00 - 10:00', 1),
(46, '03', '10:00 - 11:00', 1),
(47, '03', '11:00 - 12:00', 1),
(48, '03', '13:00 - 14:00', 1),
(49, '03', '14:00 - 15:00', 1),
(51, '03', '17:00 - 18:00', 1),
(52, '03', '19:00 - 20:00', 1),
(53, '03', '20:00 - 21:00', 1),
(54, '03', '21:00 - 22:00', 1),
(55, '02', '06:00 - 07:00', 1),
(56, '02', '07:00 - 08:00', 1),
(57, '02', '08:00 - 09:00', 1),
(58, '02', '09:00 - 10:00', 1),
(59, '02', '10:00 - 11:00', 1),
(60, '02', '11:00 - 12:00', 1),
(61, '02', '13:00 - 14:00', 1),
(62, '02', '14:00 - 15:00', 1),
(64, '02', '16:00 - 17:00', 1),
(65, '02', '19:00 - 20:00', 1),
(66, '02', '20:00 - 21:00', 1),
(67, '02', '21:00 - 22:00', 1),
(68, '04', '06:00 - 07:00', 1),
(69, '04', '07:00 - 08:00', 1),
(70, '04', '08:00 - 09:00', 1),
(71, '04', '09:00 - 10:00', 1),
(72, '04', '10:00 - 11:00', 1),
(73, '04', '11:00 - 12:00', 1),
(74, '04', '13:00 - 14:00', 1),
(75, '04', '14:00 - 15:00', 1),
(76, '04', '14:00 - 15:00', 1),
(78, '04', '16:00 - 17:00', 1),
(79, '04', '17:00 - 18:00', 1),
(80, '04', '19:00 - 20:00', 1),
(81, '04', '20:00 - 21:00', 1),
(82, '04', '21:00 - 22:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `keterangan`
--

CREATE TABLE `keterangan` (
  `id_keterangan` int(5) NOT NULL,
  `nama_keterangan` varchar(20) NOT NULL,
  `remark` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id_keterangan`, `nama_keterangan`, `remark`) VALUES
(1, 'Laki-Laki', 'JK'),
(2, 'Perempuan', 'JK'),
(3, 'SD', 'Pendidikan'),
(4, 'SMP', 'Pendidikan'),
(5, 'SMA', 'Pendidikan'),
(6, 'S1', 'Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(5) NOT NULL,
  `id_transaksi` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `asal_bank` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `asal_no_rekening` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `jumlah` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Menunggu','Diterima','Ditolak') COLLATE latin1_general_ci NOT NULL DEFAULT 'Menunggu',
  `dibaca` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_transaksi`, `asal_bank`, `asal_no_rekening`, `jumlah`, `pengirim`, `tanggal`, `status`, `dibaca`) VALUES
(1, '12121', 'BCA', '12121212', '200', 'Arman Wibowo', '2021-07-15', 'Menunggu', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` varchar(3) NOT NULL,
  `nama_lapangan` varchar(35) NOT NULL,
  `harga` int(10) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `harga`, `blokir`) VALUES
('00', 'Lapangan 1', 100000, 'N'),
('01', 'Lapangan 2', 100000, 'N'),
('02', 'Lapangan 3', 200000, 'N'),
('03', 'Lapangan 4', 200000, 'N'),
('04', 'Lapangan 5', 300000, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` int(5) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `blokir` enum('N','Y') DEFAULT 'N',
  `foto` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `foto_ktp` varchar(100) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `nama_lengkap`, `email`, `blokir`, `foto`, `level`, `tanggal`, `alamat`, `no_telp`, `foto_ktp`, `no_hp`) VALUES
(347, '21232f297a57a5a743894a0e4a801fc3', 'Mauly Tri Nando', 'admin@gmail.com', 'N', '14nando.jpg', 'admin', '', '', '', '', ''),
(376, 'e10adc3949ba59abbe56e057f20f883e', 'Arman Wibowo', 'armanwibowo@gmail.com', 'N', '', 'user', '2017-08-19', 'Komplek Pomad No 10 RT 05 RW 06 Kalibata, Pancoran', '0818956973', '96arman wibowo.jpg', ''),
(379, 'e10adc3949ba59abbe56e057f20f883e', 'Budi Wilaksono', 'budiwilaksono@gmail.com', 'N', '', 'user', '2019-01-31', 'Jl. Bangka II Gg. VII RT 014 RW 01 Pela Mampang', '08189569773', '95budi.jpg', ''),
(380, 'e10adc3949ba59abbe56e057f20f883e', 'Ari Kamandhanu', 'arikamandhanu@gmail.com', 'N', '', 'user', '2021-07-15', 'Jl. Cipinang Muara II RT 01 RW 15 Jatinegara', '085719198080', '34arikamandhanu.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(3) NOT NULL,
  `nama_pelanggan` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_hp`) VALUES
('00', 'Umum / Non Member', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian`
--

CREATE TABLE `pemakaian` (
  `id_pemakaian` int(5) NOT NULL,
  `id_lapangan` varchar(5) NOT NULL,
  `id_transaksi` varchar(10) NOT NULL,
  `tanggal_booking` varchar(10) NOT NULL,
  `id_jadwal` varchar(10) NOT NULL,
  `status` enum('Free','Book','Pakai') NOT NULL DEFAULT 'Book'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemakaian`
--

INSERT INTO `pemakaian` (`id_pemakaian`, `id_lapangan`, `id_transaksi`, `tanggal_booking`, `id_jadwal`, `status`) VALUES
(1, '01', 'YTDTOS', '2021-07-17', '31', 'Pakai'),
(2, '01', 'YTDTOS', '2021-07-17', '32', 'Pakai');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(3) NOT NULL,
  `reff_id` varchar(20) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `jumlah_bayar` int(10) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `reff_id`, `tanggal`, `jumlah_bayar`, `catatan`) VALUES
(1, 'YTDTOS', '2021-07-15', 200000, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `tgl_transaksi` varchar(11) NOT NULL,
  `id_pelanggan` varchar(3) NOT NULL,
  `tanggal_bermain` varchar(100) NOT NULL,
  `lama` int(5) NOT NULL,
  `lapangan` varchar(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `status` enum('Lunas','Belum Lunas') NOT NULL DEFAULT 'Belum Lunas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `id_pelanggan`, `tanggal_bermain`, `lama`, `lapangan`, `harga`, `total`, `dibayar`, `sisa`, `status`) VALUES
('YTDTOS', '2021-07-17', '376', '2021-07-17', 2, '01', 100000, 200000, 200000, 0, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `nama_waktu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu`
--

INSERT INTO `waktu` (`nama_waktu`) VALUES
('06:00 - 07:00'),
('07:00 - 08:00'),
('08:00 - 09:00'),
('09:00 - 10:00'),
('10:00 - 11:00'),
('11:00 - 12:00'),
('12:00 - 13:00'),
('13:00 - 14:00'),
('14:00 - 15:00'),
('15:00 - 16:00'),
('16:00 - 17:00'),
('17:00 - 18:00'),
('18:00 - 19:00'),
('19:00 - 20:00'),
('20:00 - 21:00'),
('21:00 - 22:00'),
('22:00 - 23:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pemakaian`
--
ALTER TABLE `pemakaian`
  ADD PRIMARY KEY (`id_pemakaian`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `username` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=381;

--
-- AUTO_INCREMENT for table `pemakaian`
--
ALTER TABLE `pemakaian`
  MODIFY `id_pemakaian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
