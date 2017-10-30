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

-- Dumping data for table db_simrs.mst_education: ~8 rows (approximately)
/*!40000 ALTER TABLE `mst_education` DISABLE KEYS */;
INSERT IGNORE INTO `mst_education` (`med_id`, `med_name`, `modi_id`, `modi_datetime`) VALUES
	(1, 'Pasca Sarjana', NULL, '2014-09-19 22:08:48'),
	(2, 'S1', NULL, '2014-09-19 22:08:49'),
	(3, 'Akademi', NULL, '2014-09-19 22:08:53'),
	(4, 'SMA / SMK', NULL, '2014-09-19 22:08:54'),
	(5, 'SMP', NULL, '2014-09-19 22:08:56'),
	(6, 'SD', NULL, '2014-09-19 22:08:58'),
	(7, 'Belum Sekolah', NULL, '2014-09-19 22:09:00'),
	(8, 'Tidak Sekolah', NULL, '2014-09-19 22:09:01');
/*!40000 ALTER TABLE `mst_education` ENABLE KEYS */;


-- Dumping structure for table db_simrs.mst_marital_st
DROP TABLE IF EXISTS `mst_marital_st`;
CREATE TABLE IF NOT EXISTS `mst_marital_st` (
  `mms_id` int(11) NOT NULL AUTO_INCREMENT,
  `mms_name` varchar(20) NOT NULL DEFAULT '0',
  `modi_id` int(11) DEFAULT '0',
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_simrs.mst_marital_st: ~4 rows (approximately)
/*!40000 ALTER TABLE `mst_marital_st` DISABLE KEYS */;
INSERT IGNORE INTO `mst_marital_st` (`mms_id`, `mms_name`, `modi_id`, `modi_datetime`) VALUES
	(1, 'Belum Menikah', 0, '2014-09-19 21:59:08'),
	(2, 'Sudah Menikah', 0, '2014-09-19 21:59:12');
/*!40000 ALTER TABLE `mst_marital_st` ENABLE KEYS */;


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
	(1, 'Pelajar / Mahasiswa', NULL, NULL, '2014-09-19 22:01:49'),
	(2, 'Pegawai Negeri', NULL, NULL, '2014-09-19 22:01:58'),
	(3, 'Wiraswasta', NULL, NULL, '2014-09-19 22:02:14'),
	(4, 'Pegawai Swasta', NULL, NULL, '2014-09-19 22:02:26'),
	(5, 'Profesional', NULL, NULL, '2014-09-19 22:02:29'),
	(6, 'Tidak Bekerja', NULL, NULL, '2014-09-19 22:02:33'),
	(7, 'Lainnya', NULL, NULL, '2014-09-19 22:02:52');
/*!40000 ALTER TABLE `mst_occupation` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

ALTER TABLE `ptn_family`
	ADD COLUMN `fm_education` INT NULL DEFAULT NULL AFTER `fm_phone`,
	ADD COLUMN `fm_occupation` INT NULL DEFAULT NULL AFTER `fm_education`;
