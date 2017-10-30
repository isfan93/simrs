<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_user_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$this->db->join('mst_employer me','me.sd_type_user = mtu.id_type_user');
		$this->db->join('sys_user su','su.emp_id = me.id_employe');
		$this->db->join('sys_group sg','sg.group_id = su.user_group_id');
		$this->db->where('su.user_status',1);
		return $this->db->get('mst_type_user mtu');

	}
	
	function addMaster($data){
		$data['password']=md5($data['password'].encryptkey());
		$result=$this->db->insert('com_user', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		/*$this->db->query(
			"DELETE FROM
				sys_user
			WHERE 
				user_id IN ($kode)"
			);*/
		$data = array('user_status'=>0);
		$this->db->where_in('user_id',$kode);
		//$this->db->delete('trx_dokter_fee');		
		$this->db->update('sys_user',$data);
	}
	
	function getList($key){
		$query = $this->db->query("
	    	select me.id_employe,me.sd_name,me.sd_nip from mst_employer me			
			where me.sd_name like '%$key%'
	    	");
	    //print_r($query->result_array());
	    //die;
		$r = array();
	    foreach ($query->result() as $key) {
	    	$r[] = array(
	    		//'group'	=>$key->koef_treathment,
	    		'id_employe'	=>$key->id_employe,	    		
	    		'value'	=>$key->sd_name,
	    		//'idf'	=>$key->id_fornas,
	    		'nip'	=>$key->sd_nip
	    	);
	    }
	    return $r;
	}
}

?>