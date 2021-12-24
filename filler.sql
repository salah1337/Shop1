-- MariaDB dump 10.19  Distrib 10.5.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: shopchop
-- ------------------------------------------------------
-- Server version	10.5.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abilities`
--

DROP TABLE IF EXISTS `abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abilities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `abilities_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abilities`
--

LOCK TABLES `abilities` WRITE;
/*!40000 ALTER TABLE `abilities` DISABLE KEYS */;
INSERT INTO `abilities` VALUES (1,'store-optionGroup','create option groups',NULL,NULL),(2,'store-option','create options',NULL,NULL),(3,'store-orderDetail','create order details for existing orders',NULL,NULL),(4,'store-order','place orders',NULL,NULL),(5,'store-productCategory','create product categories',NULL,NULL),(6,'store-productOption','create product options',NULL,NULL),(7,'store-product','create products',NULL,NULL),(8,'store-user','create users',NULL,NULL),(9,'update-optionGroup','update option groups',NULL,NULL),(10,'update-option','update options',NULL,NULL),(11,'update-orderDetail','update order details for existing orders',NULL,NULL),(12,'update-productCategory','update product categories',NULL,NULL),(13,'update-productOption','update product options',NULL,NULL),(14,'update-product','update products',NULL,NULL),(15,'update-user','update users',NULL,NULL),(16,'delete-optionGroup','delete option groups',NULL,NULL),(17,'delete-option','delete options',NULL,NULL),(18,'delete-orderDetail','delete order details for existing orders',NULL,NULL),(19,'delete-order','cancel orders',NULL,NULL),(20,'delete-productCategory','delete product categories',NULL,NULL),(21,'delete-productOption','delete product options',NULL,NULL),(22,'delete-product','delete products',NULL,NULL),(23,'delete-user','delete users',NULL,NULL);
/*!40000 ALTER TABLE `abilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ability_role`
--

DROP TABLE IF EXISTS `ability_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ability_role` (
  `role_id` bigint(20) unsigned NOT NULL,
  `ability_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`ability_id`),
  KEY `ability_role_ability_id_foreign` (`ability_id`),
  CONSTRAINT `ability_role_ability_id_foreign` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ability_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ability_role`
--

LOCK TABLES `ability_role` WRITE;
/*!40000 ALTER TABLE `ability_role` DISABLE KEYS */;
INSERT INTO `ability_role` VALUES (2,14,NULL,NULL),(3,23,NULL,NULL),(4,8,NULL,NULL),(5,2,NULL,NULL),(6,8,NULL,NULL),(7,13,NULL,NULL),(8,6,NULL,NULL),(9,13,NULL,NULL);
/*!40000 ALTER TABLE `ability_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `cart_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` VALUES (1,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Fiat','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Voluptatem.',1,71,22.00,1,5),(2,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Hoodies','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Necessitatibus.',1,81,93.00,2,3),(3,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Lenovo','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Qui dolore.',5,40,574.00,3,2),(4,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Honda','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Nulla iure.',5,63,977.00,4,8),(5,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Fiat','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Molestiae sit.',2,92,269.00,5,4),(6,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Fiat','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Voluptatem.',2,71,22.00,6,5),(7,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Fiat','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Voluptatem.',2,71,22.00,7,5),(8,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Honda','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Nulla iure.',2,63,977.00,8,8),(9,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Honda','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Nulla iure.',3,63,977.00,9,8),(10,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Lenovo','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[{\"id\":3,\"created_at\":\"2020-09-08T16:56:39.000000Z\",\"updated_at\":\"2020-09-08T16:56:39.000000Z\",\"priceIncrement\":9,\"option_id\":7,\"option_group_id\":1,\"product_id\":3,\"name\":\"red\",\"group\":{\"id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"colors\"},\"option\":{\"id\":7,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"red\",\"option_group_id\":1}},{\"id\":18,\"created_at\":\"2020-09-08T16:56:40.000000Z\",\"updated_at\":\"2020-09-08T16:56:40.000000Z\",\"priceIncrement\":8,\"option_id\":2,\"option_group_id\":2,\"product_id\":3,\"name\":\"small\",\"group\":{\"id\":2,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"name\":\"sizes\"},\"option\":{\"id\":2,\"created_at\":\"2020-09-08T16:56:32.000000Z\",\"updated_at\":\"2020-09-08T16:56:32.000000Z\",\"deleted_at\":null,\"name\":\"small\",\"option_group_id\":2}}]','Qui dolore.',3,40,574.00,10,2);
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,'2021-12-24 04:13:54','2021-12-24 04:13:54',22,11),(2,'2021-12-24 04:13:54','2021-12-24 04:13:54',93,1),(3,'2021-12-24 04:13:54','2021-12-24 04:13:54',2870,2),(4,'2021-12-24 04:13:54','2021-12-24 04:13:54',4885,3),(5,'2021-12-24 04:13:54','2021-12-24 04:13:54',538,4),(6,'2021-12-24 04:13:54','2021-12-24 04:13:54',44,5),(7,'2021-12-24 04:13:54','2021-12-24 04:13:54',44,6),(8,'2021-12-24 04:13:54','2021-12-24 04:13:54',1954,7),(9,'2021-12-24 04:13:54','2021-12-24 04:13:54',2931,8),(10,'2021-12-24 04:13:54','2021-12-24 04:13:54',1722,9),(11,'2021-12-24 04:13:54','2021-12-24 04:13:54',0,10);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2020_05_28_190232_create_orders_table',1),(10,'2020_05_28_190751_create_product_categories_table',1),(11,'2020_05_28_190832_create_option_groups_table',1),(12,'2020_05_28_190833_create_products_table',1),(13,'2020_05_28_190834_create_options_table',1),(14,'2020_05_28_190835_create_order_details_table',1),(15,'2020_05_28_190836_create_product_options_table',1),(16,'2020_06_01_234055_create_roles_table',1),(17,'2020_06_01_234211_create_abilities_table',1),(18,'2020_06_01_234544_ability_role',1),(19,'2020_06_01_234902_role_user',1),(20,'2020_06_07_211245_create_carts_table',1),(21,'2020_06_08_153426_create_cart_items_table',1),(22,'2020_09_04_225940_create_addresses_table',1),(23,'2020_09_11_203933_create_cities_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_groups`
--

DROP TABLE IF EXISTS `option_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_groups`
--

LOCK TABLES `option_groups` WRITE;
/*!40000 ALTER TABLE `option_groups` DISABLE KEYS */;
INSERT INTO `option_groups` VALUES (1,NULL,NULL,NULL,'colors'),(2,NULL,NULL,NULL,'sizes'),(3,NULL,NULL,NULL,'models');
/*!40000 ALTER TABLE `option_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_group_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `options_option_group_id_foreign` (`option_group_id`),
  CONSTRAINT `options_option_group_id_foreign` FOREIGN KEY (`option_group_id`) REFERENCES `option_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'small',2),(2,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'small',2),(3,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'x220',3),(4,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'small',2),(5,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'medium',2),(6,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'blue',1),(7,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'x220',3),(8,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'small',2),(9,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'red',1);
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SKU` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_product_id_foreign` (`product_id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (1,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Honda orderDetails','Ho/Ca','kek',8793.00,9,8,7),(2,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Fiat orderDetails','Fi/Ca','kek',2152.00,8,4,10),(3,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Honda orderDetails','Ho/Ca','kek',5862.00,6,8,2),(4,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s socks orderDetails','so/T-','kek',400.00,4,10,7),(5,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Hoodies orderDetails','Ho/T-','kek',744.00,8,3,5),(6,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Fiat orderDetails','Fi/Ca','kek',350.00,1,1,3),(7,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Hoodies orderDetails','Ho/T-','kek',651.00,7,3,2),(8,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Fiat orderDetails','Fi/Ca','kek',2800.00,8,1,6),(9,'2021-12-24 04:13:54','2021-12-24 04:13:54','schumm.toni\'s Jeep orderDetails','Je/Ca','kek',864.00,6,6,8),(10,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Fiat orderDetails','Fi/Ca','kek',66.00,3,5,3),(11,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Honda orderDetails','Ho/Ca','kek',600.00,5,7,7),(12,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Accer orderDetails','Ac/La','kek',4304.00,8,9,6),(13,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Fiat orderDetails','Fi/Ca','kek',22.00,1,5,4),(14,'2021-12-24 04:13:54','2021-12-24 04:13:54','rosario42\'s Fiat orderDetails','Fi/Ca','kek',220.00,10,5,9),(15,'2021-12-24 04:13:54','2021-12-24 04:13:54','schumm.toni\'s Fiat orderDetails','Fi/Ca','kek',198.00,9,5,8),(16,'2021-12-24 04:13:54','2021-12-24 04:13:54','rosario42\'s Fiat orderDetails','Fi/Ca','kek',2800.00,8,1,9),(17,'2021-12-24 04:13:54','2021-12-24 04:13:54','schumm.toni\'s Accer orderDetails','Ac/La','kek',538.00,1,9,8),(18,'2021-12-24 04:13:54','2021-12-24 04:13:54','rosario42\'s Fiat orderDetails','Fi/Ca','kek',3500.00,10,1,9),(19,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Honda orderDetails','Ho/Ca','kek',8793.00,9,8,7),(20,'2021-12-24 04:13:54','2021-12-24 04:13:54','mohammed55\'s Accer orderDetails','Ac/La','kek',1076.00,2,9,1),(21,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Honda orderDetails','Ho/Ca','kek',977.00,1,8,2),(22,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Accer orderDetails','Ac/La','kek',3766.00,7,9,6),(23,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Jeep orderDetails','Je/Ca','kek',432.00,3,6,4),(24,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Honda orderDetails','Ho/Ca','kek',480.00,4,7,3),(25,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Fiat orderDetails','Fi/Ca','kek',1883.00,7,4,4),(26,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Hoodies orderDetails','Ho/T-','kek',93.00,1,3,4),(27,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Fiat orderDetails','Fi/Ca','kek',1345.00,5,4,10),(28,'2021-12-24 04:13:54','2021-12-24 04:13:54','baumbach.kaitlyn\'s Jeep orderDetails','Je/Ca','kek',864.00,6,6,3),(29,'2021-12-24 04:13:54','2021-12-24 04:13:54','schumm.toni\'s Honda orderDetails','Ho/Ca','kek',8793.00,9,8,8),(30,'2021-12-24 04:13:54','2021-12-24 04:13:54','vrippin\'s Lenovo orderDetails','Le/La','kek',5166.00,9,2,4);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `shipName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipAddress` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipAddress2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping` double(8,2) NOT NULL,
  `tax` double(8,2) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipped` tinyint(1) NOT NULL DEFAULT 0,
  `trackingNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,243.00,'Moses Ondricka','553 Schoen Fall Apt. 318\nSouth Harley, WA 24490','63653 Nolan Valley Apt. 698\nJadynchester, AZ 62437','North Amaniburgh','Nevada','46277','Chad','888.994.9007','83210-1732',18.00,6.00,'michelle85@example.com',0,'wyAMix7FUR',6),(2,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,368.00,'Dandre Hermiston','9261 Wiegand Garden Apt. 825\nSouth Nicole, KS 82190','481 Upton Square\nLake Estelle, OR 68828','Champlinhaven','District of Columbia','31090','Saint Martin','(866) 324-4509','54792-5883',19.00,20.00,'harley.lemke@example.net',1,'TGuGJmyteG',9),(3,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,299.00,'Dandre Hermiston','5610 Heidenreich Hill\nHintzfort, VA 63000','326 Verla Stream\nBednarland, WI 93873-4136','Keeblerport','Ohio','51668-2421','El Salvador','888-697-4838','48373',19.00,24.00,'harley.lemke@example.net',0,'UbZVprnXnq',9),(4,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,48.00,'Sydnee Ruecker','44356 Jenkins Glen\nFerryfort, ID 49430-8535','795 Heathcote Islands\nSpencerport, GA 10910','Pacochaville','Wisconsin','89114','Cape Verde','855.808.6889','13746',2.00,17.00,'lhuels@example.net',0,'ZtpSDLgsTY',1),(5,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,719.00,'Sydnee Ruecker','824 Ullrich Garden\nPort Kurtisshire, FL 48127','797 Wisozk Divide Apt. 915\nStrackeview, OR 34448-2841','Schulistbury','New Mexico','82187-8966','Guatemala','1-866-564-2679','75543',13.00,12.00,'lhuels@example.net',1,'8iyYXkWcGd',1),(6,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,950.00,'Sydnee Ruecker','65865 Rodrigo Plains\nBrayanburgh, ME 19309','701 Kihn Views Suite 229\nEichmannshire, DE 56398','West Alberto','Louisiana','66092-1933','Rwanda','1-888-499-1494','20444',10.00,4.00,'lhuels@example.net',1,'faGhvomaxE',1),(7,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,241.00,'Sydnee Ruecker','48850 Genevieve Dam Apt. 277\nBorerfurt, SD 23117-2198','88778 Macejkovic Cape\nCrooksstad, DC 61694','South Chestershire','District of Columbia','98116','Madagascar','(855) 434-0570','81461',20.00,5.00,'lhuels@example.net',1,'jV84fvtKKP',1),(8,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,415.00,'Johnnie O\'Hara','8776 Orrin Extension Suite 203\nWhiteton, OR 65005','205 Nolan Garden\nKingland, TX 92112-0305','Dessiehaven','Indiana','83110','Estonia','(800) 986-6622','42002-3816',13.00,20.00,'sherman.kuphal@example.com',0,'wztG5l9u2V',8),(9,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,949.00,'Sydnie Abshire','38254 Feeney Estate\nKoelpinmouth, VT 33809','2361 Valentine Estate\nAntoniamouth, NE 65409','Myriammouth','South Dakota','78239','Reunion','800-333-9567','64915-7642',12.00,18.00,'vallie.feil@example.net',0,'V9AR9QaLxf',2),(10,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,853.00,'Dandre Hermiston','22411 Lenora Stravenue Suite 891\nWest Elinor, WV 67060-9864','95774 Rebeca Hills Apt. 030\nBoehmfurt, FL 10966','North Vanbury','Kentucky','78338','Czech Republic','800.751.4911','28232',20.00,15.00,'harley.lemke@example.net',1,'UVaUXru5OA',9);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,NULL,NULL,'T-shirts','portrait'),(2,NULL,NULL,'Cars','portrait'),(3,NULL,NULL,'Laptops','portrait');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_options`
--

DROP TABLE IF EXISTS `product_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `priceIncrement` double(8,2) NOT NULL,
  `option_id` bigint(20) unsigned NOT NULL,
  `option_group_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_options_option_id_foreign` (`option_id`),
  KEY `product_options_option_group_id_foreign` (`option_group_id`),
  KEY `product_options_product_id_foreign` (`product_id`),
  CONSTRAINT `product_options_option_group_id_foreign` FOREIGN KEY (`option_group_id`) REFERENCES `option_groups` (`id`),
  CONSTRAINT `product_options_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  CONSTRAINT `product_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_options`
--

LOCK TABLES `product_options` WRITE;
/*!40000 ALTER TABLE `product_options` DISABLE KEYS */;
INSERT INTO `product_options` VALUES (1,'2021-12-24 04:13:54','2021-12-24 04:13:54',17.00,8,2,2),(2,'2021-12-24 04:13:54','2021-12-24 04:13:54',19.00,6,1,2),(3,'2021-12-24 04:13:54','2021-12-24 04:13:54',3.00,3,3,6),(4,'2021-12-24 04:13:54','2021-12-24 04:13:54',22.00,4,2,10),(5,'2021-12-24 04:13:54','2021-12-24 04:13:54',4.00,8,2,7),(6,'2021-12-24 04:13:54','2021-12-24 04:13:54',10.00,9,1,10),(7,'2021-12-24 04:13:54','2021-12-24 04:13:54',20.00,3,3,1),(8,'2021-12-24 04:13:54','2021-12-24 04:13:54',24.00,9,1,5),(9,'2021-12-24 04:13:54','2021-12-24 04:13:54',24.00,7,3,9),(10,'2021-12-24 04:13:54','2021-12-24 04:13:54',7.00,1,2,7),(11,'2021-12-24 04:13:54','2021-12-24 04:13:54',11.00,6,1,8),(12,'2021-12-24 04:13:54','2021-12-24 04:13:54',22.00,3,3,6),(13,'2021-12-24 04:13:54','2021-12-24 04:13:54',11.00,5,2,6),(14,'2021-12-24 04:13:54','2021-12-24 04:13:54',3.00,5,2,7),(15,'2021-12-24 04:13:54','2021-12-24 04:13:54',21.00,7,3,2),(16,'2021-12-24 04:13:54','2021-12-24 04:13:54',4.00,8,2,10),(17,'2021-12-24 04:13:54','2021-12-24 04:13:54',7.00,2,2,2),(18,'2021-12-24 04:13:54','2021-12-24 04:13:54',19.00,3,3,5),(19,'2021-12-24 04:13:54','2021-12-24 04:13:54',8.00,8,2,10),(20,'2021-12-24 04:13:54','2021-12-24 04:13:54',18.00,9,1,5),(21,'2021-12-24 04:13:54','2021-12-24 04:13:54',2.00,5,2,3),(22,'2021-12-24 04:13:54','2021-12-24 04:13:54',22.00,7,3,7),(23,'2021-12-24 04:13:54','2021-12-24 04:13:54',16.00,6,1,8),(24,'2021-12-24 04:13:54','2021-12-24 04:13:54',11.00,4,2,2),(25,'2021-12-24 04:13:54','2021-12-24 04:13:54',7.00,9,1,7),(26,'2021-12-24 04:13:54','2021-12-24 04:13:54',21.00,2,2,5),(27,'2021-12-24 04:13:54','2021-12-24 04:13:54',22.00,1,2,7),(28,'2021-12-24 04:13:54','2021-12-24 04:13:54',11.00,3,3,9),(29,'2021-12-24 04:13:54','2021-12-24 04:13:54',5.00,3,3,1),(30,'2021-12-24 04:13:54','2021-12-24 04:13:54',12.00,5,2,1);
/*!40000 ALTER TABLE `product_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `SKU` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `tax` double(8,2) NOT NULL,
  `weight` double(8,2) NOT NULL,
  `cartDesc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortDesc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longDesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` double(8,2) NOT NULL,
  `live` tinyint(1) NOT NULL,
  `unlimited` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `product_category_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Fi/Ca','Fiat',350.00,95.00,911.00,'At reiciendis.','Enim nobis aspernatur dicta et. Quasi in molestias saepe et nulla.','Nemo voluptas est facere. Similique eum non reprehenderit animi explicabo amet dolor. Est quo quasi quia amet cum et. In suscipit et quam eaque. Totam nobis id dolor deleniti numquam tempore nihil. A reprehenderit laudantium similique voluptates sapiente voluptatem et. Reiciendis occaecati corrupti dolores sapiente qui officiis ducimus. Sequi aut id ut voluptatum aut. Ipsum soluta et aspernatur nemo. Voluptatem maxime voluptas facilis. Quidem nobis itaque dolorem sit perferendis rerum.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','94355 Antonio Canyon Apt. 297',27.00,0,0,0,2),(2,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Le/La','Lenovo',574.00,40.00,3438.00,'Qui dolore.','Et repellat possimus quis nulla quas soluta autem. Eveniet sapiente a asperiores nihil libero.','Eum enim tempora rerum commodi ipsum assumenda consequuntur. Rem quos et nostrum optio ipsa. Est qui odit neque. Alias eos vel harum sed labore voluptatem. Animi repudiandae omnis et iusto. Possimus delectus est laudantium temporibus officiis. Quo totam aut ratione exercitationem aut modi provident. Culpa officiis dignissimos maxime id et. Laboriosam eaque quia ea fuga. Ut quas aut sunt cupiditate a ipsam quia. Tempora iure corrupti ipsam et numquam eos accusamus.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','51269 Rolfson Meadow',434.00,1,0,0,3),(3,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Ho/T-','Hoodies',93.00,81.00,149.00,'Necessitatibus.','Dolores laborum dolores sunt libero rerum voluptates. Dolorem quaerat ratione nam nulla.','Est est nesciunt qui porro minus. Iusto molestias architecto quae. Est qui aliquid ut. Aut quibusdam doloribus incidunt nesciunt rem ad. At sit hic velit qui. Voluptatum expedita iusto quibusdam. Quibusdam aut laudantium eos non. Nulla officiis aliquid et ut sit. Facilis repellendus officiis officiis vel sapiente assumenda repellendus et.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','151 April Cliff Apt. 090',379.00,1,0,0,1),(4,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Fi/Ca','Fiat',269.00,92.00,1116.00,'Molestiae sit.','Repellat facere aut sed consectetur. Molestiae culpa sed magnam in. Ea incidunt delectus aut.','Ea expedita inventore et in ut assumenda ut. Magni ut impedit dolores similique illum aut. Voluptates illum quo odio rerum dolores natus reiciendis sint. Aut sit voluptates eligendi earum. Aperiam ut molestias voluptas et animi quae. Maiores velit earum mollitia. Ad amet soluta quia eum sit voluptas blanditiis rerum. Modi quas ut nemo iusto quia quas.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','21329 Casper Mount',314.00,1,0,0,2),(5,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Fi/Ca','Fiat',22.00,71.00,2761.00,'Voluptatem.','Quos omnis amet dignissimos soluta ut. Fugit ea explicabo quis et.','Eius id consectetur magnam cupiditate. Illo laboriosam et cupiditate consequatur et labore. Cum aliquam velit mollitia expedita. Velit et et quod adipisci debitis illum ducimus. Fugit ea odit corporis quis. Repellat consequatur qui sit maiores optio et. Esse velit consequatur enim corrupti quos aut. Id asperiores et aperiam voluptatem nobis saepe nisi rerum. Commodi beatae sunt inventore minus ea error. Nemo distinctio porro et repellendus nemo blanditiis in.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','845 Halie Square Apt. 095',455.00,1,1,0,2),(6,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Je/Ca','Jeep',144.00,23.00,3378.00,'Totam eum ab.','Quis nisi et repellat et. In ut aliquam ut laboriosam. Et qui voluptas labore blanditiis.','Accusantium at non eius tenetur et sit. Sequi blanditiis quas laudantium est repellat. Alias nobis sit minima eos ipsa aut. Odit dolores et quidem. Et voluptatum perspiciatis eos sed molestias velit est. Unde et ea aut earum dolor. Voluptatem delectus sapiente asperiores quia aut et nihil. Soluta illum voluptatum voluptas ut quod dolor modi. Autem maiores laboriosam illum et. Et enim iusto tempore sint et qui. Sapiente velit sed sit dicta. Provident numquam aut velit alias.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','7863 Legros Fall',124.00,1,0,0,2),(7,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Ho/Ca','Honda',120.00,8.00,615.00,'Veritatis.','Et enim id voluptatem quo. Dolores ea sed voluptatem in sed eius.','Excepturi at et et libero distinctio quae in. Sit sit ad non voluptate nostrum saepe. Unde nihil impedit ducimus aut. Inventore ut sit omnis veniam rerum quis. Magni sed eos velit debitis dolorum eos sapiente. Sed numquam ipsa dolorum voluptas voluptates deserunt velit neque. Quis autem recusandae dicta consectetur. Molestias nemo sit maxime aut. Non qui ut quisquam.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','8087 Mayert Hollow Suite 961',253.00,0,0,0,2),(8,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Ho/Ca','Honda',977.00,63.00,2760.00,'Nulla iure.','At vero consequatur illum vel fuga aut. Aut nulla veritatis voluptatem voluptatem repudiandae.','Et cum dignissimos harum laudantium vero nobis. Animi deserunt est magni voluptatem quasi dolor illo. Est dolores tenetur assumenda quia doloribus magni fugiat. In laboriosam doloremque nesciunt hic veniam voluptatem occaecati. Ipsam vitae occaecati facere tempore reprehenderit. Pariatur id minus facilis voluptatem porro accusamus. Et consequatur temporibus at ea eveniet. Praesentium ut exercitationem eos voluptas. Aliquam vel omnis deserunt veritatis eligendi totam tenetur corporis.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','21966 Zita Loaf Suite 142',2.00,1,0,0,2),(9,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'Ac/La','Accer',538.00,29.00,3205.00,'Amet aut.','Dolor quis laboriosam adipisci ducimus. Consequatur quas numquam nihil dignissimos fugit.','Aperiam omnis placeat totam doloremque. Expedita velit odio facilis. Numquam omnis ratione architecto quis praesentium et possimus. Nihil voluptatem exercitationem nesciunt vero sit cupiditate quidem asperiores. Ut dolores aut tempora. Voluptatum dignissimos est voluptatem occaecati. Eum aliquid in molestias animi quia. Dignissimos omnis odio quae.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','429 Ariel Mountain Suite 109',137.00,0,0,0,3),(10,'2021-12-24 04:13:54','2021-12-24 04:13:54',NULL,'so/T-','socks',100.00,48.00,2398.00,'Similique sint.','Placeat illo amet consectetur magnam. Magni id qui rerum minus.','Quos odit autem fugiat. Repellat odio nulla suscipit laudantium. Vel voluptates qui et rem laudantium. Et iste rerum tenetur mollitia est qui ipsum. Exercitationem cupiditate incidunt cumque repellendus harum non. Inventore in ut nesciunt dolor facilis qui eius. Et dolor qui tempora. Fugit delectus distinctio veritatis quae. Dolor in et harum perferendis ut. Harum perferendis officia voluptatem dolor accusamus et. Maiores officia et numquam suscipit a harum sint aperiam.','https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg','[\"https://res.cloudinary.com/kekster/image/upload/v1640322188/undraw_placeholders_re_pvr4_y6orae.svg\"]','47281 Beier Brook Apt. 976',313.00,1,0,0,1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (6,3,NULL,NULL),(9,5,NULL,NULL),(5,7,NULL,NULL),(4,9,NULL,NULL),(7,9,NULL,NULL),(1,11,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','2021-12-24 04:13:53','2021-12-24 04:13:53'),(2,'general-manager','general Manager','2021-12-24 04:13:53','2021-12-24 04:13:53'),(3,'sales-manager','sales Manager','2021-12-24 04:13:53','2021-12-24 04:13:53'),(4,'option-manager','option Manager','2021-12-24 04:13:53','2021-12-24 04:13:53'),(5,'product-manager','product Manager','2021-12-24 04:13:53','2021-12-24 04:13:53'),(6,'user-manager','user Manager','2021-12-24 04:13:53','2021-12-24 04:13:53'),(7,'order-manager','order Manager','2021-12-24 04:13:53','2021-12-24 04:13:53'),(8,'sales-man','salesman','2021-12-24 04:13:53','2021-12-24 04:13:53'),(9,'employee','employee','2021-12-24 04:13:53','2021-12-24 04:13:53');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vrippin','lhuels@example.net','Sydnee','Ruecker','Dr.','female','Port Carlo','Maryland','31536','115.153.91.166','(866) 324-7853','11255','Azerbaijan','271 Rowe Rapids\nHoweton, MO 03086-0292','122 Christiansen Square\nBauchbury, NH 66408','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','MpXGB5m6ib','2021-12-24 04:13:53','2021-12-24 04:13:53'),(2,'rosario42','vallie.feil@example.net','Sydnie','Abshire','Ms.','female','Brooklynside','Wyoming','44333-9601','84.178.103.129','(844) 363-7575','31565-8922','Bhutan','13330 Hand Rue Apt. 503\nNew Waynebury, MS 43276','3900 Cartwright Turnpike\nTillmanland, OH 19466-8698','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Yke10Qmz6F','2021-12-24 04:13:53','2021-12-24 04:13:53'),(3,'kshlerin.rashad','tromp.marcelina@example.com','Kailyn','Larkin','Prof.','female','Ornberg','Mississippi','89312','11.234.221.3','(855) 664-1996','75827-6447','Kiribati','545 Goldner Springs\nEloisaland, MA 21036-8827','1571 Harvey Station\nCormierborough, ID 72200-6672','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','US5wN1h3nT','2021-12-24 04:13:53','2021-12-24 04:13:53'),(4,'hahn.lauretta','tpfannerstill@example.com','Stefanie','Treutel','Ms.','female','Owenmouth','Idaho','44315-9249','193.107.98.8','(888) 742-4787','59261-9277','Korea','7154 Hills Ports Suite 800\nEast Kiannachester, MO 54967','6715 Schmeler Lane\nJocelynberg, VT 91160','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','RoqkKQ5igB','2021-12-24 04:13:53','2021-12-24 04:13:53'),(5,'janelle68','abbott.chloe@example.org','Abagail','Klein','Ms.','female','Wizaside','Arkansas','43278','137.40.51.149','800-492-9865','30134','Saint Helena','1397 Nicolas Way\nCreminland, WI 09702-8320','66289 Schulist Meadows\nLaurianneland, AR 56548-5088','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','nGEInDMdN1','2021-12-24 04:13:53','2021-12-24 04:13:53'),(6,'mohammed55','michelle85@example.com','Moses','Ondricka','Dr.','male','West Dawsonbury','Louisiana','72423','184.210.6.41','1-844-992-5488','61907','Latvia','202 Marlin Vista\nTromptown, ME 64312','74570 Bahringer Pass\nWest Chadfurt, UT 75663','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','NP2uMz1GOz','2021-12-24 04:13:53','2021-12-24 04:13:53'),(7,'wilfredo97','ines41@example.net','Myrtle','Flatley','Miss','female','Hegmannhaven','Hawaii','55265','145.131.14.10','1-800-995-3902','27356-4648','French Guiana','2206 Aletha Oval Suite 660\nFriesenview, AL 05083-1167','8319 Amos Port Suite 450\nWeberberg, IL 58095','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','B9DnRgW7q5','2021-12-24 04:13:53','2021-12-24 04:13:53'),(8,'schumm.toni','sherman.kuphal@example.com','Johnnie','O\'Hara','Mr.','male','Lake Justineborough','New Jersey','70889-6854','74.156.173.102','855.278.3998','99490-3717','Germany','74835 Grimes Islands\nFernandoville, NJ 43992','354 Finn Road\nLake Hilton, MO 18817-4645','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','qLwh8RxFsH','2021-12-24 04:13:53','2021-12-24 04:13:53'),(9,'baumbach.kaitlyn','harley.lemke@example.net','Dandre','Hermiston','Mrs.','female','South Clementina','Arkansas','98996-5164','142.163.154.187','888.776.1700','52251','Dominica','217 Electa Light\nNorth Brenna, KS 29567-7868','917 Schaefer Burg\nEast Glen, MT 47652-5928','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','QafCZr0Blk','2021-12-24 04:13:53','2021-12-24 04:13:53'),(10,'baumbach.ole','olehner@example.com','Robin','Howell','Dr.','male','Port Julianne','Delaware','07917-3673','56.166.68.154','800-769-8259','62072','United States of America','2380 Erik Trail\nMargieville, NJ 96332-9064','71289 Okey Station Apt. 796\nMaxland, CT 73307-3138','noimage.jpg','2021-12-24 04:13:53','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Z37cHbBvGl','2021-12-24 04:13:53','2021-12-24 04:13:53'),(11,'1337','69@1337.com','admin','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$iulx5LsCsdfnIj81rQ8lk.C7dEo4CyMg5DMKhqCMBlYXTrO5G28aS',NULL,'2021-12-24 04:13:54','2021-12-24 04:13:54');
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

-- Dump completed on 2021-12-24  6:13:56
