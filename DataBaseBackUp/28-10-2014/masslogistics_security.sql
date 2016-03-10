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
-- Table structure for table `security`
--

DROP TABLE IF EXISTS `security`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security` (
  `idSecurity` int(11) NOT NULL AUTO_INCREMENT,
  `pageName` varchar(45) NOT NULL,
  `securityPlan1` int(11) NOT NULL,
  `securityPlan2` int(11) NOT NULL,
  `securityPlan3` int(11) NOT NULL,
  `securityPlanAdmin` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`idSecurity`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security`
--

LOCK TABLES `security` WRITE;
/*!40000 ALTER TABLE `security` DISABLE KEYS */;
INSERT INTO `security` (`idSecurity`, `pageName`, `securityPlan1`, `securityPlan2`, `securityPlan3`, `securityPlanAdmin`, `dateCreated`, `userId`) VALUES (1,'Html Design.php',0,0,0,1000,'2014-10-23 22:02:10',2),(2,'activitylog.php',0,0,0,1000,'2014-10-23 22:02:10',2),(3,'addUserAgainstAllPhpPages.php',0,0,0,1000,'2014-10-23 22:02:10',2),(4,'addbrand.php',0,0,100,1000,'2014-10-23 22:02:10',2),(5,'addbuyer.php',0,0,100,1000,'2014-10-23 22:02:10',2),(6,'addissuer.php',0,0,100,1000,'2014-10-23 22:02:10',2),(7,'addpart.php',0,0,100,1000,'2014-10-23 22:02:10',2),(8,'addpurchase.php',0,10,100,1000,'2014-10-23 22:02:10',2),(9,'addrackinstore.php',0,0,100,1000,'2014-10-23 22:02:10',2),(10,'addscrapreceiver.php',0,10,100,1000,'2014-10-23 22:02:10',2),(11,'addseller.php',0,0,100,1000,'2014-10-23 22:02:10',2),(12,'adduser.php',0,0,100,1000,'2014-10-23 22:02:10',2),(13,'addvehical.php',0,0,100,1000,'2014-10-23 22:02:10',2),(14,'checkLoginAndVerifyAccessPage.php',0,0,0,1000,'2014-10-23 22:02:10',2),(15,'controlpanel.php',0,0,100,1000,'2014-10-23 22:02:10',2),(16,'deletepurchase.php',0,10,100,1000,'2014-10-23 22:02:10',2),(17,'footer.php',0,0,0,1000,'2014-10-23 22:02:10',2),(18,'header.php',0,0,0,1000,'2014-10-23 22:02:11',2),(19,'helper.php',0,0,0,1000,'2014-10-23 22:02:11',2),(20,'index.php',1,10,100,1000,'2014-10-23 22:02:11',2),(21,'issuepage.php',0,10,100,1000,'2014-10-23 22:02:11',2),(22,'login.php',1,10,100,1000,'2014-10-23 22:02:11',2),(23,'navigationbar.php',0,0,0,1000,'2014-10-23 22:02:11',2),(24,'purchasereport.php',1,10,100,1000,'2014-10-23 22:02:11',2),(25,'reports.php',1,10,100,1000,'2014-10-23 22:02:11',2),(26,'restrict.php',0,0,0,1000,'2014-10-23 22:02:11',2),(27,'return.php',0,10,100,1000,'2014-10-23 22:02:11',2),(28,'scrapreport.php',1,10,100,1000,'2014-10-23 22:02:11',2),(29,'stockissuereport.php',1,10,100,1000,'2014-10-23 22:02:11',2),(30,'stockreport.php',1,10,100,1000,'2014-10-23 22:02:11',2),(31,'stocktransactionreport.php',1,10,100,1000,'2014-10-23 22:02:11',2),(32,'transactions.php',0,10,100,1000,'2014-10-23 22:02:11',2),(33,'tutorial.php',1,10,100,1000,'2014-10-23 22:02:11',2),(34,'manageprivacy.php',0,0,100,1000,'2014-10-24 01:57:46',2);
/*!40000 ALTER TABLE `security` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-28  0:22:33
