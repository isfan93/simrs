<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rawat_inap_model extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
    * @deprecated
    */
    function currentPatient() {
        $this->db
        ->select('tv.visit_id,tv.visit_in,p.sd_rekmed,p.sd_name,c.class_name,r.room_id')
        ->join('ptn_social_data p', 'p.sd_rekmed = tv.visit_rekmed')
        ->join('hos_bed_occupation h', 'h.visit_id = tv.visit_id')
        ->join('mst_bed b', 'b.bed_id = h.bed_id')
        ->join('mst_room r', 'r.room_id = b.room_id')
        ->join('mst_class c', 'c.class_id = r.class_id')
        ->where('h.is_occupied', 1)
        ->where('tv.visit_out', '0000-00-00 00:00:00');
        $query = $this->db->get('trx_visit tv');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    function getServiceDetails($service_id){
        $query = $this->db->get_where('trx_service',array('service_id' => $service_id));
        return $query->row();
    }

    function getVitalSign($service_id) {
        $this->db
        ->like('mdc_id', $service_id, 'after')
        ->order_by('mdc_id', 'desc');
        $query = $this->db->get('trx_medical_ptn_now');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    function getPatientData($service_id) {
        $this->db->_protect_identifiers=false;
        $this->db
                 ->select('ts.service_id,p.sd_rekmed,p.sd_name,p.sd_address,p.sd_sex,p.sd_age,p.sd_blood_tp,p.sd_alergi,p.sd_riwayat_penyakit,tv.visit_in,c.class_id,c.class_name,r.room_id')
                 ->join('trx_visit tv', 'tv.visit_rekmed = p.sd_rekmed')
                 ->join('trx_service ts', 'SUBSTR(ts.service_id,4,8) = tv.visit_id')
                 ->join('hos_bed_occupation h', 'h.service_id = ts.service_id')
                 ->join('mst_bed b', 'b.bed_id = h.bed_id')
                 ->join('mst_room r', 'r.room_id = b.room_id')
                 ->join('mst_class c', 'c.class_id = r.class_id')
                 ->where('ts.service_id', $service_id)
                 ->where('h.is_occupied', 1);
        $query = $this->db->get('ptn_social_data p');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    function getPhysician() {
        $this->db
        ->select('m.id_employe,m.sd_name')
        ->where('m.sd_employe_tp', 1);
        $query = $this->db->get('mst_employer m');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getNurses() {
        //$this->db
        //->select('m.id_employe,m.sd_name')
        //->where('m.sd_employe_tp', 2)
        //->where('m.sd_type_user', 23)
        //->where('m.sd_type_user', 24)
        //->where('m.sd_type_user', 29);
        //$query = $this->db->get('mst_employer m');
        $query=$this->db->query("select * from mst_employer m where m.sd_employe_tp = 2 and sd_type_user in (23,24,29)");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getExaminationID($service_id){
        $last_exam_id = $this->db->like('examination_id', $service_id, 'after')->order_by('examination_id', 'DESC')->get('hos_examination', 1, 0)->row();
        $examination_number = count($last_exam_id) == 0 ? '01' : substr($last_exam_id->examination_id,-2) + 1;
        $examination_number = strlen($examination_number) == 1 ? '0'.$examination_number : $examination_number;
        $examination_id = $service_id.'-'.$examination_number;
        return $examination_id;
    }

    function savePhysicianVisit() {
        $service_id = $this->uri->segment(3);
        $physician_id = $this->input->post('physician');
        $datetime = !$this->input->post('datetime') ? date('Y-m-d H:i:s') : $this->input->post('datetime').':00';
        $nurse_id = $this->input->post('nurse');
        $vital_sign = $this->input->post('vs');
        $subjective = $this->input->post('subjective');
        $objective = $this->input->post('objective');
        $diag_id = $this->input->post('diag_id');
        $treat_id = $this->input->post('treat_id');
        $instructions = $this->input->post('instructions');
        $med_id = $this->input->post('med_id');
        $med_type = $this->input->post('type');
        $med_rule = $this->input->post('rule');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $batch = $this->input->post('batch');
        $examination_id = $this->getExaminationID($service_id);
        $examination_type = 'visite';

        //arrange data for table hos_examination insertion
        $exam_data = compact('service_id', 'examination_id','datetime', 'physician_id', 'nurse_id','examination_type');

        //arrange data for table trx_medical_ptn_now insertion
        $ptn_now_data = array();
        if ($vital_sign['weight'] != NULL || $vital_sign['height'] != NULL || $vital_sign['blood_pressure']['systole'] != NULL || $vital_sign['blood_pressure']['diastole'] != NULL || $vital_sign['consciousness'] != NULL || $vital_sign['pulse'] != NULL || $vital_sign['respiration_rate'] != NULL || $vital_sign['temperature'] != NULL) {
            $ptn_now_data = array(
                'mdc_id' => $examination_id,
                'ptn_medical_weight' => $vital_sign['weight'],
                'ptn_medical_height' => $vital_sign['height'],
                'ptn_medical_blod_sy' => $vital_sign['blood_pressure']['systole'],
                'ptn_medical_blod_ds' => $vital_sign['blood_pressure']['diastole'],
                'ptn_medical_kesadaran' => $vital_sign['consciousness'],
                'ptn_medical_nadi' => $vital_sign['pulse'],
                'ptn_medical_respirationrate' => $vital_sign['respiration_rate'],
                'ptn_medical_temperatur' => $vital_sign['temperature'],
                );
        }

        //arrange data for table trx_medical_anamnesa insertion
        $anam_data = array();
        if ($subjective != NULL) {
            $anam_data = array(
                'mdc_id' => $examination_id,
                'ma_desc' => $subjective,
                );
        }

        //arrange data for table trx_medical_objective insertion
        $obj_data = array();
        if ($objective != NULL) {
            $obj_data = array(
                'mdc_id' => $examination_id,
                'mo_desc' => $objective,
                );
        }

        //arrange data for table trx_diagnosa_treathment & trx_diagnosa_treathment_detail insertion
        $diag_data = $diag_details_data = array();
        if ($diag_id[0] != NULL) {
            $diagnose_id = 'DA-'.substr($examination_id,3);
            $k = 0;
            for ($i = 0; $i < count($diag_id); $i++) {
                if ($diag_id[$i] != NULL) {
                    $diag_id_num = strlen($i) == 1 ? '0'.($i+1) : ($i+1);

                    $diag_data[$i]['mdc_id'] = $examination_id;
                    $diag_data[$i]['dat_id'] = $diagnose_id . '-' . $diag_id_num;
                    $diag_data[$i]['dat_diag'] = $diag_id[$i];
                    $diag_data[$i]['dat_note'] = $instructions[$i];

                    for ($j = 0; $j < count($treat_id[$i + 1]); $j++) {
                        $diag_details_data[$k]['dat_id'] = $diag_data[$i]['dat_id'];
                        $diag_details_data[$k]['dat_treat'] = $treat_id[$i + 1][$j];
                        $k++;
                    }
                    $diag_id_num++;
                }
            }
        }

        //arrange data for table trx_recipe and trx_recipe_details
        $recipe_data = $prescription_data = $prescription_details_data = array();

        if ($med_id[0] != NULL && $quantity[0] != NULL && $price[0] != NULL) {
            $prescription_id = 'RS-'.substr($examination_id,3).'-01';
            $recipe_data = array(
                'mdc_id' => $examination_id,
                'recipe_id' => $prescription_id,
                'recipe_paramedic_price' => 0
            );

            $prescription_data = array(
                'prescription_id' => $prescription_id,
                'status' => 0
            );

            for ($i = 0; $i < count($med_id); $i++) {
                if ($med_id[$i] != NULL && $quantity[$i] != NULL) {
                    $prescription_details_data[$i]['recipe_id'] = $prescription_id;
                    $prescription_details_data[$i]['recipe_medicine'] = $med_id[$i];
                    $prescription_details_data[$i]['recipe_rule'] = $med_rule[$i].'. '.ucfirst($med_type[$i]);
                    $prescription_details_data[$i]['recipe_qty'] = $quantity[$i];
                    $prescription_details_data[$i]['recipe_price'] = $price[$i];
                    $prescription_details_data[$i]['recipe_batch'] = $batch[$i];
                }
            }
        }

        $this->db->trans_start();
        $this->db->insert('hos_examination', $exam_data);
        if (!empty($ptn_now_data)) {
            $this->db->insert('trx_medical_ptn_now', $ptn_now_data);
        }
        if (!empty($anam_data)) {
            $this->db->insert('trx_medical_anamnesa', $anam_data);
        }
        if (!empty($obj_data)) {
            $this->db->insert('trx_medical_objective', $obj_data);
        }
        if (!empty($recipe_data)) {
            $this->db->insert('trx_recipe', $recipe_data);
        }
        if (!empty($prescription_data)) {
            $this->db->insert('hos_prescription', $prescription_data);
        }
        if (!empty($diag_data)) {
            $this->db->insert_batch('trx_diagnosa_treathment', $diag_data);
        }
        if (!empty($diag_details_data)) {
            $this->db->insert_batch('trx_diagnosa_treathment_detail', $diag_details_data);
        }
        if (!empty($prescription_details_data)) {
            $this->db->insert_batch('trx_recipe_detail', $prescription_details_data);
        }
        $this->calculate_bill($examination_id);
        $this->db->trans_complete();

        $success = TRUE;
        if ($this->db->trans_status() === FALSE) {
            $success = FALSE;
        }
        return $success;
    }

    function is_paid($service_id) {
        $query = $this->db->get_where('trx_bill_detail', array('bill_id' => 'BL-'.substr($service_id,3,11), 'payment_status' => 0));
        return $query->num_rows() == 0 ? TRUE : FALSE;
    }

    //hendri, 11 februari 2015
    function saveVitalSign(){
        $service_id = $this->uri->segment(3);
        $vital_sign = $this->input->post('vs');
        $examination_id = $this->getExaminationID($service_id);
        //arrange data for table trx_medical_ptn_now insertion
        $ptn_now_data = array();
        if ($vital_sign['weight'] != NULL || $vital_sign['height'] != NULL || $vital_sign['blood_pressure']['systole'] != NULL || $vital_sign['blood_pressure']['diastole'] != NULL || $vital_sign['consciousness'] != NULL || $vital_sign['pulse'] != NULL || $vital_sign['respiration_rate'] != NULL || $vital_sign['temperature'] != NULL) {
            $ptn_now_data = array(
                'mdc_id' => $examination_id,
                'ptn_medical_weight' => $vital_sign['weight'],
                'ptn_medical_height' => $vital_sign['height'],
                'ptn_medical_blod_sy' => $vital_sign['blood_pressure']['systole'],
                'ptn_medical_blod_ds' => $vital_sign['blood_pressure']['diastole'],
                'ptn_medical_kesadaran' => $vital_sign['consciousness'],
                'ptn_medical_nadi' => $vital_sign['pulse'],
                'ptn_medical_respirationrate' => $vital_sign['respiration_rate'],
                'ptn_medical_temperatur' => $vital_sign['temperature'],
                );
        }
        $this->db->trans_start();
        if (!empty($ptn_now_data)) {
            $this->db->insert('trx_medical_ptn_now', $ptn_now_data);
        }$this->db->trans_complete();
        $success = TRUE;
        if ($this->db->trans_status() === FALSE) {
            $success = FALSE;
        }
        return $success;
    }

    function checkOut($service_id) {
        $this->db->where(array('service_id' => $service_id, 'is_occupied' => 1));
        $this->db->update('hos_bed_occupation', array('is_occupied' => 0));
    }

    function hospitalDischarge($service_id) {
        //cek apakah sudah checkout
        $query = $this->db->get_where('hos_bed_occupation', array('service_id' => $service_id,'is_occupied' => 1));
        $checkout_status = $query->num_rows() == 0 ? TRUE : FALSE;

        //cek apakah semua pembayaran telah dilunasi
        $payment_status = $this->is_paid($service_id);
        $return = $checkout_status && $payment_status;
        if ($return) {
            $visit_id = substr($service_id, 3,8);
            $visit_data['visit_status'] = 5;
            $visit_data['visit_out'] = date('Y-m-d H:i:s');

            $bill_id = 'BL-'.substr($service_id, 3,8);
            $bill_data['bill_status'] = 1;

            $service_data['service_status'] = 5;
            $service_data['service_out'] = date('Y-m-d H:i:s');

            $this->db->trans_start();
            $this->db->where('bill_id', $service_id);
            $this->db->update('trx_bill', $bill_data);

            $this->db->where('service_id', $service_id);
            $this->db->update('trx_service', $service_data);

            $this->db->where('visit_id',$visit_id);
            $this->db->update('trx_visit',$visit_data);

            $this->db->trans_complete();

            $return = TRUE;
            if ($this->db->trans_status() === FALSE) {
                $return = FALSE;
            }
        }

        return $return;
    }

    function examinationHistory($service_id){
        //mendapatkan tanggal awal pemeriksaan
        $this->db->select('t.service_in')
        ->where('t.service_id',$service_id);
        $hos_start = $this->db->get('trx_service t');

        if($hos_start->num_rows() > 0){
            //mendapatkan riwayat pemeriksaan
            $this->db->select('h.examination_id,h.datetime,h.examination_type,m1.sd_name as physician,m2.sd_name as nurse')
            ->join('mst_employer m1','m1.id_employe = h.physician_id','left')
            ->join('mst_employer m2','m2.id_employe = h.nurse_id','left')
            ->where('service_id',$service_id);
            $query = $this->db->get('hos_examination h');

            $hos_start_date = new DateTime($hos_start->row()->service_in);
            $get_start_date = $hos_start_date->format('d-m-Y');
            $get_start_time = $hos_start_date->format('H:i');
            $date_milestone = $get_start_date;
            $day_count = 0;
            $week_milestone = $exam_count = 1;

            if($query->num_rows() > 0){
                foreach($query->result_array() as $key => $data){
                    $date = new DateTime($data['datetime']);

                    $interval = $date->diff($hos_start_date)->format('%a');
                    $weeks_count = ceil($interval/7);
                    $weeks_count = $weeks_count == 0 ? 1 : $weeks_count;

                    $get_date = $date->format('d-m-Y');
                    $get_time = $date->format('H:i');

                    if($key == 0){
                        $days[$day_count]['name'] = pretty_date($get_start_date,false);
                        $days[$day_count]['details'][] = array(
                            'time' => $get_start_time,
                            'id' => '',
                            'action' => 'Masuk rawat inap'
                            );
                    }

                    if($weeks_count != $week_milestone){
                        $days = array();
                        $week_milestone = $weeks_count;
                    }

                    if($get_date != $date_milestone){
                        $day_count++;
                        $date_milestone = $get_date;
                        $exam_count = 1;
                    }

                    if($data['examination_type'] == 'visite'){
                        $action = "Visite Dokter oleh {$data['physician']}";
                    }elseif($data['examination_type'] == 'regular'){
                        $action = "Keperawatan oleh {$data['nurse']}";
                    }
                    $days[$day_count]['name'] = pretty_date($data['datetime'],false);
                    $days[$day_count]['details'][] = array(
                        'time' => $get_time,
                        'id' => $data['examination_id'],
                        'action' => $action
                        );

                    $weeks[$weeks_count]['name'] = "Minggu ".($weeks_count);
                    $weeks[$weeks_count]['details'] = $days;
                }
            }else{
                $days[$day_count]['name'] = pretty_date($get_start_date,false);
                $days[$day_count]['details'][] = array(
                    'time' => $get_start_time,
                    'id' => '',
                    'action' => 'Masuk rawat inap'
                    );
                $weeks[0]['name'] = "Minggu 1";
                $weeks[0]['details'] = $days;
            }
            return $weeks;
        }else{
            return array();
        }
    }

    function physicianVisitDetails($examination_id){
        //get patient status
        $this->db->select(
            'he.datetime,me1.sd_name as physician,me2.sd_name as nurse,psd.sd_blood_tp,tma.ma_desc,tmo.mo_desc,tmpn.ptn_medical_weight,
            tmpn.ptn_medical_height,tmpn.ptn_medical_blod_sy,
            tmpn.ptn_medical_blod_ds,tmpn.ptn_medical_kesadaran,tmpn.ptn_medical_nadi,tmpn.ptn_medical_respirationrate,
            tmpn.ptn_medical_temperatur'
            )
        ->join('mst_employer me1','me1.id_employe = he.physician_id','left')
        ->join('mst_employer me2','me2.id_employe = he.nurse_id','left')
        ->join('trx_medical_anamnesa tma','tma.mdc_id = he.examination_id','left')
        ->join('trx_medical_objective tmo','tmo.mdc_id = he.examination_id','left')
        ->join('trx_medical_ptn_now tmpn','tmpn.mdc_id = he.examination_id','left')
        ->join('trx_visit tv','tv.visit_id = SUBSTR(he.service_id,4,8)','left')
        ->join('ptn_social_data psd','psd.sd_rekmed = tv.visit_rekmed','left')
        ->where('he.examination_id',$examination_id);
        $patient_status = $this->db->get('hos_examination he')->row_array();

        //get diagnose
        $this->db->select('tdt.dat_id,tdt.dat_case,tdt.dat_note,md.indonesian,mt.treat_name')
        ->join('trx_diagnosa_treathment_detail tdtd','tdtd.dat_id = tdt.dat_id','left')
        ->join('mst_diagnosa md','md.diag_id = tdt.dat_diag','left')
        ->join('mst_treathment mt','mt.treat_id = tdtd.dat_treat','left')
        ->where('tdt.mdc_id',$examination_id);
        $patient_diagnose = $this->db->get('trx_diagnosa_treathment tdt')->result_array();

        //get medication
        $this->db->select('tre.recipe_id,trd.recipe_medicine,iim.im_name,trd.recipe_rule,trd.recipe_note,trd.recipe_qty')
        ->join('trx_recipe_detail trd','trd.recipe_id = tre.recipe_id','left')
        ->join('inv_item_master iim','iim.im_id = trd.recipe_medicine','left')
        ->where('tre.mdc_id',$examination_id);
        $patient_medication = $this->db->get('trx_recipe tre')->result_array();

        //get concoction
        $this->db->select('tra.racikan_id,tra.racikan_name,tra.racikan_sediaan,tra.racikan_qty,tra.racikan_rule,tra.racikan_note')
        ->where('mdc_id',$examination_id);
        $patient_concoction = $this->db->get('trx_racikan tra')->result_array();

        return compact('patient_status','patient_concoction','patient_medication','patient_diagnose');
    }

    function nursingDetails($examination_id){
        //get pic
        $this->db->select('me.sd_name,he.datetime');
        $this->db->join('mst_employer me','me.id_employe = he.nurse_id');
        $this->db->where('examination_id',$examination_id);
        $pic = $this->db->get('hos_examination he')->row_array();

        //get nic
        $this->db->select('hnd.nurse_diag_id,mnd.diagnosis_name,mt.treat_name,hndd.nic_notes');
        $this->db->join('mst_nursing_diagnosis mnd','mnd.diagnosis_id = hnd.diag_id');
        $this->db->join('hos_nursing_diagnosis_detail hndd','hndd.nurse_diag_id = hnd.nurse_diag_id');
        $this->db->join('mst_treathment mt','mt.treat_id = hndd.nic_id');
        $this->db->where('hnd.mdc_id',$examination_id);
        $nic = $this->db->get('hos_nursing_diagnosis hnd')->result_array();

        //get treatment
        $this->db->select('mt.treat_name,hnt.notes');
        $this->db->join('mst_treathment mt','mt.treat_id = hnt.treatment_id');
        $this->db->where('hnt.mdc_id',$examination_id);
        $treatment = $this->db->get('hos_nursing_treatment hnt')->result_array();

        return compact('pic','nic','treatment');
    }

    function list_of_medicine($service_id){
        $this->db
            ->select('examination_id')
            ->where('service_id',$service_id);
        $query1 = $this->db->get('hos_examination he');

        if($query1->num_rows() > 0){
            foreach($query1->result() as $q){
                $examination_id[] = $q->examination_id;
            }

            $this->db->select('trd.recipe_id,trd.recipe_medicine,iim.im_name,recipe_qty')
                ->join('trx_recipe_detail trd','trd.recipe_id = tr.recipe_id')
                ->join('inv_item_master iim','iim.im_id = trd.recipe_medicine','left')
                ->join('hos_prescription hp','hp.prescription_id = trd.recipe_id')
                ->where('trd.recipe_qty != 0.0')
                ->where('hp.status != 0')
                ->where_in('tr.mdc_id',$examination_id);
            $query2 = $this->db->get('trx_recipe tr');

            return $query2->result_array();
        }else{
            return array();
        }
    }

    function get_treatment($class_id){
        $query = $this->input->get('q');
        $this->db->select('*');
        if($query!=null){
            $this->db->or_like('lower(mt.treat_name)', "$query",'both');
            //$this->db->or_like('treat_id', "$query",'both');
        }

        if(null != $class_id){
            //$this->db->where('(class_id = 0 OR class_id = '.$class_id.')');
        }
        $this->db->join('mst_koefisien_fee mkf','mkf.koef_id=mt.koef_id');
        $this->db->where('mt.treat_status = 1');
        $this->db->from('mst_treathment mt');
        //$this->db->limit(10);
        $data = $this->db->get()->result();

        foreach ($data as $datas) {
            $data['results'][] = array(
                'id'    => "$datas->treat_id",
                'name'  => "$datas->treat_name"
                );
        }

        return $data;
    }

    function calculate_bill($examination_id){
        $this->load->model('rawat_jalan/poli_model');
        $bill_id = 'BL-'.substr($examination_id,3,11);
        $adm = $this->poli_model->get_detail_adm($examination_id);
        if($adm->num_rows() >= 1){
            $dt = array();
            foreach ($adm->result() as $key => $value) {
                $dt[] = array(
                    'bill_id' => $bill_id,
                    'service_type' => 9,
                    'service_name' => $value->adm_name,
                    'price' => $value->adm_fee,
                    'paramedic_price' => 0,
                    'other_price' => 0,
                    'total_price' => $value->adm_fee,
                    'payment_status'=> 0,
                );
            }
            if(!empty($dt) ){
                $this->db->insert_batch('trx_bill_detail',$dt);
            }
        }

        // insert diagnosa dan treatment to bill
        $diagnosa   = $this->poli_model->get_detail_diagnosa($examination_id);
        if( $diagnosa->num_rows() >= 1 ){
            $dt = array();
            foreach ($diagnosa->result() as $key => $value) {
                $dt[]   = array(
                    'bill_id' => $bill_id,
                    'service_type' => 6,
                    'service_reference' => $value->dat_id,
                    'service_name' => (isset($value->treat_name)) ? $value->treat_name : '-',
                    'price' => (isset($value->treat_item_price)) ? ($value->treat_item_price) : 0,
                    'paramedic_price' => 0,
                    'other_price' => 0,
                    'total_price' => (isset($value->treat_item_price)) ? ($value->treat_item_price) : 0,
                    'payment_status' => 0,
                );
            }
            if(!empty($dt) ){
                $this->db->insert_batch('trx_bill_detail',$dt);
            }
        }
    }

    function returned_medicine_id($prescription_id) {
        $service_type = substr($prescription_id,0,2);
        $prescription_id = substr($prescription_id, 3,11);
        $format = 'RT-'.$prescription_id;
        $q = $this->db->query("SELECT substr(id, 16, 2) AS n
             FROM hos_returned_medicine WHERE id LIKE '$format%' ORDER BY n DESC LIMIT 1");

        if ($q->num_rows() == 0) {
            $no = '01';
        } else {
            $nl = intval(db_conv($q)->n);
            $nl++;
            $no = rtrim(sprintf("%'02s\n", $nl));
        }
        return $format ."-". $no;
    }

    function returned_medicine(){
        if(!empty($this->input->post('returned_medicine'))){
            $this->db->trans_start();
            foreach($this->input->post('returned_medicine') as $key => $rm){
                if("" == $rm){
                    continue;
                }

                $id = $this->returned_medicine_id($this->input->post('prescription_id')[0]);
                $medicines = $this->input->post('medicine_id');
                $medicine_id = $medicines[$key];
                $prescription = $this->input->post('prescription_id');
                $prescription_id = $prescription[$key];
                $quantity = $rm;
                $status = 0;
                $pic = $this->session->userdata('emp_id');
                $returned_medicine = compact('id', 'prescription_id', 'medicine_id', 'quantity', 'pic', 'status');
                // insert hos_returned_medicine
                $this->db->insert('hos_returned_medicine',$returned_medicine);

                // update trx_recipe_detail
                $return_qty = (float) $quantity;
                $sql = 'UPDATE `trx_recipe_detail` SET `recipe_qty` = `recipe_qty` - ?, `modi_id` = ? WHERE `recipe_id` = ? AND `recipe_medicine` = ?';
                $this->db->query($sql,array($return_qty,$pic,$prescription_id,$medicine_id));

                // insert trx_bill_detail with negative value
                $inv_item_master = $this->db->get_where('inv_item_master', array('im_id' => $medicine_id))->row();
                $bill_data[] = array(
                    'bill_id'       => 'BL-'.substr($prescription_id,3,11),
                    'service_type'  => 5,
                    'service_reference' => $id,
                    'service_name'  => "Retur ".$inv_item_master->im_name." qty : -".$return_qty,
                    'price'         => -($inv_item_master->im_item_price * $return_qty),
                    'paramedic_price' => 0,
                    'other_price'   => 0,
                    'total_price'   => -($inv_item_master->im_item_price * $return_qty),
                    'payment_status'=> 0,
                );
            }
            $this->db->insert_batch('trx_bill_detail',$bill_data);
            $this->db->trans_complete();

            $success = TRUE;
            if ($this->db->trans_status() === FALSE) {
                $success = FALSE;
            }
            return $success;
        }else{
            return true;
        }
    }

    function returned_medicine_history($service_id){
        $this->db->select('hrm.*,iim.im_name,me.sd_name');
        $this->db->join('inv_item_master iim','iim.im_id = hrm.medicine_id');
        $this->db->join('mst_employer me','me.id_employe = hrm.pic');
        $this->db->where('SUBSTR(prescription_id,4,11)',substr($service_id,3));
        $this->db->where('hrm.status != 0');
        $query = $this->db->get('hos_returned_medicine hrm');

        if($query->num_rows() > 0){
            $date_mark = $prescription_mark = '';
            $date_index = $prescription_index = -1;
            foreach($query->result() as $key => $result){
                $date = date('d-m-Y',strtotime($result->datetime));
                if($date_mark != $date){$date_index++;$date_mark = $date;}
                if($prescription_mark != $result->prescription_id){$prescription_index++;$prescription_mark = $result->prescription_id;}
                $data[$date_index]['date'] = pretty_date($result->datetime);
                $data[$date_index]['prescriptions'][$prescription_index]['prescription_id'] = $result->prescription_id;
                $data[$date_index]['prescriptions'][$prescription_index]['medicines'][] = array(
                    'medicine' => $result->im_name,
                    'quantity' => $result->quantity,
                    'pic' => $result->sd_name,
                    'status' => $result->status == 1 ? 'Retur' : 'Batal Retur'
                );
            }
            return $data;
        }else{
            return array();
        }
    }

    function labRadRegistration($service_reference,$service_type){
        // cek apakah pasien masih memiliki layanan lab / rad yang belum selesai
        // debug_array($this->input->post('penunjang'),true);
        // debug_array($this->input->post('type'),true);
        // debug_array($this->input->post('nama_penunjang'));
        $visit_id = substr($service_reference,3,8);
        $medrec = $this->db->get_where('trx_visit',array('visit_id' => $visit_id))->row()->visit_rekmed;

        $this->db->like('service_id',$service_type.'-'.$visit_id,'after');
        $this->db->where('service_reference',$service_reference);
        $this->db->where('service_status != 5');
        $query = $this->db->get('trx_service');

        switch($service_type){
            case 'LB' :
                $type = 'lab';
                $service_name = 'Laboratorium';
                break;
            case 'RD' :
                $type = 'rad';
                $service_name = 'Radiologi';
                break;
            case 'IGD' :
                $type = 'igd';
                $service_name = 'IGD';
                break;
        }

        if($query->num_rows() == 0){
            $this->load->model('pendaftaran/pendaftaran_model');

            if($type == "igd"){
                $result = $this->pendaftaran_model->daftarIgd();

            }else{
                $result = $this->pendaftaran_model->daftarLabRad($type,$visit_id,0,$service_reference,$medrec);

            }

            return array('success' => $result ? 'success' : 'failed','message' => $result ? '' : 'Transaksi gagal');
        }else{
            return array('success' => 'failed','message' => 'Pasien masih terdaftar pada layanan '.$service_name.' ');
        }
    }

    function getNursingDiagnosis(){
        $this->db->like('diagnosis_name',$this->input->get('q'));
        $query = $this->db->get('mst_nursing_diagnosis');
        return $query->result();
    }

    function getNursingNIC($nurse_diagnosis){
        $this->db->select('mt.treat_id,mt.treat_name,mt.treat_item_price');
        $this->db->join('map_diagnosis_nic mdn','mdn.treatment_id = mt.treat_id');
        $this->db->join('mst_nursing_diagnosis mnd','mnd.diagnosis_id = mdn.diagnosis_id');
        $this->db->where('mnd.diagnosis_id',$nurse_diagnosis);
        $query = $this->db->get('mst_treathment mt');

        return $query->result_array();
    }

    function saveNursingPlan(){
        $service_id = $this->uri->segment(3);
        $nurse_id = $this->input->post('nurse');
        $datetime = !$this->input->post('datetime') ? date('Y-m-d H:i:s') : $this->input->post('datetime').':00';
        $diag_id = $this->input->post('diag_id');
        $nic = $this->input->post('nic');
        $nic_notes = $this->input->post('nic_note');
        $treat_id = $this->input->post('treat_id');
        $treat_note = $this->input->post('treat_note');
        $examination_id = $this->getExaminationID($service_id);
        $examination_type = 'regular';

        //hos_examination
        $exam_data = compact('service_id', 'examination_id','datetime', 'nurse_id', 'examination_type');

        //hos_nursing_diagnosis && hos_nursing_diagnosis_detail
        $diag_data = $diag_details_data = array();
        $diagnose_id = 'ND-'.substr($examination_id,3);
        $k = 0;
        for ($i = 0; $i < count($diag_id); $i++) {
            if ($diag_id[$i] != NULL) {
                $diag_id_num = strlen($i) == 1 ? '0'.($i+1) : ($i+1);
                $diag_data[$i]['mdc_id'] = $examination_id;
                $diag_data[$i]['nurse_diag_id'] = $diagnose_id . '-' . $diag_id_num;
                $diag_data[$i]['diag_id'] = $diag_id[$i];

                for ($j = 0; $j < count($nic[$i + 1]); $j++) {
                    $diag_details_data[$k]['nurse_diag_id'] = $diag_data[$i]['nurse_diag_id'];
                    $diag_details_data[$k]['nic_id'] = $nic[$i + 1][$j];
                    $diag_details_data[$k]['nic_notes'] = $nic_notes[$i + 1][$j];
                    $k++;
                }
                $diag_id_num++;
            }
        }


        //hos_nursing_treatment
        $treat_data = $bill_data = array();
        if ($treat_id[0] != NULL) {
            for($i=0;$i<count($treat_id);$i++){
                $treat_data[] = array(
                    'mdc_id' => $examination_id,
                    'treatment_id' => $treat_id[$i],
                    'notes' => $treat_note[$i]
                );
            }

            $bill_id = 'BL-'.substr($examination_id,3,11);

            //get bill detail from mst_treatment
            $this->db->select('treat_name,treat_item_price');
            $this->db->where_in('treat_id',$treat_id);
            $query = $this->db->get('mst_treathment');
            $treat_bill = $query->result();

            foreach($treat_bill as $tb){
                if($tb->treat_item_price != 0){
                    $bill_data[] = array(
                        'bill_id' => $bill_id,
                        'service_type' => 6,
                        'service_name' => $tb->treat_name,
                        'price' => $tb->treat_item_price,
                        'paramedic_price' => 0,
                        'other_price' => 0,
                        'total_price' => $tb->treat_item_price,
                        'payment_status'=> 0
                    );
                }
            }
        }

        $this->db->trans_start();
        //insert data table hos_examination
        $this->db->insert('hos_examination',$exam_data);
        //insert data table hos_nursing_diagnosis
        if(!empty($diag_data)){
            $this->db->insert_batch('hos_nursing_diagnosis',$diag_data);
        }
        //insert data table hos_nursing_diagnosis_detail
        if(!empty($diag_details_data)){
            $this->db->insert_batch('hos_nursing_diagnosis_detail',$diag_details_data);
        }
        //insert data table hos_nursing_treatment
        if(!empty($treat_data)){
            $this->db->insert_batch('hos_nursing_treatment',$treat_data);
        }
        //insert data table trx_bill_detail
        if(!empty($bill_data)){
            $this->db->insert_batch('trx_bill_detail',$bill_data);
        }
        $this->db->trans_complete();

        $success = TRUE;
        if ($this->db->trans_status() === FALSE) {
            $success = FALSE;
        }
        return $success;
    }

    function getExaminationType($examination_id){
        $query = $this->db->get_where('hos_examination',array('examination_id' => $examination_id));
        if($query->num_rows() > 0){
            return $query->row()->examination_type;
        }else{
            return false;
        }
    }

    function getAvailableRooms(){

    }

    public function getRoomPayment($service_id){
        // mengambil tanggal mulai memakai bed
        $this->db->select('date_occupied')
                 ->where('is_occupied', 1)
                 ->where('service_id', $service_id);
        $check_in = $this->db->get('hos_bed_occupation')->row()->date_occupied;

        // Jika kosong, ambil tanggal dari trx_service
        if(null == $check_in){
            $check_in = $this->db->get_where(
                'trx_service',
                 array('service_id' => $service_id))
                 ->row();
            $check_in = $check_in->service_in;
        }

        // menghitung jumlah hari dari tanggal awal masuk, jika 0 bulatkan menjadi 1
        $check_in   = new DateTime($check_in);
        $now        = new DateTime('now');
        $day_passed = (int) $check_in->diff($now)->format('%a');
        $day_passed = $day_passed == 0 ? 1 : $day_passed;

        //mengambil data harga kamar
        $this->db
             ->select('mc.class_name,mc.price')
             ->join('mst_bed mb', 'mb.bed_id = hbo.bed_id')
             ->join('mst_room mr', 'mr.room_id = mb.room_id')
             ->join('mst_class mc', 'mc.class_id = mr.class_id')
             ->where(array('hbo.service_id' => $service_id, 'hbo.is_occupied' => 1));
        $rented_room = $this->db->get('hos_bed_occupation hbo')->row();

        // kembalikan hasil perhitungan
        $price = (int) $rented_room->price * (int) $day_passed;
        $tag   = "Kelas : ".strtoupper($rented_room->class_name)." X {$day_passed} Hari";
        return compact('price','tag');
    }

    public function changeRoom($service_id,$bed_id){
        $this->db->trans_start();

        $update = array(
            'is_occupied'     => 0,
            'date_unoccupied' => date('Y-m-d H:i:s')
        );

        $this->db->where('service_id', $service_id);
        $this->db->update('hos_bed_occupation', $update);

        $insert = array(
            'service_id'    => $service_id,
            'bed_id'        => $bed_id,
            'is_occupied'   => 1,
            'date_occupied' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('hos_bed_occupation', $insert);

        $this->db->trans_complete();

        $success = true;
        if ($this->db->trans_status() === false) {
            $success = false;
        }
        return $success;
    }
}
