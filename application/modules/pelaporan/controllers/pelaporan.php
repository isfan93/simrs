<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelaporan extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('pelaporan_model');
	}

	public function index()
	{
		$data['main_view']	= 'pelaporan/index';
		$data['title']		= 'Pelaporan';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

}