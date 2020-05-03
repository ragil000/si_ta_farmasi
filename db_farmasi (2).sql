-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2019 at 08:23 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_farmasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_akun`
--

CREATE TABLE `table_akun` (
  `id_table_akun` int(11) NOT NULL,
  `table_akun_username` varchar(45) DEFAULT NULL,
  `table_akun_password_md5` varchar(45) DEFAULT NULL,
  `table_akun_password` varchar(45) DEFAULT NULL,
  `table_akun_level` int(11) DEFAULT NULL,
  `table_akun_ket` enum('aktif','nonaktif') NOT NULL,
  `table_akun_tahap_proposal` varchar(10) NOT NULL,
  `table_akun_tahap_hasil` varchar(10) NOT NULL,
  `table_akun_tahap_skripsi` varchar(10) NOT NULL,
  `id_table_data_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_akun`
--

INSERT INTO `table_akun` (`id_table_akun`, `table_akun_username`, `table_akun_password_md5`, `table_akun_password`, `table_akun_level`, `table_akun_ket`, `table_akun_tahap_proposal`, `table_akun_tahap_hasil`, `table_akun_tahap_skripsi`, `id_table_data_akun`) VALUES
(1, 'admina', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0, 'aktif', '', '', '', 1),
(9, 'mahasiswaq', '5787be38ee03a9ae5360f54d9026465f', 'mahasiswa', 1, 'aktif', 'aktif', 'nonaktif', 'nonaktif', 11),
(10, 'tonow', '9a20c72cdd3b0b265c2ad11d6dd6349a', 'tonos', 0, 'aktif', '', '', '', 12),
(11, 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'qwe', 1, 'aktif', '', '', '', 13),
(14, 'maulid', 'c2d1ddd68302d13d09f7b0de9f38c5fa', 'maulid', 1, 'nonaktif', '', '', '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `table_data_akun`
--

CREATE TABLE `table_data_akun` (
  `id_table_data_akun` int(11) NOT NULL,
  `table_data_akun_nama` varchar(50) DEFAULT NULL,
  `table_data_akun_nim` varchar(15) DEFAULT NULL,
  `table_data_akun_jenis_kelamin` enum('L','P') DEFAULT NULL,
  `table_data_akun_agama` varchar(25) NOT NULL,
  `table_data_akun_tempat_lahir` varchar(50) DEFAULT NULL,
  `table_data_akun_tgl_lahir` date DEFAULT NULL,
  `table_data_akun_foto` varchar(45) DEFAULT NULL,
  `table_data_akun_judul_skripsi` varchar(150) DEFAULT NULL,
  `table_data_akun_tgl_daftar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_data_akun`
--

INSERT INTO `table_data_akun` (`id_table_data_akun`, `table_data_akun_nama`, `table_data_akun_nim`, `table_data_akun_jenis_kelamin`, `table_data_akun_agama`, `table_data_akun_tempat_lahir`, `table_data_akun_tgl_lahir`, `table_data_akun_foto`, `table_data_akun_judul_skripsi`, `table_data_akun_tgl_daftar`) VALUES
(1, 'Ragilw', '', 'L', 'Islam', 'Abadi Jaya', '2018-12-25', 'E1E115042_2018-12-26.jpg', '', '2018-12-01'),
(2, 'Dosen A', NULL, 'L', 'Islam', NULL, NULL, 'default_avatar.png', NULL, '2018-12-04'),
(3, 'a', 'b', '', 'Islam', NULL, NULL, 'E1E115042_2018-12-26.jpg', NULL, NULL),
(11, 'zuldsaaeeyyuutt', 'eksaarrrrttyyuu', 'L', 'Islam', '', '0000-00-00', 'e1e115054_2019-01-07.jpg', 'fdfasasddyytt', '2018-12-26'),
(12, 'Tonox', NULL, 'P', 'Islam', NULL, NULL, 'default_avatar.png', NULL, '2018-12-26'),
(13, '', '', 'L', 'Islam', '', '1997-11-30', 'default_avatar.png', '', '2018-12-28'),
(16, 'maulid', 'e1e115009', 'L', 'Islam', NULL, NULL, 'default_avatar.png', NULL, '2018-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `table_dokumen`
--

CREATE TABLE `table_dokumen` (
  `id_table_dokumen` int(11) NOT NULL,
  `table_dokumen_tgl_ujian_skripsi` date NOT NULL,
  `table_dokumen_tgl_ujian_hasil` date DEFAULT NULL,
  `table_dokumen_tgl_ujian_proposal` date DEFAULT NULL,
  `table_dokumen_jam_awal_ujian_skripsi` time NOT NULL,
  `table_dokumen_jam_akhir_ujian_skripsi` time NOT NULL,
  `table_dokumen_jam_awal_ujian_hasil` time DEFAULT NULL,
  `table_dokumen_jam_akhir_ujian_hasil` time DEFAULT NULL,
  `table_dokumen_jam_awal_ujian_proposal` time DEFAULT NULL,
  `table_dokumen_jam_akhir_ujian_proposal` time DEFAULT NULL,
  `table_dokumen_tempat_ujian_skripsi` varchar(150) NOT NULL,
  `table_dokumen_tempat_ujian_hasil` varchar(150) DEFAULT NULL,
  `table_dokumen_tempat_ujian_proposal` varchar(150) DEFAULT NULL,
  `table_dokumen_nilai_ujian_skripsi` int(11) NOT NULL,
  `table_dokumen_nilai_ujian_hasil` int(11) NOT NULL,
  `table_dokumen_nilai_ujian_proposal` int(11) NOT NULL,
  `id_table_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_dokumen`
--

INSERT INTO `table_dokumen` (`id_table_dokumen`, `table_dokumen_tgl_ujian_skripsi`, `table_dokumen_tgl_ujian_hasil`, `table_dokumen_tgl_ujian_proposal`, `table_dokumen_jam_awal_ujian_skripsi`, `table_dokumen_jam_akhir_ujian_skripsi`, `table_dokumen_jam_awal_ujian_hasil`, `table_dokumen_jam_akhir_ujian_hasil`, `table_dokumen_jam_awal_ujian_proposal`, `table_dokumen_jam_akhir_ujian_proposal`, `table_dokumen_tempat_ujian_skripsi`, `table_dokumen_tempat_ujian_hasil`, `table_dokumen_tempat_ujian_proposal`, `table_dokumen_nilai_ujian_skripsi`, `table_dokumen_nilai_ujian_hasil`, `table_dokumen_nilai_ujian_proposal`, `id_table_akun`) VALUES
(6, '0000-00-00', '2018-06-20', '2018-11-07', '00:00:00', '00:00:00', '07:45:00', '10:45:00', '03:55:00', '09:15:00', '', 'Disini', 'Audit', 12, 0, 0, 1),
(8, '2019-01-31', '2018-11-30', '2019-01-31', '11:00:00', '01:00:00', '01:45:00', '04:45:00', '11:00:00', '01:00:00', 'tt', 'rt', 'hhww', 122, 45, 122, 9),
(10, '0000-00-00', '0000-00-00', '2019-11-30', '12:00:00', '12:00:00', '12:00:00', '12:00:00', '11:00:00', '12:00:00', '', '', 'ssss', 0, 0, 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `table_dosen`
--

CREATE TABLE `table_dosen` (
  `id_table_dosen` int(11) NOT NULL,
  `table_dosen_nama` varchar(150) DEFAULT NULL,
  `table_dosen_nip` varchar(45) DEFAULT NULL,
  `table_dosen_level` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_dosen`
