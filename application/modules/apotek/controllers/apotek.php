<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apotek extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['main_view']	= 'index';
		$data['title']		= 'Apotek';
		$data['cf']			=  $this->cf;
		// $data['current']	=  '18';
		// $data['histori']	= $this->db->get_where('v_transaksi_resep',array('recipe_status'=>2));
		$this->load->view('template',$data);
	}

	public function rekap()
	{
		$data['main_view']	= 'rekap';
		$data['title']		= 'Rekap Penjualan Obat';
		$data['cf']			=  $this->cf;
		$this->load->view('template',$data);
	}

	public function rekap_harian()
	{
		$this->db->where('DATE(visit_in)',date('Y-m-d'));
		$this->db->where_in('visit_type',array('rajal','pembelian umum','ranap'));
		$visit 	= $this->db->get('trx_visit tv');
		if( $visit->num_rows() >= 0 )
		{
			$data 	= array();
			foreach ($visit->result() as $key => $value) {
				if( $value->visit_type == 'rajal')
				{
					$this->db->join('trx_recipe tr','tr.recipe_id = trd.recipe_id');
					$this->db->join('inv_item_master im','trd.recipe_medicine = im.im_id');
					$this->db->join('mst_type_inv mti','mti.mtype_id = im.im_unit');
					$recipe = $this->db->get_where('trx_recipe_detail trd',array('tr.mdc_id'=>$value->visit_id));
					if( $recipe->num_rows() >= 1 )
					{
						foreach ($recipe->result() as $k => $v) {
							if( isset($data[$v->im_id]) )
								$qty 	= $data[$v->im_id]['qty'] + $v->recipe_qty;
							else
								$qty 	= $v->recipe_qty;
							$data[$v->im_id] = array(
								'im_id'		=> $v->im_id,
								'im_name'	=> $v->im_name,
								'mtype_name'=> $v->mtype_name,
								'qty'		=> $qty,
							);
						}
					}
				}
				if( $value->visit_type == 'pembelian umum')
				{
					$this->db->join('trx_direct_buy tdb','tdb.tdb_number = tdbd.tdb_number');
					$this->db->join('inv_item_master im','tdbd.tdb_item = im.im_id');
					$this->db->join('mst_type_inv mti','mti.mtype_id = im.im_unit');
					$recipe = $this->db->get_where('trx_direct_buy_detail tdbd',array('tdb.visit_id'=>$value->visit_id));
					if( $recipe->num_rows() >= 1 )
					{
						foreach ($recipe->result() as $k => $v) {
							if( isset($data[$v->im_id]) )
								$qty 	= $data[$v->im_id]['qty'] + $v->tdb_qty;
							else
								$qty 	= $v->tdb_qty;
							$data[$v->im_id] = array(
								'im_id'		=> $v->im_id,
								'im_name'	=> $v->im_name,
								'mtype_name'=> $v->mtype_name,
								'qty'		=> $qty,
							);
						}
					}
				}
			}
		}
		$return['inv']	= $data;
		$this->load->view('apotek/rekap_harian',$return);
	}

	public function rekap_bulanan()
	{
		$this->db->where('DATE_FORMAT(visit_in,"%Y-%m")',date('Y-m'));
		$this->db->where_in('visit_type',array('rajal','pembelian umum','ranap'));
		$visit 	= $this->db->get('trx_visit tv');
		if( $visit->num_rows() >= 0 )
		{
			$data 	= array();
			foreach ($visit->result() as $key => $value) {
				if( $value->visit_type == 'rajal')
				{
					$this->db->join('trx_recipe tr','tr.recipe_id = trd.recipe_id');
					$this->db->join('inv_item_master im','trd.recipe_medicine = im.im_id');
					$this->db->join('mst_type_inv mti','mti.mtype_id = im.im_unit');
					$recipe = $this->db->get_where('trx_recipe_detail trd',array('tr.mdc_id'=>$value->visit_id));
					if( $recipe->num_rows() >= 1 )
					{
						foreach ($recipe->result() as $k => $v) {
							if( isset($data[$v->im_id]) )
								$qty 	= $data[$v->im_id]['qty'] + $v->recipe_qty;
							else
								$qty 	= $v->recipe_qty;
							$data[$v->im_id] = array(
								'im_id'		=> $v->im_id,
								'im_name'	=> $v->im_name,
								'mtype_name'=> $v->mtype_name,
								'qty'		=> $qty,
							);
						}
					}
				}
				if( $value->visit_type == 'pembelian umum')
				{
					$this->db->join('trx_direct_buy tdb','tdb.tdb_number = tdbd.tdb_number');
					$this->db->join('inv_item_master im','tdbd.tdb_item = im.im_id');
					$this->db->join('mst_type_inv mti','mti.mtype_id = im.im_unit');
					$recipe = $this->db->get_where('trx_direct_buy_detail tdbd',array('tdb.visit_id'=>$value->visit_id));
					if( $recipe->num_rows() >= 1 )
					{
						foreach ($recipe->result() as $k => $v) {
							if( isset($data[$v->im_id]) )
								$qty 	= $data[$v->im_id]['qty'] + $v->tdb_qty;
							else
								$qty 	= $v->tdb_qty;
							$data[$v->im_id] = array(
								'im_id'		=> $v->im_id,
								'im_name'	=> $v->im_name,
								'mtype_name'=> $v->mtype_name,
								'qty'		=> $qty,
							);
						}
					}
				}
			}
		}
		$return['inv']	= $data;
		$this->load->view('apotek/rekap_bulanan',$return);
	}

	public function rekap_tahunan()
	{
		$this->db->where('YEAR(visit_in)',date('Y'));
		$this->db->where_in('visit_type',array('rajal','pembelian umum','ranap'));
		$visit 	= $this->db->get('trx_visit tv');
		if( $visit->num_rows() >= 0 )
		{
			$data 	= array();
			foreach ($visit->result() as $key => $value) {
				if( $value->visit_type == 'rajal')
				{
					$this->db->join('trx_recipe tr','tr.recipe_id = trd.recipe_id');
					$this->db->join('inv_item_master im','trd.recipe_medicine = im.im_id');
					$this->db->join('mst_type_inv mti','mti.mtype_id = im.im_unit');
					$recipe = $this->db->get_where('trx_recipe_detail trd',array('tr.mdc_id'=>$value->visit_id));
					if( $recipe->num_rows() >= 1 )
					{
						foreach ($recipe->result() as $k => $v) {
							if( isset($data[$v->im_id]) )
								$qty 	= $data[$v->im_id]['qty'] + $v->recipe_qty;
							else
								$qty 	= $v->recipe_qty;
							$data[$v->im_id] = array(
								'im_id'		=> $v->im_id,
								'im_name'	=> $v->im_name,
								'mtype_name'=> $v->mtype_name,
								'qty'		=> $qty,
							);
						}
					}
				}
				if( $value->visit_type == 'pembelian umum')
				{
					$this->db->join('trx_direct_buy tdb','tdb.tdb_number = tdbd.tdb_number');
					$this->db->join('inv_item_master im','tdbd.tdb_item = im.im_id');
					$this->db->join('mst_type_inv mti','mti.mtype_id = im.im_unit');
					$recipe = $this->db->get_where('trx_direct_buy_detail tdbd',array('tdb.visit_id'=>$value->visit_id));
					if( $recipe->num_rows() >= 1 )
					{
						foreach ($recipe->result() as $k => $v) {
							if( isset($data[$v->im_id]) )
								$qty 	= $data[$v->im_id]['qty'] + $v->tdb_qty;
							else
								$qty 	= $v->tdb_qty;
							$data[$v->im_id] = array(
								'im_id'		=> $v->im_id,
								'im_name'	=> $v->im_name,
								'mtype_name'=> $v->mtype_name,
								'qty'		=> $qty,
							);
						}
					}
				}
			}
		}
		$return['inv']	= $data;
		$this->load->view('apotek/rekap_tahunan',$return);
	}

	

	//fx resep
	function get_resep(){
		$query = $this->input->get('q');
		$this->db->select('im.im_id, im.im_name, sum(iis.istok_qty) as istok_qty, im.im_item_price');
		$this->db->join('inv_item_stok iis','im.im_id = iis.istok_item','left');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
		$this->db->where('im.im_status',1);
		//$this->db->where('iis.istok_qty >',0);
		if($query!=null){
			$this->db->like('lower(im.im_name)', "$query",'both');
		}
		$this->db->group_by('im.im_id');
		$this->db->limit(10);
		$data = $this->db->get('inv_item_master im')->result();
		
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->im_id",
				'name'	=> "$datas->im_name",
				'harga' => int_to_money($datas->im_item_price),
				'stok' => "stok : ".((isset($datas->istok_qty)) ? ((float) $datas->istok_qty) : 0),
			);
		}

		echo json_encode($data);
	} 

	function json_get_resep($id){
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id');
		$obat = $this->db->get_where('inv_item_master im',array('im_id'=>$id));
		$data = array();
		$total = 0;
		foreach($obat->result() as $d){
			$data = array(
				'id'	=> $d->im_id,
				'name'	=> $d->im_name,
				'harga'	=> $d->im_item_price,
				'satuan'=> $d->mtype_name

			);
		}
		echo json_encode($data);
	}

} // end class