<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_koefisien_fee_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_koefisien_fee where koef_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_koefisien_fee', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_koefisien_fee
			WHERE 
				koef_id IN ($kode)"
			);*/
		$data = array('koef_status'=>0);
		$this->db->where_in('koef_id',$kode);		
		$this->db->update('mst_koefisien_fee',$data);
	}
	
	function updateMaster($key){
		$query=$this->db->query("select * from mst_koefisien_fee where koef_id='$key'");
		$temp = $query->row_array();
		$koef_value = $temp['koef_value'];
		$koef_id = $temp['koef_id'];
		//for(){}
		$this->db->query("
			update mst_treathment
			set treat_item_price = treat_master_fee*$koef_value
			where koef_id=$koef_id
			");
	}
}

?>