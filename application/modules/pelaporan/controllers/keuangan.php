<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan extends MY_Controller {

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

	public function cashflow()
	{
		$data['main_view']	= 'pelaporan/keuangan/cashflow';
		$data['title']		= 'Cashflow';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	function getCashflow(){
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');

		$data['title']	= "Cashflow Rumah Sakit \" Intan Husada \" ";

		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;

			$this->db->select('fnc.*,mtf.name as type_name');
			$this->db->join('mst_type_finance mtf','mtf.id = fnc.finance_type');
			$data['cashflow'] = $this->db->get('fnc_cashflow fnc');
		}
		$this->load->view('pelaporan/keuangan/data_cashflow',$data);
	}

	// public function get_kategori()
	// {
	// 	$data = array();
	// 	$q = strtolower($_GET['term']);
	// 	$data = $this->db->select('cat_id as id,category as name')->like('lower(category)', $q, 'both')->get('mst_cat_out',100,0)->result_array();
	// 	// echo json_encode(array('results'=> $data));
	// 	echo json_encode($data);
	// }

	// function create_cf(){
	// 	$data = $this->input->post('in');
	// 	$temp = $this->input->post('tmp');
	// 	$data['tanggal_transaksi']=date('Y-m-d',strtotime($data['tanggal_transaksi']));
	// 	if($temp['status']==1){
	// 		$data['debet']=$temp['rp'];
	// 	}else {$data['kredit']=$temp['rp'];}
		
	// 	$this->db->insert('trx_cash_flow',$data);
	// }

	public function jasadokter()
	{
		$data['main_view']	= 'pelaporan/keuangan/jasa_dokter';
		$data['title']		= 'Jasa Dokter';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';

		$this->load->view('template',$data);
	}

	public function getJasaDokter(){
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');

		$data['title'] = "Rekapitulasi Jasa Dokter Rumah Sakit \" Intan Husada \" ";

		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;

			/*$this->db->select('fnc.*,me.sd_name as dr_name, fnc.service_type');
			$this->db->join('mst_employer me','me.id_employe = fnc.dr_id');
			$this->db->group_by('fnc.dr_id');
			$data['jasaDokter'] = $this->db->get('fnc_jasa_dokter fnc');

			$this->db->select('fnc.*,me.sd_name as dr_name,SUM(nominal) as nominal, ms.service_name,mp.pl_name');
			$this->db->join('mst_employer me','me.id_employe = fnc.dr_id');
			$this->db->join('mst_service ms','ms.service_id = fnc.service_type');
			$this->db->join('mst_poly mp','mp.pl_id = fnc.pl_id','left');
			$this->db->where(array('DATE(fnc.modi_datetime) >='=>$dateStart,'DATE(fnc.modi_datetime) <='=>$dateEnd));
			$this->db->group_by('fnc.dr_id,fnc.service_type');
			$data['jasaDokterDetail'] = $this->db->get('fnc_jasa_dokter fnc');*/
			$data['jasaDokter'] = $this->pelaporan_model->getReportDokter($data);
		}

		$this->load->view('pelaporan/keuangan/data_jasa_dokter',$data);
	}

	public function jatuhTempo()
	{
		$data['main_view']	= 'pelaporan/keuangan/jatuh_tempo';
		$data['title']		= 'Jatuh Tempo';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';

		$this->db->select('*');
		$this->db->select_sum('ir.ir_total');
		$this->db->join('mst_supplier ms','ifk.faktur_sup = ms.msup_id');
		$this->db->join('mst_employer me','ifk.faktur_operator = me.id_employe');
		$this->db->join('inv_retur ir','ifk.faktur_id = ir.faktur_id','left');
		$this->db->group_by('ifk.faktur_id');
		$data['jatuhtempo'] = $this->db->get('inv_faktur ifk');

		$this->load->view('template',$data);
	}

	function detail_jd($dr_id){
		$nama_dokter = $this->db->where('id_employe',$dr_id)->get('mst_employer')->row_array();		
		$data['title']= 'Rincian Jasa Dokter '.$nama_dokter['sd_name'];
		$data['dateStart']=$filter['dateStart']=$this->input->post('date_startX');
		$data['dateEnd']=$filter['dateEnd']=$this->input->post('date_endX');
		$filter['dr_id']=$dr_id;
		//print_r($filter);die();
		$data['detail_jasa'] = $this->pelaporan_model->getDetailJasa($filter);
		//print_r($data['detail_jasa']);die();
		//print_r($filter);
		$this->load->view('pelaporan/keuangan/detail_jasa_dokter',$data);

	}

}