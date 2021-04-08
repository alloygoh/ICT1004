-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dev
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `following`
--

DROP TABLE IF EXISTS `following`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `following` (
  `user_id` int NOT NULL,
  `tag` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`,`tag`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `phpauth_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `following`
--

LOCK TABLES `following` WRITE;
/*!40000 ALTER TABLE `following` DISABLE KEYS */;
INSERT INTO `following` VALUES (1,'Choose...'),(1,'default');
/*!40000 ALTER TABLE `following` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpauth_attempts`
--

DROP TABLE IF EXISTS `phpauth_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phpauth_attempts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` char(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_attempts`
--

LOCK TABLES `phpauth_attempts` WRITE;
/*!40000 ALTER TABLE `phpauth_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpauth_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpauth_config`
--

DROP TABLE IF EXISTS `phpauth_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phpauth_config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `setting` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_config`
--

LOCK TABLES `phpauth_config` WRITE;
/*!40000 ALTER TABLE `phpauth_config` DISABLE KEYS */;
INSERT INTO `phpauth_config` VALUES ('allow_concurrent_sessions','0'),('attack_mitigation_time','+30 minutes'),('attempts_before_ban','30'),('attempts_before_verify','5'),('bcrypt_cost','10'),('cookie_domain',NULL),('cookie_forget','+30 minutes'),('cookie_http','0'),('cookie_name','phpauth_session_cookie'),('cookie_path','/'),('cookie_remember','+1 month'),('cookie_renew','+5 minutes'),('cookie_secure','0'),('custom_datetime_format','Y-m-d H:i'),('emailmessage_suppress_activation','0'),('emailmessage_suppress_reset','0'),('mail_charset','UTF-8'),('password_min_score','2'),('recaptcha_enabled','0'),('recaptcha_secret_key',''),('recaptcha_site_key',''),('request_key_expiration','+10 minutes'),('site_activation_page','activate'),('site_activation_page_append_code','0'),('site_email','ict1004proj@gmail.com'),('site_key','fghuior.)/!/jdUkd8s2!7HVHG7777ghg'),('site_language','en_GB'),('site_name','T3ST'),('site_password_reset_page','reset.php'),('site_password_reset_page_append_code','1'),('site_timezone','Asia/Singapore'),('site_url','http://localhost:8080'),('smtp','1'),('smtp_auth','1'),('smtp_debug','0'),('smtp_host','smtp.gmail.com'),('smtp_password','P@ssw0rd!123'),('smtp_port','587'),('smtp_security','tls'),('smtp_username','ict1004proj@gmail.com'),('table_attempts','phpauth_attempts'),('table_emails_banned','phpauth_emails_banned'),('table_requests','phpauth_requests'),('table_sessions','phpauth_sessions'),('table_translations','phpauth_translation_dictionary'),('table_users','phpauth_users'),('translation_source','php'),('verify_email_max_length','100'),('verify_email_min_length','5'),('verify_email_use_banlist','1'),('verify_password_min_length','3');
/*!40000 ALTER TABLE `phpauth_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpauth_emails_banned`
--

DROP TABLE IF EXISTS `phpauth_emails_banned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phpauth_emails_banned` (
  `id` int NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_emails_banned`
--

LOCK TABLES `phpauth_emails_banned` WRITE;
/*!40000 ALTER TABLE `phpauth_emails_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpauth_emails_banned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpauth_requests`
--

DROP TABLE IF EXISTS `phpauth_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phpauth_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `token` char(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `expire` datetime NOT NULL,
  `type` enum('activation','reset') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `token` (`token`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_requests`
--

LOCK TABLES `phpauth_requests` WRITE;
/*!40000 ALTER TABLE `phpauth_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpauth_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpauth_sessions`
--

DROP TABLE IF EXISTS `phpauth_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phpauth_sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `hash` char(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `device_id` varchar(36) DEFAULT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` char(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_sessions`
--

LOCK TABLES `phpauth_sessions` WRITE;
/*!40000 ALTER TABLE `phpauth_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpauth_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpauth_users`
--

DROP TABLE IF EXISTS `phpauth_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phpauth_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_users`
--

LOCK TABLES `phpauth_users` WRITE;
/*!40000 ALTER TABLE `phpauth_users` DISABLE KEYS */;
INSERT INTO `phpauth_users` VALUES (1,'admin','1','admin@admin.com','$2y$10$e6M29.jYO6oWntRdq.o.3OSVkqo5qUKP/DkLG2E.gPW2A7FoGC9Ry',1,'2021-04-01 02:24:33');
/*!40000 ALTER TABLE `phpauth_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `op` int NOT NULL,
  `title` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `body` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `likes` int NOT NULL,
  `tag` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_idx` (`op`),
  KEY `tag_idx` (`tag`),
  CONSTRAINT `op` FOREIGN KEY (`op`) REFERENCES `phpauth_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'Test1','test1','2021-04-05',0,'default');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-05 18:38:29
