/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/31/2014 10:54:10 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_direct_buy
-- ----------------------------
DROP TABLE IF EXISTS `trx_direct_buy`;
CREATE TABLE `trx_direct_buy` (
  `visit_id` varchar(10) NOT NULL,
  `tdb_number` varchar(20) NOT NULL,
  `tdb_operator` int(11) NOT NULL,
  `tdb_note` text,
  `tdb_discount` double(10,2) DEFAULT NULL,
  `tdb_total` double(10,2) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tdb_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
