/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 9/21/2014 7:02:14 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_racikan_detail
-- ----------------------------
CREATE TABLE `trx_racikan_detail` (
  `racikan_id` varchar(45) NOT NULL,
  `racikan_medicine` varchar(10) DEFAULT NULL,
  `racikan_medicine_qty` double(10,1) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

