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

-- Dumping structure for table simrsih.mst_province
DROP TABLE IF EXISTS `mst_province`;
CREATE TABLE IF NOT EXISTS `mst_province` (
  `mpr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mpr_name` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mpr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_province: ~33 rows (approximately)
/*!40000 ALTER TABLE `mst_province` DISABLE KEYS */;
INSERT IGNORE INTO `mst_province` (`mpr_id`, `mpr_name`, `modi_id`, `modi_datetime`) VALUES
	(1, 'Aceh', NULL, '2014-07-08 13:12:47'),
	(2, 'Sumatera Utara', NULL, '2014-07-08 13:12:51'),
	(3, 'Bengkulu', NULL, '2014-07-08 13:13:15'),
	(4, 'Jambi', NULL, '2014-07-08 13:13:17'),
	(5, 'Riau', NULL, '2014-07-08 13:13:19'),
	(6, 'Sumatera Barat', NULL, '2014-07-08 13:13:21'),
	(7, 'Sumatera Selatan', NULL, '2014-07-08 13:13:22'),
	(8, 'Lampung', NULL, '2014-07-08 13:13:25'),
	(9, 'Kepulauan Bangka Belitung', NULL, '2014-07-08 13:13:27'),
	(10, 'Kepulauan Riau', NULL, '2014-07-08 13:13:29'),
	(11, 'Banten', NULL, '2014-07-08 13:13:32'),
	(12, 'Jawa Barat', NULL, '2014-07-08 13:13:33'),
	(13, 'DKI Jakarta', NULL, '2014-07-08 13:13:36'),
	(14, 'Jawa Tengah', NULL, '2014-07-08 13:13:38'),
	(15, 'Jawa Timur', NULL, '2014-07-08 13:13:39'),
	(16, 'Daerah Istimewa Yogyakarta', NULL, '2014-07-08 13:14:03'),
	(17, 'Bali', NULL, '2014-07-08 13:14:26'),
	(18, 'Nusa Tenggara Barat', NULL, '2014-07-08 13:14:29'),
	(19, 'Nusa Tenggara Timur', NULL, '2014-07-08 13:14:31'),
	(20, 'Kalimantan Barat', NULL, '2014-07-08 13:14:33'),
	(21, 'Kalimantan Selatan', NULL, '2014-07-08 13:14:35'),
	(22, 'Kalimantan Tengah', NULL, '2014-07-08 13:14:37'),
	(23, 'Kalimantan Timur', NULL, '2014-07-08 13:14:39'),
	(24, 'Gorontalo', NULL, '2014-07-08 13:14:48'),
	(25, 'Sulawesi Selatan', NULL, '2014-07-08 13:14:50'),
	(26, 'Sulawesi Tenggara', NULL, '2014-07-08 13:14:52'),
	(27, 'Sulawesi Tengah', NULL, '2014-07-08 13:14:54'),
	(28, 'Sulawesi Utara', NULL, '2014-07-08 13:14:57'),
	(29, 'Sulawesi Barat', NULL, '2014-07-08 13:14:59'),
	(30, 'Maluku', NULL, '2014-07-08 13:15:01'),
	(31, 'Maluku Utara', NULL, '2014-07-08 13:15:03'),
	(32, 'Papua', NULL, '2014-07-08 13:15:05'),
	(33, 'Papua Barat', NULL, '2014-07-08 13:15:07');
/*!40000 ALTER TABLE `mst_province` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
