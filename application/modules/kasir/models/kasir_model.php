<?php

if (!defined("BASEPATH"))
    exit;

class Kasir_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }

    // function get_detail_bill($param = array()) {
    //     extract($param);
    //     if (isset($visit_type) && $visit_type == 'ranap') {
    //         $this->db->where(array('tvb.visit_id' => $visit_id, 'tvb.payment_status' => 0));
    //         $query = $this->db->get('trx_visit_bill tvb');
    //         if ($query->num_rows() > 0) {
    //             $result = array();
    //             foreach ($query->result() as $value) {
    //                 $bill_date = date('Y-m-d', strtotime($value->datetime));
    //                 $result[$bill_date][$value->service_id][] = $value;
    //             }

    //             //membuat catatan pembayaran untuk sewa kamar
    //             //menghitung jumlah hari
    //             $visit_in = date('Y-m-d', strtotime($visit_in));
    //             $check_in = new DateTime($visit_in);
    //             $now = new DateTime('now');
    //             $day_passed = (int) $check_in->diff($now)->format('%a');
    //             $day_passed = $day_passed == 0 ? 1 : $day_passed;

    //             //mengambil data harga kamar
    //             $this->db
    //             ->select('mc.class_name,mc.price')
    //             ->join('mst_bed mb', 'mb.bed_id = hbo.bed_id')
    //             ->join('mst_room mr', 'mr.room_id = mb.room_id')
    //             ->join('mst_class mc', 'mc.class_id = mr.class_id')
    //             ->where(array('hbo.visit_id' => $visit_id, 'hbo.is_occupied' => 1));
    //             $rented_room = $this->db->get('hos_bed_occupation hbo')->row();

    //             //menggabungkan data tagihan sewa kamar dengan data lainnya
    //             $bill_date = new DateTime('now');
    //             $bill_date = $bill_date->format('Y-m-d');
    //             $service_id = 8;
    //             $is_room_paid = $this->is_room_paid($bill_date);
    //             if(!$is_room_paid){
    //                 $room = new stdClass();
    //                 $room->visit_id = $visit_id;
    //                 $room->service_id = $service_id;
    //                 $room->service_name = "Kelas : ".strtoupper($rented_room->class_name)." X {$day_passed} Hari";
    //                 $room->price = $rented_room->price * $day_passed;
    //                 $room->paramedic_price = 0;
    //                 $room->other_price = 0;
    //                 $room->total_price = $rented_room->price * $day_passed;
    //                 $room->payment_status = 0;
    //                 $result[$bill_date][$service_id][] = $room;
    //             }
    //             return $result;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         $this->db->select('*');
    //         $this->db->where(array('visit_rekmed' => $sd_rekmed, 'visit_status' => 3, 'payment_status' => 0));
    //         $this->db->join('trx_visit_bill tvb', 'tvb.visit_id = tv.visit_id');
    //         return $this->db->get('trx_visit tv');
    //     }
    // }

    function is_room_paid($bill_id,$datetime){
        $this->db->where('bill_id',$bill_id);
        $this->db->where('payment_status',0);
        $this->db->where('DATE(datetime)',$datetime);
        $this->db->where('service_type',8);
        $query = $this->db->get('trx_bill_detail');
        $result = $query->num_rows() > 0 ? TRUE : FALSE;
        return $result;
    }

    function is_type_medical($service_id, $type) {
        if(substr($service_id, 0,2) == $type)
            return true;
        else
            return false;
    }

    //hendri, 11 februari 2015
}
