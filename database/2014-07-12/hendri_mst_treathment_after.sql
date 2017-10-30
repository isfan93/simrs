/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - simrs_rso
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`simrs_rso` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `simrs_rso`;

/*Table structure for table `mst_treathment` */

DROP TABLE IF EXISTS `mst_treathment`;

CREATE TABLE `mst_treathment` (
  `treat_id` int(11) NOT NULL AUTO_INCREMENT,
  `treat_name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `poli` int(2) DEFAULT NULL,
  `treat_item_price` bigint(20) DEFAULT NULL,
  `treat_paramedic_price` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`treat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `mst_treathment` */

insert  into `mst_treathment`(`treat_id`,`treat_name`,`description`,`poli`,`treat_item_price`,`treat_paramedic_price`) values (1,'Gibs',NULL,NULL,20000,1000),(2,'Platina',NULL,NULL,50000,2000),(3,'operasi','dilakukan dalam keadaan gawat darurat',1,100000,NULL),(4,'transplatasi tulang','opo kui',2,50000,NULL),(5,'sambung tulang','jika masih ada harapan',2,100000,NULL),(6,'coba modal','aldjal',1,89999,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
