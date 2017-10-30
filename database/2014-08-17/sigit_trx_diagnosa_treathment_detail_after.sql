/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/17/2014 8:15:37 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_diagnosa_treathment_detail
-- ----------------------------

DROP TABLE IF EXISTS `trx_diagnosa_treathment_detail`;

CREATE TABLE `trx_diagnosa_treathment_detail` (
  `mdc_id` varchar(45) NOT NULL,
  `dat_id` varchar(45) NOT NULL,
  `dat_case` varchar(10) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dat_diag` varchar(45) DEFAULT NULL,
  `dat_treat` int(11) DEFAULT NULL,
  `dat_note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
