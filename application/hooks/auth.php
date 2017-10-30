<?php
	class Auth{
		var $CI;

	    function Auth() {
	        $this->CI =& get_instance();
	    }
		
		function cek(){
			$uri1 = $this->CI->uri->segment(1);
			if(($uri1 != 'login') && (!empty($uri1)) && ($uri1 != 'logout')){
				if(!is_login()){
					$this->CI->session->set_flashdata('message',array("error","Maaf session anda sudah habis, silahkan login"));
					redirect(base_url());
				}else{
					//cek permission and reject unauth requests
				}
			}
		}
	}
?>