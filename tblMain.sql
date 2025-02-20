/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 8.0.30 : Database - nativeconn1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nativeconn1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `nativeconn1`;

/*Table structure for table `tblmain` */

DROP TABLE IF EXISTS `tblmain`;

CREATE TABLE `tblmain` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `Module` tinyint NOT NULL DEFAULT '0',
  `MainID` smallint NOT NULL DEFAULT '0',
  `Description` varchar(40) DEFAULT NULL,
  `Image` varchar(50) DEFAULT NULL,
  `Link` varchar(150) DEFAULT NULL,
  `Visible` smallint DEFAULT NULL,
  `RowColor` varchar(50) DEFAULT NULL,
  `ImgWidth` int DEFAULT '0',
  `ImgHeight` int DEFAULT '0',
  `IsNotAIMS` tinyint(1) DEFAULT '0',
  `SortID` int DEFAULT NULL,
  `SortAcct` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tblmain` */

insert  into `tblmain`(`id`,`Module`,`MainID`,`Description`,`Image`,`Link`,`Visible`,`RowColor`,`ImgWidth`,`ImgHeight`,`IsNotAIMS`,`SortID`,`SortAcct`) values (1,1,1,'User Accounts',NULL,'accounts.php',1,NULL,0,0,0,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
