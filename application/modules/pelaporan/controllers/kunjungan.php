<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kunjungan extends MY_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('pelaporan_model');
    }

    public function index() {
        $data['main_view'] = 'kunjungan/index';
        $data['title'] = 'Kunjungan';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    public function getKunjungan() {
        $dateStart = $this->input->post('date_start');
        $dateEnd = $this->input->post('date_end');

        $data['title'] = "Rekap Kunjungan Pasien Rumah Sakit \"Intan Husada\" ";
        if (!empty($dateStart) && !empty($dateEnd)) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $dateEnd = date('Y-m-d', strtotime($dateEnd));

            $data['dateStart'] = $dateStart;
            $data['dateEnd'] = $dateEnd;

            $this->db->_protect_identifiers = false;
            $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
            $this->db->where(array('DATE(tv.visit_in) >=' => $dateStart, 'DATE(tv.visit_in) <=' => $dateEnd));
            $this->db->group_by('tv.visit_id');
            $data['kunjungan'] = $this->db->get('trx_visit tv');

            foreach ($data['kunjungan']->result() as $key => $value) {
                $this->db->_protect_identifiers = false;
                $this->db->where(array('substr(ts.service_id,4,8)' => ($value->visit_id)));
                $layanan = $this->db->get('trx_service ts');
                $data['layanan'][$value->visit_id] = $layanan;

                $this->db->select_sum('tbd.total_price');
                $this->db->where(array('substr(tbd.bill_id,4,8)' => ($value->visit_id), 'tbd.payment_status' => '1'));
                $data['bill'][$value->visit_id] = $this->db->get('trx_bill_detail tbd')->row();
            }
        }

        $this->load->view('pelaporan/kunjungan/data_kunjungan', $data);
    }

    public function rawat_jalan() {
        $data['main_view'] = 'kunjungan/rawat_jalan';
        $data['title'] = 'Kunjungan Poli';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    public function getRawatJalan() {
        $dateStart = $this->input->post('date_start');
        $dateEnd = $this->input->post('date_end');

        $jk = $this->input->post('sex'); //========== hendri, 23 April 2015 ========

        $data['title'] = "Rekap Kunjungan Poli Rumah Sakit \"Intan Husada\" ";
        if (!empty($dateStart) && !empty($dateEnd)) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $dateEnd = date('Y-m-d', strtotime($dateEnd));

            $data['dateStart'] = $dateStart;
            $data['dateEnd'] = $dateEnd;

            $this->db->_protect_identifiers = false;
            $this->db->select('tv.*,ts.*,psd.*,mp.pl_name,me.sd_name as dr_name');
            $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
            $this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
            $this->db->join('trx_medical tm', 'tm.mdc_id = ts.service_id');
            $this->db->join('mst_poly mp', 'mp.pl_id = tm.pl_id');
            $this->db->join('mst_employer me', 'me.id_employe = tm.dr_id');
            $this->db->where(array('DATE(tv.visit_in) >=' => $dateStart, 'DATE(tv.visit_in) <=' => $dateEnd, 'substr(ts.service_id, 1,2) =' => 'RJ'));
            if($jk!=''){
                $this->db->where('psd.sd_sex',$jk);
            }
            $this->db->group_by('tv.visit_id');
            $data['kunjungan'] = $this->db->get('trx_visit tv');

            foreach ($data['kunjungan']->result() as $key => $value) {
                $this->db->select_sum('total_price');
                $this->db->where(array('bill_id' => $value->bill_id));
                $this->db->where_not_in('service_type', array('5', '10'));
                $bill = $this->db->get('trx_bill_detail')->row();
                $data['bill'][$value->visit_id] = $bill;
            }
        }

        $this->load->view('pelaporan/kunjungan/data_rawat_jalan', $data);
    }

    public function rawat_inap() {
        $data['main_view'] = 'kunjungan/rawat_inap';
        $data['title'] = 'Kunjungan Rawat Inap';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    public function getRawatInap() {
        $dateStart = $this->input->post('date_start');
        $dateEnd = $this->input->post('date_end');

        $data['title'] = "Rekap Kunjungan Rawat Inap \"Intan Husada\" ";
        if (!empty($dateStart) && !empty($dateEnd)) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $dateEnd = date('Y-m-d', strtotime($dateEnd));

            $data['dateStart'] = $dateStart;
            $data['dateEnd'] = $dateEnd;

            $this->db->_protect_identifiers = false;
            //$this->db->select('tv.*,ts.*,psd.*,mp.pl_name,me.sd_name as dr_name');
            $this->db->select('tv.*,ts.*,psd.*');
            $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
            $this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
            //$this->db->join('trx_medical tm', 'tm.mdc_id = ts.service_id');
            //$this->db->join('mst_poly mp', 'mp.pl_id = tm.pl_id');
            //$this->db->join('mst_employer me', 'me.id_employe = tm.dr_id');
            $this->db->where(array('DATE(tv.visit_in) >=' => $dateStart, 'DATE(tv.visit_in) <=' => $dateEnd, 'substr(ts.service_id, 1,2) =' => 'RN'));
            $this->db->group_by('tv.visit_id');
            $data['kunjungan'] = $this->db->get('trx_visit tv');

            foreach ($data['kunjungan']->result() as $key => $value) {
                $this->db->select_sum('total_price');
                $this->db->where(array('bill_id' => $value->bill_id));
                $this->db->where_not_in('service_type', array('5', '10'));
                $bill = $this->db->get('trx_bill_detail')->row();
                $data['bill'][$value->visit_id] = $bill;
            }
        }

        $this->load->view('pelaporan/kunjungan/data_rawat_inap', $data);
    }

    public function igd() {
        $data['main_view'] = 'kunjungan/igd';
        $data['title'] = 'Kunjungan IGD';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    public function getIgd() {
        $dateStart = $this->input->post('date_start');
        $dateEnd = $this->input->post('date_end');

        $data['title'] = "Rekap Kunjungan IGD Rumah Sakit \"Intan Husada\" ";
        if (!empty($dateStart) && !empty($dateEnd)) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $dateEnd = date('Y-m-d', strtotime($dateEnd));

            $data['dateStart'] = $dateStart;
            $data['dateEnd'] = $dateEnd;

            $this->db->_protect_identifiers = false;
            $this->db->select('tv.*,ts.*,psd.*,mp.pl_name,me.sd_name as dr_name');
            $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
            $this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
            $this->db->join('trx_medical tm', 'tm.mdc_id = ts.service_id');
            $this->db->join('mst_poly mp', 'mp.pl_id = tm.pl_id');
            $this->db->join('mst_employer me', 'me.id_employe = tm.dr_id');
            $this->db->where(array('DATE(tv.visit_in) >=' => $dateStart, 'DATE(tv.visit_in) <=' => $dateEnd, 'substr(ts.service_id, 1,2) =' => 'IG'));
            $this->db->group_by('tv.visit_id');
            $data['kunjungan'] = $this->db->get('trx_visit tv');

            foreach ($data['kunjungan']->result() as $key => $value) {
                $this->db->select_sum('total_price');
                $this->db->where(array('bill_id' => $value->bill_id));
                $this->db->where_not_in('service_type', array('5', '10'));
                $bill = $this->db->get('trx_bill_detail')->row();
                $data['bill'][$value->visit_id] = $bill;
            }
        }

        $this->load->view('pelaporan/kunjungan/data_igd', $data);
    }

    public function lab() {
        $data['main_view'] = 'kunjungan/laboratorium';
        $data['title'] = 'Kunjungan Laboratorium';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    public function getLab() {
        $dateStart = $this->input->post('date_start');
        $dateEnd = $this->input->post('date_end');

        $data['title'] = "Rekap Kunjungan Laboratorium Rumah Sakit \"Intan Husada\" ";
        if (!empty($dateStart) && !empty($dateEnd)) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $dateEnd = date('Y-m-d', strtotime($dateEnd));

            $data['dateStart'] = $dateStart;
            $data['dateEnd'] = $dateEnd;

            $this->db->_protect_identifiers = false;
            $this->db->select('tv.*,ts.*,psd.*,me.sd_name as dr_name');
            $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
            $this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
            $this->db->join('trx_lab_queue tlq', 'tlq.lab_queue_id = ts.service_id');
            $this->db->join('mst_employer me', 'me.id_employe = tlq.dr_id');
            $this->db->where(array('DATE(tv.visit_in) >=' => $dateStart, 'DATE(tv.visit_in) <=' => $dateEnd, 'substr(ts.service_id, 1,2) =' => 'LB'));
            $this->db->group_by('tv.visit_id');
            $data['kunjungan'] = $this->db->get('trx_visit tv');

            foreach ($data['kunjungan']->result() as $key => $value) {
                $this->db->select_sum('total_price');
                $this->db->where(array('bill_id' => $value->bill_id));
                $bill = $this->db->get('trx_bill_detail')->row();
                $data['bill'][$value->visit_id] = $bill;
            }
        }

        $this->load->view('pelaporan/kunjungan/data_laboratorium', $data);
    }

    public function rad() {
        $data['main_view'] = 'kunjungan/radiologi';
        $data['title'] = 'Kunjungan Radiologi';
        $data['cf'] = $this->cf;
        $data['current'] = '';
        $data['desc'] = 'Description. ';
        $this->load->view('template', $data);
    }

    public function getRad() {
        $dateStart = $this->input->post('date_start');
        $dateEnd = $this->input->post('date_end');

        $data['title'] = "Rekap Kunjungan Radiologi Rumah Sakit \"Intan Husada\" ";
        if (!empty($dateStart) && !empty($dateEnd)) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $dateEnd = date('Y-m-d', strtotime($dateEnd));

            $data['dateStart'] = $dateStart;
            $data['dateEnd'] = $dateEnd;

            $this->db->_protect_identifiers = false;
            $this->db->select('tv.*,ts.*,psd.*,me.sd_name as dr_name');
            $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
            $this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
            $this->db->join('trx_lab_queue tlq', 'tlq.lab_queue_id = ts.service_id');
            $this->db->join('mst_employer me', 'me.id_employe = tlq.dr_id');
            $this->db->where(array('DATE(tv.visit_in) >=' => $dateStart, 'DATE(tv.visit_in) <=' => $dateEnd, 'substr(ts.service_id, 1,2) =' => 'RD'));
            $this->db->group_by('tv.visit_id');
            $data['kunjungan'] = $this->db->get('trx_visit tv');

            foreach ($data['kunjungan']->result() as $key => $value) {
                $this->db->select_sum('total_price');
                $this->db->where(array('bill_id' => $value->bill_id));
                $bill = $this->db->get('trx_bill_detail')->row();
                $data['bill'][$value->visit_id] = $bill;
            }
        }

        $this->load->view('pelaporan/kunjungan/data_radiologi', $data);
    }

    public function detail($visit_id) {
        $data['title'] = 'Detail Billing';
        $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed', 'left');
        $this->db->where('tv.visit_id', $visit_id);
        $data['patient'] = $this->db->get('trx_visit tv')->row();
        $data['mst_service'] = $this->db->get('mst_service');
        $data['visit_id'] = $visit_id;

        $this->db->_protect_identifiers = false;
        $this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
        $this->db->where('tv.visit_id', $visit_id);
        $service = $this->db->get('trx_visit tv');
        if ($service->num_rows() >= 1) {
            foreach ($service->result() as $key => $value) {
                $this->db->select('tbd.*');
                $this->db->join('trx_bill tb', 'tbd.bill_id = tb.bill_id');
                $this->db->where(array('tb.bill_id' => $value->bill_id, 'tbd.payment_status' => '0'));
                $bill = $this->db->get('trx_bill_detail tbd');
                if ($bill->num_rows() >= 1) {
                    foreach ($bill->result() as $k => $v) {
                        $date = date('Y-m-d', strtotime($v->datetime));
                        $data['bill'][$value->service_id][$date][$v->service_type][] = $v;
                    }
                    $this->load->model('kasir/kasir_model');
                    if ($this->kasir_model->is_type_medical($value->service_id, 'RN')) {
                        $this->load->model('rawat_inap/rawat_inap_model', 'rim');
                        $room_bill = $this->rim->getRoomPayment($value->service_id);

                        $date = new DateTime('now');
                        $date = $date->format('Y-m-d');
                        $service_type = 8;
                        $is_room_paid = $this->kasir_model->is_room_paid($value->bill_id, $date);
                        if (!$is_room_paid) {
                            $room = new stdClass();
                            $room->bill_id = $value->bill_id;
                            $room->service_type = $service_type;
                            $room->service_name = $room_bill['tag'];
                            $room->price = $room_bill['price'];
                            $room->paramedic_price = 0;
                            $room->other_price = 0;
                            $room->total_price = $room_bill['price'];
                            $room->payment_status = 0;
                            $data['bill'][$value->service_id][$date][$service_type][] = $room;
                        }
                    }
                }
            }
        }
        $this->load->view('/kunjungan/detail_kunjungan', $data);
    }

    public function struk($visit_id) {
        $data['title'] = 'Detail Billing';
        $this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed', 'left');
        $this->db->where('tv.visit_id', $visit_id);
        $data['patient'] = $this->db->get('trx_visit tv')->row();
        $data['mst_service'] = $this->db->get('mst_service');
        $data['visit_id'] = $visit_id;

        $this->db->_protect_identifiers = false;
        $this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
        $this->db->where('tv.visit_id', $visit_id);
        $service = $this->db->get('trx_visit tv');
        if ($service->num_rows() >= 1) {
            foreach ($service->result() as $key => $value) {
                $this->db->select('tbd.*');
                $this->db->join('trx_bill tb', 'tbd.bill_id = tb.bill_id');
                $this->db->where(array('tb.bill_id' => $value->bill_id, 'tbd.payment_status' => '1'));
                $bill = $this->db->get('trx_bill_detail tbd');
                if ($bill->num_rows() >= 1) {
                    foreach ($bill->result() as $k => $v) {
                        $date = date('Y-m-d', strtotime($v->datetime));
                        $data['bill'][$value->service_id][$date][$v->service_type][] = $v;
                    }
                    $this->load->model('kasir/kasir_model');
                    if ($this->kasir_model->is_type_medical($value->service_id, 'RN')) {
                        $this->load->model('rawat_inap/rawat_inap_model', 'rim');
                        $room_bill = $this->rim->getRoomPayment($value->service_id);

                        $date = new DateTime('now');
                        $date = $date->format('Y-m-d');
                        $service_type = 8;
                        $is_room_paid = $this->kasir_model->is_room_paid($value->bill_id, $date);
                        if (!$is_room_paid) {
                            $room = new stdClass();
                            $room->bill_id = $value->bill_id;
                            $room->service_type = $service_type;
                            $room->service_name = $room_bill['tag'];
                            $room->price = $room_bill['price'];
                            $room->paramedic_price = 0;
                            $room->other_price = 0;
                            $room->total_price = $room_bill['price'];
                            $room->payment_status = 0;
                            $data['bill'][$value->service_id][$date][$service_type][] = $room;
                        }
                    }
                }
            }
        }
        $this->load->view('/kunjungan/detail_kunjungan', $data);
    }
}

// end class
