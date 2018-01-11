-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11 Jan 2018 pada 17.28
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erapor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `foto_admin` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `foto_admin`) VALUES
(1, 'admin', 'admin', 'Admin Satu', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `jk_guru` int(1) NOT NULL,
  `foto_guru` text,
  `password_guru` text NOT NULL,
  `telp_guru` varchar(20) DEFAULT NULL,
  `alamat_guru` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nik`, `nama_guru`, `jk_guru`, `foto_guru`, `password_guru`, `telp_guru`, `alamat_guru`) VALUES
(1, 'nik1', 'Zxc Vbn', 1, NULL, 'nik1', '09767', 'rfghj'),
(2, 'nik2', 'Asd Fgh', 0, NULL, 'nik2', '00796759', 'rhvjbknm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_mapel`
--

CREATE TABLE `jenis_mapel` (
  `id_jenis_mapel` int(11) NOT NULL,
  `nama_jenis_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_mapel`
--

INSERT INTO `jenis_mapel` (`id_jenis_mapel`, `nama_jenis_mapel`) VALUES
(1, 'Umum'),
(2, 'Kejuruan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kd`
--

CREATE TABLE `kd` (
  `id_kd` int(11) NOT NULL,
  `nama_kd` varchar(50) NOT NULL,
  `urutan` int(5) NOT NULL,
  `semester` int(1) NOT NULL,
  `id_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kd`
--

INSERT INTO `kd` (`id_kd`, `nama_kd`, `urutan`, `semester`, `id_mapel`) VALUES
(3, 'teks naratif', 1, 2, 5),
(4, 'jenis kata', 2, 2, 5),
(5, 'announcement', 1, 1, 2),
(6, 'narative', 2, 1, 2),
(7, 'descriptive', 1, 2, 2),
(8, 'procedure', 2, 2, 2),
(9, 'report', 3, 2, 2),
(10, 'puisi', 1, 1, 5),
(11, 'majas', 2, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_kelompok_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_kelompok_kelas`, `nama_kelas`) VALUES
(1, 1, 'X RPL 1'),
(2, 2, 'X TKJ 1'),
(3, 1, 'X RPL 2'),
(4, 2, 'X TKJ 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id_kelas_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `th_ajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id_kelas_siswa`, `id_siswa`, `id_kelas`, `th_ajar`) VALUES
(1, 1, 1, 2017),
(2, 2, 1, 2017);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_kelas`
--

CREATE TABLE `kelompok_kelas` (
  `id_kelompok_kelas` int(11) NOT NULL,
  `nama_kelompok_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelompok_kelas`
--

INSERT INTO `kelompok_kelas` (`id_kelompok_kelas`, `nama_kelompok_kelas`) VALUES
(1, 'X RPL'),
(2, 'X TKJ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id_kurikulum` int(11) NOT NULL,
  `nama_kurikulum` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kurikulum`
--

INSERT INTO `kurikulum` (`id_kurikulum`, `nama_kurikulum`) VALUES
(1, 'K13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `id_kurikulum` int(11) NOT NULL,
  `id_jenis_mapel` int(11) DEFAULT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `kkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `id_kurikulum`, `id_jenis_mapel`, `nama_mapel`, `kkm`) VALUES
(1, 1, 1, 'Matematika', 75),
(2, 1, 1, 'Bahasa Inggris', 75),
(5, 1, 1, 'Bahasa Indonesia', 75),
(6, 1, 2, 'Pemrograman Dasar', 70),
(7, 1, 2, 'Jaringan Dasar', 70);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_guru`
--

CREATE TABLE `mapel_guru` (
  `id_mapel_guru` int(11) NOT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel_guru`
--

INSERT INTO `mapel_guru` (`id_mapel_guru`, `id_mapel`, `id_guru`) VALUES
(1, 1, 1),
(7, 2, 2),
(8, 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_kelas`
--

CREATE TABLE `mapel_kelas` (
  `id_mapel_kelas` int(11) NOT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_kelompok_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel_kelas`
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
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_kelas_siswa` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL,
  `nilai_sikap` int(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_mapel`, `id_kelas_siswa`, `nilai_uts`, `nilai_uas`, `nilai_sikap`, `nilai_akhir`, `semester`) VALUES
(1, 5, 1, 80, 0, 0, 80, 1),
(2, 5, 2, 0, 90, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kd`
--

CREATE TABLE `nilai_kd` (
  `id_nilai_kd` int(11) NOT NULL,
  `id_kd` int(11) NOT NULL,
  `id_kelas_siswa` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_kd`
--

INSERT INTO `nilai_kd` (`id_nilai_kd`, `id_kd`, `id_kelas_siswa`, `nilai`) VALUES
(2, 11, 1, 80),
(3, 10, 2, 75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rumus`
--

CREATE TABLE `rumus` (
  `nilai_kd` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rumus`
--

INSERT INTO `rumus` (`nilai_kd`, `nilai_uts`, `nilai_uas`) VALUES
(40, 30, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` int(1) NOT NULL,
  `foto_siswa` text,
  `id_kelas_siswa` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `password` text NOT NULL,
  `th_kelulusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nis`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `jk`, `foto_siswa`, `id_kelas_siswa`, `id_guru`, `password`, `th_kelulusan`) VALUES
(1, 'nisn1', 'nis1', 'Abc Def', 'Malang', '2000-12-04', 1, NULL, 1, 2, 'nisn1', NULL),
(2, 'nisn2', 'nis2', 'Ghi Jkl', 'Surabaya', '1999-12-28', 0, NULL, 2, NULL, 'nisn2', NULL),
(7, 'nisn3', 'nis3', 'Mno Pqr', 'Bandung', '2017-12-04', 0, NULL, 1, NULL, 'nisn3', NULL),
(8, 'nisn4', 'nis4', 'Stu Vwx', 'Bogor', '2000-06-14', 1, NULL, 2, NULL, 'nisn4', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jenis_mapel`
--
ALTER TABLE `jenis_mapel`
  ADD PRIMARY KEY (`id_jenis_mapel`);

--
-- Indexes for table `kd`
--
ALTER TABLE `kd`
  ADD PRIMARY KEY (`id_kd`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_kelompok_kelas` (`id_kelompok_kelas`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id_kelas_siswa`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelompok_kelas`
--
ALTER TABLE `kelompok_kelas`
  ADD PRIMARY KEY (`id_kelompok_kelas`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_kurikulum` (`id_kurikulum`),
  ADD KEY `id_jenis_mapel` (`id_jenis_mapel`);

--
-- Indexes for table `mapel_guru`
--
ALTER TABLE `mapel_guru`
  ADD PRIMARY KEY (`id_mapel_guru`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD PRIMARY KEY (`id_mapel_kelas`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_kelompok_kelas` (`id_kelompok_kelas`),
  ADD KEY `id_kelompok_kelas_2` (`id_kelompok_kelas`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_kelas_siswa` (`id_kelas_siswa`);

--
-- Indexes for table `nilai_kd`
--
ALTER TABLE `nilai_kd`
  ADD PRIMARY KEY (`id_nilai_kd`),
  ADD KEY `id_kd` (`id_kd`),
  ADD KEY `id_siswa` (`id_kelas_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas_siswa`),
  ADD KEY `id_guru` (`id_guru`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jenis_mapel`
--
ALTER TABLE `jenis_mapel`
  MODIFY `id_jenis_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kd`
--
ALTER TABLE `kd`
  MODIFY `id_kd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id_kelas_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kelompok_kelas`
--
ALTER TABLE `kelompok_kelas`
  MODIFY `id_kelompok_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id_kurikulum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mapel_guru`
--
ALTER TABLE `mapel_guru`
  MODIFY `id_mapel_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  MODIFY `id_mapel_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nilai_kd`
--
ALTER TABLE `nilai_kd`
  MODIFY `id_nilai_kd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kd`
--
ALTER TABLE `kd`
  ADD CONSTRAINT `kd_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_kelompok_kelas`) REFERENCES `kelompok_kelas` (`id_kelompok_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`id_kurikulum`) REFERENCES `kurikulum` (`id_kurikulum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mapel_ibfk_2` FOREIGN KEY (`id_jenis_mapel`) REFERENCES `jenis_mapel` (`id_jenis_mapel`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapel_guru`
--
ALTER TABLE `mapel_guru`
  ADD CONSTRAINT `mapel_guru_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mapel_guru_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD CONSTRAINT `mapel_kelas_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mapel_kelas_ibfk_2` FOREIGN KEY (`id_kelompok_kelas`) REFERENCES `kelompok_kelas` (`id_kelompok_kelas`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_kelas_siswa`) REFERENCES `kelas_siswa` (`id_kelas_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_kd`
--
ALTER TABLE `nilai_kd`
  ADD CONSTRAINT `nilai_kd_ibfk_2` FOREIGN KEY (`id_kd`) REFERENCES `kd` (`id_kd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_kd_ibfk_3` FOREIGN KEY (`id_kelas_siswa`) REFERENCES `kelas_siswa` (`id_kelas_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
