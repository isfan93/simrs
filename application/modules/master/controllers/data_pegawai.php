<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_pegawai extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_pegawai_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_pegawai/home';
		$data['title']		= 'Data Pegawai & Dokter';
		$data['current']	= 78;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('template',$data);
	}
	
	function add(){
		$data['main_view']	= 'data_pegawai/index';
		$data['title']		= 'Data Pegawai & Dokter';
		$data['current']	= 78;
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['user_type']		= $this->db->get('mst_type_user');
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

	function edit($id){
			$data['main_view']	= 'data_pegawai/edit';
			$data['title']		= 'Data Pegawai';
			$data['current']	= 1;
			$modul = $this->cf;
			$data['cf']			=  $modul;
			$data['user_type']		= $this->db->get('mst_type_user');
			$data['religi']		= $this->db->get('mst_religion');
			$data['regency']	= $this->db->get('mst_regency');
			$data['province']	= $this->db->get('mst_province');
			$data['occupation']	= $this->db->get('mst_occupation');
			$data['nationality']= $this->db->get('mst_nationality');
			$data['education']  = $this->db->get('mst_education');
			$data['employer']		= $this->db->query("select * from mst_employer where id_employe = $id")->result();
			$data['desc']		= 'Description. ';
			// debug_array($data['employer']);
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
		//$rm = $this->get_rm();
		$data 				= $this->input->post('ds');
		$tgl = $this->input->post('tgl');krsort($tgl);
		$rt  = $this->input->post('rt');
		$data['sd_date_of_birth']	= implode("-", $tgl);
		$data['sd_rt_rw']			= implode("/", $rt);
		//$data['sd_rekmed']			= $rm;
		$data['sd_reg_date'] = DATE('Y-m-d h:i:s');
		$data['modi_datetime'] = DATE('Y-m-d h:i:s');
		$this->db->insert('mst_employer', $data);
		/*
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
		}*/
		$this->session->set_flashdata('message',array('success','Data pegawai baru berhasil di buat'));
		echo cur_url(-1)."cetak/$rm";
	}

	function update(){
		$data = $this->input->post('ds');	
		$this->db->where('id_employe', $data['id_employe']);
		$this->db->update('mst_employer', $data); 
		// echo $this->db->last_query();die();
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-1));
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
 
 function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('data_pegawai/data',$data);

	}

	function proses($rm){
		$modul = $this->cf;
		$data['cf']			=  $modul;
		$data['rekmed']			=  $rm;
		$data['main_view']	= 'pendaftaran_baru/proses';
		$this->load->view('template',$data);
	}

	function delete_list($data) {
		$this->data_pegawai_model->deleteData($data);
       
    }
	function delete_multy() {
		$data=$this->input->post('kode');
		$this->data_pegawai_model->deleteData($data);
       
    }

    public function getDokter()
    {
        $term = $this->input->post('term');
        $this->db->like('sd_name',$term);
    	$dokter = $this->db->get_where('mst_employer', array('sd_employe_tp' => 1,'sd_status'=>1));
    	$data = array();
    	if($dokter->num_rows() >= 1)
    	{
    		foreach ($dokter->result() as $key => $value) {
    			$data[] = array(
    				'id'	=> $value->id_employe,
    				'name'	=> $value->sd_name,
    			);
    		}
    	}
    	echo json_encode($data);
    }
}