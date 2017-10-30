<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_type_user_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_type_user where ts_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_type_user', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_type_user
			WHERE 
				id_type_user IN ($kode)"
			);*/
		$data = array('ts_status'=>0);
		$this->db->where_in('id_type_user',$kode);
		//$this->db->delete('trx_dokter_fee');		
		$this->db->update('mst_type_user',$data);

	}
}

?>