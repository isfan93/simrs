/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_lab_treathment_detail` */

DROP TABLE IF EXISTS `mst_lab_treathment_detail`;

CREATE TABLE `mst_lab_treathment_detail` (
  `dsd_id` int(11) NOT NULL AUTO_INCREMENT,
  `dsd_name` varchar(145) NOT NULL,
  `dsd_standart_value_male` varchar(20) NOT NULL,
  `dsd_standart_value_female` varchar(20) NOT NULL,
  `dsd_satuan` varchar(10) DEFAULT NULL,
  `dsd_gol` char(2) DEFAULT NULL,
  `dsd_status` char(1) DEFAULT '1',
  PRIMARY KEY (`dsd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `mst_lab_treathment_detail` */

insert  into `mst_lab_treathment_detail`(`dsd_id`,`dsd_name`,`dsd_standart_value_male`,`dsd_standart_value_female`,`dsd_satuan`,`dsd_gol`,`dsd_status`) values (1,'Hemoglobin','L:13-17','P:12-16','g/dl','1','1'),(2,'Leukosit','4.000 - 10.000','4.000 - 10.000','/mm3','1','1'),(3,'Hematokrit','L: 40-48','P:37 - 43','%','1','1'),(4,'Trombosit','150 - 450','150 - 450','ribu/mm3','1','1'),(5,'LED','L: <10','P:<20','mm/jam','1','1'),(6,'Dif Count: -Bas','0 - 1','0 - 1','%','1','1'),(7,'Dif Count: -Eos','1 - 4','1 - 4','%','1','1'),(8,'Dif Count: -NB','2 - 6','2 - 6','%','1','1'),(9,'Dif Count: -NS','50 - 70','50 - 70','%','1','1'),(10,'Dif Count: -Lym','20 - 40','20 - 40','%','1','1'),(11,'Dif Count: -Mon','2 - 10','2 - 10','%','1','1'),(12,'Retikulosit','0,5 - 2,0','0,5 - 2,0','%','1','1'),(13,'Waktu Pendarahan','1 - 6','1 - 6','menit','1','1'),(14,'Waktu Pembekuan','5 - 13','5 - 13','menit','1','1'),(15,'Gol Darah','','','','1','1'),(16,'Erytrosit','L:1,5-6,0','P:4,0 - 5,5','juta/mm3','1','1'),(17,'Protein','L:6,6 - 8,7','P:6,6 - 8,7','g/dl','2','1'),(18,'Albumin','L:4,0 - 5,7','P:4,0 - 5,7','g/dl','2','1'),(19,'Globulin','L:1,5 - 3,0','P:1,5 - 3,0','g/dl','2','1'),(20,'Bilirubin Total','L:< 1,00','P:< 1,00','mg/dl','2','1'),(21,'Bilirubin Direk','L:< 0,75','P:< 0,75','mg/dl','2','1'),(22,'Bilirubin Indirek','','',NULL,NULL,'1'),(23,'SGOT','L: <37','P:< 31','u/l','2','1'),(24,'SGPT','L:<41','P: <37','u/l','2','1'),(25,'Ureum','L:10 - 50','P:10 - 50','md/dl','2','1'),(26,'Kreatinin','L:0,3','P:0,5 - 0,9','mg/dl','2','1'),(27,'Asam urat','L:3,4','P:2,4 - 5,7','mg/dl','2','1'),(28,'Glukosa 2 Jam PP','L:<160','P<160','mg/dl','2','1'),(29,'Glukosa Sewaktu','L:70 - 150','P:70 - 150','mg/dl','2','1'),(30,'Glukosa Puasa','L:70 - 110','P:70 - 110','mg/dl','2','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
