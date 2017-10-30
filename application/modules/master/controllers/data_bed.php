<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_bed extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_bed_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_bed/index';
		$data['title']		= 'Manajemen Data Bed';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$data['tipe_room']	= $this->data_bed_model->get_room();//$this->db->query('select * from mst_room')->result();
		//$data['tipe_class']	= $this->db->query('select * from mst_class')->result();
		//$data['tipe_pavillion']	= $this->db->query('select * from mst_pavillion')->result();
		$this->load->view('template',$data);
	}

	function create(){
		$data = $this->input->post('mst');
		$data['status'] = 1;
		$this->db->insert('mst_bed', $data);
		 
	}

	function update($id){
		$data = $this->input->post('ds');	
		$this->db->where('room_id', $data['room_id']);
		$this->db->update('mst_bed', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));
	}

	
	function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['class'] = $this->db->query("select * from mst_class ")->result();
		$data['room'] = $this->db->query("select * from mst_room ")->result();
		$data['datas'] = $this->data_bed_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_bed/data',$data);

	}

	function aktifkan_bed($kode){
		//$temp = $/
		$data = array('status'=>1);
		$this->db->where_in('bed_id',$kode);		
		$this->db->update('mst_bed',$data);
	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_bed_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode==''){
			$this->data_bed_model->deleteData($data);
		}else{
			$this->data_bed_model->deleteData($kode);
		}
    }
}