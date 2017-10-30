INSERT INTO `sys_menu`(`menu_id`,`menu_parent`,`menu_url`,`menu_name`,`menu_status`,`modul_id`,`modi_id`,`modi_datetime`) VALUES ( NULL,'0','master/data_satuan_obat','Data Satuan Obat','1','7',NULL,CURRENT_TIMESTAMP);
INSERT INTO `sys_menu`(`menu_id`,`menu_parent`,`menu_url`,`menu_name`,`menu_status`,`modul_id`,`modi_id`,`modi_datetime`) VALUES ( NULL,'0','#','Master Obat','1','7',NULL,CURRENT_TIMESTAMP);
INSERT INTO `sys_menu`(`menu_id`,`menu_parent`,`menu_url`,`menu_name`,`menu_status`,`modul_id`,`modi_id`,`modi_datetime`) VALUES ( NULL,'78','master/data_user_group','Data Group','1','7',NULL,CURRENT_TIMESTAMP);
UPDATE `sys_menu` SET `menu_id`='83',`menu_parent`='84',`menu_url`='master/data_satuan_obat',`menu_name`='Data Satuan Obat',`menu_status`='1',`modul_id`='7',`modi_id`=NULL WHERE `menu_id`='83';
UPDATE `sys_menu` SET `menu_id`='33',`menu_parent`='84',`menu_url`='master/data_obat',`menu_name`='Data Obat',`menu_status`='1',`modul_id`='7',`modi_id`=NULL WHERE `menu_id`='33';
