<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian_umum extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['main_view']	= 'pembelian_umum/index';
		$data['title']		= 'Pembelian Umum';
		$data['cf']			=  $this->cf;

        $this->db->_protect_identifiers=false;
		$this->db->join('trx_visit tv','substr(ts.service_id,4,8) = tv.visit_id');
		$this->db->join('trx_direct_buy tdb','ts.service_id = tdb.service_id');
		$this->db->where('ts.service_status <','5');
		$data['pembelian_umum']	= $this->db->get('trx_service ts');

		$this->load->view('template',$data);
	}

	public function add_pembelian_umum($service_id = null){
		$data['main_view']	= 'pembelian_umum/add_pembelian_umum';
		$data['title']		= 'Pembelian Umum';
		$data['cf']			=  $this->cf;

        $this->db->select('SUM(iis.istok_qty) as istok_qty,im.*');
        $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
        $this->db->group_by('im.im_id');
        $data['medicine'] = $this->db->get('inv_item_master im');
        $data['racikan_fee'] = $this->db->get('mst_racikan_fee');
        
        $status_bayar_resep = $this->db->get_where('trx_bill_detail', array('bill_id' => "BL-".substr($service_id,3), 'service_type' => 5, 'payment_status' => 1));
        $data['status_bayar_resep'] = $status_bayar_resep->num_rows() >= 1 ? 1 : 0;
		
		$this->load->view('template',$data);
	}

	public function simpanPembelianUmum()
	{
        $data = $this->input->post();
        $this->db->trans_start();

        if(empty($data['mdc_id'])){
			$visit_id = $this->getVisitID();
			$service_id = 'PU-'.$visit_id.'-01';
	        $bill_id = 'BL-'.$visit_id.'-01';
	        $tdb_number = 'PU-'.$visit_id.'-01';

	        $dtVisit = array(
	            'visit_id' => $visit_id,
	            'visit_rekmed'  => 0,
	            'visit_status'  => '3',
	            'visit_desc'	=> $data['visit_desc'],
	        );

	        $dtService = array(
	            'service_id' => $service_id,
	            'service_reference' => '',
	            'service_status' => '1',
	            'reference_notes' => '',
	            'bill_id' => $bill_id
	        );

	        $dtBill = array(
	            'bill_id' => $bill_id,
	            'bill_status' => '',
	            'bill_type' => '',
	            'total' => 0,
	        );

	        $dtPembelianUmum = array(
	        	'service_id'	=> $service_id,
	        	'tdb_number'	=> $tdb_number,
	        	'tdb_operator'	=> get_user('emp_id'),
	        	'tdb_note'		=> '-',
	        	'tdb_discount'	=> '0',
	        	'tdb_total'		=> '0',
	        );

	        $this->db->insert('trx_visit', $dtVisit);
	        $this->db->insert('trx_service', $dtService);
	        $this->db->insert('trx_bill', $dtBill);
	        $this->db->insert('trx_direct_buy', $dtPembelianUmum);
	        
		}else{
			$tdb_number = $data['tdb_number'];
			$bill_id 	= $data['bill_id'];
			$this->db->where('tdb_number',$data['mdc_id']);
			$this->db->delete('trx_direct_buy_detail');
		}

        if(!empty($data['medicine']['recipe_medicine']))
        {
            foreach ($data['medicine']['recipe_medicine'] as $key => $value) {
                if(!empty($value))
                {
                    $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $value));
                    if ($inv_item_master->num_rows() <= 0) {
                        $dtMedicine['im_id'] = '';
                        $dtMedicine['im_name'] = $value;
                        $dtMedicine['im_unit'] = '';
                        $dtMedicine['im_item_price'] = '0';
                        $dtMedicine['im_item_price_buy'] = '0';
                        $dtMedicine['im_item_price_package'] = '0';
                        $dtMedicine['im_status'] = '1';
                        $this->db->insert('inv_item_master', $dtMedicine);
                        $value = $this->db->insert_id();
                    }
                    $dataMedicine[] = array(
                        'tdb_number' => $tdb_number,
                        'tdb_item' => $value,
                        'tdb_rule' => $data['medicine']['use1'][$key]." X ".$data['medicine']['use2'][$key]." ".$data['medicine']['use3'][$key],
                        'tdb_note' => $data['medicine']['note'][$key],
                        'tdb_qty' => $data['medicine']['qty'][$key],
                        'tdb_price' => $data['medicine']['price'][$key],
                        'tdb_batch' => $data['medicine']['batch'][$key],
                    );
                    $inv_item_master = $inv_item_master->row();
                    $dataBill[] = array(
                        'bill_id'       =>$bill_id,
                        'service_type'  => 5,
                        'service_reference' => $tdb_number,
                        'service_name'  => $inv_item_master->im_name." qty : ".$data['medicine']['qty'][$key],
                        'price'         => $data['medicine']['price'][$key] * $data['medicine']['qty'][$key],
                        'paramedic_price' => 0,
                        'other_price'   => 0,
                        'total_price'   => $data['medicine']['price'][$key] * $data['medicine']['qty'][$key],
                        'payment_status'=> 0,
                    );
                }
            }
            if(count($dataMedicine) >= 1){
                $this->db->insert_batch('trx_direct_buy_detail',$dataMedicine);
            }
        }

        if(!empty($data['racikan']['racikan_name'])) // RACIKAN
		{
            foreach ($data['racikan']['racikan_name'] as $key => $value) {
                if(!empty($value))
                {
                    $racikan_id = $this->gen_id_racikan($service_id);
                    $dataRacikan = array(
                        'mdc_id' => $service_id,
                        'racikan_id' => $racikan_id,
                        'racikan_name' => $value,
                        'racikan_sediaan' => $data['racikan']['racikan_sediaan'][$key],
                        'racikan_tuslah_type' => $data['racikan']['racikan_tuslah_type'][$key],
                        'racikan_rule' => $data['racikan']['racikan_use1'][$key]." X ".$data['racikan']['racikan_use2'][$key]." ".$data['racikan']['racikan_use3'][$key],
                    );
                    $hargaRacikan = 0;
                    if(!empty($data['racikan_medicine']['racikan_medicine'][$key]))
                    {
                            $dataRacikanDetail = array();
                            foreach ($data['racikan_medicine']['racikan_medicine'][$key] as $k => $v) {
                                if(!empty($v))
                                {
                                    $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $v));
                                    if ($inv_item_master->num_rows() <= 0) {
                                        $dtMedicine['im_id'] = '';
                                        $dtMedicine['im_name'] = $v;
                                        $dtMedicine['im_unit'] = '';
                                        $dtMedicine['im_item_price'] = '0';
                                        $dtMedicine['im_item_price_buy'] = '0';
                                        $dtMedicine['im_item_price_package'] = '0';
                                        $dtMedicine['im_status'] = '1';
                                        $this->db->insert('inv_item_master', $dtMedicine);
                                        $v = $this->db->insert_id();
                                    }
                                    $dataRacikanDetail[] = array(
                                        'racikan_id' => $racikan_id,
                                        'racikan_medicine' => $v,
                                        'racikan_medicine_qty' => $data['racikan_medicine']['racikan_medicine_qty'][$key][$k],
                                        'racikan_medicine_price' => $data['racikan_medicine']['racikan_medicine_price'][$key][$k],
                                        'racikan_medicine_batch' => $data['racikan_medicine']['racikan_medicine_batch'][$key][$k],
                                    );
                                    $hargaRacikan += $data['racikan_medicine']['racikan_medicine_qty'][$key][$k] * $data['racikan_medicine']['racikan_medicine_price'][$key][$k];
                                }
                            }
                            if(count($dataRacikanDetail) >= 1)
                                $this->db->insert_batch('trx_racikan_detail',$dataRacikanDetail);
                    }
                    $this->db->insert('trx_racikan',$dataRacikan);
                    $dataBill[] = array(
                        'bill_id'       =>$bill_id,
                        'service_type'  => 5,
                        'service_reference' => $racikan_id,
                        'service_name'  => $value." ".$data['racikan']['racikan_use1'][$key]." X ".$data['racikan']['racikan_use2'][$key]." ".$data['racikan']['racikan_use3'][$key],
                        'price'         => $hargaRacikan,
                        'paramedic_price' => 0,
                        'other_price'   => 0,
                        'total_price'   => $hargaRacikan,
                        'payment_status'=> 0,
                    );
                }
            }
        }

        if( (isset($data['total_administrasi'])) && ($data['total_administrasi'] != null) )
        {
            $dataBill[] = array(
                'bill_id'       => $bill_id,
                'service_type'  => 10,
                'service_reference' => $tdb_number,
                'service_name'  => 'Tuslah dan Embalase',
                'price'         => (float) preg_replace('/[^0-9]/', '', $data['total_administrasi']),
                'paramedic_price' => 0,
                'other_price'   => 0,
                'total_price'   => (float) preg_replace('/[^0-9]/', '', $data['total_administrasi']),
                'payment_status'=> 0,
            );
        }

        if(isset($dataBill)){
            $this->simpan_bill($bill_id,$dataBill);
        }

        $this->db->trans_complete();

	}

	public function simpan_bill($bill_id,$dataBill)
    {
        $this->db->where(array('bill_id'=>$bill_id,'service_type'=>5,'payment_status'=>0));
        $this->db->delete('trx_bill_detail');

        $this->db->where(array('bill_id'=>$bill_id,'service_type'=>10,'payment_status'=>0));
        $this->db->delete('trx_bill_detail');

        $this->db->insert_batch('trx_bill_detail',$dataBill);
    }

	function getVisitID() {
        $ym = date('ym');
        $query = $this->db->like('visit_id', $ym, 'after')->order_by('visit_id', 'DESC')->get('trx_visit', 1, 0)->row();
        $visit_id = count($query) == 0 ? date('ym') . "0001" : $query->visit_id + 1;
        return $visit_id;
    }

	public function data_pembelian_umum()
	{
		$data['main_view']	= 'pembelian_umum/index';
		$data['title']		= 'Pembelian Umum';
		$data['cf']			=  $this->cf;
		$this->db->select('*');
		$this->db->where('tv.visit_status >=','4');
		$this->db->join('trx_visit tv','tv.visit_id = tdb.visit_id');
		$this->db->join('mst_employer me','me.id_employe = tdb.tdb_operator','left');
		// $this->db->join('trx_visit_bill tvb','tvb.visit_id = tv.visit_id');
		$data['pembelian_umum']	= $this->db->get('trx_direct_buy tdb');
		$this->load->view('template',$data);
	}

	public function select($visit_id,$tdb_number)
	{
		$data['main_view']	= 'pembelian_umum/add_pembelian_umum';
		$data['title']		= 'Pembelian Umum';
		$data['cf']			= $this->cf;
		$data['tdb_number']	= $tdb_number;
		$data['visit_id']	= $visit_id;
		$data['bill_id']	= 'BL-'.$visit_id.'-01';

		$data['visit']		= $this->db->get_where('trx_visit',array('visit_id'=>$visit_id))->row();

		$this->db->select('SUM(iis.istok_qty) as istok_qty,im.*');
        $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
        $this->db->group_by('im.im_id');
        $data['medicine'] = $this->db->get('inv_item_master im');
        $data['racikan_fee'] = $this->db->get('mst_racikan_fee');
        
        $this->db->_protect_identifiers=false;
        $this->db->join('trx_visit tv','tv.visit_id = substr(tdbd.tdb_number,4,8)');
        $this->db->join('inv_item_master im','im.im_id = tdbd.tdb_item');
        $this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
        $this->db->where('tv.visit_id',$visit_id);
        $data['pembelian_umum_medicine']	= $this->db->get('trx_direct_buy_detail tdbd');

        $this->db->where('mdc_id',$tdb_number);
        $this->db->join('mst_racikan_fee mrf','mrf.id = tr.racikan_tuslah_type');
        $data['racikan_medicine'] = $this->db->get('trx_racikan tr');
        if($data['racikan_medicine']->num_rows() >= 1)
        {
            foreach ($data['racikan_medicine']->result() as $key => $value) {
                $this->db->join('inv_item_master im','trd.racikan_medicine = im.im_id');
                $this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
                $this->db->where('racikan_id',$value->racikan_id);
                $detail = $this->db->get('trx_racikan_detail trd');
                $data['racikan_medicine_detail'][$value->racikan_id] = $detail->result();
            }
        }

        $status_bayar_resep = $this->db->get_where('trx_bill_detail', array('bill_id' => "BL-".substr($tdb_number,3), 'service_type' => 5, 'payment_status' => 1));
        $data['status_bayar_resep'] = $status_bayar_resep->num_rows() >= 1 ? 1 : 0;
		$this->load->view('template',$data);
	}

	public function cetak($visit_id,$tdb_number)
	{
		$data['main_view'] = 'apotek/pembelian_umum/cetak_pembelian_umum';
        $data['title'] = 'Pembelian Umum';
        $data['cf'] = $this->cf;

		$data['tdb_number']	= $tdb_number;
		$data['visit_id']	= $visit_id;

        $this->db->_protect_identifiers=false;
        $this->db->join('trx_visit tv','tv.visit_id = substr(tdbd.tdb_number,4,8)');
        $this->db->join('inv_item_master im','im.im_id = tdbd.tdb_item');
        $this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
        $this->db->where('tv.visit_id',$visit_id);
        $data['pembelian_umum_medicine']	= $this->db->get('trx_direct_buy_detail tdbd');

        $this->db->_protect_identifiers=false;
        $this->db->join('trx_visit tv','tv.visit_id = substr(tr.racikan_id, 4,8)');
        $this->db->join('mst_racikan_fee mrf','mrf.id = tr.racikan_tuslah_type');
        $this->db->where('substr(tr.racikan_id,4,8)', $visit_id);
        $data['racikan'] = $this->db->get('trx_racikan tr');
		
        $this->load->view('apotek/pembelian_umum/cetak_pembelian_umum', $data);
	}

	function gen_id_racikan($mdc_id) {
        $service_type = substr($mdc_id,0,2);
        $mdc_id = $service_type == "RN" ? substr($mdc_id, 3,14) : substr($mdc_id, 3,11);
        $format = 'RC-'.$mdc_id;
        if($service_type == "RN"){
            $q = $this->db->query("SELECT substr(racikan_id, 19, 2) as n
              from trx_racikan where racikan_id like '$format%' order by n desc limit 1");
        }else{
            $q = $this->db->query("SELECT substr(racikan_id, 16, 2) as n
              from trx_racikan where racikan_id like '$format%' order by n desc limit 1");
        }

        if ($q->num_rows() == 0) {
            $no = '01';
        } else {
            $nl = intval(db_conv($q)->n);
            $nl++;
            $no = rtrim(sprintf("%'02s\n", $nl));
        }
        return $format ."-". $no;
    }

	// public function simpan_pembelian_langsung()
	// {
	// 	$dataPost 	= $this->input->post();
	// 	// insert to trx visit
	// 	$visit_id 	= $this->gen_visit_id();
	// 	$tdb_number 	= $visit_id;
	// 	$data 	= array(
	// 		'visit_id'	=> $visit_id,
	// 		'visit_rekmed'	=> $tdb_number,
	// 		'visit_type'	=> 'pembelian umum',
	// 		'visit_in'		=> date('Y-m-d H:i:s'),
	// 		'visit_status'	=> 3
	// 	);
	// 	$this->db->insert('trx_visit',$data);

	// 	// insert to trx direct buy
	// 	$data 	= array(
	// 		'visit_id' 	=> $visit_id,
	// 		'tdb_number'=> 'PU-'.$tdb_number,
	// 		'tdb_operator'	=> get_user('emp_id'),
	// 		'tdb_discount'	=> $dataPost['discount'],
	// 		'tdb_total'	=> $dataPost['grand'],
	// 	);
	// 	$this->db->insert('trx_direct_buy',$data);
		
	// 	$detail = $this->input->post();
	// 	$total_price 	= 0;
	// 	foreach($detail['rows'] as $r){
	// 		$dt = explode('|',$r);
	// 		$data = array(
	// 			'tdb_number'	=> 'PU-'.$tdb_number,
	// 			'tdb_item'		=> $dt[0],
	// 			'tdb_qty'		=> $dt[1],
	// 			'tdb_price_per_unit'	=> $dt[2],
	// 			'tdb_price'		=> $dt[1] * $dt[2],
	// 		);
	// 		// insert to trx direct buy detail
	// 		$this->db->insert('trx_direct_buy_detail', $data);
	// 		// insert to trx visit bill detail
	// 		$data = array(
	// 			'visit_id'	=> $visit_id,
	// 			'service_id'	=> '4',
	// 			'service_name'		=> ($dt[3]." ".$dt[1]." ".$dt[4]),
	// 			'price'		=> $dt[2],
	// 			'paramedic_price'	=> 0,
	// 			'other_price'	=> 0,
	// 			'total_price'	=> $dt[1] * $dt[2],
	// 			'cashier_id'	=> '',
	// 			'payment_status'=> '0',
	// 		);
	// 		$this->db->insert('trx_visit_bill',$data);
	// 		$total_price += ($dt[1] * $dt[2]);
	// 	}
	// }

	// public function gen_visit_id()
	// {

 //        $ym = date('ym');
 //        $queryVisit = $this->db->like('visit_id', $ym, 'after')->order_by('visit_id', 'DESC')->get('trx_visit', 1, 0)->row();
 //        $visit_id = count($queryVisit) == 0 ? date('ym') . "0001" : $queryVisit->visit_id + 1;
 //        return $visit_id;
	// }

	// function select($visit_id){
	// 	$data['main_view']	= 'apotek/pembelian_umum/detail_pembelian';

	// 	$this->db->select('*');
	// 	$this->db->where('tv.visit_id',$visit_id);
	// 	$this->db->join('trx_direct_buy tdb','tdb.visit_id = tv.visit_id');
	// 	$pembelian	= $this->db->get('trx_visit tv');
	// 	$data['pembelian']	= $pembelian->row();
	// 	$data['pembelian_detail']	= array();
	// 	foreach ($pembelian->result() as $key => $value) {
	// 		$this->db->where('tdb_number',$value->tdb_number);
	// 		$this->db->join('inv_item_master im','tdbd.tdb_item = im.im_id');
	// 		$this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id');
	// 		$pembelian_detail = $this->db->get('trx_direct_buy_detail tdbd')->result();
	// 		$data['pembelian_detail']	= array_merge($data['pembelian_detail'],$pembelian_detail);
	// 	}

	// 	$data['title']		= 'Resep Pasien';
	// 	$data['cf']			=  $this->cf;
	// 	$this->load->view('template',$data);
	// }

	// function simpan($tdb_number){
	// 	$data = $this->input->post('ds');
	// 	$visit_id = $data['visit_id'];

	// 	//detail
	// 	$this->db->where('tdb_number',$tdb_number);
	// 	$detail 	= $this->db->get('trx_direct_buy_detail');
	// 	if( $detail->num_rows() >= 1 )
	// 	{
	// 		foreach ($detail->result() as $key => $value) {
	// 			$this->updateStok($value->tdb_item,$value->tdb_qty);
	// 		}
	// 	}

	// 	$dt_stat['visit_status'] = 5;
	// 	$this->db->where('visit_id',$visit_id);
	// 	$this->db->update('trx_visit',$dt_stat);
	// }

	// public function updateStok($istok_item,$returQty){
	// 	$this->db->where('istok_qty >','0');
	// 	$this->db->where('istok_item',$istok_item);
	// 	$this->db->order_by('istok_exp','asc');
	// 	$stok 		= $this->db->get('inv_item_stok')->row();
	// 	$oldStokId 	= $stok->istok_id;
	// 	$oldStok 	= $stok->istok_qty;
	// 	if( $returQty > $oldStok ){
	// 		$returQty 	= $returQty - $oldStok;
	// 		$dtUpdateStok['istok_qty'] 	= 0;
	// 		$this->db->where('istok_id',$oldStokId);
	// 		$this->db->update('inv_item_stok',$dtUpdateStok);
	// 		$this->updateStok($istok_item,$returQty);
	// 	}else{
	// 		$newStok 	= $oldStok - $returQty;
	// 		$dtUpdateStok['istok_qty'] 	= $newStok;
	// 		$this->db->where('istok_id',$oldStokId);
	// 		$this->db->update('inv_item_stok',$dtUpdateStok);
	// 	}
	// }
} // end class