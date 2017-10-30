<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_mcu_detail extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_mcu_detail_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_mcu_detail/index';
		$data['title']		= 'Data Detail Paket MCU';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		//$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$data['tindakan']	= $this->db->query('select * from mst_treathment where koef_id=14')->result();
		//$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_mcu_detail/index';
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

	function get_rm(){
		$format = DATE('ym');
		$q = $this->db->query("SELECT substr(sd_rekmed, 5, 3) as n 
			  from ptn_social_data where sd_rekmed like '$format%' order by n desc limit 1"); 
		if($q->num_rows() == 0){
			$no = '001';
		}else{
			$nl = intval(db_conv($q)->n);
			$nl++; 
			$no = rtrim(sprintf("%'03s\n",$nl));
		}
		return $format.$no;		
	}

	function create(){
		$data = $this->input->post('mst');
		$this->db->insert('mst_mcu_detail',$data);
	}
	
	 function update(){
		$data = $this->input->post('ds');	
		// debug_array($data);
		$this->db->where('dmcu_id', $data['dmcu_id']);
		$this->db->update('mst_mcu_detail', $data); 
		 
	}

	/*function delete($id){
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
		$data['datas'] = $this->data_mcu_detail_model->get_list();
		//$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$data['tindakan']	= $this->db->query('select * from mst_treathment where koef_id=14')->result();
		$this->load->view('data_mcu_detail/data',$data);

	}
	
	function get_pop(){
		//$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('data_mcu_detail/popup',$data);
	}
	
	function get_pop_update($key){
		//$data['result']	= $this->db->query('select * from mst_shift')->result();
		$data['result']	= $this->data_mcu_detail_model->get_Detail($key);
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('data_mcu_detail/popup_update',$data);
	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_mcu_detail_model->addMaster($data);
		// print_r($data);die;
		if ($result){
			// echo "data berhasil disimpan";
			redirect (cur_url(-1));
		}

	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode == ''){
			//$this->db->where('treat_id',$kode);
			$this->data_mcu_detail_model->deleteData($data);
		}else{
			$this->data_mcu_detail_model->deleteData($kode);
		}
    }
	
	function update_master(){
		$data = $this->input->post('mst');
		$this->db->where('treat_id',$data['treat_id']);
		$this->data_mcu_detail_model->updateMaster($data);
	}
}