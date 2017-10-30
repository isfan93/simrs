<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_satuan_obat_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$query=$this->db->query("
			select * from mst_type_inv 
			where mtype_status = 1
			order by mtype_id desc
			");
		return $query;
	}
	
	function addMaster($data){		
		$result=$this->db->insert('mst_type_inv', $data);
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_type_inv
			WHERE 
				mtype_id IN ($kode)"
			);*/
		$data = array('mtype_status'=>0);
		$this->db->where_in('mtype_id',$kode);		
		$this->db->update('mst_type_inv',$data);
	}
	
	function updateMaster($data){
		//$result=$this->db->insert('mst_treathment', $data);
		$this->db->where('mtype_id', $data['mtype_id']);
		$this->db->update('mst_type_inv', $data); 
		//return $result;
	}
}

?>