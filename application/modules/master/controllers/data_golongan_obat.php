<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_golongan_obat extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_golongan_obat_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_golongan_obat/index';
		$data['title']		= 'Data golongan Obat';
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
		$this->db->insert('mst_golongan_inv', $data);
	
	}
	
	
	function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['datas'] = $this->data_golongan_obat_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_golongan_obat/data',$data);

	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode == ''){
        	$this->data_golongan_obat_model->deleteData($data);
        	
        }else{
        	$this->data_golongan_obat_model->deleteData($kode);        	
        } 
    }
	
	function update_master(){
		$data = $this->input->post('mst');
		$this->data_golongan_obat_model->updateMaster($data);
	}
}