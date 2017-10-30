/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/30/2014 6:58:03 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for inv_purchase_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `inv_purchase_order_detail`;
CREATE TABLE `inv_purchase_order_detail` (
  `ipo_id` varchar(20) NOT NULL,
  `ipod_item` varchar(20) NOT NULL,
  `ipod_qty` int(11) NOT NULL,
  `ipod_harga_beli` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
