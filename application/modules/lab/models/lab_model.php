<?php if (! defined("BASEPATH")) exit;
class Lab_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}

	function get_antrian($lab_queue_status){
		if( is_array($lab_queue_status) )
			$this->db->where_in('lab_queue_status',$lab_queue_status);
		else
			$this->db->where('lab_queue_status',$lab_queue_status);

        $this->db->_protect_identifiers=false;
		$this->db->join('trx_visit tv','tv.visit_id = substr(trx_lab_queue.lab_queue_id,4,8)');
		$this->db->join('ptn_social_data','ptn_social_data.sd_rekmed=trx_lab_queue.sd_rekmed','left');
		$this->db->where('substr(trx_lab_queue.lab_queue_id,1,2)','LB');
		return $this->db->get('trx_lab_queue');
	}

	function get_trx_penunjang($lab_queue_id){
		$this->db->join('mst_lab_treathment mlt','tlt.ds_id = mlt.ds_id');
		$this->db->join('mst_lab_treathment_gol mltg','mltg.id = mlt.ds_gol','left');
		return $this->db->get_where('trx_lab_treathment tlt',array('lab_queue_id'=>$lab_queue_id));
	}

	function get_trx_penunjang_detail($lab_queue_id){
		$this->db->join('trx_lab_treathment tlt','tlt.trx_ds_id = tltd.trx_ds_id');
		return $this->db->get_where('trx_lab_treathment_detail tltd',array('tltd.lab_queue_id'=>$lab_queue_id));
	}

	function get_diagnosa_support_detail($ds_id){
		$this->db->select('mml.ds_id,mml.dsd_id,mltbd.*');
		$this->db->join('map_mst_lab mml','mltbd.dsd_id = mml.dsd_id');
		$this->db->join('mst_lab_treathment mlt','mml.ds_id = mlt.ds_id');
		$this->db->order_by('mml.dsd_id','asc');
		return $this->db->get_where('mst_lab_treathment_detail mltbd',array('mml.status'=>'1','mml.ds_id'=>$ds_id,'mltbd.dsd_status'=>'1','mlt.ds_type'=>'LAB'));
	}

	function checkExist($table,$where)
	{
		$this->db->where($where);
		return $this->db->get($table);
	}
}