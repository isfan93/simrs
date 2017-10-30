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

/*Table structure for table `mst_type_user` */

DROP TABLE IF EXISTS `mst_type_user`;

CREATE TABLE `mst_type_user` (
  `id_type_user` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_type_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mst_type_user` */

insert  into `mst_type_user`(`id_type_user`,`description`) values (1,'dokter'),(2,'rekam medis'),(3,'kasir'),(4,'apoteker'),(5,'receptionist');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
