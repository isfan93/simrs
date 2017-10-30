<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('expenses_model');
	}

	public function index()
	{
		$data['main_view']	= 'expenses/index';
		$data['title']		= 'Pencatatan Pengeluaran';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$data['category']		= $this->db->get('mst_type_finance')->result();
		$this->load->view('template',$data);
	}

	public function cashflow()
	{
		$data['main_view']	= 'pelaporan/keuangan/index';
		$data['title']		= 'Pelaporan Cashflow';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$data['category']		= $this->db->get('mst_type_finance')->result();
		$this->load->view('template',$data);
	}

	public function getType()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('id as id,name as name')->like('lower(name)', $q, 'both')->get('mst_type_finance',100,0)->result_array();
		echo json_encode($data);
	}

	public function saveExpenses()
	{
		$data = $this->input->post('ds');
		if(!empty($data))
		{	
			$this->db->trans_start();
			$data['date'] = date('Y-m-d',strtotime($data['date']));
			$this->db->insert('fnc_expenses',$data);
			$data['kredit']	= $data['nominal'];
			$data['debet']	= 0;
			unset($data['nominal']);
			$this->db->insert('fnc_cashflow',$data);
			$this->db->trans_complete();
		}
	}

	public function getDataExpenses()
	{
		$data['expenses'] = $this->db->get('fnc_expenses');
		$this->load->view('expenses/data_expenses',$data);
	}

	// function data_cashflow(){
	// 	//$data['tipeaskes']		= $this->db->get('mst_type_inv')->result();
	// 	$data['datas'] = $this->expenses_model->get_list();
	// 	$this->load->view('keuangan/expenses/data_cashflow',$data);

	// }

	// function create_cf(){
	// 	$data = $this->input->post('in');
	// 	$temp = $this->input->post('tmp');
	// 	$data['tanggal_transaksi']=date('Y-m-d',strtotime($data['tanggal_transaksi']));
	// 	if($temp['status']==1){
	// 		$data['debet']=$temp['rp'];
	// 	}else {$data['kredit']=$temp['rp'];}
		
	// 	$this->db->insert('trx_jurnal',$data);
	// }

	// function getRekapHarian(){
	// 	$dateStart=date('Y-m-d',strtotime($this->input->post('date_start')));
	// 	$dateEnd=date('Y-m-d',strtotime($this->input->post('date_end')));
	// 	//print_r($dateStart);die();
	// 	$data['datas']=$this->expenses_model->rekapHarian($dateStart,$dateEnd);
	// 	$this->load->view('keuangan/expenses/data_cashflow',$data);
	// }

	// function getRekapBulanan(){
	// 	$monthStart=$this->input->post('month_start');
	// 	$monthEnd=$this->input->post('month_end');
	// 	//$year=$this->input->post('year');
	// 	$data['datas']=$this->expenses_model->rekapBulanan($monthStart,$monthEnd);
	// 	//print_r($data['datas']);die();
	// 	$this->load->view('keuangan/expenses/cashflow_month',$data);
	// }

}