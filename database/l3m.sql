-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2013 at 02:21 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

--
-- Database: `l3m`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `name` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`name`)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `email`, `company`, `type`) VALUES
('admin', 'admin', 'admin@lestroismarios.com', 'L3M', 1),
('user', 'user', 'user@lestroismarios.com', 'L3M', 2);


-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--
DROP TABLE IF EXISTS `complaints`;
CREATE TABLE `complaints` (
  `idcomplaint` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `subject` text NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(15) NOT NULL,
  PRIMARY KEY (`idcomplaint`),
  KEY `username` (`username`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `idanswer` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `ncomplaint` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  PRIMARY KEY (`idanswer`),
  KEY `username` (`username`),
  KEY `ncomplaint`(`ncomplaint`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`name`) ON DELETE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`ncomplaint`) REFERENCES `complaints` (`idcomplaint`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `photo`
--
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `idcomplaint` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `filesize` float NOT NULL,
  PRIMARY KEY (`idcomplaint`,`filename`),
  KEY `idcomplaint` (`idcomplaint`),
  CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`idcomplaint`) REFERENCES `complaints` (`idcomplaint`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------



