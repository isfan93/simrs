<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_rute_obat_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$query=$this->db->query("
			select * from mst_rute_inv 
			where rute_status = 1
			order by rute_id desc
			");
		return $query;
	}
	
	function addMaster($data){		
		$result=$this->db->insert('mst_rute_inv', $data);
		return $result;
	}
	
	function deleteData($kode){		
		$data = array('rute_status'=>0);
		$this->db->where_in('rute_id',$kode);		
		$this->db->update('mst_rute_inv',$data);
	}
	
	function updateMaster($data){		
		$this->db->where('rute_id', $data['rute_id']);
		$this->db->update('mst_rute_inv', $data); 		
	}
}

?>