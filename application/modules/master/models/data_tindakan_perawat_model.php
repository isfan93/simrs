<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_tindakan_perawat_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_nursing_diagnosis where nd_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_diagnosa', $data);
		
		return $result;
	}
	
	function deleteData($kode){		
		$data = array('nd_status'=>0);
			$this->db->where_in('diagnosis_id',$kode);		
			$this->db->update('mst_nursing_diagnosis',$data);
		$data2 = array('status'=>0);
			$this->db->where_in('diagnosis_id',$kode);		
			$this->db->update('map_diagnosis_nic',$data2);
	}
	
	function getInfoPacket($key){
		$query=$this->db->query("
			select * from mst_nursing_diagnosis where diagnosis_id=$key
			");		
		return $query->row_array();
	}
	
	function getDetail($key){
		$query = $this->db->query("
			select *
			from map_diagnosis_nic mdn
			join mst_treathment mt on(mt.treat_id=mdn.treatment_id)			
			join mst_nursing_diagnosis mnd on(mnd.diagnosis_id=mdn.diagnosis_id)			
			where mdn.diagnosis_id=$key and mdn.status = 1
			order by mdn.treatment_id
		");
		//$this->sum_packet_price($key);
		return $query;
	}
	
	function getList($key){
		$query = $this->db->query("
	    	select * 
	    	from mst_treathment			
			where treat_name like '%$key%' and treat_status = 1
	    	");	    
	    return $query->result_array();
	}
	
	function deleteDataDetail($kode){
		/*$this->db->query(
		"DELETE FROM
			map_mst_lab
		WHERE 
			id_map IN ($kode)"
		);*/
		$data2 = array('status'=>0);
			$this->db->where_in('map_id',$kode);		
			$this->db->update('map_diagnosis_nic',$data2);
	}
}

?>