/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `map_mst_lab` */

DROP TABLE IF EXISTS `map_mst_lab`;

CREATE TABLE `map_mst_lab` (
  `ds_id` smallint(6) NOT NULL,
  `dsd_name` varchar(145) NOT NULL,
  `dsd_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `map_mst_lab` */

insert  into `map_mst_lab`(`ds_id`,`dsd_name`,`dsd_id`) values (6,'Leukosit',2),(6,'Dif Count: -Eos',7),(6,'Trombosit',4),(6,'Dif Count: -NS',9),(6,'Hemoglobin',1),(6,'Dif Count: -Bas',6),(6,'Dif Count: -Mon',11),(6,'Hematokrit',3),(6,'Dif Count: -NB',8),(6,'LED',5),(6,'Dif Count: -Lym',10),(7,'Retikulosit',12),(7,'LED',5),(7,'Dif Count: -Lym',10),(7,'Leukosit',2),(7,'Waktu Pembekuan',14),(7,'Dif Count: -Eos',7),(7,'Trombosit',4),(7,'Erytrosit',16),(7,'Dif Count: -NS',9),(7,'Hemoglobin',1),(7,'Waktu Pendarahan',13),(7,'Dif Count: -Bas',6),(7,'Dif Count: -Mon',11),(7,'Hematokrit',3),(7,'Gol Darah',15),(7,'Dif Count: -NB',8),(8,'Hemoglobin',1),(9,'LED',5),(10,'Leukosit',2),(11,'Dif Count: -Bas',6),(11,'Dif Count: -Mon',11),(11,'Dif Count: -NB',8),(11,'Dif Count: -Lym',10),(11,'Dif Count: -Eos',7),(11,'Dif Count: -NS',9),(12,'Hematokrit',3),(13,'Erytrosit',16),(14,'Trombosit',4),(15,'Gol Darah',15),(16,'Waktu Pendarahan',13),(17,'Waktu Pembekuan',14),(18,'Protein',17),(19,'Globulin',19),(19,'Albumin',18),(20,'Bilirubin Total',20),(21,'Bilirubin Direk',21),(22,'Bilirubin Indirek',22),(23,'SGOT',23),(24,'SGPT',24),(25,'Ureum',25),(26,'Kreatinin',26),(27,'Asam urat',27),(28,'Glukosa Puasa',30),(29,'Glukosa 2 Jam PP',28),(30,'Glukosa Sewaktu',29);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
