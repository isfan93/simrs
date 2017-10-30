<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stok extends MY_Controller {
	function __construct() {
		parent::__construct();
		// ipo status 0 -> default ; 1 sudah diproses
	}

	// index
	public function index(){
		$data['main_view']	= 'stok/index';
		$data['title']		= 'Stok Inventori';
		$data['cf']			= $this->cf;
		$this->load->view('template',$data);
	}

	function get_stok(){

		$config['sTable']		= "inv_item_stok i ";
		//$config['aColumns']		= array("im_name","istok_qty","mtype_name","istok_exp","istok_batch","istok_item_price");
		$config['aColumns']		= array("im_name","istok_qty","mtype_name","istok_exp","istok_item_price");
		//$config['aColumns_format']	= array("im.im_name,mti.mtype_name,sum(i.istok_qty) as istok_qty,min(i.istok_exp) as istok_exp,if(i.istok_batch = '', '-',i.istok_batch) as istok_batch,if(i.istok_item_price = '0', '0',max(i.istok_item_price)) as istok_item_price");
		$config['aColumns_format']	= array("im.im_name,mti.mtype_name,sum(i.istok_qty) as istok_qty,min(i.istok_exp) as istok_exp,max(i.istok_item_price) as istok_item_price");
		$config['php_format']	= array("","float","","date","money");
		$config['key']			= "istok_id";
		$config['group']		= "istok_item";
		// $config['where'][]		= "i.istok_qty > 0";
		$config['where'][]		= "im.im_status = 1";
		//$config['sOrder'][]		= array("i.istok_exp,asc");
		$config['sOrder'][]		= array("im.im_name,asc");
		$config['leftjoin'][]		= array("inv_item_master im","im.im_id = i.istok_item");
		$config['leftjoin'][]	= array("mst_type_inv mti","im.im_unit = mti.mtype_id");
		$config['searchColumn']	= array("im.im_name");
		$config['aksi']			= array(
									'stat'  	=> false,
									// 'key'		=> 'istok_id',
									// 'pilih'	=> base_url().'gudang/purchase_order/detail/',
									);
		init_datatable($config);
	}

	function stokopnam(){
		$data['main_view']	= 'stok/edit_stok';
		$data['title']		= 'Stok Opnam';
		$data['cf']			= $this->cf;
		$this->load->view('template',$data);
	}

	function update(){
		$data = $this->input->post('ds');	
 		$this->db->where('istok_id', $data['istok_id']);
 		$this->db->where('istok_item', $data['istok_item']);
		$this->db->update('inv_item_stok', $data); 
	}
	
	function loaddata(){
		$query = $this->db->query("SELECT i.faktur_id,i.istok_id,i.istok_item,im.im_name,mti.mtype_name,i.istok_qty AS istok_qty,i.istok_exp AS istok_exp,IF(i.istok_batch = '', '-',i.istok_batch) AS istok_batch,IF(i.istok_item_price = '0', '0',i.istok_item_price) AS istok_item_price
					FROM inv_item_stok i 
					LEFT JOIN inv_item_master im ON im.im_id = i.istok_item
					LEFT JOIN mst_type_inv mti ON im.im_unit = mti.mtype_id
					WHERE im.im_status = 1
					ORDER BY im.im_name ASC ");
		$data['datas'] = $query;
		$this->load->view('stok/data_to_edit',$data);

	}

}