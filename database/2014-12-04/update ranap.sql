INSERT INTO `db_simrsih`.`mst_koefisien_fee` (`koef_id`, `koef_treathment`, `koef_value`, `koef_status`) VALUES ('19', 'nic', '1', '1');

ALTER TABLE `db_simrsih`.`hos_examination`
CHANGE COLUMN `datetime` `datetime` DATETIME NULL ;

ALTER TABLE `db_simrsih`.`trx_recipe_detail`
CHANGE COLUMN `recipe_rule` `recipe_rule` TEXT NULL DEFAULT NULL ;

ALTER TABLE `db_simrsih`.`hos_examination`
ADD COLUMN `examination_type` ENUM('visite','regular') NULL AFTER `nurse_id`;

ALTER TABLE `db_simrsih`.`trx_diagnosa_treathment_detail`
CHANGE COLUMN `dat_treat` `dat_treat` INT(11) NULL DEFAULT NULL AFTER `dat_id`;

DROP TABLE IF EXISTS `hos_nursing_diagnosis`;
CREATE TABLE `hos_nursing_diagnosis` (
  `mdc_id` varchar(45) DEFAULT NULL,
  `nurse_diag_id` varchar(45) DEFAULT NULL,
  `diag_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `hos_nursing_diagnosis_detail`;
CREATE TABLE `hos_nursing_diagnosis_detail` (
  `nurse_diag_id` varchar(45) DEFAULT NULL,
  `nic_id` int(11) DEFAULT NULL,
  `nic_notes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `hos_nursing_treatment`;
CREATE TABLE `hos_nursing_treatment` (
  `mdc_id` varchar(45) DEFAULT NULL,
  `treatment_id` int(11) DEFAULT NULL,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mst_nursing_diagnosis`;
CREATE TABLE `mst_nursing_diagnosis` (
  `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosis_name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`diagnosis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO `mst_nursing_diagnosis` VALUES (1,'Bersihan Jalan Nafas tidak efektif'),(2,'Pola Nafas tidak efektif'),(3,'Gangguan Pertukaran gas'),(4,'Kurang Pengetahuan'),(5,'Risiko Aspirasi'),(6,'Hipertermia'),(7,'Ketidakseimbangan nutrisi kurang dari kebutuhan tubuh'),(8,'Defisit Volume Cairan'),(9,'Kelebihan Volume Cairan'),(10,'Risiko infeksi'),(11,'Intoleransi aktivitas'),(12,'Kerusakan integritas kulit'),(13,'Kecemasan'),(14,'Takut'),(15,'Penurunan curah jantung'),(16,'Perfusi jaringan kardio pulmonal tidak efektif'),(17,'Perfusi jaringan cerebral tidak efektif'),(18,'Perfusi jaringan gastrointestinal tidak efektif'),(19,'Perfusi jaringan renal tidak efektif'),(20,'Defisit perawatan diri'),(21,'Risiko gangguan integritas kulit'),(22,'Ketidakseimbangan nutrisi lebih dari kebutuhan tubuh'),(23,'Nyeri akut '),(24,'Nyeri Kronis'),(25,'Gangguan mobilitas fisik'),(26,'Risiko trauma'),(27,'Risiko Injury'),(28,'Mual'),(29,'Diare'),(30,'Konstipasi'),(31,'Gangguan pola tidur'),(32,'Retensi urin'),(33,'Kerusakan integritas jaringan'),(34,'Gangguan body image'),(35,'Manejemen regimen terapeutik tidak efektif'),(36,'Kelelahan');
