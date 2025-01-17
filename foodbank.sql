-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2025 at 08:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `distributorid` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id`, `name`, `address`, `distributorid`) VALUES
(1, 'Dist 1', 'Abbaseya-Cairo', 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 'Dist 2', 'Abbaseya-Cairo', 'c81e728d9d4c2f636f067f89cc14862c'),
(7, 'Dist 3', 'Nasr City - Cairo', '8f14e45fceea167a5a36dedd4bea2543');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_cost` float UNSIGNED NOT NULL,
  `donation_date` date NOT NULL,
  `donationid` varchar(222) DEFAULT NULL,
  `donor_id` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `total_cost`, `donation_date`, `donationid`, `donor_id`) VALUES
(6, 5600, '2024-12-30', '1679091c5a880faf6fb5e6087eb1b2dc', '45c48cce2e2d7fbdea1afc51c7c6ad26'),
(7, 1500, '2024-12-31', '8f14e45fceea167a5a36dedd4bea2543', '45c48cce2e2d7fbdea1afc51c7c6ad26'),
(8, 10005, '2025-01-17', 'c9f0f895fb98ab9159f51fd0297e236d', '6512bd43d9caa6e02c990b0a82652dca'),
(9, 15000, '2025-01-17', '45c48cce2e2d7fbdea1afc51c7c6ad26', '6512bd43d9caa6e02c990b0a82652dca'),
(10, 40000, '2025-01-17', 'd3d9446802a44259755d38e6d163e820', '6512bd43d9caa6e02c990b0a82652dca'),
(11, 2405, '2025-01-17', '6512bd43d9caa6e02c990b0a82652dca', '6512bd43d9caa6e02c990b0a82652dca'),
(12, 1800, '2025-01-17', 'c20ad4d76fe97759aa27a0c99bff6710', 'c20ad4d76fe97759aa27a0c99bff6710');

-- --------------------------------------------------------

--
-- Table structure for table `donation_details`
--

CREATE TABLE `donation_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `Qty` int(10) UNSIGNED NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `dd_id` varchar(222) DEFAULT NULL,
  `item_id` varchar(222) DEFAULT NULL,
  `donation_id` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_details`
--

