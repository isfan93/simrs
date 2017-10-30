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

-- Dumping structure for table simrsih.sys_menu_role
DROP TABLE IF EXISTS `sys_menu_role`;
CREATE TABLE IF NOT EXISTS `sys_menu_role` (
  `menu_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.sys_menu_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_menu_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_menu_role` ENABLE KEYS */;


-- Dumping structure for table simrsih.sys_module
DROP TABLE IF EXISTS `sys_module`;
CREATE TABLE IF NOT EXISTS `sys_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) DEFAULT NULL,
  `module_url` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.sys_module: ~6 rows (approximately)
/*!40000 ALTER TABLE `sys_module` DISABLE KEYS */;
INSERT IGNORE INTO `sys_module` (`module_id`, `module_name`, `module_url`, `status`, `modi_id`, `modi_datetime`) VALUES
	(1, 'pendaftaran', 'pendaftaran', 1, NULL, '2014-07-18 00:11:25'),
	(2, 'pelayanan informasi', 'pelayanan_informasi', 1, NULL, '2014-07-18 00:12:09'),
	(3, 'rawat jalan', 'rawat_jalan', 1, NULL, '2014-07-18 00:12:23'),
	(4, 'kasir', 'kasir', 1, NULL, '2014-07-18 00:12:49'),
	(5, 'apotek', 'apotek', 1, NULL, '2014-07-18 00:13:03'),
	(6, 'gudang farmasi', 'gudang_farmasi', 1, NULL, '2014-07-18 00:13:19');
/*!40000 ALTER TABLE `sys_module` ENABLE KEYS */;


-- Dumping structure for table simrsih.sys_module_role
DROP TABLE IF EXISTS `sys_module_role`;
CREATE TABLE IF NOT EXISTS `sys_module_role` (
  `module_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.sys_module_role: ~6 rows (approximately)
/*!40000 ALTER TABLE `sys_module_role` DISABLE KEYS */;
INSERT IGNORE INTO `sys_module_role` (`module_id`, `group_id`, `modi_id`, `modi_datetime`) VALUES
	(1, 1, 1, '2014-07-18 00:20:03'),
	(2, 1, 1, '2014-07-19 06:04:56'),
	(3, 1, 1, '2014-07-19 06:05:06'),
	(4, 1, 1, '2014-07-19 06:15:01'),
	(5, 1, 1, '2014-07-19 06:15:10'),
	(6, 1, 1, '2014-07-19 06:15:24');
/*!40000 ALTER TABLE `sys_module_role` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
