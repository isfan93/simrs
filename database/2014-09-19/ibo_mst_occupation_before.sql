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

-- Dumping structure for table db_simrs.mst_occupation
DROP TABLE IF EXISTS `mst_occupation`;
CREATE TABLE IF NOT EXISTS `mst_occupation` (
  `oc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mo_name` varchar(45) DEFAULT NULL,
  `mo_desc` varchar(45) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`oc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table db_simrs.mst_occupation: ~11 rows (approximately)
/*!40000 ALTER TABLE `mst_occupation` DISABLE KEYS */;
INSERT IGNORE INTO `mst_occupation` (`oc_id`, `mo_name`, `mo_desc`, `modi_id`, `modi_datetime`) VALUES
	(1, '-', NULL, NULL, '2014-06-22 09:47:46'),
	(2, 'TNI', NULL, NULL, '2014-06-22 09:47:46'),
	(3, 'PNS', NULL, NULL, '2014-06-22 09:47:46'),
	(4, 'POLRI', NULL, NULL, '2014-06-22 09:47:46'),
	(5, 'BUMN', NULL, NULL, '2014-06-22 09:47:46'),
	(6, 'SWASTA', NULL, NULL, '2014-06-22 09:47:46'),
	(7, 'Mahasiswa', NULL, NULL, '2014-06-22 09:47:46'),
	(8, 'Pelajar', NULL, NULL, '2014-06-22 09:47:46'),
	(9, 'Tani', NULL, NULL, '2014-06-22 09:47:46'),
	(10, 'Dagang', NULL, NULL, '2014-06-22 09:47:46'),
	(11, 'Lainnya', NULL, NULL, '2014-06-22 09:47:46');
/*!40000 ALTER TABLE `mst_occupation` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
