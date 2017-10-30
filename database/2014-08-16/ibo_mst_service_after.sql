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

-- Dumping structure for table simrsih.mst_service
DROP TABLE IF EXISTS `mst_service`;
CREATE TABLE IF NOT EXISTS `mst_service` (
  `service_id` varchar(10) NOT NULL,
  `service_name` varchar(50) DEFAULT NULL,
  `modi_id` varchar(5) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_service: ~7 rows (approximately)
/*!40000 ALTER TABLE `mst_service` DISABLE KEYS */;
INSERT IGNORE INTO `mst_service` (`service_id`, `service_name`, `modi_id`, `modi_datetime`) VALUES
	('1', 'Biaya Perawatan', NULL, '2014-06-21 22:43:02'),
	('2', 'PPPK/Poli Bedah', '', '2014-06-21 22:43:02'),
	('3', 'Biaya Makan', NULL, '2014-06-21 22:43:02'),
	('4', 'Obat-obat infus dll', NULL, '2014-06-21 22:43:02'),
	('5', 'Obat dan Resep', NULL, '2014-06-21 22:43:02'),
	('6', 'Tindakan', NULL, '2014-06-21 22:43:02'),
	('7', 'Laboratorium', NULL, '2014-07-29 17:23:41'),
	('8', 'Sewa Kamar', NULL, '2014-08-16 13:11:25');
/*!40000 ALTER TABLE `mst_service` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
