<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_adm_fee_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_adm_fee where adm_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_adm_fee', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_adm_fee
			WHERE 
				adm_id IN ($kode)"
			);*/
		$this->db->query("
			update mst_adm_fee
			set adm_status = 0
			where adm_id in ($kode)");
	}
}

?>