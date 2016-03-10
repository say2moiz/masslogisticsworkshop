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
-- Table structure for table `backupsecurity`
--

DROP TABLE IF EXISTS `backupsecurity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backupsecurity` (
  `idBackUpSecurity` int(11) NOT NULL AUTO_INCREMENT,
  `queryString` varchar(500) NOT NULL,
  `dateCreated` varchar(45) NOT NULL,
  PRIMARY KEY (`idBackUpSecurity`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backupsecurity`
--

LOCK TABLES `backupsecurity` WRITE;
/*!40000 ALTER TABLE `backupsecurity` DISABLE KEYS */;
INSERT INTO `backupsecurity` (`idBackUpSecurity`, `queryString`, `dateCreated`) VALUES (1,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'1\',\'Html Design.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(2,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'2\',\'activitylog.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(3,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'3\',\'addUserAgainstAllPhpPages.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(4,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'4\',\'addbrand.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(5,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'5\',\'addbuyer.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(6,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'6\',\'addissuer.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(7,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'7\',\'addpart.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(8,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'8\',\'addpurchase.php\',\'0\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(9,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'9\',\'addrackinstore.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(10,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'10\',\'addscrapreceiver.php\',\'0\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(11,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'11\',\'addseller.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:52'),(12,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'12\',\'adduser.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:53'),(13,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'13\',\'addvehical.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:53'),(14,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'14\',\'checkLoginAndVerifyAccessPage.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:53'),(15,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'15\',\'controlpanel.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:53'),(16,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'16\',\'deletepurchase.php\',\'0\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:53'),(17,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'17\',\'footer.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:10\',\'2\');','2014-10-24 00:41:53'),(18,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'18\',\'header.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(19,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'19\',\'helper.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(20,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'20\',\'index.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(21,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'21\',\'issuepage.php\',\'0\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(22,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'22\',\'login.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(23,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'23\',\'navigationbar.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(24,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'24\',\'purchasereport.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(25,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'25\',\'reports.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(26,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'26\',\'restrict.php\',\'0\',\'0\',\'0\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(27,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'27\',\'return.php\',\'0\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(28,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'28\',\'scrapreport.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(29,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'29\',\'stockissuereport.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(30,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'30\',\'stockreport.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(31,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'31\',\'stocktransactionreport.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(32,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'32\',\'transactions.php\',\'0\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(33,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'33\',\'tutorial.php\',\'1\',\'10\',\'100\',\'1000\',\'2014-10-23 22:02:11\',\'2\');','2014-10-24 00:41:53'),(34,'Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values (\'34\',\'manageprivacy.php\',\'0\',\'0\',\'100\',\'1000\',\'2014-10-24 01:57:46\',\'2\');','2014-10-24 02:31:00');
/*!40000 ALTER TABLE `backupsecurity` ENABLE KEYS */;
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
