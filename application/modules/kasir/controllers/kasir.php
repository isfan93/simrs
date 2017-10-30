<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kasir extends MY_Controller
{
		
		function __construct() {
				parent::__construct();
				
				// model
				$this->load->model('kasir_model', 'kasir_model');
				$this->load->model('apotek/apotek_model', 'apotek_model');
		}
		
		public function index() {
				$data['main_view'] = 'index';
				$data['title'] = 'Kasir ';
				$cf = $this->cf;
				$data['cf'] = $cf;
				$this->load->view('template', $data);
		}
		
		function get_transaksi() {
				$config['sTable'] = "trx_visit tv";
				$config['key'] = "tv.visit_id";
				$config['leftjoin'][] = array("ptn_social_data psd", "psd.sd_rekmed = tv.visit_rekmed");
				$config['join'][] = array("trx_service ts", " substr(ts.service_id,4,8) = tv.visit_id");
				$config['join'][] = array("trx_bill tb", "tb.bill_id = ts.bill_id");
				$config['join'][] = array("trx_bill_detail tbd", "tbd.bill_id = tb.bill_id");
				$config['aColumns'] = array("visit_in", "visit_rekmed", "sd_name", "sd_address");
				$config['aColumns_format'] = array("tv.visit_in,if(psd.sd_name is null, tv.visit_desc, psd.sd_name) as sd_name,if(tv.visit_rekmed = 0, '-', tv.visit_rekmed) as visit_rekmed,if(psd.sd_address is null, '-', psd.sd_address) as sd_address");
				$config['php_format'] = array("date", "strtoupper", "strtoupper", "strtoupper", "strtoupper");
				$config['group'] = "tv.visit_id";
				$config['where'][] = "tv.visit_status <= 4";
				$config['where'][] = "ts.service_status <= 4";
				
				// $config['where'][]         = "tb.bill_status = 0";
				$config['where'][] = "tbd.payment_status = 0";
				$config['aksi'] = array('stat' => true, 'key' => 'visit_id', 'pilih' => base_url() . 'kasir/detail/',);
				$config['sOrder'][] = array("tv.visit_in,desc");
				$config['searchColumn'] = array("tv.sd_rekmed");
				init_datatable($config);
		}
		
		function detail($visit_id) {
				$data['title'] = 'Kasir ';
				$data['cf'] = $this->cf;
				$data['main_view'] = 'kasir/detail_transaksi';
				$this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
				$this->db->where('tv.visit_id', $visit_id);
				$data['patient'] = $this->db->get('trx_visit tv')->row();
				$data['mst_service'] = $this->db->get('mst_service');
				$data['insurance'] = $this->db->get('mst_insurance');
				$data['visit_id'] = $visit_id;
				
				$this->db->_protect_identifiers = false;
				$this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
				$this->db->where('tv.visit_id', $visit_id);
				$service = $this->db->get('trx_visit tv');
				if ($service->num_rows() >= 1) {
						foreach ($service->result() as $key => $value) {
								$this->db->select('tbd.*');
								$this->db->join('trx_bill tb', 'tbd.bill_id = tb.bill_id');
								$this->db->where(array('tb.bill_id' => $value->bill_id, 'tbd.payment_status' => '0'));
								$bill = $this->db->get('trx_bill_detail tbd');
								if ($bill->num_rows() >= 1) {
										foreach ($bill->result() as $k => $v) {
												$date = date('Y-m-d', strtotime($v->datetime));
												$data['bill'][$value->service_id][$date][$v->service_type][] = $v;
										}
										
										if ($this->kasir_model->is_type_medical($value->service_id, 'RN')) {
												
												$this->load->model('rawat_inap/rawat_inap_model', 'rim');
												$room_bill = $this->rim->getRoomPayment($value->service_id);
												
												//menggabungkan data tagihan sewa kamar dengan data lainnya
												$date = new DateTime('now');
												$date = $date->format('Y-m-d');
												$service_type = 8;
												$is_room_paid = $this->kasir_model->is_room_paid($value->bill_id, $date);
												if (!$is_room_paid) {
														$room = new stdClass();
														$room->bill_id = $value->bill_id;
														$room->service_type = $service_type;
														$room->service_name = $room_bill['tag'];
														$room->price = $room_bill['price'];
														$room->paramedic_price = 0;
														$room->other_price = 0;
														$room->total_price = $room_bill['price'];
														$room->payment_status = 0;
														$data['bill'][$value->service_id][$date][$service_type][] = $room;
												}
										}
								}
						}
				}
				
				$this->load->view('template', $data);
		}
		
		function bayar() {
				$this->load->model('rawat_inap/rawat_inap_model', 'rim');
				$bill_per_date = $this->input->post('bill_per_date');

				if ($bill_per_date != false) {
					$this->db->trans_start();
					foreach ($bill_per_date as $key => $bill) {
							$bill_explode = explode('_', $bill);
							$service_id = $bill_explode[0];
							$date = $bill_explode[1];
							$bill_id = 'BL-' . substr($service_id, 3, 11);

							if($key == 0)
							{
								$discount 	= $this->input->post('discount');
								$additional = $this->input->post('additional');
								$this->db->where('bill_id',$bill_id);
								$oldBill = $this->db->get('trx_bill')->row();
								$oldDiscount = (isset($oldBill->discount) && ($oldBill->discount != null)) ? $oldBill->discount : 0;
								$oldAdditional = (isset($oldBill->additional) && ($oldBill->additional != null)) ? $oldBill->additional : 0;

								$dataBill = array(
									'discount'	=> ($discount + $oldDiscount),
									'additional'	=> ($additional + $oldAdditional),
								);
								$this->db->where(array('bill_id'=>$bill_id));
								$this->db->update('trx_bill',$dataBill);
							}
							
							if ($this->kasir_model->is_type_medical($service_id, 'RJ')) {
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
									
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id, 'payment_status' => 0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
									
									$data_service['service_status'] = 4;
									$this->db->where(array('service_id' => $service_id));
									$this->db->update('trx_service', $data_service);
							} elseif ($this->kasir_model->is_type_medical($service_id, 'IG')) {
									
									// rajal / poli / igd
									
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
									
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id, 'payment_status' => 0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
									
									$data_service['service_status'] = 4;
									$this->db->where(array('service_id' => $service_id));
									$this->db->update('trx_service', $data_service);
									
									$data_visit['visit_out'] = date('Y-m-d H:i:s');
									$this->db->where(array('visit_id' => substr($service_id, 3, 8)));
									$this->db->update('trx_visit', $data_visit);
							} elseif ($this->kasir_model->is_type_medical($service_id, 'LB') || $this->kasir_model->is_type_medical($service_id, 'RD')) {
									
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
									
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id, 'payment_status' => 0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
									
									$dt_queo['lab_queue_status'] = 4;
									$this->db->where('lab_queue_id', $service_id);
									$this->db->update('trx_lab_queue', $dt_queo);
									
									$data_service['service_status'] = 4;
									$this->db->where(array('service_id' => $service_id));
									$this->db->update('trx_service', $data_service);
							} elseif ($this->kasir_model->is_type_medical($service_id, 'RN')) {
									
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id, 'payment_status' => 0));
									$this->db->where('DATE(datetime)', $date);
									$this->db->update('trx_bill_detail', $data_bill_detail);
									
									if ($bill == $this->input->post('room_service')) {
											$room_payment['bill_id'] = $bill_id;
											$room_payment['service_type'] = 8;
											$room_payment['service_name'] = $this->input->post('room_service_name');
											$room_payment['price'] = $this->input->post('room_service_price');
											$room_payment['paramedic_price'] = 0;
											$room_payment['other_price'] = 0;
											$room_payment['total_price'] = $this->input->post('room_service_price');
											$room_payment['payment_status'] = 1;
											$room_payment['cashier_id'] = get_user('emp_id');
											$this->db->insert('trx_bill_detail', $room_payment);
									}
							} elseif ($this->kasir_model->is_type_medical($service_id, 'PU')) {
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
									
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id, 'payment_status' => 0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
									
									$data_service['service_status'] = 4;
									$this->db->where(array('service_id' => $service_id));
									$this->db->update('trx_service', $data_service);
							}
					}
					
					if ($this->kasir_model->is_type_medical($service_id, 'RN')) {
							$this->rim->hospitalDischarge($service_id);
					}
					
					$this->db->trans_complete();
					$success = 'success';
					if ($this->db->trans_status() === FALSE) {
							$success = 'failed';
					}
				} else {
						$success = 'success';
				}
				
				echo json_encode(array('success' => $success));
				
				/*$this->db->trans_start();
				if(isset($data_service_id) && is_array($data_service_id))
				{
					foreach ($data_service_id as $k => $service_id) {
						if($this->kasir_model->is_type_medical($service_id,'RJ')){ // rajal / poli
							$bill_id = $data_bill_id[$service_id];
				
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
				
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id,'payment_status'=>0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
				
								$data_service['service_status'] = 4;
								$this->db->where(array('service_id'=>$service_id));
								$this->db->update('trx_service',$data_service);
				
								// $dt_queo['queo_status'] = 3;
								// $this->db->where('queo_id',$service_id);
								// $this->db->update('trx_queue_outpatient',$dt_queo);
				
						}else if($this->kasir_model->is_type_medical($service_id,'IG')){ // IGD
							$bill_id = $data_bill_id[$service_id];
				
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
				
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id,'payment_status'=>0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
				
								$data_service['service_status'] = 4;
								$this->db->where(array('service_id'=>$service_id));
								$this->db->update('trx_service',$data_service);
				
						}else if($this->kasir_model->is_type_medical($service_id,'LB'))
						{
							$bill_id = $data_bill_id[$service_id];
				
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
				
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id,'payment_status'=>0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
				
					$dt_queo['lab_queue_status'] = 4;
					$this->db->where('lab_queue_id',$service_id);
					$this->db->update('trx_lab_queue',$dt_queo);
				
									$data_service['service_status'] = 4;
								$this->db->where(array('service_id'=>$service_id));
								$this->db->update('trx_service',$data_service);
				
				}else if($this->kasir_model->is_type_medical($service_id,'RD'))
						{
							$bill_id = $data_bill_id[$service_id];
				
									$data_bill['bill_status'] = 1;
									$this->db->where(array('bill_id' => $bill_id));
									$this->db->update('trx_bill', $data_bill);
				
									$data_bill_detail['payment_status'] = 1;
									$data_bill_detail['cashier_id'] = get_user('emp_id');
									$this->db->where(array('bill_id' => $bill_id,'payment_status'=>0));
									$this->db->update('trx_bill_detail', $data_bill_detail);
				
					$dt_queo['lab_queue_status'] = 4;
					$this->db->where('lab_queue_id',$service_id);
					$this->db->update('trx_lab_queue',$dt_queo);
				
					$data_service['service_status'] = 4;
								$this->db->where(array('service_id'=>$service_id));
								$this->db->update('trx_service',$data_service);
				
						}else if($this->kasir_model->is_type_medical($service_id,'RN'))
						{
								// $bill_date = $this->input->post('bill_date');
				//             $this->db->trans_start();
				//             foreach($bill_date as $date){
				//                 $bill_data['payment_status'] = 1;
				//                 $bill_data['cashier_id'] = get_user('emp_id');
				//                 $this->db->where('visit_id',$visit_id);
				//                 $this->db->where('payment_status',0);
				//                 $this->db->where('DATE(datetime)',$date);
				//                 $this->db->update('trx_visit_bill', $bill_data);
				//             }
				
				//             $room_payment['visit_id'] = $visit_id;
				//             $room_payment['service_id'] = 8;
				//             $room_payment['service_name'] = $this->input->post('room_service_name');
				//             $room_payment['price'] = $this->input->post('room_service_price');
				//             $room_payment['paramedic_price'] = 0;
				//             $room_payment['other_price'] = 0;
				//             $room_payment['total_price'] = $this->input->post('room_service_price');
				//             $room_payment['payment_status'] = 1;
				//             $this->db->insert('trx_visit_bill',$room_payment);
				
				//             $this->load->model('rawat_inap/rawat_inap_model','rim');
				//             $this->rim->hospitalDischarge($visit_id);
				//             $this->db->trans_complete();
				
				//             $success = 'success';
				//             if ($this->db->trans_status() === FALSE) {
				//                 $success = 'failed';
				//             }
				//             echo json_encode(array('success' => $success));
				//         }
						}
				}
				}
				$this->db->trans_complete();*/
		}
		
		function cetak_nota($visit_id) {
				$data['title'] = 'Nota Pembayaran';
				
				$this->db->join('ptn_social_data psd', 'psd.sd_rekmed = tv.visit_rekmed');
				$this->db->where('tv.visit_id', $visit_id);
				$data['patient'] = $this->db->get('trx_visit tv')->row();
				
				$data['mst_bill'] = $this->db->get('mst_service');
				$data['insurance'] = $this->db->get('mst_insurance');
				
				$this->db->_protect_identifiers = false;
				$this->db->join('trx_service ts', 'substr(ts.service_id,4,8) = tv.visit_id');
				$this->db->where('tv.visit_id', $visit_id);
				$data['service'] = $this->db->get('trx_visit tv');
				if ($data['service']->num_rows() >= 1) {
						foreach ($data['service']->result() as $key => $value) {
								$this->db->join('trx_bill tb', 'tbd.bill_id = tb.bill_id');
								$this->db->where(array('tb.bill_id' => $value->bill_id, 'tbd.payment_status' => 1));
								$bill = $this->db->get('trx_bill_detail tbd');
								if ($bill->num_rows() >= 1) {
										foreach ($bill->result() as $k => $v) {
												$data['bill'][$value->service_id][$v->service_type][] = $v;
										}
								}
						}
				}
				
				$this->load->view('kasir/nota', $data);
		}

		public function saveAdditionalFee()
		{
			$data 	= $this->input->post();
			if(!empty($data))
			{
				$this->db->_protect_identifiers = false;
				$this->db->join('trx_visit tv','tv.visit_id = substr(ts.service_id,4,8)');
				$this->db->where(array('visit_rekmed'=>$data['sd_rekmed']));
				$this->db->order_by('ts.service_in','desc');
				$service 	= $this->db->get('trx_service ts')->row();
				$bill_id 	= $service->bill_id;
				if(!empty($bill_id))
				{
					$dt = array(
						'bill_id'	=> $bill_id,
						'service_type'	=> '12',
						'service_name'	=> $data['keterangan'],
						'price'			=> $data['harga'],
						'total_price'	=> $data['harga'],
						'payment_status'=> 0
					);
					if($this->db->insert('trx_bill_detail',$dt))
					{
						echo json_encode(array('success'=>'true','message'=>'Success!'));
					}else{
						echo json_encode(array('success'=>'false','message'=>'Failed to save!'));
					}
				}else{
					echo json_encode(array('success'=>'false','message'=>'Bill id is empty!'));
				}
			}
		}

		public function additionalFee($visit_id)
		{
			$this->db->_protect_identifiers = false;
			$this->db->where(array('service_type'=>'12','substr(bill_id,4,8)'=>$visit_id,'payment_status'=>'0'));
			$additionalFee 	= $this->db->get('trx_bill_detail');
			$data['additional_fee'] 	= $additionalFee;
			$this->load->view('additional_fee',$data);
		}
}

// end class
//hendri, 11 februari 2015

