<?php if (! defined("BASEPATH")) exit;
class Trend_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}

	function getReportDiagnosa($data){
		$dateStart=$data['dateStart'];$dateEnd=$data['dateEnd'];
		if($data['service']==''){
			return $this->db->query("SELECT md.diag_kode,md.diag_name,md.indonesian,COUNT(md.diag_kode) AS jumlah
				FROM trx_service ts
				JOIN trx_diagnosa_treathment tdt ON (ts.service_id=tdt.mdc_id)
				JOIN mst_diagnosa md ON (md.diag_id=tdt.dat_diag)
				WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd'
				GROUP BY md.diag_kode

				UNION
				SELECT md.diag_kode,md.diag_name,md.indonesian,COUNT(md.diag_kode) AS jumlah
				FROM trx_service ts
				JOIN hos_examination he ON ts.service_id=he.service_id
				JOIN hos_nursing_diagnosis hnd ON hnd.mdc_id = he.examination_id
				JOIN mst_diagnosa md ON (md.diag_id=hnd.diag_id)
				WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd'
				GROUP BY md.diag_kode
				ORDER BY jumlah DESC 
				LIMIT 10
			");	
		}elseif($data['service']=='RJ'){
			return $this->db->query("SELECT md.diag_kode,md.diag_name,md.indonesian,COUNT(md.diag_kode) AS jumlah
				FROM trx_service ts
				JOIN trx_diagnosa_treathment tdt ON (ts.service_id=tdt.mdc_id)
				JOIN mst_diagnosa md ON (md.diag_id=tdt.dat_diag)
				WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd'
				GROUP BY md.diag_kode				
				ORDER BY jumlah DESC 
				LIMIT 10
			");

		}elseif ($data['service']=='RN') {
			return $this->db->query("
				SELECT md.diag_kode,md.diag_name,md.indonesian,COUNT(md.diag_kode) AS jumlah
				FROM trx_service ts
				JOIN hos_examination he ON ts.service_id=he.service_id
				JOIN hos_nursing_diagnosis hnd ON hnd.mdc_id = he.examination_id
				JOIN mst_diagnosa md ON (md.diag_id=hnd.diag_id)
				WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd'
				GROUP BY md.diag_kode
				ORDER BY jumlah DESC 
				LIMIT 10
			");
		}elseif ($data['service']=='IG') {
			return $this->db->query("SELECT md.diag_kode,md.diag_name,md.indonesian,COUNT(md.diag_kode) AS jumlah
				FROM trx_service ts
				JOIN trx_diagnosa_treathment tdt ON (ts.service_id=tdt.mdc_id)
				JOIN mst_diagnosa md ON (md.diag_id=tdt.dat_diag)
				WHERE DATE(ts.service_in) >= '$dateStart' AND DATE(ts.service_in) <= '$dateEnd' AND ts.service_id like 'IG%'
				GROUP BY md.diag_kode				
				ORDER BY jumlah DESC 
				LIMIT 10
			");
		}		
	}
}