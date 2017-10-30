<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_lab_treathment_detail extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_lab_treathment_detail_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_lab_treathment_detail/index';
		$data['title']		= 'Master Data Detail Tindakan Laboratorium';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['golongan']	= $this->db->get('mst_lab_treathment_gol')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_lab_treathment_detail/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_lab_treathment_detail', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('dsd_id', $data['dsd_id']);
		$this->db->update('mst_lab_treathment_detail', $data); 
	}
	
	function loaddata(){
		//$data['tipeaskes']		= $this->db->get('mst_type_inv')->result();
		$data['datas'] = $this->data_lab_treathment_detail_model->get_list();
		$data['golongan']	= $this->db->get('mst_lab_treathment_gol')->result();
		$this->load->view('data_lab_treathment_detail/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_lab_treathment_detail_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
		$data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_lab_treathment_detail_model->deleteData($data);
        }else{
        	$this->data_lab_treathment_detail_model->deleteData($kode);
        }
        
    }
}