<?php

class Pendaftaran_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @deprecated
     */
    function getMedRecNumber() {
        $query_medical_record = $this->db->order_by('sd_rekmed', 'DESC')->get('ptn_social_data', 1, 0);
        if ($query_medical_record->num_rows() > 0) {
            $last_number = (int) $query_medical_record->row()->sd_rekmed;
            $last_number++;
            $prefix = '';
            for ($i = strlen($last_number); $i < 6; $i++) {
                $prefix .= '0';
            }
            $medical_record_number = $prefix . $last_number;
        } else {
            $medical_record_number = '000001';
        }
        return $medical_record_number;
    }

    function getPatientData() {
        $post_data = $this->input->post();
        if (is_numeric($post_data['searchInput'])) {
            $this->db->where('sd.sd_card_number', $post_data['searchInput']);
            $this->db->or_where('sd.sd_rekmed', $post_data['searchInput']);
        } else {
            $this->db->like('sd.sd_name', $post_data['searchInput']);
        }

        if ((NULL != $post_data['day'] && NULL != $post_data['month'] && NULL != $post_data['year'])) {
            $birthdate = $post_data['year'] . "-" . $post_data['month'] . "-" . $post_data['day'];
            $this->db->where('sd.sd_date_of_birth', $birthdate);
        }

        if (NULL != $post_data['regency']) {
            $this->db->where('sd.sd_reg_kab', $post_data['regency']);
        }

        if (NULL != $post_data['phone']) {
            $this->db->where('sd.sd_telp', $post_data['phone']);
        }

        $query = $this->db->get('ptn_social_data sd',15);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getProvinsi($id_regency) {
        $this->db
                ->select('p.*')
                ->join('mst_province p', 'p.mpr_id = r.mpr_id')
                ->where('r.mre_id', $id_regency);
        $query = $this->db->get('mst_regency r');

        if ($query->num_rows() > 0) {
            return json_encode($query->row_array());
        } else {
            return false;
        }
    }

    function getVisitID($type) {
        $ym = date('ym');
        $query = $this->db->like('visit_id', $ym, 'after')->order_by('visit_id', 'DESC')->get('trx_visit', 1, 0)->row();
        $visit_id = count($query) == 0 ? date('ym') . "0001" : $query->visit_id + 1;
        return $visit_id;
    }

    function getQueoId()
    {
        $this->db->select_max('queo_no');
        $this->db->where("DATE_FORMAT(queo_datetime,'%Y-%m-%d')",date('Y-m-d'));
        $no = $this->db->get('trx_queue_outpatient');
        if($no->num_rows() >= 1){
            $no = $no->row();
            $no = $no->queo_no;
            if($no == NULL)
            {
                $no = 0;
            }
        }else
            $no = 0;
        return ($no + 1);
    }

    function antriPoli() {
        $visit_id = $this->getVisitID('rajal');
        $poli = $this->input->post('poli');
        $physician = $this->input->post('physician');

        $this->db->trans_start();

        $dtVisit = array(
            'visit_id' => $visit_id,
            'visit_rekmed'  => $this->input->post('no_rekmed'),
            'visit_status'  => '1',
        );
        $this->db->insert('trx_visit', $dtVisit);
        if(is_array($poli)) // poli lebih dari 1
        {
            foreach ($poli as $key => $value) {
                if( (!empty($value)) && (!empty($physician[$key])) )
                {

                    $service_id = 'RJ-'.$visit_id.'-'.str_pad( ($key + 1),2,"0",STR_PAD_LEFT);
                    $bill_id = 'BL-'.$visit_id.'-'.str_pad( ($key + 1),2,"0",STR_PAD_LEFT);

                    $dtQueue = array(
                        'queo_id' => $service_id,
                        'sd_rekmed' => $this->input->post('no_rekmed'),
                        'queo_no' => $this->getQueoId(),
                        'queo_datetime' => date('Y-m-d H:i:s'),
                        'dr_id' => $physician[$key],
                        'pl_id' => $value,
                        'sch_id' => 1,
                        'modi_id' => 1
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

                    $this->repo_model->insert('trx_queue_outpatient', $dtQueue);
                    $this->db->insert('trx_service', $dtService);
                    $this->db->insert('trx_bill', $dtBill);

                    //administration fee
                    $bill['bill_id'] = $bill_id;
                    $bill['service_type'] = 9;
                    $bill['paramedic_price'] = 0;
                    $bill['other_price'] = 0;
                    $bill['cashier_id'] = '';
                    $bill['payment_status'] = 0;

                    // if($key == 0)
                    // {
                    //     $adm_fee = array(
                    //         'service_name' => $administration[0]->adm_name,
                    //         'price' => $administration[0]->adm_fee,
                    //         'total_price' => $administration[0]->adm_fee,
                    //     );
                    //     $adm_fee += $bill;
                    //     $this->repo_model->insert('trx_bill_detail', $adm_fee);
                    // }

                    if($key == 0)
                    {
                        if ($this->input->post('request_new_card') == TRUE) {
                            $administration = $this->repo_model->get('mst_adm_fee');
                            $new_card = array(
                                'service_name' => $administration[1]->adm_name,
                                'price' => $administration[1]->adm_fee,
                                'total_price' => $administration[1]->adm_fee,
                            );
                            $new_card += $bill;
                            $this->repo_model->insert('trx_bill_detail', $new_card);
                        }
                    }

                    unset($bill['service_type']);
                    $physician_fee = $this->repo_model->get('trx_dokter_fee', array('dr_id' => $physician[$key]))->dr_fee;
                    $physician_service_name = $this->repo_model->get('mst_service', array('service_id' => 1))->service_name;
                    $physician_bill = array(
                        'service_type' => 1,
                        'service_name' => $physician_service_name,
                        'price' => $physician_fee,
                        'total_price' => $physician_fee,
                    );
                    $physician_bill += $bill;
                    $this->repo_model->insert('trx_bill_detail', $physician_bill);
                }
            }
        }
        $this->db->trans_complete();
        $return = FALSE;

        if ( $this->db->trans_status() !== FALSE ) {
            return $visit_id;
        }else{
            return FALSE;
        }
    }

    function singleQueue($no_rekmed) {
        $this->db
                ->where('sd_rekmed', $no_rekmed)
                ->order_by('queo_datetime', 'desc');
        $query = $this->db->get('trx_queue_outpatient', 1);
        if ($query->num_rows() > 0) {
            $queue = $query->row();
            $now = new DateTime('now');
            $queue_datetime = new DateTime($queue->queo_datetime);
            $interval = $now->diff($queue_datetime);
            if ($interval->format('%a') == 0) {

            }
        }
    }

    function getSchedule($polyclinic) {
        $this->db->select('me.id_employe,me.sd_name,tds.day,ms.shift_start,ms.shift_end,mp.pl_name,ms.shift_id');
        $this->db->where('tds.pl_id', $polyclinic);
        $this->db->where('me.sd_status', 1);
        $this->db->join('mst_employer me', 'tds.employe_id = me.id_employe');
        $this->db->join('mst_poly mp', 'mp.pl_id = tds.pl_id');
        $this->db->join('mst_shift ms', 'tds.sch_shift = ms.shift_id');
        $schedule = $this->db->get('trx_dr_schedule tds');

        if ($schedule->num_rows() > 0) {
            return $schedule->result_array();
        } else {
            return array();
        }
    }

    function getClasses($blacklist = null) {
        $this->db
                ->select('c.class_id,c.class_name,c.price')
                ->distinct()
                ->join('mst_room r', 'r.room_id = b.room_id')
                ->join('mst_class c', 'c.class_id = r.class_id')
                ->where('b.status', 1);
        if($blacklist != null){
            $this->db->where_not_in('c.class_id',$blacklist);
        }
        $query = $this->db->get('mst_bed b');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    function getRoom($class) {
        $sql = "SELECT *
                 FROM (`mst_bed` b)
                 JOIN `mst_room` r ON `r`.`room_id` = `b`.`room_id`
                 JOIN `mst_class` c ON `c`.`class_id` = `r`.`class_id`
                 JOIN `mst_pavillion` p ON `p`.`pavillion_id` = `r`.`pavillion_id`
                 WHERE `c`.`class_id` = ?
                 AND `b`.`status` =  1
                 AND b.bed_id NOT IN (
                    SELECT h.bed_id FROM hos_bed_occupation h
                    JOIN `trx_service` ts ON `ts`.`service_id` = `h`.`service_id`
                    WHERE `ts`.`service_out` = '0000-00-00 00:00:00'
                    AND `h`.`is_occupied` = 1
                 )
                 ORDER BY `r`.`room_id`";

        $query = $this->db->query($sql, array($class));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function daftarAll() {
        $lab = $this->input->post('lab');
        $rad = $this->input->post('rad');
        $rajal = $this->input->post('rajal');
        $ranap = $this->input->post('ranap');
        $igd = $this->input->post('igd');
        $visit_id = $no = $service_id = 0;
        $service_id = $this->input->post('service_id'); //mdc_id
        $visit_id = $this->input->post('visit_id'); // visit_id
        $pasien_umum = $this->input->post('pasien_umum'); // pasien umum

        $this->db->trans_start();
        if(isset($pasien_umum) && $pasien_umum == 'yes')
        {
            if ($lab == 'yes') {
                $visit_id = $this->daftarLabRad('lab',$visit_id,$no);
                $no++;
            }
            if ($rad == 'yes') {
                $visit_id = $this->daftarLabRad('rad',$visit_id,$no);
                $no++;
            }
        }else
        {
            if( ($service_id != '0') && ($visit_id != '0') )
            {
                $service_reference = $service_id;
                if ($lab == 'yes') {
                    $visit_id = $this->daftarLabRad('lab',$visit_id,$no,$service_reference);
                    $no++;
                }
                if ($rad == 'yes') {
                    $visit_id = $this->daftarLabRad('rad',$visit_id,$no,$service_reference);
                    $no++;
                }
                if ($igd == 'yes') {
                    $visit_id = $this->daftarIgd($service_reference);
                    $no++;
                }
                if ($ranap == 'yes'){
                    $visit_id = $this->daftarRanap($service_reference);
                    $no++;
                }
            }else{
                if ($rajal == 'yes') {
                    $visit_id = $this->antriPoli();
                    $no++;
                } else if ($ranap == 'yes') {
                    $visit_id = $this->daftarRanap();
                    $no++;
                } else if ($igd == 'yes') {
                    $visit_id = $this->daftarIgd();
                    $no++;
                }

                if ($lab == 'yes') {
                    $visit_id = $this->daftarLabRad('lab',$visit_id,$no);
                    $no++;
                }
                if ($rad == 'yes') {
                    $visit_id = $this->daftarLabRad('rad',$visit_id,$no);
                    $no++;
                }
            }
        }
        $this->db->trans_complete();

        if ($visit_id == 0) {
            return FALSE;
        } else {
            return $visit_id;
        }
    }

    function daftarRanap($service_reference = null) {
        $this->db->trans_start();
        if($service_reference != null) // Transfer dari Rajal / IGD
        {
            $visit_id = $this->input->post('visit_id');

            $this->db->like('service_id',$visit_id);
            $serviceCount = $this->db->get('trx_service');
            $serviceCount = $serviceCount->num_rows();
            $no = $serviceCount;

            // $service_id = 'IG-'.$visit_id.'-01';
            $service_id = 'RN-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);
            $bill_id = 'BL-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);

            $dtService = array(
                'service_id' => $service_id,
                'service_reference' => $service_reference,
                'service_status' => '1',
                'reference_notes' => '',
                'bill_id' => $bill_id
            );
        }else{
            $visit_id = $this->getVisitID('ranap');
            $service_id = 'RN-'.$visit_id.'-01';
            $bill_id = 'BL-'.$visit_id.'-01';

            $dtVisit = array(
                'visit_id' => $visit_id,
                'visit_rekmed' => $this->input->post('no_rekmed'),
                'visit_status' => 1
            );
            $this->db->insert('trx_visit', $dtVisit);

            $dtService = array(
                'service_id' => $service_id,
                'service_reference' => '',
                'service_status' => 1,
                'reference_notes' => '',
                'bill_id' => $bill_id
            );
        }

        $dtBill = array(
            'bill_id' => $bill_id,
            'bill_status' => '',
            'bill_type' => '',
            'total' => 0,
        );

        $bed_id = explode('-', $this->input->post('rooms'));
        $dtBed = array(
            'service_id' => $service_id,
            'bed_id' => $bed_id[3],
            'is_occupied' => 1,
        );
        $this->db->insert('trx_service', $dtService);
        $this->db->insert('trx_bill', $dtBill);
        $this->db->insert('hos_bed_occupation', $dtBed);

        //administration fee
        $bill['bill_id'] = $bill_id;
        $bill['service_type'] = 9;
        $bill['paramedic_price'] = 0;
        $bill['other_price'] = 0;
        $bill['cashier_id'] = 0;
        $bill['payment_status'] = 0;

        $administration = $this->repo_model->get('mst_adm_fee');
        $adm_fee = array(
            'service_name' => $administration[0]->adm_name,
            'price' => $administration[0]->adm_fee,
            'total_price' => $administration[0]->adm_fee,
        );
        $adm_fee += $bill;
        $transfer_pasien = $this->input->post('transfer_pasien');
        if( ! isset($transfer_pasien) || $transfer_pasien != 'yes')
        {
            $this->repo_model->insert('trx_bill_detail', $adm_fee);
        }

        if ($this->input->post('request_new_card') == TRUE) {
            $new_card = array(
                'service_name' => $administration[1]->adm_name,
                'price' => $administration[1]->adm_fee,
                'total_price' => $administration[1]->adm_fee,
            );
            $new_card += $bill;
            $this->db->insert('trx_bill_detail', $new_card);
        }
        $this->db->trans_complete();

        $return = FALSE;
        if ($this->db->trans_status() !== FALSE) {
            $return = $visit_id;
        }
        return $return;
    }

    function daftarIgd($service_reference = null) {
       // debug_array($this->input->post());
        $this->db->trans_start();
        if($service_reference){
            $visit_id = $this->input->post('visit_id');

            $this->db->like('service_id',$visit_id);
            $serviceCount = $this->db->get('trx_service');
            $serviceCount = $serviceCount->num_rows();
            $no = $serviceCount;

            // $service_id = 'IG-'.$visit_id.'-01';
            $service_id = 'IG-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);
            $bill_id = 'BL-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);

            $dtService = array(
                'service_id' => $service_id,
                'service_reference' => $service_reference,
                'service_status' => '1',
                'reference_notes' => '',
                'bill_id' => $bill_id
            );
        }else{
            $visit_id = $this->getVisitID('igd');
            $service_id = 'IG-'.$visit_id.'-01';
            $bill_id = 'BL-'.$visit_id.'-01';
            $dtVisit = array(
                'visit_id' => $visit_id,
                'visit_rekmed'  => $this->input->post('no_rekmed'),
                'visit_status'  => '1',
            );

             $dtService = array(
                'service_id' => $service_id,
                'service_reference' => '',
                'service_status' => '1',
                'reference_notes' => '',
                'bill_id' => $bill_id
            );
            $this->db->insert('trx_visit', $dtVisit);
        }

        $dtBill = array(
            'bill_id' => $bill_id,
            'bill_status' => '',
            'bill_type' => '',
            'total' => 0,
        );

        $data = array(
            'mdc_id' => $service_id,
            'sd_rekmed' => $this->input->post('no_rekmed'),
            'dr_id' => $this->input->post('physician'),
            'pl_id' => '12',
            'modi_id' => 1
        );

        $this->db->insert('trx_service', $dtService);
        $this->db->insert('trx_bill', $dtBill);
        $this->repo_model->insert('trx_medical', $data);

        $visiting['visit_in'] = $this->input->post('jam_masuk_igd');
        $this->repo_model->update("trx_visit", "visit_id = $visit_id", $visiting);

        //administration fee
        $bill['bill_id'] = $bill_id;
        $bill['service_type'] = 9;
        $bill['paramedic_price'] = 0;
        $bill['other_price'] = 0;
        $bill['cashier_id'] = '';
        $bill['payment_status'] = 0;

        $administration = $this->repo_model->get('mst_adm_fee');
        $adm_fee = array(
            'service_name' => $administration[0]->adm_name,
            'price' => $administration[0]->adm_fee,
            'total_price' => $administration[0]->adm_fee,
        );
        $adm_fee += $bill;
        $transfer_pasien = $this->input->post('transfer_pasien');
        if( ! isset($transfer_pasien) || $transfer_pasien != 'yes')
        {
            $this->repo_model->insert('trx_bill_detail', $adm_fee);
        }

        if ($this->input->post('request_new_card') == TRUE) {
            $new_card = array(
                'service_name' => $administration[1]->adm_name,
                'price' => $administration[1]->adm_fee,
                'total_price' => $administration[1]->adm_fee,
            );
            $new_card += $bill;
            $this->repo_model->insert('trx_bill_detail', $new_card);
        }

        $physician_fee = $this->repo_model->get('trx_dokter_fee', array('dr_id' => $this->input->post('physician')))->dr_fee;
        $physician_service_name = $this->repo_model->get('mst_service', array('service_id' => 1))->service_name;
        $bill = array(
            'bill_id' => $bill_id,
            'service_type' => 1,
            'service_name' => $physician_service_name,
            'price' => $physician_fee,
            'total_price' => $physician_fee,
            'paramedic_price' => 0,
            'other_price' => 0,
            'cashier_id' => '',
            'payment_status' => 0
        );
        $this->repo_model->insert('trx_bill_detail', $bill);
        $this->db->trans_complete();

        $return = FALSE;
        if ($this->db->trans_status() !== FALSE) {
            $return = $visit_id;
        }
        return $return;
    }

    public function daftarLabRad($type,$visit_id = null,$no,$service_reference = null,$no_rekmed = null) {

        $penunjang      = $this->input->post('penunjang');
        $nama_penunjang = $this->input->post('nama_penunjang');
        $harga          = $this->input->post('harga');
        $type_penunjang = $this->input->post('type');

        $this->db->trans_start();

        if($visit_id == null || $visit_id == '0')
        {
            $visit_id = $this->getVisitID('lab');
            $visit_desc = $this->input->post('visit_desc');
            $dtVisit = array(
                'visit_id' => $visit_id,
                'visit_rekmed'  => $no_rekmed != null ? $no_rekmed : $this->input->post('no_rekmed'),
                'visit_desc'  => ($visit_desc != null) ? $visit_desc : '',
                'visit_status'  => '1',
            );
            $this->db->insert('trx_visit', $dtVisit);
        }
        if($service_reference != null){
            $this->db->like('service_id',$visit_id);
            $serviceCount = $this->db->get('trx_service');
            $serviceCount = $serviceCount->num_rows();
            $no = $serviceCount;
        }

        if($type == 'lab')
            $service_id = 'LB-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);
        else
            $service_id = 'RD-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);

        $bill_id = 'BL-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);

        $dtService = array(
            'service_id' => $service_id,
            'service_reference' => ($service_reference != null) ? $service_reference : '',
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

        $this->db->insert('trx_service', $dtService);
        $this->db->insert('trx_bill', $dtBill);

        if(isset($penunjang) && is_array($penunjang) && isset($nama_penunjang) && is_array($nama_penunjang) && isset($harga) && is_array($harga))
        {
            $CI =& get_instance();
            $CI->load->model('lab/lab_model');
            $CI->load->model('rad/rad_model');
            // debug_array(Modules::run('lab/genIdPenunjangDiagnosa/'.$service_id));
            foreach ($penunjang as $key => $value) {
                if(!empty($value))
                {
                    if($type_penunjang[$value] == 'lab' && $type_penunjang[$value] == $type)
                    {
                        $dtLabTreatment = array(
                            'lab_queue_id'  => $service_id,
                            'trx_ds_id' =>  Modules::run('lab/genIdPenunjangDiagnosa',$service_id),
                            'ds_id'     => $value,
                        );
                        $this->db->insert('trx_lab_treathment',$dtLabTreatment);
                        $dataBillDetail = array();
                        $dataBillDetail['bill_id']   = $bill_id;
                        $dataBillDetail['service_type']  = '7';
                        $dataBillDetail['service_name']      = $nama_penunjang[$value];
                        $dataBillDetail['price']     = $harga[$value];
                        $dataBillDetail['other_price']       = 0;
                        $dataBillDetail['total_price']       = ($harga[$value]);
                        $dataBillDetail['cashier_id']        = '';
                        $dataBillDetail['payment_status']        = 0;
                        $this->db->insert('trx_bill_detail',$dataBillDetail);

                        // get mst_lab_treathment_detail
                        $data_ds_detail = $CI->lab_model->get_diagnosa_support_detail($value);
                        if($data_ds_detail->num_rows() >= 1){
                            $dtd = array();
                            foreach ($data_ds_detail->result() as $k => $v) {
                                //$nilaistandart=''
                                if($v->dsd_standart_value_female!=''){
                                    $nilaistandart=$v->dsd_standart_value_male.', '.$v->dsd_standart_value_female;
                                }else{
                                    $nilaistandart=$v->dsd_standart_value_male;
                                }
                                $dtd[] = array(
                                    'lab_queue_id'  => $service_id,
                                    'trx_ds_id' => $dtLabTreatment['trx_ds_id'],
                                    'dsupport_code' => $v->dsd_id,
                                    'dsupport_name' => $v->dsd_name,
                                    'dsupport_value'=> '',
                                    //'dsupport_standart_value' => 'L: '.$v->dsd_standart_value_male.', P: '.$v->dsd_standart_value_female,
                                    'dsupport_standart_value' => $nilaistandart,
                                    'dsupport_satuan' => $v->dsd_satuan

                                );
                            }
                            // insert diagnosa support detail
                            $this->db->insert_batch('trx_lab_treathment_detail',$dtd);
                        }
                    }else if($type_penunjang[$value] == 'rad' && $type_penunjang[$value] == $type)
                    {
                        $dtLabTreatment = array(
                            'lab_queue_id'  => $service_id,
                            'trx_ds_id' =>  Modules::run('rad/genIdPenunjangDiagnosa',$service_id),
                            'ds_id'     => $value,
                        );
                        $this->db->insert('trx_lab_treathment',$dtLabTreatment);
                        $dataBillDetail = array();
                        $dataBillDetail['bill_id']   = $bill_id;
                        $dataBillDetail['service_type']  = '7';
                        $dataBillDetail['service_name']      = $nama_penunjang[$value];
                        $dataBillDetail['price']     = $harga[$value];
                        $dataBillDetail['other_price']       = 0;
                        $dataBillDetail['total_price']       = ($harga[$value]);
                        $dataBillDetail['cashier_id']        = '';
                        $dataBillDetail['payment_status']        = 0;
                        $this->db->insert('trx_bill_detail',$dataBillDetail);

                        // get mst_lab_treathment_detail
                        $data_ds_detail = $CI->rad_model->get_diagnosa_support_detail($value);
                        if($data_ds_detail->num_rows() >= 1){
                            $dtd = array();
                            foreach ($data_ds_detail->result() as $k => $v) {
                                if($v->dsd_standart_value_female!=''){
                                    $nilaistandart=$v->dsd_standart_value_male.', '.$v->dsd_standart_value_female;
                                }else{
                                    $nilaistandart=$v->dsd_standart_value_male;
                                }
                                $dtd[] = array(
                                    'lab_queue_id'  => $service_id,
                                    'trx_ds_id' => $dtLabTreatment['trx_ds_id'],
                                    'dsupport_code' => $v->dsd_id,
                                    'dsupport_name' => $v->dsd_name,
                                    'dsupport_value'=> '',
                                    //'dsupport_standart_value' => 'L: '.$v->dsd_standart_value_male.', P: '.$v->dsd_standart_value_female,
                                    'dsupport_standart_value' => $nilaistandart,
                                    'dsupport_satuan' => $v->dsd_satuan

                                );
                            }
                            // insert diagnosa support detail
                            $this->db->insert_batch('trx_lab_treathment_detail',$dtd);
                        }
                    }
                }
            }
        }

        $generate_id    = Modules::run('lab/gen_lab_queue_id');
        $lab_queue_id   = $service_id;
        $lab_queue_no   = $generate_id['lab_queue_no'];

        $data_antrian_lab['lab_queue_id'] = $lab_queue_id;
        $data_antrian_lab['sd_rekmed'] = $no_rekmed != null ? $no_rekmed : $this->input->post('no_rekmed');
        $data_antrian_lab['lab_queue_no'] = $lab_queue_no;
        $data_antrian_lab['lab_queue_datetime'] = date('Y-m-d H:i:s');
        $data_antrian_lab['operator_id'] = '';
        $this->db->insert('trx_lab_queue', $data_antrian_lab);

        $this->db->trans_complete();

        $return = FALSE;
        if ($this->db->trans_status() !== FALSE)
            $return = $visit_id;
        return $return;
    }


    function getTracer($visit_id) {
        $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed','left');
        $this->db->where('tv.visit_id',$visit_id);
        $data['medical'] = $this->db->get('trx_visit tv')->row();

        $this->db->join('trx_visit tv','tv.visit_id = substr(ts.service_id, 4,8)');
        $this->db->where('tv.visit_id',$visit_id);
        $result = $this->db->get('trx_service ts');
        if($result->num_rows() >= 1)
        {
            foreach ($result->result() as $key => $value) {
                $queue = $dokter = $poly = '';
                $type = substr($value->service_id, 0,2);
                if($type == 'RJ'){
                    $type = 'Rawat Jalan';
                    $this->db->select('tqo.queo_no as queue,tqo.queo_datetime as visit_time,me.sd_name as physician,mp.pl_name as poly');
                    $this->db->join('mst_employer me', 'me.id_employe = tqo.dr_id');
                    $this->db->join('mst_poly mp', 'mp.pl_id = tqo.pl_id');
                    $this->db->where('tqo.queo_id',$value->service_id);
                    $service =  $this->db->get('trx_queue_outpatient tqo');
                    foreach ($service->result() as $k => $v) {
                        $queue  .= $v->queue;
                        $dokter .= $v->physician;
                        $poly   .= $v->poly;
                    }

                    $data['service'][$key]['queue']  = $queue;
                    $data['service'][$key]['dokter'] = $dokter;
                    $data['service'][$key]['poly']   = $poly;
                }
                else if($type == 'RN'){
                    $type = 'Rawat Inap';
                    $this->db->select('mr.room_id, mc.class_name, mp.pavillion_name');
                    $this->db->join('mst_bed mb','mb.bed_id = hbo.bed_id');
                    $this->db->join('mst_room mr','mr.room_id = mb.room_id');
                    $this->db->join('mst_class mc','mc.class_id = mr.class_id');
                    $this->db->join('mst_pavillion mp','mp.pavillion_id = mr.pavillion_id');
                    $this->db->where(array('service_id' => $value->service_id, 'is_occupied' => 1));
                    $service = $this->db->get('hos_bed_occupation hbo')->row();
                    if(empty($service)){
                        //pasien udah pulang tapi tracernya pengin dicetak lagi
                        $this->db->select('mr.room_id, mc.class_name, mp.pavillion_name');
                        $this->db->join('mst_bed mb','mb.bed_id = hbo.bed_id');
                        $this->db->join('mst_room mr','mr.room_id = mb.room_id');
                        $this->db->join('mst_class mc','mc.class_id = mr.class_id');
                        $this->db->join('mst_pavillion mp','mp.pavillion_id = mr.pavillion_id');
                        $this->db->where(array('service_id' => $value->service_id, 'is_occupied' => 0));
                        $service = $this->db->get('hos_bed_occupation hbo')->row();
                    }
                    $data['service'][$key]['room']      = $service->room_id;
                    $data['service'][$key]['class']     = $service->class_name;
                    $data['service'][$key]['pavillion'] = $service->pavillion_name;
                }
                else if($type == 'IG'){
                    $this->db->_protect_identifiers=false;
                    $this->db->select('tv.visit_in as visit_time,me.sd_name as physician');
                    $this->db->join('trx_medical tm','substr(tm.mdc_id,4,8) = tv.visit_id');
                    $this->db->join('mst_employer me', 'me.id_employe = tm.dr_id');
                    $this->db->where('tm.mdc_id',$value->service_id);
                    $service =  $this->db->get('trx_visit tv');
                    foreach ($service->result() as $k => $v) {
                        //$queue  .= $v->queue;
                        $dokter .= $v->physician;
                    }
                    $type = 'IGD';
                }
                else if($type == 'LB')
                    $type = 'Laboratorium';
                else if($type == 'RD')
                    $type = 'Radiologi';

                $data['service'][$key]['type'] = $type;
            }
        }
        //cek pasien lama atau baru
        $rekmed = $data['medical']->visit_rekmed;
        $cek = $this->db->query("SELECT *
                    FROM trx_visit tv
                    WHERE tv.visit_rekmed = '$rekmed'");
        $getDate = $cek->row_array();
        $date_visit = date('Y-m-d',strtotime($getDate['visit_in']));
        if(($cek->num_rows() != 1) || ($rekmed < 920) || ( $date_visit != date('Y-m-d'))){
            $data['st_pasien']=' (Pasien Lama)';
        }elseif($cek->num_rows() == 1)
            {$data['st_pasien']=' (Pasien Baru)';}
        //=====================
        if(!empty($data)){
            return $data;
        }else{
            return FALSE;
        }
    }

    // function getTracerRanap($visit_id) {
    //     $this->db
    //             ->select('tv.visit_in as visit_time,p.sd_rekmed as medical_record,p.sd_name as patient,mc.class_name as class,mr.room_id as room')
    //             ->join('trx_visit tv', 'tv.visit_id = h.visit_id')
    //             ->join('ptn_social_data p', 'p.sd_rekmed = tv.visit_rekmed')
    //             ->join('mst_bed mb', 'mb.bed_id = h.bed_id')
    //             ->join('mst_room mr', 'mr.room_id = mb.room_id')
    //             ->join('mst_class mc', 'mc.class_id = mr.class_id')
    //             ->where('h.visit_id', $visit_id);
    //     $query = $this->db->get('hos_bed_occupation h');

    //     if ($query->num_rows() > 0) {
    //         return $query->row();
    //     } else {
    //         return false;
    //     }
    // }

    // function getTracerLab($visit_id) {
    //     $this->db
    //             ->select('tv.visit_in as visit_time,tv.visit_rekmed as medical_record,psd.sd_name as patient')
    //             ->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed')
    //             ->where('tv.visit_id', $visit_id);
    //     $query = $this->db->get('trx_visit tv');

    //     if ($query->num_rows() > 0) {
    //         return $query->row();
    //     } else {
    //         return false;
    //     }
    // }

    // function getTracerRad($visit_id) {
    //    $this->db
    //             ->select('tv.visit_in as visit_time,tv.visit_rekmed as medical_record,psd.sd_name as patient')
    //             ->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed')
    //             ->where('tv.visit_id', $visit_id);
    //     $query = $this->db->get('trx_visit tv');

    //     if ($query->num_rows() > 0) {
    //         return $query->row();
    //     } else {
    //         return false;
    //     }
    // }

    // function getTracerIGD($visit_id) {
    //    $this->db
    //             ->select('tv.visit_in as visit_time,tv.visit_rekmed as medical_record,psd.sd_name as patient')
    //             ->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed')
    //             ->where('tv.visit_id', $visit_id);
    //     $query = $this->db->get('trx_visit tv');

    //     if ($query->num_rows() > 0) {
    //         return $query->row();
    //     } else {
    //         return false;
    //     }
    // }

    function isPatientAvailable($no_rekmed) {
        $this->db->_protect_identifiers=false;
        $this->db
                ->join('trx_service ts','substr(ts.service_id,4,8) = tv.visit_id')
                ->where('tv.visit_rekmed', $no_rekmed)
                ->where("tv.visit_out = '0000-00-00 00:00:00'")
                ->where("tv.visit_status !=",5)
                ->where("substr(ts.service_id,1,2) != 'RJ'")
                ->where("substr(ts.service_id,1,2) != 'LB'")
                ->where("substr(ts.service_id,1,2) != 'RD'");
        $query = $this->db->get('trx_visit tv');
        if ($query->num_rows() > 0) {
            $return = array('is_available' => FALSE,'patient_data' => $query->row_array());
        } else {
            $return = array('is_available' => TRUE,'patient_data' => array());
        }

        return $return;
    }

    function getPoly() {
        $this->db->where('pl_id != 100');
        $query = $this->db->get('mst_poly');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
