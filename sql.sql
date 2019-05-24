-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2019 at 03:54 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `eauction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `bids_id` int(11) NOT NULL,
  `cu_id` int(11) NOT NULL,
  `amt` varchar(10) NOT NULL,
  `bi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bids_id`, `cu_id`, `amt`, `bi_id`) VALUES
(11, 4, '15600', 2),
(12, 4, '555', 1),
(16, 3, '18000', 2),
(18, 3, '999', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bid_info`
--

CREATE TABLE `bid_info` (
  `bi_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT '-1',
  `cu_id` varchar(5) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bid_info`
--

INSERT INTO `bid_info` (`bi_id`, `pr_id`, `start_date`, `end_date`, `status`, `cu_id`) VALUES
(1, 6, '2019-03-26', '2019-03-27', '-1', '4'),
(2, 9, '2019-03-19', '2019-03-27', '-1', '3'),
(3, 2, '2019-04-25', '2019-04-30', '-1', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `category` varchar(15) NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category`, `status`) VALUES
(5, 'Book', '1'),
(7, 'Clothes', '1'),
(8, 'Painting', '1'),
(9, 'Ordinance', '1'),
(10, 'Stamps', '1'),
(11, 'Coins', '0'),
(12, 'Vehicle', '1'),
(13, 'Gold', '0'),
(14, 'Demo', '0'),
(15, 'Aaa', '0'),
(16, 'Sports Equipeme', '1'),
(17, 'Jwellery', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cu_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `addr` varchar(50) DEFAULT NULL,
  `status` varchar(5) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cu_id`, `fname`, `lname`, `email`, `pass`, `dob`, `gender`, `mobile`, `addr`, `status`) VALUES
(1, 'Patrick', 'Patel', 'patrick@gmail.com', '123', NULL, NULL, NULL, NULL, '-1'),
(2, 'Disha', 'Kushwah', 'Disha.kushwah@gmail.com', '123', NULL, NULL, NULL, NULL, '0'),
(3, 'khushboo', 'Shah', 'Khushboo.shah@gmail.com', '123', '2019-03-19', 'Female', '1234567890', 'Gujarat', '1'),
(4, 'Ani', 'Jani', 'Ani.Jani@gmail.com', '123', NULL, NULL, NULL, NULL, '1'),
(5, 'Noopur', 'Tiwari', 'Nuup.Tiwari@gmail.com', '123', NULL, NULL, NULL, NULL, '1'),
(6, 'Palak', 'Patel', 'Palak.patel@gmail.com', '123', NULL, NULL, NULL, NULL, '0'),
(7, 'krushali', 'patel', 'krushali.patel@gmail.com', '123', NULL, NULL, NULL, NULL, '0'),
(8, 'Neha', 'Sharma', 'NehuSharma89@gmail.com', '123', NULL, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pr_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `mfg_yr` varchar(5) NOT NULL,
  `des` varchar(100) NOT NULL,
  `key_points` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `added_by` varchar(5) NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pr_id`, `cat_id`, `name`, `price`, `mfg_yr`, `des`, `key_points`, `url`, `img`, `added_by`, `status`) VALUES
(2, 5, 'P2', '123', '1234', 'ddd', 'fff', 'https://www.google.com', 'images/1553539179.png', '3', '1'),
(3, 11, 'WWII gun', '5000', '1111', 'rrr', 'eew222', 'https://www.google.com', 'images/1553427410.png', '4', '1'),
(5, 8, 'Pensil Sketch', '250', '1999', 'Hand made a pencil sketch made by one of the best artists ', 'different shades of the pencil sketch.', 'www.google.com/Images/sketch.png', 'images/1553706652.jpg', '5', '0'),
(6, 5, 'power of sub conscious mind', '500', '2012', 'best seller book', 'best seller book \r\npower of mind', 'www.google.com/Images/book.png', 'images/1553707778.jpg', '3', '1'),
(7, 17, 'GOLD', '90000', '1785', 'Real Gold', 'Real 24 carat GOLD', 'https://www.google.co.in/search?q=Nobita+image&tbm', 'images/1553708302.jfif', '4', '0'),
(8, 16, 'Sachin bat', '9000', '2000', 'the great Indian former batsman Sachin Tendulkar autograph bat.', 'autograph bat', 'd7kzaa2LQKk5', 'images/1553709132.jfif', '5', '0'),
(9, 16, 'Dhoni bat', '15200', '2000', 'the great Indian former cricketer captain cool had hit six and won the world cup with this bat.', 'Autograph bat', 'd7kzaa2LQKk5', 'images/1553709210.jpg', '3', '1'),
(10, 8, 'MF Painting', '8000', '2000', 'sdsa', 'dsdsd', 'ddd', 'images/1553714849.png', '3', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `ve_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `addr` varchar(50) DEFAULT NULL,
  `status` varchar(5) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`ve_id`, `fname`, `lname`, `email`, `pass`, `dob`, `gender`, `mobile`, `addr`, `status`) VALUES
(1, 'Sunny', 'Vaidya', 'sunny@gmail.com', '123', NULL, NULL, NULL, NULL, '0'),
(2, 'Harshwardhan', 'Patel', 'HarshwardhanPatel@gmail.com', '123', NULL, NULL, NULL, NULL, '0'),
(3, 'Brijesh', 'Shah', 'Brijesh.shah@gmail.com', '123', '2019-03-10', 'Male', '9876543210', 'Gujarat', '1'),
(4, 'Utkarsh', 'Vaishnav', 'Utkarsh.Vaishnav@gmail.com', '123', NULL, NULL, NULL, NULL, '1'),
(5, 'Vatsal', 'Patel', 'Vatsal.patel@gmail.com', '123', NULL, NULL, NULL, NULL, '-1'),
(6, 'Mandeep', 'Singh', 'MandySingh98@gmail.com', '123', NULL, NULL, NULL, NULL, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bids_id`),
  ADD KEY `cu_id` (`cu_id`),
  ADD KEY `bi_id` (`bi_id`);

--
-- Indexes for table `bid_info`
--
ALTER TABLE `bid_info`
  ADD PRIMARY KEY (`bi_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cu_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`ve_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bids_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bid_info`
--
ALTER TABLE `bid_info`
  MODIFY `bi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `ve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`cu_id`) REFERENCES `customer` (`cu_id`),
  ADD CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`bi_id`) REFERENCES `bid_info` (`bi_id`);
