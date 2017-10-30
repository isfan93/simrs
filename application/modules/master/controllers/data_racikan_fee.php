<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_racikan_fee extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_racikan_fee_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_racikan_fee/index';
		$data['title']		= 'Master Data Tarif Racikan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		//$data['tipe_racikan_fee']		= $this->db->get('mst_type_inv')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_racikan_fee', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('id', $data['id']);
		$this->db->update('mst_racikan_fee', $data); 
	}
	
	function loaddata(){
		//$data['tipeaskes']		= $this->db->get('mst_type_inv')->result();
		$data['datas'] = $this->data_racikan_fee_model->get_list();
		$this->load->view('data_racikan_fee/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_racikan_fee_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_racikan_fee_model->deleteData($data);
        	
        }else{
        	$this->data_racikan_fee_model->deleteData($kode);
        	
        }
    }
}