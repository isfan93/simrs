<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trend extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('trend_model');
	}

	public function index()
	{
		$data['main_view']	= 'trend/index';
		$data['title']		= '10 Besar';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	public function penyakit()
	{
		$data['main_view']	= 'trend/index';
		$data['title']		= '10 Besar';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	public function getDiagnosa()
	{
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');
		$service = $this->input->post('service');

		$data['title']	= "10 Besar Penyakit";
		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;
			$data['service']	= $service;

        	$this->db->_protect_identifiers=false;
        	
        	/*$this->db->select('md.*,COUNT(md.diag_kode) AS jumlah');
			$this->db->join('mst_diagnosa md','md.diag_id=tdt.dat_diag');
			$this->db->join('trx_service ts','ts.service_id=tdt.mdc_id');
			$this->db->where(array('DATE(ts.service_in) >='=>$dateStart,'DATE(ts.service_in) <='=>$dateEnd));
			$this->db->group_by('md.diag_kode');
			$this->db->order_by('jumlah','DESC');
			$this->db->limit(10);$this->db->get('trx_diagnosa_treathment tdt');*/
			$data['diagnosa']	= $this->trend_model->getReportDiagnosa($data);

			/*foreach ($data['kunjungan']->result() as $key => $value) {
        		$this->db->_protect_identifiers=false;
				$this->db->where(array('substr(ts.service_id,4,8)' => ($value->visit_id) ));
				$layanan = $this->db->get('trx_service ts');
				$data['layanan'][$value->visit_id] = $layanan;

				$this->db->select_sum('tbd.total_price');
				$this->db->where(array('substr(tbd.bill_id,4,8)' => ($value->visit_id) ,'tbd.payment_status'=>'1'));
				$data['bill'][$value->visit_id]	= $this->db->get('trx_bill_detail tbd')->row();
			}*/


		}

		$this->load->view('pelaporan/trend/penyakit',$data);
	}

	

}
// end class