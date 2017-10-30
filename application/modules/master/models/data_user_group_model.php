<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_user_group_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from sys_group sg
			where sg.group_status=1
			ORDER BY sg.group_id
			");		
		return $query;
	}	
	
	function deleteData($kode){
		$this->db->query(
			"DELETE FROM
				sys_group
			WHERE 
				group_id IN ($kode)"
			);
		$this->db->query(
			"DELETE FROM
				sys_module_role
			WHERE 
				group_id IN ($kode)"
			);
	}
	
	function getInfoPacket($key){
		$query=$this->db->query("
			select * from sys_group sg
			
			where sg.group_id=$key
			");		
		//join sys_module sm on(sm.module_url=sg.group_homebase)
		return $query->row_array();
	}
	
	function getDetail($key){
		$query = $this->db->query("
			SELECT *
			FROM sys_module_role smr
			JOIN sys_module sm ON(sm.module_id=smr.module_id)
			WHERE smr.group_id=$key
		");
		//$this->sum_packet_price($key);
		return $query;
	}
	
	function getList($key){
		$query = $this->db->query("
	    	select * from sys_group_detail mltd
			join sys_group_gol mltg on(mltg.id=mltd.dsd_gol)
			where mltd.dsd_name like '%$key%'
	    	");
	    //print_r($query->result_array());
	    //die;
		$r = array();
	    foreach ($query->result() as $key) {
	    	$r[] = array(
	    		//'group'	=>$key->koef_treathment,
	    		'lab_treat_id'	=>$key->dsd_id,	    		
	    		'value'	=>$key->dsd_name,
	    		//'idf'	=>$key->id_fornas,
	    		'gol'	=>$key->golongan_name
	    	);
	    }
	    return $r;
	}
	
	function deleteDataDetail($kode){
		$this->db->query(
		"DELETE FROM
			sys_module_role
		WHERE 
			mr_id IN ($kode)"
		);
	}
}

?>