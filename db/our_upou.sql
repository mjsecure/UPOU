-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2017 at 04:55 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `our_upou`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access`
--

CREATE TABLE `tbl_access` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_access`
--

INSERT INTO `tbl_access` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$elt09pdhy/Z5BXb.BBRQEeZDTVo82W2dCGZrcwO/6knNO.XmOaLsW', '2017-03-16 06:17:07'),
(3, 'maryjane', 'maryjane@yahoo.com', '$2y$10$VXILkF6ioNM7V8pJocWLE.JHZx2NkXm15ctIxRxJRQMx5DMrikTna', '2017-03-16 06:42:38'),
(4, 'rizalyn', 'rizalyn@gmail.com', '$2y$10$I9im05kibV3PFhY5J1/x/uIJpvikszhjnBIDagZMHUWKxsLhYXZXS', '2017-03-16 06:43:02'),
(5, 'loraine', 'loraine@gmail.com', '$2y$10$IauYOKlkQIy04rVyK/8rbOcfAvMz.kR0H9VpUmRBfyeqAwOj5fa7O', '2017-03-16 07:02:59'),
(6, 'jeremy', 'jeremy@gmail.com', '$2y$10$3Qf2vAqcYqZU5v/gbxHYTu6VtBNRK1Fe0YOyH8NmQ95khBtqZKuKy', '2017-03-16 07:41:24'),
(7, 'rommel', 'rommel@gmail.com', '$2y$10$Hhyn3boWfTmROvLZaptS5u7dSAQ8wELCUgNK54/ApoYad2d5FMMoa', '2017-03-21 23:34:00'),
(8, 'rj', 'rj@gmail.com', '$2y$10$GQXvMxF5ftBXs8GJ1fnJC.HKu10wLCoT785SfqpC0fzNMFbiafRa2', '2017-03-22 01:47:18'),
(9, 'inel', 'inel@gmail.com', '$2y$10$VXn31W.gYxAK9oQYvxRDL.A7YeY2pCDSJOwNUdZZdmyzuks/g7czu', '2017-03-22 01:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `name`) VALUES
(37, 'Sample'),
(38, 'Testing'),
(50, 'News'),
(68, 'rty'),
(69, '123'),
(70, '123'),
(71, '123333');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploads`
--

CREATE TABLE `tbl_uploads` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `uploaded_by` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_uploads`
--

INSERT INTO `tbl_uploads` (`id`, `title`, `file`, `type`, `size`, `description`, `location`, `url`, `uploaded_by`, `date_created`, `date_updated`, `category_id`) VALUES
(4, 'ooh no!', 'hydrangeas.jpg', 'image/jpeg', 581, 'Why', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/hydrangeas.jpg', 'jeremy@gmail.com', '2017-03-21 08:32:03', NULL, 38),
(5, 'no!', 'lighthouse.jpg', 'image/jpeg', 561276, 'try', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/lighthouse.jpg', 'jeremy@gmail.com', '2017-03-21 08:32:37', '2017-03-21 09:37:11', 37),
(6, 'Why', 'day.docx', 'application/octet-stream', 3915, 'Why', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/day.docx', 'jeremy@gmail.com', '2017-03-21 23:35:10', '2017-03-21 23:44:10', 37),
(7, 'try', 'bgp-form-v3.xlsx', 'application/octet-stream', 27, 'try', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/bgp-form-v3.xlsx', 'jeremy@gmail.com', '2017-03-22 00:57:26', NULL, 37),
(8, 'ytr', 'weeklyar-(2).docx', 'application/octet-stream', 693, 'ytr', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/weeklyar-(2).docx', 'jeremy@gmail.com', '2017-03-22 00:57:45', NULL, 50),
(9, 'rtrt', 'upou-seal2009-copy-(1).png', 'image/png', 659, 'rtrt', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/upou-seal2009-copy-(1).png', 'jeremy@gmail.com', '2017-03-22 00:58:03', NULL, 38),
(10, 'yui', 'adminlte-2.3.11.zip', '', 0, 'yui', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/adminlte-2.3.11.zip', 'jeremy@gmail.com', '2017-03-22 00:58:26', NULL, 50),
(11, 'yui', '45.jpg', 'image/jpeg', 606, 'yuyu', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/45.jpg', 'jeremy@gmail.com', '2017-03-22 00:59:03', NULL, 37),
(12, 'yuyuyuyu', 'penguins.jpg', 'image/jpeg', 760, 'yuyuyu', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/penguins.jpg', 'jeremy@gmail.com', '2017-03-22 00:59:18', NULL, 50),
(13, 'yuyuyuuyt', 'lighthouse.jpg', 'image/jpeg', 548, 'ytyrtytyrty', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/lighthouse.jpg', 'jeremy@gmail.com', '2017-03-22 00:59:47', NULL, 37),
(14, 'asa', 'jellyfish.jpg', 'image/jpeg', 758, 'aas', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/jellyfish.jpg', 'jeremy@gmail.com', '2017-03-22 01:00:27', NULL, 37),
(15, 'asasas', 'hydrangeas.jpg', 'image/jpeg', 581, 'asasasasasas', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/hydrangeas.jpg', 'jeremy@gmail.com', '2017-03-22 01:00:48', NULL, 50),
(16, 'asasasA', 'desert.jpg', 'image/jpeg', 826, 'asASasasasa', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/desert.jpg', 'jeremy@gmail.com', '2017-03-22 01:01:05', NULL, 50),
(17, 'IT', 'php_database.zip', 'application/octet-stream', 445, 'BSIT-4A Laguna University', '/UPOU/admin/uploads/', 'http://localhost/UPOU/admin/uploads/php_database.zip', 'jeremy@gmail.com', '2017-03-22 03:50:00', '2017-03-22 03:50:34', 37);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`) VALUES
(1, 'google', '113214041465197460288', 'Maryjane', 'Pascua', 'maryjanepascua89@gmail.com', 'female', 'en', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '', '2017-02-10 02:19:01', '2017-03-22 04:01:59'),
(2, 'google', '113389594057352272641', 'Mary Jane', 'Pascua', 'maryjanepascua69@gmail.com', '', 'en', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '', '2017-02-20 02:33:55', '2017-02-20 02:52:45'),
(3, 'google', '110318400346904643557', 'beth', 'punzalan', 'bethelizganda22@gmail.com', 'female', 'en', 'https://lh3.googleusercontent.com/-m0iT_sgESO0/AAAAAAAAAAI/AAAAAAAAQn4/JEHOrHYLU54/photo.jpg', '', '2017-02-23 02:14:56', '2017-02-23 02:20:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_access`
--
ALTER TABLE `tbl_access`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_access`
--
ALTER TABLE `tbl_access`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  ADD CONSTRAINT `fk_table_cat` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
