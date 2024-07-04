-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 05:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mmsl_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit_info`
--

CREATE TABLE `credit_info` (
  `t_crdt` int(30) NOT NULL,
  `last_credit_update_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `credit_info`
--

INSERT INTO `credit_info` (`t_crdt`, `last_credit_update_date`) VALUES
(-35931, '11-11-02 06:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `grp_info`
--

CREATE TABLE `grp_info` (
  `grp_id` varchar(20) NOT NULL,
  `grp_creator` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grp_info`
--

INSERT INTO `grp_info` (`grp_id`, `grp_creator`) VALUES
('easia2011_em sub', 'easia2011'),
('easia2011_easia sec', 'easia2011'),
('easia2011_semi sub', 'easia2011'),
('easia2011_com sub', 'easia2011'),
('easia2011_Inagu sub', 'easia2011'),
('easia2011_welc sub', 'easia2011'),
('easia2011_Org PM1', 'easia2011'),
('admin_smss', 'admin'),
('admin_np com.', 'admin'),
('admin_jrnl bsl', 'admin'),
('easia2011_spon_sub', 'easia2011'),
('admin_DJ', 'admin'),
('admin_DJ nw', 'admin'),
('admin_DJ 200', 'admin'),
('admin_DJ 47', 'admin'),
('imdad_C7', 'imdad'),
('easia2011_EOI', 'easia2011'),
('mrmamun_d2kpsd', 'mrmamun'),
('AAMAMUN_cy', 'AAMAMUN'),
('easia2011_media', 'easia2011');

-- --------------------------------------------------------

--
-- Table structure for table `grp_tbl`
--

CREATE TABLE `grp_tbl` (
  `grp_id` varchar(20) NOT NULL,
  `mob_num` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metro_send_sms_log`
--

CREATE TABLE `metro_send_sms_log` (
  `id` int(12) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `Mob_To` varchar(150) NOT NULL,
  `sms` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `status` int(8) NOT NULL,
  `lang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metro_send_sms_log2`
--

CREATE TABLE `metro_send_sms_log2` (
  `id` int(12) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `Mob_To` varchar(150) NOT NULL,
  `sms` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `status` int(8) NOT NULL,
  `lang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mt`
--

CREATE TABLE `mt` (
  `id` bigint(20) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `to` varchar(20) NOT NULL,
  `sms` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  `telco_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mt_log`
--

CREATE TABLE `mt_log` (
  `id` bigint(20) NOT NULL,
  `sender` varchar(30) NOT NULL,
  `Mob_To` varchar(13) NOT NULL,
  `sms` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `telco_id` tinyint(1) NOT NULL,
  `lang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remote_access_user`
--

CREATE TABLE `remote_access_user` (
  `id` bigint(20) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `u_pass` varchar(300) NOT NULL,
  `u_creator` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sch_sms_info`
--

CREATE TABLE `sch_sms_info` (
  `delv_time` varchar(25) NOT NULL,
  `to` varchar(100) NOT NULL,
  `sms` varchar(200) NOT NULL,
  `admin_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_sms_log`
--

CREATE TABLE `send_sms_log` (
  `id` int(12) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `Mob_To` varchar(150) NOT NULL,
  `sms` text NOT NULL,
  `date_time` datetime NOT NULL,
  `status` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_crdt_log`
--

CREATE TABLE `user_crdt_log` (
  `user_login_name` varchar(15) NOT NULL,
  `user_allocated_sms_num` int(11) NOT NULL,
  `allocation_date` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_crdt_log`
--

INSERT INTO `user_crdt_log` (`user_login_name`, `user_allocated_sms_num`, `allocation_date`) VALUES
('mmsl_test', 25, '11-08-06 06:08:08'),
('mmsl_test', 5, '11-08-06 06:08:06'),
('admin', 14, '11-08-04 07:08:21'),
('admin', 8600, '11-08-04 07:08:20'),
('admin', 25, '11-07-30 04:07:49'),
('mmsl_test', 25, '11-08-06 06:08:11'),
('npc', 150, '11-08-06 07:08:18'),
('test_user', 11, '11-08-08 04:08:07'),
('test_user', 11, '11-08-08 04:08:07'),
('juli123', 50, '11-08-15 08:08:31'),
('npc', 150, '11-08-22 05:08:28'),
('easia2011', 100, '11-08-23 09:08:09'),
('easia2011', 100, '11-08-23 09:08:18'),
('easia2011', 500, '11-08-26 04:08:05'),
('imdad', 300, '11-09-05 08:09:48'),
('rajib', 100, '11-09-09 08:09:16'),
('rajib', 1000, '11-09-10 09:09:15'),
('easia2011', 1000, '11-09-29 09:09:28'),
('rajib', 1094, '11-09-29 09:09:29'),
('mamshad', 10, '11-10-24 11:10:39'),
('mamshad', 1, '11-10-24 11:10:39'),
('mamshad', 1, '11-10-24 11:10:39'),
('mrmamun', 5, '11-10-29 12:10:52'),
('aamamun', 1, '11-10-29 12:10:59'),
('aamamun', 1, '11-10-29 01:10:13'),
('aamamun', 1, '11-10-29 01:10:20'),
('shibly', 123, '11-10-29 04:10:03'),
('mrmamun', 9490, '11-11-02 04:11:16'),
('mrmamun', 4, '11-11-02 04:11:16'),
('easia2011', 856, '12-01-16 05:01:37'),
('imdad', 299, '12-01-16 05:01:37'),
('sagar', 500, '13-03-07 06:03:10'),
('sagar', 50, '13-03-07 10:03:20'),
('rafiq', 50, '13-03-07 10:03:23'),
('rafiq', 20, '13-03-07 10:03:24'),
('sagar', 50, '13-03-07 10:03:37'),
('rafiq', 50, '13-03-07 10:03:37'),
('asad', 100, '13-03-10 06:03:32'),
('motin', 10, '13-03-10 06:03:45'),
('sajal', 10, '13-03-10 07:03:01'),
('motin', 10, '13-03-11 10:03:05'),
('motin', 10, '13-03-11 10:03:05'),
('sajal', 10, '13-03-11 01:03:38'),
('sajal', 10, '13-03-11 01:03:49'),
('sajal', 100, '13-03-11 03:03:02'),
('samsung', 0, '13-04-23 11:04:58'),
('samsung', 33, '13-04-23 11:04:58'),
('samsung', 52, '13-04-23 12:04:01'),
('samsung', 36, '13-04-23 03:04:11'),
('samsung', 12, '13-04-23 04:04:52'),
('samsung', 13, '13-04-23 04:04:54'),
('mobilecare', 15, '13-05-29 04:05:25'),
('', 100, '13-06-03 05:06:14'),
('', 100, '13-06-03 05:06:15'),
('samsung', 100, '13-06-03 05:06:15'),
('mobilecare', 50, '13-09-23 12:09:52'),
('ew', 9857, '15-11-05 10:11:57'),
('ew', 500, '15-11-30 02:11:39'),
('ew', 14500, '15-12-28 12:12:03'),
('ahs', 100, '16-02-02 03:02:07'),
('ahs', 123, '16-02-02 03:02:09'),
('ahs', 2000, '16-02-03 02:02:03'),
('deens', 1050, '16-03-01 03:03:49'),
('deens', 2000, '16-06-08 02:06:07'),
('deens', 1432, '16-06-21 10:06:47'),
('deens', 432, '16-06-21 10:06:48'),
('deens', 2000, '16-06-22 12:06:48'),
('deens', 5000, '16-06-29 03:06:36'),
('ew', 11529, '16-09-21 12:09:43'),
('deens', 1000, '16-11-05 02:11:44'),
('asad', 44, '16-11-05 03:11:21'),
('motin', 10, '16-11-05 03:11:21'),
('pablo', 9, '16-11-05 03:11:21'),
('rafiq', 44, '16-11-05 03:11:21'),
('saintjudes', 299, '16-11-05 03:11:21'),
('sajal', 95, '16-11-05 03:11:21'),
('ahs', 1535, '16-11-05 03:11:22'),
('deens', 500, '16-12-22 03:12:33'),
('ew', 10, '17-03-20 04:03:05'),
('deens', 16000, '17-04-06 12:04:17'),
('deens', 630, '17-04-06 08:04:33'),
('alsmani', 100, '17-07-13 01:07:06'),
('alsmani', 4900, '17-07-13 01:07:06'),
('sagar', 10000, '20-10-06 03:10:10'),
('sagar', 10000, '20-10-06 03:10:15'),
('celegra', 5000, '20-10-08 04:10:06'),
('drkm', 10, '20-10-29 01:10:32'),
('bgb', 5000, '22-06-20 05:06:37'),
('clemon', 5000, '22-10-17 01:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_info_cat`
--

CREATE TABLE `user_info_cat` (
  `user_login_name` varchar(100) NOT NULL,
  `user_login_pass` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `user_allocated_sms_credit` int(10) NOT NULL,
  `user_remaining_sms_credit` int(10) NOT NULL,
  `user_creation_date` varchar(100) NOT NULL,
  `user_valid_date` date NOT NULL,
  `creator_info` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_info_cat`
--

INSERT INTO `user_info_cat` (`user_login_name`, `user_login_pass`, `user_type`, `user_allocated_sms_credit`, `user_remaining_sms_credit`, `user_creation_date`, `user_valid_date`, `creator_info`) VALUES
('superAdmin', 'mmsladmin', '2', 184990, 200000, '11-10-29 04:10:03', '2025-12-10', 'super'),
('sagar', '123456', '1', 9979, 10000, '20-10-06 03:10:15', '2020-10-31', 'superAdmin'),
('poadmin', 'poadmin@123', '1', 5000, 5000, '20-10-08 04:10:06', '2024-12-31', 'superAdmin'),
('drkm', '110011', '1', 8, 10, '20-10-29 01:10:32', '2020-11-30', 'superAdmin'),
('bgb', 'bgb@2k22', '1', 5, 10, '22-06-20 05:06:37', '2023-06-30', 'superAdmin'),
('clemon', 'clemon123', '1', 988, 15000, '22-10-17 01:10:53', '2022-11-30', 'superAdmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `metro_send_sms_log`
--
ALTER TABLE `metro_send_sms_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metro_send_sms_log2`
--
ALTER TABLE `metro_send_sms_log2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mt`
--
ALTER TABLE `mt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mt_log`
--
ALTER TABLE `mt_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_sms_log`
--
ALTER TABLE `send_sms_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `metro_send_sms_log`
--
ALTER TABLE `metro_send_sms_log`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metro_send_sms_log2`
--
ALTER TABLE `metro_send_sms_log2`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mt`
--
ALTER TABLE `mt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mt_log`
--
ALTER TABLE `mt_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_sms_log`
--
ALTER TABLE `send_sms_log`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
