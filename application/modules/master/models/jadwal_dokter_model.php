<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_dokter_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$query=$this->db->query("
			SELECT tds.sch_id,me.sd_name,tds.day,ms.shift_start,ms.shift_end,mp.pl_name,mp.pl_id as poli_id,tds.sch_shift
			FROM trx_dr_schedule tds
			JOIN mst_employer me ON(me.id_employe=tds.employe_id)
			JOIN mst_shift ms ON(ms.shift_id=tds.sch_shift)
			JOIN mst_poly mp ON(mp.pl_id=tds.pl_id)
			WHERE tds.tds_status = 1
			");
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('trx_dr_schedule', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				trx_dr_schedule
			WHERE 
				sch_id IN ($kode)"
			);*/
		$data = array('tds_status'=>0);
		$this->db->where_in('sch_id',$kode);
		//$this->db->delete('trx_dokter_fee');		
		$this->db->update('trx_dr_schedule',$data);
	}
	
	function get_Detail($key){
		$query=$this->db->query("
			SELECT mt.*,tp.* FROM mst_treathment mt
			JOIN mst_poly tp ON (tp.pl_id=mt.poli)
			WHERE mt.treat_id='$key'
			");
		return $query->row_array();
	}
	
	function updateMaster($data){
		//$result=$this->db->insert('mst_treathment', $data);
		$this->db->where('sch_id', $data['sch_id']);
		$this->db->update('trx_dr_schedule', $data); 
		//return $result;
	}
}

?>