<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_lab_treathment_detail_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * 
			from mst_lab_treathment_detail ltd
			join mst_lab_treathment_gol tg on(tg.id=ltd.dsd_gol)
			where ltd.dsd_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_lab_treathment_detail', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_lab_treathment_detail
			WHERE 
				dsd_id IN ($kode)"
			);*/
		$data = array('dsd_status'=>0);
		$this->db->where_in('dsd_id',$kode);		
		$this->db->update('mst_lab_treathment_detail',$data);
	}
}

?>