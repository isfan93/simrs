<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_pegawai_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_mst_employer(){
		$query=$this->db->query("
			SELECT *
			FROM mst_employer me
			JOIN mst_type_user mtu ON(mtu.id_type_user=me.sd_type_user)
			where me.sd_status = 1
			");
		return $query->result();
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_employer
			WHERE 
				id_employe IN ($kode)"
			);*/
		$this->db->query("
			update mst_employer
			set sd_status = 0
			where id_employe in ($kode)");
	}
}

?>