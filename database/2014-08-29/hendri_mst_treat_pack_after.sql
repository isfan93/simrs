/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_treat_pack` */

DROP TABLE IF EXISTS `mst_treat_pack`;

CREATE TABLE `mst_treat_pack` (
  `pt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_name` varchar(150) DEFAULT NULL,
  `pt_desc` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mst_treat_pack` */

insert  into `mst_treat_pack`(`pt_id`,`pt_name`,`pt_desc`,`price`) values (1,'Paket Hemat','Tindakan paket untuk kelas 3',1282500),(2,'Paket Hemat B','Tindakan paket untuk kelas 2',314100),(3,'Paket VIP','Buat orang yang banyak duit',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
