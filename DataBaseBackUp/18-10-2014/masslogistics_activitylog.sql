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
-- Table structure for table `activitylog`
--

DROP TABLE IF EXISTS `activitylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activitylog` (
  `idActivityLog` int(11) NOT NULL AUTO_INCREMENT,
  `urlAccessed` varchar(300) NOT NULL,
  `idUserAuth` int(11) NOT NULL,
  `dateActivity` datetime NOT NULL,
  `attemptStatus` varchar(45) NOT NULL,
  PRIMARY KEY (`idActivityLog`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activitylog`
--

LOCK TABLES `activitylog` WRITE;
/*!40000 ALTER TABLE `activitylog` DISABLE KEYS */;
INSERT INTO `activitylog` (`idActivityLog`, `urlAccessed`, `idUserAuth`, `dateActivity`, `attemptStatus`) VALUES (1,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 22:51:07','Failure'),(2,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 22:51:22','Success'),(3,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 22:55:51','Failure'),(4,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 22:56:13','Success'),(5,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 22:56:23','Failure'),(6,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 22:58:40','Failure'),(7,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:00:58','Failure'),(8,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:01:30','Failure'),(9,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:02:07','Failure'),(10,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:04:03','Failure'),(11,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:05:19','Failure'),(12,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:06:23','Failure'),(13,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:07:42','Failure'),(14,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:11:38','Failure'),(15,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:13:13','Success'),(16,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:13:22','Failure'),(17,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:13:29','Success'),(18,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:16:13','Failure'),(19,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:19:23','Success'),(20,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:19:45','Failure'),(21,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-16 23:19:55','Success'),(22,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:24:24','Success'),(23,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:25:56','Success'),(24,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:26:25','Success'),(25,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:26:30','Success'),(26,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:27:53','Success'),(27,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:29:21','Success'),(28,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:31:42','Success'),(29,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:31:58','Success'),(30,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:32:05','Success'),(31,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:32:28','Success'),(32,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:32:45','Success'),(33,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:33:11','Success'),(34,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:33:30','Success'),(35,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:33:47','Success'),(36,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:34:09','Success'),(37,'/MassLogisticsWorkshop/addbrand.php',2,'2014-10-17 00:34:47','Success'),(38,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:37:29','Success'),(39,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:38:16','Success'),(40,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:38:44','Success'),(41,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:39:10','Success'),(42,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:39:17','Success'),(43,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:39:34','Success'),(44,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:45:04','Success'),(45,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 00:45:05','Restricted'),(46,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 00:45:16','Restricted'),(47,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 00:46:14','Success'),(48,'/MassLogisticsWorkshop/addbuyer.php',1,'2014-10-17 00:46:54','Restricted'),(49,'/MassLogisticsWorkshop/addbuyer.php',1,'2014-10-17 00:47:04','Restricted'),(50,'/MassLogisticsWorkshop/addbuyer.php',1,'2014-10-17 00:47:18','Restricted'),(51,'/MassLogisticsWorkshop/addbuyer.php',1,'2014-10-17 00:47:30','Failure'),(52,'/MassLogisticsWorkshop/addbuyer.php',1,'2014-10-17 00:47:39','Restricted'),(53,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 00:47:45','Success'),(54,'/MassLogisticsWorkshop/addbrand.php',1,'2014-10-17 00:47:51','Success'),(55,'/MassLogisticsWorkshop/addbuyer.php',1,'2014-10-17 00:47:55','Restricted'),(56,'/MassLogisticsWorkshop/issuepage.php',1,'2014-10-17 01:01:12','Restricted'),(57,'/MassLogisticsWorkshop/controlpanel.php',1,'2014-10-17 01:02:36','Restricted'),(58,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 01:02:44','Success'),(59,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 01:03:22','Restricted'),(60,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 01:03:27','Restricted'),(61,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 01:04:13','Success'),(62,'/MassLogisticsWorkshop/adduser.php',1,'2014-10-17 01:04:33','Success'),(63,'/MassLogisticsWorkshop/addpurchase.php',1,'2014-10-17 01:06:33','Success'),(64,'/MassLogisticsWorkshop/addpurchase.php',1,'2014-10-17 01:06:33','Success'),(65,'/MassLogisticsWorkshop/addpurchase.php',1,'2014-10-18 17:55:48','Success');
/*!40000 ALTER TABLE `activitylog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-18 17:58:32
