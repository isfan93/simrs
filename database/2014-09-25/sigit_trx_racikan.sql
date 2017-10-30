ALTER TABLE `trx_racikan` ADD `racikan_qty` DOUBLE(10,2) NOT NULL AFTER `racikan_rule`;
ALTER TABLE `trx_racikan` ADD `racikan_sediaan` VARCHAR(20) NOT NULL AFTER `racikan_name`;

ALTER TABLE `trx_racikan` ADD `racikan_tuslah_type` INT NOT NULL AFTER `racikan_sediaan`;