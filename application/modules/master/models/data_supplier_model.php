<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_supplier_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){		
		$query=$this->db->query("
			select * from mst_supplier ms
			left join mst_province mp on(mp.mpr_id=ms.msup_province)
			left join mst_regency mr on(mr.mre_id=ms.msup_city)
			where ms.msup_status = 1
			");		
		return $query;
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_supplier', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				mst_supplier
			WHERE 
				msup_id IN ($kode)"
			);*/
		$data = array('msup_status'=>0);
		$this->db->where_in('msup_id',$kode);		
		$this->db->update('mst_supplier',$data);
	}
}

?>