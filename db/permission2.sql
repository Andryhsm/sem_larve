-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dynamic_sem_laravel
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

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
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(191) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `route` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'Dashboard',NULL,'dashboard,profile'),(3,'Training + FAQ',NULL,NULL),(4,'Account',NULL,NULL),(6,'Statistics',NULL,NULL),(7,'Sales',NULL,NULL),(15,'Page Manager',3,'page.index,page.create,page.edit'),(16,'Email/SMS Template',39,'email-template.index,email-template.create,email-template.edit'),(19,'Customer',4,'customer.index,customer.create,customer.edit'),(20,'Merchant',4,'store.index,store.create,store.edit'),(21,'Admin system',4,'administrator,add_administrator,edit_administrator'),(22,'Role manager',4,'role.index,role.create,role.edit'),(26,'Sales',6,'product_billed'),(29,'Ongoing',45,'orders,orders_detail'),(30,'Completed',45,'orders,orders_detail'),(31,'Special Ask',45,'orders'),(32,'Status Manager',7,'order-status.index,order-status.create,order-status.edit'),(33,'Blog Management',NULL,NULL),(34,'Blog Category',33,'blog-category.index,blog-category.create,blog-category.edit'),(35,'Blog Post',33,'blog.index,blog.create,blog.edit'),(36,'FAQ Manager',3,'faq.index,faq.create,faq.edit'),(39,'System',NULL,''),(44,'Meta & OG',39,'setting_list,update_setting'),(45,'All orders',7,NULL),(48,'Comm. & Tickets',NULL,NULL),(49,'Ticket Priorities',48,'priorities.index,priorities.create,priorities.edit'),(51,'Ticket Statuses',48,'statuses.index,statuses.create,statuses.edit'),(52,'Tickets Lists',48,'tickets.index,tickets.create,tickets.edit,tickets.show'),(55,'Subscribe Information',4,'customer_informations'),(56,'Support + FAQ',NULL,''),(58,'Support',56,'tickets-subscribe,help-faq'),(59,'FAQ',56,'faq'),(60,'Keywords Trends',NULL,'keywords-trends'),(61,'Training',NULL,'training'),(63,'Profile',4,'profile'),(64,'Sub Accounts',4,'sub-accounts'),(65,'Ticket Categories',48,'categories.index,categories.create,categories.edit');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-16 14:33:46
