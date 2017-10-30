-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.37-0ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table simrsih.sys_menu
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE IF NOT EXISTS `sys_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent` int(11) DEFAULT '0',
  `menu_url` varchar(255) DEFAULT NULL,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_status` int(11) DEFAULT '1',
  `modul_id` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.sys_menu: ~23 rows (approximately)
/*!40000 ALTER TABLE `sys_menu` DISABLE KEYS */;
INSERT IGNORE INTO `sys_menu` (`menu_id`, `menu_parent`, `menu_url`, `menu_name`, `menu_status`, `modul_id`, `modi_id`, `modi_datetime`) VALUES
	(1, 0, 'pendaftaran/pendaftaran_baru', 'pendaftaran_baru', 0, 1, NULL, '2014-07-08 20:07:39'),
	(2, 0, 'pendaftaran/pendaftaran_rawat_jalan', 'pendaftaran rawat jalan', 1, 1, NULL, '2014-07-08 20:07:43'),
	(3, 0, 'pendaftaran/pendaftaran_rawat_inap', 'pendaftaran rawat inap', 1, 1, NULL, '2014-06-21 22:52:39'),
	(4, 0, 'pendaftaran/IGD', 'IGD', 0, 1, NULL, '2014-07-08 13:25:01'),
	(5, 0, 'pelayanan_informasi/informasi_pasien', 'informasi pasien', 1, 2, NULL, '2014-06-21 22:52:39'),
	(6, 0, 'pelayanan_informasi/jadwal_dokter', 'jadwal dokter', 1, 2, NULL, '2014-06-21 22:52:39'),
	(7, 0, 'pelayanan_informasi/informasi_kamar', 'informasi kamar', 1, 2, NULL, '2014-06-21 22:52:39'),
	(8, 0, 'pelayanan_informasi/informasi_paket', 'informasi paket', 1, 2, NULL, '2014-06-21 22:52:39'),
	(9, 0, 'rawat_jalan/poli_gigi', 'poli gigi', 1, 3, NULL, '2014-06-21 22:52:39'),
	(10, 0, 'rawat_jalan/poli_tulang', 'poli tulang', 1, 3, NULL, '2014-06-21 22:52:39'),
	(11, 0, 'kasir/rawat_jalan', 'rawat jalan', 1, 4, NULL, '2014-06-21 22:52:39'),
	(12, 0, 'kasir/IGD', 'IGD', 1, 4, NULL, '2014-06-21 22:52:39'),
	(13, 0, 'kasir/rawat_inap', 'rawat inap', 1, 4, NULL, '2014-06-21 22:52:39'),
	(14, 0, 'apotek/resep_pasien', 'resep pasien', 1, 5, NULL, '2014-06-21 22:52:39'),
	(15, 0, 'apotek/pembelian_langsung', 'pembelian langsung', 1, 5, NULL, '2014-06-21 22:52:39'),
	(16, 0, 'gudang_farmasi/purchase_request', 'purchase request', 1, 6, NULL, '2014-06-21 22:52:39'),
	(17, 0, 'gudang_farmasi/purchase_order', 'purchase order', 1, 6, NULL, '2014-06-21 22:52:39'),
	(18, 0, 'gudang_farmasi/receive_item', 'receive item', 1, 6, NULL, '2014-06-21 22:52:39'),
	(19, 0, 'gudang_farmasi/retur', 'retur', 1, 6, NULL, '2014-06-21 22:52:39'),
	(20, 0, 'gudang_farmasi/stok', 'stok', 1, 6, NULL, '2014-06-21 22:52:39'),
	(21, 0, 'gudang_farmasi/transfer_item', 'transfer item', 1, 6, NULL, '2014-06-21 22:52:39'),
	(22, 0, 'pendaftaran/daftar_pasien', 'daftar pasien', 0, 1, NULL, '2014-07-08 13:25:05'),
	(24, 0, 'gudang_farmasi/pos_item', 'pos_item', 1, 6, NULL, '2014-06-21 22:52:39');
/*!40000 ALTER TABLE `sys_menu` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
