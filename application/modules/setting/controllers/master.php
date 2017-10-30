<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['main_view']	= 'index';
		$data['title']		= 'Master Data ';
		$data['desc']		= 'Modul master. ';
		$this->load->view('template',$data);
	}
}