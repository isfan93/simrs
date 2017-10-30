ALTER TABLE ptn_social_data ADD COLUMN sd_card_number varchar(20) AFTER sd_rekmed;
ALTER TABLE ptn_social_data ADD COLUMN sd_barcode VARCHAR(100) AFTER sd_card_number;
ALTER TABLE ptn_social_data ADD COLUMN sd_title CHAR(2) AFTER sd_barcode;
ALTER TABLE ptn_social_data ADD COLUMN fm_id INT(11) AFTER sd_title;
ALTER TABLE ptn_social_data ADD COLUMN sd_institute VARCHAR(50) NULL DEFAULT NULL AFTER sd_occupation;
