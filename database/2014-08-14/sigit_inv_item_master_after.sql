/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_simrs
Target Host: localhost
Target Database: db_simrs
Date: 8/14/2014 9:05:56 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for inv_item_master
-- ----------------------------
CREATE TABLE `inv_item_master` (
  `im_id` int(20) NOT NULL AUTO_INCREMENT,
  `im_unit` varchar(20) DEFAULT NULL,
  `im_komposisi` varchar(100) DEFAULT NULL,
  `im_name` varchar(100) DEFAULT NULL,
  `im_barcode` varchar(20) DEFAULT NULL,
  `im_item_price_buy` decimal(8,2) DEFAULT NULL,
  `im_item_price` decimal(8,2) DEFAULT NULL,
  `im_item_price_package` decimal(8,2) DEFAULT NULL,
  `im_ppn` decimal(6,2) DEFAULT NULL,
  `im_reorder_point` decimal(10,2) DEFAULT NULL,
  `im_min_stock` int(10) DEFAULT NULL,
  `im_max_stock` int(10) DEFAULT NULL,
  `im_status` int(11) DEFAULT '1',
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `im_type` int(11) DEFAULT NULL,
  `im_vat_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`im_id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `inv_item_master` VALUES ('19', '8', null, 'ANGIOTEN 50 MG [Losartan 50 mg]', null, '50.00', '62.50', '62.50', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('20', '8', null, 'ANGIOTEN 50 MG [Losartan 50 mg]', null, null, '290000.00', '290000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('21', '8', null, 'BETA -ONE 2,5 MG [Bisoprolol 2,5 mg]', null, null, '100000.00', '100000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('22', '8', null, 'BIOGAIA RILLUS [Lacctobacillus]', null, null, '185000.00', '185000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('23', '8', null, 'CAR-Q [Co enzym Q]', null, null, '285000.00', '285000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('24', '8', null, 'CPG [Clopidogrel]', null, null, '400000.00', '400000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('25', '8', null, 'DIVASK 5 MG [Amlodipin]', null, null, '170000.00', '170000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('26', '8', null, 'IRVASK 150 MG [Irbesartan]', null, null, '255000.00', '255000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('27', '3', null, 'LANCID [Lansoprazole 30]', null, null, '260000.00', '260000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('28', '8', null, 'METRIX 2 MG [Gliquidone]', null, null, '120000.00', '120000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('29', '8', null, 'NECIBLOX 500 MG [Sukralfat]', null, null, '90000.00', '90000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('30', '4', null, 'NECIBLOX SUSP 100 ML [Sukralfat]', null, null, '45000.00', '45000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('31', '8', null, 'NEVOX XR 500 [Metformin ]', null, null, '48000.00', '48000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('32', '8', null, 'PIONIX M 850 MG []', null, null, '195000.00', '195000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('33', '10', null, 'PRANZA 40 MG  [Pantoprazole]', null, null, '127500.00', '127500.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('34', '8', null, 'SPIROLA 25 [Spironolactone]', null, null, '70000.00', '70000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('35', '8', null, 'TRUVAZ 20 [Atorvastatin]', null, null, '346500.00', '346500.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('36', '8', null, 'URDAHEX KAPSUL [Ursodeoksilat]', null, null, '245000.00', '245000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('37', '8', null, 'VBLOC 6,25 [Karvedilol 6,25]', null, null, '75000.00', '75000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('38', '8', null, 'VOMCERAN 4 MG [Oondansetron 4 mg]', null, null, '135000.00', '135000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('39', '8', null, 'VOMITAS FDT [Domperidone]', null, null, '175000.00', '175000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('40', '1', null, 'BRAINACT 1000 [Citicoline ]', null, null, '494500.00', '494500.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('41', '8', null, 'BRAINACT ORAL 500 [Citicoline ]', null, null, '334000.00', '334000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('42', '8', null, 'BRAINACT O DIS  [Citicoline ]', null, null, '323500.00', '323500.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('43', '8', null, 'FORNEURO  []', null, null, '136000.00', '136000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('44', '8', null, 'FORRES 50 [Esperisone]', null, null, '185000.00', '185000.00', null, null, null, null, '1', null, '2014-08-11 12:02:51', null, null);
INSERT INTO `inv_item_master` VALUES ('45', '8', null, 'FREGO 10 [Flunarizine]', null, null, '331000.00', '331000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('46', '8', null, 'FREGO 5 [Flunarizine]', null, null, '247000.00', '247000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('47', '3', null, 'KALMECO 500 UG [Metcobalamin]', null, null, '186000.00', '186000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('48', '1', null, 'KALMECO INJ 500 NCG/ML [Metcobalamin]', null, null, '88000.00', '88000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('49', '3', null, 'KALXETIN 10 [Fluoxetine]', null, null, '99000.00', '99000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('50', '8', null, 'NEUROTAM 1200 [Piracetam 1200 mg]', null, null, '258000.00', '258000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('51', '1', null, 'NEUROTAM INJ 3 GRAM [Piracetam   ]', null, null, '208000.00', '208000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('52', '3', null, 'PR5ELYN 75 [Pregabalyn]', null, null, '124000.00', '124000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('53', '8', null, 'REOTAL 400 MG [Pentoxifilin]', null, null, '224000.00', '224000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('54', '1', null, 'REOTAL INJ 300 [Pentoxifilin]', null, null, '215000.00', '215000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('55', '8', null, 'VESI8 [Betahistin]', null, null, '231000.00', '231000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('56', '4', null, 'CEFSPAN SYR [Cefixim]', null, null, '85000.00', '85000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('57', '4', null, 'CETINAL SYR [Loratadine]', null, null, '45000.00', '45000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('58', '8', null, 'EMINETON [Fe fumarat,  Cu Sulfat]', null, null, '131000.00', '131000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('59', '0', null, 'ENTROCARE []', null, null, '127500.00', '127500.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('60', '4', null, 'ENYSTIN 12 ML [Nistatin]', null, null, '30000.00', '30000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('61', '4', null, 'FEROKID SYRUP []', null, null, '30000.00', '30000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('62', '4', null, 'IBUFENS SUSP [Ibuprofen]', null, null, '13500.00', '13500.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('63', '1', null, 'INDUXIN 1 ML [Oksitosin]', null, null, '80000.00', '80000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('64', '8', null, 'INVITEC  [Misoprostol]', null, null, '275000.00', '275000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('65', '8', null, 'LACTAMOR []', null, null, '99000.00', '99000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('66', '4', null, 'LIBROFED SYR []', null, null, '18000.00', '18000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('67', '4', null, 'LIKURMIN 100 ML [Curcuminoid, Lysin]', null, null, '30000.00', '30000.00', null, null, null, null, '1', null, '2014-08-11 12:02:52', null, null);
INSERT INTO `inv_item_master` VALUES ('68', '4', null, 'LIPROLAC []', null, null, '165000.00', '165000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('69', '4', null, 'LONGCEF 125 MG [Cefadroxil]', null, null, '42000.00', '42000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('70', '5', null, 'NEO GYNOXA [Metronidazole ]', null, null, '126000.00', '126000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('71', '4', null, 'NEUROTAM SYR [Piracetam]', null, null, '58000.00', '58000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('72', '8', null, 'OSFIT DHA []', null, null, '98000.00', '98000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('73', '8', null, 'POSPARGIN 0,125 [Metilergometrin]', null, null, '50000.00', '50000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('74', '1', null, 'POSPARGIN INJ [Metilergometrin]', null, null, '55000.00', '55000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('75', '8', null, 'PREMASTON [Alilestrenol]', null, null, '110000.00', '110000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('76', '8', null, 'PROFERTIL [Klomifen sitrat]', null, null, '131000.00', '131000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('77', '6', null, 'TROLIT 6 []', null, null, '55000.00', '55000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('78', '4', null, 'VESTEIN DRY SYRUP [Endostein]', null, null, '32500.00', '32500.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('79', '8', null, 'VOMILAT 8 [Domperidone]', null, null, '25000.00', '25000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('80', '4', null, 'VOMITAS SYRUP [Domperidone]', null, null, '38000.00', '38000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('81', '8', null, 'ZINCARE 8 [Zinc sulfate]', null, null, '190000.00', '190000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('82', '10', null, 'BROADCED INJ 1000 [Ceftriaxone]', null, null, '175000.00', '175000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('83', '3', null, 'CEFSPN 100 MG [Cefixim 100]', null, null, '570000.00', '570000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('84', '10', null, 'CERNEVIT []', null, null, '135000.00', '135000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('85', '8', null, 'CETINAL 10 [Loratadine 10]', null, null, '135000.00', '135000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('86', '8', null, 'CLAVAMOX 500 [Amoxy + as.clavulanat]', null, null, '330000.00', '330000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('87', '3', null, 'CLIMADAN 300 MG [Clindamycin 300]', null, null, '325000.00', '325000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('88', '8', null, 'CRAVIT 500 [Levofloxacin ]', null, null, '350000.00', '350000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('89', '2', null, 'CRAVIT IV 500 [Levofloxacin ]', null, null, '255000.00', '255000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('90', '4', null, 'FLUTIAS 125 MCG []', null, null, '100000.00', '100000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('91', '4', null, 'GLISODIN []', null, null, '165000.00', '165000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('92', '8', null, 'HEXILON 4 [Metilprednisolon]', null, null, '125000.00', '125000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('93', '1', null, 'HEXILON INJ 125 MG [Metilprednisolon]', null, null, '78000.00', '78000.00', null, null, null, null, '1', null, '2014-08-11 12:02:53', null, null);
INSERT INTO `inv_item_master` VALUES ('94', '10', null, 'KALFOXIM 1000 MG [Cefotaxim]', null, null, '125000.00', '125000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('95', '1', null, 'KALMETHASONE INJ    [Dexametasone]', null, null, '30000.00', '30000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('96', '8', null, 'KALNEX 500 MG [As,Traneksamat]', null, null, '260000.00', '260000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('97', '1', null, 'KALNEX INJ 250  [As,Traneksamat]', null, null, '90000.00', '90000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('98', '8', null, 'KALTROFEN EC 8 100 [Ketoprofen]', null, null, '135000.00', '135000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('99', '1', null, 'KALTROFEN INJ 100 [Ketoprofen]', null, null, '125000.00', '125000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('100', '7', null, 'KALTROFEN 7 [Ketoprofen]', null, null, '110000.00', '110000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('101', '3', null, 'LONGCEF 500 [Cefadroxil]', null, null, '270000.00', '270000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('102', '10', null, 'MIKASIN 500 MG 2 ML [Mikasin]', null, null, '160000.00', '160000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('103', '4', null, 'TARIVID OTIC [Ofloxacin]', null, null, '68000.00', '68000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('104', '10', null, 'THIDIM  []', null, null, '180000.00', '180000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('105', '8', null, 'TORASIC 10 MG  [Ketorolac]', null, null, '100000.00', '100000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('106', '1', null, 'TORASIC 30 MG 1 [Ketorolac]', null, null, '200000.00', '200000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('107', '3', null, 'VENOSMIL KAPSUL [Hidrosmin]', null, null, '145000.00', '145000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('108', '3', null, 'VESTEIN 300 MG [Erdostein]', null, null, '75000.00', '75000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('109', '8', null, 'ZEGAVIT [Multivit]', null, null, '115000.00', '115000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('110', '8', null, 'ZITHRAX [Azitromicin]', null, null, '174000.00', '174000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('111', '8', null, 'ALGANAX 0,5 MG [Alprazolam 0,5]', null, null, '82000.00', '82000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('112', '8', null, 'ALGANAX 1 MG [Alprazolam 1]', null, null, '132000.00', '132000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('113', '9', null, 'ELOX 5 [Mometason  furoate]', null, null, '34500.00', '34500.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('114', '9', null, 'FULADIC CR [Fusidic acid]', null, null, '39000.00', '39000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('115', '8', null, 'GOFLEX [Nabumetone]', null, null, '210000.00', '210000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('116', '10', null, 'GOFORAN [Cefotaxim]', null, null, '125000.00', '125000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('117', '8', null, 'NOBOR [Alilestrenol]', null, null, '99000.00', '99000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('118', '8', null, 'NORESTIL [Norethisterone]', null, null, '105000.00', '105000.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('119', '8', null, 'NEUROHAX 5000 [Vit B1,B6,B12]', null, null, '0.00', '0.00', null, null, null, null, '1', null, '2014-08-11 12:02:54', null, null);
INSERT INTO `inv_item_master` VALUES ('120', '4', null, 'NUCRAL 100 [Sukralfat]', null, null, '46000.00', '46000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('121', '8', null, 'NUZYM [Co enzym Q]', null, null, '324000.00', '324000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('122', '8', null, 'UNALIUM 5 [Flunarizine]', null, null, '168000.00', '168000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('123', '9', null, 'NUFACE 0,025 % 10 GR [Tretinoin]', null, null, '22000.00', '22000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('124', '8', null, 'RYDIAN [Cetirizine]', null, null, '100500.00', '100500.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('125', '3', null, 'ZIBRAMAX [Azitromicin]', null, null, '174000.00', '174000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('126', '8', null, 'G5OTIL 2 [Haloperidol]', null, null, '44000.00', '44000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('127', '1', null, 'ONDANE 2 [Ondansetron]', null, null, '122500.00', '122500.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('128', '1', null, 'GETIDIN INJ [Ranitidin]', null, null, '85000.00', '85000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('129', '4', null, 'DHAVIT SYR [Multivit]', null, null, '21000.00', '21000.00', null, null, null, null, '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('130', '8', null, 'G5AZOL [Fluconazole]', null, null, '180000.00', '180000.00', null, null, '120', '20', '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('131', '4', null, 'FORASMA SYR [Terbutalin]', null, null, '21000.00', '21000.00', null, null, '80', '10', '1', null, '2014-08-11 12:02:55', null, null);
INSERT INTO `inv_item_master` VALUES ('132', '8', null, 'FORASMA 8 [Terbutalin]', null, '200.00', '250.00', '46250.00', null, null, '100', '20', '1', null, '2014-08-11 12:08:33', null, null);
