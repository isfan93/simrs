<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_bed_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_room(){
		$query=$this->db->query("
			SELECT mr.room_id,mr.room_number,mp.pavillion_name
			FROM mst_room mr
			JOIN mst_pavillion mp ON mp.pavillion_id = mr.pavillion_id
			WHERE mr.room_status = 1
			ORDER BY mr.room_number,mp.pavillion_name
			");
		return $query->result();
	}
	function get_list(){		
		//return $this->db->get('mst_room');
		$query=$this->db->query("
			SELECT *
			FROM mst_bed b
			JOIN mst_room r ON(r.room_id=b.room_id)	
			Join mst_pavillion p on(p.pavillion_id=r.pavillion_id)
			
			");
		//where b.status = 1
		return $query;
	}
	
	function deleteData($kode){
		/*
		$this->db->query(
			"DELETE FROM
				mst_bed
			WHERE 
				bed_id IN ($kode)"
			);
		*/
		$data = array('status'=>0);
		$this->db->where_in('bed_id',$kode);		
		$this->db->update('mst_bed',$data);
	}
}

?>