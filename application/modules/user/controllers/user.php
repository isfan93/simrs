<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct() {
		parent::__construct();
		// $this->load->model('pelaporan_model');
	}

	public function profil()
	{
		$user_id = get_user('emp_id');
		if(!empty($user_id))
		{
			$this->db->join('sys_user su','su.emp_id = me.id_employe');
			$this->db->join('mst_type_user mtu','mtu.id_type_user = me.sd_type_user');
			$this->db->where('me.id_employe',$user_id);
			$data['user'] = $this->db->get('mst_employer me')->row();
		}
        $data['is_fullpage'] = true;
		$data['title']	= 'Profil User';
		$data['main_view']	= 'user/profil/index';
		$this->load->view('template',$data);
	}

}
// end class