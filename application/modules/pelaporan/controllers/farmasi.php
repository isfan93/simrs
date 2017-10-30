<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Farmasi extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('pelaporan_model');
	}

	public function index()
	{
		$data['main_view']	= 'pelaporan/farmasi/farmasi';
		$data['title']		= 'Pelaporan Hasil Penjualan Obat';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	function getPengeluaran(){
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');

		$data['title'] = "Rekap Penjualan Sediaan Farmasi Rumah Sakit \"Intan Husada\" ";

		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;        	
			$data['konten']		= $this->pelaporan_model->getReportFarmasi($data);
			$medicine = array();
			if($data['konten']['recipe']->num_rows() >= 1){
				foreach ($data['konten']['recipe']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}
				}
			}
			if($data['konten']['racikan']->num_rows() >= 1){
				foreach ($data['konten']['racikan']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->racikan_medicine_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->racikan_medicine_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}
				}
			}
			if($data['konten']['direct_buy']->num_rows() >= 1){
				foreach ($data['konten']['direct_buy']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->tdb_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->tdb_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}
				}
			}
		}
		$data['medicine'] = $medicine;
		$this->load->view('pelaporan/farmasi/data_farmasi',$data);
	}

	public function napza()
	{
		$data['main_view']	= 'pelaporan/farmasi/napza';
		$data['title']		= 'Pelaporan Penggunaan Obat Narkotika';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	public function getPenggunaanNapza()
	{
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');

		$data['title'] = "Rekap Penggunaan Obat Napza Rumah Sakit \"Intan Husada\" ";

		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;        	
			$data['konten']		= $this->pelaporan_model->getReportFarmasiNapza($data);
			$medicine = array();
			if($data['konten']['recipe']->num_rows() >= 1){
				foreach ($data['konten']['recipe']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}
				}
			}
			if($data['konten']['racikan']->num_rows() >= 1){
				foreach ($data['konten']['racikan']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->racikan_medicine_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->racikan_medicine_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}
				}
			}
			if($data['konten']['direct_buy']->num_rows() >= 1){
				foreach ($data['konten']['direct_buy']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->tdb_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->tdb_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}
				}
			}
		}
		$data['medicine'] = $medicine;
		$this->load->view('pelaporan/farmasi/data_napza',$data);

	}

	public function pembelian()
	{
		$data['main_view']	= 'pelaporan/farmasi/pembelian';
		$data['title']		= 'Pelaporan Pembelian';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	public function getPembelian()
	{
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');

		$data['title'] = "Rekap Pembelian Sediaan Farmasi Rumah Sakit \"Intan Husada\" ";

		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;    

			$this->db->join('inv_faktur ifk','ifk.faktur_id = ifd.faktur_id');
			$this->db->join('inv_item_master im','im.im_id = ifd.faktur_item');
			$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id');
			$this->db->where(array('ifk.faktur_date >='=> $dateStart,'ifk.faktur_date <='=>$dateEnd));
			$data['medicine'] = $this->db->get('inv_faktur_detail ifd')    	;
		}
		$this->load->view('pelaporan/farmasi/data_pembelian',$data);
	}

	public function prekursor()
	{
		$data['main_view']	= 'pelaporan/farmasi/prekursor';
		$data['title']		= 'Pelaporan Penggunaan Obat Prekursor';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	public function getPenggunaanPrekursor()
	{
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');

		$data['title'] = "Rekap Penggunaan Obat Prekursor Rumah Sakit \"Intan Husada\" ";

		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;        	
			$data['konten']		= $this->pelaporan_model->getReportFarmasiPrekursor($data);
			$medicine = array();
			if($data['konten']['recipe']->num_rows() >= 1){
				foreach ($data['konten']['recipe']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}
				}
			}
			if($data['konten']['racikan']->num_rows() >= 1){
				foreach ($data['konten']['racikan']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->racikan_medicine_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->racikan_medicine_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}
				}
			}
			if($data['konten']['direct_buy']->num_rows() >= 1){
				foreach ($data['konten']['direct_buy']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->tdb_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->tdb_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}
				}
			}
		}
		$data['medicine'] = $medicine;
		$this->load->view('pelaporan/farmasi/data_prekursor',$data);

	}

	public function psikotropika()
	{
		$data['main_view']	= 'pelaporan/farmasi/psikotropika';
		$data['title']		= 'Pelaporan Penggunaan Obat Psikotropika';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	public function getPenggunaanPsikotropika()
	{
		$dateStart = $this->input->post('date_start');
		$dateEnd = $this->input->post('date_end');

		$data['title'] = "Rekap Penggunaan Obat Psikotropika Rumah Sakit \"Intan Husada\" ";

		if(!empty($dateStart) && !empty($dateEnd))
		{
			$dateStart 	= date('Y-m-d',strtotime($dateStart));
			$dateEnd 	= date('Y-m-d',strtotime($dateEnd));

			$data['dateStart']	= $dateStart;
			$data['dateEnd']	= $dateEnd;        	
			$data['konten']		= $this->pelaporan_model->getReportFarmasiPsikotropika($data);
			$medicine = array();
			if($data['konten']['recipe']->num_rows() >= 1){
				foreach ($data['konten']['recipe']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->recipe_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->recipe_price,
						);
					}
				}
			}
			if($data['konten']['racikan']->num_rows() >= 1){
				foreach ($data['konten']['racikan']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->racikan_medicine_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->racikan_medicine_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->racikan_medicine_price,
						);
					}
				}
			}
			if($data['konten']['direct_buy']->num_rows() >= 1){
				foreach ($data['konten']['direct_buy']->result() as $key => $value) {
					if(isset($medicine[$value->im_id][$value->batch]))
					{
						$qty = $medicine[$value->im_id][$value->batch]['qty'];
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $qty + $value->tdb_qty,
							'mtype_name'	=> $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}else{
						$medicine[$value->im_id][$value->batch] = array(
							'im_id'	=> $value->im_id,
							'im_name'	=> $value->im_name,
							'qty'	=> $value->tdb_qty,
							'mtype_name' => $value->mtype_name,
							'batch'		=> $value->batch,
							'im_item_price'		=> $value->tdb_price,
						);
					}
				}
			}
		}
		$data['medicine'] = $medicine;
		$this->load->view('pelaporan/farmasi/data_napza',$data);
	}

}
// end class