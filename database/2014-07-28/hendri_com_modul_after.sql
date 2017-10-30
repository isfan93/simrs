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

/*Table structure for table `com_modul` */

DROP TABLE IF EXISTS `com_modul`;

CREATE TABLE `com_modul` (
  `modul_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `modul_nama` varchar(200) NOT NULL,
  `modul_url` varchar(200) NOT NULL,
  `modul_icon` varchar(200) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`modul_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `com_modul` */

insert  into `com_modul`(`modul_id`,`modul_nama`,`modul_url`,`modul_icon`,`status`) values (1,'pelayanan informasi','pelayanan_informasi','',1),(2,'pendaftaran','pendaftaran','',1),(3,'rawat jalan','rawat_jalan','',1),(4,'kasir','kasir','',1),(5,'apotek','apotek','',1),(6,'gudang farmasi','gudang_farmasi','',0),(7,'manajemen data','master','',1),(8,'lab','lab',NULL,1),(9,'pelaporan','pelaporan',NULL,1),(11,'gudang farmasi','gudang',NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
