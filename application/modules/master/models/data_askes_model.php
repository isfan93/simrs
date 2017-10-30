<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_askes_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_insurance where ins_status=1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_insurance', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_insurance
			WHERE 
				ins_id IN ($kode)"
			);*/
		$this->db->query("
			update mst_insurance
			set ins_status = 0
			where ins_id in ($kode)");
	}
}

?>