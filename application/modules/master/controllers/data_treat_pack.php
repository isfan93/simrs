<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_treat_pack extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_treat_pack_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_treat_pack/index';
		$data['title']		= 'Master Data Paket Tindakan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		//$data['provinsi']		= $this->db->get('mst_province')->result();
		//$data['kabupaten']		= $this->db->get('mst_city')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_treat_pack/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data = $this->input->post('ds');
		if($this->db->insert('mst_treat_pack', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('pt_id', $data['pt_id']);
		$this->db->update('mst_treat_pack', $data); 
	}
	
	function loaddata(){
		//$data['tipeaskes']		= $this->db->get('mst_type_inv')->result();
		$data['datas'] = $this->data_treat_pack_model->get_list();
		$this->load->view('data_treat_pack/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_treat_pack_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_treat_pack_model->deleteData($data);
        	
        }else{
        	$this->data_treat_pack_model->deleteData($kode);
        	
        }
    }
	
	function detail_list($key){
		$data['main_view']	= 'data_treat_pack/index_detail';
		//$data['title']		= 'Master Data Paket Tindakan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['konten']		= $this->data_treat_pack_model->getInfoPacket($key);
		$data['tindakan']	= $this->db->get('mst_treathment')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$this->load->view('template',$data);
	}
	
	function loaddata_detail($key){
		//$data['tipeaskes']		= $this->db->get('mst_type_inv')->result();
		$data['datas'] = $this->data_treat_pack_model->getDetail($key);
		//$data['price_total']=$data['datas']->result()
		$this->load->view('data_treat_pack/detail',$data);
	}
	
	function list_treat(){
		$key=$this->input->get("term");
		//var $term;
		$query = $this->data_treat_pack_model->GetList($key);
        print json_encode($query);
	}
	
	function create_detail(){
		$data = $this->input->post('ds');
		if($this->db->insert('map_mst_treat_pack', $data)){
			echo "berhasil";
		}
	}
	
	function delete_list_detail($kode) {
		$this->data_treat_pack_model->deleteDataDetail($kode);        
    }
}