<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rawat_inap extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('rawat_inap_model', 'rim');
        $this->load->model('rawat_jalan/poli_model', 'pm');
    }

    function index() {
        $data['main_view'] = 'index';
        $data['title'] = 'Rawat Inap';
        $data['cf'] = $this->cf;
        $data['is_fullpage'] = true;
        $data['current'] = '';
        $data['desc'] = 'Daftar Pasien Rawat Inap ';
        $this->load->view('template', $data);
    }

    function pasien_ranap() {
        $config['sTable'] = "trx_service ts";
        //$config['aColumns'] = array("service_in", "service_id", "sd_name", "class_name", "room_id");
        $config['aColumns'] = array("service_in", "service_id", "sd_rekmed", "sd_name", "class_name", "room_id");
        //$config['aColumns_format'] = array("ts.service_in", "ts.service_id", "p.sd_name", "c.class_name", "r.room_id");
        $config['aColumns_format'] = array("ts.service_in", "ts.service_id", "p.sd_rekmed", "p.sd_name", "c.class_name", "r.room_id");
        $config['php_format'] = array("datetime", "","", "", "", "");
        $config['join'][] = array('trx_visit tv', 'tv.visit_id = SUBSTR(ts.service_id,4,8)');
        $config['join'][] = array('ptn_social_data p', 'p.sd_rekmed = tv.visit_rekmed');
        $config['join'][] = array('hos_bed_occupation h', 'h.service_id = ts.service_id');
        $config['join'][] = array('mst_bed b', 'b.bed_id = h.bed_id');
        $config['join'][] = array('mst_room r', 'r.room_id = b.room_id');
        $config['join'][] = array('mst_class c', 'c.class_id = r.class_id');
        //$config['where'][] = "ts.service_status != 5";
        $config['where'][] = "ts.service_status != 5 and h.is_occupied = 1";
        $config['key'] = "ts.service_id";
        $config['searchColumn'] = array("sd_name", "class_name", "room_id");
        $config['aksi'] = array('stat' => false);
        init_datatable($config);
    }

    function pemeriksaan($service_id) {
        $data['patient_data'] = $this->rim->getPatientData($service_id);
        $data['title'] = 'Rawat Inap';
        $data['is_fullpage'] = TRUE;
        $data['main_view'] = 'pemeriksaan';
        $data['penunjang_lab'] = $this->db->get_where('mst_lab_treathment',array('ds_status'=>1,'ds_type'=>'LAB'));
        $data['penunjang_rad'] = $this->db->get_where('mst_lab_treathment',array('ds_status'=>1,'ds_type'=>'RAD'));
        $data['patient'] = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $data['patient_data']['sd_rekmed']));
        $this->load->view('template', $data);
    }

    function visite_dokter($service_id) {
        $data['pic']['service_in'] = $this->rim->getServiceDetails($service_id)->service_in;
        $data['pic']['physicians'] = $this->rim->getPhysician();
        $data['pic']['nurses'] = $this->rim->getNurses();
        $patient_data = $this->rim->getPatientData($service_id);
        $data['patient_data'] = $patient_data;
        $data['selecttext_rute']['rute_obat'] = $this->list_rute_obat();
        $this->load->view('visite_dokter', $data);
    }

    function list_rute_obat(){
        $selecttext='';
        $query=$this->db->get('mst_rute_inv');
        foreach ($query->result() as $key) {
            $selecttext.="<option value='".$key->rute_name."'>".$key->rute_name."</option>";
        }
        return $selecttext;
    }

    function simpan_visite_dokter() {
        $result = $this->rim->savePhysicianVisit();
        $success = $result ? 'success' : 'failed';
        echo json_encode(array('success' => $success));
    }

    //hendri, 11 Februari 2015
    function simpan_vital_sign(){
        $result = $this->rim->saveVitalSign();
        $success = $result ? 'success' : 'failed';
        echo json_encode(array('success' => $success));
    }

    function checkout($service_id){
        //mengecek apakah pasien masih memiliki tanggungan pembayaran
        $is_paid = $this->rim->is_paid($service_id);
        if($is_paid){
            $this->rim->checkOut($service_id);
            $this->rim->hospitalDischarge($service_id);
            $success = 'success';
        }else{
            $success = 'failed';
        }
        echo json_encode(compact('success'));
    }

    function riwayat_pemeriksaan($service_id){
        $data['history'] = $this->rim->examinationHistory($service_id);
        $this->load->view('examination_history',$data);
    }

    function detail_pemeriksaan($examination_id){
        $exam_type = $this->rim->getExaminationType($examination_id);
        if($exam_type == 'visite'){
            $data['examination_details'] = $this->rim->physicianVisitDetails($examination_id);
            $this->load->view('physician_visit_details',$data);
        }elseif($exam_type == 'regular'){
            $data['examination_details'] = $this->rim->nursingDetails($examination_id);
            $this->load->view('nursing_details',$data);
        }
    }

    function daftar_obat($service_id){
        $data['returned_medicine_history'] = $this->rim->returned_medicine_history($service_id);
        $data['list_of_medicine'] = $this->rim->list_of_medicine($service_id);
        $this->load->view('retur_obat',$data);
    }

    function get_treatment($class_id = null){
        $data = $this->rim->get_treatment($class_id);
        echo json_encode($data);
    }

    function retur_obat(){
        $success = $this->rim->returned_medicine();
        $success = $success ? 'success' : 'failed';
        echo json_encode(array('success' => $success));
    }

    function pendaftaran_lab_rad($service_reference,$service_type){
        $result =  $this->rim->labRadRegistration($service_reference,$service_type);
        echo json_encode(array('success' => $result['success'],'message' => $result['message']));
    }

    function perencanaan_keperawatan($service_id){
        $data['diagnosis']['service_in'] = $this->rim->getServiceDetails($service_id)->service_in;
        $data['diagnosis']['nurses'] = $this->rim->getNurses();
        $data['treatment']['patient_data'] = $this->rim->getPatientData($service_id);
        $data['treatment']['service_in'] = $data['diagnosis']['service_in'];
        $this->load->view('nursing_plan',$data);
    }

    function get_nursing_diagnosis(){
        $data = $this->rim->getNursingDiagnosis();
        foreach ($data as $d) {
            $data['results'][] = array(
                'id'    => "$d->diagnosis_id",
                'name'  => "$d->diagnosis_name",
            );
        }
        echo json_encode($data);
    }

    function get_nursing_nic($nurse_diagnosis){
        $data = $this->rim->getNursingNIC($nurse_diagnosis);
        echo json_encode($data);
    }

    function simpan_perencanaan_keperawatan(){
        $result = $this->rim->saveNursingPlan();
        $success = $result ? 'success' : 'failed';
        echo json_encode(array('success' => $success));
    }

    function room_options(){
        $this->load->model('pendaftaran/pendaftaran_model');
        $data['classes'] = $this->pendaftaran_model->getClasses(array($this->input->post('class_id')));
        $data['patient'] = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $this->input->post('patient_medrec')));
        $this->load->view('room_options',$data);
    }

    function vital_sign($service_id){
        $patient_data = $this->rim->getPatientData($service_id);
        $data['service_in'] = $this->rim->getServiceDetails($service_id)->service_in;
        $data['vital_sign'] = $this->rim->getVitalSign($service_id);
        $data['vital_sign']['blood_type'] = $patient_data['sd_blood_tp'];
        $this->load->view('vital_sign', $data);
    }

    public function change_room() {
        /*
            - Menghitung total tagihan kamar yang lama,
              dimulai dari date_occupied (atau service_in kalau date_occupied belum ada) dan memasukkan ke table trx_bill_detail
            - Membebaskan bed, set is_occupied pada bed yang lama menjadi 0. Set tanggal date_unoccupied
            - Tambah row baru untuk bed yang baru
         */

        $service_id = $this->input->post('service_id');
        $bed_id     = explode('-', $this->input->post('room'));
        $bed_id     = end($bed_id);

        $bill = $this->rim->getRoomPayment($service_id);

        $room_payment['bill_id']         = 'BL-'.substr($service_id,3);
        $room_payment['service_type']    = 8;
        $room_payment['service_name']    = $bill['tag'];
        $room_payment['price']           = $bill['price'];
        $room_payment['paramedic_price'] = 0;
        $room_payment['other_price']     = 0;
        $room_payment['total_price']     = $bill['price'];
        $room_payment['payment_status']  = 0;
        $room_payment['cashier_id']      = null;

        $this->db->insert('trx_bill_detail',$room_payment);

        $change_room = $this->rim->changeRoom($service_id, $bed_id);
    }

    function rekam_medis($sd_rekmed){
        $this->load->model('rawat_jalan/poli_model');
        $data['med_recs']   = $this->poli_model->get_ptn_rekmed($sd_rekmed);
        //$data['url_poli']   = $this->url_poli;
        $this->load->view('rekam_medis',$data);    
    }

    function single_rekmed($mdc_id){
        $this->load->model('igd/igd_model','igd_model');
        $data['mdc_id'] = $mdc_id;
        $data['dokter']     = $this->igd_model->get_dokter($mdc_id)->row();

        $service = $this->db->get_where('trx_service',array('service_id'=>$mdc_id))->row();
        $data['visit_status'] = $this->db->get_where('mst_visit_status',array('vs_id'=>$service->service_status))->row();
        
        $this->db->_protect_identifiers=false;
        $this->db->join('trx_service ts','substr(ts.service_id,4,8) = tv.visit_id');
        $this->db->join('trx_medical tm','ts.service_id = tm.mdc_id','left');
        $this->db->join('mst_poly mp','tm.pl_id = mp.pl_id','left');
        $this->db->where('ts.service_id',$mdc_id);
        $data['medical']    = $this->db->get('trx_visit tv');
        $data['ptn_now']    = $this->igd_model->get_medical_ptn_now($mdc_id);
        
        $data['diagnosa']   = $this->igd_model->get_diagnosa($mdc_id);
        $data['anamnesa']   = $this->db->get_where('trx_medical_anamnesa',array('mdc_id'=>$mdc_id));
        $data['objective']  = $this->db->get_where('trx_medical_objective',array('mdc_id'=>$mdc_id));
        $data['detail_diagnosa']    = $this->igd_model->get_detail_diagnosa($mdc_id);
        $data['obat']       = $this->igd_model->get_detail_resep($mdc_id);
        $data['racikan']        = $this->igd_model->get_racikan($mdc_id);
        $data['surat_keterangan']   = $this->db->get_where('trx_reference',array('mdc_id'=>$mdc_id));
        $data['penunjang'] = $this->igd_model->get_trx_penunjang_rekmed($mdc_id);
        // $data['penunjang_detail'] = $this->igd_model->get_trx_penunjang_detail($lab_queue_id);
        $data['visite'] = $this->igd_model->get_visite_detail($mdc_id);
        $this->load->view('single_rekmed',$data);
    }
}
