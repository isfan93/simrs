<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_user extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_user_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_user/index';
		$data['title']		= 'Manajemen Data User';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$data['tipe_user']	= $this->db->query('select * from sys_group')->result();
		$data['user_type']		= $this->db->get('mst_type_user');
		$this->load->view('template',$data);
	}

	function create(){
		$data = $this->input->post('mst');
		//print_r($data);
		$cek=$this->db->where('user_name',$data['user_name'])->get('sys_user')->num_rows();
		if($cek > 0){
			$result = array('success'=>false);
		}else{
			$data['user_password']=md5($data['user_password'].encryptkey());
			$this->db->insert('sys_user', $data);	
			$result = array('success'=>true);
		}
		
		echo json_encode($result);
		 
	}

	public function get_dokter()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$this->db->select('id_employe as id,sd_name as name');
		//$this->db->where('sd_employe_tp','1');
		$this->db->like('lower(sd_name)', $q, 'both');
		$data = $this->db->get('mst_employer')->result_array();		
		echo json_encode($data);
	}

	public function get_group()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$this->db->select('group_id as id,group_name as name');
		//$this->db->where('sd_employe_tp','1');
		$this->db->like('lower(group_name)', $q, 'both');
		$data = $this->db->get('sys_group')->result_array();		
		echo json_encode($data);
	}

	function update(){
		$data = $this->input->post('ds');	
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('sys_user', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));
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
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['employer']	= $this->db->query('select * from mst_employer')->result();
		$data['group']	= $this->db->query('select * from sys_group')->result();
		$data['datas'] = $this->data_user_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_user/data',$data);

	}
	
	function get_pop(){
		//$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		$data['tipe_user']	= $this->db->query('select * from com_user_tipe')->result();
		$this->load->view('data_user/popup',$data);
	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_user_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode==''){
			$this->data_user_model->deleteData($data);
		}else{
			$this->data_user_model->deleteData($kode);
		}
        
    }
	
	function list_user(){
		$key=$this->input->get("term");
		//var $term;
		$query = $this->data_user_model->GetList($key);
        print json_encode($query);
	}
	
	function get_user(){
		$data = array();
		$q = strtolower($_GET['q']);
		$data = $this->db->select('id_employe as id,sd_name as name')->like('lower(id_employe)', $q, 'both')->or_like('lower(sd_name)', $q, 'both')->get_where('mst_employer')->result_array();
		echo json_encode(array('results'=> $data));
	}
	function create_default_user(){
		$user = $this->db->get('mst_employer');
		foreach ($user->result() as $key) {
			$name = explode(' ', $key->sd_name); 
			if($key->sd_employe_tp == '1'){
				$username = strtolower ($name[1]);					
			}else if($key->sd_employe_tp == '2'){
				$username = strtolower ($name[0]);
			}

			$datauser[] = array(
				'emp_id' => $key->id_employe,
				'user_name' => $username,
				'user_password' => md5('12345'.encryptkey()),
				'user_status' => '1',
				'user_group_id' => '6',
				
				);
		}
		$insert = $this->db->insert_batch('sys_user',$datauser);
		debug_array($insert);
	}

	function reset_password()
	{
		$user_id = $this->input->post('user_id');
		if(!empty($user_id))
		{
			$data['user_password'] = (md5('12345'.encryptkey())) ;
			$this->db->where('user_id',$user_id);
			$this->db->update('sys_user',$data);
		}
	}
}