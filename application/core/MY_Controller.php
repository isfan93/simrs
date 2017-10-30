<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Controller class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {

    public $module,$cf;

    function __construct() {
        parent::__construct();
        $this->getModule();
        $this->currentModule();
    }

    function getModule() {
        $group_id = $this->session->userdata('group_id');
        $this->module = $this->repo_model->getModule($group_id);
        // debug_array($this->module);
    }

    function currentModule() {
        $module = $this->uri->segment(1);
        $modules = $this->module;
        foreach ($modules as $m) {
            if ($m['module_url'] == $module) {
                $this->cf = array(
                    'modul_id' => $m['module_id']
                );
                break;
            }
        }
    }

}

/*end of MY_Controller.php file*/

