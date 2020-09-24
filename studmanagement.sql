-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2020 at 06:11 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `cid` int(11) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`cid`, `course_name`, `status`) VALUES
(1, 'B.com', 1),
(2, 'BCA', 1),
(3, 'BA. English', 1),
(4, 'BA. Malayalam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `logid` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(300) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'student',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`logid`, `email`, `password`, `type`, `status`) VALUES
(5, 'noel@gmail.com', 'password', 'student', 1),
(9, 'blabla@gmail.com', 'pass', 'inst', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manage_registration`
--

CREATE TABLE `tbl_manage_registration` (
  `manageid` int(11) NOT NULL,
  `management_username` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `mlogid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_manage_registration`
--

INSERT INTO `tbl_manage_registration` (`manageid`, `management_username`, `address`, `mlogid`, `status`) VALUES
(1, 'bla bla', 'ajsbak', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stud_registration`
--

CREATE TABLE `tbl_stud_registration` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `courseid` int(11) NOT NULL,
  `logid` int(11) NOT NULL,
  `manageid` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stud_registration`
--

INSERT INTO `tbl_stud_registration` (`userid`, `username`, `address`, `dob`, `gender`, `courseid`, `logid`, `manageid`, `status`) VALUES
(1, 'noel', 'dddddddddddddddddd', '1997-09-07', 'male', 1, 5, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `tbl_manage_registration`
--
ALTER TABLE `tbl_manage_registration`
  ADD PRIMARY KEY (`manageid`);

--
-- Indexes for table `tbl_stud_registration`
--
ALTER TABLE `tbl_stud_registration`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_manage_registration`
--
ALTER TABLE `tbl_manage_registration`
  MODIFY `manageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_stud_registration`
--
ALTER TABLE `tbl_stud_registration`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
