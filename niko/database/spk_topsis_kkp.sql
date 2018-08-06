-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2018 pada 05.34
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_topsis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `level` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`, `level`) VALUES
('admin', 'admin', ''),
('budi', 'admin123', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `kode_karyawan` varchar(16) NOT NULL,
  `nik` varchar(10) DEFAULT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `total` double NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`kode_karyawan`, `nik`, `nama_karyawan`, `departemen`, `total`, `rank`) VALUES
('K03', '1.8103.005', 'SUPANGI', 'Maintenance Service', 0, 0),
('K02', '1.9508.003', 'HARYO DWIYHOGA', 'Maintenance Service', 0, 0),
('K01', '1.9500.013', 'KRISNOMURTHI', 'Maintenance Service', 0, 0),
('K04', '1.9411.006', 'RUSLAN', 'Maintenance Service', 0, 0),
('K05', '1.9412.007', 'ADAM MAULANA', 'Maintenance Service', 0, 0),
('K06', '1.9505.008', 'JAHRONI', 'Maintenance Service', 0, 0),
('K07', '1.8603.009', 'MOCHAMMAD TEGUH SAPUTRA', 'Maintenance Service', 0, 0),
('K08', '1.9102.010', 'ANTON SEPTANTO', 'Maintenance Service', 0, 0),
('K09', '1.9608.011', 'AGUS ADAM', 'Maintenance Service', 0, 0),
('K10', '1.7010.012', 'MUHAMMAD HAFID MARDIAN', 'Maintenance Service', 0, 0),
('K11', '1.7302.013', 'FEBRIAN RAMADAN', 'Maintenance Service', 0, 0),
('K12', '1.7309.014', 'ARGO WISNU WIWOHO', 'Maintenance Service', 0, 0),
('K13', '1.9503.015', 'BAGUS NARWANTO', 'Maintenance Service', 0, 0),
('K14', '1.9304.016', 'GALYH NUR FAUZI', 'Maintenance Service', 0, 0),
('K15', '1.8207.017', 'MUHAMMAD IQBAL', 'Maintenance Service', 0, 0),
('K16', '1.6909.018', 'HANDRI SURYANTO', 'Maintenance Service', 0, 0),
('K17', '2.9208.019', 'IMAM MUJIYONO', 'Maintenance Service', 0, 0),
('K18', '2.9602.020', 'SUSILO ADI SETYO NUGROHO', 'Maintenance Service', 0, 0),
('K19', '3.8207.021', 'RIZKY MAULANA HASAN', 'Maintenance Service', 0, 0),
('K20', '3.8908.022', 'DELIYANA BAITULLAH', 'Maintenance Service', 0, 0),
('K21', '3.9909.029', 'KEPIN ADWIAN', 'Maintenance Service', 0, 0),
('K22', '3.9406.032', 'WAWAN SANJAYA', 'Maintenance Service', 0, 0),
('K23', '3.8605.033', 'WAN FUJI LESMANA', 'Maintenance Service', 0, 0),
('K24', '3.9312.035', 'ODI HERMAWAN', 'Maintenance Service', 0, 0),
('K25', '3.8903.037', 'MUHAMMAD RIZAL', 'Maintenance Service', 0, 0),
('K26', '4.9312.043', 'SURIZKY', 'Maintenance Service', 0, 0),
('K27', '4.9108.045', 'SUGENG RIYADI', 'Maintenance Service', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `attribut` varchar(80) NOT NULL,
  `bobot` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `attribut`, `bobot`) VALUES
('C04', 'Pencapaian Target', 'benefit', 25),
('C03', 'Tanggung Jawab', 'benefit', 20),
('C01', 'Kehadiran', 'benefit', 30),
('C02', 'Kerjasama', 'benefit', 10),
('C05', 'Kepemimpinan', 'benefit', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai_karyawan`
--

CREATE TABLE `tb_nilai_karyawan` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(16) NOT NULL,
  `kode_karyawan` varchar(16) NOT NULL,
  `nilai` double NOT NULL,
  `periode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_nilai_karyawan`
--

