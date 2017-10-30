<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_tindakan_lab_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			SELECT * 
			FROM mst_lab_treathment mlt
			LEFT JOIN mst_lab_treathment_gol mltg ON (mltg.id=mlt.ds_gol)
			WHERE mlt.ds_status = 1	
			");		
		return $query;
		/*
		select * 
			from mst_lab_treathment where ds_status = 1
		*/
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_diagnosa', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_lab_treathment
			WHERE 
				ds_id IN ($kode)"
			);
		$this->db->query(
			"DELETE FROM
				map_mst_lab
			WHERE 
				ds_id IN ($kode)"
			);*/
		$data = array('ds_status'=>0);
			$this->db->where_in('ds_id',$kode);		
			$this->db->update('mst_lab_treathment',$data);
		$data2 = array('status'=>0);
			$this->db->where_in('ds_id',$kode);		
			$this->db->update('map_mst_lab',$data2);
	}
	
	function getInfoPacket($key){
		$query=$this->db->query("
			select * from mst_lab_treathment where ds_id=$key
			");		
		return $query->row_array();
	}
	
	function getDetail($key){
		$query = $this->db->query("
			select mltd.dsd_id,mml.id_map,mml.ds_id,mltd.dsd_name,mltg.golongan_name
			from map_mst_lab mml
			join mst_lab_treathment mlt on(mlt.ds_id=mml.ds_id)			
			join mst_lab_treathment_detail mltd on(mltd.dsd_id=mml.dsd_id)
			join mst_lab_treathment_gol mltg on(mltg.id=mltd.dsd_gol)
			where mml.ds_id=$key and mml.status = 1
			order by mltd.dsd_id
		");
		//$this->sum_packet_price($key);
		return $query;
	}
	
	function getList($key){
		$query = $this->db->query("
	    	select mltd.dsd_id as id,mltd.dsd_name as name,mltg.golongan_name as gol 
	    	from mst_lab_treathment_detail mltd
			join mst_lab_treathment_gol mltg on(mltg.id=mltd.dsd_gol)
			where mltd.dsd_name like '%$key%'
	    	");
	    //print_r($query->result_array());
	    //die;
	    /*
		$r = array();
	    foreach ($query->result() as $key) {
	    	$r[] = array(
	    		//'group'	=>$key->koef_treathment,
	    		'lab_treat_id'	=>$key->dsd_id,	    		
	    		'value'	=>$key->dsd_name,
	    		//'idf'	=>$key->id_fornas,
	    		'gol'	=>$key->golongan_name
	    	);
	    }*/
	    //return $r;
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
			$this->db->where_in('id_map',$kode);		
			$this->db->update('map_mst_lab',$data2);
	}
}

?>