-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2014 at 02:43 PM
-- Server version: 5.1.41-community-log
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
-- Table structure for table `all_post_contents`
--

DROP TABLE IF EXISTS `all_post_contents`;
CREATE TABLE IF NOT EXISTS `all_post_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `desc` text,
  `img_url` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_img_url` varchar(255) DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `is_added_by_skater` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `all_post_contents`
--

INSERT INTO `all_post_contents` (`id`, `desc`, `img_url`, `link_url`, `link_img_url`, `link_title`, `is_added_by_skater`, `created_date`) VALUES
(1, NULL, '/img/cake.power.gif', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `profile_img_id` int(11) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `launched_year` year(4) DEFAULT NULL,
  `closed_year` year(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `profile_img_id`, `alias`, `launched_year`, `closed_year`, `created_date`) VALUES
(1, 'Nike SB', 0, 'nikesb', 0000, 0000, '0000-00-00 00:00:00'),
(2, 'DVS', 0, 'dvs', 0000, 0000, '0000-00-00 00:00:00'),
(6, 'Lakai', 4, 'lakai', 2007, 0000, '2014-08-18 13:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `company_videos`
--

DROP TABLE IF EXISTS `company_videos`;
CREATE TABLE IF NOT EXISTS `company_videos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `video_id` int(11) unsigned NOT NULL,
  `is_created_by_skater` int(11) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `company_videos`
--

INSERT INTO `company_videos` (`id`, `company_id`, `video_id`, `is_created_by_skater`, `created_date`) VALUES
(1, 0, 1, NULL, '2014-08-18 13:22:05'),
(2, 0, 2, NULL, '2014-08-18 13:22:05'),
(3, 6, 7, NULL, '2014-08-25 02:44:46'),
(4, 1, 7, NULL, '2014-08-25 02:44:46'),
(5, 1, 7, NULL, '2014-08-25 02:44:46'),
(6, 1, 7, NULL, '2014-08-25 02:44:46'),
(7, 6, 8, NULL, '2014-08-25 02:45:36'),
(8, 1, 8, NULL, '2014-08-25 02:45:36'),
(9, 6, 9, NULL, '2014-08-25 02:46:28'),
(10, 1, 9, NULL, '2014-08-25 02:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `content_skater_relations`
--

DROP TABLE IF EXISTS `content_skater_relations`;
CREATE TABLE IF NOT EXISTS `content_skater_relations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `skater_id` int(11) unsigned NOT NULL,
  `content_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `content_skater_relations`
--

INSERT INTO `content_skater_relations` (`id`, `skater_id`, `content_id`) VALUES
(1, 13, 1);

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
  `profile_img_id` int(11) unsigned DEFAULT NULL,
  `stance` tinyint(3) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `is_owned_by` int(11) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `skaters`
--

INSERT INTO `skaters` (`id`, `firstname`, `middlename`, `lastname`, `alias`, `birthdate`, `profile_img_id`, `stance`, `status`, `is_owned_by`, `created_date`) VALUES
(4, 'Duc', NULL, 'Phan', 'Duc_Phan', NULL, 0, NULL, NULL, 15, '2014-07-29 08:57:31'),
(6, 'Duca', '', 'Phan', 'duca_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(7, 'don', 'Viet', 'Phan', 'don_phan', NULL, 1, 0, 3, NULL, '0000-00-00 00:00:00'),
(8, 'dona', 'Viet', 'Phan', 'dona_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(9, 'Ducdon', 'Viet', 'Phan', 'ducdon_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(10, 'Ducdona', 'Viet', 'Phan', 'ducdona_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(11, 'Nyjah', '', 'Huston', 'nyjah_huston', NULL, NULL, 1, 0, NULL, '0000-00-00 00:00:00'),
(12, 'Ducas', 'Viet', 'Phan', 'ducas_phan', NULL, NULL, 0, 3, NULL, '0000-00-00 00:00:00'),
(13, 'Ducasdf', 'Viet', 'Phan', 'ducasdf_phan', NULL, 1, 0, 3, NULL, '2014-08-26 14:36:05');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `skater_sponsors`
--

INSERT INTO `skater_sponsors` (`id`, `company_id`, `skater_id`, `is_created_by_skater`, `created_date`) VALUES
(2, 1, 6, NULL, '2014-08-09 04:22:30'),
(3, 1, 7, NULL, '2014-08-09 06:04:00'),
(4, 1, 11, NULL, '2014-08-12 04:59:27'),
(5, 1, 12, NULL, '2014-08-15 15:03:52'),
(10, 6, 7, NULL, '2014-08-18 13:22:05'),
(11, 6, 6, NULL, '2014-08-18 13:22:05'),
(12, 6, 4, NULL, '2014-08-18 13:22:05');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `skater_videos`
--

INSERT INTO `skater_videos` (`id`, `video_id`, `skater_id`, `is_created_by_skater`, `created_date`) VALUES
(2, 1, 6, NULL, '2014-08-09 04:22:30'),
(3, 1, 7, NULL, '2014-08-09 06:04:00'),
(4, 1, 11, NULL, '2014-08-12 04:59:27'),
(5, 1, 3, NULL, '2014-08-18 12:52:56'),
(6, 9, 7, NULL, '2014-08-25 02:46:28'),
(7, 9, 8, NULL, '2014-08-25 02:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
CREATE TABLE IF NOT EXISTS `tricks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `is_created_by_skater` int(11) unsigned NOT NULL,
  `is_invented_by_skater` int(11) unsigned NOT NULL,
  `alias` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(150) NOT NULL,
  `desc` text NOT NULL,
  `profile_img_id` int(11) unsigned DEFAULT NULL,
  `released_date` year(4) DEFAULT NULL,
  `running_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `alias`, `desc`, `profile_img_id`, `released_date`, `running_time`) VALUES
(1, 'Fully flared', 'fully_flared', '', 1, 0000, NULL),
(2, 'Dirty Head', 'dirty_head', '', 2, 0000, NULL),
(3, 'Remote Control Alligator Prank', 'remote_control_alligator_prank', 'After the popularity of the 1st alligator prank we had to do it again. We hope you enjoy this video. Subscribe for more! http://www.youtube.com/user/pranks?s...', NULL, NULL, NULL),
(6, 'DERO密室游戏大脱逃第22集', 'dero222', ' ', 4, NULL, NULL),
(7, 'DERO密室游戏大脱逃第22集', 'dero22asdf', ' ', 5, NULL, NULL),
(8, 'DERO密室游戏大脱逃第22集', 'dero2212', ' ', 6, NULL, NULL),
(9, 'DERO密室游戏大脱逃第22集', 'dero22', ' ', 7, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
