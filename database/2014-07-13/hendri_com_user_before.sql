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

/*Table structure for table `com_user` */

DROP TABLE IF EXISTS `com_user`;

CREATE TABLE `com_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `user_tipe` int(11) NOT NULL,
  `jenis_kelamin` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `com_user` */

insert  into `com_user`(`user_id`,`username`,`password`,`nama`,`avatar`,`user_tipe`,`jenis_kelamin`,`email`,`last_login`,`status`) values (1,'jike','49deebdfb953a2f52e2ac0931cf29b72','jike',NULL,1,'Laki - Laki','jike@yahoo.com','2014-06-21 22:28:24',1),(2,'hendri','49deebdfb953a2f52e2ac0931cf29b72','',NULL,1,NULL,NULL,'2014-07-13 01:04:19',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
