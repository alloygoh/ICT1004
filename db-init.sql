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
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `announcement` mediumtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `following`
--

DROP TABLE IF EXISTS `following`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `following` (
  `user_id` int NOT NULL,
  `tag` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`,`tag`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `phpauth_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `following`
--

LOCK TABLES `following` WRITE;
/*!40000 ALTER TABLE `following` DISABLE KEYS */;
INSERT INTO `following` VALUES (1,'blah'),(1,'default'),(1,'qq'),(1,'qqq'),(1,'qqqq'),(1,'test'),(1,'zazazaz'),(2,'qq'),(2,'test');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
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
INSERT INTO `phpauth_config` VALUES ('allow_concurrent_sessions','0'),('attack_mitigation_time','+30 minutes'),('attempts_before_ban','30'),('attempts_before_verify','0'),('bcrypt_cost','10'),('cookie_domain',NULL),('cookie_forget','+30 minutes'),('cookie_http','0'),('cookie_name','phpauth_session_cookie'),('cookie_path','/'),('cookie_remember','+1 month'),('cookie_renew','+5 minutes'),('cookie_secure','0'),('custom_datetime_format','Y-m-d H:i'),('emailmessage_suppress_activation','0'),('emailmessage_suppress_reset','0'),('mail_charset','UTF-8'),('password_min_score','2'),('recaptcha_enabled','1'),('recaptcha_secret_key','6Le6OJ0aAAAAAJP6COxFD0614KxNTBkWuuXqONvt'),('recaptcha_site_key','<redacted>'),('request_key_expiration','+10 minutes'),('site_activation_page','activate'),('site_activation_page_append_code','0'),('site_email','ict1004proj@gmail.com'),('site_key','<redacted>'),('site_language','en_GB'),('site_name','T3ST'),('site_password_reset_page','reset.php'),('site_password_reset_page_append_code','1'),('site_timezone','Asia/Singapore'),('site_url','http://localhost:8080'),('smtp','1'),('smtp_auth','1'),('smtp_debug','0'),('smtp_host','smtp.gmail.com'),('smtp_password','<redacted>'),('smtp_port','587'),('smtp_security','tls'),('smtp_username','<redacted>'),('table_attempts','phpauth_attempts'),('table_emails_banned','phpauth_emails_banned'),('table_requests','phpauth_requests'),('table_sessions','phpauth_sessions'),('table_translations','phpauth_translation_dictionary'),('table_users','phpauth_users'),('translation_source','php'),('verify_email_max_length','100'),('verify_email_min_length','5'),('verify_email_use_banlist','1'),('verify_password_min_length','3');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_requests`
--

LOCK TABLES `phpauth_requests` WRITE;
/*!40000 ALTER TABLE `phpauth_requests` DISABLE KEYS */;
INSERT INTO `phpauth_requests` VALUES (1,2,'33JsD2W4l34DG9nuPp22','2021-04-06 13:31:56','reset');
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpauth_users`
--

LOCK TABLES `phpauth_users` WRITE;
/*!40000 ALTER TABLE `phpauth_users` DISABLE KEYS */;
INSERT INTO `phpauth_users` VALUES (1,'admin','2','admin@admin.com','$2y$10$e6M29.jYO6oWntRdq.o.3OSVkqo5qUKP/DkLG2E.gPW2A7FoGC9Ry',1,'2021-04-01 02:24:33');
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
  `title` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `body` mediumtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` int NOT NULL,
  `tag` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_archived` tinyint DEFAULT '0',
  `archived_date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_idx` (`op`),
  KEY `tag_idx` (`tag`),
  CONSTRAINT `op` FOREIGN KEY (`op`) REFERENCES `phpauth_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'Test1','<p>u[pdate pls work</p>','2021-04-05 00:00:00',0,'',0,NULL),(2,1,'New Blog','<p>lorem ipsum</p>','2021-04-05 00:00:00',10,'blah',0,NULL),(16,1,'hey there','<p><strong style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br data-mce-bogus=\"1\"></p>','0000-00-00 00:00:00',0,'new',0,NULL),(17,1,'XSS test','<pre style=\"font-family: SFMono-Regular, Consolas, &quot;Liberation Mono&quot;, Menlo, monospace; font-size: 13.6px; margin-bottom: 0px; overflow-wrap: normal; padding: 16px; line-height: 1.45; background-color: var(--color-bg-tertiary); border-radius: 6px; word-break: normal; color: rgb(36, 41, 46);\"><span class=\"pl-c\" style=\"color: var(--color-prettylights-syntax-comment);\">// Basic payload</span>\n<span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-ent\" style=\"color: var(--color-prettylights-syntax-entity-tag);\">script</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span>alert(\'XSS\')<span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">/</span><span class=\"pl-ent\" style=\"color: var(--color-prettylights-syntax-entity-tag);\">script</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span>\n<span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-s1\">scr</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-s1\">script</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span><span class=\"pl-s1\">ipt</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span><span class=\"pl-en\" style=\"color: var(--color-prettylights-syntax-entity);\">alert</span><span class=\"pl-kos\">(</span><span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\'XSS\'</span><span class=\"pl-kos\">)</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">/</span>scr&lt;script&gt;ipt&gt;\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\"&gt;&lt;script&gt;alert(\'XSS\')&lt;/script&gt;</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\"</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-ent\" style=\"color: var(--color-prettylights-syntax-entity-tag);\">script</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span>alert(String.fromCharCode(88,83,83))<span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">/</span><span class=\"pl-ent\" style=\"color: var(--color-prettylights-syntax-entity-tag);\">script</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span>\n\n<span class=\"pl-c\" style=\"color: var(--color-prettylights-syntax-comment);\">// Img payload</span>\n<span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-s1\">img</span> <span class=\"pl-s1\">src</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">=</span><span class=\"pl-s1\">x</span> <span class=\"pl-s1\">onerror</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">=</span><span class=\"pl-en\" style=\"color: var(--color-prettylights-syntax-entity);\">alert</span><span class=\"pl-kos\">(</span><span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\'XSS\'</span><span class=\"pl-kos\">)</span><span class=\"pl-kos\">;</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&gt;</span>\n<span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">&lt;</span><span class=\"pl-s1\">img</span> <span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">src</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">=</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">x</span> <span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">onerror</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">=</span><span class=\"pl-s1\">alert</span><span class=\"pl-kos\">(</span>\'<span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">XSS</span><span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\')//</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">&lt;img src=x onerror=alert(String.fromCharCode(88,83,83));&gt;</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">&lt;img src=x oneonerrorrror=alert(String.fromCharCode(88,83,83));&gt;</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">&lt;img src=x:alert(alt) onerror=eval(src) alt=xss&gt;</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\"&gt;&lt;img src=x onerror=alert(\'</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">XSS</span><span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\');&gt;</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">\"&gt;&lt;img src=x onerror=alert(String.fromCharCode(88,83,83));&gt;</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\"></span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">// Svg payload</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">&lt;svgonload=alert(1)&gt;</span>\n<span class=\"pl-s\" style=\"color: var(--color-prettylights-syntax-string);\">&lt;svg/onload=alert(\'</span><span class=\"pl-c1\" style=\"color: var(--color-prettylights-syntax-constant);\">XSS</span>\')&gt;\n&lt;svg onload=alert(1)//\n&lt;svg/onload=alert(String.fromCharCode(88,83,83))&gt;\n&lt;svg id=alert(1) onload=eval(id)&gt;\n\"&gt;&lt;svg/onload=alert(String.fromCharCode(88,83,83))&gt;\n\"&gt;&lt;svg/onload=alert(/XSS/)\n&lt;svg&gt;&lt;script href=data:,alert(1) /&gt;(`Firefox` is the only browser which allows self closing script)\n\n// Div payload\n&lt;div onpointerover=\"alert(45)\"&gt;MOVE HERE&lt;/div&gt;\n&lt;div onpointerdown=\"alert(45)\"&gt;MOVE HERE&lt;/div&gt;\n&lt;div onpointerenter=\"alert(45)\"&gt;MOVE HERE&lt;/div&gt;\n&lt;div onpointerleave=\"alert(45)\"&gt;MOVE HERE&lt;/div&gt;\n&lt;div onpointermove=\"alert(45)\"&gt;MOVE HERE&lt;/div&gt;\n&lt;div onpointerout=\"alert(45)\"&gt;MOVE HERE&lt;/div&gt;\n&lt;div onpointerup=\"alert(45)\"&gt;MOVE HERE&lt;/div&gt;</pre>','0000-00-00 00:00:00',0,'test',0,NULL),(18,1,'lorem test2','<p style=\"margin-bottom: 15px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-bottom: 15px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>','0000-00-00 00:00:00',0,'test',0,NULL),(19,1,'lorem test3','<p>asddddddddddddd<span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><span style=\"background-color: transparent;\">asddddddddddddd</span><br></p>','0000-00-00 00:00:00',0,'qq',0,NULL),(20,1,'lorem test4','<p>New STUFF234</p>','0000-00-00 00:00:00',0,'test',0,NULL),(21,1,'lorem test4','<p>hello this is a text post2</p>','0000-00-00 00:00:00',0,'qqq',0,NULL),(22,1,'lorem test4','<p>change text inpout u[date</p>','2021-04-06 22:42:18',0,'test',0,NULL),(23,1,'zazazazazaz','<p>change input test</p>','2021-04-06 22:47:17',0,'test',1,'2021-04-07 15:57:55'),(24,2,'Hello','<p>Hello from another user</p>','2021-04-07 16:36:56',0,'qq',0,NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_upvoted`
--

DROP TABLE IF EXISTS `user_upvoted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_upvoted` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `upvoted` text COLLATE utf8_bin,
  `downvoted` text COLLATE utf8_bin,
  PRIMARY KEY (`id`,`user`),
  KEY `user_idx` (`user`),
  CONSTRAINT `user` FOREIGN KEY (`user`) REFERENCES `phpauth_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_upvoted`
--

LOCK TABLES `user_upvoted` WRITE;
/*!40000 ALTER TABLE `user_upvoted` DISABLE KEYS */;
INSERT INTO `user_upvoted` VALUES (1,1,'','');
/*!40000 ALTER TABLE `user_upvoted` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-07 19:03:06
