<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Latihan extends CI_Controller {

	function index(){
		echo get_next_val('trx_dr_schedule','sch_id');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */