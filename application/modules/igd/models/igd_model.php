<?php if (! defined("BASEPATH")) exit;
class Igd_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}

	function get_ptn_rekmed($sd_rekmed){
        $this->db->_protect_identifiers=false;
		$this->db->order_by('visit_in','desc');
		$this->db->join('trx_service ts','substr(ts.service_id,4,8) = tv.visit_id');
		return $this->db->get_where('trx_visit tv',array('visit_rekmed'=>$sd_rekmed));
	}

	function get_kajian_anamnesa($pl_id){
		return $this->db->get_where('mst_medical_anamnesa',array('pl_id'=>$pl_id));
	}

	function get_kajian_subjective($pl_id){
		return $this->db->get_where('mst_medical_subjective',array('pl_id'=>$pl_id));
	}

	function get_kajian_objective($pl_id){
		return $this->db->get_where('mst_medical_objective',array('pl_id'=>$pl_id));
	}

	function cek_is_exist_medical($mdc_id,$sd_rekmed){
		return $this->db->get_where('trx_medical',array('mdc_id'=>$mdc_id,'sd_rekmed'=>$sd_rekmed));
	}

	function get_racikan($mdc_id)
	{
		return $this->db->get_where('trx_racikan',array('mdc_id'=>$mdc_id));
	}

	function get_trx_kajian_anamnesa($mdc_id){
		return $this->db->get_where('trx_medical_anamnesa',array('mdc_id'=>$mdc_id));
	}

	function get_trx_kajian_objective($mdc_id){
		return $this->db->get_where('trx_medical_objective',array('mdc_id'=>$mdc_id));
	}

	function get_trx_kajian_subjective($mdc_id){
		return $this->db->get_where('trx_medical_subjective',array('mdc_id'=>$mdc_id));
	}

	function cek_is_exist_diagnosa_treathment($mdc_id){
		return $this->db->get_where('trx_diagnosa_treathment',array('mdc_id'=>$mdc_id));
	}

	function get_com_code($title){
		return $this->db->get_where('com_code',array('title'=>$title));
	}

	function cek_is_exist_medical_lab($mdc_id){
		return $this->db->get_where('trx_medical_lab',array('mdc_id'=>$mdc_id));
	}

	function get_trx_penunjang($lab_queue_id){
		$this->db->join('mst_lab_treathment mt','mt.ds_id = tlt.ds_id');
		return $this->db->get_where('trx_lab_treathment tlt',array('lab_queue_id'=>$lab_queue_id));
	}
	
	function get_trx_penunjang_detail($lab_queue_id){
		return $this->db->get_where('trx_lab_treathment_detail',array('lab_queue_id'=>$lab_queue_id));
	}

	function get_trx_penunjang_rekmed($mdc_id)
	{
		$visit_id = substr($mdc_id, 3,8);
		$this->db->join('mst_lab_treathment mt','mt.ds_id = tlt.ds_id');
		$this->db->like('tlt.lab_queue_id',$visit_id);
		return $this->db->get('trx_lab_treathment tlt');
	}

	function cek_is_exist_diagnosa_support($lab_queue_id){
		return $this->db->get_where('trx_lab_treathment',array('lab_queue_id'=>$lab_queue_id));
	}

	function get_diagnosa($mdc_id)
	{
		$this->db->select('tdt.mdc_id,tdt.dat_id,tdt.dat_note,tdt.dat_case,tdt.dat_diag,md.diag_name,md.description,md.indonesian');
		$this->db->where('tdt.mdc_id',$mdc_id);
		$this->db->join('mst_diagnosa md','md.diag_id = tdt.dat_diag','left');
		return $this->db->get('trx_diagnosa_treathment tdt');
	}
	
	function get_diagnosa_support_detail($ds_id){
		$this->db->select('mml.ds_id,mml.dsd_id,mltbd.*');
		$this->db->join('map_mst_lab mml','mltbd.dsd_id = mml.dsd_id');
		return $this->db->get_where('mst_lab_treathment_detail mltbd',array('mml.ds_id'=>$ds_id,'mltbd.dsd_status'=>'1'));
	}

	function cek_is_existt_medical_ptn_now($mdc_id){
		return $this->db->get_where('trx_medical_ptn_now',array('mdc_id'=>$mdc_id));
	}

	function get_medical_ptn_now($mdc_id){
		return $this->db->get_where('trx_medical_ptn_now',array('mdc_id'=>$mdc_id))->row();
	}

	function get_detail_diagnosa($mdc_id)
	{
		$this->db->select('tdtd.dat_time as time,tdtd.dat_pic as pic,tdt.mdc_id,tdtd.dat_id,tdtd.dat_treat,mt.treat_name,mt.treat_item_price');
		$this->db->where('tdt.mdc_id',$mdc_id);
		$this->db->join('mst_treathment mt','mt.treat_id = tdtd.dat_treat','left');
		$this->db->join('trx_diagnosa_treathment tdt','tdt.dat_id = tdtd.dat_id','left');
		return $this->db->get('trx_diagnosa_treathment_detail tdtd');
	}

	function get_dokter($mdc_id)
	{
		$this->db->select('me.sd_name as dr_name');
		$this->db->where('mdc_id',$mdc_id);
		$this->db->join('mst_employer me','me.id_employe = tm.dr_id');
		return $this->db->get('trx_medical tm');
	}

	function get_all_dokter()
	{
		$dokter = $this->db->get_where('mst_employer','sd_employe_tp = 1');
		return $dokter->result();
	}

	function get_konsul($mdc_id){
		$konsul = $this->db->get_where('trx_visite',"mdc_id = '$mdc_id'");
		return $konsul->result();
	}

	function get_visite(){
		//$visite = $this->db->get_where('mst_treathment',"treat_name like 'visite %'");
		$visite = $this->db->get_where('mst_treathment',"koef_id = 1");
		return json_encode($visite->result());
	}

	function get_detail_resep($mdc_id)
	{
		$this->db->select('tr.mdc_id,tr.recipe_id,trd.recipe_medicine,trd.recipe_price,trd.recipe_batch,trd.recipe_note,trd.recipe_rule,trd.recipe_qty,im.im_unit,im.im_name,im.im_item_price,mti.mtype_name');
		$this->db->where('tr.mdc_id',$mdc_id);
		$this->db->join('trx_recipe_detail trd','trd.recipe_id = tr.recipe_id');
		$this->db->join('inv_item_master im','trd.recipe_medicine = im.im_id');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
		return $this->db->get('trx_recipe tr');
	}

	function cek_if_exist_trx_visit_bill($mdc_id)
	{
		$status 	= $this->db->get_where('trx_visit_bill',array('visit_id'=>$mdc_id));
		if( $status->num_rows() >= 1 )
		{
			return TRUE;
		}else
		{
			return FALSE;
		}
	}

	function get_dokter_fee($mdc_id)
	{
		$medical 	= $this->db->get_where('trx_medical',array('mdc_id'=>$mdc_id))->row();
		$dokter_fee = $this->db->get_where('trx_dokter_fee',array('dr_id'=>$medical->dr_id,'tdf_status'=>'1'));
		// $dokter_fee = $this->db->get_where('mst_treathment',array('treat_id'=>108));
		
		return 	$dokter_fee;
	}

	function get_adm_fee($mdc_id)
	{
		$this->db->select('*');
		$this->db->where('taf.mdc_id',$mdc_id);
		$this->db->join('mst_adm_fee maf','taf.adm_id = maf.adm_id');
		return $this->db->get('trx_adm_fee taf');
	}

	function get_medical_patient($sd_rekmed)
	{
		return $this->db->get_where('ptn_social_data',array('sd_rekmed'=>$sd_rekmed))->row();
	}

	function get_detail_adm($visit_id)
	{
		$this->db->join('mst_adm_fee maf','maf.adm_id = taf.adm_id');
		return $this->db->get_where('trx_adm_fee taf',array('mdc_id'=>$visit_id));
	}

	function get_visite_detail($mdc_id)
	{
		$this->db->join('mst_employer me','tve.dr_id = me.id_employe','left');
		$this->db->join('mst_treathment mt','mt.treat_id = tve.visite_tp','left');
		$this->db->where(array('tve.mdc_id'=>$mdc_id));
		return $this->db->get('trx_visite tve');
	}

	

} // end class