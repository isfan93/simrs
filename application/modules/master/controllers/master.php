<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	function __construct() {
		parent::__construct();
    }

	public function index(){
		$data['main_view']	= 'index';
		$data['title']		= 'Manajemen Data';
		$data['desc']		= 'Modul master. ';
		$data['cf']		= $this->cf;
		$this->load->view('template',$data);
	}
	
	function tab_obat(){
		$this->load->view('tab/tab_obat');
	}
	
	function tab_user(){
		$this->load->view('tab/tab_user');
	}
	
	function tab_tindakan(){
		$this->load->view('tab/tab_tindakan');
	}
	
	function tab_service(){
		$this->load->view('tab/tab_service');
	}

	function backup_db(){
        $this->load->dbutil();
        $prefs = array(
                'tables'      => array(),  // Array of tables to backup.
                //'tables'      => array('tb_user_profil'),
                'format'      => 'zip',             // gzip, zip, txt
                
                'filename'    => 'backup_dbRSIH.sql',    // File name - NEEDED ONLY WITH ZIP FILES
          
              );

        //$this->dbutil->backup($prefs);

        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'download/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 

        $this->load->helper('download');
        force_download($db_name, $backup);

        header('Content-Description: File Transfer');
        header('Content-Type: application/x-zip');
        header('Content-Disposition: attachment; filename='.basename($dbname));
 
    }
}