--

INSERT INTO `table_dosen` (`id_table_dosen`, `table_dosen_nama`, `table_dosen_nip`, `table_dosen_level`) VALUES
(1, 'Dosen A, ST., MT', '0812', 'Ketua Jurusan'),
(2, 'Dosen B, ST., MT', '1123', 'Dosen Biasa'),
(3, 'Dosen C, ST., MT', '1213', 'Dosen Biasa'),
(4, 'Dosen D, ST., MT', '4343', 'Dosen Biasa'),
(5, 'Dosen E, ST., MT', '3424', 'Dosen Biasa'),
(7, 'Dosen X, ST., MT.', '21212', 'Dosen Biasa'),
(8, 'qwe', '111', 'Dosen Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `table_tugas_dosen`
--

CREATE TABLE `table_tugas_dosen` (
  `id_table_tugas_dosen` int(11) NOT NULL,
  `table_tugas_dosen_tugas` varchar(30) NOT NULL,
  `id_table_dosen` int(11) NOT NULL,
  `id_table_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_tugas_dosen`
--

INSERT INTO `table_tugas_dosen` (`id_table_tugas_dosen`, `table_tugas_dosen_tugas`, `id_table_dosen`, `id_table_akun`) VALUES
(23, 'Ketua Sidang', 2, 1),
(24, 'Sekretaris Sidang', 1, 1),
(28, 'Pembimbing 1', 1, 1),
(33, 'Pembimbing 2', 3, 1),
(34, 'Anggota 1', 5, 1),
(35, 'Dosen Penguji', 5, 1),
(36, 'Ketua Sidang', 2, 9),
(37, 'Sekretaris Sidang', 1, 9),
(38, 'Pembimbing 1', 1, 9),
(39, 'Pembimbing 2', 2, 9),
(40, 'Anggota 1', 4, 9),
(41, 'Dosen Penguji', 4, 9),
(109, 'Ketua Sidang Proposal', 4, 9),
(110, 'Sekretaris Sidang Proposal', 5, 9),
(113, 'Ketua Sidang Hasil', 4, 9),
(114, 'Sekretaris Sidang Hasil', 5, 9),
(115, 'Ketua Sidang skripsi', 5, 9),
(116, 'Sekretaris Sidang skripsi', 2, 9),
(117, 'Dosen Penguji Skripsi', 5, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_akun`
--
ALTER TABLE `table_akun`
  ADD PRIMARY KEY (`id_table_akun`,`id_table_data_akun`),
  ADD KEY `id_table_akun` (`id_table_akun`),
  ADD KEY `id_table_data_akun` (`id_table_data_akun`);

--
-- Indexes for table `table_data_akun`
--
ALTER TABLE `table_data_akun`
  ADD PRIMARY KEY (`id_table_data_akun`),
  ADD KEY `id_table_data_akun` (`id_table_data_akun`);

--
-- Indexes for table `table_dokumen`
--
ALTER TABLE `table_dokumen`
  ADD PRIMARY KEY (`id_table_dokumen`,`id_table_akun`),
  ADD KEY `id_table_dokumen` (`id_table_dokumen`),
  ADD KEY `id_table_akun` (`id_table_akun`);

--
-- Indexes for table `table_dosen`
--
ALTER TABLE `table_dosen`
  ADD PRIMARY KEY (`id_table_dosen`),
  ADD KEY `id_table_dosen` (`id_table_dosen`);

--
-- Indexes for table `table_tugas_dosen`
--
ALTER TABLE `table_tugas_dosen`
  ADD PRIMARY KEY (`id_table_tugas_dosen`,`id_table_dosen`,`id_table_akun`),
  ADD KEY `id_table_tugas_dosen` (`id_table_tugas_dosen`),
  ADD KEY `id_table_dosen` (`id_table_dosen`),
  ADD KEY `id_table_akun` (`id_table_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_akun`
--
ALTER TABLE `table_akun`
  MODIFY `id_table_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `table_data_akun`
--
ALTER TABLE `table_data_akun`
  MODIFY `id_table_data_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `table_dokumen`
--
ALTER TABLE `table_dokumen`
  MODIFY `id_table_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `table_dosen`
--
ALTER TABLE `table_dosen`
  MODIFY `id_table_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_tugas_dosen`
--
ALTER TABLE `table_tugas_dosen`
  MODIFY `id_table_tugas_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_akun`
--
ALTER TABLE `table_akun`
  ADD CONSTRAINT `table_akun_ibfk_1` FOREIGN KEY (`id_table_data_akun`) REFERENCES `table_data_akun` (`id_table_data_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_dokumen`
--
ALTER TABLE `table_dokumen`
  ADD CONSTRAINT `table_dokumen_ibfk_1` FOREIGN KEY (`id_table_akun`) REFERENCES `table_akun` (`id_table_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_tugas_dosen`
--
ALTER TABLE `table_tugas_dosen`
  ADD CONSTRAINT `table_tugas_dosen_ibfk_1` FOREIGN KEY (`id_table_dosen`) REFERENCES `table_dosen` (`id_table_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_tugas_dosen_ibfk_2` FOREIGN KEY (`id_table_akun`) REFERENCES `table_akun` (`id_table_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
