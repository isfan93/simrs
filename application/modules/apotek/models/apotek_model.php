<?php if (!defined("BASEPATH")) exit;
class Apotek_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }

    public function getResepByService($service_id)
    {
    	$this->db->join('trx_recipe_detail trd','trd.recipe_id = tr.recipe_id');
    	$this->db->where(array('mdc_id'=>$service_id));
    	return $this->db->get('trx_recipe tr');
    }

}