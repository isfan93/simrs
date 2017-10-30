<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retur_ranap extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['main_view']	= 'retur_ranap/index';
		$data['title']		= 'Retur Obat Rawat Inap';
		$data['cf']			=  $this->cf;
		$this->load->view('template',$data);
	}


	function get_returned_medicine(){
		$config['sTable'] = "hos_returned_medicine h";
        $config['aColumns'] = array("sd_name", "im_name", "quantity", "datetime");
        $config['aColumns_format'] = array("ptn.sd_name","h.id", "im.im_name", "h.quantity", "h.datetime");
        $config['php_format'] = array("", "", "", "datetime");
        $config['key'] = "h.id";
        $config['searchColumn'] = array("im.im_name");
        $config['join'][]       = array("inv_item_master im","im.im_id = h.medicine_id");
        $config['join'][]       = array("trx_visit tv","tv.visit_id = substr(h.id,4,8)");
        $config['join'][]		= array("ptn_social_data ptn","tv.visit_rekmed = ptn.sd_rekmed");
        $config['where'][] = "h.status = 0";
        $config['aksi'] = array(
            'stat' => true,
            'key' => 'medicine_id',
            'custom' => array(
                array(
                    'title' => 'Confirm',
                    'class' => 'btn-primary confirm',
                    'href' => array('url' => base_url() . 'gudang/retur_ranap/confirm/', 'uid' => 'id'),
                    'text' => 'Confirm',
                ),
                array(
                    'title' => 'Cancel',
                    'class' => 'btn-danger cancel',
                    'href' => array('url' => base_url() . 'gudang/retur_ranap/cancel/', 'uid' => 'id'),
                    'text' => 'Cancel',
                ))
        );
        init_datatable($config);
	}

	function confirm($id){
		$returned_medicine = $this->db->get_where('hos_returned_medicine',array('id' => $id,'status' => 0))->row();
		$quantity = $returned_medicine->quantity;
		$prescription_id = $returned_medicine->prescription_id;
		$medicine_id = $returned_medicine->medicine_id;

		$prescription_qty = (float) $this->db->get_where('trx_recipe_detail',array(
			'recipe_id' => $prescription_id,
			'recipe_medicine' => $medicine_id))->row()->recipe_qty;

		$this->db->trans_start();
		//update hos_returned_medicine
		$this->db->where('id',$id);
		$this->db->update('hos_returned_medicine',array('status' => 1));

		//update inv_item_stok
		$this->db->where('istok_qty > 0');
        $this->db->where('istok_item', $medicine_id);
        $this->db->order_by('istok_exp', 'asc');
        $stok = $this->db->get('inv_item_stok');
        if ($stok->num_rows() >= 1) {
	    	$sql = 'UPDATE `inv_item_stok` SET `istok_qty` = `istok_qty` + ? WHERE `istok_id` = ?';
	        $this->db->query($sql,array($quantity,$stok->row()->istok_id));
        }else{
       		$this->db->insert('inv_item_stok', array(
       			'faktur_id' => '',
                'istok_item' => $medicine_id,
                'istok_qty' => $quantity,
                'istok_item_price' => 0,
                'istok_exp' => '',
                'istok_batch' => ''
   			));
        }

        // if recipe_qty in trx_recipe_detail == 0.0, delete that rows
        // if($prescription_qty == 0.0){
        // 	$this->db->where(array('recipe_id' => $prescription_id,'recipe_medicine' => $medicine_id));
        // 	$this->db->delete('trx_recipe_detail');
        // }
		$this->db->trans_complete();

		$success = 'success';
        if ($this->db->trans_status() === false) {
            $success = 'failed';
        }

        echo json_encode(array('success' => $success));
	}

	function cancel($id){
		$query = $this->db->get_where('hos_returned_medicine',compact('id'))->row();
		$returned_medicine_id = $query->id;
		$prescription_id = $query->prescription_id;
		$medicine_id = $query->medicine_id;
		$quantity = $query->quantity;
		$pic = $this->session->userdata('emp_id');

		$this->db->trans_start();
		// update hos_returned_medicine to 2
		$this->db->where('id',$id);
		$this->db->update('hos_returned_medicine',array('status' => 2));

		// update trx_recipe_detail. restore medicine qty to original value
		$sql = 'UPDATE `trx_recipe_detail` SET `recipe_qty` = `recipe_qty` + ?, `modi_id` = ? WHERE `recipe_id` = ? AND `recipe_medicine` = ?';
        $this->db->query($sql,array($quantity,$pic,$prescription_id,$medicine_id));

		// delete from trx_bill_detail
		$this->db->where('service_reference',$returned_medicine_id);
        $this->db->delete('trx_bill_detail');
		$this->db->trans_complete();

		$success = 'success';
        if ($this->db->trans_status() === false) {
            $success = 'failed';
        }

        echo json_encode(array('success' => $success));
	}
}