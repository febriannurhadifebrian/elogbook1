-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 04:07 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elogbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `tgl` datetime(6) NOT NULL,
  `care_center` varchar(50) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `hp` varchar(150) NOT NULL,
  `pc` varchar(150) NOT NULL,
  `monitoring` varchar(150) NOT NULL,
  `apptools` varchar(150) NOT NULL,
  `webtools` varchar(150) NOT NULL,
  `catatan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`id`, `nip`, `tgl`, `care_center`, `shift`, `hp`, `pc`, `monitoring`, `apptools`, `webtools`, `catatan`) VALUES
(23, '12345321', '2021-09-01 00:00:00.000000', '0', 'Sore', 'OK', 'OK', 'OK', 'OK', 'OK', 'Pertama\r\n'),
(24, '12345321', '2023-09-02 00:00:00.000000', 'Care Center 4', 'Siang', 'OK', 'OK', 'OK', 'OK', 'OK', 'KEDUA'),
(25, '12345321', '2023-09-01 00:00:00.000000', 'Care Center 1', 'Sore', 'OK', 'OK', 'OK', 'OK', 'OK', 'KESATU'),
(26, '12312312', '0202-09-04 00:00:00.000000', 'Care Center 5', 'Pagi', 'OK', 'OK', 'OK', 'OK', 'OK', 'KEEMPAT\r\n'),
(27, '12312312', '2023-09-05 00:00:00.000000', 'Care Center 6', 'Siang', 'OK', 'OK', 'OK', 'OK', 'OK', 'KELIMA'),
(28, '12312312', '2023-09-06 00:00:00.000000', 'Care Center 3', 'Sore', 'OK', 'OK', 'OK', 'OK', 'OK', 'KEENAM'),
(29, '12345321', '2023-09-10 00:00:00.000000', 'Care Center 6', 'Siang', 'OK', 'OK', 'OK', 'OK', 'OK', 'BISA SIH HARUSNYA eeeeeeeeeeeeeeeeeeee'),
(30, '31011', '2023-12-30 11:11:00.000000', 'Care Center 6', 'Sore', 'OK', 'OK', 'OK', 'OK', 'OK', 'coba'),
(34, '31011', '2023-12-21 13:09:00.000000', 'Care Center 1', 'Pagi', 'OK', 'OK', 'OK', 'OK', 'OK', 'pp'),
(35, '31011', '2023-12-29 12:00:00.000000', 'Care Center 1', 'Pagi', 'OK', 'OK', 'OK', 'OK', 'OK', 'pp'),
(36, '12312312', '2023-12-31 13:00:00.000000', 'Care Center 1', 'Pagi', 'NOK', 'NOK', 'NOK', 'NOK', 'NOK', ''),
(37, '31011', '2024-12-02 08:00:00.000000', 'Care Center 1', 'Pagi', 'OK', 'OK', 'OK', 'OK', 'OK', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook`
--

