<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_tindakan_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		//$query = $this->db->join('mst_treathment mt','mt.poli = mp.pl_id');

		$query=$this->db->query("
			select * from mst_treathment mt 
			join mst_poly mp on (mp.pl_id=mt.poli)
			join mst_koefisien_fee mkf on(mkf.koef_id=mt.koef_id)
			where mt.treat_status = 1
			order by mt.treat_id desc");
		//return $this->db->get('mst_poly mp');
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_treathment', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_treathment
			WHERE 
				treat_id IN ($kode)"
			);*/
		// echo $this->db->last_query();
		$data = array('treat_status'=>0);
		$this->db->where_in('treat_id',$kode);		
		$this->db->update('mst_treathment',$data);
	}
	
	function get_Detail($key){
		$query=$this->db->query("
			SELECT mt.*,tp.* FROM mst_treathment mt
			JOIN mst_poly tp ON (tp.pl_id=mt.poli)
			WHERE mt.treat_id='$key'
			");
		return $query->row_array();
	}
	
	function updateMaster($data){
		//$result=$this->db->insert('mst_treathment', $data);
		
		//return $result;
	}
	
	function getkoef($data){
		$query=$this->db->query("select * from mst_koefisien_fee where koef_id='$data'");
		return $query->row_array();
	}
}

?>