/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_baru
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_supplier` */

DROP TABLE IF EXISTS `mst_supplier`;

CREATE TABLE `mst_supplier` (
  `msup_id` int(11) NOT NULL AUTO_INCREMENT,
  `msup_name` varchar(50) DEFAULT NULL,
  `msup_address` text,
  `msup_province` varchar(50) DEFAULT NULL,
  `msup_city` varchar(50) DEFAULT NULL,
  `msup_zip_code` varchar(12) DEFAULT NULL,
  `msup_telp` varchar(14) DEFAULT NULL,
  `msup_fax` varchar(12) DEFAULT NULL,
  `msup_email` varchar(30) DEFAULT NULL,
  `msup_npwp` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mst_supplier` */

insert  into `mst_supplier`(`msup_id`,`msup_name`,`msup_address`,`msup_province`,`msup_city`,`msup_zip_code`,`msup_telp`,`msup_fax`,`msup_email`,`msup_npwp`,`modi_id`,`modi_datetime`) values (1,'Kimia Farma','Jalan Jendran Gatot Subroto','4','4',NULL,NULL,NULL,NULL,NULL,NULL,'2014-07-17 09:48:03'),(2,'Indofarma','Ga jelas','4','24',NULL,'9878798798',NULL,'oke@mail.com',NULL,NULL,'2014-08-19 21:23:42'),(3,'Boga','Cihidueng','12','26',NULL,'74987874',NULL,'boga@mail.com',NULL,NULL,'2014-08-27 05:43:41'),(4,'Farmako','Jl. Magelang','16','71',NULL,'0274-',NULL,'farmako@mail.com',NULL,NULL,'2014-08-30 11:16:25'),(5,'indofarma','Jl. Sudirman','12','26',NULL,'89898989',NULL,'indofarma@mail.com',NULL,NULL,'2014-09-01 20:57:59');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
