-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: pos
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'MILK & DIAPERS'),(2,'OINTMENTS'),(3,'BRANDED TABLETS'),(4,'GENERIC TABLETS'),(5,'SUPPLEMENTS'),(6,'BRANDED SYRUP'),(7,'GENERIC SYRUP'),(8,'GALLENICALS'),(9,'TEST2');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(100) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `date_transact` datetime DEFAULT NULL,
  `total_items` int DEFAULT NULL,
  `total_purchase` float DEFAULT NULL,
  `discount` tinyint(1) DEFAULT '0' COMMENT 'True | False',
  `costumer_name` varchar(100) DEFAULT NULL,
  `osca_number` varchar(100) DEFAULT NULL,
  `cash_payment` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_FK` (`user_id`),
  CONSTRAINT `invoices_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,'20221227102104',1,'2022-12-27 10:21:04',1,435,0,'',NULL,NULL),(2,'20221227110021',1,'2022-12-27 11:00:21',1,368,1,'Jason',NULL,NULL),(3,'20230107090124',1,'2023-01-07 09:01:24',2,87,0,'',NULL,NULL),(4,'20230107090240',1,'2023-01-07 09:02:40',2,160,0,'',NULL,NULL),(5,'20230107090528',1,'2023-01-07 09:05:28',1,240,0,'',NULL,NULL),(6,'20230109001009',1,'2023-01-09 00:10:09',2,267.6,1,'John Dela Cruz',NULL,NULL),(7,'20230109014930',1,'2023-01-09 01:49:30',1,125,0,'','',150),(8,'20230109020323',1,'2023-01-09 02:03:23',2,315,1,'Juana Dela Cruz','4568799',350),(9,'20230109020857',1,'2023-01-09 02:08:57',2,345,0,'','',350),(10,'20230109021133',1,'2023-01-09 02:11:33',3,515,1,'Test Customer Name','1241251',1000),(11,'20230109044833',1,'2023-01-09 04:48:33',2,300,0,'','',500);
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `buy_price` float DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `expired_status` int DEFAULT '0',
  `batch` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_details_FK` (`product_id`),
  CONSTRAINT `product_details_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
