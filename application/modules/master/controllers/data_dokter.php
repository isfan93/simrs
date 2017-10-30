<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_dokter extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['main_view']	= 'data_dokter/index';
		$data['title']		= 'Data Dokter';
		$data['current']	= 1;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['religi']		= $this->db->get('mst_religion');
		$data['regency']	= $this->db->get('mst_regency');
		$data['province']	= $this->db->get('mst_province');
		$data['occupation']	= $this->db->get('mst_occupation');
		$data['nationality']= $this->db->get('mst_nationality');
		$data['education']  = $this->db->get('mst_education');
		//$data['rekmed']		= $this->get_rm();
		$data['desc']		= 'Description. ';
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
		$rm = $this->get_rm();
		$data 				= $this->input->post('ds');
		$tgl = $this->input->post('tgl');krsort($tgl);
		$rt  = $this->input->post('rt');
		$data['sd_date_of_birth']	= implode("-", $tgl);
		$data['sd_rt_rw']			= implode("/", $rt);
		$data['sd_rekmed']			= $rm;
		$data['sd_reg_date'] = DATE('Y-m-d h:i:s');
		$data['modi_datetime'] = DATE('Y-m-d h:i:s');
		$this->db->insert('ptn_social_data', $data);
		$data_fam 			= $this->input->post();
		if (!(empty($data_fam['rows']))) {
			foreach($data_fam['rows'] as $r){
				$dt = explode('|',$r);
				$dt = array(
					'sd_rekmed'			=> $rm,
					'fm_name'			=> $dt[0],
					'fm_sex'			=> $dt[1],
					'fm_relation'		=> $dt[2],
					'fm_address'		=> $dt[3],
					'fm_telp'			=> $dt[4],
					'fm_phone'			=> $dt[5],
				);
				$this->db->insert('ptn_family', $dt);
			}
		}
		$this->session->set_flashdata('message',array('success','Data pasien baru berhasil di buat'));
		echo cur_url(-1)."cetak/$rm";
	}

	function update($id){
		$data = $this->input->post('ds');	
		$this->db->where('', $id);
		$this->db->update('', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));
	}

	function delete($id){
		$data = array('status' => 0);
		$this->db->where('', $id);
		$this->db->update('', $data);
		$this->session->set_flashdata('message',array('success','Data berhasil dihapus'));
		redirect(cur_url(-2));
	}

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
}