<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_type_user extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_type_user_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_type_user/index';
		$data['title']		= 'Master Data Tipe User';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		//$data['tipe_type_user']		= $this->db->get('mst_type_inv')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_type_user/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_type_user', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('id_type_user', $data['id_type_user']);
		$this->db->update('mst_type_user', $data); 
	}
	
	function loaddata(){
		//$data['tipetype_user']		= $this->db->get('mst_type_inv')->result();
		$data['datas'] = $this->data_type_user_model->get_list();
		$this->load->view('data_type_user/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_type_user_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_type_user_model->deleteData($data);
        	
        }else{
        	$this->data_type_user_model->deleteData($kode);
        	
        }
    }	
}