-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 29, 2012 at 01:49 AM
-- Server version: 5.1.63
-- PHP Version: 5.3.2-1ubuntu4.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `formality`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) DEFAULT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `perishable_token` varchar(64) DEFAULT NULL,
  `logins` int(10) unsigned DEFAULT '0',
  `last_login_at` datetime DEFAULT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`password`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `email_3` (`email`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `perishable_token`, `logins`, `last_login_at`, `ip_address`, `created`, `modified`, `deleted`) VALUES
(1, 'tlorens@corevitals.com', 'Timothy', 'Lorens', 'd25fcb25c19617d26fadae8e9b95748b29c4a32e', NULL, 4, '2012-10-29 01:07:00', '173.78.219.233', '2012-10-29 00:55:48', '2012-10-29 01:07:00', NULL);
