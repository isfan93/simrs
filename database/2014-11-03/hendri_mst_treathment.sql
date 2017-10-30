ALTER TABLE `db_simrsih_6okt`.`mst_treathment` ADD COLUMN `class` INT(2) DEFAULT '0' NULL AFTER `treat_paramedic_price`;
UPDATE mst_treathment  SET class=1  WHERE treat_name LIKE '%kelas 1%' ;
UPDATE mst_treathment  SET class=1  WHERE treat_name LIKE '%kelas1%' ;
UPDATE mst_treathment  SET class=2  WHERE treat_name LIKE '%kelas 2%' ;
UPDATE mst_treathment  SET class=2  WHERE treat_name LIKE '%kelas2%' ;
UPDATE mst_treathment  SET class=3  WHERE treat_name LIKE '%kelas 3%' ;
UPDATE mst_treathment  SET class=3  WHERE treat_name LIKE '%kelas3%' ;