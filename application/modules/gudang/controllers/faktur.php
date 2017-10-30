<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faktur extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	// INDEX
	public function index(){
		$data['main_view']	= 'faktur/index';
		$data['title']		= 'Faktur Pembelian';
		$data['cf']			=  $this->cf;
		$this->load->view('template',$data);
	}

	function get_faktur(){

		$config['sTable']		= "inv_faktur i";
		//$config['aColumns']		= array("faktur_id","faktur_date","faktur_date_maturity","msup_name","sd_name","faktur_total");
		$config['aColumns']		= array("faktur_id","faktur_number","faktur_date","faktur_date_maturity","msup_name","sd_name","faktur_total");
		//$config['aColumns_format']	= array("i.faktur_id,i.faktur_date,i.faktur_date_maturity,ms.msup_name,me.sd_name,i.faktur_total");
		$config['aColumns_format']	= array("i.faktur_id,i.faktur_number,i.faktur_date,i.faktur_date_maturity,ms.msup_name,me.sd_name,i.faktur_total");
		$config['php_format']	= array("","","date","date","","","money");
		$config['key']			= "i.faktur_id";
		$config['join'][]		= array("mst_supplier ms","ms.msup_id = i.faktur_sup");
		$config['leftjoin'][]		= array("mst_employer me","me.id_employe = i.faktur_operator");
		$config['searchColumn']	= array("faktur_number","faktur_date","faktur_date_maturity","msup_name","sd_name","faktur_total");
		$config['aksi']			= array(
									'stat'  	=> true,
									'key'		=> 'faktur_id',
									'pilih'	=> base_url().'gudang/faktur/detail/',
									);
		init_datatable($config);
	}

	// detail
	public function detail($faktur_id)
	{
		$data['main_view']	= 'faktur/detail';
		$data['title']		= $faktur_id;
		$data['cf']			= $this->cf;

		$this->db->join('mst_employer me','ifk.faktur_operator = me.id_employe','left');
		$data['faktur'] = $this->db->get_where('inv_faktur ifk',array('ifk.faktur_id'=>$faktur_id))->row();

		$this->db->select('ifd.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id,mti.mtype_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = ifd.faktur_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
		$this->db->where('ifd.faktur_id',$faktur_id);
		$data['detail']		= $this->db->get('inv_faktur_detail ifd');

		$this->load->view('template',$data);
	}

	// ADD / SIMPAN RECEIVE ITEM
	public function add_faktur()
	{
		$data['main_view']	= 'faktur/add';
		$data['title']		= 'Tambah Faktur Pembelian';
		$data['cf']			= $this->cf;
		$data['faktur_id']		= $this->get_faktur_id();
		$this->load->view('template',$data);
	}

	public function save_faktur()
	{
		// debug_array($this->input->post());
		$total_include_ppn = $this->input->post('total_include_ppn');
		$data 	= $this->input->post('ds');
		// debug_array($this->input->post());
		$dates 	= $this->input->post('faktur_date');
		$data['faktur_date']	= date('Y-m-d', strtotime ($dates));
		$dates 	= $this->input->post('faktur_date_maturity');
		$data['faktur_date_maturity'] = date('Y-m-d', strtotime ($dates));
		//hendri, 13 Maret 2015
		$data['ppn']=((isset($total_include_ppn)) && ($total_include_ppn == 'on')) ? 1 : 0;
		//=====================
		$this->db->trans_start();
		
		$this->db->insert('inv_faktur', $data); 
		$detail = $this->input->post('rows');
		if(isset($detail)){
			foreach($detail as $r){
				$dt = explode('|',$r);
				$exp = date('Y-m-d',strtotime($dt[2]));
				$dt = array(
					'faktur_id'				=> $data['faktur_id'],
					'faktur_item'			=> $dt[0],
					'faktur_item_qty'		=> $dt[1],
					'faktur_item_price'		=> ($dt[6] - ($dt[9]/$dt[1])) * $dt[1],
					'faktur_item_pajak'		=> $dt[9],
					'faktur_item_discount'	=> $dt[8],
					'faktur_item_total'		=> ((isset($total_include_ppn)) && ($total_include_ppn == 'on')) ? $dt[7] : ($dt[7] + $dt[9]) ,
					'faktur_item_exp'		=> $exp,
					'faktur_item_batch'		=> $dt[4],
					//hendri, 13 Maret 2015
					'ppn'					=> ((isset($total_include_ppn)) && ($total_include_ppn == 'on')) ? 1 : 0,
				);
				$this->db->insert('inv_faktur_detail', $dt);
			}
			foreach($detail as $r){
				$dt = explode('|',$r);
				$exp = date('Y-m-d',strtotime($dt[2]));
				$dtstok = array(
					'faktur_id'			=> $data['faktur_id'],
					'istok_item'		=> $dt[0],
					'istok_qty'			=> $dt[1],
					'istok_item_buy'	=> $dt[6],
					'istok_item_price'	=> $dt[6] + ($dt[6]*0.25),
					'istok_exp'			=> $exp,
					'istok_batch'		=> $dt[4],
				);
				$this->db->insert('inv_item_stok', $dtstok);

				// update harga di inv master
				$dtinv['im_item_price_buy'] = ($dt[6] - ($dt[9]/$dt[1]));
				$dtinv['im_item_price'] = $dtinv['im_item_price_buy'] + ($dtinv['im_item_price_buy']*0.25);
				$this->db->where('im_id',$dt[0]);
				$this->db->update('inv_item_master',$dtinv);
			}
		}
		
		$this->db->trans_complete();
	}

	// FUNGSI TAMBAHAN
	public function get_faktur_id(){
		if( empty($format) )
			$format = 'FK-';
		$l = strlen($format)+1+4;
		$q = "SELECT substr(faktur_id, $l, 4) as n 
			  from inv_faktur where faktur_id like '$format%' order by n desc limit 1"; 
		$q = $this->db->query($q);
		if($q->num_rows() == 0){
			$no = '0001';
		}else{
			$nl = intval(db_conv($q)->n);
			$nl++;
			$no = rtrim(sprintf("%'04s\n",$nl));
		}
		return $format.DATE('y').DATE('m').$no;		
	}

	public function cetak($faktur_id)
	{
		$data['title']		= $faktur_id;
		$data['cf']			= $this->cf;

		$this->db->join('mst_employer me','ifk.faktur_operator = me.id_employe');
		$data['faktur'] = $this->db->get_where('inv_faktur ifk',array('ifk.faktur_id'=>$faktur_id))->row();

		$this->db->select('ifd.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id,mti.mtype_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = ifd.faktur_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
		$this->db->where('ifd.faktur_id',$faktur_id);
		$data['detail']		= $this->db->get('inv_faktur_detail ifd');

		$this->load->view('gudang/faktur/cetak',$data);
	}

	public function get_supplier()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('msup_id as id,msup_name as name,msup_address as address')->like('lower(msup_id)', $q, 'both')->or_like('lower(msup_name)', $q, 'both')->or_like('lower(msup_address)', $q, 'both')->get('mst_supplier',100,0)->result_array();
		echo json_encode($data);
	}

	// function update_data($dfi){
	// 	// update detail faktur
	// 	$faktur_id= $this->input->post('faktur_id');
		
	// 	$this->db->trans_start();
		
	// 	$data['faktur_item_exp']= $this->input->post('exp');
	// 	$data['faktur_item_batch']= $this->input->post('nobatch');
	// 	$data['faktur_item_price']= ($this->input->post('price')) * $this->input->post('qty');
	// 	$data['faktur_item_pajak']= (0.10 * $this->input->post('price')) * $this->input->post('qty');
	// 	$data['faktur_item_total']= ($this->input->post('price') + (0.10 * $this->input->post('price'))  )* $this->input->post('qty');
	// 	$data['faktur_item_qty']= $this->input->post('qty');
	// 	$this->db->where('ifd_id',$dfi);
	// 	$this->db->update('inv_faktur_detail',$data);
	// 	// update faktur
	// 	$this->db->where('faktur_id',$faktur_id);
	// 	$dataFaktur = $this->db->get('inv_faktur_detail ifd');
	// 	$faktur_pajak = $faktur_price = $faktur_discount = $faktur_total = 0;
	// 	foreach ($dataFaktur->result() as $key => $value) {
	// 		$faktur_price += $value->faktur_item_price;
	// 		$faktur_pajak += $value->faktur_item_pajak;
	// 		// $faktur_discount +=  $value->faktur_item_discount;
	// 		$faktur_total += $value->faktur_item_total;
	// 	}
	// 	$dataFakturNew = array(
	// 		'faktur_price'	=> $faktur_price,
	// 		// 'faktur_discount'	=> $faktur_discount,
	// 		'faktur_pajak'	=> $faktur_pajak,
	// 		'faktur_total'	=> $faktur_total,
	// 	);
	// 	$this->db->where('faktur_id',$faktur_id);
	// 	$this->db->update('inv_faktur',$dataFakturNew);
	// 	$this->update_stok($dfi,$data);
	// 	$this->db->trans_complete();
	// }

	function update_stok($dfi,$data){
		$faktur_detail = $this->db->where('ifd_id',$dfi)->get('inv_faktur_detail')->row_array();
		$stok['istok_exp']=$data['faktur_item_exp'];
		$stok['istok_batch']=$data['faktur_item_batch'];
		$stok['istok_item_buy']=($data['faktur_item_price'] + $data['faktur_item_pajak']) / $data['faktur_item_qty'];
		$stok['istok_item_price']=$stok['istok_item_buy'] + ($stok['istok_item_buy']*0.25);

		$this->db->where('faktur_id',$faktur_detail['faktur_id']);
		$this->db->where('istok_item',$faktur_detail['faktur_item']);
		$this->db->update('inv_item_stok',$stok);
	}

}