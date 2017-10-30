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

-- Dumping structure for table simrsih.trx_visit_bill
DROP TABLE IF EXISTS `trx_visit_bill`;
CREATE TABLE IF NOT EXISTS `trx_visit_bill` (
  `visit_id` varchar(20) NOT NULL,
  `service_id` varchar(10) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `paramedic_price` float NOT NULL,
  `other_price` float NOT NULL,
  `total_price` float NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.trx_visit_bill: ~15 rows (approximately)
/*!40000 ALTER TABLE `trx_visit_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_visit_bill` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
