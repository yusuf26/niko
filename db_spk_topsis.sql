-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2018 at 04:37 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_spk_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `level` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`, `level`) VALUES
('admin', 'admin', ''),
('budi', 'admin123', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE IF NOT EXISTS `tb_karyawan` (
  `kode_karyawan` varchar(16) NOT NULL,
  `nik` varchar(10) DEFAULT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` text,
  `total` double NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`kode_karyawan`, `nik`, `nama_karyawan`, `departemen`, `total`, `rank`) VALUES
('K01', '', 'PT. XYZ', 'Jl. Asia Afrika No.27', 0, 0),
('K02', '', 'Tes', 'tess', 0, 0),
('K03', '', 'as', 'ddd', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE IF NOT EXISTS `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` decimal(10,4) NOT NULL,
  `parent` varchar(16) NOT NULL,
  `attribut` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot`, `parent`, `attribut`) VALUES
('A', 'Quality', '0.1403', '0', ''),
('A.1', 'Tingkat Kecacatan', '0.5897', 'A', NULL),
('A.2', 'Kemampuan memberikan kualitas yang konsisten', '0.4043', 'A', ''),
('A.3', 'Kelengkapan dokumen pengecekan', '0.0060', 'A', ''),
('B', 'Cost', '0.1226', '0', ''),
('B.1', 'Harga penawaran', '0.4914', 'B', ''),
('B.2', 'Cara pembayaran', '0.1431', 'B', ''),
('B.3', 'Negosiasi', '0.3655', 'B', ''),
('C', 'Delivery', '0.0356', '0', ''),
('C.1', 'Jumlah pengiriman', '0.2366', 'C', ''),
('C.2', 'Waktu pengiriman', '0.3961', 'C', ''),
('C.3', 'Biaya transportasi', '0.0852', 'C', ''),
('C.4', 'Frekuensi pengiriman', '0.2822', 'C', ''),
('D', 'Flexibility', '0.1093', '0', ''),
('D.1', 'Kemudahan penambahan atau pengurangan jumlah pemesanan', '0.7087', 'D', ''),
('D.2', 'Kemudahan perubahan waktu pengiriman', '0.2913', 'D', ''),
('E', 'Responsiveness', '0.0679', '0', ''),
('E.1', 'Kemudahan penggantian produk cacat', '0.6866', 'E', ''),
('E.2', 'Kecepatan dalam menanggap keinginan pelanggan', '0.3134', 'E', ''),
('F', 'Warranties and claim policies', '0.1230', '0', ''),
('F.1', 'Memberikan jaminan atau garansi terhadap barang', '0.7452', 'F', ''),
('F.2', 'Dapat memberikan bantuan dalam keadaan darurat', '0.2548', 'F', ''),
('G', 'Performance history', '0.0505', '0', ''),
('G.1', 'Kemampuan menjaga kesepakatan', '0.3700', 'G', ''),
('G.2', 'Kemampuan pemenuhan terhadap jadwal yang telah dijadwalkan', '0.2217', 'G', ''),
('G.3', 'Kemampuan pemenuhan terhadap jumlah pemesanan', '0.4083', 'G', ''),
('H', 'Communication system', '0.0174', '0', ''),
('H.1', 'Tingkat konsistensi terhadap pertukaran informasi', '1.0000', 'H', ''),
('I', 'Technical capability', '0.0395', '0', ''),
('I.1', 'Fasilitas permesinan produksi pemasok', '1.0000', 'I', ''),
('J', 'Management and organization', '0.0897', '0', ''),
('J.1', 'Kelengkapan dokumen perusahaan', '0.4013', 'J', ''),
('J.2', 'Kelengkapan dokumen penawaran barang', '0.1497', 'J', ''),
('J.3', 'Sertifikasi', '0.4490', 'J', ''),
('K', 'Geographical location', '0.0848', '0', ''),
('K.1', 'Jarak pemasok dengan perusahaan', '1.0000', 'K', ''),
('L', 'Repair service', '0.1194', '0', ''),
('L.1', 'Kemudahan untuk dihubungi', '0.2319', 'L', ''),
('L.2', 'Kemampuan memberikan informasi secara jelas dan mudah dimengerti', '0.1096', 'L', ''),
('L.3', 'Kecepatan dalam hal menanggapi permintaan pelanggan', '0.3005', 'L', ''),
('L.4', 'Cepat tanggap dalam menyelesaikan keluhan pelanggan', '0.3581', 'L', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_karyawan`
--

CREATE TABLE IF NOT EXISTS `tb_nilai_karyawan` (
`id` int(11) NOT NULL,
  `kode_kriteria` varchar(16) NOT NULL,
  `kode_karyawan` varchar(16) NOT NULL,
  `nilai` double NOT NULL,
  `periode_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_periode`
--

CREATE TABLE IF NOT EXISTS `tb_periode` (
`periode_id` int(11) NOT NULL,
  `nama_periode` varchar(255) NOT NULL,
  `keterangan` text,
  `tgl_periode` varchar(100) NOT NULL,
  `created_dt` datetime NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_periode`
--

INSERT INTO `tb_periode` (`periode_id`, `nama_periode`, `keterangan`, `tgl_periode`, `created_dt`, `status`) VALUES
(1, 'P01', 'Roll Coil (CYK275KB)', '31-01-2018 - 31-07-2018', '2018-07-31 16:09:21', 0),
(2, 'P02', 'asd', '03-02-2018 - 03-08-2018', '2018-08-03 04:49:40', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
 ADD PRIMARY KEY (`user`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
 ADD PRIMARY KEY (`kode_karyawan`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
 ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_nilai_karyawan`
--
ALTER TABLE `tb_nilai_karyawan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_periode`
--
ALTER TABLE `tb_periode`
 ADD PRIMARY KEY (`periode_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_nilai_karyawan`
--
ALTER TABLE `tb_nilai_karyawan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `tb_periode`
--
ALTER TABLE `tb_periode`
MODIFY `periode_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
