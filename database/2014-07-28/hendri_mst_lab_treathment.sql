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

/*Table structure for table `mst_lab_treathment` */

DROP TABLE IF EXISTS `mst_lab_treathment`;

CREATE TABLE `mst_lab_treathment` (
  `ds_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ds_name` varchar(100) NOT NULL,
  `ds_paramedic_price` double(11,2) DEFAULT NULL,
  `ds_price` double(11,2) NOT NULL,
  `ds_status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ds_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mst_lab_treathment` */

insert  into `mst_lab_treathment`(`ds_id`,`ds_name`,`ds_paramedic_price`,`ds_price`,`ds_status`) values (1,'Hemoglobin',2000.00,20000.00,'1'),(2,'Leukosit',2000.00,20000.00,'1'),(3,'Golongan darah (ABO Rh)',2000.00,200000.00,'1'),(4,'Paket 1: Darah Rutin,SGOT,SGPT',2000.00,200000.00,'1'),(5,'Paket 2: Asam urat,kolesterol total, HDL ,LDL,TGL',2000.00,300000.00,'1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
