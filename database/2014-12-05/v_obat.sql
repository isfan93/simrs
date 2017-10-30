/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - db_simrsih_4des
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `v_obat` */

DROP TABLE IF EXISTS `v_obat`;

/*!50001 DROP VIEW IF EXISTS `v_obat` */;
/*!50001 DROP TABLE IF EXISTS `v_obat` */;

/*!50001 CREATE TABLE `v_obat` (
  `im_id` int(20) NOT NULL DEFAULT '0',
  `im_unit` varchar(20) DEFAULT NULL,
  `im_komposisi` varchar(100) DEFAULT NULL,
  `im_name` varchar(100) DEFAULT NULL,
  `im_barcode` varchar(20) DEFAULT NULL,
  `im_item_price_buy` decimal(8,2) DEFAULT NULL,
  `im_item_price` decimal(8,2) DEFAULT NULL COMMENT '0.00',
  `im_item_price_package` decimal(8,2) DEFAULT NULL,
  `im_ppn` decimal(6,2) DEFAULT NULL,
  `im_reorder_point` decimal(10,2) DEFAULT NULL,
  `im_min_stock` int(10) DEFAULT NULL,
  `im_max_stock` int(10) DEFAULT NULL,
  `im_status` int(11) DEFAULT NULL,
  `modi_id` int(11) DEFAULT NULL,
  `modi_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `im_vat_status` varchar(50) DEFAULT NULL,
  `mtype_name` varchar(50) DEFAULT NULL,
  `gol_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*View structure for view v_obat */

/*!50001 DROP TABLE IF EXISTS `v_obat` */;
/*!50001 DROP VIEW IF EXISTS `v_obat` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_obat` AS select `iim`.`im_id` AS `im_id`,`iim`.`im_unit` AS `im_unit`,`iim`.`im_komposisi` AS `im_komposisi`,`iim`.`im_name` AS `im_name`,`iim`.`im_barcode` AS `im_barcode`,`iim`.`im_item_price_buy` AS `im_item_price_buy`,`iim`.`im_item_price` AS `im_item_price`,`iim`.`im_item_price_package` AS `im_item_price_package`,`iim`.`im_ppn` AS `im_ppn`,`iim`.`im_reorder_point` AS `im_reorder_point`,`iim`.`im_min_stock` AS `im_min_stock`,`iim`.`im_max_stock` AS `im_max_stock`,`iim`.`im_status` AS `im_status`,`iim`.`modi_id` AS `modi_id`,`iim`.`modi_datetime` AS `modi_datetime`,`iim`.`im_vat_status` AS `im_vat_status`,`mti`.`mtype_name` AS `mtype_name`,`mgi`.`gol_name` AS `gol_name` from ((`inv_item_master` `iim` left join `mst_type_inv` `mti` on((`mti`.`mtype_id` = `iim`.`im_unit`))) left join `mst_golongan_inv` `mgi` on((`mgi`.`gol_id` = `iim`.`im_golongan`))) where (`iim`.`im_status` = 1) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
