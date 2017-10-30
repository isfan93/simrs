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

-- Dumping structure for table db_simrs.hos_bed_occupation
CREATE TABLE IF NOT EXISTS `hos_bed_occupation` (
  `visit_id` int(11) NOT NULL DEFAULT '0',
  `bed_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping structure for table db_simrs.hos_concoction
CREATE TABLE IF NOT EXISTS `hos_concoction` (
  `concoction_id` int(11) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping structure for table db_simrs.hos_diagnose
CREATE TABLE IF NOT EXISTS `hos_diagnose` (
  `diagnose_id` int(11) NOT NULL,
  `examination_id` varchar(20) DEFAULT NULL,
  `case_type` varchar(5) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping structure for table db_simrs.hos_examination
CREATE TABLE IF NOT EXISTS `hos_examination` (
  `visit_id` varchar(20) NOT NULL,
  `examination_id` varchar(20) NOT NULL,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `physician_id` int(11) DEFAULT NULL,
  `nurse_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`examination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping structure for table db_simrs.hos_examination_type
CREATE TABLE IF NOT EXISTS `hos_examination_type` (
  `et_id` int(11) NOT NULL,
  `et_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`et_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping structure for table db_simrs.hos_prescription
CREATE TABLE IF NOT EXISTS `hos_prescription` (
  `examination_id` varchar(20) DEFAULT NULL,
  `prescription_id` varchar(45) DEFAULT NULL,
  `paramedic_price` double(10,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 : issued ; 2 : not issued'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping structure for table db_simrs.hos_prescription_details
CREATE TABLE IF NOT EXISTS `hos_prescription_details` (
  `prescription_id` varchar(45) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `uses` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  `rule` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `type` enum('C','P') DEFAULT NULL COMMENT 'C:Concoction ;P:Pure ',
  `concoction_price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping structure for table db_simrs.hos_sub_obj
CREATE TABLE IF NOT EXISTS `hos_sub_obj` (
  `examination_id` varchar(20) DEFAULT NULL,
  `subjective` text,
  `objective` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping structure for table db_simrs.hos_treatment
CREATE TABLE IF NOT EXISTS `hos_treatment` (
  `treatment_id` int(11) DEFAULT NULL,
  `examination_id` varchar(20) DEFAULT NULL,
  `diagnose_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping structure for table db_simrs.hos_vital_sign
CREATE TABLE IF NOT EXISTS `hos_vital_sign` (
  `examination_id` varchar(20) DEFAULT NULL,
  `blood_type` char(2) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `consciousness` int(11) DEFAULT NULL,
  `systole` int(11) DEFAULT NULL,
  `diastole` int(11) DEFAULT NULL,
  `pulse` int(11) DEFAULT NULL,
  `respiration_rate` int(11) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

