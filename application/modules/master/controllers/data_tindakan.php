<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_tindakan extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_tindakan_model');
	}
	
	public function index(){
		$data['main_view']	= 'data_tindakan/index';
		$data['title']		= 'Data Tindakan';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$data['kategori']	= $this->db->query('select * from mst_koefisien_fee')->result();
		//$data['list']		= $this->data_pegawai_model->get_mst_employer();
		$this->load->view('template',$data);
	}
	
	public function get_poli()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('pl_id as id,pl_name as name')->like('lower(pl_name)', $q, 'both')->get('mst_poly',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}
	
	public function get_kategori()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('koef_id as id,koef_treathment as name')->like('lower(koef_treathment)', $q, 'both')->get('mst_koefisien_fee',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}
	
	function get_update($key){
		$data['main_view']	= 'data_tindakan/popup_update';
		$data['title']		= 'Ubah Data Tindakan';
		$data['current']	= '';
		$cf = $this->cf;
		$data['cf']			= $cf;
		//$data['poli']		= $this->db->get('mst_poly');
		$data['result']	= $this->data_tindakan_model->get_Detail($key);
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		//$data['menu']		= $this->db->get_where('sys_menu',array('modul_id'=>$modul['modul_id']));
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$data['kategori']	= $this->db->query('select * from mst_koefisien_fee')->result();
		$this->load->view('template',$data);
	}

	function create(){
		$data = $this->input->post('mst');
		//get koefisien
		$data['treat_master_fee']=preg_replace('/[^A-Za-z0-9\-]/', '', $data['treat_master_fee']);
		$temp = $this->data_tindakan_model->getkoef($data['koef_id']);
		$koef = $temp['koef_value'];
		
		$data['treat_item_price']=$koef*$data['treat_master_fee'];
		//insert data
		//print_r($data);
		$this->db->insert('mst_treathment',$data);
	}
	
	 function update(){
		//$data = $this->input->post('ds');
		$data = $this->input->post('mst');
		//get koefisien
		$temp = $this->data_tindakan_model->getkoef($data['koef_id']);
		$koef = $temp['koef_value'];
		
		$data['treat_item_price']=$koef*$data['treat_master_fee'];
		
		$this->db->where('treat_id', $data['treat_id']);
		$this->db->update('mst_treathment', $data); 
	}
 
	
	function loaddata(){
		//$data['datas'] = $this->data_tindakan_model->get_list();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$data['kategori']	= $this->db->query('select * from mst_koefisien_fee')->result();
		$this->load->view('data_tindakan/data',$data);

	}
	
	function get_pop(){
		//$data['jam2']	= $this->db->query('select * from mst_shift')->result();
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('data_tindakan/popup',$data);
	}
	
	function get_pop_update($key){
		//$data['result']	= $this->db->query('select * from mst_shift')->result();
		$data['result']	= $this->data_tindakan_model->get_Detail($key);
		$data['poli2']	= $this->db->query('select * from mst_poly')->result();
		$this->load->view('data_tindakan/popup_update',$data);
	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_tindakan_model->addMaster($data);
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
			$this->data_tindakan_model->deleteData($data);
		}else{
			$this->data_tindakan_model->deleteData($kode);
		}
    }
	
	function update_master(){
		$data = $this->input->post('mst');
		$this->db->where('treat_id',$data['treat_id']);
		$this->data_tindakan_model->updateMaster($data);
	}
	
	function server_side(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        //$aColumns = array('treat_id', 'treat_name', 'koef_id', 'poli', 'treat_master_fee', 'treat_item_price' );
		$aColumns = array('treat_id','treat_id', 'treat_name', 'koef_treathment', 'pl_name', 'treat_master_fee', 'treat_item_price','treat_id' );
        
        // DB table to use
        //$sTable = 'mst_treathment';
		$sTable = 'v_tindakan';
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

	public function getTindakan()
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