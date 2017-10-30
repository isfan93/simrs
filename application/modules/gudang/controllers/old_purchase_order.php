<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order extends MY_Controller {
	function __construct() {
		parent::__construct();
		// ipo status 0 -> default ; 1 sudah diproses
	}

	// index
	public function index(){
		$data['main_view']	= 'purchase_order/index';
		$data['title']		= 'Purchase Order';
		$data['cf']			= $this->cf;
		$data['ipo_id']		= $this->get_ipo_id();
		$this->load->view('template',$data);
	}

	function get_purchase_order(){
		$config['sTable']		= "inv_purchase_order i";
		$config['aColumns']		= array("ipo_id","ipo_date_req","msup_name","sd_name","ipo_note");
		$config['aColumns_format']	= array("i.ipo_id,i.ipo_date_req,ms.msup_name,me.sd_name,i.ipo_note");
		$config['php_format']	= array("","date","","","");
		$config['key']			= "i.ipo_id";
		$config['join'][]		= array("mst_supplier ms","ms.msup_id = i.ipo_supplier");
		$config['join'][]		= array("mst_employer me","i.ipo_operator = me.id_employe");
		$config['searchColumn']	= array("ipo_id");
		$config['aksi']			= array(
									'stat'  	=> true,
									'key'		=> 'ipo_id',
									'pilih'	=> base_url().'gudang/purchase_order/detail/',
									);
		init_datatable($config);
	}

	// simpan purchase

	public function add_purchase_order()
	{
		$data['main_view']	= 'purchase_order/add_purchase_order';
		$data['title']		= 'Tambah Purchase Order';
		$data['cf']			= $this->cf;
		$data['ipo_id']		= $this->get_ipo_id();
		$this->load->view('template',$data);
	}

	function add_order(){
		$data 	= $this->input->post('ds');
		$dates 	= $this->input->post('ipo_date_req');
		$data['ipo_date_req'] = date('Y-m-d', strtotime ($dates));

		$this->db->trans_start();
		$this->db->insert('inv_purchase_order', $data); 
		$detail = $this->input->post();
		$sub 	= $this->input->post('tot');
		$total 	= $this->input->post('grand');
		foreach($detail['rows'] as $r){
			$dt = explode('|',$r);
			$dt = array(
				'ipo_id'			=> $data['ipo_id'],
				'ipod_item'			=> $dt[0],
				'ipod_qty'			=> $dt[1],
				'ipod_harga_beli'	=> $dt[2],
			);
			$this->db->insert('inv_purchase_order_detail', $dt);
		}
		$this->db->trans_complete();
		$this->session->set_flashdata('message',array('success','Data berhasil di buat'));
	}

	// detail
	public function detail($ipo_id)
	{
		$data['main_view']	= 'purchase_order/detail_purchase';
		$data['title']		= $ipo_id;
		$data['cf']			= $this->cf;

		$this->db->select('i.*,ms.msup_name,me.sd_name');
		$this->db->join('mst_supplier ms','i.ipo_supplier = ms.msup_id');
		$this->db->join('mst_employer me','i.ipo_operator = me.id_employe');
		$this->db->where('i.ipo_id',$ipo_id);
		$data['purchase']	= $this->db->get('inv_purchase_order i')->row();

		$this->db->select('id.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id,mti.mtype_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = id.ipod_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id');
		$this->db->where('id.ipo_id',$ipo_id);
		$data['detail']		= $this->db->get('inv_purchase_order_detail id');
		$this->load->view('template',$data);
	}

	// fungsi lain

	function get_ipo_id(){
		$format = 'PO-';
		$l = strlen($format)+1+4;
		$q = "SELECT substr(ipo_id, $l, 4) as n 
			  from inv_purchase_order where ipo_id like '$format%' order by n desc limit 1"; 
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

	public function get_supplier()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('msup_id as id,msup_name as name,msup_address as address')->like('lower(msup_id)', $q, 'both')->or_like('lower(msup_name)', $q, 'both')->or_like('lower(msup_address)', $q, 'both')->get('mst_supplier',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}

	public function cetak_purchase($ipo_id)
	{
		$data['title']		= $ipo_id;
		$data['cf']			= $this->cf;

		$this->db->select('i.*,ms.msup_name,me.sd_name');
		$this->db->join('mst_supplier ms','i.ipo_supplier = ms.msup_id');
		$this->db->join('mst_employer me','i.ipo_operator = me.id_employe');
		$this->db->where('i.ipo_id',$ipo_id);
		$data['purchase']	= $this->db->get('inv_purchase_order i')->row();

		$this->db->select('id.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id,mti.mtype_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = id.ipod_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id');
		$this->db->where('id.ipo_id',$ipo_id);
		$data['detail']		= $this->db->get('inv_purchase_order_detail id');
		$this->load->view('gudang/purchase_order/cetak_purchase',$data);
	}

}	// end class