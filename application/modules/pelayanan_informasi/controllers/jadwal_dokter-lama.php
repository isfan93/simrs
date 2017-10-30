<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_dokter extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
	

	public function index(){
		$data['main_view']	= 'jadwal_dokter/index';
		$data['title']		= 'Jadwal Dokter';
		$data['cf']			=  $this->cf;
		$data['desc']		= 'Description. ';
		$data['current']	= 6;
		$data['poli']	= $this->db->query('select * from mst_poly')->result();
		$data['jam']	= $this->db->query('select * from mst_shift')->result();
		$this->load->view('template',$data);
	}

	function create(){
		$data = $this->input->post('ds');
		$this->db->insert('', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil di buat'));
		redirect(cur_url(-1));
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

	// function create_dokter(){
	// 	for($i=2;$i<=200;$i++){
	// 		$emp = rand(1,5);
	// 		$emp2 = rand(6,15);
	// 		$this->db->query("insert into trx_doctor values('$i','$emp','Dr. Sigit $i','$emp2','2012-09-23')");
	// 	}
	// }

	function search(){
		$nama_dokter = $this->input->post('nama_dokter');//hendri_tmi(2-7-2014)
		
		$nama = $this->input->post('nama');
		$poli = $this->input->post('poli');
		$ruang = $this->input->post('ruang');
		$jam = $this->input->post('jam');
 		$tgl = $this->input->post('tgl_frm');

		$this->db->select('*');
		$this->db->from('v_sch_doctor');
		//hendri_tmi(2-7-2014)
		if($nama_dokter != null){
			$this->db->like('lower(dr_name)',"$nama_dokter",'both');
		}
		//---end---
		if($nama != null){
			$this->db->like('lower(dr_name)',"$nama",'both');
		}

		if($poli != null){
			$this->db->where('pl_id',"$poli");
		}
  
		if($jam != null){
			$this->db->where('(sch_shift)',"$jam");
		}
		
		//$this->db->like('(sch_time_start::text)',"$tgl");
		$this->db->like('(sch_time_start)',"$tgl");
		$this->db->order_by("dr_name", "asc");
		$data['datas'] = $this->db->get();
 		//echo $this->db->last_query();die();
 		//var_dump($data['datas']->result());
 		$this->load->view('jadwal_dokter/data',$data);
	}

	function loaddata(){
		$tgl = $this->input->post('tgl');
		$tgl = date('Y-m-d',strtotime($tgl));
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('jadwal_dokter/data',$data);

	}

	function get_dokter(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('trx_doctor');
		if($query!=null){
			$this->db->like('lower(dr_name)', "$query",'both');
		}
		$data = $this->db->get()->result();
		//var_dump($data);
		//echo $this->db->last_query();die();
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->dr_id",
				'name'	=> "$datas->dr_name"
			);
		}

		echo json_encode($data);
	}

	function add_schdl(){
		//$id_sch =   get_next_val('trx_dr_schedule','sch_id');
		$nama =  $this->input->post('nama');
		$ruang =  $this->input->post('ruang');
		$poli =  $this->input->post('poli');
		$jam =  $this->input->post('jams');
		//hendri
		$tgl_unformat =  str_replace("/","-",$this->input->post('tanggal'));
		$reverse_date = date("Y-m-d", strtotime($tgl_unformat));
		
		//echo $tgl_unformat." ".$reverse_date;
			$tgl =  $reverse_date;//'2014-07-05';//$this->input->post('tanggal');
			
		$tgl_unformat2 =  str_replace("/","-",$this->input->post('tanggal2'));
		$reverse_date2 = date("Y-m-d", strtotime($tgl_unformat2));
		
			$tgl2 = $reverse_date2;// '2014-08-05';//$this->input->post('tanggal2');
		//echo $tgl_unformat2." ".$reverse_date2;
		$jam_hide =  $this->input->post('jam_hide');
		$jam2 = explode(' ',$jam_hide);
		 
		$data = array(//'sch_id'=>$id_sch,
			'dr_id'=>$nama,
			'sch_shift'=>$jam,
			'pl_id'=>$poli,
			'modi_id'=>'1',
			'sch_time_start'=>$tgl.' '.$jam2[0],
			'sch_time_end'=>$tgl2.' '.$jam2[1]);
		$this->db->insert('trx_dr_schedule', $data);
	}

	function get_pop(){
		$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('jadwal_dokter/popup',$data);
	}

	function get_jam($id=''){
		$data = $this->db->query("select * from mst_shift where shift_id = $id")->result();
		//$data = $this->db->get('mst_shift')->result();
		echo json_encode($data[0]);
	}
}