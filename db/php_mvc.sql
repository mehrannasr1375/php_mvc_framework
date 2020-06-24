-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2020 at 10:53 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_mvc`
--
CREATE DATABASE IF NOT EXISTS `php_mvc` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;
USE `php_mvc`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8_persian_ci DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `online` tinyint(1) DEFAULT '0',
  `acl` varchar(500) COLLATE utf8_persian_ci DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '1',
  `mobile` varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
  `province` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `township` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `postal_code` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `activation_code` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `creation_time` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `mobile_UNIQUE` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `full_name`, `username`, `email`, `password`, `enabled`, `online`, `acl`, `gender`, `mobile`, `province`, `township`, `address`, `postal_code`, `activation_code`, `creation_time`, `deleted`) VALUES
(1, 'mehran nasr', 'mehran', 'test4@gmail.com', '$2y$10$40TicU9UiNig1hY40kvYY.g9Qq.3q29/kYxTMOVzZToEDnnuy6mlC', 1, 0, '[\"Gold\", \"SuperAdmin\"]', 1, '09035438619', 'isfahan', 'shahreza', 'ادرس در اینجا قرار گرفته است. البته این یک ادرس دروغی است ادرس در اینجا قرار گرفته است. البته این یک ادرس دروغی است', '8613713788', '120877', 1584955218, 0),
(2, 'ali', 'ali', 'test@gmail.com', '$2y$10$40TicU9UiNig1hY40kvYY.g9Qq.3q29/kYxTMOVzZToEDnnuy6mlC', 0, 0, 'registered', 1, '03245324532', 'province', 'township', 'ادرس در اینجا قرار گرفته است. البته این یک ادرس دروغی است', '8613713788', 'c4ca1101e0c6d9df50f55811bd5c2521', 1584955218, 0),
(3, 'reza', 'reza', 'test2@gmail.com', '$2y$10$40TicU9UiNig1hY40kvYY.g9Qq.3q29/kYxTMOVzZToEDnnuy6mlC', 1, 0, 'registered', 1, '09990875652', 'تهران', 'ورامین', 'ادرس در اینجا قرار گرفته است. البته این یک ادرس دروغی است ادرس در اینجا قرار گرفته است. البته این یک ادرس دروغی است', '8613713788', '12345', 1584955218, 0),
(4, 'hassan', 'hassan', 'test3@gmail.com', '$2y$10$40TicU9UiNig1hY40kvYY.g9Qq.3q29/kYxTMOVzZToEDnnuy6mlC', 1, 0, 'registered', 1, '09999935922', 'اصفهان', 'آران و بیدگل', 'ادرس در اینجا قرار گرفته است. البته این یک ادرس دروغی است ادرس در اینجا قرار گرفته است. البته این یک ادرس دروغی است', '8613713788', '12345', 1584955218, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_sessions`
--

DROP TABLE IF EXISTS `tbl_user_sessions`;
CREATE TABLE IF NOT EXISTS `tbl_user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `session` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
