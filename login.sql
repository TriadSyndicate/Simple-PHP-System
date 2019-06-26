-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2019 at 11:51 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `amount` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date_created`, `amount`, `status`) VALUES
(41, 8, '2019-06-25 01:39:39', 1350, 0),
(42, 8, '2019-06-25 02:27:13', 5050, 0),
(43, 8, '2019-06-25 08:44:01', 1350, 0),
(44, 32, '2019-06-25 09:18:14', 1000, 0),
(45, 32, '2019-06-25 09:18:39', 1250, 0),
(46, 34, '2019-06-26 11:55:40', 7041, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `unit_amount` double NOT NULL,
  `description` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `unit_amount`, `description`, `quantity`, `date_created`, `status`) VALUES
(153, 41, 1000, 'Large_Pizza', 1, '2019-06-25 01:39:39', 0),
(154, 41, 150, 'Meat', 1, '2019-06-25 01:39:39', 0),
(155, 41, 1, 'Donation', 200, '2019-06-25 01:39:39', 0),
(156, 42, 1000, 'Large_Pizza', 1, '2019-06-25 02:27:13', 0),
(157, 42, 800, 'Medium_Pizza', 2, '2019-06-25 02:27:13', 0),
(158, 42, 500, 'Small_Pizza', 3, '2019-06-25 02:27:13', 0),
(159, 42, 150, 'Meat', 6, '2019-06-25 02:27:13', 0),
(160, 42, 50, 'Donation', 1, '2019-06-25 02:27:13', 0),
(161, 43, 1000, 'Large_Pizza', 1, '2019-06-25 08:44:01', 0),
(162, 43, 150, 'Meat', 1, '2019-06-25 08:44:01', 0),
(163, 43, 200, 'Donation', 1, '2019-06-25 08:44:01', 0),
(164, 44, 1000, 'Large_Pizza', 1, '2019-06-25 09:18:14', 0),
(165, 45, 1000, 'Large_Pizza', 1, '2019-06-25 09:18:39', 0),
(166, 45, 150, 'Meat', 1, '2019-06-25 09:18:39', 0),
(167, 45, 100, 'Donation', 1, '2019-06-25 09:18:39', 0),
(168, 46, 1000, 'Large_Pizza', 2, '2019-06-26 11:55:40', 0),
(169, 46, 800, 'Medium_Pizza', 5, '2019-06-26 11:55:40', 0),
(170, 46, 150, 'Meat', 7, '2019-06-26 11:55:40', 0),
(171, 46, -9, 'Donation', 1, '2019-06-26 11:55:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `secretword` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `firstName`, `lastName`, `email`, `username`, `password`, `gender`, `dob`, `secretword`, `hash`) VALUES
(8, 'Tony', 'Triad', 'triadsyndicate@gmail.com', 'Triad', '$2y$10$hDq/I8jH3J0kcuMvATyLRufReNRVwAvb8DMM4cWB4BrafJYbF.Una', 'Male', '1997-07-31', 'test', '1'),
(12, 'Peninah', 'Muthoni', 'ninahpesoca@gmail.com', 'Peaches', '$2y$10$6PY5J2wgMHIYFrJnlaf0iuxMiVn9sT5k6gqtRtzqLTDvE3uD7P1m2', 'Female', '1994-03-27', 'Triad', '1'),
(23, 'pickle', 'peaches', 'picklepeaches@triad.com', 'Syndicate', '$2y$10$wbpLzexlb/WfbRC.rN0o9e1R9eURtNBXjapa7QJASv1l3b9jEoXbm', 'Male', '2019-05-01', 'tony', '1'),
(25, 'Kakule', 'Bulembo', 'Jimmy@gmail.com', 'Jimmybu14', '$2y$10$2if0WLtLG20C8r/.EmJeSu/ZICtYrsSdemIZ9QvPj15KYn9Uj11LO', 'Male', '1999-01-14', 'Jbk', '1'),
(27, 'Daniel', 'vanga', 'Dan@gmail.com', 'Danbu14', '$2y$10$UcGM6Z2VdVMLkcZ28bcr0eLi9GX8tVLEu/Oq4X0bF04O8zShzljFG', 'Male', '1999-01-14', 'abc', '1'),
(28, 'Daniel', 'Takenga', 'Daniel@gmail.com', 'Danieltak17', '$2y$10$pzBMV8I9k42HGEER2..5weolqIBairMi60UOfFaxKOFFW3dCpcoKC', 'Male', '2000-05-23', 'Hdb', '1'),
(29, 'Pickle', 'peaches', 'peachespickle@tony.com', 'Me', '$2y$10$uk73rBN8dPlo05MxOIEXgeXaasdcnepPNVs7Q8k3jCtIgY3qMvghK', 'Female', '2019-05-01', 'Lol', '1'),
(30, 'Jocey', 'Chemtai', 'jctumwet@gmail.com', 'jCTumwet', '$2y$10$CQl3le3Ugge1HUUxikbmx.qpUM8cPkXY81m5GP.VUmkkaKg0UpsAO', 'Female', '1986-06-21', 'Saul', '1'),
(31, 'pickle', 'peaches', 'picklepeaches@tria.com', 'peaches', '$2y$10$Mh9ONWfR7E945R8HSXm/auw4/sAEycagaGdRTpre2BhJb4Z9U3lHu', 'Male', '2019-05-01', 'tony', '1'),
(32, 'Robert', 'Gitata', 'gitatarobert6@gmail.com', 'Bob', '$2y$10$.uf9AS/NNC0KT7/Zeb7sMeQgqK2Ht3JhoBu58jzTokIAsSEoVCF7S', 'Male', '2018-05-22', 'Bobwashere', '1'),
(33, 'bruce', 'omukoko', 'brucelosis12@gmail.com', 'thewick3rman', '$2y$10$z84/HLv2YgyBrSLqSDwUHev89ARpzh5TCnFY6NGOnOgVZ4KGF21Gq', 'Male', '1998-03-12', 'Faith', '1'),
(34, 'Shaune', 'Nandi', 'shaunenandi27@gmail.com', '110898', '$2y$10$J/.w//ZNvkkykxuIJHUZl.rseSRhfhh1T.lu0KFZZ/6hoAtw6CQY.', 'Male', '1999-07-17', '12345', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
