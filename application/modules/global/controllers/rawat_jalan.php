<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rawat_jalan extends MY_Controller {

	function diagnosa()
	{
		$data = array();
		for($i=1;$i<=10;$i++){
			$data[] = array(
				'id'		=> "Kode ke-$i",
				'name'		=> "Diagnosis ke-$i"
			);
		}
		$return = array(
			'results'	=> $data
		);
		echo json_encode($return);
	}
}