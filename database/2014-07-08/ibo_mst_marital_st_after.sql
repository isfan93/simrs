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

-- Dumping structure for table simrsih.mst_marital_st
DROP TABLE IF EXISTS `mst_marital_st`;
CREATE TABLE IF NOT EXISTS `mst_marital_st` (
  `mms_id` int(11) NOT NULL AUTO_INCREMENT,
  `mms_name` varchar(20) NOT NULL DEFAULT '0',
  `modi_id` int(11) DEFAULT '0',
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_marital_st: ~4 rows (approximately)
/*!40000 ALTER TABLE `mst_marital_st` DISABLE KEYS */;
INSERT IGNORE INTO `mst_marital_st` (`mms_id`, `mms_name`, `modi_id`, `modi_datetime`) VALUES
	(1, 'Belum Kawin', 0, '2014-07-08 12:37:43'),
	(2, 'Kawin', 0, '2014-07-08 12:38:39'),
	(3, 'Duda / Janda', 0, '2014-07-08 12:38:45'),
	(4, 'Tidak Kawin', 0, '2014-07-08 12:38:56');
/*!40000 ALTER TABLE `mst_marital_st` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
