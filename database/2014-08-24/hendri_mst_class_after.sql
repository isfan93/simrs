/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_class_after` */

DROP TABLE IF EXISTS `mst_class_after`;

CREATE TABLE `mst_class_after` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `price_master` int(11) DEFAULT NULL,
  `price_koef` double DEFAULT NULL,
  `modi_id` int(11) NOT NULL DEFAULT '1',
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `mst_class_after` */

insert  into `mst_class_after`(`class_id`,`class_name`,`price`,`price_master`,`price_koef`,`modi_id`,`modi_datetime`) values (1,'VVIP',1000000,2150000,2.15,1,'2014-08-22 23:11:57'),(2,'VIP',525000,1250000,2.380952381,1,'2014-08-22 23:11:57'),(3,'Kelas 1',125000,900000,7.2,1,'2014-08-22 23:11:57'),(4,'Kelas 2',100000,250000,2.5,1,'2014-08-22 23:11:57'),(5,'Kelas 3',80000,150000,1.875,1,'2014-08-22 23:11:57'),(6,'VIP  [Anak]',525000,1250000,2.380952381,1,'2014-08-22 23:11:57'),(7,'Kelas 1 [Anak]',125000,900000,7.2,1,'2014-08-22 23:11:57'),(8,'Kelas Superior [Anak]',305555.5556,550000,1.8,1,'2014-08-22 23:11:57'),(9,'Kelas 2 [Anak]',100000,250000,2.5,1,'2014-08-22 23:11:57'),(10,'Kelas 3 [Anak]',80000,150000,1.875,1,'2014-08-22 23:11:57'),(11,'Inkubator [Anak]',320000,600000,1.875,1,'2014-08-22 23:11:57'),(12,'VVIP  [Kebidanan]',1000000,2150000,2.15,1,'2014-08-22 23:11:57'),(13,'VIP  [Kebidanan]',525000,1250000,2.380952381,1,'2014-08-22 23:11:57'),(14,'Kelas 1 [Kebidanan]',125000,900000,7.2,1,'2014-08-22 23:11:57'),(15,'Kelas 2 [Kebidanan]',100000,250000,2.5,1,'2014-08-22 23:11:57'),(16,'Kelas 3 [Kebidanan]',80000,150000,1.875,1,'2014-08-22 23:11:57'),(17,'Kamar Bersalin Kelas VVIP [Kebidanan]',675000,1450000,2.148148148,1,'2014-08-22 23:11:57'),(18,'Kamar Bersalin Kelas VIP [Kebidanan]',675000,1450000,2.148148148,1,'2014-08-22 23:11:57'),(19,'Kamar Bersalin Kelas 1 [Kebidanan]',525000,1250000,2.380952381,1,'2014-08-22 23:11:57'),(20,'Kamar Bersalin Kelas 2 [Kebidanan]',225000,550000,2.444444444,1,'2014-08-22 23:11:57'),(21,'Kamar Bersalin Kelas 3 [Kebidanan]',225000,550000,2.444444444,1,'2014-08-22 23:11:57'),(23,'VVIP  [Bayi]',325000,750000,2.307692308,1,'2014-08-22 23:11:57'),(24,'VIP  [Bayi]',250000,600000,2.4,1,'2014-08-22 23:11:57'),(25,'Kelas 1 [Bayi]',62500,450000,7.2,1,'2014-08-22 23:11:57'),(26,'Kelas 2 [Bayi]',60000,150000,2.5,1,'2014-08-22 23:11:57'),(27,'Kelas 3 [Bayi]',40000,100000,2.5,1,'2014-08-22 23:11:57'),(28,'Inkubator [Bayi]',250000,600000,2.4,1,'2014-08-22 23:11:57'),(29,'Bayi lahir di luar RSIH (rujukan) [Bayi]',125000,350000,2.8,1,'2014-08-22 23:11:57'),(30,'Intensive Care Unit  A ',450000,1100000,2.444444444,1,'2014-08-22 23:11:57'),(31,'Intensive Care Unit  B / Anak',450000,1100000,2.444444444,1,'2014-08-22 23:11:57'),(32,'Intensive Care Burn Unit (ICU Luka Bakar)',450000,1100000,2.444444444,1,'2014-08-22 23:11:57'),(33,'Stroke Unit',450000,1100000,2.444444444,1,'2014-08-22 23:11:57'),(34,'Kamar  Ablasi',275000,650000,2.363636364,1,'2014-08-22 23:11:57'),(35,'Kamar One Day Care (Post Op)',275000,650000,2.363636364,1,'2014-08-22 23:11:57'),(36,'Kamar Jenazah < 6 jam *',125000,350000,2.8,1,'2014-08-22 23:11:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
