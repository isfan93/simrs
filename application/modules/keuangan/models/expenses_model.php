<?php if (! defined("BASEPATH")) exit;
class Expenses_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db->reconnect();
	}

	function get_list(){
		$query=$this->db->query("
			SELECT tcf.*,mco.category
			FROM trx_jurnal tcf
			JOIN mst_expense mco on(mco.expense_id=tcf.expense_id)
			");
		return $query;
	}

	function rekapHarian($start,$end){
		$query=$this->db->query("
			SELECT tcf.*,mco.category
			FROM trx_jurnal tcf
			JOIN mst_expense mco on(mco.expense_id=tcf.expense_id)
			WHERE tcf.tanggal_transaksi BETWEEN '$start' AND '$end'	
			");
		return $query;
	}

	function rekapBulanan($start,$end){
		$query=$this->db->query("
			SELECT me.category,SUM(tj.debet) AS uang_masuk,SUM(tj.kredit) AS uang_keluar
			FROM trx_jurnal tj
			JOIN mst_expense me ON(me.expense_id=tj.expense_id)
			WHERE MONTH(tj.tanggal_transaksi) BETWEEN '$start' AND '$end' AND YEAR(tj.tanggal_transaksi)=YEAR(NOW())
			GROUP BY tj.expense_id
			");
		return $query;
	}
}