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
  `sd_nip` varchar(25) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `user_tipe` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `com_user` */

insert  into `com_user`(`user_id`,`username`,`password`,`sd_nip`,`avatar`,`user_tipe`,`email`,`last_login`,`status`) values (1,'jike','49deebdfb953a2f52e2ac0931cf29b72','98q47t4h',NULL,1,'jike@yahoo.com','2014-07-13 01:08:19',1),(2,'hendri','49deebdfb953a2f52e2ac0931cf29b72','54rtjt69iwstr',NULL,1,NULL,'2014-07-13 01:08:30',1),(3,'wawan','0a000f688d85de79e3761dec6816b2a5','1949u98u',NULL,24,'waone@gmail.com','2014-07-13 02:07:43',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
