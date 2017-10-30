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

/*Table structure for table `com_menu` */

DROP TABLE IF EXISTS `com_menu`;

CREATE TABLE `com_menu` (
  `menu_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `modul_id` smallint(6) NOT NULL,
  `menu_nama` varchar(200) NOT NULL,
  `menu_url` varchar(200) NOT NULL,
  `menu_icon` varchar(200) DEFAULT NULL,
  `menu_parent` varchar(200) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `com_menu` */

insert  into `com_menu`(`menu_id`,`modul_id`,`menu_nama`,`menu_url`,`menu_icon`,`menu_parent`,`status`) values (1,1,'pendaftaran baru','pendaftaran/pendaftaran_baru',NULL,'',1),(2,1,'pendaftaran rawat jalan','pendaftaran/pendaftaran_rawat_jalan',NULL,'',1),(3,1,'pendaftaran rawat inap','pendaftaran/pendaftaran_rawat_inap',NULL,'',1),(4,1,'IGD','pendaftaran/IGD',NULL,'',1),(5,2,'informasi pasien','pelayanan_informasi/informasi_pasien',NULL,'',1),(6,2,'jadwal dokter','pelayanan_informasi/jadwal_dokter',NULL,'',1),(7,2,'informasi kamar','pelayanan_informasi/informasi_kamar',NULL,'',1),(8,2,'informasi paket','pelayanan_informasi/informasi_paket',NULL,'',0),(9,3,'poli gigi','rawat_jalan/poli_gigi',NULL,'',1),(10,3,'poli tulang','rawat_jalan/poli_tulang',NULL,'',1),(11,4,'rawat jalan','kasir/rawat_jalan',NULL,'',1),(12,4,'IGD','kasir/IGD',NULL,'',1),(13,4,'rawat inap','kasir/rawat_inap',NULL,'',1),(14,5,'resep pasien','apotek/resep_pasien',NULL,'',1),(15,5,'pembelian lansung','apotek/pembelian_langsung',NULL,'',1),(16,6,'purchase request','gudang_farmasi/purchase_request',NULL,'',1),(17,6,'purchase order','gudang_farmasi/purchase_order',NULL,'',1),(18,6,'receive item','gudang_farmasi/receive_item',NULL,'',1),(19,6,'retur','gudang_farmasi/retur',NULL,'',1),(20,6,'stok','gudang_farmasi/stok',NULL,'',1),(21,6,'transfer item','gudang_farmasi/transfer_item',NULL,'',1),(22,7,'data dokter','master/data_dokter',NULL,'',1),(23,7,'data tindakan','master/data_tindakan',NULL,'',1),(24,7,'data diagnosa','master/data_diagnosa',NULL,NULL,1),(25,7,'data obat','master/data_obat',NULL,NULL,1),(27,7,'data pegawai','master/data_pegawai',NULL,NULL,1),(28,7,'data user','master/data_user',NULL,NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
