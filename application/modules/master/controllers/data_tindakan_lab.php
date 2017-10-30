<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_tindakan_lab extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_tindakan_lab_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_tindakan_lab/index';
		$data['title']		= 'Master Data Tindakan Laboratorium dan Radiologi';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['golongan']	= $this->db->get('mst_lab_treathment_gol')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_tindakan_lab/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_lab_treathment', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('ds_id', $data['ds_id']);
		$this->db->update('mst_lab_treathment', $data); 
	}
	
	function loaddata(){
		$data['golongan']	= $this->db->get('mst_lab_treathment_gol')->result();
		$data['datas'] = $this->data_tindakan_lab_model->get_list();
		$this->load->view('data_tindakan_lab/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_tindakan_lab_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_tindakan_lab_model->deleteData($data);
        	
        }else{
        	$this->data_tindakan_lab_model->deleteData($kode);
        	
        }
    }
	
	function detail_list($key){
		$data['main_view']	= 'data_tindakan_lab/index_detail';
		//$data['title']		= 'Master Data Paket Tindakan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['konten']		= $this->data_tindakan_lab_model->getInfoPacket($key);
		//$data['tindakan']	= $this->db->get('mst_lab_treathment_detail')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$this->load->view('template',$data);
	}
	
	function list_treat(){
		$key=$this->input->get("term");
		//var $term;
		$query = $this->data_tindakan_lab_model->GetList($key);
        print json_encode($query);
	}

	public function get_tindakan_lab(){
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->data_tindakan_lab_model->GetList($q);
		echo json_encode($data);
	}
	
	function loaddata_detail($key){
		$data['datas'] = $this->data_tindakan_lab_model->getDetail($key);
		$this->load->view('data_tindakan_lab/detail',$data);
	}
	
	function create_detail(){
		$data = $this->input->post('ds');
		if($this->db->insert('map_mst_lab', $data)){
			echo "berhasil";
		}
	}
	
	function delete_list_detail($kode) {
		$this->data_tindakan_lab_model->deleteDataDetail($kode);        
    }
}