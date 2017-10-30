/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/17/2014 8:14:27 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for mst_adm_fee
-- ----------------------------
DROP TABLE IF EXISTS `mst_adm_fee`;

CREATE TABLE `mst_adm_fee` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_name` varchar(255) NOT NULL,
  `adm_fee` double(10,2) NOT NULL,
  `adm_status` char(1) NOT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `mst_adm_fee` VALUES ('1', 'Pendaftaran pasien baru', '25000.00', '1', null, '2014-08-17 10:44:47');
INSERT INTO `mst_adm_fee` VALUES ('2', 'Cetak kartu pasien', '10000.00', '1', null, '2014-08-17 10:44:41');
INSERT INTO `mst_adm_fee` VALUES ('3', 'Cetak surat keterangan', '5000.00', '1', null, '2014-08-17 10:44:30');
INSERT INTO `mst_adm_fee` VALUES ('4', 'Embalase Resep', '1000.00', '1', null, null);
INSERT INTO `mst_adm_fee` VALUES ('5', 'Tusla Resep', '1000.00', '1', null, null);
