<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_room_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		//return $this->db->get('mst_room');
		$query=$this->db->query("
			SELECT *
			FROM mst_room r
			JOIN mst_class c ON(c.class_id=r.class_id)
			JOIN mst_pavillion p ON(p.pavillion_id=r.pavillion_id)
			
			");
		return $query;
		//WHERE r.room_status=1
	}
	
	function addMaster($data){
		$data['password']=md5($data['password'].encryptkey());
		$result=$this->db->insert('com_user', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_room
			WHERE 
				room_id IN ($kode)"
			);*/
		$this->db->query("
			update mst_room
			set room_status = 0
			where room_id in ($kode)");
	}
}

?>