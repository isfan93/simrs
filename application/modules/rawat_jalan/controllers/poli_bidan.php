<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poli_bidan extends MY_Controller {
	function __construct() {
		parent::__construct();

		// local variable
		$this->pl_id = 5;
		$this->nama_poli 	= 'Poli Bidan';
		$this->url_poli 	= 'poli_bidan';

		// model 
		$this->load->model('poli_model','poli_model');
		$this->load->model('pendaftaran/pendaftaran_model','pendaftaran_m');

		// alur status 
		// antrian masuk trx_queo queo_status 1
		// pemeriksaan selesai, belum bayar queo_status 2
		// pemeriksaan selesai, sudah bayar queo_status 3
		// dilakukan pemeriksaan mdc_status 1
		// pemeriksaan selesai mdc_status 2

		// trx visit status
		// 1 = masuk; 2 = proses; 3 = menunggu bayar; 4 = sudah bayar; 5 = selesai;

		// ekspertise status
		// 1 : daftar ekspertise; 2 : diproses; 5 : sudah di eksertise;
	}

	public function index(){
		$data['main_view']	= 'poli/index';
		$data['title']		= 'Pasien '.$this->nama_poli;
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['url_poli']	= $this->url_poli;
		$data['desc']		= 'Antrian '.$this->nama_poli;;
		// $data['antrian']	= $this->poli_model->get_antrian_active_poli($this->pl_id);
		$this->load->view('template',$data);
	}

	public function get_antrian()
	{
		$config['sTable']	= "trx_queue_outpatient tqo";
		$config['key']		= "tqo.queo_id";
		$config['join'][]	= array("ptn_social_data psd","tqo.sd_rekmed = psd.sd_rekmed");
		$config['join'][]	= array("trx_service ts","ts.service_id = tqo.queo_id");
		$config['aColumns']		= array("tanggal","mdc_id","sd_rekmed","sd_address");
		$config['aColumns_format']	= array("tqo.queo_datetime as tanggal,tqo.queo_id as mdc_id, psd.sd_rekmed as sd_rekmed,  CONCAT_WS( '<br>', CONCAT('<b>',psd.sd_name,'</b>'),CONCAT('<i>',psd.sd_address,'</i>')) as sd_address");
		$config['php_format']	= array("date","","","strtoupper");
		$config['where'][]		= "tqo.pl_id = ".$this->pl_id;
		$config['where'][]		= "tqo.queo_status = 1";
		$config['aksi']			= array(
									'stat'  	=> false,
									'key'		=> '',
									'pilih'	=> '',
									);
		$config['searchColumn']	= array("sd_name");
		init_datatable($config);
	}

	function data_diri($rm = null,$mdc_id = null){
		$data['main_view']	= 'poli/data_diri';
		$data['url_poli']	= $this->url_poli;
		$this->db->where('psd.sd_rekmed',$rm);
		$this->db->where('tqo.queo_status',1);
		$this->db->where('tqo.queo_id',$mdc_id);
		$this->db->join('ptn_social_data psd','psd.sd_rekmed = tqo.sd_rekmed');
		$pasien = $this->db->get('trx_queue_outpatient tqo');
		if( $pasien->num_rows() >= 1)
		{
			$this->db->where('psd.sd_rekmed',$rm);
			$this->db->where('tqo.queo_status',1);
			$this->db->where('tqo.queo_id',$mdc_id);
			$this->db->join('ptn_social_data psd','psd.sd_rekmed = tqo.sd_rekmed');
			$data['pasien'] = db_conv($this->db->get('trx_queue_outpatient tqo'));
		}
		$data['ptn_now'] = $this->poli_model->get_medical_ptn_now($mdc_id);
		$this->load->view('poli/data_diri',$data);
	}
	
	// proses antrian
	function proses(){
		$data['prev']		= $this->input->post('ds');
		$data['ptn_now'] 	= $this->input->post('dp');
		$data['sd']			= $this->input->post('sd');
		$data['url_poli']	= $this->url_poli;
		$this->db->trans_start();
		if(isset($data['prev']['sd_rekmed'])){
			$cek = $this->poli_model->cek_is_exist_medical($data['prev']['queo_id'],$data['prev']['sd_rekmed']);
			if( $cek->num_rows() == 0){
				$dt['sd_rekmed'] = $data['prev']['sd_rekmed'];
				$dt['mdc_id']	 = $data['prev']['queo_id'];
				$dt['pl_id']	 = $data['prev']['pl_id'];
				$dt['dr_id']	 = $data['prev']['dr_id'];
				$this->db->insert('trx_medical',$dt);
			}
		}

		if(isset($data['ptn_now']['mdc_id'])){
			$mdc_id = $data['ptn_now']['mdc_id'];
			$cek = $this->poli_model->cek_is_existt_medical_ptn_now($mdc_id);
			if( $cek->num_rows() >= 1){
				$this->db->where('mdc_id',$mdc_id);
				$this->db->update('trx_medical_ptn_now',$data['ptn_now']);
			}else{
				$this->db->insert('trx_medical_ptn_now',$data['ptn_now']);
				// update status to proses
				$dtVisit['visit_status'] = 2;
				$this->db->where('visit_id',substr($mdc_id, 3,8));
				$this->db->update('trx_visit',$dtVisit);
				$dtService['service_status'] = 2;
				$this->db->where('service_id',$mdc_id);
				$this->db->update('trx_service',$dtService);
			}
		}

		if( !empty($data['sd']) )
		{
			$this->db->where('sd_rekmed',$data['prev']['sd_rekmed']);
			$this->db->update('ptn_social_data',$data['sd']);
		}

		// if(isset($mdc_id))
		// {
		// 	$data_resep = $this->db->get_where('trx_recipe',array('mdc_id'=>$mdc_id));
		// 	if($data_resep->num_rows() <= 0){
		// 		$visit_id = substr($mdc_id, 3, 8);
		// 		$dtr['mdc_id']		= $mdc_id;
		// 		$dtr['recipe_id']		= $this->genResepID($visit_id);
		// 		$this->db->insert('trx_recipe',$dtr);
		// 	}
		// }
		$this->db->trans_complete();

		$data['ptn_now'] 	= $this->poli_model->get_medical_ptn_now($mdc_id);
		$data['pasien']		= $this->poli_model->get_medical_patient($data['prev']['sd_rekmed']);
		$data['classes'] 	= $this->pendaftaran_m->getClasses();
		$data['penunjang_lab'] = $this->db->join('mst_lab_treathment_gol mg','mg.id = mt.ds_gol','left')->order_by('ds_gol','asc')->get_where('mst_lab_treathment mt',array('ds_status'=>1,'ds_type'=>'LAB'));
		//$data['penunjang_lab'] = $this->db->get_where('mst_lab_treathment',array('ds_status'=>1,'ds_type'=>'LAB'));
		//$this->db->select('mt.*,mg.golongan_name');
		//$this->db->join('mst_lab_treathment_gol mg','mg.id = mt.ds_gol');
		//$this->db->where('mt.ds_status',1);
		//$this->db->where('mt.ds_type','LAB');
		//$data['penunjang_lab'] = $this->db->query("SELECT mt.*
		//	FROM mst_lab_treathment mt
		//	JOIN mst_lab_treathment_gol mg ON mg.id = mt.ds_gol
		//	WHERE mt.ds_status = 1 AND mt.ds_type = 'LAB'");
		$data['penunjang_rad'] = $this->db->join('mst_lab_treathment_gol mg','mg.id = mt.ds_gol','left')->order_by('ds_gol','asc')->get_where('mst_lab_treathment mt',array('ds_status'=>1,'ds_type'=>'RAD'));
		//$data['penunjang_rad'] = $this->db->get_where('mst_lab_treathment',array('ds_status'=>1,'ds_type'=>'RAD'));
		$data['main_view']	= 'poli/proses';
		$data['title']		= 'Pasien '.$this->nama_poli;
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$data['mdc_id']		= $data['prev']['queo_id'];
		$data['sd_rekmed']	= $data['prev']['sd_rekmed'];
		$this->load->view('template',$data);
	}

	// simpan oleh perawat
	public function proses_simpan(){
		$data['prev']		= $this->input->post('ds');
		$data['ptn_now'] 	= $this->input->post('dp');
		$data['sd']			= $this->input->post('sd');
		$data['url_poli']	= $this->url_poli;
		if(isset($data['prev']['sd_rekmed'])){
			$cek = $this->poli_model->cek_is_exist_medical($data['prev']['queo_id'],$data['prev']['sd_rekmed']);
			if( $cek->num_rows() == 0){
				$dt['sd_rekmed'] = $data['prev']['sd_rekmed'];
				$dt['mdc_id']	 = $data['prev']['queo_id'];
				$dt['pl_id']	 = $data['prev']['pl_id'];
				$dt['dr_id']	 = $data['prev']['dr_id'];

				$this->db->insert('trx_medical',$dt);
				// insert to trx_visit
				$dt = array();
				$dt['visit_rekmed']	= $data['prev']['sd_rekmed'];
				$dt['visit_type']	= 'rajal';
				$dt['visit_in']	= date('Y-m-d h:i:s');
				$dt['visit_status']	= 2;
				$this->db->where('visit_id',$data['prev']['queo_id']);
				$this->db->update('trx_visit',$dt);
			}
		}
		if(isset($data['ptn_now']['mdc_id'])){
			$mdc_id = $data['ptn_now']['mdc_id'];
			$cek = $this->poli_model->cek_is_existt_medical_ptn_now($mdc_id);
			if( $cek->num_rows() >= 1){
				$this->db->where('mdc_id',$mdc_id);
				$this->db->update('trx_medical_ptn_now',$data['ptn_now']);
			}else{
				$this->db->insert('trx_medical_ptn_now',$data['ptn_now']);
			}
		}
		if( !empty($data['sd']) )
		{
			$this->db->where('sd_rekmed',$data['prev']['sd_rekmed']);
			$this->db->update('ptn_social_data',$data['sd']);
		}

		$data_resep = $this->db->get_where('trx_recipe',array('mdc_id'=>$mdc_id));
		if($data_resep->num_rows() <= 0){
			$dtr['mdc_id']		= $mdc_id;
			$dtr['recipe_id']		= $this->genResepID();
			$this->db->insert('trx_recipe',$dtr);
		}
	}
	
	// tab kajian // subjective
	function kajian($mdc_id){
		$data['mdc_id'] = $mdc_id;
		$data['pl_id']	= $this->pl_id;
		$data['url_poli'] = $this->url_poli;
		$this->load->view('poli/kajian',$data);
	}

	// anamnesa
	function anamnesa($mdc_id){
		$data['anamnesa']		= $this->poli_model->get_kajian_anamnesa($this->pl_id);
		if(!empty($mdc_id)){
			$data['trx_anamnesa'] = $this->poli_model->get_trx_kajian_anamnesa($mdc_id);
		}
		$this->load->view('poli/anamnesa',$data);
	}

	function add_anamnesa(){
		$data = $this->input->post('ds');
		$this->db->insert('mst_medical_anamnesa',$data);
	}

	// objective
	function objective($mdc_id){
		$data['mdc_id'] = $mdc_id;
		$data['pl_id']	= $this->pl_id;
		$data['url_poli']	= $this->url_poli;
		$data['ptn_now']= $this->poli_model->get_medical_ptn_now($mdc_id);
		$data['objective']	= $this->poli_model->get_trx_kajian_objective($mdc_id);
		$this->load->view('poli/objective',$data);
	}

	//kajian objective (ko)
	function kajian_objective($mdc_id){
		$data['ko']		= $this->poli_model->get_kajian_objective($this->pl_id);
		if(!empty($mdc_id)){
			$trx_ko 		= $this->poli_model->get_trx_kajian_objective($mdc_id);
			if($trx_ko->num_rows()){
				$data['trx_ko'] = $this->poli_model->get_trx_kajian_objective($mdc_id);
			}else{
				$data['trx_ko'] = array();
			}
		}
		$this->load->view('poli/kajian_objective',$data);
	}

	function add_kajian_objective(){
		$data = $this->input->post('ds');
		$this->db->insert('mst_medical_objective',$data);
	}

	//kajian subjective (ks)
	function kajian_subjective($mdc_id){
		$data['ks']		= $this->poli_model->get_kajian_subjective($this->pl_id);
		if(!empty($mdc_id)){
			$trx_ks 		= $this->poli_model->get_trx_kajian_subjective($mdc_id);
			if($trx_ks->num_rows()){
				$data['trx_ks'] = $this->poli_model->get_trx_kajian_subjective($mdc_id);
			}else{
				$data['trx_ks'] = array();
			}
		}
		$this->load->view('poli/kajian_subjective',$data);
	}

	function add_kajian_subjective(){
		$data = $this->input->post('ds');
		$this->db->insert('mst_medical_subjective',$data);
	}

	function simpan_kajian(){
		$data = $this->input->post('ds');
		$mdc_id = $data['mdc_id'];
		// anamnesa
		$this->db->trans_start();
		$dtkajian = $this->poli_model->get_trx_kajian_anamnesa($mdc_id);
		if( $dtkajian->num_rows() >= 1 ){
			$this->db->where('mdc_id',$mdc_id);
			$this->db->update('trx_medical_anamnesa',$data);
		}else{
			$this->db->insert('trx_medical_anamnesa',$data);
		}
		$this->db->trans_complete();
	}

	function simpan_objective()
	{
		$data = $this->input->post('ds');
		$mdc_id = $data['mdc_id'];
		$dtkajian = $this->poli_model->get_trx_kajian_objective($mdc_id);
		$this->db->trans_start();
		if( $dtkajian->num_rows() >= 1 ){
			$this->db->where('mdc_id',$mdc_id);
			$this->db->update('trx_medical_objective',$data);
		}else{
			$this->db->insert('trx_medical_objective',$data);
		}
		$this->db->trans_complete();
	}
	

	// rekam medis
	function rekam_medis($sd_rekmed){
		$data['med_recs'] 	= $this->poli_model->get_ptn_rekmed($sd_rekmed);
		$data['url_poli']	= $this->url_poli;
		$this->load->view('poli/rekam_medis',$data);	
	}

	function single_rekmed($mdc_id){
		$data['mdc_id']	= $mdc_id;
		$data['dokter']		= $this->poli_model->get_dokter($mdc_id)->row();
        
        $service = $this->db->get_where('trx_service',array('service_id'=>$mdc_id))->row();
		$data['visit_status'] = $this->db->get_where('mst_visit_status',array('vs_id'=>$service->service_status))->row();

        $this->db->_protect_identifiers=false;
		$this->db->join('trx_service ts','substr(ts.service_id,4,8) = tv.visit_id');
		$this->db->join('trx_medical tm','ts.service_id = tm.mdc_id','left');
		$this->db->join('mst_poly mp','tm.pl_id = mp.pl_id','left');
		$this->db->where('ts.service_id',$mdc_id);
		$data['medical']	= $this->db->get('trx_visit tv');
		$data['ptn_now']	= $this->poli_model->get_medical_ptn_now($mdc_id);

		
		$data['diagnosa'] 	= $this->poli_model->get_diagnosa($mdc_id);
		$data['anamnesa'] 	= $this->db->get_where('trx_medical_anamnesa',array('mdc_id'=>$mdc_id));
		$data['objective'] 	= $this->db->get_where('trx_medical_objective',array('mdc_id'=>$mdc_id));
		$data['detail_diagnosa'] 	= $this->poli_model->get_detail_diagnosa($mdc_id);
		$data['obat'] 		= $this->poli_model->get_detail_resep($mdc_id);
		$data['racikan'] 		= $this->poli_model->get_racikan($mdc_id);
		$data['surat_keterangan'] 	= $this->db->get_where('trx_reference',array('mdc_id'=>$mdc_id));
		
		$data['penunjang'] = $this->poli_model->get_trx_penunjang_rekmed($mdc_id);
		// $data['penunjang_detail'] = $this->poli_model->get_trx_penunjang_detail_rekmed($mdc_id);
		$data['visite']	= $this->poli_model->get_visite_detail($mdc_id);

		$this->load->view('poli/single_rekmed',$data);
	}

	// diagnosis
	function diagnosis($mdc_id){
		$data['mdc_id']	= $mdc_id;
		$data['url_poli']	= $this->url_poli;
		$data['diagnosa']= $this->poli_model->get_diagnosa($mdc_id);
		$data['detail_diagnosa']= $this->poli_model->get_detail_diagnosa($mdc_id);
		$this->load->view('poli/diagnosis',$data);
	}

	function simpan_diagnosis(){
		$data 		= $this->input->post();
		$mdc_id 	= $data['mdc_id'];
		$data_diag = $this->poli_model->cek_is_exist_diagnosa_treathment($mdc_id);

		$this->db->trans_start();
		if($data_diag->num_rows() >= 1){
			foreach ($data_diag->result() as $key => $value) {
				$this->db->where('dat_id',$value->dat_id);
				$this->db->delete('trx_diagnosa_treathment_detail');		
			}
			$this->db->where('mdc_id',$mdc_id);
			$this->db->delete('trx_diagnosa_treathment');
		}
		
		foreach ($data['diagnosa'] as $key => $value) {
				$visit_id = substr($mdc_id, 3, 8);
				$dat_id = $this->genDiagnosaID($mdc_id,$visit_id);
				$data_diagnosa = array(
					'mdc_id'	=> $mdc_id,
					'dat_id'	=> $dat_id,
					'dat_diag'	=> (isset($value)) ? $value : '',
					'dat_note'	=> (isset($data['note'][$key])) ? $data['note'][$key] : '',
					'dat_case'	=> (isset($data['rj_case_'.$key])) ? $data['rj_case_'.$key] : '',
				);
			if(!empty($data_diagnosa)){
				$this->db->insert('trx_diagnosa_treathment',$data_diagnosa);
			}
			if(count($data['tindakan'][($key+1)]) >= 1){
				foreach ($data['tindakan'][($key+1)] as $k => $v) {
					if(!empty($v)){
						$data_tindakan[] = array(
							'dat_id'	=> $dat_id,
							'dat_treat'	=> $v,
						);
					}
				}
			}
		}
		if(!empty($data_tindakan)){
			$this->db->insert_batch('trx_diagnosa_treathment_detail',$data_tindakan);
		}
		$this->db->trans_complete();
	}

	//membuat id diagnosa
	function genDiagnosaID($mdc_id,$visit_id){
		$this->db->select_max('dat_id');
        $this->db->where('substr(mdc_id,4,8)',$visit_id);
        $no = $this->db->get('trx_diagnosa_treathment');
        if($no->num_rows() >= 1)
        {
        	$no = $no->row();
        	$no = substr($no->dat_id,12,2);
        }else{
        	$no = 0;
        }
        $format = 'DA-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);
        return $format;
	}

	
	function get_diagnosa(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('mst_diagnosa');
		if($query!=null){
			$this->db->or_like('lower(indonesian)', "$query",'both');
			$this->db->or_like('diag_kode', "$query",'both');
		}
		$this->db->limit(10);
		$data = $this->db->get()->result();
		
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->diag_id",
				'name'	=> "$datas->indonesian ($datas->diag_kode)",
				'desc'	=> "$datas->description",
				'indonesian'	=> "$datas->indonesian",
			);
		}

		echo json_encode($data);
	} 

	function json_get_tindakan($id){
		$tindakan = $this->db->get_where('mst_treathment',array('treat_id'=>$id));
		$data = array();
		$total = 0;
		foreach($tindakan->result() as $d){
			$data = array(
				'id'	=> $d->treat_id,
				'name'	=> $d->treat_name,
				'harga'	=> $d->treat_item_price,
				'harga_jasa' => $d->treat_paramedic_price
			);
		}
		echo json_encode($data);
	}

	function get_tindakan(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		if($query!=null){
			$this->db->or_like('lower(treat_name)', "$query",'both');
			$this->db->or_like('treat_id', "$query",'both');
		}
		$this->db->where_in('poli',array($this->pl_id,100));
		$this->db->where('treat_status = 1');
		$this->db->from('mst_treathment');
		$this->db->limit(10);
		$data = $this->db->get()->result();
		
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->treat_id",
				'name'	=> "$datas->treat_name"
			);
		}

		echo json_encode($data);
	} 



	// resep dan obat
	function resep($mdc_id){
		$data['resep']	= $this->poli_model->get_detail_resep($mdc_id);
		$data['mdc_id'] = $mdc_id;
		$data['url_poli'] 	= $this->url_poli;
		// get Recipa
		$recipe 	= $this->db->get_where('trx_recipe',array('mdc_id'=>$mdc_id));
		// Get all medicine
		$this->db->select('SUM(iis.istok_qty) as istok_qty,im.*');
        $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
        $this->db->group_by('im.im_id');
        $data['medicine'] = $this->db->get('inv_item_master im');
        // get racikan fee
        $data['racikan_fee'] = $this->db->get('mst_racikan_fee');
        // Get Racikan
        $this->db->where('mdc_id',$mdc_id);
        $this->db->join('mst_racikan_fee mrf','mrf.id = tr.racikan_tuslah_type');
        $data['racikan_medicine'] = $this->db->get('trx_racikan tr');
        if($data['racikan_medicine']->num_rows() >= 1)
        {
            foreach ($data['racikan_medicine']->result() as $key => $value) {
                $this->db->join('inv_item_master im','trd.racikan_medicine = im.im_id');
                $this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
                $this->db->where('racikan_id',$value->racikan_id);
                $detail = $this->db->get('trx_racikan_detail trd');
                $data['racikan_medicine_detail'][$value->racikan_id] = $detail->result();
            }
        }
        $medical = $this->db->get_where('trx_medical',array('mdc_id'=>$mdc_id))->row();
        // get racikan yang pernah dipakai dokter
        $this->db->where('tm.dr_id',$medical->dr_id);
        $this->db->join('trx_medical tm','tm.mdc_id = tr.mdc_id');
        $data['riwayat_racikan']	= $this->db->get('trx_racikan tr');

        if($data['riwayat_racikan']->num_rows() >= 1)
        {
        	foreach ($data['riwayat_racikan']->result() as $key => $value) {
        		$this->db->where('trd.racikan_id',$value->racikan_id);
        		$this->db->join('inv_item_master im','im.im_id = trd.racikan_medicine');
        		$this->db->join('mst_type_inv mt','mt.mtype_id = im.im_unit');
        		$data['detail_riwayat_racikan'][$value->racikan_id]	= $this->db->get('trx_racikan_detail trd');
        	}
        }

		$this->load->view('poli/resep',$data);
	}

	function simpan_resep(){
		$dt 		= $this->input->post();
		$mdc_id 	= $dt['mdc_id'];
		$bill_id = str_replace('RJ', 'BL', $mdc_id);
		$dt_resep 	= array();
		$harga_jasa = $i = $total = $tuslah = 0;
		$data_resep = $this->db->get_where('trx_recipe',array('mdc_id'=>$mdc_id));
		
		$this->db->trans_start();
		if($data_resep->num_rows() >= 1){

			$dt_res = $data_resep->result();
			$id 	= $dt_res[0]->recipe_id;

			//menghapus detail recipe
			$this->db->where('recipe_id',$id);
			$this->db->delete('trx_recipe_detail');

			//insert detail :
			$i = 0;
			foreach ($dt['resep'] as $key => $value) {
				if(! empty($dt['resep'][$i])){
					$dt_resep[] = array(
						'recipe_medicine'	=> $value,
						'recipe_rule'		=> $dt['use1'][$i].' X '.$dt['use2'][$i].' '.$dt['use3'][$i],
						'recipe_note'		=> $dt['catatan'][$i],
						'recipe_qty'		=> $dt['qty'][$i],
						'recipe_price'		=> $dt['harga'][$i],
						'recipe_batch'		=> $dt['batch'][$i],
						'recipe_id'			=> $id,
						'recipe_number'		=> $i+1
					);
					$dataBill[] = array(
                        'bill_id'       => $bill_id,
                        'service_type'  => 5,
                        'service_reference' => $mdc_id,
                        'service_name'  => $dt['item_name'][$i]." ".$dt['use1'][$i].' X '.$dt['use2'][$i].' '.$dt['use3'][$i].' qty : '.$dt['qty'][$i],
                        'price'         => $dt['harga'][$i],
                        'paramedic_price' => 0,
                        'other_price'   => 0,
                        'total_price'   => $dt['harga'][$i] * $dt['qty'][$i],
                        'payment_status'=> 0,
                    );
                    $tuslah += $dt['tuslah'][$i];
				}
				$i++;
			}
			if( count($dt_resep) >= 1 ){
				$this->db->insert_batch('trx_recipe_detail',$dt_resep);
			}

			// Save Racikan
			$data = $this->input->post();
			if(!empty($data['racikan']['racikan_name']))
	        {
	        	// Delete old racikan
                $this->db->where(array('mdc_id'=>$mdc_id));
    			$this->db->delete('trx_racikan');
    			
    			// Delete old racikan detail
    			$this->db->where('substr(racikan_id,4,8)',substr($mdc_id, 3,8));
				$this->db->delete('trx_racikan_detail');

	            foreach ($data['racikan']['racikan_name'] as $key => $value) {
	                if(!empty($value))
	                {
	                	$tuslah += $data['racikan']['racikan_tuslah_fee'][$key];
	                    $racikan_id = Modules::run('apotek/resep_pasien/gen_id_racikan',$mdc_id);
	                    $dataRacikan = array(
	                        'mdc_id' => $mdc_id,
	                        'racikan_id' => $racikan_id,
	                        'racikan_name' => $value,
	                        'racikan_sediaan' => $data['racikan']['racikan_sediaan'][$key],
	                        'racikan_tuslah_type' => $data['racikan']['racikan_tuslah_type'][$key],
	                        'racikan_rule' => $data['racikan']['racikan_use1'][$key]." X ".$data['racikan']['racikan_use2'][$key]." ".$data['racikan']['racikan_use3'][$key],
	                    );
	                    $hargaRacikan = 0;
	                    if(!empty($data['racikan_medicine']['racikan_medicine'][$key]))
	                    {
	                            $dataRacikanDetail = array();
	                            foreach ($data['racikan_medicine']['racikan_medicine'][$key] as $k => $v) {
	                                if(!empty($v))
	                                {
	                                    $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $v));
	                                    if ($inv_item_master->num_rows() <= 0) {
	                                        $dtMedicine['im_id'] = '';
	                                        $dtMedicine['im_name'] = $v;
	                                        $dtMedicine['im_unit'] = '';
	                                        $dtMedicine['im_item_price'] = '0';
	                                        $dtMedicine['im_item_price_buy'] = '0';
	                                        $dtMedicine['im_item_price_package'] = '0';
	                                        $dtMedicine['im_status'] = '1';
	                                        $this->db->insert('inv_item_master', $dtMedicine);
	                                        $v = $this->db->insert_id();
	                                    }
	                                    $dataRacikanDetail[] = array(
	                                        'racikan_id' => $racikan_id,
	                                        'racikan_medicine' => $v,
	                                        'racikan_medicine_qty' => $data['racikan_medicine']['racikan_medicine_qty'][$key][$k],
	                                        'racikan_medicine_price' => $data['racikan_medicine']['racikan_medicine_price'][$key][$k],
	                                        'racikan_medicine_batch' => $data['racikan_medicine']['racikan_medicine_batch'][$key][$k],
	                                    );
	                                    $hargaRacikan += $data['racikan_medicine']['racikan_medicine_qty'][$key][$k] * $data['racikan_medicine']['racikan_medicine_price'][$key][$k];
	                                	$tuslah += $data['racikan_medicine']['racikan_medicine_tuslah'][$key][$k];
	                                }
	                            }
	                            if(count($dataRacikanDetail) >= 1)
	                                $this->db->insert_batch('trx_racikan_detail',$dataRacikanDetail);
	                    }
	                    $this->db->insert('trx_racikan',$dataRacikan);
	                    $dataBill[] = array(
	                        'bill_id'       => $bill_id,
	                        'service_type'  => 5,
	                        'service_reference' => $racikan_id,
	                        'service_name'  => $value." ".$data['racikan']['racikan_use1'][$key]." X ".$data['racikan']['racikan_use2'][$key]." ".$data['racikan']['racikan_use3'][$key],
	                        'price'         => $hargaRacikan,
	                        'paramedic_price' => 0,
	                        'other_price'   => 0,
	                        'total_price'   => $hargaRacikan,
	                        'payment_status'=> 0,
	                    );
	                }
	            }
	            $dataTotalRacikan['racikan_total']	= $hargaRacikan;
	            $this->db->where(array('mdc_id'=>$mdc_id,'racikan_id'=>$racikan_id));
	        	$this->db->update('trx_racikan',$dataTotalRacikan);
	        }
		}else{
			$visit_id = substr($mdc_id, 3, 8);
			$dtr['mdc_id']			= $mdc_id;
			$dtr['recipe_id']		= $this->genResepID($visit_id);
			$this->db->insert('trx_recipe',$dtr);

			$id = $dtr['recipe_id'];
			$i = 0;
			foreach ($dt['resep'] as $key => $value) {
				if(! empty($dt['resep'][$i])){
					$dt_resep[] = array(
						'recipe_medicine'	=> $value,
						'recipe_rule'		=> $dt['use1'][$i].' X '.$dt['use2'][$i].' '.$dt['use3'][$i],
						'recipe_note'		=> $dt['catatan'][$i],
						'recipe_qty'		=> $dt['qty'][$i],
						'recipe_price'		=> $dt['harga'][$i],
						'recipe_batch'		=> $dt['batch'][$i],
						'recipe_id'			=> $id,
						'recipe_number'		=> $i+1
					);
					$dataBill[] = array(
                        'bill_id'       => $bill_id,
                        'service_type'  => 5,
                        'service_reference' => $mdc_id,
                        'service_name'  => $dt['item_name'][$i]." ".$dt['use1'][$i].' X '.$dt['use2'][$i].' '.$dt['use3'][$i].' qty : '.$dt['qty'][$i],
                        'price'         => $dt['harga'][$i],
                        'paramedic_price' => 0,
                        'other_price'   => 0,
                        'total_price'   => $dt['harga'][$i] * $dt['qty'][$i],
                        'payment_status'=> 0,
                    );
                    $tuslah += $dt['tuslah'][$i];
				}
				$i++;
			}
			if( count($dt_resep) >= 1 ){
				$this->db->insert_batch('trx_recipe_detail',$dt_resep);
			}

			// Save Racikan
			$data = $this->input->post();
			if(!empty($data['racikan']['racikan_name']))
	        {
	        	// Delete old racikan
                $this->db->where(array('mdc_id'=>$mdc_id));
    			$this->db->delete('trx_racikan');
    			
    			// Delete old racikan detail
    			$this->db->where('substr(racikan_id,4,8)',substr($mdc_id, 3,8));
				$this->db->delete('trx_racikan_detail');

	            foreach ($data['racikan']['racikan_name'] as $key => $value) {
	                if(!empty($value))
	                {
	                	$tuslah += $data['racikan']['racikan_tuslah_fee'][$key];
	                    $racikan_id = Modules::run('apotek/resep_pasien/gen_id_racikan',$mdc_id);
	                    // Delete old racikan
	                    $this->db->where(array('racikan_id'=>$racikan_id,'mdc_id'=>$mdc_id));
	        			$this->db->delete('trx_racikan');

	                    $dataRacikan = array(
	                        'mdc_id' => $mdc_id,
	                        'racikan_id' => $racikan_id,
	                        'racikan_name' => $value,
	                        'racikan_sediaan' => $data['racikan']['racikan_sediaan'][$key],
	                        'racikan_tuslah_type' => $data['racikan']['racikan_tuslah_type'][$key],
	                        'racikan_rule' => $data['racikan']['racikan_use1'][$key]." X ".$data['racikan']['racikan_use2'][$key]." ".$data['racikan']['racikan_use3'][$key],
	                    );
	                    $hargaRacikan = 0;
	                    if(!empty($data['racikan_medicine']['racikan_medicine'][$key]))
	                    {
	                            $dataRacikanDetail = array();
	                            foreach ($data['racikan_medicine']['racikan_medicine'][$key] as $k => $v) {
	                                if(!empty($v))
	                                {
	                                    $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $v));
	                                    if ($inv_item_master->num_rows() <= 0) {
	                                        $dtMedicine['im_id'] = '';
	                                        $dtMedicine['im_name'] = $v;
	                                        $dtMedicine['im_unit'] = '';
	                                        $dtMedicine['im_item_price'] = '0';
	                                        $dtMedicine['im_item_price_buy'] = '0';
	                                        $dtMedicine['im_item_price_package'] = '0';
	                                        $dtMedicine['im_status'] = '1';
	                                        $this->db->insert('inv_item_master', $dtMedicine);
	                                        $v = $this->db->insert_id();
	                                    }
	                                    $dataRacikanDetail[] = array(
	                                        'racikan_id' => $racikan_id,
	                                        'racikan_medicine' => $v,
	                                        'racikan_medicine_qty' => $data['racikan_medicine']['racikan_medicine_qty'][$key][$k],
	                                        'racikan_medicine_price' => $data['racikan_medicine']['racikan_medicine_price'][$key][$k],
	                                        'racikan_medicine_batch' => $data['racikan_medicine']['racikan_medicine_batch'][$key][$k],
	                                    );
	                                    $hargaRacikan += $data['racikan_medicine']['racikan_medicine_qty'][$key][$k] * $data['racikan_medicine']['racikan_medicine_price'][$key][$k];
	                                	$tuslah += $data['racikan_medicine']['racikan_medicine_tuslah'][$key][$k];
	                                }
	                            }
	                            if(count($dataRacikanDetail) >= 1)
	                                $this->db->insert_batch('trx_racikan_detail',$dataRacikanDetail);
	                    }
	                    $this->db->insert('trx_racikan',$dataRacikan);
	                    $dataBill[] = array(
	                        'bill_id'       => $bill_id,
	                        'service_type'  => 5,
	                        'service_reference' => $racikan_id,
	                        'service_name'  => $value." ".$data['racikan']['racikan_use1'][$key]." X ".$data['racikan']['racikan_use2'][$key]." ".$data['racikan']['racikan_use3'][$key],
	                        'price'         => $hargaRacikan,
	                        'paramedic_price' => 0,
	                        'other_price'   => 0,
	                        'total_price'   => $hargaRacikan,
	                        'payment_status'=> 0,
	                    );
	                }
	            }
	            $dataTotalRacikan['racikan_total']	= $hargaRacikan;
	            $this->db->where(array('mdc_id'=>$mdc_id,'racikan_id'=>$racikan_id));
	        	$this->db->update('trx_racikan',$dataTotalRacikan);
	        }
		}
		if($tuslah >= 0)
		{
			$dataBill[] = array(
		        'bill_id'       => $bill_id,
		        'service_type'  => 10,
		        'service_reference' => '',
		        'service_name'  => 'Tuslah dan Embalase',
		        'price'         => (float) $tuslah,
		        'paramedic_price' => 0,
		        'other_price'   => 0,
		        'total_price'   => (float) $tuslah,
		        'payment_status'=> 0,
		    );
		}

		if(isset($dataBill) && is_array($dataBill) && isset($bill_id))
		{
			Modules::run('apotek/resep_pasien/simpan_bill',$bill_id, $dataBill);
		}
		$this->db->trans_complete();
	}

	//membuat id resep
	function genResepID($visit_id){
		$this->db->select_max('recipe_id');
        $this->db->where('substr(mdc_id,4,8)',$visit_id);
        $no = $this->db->get('trx_recipe');
        if($no->num_rows() >= 1)
        {
        	$no = $no->row();
        	$no = substr($no->recipe_id,12,2);
        }else{
        	$no = 0;
        }
        $format = 'RS-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);
        return $format;
	}



	//keterangan
	function keterangan($mdc_id){
		$data['mdc_id'] 	= $mdc_id;
		$data['url_poli']	= $this->url_poli;
		$this->db->select_max('ref_id');
		$this->db->where('mdc_id',$mdc_id);
		$this->db->limit('1');
		$no = $this->db->get('trx_reference');
		$no = $no->row();
		$no = ($no->ref_id + 1);
		$data['ref_number']	= date('Y/M/d')."/SKet/".$mdc_id."/".$no; 
		$data['surat']		= $this->db->get_where('trx_reference',array('mdc_id'=>$mdc_id));
		$this->load->view('poli/keterangan',$data);
	}

	// surat keterangan
	function sk_pengantar(){
		$data = $this->input->post('ds');
		$data_date = $this->input->post('dt');
		$data['ref_date_start'] = $data_date['thn_start'].'-'.$data_date['bln_start'].'-'.$data_date['tgl_start'];
		$data['ref_date_end'] = $data_date['thn_end'].'-'.$data_date['bln_end'].'-'.$data_date['tgl_end'];

		$this->db->trans_start();
		if($this->db->insert('trx_reference', $data)){
			$dataAdmFee['adm_id']	= 9;
			$dataAdmFee['mdc_id']	= $data['mdc_id'];
			$this->db->insert('trx_adm_fee',$dataAdmFee);
			$this->session->set_flashdata('message',array('success','Data berhasil di buat'));
		}else{
			$this->session->set_flashdata('message',array('error','Data gagal di buat'));
		}
		$this->db->trans_complete();
	}

	function cetak_surat($ref_id){
		$this->db->select('trx_reference.*,ptn_social_data.*,mst_employer.sd_name as dr_name');
		$this->db->where('ref_id',$ref_id);
		$this->db->join('trx_medical','trx_reference.mdc_id = trx_medical.mdc_id');
		$this->db->join('ptn_social_data','ptn_social_data.sd_rekmed = trx_medical.sd_rekmed');
		$this->db->join('mst_employer','mst_employer.id_employe = trx_medical.dr_id');
		$data['surat'] 	= $this->db->get('trx_reference')->row();
		$data['title']	= 'Cetak Surat';

		$category 	= $data['surat']->ref_category;
		$view 	= "rawat_jalan/poli/surat_keterangan/".strtolower(str_replace(' ', '_', $category));
		$this->load->view($view,$data);
	}

	//ringkasan
	function ringkasan($mdc_id){
		$data['mdc_id']		= $mdc_id;
		$data['url_poli']	= $this->url_poli;
		$data['dokter']		= $this->poli_model->get_dokter($mdc_id)->row();
        
        $this->db->_protect_identifiers=false;
		$this->db->join('trx_service ts','substr(ts.service_id,4,8) = tv.visit_id');
		$this->db->join('trx_medical tm','ts.service_id = tm.mdc_id','left');
		$this->db->join('mst_poly mp','tm.pl_id = mp.pl_id','left');
		$this->db->where('ts.service_id',$mdc_id);
		$data['medical']	= $this->db->get('trx_visit tv');
		$data['ptn_now']	= $this->poli_model->get_medical_ptn_now($mdc_id);
		
		$data['diagnosa'] 	= $this->poli_model->get_diagnosa($mdc_id);
		$data['anamnesa'] 	= $this->db->get_where('trx_medical_anamnesa',array('mdc_id'=>$mdc_id));
		$data['objective'] 	= $this->db->get_where('trx_medical_objective',array('mdc_id'=>$mdc_id));
		$data['detail_diagnosa'] 	= $this->poli_model->get_detail_diagnosa($mdc_id);
		$data['obat'] 		= $this->poli_model->get_detail_resep($mdc_id);
		$data['racikan'] 		= $this->poli_model->get_racikan($mdc_id);
		$data['surat_keterangan'] 	= $this->db->get_where('trx_reference',array('mdc_id'=>$mdc_id));
		$medical_lab 		= $this->poli_model->cek_is_exist_medical_lab($mdc_id);
		if( $medical_lab->num_rows() >= 1 ){
			$medical_lab 	= $medical_lab->row();
			$lab_queue_id 	= $medical_lab->lab_queue_id;
		}else{
			$lab_queue_id = $mdc_id;
		}
		$data['penunjang'] = $this->poli_model->get_trx_penunjang_rekmed($lab_queue_id);
		$data['penunjang_detail'] = $this->poli_model->get_trx_penunjang_detail($lab_queue_id);
		$data['visite']	= $this->poli_model->get_visite_detail($mdc_id);

		$this->load->view('poli/ringkasan',$data);
	}

	function cetak_ringkasan($mdc_id)
	{
		$data['mdc_id']		= $mdc_id;
		$data['url_poli']	= $this->url_poli;
		$data['dokter']		= $this->poli_model->get_dokter($mdc_id)->row();
        
        $this->db->_protect_identifiers=false;
		$this->db->join('trx_service ts','substr(ts.service_id,4,8) = tv.visit_id');
		$this->db->where('ts.service_id',$mdc_id);
		$data['medical']	= $this->db->get('trx_visit tv');
		$data['ptn_now']	= $this->poli_model->get_medical_ptn_now($mdc_id);
		
		$data['diagnosa'] 	= $this->poli_model->get_diagnosa($mdc_id);
		$data['anamnesa'] 	= $this->db->get_where('trx_medical_anamnesa',array('mdc_id'=>$mdc_id));
		$data['objective'] 	= $this->db->get_where('trx_medical_objective',array('mdc_id'=>$mdc_id));
		$data['detail_diagnosa'] 	= $this->poli_model->get_detail_diagnosa($mdc_id);
		$data['obat'] 		= $this->poli_model->get_detail_resep($mdc_id);
		$data['racikan'] 		= $this->poli_model->get_racikan($mdc_id);
		$data['surat_keterangan'] 	= $this->db->get_where('trx_reference',array('mdc_id'=>$mdc_id));
		$sd_rekmed 			= $data['medical']->row();
		$data['patient']	= $this->db->get_where('ptn_social_data',array('sd_rekmed'=>$sd_rekmed->visit_rekmed))->row();
		$data['penunjang'] = $this->poli_model->get_trx_penunjang_rekmed($mdc_id);
		// $data['penunjang_detail'] = $this->poli_model->get_trx_penunjang_detail($lab_queue_id);
		$data['visite']	= $this->poli_model->get_visite_detail($mdc_id);
		$data['title']	= 'Cetak Ringkasan';
		$this->load->view('poli/cetak_ringkasan',$data);
	}

	//Harga
	function harga($mdc_id){
		$data['billing'] 	= $this->db->get('mst_service');
		$data['url_poli']	= $this->url_poli;
		$data['mdc_id']		= $mdc_id;
		$data['resep'] 		= $this->poli_model->get_detail_resep($mdc_id);
		$data['racikan']	= $this->poli_model->get_racikan($mdc_id);
		//hendri, 22 februari 2015
		$data['tuslah']		= $this->poli_model->get_tuslah_fee($mdc_id);
		//
		// if($data['racikan']->num_rows() >= 1)
		// {
		// 	foreach ($data['racikan']->result() as $key => $value) {
		// 		$data['racikan_detail'][$value->racikan_id][] = $this->poli_model->get_racikan_detail($value->racikan_id);
		// 	}
		// }
		$data['tindakan']	= $this->poli_model->get_detail_diagnosa($mdc_id);
		$data['dokter_fee'] = $this->poli_model->get_dokter_fee($mdc_id);
		$data['adm_fee']	= $this->poli_model->get_adm_fee($mdc_id);
		$data['visite']	= $this->poli_model->get_visite_detail($mdc_id);

		$this->load->view('poli/harga',$data);
	}

	function finish_pemeriksaan(){
		$this->db->trans_start();
		$mdc_id = $this->input->post('mdc_id');

		$dt['service_status'] = '3';
		$this->db->where('service_id',$mdc_id);
		$this->db->update('trx_service',$dt);
		
		$dt_queo['queo_status'] = '2';
		$this->db->where('queo_id',$mdc_id);
		$this->db->update('trx_queue_outpatient',$dt_queo);
		
		$this->calculate_bill($mdc_id);
		$this->db->trans_complete();
	}

	// calculate bill
	function calculate_bill($mdc_id)
	{
        // insert adm to bill
		$adm 	= $this->poli_model->get_detail_adm($mdc_id);
        if( $adm->num_rows() >= 1 )
		{
			$dt 	= array();
                        foreach ($adm->result() as $key => $value) {
				$dt[] = array(
					'bill_id'	=> str_replace('RJ', 'BL', $mdc_id),
					'service_type'	=> $value->adm_id,
					'service_name'		=> $value->adm_name,
					'price'		=> $value->adm_fee,
					'paramedic_price'	=> 0,
					'other_price'	=> 0,
					'total_price'	=> $value->adm_fee,
					'cashier_id'	=> '',
					'payment_status'=> 0,
				);
			}
			if( !empty($dt) ){
				$this->db->insert_batch('trx_bill_detail',$dt);
			}
		}

		// insert diagnosa dan treatment to bill
		$diagnosa 	= $this->poli_model->get_detail_diagnosa($mdc_id);
        if( $diagnosa->num_rows() >= 1 )
		{
			$dt 	= array();
			foreach ($diagnosa->result() as $key => $value) {
				$dt[] 	= array(
					'bill_id'	=> str_replace('RJ', 'BL', $mdc_id),
					'service_type'	=> 6,
					'service_name'		=> (isset($value->treat_name)) ? $value->treat_name : '-',
					'price'		=> (isset($value->treat_item_price)) ? ($value->treat_item_price) : 0,
					'paramedic_price'	=> 0,
					'other_price'	=> 0,
					'total_price'	=> (isset($value->treat_item_price)) ? ($value->treat_item_price) : 0,
					'payment_status'=> 0,
				);
			}
			if( !empty($dt) ){
				$this->db->insert_batch('trx_bill_detail',$dt);
			}
		}

		$visite = $this->poli_model->get_visite_detail($mdc_id);
		if($visite->num_rows() >= 1)
		{
			$dt 	= array();
			foreach ($visite->result() as $key => $value) {
				$dt[] 	= array(
					'bill_id'	=> str_replace('RJ', 'BL', $mdc_id),
					'service_type'	=> 11,
					'service_name'		=> (isset($value->treat_name)) ? $value->treat_name : '-',
					'price'		=> (isset($value->treat_item_price)) ? ($value->treat_item_price) : 0,
					'paramedic_price'	=> 0,
					'other_price'	=> 0,
					'total_price'	=> (isset($value->treat_item_price)) ? ($value->treat_item_price) : 0,
					'payment_status'=> 0,
				);
			}
			if( !empty($dt) ){
				$this->db->insert_batch('trx_bill_detail',$dt);
			}
		}

	}

	// tindakan penunjang
	function penunjang($mdc_id,$sd_rekmed){
		$lab_queue_id 		= 0;
		$data['penunjang'] 	= array();
		$data['mdc_id']		= $mdc_id;
		$data['sd_rekmed']	= $sd_rekmed;
		$data['url_poli']	= $this->url_poli;
		$medical_lab 	= $this->poli_model->cek_is_exist_medical_lab($mdc_id);
		if($medical_lab->num_rows() >= 1){
			$medical_lab 	= $medical_lab->row();
			$lab_queue_id 	= $medical_lab->lab_queue_id; 
			$data['penunjang'] = $this->poli_model->get_trx_penunjang($lab_queue_id);
			$data['penunjang_detail'] = $this->poli_model->get_trx_penunjang_detail($lab_queue_id);
			$data['visit']	= $this->db->get_where('trx_visit',array('visit_id'=>$lab_queue_id))->row();
		}
		$this->load->view('poli/penunjang',$data);
	}

	function simpan_penunjang(){
		$data = $this->input->post();
		$mdc_id 	= $data['mdc_id'];
		$sd_rekmed 	= $data['sd_rekmed'];
		if(!empty($mdc_id)){
			$medical_lab 	= $this->poli_model->cek_is_exist_medical_lab($mdc_id);
			if($medical_lab->num_rows() >= 1){
				$medical_lab 	= $medical_lab->row();
				$lab_queue_id 	= $medical_lab->lab_queue_id; 
				// delete diagnosa support old
				$this->db->where('lab_queue_id',$lab_queue_id);
				$this->db->delete('trx_lab_treathment');
				// delete diagnosa support detail
				$this->db->where('lab_queue_id',$lab_queue_id);
				$this->db->delete('trx_lab_treathment_detail');
				// delete trx visit bill
				$this->db->where('visit_id',$lab_queue_id);
				$this->db->delete('trx_visit_bill');

				// insert diagnosa support | treatment
				$paramedic_fee = $total_pay = $total_amount = 0;
				foreach ($data['penunjang'] as $key => $value) {
					if(!empty($value)){
						$dt = array(
							'lab_queue_id'	=> $lab_queue_id,
							'trx_ds_id' => $this->gen_id_penunjang(),
							'ds_id' 	=> $value,
						);
						$this->db->insert('trx_lab_treathment',$dt);

						$data_visit_detail['visit_id']	= $lab_queue_id;
						$data_visit_detail['service_id']	= '7';
						$data_visit_detail['service_name']		= $data['nama_penunjang'][$key];
						$data_visit_detail['price']		= $data['harga'][$key];
						$data_visit_detail['other_price']		= 0;
						$data_visit_detail['total_price']		= ($data['harga'][$key]);
						$data_visit_detail['cashier_id']		= get_user('emp_id');
						$data_visit_detail['payment_status']	= 0;
						$this->db->insert('trx_visit_bill',$data_visit_detail);

						// $total_amount 	+= $data['harga'][$key];
						// $total_pay 		+= $data['harga'][$key] + $data['harga_paramedis'][$key];
						// get mst_lab_treathment_detail
						$data_ds_detail = $this->poli_model->get_diagnosa_support_detail($value);
						if($data_ds_detail->num_rows() >= 1){
							foreach ($data_ds_detail->result() as $k => $v) {
								$dtd = array(
									'lab_queue_id' 	=> $lab_queue_id,
									'trx_ds_id'	=> $dt['trx_ds_id'],
									'dsupport_code'	=> $v->dsd_id,
									'dsupport_name'	=> $v->dsd_name,
									'dsupport_value'=> '',
									'dsupport_standart_value' => 'L: '.$v->dsd_standart_value_male.', P: '.$v->dsd_standart_value_female,
									'dsupport_satuan' => $v->dsd_satuan

								);
								$this->db->insert('trx_lab_treathment_detail',$dtd);
							}
						}
					}
				}
			}else{
				$generate_id 	= $this->gen_lab_queue_id();
				$lab_queue_id 	= $generate_id['lab_queue_id'];
				$lab_queue_no 	= $generate_id['lab_queue_no'];
				
				$data_medical_lab['lab_queue_id'] = $lab_queue_id;
				$data_medical_lab['mdc_id'] = $mdc_id;
				$this->db->insert('trx_medical_lab',$data_medical_lab);

				$data_visit['visit_id']	= $generate_id['lab_queue_id'];
				$data_visit['visit_type']	= 'lab';
				$data_visit['visit_rekmed']	= $sd_rekmed;
				$data_visit['visit_in']		= date('Y-m-d H:i:s');
				$data_visit['visit_status'] = '3';
				$this->db->insert('trx_visit',$data_visit);

				$data_antrian_lab['lab_queue_id'] 	= $lab_queue_id;
				$data_antrian_lab['sd_rekmed'] 		= $sd_rekmed;
				$data_antrian_lab['lab_queue_no'] 	= $lab_queue_no;
				$data_antrian_lab['lab_queue_datetime'] = date('Y-m-d H:i:s');
				$data_antrian_lab['operator_id'] 	= '';
				$this->db->insert('trx_lab_queue',$data_antrian_lab);
				
				// delete diagnosa support old
				$this->db->where('lab_queue_id',$lab_queue_id);
				$this->db->delete('trx_lab_treathment');
				// delete diagnosa support detail
				$this->db->where('lab_queue_id',$lab_queue_id);
				$this->db->delete('trx_lab_treathment_detail');
				// insert diagnosa support | treatment
				$paramedic_fee = $total_pay = $total_amount = 0;
				foreach ($data['penunjang'] as $key => $value) {
					if(!empty($value)){
						$dt = array(
							'lab_queue_id'	=> $lab_queue_id,
							'trx_ds_id' => $this->gen_id_penunjang(),
							'ds_id' 	=> $value,
						);
						$this->db->insert('trx_lab_treathment',$dt);

						$data_visit_detail['visit_id']	= $lab_queue_id;
						$data_visit_detail['service_id']	= '7';
						$data_visit_detail['service_name']		= $data['nama_penunjang'][$key];
						$data_visit_detail['price']		= $data['harga'][$key];
						$data_visit_detail['other_price']		= 0;
						$data_visit_detail['total_price']		= ($data['harga'][$key]);
						$data_visit_detail['cashier_id']		= get_user('emp_id');
						$data_visit_detail['payment_status']		= 0;
						$this->db->insert('trx_visit_bill',$data_visit_detail);

						// $total_amount 	+= $data['harga'][$key];
						// $total_pay 		+= $data['harga'][$key] + $data['harga_paramedis'][$key];
						// get mst_lab_treathment_detail
						$data_ds_detail = $this->poli_model->get_diagnosa_support_detail($value);
						if($data_ds_detail->num_rows() >= 1){
							foreach ($data_ds_detail->result() as $k => $v) {
								$dtd = array(
									'lab_queue_id' 	=> $lab_queue_id,
									'trx_ds_id'	=> $dt['trx_ds_id'],
									'dsupport_code'	=> $v->dsd_id,
									'dsupport_name'	=> $v->dsd_name,
									'dsupport_value'=> '',
									'dsupport_standart_value' => 'L: '.$v->dsd_standart_value_male.', P: '.$v->dsd_standart_value_female,
									'dsupport_satuan' => $v->dsd_satuan

								);
								// insert diagnosa support detail
								$this->db->insert('trx_lab_treathment_detail',$dtd);
							}
						}
					}
				}

			}

		}
	}

	// add ekspertise
	public function add_ekspertise()
	{
		$lab_queue_id = $this->input->post('lab_queue_id');
		$trx_ds_id = $this->input->post('trx_ds_id');
		
		$data['ds_ekspertise_status'] = 1;
		$this->db->where('lab_queue_id',$lab_queue_id);
		$this->db->where('trx_ds_id',$trx_ds_id);
		$this->db->update('trx_lab_treathment',$data);
	}

	public function proses_ekspertise()
	{
		$lab_queue_id = $this->input->post('lab_queue_id');
		$dsupport_code = $this->input->post('dsupport_code');
		
		$data['dsupport_ekspertise_status'] = 2;
		$this->db->where('lab_queue_id',$lab_queue_id);
		$this->db->where('dsupport_code',$dsupport_code);
		$this->db->update('trx_lab_treathment_detail',$data);
	}

	function get_penunjang(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('mst_lab_treathment');
		$this->db->where('ds_status','1');
		if($query!=null){
			$this->db->like('lower(ds_name)', "$query",'both');
		}
		$data = $this->db->get()->result();
		
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->ds_id",
				'name'	=> "$datas->ds_name",
				'harga' => int_to_money($datas->ds_price)
			);
		}

		echo json_encode($data);
	} 

	function json_get_penunjang($id){
		$tindakan = $this->db->get_where('mst_lab_treathment',array('ds_id'=>$id,'ds_status'=>'1'));
		$data = array();
		$total = 0;
		foreach($tindakan->result() as $d){
			$data = array(
				'id'	=> $d->ds_id,
				'name'	=> $d->ds_name,
				'harga'	=> $d->ds_price,
				'harga_paramedis' => $d->ds_paramedic_price
			);
		}
		echo json_encode($data);
	}

	//membuat id penunjang
	function gen_id_penunjang(){
		$kd = $this->db->get_where('com_code',array('title'=>'format_penunjang_diagnosa'));
		if($kd->num_rows() == 1){
			$kode = db_conv($kd);
		}else{
			$kode = new stdClass();
			$kode->value_1 = 'PD-'; // Peunjang Diagnosa
		}
		$format = $kode->value_1.DATE('ym');

		$q = $this->db->query("SELECT substr(trx_ds_id, 9, 4) as n 
			  from trx_lab_treathment where trx_ds_id like '$format%' order by n desc limit 1"); 
		
		if($q->num_rows() == 0){
			$no = '0001';
		}else{
			$nl = intval(db_conv($q)->n);
			$nl++; 
			$no = rtrim(sprintf("%'04s\n",$nl));
		}
		return $format.$no;		
	}


	// create antrian untuk lab pada kegiatan penunjang
	function gen_lab_queue_id(){
		$ym = date('ym');
		$a = $this->db->like('lab_queue_id',$ym,'after')->order_by('lab_queue_id','DESC')->get('trx_lab_queue',1,0)->row();
		$no = count($a) == 0 ? 1 : $a->lab_queue_no+1;
		$data['lab_queue_no'] = $no;

		$a = $this->db->like('visit_id',$ym,'after')->order_by('visit_id','DESC')->get('trx_visit',1,0)->row();
		$data['lab_queue_id'] = count($a) == 0 ?date('ym')."0001" : $a->visit_id+1;
		return $data;
	}

//tampil konsul visite
	function konsul($mdc_id){
		$data['dokter']		= json_encode($this->poli_model->get_all_dokter());
		$data['mdc_id'] 	= $mdc_id;
		$data['url_poli'] 	= $this->url_poli;
		$data['konsul'] 	= $this->poli_model->get_konsul($mdc_id);
		$data['visite'] 	= $this->poli_model->get_visite($mdc_id);


		$this->load->view('/poli/konsul',$data);

	}

	function get_all_dokter(){
		$data['dokter']		= json_encode($this->poli_model->get_all_dokter());
		echo  $data['dokter'];
	}

	function simpan_konsul(){
		$data = $this->input->post();
		$data['mdc_id'] = $data['mdc_id'];

		$this->db->trans_start(); 
		$this->db->where('mdc_id',$data['mdc_id']);
		$this->db->delete('trx_visite');
		
		if(!empty($data['dokter'])){
			$i = 0;
			foreach ($data['dokter'] as $key) {
				if($data['dokter'][$i] !='' && $data['visite'][$i] != '' && $data['time'][$i] !='' ){
					$konsul[] = array(
								'mdc_id' => $data['mdc_id'],
								'dr_id' => $data['dokter'][$i],
								'visite_tp' => $data['visite'][$i],
								'time' => $data['time'][$i]
								);
				}
				$i++;
			}
		}

		if( isset($konsul) >= 1 ){
			$sukses = $this->db->insert_batch('trx_visite',$konsul);
		}else{
			echo 'Terdapat kesalahan dalam penyimpanan. Mohon di cek lagi apakah form telah terisi semua.';
		}
		$this->db->trans_complete();

	}

} // end class