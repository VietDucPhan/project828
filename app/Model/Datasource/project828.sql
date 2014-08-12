-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2014 at 10:04 AM
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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `launched_year` year(4) DEFAULT NULL,
  `closed_year` year(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `alias`, `launched_year`, `closed_year`, `created_date`) VALUES
(1, 'Nike SB', 'nikesb', 0000, 0000, '0000-00-00 00:00:00'),
(2, 'DVS', 'dvs', 0000, 0000, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_post_images`
--

DROP TABLE IF EXISTS `company_post_images`;
CREATE TABLE IF NOT EXISTS `company_post_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `desc` text,
  `url` varchar(255) NOT NULL,
  `is_owned_by_company` int(11) NOT NULL,
  `posted_by_skater` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_post_images`
--

INSERT INTO `company_post_images` (`id`, `desc`, `url`, `is_owned_by_company`, `posted_by_skater`, `created_date`) VALUES
(1, NULL, 'https://skaterprofile.s3.amazonaws.com/324ef046287cc0f3f6f2a3f09a7f8e41a6d3de16_a6e6ea6c1efe5352b8ceba94451aad9792aec7b6.png', 1, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skaters`
--

DROP TABLE IF EXISTS `skaters`;
CREATE TABLE IF NOT EXISTS `skaters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(14) DEFAULT NULL,
  `middlename` varchar(20) DEFAULT NULL,
  `lastname` varchar(15) DEFAULT NULL,
  `alias` varchar(30) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `profile_img` int(11) unsigned DEFAULT NULL,
  `stance` tinyint(3) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `is_owned_by` int(11) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `skaters`
--

INSERT INTO `skaters` (`id`, `firstname`, `middlename`, `lastname`, `alias`, `birthdate`, `profile_img`, `stance`, `status`, `is_owned_by`, `created_date`) VALUES
(4, 'Duc', NULL, 'Phan', 'Duc_Phan', NULL, 0, NULL, NULL, 15, '2014-07-29 08:57:31'),
(6, 'Duca', '', 'Phan', 'duca_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(7, 'don', 'Viet', 'Phan', 'don_phan', NULL, 1, 0, 3, NULL, '0000-00-00 00:00:00'),
(8, 'dona', 'Viet', 'Phan', 'dona_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(9, 'Ducdon', 'Viet', 'Phan', 'ducdon_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(10, 'Ducdona', 'Viet', 'Phan', 'ducdona_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(11, 'Nyjah', '', 'Huston', 'nyjah_huston', NULL, NULL, 1, 0, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skater_post_images`
--

DROP TABLE IF EXISTS `skater_post_images`;
CREATE TABLE IF NOT EXISTS `skater_post_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `is_owned_by_skater` int(11) unsigned DEFAULT NULL,
  `posted_by_skater` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `skater_post_images`
--

INSERT INTO `skater_post_images` (`id`, `url`, `desc`, `is_owned_by_skater`, `posted_by_skater`, `created_date`) VALUES
(1, 'https://skaterprofile.s3.amazonaws.com/324ef046287cc0f3f6f2a3f09a7f8e41a6d3de16_a6e6ea6c1efe5352b8ceba94451aad9792aec7b6.png', '', 7, NULL, '2014-08-09 06:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `skater_sponsors`
--

DROP TABLE IF EXISTS `skater_sponsors`;
CREATE TABLE IF NOT EXISTS `skater_sponsors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `skater_id` int(11) NOT NULL,
  `is_created_by_skater` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `skater_sponsors`
--

INSERT INTO `skater_sponsors` (`id`, `company_id`, `skater_id`, `is_created_by_skater`, `created_date`) VALUES
(2, 1, 6, NULL, '2014-08-09 04:22:30'),
(3, 1, 7, NULL, '2014-08-09 06:04:00'),
(4, 1, 11, NULL, '2014-08-12 04:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `skater_videos`
--

DROP TABLE IF EXISTS `skater_videos`;
CREATE TABLE IF NOT EXISTS `skater_videos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(11) unsigned NOT NULL,
  `skater_id` int(11) unsigned NOT NULL,
  `is_created_by_skater` int(11) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `skater_videos`
--

INSERT INTO `skater_videos` (`id`, `video_id`, `skater_id`, `is_created_by_skater`, `created_date`) VALUES
(2, 1, 6, NULL, '2014-08-09 04:22:30'),
(3, 1, 7, NULL, '2014-08-09 06:04:00'),
(4, 1, 11, NULL, '2014-08-12 04:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`) VALUES
(1, 'Fully flared'),
(2, 'Dirty Head');

-- --------------------------------------------------------

--
-- Table structure for table `video_post_images`
--

DROP TABLE IF EXISTS `video_post_images`;
CREATE TABLE IF NOT EXISTS `video_post_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc` text,
  `url` varchar(255) NOT NULL,
  `is_owned_by_video` int(11) unsigned NOT NULL,
  `posted_by_skater` int(11) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `video_post_images`
--

INSERT INTO `video_post_images` (`id`, `desc`, `url`, `is_owned_by_video`, `posted_by_skater`, `created_date`) VALUES
(1, NULL, 'https://skaterprofile.s3.amazonaws.com/324ef046287cc0f3f6f2a3f09a7f8e41a6d3de16_a6e6ea6c1efe5352b8ceba94451aad9792aec7b6.png', 1, NULL, '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
