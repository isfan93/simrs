<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_mcu_detail_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		//$query = $this->db->join('mst_treathment mt','mt.poli = mp.pl_id');

		$query=$this->db->query("
			select mmd.dmcu_id,mmd.mcu_id,mmd.description,mt.treat_id,mt.treat_name
			from mst_mcu_detail mmd
			join mst_treathment mt on (mt.treat_id=mmd.mcu_id)			
			order by mt.treat_id desc");
		//return $this->db->get('mst_poly mp');
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_treathment', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		$this->db->query(
			"DELETE FROM
				mst_mcu_detail
			WHERE 
				dmcu_id IN ($kode)"
			);
		// echo $this->db->last_query();
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
		
		//return $result;
	}
}

?>