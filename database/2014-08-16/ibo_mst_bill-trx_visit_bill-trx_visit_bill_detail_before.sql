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

-- Dumping structure for table simrsih.mst_bill
DROP TABLE IF EXISTS `mst_bill`;
CREATE TABLE IF NOT EXISTS `mst_bill` (
  `bill_id` varchar(10) NOT NULL,
  `modi_id` varchar(5) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bill_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.mst_bill: ~7 rows (approximately)
/*!40000 ALTER TABLE `mst_bill` DISABLE KEYS */;
INSERT IGNORE INTO `mst_bill` (`bill_id`, `modi_id`, `modi_datetime`, `bill_name`) VALUES
	('1', NULL, '2014-06-21 22:43:02', 'Biaya Perawatan'),
	('2', '', '2014-06-21 22:43:02', 'PPPK/Poli Bedah'),
	('3', NULL, '2014-06-21 22:43:02', 'Biaya Makan'),
	('4', NULL, '2014-06-21 22:43:02', 'Obat-obat infus dll'),
	('5', NULL, '2014-06-21 22:43:02', 'Obat dan Resep'),
	('6', NULL, '2014-06-21 22:43:02', 'Tindakan'),
	('7', NULL, '2014-07-29 17:23:41', 'Laboratorium');
/*!40000 ALTER TABLE `mst_bill` ENABLE KEYS */;


-- Dumping structure for table simrsih.trx_visit_bill
DROP TABLE IF EXISTS `trx_visit_bill`;
CREATE TABLE IF NOT EXISTS `trx_visit_bill` (
  `tvb_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` varchar(255) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `ins_id` int(2) DEFAULT NULL,
  `ins_no` varchar(20) DEFAULT NULL,
  `patient_pay` double(11,2) DEFAULT NULL,
  `total_price` double(11,2) DEFAULT NULL,
  `note` text,
  `payment_status` char(1) DEFAULT NULL,
  `modi_id` char(1) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tvb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.trx_visit_bill: ~15 rows (approximately)
/*!40000 ALTER TABLE `trx_visit_bill` DISABLE KEYS */;
INSERT IGNORE INTO `trx_visit_bill` (`tvb_id`, `visit_id`, `payment_date`, `ins_id`, `ins_no`, `patient_pay`, `total_price`, `note`, `payment_status`, `modi_id`, `modi_datetime`) VALUES
	(54, '14080002', NULL, 1, '', 250000.00, 202000.00, '', '4', NULL, '2014-08-08 00:23:54'),
	(55, '14080001', NULL, 1, '', 60000.00, 55000.00, '', '4', NULL, '2014-08-08 00:35:45'),
	(56, '14080003', NULL, 1, '', 4000.00, 3750.00, '', '4', NULL, '2014-08-08 01:02:09'),
	(57, '14080004', NULL, 1, '', 4000.00, 3750.00, '', '4', NULL, '2014-08-08 01:02:31'),
	(58, '14080005', NULL, NULL, NULL, NULL, 31250.00, NULL, '3', NULL, '2014-08-08 00:55:26'),
	(75, '14080008', NULL, NULL, NULL, NULL, 40000.00, NULL, '3', NULL, '2014-08-08 09:50:46'),
	(79, '14080011', NULL, 1, '', 50000.00, 40000.00, '', '4', NULL, '2014-08-08 15:39:44'),
	(80, '14080010', NULL, NULL, NULL, NULL, 0.00, '', '3', NULL, '2014-08-08 15:51:06'),
	(81, '14080006', NULL, 1, '', 6000000.00, 5712000.00, '', '4', NULL, '2014-08-08 16:04:58'),
	(82, '14080012', NULL, 1, '', 4000000.00, 3480000.00, '', '4', NULL, '2014-08-08 16:09:25'),
	(84, '14080016', NULL, NULL, NULL, NULL, 55000.00, NULL, '3', NULL, '2014-08-09 08:02:58'),
	(85, '14080014', NULL, NULL, NULL, NULL, 5100625.00, '', '3', NULL, '2014-08-09 08:18:42'),
	(86, '14080018', NULL, 1, '', 50000.00, 49000.00, '', '4', NULL, '2014-08-09 08:29:31'),
	(87, '14080021', NULL, 1, '', 120000.00, 110000.00, '', '4', NULL, '2014-08-09 15:23:16'),
	(88, '14080019', NULL, NULL, NULL, NULL, 2290000.00, '', '3', NULL, '2014-08-09 16:13:56');
/*!40000 ALTER TABLE `trx_visit_bill` ENABLE KEYS */;


-- Dumping structure for table simrsih.trx_visit_bill_detail
DROP TABLE IF EXISTS `trx_visit_bill_detail`;
CREATE TABLE IF NOT EXISTS `trx_visit_bill_detail` (
  `tvb_id` int(11) NOT NULL,
  `bill_type` int(11) NOT NULL,
  `desc` text,
  `price` double(10,2) DEFAULT NULL,
  `paramedic_price` double(10,2) DEFAULT NULL,
  `other_price` double(10,2) DEFAULT NULL,
  `total_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simrsih.trx_visit_bill_detail: ~26 rows (approximately)
/*!40000 ALTER TABLE `trx_visit_bill_detail` DISABLE KEYS */;
INSERT IGNORE INTO `trx_visit_bill_detail` (`tvb_id`, `bill_type`, `desc`, `price`, `paramedic_price`, `other_price`, `total_price`) VALUES
	(54, 7, 'Golongan darah (ABO Rh)', 200000.00, 2000.00, 0.00, 202000.00),
	(55, 5, 'Amoxilin 5mg 3 X 1 Setelah Makan 12 Tablet', 0.00, 0.00, 0.00, 0.00),
	(55, 6, NULL, 45000.00, 0.00, 0.00, 45000.00),
	(55, 1, 'Jasa pemeriksaan dokter', 10000.00, 0.00, 0.00, 10000.00),
	(56, 4, 'Amoxilin 5mg 2 Tablet', 3750.00, 0.00, 0.00, 3750.00),
	(57, 4, 'Amoxilin 5mg 2 Tablet', 3750.00, 0.00, 0.00, 3750.00),
	(58, 4, 'Amoxilin 5mg 10 Tablet', 31250.00, 0.00, 0.00, 31250.00),
	(75, 7, 'Darah Rutin (Hb, Leuko,trombo,hematokri,Diff, LED)', 40000.00, 0.00, 0.00, 40000.00),
	(79, 7, 'Darah Rutin (Hb, Leuko,trombo,hematokri,Diff, LED)', 40000.00, 0.00, 0.00, 40000.00),
	(81, 5, 'ANGIOTEN 50 MG [Losartan 50 mg] 1 X 1 Setelah Makan 12 Tab', 3480000.00, 0.00, 0.00, 3480000.00),
	(81, 5, 'KALMECO 500 UG [Metcobalamin] 3 X 1 Setelah Makan 12 Cup', 2232000.00, 0.00, 0.00, 2232000.00),
	(82, 4, 'ANGIOTEN 50 MG [Losartan 50 mg] 12 Tab', 3480000.00, 0.00, 0.00, 3480000.00),
	(84, 7, 'Darah Lengkap', 55000.00, 0.00, 0.00, 55000.00),
	(85, 5, 'CPG [Clopidogrel] 3 X 1 Setelah Makan 10 Tab', 4000000.00, 0.00, 0.00, 4000000.00),
	(85, 5, 'BETA -ONE 2,5 MG [Bisoprolol 2,5 mg] 2 X 1 Setelah Makan 10 Tab', 1000000.00, 0.00, 0.00, 1000000.00),
	(85, 5, 'ANGIOTEN 50 MG [Losartan 50 mg] 2 X 1 Setelah Makan 10 Tab', 625.00, 0.00, 0.00, 625.00),
	(85, 6, NULL, 0.00, 0.00, 0.00, 0.00),
	(85, 1, 'Jasa pemeriksaan dokter', 100000.00, 0.00, 0.00, 100000.00),
	(86, 7, 'Glukosa darah puasa', 15000.00, 0.00, 0.00, 15000.00),
	(86, 7, 'Glukosa darah 2 jam pp', 15000.00, 0.00, 0.00, 15000.00),
	(86, 7, 'Asam urat', 19000.00, 0.00, 0.00, 19000.00),
	(87, 7, 'Darah Lengkap', 55000.00, 0.00, 0.00, 55000.00),
	(87, 7, 'Thorax Foto/Cor & Pulmo', 55000.00, 0.00, 0.00, 55000.00),
	(88, 5, 'LACTAMOR [] 3 X 1 Sebelum Makan 10 Tab', 990000.00, 0.00, 0.00, 990000.00),
	(88, 5, 'CPG [Clopidogrel] 1 X 1 Setelah Makan 3 Tab', 1200000.00, 0.00, 0.00, 1200000.00),
	(88, 1, 'Jasa pemeriksaan dokter', 100000.00, 0.00, 0.00, 100000.00);
/*!40000 ALTER TABLE `trx_visit_bill_detail` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
