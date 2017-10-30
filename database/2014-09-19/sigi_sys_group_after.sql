/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 9/19/2014 11:50:41 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for sys_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_group`;

CREATE TABLE `sys_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) DEFAULT NULL,
  `group_homebase` varchar(99) DEFAULT NULL,
  `group_status` int(11) DEFAULT 1,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `sys_group` VALUES ('1', 'super admin', 'home', '1', null, '2014-07-15 05:08:09');
INSERT INTO `sys_group` VALUES ('2', 'admin', 'rawat_jalan', '1', null, '2014-08-07 18:37:37');
INSERT INTO `sys_group` VALUES ('3', 'dokter poli', 'rawat_jalan', '1', null, '2014-08-15 01:48:41');
INSERT INTO `sys_group` VALUES ('4', 'kasir', 'kasir', '1', null, '2014-08-07 10:50:16');
INSERT INTO `sys_group` VALUES ('5', 'apotek', 'apotek', '1', null, '2014-08-07 10:57:17');
INSERT INTO `sys_group` VALUES ('6', 'lab', 'lab/antrian', '1', null, '2014-09-19 23:50:06');
INSERT INTO `sys_group` VALUES ('7', 'gudang', 'gudang', '1', null, '2014-08-07 18:33:05');
INSERT INTO `sys_group` VALUES ('8', 'resepsionis', 'pendaftaran', '1', null, '2014-08-15 01:48:52');
INSERT INTO `sys_group` VALUES ('9', 'igd', 'pendaftaran', '1', null, '2014-09-08 03:18:38');
INSERT INTO `sys_group` VALUES ('10', 'super admin', 'pelaporan', '1', null, '2014-09-19 23:50:08');
INSERT INTO `sys_group` VALUES ('11', 'Direktur', 'pelaporan', '1', null, '2014-09-19 23:50:09');
INSERT INTO `sys_group` VALUES ('12', 'radiologi', 'lab/antrian', '1', null, '2014-09-19 23:50:10');
INSERT INTO `sys_group` VALUES ('13', 'perawat', 'rawat_jalan', '1', null, '2014-09-19 23:50:21');
