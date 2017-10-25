-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2016 at 07:36 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id_complaint`, `text`, `subject`, `date`, `username`, `approve`, `id_contract`) VALUES
(25, 'Todo bien en stdenis', 'mi primer comment', '2016-02-19 12:25:55', 'yaima', 0, 'St-Denis');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id_name`) VALUES
('Lowney Phase 10'),
('Lowney Phase 11'),
('Lowney Phase 8'),
('Lowney Phase 9');

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
  PRIMARY KEY (`id_reply`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id_reply`, `text`, `date`, `id_parent`, `username`, `approve`) VALUES
(1000019, 'sasas', '2016-02-26 14:09:34', 25, 'mario', 1),
(1000020, 'another test', '2016-02-26 14:27:30', 1000019, 'mario', 1),
(1000021, 'another child', '2016-02-26 14:27:40', 25, 'mario', 1);

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
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `email`, `type`) VALUES
('dennys', 'Mario Dennys', 'dennys', 'dennys@gmail.com', 'Director'),
('eufemio', 'Eufemio Garcia', 'eufemio', 'eufemio@gmail.com', 'Administrator'),
('mario', 'Mario Alejandro', 'mario', 'mario@gmail.com', 'Director'),
('tanguy', 'Tanguy De Ridder', 'tanguy', 'tanguy@gmail.com', 'Manager'),
('yaima', 'Yaima Cordero', 'yaima', 'yaima@gmail.com', 'User'),
('zaida', 'Zaida Fajardo', 'zaida', 'zaida@gmail.com', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users_autorized`
--

DROP TABLE IF EXISTS `users_autorized`;
CREATE TABLE IF NOT EXISTS `users_autorized` (
  `id_complaint` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_autorized`
--

INSERT INTO `users_autorized` (`id_complaint`, `usertype`) VALUES
(36, 'User'),
(37, 'Manager'),
(26, 'User'),
(27, 'User'),
(26, 'Manager'),
(23, 'Administrator'),
(24, 'User'),
(23, 'User'),
(1000005, 'User'),
(25, 'User'),
(38, 'User'),
(38, 'Manager'),
(36, 'Manager'),
(1000007, 'User'),
(1000006, 'Manager'),
(1000007, 'Manager'),
(1000008, 'Manager'),
(1000008, 'User'),
(1000011, 'Manager'),
(1000012, 'User'),
(37, 'User'),
(1000013, 'Manager'),
(1000013, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users_contracts`
--

DROP TABLE IF EXISTS `users_contracts`;
CREATE TABLE IF NOT EXISTS `users_contracts` (
  `id_name_contract` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  KEY `user_constraint` (`username`),
  KEY `contract_constraint` (`id_name_contract`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_contracts`
--

INSERT INTO `users_contracts` (`id_name_contract`, `username`) VALUES
('Lowney Phase 10', 'mario'),
('Lowney Phase 10', 'tanguy'),
('Lowney Phase 10', 'yaima'),
('Lowney Phase 10', 'dennys'),
('Lowney Phase 11', 'dennys'),
('Lowney Phase 11', 'mario'),
('Lowney Phase 8', 'dennys'),
('Lowney Phase 8', 'mario'),
('Lowney Phase 8', 'tanguy'),
('Lowney Phase 8', 'yaima'),
('Lowney Phase 8', 'zaida'),
('Lowney Phase 9', 'dennys'),
('Lowney Phase 9', 'eufemio'),
('Lowney Phase 9', 'mario'),
('Lowney Phase 9', 'tanguy'),
('Lowney Phase 9', 'yaima');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_autorized``
-- when a complaint or a reply is deleted -> delete autorization to see this comment
ALTER TABLE `users_autorized`
  ADD CONSTRAINT `user_complaint_fkc` FOREIGN KEY (`id_complaint`) REFERENCES `complaints` (`id_complaint`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_reply_fkc` FOREIGN KEY (`id_complaint`) REFERENCES `reply` (`id_reply`) ON DELETE CASCADE;

--
-- Constraints for table `users_contracts`
-- when delete an user or a contract delete it from users_contract as well
ALTER TABLE `users_contracts`
  ADD CONSTRAINT `contract_constraint_fkc` FOREIGN KEY (`id_name_contract`) REFERENCES `contracts` (`id_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_constraint_fkc` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
