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

-- Dumping structure for table simrsih.mst_bed
DROP TABLE IF EXISTS `mst_bed`;
CREATE TABLE IF NOT EXISTS `mst_bed` (
  `bed_id` int(11) NOT NULL,
  `inventory_number` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bed_status` tinyint(4) NOT NULL COMMENT '1 : dipakai | 0 : tidak dipakai',
  `modi_id` int(11) NOT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_bed: ~2 rows (approximately)
/*!40000 ALTER TABLE `mst_bed` DISABLE KEYS */;
INSERT IGNORE INTO `mst_bed` (`bed_id`, `inventory_number`, `room_id`, `bed_status`, `modi_id`, `modi_datetime`) VALUES
	(1, '', 1, 0, 0, '2014-08-16 15:04:31'),
	(2, '', 2, 0, 0, '2014-08-16 15:04:37'),
	(3, '', 3, 0, 0, '2014-08-16 15:12:53'),
	(4, '', 3, 0, 0, '2014-08-16 15:13:03'),
	(5, '', 4, 0, 0, '2014-08-16 15:13:10'),
	(6, '', 4, 0, 0, '2014-08-16 15:13:16'),
	(7, '', 5, 0, 0, '2014-08-16 15:13:22'),
	(8, '', 5, 0, 0, '2014-08-16 15:13:28'),
	(9, '', 6, 0, 0, '2014-08-16 15:13:34'),
	(10, '', 6, 0, 0, '2014-08-16 15:13:40');
/*!40000 ALTER TABLE `mst_bed` ENABLE KEYS */;


-- Dumping structure for table simrsih.mst_class
DROP TABLE IF EXISTS `mst_class`;
CREATE TABLE IF NOT EXISTS `mst_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `modi_id` int(11) NOT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_class: ~5 rows (approximately)
/*!40000 ALTER TABLE `mst_class` DISABLE KEYS */;
INSERT IGNORE INTO `mst_class` (`class_id`, `class_name`, `price`, `modi_id`, `modi_datetime`) VALUES
	(1, 'VVIP', 1000000, 0, '2014-08-16 15:06:40'),
	(2, 'VIP', 700000, 0, '2014-08-16 15:06:44'),
	(3, 'Kelas I', 450000, 0, '2014-08-16 15:07:09'),
	(4, 'Kelas II', 250000, 0, '2014-08-16 15:07:28'),
	(5, 'Kelas III', 125000, 0, '2014-08-16 15:07:44');
/*!40000 ALTER TABLE `mst_class` ENABLE KEYS */;


-- Dumping structure for table simrsih.mst_pavillion
DROP TABLE IF EXISTS `mst_pavillion`;
CREATE TABLE IF NOT EXISTS `mst_pavillion` (
  `pavillion_id` int(11) NOT NULL AUTO_INCREMENT,
  `pavillion_name` varchar(20) DEFAULT '0',
  `modi_id` int(11) DEFAULT '0',
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pavillion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_pavillion: ~1 rows (approximately)
/*!40000 ALTER TABLE `mst_pavillion` DISABLE KEYS */;
INSERT IGNORE INTO `mst_pavillion` (`pavillion_id`, `pavillion_name`, `modi_id`, `modi_datetime`) VALUES
	(1, 'Anggrek', 0, '2014-08-16 15:04:57');
/*!40000 ALTER TABLE `mst_pavillion` ENABLE KEYS */;


-- Dumping structure for table simrsih.mst_room
DROP TABLE IF EXISTS `mst_room`;
CREATE TABLE IF NOT EXISTS `mst_room` (
  `room_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL DEFAULT '0',
  `pavillion_id` int(11) NOT NULL DEFAULT '0',
  `modi_id` int(11) DEFAULT '1',
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_room: ~1 rows (approximately)
/*!40000 ALTER TABLE `mst_room` DISABLE KEYS */;
INSERT IGNORE INTO `mst_room` (`room_id`, `class_id`, `pavillion_id`, `modi_id`, `modi_datetime`) VALUES
	(1, 2, 1, 1, '2014-08-16 15:09:04'),
	(2, 2, 1, 1, '2014-08-16 15:11:33'),
	(3, 3, 1, 1, '2014-08-16 15:11:44'),
	(4, 3, 1, 1, '2014-08-16 15:11:53'),
	(5, 3, 1, 1, '2014-08-16 15:12:13'),
	(6, 3, 1, 1, '2014-08-16 15:12:23');
/*!40000 ALTER TABLE `mst_room` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
