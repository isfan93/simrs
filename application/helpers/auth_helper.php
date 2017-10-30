<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('encryptkey()'))
{
	function encryptkey()
	{
		$CI =& get_instance();
		return $CI->config->item('encryption_key');
	}
}

if ( ! function_exists('is_login()'))
{
	function is_login()
	{
		$CI =& get_instance();
		return $CI->session->userdata('user_'.encryptkey());
	}
}

if ( ! function_exists('get_user()'))
{
	function get_user($a='')
	{
		$CI =& get_instance();
		$ses = array(
			'user_id'		=> $CI->session->userdata('user_id'),
			'emp_id'		=> $CI->session->userdata('emp_id'),
			'sd_name'		=> $CI->session->userdata('sd_name'),
			'user_name' 	=> $CI->session->userdata('user_name'),
			'group_id' 		=> $CI->session->userdata('group_id'),
			'group_name'	=> $CI->session->userdata('group_name'),
			'group_homebase'=> $CI->session->userdata('group_homebase')
		);
		if(!$CI->session->userdata('user_'.encryptkey()))
			return false;
			else{
				if($a == ''){
					return $ses;
				} else return $ses[$a];
			} 
	}
}

if ( ! function_exists('login_cek()'))
{
	function login_cek($uname='',$pwd='')
	{
		$CI =& get_instance();
		$CI->db->where(array('user_name'=>$uname,'user_status'=>1));
		$CI->db->join('mst_employer','sys_user.emp_id = mst_employer.id_employe','left');
		$ds = $CI->db->get('sys_user');
		if($ds->num_rows() == 1){
			$ds = $ds->result_array();
			$ds = $ds[0];
			if((md5($pwd.encryptkey()) == $ds['user_password'])){
				sess_register($ds);
				return true;
			}else return false;
		}else return false;
	}
}

if ( ! function_exists('sess_register()'))
{
	function sess_register($data=array())
	{
		$CI =& get_instance();
		$CI->session->set_userdata(array('user_'.encryptkey() => true));
		$tp = db_conv($CI->db->get_where('sys_group',array('group_id'=>$data['user_group_id'])));
		$data['group_id'] 	= $tp->group_id;
		$data['group_name'] = $tp->group_name;
		$data['group_homebase'] = $tp->group_homebase;
		$CI->session->set_userdata($data);
	}
}

if ( ! function_exists('logout()'))
{
	function logout()
	{
		$CI =& get_instance();
		$CI->session->set_userdata(array('user_'.encryptkey() => false));
		$CI->session->sess_destroy();
	}
}

function get_home_base(){
	$hb = get_user('group_homebase');
	return (empty($hb)) ? 'welcome' : $hb;
}