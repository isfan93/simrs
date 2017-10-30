-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.38-0ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table simrsih.mst_visit_status
DROP TABLE IF EXISTS `mst_visit_status`;
CREATE TABLE IF NOT EXISTS `mst_visit_status` (
  `vs_id` int(11) DEFAULT NULL,
  `vs_name` varchar(64) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_visit_status: ~6 rows (approximately)
/*!40000 ALTER TABLE `mst_visit_status` DISABLE KEYS */;
INSERT IGNORE INTO `mst_visit_status` (`vs_id`, `vs_name`, `modi_id`, `modi_datetime`) VALUES
	(1, 'Mendaftar', NULL, '2014-09-05 16:32:32'),
	(2, 'Dalam Pelayanan', NULL, '2014-09-05 16:37:50'),
	(3, 'Mengantri Bayar', NULL, '2014-09-05 19:15:33'),
	(4, 'Telah Membayar', NULL, '2014-09-05 16:33:28'),
	(5, 'Kunjungan Selesai', NULL, '2014-09-05 16:34:16'),
	(6, 'Menginap', NULL, '2014-09-05 16:34:54');
/*!40000 ALTER TABLE `mst_visit_status` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
