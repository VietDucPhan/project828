-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2014 at 09:42 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project828`
--
CREATE DATABASE IF NOT EXISTS `project828` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project828`;

-- --------------------------------------------------------

--
-- Table structure for table `skaters`
--

CREATE TABLE IF NOT EXISTS `skaters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(15) DEFAULT NULL,
  `middlename` varchar(20) DEFAULT NULL,
  `lastname` varchar(15) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `profile_img` int(11) unsigned DEFAULT NULL,
  `stance` tinyint(3) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `is_owned_by` int(11) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `skaters`
--

INSERT INTO `skaters` (`id`, `firstname`, `middlename`, `lastname`, `username`, `birthdate`, `profile_img`, `stance`, `status`, `is_owned_by`, `created_date`) VALUES
(4, 'Duc', NULL, 'Phan', 'Duc_Phan', NULL, 0, NULL, NULL, 15, '2014-07-29 08:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `skater_images`
--

CREATE TABLE IF NOT EXISTS `skater_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) NOT NULL DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL,
  `resetCode` varchar(100) NOT NULL,
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `block`, `sendEmail`, `registerDate`, `lastvisitDate`, `activation`, `resetCode`, `lastResetTime`, `config`) VALUES
(15, 'joomdaily@gmail.com', '$2a$10$R1wOGsrLGHAIm9KKbGzVROBukgJj/UMxFiOqpd7pu2hf.Gqr8WbYK', 0, 0, '2014-07-21 15:21:48', '2014-07-31 00:55:16', '7041d283d4376704700e7b756157691c5ef64ba8', '', '0000-00-00 00:00:00', ''),
(23, 'viet_duc_phan@yahoo.com', '$2a$10$pkqMKrw2cNXRdJV1X5hch.Y1fkrTilat.CLr.OH7kWLxFBuvGzkHi', 0, 0, '2014-07-29 08:57:31', '2014-07-29 09:11:08', '0', '', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
