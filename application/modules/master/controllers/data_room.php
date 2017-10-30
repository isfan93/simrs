<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_room extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_room_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_room/index';
		$data['title']		= 'Manajemen Data Room';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$data['tipe_pavillion']	= $this->db->query('select * from mst_pavillion')->result();
		$data['tipe_class']	= $this->db->query('select * from mst_class')->result();
		//$data['tipe_pavillion']	= $this->db->query('select * from mst_pavillion')->result();
		$this->load->view('template',$data);
	}

	function create(){
		$data = $this->input->post('mst');
		$this->db->insert('mst_room', $data);
	}

	function update($id){
		$data = $this->input->post('ds');	
		$this->db->where('room_id', $data['room_id']);
		$this->db->update('mst_room', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));
	}

	
	function loaddata(){
		//$tgl = $this->input->post('tgl');
		$data['class'] = $this->db->query("select * from mst_class ")->result();
		$data['pav'] = $this->db->query("select * from mst_pavillion ")->result();
		$data['datas'] = $this->data_room_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_room/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_room_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode==''){
			$this->data_room_model->deleteData($data);
		}else{
			$this->data_room_model->deleteData($kode);
		}
    }

    function aktifkan($kode){
    	$this->db->query("
			update mst_room
			set room_status = 1
			where room_id in ($kode)");
    }
}