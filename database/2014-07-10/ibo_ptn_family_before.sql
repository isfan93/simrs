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

-- Dumping structure for table simrsih.ptn_family
DROP TABLE IF EXISTS `ptn_family`;
CREATE TABLE IF NOT EXISTS `ptn_family` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sd_rekmed` varchar(10) DEFAULT NULL,
  `fm_sex` varchar(255) DEFAULT NULL,
  `fm_relation` varchar(20) DEFAULT NULL,
  `fm_address` text,
  `fm_telp` varchar(20) DEFAULT NULL,
  `fm_phone` varchar(20) DEFAULT NULL,
  `fm_rekmed` varchar(20) DEFAULT NULL,
  `fm_status` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.ptn_family: ~0 rows (approximately)
/*!40000 ALTER TABLE `ptn_family` DISABLE KEYS */;
/*!40000 ALTER TABLE `ptn_family` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
