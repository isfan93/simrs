<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_pavillion extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_pavillion_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_pavillion/index';
		$data['title']		= 'Master Data Pavillion';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		//$data['tipe_pavillion']		= $this->db->get('mst_type_inv')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	

	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_pavillion', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('pavillion_id', $data['pavillion_id']);
		$this->db->update('mst_pavillion', $data); 
	}
	
	function loaddata(){
		//$data['tipeaskes']		= $this->db->get('mst_type_inv')->result();
		$data['datas'] = $this->data_pavillion_model->get_list();
		$this->load->view('data_pavillion/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_pavillion_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_pavillion_model->deleteData($data);
        	
        }else{
        	$this->data_pavillion_model->deleteData($kode);
        	
        }
    }

    function aktifkan($kode){
		//$temp = $/
		$data = array('pav_status'=>1);
		$this->db->where_in('pavillion_id',$kode);		
		$this->db->update('mst_pavillion',$data);
	}
}