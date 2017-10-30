ALTER TABLE `mst_insurance` ADD COLUMN `ins_status` INT(2) DEFAULT '1' NULL AFTER `ins_name`;
ALTER TABLE `mst_room` ADD COLUMN `room_status` INT DEFAULT '1' NULL AFTER `pavillion_id`;
ALTER TABLE `mst_pavillion` ADD COLUMN `pav_status` INT DEFAULT '1' NULL AFTER `pavillion_name`;
ALTER TABLE `mst_service` ADD COLUMN `svc_status` INT DEFAULT '1' NULL AFTER `service_name`;
ALTER TABLE `mst_adm_fee` CHANGE `adm_status` `adm_status` CHAR(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1' NOT NULL;
ALTER TABLE `mst_class` ADD COLUMN `class_status` INT DEFAULT '1' NULL AFTER `price_koef`;
ALTER TABLE `trx_dr_schedule` ADD COLUMN `tds_status` INT(2) DEFAULT '1' NULL AFTER `pl_id`;
ALTER TABLE `mst_type_user` ADD COLUMN `ts_status` INT DEFAULT '1' NULL AFTER `description`, ADD COLUMN `modi_id` INT NULL AFTER `ts_status`, ADD COLUMN `modi_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;
ALTER TABLE `mst_treathment` ADD COLUMN `treat_status` INT DEFAULT '1' NULL AFTER `treat_paramedic_price`, ADD COLUMN `modi_id` INT NULL AFTER `treat_status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`,CHANGE `treat_paramedic_price` `treat_paramedic_price` BIGINT(20) NULL ;
	
	DELIMITER $$

	DROP VIEW IF EXISTS `v_tindakan`$$

	CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tindakan` AS 
	SELECT `mt`.`treat_id` AS `treat_id`,`mt`.`treat_name` AS `treat_name`,`mt`.`koef_id` AS `koef_id`,
	`mkf`.`koef_treathment` AS `koef_treathment`,`mp`.`pl_id` AS `pl_id`,`mp`.`pl_name` AS `pl_name`,
	`mt`.`treat_master_fee` AS `treat_master_fee`,`mt`.`treat_item_price` AS `treat_item_price` 
	FROM ((`mst_treathment` `mt` 
	JOIN `mst_poly` `mp` ON((`mp`.`pl_id` = `mt`.`poli`))) 
	JOIN `mst_koefisien_fee` `mkf` ON((`mkf`.`koef_id` = `mt`.`koef_id`))) 
	WHERE mt.treat_status = 1
	ORDER BY `mt`.`treat_id` DESC$$

	DELIMITER ;
	
ALTER TABLE `mst_koefisien_fee` ADD COLUMN `koef_status` INT DEFAULT '1' NULL AFTER `koef_value`;
ALTER TABLE `mst_treat_pack` ADD COLUMN `pt_status` INT DEFAULT '1' NULL AFTER `price`, ADD COLUMN `modi_id` INT NULL AFTER `pt_status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;
ALTER TABLE `map_mst_treat_pack` ADD COLUMN `status` INT DEFAULT '1' NULL AFTER `treat_id`, ADD COLUMN `modi_id` INT NULL AFTER `status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;
ALTER TABLE `mst_lab_treathment` ADD COLUMN `modi_id` INT NULL AFTER `ds_status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;
ALTER TABLE `map_mst_lab` ADD COLUMN `status` INT DEFAULT '1' NULL AFTER `dsd_id`, ADD COLUMN `modi_id` INT NULL AFTER `status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;		
ALTER TABLE `mst_lab_treathment_detail` ADD COLUMN `modi_id` INT NULL AFTER `dsd_status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;
ALTER TABLE `mst_lab_treathment_gol` ADD COLUMN `status` INT DEFAULT '1' NULL AFTER `description`, ADD COLUMN `modi_id` INT NULL AFTER `status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;
ALTER TABLE `mst_supplier` ADD COLUMN `msup_status` INT DEFAULT '1' NULL AFTER `msup_npwp`;
ALTER TABLE `mst_racikan_fee` ADD COLUMN `status` INT DEFAULT '1' NULL AFTER `fee`, ADD COLUMN `modi_id` INT NULL AFTER `status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;

	DELIMITER $$

		DROP VIEW IF EXISTS `v_obat`$$

		CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_obat` AS 
		SELECT `iim`.`im_id` AS `im_id`,`iim`.`im_unit` AS `im_unit`,`iim`.`im_komposisi` AS `im_komposisi`,
		`iim`.`im_name` AS `im_name`,`iim`.`im_barcode` AS `im_barcode`,`iim`.`im_item_price_buy` AS `im_item_price_buy`,
		`iim`.`im_item_price` AS `im_item_price`,`iim`.`im_item_price_package` AS `im_item_price_package`,
		`iim`.`im_ppn` AS `im_ppn`,`iim`.`im_reorder_point` AS `im_reorder_point`,`iim`.`im_min_stock` AS `im_min_stock`,
		`iim`.`im_max_stock` AS `im_max_stock`,`iim`.`im_status` AS `im_status`,`iim`.`modi_id` AS `modi_id`,
		`iim`.`modi_datetime` AS `modi_datetime`,`iim`.`im_type` AS `im_type`,`iim`.`im_vat_status` AS `im_vat_status`,
		`mti`.`mtype_name` AS `mtype_name` 
		FROM (`inv_item_master` `iim` LEFT JOIN `mst_type_inv` `mti` ON((`mti`.`mtype_id` = `iim`.`im_unit`)))
		WHERE iim.im_status = 1
		$$

		DELIMITER ;
	
ALTER TABLE `mst_diagnosa` ADD COLUMN `diag_status` INT DEFAULT '1' NULL AFTER `indonesian`, ADD COLUMN `modi_id` INT NULL AFTER `diag_status`, ADD COLUMN `modi_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `modi_id`;

CREATE	VIEW v_diagnosa AS SELECT * FROM mst_diagnosa 
	WHERE diag_status = 1
	ORDER BY (diag_id) desc
			