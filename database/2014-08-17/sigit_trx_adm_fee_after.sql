DROP TABLE IF EXISTS `trx_adm_fee`;

CREATE TABLE `trx_adm_fee` (
  `mdc_id` varchar(10) NOT NULL,
  `adm_id` int(11) NOT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;