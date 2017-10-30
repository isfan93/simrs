<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_poli extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_poli_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_poli/index';
		$data['title']		= 'Data Poli';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		//$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_poli/index';
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
		$this->db->insert('mst_poly', $data);
	
	}
	
	function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['datas'] = $this->data_poli_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_poli/data',$data);

	}
	
	function get_pop(){
		//$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('data_poli/popup',$data);
	}
	
	function get_pop_update($key){
		//$data['result']	= $this->db->query('select * from mst_shift')->result();
		$data['result']	= $this->data_poli_model->get_Detail($key);
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('data_poli/popup_update',$data);
	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_poli_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
		$data=$this->input->post('kode');
		if($kode==''){
			$this->data_poli_model->deleteData($data);	
		}else{
			//$this->input
			$this->data_poli_model->deleteData($kode);	
		}
        //$kode=$this->input->post('kode');
        
    }
	
	function update_master(){
		$data = $this->input->post('mst');
		$this->data_poli_model->updateMaster($data);
	}
}