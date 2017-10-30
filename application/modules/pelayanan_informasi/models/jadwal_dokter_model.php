<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_dokter_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}
	
	function get_list(){
		$query=$this->db->query("
			SELECT tds.sch_id,me.sd_name,tds.day,ms.shift_start,ms.shift_end,mp.pl_name
			FROM trx_dr_schedule tds
			JOIN mst_employer me ON(me.id_employ=tds.employ_id)
			JOIN mst_shift ms ON(ms.shift_id=tds.sch_shift)
			JOIN mst_poly mp ON(mp.pl_id=tds.pl_id)
			");
		return $query;
	}
	
	function getResult($data){
		$where='';
		if($data['nama_dokter'] != null){
			//$this->db->like('lower(dr_name)',"$nama_dokter",'both');
			$where.='sd.name="'.$data['nama_dokter'].'"';
		}
		//advance search
		/*
		if($nama != null){
			$this->db->like('lower(dr_name)',"$nama",'both');
		}

		if($poli != null){
			$this->db->where('pl_id',"$poli");
		}
  
		if($jam != null){
			$this->db->where('(sch_shift)',"$jam");
		}*/
		$query=$this->db->query("
			SELECT tds.sch_id,me.sd_name,tds.day,ms.shift_start,ms.shift_end,mp.pl_name
			FROM trx_dr_schedule tds
			JOIN mst_employer me ON(me.id_employ=tds.employ_id)
			JOIN mst_shift ms ON(ms.shift_id=tds.sch_shift)
			JOIN mst_poly mp ON(mp.pl_id=tds.pl_id)
			WHERE $where
			");
		return $query;
		//$result=$this->db->insert('trx_dr_schedule', $data);
		
		//return $result;
	}
	
	function deleteData($kode){
		$this->db->query(
			"DELETE FROM
				trx_dr_schedule
			WHERE 
				sch_id IN ($kode)"
			);
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
	
	function getRows($key=""){
		$where="";
		if($key!=""){
			$where.="where me.sd_name=".$key;
		}
		$query=$this->db->query("
			SELECT ms.shift_id,ms.shift_start,ms.shift_end,me.sd_name,mp.pl_name,tds.day
			FROM trx_dr_schedule tds
			JOIN mst_employer me ON (me.id_employe=tds.employe_id)
			JOIN mst_poly mp ON (mp.pl_id=tds.pl_id)
			JOIN mst_shift ms ON (ms.shift_id=tds.sch_shift)
				$where
			");
			//where tds.employe_id=8
		return $query->result();
	}
	
	function getDay(){
		$query=$this->db->query("
			SELECT day
			FROM trx_dr_schedule
			GROUP BY day
		");
		return $query->result();
	}
}

?>
	
