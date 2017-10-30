/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 9/21/2014 7:02:00 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_racikan
-- ----------------------------
CREATE TABLE `trx_racikan` (
  `mdc_id` varchar(45) NOT NULL,
  `racikan_id` varchar(45) NOT NULL,
  `racikan_name` varchar(50) NOT NULL,
  `racikan_rule` varchar(45) NOT NULL,
  `racikan_note` varchar(45) DEFAULT NULL,
  `racikan_total` double(10,2) DEFAULT '0.00',
  `racikan_status` char(1) NOT NULL,
  PRIMARY KEY (`racikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
