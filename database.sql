-- MySQL dump 10.17  Distrib 10.3.11-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: osma2
-- ------------------------------------------------------
-- Server version	10.3.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `client` varchar(50) NOT NULL,
  `rhEmail` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(20) DEFAULT NULL,
  `lob` varchar(100) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `consume` int(2) NOT NULL,
  `collaborate` int(2) NOT NULL,
  `createOS` int(2) NOT NULL,
  `policy` int(2) NOT NULL,
  `question11` int(2) DEFAULT NULL,
  `question12` int(2) DEFAULT NULL,
  `question13` int(2) DEFAULT NULL,
  `question14` int(2) DEFAULT NULL,
  `question15` int(2) DEFAULT NULL,
  `question21` int(2) DEFAULT NULL,
  `question22` int(2) DEFAULT NULL,
  `question23` int(2) DEFAULT NULL,
  `question24` int(2) DEFAULT NULL,
  `question25` int(2) DEFAULT NULL,
  `question26` int(2) DEFAULT NULL,
  `question31` int(2) DEFAULT NULL,
  `question32` int(2) DEFAULT NULL,
  `question33` int(2) DEFAULT NULL,
  `question41` int(2) DEFAULT NULL,
  `question42` int(2) DEFAULT NULL,
  `question43` int(2) DEFAULT NULL,
  `question44` int(2) DEFAULT NULL,
  `question51` int(2) DEFAULT NULL,
  `question52` int(2) DEFAULT NULL,
  `question53` int(2) DEFAULT NULL,
  `area1_comments` text DEFAULT NULL,
  `area2_comments` text DEFAULT NULL,
  `area3_comments` text DEFAULT NULL,
  `area4_comments` text DEFAULT NULL,
  `area5_comments` text DEFAULT NULL,
  `area6_comments` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-24 13:20:15
