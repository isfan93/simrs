-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.40-0ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_simrs.hos_examination
CREATE TABLE IF NOT EXISTS `hos_examination` (
  `visit_id` varchar(20) NOT NULL,
  `examination_id` varchar(20) NOT NULL,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `physician_id` int(11) DEFAULT NULL,
  `nurse_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`examination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_simrs.hos_examination: ~6 rows (approximately)
/*!40000 ALTER TABLE `hos_examination` DISABLE KEYS */;
INSERT IGNORE INTO `hos_examination` (`visit_id`, `examination_id`, `datetime`, `physician_id`, `nurse_id`) VALUES
	('14100001', '14100001001', '2014-10-04 23:00:07', 7, 64),
	('14100001', '14100001002', '2014-10-04 23:36:31', 0, 0),
	('14100001', '14100001003', '2014-10-08 10:26:30', 0, 0),
	('14100001', '14100001004', '2014-10-08 10:27:25', 0, 0),
	('14100001', '14100001005', '2014-10-08 10:56:54', 0, 0),
	('14100001', '14100001006', '2014-10-08 11:01:45', 0, 0);
/*!40000 ALTER TABLE `hos_examination` ENABLE KEYS */;


-- Dumping structure for table db_simrs.hos_prescription
CREATE TABLE IF NOT EXISTS `hos_prescription` (
  `prescription_id` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`prescription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_simrs.hos_prescription: ~5 rows (approximately)
/*!40000 ALTER TABLE `hos_prescription` DISABLE KEYS */;
INSERT IGNORE INTO `hos_prescription` (`prescription_id`, `status`) VALUES
	('RS-14100001', 1),
	('RS-14100002', 0),
	('RS-14100003', 1),
	('RS-14100004', 1),
	('RS-14100005', 0);
/*!40000 ALTER TABLE `hos_prescription` ENABLE KEYS */;


-- Dumping structure for table db_simrs.hos_returned_medicine
CREATE TABLE IF NOT EXISTS `hos_returned_medicine` (
  `prescription_id` int(11) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_simrs.hos_returned_medicine: ~0 rows (approximately)
/*!40000 ALTER TABLE `hos_returned_medicine` DISABLE KEYS */;
/*!40000 ALTER TABLE `hos_returned_medicine` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
