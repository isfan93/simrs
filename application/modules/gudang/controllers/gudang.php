<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['main_view']	= 'gudang/index';
		$data['title']		= 'Gudang Farmasi';
		$data['cf']			=  $this->cf;

		$ci =& get_instance();

		$this->db->select('im.im_name,iti.mtype_name');
		$this->db->select_sum('ins.istok_qty');

		$this->db->group_by('ins.istok_item');
		$this->db->having('istok_qty <=', '10');
		$this->db->join('inv_item_master im','im.im_id = ins.istok_item');
		$this->db->join('mst_type_inv iti','im.im_unit = iti.mtype_id');
		$data['critical_stok']	= $this->db->get('inv_item_stok ins');

		$this->db->select('im.im_name,im.im_unit,min(ins.istok_exp) as istok_exp');
		$this->db->group_by('ins.istok_item');
		$this->db->where('ins.istok_qty >',0);
		$this->db->where('istok_exp <=', date('Y-m-d',strtotime('+3 month')));
		$this->db->join('inv_item_master im','im.im_id = ins.istok_item');
		$data['critical_exp']	= $this->db->get('inv_item_stok ins');

		$this->load->view('template',$data);
	}

	function get_item(){
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('im_id as id,im_name as name, im_item_price as harga_jual, im_item_price_buy as harga_beli, im_status')->like('lower(im_id)', $q, 'both')->or_like('lower(im_name)', $q, 'both')->having('im_status = 1')->get_where('inv_item_master',array('im_status'=>1),10,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}

	function get_item_harga($id){
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id');
		$item = $this->db->get_where('inv_item_master im',array('im_id'=>$id));
		$data = array();
		$total = 0;
		foreach($item->result() as $d){
			$data = array(
				'id'	=> $d->im_id,
				'unit'	=> $d->mtype_name,
				'harga_jual'	=> $d->im_item_price,
				'harga_beli'	=> $d->im_item_price_buy,
			);
		}
		echo json_encode($data);
	}
}