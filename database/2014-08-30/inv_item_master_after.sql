/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/30/2014 6:58:41 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for inv_item_master
-- ----------------------------
DROP TABLE IF EXISTS `inv_item_master`;
CREATE TABLE `inv_item_master` (
  `im_id` int(20) NOT NULL AUTO_INCREMENT,
  `im_unit` varchar(20) DEFAULT NULL,
  `im_komposisi` varchar(100) DEFAULT NULL,
  `im_name` varchar(100) DEFAULT NULL,
  `im_barcode` varchar(20) DEFAULT NULL,
  `im_item_price_buy` decimal(8,2) DEFAULT '0.00',
  `im_item_price` decimal(8,2) DEFAULT '0.00' COMMENT '0.00',
  `im_item_price_package` decimal(8,2) DEFAULT NULL,
  `im_ppn` decimal(6,2) DEFAULT NULL,
  `im_reorder_point` decimal(10,2) DEFAULT NULL,
  `im_min_stock` int(10) DEFAULT NULL,
  `im_max_stock` int(10) DEFAULT NULL,
  `im_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `im_type` int(11) DEFAULT NULL,
  `im_vat_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`im_id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;
