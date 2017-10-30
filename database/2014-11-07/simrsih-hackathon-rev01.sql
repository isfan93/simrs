ALTER TABLE `db_simrsih_ref`.`hos_bed_occupation`
CHANGE COLUMN `visit_id` `service_id` VARCHAR(14) NOT NULL DEFAULT '0' ;

ALTER TABLE `db_simrsih_ref`.`hos_examination`
CHANGE COLUMN `visit_id` `service_id` VARCHAR(14) NOT NULL ,
CHANGE COLUMN `examination_id` `examination_id` VARCHAR(17) NOT NULL ;

ALTER TABLE `db_simrsih_ref`.`trx_bill_detail`
CHANGE COLUMN `service_id` `service_type` TINYINT(4) NULL DEFAULT NULL ;

ALTER TABLE `db_simrsih_ref`.`trx_bill_detail`
ADD COLUMN `total_price` FLOAT NULL DEFAULT NULL AFTER `other_price`;

ALTER TABLE `db_simrsih_ref`.`trx_bill_detail`
DROP PRIMARY KEY;

ALTER TABLE `db_simrsih_ref`.`trx_service` 
CHANGE COLUMN `service_in` `service_in` TIMESTAMP DEFAULT CURRENT TIMESTAMP ;

ALTER TABLE `db_simrsih_ref`.`hos_examination` 
CHANGE COLUMN `examination_id` `examination_id` VARCHAR(18) NOT NULL ;

ALTER TABLE `db_simrs`.`trx_diagnosa_treathment_detail` 
DROP COLUMN `mdc_id`;