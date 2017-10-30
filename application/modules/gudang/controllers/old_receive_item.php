<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receive_item extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	// INDEX
	public function index(){
		$data['main_view']	= 'receive_item/index';
		$data['title']		= 'Receive Item';
		$data['cf']			=  $this->cf;
		$this->load->view('template',$data);
	}

	function get_receive_item(){

		$config['sTable']		= "inv_receive_item i";
		$config['aColumns']		= array("iri_id","iri_date_accept","msup_name","sd_name","ipo_id","ipo_date_req");
		$config['aColumns_format']	= array("i.iri_id,i.iri_date_accept,ms.msup_name,me.sd_name,ipo.ipo_id,ipo.ipo_date_req");
		$config['php_format']	= array("","date","","","","date");
		$config['key']			= "i.iri_id";
		$config['join'][]		= array("inv_purchase_order ipo","ipo.ipo_id = i.ipo_id");
		$config['join'][]		= array("mst_supplier ms","ms.msup_id = ipo.ipo_supplier");
		$config['join'][]		= array("mst_employer me","me.id_employe = i.iri_operator");
		$config['searchColumn']	= array("ipo_id");
		$config['aksi']			= array(
									'stat'  	=> true,
									'key'		=> 'iri_id',
									'pilih'	=> base_url().'gudang/receive_item/detail/',
									);
		init_datatable($config);
	}

	// detail
	public function detail($iri_id)
	{
		$data['main_view']	= 'receive_item/detail_receive';
		$data['title']		= $iri_id;
		$data['cf']			= $this->cf;

		$this->db->join('mst_employer me','iri.iri_operator = me.id_employe');
		$data['receive_item'] = $this->db->get_where('inv_receive_item iri',array('iri.iri_id'=>$iri_id))->row();
		$ipo_id = $data['receive_item']->ipo_id;

		$this->db->select('i.*,ms.msup_name,me.sd_name');
		$this->db->join('mst_supplier ms','i.ipo_supplier = ms.msup_id');
		$this->db->join('mst_employer me','i.ipo_operator = me.id_employe');
		$this->db->where('i.ipo_id',$ipo_id);
		$data['purchase']	= $this->db->get('inv_purchase_order i')->row();

		$this->db->select('irid.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id,mti.mtype_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = irid.iri_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id');
		$this->db->where('irid.iri_id',$iri_id);
		$data['detail']		= $this->db->get('inv_receive_item_detail irid');

		$this->load->view('template',$data);
	}

	// ADD / SIMPAN RECEIVE ITEM
	public function add_receive_item()
	{
		$data['main_view']	= 'receive_item/add_receive_item';
		$data['title']		= 'Tambah Receive Item';
		$data['cf']			= $this->cf;
		$data['ipo_id']		= $this->get_ri_id();
		$this->load->view('template',$data);
	}

	public function save_receive_item()
	{
		$data 	= $this->input->post('ds');
		$data['ipo_id'] 	= $this->input->post('ipo_id');
		$data['iri_date_accept']	= date('Y-m-d');
		$data['iri_discount']	= $this->input->post('discount');
		$data['iri_total']	= $this->input->post('grand');
		$dates 	= $this->input->post('iri_date_maturity');
		$data['iri_date_maturity'] = date('Y-m-d', strtotime ($dates));
		$this->db->trans_start();
		
		$this->db->insert('inv_receive_item', $data); 
		$detail = $this->input->post('rows');
		foreach($detail as $r){
			$dt = explode('|',$r);
			$exp = date('Y-m-d',strtotime($dt[2]));
			$dt = array(
				'iri_id'			=> $data['iri_id'],
				'iri_item'			=> $dt[0],
				'iri_qty'			=> $dt[1],
				'iri_item_price'	=> $dt[3],
				'iri_exp'			=> $exp,
				'iri_batch'			=> $dt[4],
			);
			$this->db->insert('inv_receive_item_detail', $dt);
		}
		foreach($detail as $r){
			$dt = explode('|',$r);
			$exp = date('Y-m-d',strtotime($dt[2]));
			$dtstok = array(
				'iri_id'			=> $data['iri_id'],
				'istok_item'			=> $dt[0],
				'istok_qty'			=> $dt[1],
				'istok_item_price'	=> $dt[3] + ($dt[3]*0.25),
				'istok_exp'			=> $exp,
				'istok_batch'		=> $dt[4],
			);
			$this->db->insert('inv_item_stok', $dtstok);

			// cek harga di inv master
			$this->db->where('im_id',$dt[0]);
			$inv_item_master = $this->db->get('inv_item_master')->row();
			if( $inv_item_master->im_item_price_buy < $dt[3] )
			{
				$dtinv['im_item_price_buy'] = $dt[3];
				$dtinv['im_item_price'] = $dt[3] + ($dt[3]*0.25);
				$this->db->where('im_id',$inv_item_master->im_id);
				$this->db->update('inv_item_master',$dtinv);
			}
		}
		$dataPO['ipo_status']	= 1;
		$this->db->where('ipo_id',$data['ipo_id']);
		$this->db->update('inv_purchase_order',$dataPO);
		
		$this->db->trans_complete();
	}

	// FUNGSI TAMBAHAN
	public function get_ri_id(){
		// $format = db_conv($this->db->get_where('com_code',array('id'=>1)))->value_1;
		if( empty($format) )
			$format = 'RI-';
		$l = strlen($format)+1+4;
		$q = "SELECT substr(iri_id, $l, 4) as n 
			  from inv_receive_item where iri_id like '$format%' order by n desc limit 1"; 
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

	public function get_purchase_order()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('ipo_id as id,ipo_id as name')->like('lower(ipo_id)', $q, 'both')->where('ipo_status','0')->get('inv_purchase_order',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}

	function get_detail_purchase_order($ipo_id){
		$this->db->select('*');
		$this->db->where('ipo_id',$ipo_id);
		$this->db->join('mst_supplier ms','ms.msup_id = i.ipo_supplier');
		$po = $this->db->get('inv_purchase_order i');;
		$data = array();
		foreach($po->result() as $d){
			$data = array(
				'id'	=> $d->ipo_id,
				'ipo_supplier'	=> $d->ipo_supplier,
				'ipo_supplier_name'	=> $d->msup_name,
				'ipo_date_req'	=> date('d/m/Y',strtotime($d->ipo_date_req)),
				'ipo_ppn'	=> $d->ipo_ppn,
				'ipo_address'	=> $d->ipo_address,
				'ipo_operator'	=> $d->ipo_operator,
				'ipo_note'	=> $d->ipo_note,
			);
		}
		echo json_encode($data);
	}

	public function cetak_receive($iri_id)
	{
		$data['title']		= $iri_id;
		$data['cf']			= $this->cf;

		$this->db->join('mst_employer me','iri.iri_operator = me.id_employe');
		$data['receive_item'] = $this->db->get_where('inv_receive_item iri',array('iri.iri_id'=>$iri_id))->row();
		$ipo_id = $data['receive_item']->ipo_id;

		$this->db->select('i.*,ms.msup_name,me.sd_name');
		$this->db->join('mst_supplier ms','i.ipo_supplier = ms.msup_id');
		$this->db->join('mst_employer me','i.ipo_operator = me.id_employe');
		$this->db->where('i.ipo_id',$ipo_id);
		$data['purchase']	= $this->db->get('inv_purchase_order i')->row();

		$this->db->select('irid.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id');
		$this->db->join('inv_item_master im','im.im_id = irid.iri_item');
		$this->db->where('irid.iri_id',$iri_id);
		$data['detail']		= $this->db->get('inv_receive_item_detail irid');

		$this->load->view('gudang/receive_item/cetak_receive',$data);
	}

	public function get_supplier()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('msup_id as id,msup_name as name,msup_address as address')->like('lower(msup_id)', $q, 'both')->or_like('lower(msup_name)', $q, 'both')->or_like('lower(msup_address)', $q, 'both')->get('mst_supplier',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}

}