-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2014 at 08:33 PM
-- Server version: 5.5.40-36.1-log
-- PHP Version: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jabouzic_pizza_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(40) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`customer_id`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Triggers `customer`
--
DROP TRIGGER IF EXISTS `customer_insert`;
DELIMITER //
CREATE TRIGGER `customer_insert` BEFORE INSERT ON `customer`
 FOR EACH ROW BEGIN
    SET NEW.date_created = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

DROP TABLE IF EXISTS `pizza`;
CREATE TABLE IF NOT EXISTS `pizza` (
  `pizza_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `ingredient_1` bit(1) NOT NULL DEFAULT b'0',
  `ingredient_2` bit(1) NOT NULL DEFAULT b'0',
  `ingredient_3` bit(1) NOT NULL DEFAULT b'0',
  `delivery` bit(1) NOT NULL DEFAULT b'0',
  `price` decimal(10,2) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` datetime NOT NULL,
  `canceled` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`pizza_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `pizza_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `pizza`
--
DROP TRIGGER IF EXISTS `pizza_insert`;
DELIMITER //
CREATE TRIGGER `pizza_insert` BEFORE INSERT ON `pizza`
 FOR EACH ROW BEGIN
    SET NEW.date_created = NOW();
END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
