-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2020 at 06:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logintest`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(20) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `CWID` int(20) NOT NULL,
  PRIMARY KEY (`class_id`),
  KEY `CWID` (`CWID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `CWID`) VALUES
(1, 'CSPC362', 12345678),
(2, 'CSPC431', 12345678),
(3, 'CSPC471', 12345678),
(4, 'math123', 12345678),
(5, 'MATH333', 12345678);

-- --------------------------------------------------------

--
-- Table structure for table `class_task`
--

DROP TABLE IF EXISTS `class_task`;
CREATE TABLE IF NOT EXISTS `class_task` (
  `task_name` varchar(100) NOT NULL,
  `task_detail` text NOT NULL,
  `task_duedate` date NOT NULL,
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(20) NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_task`
--

INSERT INTO `class_task` (`task_name`, `task_detail`, `task_duedate`, `task_id`, `class_id`) VALUES
('ASSIGNMENT1', 'detail of assignment1', '2020-04-01', 1, 1),
('Assignment2', 'detail of assignment2', '2020-04-08', 2, 1),
('homework1', 'detail of homework1', '2020-04-02', 3, 2),
('lab1', 'No detail', '2020-04-03', 4, 3),
('lab1', 'none', '2020-04-04', 5, 4),
('TASK1', 'none', '2020-04-05', 6, 5),
('lab2', '123', '2020-04-14', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_name` varchar(20) NOT NULL,
  `event_detail` text NOT NULL,
  `event_date` date NOT NULL,
  `CWID` int(20) NOT NULL,
  `event_id` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`event_id`),
  KEY `CWID` (`CWID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `CWID` int(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`CWID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`CWID`, `firstname`, `lastname`, `username`, `password`) VALUES
(8888889, 'Yixiang', 'Yan', 'test1', '123'),
(12345678, 'Yixiang', 'Yan', 'test123', '123'),
(88888888, 'Yixiang', 'Yan', 'test', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`CWID`) REFERENCES `users` (`CWID`);

--
-- Constraints for table `class_task`
--
ALTER TABLE `class_task`
  ADD CONSTRAINT `class_task_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`CWID`) REFERENCES `users` (`CWID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