INSERT INTO `tb_nilai_karyawan` (`id`, `kode_kriteria`, `kode_karyawan`, `nilai`, `periode_id`) VALUES
(156, 'C01', 'K01', 3, 25),
(157, 'C02', 'K01', 4, 25),
(158, 'C03', 'K01', 4, 25),
(159, 'C04', 'K01', 5, 25),
(160, 'C05', 'K01', 4, 25),
(161, 'C01', 'K02', 4, 25),
(162, 'C02', 'K02', 4, 25),
(163, 'C03', 'K02', 3, 25),
(164, 'C04', 'K02', 3, 25),
(165, 'C05', 'K02', 4, 25),
(166, 'C01', 'K03', 4, 25),
(167, 'C02', 'K03', 5, 25),
(168, 'C03', 'K03', 3, 25),
(169, 'C04', 'K03', 4, 25),
(170, 'C05', 'K03', 3, 25),
(171, 'C01', 'K04', 4, 25),
(172, 'C02', 'K04', 3, 25),
(173, 'C03', 'K04', 4, 25),
(174, 'C04', 'K04', 4, 25),
(175, 'C05', 'K04', 3, 25),
(176, 'C01', 'K05', 4, 25),
(177, 'C02', 'K05', 4, 25),
(178, 'C03', 'K05', 3, 25),
(179, 'C04', 'K05', 5, 25),
(180, 'C05', 'K05', 4, 25),
(181, 'C01', 'K06', 5, 25),
(182, 'C02', 'K06', 3, 25),
(183, 'C03', 'K06', 2, 25),
(184, 'C04', 'K06', 4, 25),
(185, 'C05', 'K06', 4, 25),
(186, 'C01', 'K07', 3, 25),
(187, 'C02', 'K07', 5, 25),
(188, 'C03', 'K07', 5, 25),
(189, 'C04', 'K07', 4, 25),
(190, 'C05', 'K07', 3, 25),
(191, 'C01', 'K08', 4, 25),
(192, 'C02', 'K08', 3, 25),
(193, 'C03', 'K08', 5, 25),
(194, 'C04', 'K08', 3, 25),
(195, 'C05', 'K08', 2, 25),
(196, 'C01', 'K09', 2, 25),
(197, 'C02', 'K09', 4, 25),
(198, 'C03', 'K09', 5, 25),
(199, 'C04', 'K09', 4, 25),
(200, 'C05', 'K09', 2, 25),
(201, 'C01', 'K10', 4, 25),
(202, 'C02', 'K10', 4, 25),
(203, 'C03', 'K10', 5, 25),
(204, 'C04', 'K10', 4, 25),
(205, 'C05', 'K10', 3, 25),
(206, 'C01', 'K11', 4, 25),
(207, 'C02', 'K11', 2, 25),
(208, 'C03', 'K11', 5, 25),
(209, 'C04', 'K11', 3, 25),
(210, 'C05', 'K11', 4, 25),
(211, 'C01', 'K12', 3, 25),
(212, 'C02', 'K12', 4, 25),
(213, 'C03', 'K12', 4, 25),
(214, 'C04', 'K12', 4, 25),
(215, 'C05', 'K12', 3, 25),
(216, 'C01', 'K13', 3, 25),
(217, 'C02', 'K13', 4, 25),
(218, 'C03', 'K13', 2, 25),
(219, 'C04', 'K13', 4, 25),
(220, 'C05', 'K13', 4, 25),
(221, 'C01', 'K14', 5, 25),
(222, 'C02', 'K14', 3, 25),
(223, 'C03', 'K14', 4, 25),
(224, 'C04', 'K14', 4, 25),
(225, 'C05', 'K14', 3, 25),
(226, 'C01', 'K15', 5, 25),
(227, 'C02', 'K15', 4, 25),
(228, 'C03', 'K15', 3, 25),
(229, 'C04', 'K15', 4, 25),
(230, 'C05', 'K15', 3, 25),
(231, 'C01', 'K16', 4, 25),
(232, 'C02', 'K16', 3, 25),
(233, 'C03', 'K16', 4, 25),
(234, 'C04', 'K16', 5, 25),
(235, 'C05', 'K16', 2, 25),
(236, 'C01', 'K17', 4, 25),
(237, 'C02', 'K17', 2, 25),
(238, 'C03', 'K17', 3, 25),
(239, 'C04', 'K17', 3, 25),
(240, 'C05', 'K17', 4, 25),
(241, 'C01', 'K18', 5, 25),
(242, 'C02', 'K18', 4, 25),
(243, 'C03', 'K18', 3, 25),
(244, 'C04', 'K18', 5, 25),
(245, 'C05', 'K18', 2, 25),
(246, 'C01', 'K19', 3, 25),
(247, 'C02', 'K19', 5, 25),
(248, 'C03', 'K19', 4, 25),
(249, 'C04', 'K19', 2, 25),
(250, 'C05', 'K19', 3, 25),
(251, 'C01', 'K20', 3, 25),
(252, 'C02', 'K20', 4, 25),
(253, 'C03', 'K20', 3, 25),
(254, 'C04', 'K20', 1, 25),
(255, 'C05', 'K20', 2, 25),
(256, 'C01', 'K21', 4, 25),
(257, 'C02', 'K21', 3, 25),
(258, 'C03', 'K21', 4, 25),
(259, 'C04', 'K21', 2, 25),
(260, 'C05', 'K21', 3, 25),
(261, 'C01', 'K22', 1, 25),
(262, 'C02', 'K22', 3, 25),
(263, 'C03', 'K22', 4, 25),
(264, 'C04', 'K22', 4, 25),
(265, 'C05', 'K22', 4, 25),
(266, 'C01', 'K23', 5, 25),
(267, 'C02', 'K23', 4, 25),
(268, 'C03', 'K23', 4, 25),
(269, 'C04', 'K23', 3, 25),
(270, 'C05', 'K23', 2, 25),
(271, 'C01', 'K24', 2, 25),
(272, 'C02', 'K24', 3, 25),
(273, 'C03', 'K24', 4, 25),
(274, 'C04', 'K24', 2, 25),
(275, 'C05', 'K24', 4, 25),
(276, 'C01', 'K25', 1, 25),
(277, 'C02', 'K25', 4, 25),
(278, 'C03', 'K25', 2, 25),
(279, 'C04', 'K25', 4, 25),
(280, 'C05', 'K25', 3, 25),
(281, 'C01', 'K26', 3, 25),
(282, 'C02', 'K26', 5, 25),
(283, 'C03', 'K26', 4, 25),
(284, 'C04', 'K26', 2, 25),
(285, 'C05', 'K26', 4, 25),
(286, 'C01', 'K27', 4, 25),
(287, 'C02', 'K27', 3, 25),
(288, 'C03', 'K27', 3, 25),
(289, 'C04', 'K27', 3, 25),
(290, 'C05', 'K27', 4, 25),
(321, 'C01', 'K01', 3, 28),
(322, 'C02', 'K01', 23, 28),
(323, 'C03', 'K01', 4, 28),
(324, 'C04', 'K01', 4, 28),
(325, 'C05', 'K01', 12, 28),
(326, 'C01', 'K02', 23, 28),
(327, 'C02', 'K02', 2, 28),
(328, 'C03', 'K02', 1, 28),
(329, 'C04', 'K02', 32, 28),
(330, 'C05', 'K02', 32, 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode`
--

CREATE TABLE `tb_periode` (
  `periode_id` int(11) NOT NULL,
  `nama_periode` varchar(255) NOT NULL,
  `keterangan` text,
  `tgl_periode` varchar(100) NOT NULL,
  `created_dt` datetime NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_periode`
--

INSERT INTO `tb_periode` (`periode_id`, `nama_periode`, `keterangan`, `tgl_periode`, `created_dt`, `status`) VALUES
(25, 'P01', 'Project Maintenance Service ', '01-01-2018 - 02-07-2018', '2018-07-15 17:53:32', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indeks untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`kode_karyawan`);

--
-- Indeks untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indeks untuk tabel `tb_nilai_karyawan`
--
ALTER TABLE `tb_nilai_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`periode_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_nilai_karyawan`
--
ALTER TABLE `tb_nilai_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  MODIFY `periode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
