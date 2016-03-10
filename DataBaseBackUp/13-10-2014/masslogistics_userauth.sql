CREATE DATABASE  IF NOT EXISTS `masslogistics` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `masslogistics`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: masslogistics
-- ------------------------------------------------------
-- Server version	5.6.12-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `userauth`
--

DROP TABLE IF EXISTS `userauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userauth` (
  `idUserAuth` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `accessLevel` int(11) NOT NULL,
  `dateUserCreated` datetime NOT NULL,
  `dateUserUpdated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUserAuth`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userauth`
--

LOCK TABLES `userauth` WRITE;
/*!40000 ALTER TABLE `userauth` DISABLE KEYS */;
INSERT INTO `userauth` (`idUserAuth`, `userName`, `password`, `email`, `accessLevel`, `dateUserCreated`, `dateUserUpdated`) VALUES (1,'masslogistics','logistics','masslogistics4@gmail.com',0,'2014-05-01 01:17:13',''),(2,'admin','amoiz','amoiz1992@gmail.com',100,'2014-05-01 01:18:09',NULL),(3,'sohail','sohail','sohail@gmail.com',10,'2014-05-01 02:51:19',NULL),(4,'admin','123','addasda',22,'2014-10-04 18:27:33',NULL),(5,'admin','123','addasda',22,'2014-10-04 18:28:17',NULL),(6,'admin123','123','dasdasd',100,'2014-10-04 19:38:41',NULL),(7,'admin223','dddd','ddddd',0,'2014-10-04 19:39:35',NULL),(8,'admin224','ddddddd','ddd',0,'2014-10-04 19:41:11',NULL),(9,'username','ddd','ddd',0,'2014-10-04 19:41:29',NULL),(10,'user','sss','sss',0,'2014-10-04 19:42:26',NULL),(11,'admin1234','ddd','ddd',0,'2014-10-04 19:47:41',NULL),(12,'dddd','dddd','dddd',0,'2014-10-04 19:47:58',NULL),(13,'ddd','dddd','dddd',0,'2014-10-04 19:48:06',NULL),(14,'Abdul Moiz Baig','abdulmoizbaig','amoiz1992@gmail.com',100,'2014-10-04 21:00:10',NULL);
/*!40000 ALTER TABLE `userauth` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-13  1:19:31