CREATE TABLE `tb_logbook` (
  `id` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `tgl` datetime(6) NOT NULL,
  `kategori` text NOT NULL,
  `lokasi` varchar(200) DEFAULT NULL,
  `layanan` varchar(100) NOT NULL,
  `judul` text NOT NULL,
  `ket` text DEFAULT NULL,
  `nama` varchar(128) NOT NULL,
  `level` varchar(50) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `close` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_logbook`
--

INSERT INTO `tb_logbook` (`id`, `nip`, `tgl`, `kategori`, `lokasi`, `layanan`, `judul`, `ket`, `nama`, `level`, `kode`, `lampiran`, `status`, `close`) VALUES
(4, '310114', '2023-12-25 12:47:39.000000', 'Ruang section head kebanjiran', 'Unit Section Head', 'High', 'Membersihkan sisa banjir', 'Ruang sudah kembali bersih', 'Hafiizh Zoelva', 'Staf', '0.1.4', '', 'Open', ''),
(5, '310113', '2024-01-15 12:47:39.000000', 'Ruang staf terkunci', 'Ruang staf', 'High', 'Mencari kunci ruangan', 'Ruang sudah dapat dibuka kembali', 'Khairani', 'Section Head', '0.1.4', '', 'Waiting Close', ''),
(7, '31011', '2024-01-16 12:47:39.000000', 'Server mengalami gangguan jawabb', NULL, 'Vsat SCPC', 'Memperbaiki server', NULL, 'Hafiizh Zoelva Khairani', 'Admin', '0.1.1', '65454b607fe86.png', '', 'Y'),
(8, '310112', '2023-12-21 12:47:39.000000', 'Listrik ruangan padam', 'Ruangan General Affair', 'Low', 'Menghidupkan saklar listrik dari off ke on', 'Sudah diperbaiki', 'Hafiizh', 'Department', '0.0.3', '', '', ''),
(13, '310113', '2024-01-02 12:47:39.000000', 'Terjadi percikan api di kabel', 'Ruang Staf', 'High', 'Mematikan arus listrik', 'Keadaan sudah normal kembali', 'Khairani', 'Section Head', '0.1.4', '', 'Open', ''),
(14, '310293', '2023-12-23 12:47:39.000000', 'Membuat program E-Logbook', 'Ruang staf IT', 'Medium', 'Membuat program E-Logbook', 'Membuat program E-Logbook', 'Khairani Zoelva', 'Staf', '0.1.1', '', '', ''),
(17, '31011', '2023-12-29 12:47:39.000000', '12312', NULL, 'Mangosfamily', '12312', NULL, 'Hafiizh Zoelva Khairani', 'Section Head', '0.1.1', '6545e689210ee.png', 'Waiting Close', 'Y'),
(31, '0123', '2023-12-27 12:47:39.000000', 'ppp', NULL, 'MSP', 'pp', NULL, 'Febrian nur hadi', 'Section Head', '0.1.1', '', '', 'Y'),
(32, '0123', '2023-12-31 12:47:39.000000', 'pp', NULL, 'BGAN (Broadband Global Area Network)', 'pp', NULL, 'Febrian nur hadi', 'Section Head', '0.1.1', '', '', 'Y'),
(33, '0123', '2023-12-24 12:47:39.000000', 'hh', NULL, '', 'hyyh', NULL, 'Febrian nur hadi', 'Section Head', '0.1.1', '', 'Open', ''),
(34, '0123', '2024-01-07 12:47:39.000000', 'abc', NULL, 'Broadcast', 'udsrr', NULL, 'Febrian nur hadi', 'Section Head', '0.1.1', '', '', 'Y'),
(35, '01234', '2024-01-09 12:47:39.000000', '1223', NULL, 'Vsat SCPC', 'coba', NULL, 'aan', 'Staf', '0.2.2', '', 'Open', 'Y'),
(85, '12312312', '2024-01-05 12:47:39.000000', 'Technical Issue', NULL, 'MPLS', 'Perbaikan Satelit di Lumajang', NULL, '', '', '', '657d972caef0c.jpg', 'Open', ''),
(86, '12312312', '2024-01-13 12:47:39.000000', 'Perkataan', NULL, 'BGAN (Broadband Global Area Network)', 'Pengadaan Barang', NULL, '', '', '', '657f40aaa9163.jpeg', 'Waiting Close', ''),
(87, '12312312', '2024-01-02 12:47:39.000000', 'Bersama Kita Bisa', NULL, 'Vsat SCPC', 'Ayo kita bisa', NULL, '', '', '', '65807a03d239b.jpeg', '', ''),
(88, '31011', '2024-01-14 12:47:39.000000', 'Penambahan Pages', NULL, 'MPLS', 'Ayo kita bisa', NULL, '', '', '', '6580920f6e69b.jpg', '', ''),
(89, '12312312', '2023-12-19 12:47:39.000000', 'customer complain', NULL, 'Mangosfamily', 'asa', NULL, '', '', '', '6583b1c5985ff.jpeg', '', ''),
(90, '12312312', '2023-12-29 12:47:39.000000', 'monitoring', NULL, 'BBS Bakti', 'xss', NULL, '', '', '', '6583f65f07924.png', '', ''),
(94, '31011', '2024-01-07 12:47:39.000000', 'monitoring', NULL, 'BBS Bakti', 'pp', NULL, '', '', '', '65899166efba4.png', '', ''),
(95, '31011', '2023-12-27 12:47:39.000000', 'monitoring', NULL, 'BBS Bakti', 'pp', NULL, '', '', '', '658cfa0ce609e.png', 'Waiting Close', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `kode`, `unit`) VALUES
(32, '0.01', 'Manager'),
(33, '0.02', 'Koordinator Care Center A'),
(34, '0.03', 'Koordinator Care Center B'),
(35, '0.04', 'Koordinator Care Center D'),
(36, '0.05', 'EOS'),
(37, '0.06', 'LEADER CC-1'),
(38, '0.07', 'LEADER CC-2'),
(39, '0.08', 'LEADER CC-3'),
(40, '0.09', 'LEADER CC-4'),
(41, '0.10', 'LEADER CC-5'),
(42, '0.11', 'LEADER CC-6'),
(43, '0.12', 'TIM CC-1'),
(44, '0.13', 'TIM CC-2'),
(45, '0.14', 'TIM CC-3'),
(46, '0.15', 'TIM CC-4'),
(47, '0.16', 'TIM CC-5'),
(48, '0.17', 'TIM CC-6'),
(49, '0.18', 'ADMIN SSCC');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(2556) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `qr_code` varchar(100) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nip`, `name`, `username`, `password`, `jabatan`, `kode`, `qr_code`, `image`, `role_id`) VALUES
(38, '31011', 'Febrian nur hadi', 'zoelva', '$2y$10$KDfMrSmiSnTDcRGg3zeuJOWhG2Zy7UsnTmTgj/a2jSIbo5.SGekpK', 'Section Head', '0.1.1', '31011.png', 'BHEZ2712_-_Copy.JPG', 1),
(44, '12312312', 'Ferdy Elfanes', 'ferdyelfanes', '$2y$10$jUA8pXpJwxyEkLzP1mT8fuJlpfbHvF1PjVjU7ePlwyLjwWU0Dqwpa', 'Staf', '0.5.1', '12312312.png', 'default.jpg', 2),
(46, '0123', 'Febrian nur hadi', 'febrnhadi', '$2y$10$OJdA.SID2Ty/zi9WQVfwd.ZPQxsC7c40zC.dlB/5VX4ZAn4DDFgQK', 'Section Head', '0.1.1', '0123.png', 'default.jpg', 1),
(47, '01234', 'aan', 'aan123', '$2y$10$OHyYBz88Z27E/57qjyNJw.KFvg1jUlYixEUdjwfttR5aTdI2dnwWS', 'Staf', '0.2.2', '01234.png', 'default.jpg', 2),
(52, '34567', 'donispartan', 'donisp', '$2y$10$EOdtIBprWQd5KaghJdfBteZbbHtSKqvIUsFGQ100nGL8c0FP/.L9G', 'Section Head', '0.4.3', '34567.png', 'default.jpg', 1),
(53, '897263', 'febrian', 'febrnhadi123', '$2y$10$CIT/d9oxN61ZRWNAOAYhuuD8NmhN5jDvAGJHtryFmtYS7AyyG4HXu', 'Manager Service Solu', '0.01', '897263.png', 'default.jpg', 1),
(54, '12345321', 'Ferdy Elfanes', 'felfanes', '$2y$10$31qtQr6AsALLAgxShd9kPOEUsatNk9D..M5SriU55aDETwcS9/Q5e', 'Officer 3 Service So', '0.02', '12345321.png', 'default.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 3),
(5, 1, 6),
(6, 2, 6),
(8, 2, 7),
(9, 2, 2),
(10, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(6, 'Fitur'),
(8, 'Data user');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 1, 'Role', 'admin/role', 'fas fa-fw fa-gear', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Sub Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(9, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-cog', 1),
(10, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(11, 1, 'Add User', 'admin/user', 'fas fa-fw fa-plus-square', 1),
(12, 1, 'Unit', 'admin/unit', 'fas fa-fw fa-sitemap', 1),
(14, 6, 'E-Logbook', 'fitur', 'fas fa-fw fa-book', 1),
(17, 6, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(18, 8, 'data user', 'admin/datauser', 'fas fa-fw fa-sitemap', 1),
(19, 6, 'Checklist', 'fitur/checklist', 'fas fa-fw fa-check-square', 1),
(20, 8, 'Close', 'admin/close', 'fas fa-fw fa-check-square', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook`
--
ALTER TABLE `tb_logbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `kode` (`kode`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode` (`kode`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_logbook`
--
ALTER TABLE `tb_logbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
