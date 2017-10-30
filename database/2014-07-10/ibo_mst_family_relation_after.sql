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

-- Dumping structure for table simrsih.mst_family_relation
DROP TABLE IF EXISTS `mst_family_relation`;
CREATE TABLE IF NOT EXISTS `mst_family_relation` (
  `mfr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mfr_name` varchar(20) DEFAULT NULL,
  `modi_id` int(11) NOT NULL DEFAULT '0',
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mfr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_family_relation: ~5 rows (approximately)
/*!40000 ALTER TABLE `mst_family_relation` DISABLE KEYS */;
INSERT IGNORE INTO `mst_family_relation` (`mfr_id`, `mfr_name`, `modi_id`, `modi_datetime`) VALUES
	(1, 'Orang Tua', 0, '2014-07-10 11:47:24'),
	(2, 'Suami / Istri', 0, '2014-07-10 11:47:38'),
	(3, 'Saudara', 0, '2014-07-10 11:47:52'),
	(4, 'Teman', 0, '2014-07-10 11:47:56'),
	(5, 'Pengantar', 0, '2014-07-10 11:48:03');
/*!40000 ALTER TABLE `mst_family_relation` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
