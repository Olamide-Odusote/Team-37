-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: omnicart
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `Admin_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Admin_ID`),
  UNIQUE KEY `admins_email_unique` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'ABHJOYY','adam.sandhu123@hotmail.com','$2y$12$i6M39cruHoaqLvaCJsBpEOyb2/osFwauA/HAVf7wtk6sdHBAdHrcC','2026-02-06 19:30:51','2026-02-06 19:30:51');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `basket_products`
--

DROP TABLE IF EXISTS `basket_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `basket_products` (
  `BasketProduct_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Basket_ID` bigint unsigned NOT NULL,
  `Product_ID` bigint unsigned NOT NULL,
  `Quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`BasketProduct_ID`),
  KEY `basket_products_basket_id_foreign` (`Basket_ID`),
  KEY `basket_products_product_id_foreign` (`Product_ID`),
  CONSTRAINT `basket_products_basket_id_foreign` FOREIGN KEY (`Basket_ID`) REFERENCES `baskets` (`Basket_ID`) ON DELETE CASCADE,
  CONSTRAINT `basket_products_product_id_foreign` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basket_products`
--

LOCK TABLES `basket_products` WRITE;
/*!40000 ALTER TABLE `basket_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `basket_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `baskets`
--

DROP TABLE IF EXISTS `baskets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `baskets` (
  `Basket_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Customer_ID` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Basket_ID`),
  KEY `baskets_customer_id_foreign` (`Customer_ID`),
  CONSTRAINT `baskets_customer_id_foreign` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baskets`
--

LOCK TABLES `baskets` WRITE;
/*!40000 ALTER TABLE `baskets` DISABLE KEYS */;
INSERT INTO `baskets` VALUES (2,1,'2026-01-29 15:39:06','2026-01-29 15:39:06');
/*!40000 ALTER TABLE `baskets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_addresses`
--

DROP TABLE IF EXISTS `customer_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_addresses` (
  `CustomerAddress_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Customer_ID` bigint unsigned NOT NULL,
  `Street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Post_Code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`CustomerAddress_ID`),
  KEY `customer_addresses_customer_id_foreign` (`Customer_ID`),
  CONSTRAINT `customer_addresses_customer_id_foreign` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_addresses`
--

LOCK TABLES `customer_addresses` WRITE;
/*!40000 ALTER TABLE `customer_addresses` DISABLE KEYS */;
INSERT INTO `customer_addresses` VALUES (6,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-06 22:29:56','2026-02-06 22:29:56'),(7,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-06 22:30:34','2026-02-06 22:30:34'),(11,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-06 23:35:37','2026-02-06 23:35:37'),(12,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-06 23:49:43','2026-02-06 23:49:43'),(13,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-10 14:20:53','2026-02-10 14:20:53'),(14,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-13 16:36:23','2026-02-13 16:36:23'),(15,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-13 16:37:14','2026-02-13 16:37:14'),(16,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-13 16:38:55','2026-02-13 16:38:55'),(17,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-13 18:44:17','2026-02-13 18:44:17'),(18,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-13 18:50:45','2026-02-13 18:50:45'),(19,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 14:16:02','2026-02-14 14:16:02'),(20,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 14:35:40','2026-02-14 14:35:40'),(21,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 15:48:58','2026-02-14 15:48:58'),(22,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 20:03:43','2026-02-14 20:03:43'),(23,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 20:11:33','2026-02-14 20:11:33'),(24,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 21:29:57','2026-02-14 21:29:57'),(25,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 21:54:53','2026-02-14 21:54:53'),(26,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-14 22:25:17','2026-02-14 22:25:17'),(27,1,'Aston Street','Birmingham','B4 7ET','United Kingdom','2026-02-17 15:31:27','2026-02-17 15:31:27');
/*!40000 ALTER TABLE `customer_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_payments`
--

DROP TABLE IF EXISTS `customer_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_payments` (
  `CustomerPayment_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Customer_ID` bigint unsigned NOT NULL,
  `CardHolder_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaskedCardNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ExpiryDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`CustomerPayment_ID`),
  KEY `customer_payments_customer_id_foreign` (`Customer_ID`),
  CONSTRAINT `customer_payments_customer_id_foreign` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_payments`
--

LOCK TABLES `customer_payments` WRITE;
/*!40000 ALTER TABLE `customer_payments` DISABLE KEYS */;
INSERT INTO `customer_payments` VALUES (3,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-06 22:29:56','2026-02-06 22:29:56'),(4,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-06 22:30:34','2026-02-06 22:30:34'),(8,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-06 23:35:37','2026-02-06 23:35:37'),(9,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-06 23:49:43','2026-02-06 23:49:43'),(10,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-10 14:20:53','2026-02-10 14:20:53'),(11,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-13 16:36:23','2026-02-13 16:36:23'),(12,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-13 16:37:14','2026-02-13 16:37:14'),(13,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-13 16:38:55','2026-02-13 16:38:55'),(14,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-13 18:44:17','2026-02-13 18:44:17'),(15,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-13 18:50:45','2026-02-13 18:50:45'),(16,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 14:16:02','2026-02-14 14:16:02'),(17,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 14:35:40','2026-02-14 14:35:40'),(18,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 15:48:58','2026-02-14 15:48:58'),(19,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 20:03:43','2026-02-14 20:03:43'),(20,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 20:11:33','2026-02-14 20:11:33'),(21,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 21:29:57','2026-02-14 21:29:57'),(22,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 21:54:53','2026-02-14 21:54:53'),(23,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-14 22:25:17','2026-02-14 22:25:17'),(24,1,'Adam Sandhu','XXXXXXXXXXXX1112','2034-07-01','2026-02-17 15:31:27','2026-02-17 15:31:27');
/*!40000 ALTER TABLE `customer_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `Customer_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobile Number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Customer_ID`),
  UNIQUE KEY `customers_email_unique` (`Email`),
  UNIQUE KEY `customers_user_id_unique` (`user_id`),
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,1,'Adam','as123@gmail.com','$2y$12$BBV7EZp0dimXpXIMO88Yhe/wZUQ9RhMMhpaoT0ElXjTvdaPJUf4w2',0,'2026-01-29 15:37:06','2026-01-29 15:37:06');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedbacks` (
  `Feedback_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Customer_ID` bigint unsigned NOT NULL,
  `Product_ID` bigint unsigned NOT NULL,
  `Rating` tinyint NOT NULL,
  `Comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Feedback_ID`),
  KEY `feedbacks_customer_id_foreign` (`Customer_ID`),
  KEY `feedbacks_product_id_foreign` (`Product_ID`),
  CONSTRAINT `feedbacks_customer_id_foreign` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`) ON DELETE CASCADE,
  CONSTRAINT `feedbacks_product_id_foreign` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_orders`
--

DROP TABLE IF EXISTS `final_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `final_orders` (
  `FinalOrder_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Customer_ID` bigint unsigned NOT NULL,
  `CustomerAddress_ID` bigint unsigned NOT NULL,
  `CustomerPayment_ID` bigint unsigned NOT NULL,
  `OrderDate` date NOT NULL,
  `Total_Price` decimal(8,2) NOT NULL,
  `Status` enum('pending','shipped','delivered','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`FinalOrder_ID`),
  KEY `final_orders_customer_id_foreign` (`Customer_ID`),
  KEY `final_orders_customeraddress_id_foreign` (`CustomerAddress_ID`),
  KEY `final_orders_customerpayment_id_foreign` (`CustomerPayment_ID`),
  CONSTRAINT `final_orders_customer_id_foreign` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`) ON DELETE CASCADE,
  CONSTRAINT `final_orders_customeraddress_id_foreign` FOREIGN KEY (`CustomerAddress_ID`) REFERENCES `customer_addresses` (`CustomerAddress_ID`) ON DELETE CASCADE,
  CONSTRAINT `final_orders_customerpayment_id_foreign` FOREIGN KEY (`CustomerPayment_ID`) REFERENCES `customer_payments` (`CustomerPayment_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_orders`
--

LOCK TABLES `final_orders` WRITE;
/*!40000 ALTER TABLE `final_orders` DISABLE KEYS */;
INSERT INTO `final_orders` VALUES (2,1,6,3,'2026-02-06',687.00,'delivered','2026-02-06 22:29:56','2026-02-18 00:49:27'),(3,1,7,4,'2026-02-06',229.00,'delivered','2026-02-06 22:30:34','2026-02-18 00:50:24'),(7,1,11,8,'2026-02-06',229.00,'delivered','2026-02-06 23:35:37','2026-02-18 00:50:50'),(8,1,12,9,'2026-02-06',229.00,'delivered','2026-02-06 23:49:43','2026-02-18 00:51:01'),(9,1,13,10,'2026-02-10',127.96,'delivered','2026-02-10 14:20:54','2026-02-18 00:51:23'),(10,1,14,11,'2026-02-13',458.00,'shipped','2026-02-13 16:36:23','2026-02-18 00:52:17'),(11,1,15,12,'2026-02-13',458.00,'delivered','2026-02-13 16:37:14','2026-02-18 00:51:45'),(12,1,16,13,'2026-02-13',243.99,'delivered','2026-02-13 16:38:55','2026-02-18 00:51:53'),(13,1,17,14,'2026-02-13',91.96,'delivered','2026-02-13 18:44:17','2026-02-18 00:52:02'),(14,1,18,15,'2026-02-13',258.99,'delivered','2026-02-13 18:50:45','2026-02-18 00:51:33'),(15,1,19,16,'2026-02-14',458.00,'shipped','2026-02-14 14:16:02','2026-02-18 00:52:43'),(16,1,20,17,'2026-02-14',243.99,'shipped','2026-02-14 14:35:40','2026-02-18 00:52:52'),(17,1,21,18,'2026-02-14',36.96,'shipped','2026-02-14 15:48:58','2026-02-18 00:53:00'),(18,1,22,19,'2026-02-14',687.00,'shipped','2026-02-14 20:03:43','2026-02-18 00:53:08'),(19,1,23,20,'2026-02-14',472.99,'shipped','2026-02-14 20:11:33','2026-02-18 00:53:15'),(20,1,24,21,'2026-02-14',17.99,'shipped','2026-02-14 21:29:57','2026-02-18 00:53:25'),(21,1,25,22,'2026-02-14',319.94,'shipped','2026-02-14 21:54:53','2026-02-18 00:53:32'),(22,1,26,23,'2026-02-14',302.92,'shipped','2026-02-14 22:25:17','2026-02-18 00:53:43'),(23,1,27,24,'2026-02-17',19.99,'returned','2026-02-17 15:31:28','2026-02-18 00:54:00');
/*!40000 ALTER TABLE `final_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventories` (
  `Inventory_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Product_ID` bigint unsigned NOT NULL,
  `Quantity` int NOT NULL DEFAULT '0',
  `Threshold` int NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Inventory_ID`),
  KEY `inventories_product_id_foreign` (`Product_ID`),
  CONSTRAINT `inventories_product_id_foreign` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (1,1,29,10,'2026-02-06 19:53:07','2026-02-18 12:30:37'),(2,2,32,10,'2026-02-06 19:53:07','2026-02-14 22:25:17'),(3,3,37,10,'2026-02-06 19:53:07','2026-02-14 21:54:53'),(4,4,45,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(5,5,27,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(6,6,32,10,'2026-02-06 19:53:07','2026-02-17 15:31:28'),(7,7,30,10,'2026-02-06 19:53:07','2026-02-14 22:25:17'),(8,8,31,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(9,9,21,10,'2026-02-06 19:53:07','2026-02-13 18:44:17'),(10,10,29,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(11,11,46,10,'2026-02-06 19:53:07','2026-02-10 14:20:54'),(12,12,21,10,'2026-02-06 19:53:07','2026-02-10 14:20:54'),(13,13,21,10,'2026-02-06 19:53:07','2026-02-10 14:20:54'),(14,14,18,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(15,15,17,10,'2026-02-06 19:53:07','2026-02-10 14:20:54'),(16,16,69,10,'2026-02-06 19:53:07','2026-02-06 20:10:23'),(17,17,38,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(18,18,46,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(19,19,21,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(20,20,48,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(21,21,13,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(22,22,21,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(23,23,46,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(24,24,27,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(25,25,29,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(26,26,36,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(27,27,37,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(28,28,33,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(29,29,27,10,'2026-02-06 19:53:07','2026-02-06 20:25:17'),(30,30,15,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(31,31,36,10,'2026-02-06 19:53:07','2026-02-14 15:48:58'),(32,32,39,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(33,33,20,10,'2026-02-06 19:53:07','2026-02-14 15:48:58'),(34,34,44,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(35,35,39,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(36,36,15,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(37,37,47,10,'2026-02-06 19:53:07','2026-02-14 15:48:58'),(38,38,26,10,'2026-02-06 19:53:07','2026-02-14 15:48:58'),(39,39,29,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(40,40,30,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(41,41,37,10,'2026-02-06 19:53:07','2026-02-14 22:25:17'),(42,42,46,10,'2026-02-06 19:53:07','2026-02-14 22:25:17'),(43,43,27,10,'2026-02-06 19:53:07','2026-02-14 21:54:53'),(44,44,31,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(45,45,36,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(46,46,19,10,'2026-02-06 19:53:07','2026-02-18 12:30:50'),(47,47,38,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(48,48,28,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(49,49,46,10,'2026-02-06 19:53:07','2026-02-06 19:53:07'),(50,50,50,10,'2026-02-06 19:53:07','2026-02-06 19:53:07');
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_logs`
--

DROP TABLE IF EXISTS `inventory_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory_logs` (
  `InventoryLog_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Product_ID` bigint unsigned NOT NULL,
  `Admin_ID` bigint unsigned DEFAULT NULL,
  `Action_Type` enum('restock','return','adjustment') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Quantity_Changed` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`InventoryLog_ID`),
  KEY `inventory_logs_product_id_foreign` (`Product_ID`),
  KEY `inventory_logs_admin_id_foreign` (`Admin_ID`),
  CONSTRAINT `inventory_logs_admin_id_foreign` FOREIGN KEY (`Admin_ID`) REFERENCES `admins` (`Admin_ID`) ON DELETE CASCADE,
  CONSTRAINT `inventory_logs_product_id_foreign` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_logs`
--

LOCK TABLES `inventory_logs` WRITE;
/*!40000 ALTER TABLE `inventory_logs` DISABLE KEYS */;
INSERT INTO `inventory_logs` VALUES (1,29,1,'restock',20,'2026-02-06 20:25:17','2026-02-06 20:25:17'),(2,1,NULL,'adjustment',-1,'2026-02-06 23:35:37','2026-02-06 23:35:37'),(3,1,NULL,'adjustment',-1,'2026-02-06 23:49:43','2026-02-06 23:49:43'),(4,11,NULL,'adjustment',-1,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(5,12,NULL,'adjustment',-1,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(6,13,NULL,'adjustment',-1,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(7,15,NULL,'adjustment',-1,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(8,1,NULL,'adjustment',-2,'2026-02-13 16:36:23','2026-02-13 16:36:23'),(9,1,NULL,'adjustment',-2,'2026-02-13 16:37:14','2026-02-13 16:37:14'),(10,1,NULL,'adjustment',-1,'2026-02-13 16:38:55','2026-02-13 16:38:55'),(11,2,NULL,'adjustment',-1,'2026-02-13 16:38:55','2026-02-13 16:38:55'),(12,9,NULL,'adjustment',-4,'2026-02-13 18:44:17','2026-02-13 18:44:17'),(13,1,NULL,'adjustment',-1,'2026-02-13 18:50:45','2026-02-13 18:50:45'),(14,3,NULL,'adjustment',-1,'2026-02-13 18:50:45','2026-02-13 18:50:45'),(15,1,NULL,'adjustment',-2,'2026-02-14 14:16:02','2026-02-14 14:16:02'),(16,1,NULL,'adjustment',-1,'2026-02-14 14:35:40','2026-02-14 14:35:40'),(17,2,NULL,'adjustment',-1,'2026-02-14 14:35:40','2026-02-14 14:35:40'),(18,31,NULL,'adjustment',-1,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(19,33,NULL,'adjustment',-1,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(20,37,NULL,'adjustment',-1,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(21,38,NULL,'adjustment',-1,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(22,1,NULL,'adjustment',-3,'2026-02-14 20:03:43','2026-02-14 20:03:43'),(23,1,NULL,'adjustment',-2,'2026-02-14 20:11:33','2026-02-14 20:11:33'),(24,2,NULL,'adjustment',-1,'2026-02-14 20:11:33','2026-02-14 20:11:33'),(25,7,NULL,'adjustment',-1,'2026-02-14 21:29:57','2026-02-14 21:29:57'),(26,1,NULL,'adjustment',-1,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(27,2,NULL,'adjustment',-1,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(28,3,NULL,'adjustment',-1,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(29,7,NULL,'adjustment',-1,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(30,41,NULL,'adjustment',-1,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(31,42,NULL,'adjustment',-1,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(32,43,NULL,'adjustment',-1,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(33,1,NULL,'adjustment',-1,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(34,2,NULL,'adjustment',-1,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(35,7,NULL,'adjustment',-1,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(36,41,NULL,'adjustment',-1,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(37,42,NULL,'adjustment',-1,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(38,46,NULL,'adjustment',-4,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(39,6,NULL,'adjustment',-1,'2026-02-17 15:31:28','2026-02-17 15:31:28'),(40,1,1,'restock',20,'2026-02-18 12:30:37','2026-02-18 12:30:37'),(41,46,1,'restock',10,'2026-02-18 12:30:50','2026-02-18 12:30:50');
/*!40000 ALTER TABLE `inventory_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_11_17_101650_create_customers_table',1),(5,'2025_11_17_105633_create_customer_addresses_table',1),(6,'2025_11_17_111730_create_customer_payments_table',1),(7,'2025_11_17_111800_create_admins_table',1),(8,'2025_11_17_111900_create_product_categories_table',1),(9,'2025_11_17_112100_create_products_table',1),(10,'2025_11_17_112150_create_inventories_table',1),(11,'2025_11_17_112200_create_inventory_logs_table',1),(12,'2025_11_17_112500_create_baskets_table',1),(13,'2025_11_17_112644_create_basket_products_table',1),(14,'2025_11_18_094640_create_final_orders_table',1),(15,'2025_11_18_100653_create_order_items_table',1),(16,'2025_11_18_101322_create_return_requests_table',1),(17,'2025_11_18_102018_create_feedback_table',1),(18,'2025_12_05_094205_add_image_url_to_product_categories_table',2),(19,'2025_12_05_101955_fix_imageurl_column',3),(20,'2026_01_29_141911_add_user_id_to_customers',4),(21,'2026_02_06_232153_make_admin_id_nullable_on_inventory_logs',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `OrderItem_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `FinalOrder_ID` bigint unsigned NOT NULL,
  `Product_ID` bigint unsigned NOT NULL,
  `Quantity` int NOT NULL,
  `Unit_Price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`OrderItem_ID`),
  KEY `order_items_finalorder_id_foreign` (`FinalOrder_ID`),
  KEY `order_items_product_id_foreign` (`Product_ID`),
  CONSTRAINT `order_items_finalorder_id_foreign` FOREIGN KEY (`FinalOrder_ID`) REFERENCES `final_orders` (`FinalOrder_ID`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,2,1,3,229.00,'2026-02-06 22:29:56','2026-02-06 22:29:56'),(2,3,1,1,229.00,'2026-02-06 22:30:34','2026-02-06 22:30:34'),(6,7,1,1,229.00,'2026-02-06 23:35:37','2026-02-06 23:35:37'),(7,8,1,1,229.00,'2026-02-06 23:49:43','2026-02-06 23:49:43'),(8,9,11,1,39.99,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(9,9,12,1,12.99,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(10,9,13,1,24.99,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(11,9,15,1,49.99,'2026-02-10 14:20:54','2026-02-10 14:20:54'),(12,10,1,2,229.00,'2026-02-13 16:36:23','2026-02-13 16:36:23'),(13,11,1,2,229.00,'2026-02-13 16:37:14','2026-02-13 16:37:14'),(14,12,1,1,229.00,'2026-02-13 16:38:55','2026-02-13 16:38:55'),(15,12,2,1,14.99,'2026-02-13 16:38:55','2026-02-13 16:38:55'),(16,13,9,4,22.99,'2026-02-13 18:44:17','2026-02-13 18:44:17'),(17,14,1,1,229.00,'2026-02-13 18:50:45','2026-02-13 18:50:45'),(18,14,3,1,29.99,'2026-02-13 18:50:45','2026-02-13 18:50:45'),(19,15,1,2,229.00,'2026-02-14 14:16:02','2026-02-14 14:16:02'),(20,16,1,1,229.00,'2026-02-14 14:35:40','2026-02-14 14:35:40'),(21,16,2,1,14.99,'2026-02-14 14:35:40','2026-02-14 14:35:40'),(22,17,31,1,6.99,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(23,17,33,1,8.99,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(24,17,37,1,5.99,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(25,17,38,1,14.99,'2026-02-14 15:48:58','2026-02-14 15:48:58'),(26,18,1,3,229.00,'2026-02-14 20:03:43','2026-02-14 20:03:43'),(27,19,1,2,229.00,'2026-02-14 20:11:33','2026-02-14 20:11:33'),(28,19,2,1,14.99,'2026-02-14 20:11:33','2026-02-14 20:11:33'),(29,20,7,1,17.99,'2026-02-14 21:29:57','2026-02-14 21:29:57'),(30,21,1,1,229.00,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(31,21,2,1,14.99,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(32,21,3,1,29.99,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(33,21,7,1,17.99,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(34,21,41,1,11.99,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(35,21,42,1,8.99,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(36,21,43,1,6.99,'2026-02-14 21:54:53','2026-02-14 21:54:53'),(37,22,1,1,229.00,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(38,22,2,1,14.99,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(39,22,7,1,17.99,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(40,22,41,1,11.99,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(41,22,42,1,8.99,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(42,22,46,4,4.99,'2026-02-14 22:25:17','2026-02-14 22:25:17'),(43,23,6,1,19.99,'2026-02-17 15:31:28','2026-02-17 15:31:28');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `ProductCategory_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci,
  `ImageURL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ProductCategory_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Computers & Accessories','Electronical devices and accessories used by everyone for everyday use. No matter the location we have everything you need','images/categories/Laptop.png',NULL,NULL),(2,'Wardrobe','Comfortable, stylish essentials made for real people and real moments. Wear what makes you feel confident, relaxed, and truly yourself.','images/categories/wardrobe.png',NULL,NULL),(3,'Sports','Gear that supports your goals—whether you’re training, exploring, or just staying active. Built to help you feel stronger, healthier, and motivated every day.','images/categories/sport.png',NULL,NULL),(4,'Education & Equipment','Simple tools that inspire learning, creativity, and productivity. Everything you need to stay organised, focused, and ready for your next step.','images/categories/education.png',NULL,NULL),(5,'Personal Healthcare','Thoughtful essentials that help you take care of yourself—mind, body, and everyday wellbeing. Because feeling good should always come first.','images/categories/ph.png',NULL,NULL);
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `Product_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ProductCategory_ID` bigint unsigned NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci,
  `Price` decimal(8,2) NOT NULL,
  `Image_URL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Product_ID`),
  KEY `products_productcategory_id_foreign` (`ProductCategory_ID`),
  CONSTRAINT `products_productcategory_id_foreign` FOREIGN KEY (`ProductCategory_ID`) REFERENCES `product_categories` (`ProductCategory_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Dell Latitude 6300U Laptop','A reliable ultrabook with fast SSD storage, smooth multitasking and a compact design — ideal for work or study.',229.00,'Laptop.jpg',NULL,NULL),(2,1,'Mouse','A smooth, comfortable wireless mouse perfect for everyday browsing, work and travel.',14.99,'Mouse.jpeg',NULL,NULL),(3,1,'Headphones','Comfortable, high-clarity headphones designed for immersive listening and noise reduction.',29.99,'Headphones.jpeg',NULL,NULL),(4,1,'USB-C Charger','A durable 65W charger offering fast, stable charging for most modern laptops.',24.99,'Charger.jpeg',NULL,NULL),(5,1,'32GB USB 3.0 Flash Drive','Portable, fast and reliable storage for documents, photos and backups.',9.99,'USB-Drive.jpeg',NULL,NULL),(6,1,'Keyboard','Slim, quiet and responsive — an ideal wireless keyboard for productivity and comfort.',19.99,'Keyboard.jpeg',NULL,NULL),(7,1,'Laptop Stand','Ergonomic aluminium stand designed to improve posture and cooling while you work.',17.99,'Laptopstand.jpeg',NULL,NULL),(8,1,'HD Webcam','Crystal-clear video quality for meetings, classes and streaming sessions.',34.99,'webcam.jpeg',NULL,NULL),(9,1,'Portable Power Bank 20,000mAh','High-capacity power bank to keep your devices charged on the move.',22.99,'powerbank.jpg',NULL,NULL),(10,1,'Bluetooth Speaker','Compact yet powerful speaker with rich sound and long battery life.',27.99,'bluetoothspeaker.jpeg',NULL,NULL),(11,2,'Casual Sneakers','Lightweight, stylish sneakers built for all-day comfort.',39.99,'shoes.jpeg',NULL,NULL),(12,2,'Casual T-Shirt','Soft-cotton t-shirt designed for comfort, style and durability.',12.99,'tshirt.png',NULL,NULL),(13,2,'Casual Trousers','Stretch-fit trousers offering both comfort and versatility.',24.99,'trousers.jpeg',NULL,NULL),(14,2,'Socks & Underwear Pack','A premium selection of everyday essentials designed for comfort.',14.99,'underwearsocks.jpg',NULL,NULL),(15,2,'Accessory Set (Glasses / Earrings / Smart Watch)','A stylish accessory bundle made to complement any outfit.',49.99,'accessories.jpeg',NULL,NULL),(16,2,'Hoodie','Warm, comfy hoodie built for everyday wear and relaxation.',29.99,'hoodie.png',NULL,NULL),(17,2,'Baseball Cap','Classic adjustable cap perfect for daily wear.',9.99,'cap.jpeg',NULL,NULL),(18,2,'Crossbody Bag','Compact, secure bag for quick trips and urban travel.',19.99,'crossbody.jpeg',NULL,NULL),(19,2,'Smart Watch','Feature-rich smartwatch with fitness tracking and notifications.',59.99,'smartwatch.jpeg',NULL,NULL),(20,2,'Backpack','Durable backpack with spacious compartments for work, school or travel.',34.99,'backpack.jpeg',NULL,NULL),(21,3,'Sports Top','Breathable, sweat-wicking athletic top designed for intense workouts.',15.99,'sportstop.jpeg',NULL,NULL),(22,3,'Running Shoes','Lightweight running shoes engineered for speed and comfort.',49.99,'sportsshoes.jpeg',NULL,NULL),(23,3,'Dumbbell Pair','Versatile dumbbells ideal for strength training at home.',29.99,'weights.jpeg',NULL,NULL),(24,3,'Resistance Bands Set','Multi-strength bands for strength, mobility and conditioning.',12.99,'resistanceband.jpeg',NULL,NULL),(25,3,'Football','High-quality football with excellent grip and durability.',17.99,'football.jpeg',NULL,NULL),(26,3,'BPA-Free Water Bottle','Durable, leak-proof bottle perfect for the gym or travel.',7.99,'waterbottle.jpeg',NULL,NULL),(27,3,'Yoga Mat','Soft, non-slip yoga mat offering excellent cushioning.',19.99,'yogamat.jpeg',NULL,NULL),(28,3,'Skipping Rope','Lightweight skipping rope perfect for fitness and cardio.',6.99,'skippingrope.jpeg',NULL,NULL),(29,3,'Gym Gloves','Protective gloves designed for comfort during lifting.',14.99,'gymgloves.jpeg',NULL,NULL),(30,3,'Smart Fitness Vest','Advanced vest that tracks movement, posture and performance.',69.99,'fitnessvest.jpeg',NULL,NULL),(31,4,'Notebook Pack','Smooth-paper notebooks ideal for revision, sketching and notes.',6.99,'notebooks.jpeg',NULL,NULL),(32,4,'Document Folders','Durable, colourful folders to organise school or office documents.',4.99,'folders.jpeg',NULL,NULL),(33,4,'Filled Stationery Case','A complete stationery kit with pens, pencils, ruler and more.',8.99,'stationerycase.jpeg',NULL,NULL),(34,4,'Highlighter Set','Vibrant highlighters perfect for study notes and revision.',3.99,'highlighters.jpeg',NULL,NULL),(35,4,'Sticky Notes Pack','Bright sticky notes for reminders, study tips and annotations.',2.99,'stickynotes.jpeg',NULL,NULL),(36,4,'Online Course Pack','Digital learning courses covering key study and career skills.',29.99,'onlinecourse.jpeg',NULL,NULL),(37,4,'Flashcards Pack','Revision flashcards ideal for exams and active recall.',5.99,'flashcards.jpeg',NULL,NULL),(38,4,'Laptop Privacy Screen','Privacy filter to protect your screen from side-viewing.',14.99,'privacyscreen.jpeg',NULL,NULL),(39,4,'Scientific Calculator','Reliable calculator for exams, coursework and everyday maths.',12.99,'calculator.jpeg',NULL,NULL),(40,4,'Binder & Paper Clips Set','Organisational set for keeping papers tidy and secure.',3.49,'binderclips.jpeg',NULL,NULL),(41,5,'First Aid Kit','A compact, essential first aid kit for home, travel or emergencies.',11.99,'firstaid.jpg',NULL,NULL),(42,5,'Basic Medicine Pack','A curated set of essential over-the-counter items for daily health.',8.99,'medicinepack.jpeg',NULL,NULL),(43,5,'Oral Care Kit','A complete dental hygiene set with brush, paste and floss.',6.99,'oralcare.jpeg',NULL,NULL),(44,5,'Skin Care Bundle','A premium care set designed for nourishment and protection.',19.99,'skincare.jpeg',NULL,NULL),(45,5,'Shower Essentials Pack','Everything you need for refreshing daily hygiene.',9.99,'showerproducts.jpeg',NULL,NULL),(46,5,'Sleep Mask','A soft, light-blocking sleep mask for deep, restful sleep.',4.99,'sleepmask.jpeg',NULL,NULL),(47,5,'Hand Sanitiser','Fast-drying sanitiser that kills 99.9% of germs.',2.49,'handsanitizer.jpeg',NULL,NULL),(48,5,'Lip Balm','Hydrating lip balm that keeps lips soft and protected.',1.99,'lipbalm.jpeg',NULL,NULL),(49,5,'Hair Styling Cream','Flexible-hold cream that defines and nourishes hair.',5.99,'stylingcream.jpeg',NULL,NULL),(50,5,'Body Scrub','Gentle exfoliating scrub for smooth, refreshed skin.',7.99,'bodyscrub.jpeg',NULL,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_requests`
--

DROP TABLE IF EXISTS `return_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `return_requests` (
  `ReturnRequest_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `OrderItem_ID` bigint unsigned NOT NULL,
  `Reason` text COLLATE utf8mb4_unicode_ci,
  `Status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ReturnRequest_ID`),
  KEY `return_requests_orderitem_id_foreign` (`OrderItem_ID`),
  CONSTRAINT `return_requests_orderitem_id_foreign` FOREIGN KEY (`OrderItem_ID`) REFERENCES `order_items` (`OrderItem_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_requests`
--

LOCK TABLES `return_requests` WRITE;
/*!40000 ALTER TABLE `return_requests` DISABLE KEYS */;
INSERT INTO `return_requests` VALUES (1,8,'Wrong size','pending','2026-02-10 14:22:01','2026-02-10 14:22:01');
/*!40000 ALTER TABLE `return_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('SWOd0WaKZSS1EZK9VSlWyA1E8csPyKmBu1cMET5h',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYUozOElnQ2toODN2TlE1a2hzTUh2SHlGNTJlcHJlSXMwckE5bXJ5eSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbnZlbnRvcnkiO3M6NToicm91dGUiO3M6MjE6ImFkbWluLmludmVudG9yeS5pbmRleCI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1771696539);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adam','as123@gmail.com',NULL,'$2y$12$BBV7EZp0dimXpXIMO88Yhe/wZUQ9RhMMhpaoT0ElXjTvdaPJUf4w2',NULL,'2025-12-09 10:18:24','2025-12-09 10:18:24');
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

-- Dump completed on 2026-02-22 14:17:51
