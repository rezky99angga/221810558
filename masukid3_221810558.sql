-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2022 at 10:49 PM
-- Server version: 10.3.34-MariaDB-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masukid3_221810558`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_pegawai_pengirim` int(11) NOT NULL,
  `id_pegawai_penerima` int(11) NOT NULL,
  `tgl_disposisi` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `id_surat`, `id_pegawai_pengirim`, `id_pegawai_penerima`, `tgl_disposisi`, `keterangan`) VALUES
(21, 10, 15, 4, '2022-06-20 02:14:33', 'Dari BPS Banyumas'),
(22, 10, 15, 18, '2022-06-20 02:15:54', 'Surat tolong dicek'),
(25, 14, 15, 4, '2022-06-20 06:19:10', 'koordinator cek'),
(26, 10, 15, 18, '2022-06-20 10:14:48', 'Coba Disposisi');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` char(30) NOT NULL,
  `role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `role`) VALUES
(1, 'Sub Bagian Umum', 1),
(2, 'Kepala BPS', 2),
(3, 'Koordinator Fungsi 1', 3),
(4, 'Keamanan', 4),
(11, 'Koordinator Fungsi 2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `nama_pegawai` char(50) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `nama_pegawai`, `id_jabatan`, `password`) VALUES
(1, 'bagianumum', 'Heni Yulianti, SST, M.Si', 1, '21232f297a57a5a743894a0e4a801fc3'),
(2, 'kepalabps', 'Djulfikar Rizky, M.Si', 2, '21232f297a57a5a743894a0e4a801fc3'),
(3, 'keamanan', 'Keamanan', 4, '21232f297a57a5a743894a0e4a801fc3'),
(4, 'koordinator2', 'Koordinator Fungsi 2', 11, '21232f297a57a5a743894a0e4a801fc3'),
(18, 'koordinator1', 'Koordinator Fungsi 1', 3, '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'ADMIN'),
(2, 'PENGAWAS'),
(3, 'KOORDINATOR'),
(4, 'KEAMANAN');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat` int(11) NOT NULL,
  `nomor_surat` varchar(200) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `tujuan` varchar(200) NOT NULL,
  `perihal` varchar(200) NOT NULL,
  `id_pegawai` int(11) NOT NULL DEFAULT 1,
  `file_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat`, `nomor_surat`, `tgl_kirim`, `tujuan`, `perihal`, `id_pegawai`, `file_surat`) VALUES
(8, '432/suratkeluar1', '2022-06-20', 'BPS Bali', 'Undangan Rapat', 1, 'Contoh_Surat3.pdf'),
(9, '222/suratkeluar2', '2022-06-24', 'Jakarta', 'Undangan', 1, 'Contoh_Surat6.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keputusan`
--

CREATE TABLE `surat_keputusan` (
  `id_surat` int(11) NOT NULL,
  `nomor_surat` varchar(200) NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` varchar(200) NOT NULL,
  `bagian` int(11) NOT NULL,
  `file_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keputusan`
--

INSERT INTO `surat_keputusan` (`id_surat`, `nomor_surat`, `tgl_surat`, `perihal`, `bagian`, `file_surat`) VALUES
(8, 'SK001', '2022-06-17', 'SK Kepala BPS', 2, 'Contoh_Surat2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat` int(11) NOT NULL,
  `nomor_surat` varchar(200) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `tgl_terima` date NOT NULL,
  `pengirim` varchar(200) NOT NULL,
  `perihal` varchar(200) NOT NULL,
  `id_pegawai` int(11) NOT NULL DEFAULT 1,
  `file_surat` text NOT NULL,
  `status` enum('proses','selesai') NOT NULL DEFAULT 'proses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat`, `nomor_surat`, `tgl_kirim`, `tgl_terima`, `pengirim`, `perihal`, `id_pegawai`, `file_surat`, `status`) VALUES
(10, '111/surat1', '2022-06-18', '2022-06-20', 'BPS Banyumas', 'Undangan Rapat', 1, 'Contoh_Surat.pdf', 'proses'),
(13, '333/surat3', '2022-06-16', '2022-06-20', 'BPS Pusat', 'Keputusan Kepala BPS Pusat', 1, 'Contoh_Surat1.pdf', 'proses'),
(14, '222/surat2', '2022-06-15', '2022-06-20', 'BPS Banyumas', 'Undangan', 1, 'Contoh_Surat4.pdf', 'proses'),
(15, '444/surat4', '2022-06-17', '2022-06-20', 'BPS Banyumas', 'Rapat', 1, 'Contoh_Surat5.pdf', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama_tamu` char(50) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `keperluan` varchar(200) NOT NULL,
  `suhu` int(2) NOT NULL,
  `id_pegawai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `nama_tamu`, `tgl_masuk`, `alamat`, `keperluan`, `suhu`, `id_pegawai`) VALUES
(7, 'Galih', '2022-06-20', 'Bobotsari', 'Mengambil berkas', 34, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `id_surat` (`id_surat`),
  ADD KEY `id_pegawai_penerima` (`id_pegawai_penerima`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `jabatan_role` (`role`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `id_role` (`id_role`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_surat` (`id_surat`),
  ADD KEY `id_pegawai_id_pegawai` (`id_pegawai`);

--
-- Indexes for table `surat_keputusan`
--
ALTER TABLE `surat_keputusan`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `bagian_id_jabatan` (`bagian`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_id` (`id_pegawai`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`),
  ADD UNIQUE KEY `id_tamu` (`id_tamu`),
  ADD KEY `tamu_role_role_id_role` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_keputusan`
--
ALTER TABLE `surat_keputusan`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `surat_masuk` (`id_surat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_pegawai_id_pegawai_fk` FOREIGN KEY (`id_pegawai_penerima`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_role` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_jabatan_id_jabatan_fk` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `id_pegawai_id_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `surat_keputusan`
--
ALTER TABLE `surat_keputusan`
  ADD CONSTRAINT `bagian_id_jabatan` FOREIGN KEY (`bagian`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `id_id` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `tamu`
--
ALTER TABLE `tamu`
  ADD CONSTRAINT `tamu_role_role_id_role` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
