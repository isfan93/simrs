<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_pavillion_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_pavillion
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_pavillion', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_pavillion
			WHERE 
				pavillion_id IN ($kode)"
			);*/
		$this->db->query("
			update mst_pavillion
			set pav_status = 0
			where pavillion_id in ($kode)");
	}
}

?>