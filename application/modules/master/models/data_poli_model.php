<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_poli_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$query=$this->db->query("
			select * from mst_poly 
			where pl_status=1
			order by pl_id desc
			");
		return $query;
	}
	
	function addMaster($data){		
		$result=$this->db->insert('mst_poly', $data);
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_poly
			WHERE 
				pl_id IN ($kode)"
			);*/
		$this->db->query("
			update mst_poly
			set pl_status = 0
			where pl_id in ($kode)");
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
		$this->db->where('pl_id', $data['pl_id']);
		$this->db->update('mst_poly', $data); 
		//return $result;
	}
}

?>