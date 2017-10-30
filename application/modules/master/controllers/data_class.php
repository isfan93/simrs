<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_class extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_class_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_class/index';
		$data['title']		= 'Manajemen Data Kelas Ruangan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		//$data['tipe_pavillion']	= $this->db->query('select * from mst_pavillion')->result();
		//$data['tipe_class']	= $this->db->query('select * from mst_class')->result();
		//$data['tipe_pavillion']	= $this->db->query('select * from mst_pavillion')->result();
		$this->load->view('template',$data);
	}

	function create(){
		$data = $this->input->post('ds');
		$this->db->insert('mst_class', $data);
		 
	}

	function update($id){
		$data = $this->input->post('ds');	
		$this->db->where('class_id', $data['class_id']);
		$this->db->update('mst_class', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));
	}


	function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['datas'] = $this->data_class_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_class/data',$data);

	}

	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_class_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode==''){
		    $this->data_class_model->deleteData($data);
		}else{
			$this->data_class_model->deleteData($kode);
		}
    }
}