INSERT INTO `product_details` VALUES (1,1,0,10,'2022-12-27 10:01:16','2023-04-27',0,3),(2,1,0,10,'2022-12-27 10:02:19','2023-03-07',0,2),(3,1,9,10,'2022-12-27 10:03:07','2023-07-20',0,4),(4,2,0,30,'2022-12-27 10:04:14','2023-05-25',0,1),(5,2,0,30,'2022-12-27 10:05:07','2023-11-10',0,2),(6,3,0,5,'2022-12-27 10:05:52','2023-03-16',0,1),(7,3,0,6,'2022-12-27 10:06:17','2023-07-18',0,2),(8,4,0,15,'2022-12-27 10:54:34','2023-03-07',0,1),(9,4,0,15,'2022-12-27 10:55:55','2023-06-21',0,2),(10,4,0,15,'2022-12-27 10:56:13','2023-12-27',0,4),(11,5,0,15,'2022-12-27 10:56:56','2023-02-09',0,2),(12,5,5,20,'2022-12-27 10:57:12','2023-04-26',0,3),(13,4,10,15,'2023-01-09 02:00:28','2023-09-08',0,3),(14,5,10,20,'2023-01-09 03:53:45','2023-01-09',1,1),(15,1,20,10,'2023-01-09 04:22:19','2022-12-13',1,1),(16,5,10,15,'2023-01-09 04:23:10','2023-01-09',1,1),(17,6,13,12,'2023-01-09 04:46:09','2023-01-09',1,1);
/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `barcode` int DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sale_price` float DEFAULT NULL,
  `status` int DEFAULT NULL,
  `max_stock` int DEFAULT NULL,
  `min_stock` int DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_FK` (`category_id`),
  CONSTRAINT `products_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1479,'Happy Baby Pants Large 12s',20,1,50,20,NULL),(2,2,22,'Betamethasone Cream',33.5,1,20,8,NULL),(3,3,294,'Advil Liquigel capsule',10,1,10,5,'branded'),(4,4,107,'Allopurinol 100mg tab',25,1,NULL,NULL,'generic'),(5,3,287,'Alaxan FR capsule',25,1,NULL,NULL,'branded'),(6,9,123,'test',12,1,NULL,NULL,'branded');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `invoice_id` int DEFAULT NULL,
  `product_detail_id` int DEFAULT NULL,
  `void` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_FK` (`product_id`),
  KEY `sales_FK_1` (`invoice_id`),
  KEY `sales_FK_2` (`product_detail_id`),
  CONSTRAINT `sales_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `sales_FK_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  CONSTRAINT `sales_FK_2` FOREIGN KEY (`product_detail_id`) REFERENCES `product_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,1,300,15,'2022-12-27 10:21:04',1,2,1),(2,1,100,5,'2022-12-27 10:21:04',1,1,1),(3,2,335,10,'2022-12-27 10:21:04',1,4,NULL),(4,2,100.5,3,'2022-12-27 10:21:04',1,5,NULL),(5,3,100,10,'2022-12-27 10:21:04',1,6,1),(6,3,20,2,'2022-12-27 10:21:04',1,7,1),(7,4,160,10,'2022-12-27 11:00:21',2,8,NULL),(8,4,80,5,'2022-12-27 11:00:21',2,9,NULL),(9,4,128,8,'2022-12-27 11:00:21',2,10,NULL),(10,5,460,20,'2022-12-27 11:00:21',2,11,1),(11,5,23,1,'2022-12-27 11:00:21',2,12,1),(12,1,20,1,'2023-01-07 09:01:24',3,2,NULL),(13,2,67,2,'2023-01-07 09:01:24',3,5,NULL),(14,1,60,3,'2023-01-07 09:02:40',4,2,NULL),(15,3,100,10,'2023-01-07 09:02:40',4,6,NULL),(16,4,240,12,'2023-01-07 09:05:28',5,10,NULL),(17,1,220,11,'2023-01-09 00:10:09',6,2,NULL),(18,1,20,1,'2023-01-09 00:10:09',6,1,NULL),(19,3,27.6,3,'2023-01-09 00:10:09',6,7,NULL),(20,5,125,5,'2023-01-09 01:49:30',7,11,NULL),(21,5,115,5,'2023-01-09 02:03:23',8,11,NULL),(22,4,200,10,'2023-01-09 02:03:23',8,13,NULL),(23,4,325,13,'2023-01-09 02:08:57',9,13,NULL),(24,3,20,2,'2023-01-09 02:08:57',9,7,NULL),(25,1,180,9,'2023-01-09 02:11:33',10,1,NULL),(26,1,20,1,'2023-01-09 02:11:33',10,3,NULL),(27,4,200,10,'2023-01-09 02:11:33',10,13,NULL),(28,5,115,5,'2023-01-09 02:11:33',10,11,NULL),(29,5,125,5,'2023-01-09 04:48:33',11,11,NULL),(30,4,175,7,'2023-01-09 04:48:33',11,13,NULL);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trigger`
--

DROP TABLE IF EXISTS `trigger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trigger` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `triggered` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trigger_FK` (`user_id`),
  CONSTRAINT `trigger_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trigger`
--

LOCK TABLES `trigger` WRITE;
/*!40000 ALTER TABLE `trigger` DISABLE KEYS */;
/*!40000 ALTER TABLE `trigger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `login_attempt` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','Doe','owner','$2y$10$uovfGxUqgB7aaOXTlT832OEXoy52Kj1lJ6wzqchHhhnTi65937ZAS',1,1,'2023-01-09 04:51:21',0),(2,'Juan','Dela Cruz','admin','$2y$10$45sOywxA1w7OX4m0I/E4Q.Nl5ii0Q892FNdwhnKr.s.xW.y4iP3gq',2,1,'2023-01-09 04:49:38',0),(3,'Juana','Dela Cruz','user','$2y$10$z1a/NP5vWRsGUHRCepnk1.V9m0AiER.7zE7Xgff3XMkgGBYyk57By',3,1,'2022-12-27 17:17:36',NULL),(6,'Test','Test','user2','$2y$10$ty1kK4D2WYYFcQfL7EZfVeYSFkg6wYbBdBLiC3Xjapp2eijb4U.AO',3,1,'2023-01-09 03:34:07',0),(7,'user3','user3','user3','$2y$10$NfmdGTpxlbt2WjYMYi2qfetOX8v1NDy2mpDmH3fijT2nDrLPUaHzG',2,1,NULL,NULL);
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

-- Dump completed on 2023-01-09  4:57:44
