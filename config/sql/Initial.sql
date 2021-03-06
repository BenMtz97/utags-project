CREATE DATABASE  IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `blog`;
-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: blog
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `cat_country`
--

DROP TABLE IF EXISTS `cat_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_country` (
  `idcat_country` int NOT NULL AUTO_INCREMENT,
  `key` varchar(2) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idcat_country`),
  UNIQUE KEY `key_UNIQUE` (`key`),
  UNIQUE KEY `idcat_countries_UNIQUE` (`idcat_country`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_country`
--

LOCK TABLES `cat_country` WRITE;
/*!40000 ALTER TABLE `cat_country` DISABLE KEYS */;
INSERT INTO `cat_country` VALUES (1,'AF','AFGHANISTAN'),(2,'AL','ALBANIA'),(3,'DZ','ALGERIA'),(4,'AS','AMERICAN SAMOA'),(5,'AD','ANDORRA'),(6,'AO','ANGOLA'),(7,'AI','ANGUILLA'),(8,'AQ','ANTARCTICA'),(9,'AG','ANTIGUA AND BARBUDA'),(10,'AR','ARGENTINA'),(11,'AM','ARMENIA'),(12,'AW','ARUBA'),(13,'AU','AUSTRALIA'),(14,'AT','AUSTRIA'),(15,'AZ','AZERBAIJAN'),(16,'BS','BAHAMAS'),(17,'BH','BAHRAIN'),(18,'BD','BANGLADESH'),(19,'BB','BARBADOS'),(20,'BY','BELARUS'),(21,'BE','BELGIUM'),(22,'BZ','BELIZE'),(23,'BJ','BENIN'),(24,'BM','BERMUDA'),(25,'BT','BHUTAN'),(26,'BO','BOLIVIA'),(27,'BA','BOSNIA AND HERZEGOVINA'),(28,'BW','BOTSWANA'),(29,'BV','BOUVET ISLAND'),(30,'BR','BRAZIL'),(31,'IO','BRITISH INDIAN OCEAN TERRITORY'),(32,'BN','BRUNEI DARUSSALAM'),(33,'BG','BULGARIA'),(34,'BF','BURKINA FASO'),(35,'BI','BURUNDI'),(36,'KH','CAMBODIA'),(37,'CM','CAMEROON'),(38,'CA','CANADA'),(39,'CV','CAPE VERDE'),(40,'KY','CAYMAN ISLANDS'),(41,'CF','CENTRAL AFRICAN REPUBLIC'),(42,'TD','CHAD'),(43,'CL','CHILE'),(44,'CN','CHINA'),(45,'CX','CHRISTMAS ISLAND'),(46,'CC','COCOS (KEELING) ISLANDS'),(47,'CO','COLOMBIA'),(48,'KM','COMOROS'),(49,'CG','CONGO'),(50,'CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE'),(51,'CK','COOK ISLANDS'),(52,'CR','COSTA RICA'),(53,'CI','COTE D IVOIRE'),(54,'HR','CROATIA'),(55,'CU','CUBA'),(56,'CY','CYPRUS'),(57,'CZ','CZECH REPUBLIC'),(58,'DK','DENMARK'),(59,'DJ','DJIBOUTI'),(60,'DM','DOMINICA'),(61,'DO','DOMINICAN REPUBLIC'),(62,'TP','EAST TIMOR'),(63,'EC','ECUADOR'),(64,'EG','EGYPT'),(65,'SV','EL SALVADOR'),(66,'GQ','EQUATORIAL GUINEA'),(67,'ER','ERITREA'),(68,'EE','ESTONIA'),(69,'ET','ETHIOPIA'),(70,'FK','FALKLAND ISLANDS (MALVINAS)'),(71,'FO','FAROE ISLANDS'),(72,'FJ','FIJI'),(73,'FI','FINLAND'),(74,'FR','FRANCE'),(75,'GF','FRENCH GUIANA'),(76,'PF','FRENCH POLYNESIA'),(77,'TF','FRENCH SOUTHERN TERRITORIES'),(78,'GA','GABON'),(79,'GM','GAMBIA'),(80,'GE','GEORGIA'),(81,'DE','GERMANY'),(82,'GH','GHANA'),(83,'GI','GIBRALTAR'),(84,'GR','GREECE'),(85,'GL','GREENLAND'),(86,'GD','GRENADA'),(87,'GP','GUADELOUPE'),(88,'GU','GUAM'),(89,'GT','GUATEMALA'),(90,'GN','GUINEA'),(91,'GW','GUINEA-BISSAU'),(92,'GY','GUYANA'),(93,'HT','HAITI'),(94,'HM','HEARD ISLAND AND MCDONALD ISLANDS'),(95,'VA','HOLY SEE (VATICAN CITY STATE)'),(96,'HN','HONDURAS'),(97,'HK','HONG KONG'),(98,'HU','HUNGARY'),(99,'IS','ICELAND'),(100,'IN','INDIA'),(101,'ID','INDONESIA'),(102,'IR','IRAN, ISLAMIC REPUBLIC OF'),(103,'IQ','IRAQ'),(104,'IE','IRELAND'),(105,'IL','ISRAEL'),(106,'IT','ITALY'),(107,'JM','JAMAICA'),(108,'JP','JAPAN'),(109,'JO','JORDAN'),(110,'KZ','KAZAKSTAN'),(111,'KE','KENYA'),(112,'KI','KIRIBATI'),(113,'KP','KOREA DEMOCRATIC PEOPLES REPUBLIC OF'),(114,'KR','KOREA REPUBLIC OF'),(115,'KW','KUWAIT'),(116,'KG','KYRGYZSTAN'),(117,'LA','LAO PEOPLES DEMOCRATIC REPUBLIC'),(118,'LV','LATVIA'),(119,'LB','LEBANON'),(120,'LS','LESOTHO'),(121,'LR','LIBERIA'),(122,'LY','LIBYAN ARAB JAMAHIRIYA'),(123,'LI','LIECHTENSTEIN'),(124,'LT','LITHUANIA'),(125,'LU','LUXEMBOURG'),(126,'MO','MACAU'),(127,'MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF'),(128,'MG','MADAGASCAR'),(129,'MW','MALAWI'),(130,'MY','MALAYSIA'),(131,'MV','MALDIVES'),(132,'ML','MALI'),(133,'MT','MALTA'),(134,'MH','MARSHALL ISLANDS'),(135,'MQ','MARTINIQUE'),(136,'MR','MAURITANIA'),(137,'MU','MAURITIUS'),(138,'YT','MAYOTTE'),(139,'MX','MEXICO'),(140,'FM','MICRONESIA, FEDERATED STATES OF'),(141,'MD','MOLDOVA, REPUBLIC OF'),(142,'MC','MONACO'),(143,'MN','MONGOLIA'),(144,'MS','MONTSERRAT'),(145,'MA','MOROCCO'),(146,'MZ','MOZAMBIQUE'),(147,'MM','MYANMAR'),(148,'NA','NAMIBIA'),(149,'NR','NAURU'),(150,'NP','NEPAL'),(151,'NL','NETHERLANDS'),(152,'AN','NETHERLANDS ANTILLES'),(153,'NC','NEW CALEDONIA'),(154,'NZ','NEW ZEALAND'),(155,'NI','NICARAGUA'),(156,'NE','NIGER'),(157,'NG','NIGERIA'),(158,'NU','NIUE'),(159,'NF','NORFOLK ISLAND'),(160,'MP','NORTHERN MARIANA ISLANDS'),(161,'NO','NORWAY'),(162,'OM','OMAN'),(163,'PK','PAKISTAN'),(164,'PW','PALAU'),(165,'PS','PALESTINIAN TERRITORY, OCCUPIED'),(166,'PA','PANAMA'),(167,'PG','PAPUA NEW GUINEA'),(168,'PY','PARAGUAY'),(169,'PE','PERU'),(170,'PH','PHILIPPINES'),(171,'PN','PITCAIRN'),(172,'PL','POLAND'),(173,'PT','PORTUGAL'),(174,'PR','PUERTO RICO'),(175,'QA','QATAR'),(176,'RE','REUNION'),(177,'RO','ROMANIA'),(178,'RU','RUSSIAN FEDERATION'),(179,'RW','RWANDA'),(180,'SH','SAINT HELENA'),(181,'KN','SAINT KITTS AND NEVIS'),(182,'LC','SAINT LUCIA'),(183,'PM','SAINT PIERRE AND MIQUELON'),(184,'VC','SAINT VINCENT AND THE GRENADINES'),(185,'WS','SAMOA'),(186,'SM','SAN MARINO'),(187,'ST','SAO TOME AND PRINCIPE'),(188,'SA','SAUDI ARABIA'),(189,'SN','SENEGAL'),(190,'SC','SEYCHELLES'),(191,'SL','SIERRA LEONE'),(192,'SG','SINGAPORE'),(193,'SK','SLOVAKIA'),(194,'SI','SLOVENIA'),(195,'SB','SOLOMON ISLANDS'),(196,'SO','SOMALIA'),(197,'ZA','SOUTH AFRICA'),(198,'GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS'),(199,'ES','SPAIN'),(200,'LK','SRI LANKA'),(201,'SD','SUDAN'),(202,'SR','SURINAME'),(203,'SJ','SVALBARD AND JAN MAYEN'),(204,'SZ','SWAZILAND'),(205,'SE','SWEDEN'),(206,'CH','SWITZERLAND'),(207,'SY','SYRIAN ARAB REPUBLIC'),(208,'TW','TAIWAN, PROVINCE OF CHINA'),(209,'TJ','TAJIKISTAN'),(210,'TZ','TANZANIA, UNITED REPUBLIC OF'),(211,'TH','THAILAND'),(212,'TG','TOGO'),(213,'TK','TOKELAU'),(214,'TO','TONGA'),(215,'TT','TRINIDAD AND TOBAGO'),(216,'TN','TUNISIA'),(217,'TR','TURKEY'),(218,'TM','TURKMENISTAN'),(219,'TC','TURKS AND CAICOS ISLANDS'),(220,'TV','TUVALU'),(221,'UG','UGANDA'),(222,'UA','UKRAINE'),(223,'AE','UNITED ARAB EMIRATES'),(224,'GB','UNITED KINGDOM'),(225,'US','UNITED STATES'),(226,'UM','UNITED STATES MINOR OUTLYING ISLANDS'),(227,'UY','URUGUAY'),(228,'UZ','UZBEKISTAN'),(229,'VU','VANUATU'),(230,'VE','VENEZUELA'),(231,'VN','VIET NAM'),(232,'VG','VIRGIN ISLANDS, BRITISH'),(233,'VI','VIRGIN ISLANDS, U.S.'),(234,'WF','WALLIS AND FUTUNA'),(235,'EH','WESTERN SAHARA'),(236,'YE','YEMEN'),(237,'YU','YUGOSLAVIA'),(238,'ZM','ZAMBIA'),(239,'ZW','ZIMBABWE');
/*!40000 ALTER TABLE `cat_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `lastname` varchar(40) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` bigint DEFAULT NULL,
  `country` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(60) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `auth_key` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `login_attempts` smallint DEFAULT '0',
  `login_lock_date` datetime DEFAULT NULL,
  `type` smallint unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_uindex` (`email`),
  UNIQUE KEY `user_id_uindex` (`id`),
  UNIQUE KEY `user_username_uindex` (`username`),
  KEY `country_idx` (`country`),
  CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `cat_country` (`idcat_country`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Benjamin','Martinez','2006-11-23','benmtz97','bmartinez97.08@yahoo.com',4494927915,1,1,'$2y$13$vDml2VUlZAI2eaayTKalU.W/vVrO6W2X9TQgSLFo1jB7FkZuk1cfq','2021-12-05 23:43:01','2021-12-05 19:13:39',NULL,NULL,'LW_hwx0fsOvQw7SVYrMSYcPb87_CAx2t',0,NULL,2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'blog'
--

--
-- Dumping routines for database 'blog'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-06  0:32:40
