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

DROP TABLE IF EXISTS `trx_hospitalization`;

-- Dumping structure for table db_simrs.hos_bed_occupation
DROP TABLE IF EXISTS `hos_bed_occupation`;
CREATE TABLE IF NOT EXISTS `hos_bed_occupation` (
  `visit_id` int(11) NOT NULL DEFAULT '0',
  `bed_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_simrs.hos_bed_occupation: ~1 rows (approximately)
/*!40000 ALTER TABLE `hos_bed_occupation` DISABLE KEYS */;
INSERT IGNORE INTO `hos_bed_occupation` (`visit_id`, `bed_id`) VALUES
	(14090001, 2);
/*!40000 ALTER TABLE `hos_bed_occupation` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
