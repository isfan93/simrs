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

-- Dumping structure for table db_simrs.mst_education
DROP TABLE IF EXISTS `mst_education`;
CREATE TABLE IF NOT EXISTS `mst_education` (
  `med_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_name` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table db_simrs.mst_education: ~9 rows (approximately)
/*!40000 ALTER TABLE `mst_education` DISABLE KEYS */;
INSERT IGNORE INTO `mst_education` (`med_id`, `med_name`, `modi_id`, `modi_datetime`) VALUES
	(29, '-', NULL, '2014-06-22 09:45:00'),
	(30, 'TK', NULL, '2014-06-22 09:45:00'),
	(31, 'SD', NULL, '2014-06-22 09:45:00'),
	(32, 'SMP', NULL, '2014-06-22 09:45:00'),
	(33, 'SMA', NULL, '2014-06-22 09:45:00'),
	(34, 'D2', NULL, '2014-06-22 09:45:00'),
	(35, 'D3', NULL, '2014-06-22 09:45:00'),
	(36, 'S1', NULL, '2014-06-22 09:45:00'),
	(37, 'S2', NULL, '2014-06-22 09:45:00');
/*!40000 ALTER TABLE `mst_education` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
