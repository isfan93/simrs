<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_satuan_obat extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_satuan_obat_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_satuan_obat/index';
		$data['title']		= 'Data Satuan Obat';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		//$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_satuan_obat/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		//$data['religi']		= $this->db->get('mst_religion');
		//$data['regency']	= $this->db->get('mst_regency');		
		//$data['menu']		= $this->db->get_where('sys_menu',array('modul_id'=>$modul['modul_id']));
		$this->load->view('template',$data);
	}

	function create(){
		$data 				= $this->input->post('mst');
		$this->db->insert('mst_type_inv', $data);
	
	}
	
	function cetak($rm){
		$data['ds']			= db_conv($this->db->get_where('v_data_patient',array('sd_rekmed'=>$rm)));
		$data['main_view']	= 'pendaftaran_baru/cetak';
		$this->load->view('template_print',$data);
	}
 
	function proses($rm){
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['rekmed']			=  $rm;
		$data['main_view']	= 'pendaftaran_baru/proses';
		$this->load->view('template',$data);
	}
	
	function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['datas'] = $this->data_satuan_obat_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_satuan_obat/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_satuan_obat_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode == ''){
        	$this->data_satuan_obat_model->deleteData($data);
        	
        }else{
        	$this->data_satuan_obat_model->deleteData($kode);        	
        } 
    }
	
	function update_master(){
		$data = $this->input->post('mst');
		$this->data_satuan_obat_model->updateMaster($data);
	}
}