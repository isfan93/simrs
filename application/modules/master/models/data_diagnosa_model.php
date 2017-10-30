<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_diagnosa_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$query=$this->db->query("
			select * from mst_diagnosa 
			where diag_status = 1
			order by (diag_id) desc
			");
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_diagnosa', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_diagnosa
			WHERE 
				diag_id IN ('$kode')"
			);*/
		$data = array('diag_status'=>0);
		$this->db->where_in('diag_id',$kode);		
		$this->db->update('mst_diagnosa',$data);		
	}
	
	function get_Detail($key){
		$query=$this->db->query("
			select * from mst_diagnosa where diag_id='$key'
			");
		return $query->row_array();
	}
}

?>
	
