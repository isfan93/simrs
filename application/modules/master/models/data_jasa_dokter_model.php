<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_jasa_dokter_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
		//$db1 = $this->load->database('default', TRUE);
		//$db2 = $this->load->database('second_db', TRUE);
	}
	
	function get_list(){
		$this->db->where('tdf_status','1');
		$this->db->order_by('tdf_id','desc');
		$this->db->join('mst_employer me','me.id_employe = tdf.dr_id');
		$this->db->join('mst_type_user mtu','me.sd_type_user = mtu.id_type_user');
		return $this->db->get('trx_dokter_fee tdf');
	}
	
	function addMaster($data){
		$result=$this->db->insert('mst_diagnosa', $data);
		
		return $result;
	}
	
	function deleteData($kode){
		$kode = explode(',', $kode);
		$data = array('tdf_status'=>0);
		$this->db->where_in('tdf_id',$kode);
		//$this->db->delete('trx_dokter_fee');		
		$this->db->update('trx_dokter_fee',$data);
	}
}

?>