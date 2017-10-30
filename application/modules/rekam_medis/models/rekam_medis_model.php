<?php if (! defined("BASEPATH")) exit;
class Rekam_medis_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}

	function get_antrian($lab_queue_status){
		$this->db->where('lab_queue_status',$lab_queue_status);
		$this->db->join('ptn_social_data','ptn_social_data.sd_rekmed=trx_lab_queue.sd_rekmed');
		return $this->db->get('trx_lab_queue');
	}

	function get_trx_penunjang($lab_queue_id){
		return $this->db->get_where('trx_lab_treathment',array('lab_queue_id'=>$lab_queue_id));
	}

	function get_trx_penunjang_detail($lab_queue_id){
		return $this->db->get_where('trx_lab_treathment_detail',array('lab_queue_id'=>$lab_queue_id));
	}
}