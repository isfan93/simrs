/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_koefisien_fee` */

DROP TABLE IF EXISTS `mst_koefisien_fee`;

CREATE TABLE `mst_koefisien_fee` (
  `koef_id` int(11) DEFAULT NULL,
  `koef_treathment` varchar(255) DEFAULT NULL,
  `koef_value` double DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_koefisien_fee` */

insert  into `mst_koefisien_fee`(`koef_id`,`koef_treathment`,`koef_value`,`modi_id`,`modi_time`) values (1,'konsultasi dan visit',0.56,NULL,'2014-08-23 19:23:43'),(2,'poliklinik',0.45,NULL,'2014-08-23 19:23:43'),(3,'igd',0.45,NULL,'2014-08-23 19:23:43'),(4,'bedah umum dan digestif',0.45,NULL,'2014-08-23 19:23:43'),(5,'bedah anak',0.45,NULL,'2014-08-23 19:23:43'),(6,'bedah thorax',0.45,NULL,'2014-08-23 19:23:43'),(7,'bedah tumor (onkologi)',0.45,NULL,'2014-08-23 19:23:43'),(8,'bedah urologi',0.45,NULL,'2014-08-23 19:23:43'),(9,'sewa alat kamar operasi 1',1,NULL,'2014-08-23 19:23:43'),(10,'sewa alat kamar operasi 2',0.45,NULL,'2014-08-23 19:23:43'),(11,'sewa alat cssd',1,NULL,'2014-08-23 19:23:43'),(12,'operasi kebidanan dan kandungan',0.45,NULL,'2014-08-23 19:23:43'),(13,'operasi penyakit anak',0.45,NULL,'2014-08-23 19:23:43'),(14,'mcu',1,NULL,'2014-08-23 19:23:43'),(15,'bagian radiologi dan radioterapi',1,NULL,'2014-08-23 19:23:43'),(16,'pemulasaran jenazah',0.65,NULL,'2014-08-23 19:23:43'),(17,'tindakan dan sewa alat poli',0.4,NULL,'2014-08-23 19:33:03'),(18,'anestesi',0.45,NULL,'2014-08-23 19:55:31');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
