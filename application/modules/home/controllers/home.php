<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'HOME SISTEM ';
        // $data['ds'] = $this->db->order_by('modul_id', 'asc')->get_where('com_modul', array('status' => 1));
        $this->load->view('index', $data);
    }

    function create() {
        $data = $this->input->post('ds');
        $this->db->insert('', $data);
        $this->session->set_flashdata('message', array('success', 'Data berhasil di buat'));
        redirect(cur_url(-1));
    }

    function update($id) {
        $data = $this->input->post('ds');
        $this->db->where('', $id);
        $this->db->update('', $data);
        $this->session->set_flashdata('message', array('success', 'Data berhasil diperbarui'));
        redirect(cur_url(-2));
    }

    function delete($id) {
        $data = array('status' => 0);
        $this->db->where('', $id);
        $this->db->update('', $data);
        $this->session->set_flashdata('message', array('success', 'Data berhasil dihapus'));
        redirect(cur_url(-2));
    }

}
