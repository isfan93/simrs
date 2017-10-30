<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_treat_pack_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select pt_id,pt_name,pt_desc,ifnull(price,0)as price from mst_treat_pack where pt_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_suplyer', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_treat_pack
			WHERE 
				pt_id IN ($kode)"
			);
		$this->db->query(
			"DELETE FROM
				map_mst_treat_pack
			WHERE 
				pt_id IN ($kode)"
			);*/
		$data = array('pt_status'=>0);
			$this->db->where_in('pt_id',$kode);		
			$this->db->update('mst_treat_pack',$data);
		$data2 = array('status'=>0);
			$this->db->where_in('pt_id',$kode);		
			$this->db->update('map_mst_treat_pack',$data2);
	}
	
	function getInfoPacket($key){
		$query=$this->db->query("
			select * from mst_treat_pack where pt_id=$key
			");		
		return $query->row_array();
	}
	
	function getList($key){
		$query = $this->db->query("
	    	select * from mst_treathment mt
			join mst_koefisien_fee mkf on(mkf.koef_id=mt.koef_id)
			where mt.treat_name like '%$key%'
	    	");
	    //print_r($query->result_array());
	    //die;
		$r = array();
	    foreach ($query->result() as $key) {
	    	$r[] = array(
	    		'group'	=>$key->koef_treathment,
	    		'treat_id'	=>$key->treat_id,	    		
	    		'value'	=>$key->treat_name,
	    		//'idf'	=>$key->id_fornas,
	    		'price'	=>$key->treat_item_price
	    	);
	    }
	    return $r;
	}
	
	function getDetail($key){
		$query = $this->db->query("
			select mmtp.map_id,mmtp.pt_id,mt.treat_name, mkf.koef_treathment, mt.treat_item_price
			from map_mst_treat_pack mmtp
			join mst_treathment mt on(mt.treat_id=mmtp.treat_id)			
			join mst_koefisien_fee mkf on(mkf.koef_id=mt.koef_id)
			where mmtp.pt_id=$key and mmtp.status = 1
		");
		$this->sum_packet_price($key);
		return $query;
	}
	
	function sum_packet_price($key){
		$query = $this->db->query("
			select mmtp.pt_id, sum(mt.treat_item_price) as tot_price
			from map_mst_treat_pack mmtp
			join mst_treathment mt on(mt.treat_id=mmtp.treat_id)			
			join mst_koefisien_fee mkf on(mkf.koef_id=mt.koef_id)
			where mmtp.pt_id=$key and mmtp.status = 1
		");		
		$temp=$query->row_array();
		$total=$temp['tot_price'];
		$id=$temp['pt_id'];
		if(!(empty($id))){
			$this->db->query("update mst_treat_pack set price=$total where pt_id=$id");
		}
	}
	
	function deleteDataDetail($kode){
		$query=$this->db->query("select * from map_mst_treat_pack where map_id=$kode");
		$temp=$query->row_array();
		$pt_id=$temp['pt_id'];
	
		/*$this->db->query(
			"DELETE FROM
				map_mst_treat_pack
			WHERE 
				map_id IN ($kode)"
			);*/
		$data2 = array('status'=>0);
			$this->db->where_in('map_id',$kode);		
			$this->db->update('map_mst_treat_pack',$data2);

		$this->sum_packet_price($pt_id);
	}
}

?>