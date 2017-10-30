/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/17/2014 8:15:55 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_lab_treathment
-- ----------------------------
DROP TABLE IF EXISTS `trx_lab_treathment`;

CREATE TABLE `trx_lab_treathment` (
  `lab_queue_id` varchar(45) NOT NULL,
  `trx_ds_id` varchar(45) NOT NULL,
  `ds_id` smallint(6) NOT NULL,
  `ds_ekspertise_status` char(2) DEFAULT NULL,
  `ds_ekspertise_note` text,
  PRIMARY KEY (`trx_ds_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
