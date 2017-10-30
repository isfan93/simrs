/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/30/2014 6:58:22 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for inv_receive_item
-- ----------------------------
DROP TABLE IF EXISTS `inv_receive_item`;
CREATE TABLE `inv_receive_item` (
  `iri_id` varchar(20) NOT NULL,
  `ipo_id` varchar(20) DEFAULT NULL,
  `iri_date_accept` date DEFAULT NULL,
  `iri_operator` varchar(50) DEFAULT NULL,
  `iri_total` double(10,2) DEFAULT NULL,
  `iri_discount` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`iri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
