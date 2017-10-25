-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2016 at 05:26 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-05:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `l3m`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `id_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

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

CREATE TABLE IF NOT EXISTS `reply` (
  `id_reply` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `id_parent` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `approve` int(11) NOT NULL,
  PRIMARY KEY (`id_reply`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000000 ;



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `email`, `type`) VALUES
('mario', 'Mario Alejandro', 'mario', 'mariowhite2007@yahoo.es', 'Director');


-- --------------------------------------------------------

--
-- Table structure for table `users_contracts`
--

CREATE TABLE IF NOT EXISTS `users_contracts` (
  `id_name_contract` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  KEY `user_constraint` (`username`),
  KEY `contract_constraint` (`id_name_contract`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`id`) REFERENCES `complaints` (`id_complaint`) ON DELETE CASCADE;

--
-- Constraints for table `users_contracts`
--
ALTER TABLE `users_contracts`
  ADD CONSTRAINT `contract_constraint` FOREIGN KEY (`id_name_contract`) REFERENCES `contracts` (`id_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_constraint` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
