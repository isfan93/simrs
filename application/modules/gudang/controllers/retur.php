<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retur extends MY_Controller {
	function __construct() {
		parent::__construct();
		// ipo status 0 -> default ; 1 sudah diproses
	}

	// index
	public function index(){
		$data['main_view']	= 'retur/index';
		$data['title']		= 'Retur';
		$data['cf']			= $this->cf;
		$this->load->view('template',$data);
	}

	function get_retur(){

		$config['sTable']		= "inv_retur i";
		$config['aColumns']		= array("ir_id","faktur_id","ir_date","sd_name","ir_note");
		$config['aColumns_format']	= array("i.ir_id,ifk.faktur_id,i.ir_date,me.sd_name,i.ir_note");
		$config['php_format']	= array("","","date","","","");
		$config['key']			= "i.ir_id";
		$config['join'][]		= array("mst_employer me","me.id_employe = i.ir_operator");
		$config['join'][]		= array("inv_faktur ifk","ifk.faktur_id = i.faktur_id");
		$config['searchColumn']	= array("ir_id");
		$config['aksi']			= array(
									'stat'  	=> true,
									'key'		=> 'ir_id',
									'pilih'	=> base_url().'gudang/retur/detail/',
									);
		init_datatable($config);
	}

	// simpan purchase

	public function add_retur()
	{
		$data['main_view']	= 'retur/add';
		$data['title']		= 'Tambah Retur';
		$data['cf']			= $this->cf;
		$data['ir_id']		= $this->get_retur_id();
		$this->load->view('template',$data);
	}

	function save_retur(){
		$data = $this->input->post();

		$data['ds']['ir_date'] = date('Y-m-d', strtotime ($data['ds']['ir_date']));
		$this->db->trans_start();
		
		$this->db->insert('inv_retur', $data['ds']); 
		$detail = $this->input->post();
		if(isset($data['returDetail']['ir_item']) && is_array($data['returDetail']))
		{
			foreach ($data['returDetail']['ir_item'] as $key => $value) {
				if(!empty($value))
				{
					$dtDetail[] = array(
						'ir_id'		=> $data['ds']['ir_id'],
						'ir_item'	=> $value,
						'ir_item_qty'	=> $data['returDetail']['ir_item_qty'][$value],
						'ir_item_price'	=> $data['returDetail']['ir_item_price'][$value] * $data['returDetail']['ir_item_qty'][$value],
						'ir_item_pajak'	=> $data['returDetail']['ir_item_pajak'][$value] * $data['returDetail']['ir_item_qty'][$value],
						'ir_item_total'	=> $data['returDetail']['ir_item_total'][$value],
					);
					$stok = $this->db->get_where('inv_item_stok',array('faktur_id'=>$data['ds']['faktur_id'],'istok_item'=>$value))->row();
					$dtstok = array(
						'faktur_id'			=> $data['ds']['faktur_id'],
						'istok_item'		=> $value,
						'istok_qty'			=> $stok->istok_qty - $data['returDetail']['ir_item_qty'][$value],
					);
					$this->db->where(array('faktur_id'=>$data['ds']['faktur_id'],'istok_item'=>$value) );
					$this->db->update('inv_item_stok', $dtstok);
				}
			}
			if(!empty($dtDetail))
				$this->db->insert_batch('inv_retur_detail',$dtDetail);
		}

		$this->db->trans_complete();
		
		$this->session->set_flashdata('message',array('success','Data berhasil di buat'));
	}

	// detail
	public function detail($ir_id)
	{
		$data['main_view']	= 'retur/detail';
		$data['title']		= $ir_id;
		$data['cf']			= $this->cf;
		$this->db->join('inv_faktur ifk','ifk.faktur_id = i.faktur_id');
		$this->db->join('mst_employer me','ifk.faktur_operator = me.id_employe');
		$this->db->join('mst_supplier ms','ifk.faktur_sup = ms.msup_id');
		$this->db->where('i.ir_id',$ir_id);
		$data['retur']	= $this->db->get('inv_retur i')->row();

		$this->db->select('id.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = id.ir_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
		$this->db->where('id.ir_id',$ir_id);
		$data['detail']		= $this->db->get('inv_retur_detail id');
		$this->load->view('template',$data);
	}

	// fungsi lain

	function get_retur_id(){
		if( empty($format) )
			$format = 'RE-';
		$l = strlen($format)+1+4;
		$q = "SELECT substr(ir_id, $l, 4) as n 
			  from inv_retur where ir_id like '$format%' order by n desc limit 1"; 
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
		echo json_encode($data);
	}


	// cetak
	public function cetak($ir_id)
	{
		$data['title']		= $ir_id;
		$data['cf']			= $this->cf;

		$this->db->join('inv_faktur ifk','ifk.faktur_id = i.faktur_id');
		$this->db->join('mst_employer me','ifk.faktur_operator = me.id_employe');
		$this->db->join('mst_supplier ms','ifk.faktur_sup = ms.msup_id');
		$this->db->where('i.ir_id',$ir_id);
		$data['retur']	= $this->db->get('inv_retur i')->row();

		$this->db->select('id.*,im.im_name,im.im_unit,im_unit,im_item_price_buy,im_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = id.ir_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
		$this->db->where('id.ir_id',$ir_id);
		$data['detail']		= $this->db->get('inv_retur_detail id');

		$this->load->view('gudang/retur/cetak',$data);
	}

	public function get_faktur()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('faktur_id as id,faktur_id as name')->like('lower(faktur_id)', $q, 'both')->get('inv_faktur',100,0)->result_array();
		echo json_encode($data);
	}

	public function get_faktur_detail($faktur_id)
	{
		$this->db->select('ifd.*,im.im_name,mti.mtype_id,mti.mtype_name');
		$this->db->join('inv_item_master im','im.im_id = ifd.faktur_item');
		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
		$this->db->where('ifd.faktur_id',$faktur_id);
		$data['detail']		= $this->db->get('inv_faktur_detail ifd');

		$this->load->view('retur/detail_faktur',$data);
	}

}	// end class