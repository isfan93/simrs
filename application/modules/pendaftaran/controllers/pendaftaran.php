<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendaftaran extends MY_Controller {
    function __construct() {
        parent::__construct();
        //load models
        $this->load->model('pendaftaran_model', 'pendaftaran_m');
    }

    function index() {
        $data['main_view'] = 'index';
        $data['title'] = 'Pendaftaran';
//        $data['cf'] = $this->cf;
        $data['regency'] = $this->repo_model->get('mst_regency');
        $data['is_fullpage'] = TRUE;
        $this->load->view('template', $data);
    }

    function getPatientData() {
        $results = $this->pendaftaran_m->getPatientData();
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                $results[$key] = $value;
            }
            $data['result'] = $results;
            $this->load->view('daftar_pasien', $data);
        } else {
            $response = "";
            echo $response;
        }
    }

    function getProvinsi() {
        $id_regency = $this->input->post('id_regency');
        $result = $this->pendaftaran_m->getProvinsi($id_regency);
        echo $result;
    }

    function pendaftaran_baru() {
        $data['medical_record'] = $this->pendaftaran_m->getMedRecNumber();
        $data['religi'] = $this->repo_model->get('mst_religion');
        $data['regency'] = $this->repo_model->get('mst_regency');
        $data['marital_status'] = $this->repo_model->get('mst_marital_st');
        $data['occupation'] = $this->repo_model->get('mst_occupation');
        $data['nationality'] = $this->repo_model->get('mst_nationality');
        $data['education'] = $this->repo_model->get('mst_education');
        $this->load->view('data_sosial', $data);
    }

    function edit_data_pasien($no_rekmed) {
        $data['religi'] = $this->repo_model->get('mst_religion');
        $data['regency'] = $this->repo_model->get('mst_regency');
        $data['marital_status'] = $this->repo_model->get('mst_marital_st');
        $data['occupation'] = $this->repo_model->get('mst_occupation');
        $data['nationality'] = $this->repo_model->get('mst_nationality');
        $data['education'] = $this->repo_model->get('mst_education');
        $data['social_data'] = (array) $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $data['province'] = (array) $this->repo_model->get('mst_province', array('mpr_id' => $data['social_data']['sd_reg_prov']));
        $data['is_edit'] = TRUE;
        $this->load->view('data_sosial', $data);
    }

    function tambah_data_pasien() {
        $data = $this->data_sosial();
        $data['sd_rekmed'] = $this->pendaftaran_m->getMedRecNumber();
        $result = $this->repo_model->insert('ptn_social_data', $data);
        $success = TRUE == $result ? 'success' : 'failed';
        echo json_encode(array('success' => $success));
    }

    function ubah_data_pasien($no_rekmed) {
        $social_data = $this->input->post('ds');
        $card_number = $social_data['sd_card_number'];
        $patient_data = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $update_barcode = FALSE;
        if ($patient_data->sd_card_number != $card_number) {
            $update_barcode = TRUE;
        }
        $data = $this->data_sosial($update_barcode);
        $result = $this->repo_model->update('ptn_social_data', array('sd_rekmed' => $no_rekmed), $data);
        $success = TRUE == $result ? 'success' : 'failed';
        echo json_encode(array('success' => $success));
    }

    function createBarcode($no_rekmed, $card_number, $update_barcode = FALSE) {
        $this->load->library('barcode');
        $filepath = '/uploads/barcode/' . $no_rekmed . '.png';
        return $this->barcode->generate($card_number, $filepath, $update_barcode);
    }

    function data_sosial($update_barcode = FALSE) {
        $social_data = $this->input->post('ds');
        $data['sd_rekmed'] = $social_data['sd_rekmed'];
        $data['sd_card_number'] = $social_data['sd_card_number'];
        $data['sd_barcode'] = $this->createBarcode($data['sd_rekmed'], $data['sd_card_number'], $update_barcode);
        $data['sd_title'] = $social_data['sd_title'];
        $data['sd_name'] = ucwords(strtolower($social_data['sd_name']));
        $data['sd_sex'] = isset($social_data['sd_sex']) ? strtoupper($social_data['sd_sex']) : "";
        $data['sd_place_of_birth'] = ucwords($social_data['sd_place_of_birth']);
        $data['sd_age'] = $social_data['sd_age'];
        $birthdate = $this->input->post('tgl');
        if ("" != $birthdate[0] && "" != $birthdate[1] && "" != $birthdate[2]) {
            $day = $birthdate[0];
            $month = $birthdate[1];
            $year = $birthdate[2];
        } else {
            $day = 1;
            $month = 1;
            $year = date('Y') - $data['sd_age'];
        }
        $data['sd_date_of_birth'] = $year . "-" . $month . "-" . $day;
        $data['sd_blood_tp'] = isset($social_data['sd_blood_tp']) ? $social_data['sd_blood_tp'] : "";
        $rt_rw = $this->input->post('rt');
        $data['sd_rt_rw'] = ("" != $rt_rw[0] && "" != $rt_rw[1]) ? $rt_rw[0] . "/" . $rt_rw[1] : "";
        $formatted_rt_rw = ("" != $rt_rw[0] && "" != $rt_rw[1]) ? 'RT ' . $rt_rw[0] . " / RW " . $rt_rw[1] : "";
        $data['sd_reg_street'] = ucwords($social_data['sd_reg_street']);
        $data['sd_reg_desa'] = ucwords($social_data['sd_reg_desa']);
        $data['sd_reg_kec'] = ucwords($social_data['sd_reg_kec']);
        $data['sd_reg_kab'] = $social_data['sd_reg_kab'];
        $data['sd_reg_prov'] = $social_data['sd_reg_prov'];
        $data['sd_telp'] = $social_data['sd_telp'];
        $data['sd_address'] = $data['sd_reg_street'] . " " . $formatted_rt_rw . " " . $data['sd_reg_desa'] . " " . $data['sd_reg_kec'];
        $data['sd_citizen'] = isset($social_data['sd_citizen']) ? $social_data['sd_citizen'] : "";
        $data['sd_marital_st'] = isset($social_data['sd_marital_st']) ? $social_data['sd_marital_st'] : "";
        $data['sd_religion'] = isset($social_data['sd_religion']) ? $social_data['sd_religion'] : "";
        $data['sd_education'] = isset($social_data['sd_education']) ? $social_data['sd_education'] : "";
        $data['sd_occupation'] = isset($social_data['sd_occupation']) ? $social_data['sd_occupation'] : "";
        $data['sd_institute'] = isset($social_data['sd_institute']) ? ucwords($social_data['sd_institute']) : "";
        $data['sd_status'] = 1;
        return $data;
    }

    function form_data_keluarga($no_rekmed) {
        $data['no_rekmed'] = $no_rekmed;
        $data['family_rel'] = $this->repo_model->get('mst_family_relation');
        $data['education'] = $this->repo_model->get('mst_education');
        $data['occupation'] = $this->repo_model->get('mst_occupation');
        sleep(1);
        $social_data = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $data['patient_address'] = $social_data->sd_address;
        $data['patient_phone'] = $social_data->sd_telp;
        $data['is_edit'] = FALSE;
        $this->load->view('data_keluarga', $data);
    }

    function form_edit_keluarga($no_rekmed) {
        $data['no_rekmed'] = $no_rekmed;
        $data['family_rel'] = $this->repo_model->get('mst_family_relation');
        sleep(1);
        $data['education'] = $this->repo_model->get('mst_education');
        $data['occupation'] = $this->repo_model->get('mst_occupation');
        $social_data = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $family_data = $this->repo_model->get('ptn_family', array('fm_id' => $social_data->fm_id));
        $data['patient_address'] = $social_data->sd_address;
        $data['patient_phone'] = $social_data->sd_telp;
        $data['family_data'] = $family_data != FALSE ? (array) $family_data : array();
        $data['is_edit'] = TRUE;
        $this->load->view('data_keluarga', $data);
    }

    function data_keluarga() {
        $data['fm_name'] = ucwords($this->input->post('fm_name'));
        $data['fm_sex'] = $this->input->post('fm_sex');
        $data['fm_relation'] = $this->input->post('fm_relation');
        if(NULL == $this->input->post('fm_address') && NULL != $data['fm_name']){
           $patient_data = $this->repo_model->get('ptn_social_data',array('sd_rekmed' => $this->input->post('sd_rekmed')));
           $data['fm_address'] = $patient_data->sd_address;
           $data['fm_phone'] = $patient_data->sd_telp;
        }else{
            $data['fm_address'] = $this->input->post('fm_address');
            $data['fm_phone'] = $this->input->post('fm_phone');
        }
        $data['fm_phone'] = $this->input->post('fm_phone');
        $data['fm_education'] = $this->input->post('fm_education');
        $data['fm_occupation'] = $this->input->post('fm_occupation');
        return $data;
    }

    function tambah_data_keluarga() {
        if ($this->input->post('fm_name') != null) {
            $data = $this->data_keluarga();
            $fm_id = $this->repo_model->insert('ptn_family', $data, FALSE);
            $result = $this->repo_model->update('ptn_social_data', array('sd_rekmed' => $this->input->post('sd_rekmed')), array('fm_id' => $fm_id));
            $success = $result ? 'success' : 'failed';
        } else {
            $success = 'success';
        }
        echo json_encode(array('success' => $success));
    }

    function ubah_data_keluarga() {
        $data = $this->data_keluarga();
        $social_data = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $this->input->post('sd_rekmed')));
        $result = $this->repo_model->update('ptn_family', array('fm_id' => $social_data->fm_id), $data);
        $success = $result ? 'success' : 'failed';
        echo json_encode(array('success' => $success));
    }

    function pilih_layanan($no_rekmed = null) {
        if($no_rekmed != null)
        {
            $data['patient_availability'] = $this->pendaftaran_m->isPatientAvailable($no_rekmed);
            $data['no_rekmed'] = $no_rekmed;
            if ($this->session->userdata('group_id') == 9) {
                $this->load->view('pilih_layanan_igd', $data);
            } else if ($this->session->userdata('group_id') == 6) {
                $this->load->view('pilih_layanan_lab', $data);
            } else if ($this->session->userdata('group_id') == 12) {
                $this->load->view('pilih_layanan_lab', $data);
            } else {
                $this->load->view('pilih_layanan', $data);
            }
        }else{
            $this->load->view('pilih_layanan_pasien_umum');
        }
    }

    function rawat_jalan($no_rekmed) {
        $visit_record = $this->repo_model->get('trx_visit', array('visit_rekmed' => $no_rekmed));
        $is_new_patient = empty($visit_record) ? TRUE : FALSE;
        $data['patient'] = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $data['poly'] = $this->pendaftaran_m->getPoly();
        $data['is_new_patient'] = $is_new_patient;
        $data['physicians'] = $this->repo_model->get('mst_employer', array('sd_employe_tp' => 1,'sd_status'=>1));
        $this->load->view('rawat_jalan', $data);
    }

    function rawat_inap($no_rekmed) {
        $visit_record = $this->repo_model->get('trx_visit', array('visit_rekmed' => $no_rekmed));
        $is_new_patient = empty($visit_record) ? TRUE : FALSE;
        $data['patient'] = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $data['classes'] = $this->pendaftaran_m->getClasses();
        $data['is_new_patient'] = $is_new_patient;
        $data['physicians'] = $this->repo_model->get('mst_employer');
        $this->load->view('rawat_inap', $data);
    }

    function getRoom($class) {
        $rooms = $this->pendaftaran_m->getRoom($class);
        echo json_encode($rooms);
    }

    // function daftar_igd() {
    //     $igd = $this->pendaftaran_m->daftar_igd();
    //     $success = !$igd ? 'failed' : 'success';
    //     echo json_encode(array('success' => $success, 'sd_rekmed' => $this->input->post('no_rekmed')));
    // }

    function igd($no_rekmed) {
        $visit_record = $this->repo_model->get('trx_visit', array('visit_rekmed' => $no_rekmed));
        $is_new_patient = empty($visit_record) ? TRUE : FALSE;
        $data['patient'] = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $data['classes'] = $this->pendaftaran_m->getClasses();
        $data['is_new_patient'] = $is_new_patient;
        $data['dokter_jaga_igd'] = $this->repo_model->get('mst_employer', array('sd_employe_tp' => 1,'sd_type_user' => 39,'sd_status'=>1));
        $this->load->view('igd', $data);
    }

    function transferIgd($service_reference){
        // cek apakah pasien masih memiliki layanan igd yang belum selesai
        $visit_id = $this->input->post('visit_id');
        $service_id = $this->input->post('service_id');
        // $medrec = $this->db->get_where('trx_visit',array('visit_id' => $visit_id))->row()->visit_rekmed;
        $service_type = 'IG';
       
        $this->db->like('service_id',$service_type.'-'.$visit_id,'after');
        $this->db->where('service_reference',$service_reference);
        $this->db->where('service_status < 5');
        $query = $this->db->get('trx_service');
        // debug_array( $this->input->post());
        if($query->num_rows() == 0){
            
            if(substr($service_id, 0,2) == 'RJ')
            {
                $dataQueue['queo_status'] = 2;
                $this->db->where('queo_id',$service_id);
                $this->db->update('trx_queue_outpatient',$dataQueue);
            }

            $data['service_status'] = 3;
            $this->db->where('service_id',$service_id);
            $this->db->update('trx_service',$data);

            $this->load->model('pendaftaran/pendaftaran_model');
            $result = $this->pendaftaran_model->daftarAll();
            
            echo json_encode(array('success' => $result ? 'success' : 'failed','message' => $result ? '' : 'Transaksi gagal'));
        }else{
            echo json_encode(array('success' => 'failed','message' => 'Pasien telah terdaftar di IGD'));
        }
    }

    function transferRanap($service_reference){
        $visit_id = $this->input->post('visit_id');
        $service_id = $this->input->post('service_id');
        $service_type = 'RN';
        
        // cek apakah pasien masih memiliki layanan ranap yang belum selesai
        $this->db->where('service_status < 5');
        $this->db->like('service_id',$service_type.'-'.$visit_id,'after');
        // $this->db->or_where('service_reference',$service_reference);
        $query = $this->db->get('trx_service');
        if($query->num_rows() == 0){

            if(substr($service_id, 0,2) == 'RJ')
            {
                $dataQueue['queo_status'] = 2;
                $this->db->where('queo_id',$service_id);
                $this->db->update('trx_queue_outpatient',$dataQueue);
            }
            
            $data['service_status'] = 3;
            $data['service_note'] = $this->input->post('service_note');
            $this->db->where('service_id',$service_id);
            $this->db->update('trx_service',$data);

            $this->load->model('pendaftaran/pendaftaran_model');
            $result = $this->pendaftaran_model->daftarAll();
            echo json_encode(array('success' => $result ? 'success' : 'failed','message' => $result ? '' : 'Transaksi gagal'));
        }else{
            echo json_encode(array('success' => 'failed','message' => 'Pasien telah terdaftar di Rawat Inap'));
        }
    }

    function getSchedule($polyclinic) {
        $data['shifts'] = (array) $this->repo_model->get('mst_shift');
        $data['schedules'] = json_encode($this->pendaftaran_m->getSchedule($polyclinic));
        $this->load->view('dokter_jaga', $data);
    }

    function getPhysician($polyclinic) {
        $schedule = $this->pendaftaran_m->getSchedule($polyclinic);
        if (!empty($schedule)) {
            $attending_physician = array();
            foreach ($schedule as $value) {
                $day_index = array(
                    'Ahad' => 0,
                    'Senin' => 1,
                    'Selasa' => 2,
                    'Rabu' => 3,
                    'Kamis' => 4,
                    'Jumat' => 5,
                    'Sabtu' => 6
                );

                $now = date('w:G:i');
                $now_details = explode(':', $now);
                $day = (int) $now_details[0];
                $shift_day = $day_index[$value['day']];
                if ($shift_day == $day) {
                    $shift_start = explode(':', $value['shift_start']);
                    $shift_start_sec = (int) $shift_start[0] * 3600 + (int) $shift_start[1] * 60;
                    $shift_end = explode(':', $value['shift_end']);
                    $shift_end_sec = (int) $shift_end[0] * 3600 + (int) $shift_end[1] * 60;
                    $now_sec = (int) $now_details[1] * 3600 + (int) $now_details[2] * 60;
                    if ($now_sec >= $shift_start_sec && $now_sec <= $shift_end_sec) {
                        $attending_physician['id'] = $value['id_employe'];
                        $attending_physician['name'] = $value['sd_name'];
                    }
                }
            }

            if (!empty($attending_physician)) {
                $result['physician'] = $attending_physician;
            } else {
                $result['physician']['id'] = '';
                $result['physician']['name'] = '-';
            }
        } else {
            $result['physician']['id'] = '';
            $result['physician']['name'] = '-';
        }
        echo json_encode($result);
    }

    // function antri_poli() {
    //     $result = $this->pendaftaran_m->antriPoli();
    //     $success = !$result ? 'failed' : 'success';
    //     echo json_encode(array('success' => $success, 'sd_rekmed' => $result));
    // }

    // function daftar_ranap() {
    //     $result = $this->pendaftaran_m->daftarRanap();
    //     $success = TRUE == $result ? 'success' : 'failed';
    //     echo json_encode(array('success' => $success, 'sd_rekmed' => $result));
    // }

    function cetak_barcode($no_rekmed) {
        $data['social_data'] = (array) $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
        $this->load->view('barcode', $data);
    }

    public function daftarAll(){
        $result = $this->pendaftaran_m->daftarAll();
        $success = !$result ? 'failed' : 'success';
        echo json_encode(array('success' => $success, 'visit_id' => $result));
    }

    function cetak_tracer($visit_id = null) {
        if($visit_id != null)
        {
            $view = 'tracer';
            $data['tracer'] = (array) $this->pendaftaran_m->getTracer($visit_id);
            $this->load->view($view, $data);
        }
    }

    // LAB
    function lab($no_rekmed = null) {
        if($no_rekmed != null)
        {
            $visit_record = $this->repo_model->get('trx_visit', array('visit_rekmed' => $no_rekmed));
            $is_new_patient = empty($visit_record) ? TRUE : FALSE;
            $data['patient'] = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
            $data['is_new_patient'] = $is_new_patient;
            $data['dokter_jaga_igd'] = $this->repo_model->get('mst_employer', array('sd_employe_tp' => 1));
            $this->load->view('lab', $data);
        }else
        {
            $data['penunjang'] = $this->db->get_where('mst_lab_treathment',array('ds_status'=>1,'ds_type'=>'LAB'));
            $this->load->view('lab_pasien_umum',$data);
        }
    }

    // RAD
    function rad($no_rekmed = null) {
        if($no_rekmed != null)
        {
            $visit_record = $this->repo_model->get('trx_visit', array('visit_rekmed' => $no_rekmed));
            $is_new_patient = empty($visit_record) ? TRUE : FALSE;
            $data['patient'] = $this->repo_model->get('ptn_social_data', array('sd_rekmed' => $no_rekmed));
            $data['is_new_patient'] = $is_new_patient;
            $data['dokter_jaga_igd'] = $this->repo_model->get('mst_employer', array('sd_employe_tp' => 1));
            $this->load->view('rad', $data);
        }else
        {
            $data['penunjang'] = $this->db->get_where('mst_lab_treathment',array('ds_status'=>1,'ds_type'=>'RAD'));
            $this->load->view('rad_pasien_umum',$data);
        }
    }

    function cetak_form_pasien($no_rekmed){
        $data['social_data'] = $this->repo_model->get('ptn_social_data',array('sd_rekmed' => $no_rekmed));
        $data['social_data'] = !$data['social_data'] ? array() : (array) $data['social_data'];
        $data['family_data'] = $this->repo_model->get('ptn_family',array('fm_id' => $data['social_data']['fm_id']));
        $data['family_data'] = !$data['family_data'] ? array() : (array) $data['family_data'];
        $data['education'] = $this->repo_model->get('mst_education');
        $data['occupation'] = $this->repo_model->get('mst_occupation');
        $data['marital_status'] = $this->repo_model->get('mst_marital_st');
        $data['religion'] = $this->repo_model->get('mst_religion');
        $data['nationality'] = $this->repo_model->get('mst_nationality');
        $data['family_relation'] = $this->repo_model->get('mst_family_relation');
        $data['firstvisit'] = $this->db->query("SELECT * FROM trx_visit  WHERE visit_rekmed = '$no_rekmed' ORDER BY visit_in LIMIT 1")->row_array();
        $this->load->view('form_pasien',$data);
    }

    function cetak_general_consent(){
        $this->load->view('general_consent');
    }
}
