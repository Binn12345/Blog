/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 8.0.30 : Database - nativeconn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nativeconn` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `nativeconn`;

/*Table structure for table `tblpersonaldata` */

DROP TABLE IF EXISTS `tblpersonaldata`;

CREATE TABLE `tblpersonaldata` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uniqid` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblpersonaldata` */

insert  into `tblpersonaldata`(`id`,`uniqid`,`username`,`fname`,`mname`,`lname`,`fullname`,`gender`,`created_at`,`updated_at`) values 
(1,'test6','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,'post6','post',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,'qwe6','qwe',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,'try6','try','DSAD','SADSADSAD','SADSA','SADSA, DSAD SADSADSAD',NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `usertype` int DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `terms` int DEFAULT '0',
  `uniqid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`name`,`usertype`,`username`,`password`,`created_at`,`updated_at`,`terms`,`uniqid`) values 
(1,NULL,NULL,1,'test','$2y$10$gjeF48K.61azPg6o9MyWvuMiLt2D0cnddmaCQrqjKnKScMyxlW8GG',NULL,NULL,0,'test6'),
(2,NULL,NULL,1,'post','$2y$10$OER73Q1u29FXI52xvizCSeQzas.fgLnzZgf1SzbCUFTWG2CG6eydu',NULL,NULL,0,'post6'),
(3,NULL,NULL,1,'qwe','$2y$10$WPZelJ33BWMwGOOKt1fiIe/S1JXE0F7t6SY8njZQPiIM7Lc6Ge5oW',NULL,NULL,0,'qwe6'),
(4,NULL,NULL,3,'try','$2y$10$I6D.aKSsQ0H1XrewvCytiOHfqdK571WBjnqRrZ2O89xenDrR0uc0i',NULL,NULL,0,'try6'),
(5,'d@gmail.com','sfsdfs',NULL,'test','$2y$10$.HITTJKYdfxShUOLXaDKAuZdLRl1sylqnjHUye.PJu7GfoTdcyPOG',NULL,NULL,1,NULL),
(6,'d@gmail.com','sfsdfs',NULL,'test','$2y$10$Sd9Zqk0yz7Ln1zAyIqk9OeykiPhgpSsfyN8yc8p.30k8zTp1yg9AG',NULL,NULL,1,NULL),
(7,'sdsadas','dsadsa',NULL,'d@gmail.com','$2y$10$MpOU1wjrIm7I1NIzsu40Y.rBsOGbuNWA7yl6XXp5fqS8BWO//NYcm',NULL,NULL,1,NULL),
(10,'dsadsad@gmail.com','dsadsad',NULL,'sadsad','$2y$10$qjoq9QZj1vkvpemH.BUZyutAoZb3Iens1neYBKVR4rHeJszxphTHW',NULL,NULL,0,NULL),
(11,'dsadsadsasasa@gmail.com','dsadsad',NULL,'dsdsd','$2y$10$KVQ1s.Rgl6MlBzizzm44UOpwyAoQDQbXA9zcXyVrowp5uY5awJnNa',NULL,NULL,1,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
