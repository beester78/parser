﻿# SQL Manager for MySQL 5.5.1.45563
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ukol


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `ukol`
    CHARACTER SET 'utf8mb4'
    COLLATE 'utf8mb4_general_ci';

USE `ukol`;

#
# Structure for the `scraped_data` table :
#

CREATE TABLE `scraped_data` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `description` VARCHAR(1000) COLLATE utf8_czech_ci DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB
AUTO_INCREMENT=1 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_czech_ci'
;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;