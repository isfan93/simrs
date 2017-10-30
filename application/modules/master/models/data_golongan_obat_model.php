<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_golongan_obat_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$query=$this->db->query("
			select * from mst_golongan_inv 
			where gol_status = 1
			order by gol_id desc
			");
		return $query;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_gol_inv
			WHERE 
				gol_id IN ($kode)"
			);*/
		$data = array('gol_status'=>0);
		$this->db->where_in('gol_id',$kode);		
		$this->db->update('mst_golongan_inv',$data);
	}
	
	function updateMaster($data){
		//$result=$this->db->insert('mst_treathment', $data);
		$this->db->where('gol_id', $data['gol_id']);
		$this->db->update('mst_golongan_inv', $data); 
		//return $result;
	}
}

?>