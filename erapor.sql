-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2018 at 05:09 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `erapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `foto_admin` text,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `foto_admin`) VALUES
(1, 'admin', 'admin', 'Admin Satu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id_guru` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `jk_guru` int(1) NOT NULL,
  `foto_guru` text,
  `password_guru` text NOT NULL,
  `telp_guru` varchar(20) DEFAULT NULL,
  `alamat_guru` text,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nik`, `nama_guru`, `jk_guru`, `foto_guru`, `password_guru`, `telp_guru`, `alamat_guru`) VALUES
(1, 'nik1', 'Zxc Vbn', 1, NULL, 'nik1', NULL, NULL),
(2, 'nik2', 'Asd Fgh', 0, NULL, 'nik2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_mapel`
--

CREATE TABLE IF NOT EXISTS `jenis_mapel` (
  `id_jenis_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_mapel` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis_mapel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jenis_mapel`
--

INSERT INTO `jenis_mapel` (`id_jenis_mapel`, `nama_jenis_mapel`) VALUES
(1, 'Umum'),
(2, 'Kejuruan');

-- --------------------------------------------------------

--
-- Table structure for table `kd`
--

CREATE TABLE IF NOT EXISTS `kd` (
  `id_kd` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kd` varchar(50) NOT NULL,
  `urutan` int(5) NOT NULL,
  `semester` int(1) NOT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kd`),
  KEY `id_mapel` (`id_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelompok_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_kelompok_kelas` (`id_kelompok_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_kelompok_kelas`, `nama_kelas`) VALUES
(1, 1, 'X RPL 1'),
(2, 2, 'X TKJ 1'),
(3, 1, 'X RPL 2'),
(4, 2, 'X TKJ 2');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_kelas`
--

CREATE TABLE IF NOT EXISTS `kelompok_kelas` (
  `id_kelompok_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok_kelas` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kelompok_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kelompok_kelas`
--

INSERT INTO `kelompok_kelas` (`id_kelompok_kelas`, `nama_kelompok_kelas`) VALUES
(1, 'x RPL'),
(2, 'X TKJ');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE IF NOT EXISTS `kurikulum` (
  `id_kurikulum` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kurikulum` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kurikulum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id_kurikulum`, `nama_kurikulum`) VALUES
(1, 'K13');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `id_kurikulum` int(11) NOT NULL,
  `id_jenis_mapel` int(11) DEFAULT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `kkm` int(11) NOT NULL,
  PRIMARY KEY (`id_mapel`),
  KEY `id_kurikulum` (`id_kurikulum`),
  KEY `id_jenis_mapel` (`id_jenis_mapel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `id_kurikulum`, `id_jenis_mapel`, `nama_mapel`, `kkm`) VALUES
(1, 1, 1, 'Matematika', 75),
(2, 1, 1, 'Bahasa Inggris', 75),
(5, 1, 1, 'Bahasa Indonesia', 75),
(6, 1, 2, 'Pemrograman Dasar', 70),
(7, 1, 2, 'Jaringan Dasar', 70);

-- --------------------------------------------------------

--
-- Table structure for table `mapel_guru`
--

CREATE TABLE IF NOT EXISTS `mapel_guru` (
  `id_mapel_guru` int(11) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mapel_guru`),
  KEY `id_mapel` (`id_mapel`),
  KEY `id_guru` (`id_guru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mapel_guru`
--

INSERT INTO `mapel_guru` (`id_mapel_guru`, `id_mapel`, `id_guru`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mapel_kelas`
--

CREATE TABLE IF NOT EXISTS `mapel_kelas` (
  `id_mapel_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) DEFAULT NULL,
  `id_kelompok_kelas` int(11) NOT NULL,
  PRIMARY KEY (`id_mapel_kelas`),
  KEY `id_mapel` (`id_mapel`),
  KEY `id_kelompok_kelas` (`id_kelompok_kelas`),
  KEY `id_kelompok_kelas_2` (`id_kelompok_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mapel_kelas`
--

INSERT INTO `mapel_kelas` (`id_mapel_kelas`, `id_mapel`, `id_kelompok_kelas`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 2, 2),
(4, 5, 1),
(5, 6, 2),
(6, 6, 2),
(7, 7, 2),
(8, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `nilai_sikap` int(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  `kelas` text NOT NULL,
  `th_ajar` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_mapel` (`id_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kd`
--

CREATE TABLE IF NOT EXISTS `nilai_kd` (
  `id_nilai_kd` int(11) NOT NULL AUTO_INCREMENT,
  `id_nilai` int(11) NOT NULL,
  `id_kd` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai_kd`),
  KEY `id_nilai` (`id_nilai`),
  KEY `id_kd` (`id_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rumus`
--

CREATE TABLE IF NOT EXISTS `rumus` (
  `nilai_kd` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `id_semester` int(11) NOT NULL AUTO_INCREMENT,
  `id_nilai` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL,
  `urutan` int(5) NOT NULL,
  PRIMARY KEY (`id_semester`),
  KEY `id_nilai` (`id_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nisn` varchar(50) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` int(1) NOT NULL,
  `foto_siswa` text,
  `id_kelas` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `password` text NOT NULL,
  `th_kelulusan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_guru` (`id_guru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nis`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `jk`, `foto_siswa`, `id_kelas`, `id_guru`, `password`, `th_kelulusan`) VALUES
(1, 'nisn1', 'nis1', 'Abc Def', 'Malang', '2000-12-04', 1, NULL, 1, 2, 'nisn1', NULL),
(2, 'nisn2', 'nis2', 'Ghi Jkl', 'Surabaya', '1999-12-28', 0, NULL, 2, NULL, 'nisn2', NULL),
(7, 'nisn3', 'nis3', 'Mno Pqr', 'Bandung', '2017-12-04', 0, NULL, 1, NULL, 'nisn3', NULL),
(8, 'nisn4', 'nis4', 'Stu Vwx', 'Bogor', '2000-06-14', 1, NULL, 2, NULL, 'nisn4', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kd`
--
ALTER TABLE `kd`
  ADD CONSTRAINT `kd_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_kelompok_kelas`) REFERENCES `kelompok_kelas` (`id_kelompok_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`id_kurikulum`) REFERENCES `kurikulum` (`id_kurikulum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mapel_ibfk_2` FOREIGN KEY (`id_jenis_mapel`) REFERENCES `jenis_mapel` (`id_jenis_mapel`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `mapel_guru`
--
ALTER TABLE `mapel_guru`
  ADD CONSTRAINT `mapel_guru_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mapel_guru_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD CONSTRAINT `mapel_kelas_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mapel_kelas_ibfk_2` FOREIGN KEY (`id_kelompok_kelas`) REFERENCES `kelompok_kelas` (`id_kelompok_kelas`) ON DELETE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_kd`
--
ALTER TABLE `nilai_kd`
  ADD CONSTRAINT `nilai_kd_ibfk_1` FOREIGN KEY (`id_nilai`) REFERENCES `nilai` (`id_nilai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_kd_ibfk_2` FOREIGN KEY (`id_kd`) REFERENCES `kd` (`id_kd`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`id_nilai`) REFERENCES `nilai` (`id_nilai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
