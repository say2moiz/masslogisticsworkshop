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
-- Table structure for table `part`
--

DROP TABLE IF EXISTS `part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part` (
  `idPart` int(11) NOT NULL AUTO_INCREMENT,
  `idStore` int(11) NOT NULL,
  `partName` varchar(50) NOT NULL,
  `partType` varchar(45) NOT NULL,
  `partNumber` varchar(45) NOT NULL,
  `datePartCreated` datetime NOT NULL,
  PRIMARY KEY (`idPart`),
  KEY `idStore` (`idStore`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part`
--

LOCK TABLES `part` WRITE;
/*!40000 ALTER TABLE `part` DISABLE KEYS */;
INSERT INTO `part` (`idPart`, `idStore`, `partName`, `partType`, `partNumber`, `datePartCreated`) VALUES (1,1,'Tyre','Specialized','ssss','2014-10-04 04:47:22'),(2,1,'Tube','general type','tG3024','2014-10-04 04:54:05'),(3,1,'chk part','aaa','aaa','2014-10-04 05:07:07'),(4,1,'new\'/\'/\'/  \'\'\'/// /\'\'\'\'!@#$%^&*()_+{}|:\"?><[];\'\\,.','Specialized','chk part','2014-10-04 22:26:50'),(5,1,'New Part Remote Chk','Chk','CHK','2014-10-05 00:27:59'),(6,1,'Test Part','Specialized','Test1','2014-10-06 11:34:56');
/*!40000 ALTER TABLE `part` ENABLE KEYS */;
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
