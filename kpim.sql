-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2017 at 05:43 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpim`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama_akses`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'Head'),
(4, 'Manager'),
(5, 'Board of Directors'),
(6, 'SPV'),
(7, 'Assistant SPV'),
(8, 'Assistant Manager');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id_dept` int(65) NOT NULL,
  `nama_dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id_dept`, `nama_dept`) VALUES
(1, 'IT'),
(2, 'HC'),
(3, 'PAT'),
(4, 'GA'),
(5, 'Marketing'),
(6, 'Finance'),
(7, 'Logistic'),
(8, 'Production'),
(9, 'SITAC'),
(10, 'Accounting'),
(11, 'Secretary'),
(12, 'Internal Audit'),
(13, 'WIPERINDO'),
(14, 'Tritunggal Metalworks');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(65) NOT NULL,
  `dept` varchar(65) NOT NULL,
  `id_jabatan` int(65) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_karyawan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `dept`, `id_jabatan`, `hak_akses`, `username`, `password`, `nama_karyawan`) VALUES
(1, '1,2,3,4,5,6,7,8,9,10,11,12', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14', 'dzaky', 'cc2097d78a0536b1c883a62e3d9befe7', 'Dzaky'),
(33, '1,5', 3, '2,6', 'Efendi', '57cc413966df22ed4e2fc802674246d2', 'Efendi'),
(35, '1', 2, '0', 'Keisha', '411eec6c74e1c57ee945590e4c6c00d7', 'Keisha Satrio'),
(36, '1', 2, '0', 'Surya', '8c3a9f08696af482a53e1dd8db0ef40f', 'Surya Gemilang'),
(38, '1,2,3,4,5,6,7,8,9,10,11,12,13,14', 5, '1,2,3,4,5,6,7,8,9,10,11,12,13,14', 'BOD', '9413b2ec11165b54fcbcc9ea60ada2d8', 'Board of Directors'),
(46, '1,2,3,4,5,6,7,8,9,10,11,12,13,14', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14', 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(48, '1,2,3,4,5', 4, '2,3,6', 'managerit', '0b1dd5fabd221ef63c58c026bce4cf6b', 'manager IT'),
(49, '1,3,4,9,11', 4, '3,6,8', 'felly', 'd9fe34f150419a2d2d91ca810a04db30', 'Bu Felly'),
(50, '1', 6, '2', 'rudys', 'a318ebe40d73124c1940b41d77954b95', 'Rudy Suryawan');

-- --------------------------------------------------------

--
-- Table structure for table `kpim_karyawan`
--

CREATE TABLE `kpim_karyawan` (
  `id` int(100) NOT NULL,
  `id_karyawan` int(200) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_end` date NOT NULL,
  `nama_goals` varchar(200) DEFAULT NULL,
  `action` varchar(225) NOT NULL,
  `kendala` varchar(225) NOT NULL,
  `result` varchar(225) NOT NULL,
  `deadline` date NOT NULL,
  `tgs_dept` varchar(65) NOT NULL,
  `id_status` int(65) NOT NULL,
  `status_nilai` int(2) NOT NULL,
  `status_deadline` int(1) NOT NULL,
  `bobot` int(3) NOT NULL,
  `target` float NOT NULL,
  `actual` float NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kpim_karyawan`
--

INSERT INTO `kpim_karyawan` (`id`, `id_karyawan`, `tgl`, `tgl_start`, `tgl_end`, `nama_goals`, `action`, `kendala`, `result`, `deadline`, `tgs_dept`, `id_status`, `status_nilai`, `status_deadline`, `bobot`, `target`, `actual`, `score`) VALUES
(185, 36, '2017-06-28', '2017-06-28', '2017-06-28', 's', 's', 's', 's', '2017-06-30', '1', 2, 1, 1, 99, 8, 9, 111.375),
(186, 36, '2017-06-28', '2017-06-28', '2017-06-28', 'a', 'a', 'a', 'a', '2017-06-26', '1', 2, 1, 3, 33, 9, 9, 33),
(187, 36, '2017-06-28', '2017-06-28', '2017-06-28', 'w', 'w', 'w', 'w', '2017-06-28', '1', 2, 1, 2, 99, 10, 2, 19.8),
(188, 33, '2017-07-02', '2017-07-02', '2017-07-02', 'test', 'h', 'h', 'h', '2017-07-02', '1', 2, 1, 2, 0, 0, 0, 0),
(189, 36, '2017-07-02', '2017-06-28', '2017-07-05', 'tes', 'tes ac', 'tes', 'tes', '2017-07-29', '1', 2, 1, 1, 80, 10, 8, 64),
(191, 1, '2017-07-05', '2017-07-05', '2017-07-05', 'test', 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 'test', 'test', '2017-07-05', '1', 2, 1, 2, 0, 0, 0, 0),
(192, 44, '2017-07-09', '2017-07-12', '2017-07-28', 'test staf ga', 'nn', 'ss', 'cc', '2017-07-27', '4', 2, 1, 1, 60, 7, 5, 42.8571),
(193, 35, '2017-07-07', '2017-07-06', '2017-07-12', 'Match Terpadu', 'Login', '', 'sudah', '2017-08-09', '1', 2, 0, 1, 0, 0, 0, 0),
(194, 35, '2017-07-10', '2017-07-06', '2017-07-12', 'Match Terpadu', 'Logout', '', 'sudah', '2017-08-09', '1', 2, 0, 1, 0, 0, 0, 0),
(195, 36, '2017-06-28', '2017-06-28', '2017-06-28', 'belum nilai', 'w', 'w', 'w', '2017-06-28', '1', 2, 1, 2, 0, 0, 0, 99),
(202, 1, '2017-07-10', '2017-07-11', '2017-07-11', 'coba', 'a', 'a', 'a', '2017-07-11', '1', 2, 1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kpim_next`
--

