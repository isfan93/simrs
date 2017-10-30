<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi_pasien extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('pelayanan_informasi_model','pim');
		}

	public function index(){
		$data['hospitalized_patients'] = $this->pim->hospitalized_patients();
		$data['main_view']	= 'informasi_pasien/index';
		$data['title']		= 'Informasi Pasien Rawat Inap';
		$data['cf']			=  $this->cf;
		$data['current']	= 5;
		$this->load->view('template',$data);
	}

	// function dt_all_pasien(){
	// 	$config['sTable']		= "ptn_social_data";
	// 	$config['aColumns']		= array("sd_name","sd_address","sd_place_of_birth","sd_date_of_birth","sd_age","sd_reg_date");
	// 	$config['aColumns_format']	= array("sd_rekmed,sd_name,sd_address,sd_place_of_birth,sd_date_of_birth,sd_age,sd_reg_date");
	// 	$config['php_format']	= array("","strtoupper","strtoupper","strtoupper","strtoupper","","date");
	// 	$config['key']			= "sd_rekmed";
	// 	$config['searchColumn']	= array("sd_name","sd_address");
	// 	$config['aksi']			= array(
	// 								'stat'  	=> false,
	// 								// 'key'		=> 'ipo_id',
	// 								// 'pilih'	=> base_url().'gudang/purchase_order/detail/',
	// 								);
	// 	// init_datatable($config);
	// 	// $config['sTable'] 			= 'ptn_social_data';
	// 	// $config['aColumns'] 		= array('sd_rekmed,sd_name,sd_address,sd_place_of_birth,sd_date_of_birth,sd_age,ptn_reg_date');
	// 	// $config['aColumns_format'] 	= array("sd_rekmed","sd_name","sd_address","sd_place_of_birth","sd_date_of_birth","sd_age","ptn_reg_date");
	// 	// $config['php_format'] 		= array('','strtoupper','','','date','','date');
	// 	// $config['key'] 				= 'ptn_rekmed';
	// 	// $config['searchColumn'] 	= array('ptn_name','ptn_address');
	// 	// $config['aksi'] = array(
	// 	// 						'stat'  	=> false,
	// 	// 						// 'key'		=> 'ptn_rekmed',//
	// 	// 						/*'edit'   	=> base_url().'rawat_jalan/master__dokter/update/',
	// 	// 						'delete' 	=> base_url().'rawat_jalan/master__dokter/delete/dr/',*/
	// 	// 						// 'detail'	=> base_url().'pelayanan_informasi/informasi_pasien/detail/',
	// 	// 						);
	// 	init_datatable($config);
	// }
}