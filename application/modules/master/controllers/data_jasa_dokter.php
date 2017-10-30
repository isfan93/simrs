<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_jasa_dokter extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_jasa_dokter_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_jasa_dokter/index';
		$data['title']		= 'Master Data Harga Jasa Pemeriksaan Dokter';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			= $cf;
		$data['desc']		= 'Description. ';
		$this->db->or_where('sd_type_user','1');
		$this->db->or_where('sd_type_user','6');
		$this->db->or_where('sd_type_user','7');
		$this->db->or_where('sd_type_user','8');
		$this->db->or_where('sd_type_user','9');
		$this->db->or_where('sd_type_user','10');
		$this->db->or_where('sd_type_user','11');
		$this->db->or_where('sd_type_user','12');
		$this->db->or_where('sd_type_user','13');
		$this->db->or_where('sd_type_user','14');
		$this->db->or_where('sd_type_user','15');
		$this->db->or_where('sd_type_user','16');
		$this->db->or_where('sd_type_user','17');
		$this->db->or_where('sd_type_user','18');
		$data['dokter']		= $this->db->get('mst_employer');
		// $data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$data['user_type']		= $this->db->get('mst_type_user');
		$this->load->view('template',$data);
	}

	public function get_dokter()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$this->db->select('id_employe as id,sd_name as name');
		$this->db->where('sd_employe_tp','1');
		$this->db->like('lower(sd_name)', $q, 'both');
		$data = $this->db->get('mst_employer')->result_array();
		
		//$data = ->get('mst_poly',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}
	
	function add(){
		$data['main_view']	= 'data_jasa_dokter/index';
		$data['title']		= 'Data Harga Jasa Pemeriksaan Dokter';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		$this->load->view('template',$data);
	}


	function create(){
		$data 				= $this->input->post('ds');
		
		if($this->db->insert('trx_dokter_fee', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('tdf_id', $data['tdf_id']);
		$this->db->update('trx_dokter_fee', $data); 
	}
	
	function loaddata(){
		$data['mst_type_user']		= $this->db->get('mst_type_user')->result();
		$data['datas'] = $this->data_jasa_dokter_model->get_list();
		$this->load->view('data_jasa_dokter/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_jasa_dokter_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_jasa_dokter_model->deleteData($data);
        	
        }else{
        	$this->data_jasa_dokter_model->deleteData($kode);
        	
        }
    }

    function additional_dr(){
 		$data = $this->input->post('add');
		$this->db->insert('mst_employer', $data);
    }
}