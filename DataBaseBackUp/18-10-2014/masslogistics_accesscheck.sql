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
-- Table structure for table `accesscheck`
--

DROP TABLE IF EXISTS `accesscheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesscheck` (
  `idAccessCheck` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(45) NOT NULL,
  `dateAccessCheckCreated` datetime NOT NULL,
  `userId` varchar(45) NOT NULL,
  `allowed` int(11) NOT NULL,
  PRIMARY KEY (`idAccessCheck`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesscheck`
--

LOCK TABLES `accesscheck` WRITE;
/*!40000 ALTER TABLE `accesscheck` DISABLE KEYS */;
INSERT INTO `accesscheck` (`idAccessCheck`, `page`, `dateAccessCheckCreated`, `userId`, `allowed`) VALUES (1,'adduser.php','0000-00-00 00:00:00','1',1),(2,'Html Design.php','2014-10-17 01:04:46','1',1),(3,'activitylog.php','2014-10-17 01:04:46','1',1),(4,'addUserAgainstAllPhpPages.php','2014-10-17 01:04:46','1',1),(5,'addbrand.php','2014-10-17 01:04:46','1',1),(6,'addbuyer.php','2014-10-17 01:04:46','1',1),(7,'addissuer.php','2014-10-17 01:04:46','1',1),(8,'addpart.php','2014-10-17 01:04:46','1',1),(9,'addpurchase.php','2014-10-17 01:04:46','1',1),(10,'addrackinstore.php','2014-10-17 01:04:46','1',1),(11,'addscrapreceiver.php','2014-10-17 01:04:46','1',1),(12,'addseller.php','2014-10-17 01:04:46','1',1),(13,'adduser.php','2014-10-17 01:04:46','1',1),(14,'addvehical.php','2014-10-17 01:04:46','1',1),(15,'checkLoginAndVerifyAccessPage.php','2014-10-17 01:04:46','1',1),(16,'controlpanel.php','2014-10-17 01:04:46','1',1),(17,'deletepurchase.php','2014-10-17 01:04:46','1',1),(18,'footer.php','2014-10-17 01:04:47','1',1),(19,'header.php','2014-10-17 01:04:47','1',1),(20,'helper.php','2014-10-17 01:04:47','1',1),(21,'index.php','2014-10-17 01:04:47','1',1),(22,'issuepage.php','2014-10-17 01:04:47','1',1),(23,'login.php','2014-10-17 01:04:47','1',1),(24,'navigationbar.php','2014-10-17 01:04:47','1',1),(25,'purchasereport.php','2014-10-17 01:04:47','1',1),(26,'reports.php','2014-10-17 01:04:47','1',1),(27,'restrict.php','2014-10-17 01:04:47','1',1),(28,'return.php','2014-10-17 01:04:47','1',1),(29,'scrapreport.php','2014-10-17 01:04:47','1',1),(30,'stockissuereport.php','2014-10-17 01:04:47','1',1),(31,'stockreport.php','2014-10-17 01:04:47','1',1),(32,'stocktransactionreport.php','2014-10-17 01:04:47','1',1),(33,'transactions.php','2014-10-17 01:04:47','1',1),(34,'tutorial.php','2014-10-17 01:04:47','1',1);
/*!40000 ALTER TABLE `accesscheck` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-18 17:58:31
