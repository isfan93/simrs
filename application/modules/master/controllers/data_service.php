<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_service extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_service_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_service/index';
		$data['title']		= 'Master Data Pelayanan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		//$data['tipe_service']		= $this->db->get('mst_type_inv')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_service/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_service', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('service_id', $data['service_id']);
		$this->db->update('mst_service', $data); 
	}
	
	function loaddata(){
		//$data['tipeaskes']		= $this->db->get('mst_type_inv')->result();
		$data['datas'] = $this->data_service_model->get_list();
		$this->load->view('data_service/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_service_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode) {
        //$data=$this->input->post('kode');
        $this->data_service_model->deleteData($kode);
        
    }
}