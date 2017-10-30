/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_baru
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_supplier_before` */

DROP TABLE IF EXISTS `mst_supplier_before`;

CREATE TABLE `mst_supplier_before` (
  `msup_id` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_supplier_before` */

insert  into `mst_supplier_before`(`msup_id`,`msup_name`,`msup_address`,`msup_province`,`msup_city`,`msup_zip_code`,`msup_telp`,`msup_fax`,`msup_email`,`msup_npwp`,`modi_id`,`modi_datetime`) values ('','Intan Husada','Jalan Prof Dr Suherman','12','26',NULL,'-',NULL,'-',NULL,NULL,'2014-08-30 16:46:18'),('KF','Kimia Farma','Jalan Jendran Gatot Subroto',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-07-17 09:48:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
