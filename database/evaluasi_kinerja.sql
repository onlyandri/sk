-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2021 at 07:42 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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
(21, 14040230, '2020-12-25', 'Sub Dept Head ICT'),
(22, 14040235, '2021-02-20', 'Help Desk');

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
(228, 21, 'S001', 5),
(229, 21, 'S002', 5),
(230, 21, 'S003', 4),
(231, 21, 'S004', 5),
(232, 21, 'S005', 4),
(233, 21, 'S006', 5),
(234, 21, 'S007', 4),
(235, 21, 'S008', 5),
(236, 21, 'S009', 4),
(237, 21, 'S010', 5),
(238, 22, 'S001', 4),
(239, 22, 'S002', 5),
(240, 22, 'S003', 5),
(241, 22, 'S004', 4),
(242, 22, 'S005', 5),
(243, 22, 'S006', 4),
(244, 22, 'S007', 5),
(245, 22, 'S008', 4),
(246, 22, 'S009', 5),
(247, 22, 'S010', 6);

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
('S006', 'K003', 'Proses individu', 4, 'Secondary'),
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
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nilai_detail`
--
ALTER TABLE `nilai_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

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
