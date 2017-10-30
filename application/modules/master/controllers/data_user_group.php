<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_user_group extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_user_group_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_user_group/index';
		$data['title']		= 'Master Data User Group';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['home_base']		= $this->db->get('sys_module')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_user_group/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('sys_group', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('group_id', $data['group_id']);
		$this->db->update('sys_group', $data); 
	}
	
	function loaddata(){
		$data['home_base']		= $this->db->get('sys_module')->result();
		$data['datas'] = $this->data_user_group_model->get_list();
		$this->load->view('data_user_group/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_user_group_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_user_group_model->deleteData($data);
        	
        }else{
        	$this->data_user_group_model->deleteData($kode);
        	
        }
    }
	
	function detail_list($key){
		$data['main_view']	= 'data_user_group/index_detail';
		//$data['title']		= 'Master Data Paket Tindakan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['konten']		= $this->data_user_group_model->getInfoPacket($key);
		$data['home_base']		= $this->db->get('sys_module')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$this->load->view('template',$data);
	}
	
	function list_treat(){
		$key=$this->input->get("term");
		//var $term;
		$query = $this->data_user_group_model->GetList($key);
        print json_encode($query);
	}
	
	function loaddata_detail($key){
		$data['datas'] = $this->data_user_group_model->getDetail($key);
		$this->load->view('data_user_group/detail',$data);
	}
	
	function create_detail(){
		$data = $this->input->post('ds');
		if($this->db->insert('sys_module_role', $data)){
			echo "berhasil";
		}
	}
	
	function delete_list_detail($kode) {
		$this->data_user_group_model->deleteDataDetail($kode);        
    }
}