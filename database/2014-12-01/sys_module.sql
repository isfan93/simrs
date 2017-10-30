/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 12/1/2014 5:44:34 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for sys_module
-- ----------------------------
CREATE TABLE `sys_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) DEFAULT NULL,
  `module_url` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `sys_module` VALUES ('1', 'pendaftaran', 'pendaftaran', '1', null, '2014-07-18 11:11:25');
INSERT INTO `sys_module` VALUES ('2', 'pelayanan informasi', 'pelayanan_informasi', '1', null, '2014-12-01 05:05:55');
INSERT INTO `sys_module` VALUES ('3', 'rawat jalan', 'rawat_jalan', '1', null, '2014-07-18 11:12:23');
INSERT INTO `sys_module` VALUES ('4', 'kasir', 'kasir', '1', null, '2014-07-18 11:12:49');
INSERT INTO `sys_module` VALUES ('5', 'apotek', 'apotek', '1', null, '2014-07-18 11:13:03');
INSERT INTO `sys_module` VALUES ('7', 'lab', 'lab', '1', null, '2014-12-01 05:05:54');
INSERT INTO `sys_module` VALUES ('8', 'pelaporan', 'pelaporan', '1', null, '2014-08-07 08:22:57');
INSERT INTO `sys_module` VALUES ('9', 'manajemen data', 'master', '1', null, '2014-08-07 08:22:57');
INSERT INTO `sys_module` VALUES ('10', 'gudang farmasi', 'gudang', '1', null, '2014-08-07 08:22:58');
INSERT INTO `sys_module` VALUES ('11', 'rawat inap', 'rawat_inap', '1', null, '2014-09-09 06:47:01');
INSERT INTO `sys_module` VALUES ('12', 'rekam medis', 'rekam_medis', '1', null, '2014-09-03 19:23:07');
INSERT INTO `sys_module` VALUES ('13', 'igd', 'igd', '1', null, '2014-09-08 10:16:00');
INSERT INTO `sys_module` VALUES ('14', 'rad', 'rad', '1', null, '2014-12-01 05:05:52');
INSERT INTO `sys_module` VALUES ('15', 'keuangan', 'keuangan', '1', null, '2014-11-30 17:31:14');
