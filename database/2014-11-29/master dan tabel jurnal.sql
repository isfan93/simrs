/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_15nov
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `mst_expense` */

DROP TABLE IF EXISTS `mst_expense`;

CREATE TABLE `mst_expense` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `mst_expense` */

insert  into `mst_expense`(`expense_id`,`category`,`status`,`modi_id`,`datetime`) values (1,'Biaya untuk gizi',1,NULL,'2014-11-27 21:40:32'),(2,'Biaya apotek',1,NULL,'2014-11-27 21:40:45'),(3,'Biaya laboratorium',1,NULL,'2014-11-27 21:40:57'),(4,'Biaya operasional kendaraan dan genset',1,NULL,'2014-11-27 21:41:18'),(5,'Biaya foto copy dan alat tulis kantor',1,NULL,'2014-11-27 21:41:39'),(6,'Biaya gaji karyawan dan SDM',1,NULL,'2014-11-27 21:41:56'),(7,'Biaya operasional RSIH',1,NULL,'2014-11-27 21:42:12'),(8,'Biaya lain-lain',1,NULL,'2014-11-27 21:42:26'),(9,'Kas masuk',1,NULL,'2014-11-27 23:41:58');

/*Table structure for table `trx_jurnal` */

DROP TABLE IF EXISTS `trx_jurnal`;

CREATE TABLE `trx_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `tipe_layanaan` int(11) DEFAULT NULL,
  `debet` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `trx_jurnal` */

insert  into `trx_jurnal`(`id`,`expense_id`,`keterangan`,`tanggal_transaksi`,`tipe_layanaan`,`debet`,`kredit`,`modi_id`,`modi_datetime`) values (1,9,'saldo oktober','1970-01-01',NULL,1000000,NULL,NULL,'2014-11-27 23:42:54'),(2,2,'beli tisu','1970-01-01',NULL,NULL,500,NULL,'2014-11-27 23:51:01'),(3,5,'beli pulpen','1970-01-01',NULL,NULL,1000,NULL,'2014-11-28 00:02:12'),(4,4,'beli solar','2014-11-27',NULL,NULL,18000,NULL,'2014-11-28 00:03:53'),(5,5,'beli buku','2014-11-28',NULL,NULL,2000,NULL,'2014-11-29 07:27:44');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
