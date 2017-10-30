<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_bed_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		//return $this->db->get('mst_room');
		// SELECT bd.bed_id,mr.room_id,p.pavillion_name,c.class_name,IFNULL(hbo.bed_id,0) AS status
		// 	FROM mst_bed bd
		// 	JOIN mst_room mr ON (mr.room_id=bd.room_id)
		// 	JOIN mst_pavillion p ON(p.pavillion_id=mr.pavillion_id)
		// 	JOIN mst_class c ON(c.class_id=mr.class_id)
		// 	LEFT JOIN hos_bed_occupation hbo ON (hbo.bed_id=bd.bed_id)
		$query=$this->db->query("
			SELECT bd.bed_id,mr.room_id,p.pavillion_name,c.class_name,hbc.is_occupied AS status_bed
			FROM mst_bed bd
			JOIN mst_room mr ON (mr.room_id=bd.room_id)
			JOIN mst_pavillion p ON(p.pavillion_id=mr.pavillion_id)
			JOIN mst_class c ON(c.class_id=mr.class_id)
			JOIN hos_bed_occupation hbc ON hbc.bed_id=bd.bed_id
			WHERE hbc.is_occupied = 1
			UNION 
			SELECT bd.bed_id,mr.room_id,p.pavillion_name,c.class_name,IFNULL(hbo.bed_id,0) AS status_bed
			FROM mst_bed bd
			JOIN mst_room mr ON (mr.room_id=bd.room_id)
			JOIN mst_pavillion p ON(p.pavillion_id=mr.pavillion_id)
			JOIN mst_class c ON(c.class_id=mr.class_id)
			JOIN hos_bed_occupation hbo ON (hbo.bed_id=bd.bed_id)
			WHERE bd.bed_id NOT IN(
				SELECT bd2.bed_id
				FROM mst_bed bd2
				JOIN mst_room mr2 ON (mr2.room_id=bd2.room_id)
				JOIN mst_pavillion p2 ON(p2.pavillion_id=mr2.pavillion_id)
				JOIN mst_class c2 ON(c2.class_id=mr2.class_id)
				JOIN hos_bed_occupation hbc2 ON hbc2.bed_id=bd2.bed_id
				WHERE hbc2.is_occupied = 1
			) AND bd.status = 1 AND bd.bed_id <> 14			
			");
		return $query;

	}
	
	function deleteData($kode){
		$this->db->query(
			"DELETE FROM
				mst_bed
			WHERE 
				bed_id IN ($kode)"
			);
	}
}

?>