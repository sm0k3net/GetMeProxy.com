-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2017 at 05:50 AM
-- Server version: 5.5.53
-- PHP Version: 5.4.45-0+deb7u6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `getmeproxy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tools_proxy`
--

CREATE TABLE IF NOT EXISTS `tools_proxy` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `proxy` varchar(25) NOT NULL,
  `location` text NOT NULL,
  `region` text NOT NULL,
  `type` varchar(12) NOT NULL,
  `conn_time` varchar(20) NOT NULL,
  `anonymity` varchar(24) NOT NULL,
  `status` varchar(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10716 ;
