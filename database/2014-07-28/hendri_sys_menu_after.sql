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

/*Table structure for table `sys_menu` */

DROP TABLE IF EXISTS `sys_menu`;

CREATE TABLE `sys_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent` int(11) DEFAULT '0',
  `menu_url` varchar(255) DEFAULT NULL,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_status` int(11) DEFAULT '1',
  `modul_id` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`menu_parent`,`menu_url`,`menu_name`,`menu_status`,`modul_id`,`modi_id`,`modi_datetime`) values (2,0,'pendaftaran/pendaftaran_rawat_jalan','pendaftaran rawat jalan',1,1,NULL,'2014-06-21 22:52:38'),(5,0,'pelayanan_informasi/informasi_pasien','informasi pasien',1,2,NULL,'2014-06-21 22:52:39'),(6,0,'pelayanan_informasi/jadwal_dokter','jadwal dokter',1,2,NULL,'2014-06-21 22:52:39'),(9,0,'rawat_jalan/poli_umum','poli umum',1,3,NULL,'2014-07-17 22:37:27'),(10,0,'rawat_jalan/poli_anak','poli anak',1,3,NULL,'2014-07-17 22:37:41'),(11,0,'kasir/rawat_jalan','rawat jalan',1,4,NULL,'2014-06-21 22:52:39'),(12,0,'kasir/IGD','IGD',0,4,NULL,'2014-06-29 14:05:46'),(13,0,'kasir/rawat_inap','rawat inap',0,4,NULL,'2014-06-29 14:05:50'),(14,0,'apotek/resep_pasien','resep pasien',1,5,NULL,'2014-06-21 22:52:39'),(15,0,'apotek/resep_pasien','pembelian langsung',1,5,NULL,'2014-07-17 23:08:43'),(16,0,'gudang_farmasi/purchase_request','purchase request',0,6,NULL,'2014-06-29 13:59:37'),(17,0,'gudang_farmasi/purchase_order','purchase order',0,6,NULL,'2014-06-29 13:59:31'),(18,0,'gudang_farmasi/receive_item','receive item',0,6,NULL,'2014-06-29 13:59:29'),(19,0,'gudang_farmasi/retur','retur',0,6,NULL,'2014-06-29 13:59:28'),(20,0,'gudang_farmasi/stok','stok',0,6,NULL,'2014-06-29 13:59:26'),(21,0,'gudang_farmasi/transfer_item','transfer item',0,6,NULL,'2014-06-29 13:59:25'),(22,0,'pendaftaran/daftar_pasien','daftar pasien',0,1,NULL,'2014-07-07 17:01:59'),(24,0,'gudang_farmasi/pos_item','pos_item',0,6,NULL,'2014-06-29 13:59:22'),(25,0,'lab/rawat_jalan','rawat jalan',1,8,NULL,'2014-07-10 22:45:07'),(26,0,'kasir/lab','Lab',1,4,NULL,'2014-07-10 15:57:15'),(27,0,'pelaporan/rawat_jalan','laporan kunjungan',1,9,NULL,'2014-07-14 21:56:57'),(28,27,'pelaporan/rawat_jalan','kunjungan rawat jalan',1,9,NULL,'2014-07-14 21:57:59'),(29,27,'pelaporan/rawat_jalan','kunjungan rawat inap',1,9,NULL,'2014-07-17 23:05:26'),(30,0,'master/data_dokter','data dokter',0,7,NULL,'2014-07-05 14:37:58'),(31,0,'master/data_tindakan','data tindakan',1,7,NULL,'2014-07-28 21:15:24'),(32,0,'master/data_diagnosa','data diagnosa',1,7,NULL,'2014-07-28 21:15:25'),(33,0,'master/data_obat','data obat',1,7,NULL,'2014-07-28 21:15:25'),(34,0,'master/data_pegawai','data pegawai',1,7,NULL,'2014-07-28 21:15:25'),(35,0,'master/data_user','data user',1,7,NULL,'2014-07-28 21:15:26'),(36,27,'pelaporan/lab','kunjungan lab',1,9,NULL,'2014-07-14 21:58:35'),(38,0,'gudang/purchase_order','purchase order',1,11,NULL,'2014-07-17 09:33:46'),(39,0,'gudang/receive_item','receive item',1,11,NULL,'2014-07-17 09:33:54'),(40,0,'gudang/retur','retur',1,11,NULL,'2014-07-17 09:34:08'),(41,0,'gudang/stok','stok',1,11,NULL,'2014-07-17 09:34:28'),(42,0,'rawat_jalan/poli_gigi','poli gigi',1,3,NULL,'2014-07-17 22:39:51'),(43,0,'master/data_poli','data poli',1,7,NULL,'2014-07-28 21:15:29'),(44,0,'master/jadwal_dokter','Penjadwalan Dokter',1,7,NULL,'2014-07-28 21:15:28'),(45,0,'master/data_tindakan_lab','Tindakan Lab',1,7,NULL,'2014-07-28 21:29:01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
