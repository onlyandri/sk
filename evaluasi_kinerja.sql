-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 05:33 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluasi_kinerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  `departemen` varchar(40) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama`, `jabatan`, `departemen`, `jenis_kelamin`) VALUES
(123456, 'takumi minamino', 'staff mobile developer', 'kehakiman', 'Laki-Laki'),
(14040230, 'Hyunjin Saputra', 'Sub Dept Head ICT', 'ICT', 'Laki-Laki'),
(14040234, 'Bae Suzy', 'Staf Web Programmer', 'ICT', 'Perempuan'),
(14040235, 'Lino Baskara', 'Help Desk', 'ICT', 'Laki-Laki'),
(14040236, 'Chandra Wijaya', 'Section Head', 'ICT', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(11) NOT NULL,
  `nama_kriteria` varchar(40) NOT NULL,
  `presentase` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `presentase`) VALUES
('K001', 'Pengetahuan Kerja', 15),
('K002', 'Pengembangan Pribadi', 15),
('K003', 'Sikap Kerja', 25),
('K004', 'Performa Hasil Kerja', 35),
('K005', 'Presensi Kehadiran', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `tgl_nilai` date NOT NULL,
  `jabatan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nik`, `tgl_nilai`, `jabatan`) VALUES
(25, 14040230, '2021-03-03', 'Sub Dept Head ICT'),
(26, 14040235, '2021-03-03', 'Help Desk'),
(27, 14040234, '2021-03-03', 'Staf Web Programmer'),
(28, 123456, '2021-03-03', 'staff mobile developer');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_detail`
--

CREATE TABLE `nilai_detail` (
  `id_detail` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `kode_subkriteria` varchar(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_detail`
--

INSERT INTO `nilai_detail` (`id_detail`, `id_nilai`, `kode_subkriteria`, `nilai`) VALUES
(268, 25, 'S001', 1),
(269, 25, 'S002', 4),
(270, 25, 'S003', 3),
(271, 25, 'S004', 4),
(272, 25, 'S005', 4),
(273, 25, 'S006', 5),
(274, 25, 'S007', 4),
(275, 25, 'S008', 4),
(276, 25, 'S009', 4),
(277, 25, 'S010', 4),
(278, 26, 'S001', 3),
(279, 26, 'S002', 1),
(280, 26, 'S003', 3),
(281, 26, 'S004', 3),
(282, 26, 'S005', 3),
(283, 26, 'S006', 2),
(284, 26, 'S007', 3),
(285, 26, 'S008', 3),
(286, 26, 'S009', 3),
(287, 26, 'S010', 3),
(288, 27, 'S001', 5),
(289, 27, 'S002', 5),
(290, 27, 'S003', 5),
(291, 27, 'S004', 5),
(292, 27, 'S005', 5),
(293, 27, 'S006', 5),
(294, 27, 'S007', 5),
(295, 27, 'S008', 5),
(296, 27, 'S009', 5),
(297, 27, 'S010', 5),
(298, 28, 'S001', 1),
(299, 28, 'S002', 3),
(300, 28, 'S003', 4),
(301, 28, 'S004', 5),
(302, 28, 'S005', 1),
(303, 28, 'S006', 4),
(304, 28, 'S007', 4),
(305, 28, 'S008', 4),
(306, 28, 'S009', 4),
(307, 28, 'S010', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `kode_subkriteria` varchar(11) NOT NULL,
  `kode_kriteria` varchar(11) NOT NULL,
  `subkriteria` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `factor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`kode_subkriteria`, `kode_kriteria`, `subkriteria`, `bobot`, `factor`) VALUES
('S001', 'K001', 'Taat dan berkomitmen', 4, 'Core'),
('S002', 'K001', 'Perencanaan Kerja', 3, 'Secondary'),
('S003', 'K002', 'Cara Penyelesaian Masalah', 3, 'Secondary'),
('S004', 'K002', 'Mampu Bekerja Sama', 4, 'Core'),
('S005', 'K003', 'Pencapain Kerja', 5, 'Core'),
('S006', 'K003', 'Proses individu', 4, 'secondary'),
('S007', 'K004', 'Pencapaian Target', 5, 'Core'),
('S008', 'K004', 'Tingkat Kepuasan Pelanggan', 4, 'Secondary'),
('S009', 'K005', 'Permisi', 3, 'Core'),
('S010', 'K005', 'Ijin Keluar/ Terlambat/ Pulang (IKTP)', 2, 'Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, 'Bae Suzy', 'suzy', '78b421309e310f1950b83b418b1ebc04', 'Penilai'),
(3, 'wahyu', 'wahyu', '32c9e71e866ecdbc93e497482aa6779f', 'Penilai'),
(6, 'Lino Baskara', 'lino', '97715b142669a39eef883791f5338998', 'Admin'),
(7, 'Hyunjin Saputra', 'haje', 'c24f65ff4c0d1f4912c182a501779db8', 'Penilai'),
(8, 'Farhan', 'han', '83832391027a1f2f4d46ef882ff3a47d', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `nilai_detail`
--
ALTER TABLE `nilai_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_nilai` (`id_nilai`),
  ADD KEY `kode_subkriteria` (`kode_subkriteria`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`kode_subkriteria`),
  ADD KEY `kode_kriteria` (`kode_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `nilai_detail`
--
ALTER TABLE `nilai_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `karyawan` (`nik`);

--
-- Constraints for table `nilai_detail`
--
ALTER TABLE `nilai_detail`
  ADD CONSTRAINT `nilai_detail_ibfk_1` FOREIGN KEY (`id_nilai`) REFERENCES `nilai` (`id_nilai`),
  ADD CONSTRAINT `nilai_detail_ibfk_2` FOREIGN KEY (`kode_subkriteria`) REFERENCES `subkriteria` (`kode_subkriteria`);

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriteria` (`kode_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
