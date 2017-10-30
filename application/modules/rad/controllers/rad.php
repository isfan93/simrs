<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rad extends MY_Controller {
	function __construct() {
		parent::__construct();
		// model 
		$this->load->model('rad_model');
		$this->load->model('rawat_jalan/poli_model');
		// keterangan kode
		// queue status 1 => baru antri, 2 antri dan sudah dibayar , 3 sudah dilakukan tindakan | selesai
		$this->active 		= 1;
		$this->activeAndPay	= 2;
		$this->waitForPay	= 3;
		$this->payed		= 4;
		$this->closed		= 5;
		$this->cancel		= 7;
	}

	// antrian
	function index(){
		$data['main_view']	= 'rad/index';
		$data['title']		= 'Radiologi';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	function antrian()
	{
		$data['main_view']	= 'rad/antrian';
		$data['title']		= 'Instalasi Radiologi';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$data['antrian']	= $this->rad_model->get_antrian(array($this->activeAndPay,$this->active,$this->waitForPay,$this->payed));
		$this->load->view('template',$data);
	}

	function data_diri($sd_rekmed = '', $mdc_id = '')
	{
		$data 	= array();
		if( ($sd_rekmed != '') && ($sd_rekmed != 0) )
		{

        	$this->db->_protect_identifiers=false;
			$this->db->join('trx_visit tv','tv.visit_id = substr(trx_lab_queue.lab_queue_id,4,8)');
			$this->db->join('ptn_social_data psd','psd.sd_rekmed = tv.visit_rekmed','left');
			$this->db->where(array('substr(trx_lab_queue.lab_queue_id,1,2)'=>'RD','tv.visit_rekmed'=>$sd_rekmed));
			$this->db->where_in('lab_queue_status',array('1','2','3','4'));
			$data_pasien		= $this->db->get('trx_lab_queue');
			if($data_pasien->num_rows() >= 1){
				$data['pasien'] = db_conv($this->db->get_where('ptn_social_data',array('sd_rekmed'=>$sd_rekmed)));
				$data_pasien	= $data_pasien->row();
				$data['pasien']->lab_queue_id 	= $data_pasien->lab_queue_id;
			}
		}else if( $sd_rekmed == 0)
		{
			$this->db->_protect_identifiers=false;
			$this->db->join('trx_visit tv','tv.visit_id = substr(trx_lab_queue.lab_queue_id,4,8)');
			$this->db->where(array('substr(trx_lab_queue.lab_queue_id,1,2)'=>'RD', 'trx_lab_queue.lab_queue_id'=> $mdc_id));
			$this->db->where_in('lab_queue_status',array('1','2','3','4'));
			$data_pasien		= $this->db->get('trx_lab_queue');
			if($data_pasien->num_rows() >= 1){
				$data['pasien'] = $data_pasien->row();
				// $data['pasien'] = db_conv($this->db->get_where('ptn_social_data',array('sd_rekmed'=>$sd_rekmed)));
				// $data_pasien	= $data_pasien->row();
				// $data['pasien']->lab_queue_id 	= $data_pasien->lab_queue_id;
				// $data['pasien'] = 
			}
		}
		$this->load->view('data_diri',$data);
	}

	function proses(){
		$data['prev'] 	= $this->input->post('ds');
		$data['main_view']	= 'rad/proses';
		$data['title']		= 'Pemeriksaan Radiologi';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	function load_form($lab_queue_id){
		$this->db->join('trx_lab_queue','tv.visit_id = substr(trx_lab_queue.lab_queue_id,4,8)','left');
		$this->db->join('trx_service ts','ts.service_id = trx_lab_queue.lab_queue_id');
		$this->db->where(array('trx_lab_queue.lab_queue_id'=>$lab_queue_id));
		$data['visit'] 	= $this->db->get('trx_visit tv')->row();
		// get penunjang & detail penunjang
		$data['prev']['lab_queue_id'] = $lab_queue_id;
		$data['penunjang']	= $this->poli_model->get_trx_penunjang($lab_queue_id);
		$data['penunjang_detail'] = $this->poli_model->get_trx_penunjang_detail($lab_queue_id);

		$this->db->select('me.id_employe,me.sd_name as dr_name');
		$this->db->where_in('me.sd_type_user',array('17')); // 17 18 patologi klinis
		$data['dokter']		= $this->db->get('mst_employer me');

		$this->db->select('me.id_employe,me.sd_name as sd_name');
		$this->db->where_in('me.sd_type_user',array('26')); // 26 radi 28 lab
		$data['operator']	= $this->db->get('mst_employer me');

		$this->load->view('rad/hasil',$data);
	}

	// function gen_id_penunjang(){
	function genIdPenunjangDiagnosa($lab_queue_id){
		$format = str_replace('RD', 'PD', $lab_queue_id);
		$q = $this->db->query("SELECT substr(trx_ds_id, 16, 2) as n 
			  from trx_lab_treathment where trx_ds_id like '$format%' order by n desc limit 1"); 
		
		if($q->num_rows() == 0){
			$no = '01';
		}else{
			$nl = intval(db_conv($q)->n);
			$nl++; 
			$no = rtrim(sprintf("%'02s\n",$nl));
		}
		return $format.'-'.$no;		
	}

	function kirim_kasir(){
		$lab_queue_id = $this->input->post('lab_queue_id');
		$dr_id = $this->input->post('dr_id');
		$operator_id = $this->input->post('operator_id');
		$data = $this->input->post();

		// $this->db->trans_start();
		$data_queue['dr_id'] = $dr_id;
		$data_queue['operator_id'] = $operator_id;
		$data_queue['lab_queue_status']	= 3;
		$this->db->where('lab_queue_id',$lab_queue_id);
		$this->db->update('trx_lab_queue',$data_queue);

		$data_service['service_status']	= 3;
		$this->db->where('service_id',$lab_queue_id);
		$this->db->update('trx_service',$data_service);
		
		$data_visit['visit_status']	= 2;
		$this->db->where('visit_id',substr($lab_queue_id,3,8) );
		$this->db->update('trx_visit',$data_visit);

		foreach ($data['penunjang'] as $key => $value) {
			if(!empty($value)){
				$dt = array(
					'lab_queue_id'	=> $lab_queue_id,
					'trx_ds_id' => $this->genIdPenunjangDiagnosa($lab_queue_id),
					'ds_id' 	=> $value,
				);
				$exist = $this->rad_model->checkExist('trx_lab_treathment',array('lab_queue_id'=>$lab_queue_id,'ds_id'=>$value));
				if($exist->num_rows == 0){
					$this->db->insert('trx_lab_treathment',$dt);
					$data_visit_detail['bill_id']	= str_replace('RD', 'BL', $lab_queue_id);
					$data_visit_detail['service_type']	= '7';
					$data_visit_detail['service_name']		= $data['nama_penunjang'][$key];
					$data_visit_detail['price']		= $data['harga'][$key];
					$data_visit_detail['other_price']		= 0;
					$data_visit_detail['total_price']		= ($data['harga'][$key]);
					$data_visit_detail['cashier_id']		= '';
					$data_visit_detail['payment_status']		= 0;
					$this->db->insert('trx_bill_detail',$data_visit_detail);

					// get mst_lab_treathment_detail
					$data_ds_detail = $this->rad_model->get_diagnosa_support_detail($value);
					if($data_ds_detail->num_rows() >= 1){
						$dtd = array();
						foreach ($data_ds_detail->result() as $k => $v) {
							$dtd[] = array(
								'lab_queue_id' 	=> $lab_queue_id,
								'trx_ds_id'	=> $dt['trx_ds_id'],
								'dsupport_code'	=> $v->dsd_id,
								'dsupport_name'	=> $v->dsd_name,
								'dsupport_value'=> '',
								'dsupport_standart_value' => 'L: '.$v->dsd_standart_value_male.', P: '.$v->dsd_standart_value_female,
								'dsupport_satuan' => $v->dsd_satuan

							);
							// $dtimage[]=array(
							// 	'lab_queue_id' 	=> $lab_queue_id,
							// 	'trx_ds_id'	=> $dt['trx_ds_id'],$this->genIdPenunjangDiagnosa($lab_queue_id)
							// 	'dsupport_code'	=> $v->dsd_id
							// );
						}
						// insert diagnosa support detail
						$this->db->insert_batch('trx_lab_treathment_detail',$dtd);
						//$this->db->insert_batch('trx_lab_treathment_image',$dtimage);
					}
				}
			}
		}
		// $this->db->trans_complete();
	}

	function delete_list()
	{
		$lab_queue_id = $this->input->post('lab_queue_id');
		$trx_ds_id = $this->input->post('trx_ds_id');
		$ds_id = $this->input->post('ds_id');
		$ds_name = $this->input->post('ds_name');

		if($lab_queue_id != null && $trx_ds_id != null && $ds_id != null && $ds_name != null)
		{
			$this->db->trans_start();
			
			$this->db->where(array('lab_queue_id'=>$lab_queue_id,'trx_ds_id'=>$trx_ds_id,'ds_id'=>$ds_id));
			$this->db->delete('trx_lab_treathment');

			$this->db->where(array('lab_queue_id'=>$lab_queue_id,'trx_ds_id'=>$trx_ds_id));
			$this->db->delete('trx_lab_treathment_detail');

			$this->db->where(array('bill_id'=>str_replace('RD', 'BL', $lab_queue_id),'service_type'=>'7','service_name'=>$ds_name,'payment_status'=>'0'));
			$this->db->delete('trx_bill_detail');
			$this->db->trans_complete();
		}
	}

	function finish_pemeriksaan(){
		$data 	= $this->input->post('hasil');
		$lab_queue_id 	= $this->input->post('lab_queue_id');
		$dr_id 	= $this->input->post('dr_id');
		$operator_id	= $this->input->post('operator_id');
		$dr_sender	= $this->input->post('dr_sender');

		$this->db->trans_start();
		$data_queue['dr_id'] = $dr_id;
		$data_queue['dr_sender'] = $dr_sender;
		$data_queue['operator_id'] = $operator_id;
		$data_queue['lab_queue_status']	= 5;
		$this->db->where('lab_queue_id',$lab_queue_id);
		$this->db->update('trx_lab_queue',$data_queue);

		foreach ($data as $key => $value) {
			$dt['dsupport_value'] = $value;
			if( !empty($_FILES['image']['name'][$key]) ){
				$trx_ds_id=$this->genIdPenunjangDiagnosa($lab_queue_id);				
				// debug_array($_FILES['image']['name'][$key],true);
				//print_r($_FILES['image']['name'][$key]);die();
				for($i=0;$i<sizeof($_FILES['image']['name'][$key]);$i++){
					if( !empty($_FILES['image']['name'][$key][$i]) ){
						$name = $_FILES['image']['name'][$key][$i];
						$name = $lab_queue_id."_".str_replace(' ', '', $name);
						copy($_FILES['image']['tmp_name'][$key][$i],getcwd().'/uploads/rad/'.$name);
						$link = base_url()."uploads/rad/".$name;
						//$dtimage['dsupport_value_image'] = $link;
						$dtimage=array(
						 	'lab_queue_id' 	=> $lab_queue_id,
						 	'trx_ds_id'	=> $trx_ds_id,
						 	'dsupport_code'	=> $key,
						 	'dsupport_value_image' =>$link
						);
						$this->db->insert('trx_lab_treathment_image',$dtimage);
					}					
				}
				// $name = $_FILES['image']['name'][$key];
				// $name = $lab_queue_id."_".str_replace(' ', '', $name);
				// copy($_FILES["image"]['tmp_name'][$key],getcwd().'/uploads/rad/'.$name);
				// $link = base_url()."uploads/rad/".$name;
				// $dt['dsupport_value_image'] = $link;
			}
			$this->db->where(array('lab_queue_id'=>$lab_queue_id,'dsupport_code'=>$key));
			$this->db->update('trx_lab_treathment_detail',$dt);
			//$this->db->insert_batch('trx_lab_treathment_image',$dtimage);
			//===
			//foreach($i=0;$i<sizeof($_FILES['image']['name'][$key];$i++)){

			//}
			//===
			//unset($dt['dsupport_value_image']);
			unset($dt['dsupport_value']);
		}

		$data_trx_service['service_status'] = 5;
		$data_trx_service['service_out']	= date('Y-m-d H:i:s');
		$this->db->where('service_id',$lab_queue_id);
		$this->db->update('trx_service',$data_trx_service);
		$this->db->trans_complete();

	}

	function cetak_hasil_pemeriksaan($lab_queue_id)
	{
		$data['title']	= 'Hasil Pemeriksaan Radiologi';

		$this->db->select('*');
		$this->db->join('ptn_social_data psd','tv.visit_rekmed = psd.sd_rekmed','left');
		$this->db->join('trx_service ts','tv.visit_id = substr(ts.service_id, 4,8)');
		$this->db->where('ts.service_id',$lab_queue_id);
		$data['patient']	= $this->db->get('trx_visit tv')->row();

		$data['penunjang']	= $this->rad_model->get_trx_penunjang($lab_queue_id);
		$data['penunjang_detail'] = $this->rad_model->get_trx_penunjang_detail($lab_queue_id);
		
		$this->db->select('me.*,tlq.*');
		$this->db->join('mst_employer me','me.id_employe = tlq.dr_id');
		$this->db->where('tlq.lab_queue_id',$lab_queue_id);
		$data['dr_penanggung_jawab']	= $this->db->get('trx_lab_queue tlq');

		$this->db->select('me.*');
		$this->db->join('mst_employer me','me.id_employe = tlq.operator_id');
		$this->db->where('tlq.lab_queue_id',$lab_queue_id);
		$data['op_penanggung_jawab']	= $this->db->get('trx_lab_queue tlq');
		
		$this->load->view('rad/cetak_hasil',$data);
	}

	public function pemeriksaan()
	{
		$data['main_view']	= 'rad/pemeriksaan';
		$data['title']		= 'Data Pemeriksaan Radiologi';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';

        $this->db->_protect_identifiers=false;
		$this->db->select('*');
		$this->db->join('trx_service ts','tv.visit_id = substr(ts.service_id,4,8)');
		$this->db->join('ptn_social_data psd','tv.visit_rekmed = psd.sd_rekmed','left');
		$this->db->where(array('ts.service_status'=>'5','substr(ts.service_id,1,2)'=>'RD'));
		$data['pemeriksaan']	= $this->db->get('trx_visit tv');

		$this->load->view('template',$data);
	}

	// public function daftar()
	// {
	// 	$data['main_view']	= 'lab/daftar';
	// 	$data['title']		= 'Pendaftaran Pemeriksaan Radiologi';
	// 	$data['cf']			=  $this->cf;
	// 	$data['current']	= '';
	// 	$data['desc']		= 'Description. ';

	// 	$this->load->view('template',$data);
	// }

	// public function daftar_lab()
	// {
	// 	$data = $this->input->post();
	// 	$sd_rekmed 	= $data['sd_rekmed'];
	// 	if( isset($sd_rekmed) )
	// 	{
	// 		$generate_id 	= $this->gen_lab_queue_id();
	// 		$lab_queue_id 	= $generate_id['lab_queue_id'];
	// 		$lab_queue_no 	= $generate_id['lab_queue_no'];

	// 		$data_visit['visit_id']	= $generate_id['lab_queue_id'];
	// 		$data_visit['visit_type']	= 'lab';
	// 		$data_visit['visit_rekmed']	= $sd_rekmed;
	// 		$data_visit['visit_in']		= date('Y-m-d H:i:s');
	// 		$data_visit['visit_status'] = '3';
	// 		$this->db->insert('trx_visit',$data_visit);

	// 		$data_antrian_lab['lab_queue_id'] 	= $lab_queue_id;
	// 		$data_antrian_lab['sd_rekmed'] 		= $sd_rekmed;
	// 		$data_antrian_lab['lab_queue_no'] 	= $lab_queue_no;
	// 		$data_antrian_lab['lab_queue_datetime'] = date('Y-m-d H:i:s');
	// 		$data_antrian_lab['operator_id'] 	= '';
	// 		$this->db->insert('trx_lab_queue',$data_antrian_lab);

	// 	}
 //        $success = !$lab_queue_id ? 'failed' : 'success';
 //        echo json_encode(array('success' => $success, 'visit_id' => $lab_queue_id));
	// }

	// function daftar_rad()
	// {
	// 	$data = $this->input->post();
	// 	$sd_rekmed 	= $data['sd_rekmed'];
	// 	if( isset($sd_rekmed) )
	// 	{
	// 		$generate_id 	= $this->gen_lab_queue_id();
	// 		$lab_queue_id 	= $generate_id['lab_queue_id'];
	// 		$lab_queue_no 	= $generate_id['lab_queue_no'];
			
	// 		// $data_medical_lab['lab_queue_id'] = $lab_queue_id;
	// 		// $data_medical_lab['mdc_id'] = $mdc_id;
	// 		// $this->db->insert('trx_medical_lab',$data_medical_lab);

	// 		$data_visit['visit_id']	= $generate_id['lab_queue_id'];
	// 		$data_visit['visit_type']	= 'rad';
	// 		$data_visit['visit_rekmed']	= $sd_rekmed;
	// 		$data_visit['visit_in']		= date('Y-m-d H:i:s');
	// 		$data_visit['visit_status'] = '3';
	// 		$this->db->insert('trx_visit',$data_visit);

	// 		$data_antrian_lab['lab_queue_id'] 	= $lab_queue_id;
	// 		$data_antrian_lab['sd_rekmed'] 		= $sd_rekmed;
	// 		$data_antrian_lab['lab_queue_no'] 	= $lab_queue_no;
	// 		$data_antrian_lab['lab_queue_datetime'] = date('Y-m-d H:i:s');
	// 		$data_antrian_lab['operator_id'] 	= '';
	// 		$this->db->insert('trx_lab_queue',$data_antrian_lab);

	// 		// foreach ($data['penunjang'] as $key => $value) {
	// 		// 	if(!empty($value)){
	// 		// 		$dt = array(
	// 		// 			'lab_queue_id'	=> $lab_queue_id,
	// 		// 			'trx_ds_id' => $this->gen_id_penunjang(),
	// 		// 			'ds_id' 	=> $value,
	// 		// 		);
	// 		// 		$this->db->insert('trx_lab_treathment',$dt);

	// 		// 		$data_visit_detail['visit_id']	= $lab_queue_id;
	// 		// 		$data_visit_detail['service_id']	= '7';
	// 		// 		$data_visit_detail['service_name']		= $data['nama_penunjang'][$key];
	// 		// 		$data_visit_detail['price']		= $data['harga'][$key];
	// 		// 		$data_visit_detail['other_price']		= 0;
	// 		// 		$data_visit_detail['total_price']		= ($data['harga'][$key]);
	// 		// 		$data_visit_detail['cashier_id']		= get_user('emp_id');
	// 		// 		$data_visit_detail['payment_status']		= 0;
	// 		// 		$this->db->insert('trx_visit_bill',$data_visit_detail);

	// 		// 		// get mst_lab_treathment_detail
	// 		// 		$data_ds_detail = $this->rad_model->get_diagnosa_support_detail($value);
	// 		// 		if($data_ds_detail->num_rows() >= 1){
	// 		// 			foreach ($data_ds_detail->result() as $k => $v) {
	// 		// 				$dtd = array(
	// 		// 					'lab_queue_id' 	=> $lab_queue_id,
	// 		// 					'trx_ds_id'	=> $dt['trx_ds_id'],
	// 		// 					'dsupport_code'	=> $v->dsd_id,
	// 		// 					'dsupport_name'	=> $v->dsd_name,
	// 		// 					'dsupport_value'=> '',
	// 		// 					'dsupport_standart_value' => 'L: '.$v->dsd_standart_value_male.', P: '.$v->dsd_standart_value_female,
	// 		// 					'dsupport_satuan' => $v->dsd_satuan

	// 		// 				);
	// 		// 				// insert diagnosa support detail
	// 		// 				$this->db->insert('trx_lab_treathment_detail',$dtd);
	// 		// 			}
	// 		// 		}
	// 		// 	}
	// 		// }

	// 	}
 //        $success = !$lab_queue_id ? 'failed' : 'success';
 //        echo json_encode(array('success' => $success, 'visit_id' => $lab_queue_id));
	// }

	// public function simpan_daftar()
	// {
	// 	$data = $this->input->post();
	// 	$sd_rekmed 	= $data['sd_rekmed'];
	// 	if( isset($sd_rekmed) )
	// 	{
	// 		$generate_id 	= $this->gen_lab_queue_id();
	// 		$lab_queue_id 	= $generate_id['lab_queue_id'];
	// 		$lab_queue_no 	= $generate_id['lab_queue_no'];
			
	// 		// $data_medical_lab['lab_queue_id'] = $lab_queue_id;
	// 		// $data_medical_lab['mdc_id'] = $mdc_id;
	// 		// $this->db->insert('trx_medical_lab',$data_medical_lab);

	// 		$data_visit['visit_id']	= $generate_id['lab_queue_id'];
	// 		$data_visit['visit_type']	= 'lab';
	// 		$data_visit['visit_rekmed']	= $sd_rekmed;
	// 		$data_visit['visit_in']		= date('Y-m-d H:i:s');
	// 		$data_visit['visit_status'] = '3';
	// 		$this->db->insert('trx_visit',$data_visit);

	// 		$data_antrian_lab['lab_queue_id'] 	= $lab_queue_id;
	// 		$data_antrian_lab['sd_rekmed'] 		= $sd_rekmed;
	// 		$data_antrian_lab['lab_queue_no'] 	= $lab_queue_no;
	// 		$data_antrian_lab['lab_queue_datetime'] = date('Y-m-d H:i:s');
	// 		$data_antrian_lab['operator_id'] 	= '';
	// 		$this->db->insert('trx_lab_queue',$data_antrian_lab);

	// 		foreach ($data['penunjang'] as $key => $value) {
	// 			if(!empty($value)){
	// 				$dt = array(
	// 					'lab_queue_id'	=> $lab_queue_id,
	// 					'trx_ds_id' => $this->gen_id_penunjang(),
	// 					'ds_id' 	=> $value,
	// 				);
	// 				$this->db->insert('trx_lab_treathment',$dt);

	// 				$data_visit_detail['visit_id']	= $lab_queue_id;
	// 				$data_visit_detail['service_id']	= '7';
	// 				$data_visit_detail['service_name']		= $data['nama_penunjang'][$key];
	// 				$data_visit_detail['price']		= $data['harga'][$key];
	// 				$data_visit_detail['other_price']		= 0;
	// 				$data_visit_detail['total_price']		= ($data['harga'][$key]);
	// 				$data_visit_detail['cashier_id']		= get_user('emp_id');
	// 				$data_visit_detail['payment_status']		= 0;
	// 				$this->db->insert('trx_visit_bill',$data_visit_detail);

	// 				// get mst_lab_treathment_detail
	// 				$data_ds_detail = $this->rad_model->get_diagnosa_support_detail($value);
	// 				if($data_ds_detail->num_rows() >= 1){
	// 					foreach ($data_ds_detail->result() as $k => $v) {
	// 						$dtd = array(
	// 							'lab_queue_id' 	=> $lab_queue_id,
	// 							'trx_ds_id'	=> $dt['trx_ds_id'],
	// 							'dsupport_code'	=> $v->dsd_id,
	// 							'dsupport_name'	=> $v->dsd_name,
	// 							'dsupport_value'=> '',
	// 							'dsupport_standart_value' => 'L: '.$v->dsd_standart_value_male.', P: '.$v->dsd_standart_value_female,
	// 							'dsupport_satuan' => $v->dsd_satuan

	// 						);
	// 						// insert diagnosa support detail
	// 						$this->db->insert('trx_lab_treathment_detail',$dtd);
	// 					}
	// 				}
	// 			}
	// 		}

	// 	}
	// }

	function get_penunjang(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('mst_lab_treathment');
		$this->db->where('ds_status','1');
		if($query!=null){
			$this->db->like('lower(ds_name)', "$query",'both');
		}
		$this->db->limit(10);
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

	function get_tindakan_lab(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('mst_lab_treathment');
		$this->db->where(array('ds_status'=>'1','ds_type'=>'LAB'));
		if($query!=null){
			$this->db->like('lower(ds_name)', "$query",'both');
		}
		$this->db->limit(10);
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

	function get_tindakan_rad(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('mst_lab_treathment');
		$this->db->where(array('ds_status'=>'1','ds_type'=>'RAD'));
		if($query!=null){
			$this->db->like('lower(ds_name)', "$query",'both');
		}
		$this->db->limit(10);
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

	function get_tindakan(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('mst_lab_treathment');
		$this->db->where(array('ds_status'=>'1'));
		if($query!=null){
			$this->db->like('lower(ds_name)', "$query",'both');
		}
		$this->db->limit(10);
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

	public function getPatientData()
	{
		$noKartu 	=  $this->input->post('noKartu');
		$pasien 	= $this->db->get_where('ptn_social_data',array('sd_rekmed'=>$noKartu));
		if ( $pasien->num_rows() == 1)
		{
			$pasien 	= $pasien->row();
			$data['sd_name']	= $pasien->sd_name;
			$data['sd_rekmed']	= $pasien->sd_rekmed;
			$data['success']	= 1;
		}else
		{
			$data['sd_name']	= '';
			$data['sd_rekmed']	= '';
			$data['success']	= 0;
		}
		echo json_encode($data);
	}

	function gen_lab_queue_id(){
		$ym = date('ym');
		$a = $this->db->like('lab_queue_id',$ym,'after')->order_by('lab_queue_id','DESC')->get('trx_lab_queue',1,0)->row();
		$no = count($a) == 0 ? 1 : $a->lab_queue_no+1;
		$data['lab_queue_no'] = $no;

		$a = $this->db->like('visit_id',$ym,'after')->order_by('visit_id','DESC')->get('trx_visit',1,0)->row();
		$data['lab_queue_id'] = count($a) == 0 ?date('ym')."0001" : $a->visit_id+1;
		return $data;
	}

}	// end class
