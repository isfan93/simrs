<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_obat extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data_obat_model');
	}
	
	public function index(){
		$db1 = $this->load->database('default', TRUE);
		$data['main_view']	= 'data_obat/index';
		$data['title']		= 'Master Data Obat';
		$data['current']	= 1;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['tipe_obat']		= $this->db->get('mst_type_inv')->result();
        $data['gol_obat']      = $this->db->where('gol_status',1)->get('mst_golongan_inv')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		 
		$this->load->view('template',$data);
	}
	
	function get_update($key){
		$data['main_view']	= 'data_obat/popup_update';
		$data['title']		= 'Ubah Data Obat';
		$data['current']	= '';
		$cf = $this->cf;
		$data['cf']			= $cf;
		$data['result']	= $this->data_obat_model->get_Detail($key);
		$data['sediaan']		= $this->db->get('mst_type_inv')->result();
        $data['gol_obat']      = $this->db->where('gol_status',1)->get('mst_golongan_inv')->result();
		$data['daftar']		= $this->db->order_by('menu_id','asc')->get_where('sys_menu',array('modul_id'=>$cf['modul_id']));
		$this->load->view('template',$data);
	}


	function create(){
		$data 				= $this->input->post('ds');
		
		if($this->db->insert('inv_item_master', $data)){
			echo "berhasil";
		}
	
	}

	function update(){
		$data = $this->input->post('mst');	
 		$this->db->where('im_id', $data['im_id']);
		$this->db->update('inv_item_master', $data); 
	}
	
	function loaddata(){
		$data['tipeobat']		= $this->db->get('mst_type_inv')->result();
		//$data['datas'] = $this->data_obat_model->get_list();
		$this->load->view('data_obat/data',$data);

	}
	
	function add_master(){
		$data=$this->input->post('mst');
		$result=$this->data_obat_model->addMaster($data);
		if ($result){
			echo "data berhasil disimpan";
		}
	}
	
	function delete_list($kode='') {
        $data=$this->input->post('kode');
        if($kode == ''){
        	$this->data_obat_model->deleteData($data);
        	
        }else{
        	$this->data_obat_model->deleteData($kode);
        	
        }
    }
	
	function server_side(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        //$aColumns = array('treat_id', 'treat_name', 'koef_id', 'poli', 'treat_master_fee', 'treat_item_price' );
		$aColumns = array('im_id','im_id', 'im_name', 'mtype_name','gol_name', 'im_item_price_buy', 'im_item_price', 'im_item_price_package','im_min_stock','im_max_stock','im_id' );
        
        // DB table to use
        //$sTable = 'mst_treathment';
		$sTable = 'v_obat';
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
}