/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_adm_fee_after` */

DROP TABLE IF EXISTS `mst_adm_fee_after`;

CREATE TABLE `mst_adm_fee_after` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_name` varchar(255) NOT NULL,
  `adm_fee` double(15,2) NOT NULL,
  `adm_fee_master` int(11) DEFAULT NULL,
  `adm_koef` double DEFAULT NULL,
  `adm_min` int(11) DEFAULT NULL,
  `adm_max` int(11) DEFAULT NULL,
  `adm_status` char(1) NOT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `mst_adm_fee_after` */

insert  into `mst_adm_fee_after`(`adm_id`,`adm_name`,`adm_fee`,`adm_fee_master`,`adm_koef`,`adm_min`,`adm_max`,`adm_status`,`modi_id`,`modi_datetime`) values (1,'Pendaftaran Pasien Baru ',15000.00,50000,3.333333333,0,0,'1',NULL,'2014-08-22 22:58:10'),(2,'Kartu Berobat',10000.00,15000,1.5,0,0,'1',NULL,'2014-08-22 22:58:10'),(3,'Biaya Administrasi Rawat Jalan',5000.00,20000,4,0,0,'1',NULL,'2014-08-22 22:58:10'),(4,'Biaya Administrasi Rawat Inap adalah 2,5 % dari Total Biaya ',0.00,0,0.025,150000,1500000,'1',NULL,'2014-08-22 22:58:11'),(5,'Biaya Visum et Repertum',50000.00,100000,2,0,0,'1',NULL,'2014-08-22 22:58:11'),(6,'Biaya Pengurusan Asuransi Rawat Inap',25000.00,75000,3,0,0,'1',NULL,'2014-08-22 22:58:11'),(7,'Biaya Pengurusan Asuransi Rawat Jalan',15000.00,35000,2.333333333,0,0,'1',NULL,'2014-08-22 22:58:12'),(8,'Biaya Gelang Pasien Bayi/Dewasa',5000.00,5000,1,0,0,'1',NULL,'2014-08-22 22:58:14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
