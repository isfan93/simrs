-- modify table trx_diagnosa_treathment
ALTER TABLE `trx_diagnosa_treathment` ADD `dat_diag` VARCHAR(45) NOT NULL AFTER `dat_id`, ADD `dat_case` VARCHAR(10) NOT NULL AFTER `dat_diag`, ADD `dat_note` TEXT NOT NULL AFTER `dat_case`;
