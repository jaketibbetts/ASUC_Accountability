-- MySQL dump 10.15  Distrib 10.0.28-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: mysql    Database: mysql
-- ------------------------------------------------------
-- Server version	10.0.28-MariaDB-0+deb8u1

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
-- Table structure for table `Report`
--

DROP TABLE IF EXISTS `Report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reporting_period_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path_name` varchar(255) NOT NULL,
  `turned_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `path_name` (`path_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Report`
--

LOCK TABLES `Report` WRITE;
/*!40000 ALTER TABLE `Report` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReportingPeriod`
--

DROP TABLE IF EXISTS `ReportingPeriod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReportingPeriod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_id` int(11) NOT NULL,
  `turn_in_by` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `descript` varchar(255) NOT NULL,
  `reporters` int(11) NOT NULL COMMENT 'bitwise (3 -> Roles 1 and 2)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `turn_in_day` (`turn_in_by`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReportingPeriod`
--

LOCK TABLES `ReportingPeriod` WRITE;
/*!40000 ALTER TABLE `ReportingPeriod` DISABLE KEYS */;
INSERT INTO `ReportingPeriod` VALUES (1,1,'2016-12-14 07:59:59','Report For December 13, 2016',3),(2,1,'2016-12-21 07:59:59','Report For December 20, 2016',15),(3,1,'2016-12-28 07:59:59','Report For December 27, 2016',3),(4,1,'2017-01-04 07:59:59','Report For January 3, 2017',15),(5,1,'2017-01-11 07:59:59','Report For January 10, 2017',3),(6,1,'2017-01-18 07:59:59','Report For January 17, 2017',15),(7,1,'2017-01-25 07:59:59','Report For January 24, 2017',3),(8,1,'2017-02-01 07:59:59','Report For January 31, 2017',15),(9,1,'2017-02-08 07:59:59','Report For February 7, 2017',3),(10,1,'2017-02-15 07:59:59','Report For February 14, 2017',15),(11,1,'2017-02-22 07:59:59','Report For February 21, 2017',3),(12,1,'2017-03-01 07:59:59','Report For February 28, 2017',15),(13,1,'2017-03-08 07:59:59','Report For March 7, 2017',3),(14,1,'2017-03-15 06:59:59','Report For March 14, 2017',15),(15,1,'2017-03-22 06:59:59','Report For March 21, 2017',3),(16,1,'2017-03-29 06:59:59','Report For March 28, 2017',15),(17,1,'2017-04-05 06:59:59','Report For April 4, 2017',3),(18,1,'2017-04-12 06:59:59','Report For April 11, 2017',15),(19,1,'2017-04-19 06:59:59','Report For April 18, 2017',3),(20,1,'2017-04-26 06:59:59','Report For April 25, 2017',15),(21,1,'2017-05-03 06:59:59','Report For May 2, 2017',3),(22,1,'2017-05-10 06:59:59','Report For May 9, 2017',15);
/*!40000 ALTER TABLE `ReportingPeriod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Role`
--

DROP TABLE IF EXISTS `Role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descript` varchar(255) NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Role`
--

LOCK TABLES `Role` WRITE;
/*!40000 ALTER TABLE `Role` DISABLE KEYS */;
INSERT INTO `Role` VALUES (1,'Executive','eo'),(2,'Chief Appointed Officer','ao'),(4,'Senator','s'),(8,'Commission Chair','cc');
/*!40000 ALTER TABLE `Role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Term`
--

DROP TABLE IF EXISTS `Term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Term`
--

LOCK TABLES `Term` WRITE;
/*!40000 ALTER TABLE `Term` DISABLE KEYS */;
INSERT INTO `Term` VALUES (1,'2016-08-01 07:00:00','2017-08-01 06:59:59');
/*!40000 ALTER TABLE `Term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_abbreviation` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,1,1,'President','OP','Will','Morrow','president@asuc.org','g/0rJ/kKK76BNkYHOi.xCuqui/P63aUY956TKj3vlaSwl1RQPhY7q'),(2,1,1,'Chief of Staff, Office of the President','OPCS','Sohrob','Nayebaziz','opchief@asuc.org','X34OEyWNtmgEfHBfkKpi1eM3y4Jj1jGagpustAsKqv.Y.hWPDuCCa'),(3,1,1,'Chief of Staff, Office of the President','OPCS','Nicole','Katwan','opchief@asuc.org','fChyloLb1O2M2uPqz1n.jeUSuSfKimIedKkfnNfR7l6tNIDt95JpG'),(4,1,1,'Executive Vice President','EVP','Alicia','Lau','evp@asuc.org','LPFg03iNbkX36rsCcTrKO.tg9yPJnK4NkIxAqPkKBlWLo9.M8chMy'),(5,1,1,'Chief of Staff, Office of the Executive Vice President','EVPCS','Payas','Parab','evpchief@asuc.org','fF2/u8EzvXrhkE8JPkzB1OakQA.wiXsI6y6YO605tIeHkfLKPJx56'),(6,1,1,'Chief of Staff, Office of the Executive Vice President','EVPCS','Rachel','Schuster','evpchief@asuc.org','Nq1oy8oPB5a/bAhcyEolGe1MXbnNvvmw.0ZVdDy33opRh0qGavn9m'),(7,1,1,'External Affairs Vice President','EAVP','Andre','Luu','eavp@asuc.org','9r4uM8ipGBYeel/Jt50GUOWhKTlMUXayBH/J3YHrjHUEtDHHnmkcW'),(8,1,1,'Chief of Staff, Office of the External Affairs Vice President','EAVPCS','Hannah','He','eavpchief@asuc.org','o.ueQ0e4jxuEvkmJ1/wX/Orb.dsnJuaRWjUlmD47JarOhR3tXOwGO'),(9,1,1,'Academic Affairs Vice President','AAVP','Frances','McGinley','aavp@asuc.org','gWrwMTPPQJn4Tu9qnMs2tOAx816bNLQX2Zb7kbrTGBJYHumxTn5Xy'),(10,1,1,'Chief of Staff, Office of the Academic Affairs Vice President','AAVPCS','Charlotte','Hayward','aavpchief@asuc.org','Odby9gu03UK6NmbcEEQtpOemQH1lf1PVlDBp1DqC/AMRueBjKOJYy'),(11,1,1,'Student Advocate','SAO','Selina','Lao','chief@berkeleysao.org','ub4TR36hH1LdWTHCbDsA6eI/uI8KzFZZN/.kxZDiZCV14A4oojt2.'),(12,1,1,'External Chief of Staff, Office of the Student Advocate','SAOCSE','Raj','Bhargava','saochief@asuc.org','E3SWnpF26qz3eDZXvSD.qurl76q6fwq0l./5JupiqKK/ItAo/Q/nS'),(13,1,1,'Internal Chief of Staff, Office of the Student Advocate','SAOCSI','Nitisha','Baronia','saochief@asuc.org','9EWDD04tlF7ZwHAKLEx3a.FPf9eQVGahXkEFhi7gCKPZsyFQkn3im'),(14,2,1,'Chief Accountability Officer','CAO','Kenny','Chen','accountability@asuc.org','9/kCc0mLkYRBmLugDZdZ3e36i9OjGQk.B.2r6v5PABHHU/cFTrlim'),(15,2,1,'Chief Communications Officer','CCO','Courtney','Brousseau','communications@asuc.org','L7n7UK9UoXnR1tIwVfoYKOpQLzotUjVBC.HYj9OgZ0hHpaDr6iz9S'),(16,2,1,'Chief Financial Officer','CFO','Paul','Cho','finance@asuc.org','oMJNaNCE8mmhtix/jTsMf.RNcbGx48rfexG5uRrn2ZkOtmzvnOYLq'),(17,2,1,'Chief Legal Officer','CLO','Alek','Klimek','legal@asuc.org','A2RUerSUO339JHhWu82cVe7LwgnddBWsmywnrY9HzV08Yx3pPiDGq'),(18,2,1,'Chief Technology Officer','CTO','Apollo','Jain','technology@asuc.org','881C2YEpn2nxJt1vWTjETu5Xm/WuZHlU4DGL.0HnlJDgEqKU9Y3gK'),(19,2,1,'General Manager','GM','Vivian','Zhu','manager@asuc.org','Ci0r/z5A7k4BmjUtKvhrWu5lzH1qQcp5plrduQEaOWL5k4UuPF0zW'),(20,2,1,'Judicial Council Chair','JCC','Eric','Wilcox','judicialchair@asuc.org','.qyU1V7XZ2HrxOYclcaLL.kErrBbdt3UK3PtJzG9jJ0A/LG50qJYy'),(21,4,1,'Senator','S','Zaynab','AbdulQadir-Morris','zabdulqadir@asuc.org','uO0WlExkQoj1Ei8.uipHluUZcBhMeJUzAc3K0U6jYOaNMLel8ekRy'),(22,4,1,'Senator','S','Alaa','Aissi','aaissi@asuc.org','uh/XbRNDSXgHhQ4bn0SMIei5gccl2pka4rh/vLJQuV1NJ3im1ZqYu'),(23,4,1,'Senator','S','Benyamin','Bin Mohd Yusof','bmohdyusof@asuc.org','N6X/PcfyROhR9yXQV6/QE.DknyR8YxYPDOdQdNRA19O7aOdI75cqS'),(24,4,1,'Senator','S','Anthony','Carrasco','acarrasco@asuc.org','OU7XAdIJb8rjEvQAUeuNmuJfessbQczED81kdR8dizHxDi.EKvWGa'),(25,4,1,'Senator','S','Jay','Choi','jchoi@asuc.org','iEAov6ODxcClK2pU5Ow9teZqhCzckjblCP8lOVUGU96A8TPnrJix6'),(26,4,1,'Senator','S','Marandah','Field-Elliot','mfieldelliot@asuc.org','lVGXfS3LN3YWg2ylIWFVHuqr50tN.lJ8b/mXtCwHft/ySujT/xt06'),(27,4,1,'Senator','S','Bianca','Filart','bfilart@asuc.org','KFxY4Dd.8Sz.DZQQDVri.uIEVKXqLfWj2KZ0Bi6iUZFPbqIuGNSBG'),(28,4,1,'Senator','S','Miranda','Hernandez','mhernandez@asuc.org','xp6rd/Jukb39pf7Hp7z54e4z2dGGfcxJNkj8tRWAIWOZOKrUM8aai'),(29,4,1,'Senator','S','Andrew','Ian-Bullitt','abullitt@asuc.org','2wMj9OYbpNIdXgcaxTYJI.VDYiYjcMo7MYTJPLojcyHvQYLxWlCXi'),(30,4,1,'Senator','S','Nathan','Kelleher','nkelleher@asuc.org','BO0mMvuKnHj0VOCsQXse8.SqX4r./QHUwFJxAVmte.imENYXwFQS.'),(31,4,1,'Senator','S','Jenny','Kim','jkim@asuc.org','76qGm29GPWqXAS40JfdWUeZDh2h3LLN9PNX9qljBHFuz3LgJ5qEIS'),(32,4,1,'Senator','S','Rosa','Kwak','rkwak@asuc.org','6.TckG4lrlOs/S2Xmem2luXbEUk1Zv2CZASL07vG4IjQ/Wv54GKPq'),(33,4,1,'Senator','S','Xiao','Li','xli@asuc.org','2C2dn81Rf3cXjG0B2hlqIu3J.rXhwCuDnUbftr4O1u17608Ux1Lf.'),(34,4,1,'Senator','S','Alyssa','Liu','aliu@asuc.org','FGLgA9tPmxESqh1s9Q5JDOKy6HWvCNtLYEMfk4FE5JKlQW5zv1GlC'),(35,4,1,'Senator','S','Monsoon','Pabrai','mpabrai@asuc.org','EslBEuov9ilL0CkqPoU0huny1pNlOrMlJs1opxAO/0DxnmFrVgFU2'),(36,4,1,'Senator','S','Rigel','Robinson','rrobinson@asuc.org','Rh3AhLya51G6Mk5henKfQe14FXHVk0RjFumhh2LMXeugfeSr0MX9K'),(37,4,1,'Senator','S','Annie','Tran','annietran@berkeley.edu','uhuh0RtGd607fzm0Y5BVhORJg.tyWueAjpYgvlBU0G8xWPFApkImC'),(38,4,1,'Senator','S','Wesley','Wan','wwan@asuc.org','lk67YGxrSRzNmAZdz/DUDewr8ILNxrsAEndw4wGN382tLJ8O6k6lG'),(39,4,1,'Senator','S','Chris','Yamas','cyamas@asuc.org','sKXp1uLDBGikTDTAwoErzucyIXiVNrYKzf5EFUUkGaEnAmv1MQqly'),(40,4,1,'Senator','S','Helen','Yuan','hyuan@asuc.org','7Jy.1XVWOxLDktNLvQfrbuKJC76DTuVfNDkvPlOsX2XLSJ878Nxju'),(41,8,1,'Housing Commission Chair','CC','Matthew','Lewis','housing@asuc.org','f4K3WGqMxD.Xguo685kakeOAt2yrDubfkEygnm1f7bijziJQpyQG2'),(42,8,1,'Financial Wellness','CC','Alphonse','Simon','alphonsesimon@berkeley.edu','HcUf0Yw4e/et5gqzLBMOQueWKznr5XDxvCUpBWX42VEZ8wT6to56u'),(43,8,1,'Sexual Violence Commission Chair','CC','Anvi','Bahl','anvi@berkeley.edu','lNDEGkSWNK2RPVeP7RZxPenpgcSkEzpTRlwLw3Y0Qt2YBcrSFNb0u'),(44,8,1,'Sustainability Team Co-Chair','CC','Natalia','Mushegian','namushegian@berkeley.edu','bxDcqTB3SST8D31ZSGRIDuBVUrzmRSHhMMNMTYafzhFaCBq48l.ju'),(45,8,1,'Sustainability Team Co-Chair','CC','Sydney','Higa','sydney.higa@berkeley.edu','Sct968CuZNdRXnrKwrUBt.e6H.cXUnnXia3XRYslv9qXetTzAGhre');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-25 11:17:37
