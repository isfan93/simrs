ALTER TABLE `trx_medical_ptn_now`
CHANGE COLUMN `ptn_medical_heartrate` `ptn_medical_respirationrate` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `mst_treathment`
CHANGE COLUMN `class` `class_id` INT(11) NULL DEFAULT '0' ;

UPDATE mst_treathment SET class_id=1  WHERE treat_name LIKE '%kelas VVIP%' ;
UPDATE mst_treathment SET class_id=1  WHERE treat_name LIKE '%VVIP%' ;
UPDATE mst_treathment SET class_id=2  WHERE treat_name LIKE '%kelas VIP%' ;
UPDATE mst_treathment SET class_id=2  WHERE treat_name LIKE '%VIP%' ;
UPDATE mst_treathment SET class_id=3  WHERE treat_name LIKE '%kelas 1%' ;
UPDATE mst_treathment SET class_id=3  WHERE treat_name LIKE '%kelas1%' ;
UPDATE mst_treathment SET class_id=4  WHERE treat_name LIKE '%kelas 2%' ;
UPDATE mst_treathment SET class_id=4  WHERE treat_name LIKE '%kelas2%' ;
UPDATE mst_treathment SET class_id=5  WHERE treat_name LIKE '%kelas 3%' ;
UPDATE mst_treathment SET class_id=5  WHERE treat_name LIKE '%kelas3%' ;

ALTER TABLE `trx_lab_queue`
CHANGE COLUMN `lab_queue_id` `lab_queue_id` VARCHAR(45) NOT NULL ;

ALTER TABLE `trx_bill`
ADD COLUMN `datetime` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `total`;

ALTER TABLE `trx_recipe_detail`
DROP COLUMN `mdc_id`;

INSERT INTO `sys_code`(`id`, `name` ) VALUES('RT', 'Retur Obat' )

ALTER TABLE `db_simrsih`.`hos_returned_medicine`
CHANGE COLUMN `service_id` `service_id` VARCHAR(45) NULL DEFAULT NULL;

INSERT INTO `db_simrsih`.`sys_menu` (`menu_parent`, `menu_url`, `menu_name`, `menu_status`, `modul_id`) VALUES ('0', 'gudang/retur_ranap', 'Retur Obat Rawat Inap', '1', '10');

ALTER TABLE `db_simrsih`.`trx_bill_detail`
ADD COLUMN `datetime` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `total_price`;

ALTER TABLE `db_simrsih`.`trx_bill_detail`
ADD COLUMN `service_reference` VARCHAR(45) NULL DEFAULT NULL AFTER `service_type`;

DROP TABLE IF EXISTS `hos_returned_medicine`;
CREATE TABLE `hos_returned_medicine` (
  `id` varchar(45) NOT NULL,
  `prescription_id` varchar(45) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pic` int(11) NOT NULL,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT NULL COMMENT '0:not confirmed;1:confirmed;2:cancel',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
