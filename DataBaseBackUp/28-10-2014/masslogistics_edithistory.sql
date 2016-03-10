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
-- Table structure for table `edithistory`
--

DROP TABLE IF EXISTS `edithistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edithistory` (
  `idEditHistory` int(11) NOT NULL AUTO_INCREMENT,
  `idPurchase` int(11) NOT NULL,
  `idBrand` int(11) NOT NULL,
  `idPart` int(11) NOT NULL,
  `idBuyer` int(11) NOT NULL,
  `idSeller` int(11) NOT NULL,
  `systemPurchaseDate` datetime NOT NULL,
  `purchasedFor` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `price` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `userPurchaseDate` date NOT NULL,
  `unitOfPurchase` varchar(45) NOT NULL,
  `editPurchaseFlag` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `editId` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEditHistory`),
  KEY `idBrand` (`idBrand`),
  KEY `idPart` (`idPart`),
  KEY `idBuyer` (`idBuyer`),
  KEY `idSeller` (`idSeller`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edithistory`
--

LOCK TABLES `edithistory` WRITE;
/*!40000 ALTER TABLE `edithistory` DISABLE KEYS */;
INSERT INTO `edithistory` (`idEditHistory`, `idPurchase`, `idBrand`, `idPart`, `idBuyer`, `idSeller`, `systemPurchaseDate`, `purchasedFor`, `remarks`, `price`, `quantity`, `userPurchaseDate`, `unitOfPurchase`, `editPurchaseFlag`, `userId`, `editId`) VALUES (1,1,1,1,1,1,'2014-10-06 02:26:58','Car','New',5000,7,'2014-10-02','Numbers',1,1,NULL),(2,1,1,1,1,1,'2014-10-06 02:28:59','Car','New',5000,6,'2014-10-02','Numbers',0,1,'1'),(3,2,1,2,2,2,'2014-10-06 02:31:16','Car','New',1000,4,'2014-10-03','Numbers',1,1,NULL),(4,2,1,2,2,2,'2014-10-06 02:33:00','Car','Checking',1000,3,'2014-10-03','Numbers',0,1,'3'),(5,5,1,1,1,1,'2014-10-06 02:43:39','Car','Testing GOod',5000,10,'2014-10-05','Numbers',1,1,NULL),(6,5,1,1,1,1,'2014-10-06 02:56:23','Car','Testing GOod',5000,6,'2014-10-05','Numbers',0,1,'5');
/*!40000 ALTER TABLE `edithistory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-28  0:22:31
