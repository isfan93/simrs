/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 12/5/2014 5:18:33 PM
*/

SET FOREIGN_KEY_CHECKS=0;
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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', '0', 'pelayanan_informasi/informasi_pasien', 'informasi pasien rawat inap', '1', '2', null, '2014-11-30 16:10:28');
INSERT INTO `sys_menu` VALUES ('2', '0', 'pelayanan_informasi/jadwal_dokter', 'jadwal dokter', '1', '2', null, '2014-11-30 07:59:29');
INSERT INTO `sys_menu` VALUES ('3', '0', 'pelayanan_informasi/data_bed', 'ketersediaan bed', '1', '2', null, '2014-11-30 08:00:28');
INSERT INTO `sys_menu` VALUES ('4', '0', 'rawat_jalan/poli_umum', 'poli umum', '1', '3', null, '2014-11-30 08:08:09');
INSERT INTO `sys_menu` VALUES ('5', '0', 'rawat_jalan/poli_anak', 'poli anak', '1', '3', null, '2014-11-30 08:08:09');
INSERT INTO `sys_menu` VALUES ('6', '0', 'rawat_jalan/poli_gigi', 'poli gigi', '1', '3', null, '2014-11-30 08:08:10');
INSERT INTO `sys_menu` VALUES ('7', '0', 'rawat_jalan/poli_dalam', 'poli dalam', '1', '3', null, '2014-11-30 08:08:11');
INSERT INTO `sys_menu` VALUES ('8', '0', 'rawat_jalan/poli_bidan', 'Poli Kebidanan dan Kandungan', '1', '3', null, '2014-11-30 08:08:11');
INSERT INTO `sys_menu` VALUES ('9', '0', 'rawat_jalan/poli_saraf', 'Poli Saraf', '1', '3', null, '2014-11-30 08:08:12');
INSERT INTO `sys_menu` VALUES ('10', '0', 'rawat_jalan/poli_bedah', 'Poli Bedah', '1', '3', null, '2014-11-30 08:08:16');
INSERT INTO `sys_menu` VALUES ('11', '0', 'rawat_jalan/poli_mata', 'Poli Mata', '1', '3', null, '2014-11-30 08:08:16');
INSERT INTO `sys_menu` VALUES ('12', '0', 'rawat_jalan/poli_kulit', 'Poli Kulit dan Kelamin', '1', '3', null, '2014-11-30 08:08:17');
INSERT INTO `sys_menu` VALUES ('13', '0', 'rawat_jalan/poli_dalam', 'Poli Dalam', '1', '3', null, '2014-11-30 08:08:20');
INSERT INTO `sys_menu` VALUES ('14', '0', 'rawat_jalan/poli_jantung', 'Poli Jantung', '1', '3', null, '2014-11-30 08:08:21');
INSERT INTO `sys_menu` VALUES ('15', '0', 'rawat_jalan/igd', 'IGD', '1', '3', null, '2014-11-30 08:08:22');
INSERT INTO `sys_menu` VALUES ('16', '0', 'rawat_jalan/poli_jiwa', 'Poli kejiwaan', '1', '3', null, '2014-11-30 08:08:24');
INSERT INTO `sys_menu` VALUES ('17', '0', 'kasir', 'Transaksi', '1', '4', null, '2014-11-30 08:09:31');
INSERT INTO `sys_menu` VALUES ('18', '0', 'apotek/resep_pasien', 'Resep pasien', '1', '5', null, '2014-11-30 08:10:30');
INSERT INTO `sys_menu` VALUES ('19', '0', 'apotek/pembelian_umum', 'pembelian umum', '1', '5', null, '2014-12-03 08:40:39');
INSERT INTO `sys_menu` VALUES ('20', '0', 'apotek/resep_pasien/riwayat_resep', 'Data Riwayat Resep Pasien', '1', '5', null, '2014-11-30 08:11:43');
INSERT INTO `sys_menu` VALUES ('21', '0', 'lab/antrian', 'antrian', '1', '7', null, '2014-11-30 08:13:01');
INSERT INTO `sys_menu` VALUES ('22', '0', 'lab/pemeriksaan', 'riwayat pemeriksaan', '1', '7', null, '2014-11-30 08:13:14');
INSERT INTO `sys_menu` VALUES ('24', '0', 'rad/antrian', 'Antrian', '1', '14', null, '2014-11-30 09:35:53');
INSERT INTO `sys_menu` VALUES ('25', '0', 'rad/pemeriksaan', 'Riwayat Pemeriksaan', '1', '14', null, '2014-11-30 09:36:03');
INSERT INTO `sys_menu` VALUES ('26', '0', '', 'Kunjungan', '1', '8', null, '2014-11-30 09:39:42');
INSERT INTO `sys_menu` VALUES ('27', '26', 'pelaporan/kunjungan', 'Semua Kunjungan', '1', '8', null, '2014-12-03 12:14:37');
INSERT INTO `sys_menu` VALUES ('28', '0', '', 'Keuangan', '1', '8', null, '2014-11-30 09:39:43');
INSERT INTO `sys_menu` VALUES ('29', '28', 'pelaporan/keuangan/cashflow', 'Cashflow', '1', '8', null, '2014-11-30 09:41:10');
INSERT INTO `sys_menu` VALUES ('30', '28', 'pelaporan/keuangan/jasadokter', 'Rekapitulasi Jasa Dokter', '1', '8', null, '2014-11-30 09:41:17');
INSERT INTO `sys_menu` VALUES ('31', '0', '', 'Farmasi', '1', '8', null, '2014-11-30 09:41:57');
INSERT INTO `sys_menu` VALUES ('32', '31', 'pelaporan/farmasi', 'Penjualan', '1', '8', null, '2014-12-05 02:52:39');
INSERT INTO `sys_menu` VALUES ('33', '28', 'pelaporan/keuangan/jatuhtempo', 'Jatuh Tempo', '1', '8', null, '2014-11-30 09:44:29');
INSERT INTO `sys_menu` VALUES ('34', '0', 'master/data_dokter', 'data dokter', '0', '9', null, '2014-11-30 09:46:42');
INSERT INTO `sys_menu` VALUES ('35', '57', 'master/data_tindakan', 'Data Tindakan', '1', '9', null, '2014-11-30 09:54:19');
INSERT INTO `sys_menu` VALUES ('36', '0', 'master/data_diagnosa', 'data diagnosa / ICD 10', '1', '9', null, '2014-11-30 09:50:25');
INSERT INTO `sys_menu` VALUES ('37', '61', 'master/data_obat', 'Data Obat', '1', '9', null, '2014-11-30 09:55:02');
INSERT INTO `sys_menu` VALUES ('38', '58', 'master/data_pegawai', 'Data Pegawai & Dokter', '1', '9', null, '2014-11-30 09:55:31');
INSERT INTO `sys_menu` VALUES ('39', '58', 'master/data_user', 'data user', '0', '9', null, '2014-11-30 09:55:32');
INSERT INTO `sys_menu` VALUES ('40', '59', 'master/data_poli', 'Data Poli', '1', '9', null, '2014-11-30 09:56:12');
INSERT INTO `sys_menu` VALUES ('41', '58', 'master/data_jasa_dokter', 'Data Biaya Jasa Dokter', '1', '9', null, '2014-11-30 09:55:35');
INSERT INTO `sys_menu` VALUES ('42', '58', 'master/jadwal_dokter', 'Data Jadwal Dokter', '1', '9', null, '2014-11-30 09:55:37');
INSERT INTO `sys_menu` VALUES ('43', '79', 'master/data_askes', 'Data Askes', '1', '9', null, '2014-11-30 09:50:38');
INSERT INTO `sys_menu` VALUES ('44', '78', 'master/data_type_user', 'Data Tipe User', '1', '9', null, '2014-11-30 09:50:39');
INSERT INTO `sys_menu` VALUES ('45', '59', 'master/data_room', 'Data Room', '1', '9', null, '2014-11-30 09:56:15');
INSERT INTO `sys_menu` VALUES ('46', '61', 'master/data_supplier', 'Data Supplier', '1', '9', null, '2014-11-30 09:55:04');
INSERT INTO `sys_menu` VALUES ('47', '58', 'master/data_user', 'Data User', '1', '9', null, '2014-11-30 09:55:43');
INSERT INTO `sys_menu` VALUES ('48', '57', 'master/data_koefisien_fee', 'Data Koefisien Tarif Tindakan', '0', '9', null, '2014-12-02 17:19:37');
INSERT INTO `sys_menu` VALUES ('49', '57', 'master/data_mcu_detail', 'Data Detail MCU', '0', '9', null, '2014-12-02 17:19:50');
INSERT INTO `sys_menu` VALUES ('50', '57', 'master/data_treat_pack', 'Data Paket Tindakan', '0', '9', null, '2014-12-02 17:19:55');
INSERT INTO `sys_menu` VALUES ('51', '57', 'master/data_tindakan_lab', 'Data Tindakan Lab', '1', '9', null, '2014-11-30 09:54:25');
INSERT INTO `sys_menu` VALUES ('52', '59', 'master/data_pavillion', 'Data Pavillion', '1', '9', null, '2014-11-30 09:56:18');
INSERT INTO `sys_menu` VALUES ('53', '59', 'master/data_service', 'Data Pelayanan', '1', '9', null, '2014-11-30 09:56:19');
INSERT INTO `sys_menu` VALUES ('54', '59', 'master/data_adm_fee', 'Data Tarif Administrasi', '1', '9', null, '2014-11-30 09:56:19');
INSERT INTO `sys_menu` VALUES ('55', '57', 'master/data_lab_treathment_detail', 'Data Detail Tindakan Lab', '1', '9', null, '2014-11-30 09:54:27');
INSERT INTO `sys_menu` VALUES ('56', '57', 'master/data_lab_treathment_gol', 'Data Golongan Lab', '1', '9', null, '2014-11-30 09:54:28');
INSERT INTO `sys_menu` VALUES ('57', '0', '#', 'Master tindakan', '1', '9', null, '2014-11-30 09:53:15');
INSERT INTO `sys_menu` VALUES ('58', '0', '#', 'Master User', '1', '9', null, '2014-11-30 09:53:17');
INSERT INTO `sys_menu` VALUES ('59', '0', '#', 'Master Service', '1', '9', null, '2014-11-30 09:53:18');
INSERT INTO `sys_menu` VALUES ('60', '61', 'master/data_satuan_obat', 'Data Satuan Obat', '1', '9', null, '2014-11-30 09:55:07');
INSERT INTO `sys_menu` VALUES ('61', '0', '#', 'Master Obat', '1', '9', null, '2014-11-30 09:53:27');
INSERT INTO `sys_menu` VALUES ('62', '58', 'master/data_user_group', 'Data Group', '1', '9', null, '2014-11-30 09:55:50');
INSERT INTO `sys_menu` VALUES ('63', '59', 'master/data_class', 'Data Kelas Ruangan', '1', '9', null, '2014-11-30 09:56:27');
INSERT INTO `sys_menu` VALUES ('64', '59', 'master/data_bed', 'Data Bed', '1', '9', null, '2014-11-30 09:56:31');
INSERT INTO `sys_menu` VALUES ('65', '61', 'master/data_racikan_fee', 'Data Tarif Racikan Obat', '1', '9', null, '2014-11-30 09:55:10');
INSERT INTO `sys_menu` VALUES ('66', '0', 'gudang/faktur', 'Pembelian / Faktur', '1', '10', null, '2014-11-27 22:11:59');
INSERT INTO `sys_menu` VALUES ('67', '0', 'gudang/retur', 'retur', '1', '10', null, '2014-09-25 00:36:15');
INSERT INTO `sys_menu` VALUES ('68', '0', 'gudang/stok', 'stok', '1', '10', null, '2014-09-25 00:36:17');
INSERT INTO `sys_menu` VALUES ('69', '0', 'gudang/retur_ranap', 'Retur Obat Rawat Inap', '1', '10', null, '2014-11-30 07:33:14');
INSERT INTO `sys_menu` VALUES ('70', '0', 'rekam_medis', 'Rekam Medis', '1', '12', null, '2014-11-30 10:00:26');
INSERT INTO `sys_menu` VALUES ('71', '0', 'rekam_medis/rekam_medis/kunjungan_hari_ini', 'Kunjungan Hari Ini', '1', '12', null, '2014-11-30 10:00:29');
INSERT INTO `sys_menu` VALUES ('72', '0', 'keuangan/expenses', 'Pencatatan Pengeluaran', '1', '15', null, '2014-11-30 18:20:52');
INSERT INTO `sys_menu` VALUES ('73', '31', 'pelaporan/farmasi/pembelian', 'Pembelian', '1', '8', null, '2014-12-05 07:31:28');
INSERT INTO `sys_menu` VALUES ('74', '26', 'pelaporan/kunjungan/rawat_jalan', 'Rawat Jalan (Poli)', '1', '8', null, '2014-12-05 14:52:32');
INSERT INTO `sys_menu` VALUES ('75', '26', 'pelaporan/kunjungan/rawat_inap', 'Rawat Inap', '1', '8', null, '2014-12-05 14:52:44');
INSERT INTO `sys_menu` VALUES ('76', '26', 'pelaporan/kunjungan/igd', 'IGD', '1', '8', null, '2014-12-05 14:52:53');
INSERT INTO `sys_menu` VALUES ('77', '26', 'pelaporan/kunjungan/lab', 'Laboratorium', '1', '8', null, '2014-12-05 14:53:02');
INSERT INTO `sys_menu` VALUES ('78', '26', 'pelaporan/kunjungan/rad', 'Radiologi', '1', '8', null, '2014-12-05 14:53:07');
INSERT INTO `sys_menu` VALUES ('79', '0', 'rawat_jalan/poli_paru', 'Poli Paru', '1', '3', null, '2014-12-04 06:06:57');
INSERT INTO `sys_menu` VALUES ('80', '61', 'master/data_golongan_obat', 'Data Golongan Obat', '1', '9', null, '2014-12-05 02:41:27');
INSERT INTO `sys_menu` VALUES ('81', '31', 'pelaporan/farmasi/napza', 'Penggunaan Narkotika', '1', '8', null, '2014-12-05 07:31:59');
INSERT INTO `sys_menu` VALUES ('82', '31', 'pelaporan/farmasi/prekursor', 'Penggunaan Prekursor', '1', '8', null, '2014-12-05 07:33:57');
INSERT INTO `sys_menu` VALUES ('83', '31', 'pelaporan/farmasi/inout', 'Keruar Masuk Sediaan', '1', '8', null, '2014-12-05 07:35:20');
