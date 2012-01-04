-- MySQL dump 10.13  Distrib 5.5.8, for Win32 (x86)
--
-- Host: localhost    Database: cake
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(30) DEFAULT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `eMail` varchar(60) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `houseNumber` int(4) DEFAULT NULL,
  `postCode` varchar(10) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `companyName` varchar(60) DEFAULT NULL,
  `legalForm` varchar(30) DEFAULT NULL,
  `vatId` varchar(30) DEFAULT NULL,
  `registerNumber` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `activeDesign` varchar(30) DEFAULT NULL,
  `activeTemplate` varchar(30) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `containers`
--

DROP TABLE IF EXISTS `containers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `containers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `layout_type_id` int(11) DEFAULT NULL,
  `column` int(1) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `layout_id` (`layout_type_id`),
  KEY `parent_id` (`parent_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `containers_ibfk_3` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `containers_ibfk_1` FOREIGN KEY (`layout_type_id`) REFERENCES `layout_types` (`id`),
  CONSTRAINT `containers_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `containers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `containers`
--

LOCK TABLES `containers` WRITE;
/*!40000 ALTER TABLE `containers` DISABLE KEYS */;
/*!40000 ALTER TABLE `containers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_values`
--

DROP TABLE IF EXISTS `content_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `key` varchar(150) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `plugin_view_value_id` (`key`),
  CONSTRAINT `content_values_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_values`
--

LOCK TABLES `content_values` WRITE;
/*!40000 ALTER TABLE `content_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) NOT NULL,
  `column` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `plugin_view_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `container_id` (`container_id`),
  KEY `plugin_id` (`plugin_view_id`),
  CONSTRAINT `contents_ibfk_4` FOREIGN KEY (`plugin_view_id`) REFERENCES `plugin_views` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contents_ibfk_3` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `google_maps_locations`
--

DROP TABLE IF EXISTS `google_maps_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google_maps_locations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content_id` int(10) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `street_number` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `google_maps_locations`
--

LOCK TABLES `google_maps_locations` WRITE;
/*!40000 ALTER TABLE `google_maps_locations` DISABLE KEYS */;
INSERT INTO `google_maps_locations` VALUES (1,0,'Deutschland',65451,'Kelsterbach','Karlsbader Str.','11');
/*!40000 ALTER TABLE `google_maps_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guestbook_entries`
--

DROP TABLE IF EXISTS `guestbook_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guestbook_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guestbook_entries`
--

LOCK TABLES `guestbook_entries` WRITE;
/*!40000 ALTER TABLE `guestbook_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `guestbook_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i18n`
--

DROP TABLE IF EXISTS `i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i18n` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i18n`
--

LOCK TABLES `i18n` WRITE;
/*!40000 ALTER TABLE `i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `layout_types`
--

DROP TABLE IF EXISTS `layout_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `layout_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `columns` int(11) NOT NULL,
  `weight` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layout_types`
--

LOCK TABLES `layout_types` WRITE;
/*!40000 ALTER TABLE `layout_types` DISABLE KEYS */;
INSERT INTO `layout_types` VALUES (1,'50:50 Teilung','',0,'50:50'),(2,'33:66 Teilung','',0,'33:66'),(3,'25:75 Teilung','',0,'25:75'),(4,'Golder Schnitt links','',0,'38:62'),(5,'66:33 Teilung','',0,'66:33'),(6,'75:25 Teilung','',0,'75:25'),(7,'Goldener Schnitt rechts','',0,'62:38'),(8,'3 Spalten selbe Größe','',0,'33:33:33');
/*!40000 ALTER TABLE `layout_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_entries`
--

DROP TABLE IF EXISTS `log_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ipaddress` int(11) NOT NULL,
  `action` tinyint(1) NOT NULL,
  `actionDate` datetime NOT NULL,
  `object_class` varchar(150) NOT NULL,
  `object_id` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_entries`
--

LOCK TABLES `log_entries` WRITE;
/*!40000 ALTER TABLE `log_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_entries`
--

DROP TABLE IF EXISTS `menu_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `validFrom` datetime NOT NULL,
  `validTo` datetime NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `role_id` (`role_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `menu_entries_ibfk_5` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_entries_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `menu_entries_ibfk_4` FOREIGN KEY (`parent_id`) REFERENCES `menu_entries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_entries`
--

LOCK TABLES `menu_entries` WRITE;
/*!40000 ALTER TABLE `menu_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `validFrom` datetime NOT NULL,
  `validTo` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `metaTags` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateLastChange` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `permissions_ibfk_3` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (10,20,4,'Write'),(11,20,6,'Publish');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugin_views`
--

DROP TABLE IF EXISTS `plugin_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugin_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`),
  CONSTRAINT `plugin_views_ibfk_1` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugin_views`
--

LOCK TABLES `plugin_views` WRITE;
/*!40000 ALTER TABLE `plugin_views` DISABLE KEYS */;
INSERT INTO `plugin_views` VALUES (1,19,'Location'),(2,19,'Route');
/*!40000 ALTER TABLE `plugin_views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugins`
--

DROP TABLE IF EXISTS `plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `schema` tinyint(1) NOT NULL,
  `routing` tinyint(1) NOT NULL,
  `version` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugins`
--

LOCK TABLES `plugins` WRITE;
/*!40000 ALTER TABLE `plugins` DISABLE KEYS */;
INSERT INTO `plugins` VALUES (19,'GoogleMaps',1,1,'1.0','Patrick Zamzow'),(20,'Guestbook',1,1,'1.0','Christoph KrÃ¤mer'),(21,'StaticText',0,1,'1.0','Christoph KrÃ¤mer');
/*!40000 ALTER TABLE `plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (2,3,'Guest'),(3,4,'Registered'),(4,5,'Author'),(5,6,'Editor'),(6,7,'Administrator'),(7,NULL,'Super-Adminsitrator');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `registered` datetime NOT NULL,
  `confirmation_token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'christoph','9617b34607ee4ef23ee07b341de5a7ca26ede8c7','christoph@christophkraemer.de','2012-01-02 11:32:57','0000-00-00 00:00:00','',1),(2,7,'test123','e84f100d33cda3f881fe00a334e9dd941dfe2d15','christoph@christophkraemer.de','0000-00-00 00:00:00','2011-12-08 12:26:59','aaaf13160053ec8e18083ecfeb79a2ed34f7f32b',0),(3,3,'blubb','39bd73dac29aa4190d929fc2ce056dcd31bb4585','test@test.de','2011-12-08 12:44:50','2011-12-08 12:44:38','064acc795ba7d0834d6cafad0ff2b65fbf42e676',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-01-03 18:46:59
