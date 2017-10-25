-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2016 at 04:42 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;


--
-- Database: `l3m`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
CREATE TABLE IF NOT EXISTS `complaints` (
  `id_complaint` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `subject` text NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(15) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `id_contract` varchar(100) NOT NULL,
  PRIMARY KEY (`id_complaint`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `filesize` float NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`filename`),
  KEY `idcomplaint` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply` (
  `id_reply` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `id_parent` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `approve` int(11) NOT NULL,
  `id_contract` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_reply`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `notify` int(11) DEFAULT '1',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `email`, `type`, `notify`) VALUES
('mario', 'Mario Alejandro', 'mario', 'mariowhite2007@gmail.com', 'Director', 1);



-- --------------------------------------------------------

--
-- Table structure for table `users_autorized`
--

DROP TABLE IF EXISTS `users_autorized`;
CREATE TABLE IF NOT EXISTS `users_autorized` (
  `id_complaint` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`id_complaint`,`usertype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `users_contracts`
--

DROP TABLE IF EXISTS `users_contracts`;
CREATE TABLE IF NOT EXISTS `users_contracts` (
  `id_name_contract` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id_name_contract`,`username`),
  KEY `user_constraint` (`username`),
  KEY `contract_constraint` (`id_name_contract`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_autorized`
--
ALTER TABLE `users_autorized`
  ADD CONSTRAINT `user_complaint_fkc` FOREIGN KEY (`id_complaint`) REFERENCES `complaints` (`id_complaint`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_reply_fkc` FOREIGN KEY (`id_complaint`) REFERENCES `reply` (`id_reply`) ON DELETE CASCADE;

--
-- Constraints for table `users_contracts`
--
ALTER TABLE `users_contracts`
  ADD CONSTRAINT `contract_constraint_fkc` FOREIGN KEY (`id_name_contract`) REFERENCES `contracts` (`id_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_constraint_fkc` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
