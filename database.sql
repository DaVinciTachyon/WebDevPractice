-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: linkshortener
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_control`
--

DROP TABLE IF EXISTS `access_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `access_control` (
  `user_id` int(5) NOT NULL,
  `access_control` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_control`
--

LOCK TABLES `access_control` WRITE;
/*!40000 ALTER TABLE `access_control` DISABLE KEYS */;
INSERT INTO `access_control` VALUES (1,2),(2,2),(3,2);
/*!40000 ALTER TABLE `access_control` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'GMail');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_1`
--

DROP TABLE IF EXISTS `link_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_1` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_1`
--

LOCK TABLES `link_1` WRITE;
/*!40000 ALTER TABLE `link_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_2`
--

DROP TABLE IF EXISTS `link_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_2` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_2`
--

LOCK TABLES `link_2` WRITE;
/*!40000 ALTER TABLE `link_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_3`
--

DROP TABLE IF EXISTS `link_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_3` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_3`
--

LOCK TABLES `link_3` WRITE;
/*!40000 ALTER TABLE `link_3` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_4`
--

DROP TABLE IF EXISTS `link_4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_4` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_4`
--

LOCK TABLES `link_4` WRITE;
/*!40000 ALTER TABLE `link_4` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_5`
--

DROP TABLE IF EXISTS `link_5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_5` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_5`
--

LOCK TABLES `link_5` WRITE;
/*!40000 ALTER TABLE `link_5` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_6`
--

DROP TABLE IF EXISTS `link_6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_6` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_6`
--

LOCK TABLES `link_6` WRITE;
/*!40000 ALTER TABLE `link_6` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_6` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_7`
--

DROP TABLE IF EXISTS `link_7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_7` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_7`
--

LOCK TABLES `link_7` WRITE;
/*!40000 ALTER TABLE `link_7` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_7` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_8`
--

DROP TABLE IF EXISTS `link_8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_8` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_8`
--

LOCK TABLES `link_8` WRITE;
/*!40000 ALTER TABLE `link_8` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_9`
--

DROP TABLE IF EXISTS `link_9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `link_9` (
  `ip_address` varchar(15) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_9`
--

LOCK TABLES `link_9` WRITE;
/*!40000 ALTER TABLE `link_9` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_9` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_id`
--

DROP TABLE IF EXISTS `session_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `session_id` (
  `user_id` int(5) NOT NULL,
  `session_id` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_id`
--

LOCK TABLES `session_id` WRITE;
/*!40000 ALTER TABLE `session_id` DISABLE KEYS */;
INSERT INTO `session_id` VALUES (1,1),(2,2),(3,3),(2,4),(1,5),(3,6);
/*!40000 ALTER TABLE `session_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `short_urls`
--

DROP TABLE IF EXISTS `short_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `short_urls` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `long_url` varchar(255) NOT NULL,
  `short_code` varbinary(6) NOT NULL,
  `date_created` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_id`),
  KEY `short_code` (`short_code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `short_urls`
--

LOCK TABLES `short_urls` WRITE;
/*!40000 ALTER TABLE `short_urls` DISABLE KEYS */;
INSERT INTO `short_urls` VALUES (1,'http://www.google.com',_binary '2',1533403748,3,NULL),(2,'http://www.yahoo.com',_binary '3',1533403754,3,NULL),(3,'http://www.youtube.com',_binary '4',1533403762,3,NULL),(4,'http://www.facebook.com',_binary '5',1533403778,3,NULL),(5,'http://www.google.com',_binary '6',1533403798,2,1),(6,'http://www.yahoo.com',_binary '7',1533403803,2,1),(7,'http://www.youtube.com',_binary '8',1533403809,2,1),(8,'http://www.twitter.com',_binary '9',1533403821,2,1),(9,'https://stackoverflow.com',_binary 'a',1533403976,2,1);
/*!40000 ALTER TABLE `short_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','john@gmail.com','527bd5b5d689e2c32ae974c6229ff785',1),(2,'Mary','mary@gmail.com','b8e7be5dfa2ce0714d21dcfc7d72382c',1),(3,'Edward','edward@independent.ie','a53f3929621dba1306f8a61588f52f55',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'linkshortener'
--

--
-- Dumping routines for database 'linkshortener'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-04 19:54:32
