<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_obat_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
		//$db1 = $this->load->database('default', TRUE);
		//$db2 = $this->load->database('second_db', TRUE);
	}
	
	function get_list(){
		// $db2 = $this->load->database('second_db', TRUE);
		$query=$this->db->query("
			select * from inv_item_master iim left join mst_type_inv mti on  iim.im_unit = mti.mtype_id order by im_id desc
			");
		/*
		$query=$this->db->query("
			select * from inv_item_master
			");*/
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_diagnosa', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				inv_item_master
			WHERE 
				im_id IN ($kode)"
			);*/
		$kode = (explode(',', $kode));
		$data = array('im_status'=>0);
		$this->db->where_in('im_id',$kode);		
		$this->db->update('inv_item_master',$data);
	}
	
	function get_Detail($key){
		$query=$this->db->query("
			SELECT iim.*,mti.mtype_name,mti.mtype_id
			FROM inv_item_master iim
			LEFT JOIN mst_type_inv mti ON(mti.mtype_id=iim.im_unit)
			LEFT JOIN mst_golongan_inv mgi ON(mgi.gol_id=iim.im_golongan)
			WHERE iim.im_id='$key'
			");
		return $query->row_array();
	}
}

?>