<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_rute_obat extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_rute_obat_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_rute_obat/index';
		$data['title']		= 'Data rute Obat';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		//$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('template',$data);
	}	

	function create(){
		$data 				= $this->input->post('mst');
		$this->db->insert('mst_rute_inv', $data);
	
	}
	
	function loaddata(){
		$data['datas'] = $this->data_rute_obat_model->get_list();
		$this->load->view('data_rute_obat/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_rute_obat_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode == ''){
        	$this->data_rute_obat_model->deleteData($data);
        	
        }else{
        	$this->data_rute_obat_model->deleteData($kode);        	
        } 
    }
	
	function update_master(){
		$data = $this->input->post('mst');
		$this->data_rute_obat_model->updateMaster($data);
	}
}