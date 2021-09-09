-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2021 at 03:24 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkgadungan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training`
--

CREATE TABLE `tbl_training` (
  `id_training` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `b_indo` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `pancasila` varchar(20) NOT NULL,
  `umum` varchar(50) NOT NULL,
  `kasi_pem` varchar(10) NOT NULL,
  `wawancara` varchar(20) NOT NULL,
  `status_kelayakan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_training`
--

INSERT INTO `tbl_training` (`id_training`, `nama`, `b_indo`, `agama`, `pancasila`, `umum`, `kasi_pem`, `wawancara`, `status_kelayakan`) VALUES
(1, 'watiem', '65', '76', '55', '77', '87', '43', 'tidak layak'),
(2, 'Tugimin', '65', '88', '98', '89', '87', '43', 'layak'),
(3, 'Samino', '55', '67', '84', '85', '76', '77', 'layak'),
(4, 'Mesman K', '56', '76', '55', '44', '65', '43', 'tidak layak'),
(5, 'Arianto', '55', '33', '34', '76', '56', '90', 'tidak layak'),
(119, 'Jabar Damanik', '81', '88', '98', '85', '87', '98', 'layak'),
(130, 'Boniem', '90', '76', '98', '89', '87', '98', 'layak'),
(131, 'Ponimen B', '65', '67', '84', '77', '87', '90', 'layak'),
(135, 'Nuriatik', '85', '84', '85', '89', '76', '98', 'layak'),
(136, 'Edo', '81', '88', '98', '89', '71', '98', 'layak'),
(137, 'Danang', '78', '67', '90', '88', '80', '89', 'layak'),
(138, 'Indra', '77', '56', '67', '45', '55', '49', 'tidak layak'),
(139, 'Jaya', '88', '99', '82', '78', '92', '88', 'layak'),
(140, 'Rangga', '89', '87', '67', '89', '88', '88', 'layak'),
(141, 'Rizky', '64', '77', '54', '45', '34', '23', 'tidak layak'),
(142, 'Tama', '76', '78', '77', '89', '90', '78', 'layak'),
(143, 'Anisa', '23', '34', '45', '43', '56', '67', 'tidak layak'),
(144, 'Fitri', '89', '76', '90', '67', '89', '88', 'layak'),
(145, 'Ningrum', '67', '56', '89', '77', '56', '90', 'layak'),
(146, 'Dwi', '89', '88', '78', '67', '90', '96', 'layak'),
(147, 'Bintoro', '78', '56', '45', '34', '55', '77', 'tidak layak'),
(148, 'Puji', '77', '90', '88', '77', '67', '89', 'layak'),
(149, 'Annas', '77', '67', '89', '90', '89', '88', 'layak'),
(150, 'Woro', '34', '45', '65', '47', '58', '36', 'tidak layak'),
(151, 'Maria', '89', '77', '90', '90', '78', '69', 'layak'),
(152, 'Kuncoro', '46', '56', '35', '67', '45', '40', 'tidak layak'),
(153, 'Bambang', '89', '78', '89', '67', '90', '90', 'layak'),
(154, 'Wistri', '90', '89', '76', '89', '90', '81', 'layak'),
(155, 'Kukilo', '84', '90', '88', '78', '90', '89', 'layak'),
(156, 'Masentiko', '45', '78', '45', '34', '67', '34', 'tidak layak'),
(157, 'Wagiman', '78', '90', '89', '78', '90', '92', 'layak'),
(158, 'Sumi', '78', '89', '77', '90', '88', '90', 'layak'),
(159, 'Suwargi', '66', '90', '88', '78', '90', '88', 'layak'),
(160, 'Wilie', '89', '88', '78', '90', '78', '92', 'layak'),
(161, 'Maya', '90', '88', '90', '78', '89', '90', 'layak'),
(162, 'Larissa', '78', '90', '88', '78', '90', '83', 'layak'),
(163, 'Ririn', '56', '45', '67', '34', '67', '34', 'tidak layak'),
(164, 'Pipik', '67', '90', '88', '90', '88', '90', 'layak'),
(165, 'Aurelia', '89', '81', '80', '82', '82', '81', 'layak'),
(166, 'Vivi', '87', '80', '78', '90', '77', '90', 'layak');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Mega', 'mega@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_training`
--
ALTER TABLE `tbl_training`
  ADD PRIMARY KEY (`id_training`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id_training` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
