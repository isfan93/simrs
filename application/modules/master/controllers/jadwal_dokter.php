<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_dokter extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('jadwal_dokter_model');
	}
	
	public function index(){
		$data['main_view']	= 'jadwal_dokter/index';
		$data['title']		= 'Jadwal Dokter';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		//$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$data['user_type']		= $this->db->get('mst_type_user');
		$data['listdokter']	= $this->db->query("select * from mst_employer where sd_employe_tp = '1'")->result();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'jadwal_dokter/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['poli']		= $this->db->get('mst_poly');
		//$data['religi']		= $this->db->get('mst_religion');
		//$data['regency']	= $this->db->get('mst_regency');		
		//$data['menu']		= $this->db->get_where('sys_menu',array('modul_id'=>$modul['modul_id']));
		$this->load->view('template',$data);
	}

	function get_dokterX(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->where('sd_type_user','1');
		$this->db->from('mst_employer');
		if($query!=null){
			$this->db->like('sd_name', "$query",'both');
		}
		$data = $this->db->get()->result();
		//var_dump($data);
		//echo $this->db->last_query();die();
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->id_employ",
				'name'	=> "$datas->sd_name"
			);
		}

		echo json_encode($data);
	}

	function create(){
		//$rm = $this->get_rm();
		$data 				= $this->input->post('mst');
		 
		$this->db->insert('trx_dr_schedule', $data);
		 
		 
	}
	
	/*
	function update($id){
		$data = $this->input->post('ds');	
		$this->db->where('', $id);
		$this->db->update('', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));//mxdnya?
	}

	function delete($id){
		$data = array('status' => 0);
		$this->db->where('', $id);
		$this->db->update('', $data);
		$this->session->set_flashdata('message',array('success','Data berhasil dihapus'));
		redirect(cur_url(-2));
	}*/

	function cetak($rm){
		$data['ds']			= db_conv($this->db->get_where('v_data_patient',array('sd_rekmed'=>$rm)));
		$data['main_view']	= 'pendaftaran_baru/cetak';
		$this->load->view('template_print',$data);
	}
 
	function proses($rm){
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['rekmed']			=  $rm;
		$data['main_view']	= 'pendaftaran_baru/proses';
		$this->load->view('template',$data);
	}
	
	function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		
		$data['poli2'] = $this->db->query('select * from mst_poly')->result();
		$data['shift'] = $this->db->query('select * from mst_shift')->result();
		$data['datas'] = $this->jadwal_dokter_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('jadwal_dokter/data',$data);

	}
	
	function get_pop(){
		$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('jadwal_dokter/popup',$data);
	}
	
	function get_pop_update($key){
		//$data['result']	= $this->db->query('select * from mst_shift')->result();
		$data['result']	= $this->jadwal_dokter_model->get_Detail($key);
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('jadwal_dokter/popup_update',$data);
	}
	
	function add_schdl(){
		$data=$this->input->post('mst');
		$result=$this->jadwal_dokter_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
			redirect (cur_url(-1));
		}
	}
	
	function delete_list() {
        $kode = $this->input->post('kode');
        $this->jadwal_dokter_model->deleteData($kode);
    }

    function delete($kode) {
        $this->jadwal_dokter_model->deleteData($kode);
    }
	
	function update(){
		$data = $this->input->post('sch');
		$this->jadwal_dokter_model->updateMaster($data);
	}

	public function get_dokter()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$this->db->select('id_employe as id,sd_name as name');
		$this->db->where('sd_employe_tp','1');
		$this->db->like('lower(sd_name)', $q, 'both');
		$data = $this->db->get('mst_employer')->result_array();
		
		//$data = ->get('mst_poly',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}
	
	function additional_dr(){
 		$data = $this->input->post('add');
		$this->db->insert('mst_employer', $data);
    }

    public function get_poli()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('pl_id as id,pl_name as name')->like('lower(pl_name)', $q, 'both')->get('mst_poly',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}
}