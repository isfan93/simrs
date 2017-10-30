/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 9/19/2014 11:54:07 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_lab_treathment_detail
-- ----------------------------
DROP TABLE IF EXISTS `trx_lab_treathment_detail`;

CREATE TABLE `trx_lab_treathment_detail` (
  `lab_queue_id` varchar(45) DEFAULT NULL,
  `trx_ds_id` varchar(45) DEFAULT NULL,
  `dsupport_code` varchar(100) DEFAULT NULL,
  `dsupport_name` varchar(145) DEFAULT NULL,
  `dsupport_value` text,
  `dsupport_value_image` varchar(225) DEFAULT NULL,
  `dsupport_standart_value` varchar(145) DEFAULT NULL,
  `dsupport_satuan` varchar(10) DEFAULT NULL,
  `dsupport_ekspertise_note` text,
  `dsupport_ekspertise_status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
