/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_bed` */

DROP TABLE IF EXISTS `mst_bed`;

CREATE TABLE `mst_bed` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_number` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 : dipakai | 0 : tidak dipakai',
  `modi_id` int(11) NOT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `mst_bed` */

insert  into `mst_bed`(`bed_id`,`inventory_number`,`room_id`,`status`,`modi_id`,`modi_datetime`) values (1,'',21,0,0,'2014-09-18 12:32:54'),(2,'',22,0,0,'2014-09-18 12:32:55'),(3,'',23,0,0,'2014-09-09 05:33:06'),(4,'',23,0,0,'2014-09-09 05:33:06'),(5,'',24,0,0,'2014-09-09 05:33:08'),(6,'',24,0,0,'2014-09-09 05:33:12'),(7,'',25,0,0,'2014-09-09 05:33:12'),(8,'',25,0,0,'2014-09-09 05:33:14'),(9,'',26,0,0,'2014-09-09 05:33:16'),(10,'',26,0,0,'2014-09-09 05:33:22'),(11,'',26,0,0,'2014-09-09 05:59:56');

/*Table structure for table `mst_pavillion` */

DROP TABLE IF EXISTS `mst_pavillion`;

CREATE TABLE `mst_pavillion` (
  `pavillion_id` int(11) NOT NULL AUTO_INCREMENT,
  `pavillion_name` varchar(20) DEFAULT '0',
  `modi_id` int(11) DEFAULT '0',
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pavillion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mst_pavillion` */

insert  into `mst_pavillion`(`pavillion_id`,`pavillion_name`,`modi_id`,`modi_datetime`) values (1,'Lantai II',0,'2014-09-08 22:46:41');

/*Table structure for table `mst_room` */

DROP TABLE IF EXISTS `mst_room`;

CREATE TABLE `mst_room` (
  `room_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL DEFAULT '0',
  `pavillion_id` int(11) NOT NULL DEFAULT '0',
  `modi_id` int(11) DEFAULT '1',
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_room` */

insert  into `mst_room`(`room_id`,`class_id`,`pavillion_id`,`modi_id`,`modi_datetime`) values (21,2,1,1,'2014-09-09 05:49:54'),(22,2,1,1,'2014-09-08 22:46:21'),(23,3,1,1,'2014-09-08 22:46:22'),(24,3,1,1,'2014-09-08 22:46:24'),(25,3,1,1,'2014-09-08 22:46:26'),(26,3,1,1,'2014-09-08 22:46:28');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
