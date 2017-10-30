/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 9/19/2014 11:52:54 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_visit
-- ----------------------------
DROP TABLE IF EXISTS `trx_visit`;

CREATE TABLE `trx_visit` (
  `visit_id` varchar(20) NOT NULL,
  `visit_rekmed` varchar(10) NOT NULL,
  `visit_type` enum('rajal','ranap','lab','pembelian umum','igd','rad') NOT NULL,
  `visit_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visit_out` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `visit_status` char(1) NOT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

