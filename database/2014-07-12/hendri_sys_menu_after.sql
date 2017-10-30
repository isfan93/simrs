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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`menu_parent`,`menu_url`,`menu_name`,`menu_status`,`modul_id`,`modi_id`,`modi_datetime`) values (1,0,'pendaftaran/pendaftaran_baru','pendaftaran baru',1,1,NULL,'2014-06-21 22:52:38'),(2,0,'pendaftaran/pendaftaran_rawat_jalan','pendaftaran rawat jalan',1,1,NULL,'2014-06-21 22:52:38'),(3,0,'pendaftaran/pendaftaran_rawat_inap','pendaftaran rawat inap',1,1,NULL,'2014-06-21 22:52:39'),(4,0,'pendaftaran/IGD','IGD',1,1,NULL,'2014-06-21 22:52:39'),(5,0,'pelayanan_informasi/informasi_pasien','informasi pasien',1,2,NULL,'2014-06-21 22:52:39'),(6,0,'pelayanan_informasi/jadwal_dokter','jadwal dokter',1,2,NULL,'2014-06-21 22:52:39'),(7,0,'pelayanan_informasi/informasi_kamar','informasi kamar',0,2,NULL,'2014-07-02 22:42:48'),(8,0,'pelayanan_informasi/informasi_paket','informasi paket',0,2,NULL,'2014-07-02 22:25:32'),(9,0,'rawat_jalan/poli_gigi','poli gigi',1,3,NULL,'2014-06-21 22:52:39'),(10,0,'rawat_jalan/poli_tulang','poli tulang',1,3,NULL,'2014-06-21 22:52:39'),(11,0,'kasir/rawat_jalan','rawat jalan',1,4,NULL,'2014-06-21 22:52:39'),(12,0,'kasir/IGD','IGD',1,4,NULL,'2014-06-21 22:52:39'),(13,0,'kasir/rawat_inap','rawat inap',1,4,NULL,'2014-06-21 22:52:39'),(14,0,'apotek/resep_pasien','resep pasien',1,5,NULL,'2014-06-21 22:52:39'),(15,0,'apotek/pembelian_langsung','pembelian langsung',1,5,NULL,'2014-06-21 22:52:39'),(16,0,'gudang_farmasi/purchase_request','purchase request',1,6,NULL,'2014-06-21 22:52:39'),(17,0,'gudang_farmasi/purchase_order','purchase order',1,6,NULL,'2014-06-21 22:52:39'),(18,0,'gudang_farmasi/receive_item','receive item',1,6,NULL,'2014-06-21 22:52:39'),(19,0,'gudang_farmasi/retur','retur',1,6,NULL,'2014-06-21 22:52:39'),(20,0,'gudang_farmasi/stok','stok',1,6,NULL,'2014-06-21 22:52:39'),(21,0,'gudang_farmasi/transfer_item','transfer item',1,6,NULL,'2014-06-21 22:52:39'),(22,0,'pendaftaran/daftar_pasien','daftar pasien',1,1,NULL,'2014-06-21 22:52:39'),(24,0,'gudang_farmasi/pos_item','pos_item',1,6,NULL,'2014-06-21 22:52:39'),(25,0,'master/data_dokter','data dokter',0,7,NULL,'2014-07-05 14:37:58'),(26,0,'master/data_tindakan','data tindakan',1,7,NULL,'2014-07-03 00:52:30'),(27,0,'master/data_diagnosa','data diagnosa',1,7,NULL,'2014-07-03 00:52:47'),(28,0,'master/data_obat','data obat',1,7,NULL,'2014-07-03 00:53:11'),(29,0,'master/data_pegawai','data pegawai',1,7,NULL,'2014-07-03 00:54:33'),(30,0,'master/data_user','data user',1,7,NULL,'2014-07-11 02:34:44');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
