<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contoh extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['main_view']	= 'contoh/index';
		$data['title']		= 'Ini untuk contoh user interface';
		$data['cf']			=  $this->cf;
		$this->load->view('template',$data);
	}
	
	function contoh_iframe(){
		$data['main_view']	= 'contoh/iframe';
		$this->load->view('iframe',$data);
	}
}