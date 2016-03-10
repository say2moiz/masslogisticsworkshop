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
-- Table structure for table `stocktransaction`
--

DROP TABLE IF EXISTS `stocktransaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocktransaction` (
  `idStockTransaction` int(11) NOT NULL AUTO_INCREMENT,
  `idPart` int(11) NOT NULL,
  `idBrand` int(11) NOT NULL,
  `idPurchase` int(11) DEFAULT NULL,
  `availableStock` int(11) NOT NULL,
  `totalWorthOfAvailableStock` double NOT NULL,
  `additionInStock` int(11) NOT NULL,
  `subtractionFromStock` int(11) NOT NULL,
  `dateTransaction` datetime NOT NULL,
  `userDateTransaction` datetime NOT NULL,
  `editStockTransactionFlag` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`idStockTransaction`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocktransaction`
--

LOCK TABLES `stocktransaction` WRITE;
/*!40000 ALTER TABLE `stocktransaction` DISABLE KEYS */;
INSERT INTO `stocktransaction` (`idStockTransaction`, `idPart`, `idBrand`, `idPurchase`, `availableStock`, `totalWorthOfAvailableStock`, `additionInStock`, `subtractionFromStock`, `dateTransaction`, `userDateTransaction`, `editStockTransactionFlag`, `userId`) VALUES (1,1,1,1,6,30000,6,0,'2014-10-06 02:29:00','2014-10-02 00:00:00',1,1),(2,2,1,2,3,3000,3,0,'2014-10-06 02:33:00','2014-10-03 00:00:00',1,1),(3,1,1,3,8,40000,2,0,'2014-10-06 02:34:19','2014-10-04 00:00:00',0,1),(4,2,1,4,6,6000,3,0,'2014-10-06 02:35:36','2014-10-04 00:00:00',0,1),(5,1,1,1,5,25000,0,3,'2014-10-06 02:37:05','2014-10-01 00:00:00',0,1),(6,1,1,1,2,10000,0,3,'2014-10-06 02:42:42','2014-10-05 00:00:00',0,1),(7,1,1,5,8,40000,6,0,'2014-10-06 02:56:23','2014-10-05 00:00:00',1,1),(8,1,1,3,7,35000,0,1,'2014-10-06 03:02:25','2014-10-05 00:00:00',0,1),(9,1,1,6,9,45000,2,0,'2014-10-06 10:52:45','2014-10-05 00:00:00',0,1),(10,6,3,7,3,6000,3,0,'2014-10-06 11:38:05','2014-10-05 00:00:00',0,1),(11,6,3,7,2,4000,0,1,'2014-10-06 11:47:55','2014-10-08 00:00:00',0,1),(12,6,3,7,1,2000,0,1,'2014-10-06 13:31:23','2014-10-12 00:00:00',0,1),(13,-1,-1,0,0,0,0,1,'2014-10-06 14:57:46','2014-10-20 00:00:00',0,1),(14,-1,-1,0,0,0,0,1,'2014-10-06 14:59:01','2014-10-06 00:00:00',0,1),(15,-1,-1,0,0,0,0,1,'2014-10-06 15:01:37','2014-10-07 00:00:00',0,1),(16,-1,-1,0,0,0,0,1,'2014-10-06 15:05:47','2014-10-02 00:00:00',0,1),(17,-1,-1,0,0,0,0,1,'2014-10-06 15:06:12','2014-10-06 00:00:00',0,1),(18,1,1,3,8,40000,0,1,'2014-10-06 15:19:08','2014-10-12 00:00:00',0,1),(19,1,1,5,5,25000,0,3,'2014-10-06 15:21:22','2014-10-13 00:00:00',0,1),(20,1,1,0,0,0,0,6,'2014-10-07 03:38:46','2014-10-07 00:00:00',0,1),(21,2,1,2,4,4000,0,2,'2014-10-07 04:56:54','2014-10-22 00:00:00',0,1),(22,2,1,4,2,2000,0,2,'2014-10-08 06:36:40','2014-10-23 00:00:00',0,2);
/*!40000 ALTER TABLE `stocktransaction` ENABLE KEYS */;
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
