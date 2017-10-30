<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_supplier extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_supplier_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_supplier/index';
		$data['title']		= 'Master Data supplier';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['provinsi']		= $this->db->get('mst_province')->result();
		$data['kabupaten']		= $this->db->get('mst_regency')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_supplier/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_supplier', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('msup_id', $data['msup_id']);
		$this->db->update('mst_supplier', $data); 
	}
	
	function loaddata(){
		$data['prop']		= $this->db->get('mst_province')->result();
		$data['kab']		= $this->db->get('mst_regency')->result();
		$data['datas'] = $this->data_supplier_model->get_list();
		$this->load->view('data_supplier/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_supplier_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_supplier_model->deleteData($data);
        	
        }else{
        	$this->data_supplier_model->deleteData($kode);
        	
        }
    }
}