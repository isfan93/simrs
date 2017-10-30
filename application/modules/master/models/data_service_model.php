<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_service_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_service where svc_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_service', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_service
			WHERE 
				service_id IN ($kode)"
			);*/
		$this->db->query("
			update mst_service
			set svc_status = 0
			where service_id in ($kode)");
	}
}

?>