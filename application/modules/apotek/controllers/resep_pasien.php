<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resep_pasien extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['main_view'] = 'resep_pasien/index';
        $data['title'] = 'Resep Pasien';

        $sql = "SELECT psd.sd_rekmed,psd.sd_name,psd.sd_address,tr.recipe_id,sc.name AS service_type,ts.service_in AS datetime, ts.service_status AS service_status, ts.service_id
                FROM trx_service ts
                join trx_visit tv ON tv.visit_id = substr(ts.service_id,4,8)
                left join trx_recipe tr ON tr.mdc_id = ts.service_id
                join ptn_social_data psd ON psd.sd_rekmed = tv.visit_rekmed
                left join sys_code sc ON sc.id = substr(ts.service_id,1,2)
                WHERE ts.service_status IN ('2','3','4') AND substr(ts.service_id,1,2) = 'RJ'
                UNION ALL
                SELECT psd.sd_rekmed,psd.sd_name,psd.sd_address,tr.recipe_id,sc.name AS service_type,he.datetime, ts.service_status AS service_status, ts.service_id
                FROM trx_service ts
                join trx_visit tv ON tv.visit_id = substr(ts.service_id,4,8)
                join hos_examination he ON substr(he.examination_id,1,14) = ts.service_id
                join trx_recipe tr ON tr.mdc_id = he.examination_id
                join hos_prescription hp ON hp.prescription_id = tr.recipe_id
                join ptn_social_data psd ON psd.sd_rekmed = tv.visit_rekmed
                left join sys_code sc ON sc.id = substr(ts.service_id,1,2)
                WHERE hp.status = 0 AND substr(ts.service_id,1,2) = 'RN'";
        $data['resep_pasien'] = $this->db->query($sql)->result_array();
        $data['cf'] = $this->cf;
        $this->load->view('template', $data);
    }

    function select($recipe_id,$mdc_id,$status_bayar_resep = null) {
        $recipe     = $this->db->get_where('trx_recipe',array('recipe_id'=>$recipe_id));
        if($recipe->num_rows() <= 0)
        {
            $dtRecipe['recipe_id']  = $recipe_id;
            $dtRecipe['mdc_id']     = $mdc_id; 
            $this->db->insert('trx_recipe',$dtRecipe);
        }
        $service_type = substr($mdc_id,0,2);

        $this->db->_protect_identifiers=false;
        $this->db->join('trx_recipe_detail trd','tr.recipe_id = trd.recipe_id');
        $this->db->join('inv_item_master im','trd.recipe_medicine = im.im_id');
        $this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
        $this->db->where('tr.recipe_id',$recipe_id);
        $data['resep_medicine'] = $this->db->get('trx_recipe tr');

        if ($service_type == 'RJ') {
            $this->db->select('tv.visit_id,tv.visit_out,tv.visit_status,substr(ts.service_id,1,2) as service_type,'
                    . 'tpn.ptn_medical_weight,tpn.ptn_medical_height,tpn.ptn_medical_blod_sy,tpn.ptn_medical_blod_ds,'
                    . 'p.sd_rekmed,p.sd_name,p.sd_sex,p.sd_age,p.sd_blood_tp,p.sd_address,tr.recipe_id,ts.service_id, me.sd_name as dr_name');
            $this->db->join('trx_service ts','tv.visit_id = substr(ts.service_id,4,8)');
            $this->db->join('ptn_social_data p','p.sd_rekmed = tv.visit_rekmed');
            $this->db->join('trx_medical_ptn_now tpn', 'tpn.mdc_id = ts.service_id');
            $this->db->join('trx_recipe tr', 'tr.mdc_id = ts.service_id');
            $this->db->join('trx_medical tm', 'tm.mdc_id = ts.service_id','left');
            $this->db->join('mst_employer me', 'tm.dr_id = me.id_employe','left');
            $this->db->where('tr.recipe_id', $recipe_id);
            $data['data_pasien']    = $this->db->get('trx_visit tv')->row();

            // $this->db->join('trx_racikan_detail trd','trd.racikan_id = tr.racikan_id');
            $this->db->where('mdc_id',$mdc_id);
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
        } elseif ($service_type == 'RN') {
            $this->db->select('tpn.ptn_medical_weight,tpn.ptn_medical_height,tpn.ptn_medical_blod_sy,tpn.ptn_medical_blod_ds,'
                    . 'p.sd_rekmed,p.sd_name,p.sd_sex,p.sd_age,p.sd_blood_tp');
            $this->db->join('trx_medical_ptn_now tpn', 'tpn.mdc_id = SUBSTRING(REPLACE(tr.recipe_id,"RS","RN"),1,17)','left');
            $this->db->join('trx_visit tv', 'tv.visit_id = SUBSTR(tr.recipe_id,4,8)');
            $this->db->join('ptn_social_data p', 'p.sd_rekmed = tv.visit_rekmed');
            $this->db->where('tr.recipe_id', $recipe_id);
            $data['data_pasien'] = $this->db->get('trx_recipe tr')->row();

            $this->db->where('mdc_id',$mdc_id);
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
        }

        if($status_bayar_resep == null){
            $status_bayar_resep = $this->db->get_where('trx_bill_detail', array('bill_id' => "BL-".substr($mdc_id,3), 'service_type' => 5, 'payment_status' => 1));
            $data['status_bayar_resep'] = $status_bayar_resep->num_rows() >= 1 ? 1 : 0;
        }else{
            $data['status_bayar_resep'] = 5; // Lunas
        }

        $this->db->select('SUM(iis.istok_qty) as istok_qty,im.*');
        $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
        $this->db->group_by('im.im_id');
        $data['medicine'] = $this->db->get('inv_item_master im');
        $data['racikan_fee'] = $this->db->get('mst_racikan_fee');
        $data['recipe_id'] = $recipe_id;
        $data['main_view'] = 'apotek/resep_pasien/detail';
        $data['mdc_id'] = $mdc_id;
        $data['title'] = 'Resep Pasien';
        $data['cf'] = $this->cf;

        $this->load->view('template', $data);
    }

    function getMedicine() {
        $this->db->select('SUM(iis.istok_qty) as istok_qty,im.im_name,im.im_id');
        $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
        // $this->db->where('istok_qty >','0');
        $this->db->where('im.im_status =','1');
        $this->db->group_by('im.im_id');
        $data['medicine'] = $this->db->get('inv_item_master im')->result();
        echo json_encode($data['medicine']);
    }

    function getMedicineAjax() {
        $term = $this->input->post('term');
        $this->db->select('SUM(iis.istok_qty) as istok_qty,im.im_name,im.im_id');
        $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
        // $this->db->where('istok_qty >','0');
        $this->db->where('im.im_status =','1');
        $this->db->like('im.im_name',$term);
        $this->db->group_by('im.im_id');
        $data['medicine'] = $this->db->get('inv_item_master im')->result();
        echo json_encode($data['medicine']);
    }

    function getMedicineDetail($im_id) {
        $this->db->select('SUM(iis.istok_qty) as istok_qty,im.im_name,im.im_id,im.im_item_price,im.im_item_price_buy,mti.mtype_name,max(iis.istok_item_price) as istok_item_price,mki.kel_name, iis.istok_batch');
        $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
        $this->db->join('mst_type_inv mti', 'im.im_unit = mti.mtype_id', 'left');
        $this->db->join('mst_kelompok_inv mki', 'mki.kel_id = im.im_kelompok', 'left');
        $this->db->where(array('im.im_id'=>$im_id,'iis.istok_qty >'=>'0','im.im_status ='=>'1'));
        $this->db->group_by('im.im_id');
        $data['medicine'] = $this->db->get('inv_item_master im');
        if($data['medicine']->num_rows() >= 1)
            $data['medicine'] = $data['medicine']->row();
        else{
            $this->db->select('SUM(iis.istok_qty) as istok_qty,im.im_name,im.im_id,im.im_item_price,im.im_item_price_buy,mti.mtype_name,max(iis.istok_item_price) as istok_item_price,mki.kel_name');
            $this->db->join('inv_item_stok iis', 'im.im_id = iis.istok_item', 'left');
            $this->db->join('mst_type_inv mti', 'im.im_unit = mti.mtype_id', 'left');
            $this->db->join('mst_kelompok_inv mki', 'mki.kel_id = im.im_kelompok', 'left');
            $this->db->where(array('im.im_id'=>$im_id,'im.im_status ='=>'1'));
            $this->db->group_by('im.im_id');
            $data['medicine'] = $this->db->get('inv_item_master im')->row();
        }
        echo json_encode($data['medicine']);
    }

    function getTuslahType($id) {
        $this->db->where('mrf.id',$id);
        $data['tuslah'] = $this->db->get('mst_racikan_fee mrf')->row();
        echo json_encode($data['tuslah']);
    }

    public function simpanAll()
    {
        $data = $this->input->post();
        // debug_array($data);
        $mdc_id = $data['mdc_id'];
        $recipe_id = $data['recipe_id'];
        $bill_id = "BL-".substr($mdc_id,3);

        $this->db->trans_start();

        $this->db->where('recipe_id',$recipe_id);
        $this->db->delete('trx_recipe_detail');

        $this->db->where('mdc_id',$mdc_id);
        $this->db->delete('trx_racikan');

        $this->db->where('substr(racikan_id,4,8)',substr($mdc_id, 3,8));
        $this->db->delete('trx_racikan_detail');

        if(!empty($data['medicine']['recipe_medicine']))
        {
            foreach ($data['medicine']['recipe_medicine'] as $key => $value) {
                if(!empty($value))
                {   
                    $this->db->join('inv_item_stok iis','iis.istok_item = im.im_id','left');
                    $this->db->where(array('im.im_id'=>$value));
                    $this->db->order_by('istok_exp', 'asc');
                    $inv_item_master = $this->db->get('inv_item_master im');
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
                        'recipe_id' => $recipe_id,
                        'recipe_medicine' => $value,
                        'recipe_rule' => $data['medicine']['use1'][$key]." X ".$data['medicine']['use2'][$key]." ".$data['medicine']['use3'][$key],
                        'recipe_note' => $data['medicine']['note'][$key],
                        'recipe_qty' => $data['medicine']['qty'][$key],
                        'recipe_price'  => $data['medicine']['price'][$key],
                        'recipe_batch'  => $data['medicine']['batch'][$key],
                    );
                    $inv_item_master = $inv_item_master->row();
                    $dataBill[] = array(
                        'bill_id'       =>$bill_id,
                        'service_type'  => 5,
                        'service_reference' => $recipe_id,
                        'service_name'  => $inv_item_master->im_name." qty : ".$data['medicine']['qty'][$key],
                        'price'         => $data['medicine']['price'][$key] * $data['medicine']['qty'][$key],
                        'paramedic_price' => 0,
                        'other_price'   => 0,
                        'total_price'   => $data['medicine']['price'][$key] * $data['medicine']['qty'][$key],
                        'payment_status'=> 0,
                    );
                }
            }
            if(count($dataMedicine) >= 1)
                $this->db->insert_batch('trx_recipe_detail',$dataMedicine);
        }

        if(!empty($data['racikan']['racikan_name']))
        {
            foreach ($data['racikan']['racikan_name'] as $key => $value) {
                if(!empty($value))
                {
                    $racikan_id = $this->gen_id_racikan($mdc_id);
                    $dataRacikan = array(
                        'mdc_id' => $mdc_id,
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

                    $service_type = substr($mdc_id,0,2);
                    if($service_type == "RN"){
                        $this->db->insert('hos_prescription',array('prescription_id' => $racikan_id,'status' => 1));
                    }
                }
            }
        }
        if( (isset($data['total_administrasi'])) && ($data['total_administrasi'] != null) )
        {
            $dataBill[] = array(
                'bill_id'       => $bill_id,
                'service_type'  => 10,
                'service_reference' => '',
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

        $service_type = substr($mdc_id,0,2);
        if($service_type == 'RJ')
        {
            $dataService['service_status'] = 3;
            $this->db->where('service_id',$mdc_id);
            $this->db->update('trx_service',$dataService);
        }else if($service_type == 'PU')
        {
            $dataService['service_status'] = 5;
            $this->db->where('service_id',$mdc_id);
            $this->db->update('trx_service',$dataService);
        }

        $this->db->trans_complete();
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

    public function simpan_bill($bill_id,$dataBill)
    {
        $this->db->where(array('bill_id'=>$bill_id,'service_type'=>5,'payment_status'=>0));
        $this->db->delete('trx_bill_detail');

        $this->db->where(array('bill_id'=>$bill_id,'service_type'=>10,'payment_status'=>0));
        $this->db->delete('trx_bill_detail');

        $this->db->insert_batch('trx_bill_detail',$dataBill);
    }

    public function kurangi_stok()
    {
        $data   = $this->input->post();
        $mdc_id = $data['mdc_id'];
        $recipe_id = $data['recipe_id'];

        $service_type = substr($mdc_id,0,2);
        if( ($service_type == "RN") || ($service_type == "IG") ){
            $this->simpanAll();
        }

        $this->db->trans_start();
        if(!empty($data['medicine']['recipe_medicine']))
        {
            foreach ($data['medicine']['recipe_medicine'] as $key => $value) {
                if(!empty($value))
                {
                    $this->updateStok($value,$data['medicine']['qty'][$key]);
                    // $batch = null;
                    // $batch = $this->updateStok($value,$data['medicine']['qty'][$key],$batch);
                    // if(!empty($batch))
                    // {
                    //     if($service_type == 'PU'){
                    //         $dataBathc = array();
                    //         $dataBathc['tdb_batch'] = $batch;
                    //         $this->db->where(array('tdb_item'=>$value,'tdb_number'=>$recipe_id));
                    //         $this->db->update('trx_direct_buy_detail',$dataBathc);
                    //     }else{
                    //         $dataBathc = array();
                    //         $dataBathc['recipe_batch'] = $batch;
                    //         $this->db->where(array('recipe_medicine'=>$value,'recipe_id'=>$recipe_id));
                    //         $this->db->update('trx_recipe_detail',$dataBathc);
                    //     }
                    // }
                }
            }
        }

        if(!empty($data['racikan']['racikan_name']))
        {
            foreach ($data['racikan']['racikan_name'] as $key => $value) {
                if(!empty($value))
                {
                    if(!empty($data['racikan_medicine']['racikan_medicine'][$key]))
                    {
                        $dataRacikanDetail = array();
                        foreach ($data['racikan_medicine']['racikan_medicine'][$key] as $k => $v) {
                            if(!empty($v))
                            {
                                $this->updateStok($v,$data['racikan_medicine']['racikan_medicine_qty'][$key][$k]);
                                // $batch = null;
                                // $batch = $this->updateStok($v,$data['racikan_medicine']['racikan_medicine_qty'][$key][$k],$batch);
                                // if(!empty($batch))
                                // {
                                //     $dataBathc = array();
                                //     $dataBathc['racikan_medicine_batch'] = $batch;
                                //     $this->db->where(array('racikan_medicine'=>$v,'racikan_id'=>$data['racikan']['racikan_id'][$key]));
                                //     $this->db->update('trx_racikan_detail',$dataBathc);
                                // }
                            }
                        }
                    }
                }
            }
        }

        if($service_type == 'RJ')
        {
            $dataService['service_status'] = 5;
            $this->db->where('service_id',$mdc_id);
            $this->db->update('trx_service',$dataService);

            $dataVisit['visit_out'] = date('Y-m-d H:i:s');
            $this->db->where('visit_id',substr($mdc_id,3,8));
            $this->db->update('trx_visit',$dataVisit);
        }else if($service_type == 'RN'){
            $this->db->where('prescription_id', $recipe_id);
            $this->db->update('hos_prescription', array('status' => 1));
        }else if($service_type == 'PU')
        {
            $dataService['service_status'] = 5;
            $this->db->where('service_id',$mdc_id);
            $this->db->update('trx_service',$dataService);

            $dataVisit['visit_out'] = date('Y-m-d H:i:s');
            $dataVisit['visit_status'] = 5;
            $this->db->where('visit_id',substr($mdc_id,3,8));
            $this->db->update('trx_visit',$dataVisit);
        }
        $this->db->trans_complete();
    }

    public function batalBuatResep()
    {
        $data = $this->input->post();
        $data   = $this->input->post();
        $mdc_id = $data['service_id'];
        $recipe_id = $data['recipe_id'];
        $service_type = substr($mdc_id,0,2);

        if($service_type == 'RJ')
        {
            $dataService['service_status'] = 5;
            $this->db->where('service_id',$mdc_id);
            $this->db->update('trx_service',$dataService);
        }else if($service_type == 'RN'){
            $this->db->where('prescription_id', $recipe_id);
            $this->db->update('hos_prescription', array('status' => 1));
        }else if($service_type == 'PU')
        {
            $dataService['service_status'] = 5;
            $this->db->where('service_id',$mdc_id);
            $this->db->update('trx_service',$dataService);
        }
    }

    public function updateStok($istok_item, $returQty, $batch = null) {
        $this->db->where('istok_qty >', '0');
        $this->db->where('istok_item', $istok_item);
        $this->db->order_by('istok_exp', 'asc');
        $stok = $this->db->get('inv_item_stok');
        if ($stok->num_rows() >= 1) {
            $stok = $stok->row();
            // $batch .= $stok->istok_batch;
            $oldStokId = $stok->istok_id;
            $oldStok = $stok->istok_qty;
            if ($returQty > $oldStok) {
                $returQty = $returQty - $oldStok;
                $dtUpdateStok['istok_qty'] = 0;
                $this->db->where('istok_id', $oldStokId);
                $this->db->update('inv_item_stok', $dtUpdateStok);
                $this->updateStok($istok_item, $returQty);
            } else {
                if($batch != null) // kiriman dari pembatalan layanan
                {
                    $newStok = $oldStok - $returQty;
                    $dtUpdateStok['istok_qty'] = $newStok;
                    $this->db->where(array('istok_id'=> $oldStokId,'istok_batch'=>$batch));
                    $this->db->update('inv_item_stok', $dtUpdateStok);
                }else{
                    $newStok = $oldStok - $returQty;
                    $dtUpdateStok['istok_qty'] = $newStok;
                    $this->db->where('istok_id', $oldStokId);
                    $this->db->update('inv_item_stok', $dtUpdateStok);
                }
            }
        } else {
            // jika tidak ada di stok maka insert dengan value stok minus
            $dtstok = array(
                'faktur_id' => $this->get_faktur_id(),
                'istok_item' => $istok_item,
                'istok_qty' => (0 - $returQty),
                'istok_item_price' => 0,
                'istok_exp' => '',
                'istok_batch' => '',
            );
            $this->db->insert('inv_item_stok', $dtstok);
        }
        // return $batch;
    }

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

    public function riwayat_resep() {
        $data['main_view'] = 'resep_pasien/riwayat_resep';
        $data['title'] = 'Riwayat Resep Pasien';

        $this->db->join('trx_service ts','ts.service_id = tr.mdc_id');
        $this->db->join('trx_visit tv','tv.visit_id = substr(ts.service_id, 4,8)');
        $this->db->join('ptn_social_data psd','psd.sd_rekmed = tv.visit_rekmed');
        $this->db->where('ts.service_status','5');
        $data['resep_pasien']       = $this->db->get('trx_recipe tr');
        $data['cf'] = $this->cf;
        $this->load->view('template', $data);
    }

    function cetak_resep($recipe_id) {
        // $data['main_view'] = 'apotek/resep_pasien/detail_resep';
        $data['title'] = 'Resep Pasien';
        $data['cf'] = $this->cf;

        $this->db->_protect_identifiers=false;
        $this->db->select('psd.*,tm.*,tv.*,me.sd_name as dr_name,tpn.*');
        $this->db->join('trx_visit tv','tv.visit_rekmed = psd.sd_rekmed');
        $this->db->join('trx_medical tm', 'substr(tm.mdc_id, 4,8) = tv.visit_id', 'left');
        $this->db->join('mst_employer me', 'me.id_employe = tm.dr_id', 'left');
        $this->db->join('trx_medical_ptn_now tpn', 'substr(tpn.mdc_id, 4,8) = tv.visit_id');
        $this->db->where('tv.visit_id',substr($recipe_id, 3,8));
        $data['data_pasien']    = $this->db->get('ptn_social_data psd')->row();

        $this->db->join('trx_recipe_detail trd','trd.recipe_id = tr.recipe_id');
        $this->db->join('inv_item_master im','im.im_id = trd.recipe_medicine');
        $this->db->join('mst_type_inv mti','im.im_unit = mti.mtype_id','left');
        $this->db->where('tr.recipe_id',$recipe_id);
        $data['resep_pasien']   = $this->db->get('trx_recipe tr');

        $this->db->_protect_identifiers=false;
        $this->db->join('trx_visit tv','tv.visit_id = substr(tr.racikan_id, 4,8)');
        $this->db->join('mst_racikan_fee mrf','mrf.id = tr.racikan_tuslah_type');
        $this->db->where('substr(tr.racikan_id,4,8)', (substr($recipe_id,3,8)));
        $data['racikan'] = $this->db->get('trx_racikan tr');

        $this->load->view('apotek/resep_pasien/cetak_resep', $data);
    }

    // function loaddata($recipe_id) {
    //     $this->db->select('tr.mdc_id,tr.recipe_id,tr.recipe_paramedic_price,trd.recipe_medicine,trd.recipe_rule,trd.recipe_qty,trd.recipe_note,im.im_unit,im.im_name,im.im_item_price,mti.mtype_name');
    //     $this->db->join('trx_recipe_detail trd', 'tr.recipe_id = trd.recipe_id');
    //     $this->db->join('inv_item_master im', 'im.im_id = trd.recipe_medicine');
    //     $this->db->join('mst_type_inv mti', 'im.im_unit = mti.mtype_id', 'left');
    //     $this->db->where(array('tr.recipe_id' => $recipe_id));
    //     $data['resep_pasien'] = $this->db->get('trx_recipe tr');

    //     $mdc_id = $this->db->get_where('trx_recipe', array('recipe_id' => $recipe_id))->row()->mdc_id;
    //     $status_bayar_resep = $this->db->get_where('trx_bill_detail', array('bill_id' => "BL-".substr($mdc_id,3), 'service_type' => 5, 'payment_status' => 1));
    //     $data['status_bayar_resep'] = $status_bayar_resep->num_rows() >= 1 ? 1 : 0;
    //     $data['mdc_id'] = $mdc_id;
    //     $data['recipe_id'] = $recipe_id;

    //     $this->load->view('apotek/resep_pasien/data', $data);
    // }

//     function update($mdc_id, $recipe_medicine) {
//         $data = $this->input->post('ds');
//         $new_recipe_medicine = $data['recipe_medicine'];
//         $recipe_medicine_name = $data['recipe_medicine_name'];
//         $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $new_recipe_medicine));
//         if ($inv_item_master->num_rows() <= 0) {
//             $dtMedicine['im_id'] = $new_recipe_medicine;
//             $dtMedicine['im_name'] = $recipe_medicine_name;
//             $dtMedicine['im_unit'] = '';
//             $dtMedicine['im_item_price'] = '0';
//             $dtMedicine['im_item_price_buy'] = '0';
//             $dtMedicine['im_item_price_package'] = '0';
//             $dtMedicine['im_status'] = '1';
//             $this->db->insert('inv_item_master', $dtMedicine);
//             $data['recipe_medicine'] = $this->db->insert_id();
//         }
//         unset($data['recipe_medicine_name']);
//         $this->db->where(array('mdc_id' => $mdc_id, 'recipe_medicine' => $recipe_medicine));
//         $this->db->update('trx_recipe_detail', $data);
//     }
//     function delete_list($mdc_id, $recipe_medicine) {
//         $this->db->where(array('mdc_id' => $mdc_id, 'recipe_medicine' => $recipe_medicine));
//         $this->db->delete('trx_recipe_detail');
//     }

//     function insert() {
//         $data = $this->input->post('ds');
//         $recipe_medicine = $data['recipe_medicine'];
//         $recipe_medicine_name = $data['recipe_medicine_name'];
//         $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $recipe_medicine));
//         if ($inv_item_master->num_rows() <= 0) {
//             $dtMedicine['im_id'] = $recipe_medicine;
//             $dtMedicine['im_name'] = $recipe_medicine_name;
//             $dtMedicine['im_unit'] = '';
//             $dtMedicine['im_item_price'] = '0';
//             $dtMedicine['im_item_price_buy'] = '0';
//             $dtMedicine['im_item_price_package'] = '0';
//             $dtMedicine['im_status'] = '1';
//             $this->db->insert('inv_item_master', $dtMedicine);
//             $data['recipe_medicine'] = $this->db->insert_id();
//         }
//         $medicineExist = $this->db->get_where('trx_recipe_detail', array('recipe_id' => $data['recipe_id'], 'recipe_medicine' => $data['recipe_medicine']));
//         if ($medicineExist->num_rows() <= 0) {
//             unset($data['recipe_medicine_name']);
//             $this->db->insert('trx_recipe_detail', $data);
//         }
//     }

//     public function simpan_all(){
//         $data = $this->input->post();
//         if( (! empty($data['mdc_id'])) && (! empty($data['recipe_id'])) )
//         {
//             if(isset($data['medicine']['recipe_medicine']))
//             {
//                 foreach ($data['medicine']['recipe_medicine'] as $key => $value) {
//                     if(!empty($data['medicine']['recipe_medicine'][$key]))
//                     {
//                         $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $value));
//                         if ($inv_item_master->num_rows() <= 0) {
//                             $dtMedicine['im_id'] = $value;
//                             $dtMedicine['im_name'] = $recipe_medicine_name;
//                             $dtMedicine['im_unit'] = '';
//                             $dtMedicine['im_item_price'] = '0';
//                             $dtMedicine['im_item_price_buy'] = '0';
//                             $dtMedicine['im_item_price_package'] = '0';
//                             $dtMedicine['im_status'] = '1';
//                             $this->db->insert('inv_item_master', $dtMedicine);
//                             $data['recipe_medicine'] = $this->db->insert_id();
//                         }else{
//                             $dtMedicine = array(
//                                 'mdc_id'    => $data['mdc_id'],
//                                 'recipe_id' => $data['recipe_id'],
//                                 'recipe_medicine'   => $value,
//                                 'recipe_rule'   => $data['medicine']['recipe_rule'][$key],
//                                 'recipe_note'   => $data['medicine']['recipe_note'][$key],
//                                 'recipe_qty'    => $data['medicine']['recipe_qty'][$key],
//                             );
//                             $this->db->insert('trx_recipe_detail', $dtMedicine);
//                         }
//                     }
//                 }
//             }
//             if(isset($data['racikan']['racikan_name']) && (!empty($data['racikan']['racikan_name'])))
//             {
//                 foreach ($data['racikan']['racikan_name'] as $key => $value) {
//                     $racikan_id = $this->gen_id_racikan();
//                     $dtRacikan = array(
//                         'mdc_id'    => $data['mdc_id'],
//                         'racikan_id'    => $racikan_id,
//                         'racikan_name'   => $data['racikan']['racikan_name'][$key],
//                         'racikan_sediaan'   => $data['racikan']['racikan_sediaan'][$key],
//                         'racikan_tuslah_type'   => $data['racikan']['racikan_tuslah_type'][$key],
//                         'racikan_rule'  => $data['racikan']['racikan_rule'][$key],
//                         'racikan_qty'   => $data['racikan']['racikan_qty'][$key],
//                     );
//                     $this->db->insert('trx_racikan', $dtRacikan);
//                     if(isset($data['racikanMedicine']['racikan_medicine'][$key]))
//                     {
//                         foreach ($data['racikanMedicine']['racikan_medicine'][$key] as $k => $v) {
//                             if(!empty($v))
//                             {
//                                 $dtRacikanDetail = array(
//                                     'racikan_id'    => $racikan_id,
//                                     'racikan_medicine'  => $v,
//                                     'racikan_medicine_qty'  => $data['racikanMedicine']['racikan_medicine_qty'][$key][$k],
//                                 );
//                                 $this->db->insert('trx_racikan_detail', $dtRacikanDetail);
//                                 $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $v))->row();
//                                 if(!empty($inv_item_master))
//                                 {
//                                     $this->updateTotalRacikan($racikan_id, $inv_item_master->im_item_price, $data['racikanMedicine']['racikan_medicine_qty'][$key][$k], 'add');
//                                 }
//                             }
//                         }
//                     }
//                     // $tuslaRacikan = $this->db->get_where('mst_racikan_fee', array('id' => $data['racikan']['racikan_tuslah_type'][$key]))->row();
//                     // $this->updateTotalRacikan($racikan_id, $tuslaRacikan->fee, 1, 'add');
//                 }
//             }
//         }
//         $this->kirim_kasir($data['recipe_id']);
//     }

//     function kirim_kasir($recipe_id) {
//         $mdc_id = $this->db->get_where('trx_recipe', array('recipe_id' => $recipe_id))->row()->mdc_id;
//         if (!empty($mdc_id)) {
//             $bill_id = "BL-".substr($mdc_id,3);
//             $this->db->where_in('service_type', array(5, 10));
//             $trx_visit_bill_status = $this->db->get_where('trx_bill_detail', array('bill_id' => $bill_id));
//             if ($trx_visit_bill_status->num_rows() >= 1) {
//                 $this->db->where(array('bill_id' => $bill_id));
//                 $this->db->where_in('service_type', array(5, 10));
//                 $this->db->delete('trx_bill_detail');
//             }
//             $this->db->select('tr.mdc_id,tr.recipe_id,trd.recipe_medicine,trd.recipe_note,trd.recipe_rule,trd.recipe_qty,im.im_unit,im.im_name,im.im_item_price,mti.mtype_name');
//             $this->db->where('tr.mdc_id', $mdc_id);
//             $this->db->join('trx_recipe_detail trd', 'trd.recipe_id = tr.recipe_id');
//             $this->db->join('inv_item_master im', 'trd.recipe_medicine = im.im_id');
//             $this->db->join('mst_type_inv mti', 'im.im_unit = mti.mtype_id', 'left');
//             $resep = $this->db->get('trx_recipe tr');

//             $tuslaResep = $this->db->get_where('mst_adm_fee', array('adm_id' => 10))->row();
//             $totalTuslaResep = 0;

//             $this->db->trans_start();
//             if ($resep->num_rows() >= 1) {
//                 $dt = array();
//                 foreach ($resep->result() as $key => $value) {
//                     $dt[] = array(
//                         'bill_id' => $bill_id,
//                         'service_type' => 5,
//                         'service_name' => $value->im_name . " " . $value->recipe_rule . " " . $value->recipe_qty . " " . $value->mtype_name,
//                         'price' => $value->im_item_price * $value->recipe_qty,
//                         'paramedic_price' => 0,
//                         'other_price' => 0,
//                         'total_price' => $value->im_item_price * $value->recipe_qty,
//                         'cashier_id' => '',
//                         'payment_status' => 0,
//                     );
//                     $totalTuslaResep += $tuslaResep->adm_fee;
//                 }
//                 if (!empty($dt)) {
//                     $this->db->insert_batch('trx_bill_detail', $dt);
//                 }
//             }

//             $this->db->join('mst_racikan_fee mrf', 'mrf.id = trx_racikan.racikan_tuslah_type', 'left');
//             $racikan = $this->db->get_where('trx_racikan', array('mdc_id' => $mdc_id));
//             $totalTuslaRacikan = 0;
//             if ($racikan->num_rows() >= 1) {
//                 $dt = array();
//                 foreach ($racikan->result() as $key => $value) {
//                     $dt[] = array(
//                         'bill_id' => $bill_id,
//                         'service_type' => 5,
//                         'service_name' => $value->racikan_name . " " . $value->racikan_rule,
//                         'price' => $value->racikan_total,
//                         'paramedic_price' => 0,
//                         'other_price' => 0,
//                         'total_price' => $value->racikan_total,
//                         'cashier_id' => '',
//                         'payment_status' => 0,
//                     );
//                     $totalTuslaRacikan += $value->fee;
//                     $detail_racikan = $this->db->get_where('trx_racikan_detail',array('racikan_id'=>$value->racikan_id));
//                     foreach ($detail_racikan->result() as $key => $value) {
//                         $totalTuslaResep += $tuslaResep->adm_fee;
//                     }
//                 }
//                 if (!empty($dt)) {
//                     $this->db->insert_batch('trx_bill_detail', $dt);
//                 }
//             }
//             $totalTusla = $totalTuslaRacikan + $totalTuslaResep;
//             if ($totalTusla > 0) {
//                 $dt = array(
//                     'bill_id' => $bill_id,
//                     'service_type' => 10,
//                     'service_name' => 'Biaya Administrasi Resep',
//                     'price' => $totalTusla,
//                     'paramedic_price' => 0,
//                     'other_price' => 0,
//                     'total_price' => $totalTusla,
//                     'cashier_id' => '',
//                     'payment_status' => 0,
//                 );
//                 $this->db->insert('trx_bill_detail', $dt);
//             }
//             $this->db->where('service_id', substr($mdc_id,0,14));
//             $this->db->update('trx_service', array('service_status' => 3));
//             $this->db->trans_complete();
//         }
//     }


//     function simpan() {
//         $service_id = $this->input->post('mdc_id');
//         $service_type = substr($service_id,0,2);

//         //detail
//         $this->db->join('trx_recipe tr','tr.recipe_id = trd.recipe_id');
//         $this->db->where('tr.mdc_id',$service_id);
//         $detail = $this->db->get('trx_recipe_detail trd');
//         if ($detail->num_rows() >= 1) {
//             $recipe_id = "";
//             foreach ($detail->result() as $key => $value) {
//                 $this->updateStok($value->recipe_medicine, $value->recipe_qty);
//                 if ($service_type == 'RN' && $value->recipe_id != $recipe_id) {
//                     $recipe_id = $value->recipe_id;
//                     $this->kirim_kasir($recipe_id);
//                     $this->db->where('prescription_id', $recipe_id);
//                     $this->db->update('hos_prescription', array('status' => 1));
//                 }
//             }
//         }

//         $this->db->join('trx_racikan_detail trd', 'trd.racikan_id = tr.racikan_id');
//         $this->db->where('tr.mdc_id', $visit_id);
//         $detailRacikan = $this->db->get('trx_racikan tr');
//         if ($detailRacikan->num_rows() >= 1) {
//             foreach ($detailRacikan->result() as $key => $value) {
//                 $this->updateStok($value->racikan_medicine, $value->racikan_medicine_qty);
//             }
//         }

//         if ($service_type != 'RN') {
//             $dt_stat['visit_status'] = 5;
//             $this->db->where('visit_id', $visit_id);
//             $this->db->update('trx_visit', $dt_stat);
//         }
//     }

//     public function updateStok($istok_item, $returQty) {
//         $this->db->where('istok_qty >', '0');
//         $this->db->where('istok_item', $istok_item);
//         $this->db->order_by('istok_exp', 'asc');
//         $stok = $this->db->get('inv_item_stok');
//         if ($stok->num_rows() >= 1) {
//             $stok = $stok->row();
//             $oldStokId = $stok->istok_id;
//             $oldStok = $stok->istok_qty;
//             if ($returQty > $oldStok) {
//                 $returQty = $returQty - $oldStok;
//                 $dtUpdateStok['istok_qty'] = 0;
//                 $this->db->where('istok_id', $oldStokId);
//                 $this->db->update('inv_item_stok', $dtUpdateStok);
//                 $this->updateStok($istok_item, $returQty);
//             } else {
//                 $newStok = $oldStok - $returQty;
//                 $dtUpdateStok['istok_qty'] = $newStok;
//                 $this->db->where('istok_id', $oldStokId);
//                 $this->db->update('inv_item_stok', $dtUpdateStok);
//             }
//         } else {
//             // jika tidak ada di stok maka insert dengan value stok minus
//             $dtstok = array(
//                 'iri_id' => $data['iri_id'],
//                 'istok_item' => $istok_item,
//                 'istok_qty' => (0 - $returQty),
//                 'istok_item_price' => 0,
//                 'istok_exp' => '',
//                 'istok_batch' => '',
//             );
//             $this->db->insert('inv_item_stok', $dtstok);
//         }
//     }


// // RACIKAN
//     function insertRacikan() {
//         $data = $this->input->post('ds');
//         // $tuslaRacikan = $this->db->get_where('mst_racikan_fee',array('id'=>$data['racikan_tuslah_type']))->row();
//         // $data['racikan_total']	= $tuslaRacikan->fee;
//         $data['racikan_id'] = $this->gen_id_racikan();
//         $this->db->insert('trx_racikan', $data);
//     }

//     function loaddataRacikan($mdc_id) {
//         $this->db->join('mst_racikan_fee mrf', 'mrf.id = tr.racikan_tuslah_type', 'left');
//         $this->db->where('mdc_id', $mdc_id);
//         $data['racikan'] = $this->db->get('trx_racikan tr');

//         if ($data['racikan']->num_rows() >= 1) {
//             foreach ($data['racikan']->result() as $key => $value) {
//                 $this->db->join('inv_item_master im', 'im.im_id = trx_racikan_detail.racikan_medicine');
//                 $this->db->join('mst_type_inv mti', 'im.im_unit = mti.mtype_id', 'left');
//                 $detail = $this->db->get_where('trx_racikan_detail', array('racikan_id' => $value->racikan_id));
//                 if ($detail->num_rows() >= 1) {
//                     $data['detail'][$value->racikan_id] = $detail->result();
//                 }
//             }
//         }

//         $status_bayar_resep = $this->db->get_where('trx_bill_detail', array('bill_id' => "BL-".substr($mdc_id,3), 'service_type' => 5, 'payment_status' => 1));
//         $data['status_bayar_resep'] = $status_bayar_resep->num_rows() >= 1 ? 1 : 0;

//         $this->load->view('apotek/resep_pasien/data_racikan', $data);
//     }

//     function updateRacikan($mdc_id, $racikan_id) {
//         $data = $this->input->post('ds');
//         // $tuslaRacikan = $this->db->get_where('mst_racikan_fee', array('id' => $data['racikan_tuslah_type']))->row();
//         // $racikan_total = $tuslaRacikan->fee;
//         // $this->db->join('inv_item_master im','trd.racikan_medicine = im.im_id','left');
//         // $detail = $this->db->get_where('trx_racikan_detail trd', array('racikan_id' => $racikan_id));
//         // foreach ($detail->result() as $key => $value) {
//         //     if(isset($value->im_item_price))
//         //     {
//         //         $racikan_total += $value->im_item_price * $value->racikan_medicine_qty;
//         //     }
//         // }
//         // $data['racikan_total'] = $racikan_total;

//         $this->db->where(array('mdc_id' => $mdc_id, 'racikan_id' => $racikan_id));
//         $this->db->update('trx_racikan', $data);
//     }

//     function delete_list_racikan($mdc_id, $racikan_id) {
//         $this->db->where(array('mdc_id' => $mdc_id, 'racikan_id' => $racikan_id));
//         $this->db->delete('trx_racikan');

//         $this->db->where('racikan_id', $racikan_id);
//         $this->db->delete('trx_racikan_detail');
//     }

//     function insertRacikanDetail() {
//         $data = $this->input->post('ds');
//         $racikan_medicine = $data['racikan_medicine'];
//         $racikan_medicine_name = $data['racikan_medicine_name'];
//         $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $racikan_medicine));
//         if ($inv_item_master->num_rows() <= 0) {
//             $dtMedicine['im_id'] = $racikan_medicine;
//             $dtMedicine['im_name'] = $racikan_medicine_name;
//             $dtMedicine['im_unit'] = '';
//             $dtMedicine['im_item_price'] = '0';
//             $dtMedicine['im_item_price_buy'] = '0';
//             $dtMedicine['im_item_price_package'] = '0';
//             $dtMedicine['im_status'] = '1';
//             $this->db->insert('inv_item_master', $dtMedicine);
//             $data['racikan_medicine'] = $this->db->insert_id();
//         }
//         $exist = $this->db->get_where('trx_racikan_detail', array('racikan_id' => $data['racikan_id'], 'racikan_medicine' => $data['racikan_medicine']));
//         if ($exist->num_rows() == 0) {
//             unset($data['racikan_medicine_name']);
//             $this->db->insert('trx_racikan_detail', $data);
//             $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $data['racikan_medicine']))->row();
//             $this->updateTotalRacikan($data['racikan_id'], $inv_item_master->im_item_price, $data['racikan_medicine_qty'], 'add');
//         }
//     }

//     function deleteListRacikanDetail($racikan_id, $racikan_medicine, $qty) {
//         $this->db->where(array('racikan_id' => $racikan_id, 'racikan_medicine' => $racikan_medicine));
//         $this->db->delete('trx_racikan_detail');

//         $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $racikan_medicine))->row();
//         $this->updateTotalRacikan($racikan_id, $inv_item_master->im_item_price, $qty, 'delete');
//     }

//     function updateTotalRacikan($racikan_id, $im_item_price, $qty, $act = 'add') {
//         $racikan = $this->db->get_where('trx_racikan', array('racikan_id' => $racikan_id))->row();
//         if ($act == 'delete')
//             $total = $racikan->racikan_total - ($im_item_price * $qty);
//         else
//             $total = $racikan->racikan_total + ($im_item_price * $qty);
//         $data['racikan_total'] = $total;
//         $this->db->where('racikan_id', $racikan_id);
//         $this->db->update('trx_racikan', $data);
//     }

// END RACIKAN
}

// end class