<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi_kamar extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['main_view']	= 'informasi_kamar/index';
		$data['title']		= 'Informasi Kamar';
		$data['cf']			=  $this->cf;
		$data['current']	= 7;
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