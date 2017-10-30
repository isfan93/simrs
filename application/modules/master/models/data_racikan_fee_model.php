<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_racikan_fee_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_racikan_fee where status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_racikan_fee', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_racikan_fee
			WHERE 
				id IN ($kode)"
			);*/
		$data = array('status'=>0);
		$this->db->where_in('id',$kode);		
		$this->db->update('mst_racikan_fee',$data);
	}
}

?>