INSERT INTO `donation_details` (`id`, `Qty`, `price`, `dd_id`, `item_id`, `donation_id`) VALUES
(8, 7, 800, 'c9f0f895fb98ab9159f51fd0297e236d', 'd3d9446802a44259755d38e6d163e820', '1679091c5a880faf6fb5e6087eb1b2dc'),
(9, 3, 500, '45c48cce2e2d7fbdea1afc51c7c6ad26', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '8f14e45fceea167a5a36dedd4bea2543'),
(10, 2, 5000, 'd3d9446802a44259755d38e6d163e820', '8f14e45fceea167a5a36dedd4bea2543', 'c9f0f895fb98ab9159f51fd0297e236d'),
(11, 3, 5000, '6512bd43d9caa6e02c990b0a82652dca', '8f14e45fceea167a5a36dedd4bea2543', '45c48cce2e2d7fbdea1afc51c7c6ad26'),
(12, 2, 20000, 'c20ad4d76fe97759aa27a0c99bff6710', '1679091c5a880faf6fb5e6087eb1b2dc', 'd3d9446802a44259755d38e6d163e820'),
(13, 3, 800, 'c51ce410c124a10e0db5e4b97fc2af39', 'd3d9446802a44259755d38e6d163e820', '6512bd43d9caa6e02c990b0a82652dca'),
(14, 2, 900, 'aab3238922bcc25a6f606eb525ffdc56', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'c20ad4d76fe97759aa27a0c99bff6710');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `phone_number` varchar(128) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `donorid` varchar(222) DEFAULT NULL,
  `has_donated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `username`, `birthdate`, `email`, `password`, `phone_number`, `gender`, `donorid`, `has_donated`) VALUES
(1, 'Malak', '1992-08-25', 'example@abc.com', '35e9a3f0dab724451bd956db409c2c9e96f795c9', '01098765432', 1, 'c4ca4238a0b923820dcc509a6f75849b', 0),
(9, 'qqq', '2002-11-11', 'examplee@abc.com', '8cb2237d0679ca88db6464eac60da96345513964', '1111111111', 0, '45c48cce2e2d7fbdea1afc51c7c6ad26', 0),
(10, 'New1', '1998-05-17', 'hhh@yahoo.com', '8cb2237d0679ca88db6464eac60da96345513964', '01543675468', 1, 'd3d9446802a44259755d38e6d163e820', 0),
(11, 'omar', '2003-01-19', 'omarsalem11411@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '01067132649', 0, '6512bd43d9caa6e02c990b0a82652dca', 0),
(12, 'ahmed', '2000-11-11', 'ahmed11@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '01201201211', 0, 'c20ad4d76fe97759aa27a0c99bff6710', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(128) DEFAULT NULL,
  `item_cost` float UNSIGNED DEFAULT NULL,
  `amount` mediumint(128) UNSIGNED DEFAULT NULL,
  `program_id` varchar(222) DEFAULT NULL,
  `itemid` varchar(222) DEFAULT NULL,
  `program_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_name`, `item_cost`, `amount`, `program_id`, `itemid`, `program_name`, `is_active`) VALUES
(2, 'Family carton', 100, 2000, 'c81e728d9d4c2f636f067f89cc14862c', 'c81e728d9d4c2f636f067f89cc14862c', 'Feed Families', 1),
(3, 'Gaza carton', 500, 1080, 'e4da3b7fbbce2345d7772b0674a318d5', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Help for Gaza', 1),
(6, 'Medical needs', 20000, 170, 'e4da3b7fbbce2345d7772b0674a318d5', '1679091c5a880faf6fb5e6087eb1b2dc', 'Help for Gaza', 1),
(7, 'Food carton', 5000, 1000, 'c4ca4238a0b923820dcc509a6f75849b', '8f14e45fceea167a5a36dedd4bea2543', 'Feed Orphans', 1),
(9, 'Medical Drugs', 900, 1000, 'a87ff679a2f3e71d9181a67b7542122c', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'provide Medical drugs', 1),
(10, 'clothes', 800, 1222, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'd3d9446802a44259755d38e6d163e820', 'For the newborn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(10) UNSIGNED NOT NULL,
  `program_name` varchar(128) DEFAULT NULL,
  `description` varchar(1024) NOT NULL,
  `programid` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `program_name`, `description`, `programid`) VALUES
(1, 'Feed Orphans', 'provide essential food assistance to orphans in need', 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 'Feed Families', 'provide essential food assistance to families in need', 'c81e728d9d4c2f636f067f89cc14862c'),
(3, 'For the newborn', 'provide help for newborns ,such as essentials.', 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
(4, 'provide Medical drugs', 'provide the essential drugs , such as cold medicine , vitamins ,etc..', 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 'Help for Gaza', 'provide help to those in need.', 'e4da3b7fbbce2345d7772b0674a318d5'),
(8, 'Program 6', 'Description', 'c9f0f895fb98ab9159f51fd0297e236d');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `supplierid` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `supplierid`) VALUES
(2, 'Supp 2', 'Abbaseya-Cairo', 'c81e728d9d4c2f636f067f89cc14862c'),
(6, 'Supp 1', 'Abbaseya-Cairo', '1679091c5a880faf6fb5e6087eb1b2dc'),
(7, 'Supp 3', 'Masr Elgedida - Cairo', '8f14e45fceea167a5a36dedd4bea2543'),
(8, 'Supp 4', 'Nasr City - Cairo', 'c9f0f895fb98ab9159f51fd0297e236d'),
(9, 'Supp 5', 'Nasr City - Cairo', '45c48cce2e2d7fbdea1afc51c7c6ad26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donationid` (`donationid`),
  ADD KEY `fk_donations_donor_id` (`donor_id`);

--
-- Indexes for table `donation_details`
--
ALTER TABLE `donation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_donation_details_item_id` (`item_id`),
  ADD KEY `fk_donation_details_donation_id` (`donation_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donorid` (`donorid`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `itemid` (`itemid`),
  ADD KEY `fk_program_id` (`program_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programid` (`programid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donation_details`
--
ALTER TABLE `donation_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `fk_donations_donor_id` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donorid`);

--
-- Constraints for table `donation_details`
--
ALTER TABLE `donation_details`
  ADD CONSTRAINT `fk_donation_details_donation_id` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`donationid`),
  ADD CONSTRAINT `fk_donation_details_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`itemid`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_program_id` FOREIGN KEY (`program_id`) REFERENCES `program` (`programid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
