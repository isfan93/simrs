<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rawat_jalan extends MY_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('poli_model','poli_model');
	}

	public function index(){
		$data['main_view']	= 'index';
		$data['title']		= 'Rawat Jalan';
		$data['cf']			=  $this->cf;
		$data['current']	= '';
		$data['desc']		= 'Description. ';
		$this->load->view('template',$data);
	}

	function create(){
		$rm = "1";
		$data = $this->input->post('ds');
		// $this->db->insert('', $data);
		$this->session->set_flashdata('message',array('success','Data berhasil di buat'));
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
		$data['main_view']	= 'poli_tulang/cetak';
		$this->load->view('template_print',$data);
	}

	function get_diagnosa(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->from('mst_diagnosa');
		if($query!=null){
			$this->db->or_like('lower(diag_name)', "$query",'both');
			$this->db->or_like('diag_kode', "$query",'both');
		}
		$this->db->limit(10);
		$data = $this->db->get()->result();
		
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->diag_id",
				'name'	=> "$datas->diag_name",
				'desc'	=> "$datas->description"
			);
		}

		echo json_encode($data);
	} 

	function simpan_diagnosis(){
		$data 		= $this->input->post();
		$dt = array();
		$mdc_id = $data['mdc_id'];
		$data_diag = $this->poli_model->cek_is_exist_diagnosa_treathment($mdc_id);
		if($data_diag->num_rows() >= 1){
			$this->db->where('mdc_id',$mdc_id);
			$this->db->delete('trx_diagnosa_treathment_detail');
			$dt_diag  = $data_diag->result();
			$dat_id = $dt_diag[0]->dat_id;
			$i = 0;
			if(count($data['diagnosa']) >= 1){
				foreach ($data['diagnosa'] as $key => $value) {
					if( (! empty($data['diagnosa'][$i])) ){
						$dt[] = array(
							'mdc_id'	=> $mdc_id,
							'dat_id'	=> $dat_id,
							'dat_diag'	=> $value,
							'dat_treat'	=> $data['tindakan'][$i],
							'dat_note'	=> $data['note'][$i],
							'dat_case'	=> $data['rj_case_'][$i],
						);
					}
					$i++;
				}
			}
			if(count($dt) >= 1){
				$this->db->insert_batch('trx_diagnosa_treathment_detail',$dt);
			}
		}
	}

}