<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelayanan_informasi extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('pelayanan_informasi_model');
	}

	public function index(){
		$data['main_view']	= 'index';
		$data['title']		= 'Pelayanan Informasi';
		$data['current']	= '';
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		// $data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('com_menu',array('modul_id'=>$cf['modul_id']));
		// $data['datas'] 		= $this->pelayanan_informasi_model->get_list();
		$this->load->view('template',$data);
	}

	function create(){
		$data = $this->input->post('ds');
		$this->db->insert('', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil di buat'));
		redirect(cur_url(-1));
	}

	function update($id){
		$data = $this->input->post('ds');	
		$this->db->where('', $id);
		$this->db->update('', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));
	}

	function delete($id){
		$data = array('status' => 0);
		$this->db->where('', $id);
		$this->db->update('', $data);
		$this->session->set_flashdata('message',array('success','Data berhasil dihapus'));
		redirect(cur_url(-2));
	}
}