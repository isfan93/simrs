<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelayanan_informasi_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}

	function get_list(){
		$query=$this->db->query("
			SELECT tds.sch_id,me.sd_name,tds.day,ms.shift_start,ms.shift_end,mp.pl_name
			FROM trx_dr_schedule tds
			JOIN mst_employer me ON(me.id_employe=tds.employe_id)
			JOIN mst_shift ms ON(ms.shift_id=tds.sch_shift)
			JOIN mst_poly mp ON(mp.pl_id=tds.pl_id)
			");
		return $query;
	}

	function get_Detail($key){
		$query=$this->db->query("
			SELECT mt.*,tp.* FROM mst_treathment mt
			JOIN mst_poly tp ON (tp.pl_id=mt.poli)
			WHERE mt.treat_id='$key'
			");
		return $query->row_array();
	}

	function updateMaster($data){
		//$result=$this->db->insert('mst_treathment', $data);
		$this->db->where('treat_id', $data['treat_id']);
		$this->db->update('mst_treathment', $data);
		//return $result;
	}

	function hospitalized_patients(){
		$this->db->_protect_identifiers=false;
		$this->db->select('tv.visit_in,psd.sd_title,psd.sd_name,psd.sd_address,psd.sd_age,mc.class_name,mr.room_id,mp.pavillion_name');
		$this->db->join('trx_visit tv','tv.visit_rekmed = psd.sd_rekmed');
		$this->db->join('trx_service ts','SUBSTR(ts.service_id,4,8) = tv.visit_id');
		$this->db->join('hos_bed_occupation hbo','hbo.service_id = ts.service_id');
		$this->db->join('mst_bed mb','mb.bed_id = hbo.bed_id');
		$this->db->join('mst_room mr','mr.room_id = mb.room_id');
		$this->db->join('mst_class mc','mc.class_id = mr.class_id');
		$this->db->join('mst_pavillion mp','mp.pavillion_id = mr.pavillion_id');
		$this->db->where('hbo.is_occupied',1);
		$query = $this->db->get('ptn_social_data psd');

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return array();
		}
	}
}

?>

