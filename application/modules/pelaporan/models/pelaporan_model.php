<?php if (! defined("BASEPATH")) exit;
class Pelaporan_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}

	function getReportFarmasi($req){
		$query['recipe'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(recipe_qty) as recipe_qty, mti.mtype_name,trd.recipe_batch as batch, trd.recipe_price as recipe_price 
			FROM trx_recipe_detail trd
			JOIN inv_item_master im ON im.im_id = trd.recipe_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trd.modi_datetime) >= '$req[dateStart]' AND DATE(trd.modi_datetime) <= '$req[dateEnd]'
			GROUP BY im.im_id
		");

		$query['racikan'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(racikan_medicine_qty) as racikan_medicine_qty, mti.mtype_name,trkd.racikan_medicine_batch as batch, trkd.racikan_medicine_price as racikan_medicine_price
			FROM trx_racikan_detail trkd
			JOIN inv_item_master im ON im.im_id = trkd.racikan_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trkd.modi_datetime) >= '$req[dateStart]' AND DATE(trkd.modi_datetime) <= '$req[dateEnd]'
			GROUP BY im.im_id");

		$query['direct_buy'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(tdb_qty) as tdb_qty, mti.mtype_name,tdbd.tdb_batch as batch, tdbd.tdb_price as tdb_price
			FROM trx_direct_buy_detail tdbd
			JOIN inv_item_master im ON im.im_id = tdbd.tdb_item
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(tdbd.modi_datetime) >= '$req[dateStart]' AND DATE(tdbd.modi_datetime) <= '$req[dateEnd]'
			GROUP BY im.im_id");

		// debug_array($this->db->last_query());

		return $query;
	}

	function getReportFarmasiNapza($req){
		$query['recipe'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(recipe_qty) as recipe_qty, mti.mtype_name,trd.recipe_batch as batch, trd.recipe_price as recipe_price 
			FROM trx_recipe_detail trd
			JOIN inv_item_master im ON im.im_id = trd.recipe_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trd.modi_datetime) >= '$req[dateStart]' AND DATE(trd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '1'
			GROUP BY im.im_id
		");

		$query['racikan'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(racikan_medicine_qty) as racikan_medicine_qty, mti.mtype_name,trkd.racikan_medicine_batch as batch, trkd.racikan_medicine_price as racikan_medicine_price
			FROM trx_racikan_detail trkd
			JOIN inv_item_master im ON im.im_id = trkd.racikan_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trkd.modi_datetime) >= '$req[dateStart]' AND DATE(trkd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '1'
			GROUP BY im.im_id");

		$query['direct_buy'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(tdb_qty) as tdb_qty, mti.mtype_name,tdbd.tdb_batch as batch, tdbd.tdb_price as tdb_price
			FROM trx_direct_buy_detail tdbd
			JOIN inv_item_master im ON im.im_id = tdbd.tdb_item
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(tdbd.modi_datetime) >= '$req[dateStart]' AND DATE(tdbd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '1'
			GROUP BY im.im_id");

		// debug_array($this->db->last_query());

		return $query;
	}

	function getReportFarmasiPsikotropika($req){
		$query['recipe'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(recipe_qty) as recipe_qty, mti.mtype_name,trd.recipe_batch as batch, trd.recipe_price as recipe_price 
			FROM trx_recipe_detail trd
			JOIN inv_item_master im ON im.im_id = trd.recipe_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trd.modi_datetime) >= '$req[dateStart]' AND DATE(trd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '2'
			GROUP BY im.im_id
		");

		$query['racikan'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(racikan_medicine_qty) as racikan_medicine_qty, mti.mtype_name,trkd.racikan_medicine_batch as batch, trkd.racikan_medicine_price as racikan_medicine_price
			FROM trx_racikan_detail trkd
			JOIN inv_item_master im ON im.im_id = trkd.racikan_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trkd.modi_datetime) >= '$req[dateStart]' AND DATE(trkd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '2'
			GROUP BY im.im_id");

		$query['direct_buy'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(tdb_qty) as tdb_qty, mti.mtype_name,tdbd.tdb_batch as batch, tdbd.tdb_price as tdb_price
			FROM trx_direct_buy_detail tdbd
			JOIN inv_item_master im ON im.im_id = tdbd.tdb_item
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(tdbd.modi_datetime) >= '$req[dateStart]' AND DATE(tdbd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '2'
			GROUP BY im.im_id");

		// debug_array($this->db->last_query());

		return $query;
	}

	function getReportFarmasiPrekursor($req){
		$query['recipe'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(recipe_qty) as recipe_qty, mti.mtype_name,trd.recipe_batch as batch, trd.recipe_price as recipe_price 
			FROM trx_recipe_detail trd
			JOIN inv_item_master im ON im.im_id = trd.recipe_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trd.modi_datetime) >= '$req[dateStart]' AND DATE(trd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '3'
			GROUP BY im.im_id
		");

		$query['racikan'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(racikan_medicine_qty) as racikan_medicine_qty, mti.mtype_name,trkd.racikan_medicine_batch as batch, trkd.racikan_medicine_price as racikan_medicine_price
			FROM trx_racikan_detail trkd
			JOIN inv_item_master im ON im.im_id = trkd.racikan_medicine
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(trkd.modi_datetime) >= '$req[dateStart]' AND DATE(trkd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '3'
			GROUP BY im.im_id");

		$query['direct_buy'] = $this->db->query("SELECT im.im_id,im.im_name, SUM(tdb_qty) as tdb_qty, mti.mtype_name,tdbd.tdb_batch as batch, tdbd.tdb_price as tdb_price
			FROM trx_direct_buy_detail tdbd
			JOIN inv_item_master im ON im.im_id = tdbd.tdb_item
			LEFT JOIN mst_type_inv mti ON mti.mtype_id = im.im_unit
			WHERE DATE(tdbd.modi_datetime) >= '$req[dateStart]' AND DATE(tdbd.modi_datetime) <= '$req[dateEnd]' AND im.im_golongan = '3'
			GROUP BY im.im_id");

		// debug_array($this->db->last_query());

		return $query;
	}

	function getReportDokter($data){
		$dateStart=$data['dateStart'];$dateEnd=$data['dateEnd'];
		return $this->db->query("
			SELECT dr_id,dr_name,description,SUM(rupiah) AS rupiah,SUM(banyak_kunjungan) AS banyak_kunjungan
			FROM 
				(SELECT tm.dr_id AS dr_id,me.sd_name AS dr_name,mtu.description,SUM(tdf.dr_fee) AS rupiah,COUNT(tm.dr_id) AS banyak_kunjungan
							FROM trx_medical tm
							JOIN trx_dokter_fee tdf ON tdf.dr_id = tm.dr_id
							JOIN mst_employer me ON me.id_employe = tm.dr_id
							JOIN trx_service ts ON ts.service_id = tm.mdc_id
							JOIN mst_type_user mtu ON mtu.id_type_user = me.sd_type_user
							WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd'
							GROUP BY dr_id

				UNION ALL
				SELECT he.physician_id AS dr_id,me.sd_name AS dr_name,mtu.description,SUM(tdf.dr_fee) AS rupiah,COUNT(he.physician_id) AS banyak_kunjungan
							FROM hos_examination he
							JOIN trx_dokter_fee tdf ON tdf.dr_id = he.physician_id
							JOIN mst_employer me ON me.id_employe = he.physician_id
							JOIN trx_service ts ON ts.service_id = he.service_id
							JOIN mst_type_user mtu ON mtu.id_type_user = me.sd_type_user
							WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd'
							GROUP BY dr_id			
				) AS gabungan_layanan
			GROUP BY dr_id
			ORDER BY dr_id
			");

	}

	function getDetailJasa($data){
		$dateStart=$data['dateStart'];$dateEnd=$data['dateEnd'];$dr_id=$data['dr_id'];
		return $this->db->query("
			SELECT tm.dr_id AS dr_id,me.sd_name AS dr_name,mtu.description,ts.service_id,ts.service_in,tm.sd_rekmed AS norkm
			FROM trx_medical tm
			JOIN trx_dokter_fee tdf ON tdf.dr_id = tm.dr_id
			JOIN mst_employer me ON me.id_employe = tm.dr_id
			JOIN trx_service ts ON ts.service_id = tm.mdc_id
			JOIN mst_type_user mtu ON mtu.id_type_user = me.sd_type_user
			WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd' AND tm.dr_id = $dr_id
			UNION ALL
			SELECT he.physician_id AS dr_id,me.sd_name AS dr_name,mtu.description,ts.service_id,he.datetime AS service_in,tv.visit_rekmed AS norkm
						FROM hos_examination he
						JOIN trx_dokter_fee tdf ON tdf.dr_id = he.physician_id
						JOIN mst_employer me ON me.id_employe = he.physician_id
						JOIN trx_service ts ON ts.service_id = he.service_id
						JOIN mst_type_user mtu ON mtu.id_type_user = me.sd_type_user
						JOIN trx_visit tv ON tv.visit_id = SUBSTR(he.service_id,4,8)
						WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd' AND he.physician_id = $dr_id
			");	
	}

	// function get_list(){
	// 	$query=$this->db->query("
	// 		SELECT tcf.*,mco.category
	// 		FROM trx_jurnal tcf
	// 		JOIN mst_expense mco on(mco.cat_id=tcf.cat_id)
	// 		");
	// 	return $query;
	// }
}