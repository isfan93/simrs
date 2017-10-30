<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan extends MY_Controller {

	function __construct() {
		parent::__construct();
    }

	public function index(){
		$data['main_view']	= 'index';
		$data['title']		= 'Pencatatan Transaksi';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

}