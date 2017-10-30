/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 12/1/2014 5:34:41 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for fnc_expenses
-- ----------------------------
CREATE TABLE `fnc_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `finance_type` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `nominal` float(10,2) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `fnc_expenses` VALUES ('7', '1', '- Keterangan 1', '0000-00-00', '200000.00', null, '2014-11-30 18:14:32');
INSERT INTO `fnc_expenses` VALUES ('8', '1', '- Keterangan 1', '2014-11-30', '200000.00', null, '2014-11-30 18:15:19');
INSERT INTO `fnc_expenses` VALUES ('9', '2', 'Biaya operasional kantor', '2014-11-30', '200000.00', null, '2014-11-30 18:19:16');
INSERT INTO `fnc_expenses` VALUES ('10', '2', '-', '2014-11-30', '100000.00', null, '2014-11-30 18:19:40');
INSERT INTO `fnc_expenses` VALUES ('11', '2', 'operasional baru', '2014-11-30', '22222.00', null, '2014-11-30 18:36:15');
INSERT INTO `fnc_expenses` VALUES ('12', '1', 'operasional baru lagi', '2014-11-30', '1234555.00', null, '2014-11-30 18:37:11');
INSERT INTO `fnc_expenses` VALUES ('13', '2', '-', '2014-11-30', '1234444.00', null, '2014-11-30 18:37:30');
INSERT INTO `fnc_expenses` VALUES ('14', '1', '-', '2014-12-01', '12000.00', null, '2014-12-01 05:02:22');
INSERT INTO `fnc_expenses` VALUES ('15', '2', '-', '2014-12-01', '1000.00', null, '2014-12-01 05:03:47');
INSERT INTO `fnc_expenses` VALUES ('16', '2', '-', '2014-12-01', '12000.00', null, '2014-12-01 05:04:09');
INSERT INTO `fnc_expenses` VALUES ('17', '2', 'ket', '2014-12-01', '12000.00', null, '2014-12-01 05:04:28');



