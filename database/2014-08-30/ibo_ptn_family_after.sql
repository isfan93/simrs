DROP TABLE IF EXISTS `ptn_family`;
CREATE TABLE IF NOT EXISTS `ptn_family` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_name` varchar(50) DEFAULT NULL,
  `fm_sex` varchar(255) DEFAULT NULL,
  `fm_relation` varchar(20) DEFAULT NULL,
  `fm_address` text,
  `fm_phone` varchar(20) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
