/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/6/2014 9:33:48 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for com_code
-- ----------------------------
CREATE TABLE `com_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(200) NOT NULL,
  `value_1` text,
  `value_2` text,
  `value_3` text,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for com_menu
-- ----------------------------
CREATE TABLE `com_menu` (
  `menu_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `modul_id` smallint(6) NOT NULL,
  `menu_nama` varchar(200) NOT NULL,
  `menu_url` varchar(200) NOT NULL,
  `menu_icon` varchar(200) DEFAULT NULL,
  `menu_parent` varchar(200) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for com_menu_role
-- ----------------------------
CREATE TABLE `com_menu_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_tipe_id` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for com_modul
-- ----------------------------
CREATE TABLE `com_modul` (
  `modul_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `modul_nama` varchar(200) NOT NULL,
  `modul_url` varchar(200) NOT NULL,
  `modul_icon` varchar(200) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`modul_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for com_user
-- ----------------------------
CREATE TABLE `com_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `user_tipe` int(11) NOT NULL,
  `jenis_kelamin` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for com_user_tipe
-- ----------------------------
CREATE TABLE `com_user_tipe` (
  `tipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_nama` varchar(100) NOT NULL,
  `tipe_home` varchar(200) DEFAULT NULL,
  `tipe_homebase` varchar(200) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_item_master
-- ----------------------------
CREATE TABLE `inv_item_master` (
  `im_id` varchar(20) NOT NULL,
  `im_unit` varchar(20) DEFAULT NULL,
  `im_name` varchar(100) DEFAULT NULL,
  `im_barcode` varchar(20) DEFAULT NULL,
  `im_currency_id` varchar(20) DEFAULT NULL,
  `im_item_price_buy` decimal(8,2) DEFAULT NULL,
  `im_item_price` decimal(8,2) DEFAULT NULL,
  `im_ppn` decimal(6,2) DEFAULT NULL,
  `im_reorder_point` decimal(10,2) DEFAULT NULL,
  `im_min_stock` decimal(10,2) DEFAULT NULL,
  `im_max_stock` decimal(10,2) DEFAULT NULL,
  `im_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `im_type` int(11) DEFAULT NULL,
  `im_vat_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`im_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_item_stok
-- ----------------------------
CREATE TABLE `inv_item_stok` (
  `istok_id` int(11) NOT NULL AUTO_INCREMENT,
  `iri_id` varchar(20) DEFAULT NULL,
  `istok_item` varchar(20) DEFAULT NULL,
  `istok_qty` int(11) DEFAULT NULL,
  `istok_exp` date DEFAULT NULL,
  PRIMARY KEY (`istok_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_item_type
-- ----------------------------
CREATE TABLE `inv_item_type` (
  `it_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_name` varchar(50) DEFAULT NULL,
  `it_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`it_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_mst_pos
-- ----------------------------
CREATE TABLE `inv_mst_pos` (
  `imp_id` varchar(20) NOT NULL,
  `imp_name` varchar(100) DEFAULT NULL,
  `imp_parent` varchar(20) DEFAULT NULL,
  `imp_description` varchar(1000) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imp_status` smallint(6) DEFAULT '1',
  PRIMARY KEY (`imp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_purchase_order
-- ----------------------------
CREATE TABLE `inv_purchase_order` (
  `ipo_id` varchar(20) NOT NULL,
  `ipo_supplier` varchar(20) NOT NULL,
  `ipo_date_req` date NOT NULL,
  `ipo_currency` varchar(20) NOT NULL,
  `ipo_vat` varchar(20) DEFAULT NULL,
  `ipo_ppn` double(10,2) DEFAULT NULL,
  `ipo_address` text,
  `ipo_date_shipping` date NOT NULL,
  `ipo_operator` varchar(50) NOT NULL,
  `ipo_note` text,
  `ipo_status` int(1) DEFAULT '0',
  PRIMARY KEY (`ipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_purchase_order_detail
-- ----------------------------
CREATE TABLE `inv_purchase_order_detail` (
  `ipo_id` varchar(20) NOT NULL,
  `ipod_item` varchar(20) NOT NULL,
  `ipod_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_purchase_req
-- ----------------------------
CREATE TABLE `inv_purchase_req` (
  `ipr_id` varchar(32) NOT NULL,
  `msup_id` varchar(32) DEFAULT NULL,
  `ipr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipr_operator` varchar(32) DEFAULT NULL,
  `ipr_note` text,
  `ipr_seq` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ipr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_receive_item
-- ----------------------------
CREATE TABLE `inv_receive_item` (
  `iri_id` varchar(20) NOT NULL,
  `ipo_id` varchar(20) DEFAULT NULL,
  `iri_date_accept` date DEFAULT NULL,
  `iri_operator` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`iri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_receive_item_detail
-- ----------------------------
CREATE TABLE `inv_receive_item_detail` (
  `iri_id` varchar(20) NOT NULL,
  `iri_item` varchar(20) NOT NULL,
  `iri_qty` int(11) NOT NULL,
  `iri_exp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_retur
-- ----------------------------
CREATE TABLE `inv_retur` (
  `ir_id` varchar(20) NOT NULL,
  `ir_supplier` varchar(20) NOT NULL,
  `ir_date_req` date NOT NULL,
  `ir_currency` varchar(20) DEFAULT NULL,
  `ir_vat` varchar(20) DEFAULT NULL,
  `ir_ppn` int(2) DEFAULT NULL,
  `ir_operator` varchar(50) NOT NULL,
  `ir_note` text,
  `ir_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ir_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for inv_retur_detail
-- ----------------------------
CREATE TABLE `inv_retur_detail` (
  `ir_id` varchar(255) NOT NULL,
  `ir_item` varchar(20) NOT NULL,
  `ir_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_bill
-- ----------------------------
CREATE TABLE `mst_bill` (
  `bill_id` varchar(10) NOT NULL,
  `modi_id` varchar(5) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bill_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_city
-- ----------------------------
CREATE TABLE `mst_city` (
  `mci_id` int(11) NOT NULL AUTO_INCREMENT,
  `mci_code` varchar(5) DEFAULT NULL,
  `mci_name` varchar(25) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mci_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_class
-- ----------------------------
CREATE TABLE `mst_class` (
  `mscl_id` int(11) NOT NULL,
  `mscl_name` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mscl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_country
-- ----------------------------
CREATE TABLE `mst_country` (
  `mco_id` int(11) NOT NULL AUTO_INCREMENT,
  `mco_code` varchar(5) DEFAULT NULL,
  `mco_name` varchar(25) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_currency
-- ----------------------------
CREATE TABLE `mst_currency` (
  `mc_id` varchar(50) NOT NULL,
  `mc_name` varchar(50) DEFAULT NULL,
  `mc_value` decimal(8,2) DEFAULT NULL,
  `mc_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_diagnosa
-- ----------------------------
CREATE TABLE `mst_diagnosa` (
  `diag_id` varchar(10) NOT NULL,
  `diag_name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`diag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_education
-- ----------------------------
CREATE TABLE `mst_education` (
  `med_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_name` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_employer
-- ----------------------------
CREATE TABLE `mst_employer` (
  `id_employe` int(11) NOT NULL AUTO_INCREMENT,
  `sd_nip` varchar(25) NOT NULL,
  `sd_type_user` int(2) DEFAULT NULL,
  `sd_name` varchar(100) NOT NULL,
  `sd_sex` varchar(255) DEFAULT NULL,
  `sd_place_of_birth` varchar(150) DEFAULT NULL,
  `sd_date_of_birth` varchar(32) DEFAULT NULL,
  `sd_age` varchar(32) DEFAULT NULL,
  `sd_blood_tp` varchar(255) DEFAULT NULL,
  `sd_address` text,
  `sd_rt_rw` varchar(10) DEFAULT NULL,
  `sd_reg_desa` varchar(50) DEFAULT NULL,
  `sd_reg_kec` varchar(50) DEFAULT NULL,
  `sd_reg_kab` varchar(100) DEFAULT NULL,
  `sd_reg_prov` varchar(100) DEFAULT NULL,
  `sd_citizen` varchar(100) DEFAULT NULL,
  `sd_marital_st` varchar(50) DEFAULT NULL,
  `sd_religion` varchar(25) DEFAULT NULL,
  `sd_education` varchar(100) DEFAULT NULL,
  `sd_occupation` varchar(100) DEFAULT NULL,
  `sd_telp` varchar(20) DEFAULT NULL,
  `sd_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sd_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sd_reg_street` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_employe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_family_relation
-- ----------------------------
CREATE TABLE `mst_family_relation` (
  `mfr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mfr_name` varchar(20) DEFAULT NULL,
  `modi_id` int(11) NOT NULL DEFAULT '0',
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mfr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_insurance
-- ----------------------------
CREATE TABLE `mst_insurance` (
  `ins_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ins_name` varchar(200) DEFAULT NULL,
  `modi_id` smallint(6) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ins_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_lab_treathment
-- ----------------------------
CREATE TABLE `mst_lab_treathment` (
  `ds_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ds_name` varchar(100) NOT NULL,
  `ds_paramedic_price` double(11,2) DEFAULT NULL,
  `ds_price` double(11,2) NOT NULL,
  `ds_status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ds_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_lab_treathment_detail
-- ----------------------------
CREATE TABLE `mst_lab_treathment_detail` (
  `ds_id` smallint(6) NOT NULL,
  `dsd_code` varchar(6) NOT NULL,
  `dsd_name` varchar(145) NOT NULL,
  `dsd_standart_value_male` varchar(20) NOT NULL,
  `dsd_standart_value_female` varchar(20) NOT NULL,
  `dsd_satuan` varchar(10) DEFAULT NULL,
  `dsd_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_marital_st
-- ----------------------------
CREATE TABLE `mst_marital_st` (
  `mms_id` int(11) NOT NULL AUTO_INCREMENT,
  `mms_name` varchar(20) NOT NULL DEFAULT '0',
  `modi_id` int(11) DEFAULT '0',
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_medical_anamnesa
-- ----------------------------
CREATE TABLE `mst_medical_anamnesa` (
  `ma_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ma_indication` varchar(45) DEFAULT NULL,
  `ma_filter` char(1) DEFAULT NULL,
  `modi_id` smallint(6) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pl_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_medical_objective
-- ----------------------------
CREATE TABLE `mst_medical_objective` (
  `mo_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `mo_indication` varchar(45) DEFAULT NULL,
  `mo_filter` char(1) DEFAULT NULL,
  `modi_id` smallint(6) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pl_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_medical_subjective
-- ----------------------------
CREATE TABLE `mst_medical_subjective` (
  `ms_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ms_indication` varchar(45) DEFAULT NULL,
  `ms_filter` char(1) DEFAULT NULL,
  `modi_id` smallint(6) DEFAULT NULL,
  `modi_datetime` time DEFAULT NULL,
  `pl_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_medicine
-- ----------------------------
CREATE TABLE `mst_medicine` (
  `mdcn_id` varchar(45) NOT NULL,
  `mdcn_name` varchar(100) DEFAULT NULL,
  `mdcn_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`mdcn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_nationality
-- ----------------------------
CREATE TABLE `mst_nationality` (
  `mna_id` int(11) NOT NULL AUTO_INCREMENT,
  `mna_name` varchar(45) DEFAULT NULL,
  `mod_id` int(11) DEFAULT NULL,
  `mod_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_occupation
-- ----------------------------
CREATE TABLE `mst_occupation` (
  `oc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mo_name` varchar(45) DEFAULT NULL,
  `mo_desc` varchar(45) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`oc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_payment_method
-- ----------------------------
CREATE TABLE `mst_payment_method` (
  `mpm_id` varchar(20) NOT NULL,
  `mpm_name` varchar(45) DEFAULT NULL,
  `mpm_bank_id` varchar(20) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mpm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_poly
-- ----------------------------
CREATE TABLE `mst_poly` (
  `pl_id` int(11) NOT NULL,
  `pl_name` varchar(45) DEFAULT NULL,
  `pl_description` text,
  `pl_status` varchar(45) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_province
-- ----------------------------
CREATE TABLE `mst_province` (
  `mpr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mpr_name` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mpr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_regency
-- ----------------------------
CREATE TABLE `mst_regency` (
  `mre_id` int(11) NOT NULL AUTO_INCREMENT,
  `mco_code` varchar(32) DEFAULT NULL,
  `mpr_id` int(11) DEFAULT NULL,
  `mre_name` varchar(50) DEFAULT NULL,
  `mre_capital` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=498 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_religion
-- ----------------------------
CREATE TABLE `mst_religion` (
  `mr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mr_name` varchar(20) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_room
-- ----------------------------
CREATE TABLE `mst_room` (
  `msro_id` int(11) NOT NULL,
  `mscl_id` int(11) DEFAULT NULL,
  `msro_name` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`msro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_shift
-- ----------------------------
CREATE TABLE `mst_shift` (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_nama` varchar(100) DEFAULT NULL,
  `shift_start` time DEFAULT NULL,
  `shift_end` time DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_study
-- ----------------------------
CREATE TABLE `mst_study` (
  `mst_id` int(11) NOT NULL,
  `mst_name` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_supplier
-- ----------------------------
CREATE TABLE `mst_supplier` (
  `msup_id` varchar(50) NOT NULL,
  `msup_name` varchar(50) DEFAULT NULL,
  `msup_address` text,
  `msup_province` varchar(50) DEFAULT NULL,
  `msup_city` varchar(50) DEFAULT NULL,
  `msup_zip_code` varchar(12) DEFAULT NULL,
  `msup_telp` varchar(14) DEFAULT NULL,
  `msup_fax` varchar(12) DEFAULT NULL,
  `msup_email` varchar(30) DEFAULT NULL,
  `msup_npwp` varchar(50) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_treathment
-- ----------------------------
CREATE TABLE `mst_treathment` (
  `treat_id` int(11) NOT NULL AUTO_INCREMENT,
  `treat_name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `poli` int(2) DEFAULT NULL,
  `treat_item_price` bigint(20) DEFAULT NULL,
  `treat_paramedic_price` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`treat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_type_inv
-- ----------------------------
CREATE TABLE `mst_type_inv` (
  `mtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `mtype_name` varchar(50) DEFAULT NULL,
  `mtype_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mtype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mst_type_user
-- ----------------------------
CREATE TABLE `mst_type_user` (
  `id_type_user` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_type_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for ptn_family
-- ----------------------------
CREATE TABLE `ptn_family` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sd_rekmed` varchar(10) DEFAULT NULL,
  `fm_name` varchar(50) DEFAULT NULL,
  `fm_sex` varchar(255) DEFAULT NULL,
  `fm_relation` varchar(20) DEFAULT NULL,
  `fm_address` text,
  `fm_telp` varchar(20) DEFAULT NULL,
  `fm_phone` varchar(20) DEFAULT NULL,
  `fm_rekmed` varchar(20) DEFAULT NULL,
  `fm_status` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for ptn_social_data
-- ----------------------------
CREATE TABLE `ptn_social_data` (
  `sd_rekmed` varchar(10) NOT NULL,
  `sd_name` varchar(100) NOT NULL,
  `sd_sex` varchar(255) DEFAULT NULL,
  `sd_place_of_birth` varchar(150) DEFAULT NULL,
  `sd_date_of_birth` varchar(32) DEFAULT NULL,
  `sd_age` varchar(32) DEFAULT NULL,
  `sd_blood_tp` varchar(255) DEFAULT NULL,
  `sd_address` text,
  `sd_rt_rw` varchar(10) DEFAULT NULL,
  `sd_reg_desa` varchar(50) DEFAULT NULL,
  `sd_reg_kec` varchar(50) DEFAULT NULL,
  `sd_reg_kab` varchar(100) DEFAULT NULL,
  `sd_reg_prov` varchar(100) DEFAULT NULL,
  `sd_citizen` varchar(100) DEFAULT NULL,
  `sd_marital_st` varchar(50) DEFAULT NULL,
  `sd_religion` varchar(25) DEFAULT NULL,
  `sd_education` varchar(100) DEFAULT NULL,
  `sd_occupation` varchar(100) DEFAULT NULL,
  `sd_telp` varchar(20) DEFAULT NULL,
  `sd_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sd_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sd_reg_street` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sd_rekmed`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sys_group
-- ----------------------------
CREATE TABLE `sys_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) DEFAULT NULL,
  `group_homebase` varchar(99) DEFAULT NULL,
  `group_status` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
CREATE TABLE `sys_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent` int(11) DEFAULT '0',
  `menu_url` varchar(255) DEFAULT NULL,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_status` int(11) DEFAULT '1',
  `modul_id` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sys_menu_role
-- ----------------------------
CREATE TABLE `sys_menu_role` (
  `menu_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sys_module
-- ----------------------------
CREATE TABLE `sys_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) DEFAULT NULL,
  `module_url` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sys_module_role
-- ----------------------------
CREATE TABLE `sys_module_role` (
  `module_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
CREATE TABLE `sys_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_status` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_diagnosa_treathment
-- ----------------------------
CREATE TABLE `trx_diagnosa_treathment` (
  `mdc_id` varchar(45) DEFAULT NULL,
  `dat_id` varchar(45) NOT NULL,
  `modi_id` smallint(6) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_diagnosa_treathment_detail
-- ----------------------------
CREATE TABLE `trx_diagnosa_treathment_detail` (
  `mdc_id` varchar(45) NOT NULL,
  `dat_id` varchar(45) NOT NULL,
  `dat_case` varchar(10) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dat_diag` varchar(45) DEFAULT NULL,
  `dat_treat` int(11) DEFAULT NULL,
  `dat_note` text,
  `dat_paramedic_price` int(11) DEFAULT NULL,
  `dat_item_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_direct_buy
-- ----------------------------
CREATE TABLE `trx_direct_buy` (
  `visit_id` varchar(10) NOT NULL,
  `tdb_number` varchar(20) NOT NULL,
  `tdb_operator` int(11) NOT NULL,
  `tdb_note` text,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tdb_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_direct_buy_detail
-- ----------------------------
CREATE TABLE `trx_direct_buy_detail` (
  `tdb_number` varchar(20) DEFAULT NULL,
  `tdb_item` varchar(20) DEFAULT NULL,
  `tdb_qty` int(11) DEFAULT NULL,
  `tdb_price_per_unit` double(10,2) DEFAULT NULL,
  `tdb_price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_dokter_fee
-- ----------------------------
CREATE TABLE `trx_dokter_fee` (
  `tdf_id` int(11) NOT NULL AUTO_INCREMENT,
  `dr_id` int(11) NOT NULL,
  `dr_fee` double(10,2) NOT NULL,
  `tdf_status` char(1) NOT NULL DEFAULT '1',
  `modi_id` int(11) NOT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tdf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_dr_schedule
-- ----------------------------
CREATE TABLE `trx_dr_schedule` (
  `sch_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dr_id` bigint(20) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `day` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Ahad') DEFAULT NULL,
  `sch_shift` varchar(45) NOT NULL,
  `pl_id` int(11) NOT NULL,
  `modi_id` smallint(6) NOT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_lab_queue
-- ----------------------------
CREATE TABLE `trx_lab_queue` (
  `lab_queue_id` varchar(8) NOT NULL,
  `sd_rekmed` varchar(10) NOT NULL,
  `lab_queue_no` int(11) DEFAULT NULL,
  `lab_queue_datetime` timestamp NULL DEFAULT NULL,
  `operator_id` bigint(20) DEFAULT NULL,
  `dr_id` bigint(20) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_queue_status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lab_queue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_lab_treathment
-- ----------------------------
CREATE TABLE `trx_lab_treathment` (
  `lab_queue_id` varchar(45) NOT NULL,
  `trx_ds_id` varchar(45) NOT NULL,
  `ds_id` smallint(6) NOT NULL,
  `ds_name` varchar(100) DEFAULT NULL,
  `ds_paramedic_price` double(11,2) NOT NULL DEFAULT '0.00',
  `ds_price` double(11,2) NOT NULL,
  PRIMARY KEY (`trx_ds_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_lab_treathment_detail
-- ----------------------------
CREATE TABLE `trx_lab_treathment_detail` (
  `lab_queue_id` varchar(45) DEFAULT NULL,
  `trx_ds_id` varchar(45) DEFAULT NULL,
  `dsupport_code` varchar(6) DEFAULT NULL,
  `dsupport_name` varchar(145) DEFAULT NULL,
  `dsupport_value` varchar(145) DEFAULT NULL,
  `dsupport_value_image` varchar(225) DEFAULT NULL,
  `dsupport_standart_value` varchar(145) DEFAULT NULL,
  `dsupport_satuan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_medical
-- ----------------------------
CREATE TABLE `trx_medical` (
  `mdc_id` varchar(10) NOT NULL DEFAULT '0',
  `sd_rekmed` varchar(10) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pl_id` smallint(6) DEFAULT NULL,
  `dr_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`mdc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_medical_anamnesa
-- ----------------------------
CREATE TABLE `trx_medical_anamnesa` (
  `ma_id` int(11) NOT NULL AUTO_INCREMENT,
  `mdc_id` varchar(10) NOT NULL,
  `ma_subjective` varchar(255) NOT NULL,
  `ma_objective` varchar(255) DEFAULT NULL,
  `ma_value` varchar(255) DEFAULT NULL,
  `ma_desc` text NOT NULL,
  `modi_id` int(11) NOT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_medical_lab
-- ----------------------------
CREATE TABLE `trx_medical_lab` (
  `mdc_id` varchar(45) NOT NULL,
  `lab_queue_id` varchar(8) NOT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_medical_objective
-- ----------------------------
CREATE TABLE `trx_medical_objective` (
  `mo_id` int(11) NOT NULL AUTO_INCREMENT,
  `mdc_id` varchar(10) NOT NULL,
  `mo_value` varchar(45) DEFAULT NULL,
  `mo_desc` text,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_medical_ptn_now
-- ----------------------------
CREATE TABLE `trx_medical_ptn_now` (
  `mdc_id` varchar(10) NOT NULL,
  `ptn_medical_weight` int(11) DEFAULT NULL,
  `ptn_medical_height` int(11) DEFAULT NULL,
  `ptn_medical_blod_sy` int(11) DEFAULT NULL,
  `ptn_medical_blod_ds` int(11) DEFAULT NULL,
  `ptn_medical_kesadaran` varchar(50) DEFAULT NULL,
  `ptn_medical_nadi` int(11) DEFAULT NULL,
  `ptn_medical_heartrate` int(11) DEFAULT NULL,
  `ptn_medical_temperatur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_medical_subjective
-- ----------------------------
CREATE TABLE `trx_medical_subjective` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `mdc_id` varchar(10) NOT NULL,
  `ms_value` varchar(45) DEFAULT NULL,
  `ms_desc` text,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_queue_agent
-- ----------------------------
CREATE TABLE `trx_queue_agent` (
  `que_id` varchar(8) NOT NULL,
  `que_tp` varchar(15) NOT NULL,
  `agent_name` varchar(100) NOT NULL,
  `agent_relationship` varchar(20) DEFAULT NULL,
  `agent_sex` varchar(1) DEFAULT NULL,
  `agent_address` text,
  `agent_telp` varchar(50) DEFAULT NULL,
  `agent_id_no` varchar(100) NOT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_queue_outpatient
-- ----------------------------
CREATE TABLE `trx_queue_outpatient` (
  `queo_id` varchar(8) NOT NULL,
  `sd_rekmed` varchar(10) NOT NULL,
  `queo_no` int(11) NOT NULL,
  `queo_datetime` timestamp NULL DEFAULT NULL,
  `dr_id` bigint(20) NOT NULL,
  `pl_id` int(11) NOT NULL,
  `sch_id` varchar(20) NOT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `queo_status` smallint(6) DEFAULT '1',
  PRIMARY KEY (`queo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_recipe
-- ----------------------------
CREATE TABLE `trx_recipe` (
  `mdc_id` varchar(45) DEFAULT NULL,
  `recipe_id` varchar(45) NOT NULL,
  `recipe_paramedic_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_recipe_detail
-- ----------------------------
CREATE TABLE `trx_recipe_detail` (
  `mdc_id` varchar(45) DEFAULT NULL,
  `recipe_id` varchar(45) NOT NULL,
  `recipe_medicine` varchar(10) DEFAULT NULL,
  `recipe_rule` varchar(100) DEFAULT NULL,
  `recipe_note` varchar(255) DEFAULT NULL,
  `recipe_qty` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `recipe_number` smallint(6) DEFAULT NULL,
  `recipe_item_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_reference
-- ----------------------------
CREATE TABLE `trx_reference` (
  `mdc_id` varchar(10) DEFAULT NULL,
  `ref_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ref_date` char(2) DEFAULT NULL,
  `ref_date_start` date DEFAULT NULL,
  `ref_date_end` date DEFAULT NULL,
  `ref_description` text,
  `ref_category` varchar(100) DEFAULT NULL,
  `modi_id` smallint(6) DEFAULT NULL,
  `modi_datetime` time DEFAULT NULL,
  `ref_number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_reg_poli
-- ----------------------------
CREATE TABLE `trx_reg_poli` (
  `rp_id` int(11) NOT NULL,
  `pl_id` int(11) DEFAULT NULL,
  `sd_rekmed` varchar(10) DEFAULT NULL,
  `dr_id` int(11) DEFAULT NULL,
  `rp_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_visit
-- ----------------------------
CREATE TABLE `trx_visit` (
  `visit_id` varchar(20) NOT NULL,
  `visit_rekmed` varchar(10) NOT NULL,
  `visit_type` enum('rajal','ranap','lab','pembelian umum') NOT NULL,
  `visit_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visit_out` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `visit_status` char(1) NOT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_visit_bill
-- ----------------------------
CREATE TABLE `trx_visit_bill` (
  `tvb_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` varchar(255) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `ins_id` int(2) DEFAULT NULL,
  `ins_no` varchar(20) DEFAULT NULL,
  `patient_pay` double(11,2) DEFAULT NULL,
  `total_price` double(11,2) DEFAULT NULL,
  `note` text,
  `payment_status` char(1) DEFAULT NULL,
  `modi_id` char(1) DEFAULT NULL,
  `modi_datetime` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tvb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trx_visit_bill_detail
-- ----------------------------
CREATE TABLE `trx_visit_bill_detail` (
  `tvb_id` int(11) NOT NULL,
  `bill_type` int(11) NOT NULL,
  `desc` text,
  `price` double(10,2) DEFAULT NULL,
  `paramedic_price` double(10,2) DEFAULT NULL,
  `other_price` double(10,2) DEFAULT NULL,
  `total_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- View structure for v_data_patient
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_data_patient` AS select `psd`.`sd_rekmed` AS `sd_rekmed`,`psd`.`sd_name` AS `sd_name`,`psd`.`sd_age` AS `sd_age`,`psd`.`sd_blood_tp` AS `sd_blood_tp`,`psd`.`sd_address` AS `sd_address` from `ptn_social_data` `psd`;

-- ----------------------------
-- View structure for v_detail_diagnosa
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_diagnosa` AS select `tdt`.`dat_id` AS `dat_id`,`tdt`.`mdc_id` AS `mdc_id`,`tdtd`.`dat_diag` AS `dat_diag`,`tdtd`.`dat_treat` AS `dat_treat`,`tdtd`.`dat_case` AS `dat_case`,`tdtd`.`dat_paramedic_price` AS `dat_paramedic_price`,`tdtd`.`dat_item_price` AS `dat_item_price`,`mt`.`treat_name` AS `treat_name`,`md`.`diag_name` AS `diag_name` from (((`trx_diagnosa_treathment` `tdt` join `trx_diagnosa_treathment_detail` `tdtd` on((`tdt`.`dat_id` = `tdtd`.`dat_id`))) join `mst_treathment` `mt` on((`tdtd`.`dat_treat` = `mt`.`treat_id`))) join `mst_diagnosa` `md` on((`tdtd`.`dat_diag` = `md`.`diag_id`)));

-- ----------------------------
-- View structure for v_detail_resep
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_resep` AS select `tr`.`mdc_id` AS `mdc_id`,`tr`.`recipe_id` AS `recipe_id`,`trd`.`recipe_medicine` AS `recipe_medicine`,`im`.`im_name` AS `im_name`,`trd`.`recipe_qty` AS `recipe_qty`,`trd`.`recipe_rule` AS `recipe_rule`,`tr`.`recipe_paramedic_price` AS `recipe_paramedic_price`,`trd`.`recipe_item_price` AS `recipe_item_price`,`im`.`im_item_price` AS `im_item_price`,`im`.`im_unit` AS `im_unit` from ((`trx_recipe` `tr` join `trx_recipe_detail` `trd` on((`tr`.`mdc_id` = `trd`.`mdc_id`))) join `inv_item_master` `im` on((`trd`.`recipe_medicine` = `im`.`im_id`)));

-- ----------------------------
-- View structure for v_medical_obat
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_medical_obat` AS select `tm`.`mdc_id` AS `mdc_id`,`tm`.`sd_rekmed` AS `sd_rekmed`,`trp`.`recipe_medicine` AS `recipe_medicine`,`trp`.`recipe_qty` AS `recipe_qty`,`trp`.`recipe_rule` AS `recipe_rule` from (`trx_medical` `tm` join `trx_recipe_detail` `trp` on((`trp`.`mdc_id` = `tm`.`mdc_id`)));

-- ----------------------------
-- View structure for v_patient
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_patient` AS select `ptn_social_data`.`sd_rekmed` AS `ptn_rekmed`,`ptn_social_data`.`sd_name` AS `ptn_name`,`ptn_social_data`.`sd_address` AS `ptn_address`,`ptn_social_data`.`sd_reg_date` AS `ptn_reg_date` from `ptn_social_data`;

-- ----------------------------
-- View structure for v_queue_poli
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_queue_poli` AS select `psc`.`sd_rekmed` AS `sd_rekmed`,`psc`.`sd_name` AS `sd_name`,`psc`.`sd_sex` AS `sd_sex`,`psc`.`sd_place_of_birth` AS `sd_place_of_birth`,`psc`.`sd_date_of_birth` AS `sd_date_of_birth`,`psc`.`sd_age` AS `sd_age`,`psc`.`sd_blood_tp` AS `sd_blood_tp`,`psc`.`sd_address` AS `sd_address`,`psc`.`sd_rt_rw` AS `sd_rt_rw`,`psc`.`sd_reg_desa` AS `sd_reg_desa`,`psc`.`sd_reg_kec` AS `sd_reg_kec`,`psc`.`sd_reg_kab` AS `sd_reg_kab`,`psc`.`sd_reg_prov` AS `sd_reg_prov`,`psc`.`sd_citizen` AS `sd_citizen`,`psc`.`sd_marital_st` AS `sd_marital_st`,`psc`.`sd_religion` AS `sd_religion`,`psc`.`sd_education` AS `sd_education`,`psc`.`sd_occupation` AS `sd_occupation`,`psc`.`sd_telp` AS `sd_telp`,`psc`.`sd_reg_date` AS `sd_reg_date`,`psc`.`sd_status` AS `sd_status`,`psc`.`modi_id` AS `modi_id`,`psc`.`modi_datetime` AS `modi_datetime`,`psc`.`sd_reg_street` AS `sd_reg_street`,`tqo`.`pl_id` AS `pl_id`,`tqo`.`queo_id` AS `queo_id`,`tqo`.`queo_status` AS `queo_status`,`tqo`.`dr_id` AS `dr_id` from (`trx_queue_outpatient` `tqo` join `ptn_social_data` `psc` on((`tqo`.`sd_rekmed` = `psc`.`sd_rekmed`)));

-- ----------------------------
-- View structure for v_supplier
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_supplier` AS select `msup`.`msup_id` AS `msup_id`,`msup`.`msup_name` AS `msup_name`,`msup`.`msup_address` AS `msup_address` from `mst_supplier` `msup`;

-- ----------------------------
-- View structure for v_transaksi_detail_resep
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_detail_resep` AS select `tr`.`mdc_id` AS `mdc_id`,`tr`.`recipe_id` AS `recipe_id`,`trd`.`recipe_medicine` AS `recipe_medicine`,`im`.`im_name` AS `im_name`,`trd`.`recipe_qty` AS `recipe_qty`,`trd`.`recipe_rule` AS `recipe_rule`,`tr`.`recipe_paramedic_price` AS `recipe_paramedic_price`,`trd`.`recipe_item_price` AS `recipe_item_price`,`im`.`im_item_price` AS `im_item_price`,`im`.`im_unit` AS `im_unit` from ((`trx_recipe` `tr` join `trx_recipe_detail` `trd` on((`tr`.`mdc_id` = `trd`.`mdc_id`))) join `inv_item_master` `im` on((`trd`.`recipe_medicine` = `im`.`im_id`)));

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `com_code` VALUES ('1', 'format_po', 'PO-', 'null', 'null', '1');
INSERT INTO `com_code` VALUES ('2', 'format_resep', 'RS-', 'null', 'null', '1');
INSERT INTO `com_code` VALUES ('3', 'format_diagnosa', 'DA-', 'null', 'null', '1');
INSERT INTO `com_code` VALUES ('4', 'jasa_resep', '0', null, null, '1');
INSERT INTO `com_menu` VALUES ('1', '1', 'pendaftaran baru', 'pendaftaran/pendaftaran_baru', null, '', '1');
INSERT INTO `com_menu` VALUES ('2', '1', 'pendaftaran rawat jalan', 'pendaftaran/pendaftaran_rawat_jalan', null, '', '1');
INSERT INTO `com_menu` VALUES ('3', '1', 'pendaftaran rawat inap', 'pendaftaran/pendaftaran_rawat_inap', null, '', '1');
INSERT INTO `com_menu` VALUES ('4', '1', 'IGD', 'pendaftaran/IGD', null, '', '1');
INSERT INTO `com_menu` VALUES ('5', '2', 'informasi pasien', 'pelayanan_informasi/informasi_pasien', null, '', '1');
INSERT INTO `com_menu` VALUES ('6', '2', 'jadwal dokter', 'pelayanan_informasi/jadwal_dokter', null, '', '1');
INSERT INTO `com_menu` VALUES ('7', '2', 'informasi kamar', 'pelayanan_informasi/informasi_kamar', null, '', '1');
INSERT INTO `com_menu` VALUES ('8', '2', 'informasi paket', 'pelayanan_informasi/informasi_paket', null, '', '1');
INSERT INTO `com_menu` VALUES ('9', '3', 'poli gigi', 'rawat_jalan/poli_gigi', null, '', '1');
INSERT INTO `com_menu` VALUES ('10', '3', 'poli tulang', 'rawat_jalan/poli_tulang', null, '', '1');
INSERT INTO `com_menu` VALUES ('11', '4', 'rawat jalan', 'kasir/rawat_jalan', null, '', '1');
INSERT INTO `com_menu` VALUES ('12', '4', 'IGD', 'kasir/IGD', null, '', '1');
INSERT INTO `com_menu` VALUES ('13', '4', 'rawat inap', 'kasir/rawat_inap', null, '', '1');
INSERT INTO `com_menu` VALUES ('14', '5', 'resep pasien', 'apotek/resep_pasien', null, '', '1');
INSERT INTO `com_menu` VALUES ('15', '5', 'pembelian lansung', 'apotek/pembelian_langsung', null, '', '1');
INSERT INTO `com_menu` VALUES ('16', '6', 'purchase request', 'gudang_farmasi/purchase_request', null, '', '1');
INSERT INTO `com_menu` VALUES ('17', '6', 'purchase order', 'gudang_farmasi/purchase_order', null, '', '1');
INSERT INTO `com_menu` VALUES ('18', '6', 'receive item', 'gudang_farmasi/receive_item', null, '', '1');
INSERT INTO `com_menu` VALUES ('19', '6', 'retur', 'gudang_farmasi/retur', null, '', '1');
INSERT INTO `com_menu` VALUES ('20', '6', 'stok', 'gudang_farmasi/stok', null, '', '1');
INSERT INTO `com_menu` VALUES ('21', '6', 'transfer item', 'gudang_farmasi/transfer_item', null, '', '1');
INSERT INTO `com_menu` VALUES ('22', '7', 'data dokter', 'master/data_dokter', null, '', '1');
INSERT INTO `com_menu` VALUES ('23', '7', 'data tindakan', 'master/data_tindakan', null, '', '1');
INSERT INTO `com_menu` VALUES ('24', '7', 'data diagnosa', 'master/data_diagnosa', null, null, '1');
INSERT INTO `com_menu` VALUES ('25', '7', 'data obat', 'master/data_obat', null, null, '1');
INSERT INTO `com_menu` VALUES ('26', '7', 'data dokter', 'master/data_dokter', null, '', '1');
INSERT INTO `com_menu` VALUES ('27', '7', 'data tindakan', 'master/data_tindakan', null, '', '1');
INSERT INTO `com_menu` VALUES ('28', '7', 'data diagnosa', 'master/data_diagnosa', null, null, '1');
INSERT INTO `com_menu` VALUES ('29', '7', 'data obat', 'master/data_obat', null, null, '1');
INSERT INTO `com_menu` VALUES ('30', '7', 'data pegawai', 'master/data_pegawai', null, null, '1');
INSERT INTO `com_menu` VALUES ('31', '7', 'data user', 'master/data_user', null, null, '1');
INSERT INTO `com_modul` VALUES ('1', 'pelayanan informasi', 'pelayanan_informasi', '', '1');
INSERT INTO `com_modul` VALUES ('2', 'pendaftaran', 'pendaftaran', '', '1');
INSERT INTO `com_modul` VALUES ('3', 'rawat jalan', 'rawat_jalan', '', '1');
INSERT INTO `com_modul` VALUES ('4', 'kasir', 'kasir', '', '1');
INSERT INTO `com_modul` VALUES ('5', 'apotek', 'apotek', '', '1');
INSERT INTO `com_modul` VALUES ('6', 'gudang farmasi', 'gudang_farmasi', '', '0');
INSERT INTO `com_modul` VALUES ('8', 'lab', 'lab/antrian', null, '1');
INSERT INTO `com_modul` VALUES ('9', 'pelaporan', 'pelaporan', null, '1');
INSERT INTO `com_modul` VALUES ('10', 'manajemen data', 'master', '', '1');
INSERT INTO `com_modul` VALUES ('11', 'gudang farmasi', 'gudang', null, '1');
INSERT INTO `com_modul` VALUES ('12', 'rawat inap', 'rawat_inap', null, '1');
INSERT INTO `com_user` VALUES ('1', 'jike', '49deebdfb953a2f52e2ac0931cf29b72', 'jike', null, '1', 'Laki - Laki', 'jike@yahoo.com', '2014-06-21 22:28:24', '1');
INSERT INTO `com_user_tipe` VALUES ('1', 'super_admin', 'super_admin', 'home', '1');
INSERT INTO `com_user_tipe` VALUES ('24', 'admin', 'admin', 'admin', '1');
INSERT INTO `inv_item_master` VALUES ('1', 'Tablet/Kaplet', '9v', null, null, '200.00', '200.00', '10.00', null, null, null, '1', null, '2014-07-19 05:55:07', null, null);
INSERT INTO `inv_item_master` VALUES ('2', 'Unit', 'Abbocath', null, null, '10000.00', '10000.00', '10.00', null, null, null, '1', null, '2014-07-19 05:55:08', null, null);
INSERT INTO `inv_item_stok` VALUES ('1', 'RI-14070003', '2', '0', '2014-09-18');
INSERT INTO `inv_item_stok` VALUES ('2', 'RI-14070004', '2', '2', '2015-02-28');
INSERT INTO `inv_item_stok` VALUES ('3', 'RI-14070004', '1', '0', '2014-08-28');
INSERT INTO `inv_item_stok` VALUES ('4', 'RI-14070005', '2', '0', '2014-10-16');
INSERT INTO `inv_item_stok` VALUES ('5', 'RI-14070005', '1', '3', '2014-10-16');
INSERT INTO `inv_item_stok` VALUES ('6', 'RI-14070006', '2', '0', '2014-08-16');
INSERT INTO `inv_item_stok` VALUES ('7', 'RI-14070007', '2', '0', '2014-10-31');
INSERT INTO `inv_item_stok` VALUES ('8', 'RI-14070008', '2', '20', '2014-11-24');
INSERT INTO `inv_mst_pos` VALUES ('', null, null, null, null, '2014-07-06 23:20:38', null);
INSERT INTO `inv_purchase_order` VALUES ('PO-14070001', 'KF', '2014-07-17', '', 'exclude', '10.00', 'RS Intan Husada', '2014-07-19', 'jike', '-', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070002', 'KF', '2014-07-17', '', 'exclude', '10.00', 'RS Intan Husada', '2014-07-19', 'jike', 'Pembelian berdasarkan stok yang sudah berkurang atau bahkan kurang dari yang seharusnya ada di salam stok minima', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070008', 'KF', '2014-07-17', '', '', '10.00', 'RS IH', '0000-00-00', 'jike', '-', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070009', 'KF', '2014-07-17', '', '', '10.00', 'RSIH jalan gatot subroto', '2014-07-18', 'jike', '-', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070010', 'KF', '2014-07-19', '', 'exclude', '10.00', null, '2014-07-21', 'jike', 'harus cepat', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070011', 'KF', '2014-07-22', '', '', '10.00', null, '2014-07-26', 'jike', '-', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070012', 'KF', '2014-07-27', '', '', '10.00', null, '2014-08-07', 'jike', 'Diharapkan untuk expired date nya yang agak lama', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070013', 'KF', '2014-07-27', '', '', '10.00', null, '2014-07-27', 'jike', '-', '1');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070014', 'KF', '2014-07-27', '', '', '10.00', null, '2014-07-30', 'jike', '-', '0');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070015', 'KF', '2014-07-27', '', '', '10.00', null, '2014-07-29', 'jike', '-', '0');
INSERT INTO `inv_purchase_order` VALUES ('PO-14070016', 'KF', '2014-07-27', '', '', '10.00', null, '2014-07-29', 'jike', '-', '0');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070002', 'OB1', '10');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070008', 'OB1', '10');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070009', 'OB1', '10');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070010', '2', '100');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070011', '2', '2');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070013', '2', '3');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070014', '1', '5');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070015', '2', '5');
INSERT INTO `inv_purchase_order_detail` VALUES ('PO-14070016', '2', '3');
INSERT INTO `inv_purchase_req` VALUES ('PR-14070001', '', '0000-00-00 00:00:00', 'jike', '', null, null, '0000-00-00 00:00:00');
INSERT INTO `inv_receive_item` VALUES ('RI-14070001', 'PO-14070001', '2014-07-18', 'jike');
INSERT INTO `inv_receive_item` VALUES ('RI-14070002', 'PO-14070010', '2014-07-19', 'jike');
INSERT INTO `inv_receive_item` VALUES ('RI-14070003', 'PO-14070002', '2014-07-22', 'jike');
INSERT INTO `inv_receive_item` VALUES ('RI-14070004', 'PO-14070008', '2014-07-22', 'jike');
INSERT INTO `inv_receive_item` VALUES ('RI-14070005', 'PO-14070009', '2014-07-22', 'jike');
INSERT INTO `inv_receive_item` VALUES ('RI-14070006', 'PO-14070011', '2014-07-22', 'jike');
INSERT INTO `inv_receive_item` VALUES ('RI-14070007', 'PO-14070012', '2014-07-28', 'jike');
INSERT INTO `inv_receive_item` VALUES ('RI-14070008', 'PO-14070013', '2014-07-29', 'jike');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070001', 'OB1', '10', '2014-07-31');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070001', 'OB2', '10', '2014-09-19');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070002', '2', '50', '2015-02-19');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070003', '2', '10', '2014-09-26');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070004', '2', '10', '2015-02-28');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070004', '1', '10', '2015-02-28');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070005', '2', '10', '2014-10-16');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070005', '1', '11', '2014-10-16');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070006', '2', '2', '1970-01-01');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070007', '2', '10', '2014-10-31');
INSERT INTO `inv_receive_item_detail` VALUES ('RI-14070008', '2', '50', '2014-10-24');
INSERT INTO `inv_retur` VALUES ('RE-14070001', 'KF', '2014-07-22', null, null, null, 'jike', 'Catatan, banyak inventory yang dari kimia farma yang expiret', '1');
INSERT INTO `inv_retur` VALUES ('RE-14070002', 'KF', '2014-07-22', 'IDR', '', '10', 'jike', 'catatan', '1');
INSERT INTO `inv_retur` VALUES ('RE-14070003', 'KF', '2014-07-22', 'IDR', '', '10', 'jike', '-', '1');
INSERT INTO `inv_retur` VALUES ('RE-14070004', 'KF', '2014-07-22', 'IDR', '', '10', 'jike', '-', '1');
INSERT INTO `inv_retur` VALUES ('RE-14070005', 'KF', '2014-07-22', 'IDR', '', '10', 'jike', '-', '1');
INSERT INTO `inv_retur` VALUES ('RE-14080006', 'KF', '2014-08-02', 'IDR', '', '10', 'jike', '-', '1');
INSERT INTO `inv_retur_detail` VALUES ('RE-14070002', '2', '10');
INSERT INTO `inv_retur_detail` VALUES ('RE-14070002', '1', '10');
INSERT INTO `inv_retur_detail` VALUES ('RE-14070003', '2', '2');
INSERT INTO `inv_retur_detail` VALUES ('RE-14070003', '1', '2');
INSERT INTO `inv_retur_detail` VALUES ('RE-14070004', '2', '5');
INSERT INTO `inv_retur_detail` VALUES ('RE-14070005', '2', '5');
INSERT INTO `inv_retur_detail` VALUES ('RE-14080006', '2', '3');
INSERT INTO `mst_bill` VALUES ('1', null, '2014-06-21 22:43:02', 'Biaya Perawatan');
INSERT INTO `mst_bill` VALUES ('2', '', '2014-06-21 22:43:02', 'PPPK/Poli Bedah');
INSERT INTO `mst_bill` VALUES ('3', null, '2014-06-21 22:43:02', 'Biaya Makan');
INSERT INTO `mst_bill` VALUES ('4', null, '2014-06-21 22:43:02', 'Obat-obat infus dll');
INSERT INTO `mst_bill` VALUES ('5', null, '2014-06-21 22:43:02', 'Obat dan Resep');
INSERT INTO `mst_bill` VALUES ('6', null, '2014-06-21 22:43:02', 'Tindakan');
INSERT INTO `mst_bill` VALUES ('7', null, '2014-07-29 17:23:41', 'Laboratorium');
INSERT INTO `mst_city` VALUES ('3', 'ID', 'Bali', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('4', 'ID', 'Yogyakarta-Magelang', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('5', 'ID', 'Bali-Manggis', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('6', 'ID', 'Lombok-Mataram', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('7', 'ID', 'Ambon', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('8', 'ID', 'Anyer', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('9', 'ID', 'Banjarmasin', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('10', 'ID', 'Bandung', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('11', 'ID', 'Bintan Island', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('12', 'ID', 'Blitar', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('13', 'ID', 'Bali-Negara', null, '2014-06-21 22:43:41');
INSERT INTO `mst_city` VALUES ('14', 'ID', 'Banyuwangi', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('15', 'ID', 'Bogor', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('16', 'ID', 'Balikpapan', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('17', 'ID', 'Batam Island', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('18', 'ID', 'Bukittinggi', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('19', 'ID', 'Cirebon', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('20', 'ID', 'Cikarang', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('21', 'ID', 'Bali-Canggu', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('22', 'ID', 'Bali-Denpasar', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('23', 'ID', 'Jambi', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('24', 'ID', 'Jayapura', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('25', 'ID', 'Bali-Candi Dasa', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('26', 'ID', 'Garut', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('27', 'ID', 'Bali-Gianyar', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('28', 'ID', 'Bali-Jimbaran Bay', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('29', 'ID', 'Jakarta', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('30', 'ID', 'Kendari', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('31', 'ID', 'Bali-Kerobokan', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('32', 'ID', 'Ketapang', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('33', 'ID', 'Bali-Kuta Beach', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('34', 'ID', 'Bali-Legian Beach', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('35', 'ID', 'Bandung-Lembang', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('36', 'ID', 'Lembongan Island', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('37', 'ID', 'Lombok', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('38', 'ID', 'Malang', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('39', 'ID', 'Lombok-Medana Beach', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('40', 'ID', 'Medan', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('41', 'ID', 'Manokwari', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('42', 'ID', 'Manado', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('43', 'ID', 'Moyo Island', null, '2014-06-21 22:43:42');
INSERT INTO `mst_city` VALUES ('44', 'ID', 'Bali-Nusa Dua', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('45', 'ID', 'Pekalongan', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('46', 'ID', 'Bali-Pekutatan', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('47', 'ID', 'Pelabuhan Ratu', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('48', 'ID', 'Bangka - Pangkal Pinang', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('49', 'ID', 'Pekanbaru', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('50', 'ID', 'Palembang', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('51', 'ID', 'Palu', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('52', 'ID', 'Pontianak', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('53', 'ID', 'Parapat', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('54', 'ID', 'Pasuruan', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('55', 'ID', 'Lombok - Putri Nyale', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('56', 'ID', 'Bali-Sanur Beach', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('57', 'ID', 'Lombok - Putri Nyale', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('58', 'ID', 'Lombok-Senggigi', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('59', 'ID', 'Bali-Seminyak', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('60', 'ID', 'Solo', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('61', 'ID', 'Samarinda', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('62', 'ID', 'Surabaya', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('63', 'ID', 'Subang', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('64', 'ID', 'Sungailiat', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('65', 'ID', 'Bali-Tabanan', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('66', 'ID', 'Tangerang', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('67', 'ID', 'Tanjung Tabalong', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('68', 'ID', 'Bandar Lampung', null, '2014-06-21 22:43:43');
INSERT INTO `mst_city` VALUES ('69', 'ID', 'Bali-Uluwatu', null, '2014-06-21 22:43:44');
INSERT INTO `mst_city` VALUES ('70', 'ID', 'Wamena', null, '2014-06-21 22:43:44');
INSERT INTO `mst_city` VALUES ('71', 'ID', 'Yogyakarta-Borobudur', null, '2014-06-21 22:43:44');
INSERT INTO `mst_city` VALUES ('72', 'ID', 'Yogyakarta', null, '2014-06-21 22:43:44');
INSERT INTO `mst_country` VALUES ('1', 'AD', 'Andorra', null, '2014-06-21 22:44:17');
INSERT INTO `mst_country` VALUES ('3', 'AG', 'Antigua and Barbuda', null, '2014-06-21 22:44:17');
INSERT INTO `mst_country` VALUES ('4', 'AL', 'Albania', null, '2014-06-21 22:44:17');
INSERT INTO `mst_country` VALUES ('5', 'AM', 'Armenia', null, '2014-06-21 22:44:17');
INSERT INTO `mst_country` VALUES ('6', 'AN', 'Netherlands Antilles', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('7', 'AR', 'Argentina', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('8', 'AT', 'Austria', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('9', 'AU', 'Australia', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('10', 'AW', 'Aruba', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('11', 'AZ', 'Azerbaijan', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('12', 'BA', 'Bosnia Herzegovina', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('13', 'BB', 'Barbados', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('14', 'BE', 'Belgium', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('15', 'BG', 'Bulgaria', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('16', 'BH', 'Bahrain', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('17', 'BJ', 'Benin', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('18', 'BM', 'Bermuda', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('19', 'BN', 'Brunei Darussalam', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('21', 'BO', 'Bolivia', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('22', 'BR', 'Brazil', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('23', 'BS', 'Bahamas', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('24', 'BW', 'Botswana', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('25', 'BY', 'Belarus', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('26', 'CA', 'Canada', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('27', 'CD', 'Congo (Democratic Republi', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('28', 'CG', 'Congo (Republic of)', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('29', 'CH', 'Switzerland', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('30', 'CK', 'Cook Islands', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('31', 'CL', 'Chile', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('32', 'CM', 'Cameroon', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('33', 'CN', 'China', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('34', 'CO', 'Colombia', null, '2014-06-21 22:44:18');
INSERT INTO `mst_country` VALUES ('35', 'CR', 'Costa Rica', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('36', 'CU', 'Cuba', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('37', 'CY', 'Cyprus', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('38', 'CZ', 'Czech Republic', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('39', 'DE', 'Germany', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('40', 'DK', 'Denmark', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('41', 'DO', 'Dominican Republic', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('42', 'EC', 'Ecuador', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('43', 'EE', 'Estonia', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('44', 'EG', 'Egypt', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('45', 'ES', 'Spain', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('46', 'ET', 'Ethiopia', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('47', 'FI', 'Finland', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('48', 'FJ', 'Fiji', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('49', 'FM', 'Micronesia', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('50', 'FR', 'France', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('51', 'GA', 'Gabon', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('52', 'GB', 'United Kingdom', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('53', 'GD', 'Grenada', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('54', 'GE', 'Georgia', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('55', 'GI', 'Gibraltar', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('56', 'GL', 'Greenland', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('57', 'GM', 'Gambia', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('58', 'GP', 'Guadeloupe', null, '2014-06-21 22:44:19');
INSERT INTO `mst_country` VALUES ('59', 'GR', 'Greece', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('60', 'GT', 'Guatemala', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('61', 'GU', 'Guam', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('62', 'HK', 'Hong Kong', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('63', 'HN', 'Honduras', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('64', 'HR', 'Croatia', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('65', 'HT', 'Haiti', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('66', 'HU', 'Hungary', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('68', 'ID', 'Indonesia', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('69', 'IE', 'Ireland (Republic of)', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('70', 'IL', 'Israel', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('71', 'IN', 'India', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('72', 'IQ', 'Iraq', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('73', 'IR', 'Iran', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('74', 'IS', 'Iceland', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('75', 'IT', 'Italy', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('76', 'JM', 'Jamaica', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('77', 'JO', 'Jordan', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('78', 'JP', 'Japan', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('79', 'KE', 'Kenya', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('80', 'KG', 'Kyrgyzstan', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('81', 'KH', 'Cambodia', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('82', 'KN', 'Saint Kitts and Nevis', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('83', 'KP', 'North Korea', null, '2014-06-21 22:44:20');
INSERT INTO `mst_country` VALUES ('84', 'KR', 'South Korea', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('85', 'KW', 'Kuwait', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('86', 'KY', 'Cayman Islands', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('87', 'KZ', 'Kazakhstan', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('88', 'LA', 'Laos', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('89', 'LB', 'Lebanon', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('90', 'LC', 'Saint Lucia', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('91', 'LI', 'Liechtenstein', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('92', 'LK', 'Sri Lanka', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('93', 'LT', 'Lithuania', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('94', 'LU', 'Luxembourg', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('95', 'LV', 'Latvia', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('96', 'LY', 'Libya', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('97', 'MA', 'Morocco', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('98', 'MC', 'Monaco', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('99', 'MD', 'Moldova', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('100', 'ME', 'Montenegro', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('101', 'MF', 'Saint Martin (French part', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('102', 'MK', 'Macedonia', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('103', 'ML', 'Mali', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('104', 'MM', 'Myanmar', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('105', 'MN', 'Mongolia', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('106', 'MO', 'Macau', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('107', 'MP', 'Northern Mariana Islands', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('108', 'MT', 'Malta', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('109', 'MU', 'Mauritius', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('110', 'MV', 'Maldives', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('111', 'MX', 'Mexico', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('113', 'MY', 'Malaysia', null, '2014-06-21 22:44:21');
INSERT INTO `mst_country` VALUES ('114', 'MZ', 'Mozambique', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('115', 'NA', 'Namibia', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('116', 'NC', 'New Caledonia', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('117', 'NF', 'Norfolk Island', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('118', 'NG', 'Nigeria', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('119', 'NI', 'Nicaragua', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('120', 'NL', 'Netherlands', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('121', 'NO', 'Norway', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('122', 'NP', 'Nepal', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('123', 'NZ', 'New Zealand', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('124', 'OM', 'Oman', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('125', 'PA', 'Panama', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('126', 'PE', 'Peru', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('127', 'PF', 'French Polynesia', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('128', 'PH', 'Philippines', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('129', 'PK', 'Pakistan', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('130', 'PL', 'Poland', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('131', 'PR', 'Puerto Rico', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('132', 'PT', 'Portugal', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('133', 'PW', 'Palau', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('134', 'PY', 'Paraguay', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('135', 'QA', 'Qatar', null, '2014-06-21 22:44:22');
INSERT INTO `mst_country` VALUES ('136', 'RE', 'Reunion', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('137', 'RO', 'Romania', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('138', 'RS', 'Serbia', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('139', 'RU', 'Russia', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('140', 'SA', 'Saudi Arabia', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('141', 'SC', 'Seychelles', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('142', 'SE', 'Sweden', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('143', 'SG', 'Singapore', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('144', 'SH', 'Saint Helena, Ascension a', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('145', 'SI', 'Slovenia', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('146', 'SK', 'Slovakia', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('147', 'SM', 'San Marino (Republic of)', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('148', 'SN', 'Senegal', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('149', 'SY', 'Syria', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('150', 'SZ', 'Swaziland', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('151', 'TC', 'Turks and Caicos Islands', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('152', 'TG', 'Togo', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('153', 'TH', 'Thailand', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('154', 'TJ', 'Tajikistan', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('155', 'TM', 'Turkmenistan', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('156', 'TN', 'Tunisia', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('157', 'TO', 'Tonga', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('158', 'TR', 'Turkey', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('159', 'TT', 'Trinidad & Tobago', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('160', 'TW', 'Taiwan', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('161', 'TZ', 'Tanzania', null, '2014-06-21 22:44:23');
INSERT INTO `mst_country` VALUES ('162', 'UA', 'Ukraine', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('163', 'UG', 'Uganda', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('164', 'US', 'United States', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('165', 'UY', 'Uruguay', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('166', 'UZ', 'Uzbekistan', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('167', 'VC', 'Saint Vincent and the Gre', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('168', 'VE', 'Venezuela', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('169', 'VG', 'British Virgin Islands', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('170', 'VI', 'Virgin Islands (USA)', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('171', 'VN', 'Vietnam', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('172', 'VU', 'Vanuatu', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('173', 'WS', 'Samoa', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('174', 'YE', 'Yemen Republic', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('175', 'ZA', 'South Africa', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('176', 'ZM', 'Zambia', null, '2014-06-21 22:44:24');
INSERT INTO `mst_country` VALUES ('177', 'ZW', 'Zimbabwe', null, '2014-06-21 22:44:24');
INSERT INTO `mst_currency` VALUES ('IDR', 'Indonesia Rupiah', '1.00', '1', null, '2014-07-17 09:43:43');
INSERT INTO `mst_diagnosa` VALUES ('AX98', 'Amnesia', '-');
INSERT INTO `mst_diagnosa` VALUES ('DI', 'Diare', null);
INSERT INTO `mst_diagnosa` VALUES ('DIA', 'Diare Akut', null);
INSERT INTO `mst_diagnosa` VALUES ('DM', 'Panas Deman', null);
INSERT INTO `mst_diagnosa` VALUES ('ISPA', 'ISPA', null);
INSERT INTO `mst_education` VALUES ('29', '-', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('30', 'TK', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('31', 'SD', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('32', 'SMP', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('33', 'SMA', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('34', 'D2', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('35', 'D3', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('36', 'S1', null, '2014-06-21 22:45:00');
INSERT INTO `mst_education` VALUES ('37', 'S2', null, '2014-06-21 22:45:00');
INSERT INTO `mst_employer` VALUES ('1', '102000.5678.907', '1', 'Hendri Wawan W', 'L', '', '--', null, '-', '', '/', '', '', '1', '3', null, null, null, null, null, '', '2014-07-17 21:53:19', '1', null, '2014-07-06 06:02:10', '');
INSERT INTO `mst_employer` VALUES ('2', '102000.5678.908', '2', 'Kurniawan Hendri', 'L', 'Sleman', '1996-2-3', null, 'B', 'Kenanga 09/17 Condongcatur Depok', '09/17', 'Condongcatur', 'Depok', '16', '21', 'WNI', 'belum kawin', 'Islam', null, null, '027498789', '2014-07-17 21:53:24', '1', null, '2014-07-06 06:07:34', 'Kenanga');
INSERT INTO `mst_employer` VALUES ('3', '102000.5678.909', '1', 'Ibo Wibowo', 'L', '', '--', null, '-', '', '/', '', '', '1', '3', null, null, null, null, null, '', '2014-07-30 11:38:08', '1', null, '2014-07-06 06:51:13', '');
INSERT INTO `mst_family_relation` VALUES ('1', 'Orang Tua', '0', '2014-07-10 11:47:24');
INSERT INTO `mst_family_relation` VALUES ('2', 'Suami / Istri', '0', '2014-07-10 11:47:38');
INSERT INTO `mst_family_relation` VALUES ('3', 'Saudara', '0', '2014-07-10 11:47:52');
INSERT INTO `mst_family_relation` VALUES ('4', 'Teman', '0', '2014-07-10 11:47:56');
INSERT INTO `mst_family_relation` VALUES ('5', 'Pengantar', '0', '2014-07-10 11:48:03');
INSERT INTO `mst_insurance` VALUES ('1', 'UMUM', null, '2014-07-29 19:46:37');
INSERT INTO `mst_insurance` VALUES ('2', 'Jamkesmas', null, '2014-06-21 22:45:39');
INSERT INTO `mst_insurance` VALUES ('3', 'BPJS', null, '2014-07-29 19:46:43');
INSERT INTO `mst_insurance` VALUES ('4', 'ASKES', null, '2014-07-29 19:46:34');
INSERT INTO `mst_lab_treathment` VALUES ('1', 'Hemoglobin', '2000.00', '20000.00', '1');
INSERT INTO `mst_lab_treathment` VALUES ('3', 'Golongan darah (ABO Rh)', '2000.00', '50000.00', '1');
INSERT INTO `mst_lab_treathment` VALUES ('4', 'Paket 1: Darah Rutin,SGOT,SGPT', '2000.00', '150000.00', '1');
INSERT INTO `mst_lab_treathment_detail` VALUES ('1', '10001', 'Hemoglobin', '13-17', '12-16', 'g/dl', '1');
INSERT INTO `mst_lab_treathment_detail` VALUES ('4', '10002', 'Leukosit', '4000-10000', '4000-10000', '/mm3', '1');
INSERT INTO `mst_lab_treathment_detail` VALUES ('3', '10003', 'Leukosit 2', '4000-6000', '4000-6000', '/mm3', '1');
INSERT INTO `mst_lab_treathment_detail` VALUES ('4', '10004', 'Hemoglobin 2', '13-17', '12-16', 'g/dl', '1');
INSERT INTO `mst_lab_treathment_detail` VALUES ('4', '10005', 'HB', '12-14', '12-14', 'g/dl', '1');
INSERT INTO `mst_marital_st` VALUES ('1', 'Belum Kawin', '0', '2014-07-08 12:37:43');
INSERT INTO `mst_marital_st` VALUES ('2', 'Kawin', '0', '2014-07-08 12:38:39');
INSERT INTO `mst_marital_st` VALUES ('3', 'Duda / Janda', '0', '2014-07-08 12:38:45');
INSERT INTO `mst_marital_st` VALUES ('4', 'Tidak Kawin', '0', '2014-07-08 12:38:56');
INSERT INTO `mst_medical_anamnesa` VALUES ('6', 'sendi kaki memar', 'S', null, '2014-07-17 22:24:37', '2');
INSERT INTO `mst_medical_anamnesa` VALUES ('7', 'panas demam', 'S', null, '2014-07-17 22:52:37', '2');
INSERT INTO `mst_medical_anamnesa` VALUES ('8', 'pusing', 'S', null, '2014-07-19 12:53:16', '2');
INSERT INTO `mst_medical_anamnesa` VALUES ('9', 'sendi kaki memar', 'S', null, '2014-07-19 12:55:32', '2');
INSERT INTO `mst_medical_objective` VALUES ('1', 'tulang memar', 'S', null, '2014-07-03 20:23:40', '2');
INSERT INTO `mst_medical_objective` VALUES ('2', 'tulang sakit', 'S', null, '2014-07-03 20:51:07', '2');
INSERT INTO `mst_medical_subjective` VALUES ('6', 'Tulang Membengkak', 'S', null, null, '2');
INSERT INTO `mst_medical_subjective` VALUES ('7', 'Patah Tulang', 'S', null, null, '2');
INSERT INTO `mst_medical_subjective` VALUES ('8', 'Tulang Robek', 'S', null, null, '2');
INSERT INTO `mst_medical_subjective` VALUES ('9', 'Tulang Kering Luka', 'S', null, null, '2');
INSERT INTO `mst_medical_subjective` VALUES ('10', 'Gigi Berlubang', 'S', null, null, '1');
INSERT INTO `mst_medical_subjective` VALUES ('12', 'Tulang patah', 'S', null, null, '2');
INSERT INTO `mst_medical_subjective` VALUES ('13', 'Tulang selilit', 'S', null, null, '2');
INSERT INTO `mst_medical_subjective` VALUES ('14', 'Tulang memar merah', 'S', null, null, '2');
INSERT INTO `mst_medical_subjective` VALUES ('15', 'Tulang bengkok', 'S', null, null, '2');
INSERT INTO `mst_medicine` VALUES ('OB1', 'obat pertama', '10000');
INSERT INTO `mst_medicine` VALUES ('OB2', 'obat kedua', '20000');
INSERT INTO `mst_nationality` VALUES ('1', 'WNI', null, '2014-06-21 22:47:00');
INSERT INTO `mst_nationality` VALUES ('2', 'WNA', null, '2014-06-21 22:47:00');
INSERT INTO `mst_occupation` VALUES ('1', '-', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('2', 'TNI', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('3', 'PNS', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('4', 'POLRI', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('5', 'BUMN', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('6', 'SWASTA', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('7', 'Mahasiswa', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('8', 'Pelajar', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('9', 'Tani', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('10', 'Dagang', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_occupation` VALUES ('11', 'Lainnya', null, null, '2014-06-21 22:47:46');
INSERT INTO `mst_poly` VALUES ('1', 'Poli Umum', null, '1', null, '2014-07-17 22:42:32');
INSERT INTO `mst_poly` VALUES ('2', 'Poli Anak', null, '1', null, '2014-07-17 22:42:37');
INSERT INTO `mst_poly` VALUES ('3', 'Poli Gigi', null, '1', null, '2014-07-17 22:42:43');
INSERT INTO `mst_province` VALUES ('1', 'Aceh', null, '2014-07-08 13:12:47');
INSERT INTO `mst_province` VALUES ('2', 'Sumatera Utara', null, '2014-07-08 13:12:51');
INSERT INTO `mst_province` VALUES ('3', 'Bengkulu', null, '2014-07-08 13:13:15');
INSERT INTO `mst_province` VALUES ('4', 'Jambi', null, '2014-07-08 13:13:17');
INSERT INTO `mst_province` VALUES ('5', 'Riau', null, '2014-07-08 13:13:19');
INSERT INTO `mst_province` VALUES ('6', 'Sumatera Barat', null, '2014-07-08 13:13:21');
INSERT INTO `mst_province` VALUES ('7', 'Sumatera Selatan', null, '2014-07-08 13:13:22');
INSERT INTO `mst_province` VALUES ('8', 'Lampung', null, '2014-07-08 13:13:25');
INSERT INTO `mst_province` VALUES ('9', 'Kepulauan Bangka Belitung', null, '2014-07-08 13:13:27');
INSERT INTO `mst_province` VALUES ('10', 'Kepulauan Riau', null, '2014-07-08 13:13:29');
INSERT INTO `mst_province` VALUES ('11', 'Banten', null, '2014-07-08 13:13:32');
INSERT INTO `mst_province` VALUES ('12', 'Jawa Barat', null, '2014-07-08 13:13:33');
INSERT INTO `mst_province` VALUES ('13', 'DKI Jakarta', null, '2014-07-08 13:13:36');
INSERT INTO `mst_province` VALUES ('14', 'Jawa Tengah', null, '2014-07-08 13:13:38');
INSERT INTO `mst_province` VALUES ('15', 'Jawa Timur', null, '2014-07-08 13:13:39');
INSERT INTO `mst_province` VALUES ('16', 'Daerah Istimewa Yogyakarta', null, '2014-07-08 13:14:03');
INSERT INTO `mst_province` VALUES ('17', 'Bali', null, '2014-07-08 13:14:26');
INSERT INTO `mst_province` VALUES ('18', 'Nusa Tenggara Barat', null, '2014-07-08 13:14:29');
INSERT INTO `mst_province` VALUES ('19', 'Nusa Tenggara Timur', null, '2014-07-08 13:14:31');
INSERT INTO `mst_province` VALUES ('20', 'Kalimantan Barat', null, '2014-07-08 13:14:33');
INSERT INTO `mst_province` VALUES ('21', 'Kalimantan Selatan', null, '2014-07-08 13:14:35');
INSERT INTO `mst_province` VALUES ('22', 'Kalimantan Tengah', null, '2014-07-08 13:14:37');
INSERT INTO `mst_province` VALUES ('23', 'Kalimantan Timur', null, '2014-07-08 13:14:39');
INSERT INTO `mst_province` VALUES ('24', 'Gorontalo', null, '2014-07-08 13:14:48');
INSERT INTO `mst_province` VALUES ('25', 'Sulawesi Selatan', null, '2014-07-08 13:14:50');
INSERT INTO `mst_province` VALUES ('26', 'Sulawesi Tenggara', null, '2014-07-08 13:14:52');
INSERT INTO `mst_province` VALUES ('27', 'Sulawesi Tengah', null, '2014-07-08 13:14:54');
INSERT INTO `mst_province` VALUES ('28', 'Sulawesi Utara', null, '2014-07-08 13:14:57');
INSERT INTO `mst_province` VALUES ('29', 'Sulawesi Barat', null, '2014-07-08 13:14:59');
INSERT INTO `mst_province` VALUES ('30', 'Maluku', null, '2014-07-08 13:15:01');
INSERT INTO `mst_province` VALUES ('31', 'Maluku Utara', null, '2014-07-08 13:15:03');
INSERT INTO `mst_province` VALUES ('32', 'Papua', null, '2014-07-08 13:15:05');
INSERT INTO `mst_province` VALUES ('33', 'Papua Barat', null, '2014-07-08 13:15:07');
INSERT INTO `mst_regency` VALUES ('1', '1', '1', 'Kabupaten Bireuen', 'Bireuen', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('2', '1', '1', 'Kabupaten Gayo Lues', 'Blang Kejeren', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('3', '1', '1', 'Kabupaten Aceh Barat Daya', 'Blangpidie', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('4', '1', '1', 'Kabupaten Aceh Jaya', 'Calang', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('5', '1', '1', 'Kabupaten Aceh Timur', 'Idi Rayeuk', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('6', '1', '1', 'Kabupaten Aceh Tamiang', 'Karang Baru', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('7', '1', '1', 'Kabupaten Aceh Besar', 'Jantho', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('8', '1', '1', 'Kabupaten Aceh Tenggara', 'Kutacane', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('9', '1', '1', 'Kabupaten Aceh Utara', 'Lhoksukon', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('10', '1', '1', 'Kabupaten Aceh Barat', 'Meulaboh', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('11', '1', '1', 'Kabupaten Pidie Jaya', 'Meureudu', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('12', '1', '1', 'Kabupaten Pidie', 'Sigli', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('13', '1', '1', 'Kabupaten Bener Meriah', 'Simpang Tiga Redelong', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('14', '1', '1', 'Kabupaten Simeulue', 'Sinabang', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('15', '1', '1', 'Kabupaten Aceh Singkil', 'Singkil', null, '2014-06-21 22:49:14');
INSERT INTO `mst_regency` VALUES ('16', '1', '1', 'Kabupaten Nagan Raya', 'Suka Makmue', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('17', '1', '1', 'Kabupaten Aceh Tengah', 'Takengon', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('18', '1', '1', 'Kabupaten Aceh Selatan', 'Tapak Tuan', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('19', '1', '1', 'Kota Banda Aceh', 'Banda Aceh', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('20', '1', '1', 'Kota Langsa', 'Langsa', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('21', '1', '1', 'Kota Lhokseumawe', 'Lhokseumawe', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('22', '1', '1', 'Kota Sabang', 'Sabang', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('23', '1', '1', 'Kota Subulussalam', 'Subulussalam', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('24', '1', '2', 'Kabupaten Labuhanbatu Utara', 'Aek Kanopan', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('25', '1', '2', 'Kabupaten Toba Samosir', 'Balige', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('26', '1', '2', 'Kota Binjai', 'Binjai Kota', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('27', '1', '2', 'Kabupaten Humbang Hasundutan', 'Dolok Sanggul', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('28', '1', '2', 'Kabupaten Nias', 'Gunung Sitoli', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('29', '1', '2', 'Kabupaten Padang Lawas Utara', 'Gunung Tua', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('30', '1', '2', 'Kabupaten Karo', 'Kabanjahe', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('31', '1', '2', 'Kabupaten Asahan', 'Kisaran', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('32', '1', '2', 'Kabupaten Labuhanbatu Selatan', 'Pinang', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('33', '1', '2', 'Kabupaten Nias Barat', 'Lahomi', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('34', '1', '2', 'Kabupaten Batubara', 'Limapuluh', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('35', '1', '2', 'Kabupaten Nias Utara', 'Lotu', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('36', '1', '2', 'Kabupaten Deli Serdang', 'Lubuk Pakam', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('37', '1', '2', 'Kabupaten Tapanuli Tengah', 'Pandan', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('38', '1', '2', 'Kabupaten Samosir', 'Pangururan', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('39', '1', '2', 'Kabupaten Mandailing Natal', 'Panyabungan', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('40', '1', '2', 'Kabupaten Labuhanbatu', 'Rantau Prapat', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('41', '1', '2', 'Kabupaten Simalungun', 'Raya', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('42', '1', '2', 'Kabupaten Pakpak Bharat', 'Salak', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('43', '1', '2', 'Kabupaten Serdang Bedagai', 'Sei Rampah', null, '2014-06-21 22:49:15');
INSERT INTO `mst_regency` VALUES ('44', '1', '2', 'Kabupaten Padang Lawas', 'Sibuhuan', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('45', '1', '2', 'Kabupaten Dairi', 'Sidikalang', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('46', '1', '2', 'Kabupaten Tapanuli Selatan', 'Sipirok', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('47', '1', '2', 'Kabupaten Langkat', 'Stabat', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('48', '1', '2', 'Kabupaten Tapanuli Utara', 'Tarutung', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('49', '1', '2', 'Kabupaten Nias Selatan', 'Teluk Dalam', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('50', '1', '2', 'Kota Gunungsitoli', 'Gunungsitoli', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('51', '1', '2', 'Kota Medan', 'Medan', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('52', '1', '2', 'Kota Padangsidempuan', 'Padangsidempuan', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('53', '1', '2', 'Kota Pematangsiantar', 'Pematangsiantar', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('54', '1', '2', 'Kota Sibolga', 'Sibolga', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('55', '1', '2', 'Kota Tanjungbalai', 'Tanjungbalai', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('56', '1', '2', 'Kota Tebing Tinggi', 'Tebing Tinggi', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('57', '1', '3', 'Kabupaten Bengkulu Utara', 'Arga Makmur', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('58', '1', '3', 'Kabupaten Kaur', 'Bintuhan  Kaur Selatan', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('59', '1', '3', 'Kabupaten Rejang Lebong', 'Curup', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('60', '1', '3', 'Kabupaten Bengkulu Tengah', 'Karang Tinggi', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('61', '1', '3', 'Kabupaten Kepahiang', 'Kepahiang', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('62', '1', '3', 'Kabupaten Bengkulu Selatan', 'Kota Manna', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('63', '1', '3', 'Kabupaten Lebong', 'Muara Aman', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('64', '1', '3', 'Kabupaten Mukomuko', 'Mukomuko', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('65', '1', '3', 'Kabupaten Seluma', 'Tais', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('66', '1', '3', 'Kota Bengkulu', 'Bengkulu', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('67', '1', '4', 'Kabupaten Merangin', 'Bangko', null, '2014-06-21 22:49:16');
INSERT INTO `mst_regency` VALUES ('68', '1', '4', 'Kabupaten Tanjung Jabung Barat', 'Kuala Tungkal', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('69', '1', '4', 'Kabupaten Batanghari', 'Muara Bulian', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('70', '1', '4', 'Kabupaten Bungo', 'Muara Bungo', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('71', '1', '4', 'Kabupaten Tanjung Jabung Timur', 'Muara Sabak', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('72', '1', '4', 'Kabupaten Tebo', 'Muara Tebo', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('73', '1', '4', 'Kabupaten Sarolangun', 'Sarolangun', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('74', '1', '4', 'Kabupaten Muaro Jambi', 'Sengeti', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('75', '1', '4', 'Kabupaten Kerinci', 'Sungaipenuh', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('76', '1', '4', 'Kota Jambi', 'Jambi', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('77', '1', '4', 'Kota Sungai Penuh', 'Sungai Penuh', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('78', '1', '5', 'Kabupaten Kampar', 'Bangkinang', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('79', '1', '5', 'Kabupaten Bengkalis', 'Bengkalis', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('80', '1', '5', 'Kabupaten Pelalawan', 'Pangkalan Kerinci', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('81', '1', '5', 'Kabupaten Rokan Hulu', 'Pasir Pengaraian', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('82', '1', '5', 'Kota Pekanbaru', 'Pekanbaru', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('83', '1', '5', 'Kabupaten Indragiri Hulu', 'Rengat', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('84', '1', '5', 'Kabupaten Kepulauan Meranti', 'Selatpanjang', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('85', '1', '5', 'Kabupaten Siak', 'Siak Sri Indrapura', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('86', '1', '5', 'Kabupaten Kuantan Singingi', 'Teluk Kuantan', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('87', '1', '5', 'Kabupaten Indragiri Hilir', 'Tembilahan', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('88', '1', '5', 'Kabupaten Rokan Hilir', 'Ujung Tanjung', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('89', '1', '5', 'Kota Dumai', 'Dumai', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('90', '1', '6', 'Kabupaten Solok', 'Arosuka', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('91', '1', '6', 'Kabupaten Tanah Datar', 'Batusangkar', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('92', '1', '6', 'Kota Bukittinggi', 'Bukittinggi', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('93', '1', '6', 'Kabupaten Agam', 'Lubuk Basung', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('94', '1', '6', 'Kabupaten Pasaman', 'Lubuk Sikaping', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('95', '1', '6', 'Kabupaten Sijunjung', 'Muaro Sijunjung', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('96', '1', '6', 'Kota Padang', 'Padang', null, '2014-06-21 22:49:17');
INSERT INTO `mst_regency` VALUES ('97', '1', '6', 'Kabupaten Solok Selatan', 'Padang Aro', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('98', '1', '6', 'Kota Padangpanjang', 'Padang Panjang', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('99', '1', '6', 'Kabupaten Pesisir Selatan', 'Painan', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('100', '1', '6', 'Kota Pariaman', 'Pariaman', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('101', '1', '6', 'Kabupaten Padang Pariaman', 'Parit Malintang', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('102', '1', '6', 'Kota Payakumbuh', 'Payakumbuh', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('103', '1', '6', 'Kabupaten Dharmasraya', 'Pulau Punjung', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('104', '1', '6', 'Kabupaten Lima Puluh Kota', 'Sarilamak', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('105', '1', '6', 'Kota Sawahlunto', 'Sawahlunto', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('106', '1', '6', 'Kabupaten Pasaman Barat', 'Simpang Empat', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('107', '1', '6', 'Kota Solok', 'Solok', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('108', '1', '6', 'Kabupaten Kepulauan Mentawai', 'Tuapejat', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('109', '1', '7', 'Kabupaten Ogan Komering Ulu', 'Baturaja', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('110', '1', '7', 'Kabupaten Ogan Ilir', 'Indralaya', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('111', '1', '7', 'Kabupaten Ogan Komering Ilir', 'Kota Kayu Agung', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('112', '1', '7', 'Kabupaten Lahat', 'Lahat', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('113', '1', '7', 'Kabupaten Ogan Komering Ulu Timur', 'Martapura', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('114', '1', '7', 'Kabupaten Musi Rawas', 'Muara Beliti Baru', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('115', '1', '7', 'Kabupaten Muara Enim', 'Muara Enim', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('116', '1', '7', 'Kabupaten Ogan Komering Ulu Selatan', 'Muaradua', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('117', '1', '7', 'Kabupaten Banyuasin', 'Pangkalan Balai', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('118', '1', '7', 'Kabupaten Musi Banyuasin', 'Sekayu', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('119', '1', '7', 'Kabupaten Empat Lawang', 'Tebing Tinggi', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('120', '1', '7', 'Kota Lubuklinggau', 'Lubuklinggau', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('121', '1', '7', 'Kota Pagar Alam', 'Pagar Alam', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('122', '1', '7', 'Kota Palembang', 'Palembang', null, '2014-06-21 22:49:18');
INSERT INTO `mst_regency` VALUES ('123', '1', '7', 'Kota Prabumulih', 'Prabumulih', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('124', '1', '8', 'Kabupaten Way Kanan', 'Blambangan Umpu', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('125', '1', '8', 'Kabupaten Pesawaran', 'Gedong Tataan', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('126', '1', '8', 'Kabupaten Lampung Tengah', 'Gunung Sugih', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('127', '1', '8', 'Kabupaten Lampung Selatan', 'Kalianda', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('128', '1', '8', 'Kabupaten Tanggamus', 'Agung', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('129', '1', '8', 'Kabupaten Lampung Barat', 'Liwa', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('130', '1', '8', 'Kabupaten Lampung Utara', 'Kotabumi', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('131', '1', '8', 'Kabupaten Tulang Bawang', 'Menggala', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('132', '1', '8', 'Kabupaten Lampung Timur', 'Sukadana', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('133', '1', '8', 'Kabupaten Tulang Bawang Barat', 'Tulang Bawang Tengah', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('134', '1', '8', 'Kabupaten Mesuji', 'Kabupaten Mesuji', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('135', '1', '8', 'Kabupaten Pringsewu', 'Kabupaten Pringsewu', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('136', '1', '8', 'Kota Bandar Lampung', 'Bandar Lampung', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('137', '1', '8', 'Kota Metro', 'Metro', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('138', '1', '9', 'Kabupaten Bangka Tengah', 'Koba', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('139', '1', '9', 'Kabupaten Belitung Timur', 'Manggar', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('140', '1', '9', 'Kabupaten Bangka Selatan', 'Mentok', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('141', '1', '9', 'Kabupaten Bangka', 'Sungai Liat', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('142', '1', '9', 'Kabupaten Belitung', 'Tanjung Pandan', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('143', '1', '9', 'Kabupaten Bangka Barat', 'Toboali', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('144', '1', '9', 'Kota Pangkal Pinang', 'Pangkal Pinang', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('145', '1', '10', 'Kabupaten Bintan', 'Bandar Seri Bentan', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('146', '1', '10', 'Kabupaten Lingga', 'Daik, Lingga', null, '2014-06-21 22:49:19');
INSERT INTO `mst_regency` VALUES ('147', '1', '10', 'Kabupaten Natuna', 'Ranai, Bunguran Timur', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('148', '1', '10', 'Kabupaten Karimun', 'Tanjung Balai Karimun', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('149', '1', '10', 'Kabupaten Kepulauan Anambas', 'Tarempa', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('150', '1', '10', 'Kota Batam', 'Batam', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('151', '1', '10', 'Kota Tanjung Pinang', 'Tanjung Pinang', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('152', '1', '11', 'Kota Tangerang Selatan', 'Ciputat', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('153', '1', '11', 'Kabupaten Serang', 'Ciruas', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('154', '1', '11', 'Kabupaten Pandeglang', 'Pandeglang', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('155', '1', '11', 'Kabupaten Lebak', 'Rangkasbitung', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('156', '1', '11', 'Kabupaten Tangerang', 'Tigaraksa', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('157', '1', '11', 'Kota Cilegon', 'Cilegon', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('158', '1', '11', 'Kota Serang', 'Serang', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('159', '1', '11', 'Kota Tangerang', 'Tangerang', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('160', '1', '12', 'Kota Bandung', 'Bandung', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('161', '1', '12', 'Kota Banjar', 'Banjar', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('162', '1', '12', 'Kota Bekasi', 'Bekasi', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('163', '1', '12', 'Kota Bogor', 'Bogor', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('164', '1', '12', 'Kabupaten Ciamis', 'Ciamis', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('165', '1', '12', 'Kabupaten Cianjur', 'Cianjur', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('166', '1', '12', 'Kabupaten Bogor', 'Cibinong', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('167', '1', '12', 'Kabupaten Bekasi', 'Cikarang', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('168', '1', '12', 'Kota Cimahi', 'Cimahi', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('169', '1', '12', 'Kota Cirebon', 'Cirebon', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('170', '1', '12', 'Kota Sukabumi', 'Cisaat', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('171', '1', '12', 'Kota Depok', 'Depok', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('172', '1', '12', 'Kabupaten Garut', 'Garut', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('173', '1', '12', 'Kabupaten Indramayu', 'Indramayu', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('174', '1', '12', 'Kabupaten Karawang', 'Karawang', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('175', '1', '12', 'Kabupaten Kuningan', 'Kuningan', null, '2014-06-21 22:49:20');
INSERT INTO `mst_regency` VALUES ('176', '1', '12', 'Kabupaten Majalengka', 'Majalengka', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('177', '1', '12', 'Kabupaten Bandung Barat', 'Ngamprah', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('178', '1', '12', 'Kabupaten Sukabumi', 'Sukabumi', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('179', '1', '12', 'Kabupaten Purwakarta', 'Purwakarta', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('180', '1', '12', 'Kabupaten Tasikmalaya', 'Singaparna', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('181', '1', '12', 'Kabupaten Bandung', 'Soreang', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('182', '1', '12', 'Kabupaten Subang', 'Subang', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('183', '1', '12', 'Kabupaten Cirebon', 'Sumber', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('184', '1', '12', 'Kabupaten Sumedang', 'Sumedang', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('185', '1', '12', 'Kota Tasikmalaya', 'Tasikmalaya', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('186', '1', '13', 'Kabupaten Kepulauan Seribu', 'Pulau Pramuka', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('187', '1', '13', 'Kota Jakarta Barat', 'Jakarta Barat', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('188', '1', '13', 'Kota Jakarta Pusat', 'Jakarta Pusat', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('189', '1', '13', 'Kota Jakarta Selatan', 'Jakarta Selatan', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('190', '1', '13', 'Kota Jakarta Timur', 'Jakarta Timur', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('191', '1', '13', 'Kota Jakarta Utara', 'Jakarta Utara', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('192', '1', '14', 'Kabupaten Banjarnegara', 'Banjarnegara', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('193', '1', '14', 'Kabupaten Batang', 'Batang', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('194', '1', '14', 'Kabupaten Blora', 'Blora', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('195', '1', '14', 'Kabupaten Boyolali', 'Boyolali', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('196', '1', '14', 'Kabupaten Brebes', 'Brebes', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('197', '1', '14', 'Kabupaten Cilacap', 'Cilacap', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('198', '1', '14', 'Kabupaten Demak', 'Demak', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('199', '1', '14', 'Kabupaten Jepara', 'Jepara', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('200', '1', '14', 'Kabupaten Pekalongan', 'Kajen', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('201', '1', '14', 'Kabupaten Karanganyar', 'Karanganyar', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('202', '1', '14', 'Kabupaten Kebumen', 'Kebumen', null, '2014-06-21 22:49:21');
INSERT INTO `mst_regency` VALUES ('203', '1', '14', 'Kabupaten Kendal', 'Kendal', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('204', '1', '14', 'Kabupaten Klaten', 'Klaten', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('205', '1', '14', 'Kabupaten Kudus', 'Kudus', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('206', '1', '14', 'Kabupaten Magelang', 'Mungkid', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('207', '1', '14', 'Kabupaten Pati', 'Pati', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('208', '1', '14', 'Kabupaten Pemalang', 'Pemalang', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('209', '1', '14', 'Kabupaten Purbalingga', 'Purbalingga', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('210', '1', '14', 'Kabupaten Grobogan', 'Purwodadi', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('211', '1', '14', 'Kabupaten Banyumas', 'Purwokerto', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('212', '1', '14', 'Kabupaten Purworejo', 'Purworejo', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('213', '1', '14', 'Kabupaten Rembang', 'Rembang', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('214', '1', '14', 'Kabupaten Tegal', 'Slawi', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('215', '1', '14', 'Kabupaten Sragen', 'Sragen', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('216', '1', '14', 'Kabupaten Sukoharjo', 'Sukoharjo', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('217', '1', '14', 'Kabupaten Temanggung', 'Temanggung', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('218', '1', '14', 'Kabupaten Semarang', 'Ungaran', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('219', '1', '14', 'Kabupaten Wonogiri', 'Wonogiri', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('220', '1', '14', 'Kabupaten Wonosobo', 'Wonosobo', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('221', '1', '14', 'Kota Magelang', 'Magelang', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('222', '1', '14', 'Kota Pekalongan', 'Pekalongan', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('223', '1', '14', 'Kota Salatiga', 'Salatiga', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('224', '1', '14', 'Kota Semarang', 'Semarang', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('225', '1', '14', 'Kota Surakarta', 'Surakarta', null, '2014-06-21 22:49:22');
INSERT INTO `mst_regency` VALUES ('226', '1', '14', 'Kota Tegal', 'Tegal', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('227', '1', '15', 'Kabupaten Bangkalan', 'Bangkalan', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('228', '1', '15', 'Kabupaten Banyuwangi', 'Banyuwangi', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('229', '1', '15', 'Kabupaten Bojonegoro', 'Bojonegoro', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('230', '1', '15', 'Kabupaten Bondowoso', 'Bondowoso', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('231', '1', '15', 'Kabupaten Gresik', 'Gresik', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('232', '1', '15', 'Kabupaten Jember', 'Jember', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('233', '1', '15', 'Kabupaten Jombang', 'Jombang', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('234', '1', '15', 'Kabupaten Blitar', 'Kanigoro', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('235', '1', '15', 'Kabupaten Kediri', 'Kediri', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('236', '1', '15', 'Kabupaten Malang', 'Kepanjen', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('237', '1', '15', 'Kabupaten Probolinggo', 'Kraksaan', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('238', '1', '15', 'Kabupaten Lamongan', 'Lamongan', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('239', '1', '15', 'Kabupaten Lumajang', 'Lumajang', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('240', '1', '15', 'Kabupaten Madiun', 'Madiun', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('241', '1', '15', 'Kabupaten Magetan', 'Magetan', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('242', '1', '15', 'Kabupaten Mojokerto', 'Mojokerto', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('243', '1', '15', 'Kabupaten Nganjuk', 'Nganjuk', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('244', '1', '15', 'Kabupaten Ngawi', 'Ngawi', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('245', '1', '15', 'Kabupaten Pacitan', 'Pacitan', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('246', '1', '15', 'Kabupaten Pamekasan', 'Pamekasan', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('247', '1', '15', 'Kabupaten Pasuruan', 'Pasuruan', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('248', '1', '15', 'Kabupaten Ponorogo', 'Ponorogo', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('249', '1', '15', 'Kabupaten Sampang', 'Sampang', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('250', '1', '15', 'Kabupaten Sidoarjo', 'Sidoarjo', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('251', '1', '15', 'Kabupaten Situbondo', 'Situbondo', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('252', '1', '15', 'Kabupaten Sumenep', 'Sumenep', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('253', '1', '15', 'Kabupaten Trenggalek', 'Trenggalek', null, '2014-06-21 22:49:23');
INSERT INTO `mst_regency` VALUES ('254', '1', '15', 'Kabupaten Tuban', 'Tuban', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('255', '1', '15', 'Kabupaten Tulungagung', 'Tulungagung', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('256', '1', '15', 'Kota Batu[8]', 'Batu', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('257', '1', '15', 'Kota Blitar', 'Blitar', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('258', '1', '15', 'Kota Kediri', 'Kediri', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('259', '1', '15', 'Kota Madiun', 'Madiun', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('260', '1', '15', 'Kota Malang', 'Malang', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('261', '1', '15', 'Kota Mojokerto', 'Mojokerto', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('262', '1', '15', 'Kota Pasuruan', 'Pasuruan', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('263', '1', '15', 'Kota Probolinggo', 'Probolinggo', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('264', '1', '15', 'Kota Surabaya', 'Surabaya', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('265', '1', '16', 'Kabupaten Bantul', 'Bantul', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('266', '1', '16', 'Kabupaten Sleman', 'Sleman', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('267', '1', '16', 'Kabupaten Kulon Progo', 'Wates', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('268', '1', '16', 'Kabupaten Gunung Kidul', 'Wonosari', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('269', '1', '16', 'Kota Yogyakarta', 'Yogyakarta', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('270', '1', '17', 'Kabupaten Badung', 'Badung', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('271', '1', '17', 'Kabupaten Bangli', 'Bangli', null, '2014-06-21 22:49:24');
INSERT INTO `mst_regency` VALUES ('272', '1', '17', 'Kabupaten Gianyar', 'Gianyar', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('273', '1', '17', 'Kabupaten Karangasem', 'Karangasem', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('274', '1', '17', 'Kabupaten Klungkung', 'Klungkung', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('275', '1', '17', 'Kabupaten Jembrana', 'Negara', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('276', '1', '17', 'Kabupaten Buleleng', 'Singaraja', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('277', '1', '17', 'Kabupaten Tabanan', 'Tabanan', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('278', '1', '17', 'Kota Denpasar', 'Denpasar', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('279', '1', '18', 'Kabupaten Dompu', 'Dompu', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('280', '1', '18', 'Kabupaten Lombok Barat', 'Mataram', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('281', '1', '18', 'Kabupaten Lombok Tengah', 'Praya', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('282', '1', '18', 'Kabupaten Bima', 'Raba', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('283', '1', '18', 'Kabupaten Lombok Timur', 'Selong', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('284', '1', '18', 'Kabupaten Sumbawa', 'Sumbawa Besar', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('285', '1', '18', 'Kabupaten Sumbawa Barat', 'Taliwang', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('286', '1', '18', 'Kabupaten Lombok Utara', 'Tanjung', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('287', '1', '18', 'Kota Bima', 'Bima', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('288', '1', '18', 'Kota Mataram', 'Mataram', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('289', '1', '19', 'Kabupaten Belu', 'Atambua', null, '2014-06-21 22:49:25');
INSERT INTO `mst_regency` VALUES ('290', '1', '19', 'Kabupaten Rote Ndao', 'Baa', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('291', '1', '19', 'Kabupaten Ngada', 'Bajawa', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('292', '1', '19', 'Kabupaten Manggarai Timur', 'Borong', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('293', '1', '19', 'Kabupaten Ende', 'Ende', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('294', '1', '19', 'Kabupaten Alor', 'Kalabahi', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('295', '1', '19', 'Kabupaten Timor Tengah Utara', 'Kefamenanu', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('296', '1', '19', 'Kabupaten Kupang', 'Kupang', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('297', '1', '19', 'Kota Kupang', 'Kupang', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('298', '1', '19', 'Kabupaten Manggarai Barat', 'Labuan Bajo', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('299', '1', '19', 'Kabupaten Flores Timur', 'Larantuka', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('300', '1', '19', 'Kabupaten Lembata', 'Lewoleba', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('301', '1', '19', 'Kabupaten Sikka', 'Maumere', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('302', '1', '19', 'Kabupaten Nagekeo', 'Mbay', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('303', '1', '19', 'Kabupaten Manggarai', 'Ruteng', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('304', '1', '19', 'Kabupaten Sabu Raijua', 'Seba', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('305', '1', '19', 'Kabupaten Timor Tengah Selatan', 'Soe', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('306', '1', '19', 'Kabupaten Sumba Barat Daya', 'Tambolaka', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('307', '1', '19', 'Kabupaten Sumba Tengah', 'Waibakul', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('308', '1', '19', 'Kabupaten Sumba Barat', 'Waikabubak', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('309', '1', '19', 'Kabupaten Sumba Timur', 'Waingapu', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('310', '1', '20', 'Kabupaten Bengkayang', 'Bengkayang', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('311', '1', '20', 'Kabupaten Ketapang', 'Ketapang', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('312', '1', '20', 'Kabupaten Pontianak', 'Mempawah', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('313', '1', '20', 'Kabupaten Melawi', 'Nanga Pinoh', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('314', '1', '20', 'Kabupaten Landak', 'Ngabang', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('315', '1', '20', 'Kabupaten Kapuas Hulu', 'Putussibau', null, '2014-06-21 22:49:26');
INSERT INTO `mst_regency` VALUES ('316', '1', '20', 'Kabupaten Sambas', 'Sambas', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('317', '1', '20', 'Kabupaten Sanggau', 'Sanggau', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('318', '1', '20', 'Kabupaten Sekadau', 'Sekadau', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('319', '1', '20', 'Kabupaten Sintang', 'Sintang', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('320', '1', '20', 'Kabupaten Kayong Utara', 'Sukadana', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('321', '1', '20', 'Kabupaten Kubu Raya', 'Sungai Raya', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('322', '1', '20', 'Kota Pontianak', 'Pontianak', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('323', '1', '20', 'Kota Singkawang', 'Singkawang', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('324', '1', '21', 'Kabupaten Hulu Sungai Utara', 'Amuntai', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('325', '1', '21', 'Kota Banjarbaru', 'Banjarbaru', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('326', '1', '21', 'Kota Banjarmasin', 'Banjarmasin', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('327', '1', '21', 'Kabupaten Hulu Sungai Tengah', 'Barabai', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('328', '1', '21', 'Kabupaten Tanah Bumbu', 'Batulicin', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('329', '1', '21', 'Kabupaten Hulu Sungai Selatan', 'Kandangan', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('330', '1', '21', 'Kabupaten Kotabaru', 'Kotabaru', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('331', '1', '21', 'Kabupaten Barito Kuala', 'Marabahan', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('332', '1', '21', 'Kabupaten Banjar', 'Martapura', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('333', '1', '21', 'Kabupaten Balangan', 'Paringin', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('334', '1', '21', 'Kabupaten Tanah Laut', 'Pelaihari', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('335', '1', '21', 'Kabupaten Tapin', 'Rantau', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('336', '1', '21', 'Kabupaten Tabalong', 'Tanjung', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('337', '1', '22', 'Kabupaten Barito Selatan', 'Buntok', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('338', '1', '22', 'Kabupaten Katingan', 'Kasongan', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('339', '1', '22', 'Kabupaten Kapuas', 'Kuala Kapuas', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('340', '1', '22', 'Kabupaten Gunung Mas', 'Kuala Kurun', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('341', '1', '22', 'Kabupaten Seruyan', 'Kuala Pembuang', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('342', '1', '22', 'Kabupaten Barito Utara', 'Muara Teweh', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('343', '1', '22', 'Kabupaten Lamandau', 'Nanga Bulik', null, '2014-06-21 22:49:27');
INSERT INTO `mst_regency` VALUES ('344', '1', '22', 'Kabupaten Kotawaringin Barat', 'Pangkalan Bun', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('345', '1', '22', 'Kabupaten Pulang Pisau', 'Pulang Pisau', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('346', '1', '22', 'Kabupaten Murung Raya', 'Purukcahu', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('347', '1', '22', 'Kabupaten Kotawaringin Timur', 'Sampit', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('348', '1', '22', 'Kabupaten Sukamara', 'Sukamara', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('349', '1', '22', 'Kabupaten Barito Timur', 'Tamiang', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('350', '1', '22', 'Kota Palangka Raya', 'Palangka Raya', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('351', '1', '23', 'Kabupaten Malinau', 'Malinau', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('352', '1', '23', 'Kabupaten Nunukan', 'Nunukan', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('353', '1', '23', 'Kabupaten Penajam Paser Utara', 'Penajam', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('354', '1', '23', 'Kabupaten Kutai Timur', 'Sangatta', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('355', '1', '23', 'Kabupaten Kutai Barat', 'Sendawar', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('356', '1', '23', 'Kabupaten Paser', 'Tanah Grogot', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('357', '1', '23', 'Kabupaten Berau', 'Tanjungredep', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('358', '1', '23', 'Kabupaten Bulungan', 'Tanjungselor', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('359', '1', '23', 'Kabupaten Kutai Kartanegara', 'Tenggarong', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('360', '1', '23', 'Kabupaten Tana Tidung', 'Tideng Pale', null, '2014-06-21 22:49:28');
INSERT INTO `mst_regency` VALUES ('361', '1', '23', 'Kota Balikpapan', 'Balikpapan', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('362', '1', '23', 'Kota Bontang', 'Bontang', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('363', '1', '23', 'Kota Samarinda', 'Samarinda', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('364', '1', '23', 'Kota Tarakan', 'Tarakan', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('365', '1', '24', 'Kabupaten Gorontalo', 'Gorontalo', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('366', '1', '24', 'Kabupaten Gorontalo Utara', 'Kwandang', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('367', '1', '24', 'Kabupaten Pohuwato', 'Marisa', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('368', '1', '24', 'Kabupaten Boalemo', 'Marisa/Tilamuta', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('369', '1', '24', 'Kabupaten Bone Bolango', 'Suwawa', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('370', '1', '24', 'Kota Gorontalo', 'Gorontalo', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('371', '1', '25', 'Kabupaten Bantaeng', 'Bantaeng', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('372', '1', '25', 'Kabupaten Barru', 'Barru', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('373', '1', '25', 'Kabupaten Kepulauan Selayar', 'Benteng', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('374', '1', '25', 'Kabupaten Bulukumba', 'Bulukumba', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('375', '1', '25', 'Kabupaten Enrekang', 'Enrekang', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('376', '1', '25', 'Kabupaten Jeneponto', 'Jeneponto', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('377', '1', '25', 'Kabupaten Tana Toraja', 'Makale', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('378', '1', '25', 'Kabupaten Luwu Timur', 'Malili', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('379', '1', '25', 'Kabupaten Maros', 'Maros', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('380', '1', '25', 'Kabupaten Luwu Utara', 'Masamba', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('381', '1', '25', 'Kabupaten Luwu', 'Palopo', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('382', '1', '25', 'Kabupaten Pangkajene dan Kepulauan', 'Pangkajene', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('383', '1', '25', 'Kabupaten Pinrang', 'Pinrang', null, '2014-06-21 22:49:29');
INSERT INTO `mst_regency` VALUES ('384', '1', '25', 'Kabupaten Toraja Utara', 'Rantepao', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('385', '1', '25', 'Kabupaten Wajo', 'Sengkang', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('386', '1', '25', 'Kabupaten Sidenreng Rappang', 'Sidenreng', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('387', '1', '25', 'Kabupaten Sinjai', 'Sinjai', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('388', '1', '25', 'Kabupaten Gowa', 'Sunggu Minasa', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('389', '1', '25', 'Kabupaten Takalar', 'Takalar', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('390', '1', '25', 'Kabupaten Bone', 'Watampone', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('391', '1', '25', 'Kabupaten Soppeng', 'Watan Soppeng', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('392', '1', '25', 'Kota Makassar', 'Makassar', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('393', '1', '25', 'Kota Palopo', 'Palopo', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('394', '1', '25', 'Kota Parepare', 'Parepare', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('395', '1', '26', 'Kabupaten Konawe Selatan', 'Andolo', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('396', '1', '26', 'Kabupaten Buton', 'BauBau', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('397', '1', '26', 'Kabupaten Buton Utara', 'Buranga', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('398', '1', '26', 'Kabupaten Kolaka', 'Kolaka', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('399', '1', '26', 'Kabupaten Kolaka Utara', 'Lasusua', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('400', '1', '26', 'Kabupaten Muna', 'Raha', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('401', '1', '26', 'Kabupaten Bombana', 'Rumbia', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('402', '1', '26', 'Kabupaten Konawe', 'Unaaha', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('403', '1', '26', 'Kabupaten Konawe Utara', 'Wanggudu', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('404', '1', '26', 'Kabupaten Wakatobi', 'WangiWangi', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('405', '1', '26', 'Kota BauBau', 'BauBau', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('406', '1', '26', 'Kota Kendari', 'Kendari', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('407', '1', '27', 'Kabupaten Tojo UnaUna', 'Ampana', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('408', '1', '27', 'Kabupaten Banggai Kepulauan', 'Banggai', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('409', '1', '27', 'Kabupaten Morowali', 'Bungku', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('410', '1', '27', 'Kabupaten Buol', 'Buol', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('411', '1', '27', 'Kabupaten Donggala', 'Donggala', null, '2014-06-21 22:49:30');
INSERT INTO `mst_regency` VALUES ('412', '1', '27', 'Kabupaten Banggai', 'Luwuk', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('413', '1', '27', 'Kabupaten Parigi Moutong', 'Parigi', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('414', '1', '27', 'Kabupaten Poso', 'Poso', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('415', '1', '27', 'Kabupaten Sigi', 'Sigi Biromaru', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('416', '1', '27', 'Kabupaten ToliToli', 'ToliToli', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('417', '1', '27', 'Kota Palu', 'Palu', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('418', '1', '28', 'Kabupaten Minahasa Utara', 'Airmadidi', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('419', '1', '28', 'Kabupaten Minahasa Selatan', 'Amurang', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('420', '1', '28', 'Kabupaten Bolaang Mongondow Selatan', 'Bolaang Uki', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('421', '1', '28', 'Kabupaten Bolaang Mongondow Utara', 'Boroko', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('422', '1', '28', 'Kabupaten Bolaang Mongondow', 'Kotamobagu', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('423', '1', '28', 'Kabupaten Kepulauan Talaud', 'Melonguane', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('424', '1', '28', 'Kabupaten Kepulauan Siau Tagulandang Bia', 'Ondong Siau', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('425', '1', '28', 'Kabupaten Minahasa Tenggara', 'Ratahan', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('426', '1', '28', 'Kabupaten Kepulauan Sangihe', 'Tahuna', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('427', '1', '28', 'Kabupaten Minahasa', 'Tondano', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('428', '1', '28', 'Kabupaten Bolaang Mongondow Timur', 'Tutuyan', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('429', '1', '28', 'Kota Bitung', 'Bitung', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('430', '1', '28', 'Kota Kotamobagu', 'Kotamobagu', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('431', '1', '28', 'Kota Manado', 'Manado', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('432', '1', '28', 'Kota Tomohon', 'Tomohon', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('433', '1', '29', 'Kabupaten Majene', 'Majene', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('434', '1', '29', 'Kabupaten Mamasa', 'Mamasa', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('435', '1', '29', 'Kabupaten Mamuju', 'Mamuju', null, '2014-06-21 22:49:31');
INSERT INTO `mst_regency` VALUES ('436', '1', '29', 'Kabupaten Mamuju Utara', 'Pasangkayu', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('437', '1', '29', 'Kabupaten Polewali Mandar', 'Polewali', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('438', '1', '30', 'Kabupaten Seram Bagian Timur', 'Dataran Hunimoa', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('439', '1', '30', 'Kabupaten Seram Bagian Barat', 'Dataran Hunipopu', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('440', '1', '30', 'Kabupaten Maluku Tengah', 'Masohi', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('441', '1', '30', 'Kabupaten Buru', 'Namlea', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('442', '1', '30', 'Kabupaten Buru Selatan', 'Namrole', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('443', '1', '30', 'Kabupaten Kepulauan Aru', 'Oobo', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('444', '1', '30', 'Kabupaten Maluku Tenggara Barat', 'Saumlaki', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('445', '1', '30', 'Kabupaten Maluku Barat Daya', 'Tiakur', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('446', '1', '30', 'Kabupaten Maluku Tenggara', 'Tual', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('447', '1', '30', 'Kota Ambon', 'Ambon', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('448', '1', '30', 'Kota Tual', 'Tual', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('449', '1', '31', 'Kabupaten Halmahera Barat', 'Jailolo', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('450', '1', '31', 'Kabupaten Halmahera Selatan', 'Labuha', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('451', '1', '31', 'Kabupaten Halmahera Timur', 'Maba', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('452', '1', '31', 'Kabupaten Pulau Morotai', 'Morotai Selatan', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('453', '1', '31', 'Kabupaten Kepulauan Sula', 'Sanana', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('454', '1', '31', 'Kabupaten Halmahera Utara', 'Tobelo', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('455', '1', '31', 'Kabupaten Halmahera Tengah', 'Weda', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('456', '1', '31', 'Kota Ternate', 'Ternate', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('457', '1', '31', 'Kota Tidore Kepulauan', 'Tidore Kepulauan', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('458', '1', '32', 'Kabupaten Asmat', 'Agats', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('459', '1', '32', 'Kabupaten Biak Numfor', 'Biak', null, '2014-06-21 22:49:32');
INSERT INTO `mst_regency` VALUES ('460', '1', '32', 'Kabupaten Waropen', 'Botawa', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('461', '1', '32', 'Kabupaten Mamberamo Raya', 'Burmeso', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('462', '1', '32', 'Kabupaten Yalimo', 'Elelim', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('463', '1', '32', 'Kabupaten Paniai', 'Enarotali', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('464', '1', '32', 'Kabupaten Puncak', 'Ilaga', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('465', '1', '32', 'Kabupaten Tolikara', 'Karubaga', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('466', '1', '32', 'Kabupaten Nduga', 'Kenyam', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('467', '1', '32', 'Kabupaten Mappi', 'Kepi', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('468', '1', '32', 'Kabupaten Dogiyai', 'Kigamani', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('469', '1', '32', 'Kabupaten Mamberamo Tengah', 'Kobakma', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('470', '1', '32', 'Kabupaten Puncak Jaya', 'Kotamulia', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('471', '1', '32', 'Kabupaten Merauke', 'Merauke', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('472', '1', '32', 'Kabupaten Nabire', 'Nabire', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('473', '1', '32', 'Kabupaten Pegunungan Bintang', 'Oksibil', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('474', '1', '32', 'Kabupaten Sarmi', 'Sarmi', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('475', '1', '32', 'Kabupaten Jayapura', 'Sentani', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('476', '1', '32', 'Kabupaten Kepulauan Yapen', 'Serui', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('477', '1', '32', 'Kabupaten Supiori', 'Sorendiweri', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('478', '1', '32', 'Kabupaten Intan Jaya', 'Sugapa', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('479', '1', '32', 'Kabupaten Yahukimo', 'Sumohai', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('480', '1', '32', 'Kabupaten Boven Digoel', 'Tanah Merah', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('481', '1', '32', 'Kabupaten Deiyai', 'Tigi', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('482', '1', '32', 'Kabupaten Mimika', 'Timika', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('483', '1', '32', 'Kabupaten Lanny Jaya', 'Tiom', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('484', '1', '32', 'Kabupaten Jayawijaya', 'Wamena', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('485', '1', '32', 'Kabupaten Keerom', 'Waris', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('486', '1', '32', 'Kota Jayapura', 'Jayapura', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('487', '1', '33', 'Kabupaten Teluk Bintuni', 'Bintuni', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('488', '1', '33', 'Kabupaten Fakfak', 'Fakfak', null, '2014-06-21 22:49:33');
INSERT INTO `mst_regency` VALUES ('489', '1', '33', 'Kabupaten Tambrauw', 'Fef', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('490', '1', '33', 'Kabupaten Kaimana', 'Kaimana', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('491', '1', '33', 'Kabupaten Maybrat', 'Kumurkek', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('492', '1', '33', 'Kabupaten Manokwari', 'Manokwari', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('493', '1', '33', 'Kabupaten Teluk Wondama', 'Rasiei', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('494', '1', '33', 'Kabupaten Sorong', 'Sorong', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('495', '1', '33', 'Kabupaten Sorong Selatan', 'Teminabuan', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('496', '1', '33', 'Kabupaten Raja Ampat', 'Waisai', null, '2014-06-21 22:49:34');
INSERT INTO `mst_regency` VALUES ('497', '1', '33', 'Kota Sorong', 'Sorong', null, '2014-06-21 22:49:34');
INSERT INTO `mst_religion` VALUES ('1', 'Islam', null, '2014-06-21 22:49:57');
INSERT INTO `mst_religion` VALUES ('2', 'Hindu', null, '2014-06-21 22:49:57');
INSERT INTO `mst_religion` VALUES ('3', 'Kristen', null, '2014-06-21 22:49:57');
INSERT INTO `mst_religion` VALUES ('4', 'Budha', null, '2014-06-21 22:49:57');
INSERT INTO `mst_religion` VALUES ('5', 'Katolik', null, '2014-06-21 22:49:57');
INSERT INTO `mst_religion` VALUES ('6', 'Lainnya', null, '2014-06-21 22:49:57');
INSERT INTO `mst_shift` VALUES ('1', 'shift malam', '00:01:00', '08:00:00', null, '2012-11-25 08:44:59');
INSERT INTO `mst_shift` VALUES ('2', 'shift pagi', '08:00:00', '16:00:00', null, '2012-11-25 08:46:03');
INSERT INTO `mst_shift` VALUES ('3', 'shift sore', '16:00:00', '24:00:00', null, '2012-11-25 08:46:30');
INSERT INTO `mst_supplier` VALUES ('KF', 'Kimia Farma', 'Jalan Jendran Gatot Subroto', null, null, null, null, null, null, null, null, '2014-07-17 09:48:03');
INSERT INTO `mst_treathment` VALUES ('11', 'Injeksi Intravena', null, '2', '10000', '1000');
INSERT INTO `mst_treathment` VALUES ('12', 'Injeksi', null, '2', '5000', '1000');
INSERT INTO `mst_type_user` VALUES ('1', 'dokter');
INSERT INTO `mst_type_user` VALUES ('2', 'rekam medis');
INSERT INTO `mst_type_user` VALUES ('3', 'kasir');
INSERT INTO `mst_type_user` VALUES ('4', 'apoteker');
INSERT INTO `mst_type_user` VALUES ('5', 'receptionist');
INSERT INTO `ptn_family` VALUES ('2', '12345678', 'Ponijan', 'L', '1', 'Sanggrahan lor Bendungan Wates Kulon Progo Yogyakarta', '085743506887', '', '', '1', null, '2014-07-12 22:53:51');
INSERT INTO `ptn_family` VALUES ('3', '11111111', 'Ponijan', 'L', '1', 'Sanggrahan lor bendungan wates KP', '', '', '', '1', null, '2014-07-29 09:11:14');
INSERT INTO `ptn_family` VALUES ('4', '22222222', 'Sawitri', 'P', '1', 'Jalan sanggrahan lor bendungan wates KP', '0909090909', '', '', '1', null, '2014-07-29 16:06:24');
INSERT INTO `ptn_social_data` VALUES ('11111111', 'Dimas Hanafi', 'L', 'Yogyakarta', '1996-1-19', '18', 'A', '   ', '', '', '', '', '', '1', '', '', '', '', '0898787878', '2014-07-29 09:10:51', '1', null, '0000-00-00 00:00:00', '');
INSERT INTO `ptn_social_data` VALUES ('12345678', 'Sigit Hanafi', 'L', 'Yogyakarta', '1991-6-26', '23', 'O', 'Sanggrahan Lor 13/06 Bendungan Wates', '13/06', 'Bendungan', 'Wates', '267', '16', '1', '1', '1', '36', '1', '085743506887', '2014-07-12 22:53:16', '1', null, '0000-00-00 00:00:00', 'Sanggrahan Lor');
INSERT INTO `ptn_social_data` VALUES ('12345679', 'Ibo Wibowo', 'L', 'Yogyakarta', '2008-7-20', '5', 'A', '   ', '', '', '', '', '', '', '', '', '', '', '085643506887', '2014-07-19 07:50:19', '1', null, '0000-00-00 00:00:00', '');
INSERT INTO `ptn_social_data` VALUES ('12356789', 'Asep', 'L', 'Garut', '2000-8-17', '13', 'A', 'Ciledug 01/02 Ngamplang Sari Cilawu', '01/02', 'Ngamplang Sari', 'Cilawu', '172', '12', '', '1', '1', '32', '1', '0000000000000', '2014-07-19 12:37:49', '1', null, '0000-00-00 00:00:00', 'Ciledug');
INSERT INTO `ptn_social_data` VALUES ('22222222', 'Nanda', 'L', 'Yogyakarta', '2001-1-20', '13', 'B', 'Jalan Sanggrahan Lor Bendungan Wates KP 08/09 sanggrahan Lor Wates', '08/09', 'sanggrahan Lor', 'Wates', '267', '16', '', '', '', '', '', '09898989898', '2014-07-29 16:05:54', '1', null, '0000-00-00 00:00:00', 'Jalan Sanggrahan Lor Bendungan Wates KP');
INSERT INTO `ptn_social_data` VALUES ('33333333', 'Burhanudin', 'L', 'Yogyakarta', '1990-7-20', '24', 'AB', 'Godean moyudan 10/02 Moyudan Godean', '10/02', 'Moyudan', 'Godean', '265', '16', '', '', '', '', '', '08198989898989', '2014-07-29 16:59:08', '1', null, '0000-00-00 00:00:00', 'Godean moyudan');
INSERT INTO `sys_group` VALUES ('1', 'super admin', 'home', '1', null, '2014-07-15 01:08:09');
INSERT INTO `sys_group` VALUES ('2', 'admin', 'home', '1', null, '2014-07-15 01:08:09');
INSERT INTO `sys_group` VALUES ('3', 'dokter poli', 'home', '1', null, '2014-07-15 01:08:27');
INSERT INTO `sys_menu` VALUES ('2', '0', 'pendaftaran/pendaftaran_rawat_jalan', 'pendaftaran rawat jalan', '1', '1', null, '2014-06-21 22:52:38');
INSERT INTO `sys_menu` VALUES ('5', '0', 'pelayanan_informasi/informasi_pasien', 'informasi pasien', '1', '2', null, '2014-06-21 22:52:39');
INSERT INTO `sys_menu` VALUES ('6', '0', 'pelayanan_informasi/jadwal_dokter', 'jadwal dokter', '1', '2', null, '2014-06-21 22:52:39');
INSERT INTO `sys_menu` VALUES ('9', '0', 'rawat_jalan/poli_umum', 'poli umum', '1', '3', null, '2014-07-17 22:37:27');
INSERT INTO `sys_menu` VALUES ('10', '0', 'rawat_jalan/poli_anak', 'poli anak', '1', '3', null, '2014-07-17 22:37:41');
INSERT INTO `sys_menu` VALUES ('11', '0', 'kasir', 'Kasir', '1', '4', null, '2014-07-29 14:00:57');
INSERT INTO `sys_menu` VALUES ('14', '0', 'apotek/resep_pasien', 'resep pasien', '1', '5', null, '2014-06-21 22:52:39');
INSERT INTO `sys_menu` VALUES ('15', '0', 'apotek/pembelian_umum', 'pembelian umum', '1', '5', null, '2014-07-30 14:24:13');
INSERT INTO `sys_menu` VALUES ('16', '0', 'gudang_farmasi/purchase_request', 'purchase request', '0', '6', null, '2014-06-29 13:59:37');
INSERT INTO `sys_menu` VALUES ('17', '0', 'gudang_farmasi/purchase_order', 'purchase order', '0', '6', null, '2014-06-29 13:59:31');
INSERT INTO `sys_menu` VALUES ('18', '0', 'gudang_farmasi/receive_item', 'receive item', '0', '6', null, '2014-06-29 13:59:29');
INSERT INTO `sys_menu` VALUES ('19', '0', 'gudang_farmasi/retur', 'retur', '0', '6', null, '2014-06-29 13:59:28');
INSERT INTO `sys_menu` VALUES ('20', '0', 'gudang_farmasi/stok', 'stok', '0', '6', null, '2014-06-29 13:59:26');
INSERT INTO `sys_menu` VALUES ('21', '0', 'gudang_farmasi/transfer_item', 'transfer item', '0', '6', null, '2014-06-29 13:59:25');
INSERT INTO `sys_menu` VALUES ('22', '0', 'pendaftaran/daftar_pasien', 'daftar pasien', '0', '1', null, '2014-07-07 17:01:59');
INSERT INTO `sys_menu` VALUES ('24', '0', 'gudang_farmasi/pos_item', 'pos_item', '0', '6', null, '2014-06-29 13:59:22');
INSERT INTO `sys_menu` VALUES ('25', '0', 'lab/antrian', 'antrian lab', '1', '8', null, '2014-07-29 21:04:18');
INSERT INTO `sys_menu` VALUES ('27', '0', 'pelaporan/rawat_jalan', 'laporan kunjungan', '1', '9', null, '2014-07-14 21:56:57');
INSERT INTO `sys_menu` VALUES ('28', '27', 'pelaporan/rawat_jalan', 'kunjungan rawat jalan', '1', '9', null, '2014-07-14 21:57:59');
INSERT INTO `sys_menu` VALUES ('29', '27', 'pelaporan/rawat_jalan', 'kunjungan rawat inap', '1', '9', null, '2014-07-17 23:05:26');
INSERT INTO `sys_menu` VALUES ('30', '0', 'master/data_dokter', 'data dokter', '0', '7', null, '2014-07-05 14:37:58');
INSERT INTO `sys_menu` VALUES ('31', '0', 'master/data_tindakan', 'data tindakan', '1', '7', null, '2014-07-03 00:52:30');
INSERT INTO `sys_menu` VALUES ('32', '0', 'master/data_diagnosa', 'data diagnosa', '1', '7', null, '2014-07-03 00:52:47');
INSERT INTO `sys_menu` VALUES ('33', '0', 'master/data_obat', 'data obat', '1', '7', null, '2014-07-03 00:53:11');
INSERT INTO `sys_menu` VALUES ('34', '0', 'master/data_pegawai', 'data pegawai', '1', '7', null, '2014-07-03 00:54:33');
INSERT INTO `sys_menu` VALUES ('35', '0', 'master/data_user', 'data user', '1', '7', null, '2014-07-11 02:34:44');
INSERT INTO `sys_menu` VALUES ('36', '27', 'pelaporan/lab', 'kunjungan lab', '1', '9', null, '2014-07-14 21:58:35');
INSERT INTO `sys_menu` VALUES ('38', '0', 'gudang/purchase_order', 'purchase order', '1', '11', null, '2014-07-17 09:33:46');
INSERT INTO `sys_menu` VALUES ('39', '0', 'gudang/receive_item', 'receive item', '1', '11', null, '2014-07-17 09:33:54');
INSERT INTO `sys_menu` VALUES ('40', '0', 'gudang/retur', 'retur', '1', '11', null, '2014-07-17 09:34:08');
INSERT INTO `sys_menu` VALUES ('41', '0', 'gudang/stok', 'stok', '1', '11', null, '2014-07-17 09:34:28');
INSERT INTO `sys_menu` VALUES ('42', '0', 'rawat_jalan/poli_gigi', 'poli gigi', '1', '3', null, '2014-07-17 22:39:51');
INSERT INTO `sys_menu` VALUES ('43', '27', 'pelaporan/pembelian_umum', 'pembelian umum', '1', '9', null, '2014-08-01 18:28:23');
INSERT INTO `sys_menu` VALUES ('44', '0', 'lab/pemeriksaan', 'data pemeriksaan lab', '1', '8', null, '2014-08-02 23:32:29');
INSERT INTO `sys_module` VALUES ('1', 'pendaftaran', 'pendaftaran', '1', null, '2014-07-18 00:11:25');
INSERT INTO `sys_module` VALUES ('2', 'pelayanan informasi', 'pelayanan_informasi', '1', null, '2014-07-18 00:12:09');
INSERT INTO `sys_module` VALUES ('3', 'rawat jalan', 'rawat_jalan', '1', null, '2014-07-18 00:12:23');
INSERT INTO `sys_module` VALUES ('4', 'kasir', 'kasir', '1', null, '2014-07-18 00:12:49');
INSERT INTO `sys_module` VALUES ('5', 'apotek', 'apotek', '1', null, '2014-07-18 00:13:03');
INSERT INTO `sys_module` VALUES ('6', 'gudang farmasi', 'gudang_farmasi', '1', null, '2014-07-18 00:13:19');
INSERT INTO `sys_module_role` VALUES ('1', '1', '1', '2014-07-18 00:20:03');
INSERT INTO `sys_module_role` VALUES ('2', '1', '1', '2014-07-19 06:04:56');
INSERT INTO `sys_module_role` VALUES ('3', '1', '1', '2014-07-19 06:05:06');
INSERT INTO `sys_module_role` VALUES ('4', '1', '1', '2014-07-19 06:15:01');
INSERT INTO `sys_module_role` VALUES ('5', '1', '1', '2014-07-19 06:15:10');
INSERT INTO `sys_module_role` VALUES ('6', '1', '1', '2014-07-19 06:15:24');
INSERT INTO `sys_user` VALUES ('1', '1', 'jike', '49deebdfb953a2f52e2ac0931cf29b72', '1', '2014-07-15 01:21:37', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `trx_diagnosa_treathment` VALUES ('14070001', 'DA-14070001', null, '2014-07-29 11:03:33');
INSERT INTO `trx_diagnosa_treathment` VALUES ('14070003', 'DA-14070002', null, '2014-07-29 16:08:57');
INSERT INTO `trx_diagnosa_treathment` VALUES ('14070004', 'DA-14070003', null, '2014-07-29 17:59:31');
INSERT INTO `trx_diagnosa_treathment` VALUES ('14070006', 'DA-14070004', null, '2014-07-29 22:25:18');
INSERT INTO `trx_diagnosa_treathment` VALUES ('14070008', 'DA-14080001', null, '2014-08-01 14:35:00');
INSERT INTO `trx_diagnosa_treathment_detail` VALUES ('14070001', 'DA-14070001', 'new', null, '2014-07-29 12:27:53', 'AX98', '11', 'Catatan diagnosa', '1000', '10000');
INSERT INTO `trx_diagnosa_treathment_detail` VALUES ('14070001', 'DA-14070001', 'new', null, '2014-07-29 12:27:53', '', '0', 'Diagnosa amnesia ringan', '0', '0');
INSERT INTO `trx_diagnosa_treathment_detail` VALUES ('14070003', 'DA-14070002', 'new', null, '2014-07-29 16:10:23', 'ISPA', '12', 'Ispa', '1000', '5000');
INSERT INTO `trx_diagnosa_treathment_detail` VALUES ('14070003', 'DA-14070002', 'new', null, '2014-07-29 16:10:23', '', '0', 'Demam', '0', '0');
INSERT INTO `trx_diagnosa_treathment_detail` VALUES ('14070004', 'DA-14070003', 'new', null, '2014-07-29 17:59:31', '', '12', 'ISPA Tinggi', '1000', '5000');
INSERT INTO `trx_diagnosa_treathment_detail` VALUES ('14070006', 'DA-14070004', 'old', null, '2014-07-29 22:25:18', '', '0', 'Ispa', '0', '0');
INSERT INTO `trx_diagnosa_treathment_detail` VALUES ('14070008', 'DA-14080001', 'new', null, '2014-08-01 14:35:00', 'ISPA', '0', '-', '0', '0');
INSERT INTO `trx_direct_buy` VALUES ('14080001', 'PU-1408000', '1', null, null, null);
INSERT INTO `trx_direct_buy` VALUES ('14080003', 'PU-14080003', '1', null, null, null);
INSERT INTO `trx_direct_buy` VALUES ('14080004', 'PU-14080004', '1', null, null, null);
INSERT INTO `trx_direct_buy_detail` VALUES ('PU-14080003', '2', '3', '10000.00', '30000.00');
INSERT INTO `trx_direct_buy_detail` VALUES ('PU-1408000', '1', '3', '200.00', '600.00');
INSERT INTO `trx_direct_buy_detail` VALUES ('PU-1408000', '2', '3', '10000.00', '30000.00');
INSERT INTO `trx_direct_buy_detail` VALUES ('PU-14080003', '1', '2', '200.00', '400.00');
INSERT INTO `trx_direct_buy_detail` VALUES ('PU-14080004', '2', '2', '10000.00', '20000.00');
INSERT INTO `trx_dokter_fee` VALUES ('1', '3', '10000.00', '1', '0', '0000-00-00 00:00:00');
INSERT INTO `trx_dr_schedule` VALUES ('1', '3', '1', 'Senin', '2', '2', '1', '2014-07-15 02:11:07');
INSERT INTO `trx_dr_schedule` VALUES ('2', '3', '2', 'Selasa', '1', '2', '1', '2014-07-15 02:11:09');
INSERT INTO `trx_dr_schedule` VALUES ('3', '2', '3', 'Rabu', '3', '2', '1', '2014-07-15 02:11:13');
INSERT INTO `trx_lab_queue` VALUES ('14070005', '33333333', '1', '2014-07-29 18:48:02', '1', '1', null, '2014-08-02 23:45:10', '3');
INSERT INTO `trx_lab_queue` VALUES ('14070007', '12345678', '2', '2014-07-29 22:28:09', '1', '1', null, '2014-07-29 21:52:50', '3');
INSERT INTO `trx_lab_treathment` VALUES ('14070005', 'PD-14070001', '3', 'Golongan darah (ABO Rh)', '2000.00', '50000.00');
INSERT INTO `trx_lab_treathment` VALUES ('14070007', 'PD-14070002', '4', 'Paket 1: Darah Rutin,SGOT,SGPT', '2000.00', '150000.00');
INSERT INTO `trx_lab_treathment_detail` VALUES ('14070005', 'PD-14070001', '10003', 'Leukosit 2', '5000', null, 'L: 4000-6000, P: 4000-6000', '/mm3');
INSERT INTO `trx_lab_treathment_detail` VALUES ('14070007', 'PD-14070002', '10002', 'Leukosit', '12000', 'http://localhost/simrs_ih/uploads/labs/14070007_elementaryos.png', 'L: 4000-10000, P: 4000-10000', '/mm3');
INSERT INTO `trx_lab_treathment_detail` VALUES ('14070007', 'PD-14070002', '10004', 'Hemoglobin 2', '18', null, 'L: 13-17, P: 12-16', 'g/dl');
INSERT INTO `trx_lab_treathment_detail` VALUES ('14070007', 'PD-14070002', '10005', 'HB', '18', null, 'L: 12-14, P: 12-14', 'g/dl');
INSERT INTO `trx_medical` VALUES ('14070001', '12345678', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14070003', '22222222', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14070004', '33333333', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14070005', '12345678', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14070006', '12345678', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14070008', '12345678', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14080005', '12345678', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14080006', '12345678', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical` VALUES ('14080007', '12345678', null, '0000-00-00 00:00:00', '2', '3');
INSERT INTO `trx_medical_anamnesa` VALUES ('15', '14070001', 'Panas dan pusing', 'panas tinggi', 'panas tinggi dan demam', 'panas demam, pusing, ', '0', '2014-07-29 11:48:59');
INSERT INTO `trx_medical_anamnesa` VALUES ('16', '14070003', 'Panas Demam Batuk batuk', 'ispa', 'ispa', 'pusing, ', '0', '2014-07-29 16:08:39');
INSERT INTO `trx_medical_anamnesa` VALUES ('17', '14070004', 'Panas tinggi, demam', 'Demam tinggi', 'ISPA', 'panas demam, ', '0', '2014-07-29 17:59:09');
INSERT INTO `trx_medical_anamnesa` VALUES ('18', '14070006', 'Panas demam', 'Panas tinggi', 'ISPA', 'panas demam, ', '0', '2014-07-29 22:25:11');
INSERT INTO `trx_medical_anamnesa` VALUES ('19', '14070008', 'Panas Demam', 'Panas Demam', 'Panas demam', 'panas demam, ', '0', '2014-08-01 14:34:47');
INSERT INTO `trx_medical_lab` VALUES ('14070004', '14070005', null, '2014-07-29 17:48:01');
INSERT INTO `trx_medical_lab` VALUES ('14070006', '14070007', null, '2014-07-29 21:28:09');
INSERT INTO `trx_medical_ptn_now` VALUES ('14070001', '80', '180', '110', '80', 'Sadar', '12', '12', '28');
INSERT INTO `trx_medical_ptn_now` VALUES ('14070003', '70', '180', '110', '80', 'Sadar', '10', '12', '26');
INSERT INTO `trx_medical_ptn_now` VALUES ('14070004', '0', '0', '0', '0', 'Sadar', '0', '0', '0');
INSERT INTO `trx_medical_ptn_now` VALUES ('14070005', '0', '0', '0', '0', '', '0', '0', '0');
INSERT INTO `trx_medical_ptn_now` VALUES ('14070006', '0', '0', '0', '0', 'Sadar', '0', '0', '0');
INSERT INTO `trx_medical_ptn_now` VALUES ('14070008', '70', '180', '110', '80', 'Sadar', '12', '12', '26');
INSERT INTO `trx_medical_ptn_now` VALUES ('14080005', '80', '180', '110', '80', 'sadar', '80', '80', '28');
INSERT INTO `trx_medical_ptn_now` VALUES ('14080006', '0', '0', '0', '0', '', '0', '0', '0');
INSERT INTO `trx_medical_ptn_now` VALUES ('14080007', '0', '0', '0', '0', '', '0', '0', '0');
INSERT INTO `trx_queue_outpatient` VALUES ('14070001', '12345678', '1', '2014-07-29 00:00:00', '3', '2', '1', '1', '2014-07-29 18:14:08', '2');
INSERT INTO `trx_queue_outpatient` VALUES ('14070002', '11111111', '2', '2014-07-29 00:00:00', '3', '1', '1', '1', '2014-07-29 09:14:04', '1');
INSERT INTO `trx_queue_outpatient` VALUES ('14070003', '22222222', '3', '2014-07-29 00:00:00', '3', '2', '1', '1', '2014-07-30 10:09:43', '3');
INSERT INTO `trx_queue_outpatient` VALUES ('14070004', '33333333', '4', '2014-07-29 00:00:00', '3', '2', '1', '1', '2014-07-29 19:10:34', '2');
INSERT INTO `trx_queue_outpatient` VALUES ('14070006', '12345678', '5', '2014-07-29 00:00:00', '3', '2', '1', '1', '2014-07-29 22:25:52', '3');
INSERT INTO `trx_queue_outpatient` VALUES ('14070008', '12345678', '6', '2014-07-30 00:00:00', '3', '2', '1', '1', '2014-08-01 14:35:24', '2');
INSERT INTO `trx_queue_outpatient` VALUES ('14080005', '12345678', '1', '2014-08-02 00:00:00', '3', '2', '1', '1', '2014-08-02 21:41:32', '2');
INSERT INTO `trx_queue_outpatient` VALUES ('14080006', '12345678', '2', '2014-08-02 00:00:00', '3', '2', '1', '1', '2014-08-02 22:00:28', '3');
INSERT INTO `trx_queue_outpatient` VALUES ('14080007', '12345678', '3', '2014-08-06 00:00:00', '3', '2', '1', '1', '2014-08-06 09:20:48', '1');
INSERT INTO `trx_recipe` VALUES ('14070001', 'RS-14070001', '0');
INSERT INTO `trx_recipe` VALUES ('14070003', 'RS-14070002', '0');
INSERT INTO `trx_recipe` VALUES ('14070004', 'RS-14070003', '0');
INSERT INTO `trx_recipe` VALUES ('14070006', 'RS-14070004', '0');
INSERT INTO `trx_recipe` VALUES ('14070008', 'RS-14080001', '0');
INSERT INTO `trx_recipe` VALUES ('14080005', 'RS-14080002', '0');
INSERT INTO `trx_recipe` VALUES ('14080006', 'RS-14080003', '0');
INSERT INTO `trx_recipe_detail` VALUES ('14070001', 'RS-14070001', '1', '3 X 1 Setelah Makan', '-', '10', null, '2014-07-29 11:26:06', '1', '2000');
INSERT INTO `trx_recipe_detail` VALUES ('14070001', 'RS-14070001', '2', '3 X 1 Setelah Makan', '', '10', null, '2014-07-29 11:26:06', '2', '100000');
INSERT INTO `trx_recipe_detail` VALUES ('14070003', 'RS-14070002', '2', '2 X 1 Setelah Makan', '-', '10', null, '2014-07-29 16:15:00', '1', '100000');
INSERT INTO `trx_recipe_detail` VALUES ('14070003', 'RS-14070002', '1', '3 X 1 Setelah Makan', '-', '10', null, '2014-07-29 16:15:00', '2', '2000');
INSERT INTO `trx_recipe_detail` VALUES ('14070004', 'RS-14070003', '2', '3 X 1 Setelah Makan', null, '10', null, '2014-07-29 18:04:26', '1', '100000');
INSERT INTO `trx_recipe_detail` VALUES ('14070006', 'RS-14070004', '2', '3 X 1 Setelah Makan', null, '8', null, '2014-07-29 22:25:31', '1', '80000');
INSERT INTO `trx_recipe_detail` VALUES ('14070008', 'RS-14080001', '2', '3 X 1 Setelah Makan', null, '8', null, '2014-08-01 14:35:17', '1', '80000');
INSERT INTO `trx_recipe_detail` VALUES ('14080005', 'RS-14080002', '2', '3 X 1 Setelah Makan', null, '3', null, '2014-08-02 21:34:18', '1', '30000');
INSERT INTO `trx_recipe_detail` VALUES ('14080006', 'RS-14080003', '2', '3 X 1 Setelah Makan', null, '3', null, '2014-08-02 21:43:34', '1', '30000');
INSERT INTO `trx_reference` VALUES ('14070001', '7', '3', '2014-07-29', '2014-07-31', '', 'Surat Keterangan Sakit', null, null, '2014/Jul/29/SKet/14070001');
INSERT INTO `trx_reference` VALUES ('14070003', '8', '3', '2014-07-29', '2014-07-31', '-', 'Surat Keterangan Sakit', null, null, '2014/Jul/29/SKet/14070003');
INSERT INTO `trx_reference` VALUES ('14070008', '9', '3', '2014-07-30', '2014-08-02', '', 'Surat Keterangan Sakit', null, null, '2014/Jul/30/SKet/14070008');
INSERT INTO `trx_visit` VALUES ('14070001', '12345678', 'rajal', '2014-07-29 22:21:26', '2014-07-29 22:52:50', '5');
INSERT INTO `trx_visit` VALUES ('14070003', '22222222', 'rajal', '2014-07-30 11:17:15', '2014-07-30 11:09:43', '5');
INSERT INTO `trx_visit` VALUES ('14070004', '33333333', 'rajal', '2014-07-29 22:19:56', '2014-07-29 22:52:50', '5');
INSERT INTO `trx_visit` VALUES ('14070005', '33333333', 'lab', '2014-08-02 23:45:10', '2014-08-03 00:45:10', '5');
INSERT INTO `trx_visit` VALUES ('14070006', '12345678', 'rajal', '2014-07-29 22:26:36', '2014-07-29 23:25:52', '5');
INSERT INTO `trx_visit` VALUES ('14070007', '12345678', 'lab', '2014-07-29 22:00:20', '2014-07-29 22:52:50', '5');
INSERT INTO `trx_visit` VALUES ('14070008', '12345678', 'rajal', '2014-08-02 21:59:29', '0000-00-00 00:00:00', '4');
INSERT INTO `trx_visit` VALUES ('14080001', '14080001', 'pembelian umum', '2014-08-01 19:17:52', '2014-08-01 19:40:48', '5');
INSERT INTO `trx_visit` VALUES ('14080003', '14080003', 'pembelian umum', '2014-08-01 14:45:35', '2014-08-01 15:45:35', '4');
INSERT INTO `trx_visit` VALUES ('14080004', '14080004', 'pembelian umum', '2014-08-01 19:26:18', '2014-08-01 20:26:18', '4');
INSERT INTO `trx_visit` VALUES ('14080005', '12345678', 'rajal', '2014-08-02 21:56:56', '0000-00-00 00:00:00', '5');
INSERT INTO `trx_visit` VALUES ('14080006', '12345678', 'rajal', '2014-08-02 22:03:15', '2014-08-02 23:00:28', '5');
INSERT INTO `trx_visit` VALUES ('14080007', '12345678', 'rajal', '2014-08-06 10:20:55', '0000-00-00 00:00:00', '2');
INSERT INTO `trx_visit_bill` VALUES ('17', '14070001', null, '1', '', '200000.00', '113000.00', '', '4', null, '2014-07-29 20:36:28');
INSERT INTO `trx_visit_bill` VALUES ('21', '14070003', null, '1', '', '0.00', '108000.00', '', '4', null, '2014-07-30 10:07:08');
INSERT INTO `trx_visit_bill` VALUES ('24', '14070005', null, '1', '', '94000.00', '52000.00', '', '4', null, '2014-07-29 20:33:51');
INSERT INTO `trx_visit_bill` VALUES ('25', '14070004', null, '1', '', '106000.00', '106000.00', '', '4', null, '2014-07-29 20:30:21');
INSERT INTO `trx_visit_bill` VALUES ('26', '14070007', null, '1', '', '200000.00', '152000.00', '', '4', null, '2014-07-29 21:31:30');
INSERT INTO `trx_visit_bill` VALUES ('27', '14070006', null, '1', '', '80000.00', '80000.00', '', '4', null, '2014-07-29 22:25:52');
INSERT INTO `trx_visit_bill` VALUES ('29', '14080001', null, '3', '53453453', '40000.00', '30600.00', '', '4', null, '2014-08-01 18:40:48');
INSERT INTO `trx_visit_bill` VALUES ('31', '14080003', null, '1', '', '50000.00', '30400.00', '', '4', null, '2014-08-01 14:45:35');
INSERT INTO `trx_visit_bill` VALUES ('32', '14070008', null, null, null, null, '80000.00', '', '3', null, '2014-08-01 14:35:25');
INSERT INTO `trx_visit_bill` VALUES ('33', '14080004', null, '1', '', '20000.00', '20000.00', '', '4', null, '2014-08-01 19:26:18');
INSERT INTO `trx_visit_bill` VALUES ('34', '14080005', null, null, null, null, '40000.00', '', '3', null, '2014-08-02 21:49:34');
INSERT INTO `trx_visit_bill` VALUES ('37', '14080006', null, '1', '', '50000.00', '40000.00', '', '4', null, '2014-08-02 22:00:28');
INSERT INTO `trx_visit_bill_detail` VALUES ('17', '5', '9v 3 X 1 Setelah Makan 10 Tablet/Kaplet', '2000.00', '0.00', '0.00', '2000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('17', '5', 'Abbocath 3 X 1 Setelah Makan 10 Unit', '100000.00', '0.00', '0.00', '100000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('17', '6', 'Injeksi Intravena', '10000.00', '1000.00', '0.00', '11000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('17', '6', null, '0.00', '0.00', '0.00', '0.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('21', '5', 'Abbocath 2 X 1 Setelah Makan 10 Unit', '100000.00', '0.00', '0.00', '100000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('21', '5', '9v 3 X 1 Setelah Makan 10 Tablet/Kaplet', '2000.00', '0.00', '0.00', '2000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('21', '6', 'Injeksi', '5000.00', '1000.00', '0.00', '6000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('21', '6', null, '0.00', '0.00', '0.00', '0.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('24', '7', 'Golongan darah (ABO Rh)', '50000.00', '2000.00', '0.00', '52000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('25', '5', 'Abbocath 3 X 1 Setelah Makan 10 Unit', '100000.00', '0.00', '0.00', '100000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('25', '6', 'Injeksi', '5000.00', '1000.00', '0.00', '6000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('26', '7', 'Paket 1: Darah Rutin,SGOT,SGPT', '150000.00', '2000.00', '0.00', '152000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('27', '5', 'Abbocath 3 X 1 Setelah Makan 8 Unit', '80000.00', '0.00', '0.00', '80000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('27', '6', null, '0.00', '0.00', '0.00', '0.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('29', '4', '2 3', '30000.00', '0.00', '0.00', '30000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('29', '4', '1 3', '600.00', '0.00', '0.00', '600.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('31', '4', 'Abbocath 3 Unit', '30000.00', '0.00', '0.00', '30000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('31', '4', '9v 2 Tablet/Kaplet', '400.00', '0.00', '0.00', '400.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('32', '5', 'Abbocath 3 X 1 Setelah Makan 8 Unit', '80000.00', '0.00', '0.00', '80000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('32', '6', null, '0.00', '0.00', '0.00', '0.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('33', '4', 'Abbocath 2 Unit', '20000.00', '0.00', '0.00', '20000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('34', '5', 'Abbocath 3 X 1 Setelah Makan 3 Unit', '30000.00', '0.00', '0.00', '30000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('34', '5', 'Abbocath 3 X 1 Setelah Makan 3 Unit', '30000.00', '0.00', '0.00', '30000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('34', '1', 'Jasa pemeriksaan dokter', '10000.00', '0.00', '0.00', '10000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('37', '5', 'Abbocath 3 X 1 Setelah Makan 3 Unit', '30000.00', '0.00', '0.00', '30000.00');
INSERT INTO `trx_visit_bill_detail` VALUES ('37', '1', 'Jasa pemeriksaan dokter', '10000.00', '0.00', '0.00', '10000.00');
