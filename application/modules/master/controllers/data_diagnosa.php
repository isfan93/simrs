<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_diagnosa extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_diagnosa_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_diagnosa/index';
		$data['title']		= 'Data Diagnosa / ICD 10';
		$data['current']	= 32;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		//$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('template',$data);
	}
	
	function get_update($key){
		$data['main_view']	= 'data_diagnosa/popup_update';
		$data['title']		= 'Ubah Data Diagnosa';
		$data['current']	= '';
		$cf = $this->cf;
		$data['cf']			= $cf;
		$data['result']	= $this->data_diagnosa_model->get_Detail($key);
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));		
		$this->load->view('template',$data);
	}

	function create(){
		//$rm = $this->get_rm();
		$data 				= $this->input->post('mst');
		$this->db->insert('mst_diagnosa',$data);
	}

	function update($id){
		$data = $this->input->post('mst');	
		$this->db->where('diag_id', $data['diag_id']);
		$this->db->update('mst_diagnosa', $data); 
		$this->session->set_flashdata('message',array('success','Data berhasil diperbarui'));
		redirect(cur_url(-2));
	}

	function loaddata(){
		//$tgl = $this->input->post('tgl');
		//$data['datas'] = $this->db->query("select * from v_sch_doctor where sch_time_start::text like '%$tgl%' ");
		$data['datas'] = $this->data_diagnosa_model->get_list();//$this->db->query("select * from v_sch_doctor where sch_time_start like '%$tgl%' ");
		$this->load->view('data_diagnosa/data',$data);

	}
	
	function get_pop(){
		//$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('data_diagnosa/popup',$data);
	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_diagnosa_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
		if($kode==''){
			$this->data_diagnosa_model->deleteData($data);
		}else{
			$this->data_diagnosa_model->deleteData($kode);
		}
        //$this->db->where('diag_id',$id);
        
    }
	
	function server_side(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        //$aColumns = array('treat_id', 'treat_name', 'koef_id', 'poli', 'treat_master_fee', 'treat_item_price' );
		$aColumns = array('diag_id','diag_kode','diag_name', 'description', 'indonesian', 'diag_id' );
        
        // DB table to use
        //$sTable = 'mst_treathment';
		$sTable = 'v_diagnosa';//$sTable = 'mst_diagnosa';
        //
    
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
        }
        
        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
            }
    
            $output['aaData'][] = $row;
        }
    
        echo json_encode($output);
	}

    public function getDiagnosa()
    {
        $term = $this->input->post('term');
        $this->db->like('diag_name',$term);
        $this->db->or_like('description',$term);
        $this->db->or_like('indonesian',$term);
        $this->db->limit(10);
        $dokter = $this->db->get_where('mst_diagnosa', array('diag_status' => 1));
        $data = array();
        if($dokter->num_rows() >= 1)
        {
            foreach ($dokter->result() as $key => $value) {
                $data[] = array(
                    'diag_id'    => $value->diag_id,
                    'diag_name'  => $value->diag_name,
                    'diag_kode'  => $value->diag_kode,
                    'description'  => $value->description,
                    'indonesian'  => $value->indonesian,
                );
            }
        }
        echo json_encode($data);
    }

    // gen diagnosa id
    function genDiagnosaID($mdc_id,$visit_id){
        $this->db->select_max('dat_id');
        $this->db->where('substr(mdc_id,4,8)',$visit_id);
        $no = $this->db->get('trx_diagnosa_treathment');
        if($no->num_rows() >= 1)
        {
            $no = $no->row();
            $no = substr($no->dat_id,12,2);
        }else{
            $no = 0;
        }
        $format = 'DA-'.$visit_id.'-'.str_pad(($no + 1),2,"0",STR_PAD_LEFT);
        return $format;
    }

}