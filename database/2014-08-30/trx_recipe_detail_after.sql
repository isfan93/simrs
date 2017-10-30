/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/30/2014 6:56:35 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for trx_recipe_detail
DROP TABLE IF EXISTS `trx_recipe_detail`;
-- ----------------------------
CREATE TABLE `trx_recipe_detail` (
  `mdc_id` varchar(45) DEFAULT NULL,
  `recipe_id` varchar(45) NOT NULL,
  `recipe_medicine` varchar(10) DEFAULT NULL,
  `recipe_rule` varchar(100) DEFAULT NULL,
  `recipe_note` varchar(255) DEFAULT NULL,
  `recipe_qty` double(10,1) DEFAULT NULL,
  `recipe_number` smallint(6) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
