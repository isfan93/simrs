/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simrsih2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_simrsih2`;

/*Table structure for table `mst_lab_treathment_gol` */

DROP TABLE IF EXISTS `mst_lab_treathment_gol`;

CREATE TABLE `mst_lab_treathment_gol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `golongan_name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `mst_lab_treathment_gol` */

insert  into `mst_lab_treathment_gol`(`id`,`golongan_name`,`description`) values (1,'Hematologi',NULL),(2,'Kimia Klinik',NULL),(3,'Serologi',NULL),(4,'Urine',NULL),(5,'Feaces',NULL),(6,'Lain-lain',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
