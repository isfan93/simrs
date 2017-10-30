<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		if(is_login()){
			redirect(base_url().'home');
		}else
		$this->load->view('vLogin');
	}
	
	function cek(){
		$uname = $this->input->post('username');
		$pwd = $this->input->post('password');
                if(login_cek($uname,$pwd)){
			$this->session->set_flashdata('message',array("success","Selamat anda berhasil login"));
			redirect(base_url(get_home_base()));
		}else{
			$this->session->set_flashdata('message',array("error","Maaf username atau password anda salah"));
			redirect(base_url().'login');
		}
	}
	
	function logout(){
		logout();
		redirect(base_url().'login');
	}
}