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

/*Table structure for table `mst_employer` */

DROP TABLE IF EXISTS `mst_employer`;

CREATE TABLE `mst_employer` (
  `sd_nip` varchar(25) NOT NULL,
  `sd_type_user` int(2) DEFAULT NULL,
  `sd_name` varchar(100) NOT NULL,
  `sd_sex` varchar(255) DEFAULT NULL,
  `sd_place_of_birth` varchar(150) DEFAULT NULL,
  `sd_date_of_birth` varchar(32) DEFAULT NULL,
  `sd_age` varchar(32) DEFAULT NULL,
  `sd_blood_tp` varchar(255) DEFAULT NULL,
  `sd_address` text,
  `sd_rt_rw` varchar(10) DEFAULT NULL,
  `sd_reg_desa` varchar(50) DEFAULT NULL,
  `sd_reg_kec` varchar(50) DEFAULT NULL,
  `sd_reg_kab` varchar(100) DEFAULT NULL,
  `sd_reg_prov` varchar(100) DEFAULT NULL,
  `sd_citizen` varchar(100) DEFAULT NULL,
  `sd_marital_st` varchar(50) DEFAULT NULL,
  `sd_religion` varchar(25) DEFAULT NULL,
  `sd_education` varchar(100) DEFAULT NULL,
  `sd_occupation` varchar(100) DEFAULT NULL,
  `sd_telp` varchar(20) DEFAULT NULL,
  `sd_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sd_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sd_reg_street` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_employer` */

insert  into `mst_employer`(`sd_nip`,`sd_type_user`,`sd_name`,`sd_sex`,`sd_place_of_birth`,`sd_date_of_birth`,`sd_age`,`sd_blood_tp`,`sd_address`,`sd_rt_rw`,`sd_reg_desa`,`sd_reg_kec`,`sd_reg_kab`,`sd_reg_prov`,`sd_citizen`,`sd_marital_st`,`sd_religion`,`sd_education`,`sd_occupation`,`sd_telp`,`sd_reg_date`,`sd_status`,`modi_id`,`modi_datetime`,`sd_reg_street`) values ('54rtjt69iwstr',1,'hendri','L','','--',NULL,'-','','/','','','1','3',NULL,NULL,NULL,NULL,NULL,'','2014-07-06 06:02:10',1,NULL,'2014-07-06 06:02:10',''),('98q47t4h',2,'kurniawan','L','Sleman','1996-2-3',NULL,'B','Kenanga 09/17 Condongcatur Depok','09/17','Condongcatur','Depok','16','21','WNI','belum kawin','Islam',NULL,NULL,'027498789','2014-07-06 06:07:34',1,NULL,'2014-07-06 06:07:34','Kenanga'),('1949u98u',4,'ibo','L','','--',NULL,'-','','/','','','1','3',NULL,NULL,NULL,NULL,NULL,'','2014-07-06 06:51:13',1,NULL,'2014-07-06 06:51:13','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
