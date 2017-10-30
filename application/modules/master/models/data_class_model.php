<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_class_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_class where class_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_class', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_class
			WHERE 
				class_id IN ($kode)"
			);*/
		$this->db->query("
			update mst_class
			set class_status = 0
			where class_id in ($kode)");
	}
}

?>