CREATE TABLE `kpim_next` (
  `id` int(100) NOT NULL,
  `id_karyawan` int(200) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_end` date NOT NULL,
  `nama_goals` varchar(200) DEFAULT NULL,
  `action` varchar(225) NOT NULL,
  `kendala` varchar(225) NOT NULL,
  `result` varchar(225) NOT NULL,
  `deadline` date NOT NULL,
  `tgs_dept` varchar(65) NOT NULL,
  `id_status` int(65) NOT NULL,
  `bobot` int(3) NOT NULL,
  `target` float NOT NULL,
  `actual` float NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kpim_next`
--

INSERT INTO `kpim_next` (`id`, `id_karyawan`, `tgl`, `tgl_start`, `tgl_end`, `nama_goals`, `action`, `kendala`, `result`, `deadline`, `tgs_dept`, `id_status`, `bobot`, `target`, `actual`, `score`) VALUES
(9, 37, '2017-06-29', '2017-06-29', '2017-07-05', 'Test Goal', 'Test Action', '', '', '2017-07-28', '1', 2, 0, 0, 0, 0),
(10, 36, '2017-07-03', '2017-06-29', '2017-07-05', 'next', 'next', '', '', '2017-07-29', '1', 2, 0, 0, 0, 0),
(11, 1, '2017-07-03', '2017-07-03', '2017-07-03', 'ff', 'ff', '', '', '2017-07-03', '1', 2, 0, 0, 0, 0),
(12, 1, '2017-07-05', '2017-07-05', '2017-07-05', 'a', 's', '', '', '2017-07-14', '1', 2, 0, 0, 0, 0),
(13, 44, '2017-07-18', '2017-07-26', '2017-08-02', 'goal', 'action', '', '', '2017-07-10', '4', 2, 0, 0, 0, 0),
(14, 35, '2017-07-13', '2017-07-19', '2017-07-26', 'Match Terpadu', 'session', '', '', '2017-08-09', '1', 2, 0, 0, 0, 0),
(17, 1, '2017-07-12', '2017-07-12', '2017-07-19', 'coba', 'a', '', '', '2017-07-21', '1', 2, 0, 0, 0, 0),
(18, 35, '2017-07-12', '2017-07-12', '2017-07-19', 'Match Terpadu', 'CRUD', '', '', '2017-07-28', '1', 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posting`
--

CREATE TABLE `posting` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_post` varchar(255) NOT NULL,
  `tgl_post` date NOT NULL,
  `tujuan_post` varchar(255) NOT NULL,
  `isi_post` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posting`
--

INSERT INTO `posting` (`id_post`, `id_user`, `judul_post`, `tgl_post`, `tujuan_post`, `isi_post`) VALUES
(5, 14, 'testing ', '2016-12-23', 'IT,HC,PAT,GA,MARKETING,FINANCE,LOGISTIC,PRODUCTION,SITAC,ACCOUNTING,INTERNAL AUDIT,WIPER INDONESIA,TRITUNGGAL METAL WORKS', '<p>testing setelah set timezone config</p>'),
(7, 14, 'Postingan Baru', '2017-01-25', 'IT,HC,PAT,GA,MARKETING,FINANCE,LOGISTIC,PRODUCTION,SITAC,ACCOUNTING,SECRETARY,INTERNAL AUDIT,WIPER INDONESIA,TRITUNGGAL METAL WORKS', '<p>lorem ipsum dolor</p>'),
(8, 22, 'testing', '2017-04-20', 'IT,HC,PAT,GA,MARKETING,FINANCE,LOGISTIC,PRODUCTION,SITAC,ACCOUNTING,SECRETARY,INTERNAL AUDIT,WIPER INDONESIA,TRITUNGGAL METAL WORKS', '<p>asdfghjklksasdlkjhgfd</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tnilai`
--

CREATE TABLE `tnilai` (
  `id` int(225) NOT NULL,
  `id_kary` int(225) NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_end` date NOT NULL,
  `tanggal` date NOT NULL,
  `tot_bobot` int(40) NOT NULL,
  `tot_target` int(20) NOT NULL,
  `tot_actual` int(20) NOT NULL,
  `tot_score` double NOT NULL,
  `nilai_akhir` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tnilai`
--

INSERT INTO `tnilai` (`id`, `id_kary`, `tgl_start`, `tgl_end`, `tanggal`, `tot_bobot`, `tot_target`, `tot_actual`, `tot_score`, `nilai_akhir`) VALUES
(107, 36, '2017-01-11', '2017-06-29', '2017-04-22', 88, 12, 8, 69.1, 78.6),
(111, 36, '2017-06-22', '2017-06-28', '2017-06-01', 187, 27, 14, 92.7, 50),
(115, 36, '2017-06-22', '2017-06-28', '2017-01-18', 187, 27, 14, 92.7, 65),
(116, 36, '2017-06-22', '2017-06-28', '2017-02-02', 187, 27, 14, 92.7, 80),
(117, 36, '2017-06-22', '2017-06-28', '2017-03-31', 187, 27, 14, 92.7, 77),
(118, 36, '2017-06-22', '2017-06-28', '2017-04-01', 187, 27, 14, 92.7, 100),
(119, 36, '2017-06-22', '2017-06-28', '2017-05-21', 187, 27, 14, 92.7, 100),
(121, 36, '2017-06-22', '2017-06-28', '2017-08-05', 187, 27, 14, 92.7, 10),
(122, 36, '2017-06-22', '2017-06-28', '2017-09-25', 187, 27, 14, 92.7, 50),
(123, 36, '2017-06-22', '2017-06-28', '2017-10-09', 187, 27, 14, 92.7, 50),
(124, 36, '2017-06-22', '2017-06-28', '2017-10-22', 187, 27, 14, 92.7, 77),
(125, 36, '2017-06-22', '2017-06-28', '2017-11-02', 187, 27, 14, 92.7, 40),
(126, 36, '2017-06-22', '2017-06-28', '2017-12-22', 187, 27, 14, 92.7, 88),
(133, 36, '2017-06-22', '2017-06-28', '2016-11-26', 187, 27, 14, 92.7, 44),
(134, 36, '2017-06-22', '2017-06-28', '2016-10-03', 187, 27, 14, 92.7, 85);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_akses`, `departemen`, `nama_user`, `username`, `password`, `status`) VALUES
(1, 1, 'IT', 'Kaisha Satrio', 'kaisha', '123', 'aktif'),
(9, 3, 'PAT,MARKETING', 'Alif', 'alif', '123', 'non-Aktif'),
(10, 3, 'HC,GA', 'Erna', 'erna', '123', 'non-Aktif'),
(12, 2, 'MARKETING', 'Ratna Eka', 'ratna', '123', 'aktif'),
(13, 4, 'MARKETING', 'Gozali Puspo', 'gozali', '123', 'aktif'),
(14, 3, 'GA,INTERNAL AUDIT', 'Ana Listio', 'ana', '123', 'aktif'),
(18, 2, 'IT', 'tes user', 'tes', '123', 'non-Aktif'),
(20, 6, 'GA,SECRETARY', 'Testing dept baru', 'testing1', '12345', 'aktif'),
(21, 2, 'IT,ACCOUNTING', 'aaaaaa', 'sasasa', '123', 'aktif'),
(22, 5, 'IT,HC,PAT,GA,MARKETING,FINANCE,LOGISTIC,PRODUCTION,SITAC,ACCOUNTING,SECRETARY,INTERNAL AUDIT,WIPER INDONESIA,TRITUNGGAL METAL WORKS', 'Rudy Wijaya', 'rudyw', '123', 'aktif'),
(23, 6, 'IT', 'tes spv', 'spvtes', '123', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kpim_karyawan`
--
ALTER TABLE `kpim_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpim_next`
--
ALTER TABLE `kpim_next`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tnilai`
--
ALTER TABLE `tnilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_akses` (`id_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id_dept` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `kpim_karyawan`
--
ALTER TABLE `kpim_karyawan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `kpim_next`
--
ALTER TABLE `kpim_next`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `posting`
--
ALTER TABLE `posting`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tnilai`
--
ALTER TABLE `tnilai`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
