<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekam_medis extends MY_Controller {

    function __construct() {
        parent::__construct();
        // local variable
        // model
        $this->load->model('rekam_medis_model');
        $this->load->model('rawat_jalan/poli_model', 'poli_model');

        // keterangan kode
    }

    function index() {
        $data['main_view'] = 'rekam_medis/index';
        $data['title'] = 'Rekam Medis';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    function kunjungan_hari_ini() {
        $data['main_view'] = 'rekam_medis/kunjungan_hari_ini';
        $data['title'] = 'Rekam Medis';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    function kunjungan_aktif() {
        $data['main_view'] = 'rekam_medis/kunjungan_aktif';
        $data['title'] = 'Rekam Medis';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    function semua_pasien() {
        $config['sTable'] = "ptn_social_data p";
        $config['aColumns'] = array("sd_rekmed", "sd_name", "sd_status");
        $config['aColumns_format'] = array("p.sd_rekmed", "p.sd_name", "p.sd_status");
        $config['php_format'] = array("", "", "statusverbose");
        $config['key'] = "p.sd_rekmed";
        $config['searchColumn'] = array("sd_rekmed", "sd_name", "sd_status");
        $config['aksi'] = array(
            'stat' => true,
            'key' => 'sd_rekmed',
            'custom' => array(
                array(
                    'title' => 'Histori Kunjungan',
                    'class' => 'visit-list',
                    'href' => array('url' => base_url() . 'rekam_medis/semua_kunjungan/', 'uid' => 'sd_rekmed'),
                    'text' => 'Histori Kunjungan',
                ),
                array(
                    'title' => 'Cetak Barcode',
                    'class' => 'btn-info',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Barcode',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_barcode/', 'uid' => 'sd_rekmed'),
                ), array(
                    'title' => 'Cetak Form Pasien',
                    'class' => 'btn-warning',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Form Pasien',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_form_pasien/', 'uid' => 'sd_rekmed'),
                ),array(
                    'title' => 'Retensi',
                    'class' => 'btn-danger btn_retensi',
                    'href' => array('url' => base_url() . 'rekam_medis/retensi/', 'uid' => 'sd_rekmed'),
                    'text' => 'Retensi',
                ))
        );
        init_datatable($config);
    }

    //hendri, 21 februari 2015
    function retensi($no_rekmed){
        $keterangan = $this->input->post('sd_keterangan');
        $data=array('sd_status'=>0,'sd_keterangan'=>$keterangan);
        $this->db->where('sd_rekmed',$no_rekmed);
        if($this->db->update('ptn_social_data',$data)){
            $result = array('success' => true);    
        }else{
            $result = array('success' => false);    
        }
        
        echo json_encode($result);
    }
    //=======================

    function semua_kunjungan($no_rekmed) {
        $data['no_rekmed'] = $no_rekmed;
        $this->load->view('histori_pasien', $data);
    }

    function histori_pasien($no_rekmed) {
        //prepare table format for datatable
        $config['sTable'] = "trx_visit t";
        $config['aColumns'] = array("visit_in", "visit_out");
        $config['aColumns_format'] = array("t.visit_in", "t.visit_out","t.visit_rekmed");
        $config['php_format'] = array("date", "date");
        $config['key'] = "t.visit_id";
        $config['searchColumn'] = array("visit_in");
        $config['where'][] = "t.visit_rekmed = '$no_rekmed'";
        $config['aksi'] = array(
            'stat' => true,
            'key' => 'visit_id',
            'custom' => array(
                array(
                    'title' => 'Rekam Medis',
                    'class' => '',
                    'href' => array('url' => base_url() . 'rekam_medis/rm/', 'uid' => 'visit_rekmed'),
                    'text' => 'Rekam Medis',
                ),
                array(
                    'title' => 'Cetak Tracer',
                    'class' => 'btn-warning',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Tracer',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_tracer/', 'uid' => 'visit_id'),
                ))
        );
        init_datatable($config);
    }

    function get_kunjungan() {
        //prepare table format for datatable
        $config['sTable'] = "trx_visit t";
        $config['aColumns'] = array("visit_in","service_id","pasien", "vs_name");
        $config['aColumns_format'] = array("t.visit_in","  GROUP_CONCAT( if(substr(ts.service_id,1,2) = 'RJ', CONCAT_WS(' ',(if(mp.pl_name is not null,mp.pl_name,'')),(if(me.sd_name is not null,me.sd_name,''))) ,if(substr(ts.service_id,1,2) = 'LB','Laboratoriuam',if(substr(ts.service_id,1,2) = 'RD','Radiologi',if(substr(ts.service_id,1,2) = 'RN','Rawat Inap',if(substr(ts.service_id,1,2) = 'IG','IGD','-') ) ) ) ) SEPARATOR '<br> ') as service_id","CONCAT_WS('<br>',CONCAT('<b>',p.sd_rekmed,'</b>'),CONCAT('<b>',p.sd_name,'</b>'),CONCAT('<i>',p.sd_address,'</i>') ) as pasien", "vs.vs_name","p.sd_rekmed");
        $config['php_format'] = array("datetime","","", "");
        $config['key'] = "t.visit_id";
        $config['join'][] = array("ptn_social_data p", "p.sd_rekmed = t.visit_rekmed");
        $config['join'][] = array("mst_visit_status vs", "vs.vs_id = t.visit_status");
        $config['join'][] = array("trx_service ts", "substr(ts.service_id,4,8) = t.visit_id");
        $config['leftjoin'][] = array("trx_medical tm", "ts.service_id = tm.mdc_id");
        $config['leftjoin'][] = array("mst_poly mp", "mp.pl_id = tm.pl_id");
        $config['leftjoin'][] = array("mst_employer me", "me.id_employe = tm.dr_id");
        $config['where'][] = "DATEDIFF(NOW(),visit_in) = 0 ";
        // $config['where'][] = "t.visit_status < 5 ";
        $config['group'] = "t.visit_id";
        $config['searchColumn'] = array("sd_name");
        $config['aksi'] = array(
            'stat' => true,
            'key' => 'sd_rekmed',
            // 'detail' => base_url() . 'rekam_medis/rm/',
            'custom' => array(
                array(
                    'title' => 'Detail',
                    'class' => 'btn-default',
                    'href' => array('url' => base_url() . 'rekam_medis/rm/', 'uid' => 'sd_rekmed'),
                    'text' => 'Detail',
                    // 'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_tracer/', 'uid' => 'visit_id'),
                ),
                array(
                    'title' => 'Cetak Tracer',
                    'class' => 'btn-warning',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Tracer',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_tracer/', 'uid' => 'visit_id'),
                ),
                array(
                    'title' => 'Cetak Barcode',
                    'class' => 'btn-info',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Barcode',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_barcode/', 'uid' => 'sd_rekmed'),
                ),
                array(
                    'title' => 'Akhiri Kunjungan',
                    'class' => 'btn-danger btn-finish',
                    'href' => array('url' => base_url() . 'rekam_medis/akhiri_kunjungan/', 'uid' => 'visit_id'),
                    'text' => 'Akhiri Kunjungan',
                    'attributes' => array('type'=>'button', 'url' => base_url() . 'rekam_medis/akhiri_kunjungan/', 'uid' => 'visit_id'),
                )
            ),
        );
        init_datatable($config);
    }

    public function get_kunjungan_aktif()
    {
        $config['sTable'] = "trx_visit t";
        $config['aColumns'] = array("visit_in","service_id","pasien", "vs_name");
        $config['aColumns_format'] = array("t.visit_in","  GROUP_CONCAT( if(substr(ts.service_id,1,2) = 'RJ', CONCAT_WS(' ',(if(mp.pl_name is not null,mp.pl_name,'')),(if(me.sd_name is not null,me.sd_name,''))) ,if(substr(ts.service_id,1,2) = 'LB','Laboratoriuam',if(substr(ts.service_id,1,2) = 'RD','Radiologi',if(substr(ts.service_id,1,2) = 'RN','Rawat Inap',if(substr(ts.service_id,1,2) = 'IG','IGD','-') ) ) ) ) SEPARATOR '<br> ') as service_id","CONCAT_WS('<br>',CONCAT('<b>',p.sd_rekmed,'</b>'),CONCAT('<b>',p.sd_name,'</b>'),CONCAT('<i>',p.sd_address,'</i>') ) as pasien", "vs.vs_name","p.sd_rekmed");
        $config['php_format'] = array("datetime","","", "");
        $config['key'] = "t.visit_id";
        $config['join'][] = array("ptn_social_data p", "p.sd_rekmed = t.visit_rekmed");
        $config['join'][] = array("mst_visit_status vs", "vs.vs_id = t.visit_status");
        $config['join'][] = array("trx_service ts", "substr(ts.service_id,4,8) = t.visit_id");
        $config['leftjoin'][] = array("trx_medical tm", "ts.service_id = tm.mdc_id");
        $config['leftjoin'][] = array("mst_poly mp", "mp.pl_id = tm.pl_id");
        $config['leftjoin'][] = array("mst_employer me", "me.id_employe = tm.dr_id");
        // $config['where'][] = "DATEDIFF(NOW(),visit_in) = 0 ";
        $config['where'][] = "t.visit_status < 5 ";
        $config['group'] = "t.visit_id";
        $config['searchColumn'] = array("sd_name");
        $config['aksi'] = array(
            'stat' => true,
            'key' => 'sd_rekmed',
            // 'detail' => base_url() . 'rekam_medis/rm/',
            'custom' => array(
                array(
                    'title' => 'Detail',
                    'class' => 'btn-default',
                    'href' => array('url' => base_url() . 'rekam_medis/rm/', 'uid' => 'sd_rekmed'),
                    'text' => 'Detail',
                    // 'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_tracer/', 'uid' => 'visit_id'),
                ),
                array(
                    'title' => 'Cetak Tracer',
                    'class' => 'btn-warning',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Tracer',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_tracer/', 'uid' => 'visit_id'),
                ),
                array(
                    'title' => 'Cetak Barcode',
                    'class' => 'btn-info',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Barcode',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_barcode/', 'uid' => 'sd_rekmed'),
                ),
                array(
                    'title' => 'Akhiri Kunjungan',
                    'class' => 'btn-danger btn-finish',
                    'href' => array('url' => base_url() . 'rekam_medis/akhiri_kunjungan/', 'uid' => 'visit_id'),
                    'text' => 'Akhiri Kunjungan',
                    'attributes' => array('type'=>'button', 'url' => base_url() . 'rekam_medis/akhiri_kunjungan/', 'uid' => 'visit_id'),
                )
            ),
        );
        init_datatable($config);
    }

    // rekam medis
    function rm($sd_rekmed){
        $this->url_poli = 'poli_umum';
        $data['main_view'] = 'rawat_jalan/poli/rekam_medis';
        $data['title'] = 'Rekam Medis';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';

        $data['med_recs']   = $this->poli_model->get_ptn_rekmed($sd_rekmed);
        $data['url_poli']   = $this->url_poli;
        $data['patient']  = $this->db->get_where('ptn_social_data',array('sd_rekmed'=>$sd_rekmed))->row();

        $this->load->view('template',$data);
    }

    
    public function akhiri_kunjungan($visit_id = null){
        if($visit_id != null)
        {
            // cek semua services yang referensinya dari visit_id di atas,
            // jika service nya masih memiliki status < 4, maka service tidak boleh diakhiri.
            $this->db->like('service_id',$visit_id);
            $this->db->where('service_status <',4);
            // $this->db->where('service_status <',5); // 5 karena harus sudah selesai semua
            $unfinished_services = $this->db->get('trx_service')->num_rows() != 0 ? 1 : 0;
            // jika semua service selesai
            if (!$unfinished_services) {
                $dataVisit['visit_status']  = '5';
                $dataVisit['visit_out']  = date('Y-m-d H:i:s');
                $this->db->where('visit_id',$visit_id);
                $success = $this->db->update('trx_visit',$dataVisit);

                $this->db->_protect_identifiers = false;
                $dataService['service_status']  = 5;
                $this->db->where('service_status <',5);
                $this->db->where('substr(service_id, 4,8) =',$visit_id);
                $success = $this->db->update('trx_service',$dataService);
                
                $result = array('success' => true);
            } else {
                $result = array('success' => false);
            }
        }
        echo json_encode($result);
    }
    
    public function akhiri_layanan($service_id = null){
        if($service_id != null)
        {
            /* - cek semua services yang referensinya dari visit_id di atas,
                 jika service nya masih memiliki status < 4, maka service tidak boleh diakhiri.
            */

            $this->db->where('service_id',$service_id);
            $this->db->where('service_status <',4);
            $unfinished_services = $this->db->get('trx_service')->num_rows() != 0 ? 1 : 0;
            /*
                jika semua service selesai
             */
            //print_r($unfinished_services);
            if ($unfinished_services) {
                $dataService['service_status']  = 5;
                $dataService['service_out']  = date('Y-m-d H:i:s');

                if ( substr($service_id, 0,2) == 'RJ') {
                    $dataQueue['queo_status'] = 2;
                    $this->db->where(array('queo_id'=>$service_id));
                    $result = $this->db->update('trx_queue_outpatient',$dataQueue);
                }

                if ( (substr($service_id, 0,2) == 'LB') || (substr($service_id, 0,2) == 'RD') ) {
                    $dataQueueLabRad['lab_queue_status'] = 5;
                    $this->db->where(array('lab_queue_id'=>$service_id));
                    $result = $this->db->update('trx_lab_queue',$dataQueueLabRad);
                }

                $this->db->where('service_id',$service_id);
                $this->db->where('service_status <',5);
                $result = $this->db->update('trx_service',$dataService);

                $result = array('success' => true);
            } else {
                $result = array('success' => false);
            }

            echo json_encode($result);
        }
    }

    public function aktifkan_layanan($service_id = null){
        if($service_id != null)
        {
            $dataVisit['visit_status']  = '2';
            $dataVisit['visit_out']  = date('0000-00-00 00:00:00');
            $visit_id = explode('-', $service_id);
            $this->db->where('visit_id',$visit_id[1]);
            $result = $this->db->update('trx_visit',$dataVisit);

            $dataService['service_status']  = 2;                
            $this->db->where('service_id',$service_id);
            $result = $this->db->update('trx_service',$dataService);

            if ( substr($service_id, 0,2) == 'RJ') {
                $dataQueue['queo_status'] = 1;
                $this->db->where(array('queo_id'=>$service_id));
                $result = $this->db->update('trx_queue_outpatient',$dataQueue);
            }

            if ( (substr($service_id, 0,2) == 'LB') || (substr($service_id, 0,2) == 'RD') ) {
                $dataQueueLabRad['lab_queue_status'] = 2;
                $this->db->where(array('lab_queue_id'=>$service_id));
                $result = $this->db->update('trx_lab_queue',$dataQueueLabRad);
            }

            $result = array('success' => ($result) ? true : false );                

            echo json_encode($result);
        }
    }

    public function cancel_layanan($service_id = null)
    {
        $result = false;
        if($service_id != null)
        {
            if(substr($service_id, 0, 2) == 'RJ' || substr($service_id, 0, 2) == 'IG') // mengembalikan obat
            {
                $this->db->where('mdc_id',$service_id);
                $recipe     = $this->db->get('trx_recipe');
                if($recipe->num_rows() >= 1)
                {
                    foreach ($recipe->result() as $key => $value) {
                        $this->db->where('recipe_id',$value->recipe_id);
                        $detailRecipe   = $this->db->get('trx_recipe_detail');
                        if($detailRecipe->num_rows() >= 1)
                        {
                            foreach ($detailRecipe->result() as $k => $v) {
                                Modules::run('apotek/resep_pasien/updateStok',$v->recipe_medicine, (- $v->recipe_qty), $v->recipe_batch);                                
                            }
                        }
                    }
                }
                $this->db->where('mdc_id',$service_id);
                $racikan     = $this->db->get('trx_racikan');
                if($racikan->num_rows() >= 1)
                {
                    foreach ($racikan->result() as $key => $value) {
                        $this->db->where('racikan_id',$value->racikan_id);
                        $detailRacikan = $this->db->get('trx_racikan_detail');
                        if($detailRacikan->num_rows() >= 1)
                        {
                            foreach ($detailRacikan->result() as $k => $v) {
                                Modules::run('apotek/resep_pasien/updateStok',$v->racikan_medicine, (- $v->racikan_medicine_qty), $v->racikan_medicine_batch);                                
                            }
                        }
                    }
                }
            }

            if ( substr($service_id, 0,2) == 'RJ') {
                $dataQueue['queo_status'] = 2;
                $this->db->where(array('queo_id'=>$service_id));
                $result = $this->db->update('trx_queue_outpatient',$dataQueue);
            }

            if ( (substr($service_id, 0,2) == 'LB') || (substr($service_id, 0,2) == 'RD') ) {
                $dataQueueLabRad['lab_queue_status'] = 7;
                $this->db->where(array('lab_queue_id'=>$service_id));
                $result = $this->db->update('trx_lab_queue',$dataQueueLabRad);
            }

            
            $dataService['service_status']  = 7;    // status 7 = layanan dibatalkan
            $this->db->where('service_id',$service_id);
            $result = $this->db->update('trx_service',$dataService);
            
            $bill_id    = str_replace( substr($service_id, 0,2), 'BL', $service_id); // status 2 = payment dibatalkan
            $dataBill['payment_status'] = '2';
            $this->db->where('bill_id',$bill_id);
            $this->db->update('trx_bill_detail',$dataBill);
        }

        $result = array('success' => ($result) ? true : false );                
        echo json_encode($result);

    }


    public function updateVitalSign()
    {
        $mdc_id = $this->input->post('mdc_id');
        $dp     = $this->input->post('dp');

        $this->db->where('mdc_id',$mdc_id);
        $result = $this->db->update('trx_medical_ptn_now',$dp);

        $result = ($result) ? array('success'=>true) : array('success'=>false);
        echo json_encode($result);
    }

    public function updateDokter()
    {
        $mdc_id = $this->input->post('mdc_id');
        $dokter     = $this->input->post('dokter');

        $this->db->where('mdc_id',$mdc_id);
        $result     = $this->db->update('trx_medical',$dokter);

        $this->db->where('queo_id',$mdc_id);
        $result     = $this->db->update('trx_queue_outpatient',$dokter);

        $result = ($result) ? array('success'=>true) : array('success'=>false);
        echo json_encode($result);
    }

    public function updateAnamnesa()
    {
        $mdc_id = $this->input->post('mdc_id');
        $anamnesa['ma_desc'] = $this->input->post('anamnesa');
        $objective['mo_desc'] = $this->input->post('objective');

        $anamnesaExist = $this->db->get_where('trx_medical_anamnesa',array('mdc_id'=>$mdc_id));
        if($anamnesaExist->num_rows() >= 1)
        {
            $this->db->where('mdc_id',$mdc_id);
            $result     = $this->db->update('trx_medical_anamnesa',$anamnesa);
        }else{
            $dataAnamnesa['ma_desc']    = $anamnesa['ma_desc'];
            $dataAnamnesa['mdc_id']    = $mdc_id;
            $this->db->insert('trx_medical_anamnesa',$dataAnamnesa);
        }

        $objectiveExist = $this->db->get_where('trx_medical_objective',array('mdc_id'=>$mdc_id));
        if($objectiveExist->num_rows() >= 1)
        {
            $this->db->where('mdc_id',$mdc_id);
            $result     = $this->db->update('trx_medical_objective',$objective);
        }else{
            $dataObjective['mo_desc']    = $objective['mo_desc'];
            $dataObjective['mdc_id']    = $mdc_id;
            $this->db->insert('trx_medical_objective',$dataObjective);
        }

        $result = ($result) ? array('success'=>true) : array('success'=>false);
        echo json_encode($result);

    }

    public function updateDiagnosa()
    {
        $mdc_id = $this->input->post('mdc_id');
        $diagnosa = $this->input->post('diagnosa');

        $data_diag = $this->poli_model->cek_is_exist_diagnosa_treathment($mdc_id);

        $this->db->trans_start();
        if($data_diag->num_rows() >= 1){
            foreach ($data_diag->result() as $key => $value) {
                $this->db->where('dat_id',$value->dat_id);
                $this->db->delete('trx_diagnosa_treathment_detail');        
            }
            $this->db->where('mdc_id',$mdc_id);
            $this->db->delete('trx_diagnosa_treathment');
        }
        
        foreach ($diagnosa as $key => $value) {
                $visit_id = substr($mdc_id, 3, 8);
                $dat_id = Modules::run('master/data_diagnosa/genDiagnosaID',$mdc_id,$visit_id);
                $data_diagnosa = array(
                    'mdc_id'    => $mdc_id,
                    'dat_id'    => $dat_id,
                    'dat_diag'  => (isset($value)) ? $value : '',
                );
            if(!empty($data_diagnosa)){
                $result = $this->db->insert('trx_diagnosa_treathment',$data_diagnosa);
            }
        }
        $this->db->trans_complete();

        $result = ($result) ? array('success'=>true) : array('success'=>false);
        echo json_encode($result);
    }

    function pasien_retensi(){
        $data['main_view'] = 'rekam_medis/retensi';
        $data['title'] = 'Pasien Retensi';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    function get_retensi() {
        $config['sTable'] = "ptn_social_data p";
        $config['aColumns'] = array("sd_rekmed", "sd_name", "sd_address", "sd_status","sd_reg_date","sd_keterangan");
        $config['aColumns_format'] = array("p.sd_rekmed", "p.sd_name", "p.sd_address", "p.sd_status","p.sd_reg_date","p.sd_keterangan");
        $config['php_format'] = array("", "", "", "statusverbose","date","");
        $config['key'] = "p.sd_rekmed";
        $config['where'][] = "p.sd_status = 0 ";
        $config['searchColumn'] = array("sd_rekmed", "sd_name","sd_address", "sd_status");
        $config['aksi'] = array(
            'stat' => true,
            'key' => 'sd_rekmed'
            /*,
            'custom' => array(
                array(
                    'title' => 'Histori Kunjungan',
                    'class' => 'visit-list',
                    'href' => array('url' => base_url() . 'rekam_medis/semua_kunjungan/', 'uid' => 'sd_rekmed'),
                    'text' => 'Histori Kunjungan',
                ),
                array(
                    'title' => 'Cetak Barcode',
                    'class' => 'btn-info',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Barcode',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_barcode/', 'uid' => 'sd_rekmed'),
                ), array(
                    'title' => 'Cetak Form Pasien',
                    'class' => 'btn-warning',
                    'href' => array('url' => 'javascript:void(0);', 'uid' => ''),
                    'text' => 'Form Pasien',
                    'attributes' => array('type' => 'openInNewTab', 'url' => base_url() . 'pendaftaran/cetak_form_pasien/', 'uid' => 'sd_rekmed'),
                ),array(
                    'title' => 'Retensi',
                    'class' => 'btn-danger btn_retensi',
                    'href' => array('url' => base_url() . 'rekam_medis/retensi/', 'uid' => 'sd_rekmed'),
                    'text' => 'Retensi',
                ))*/
        );
        init_datatable($config);
    }
}
// end of class