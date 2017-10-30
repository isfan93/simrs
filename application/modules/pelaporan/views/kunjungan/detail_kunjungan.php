<div class="container-fluid" style="margin-top:20px;">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<?php $this->load->view('print_header');?>
				<br clear="all">
				<div class="body-surat" style="padding-top:0px !important">
					<div class="row-fluid">
						<div class="span12">
							<div class="text-body-surat">
								<center><b style="font-size:13px;margin-top:5px !important">
									BUKTI PEMBAYARAN
								</b></center>
								<table style="font-size:10px;">
									<tr>
										<td>Nama</td>
										<td>: <?php echo (isset($patient->sd_name))? $patient->sd_name : ((isset($patient->visit_desc)) ? $patient->visit_desc : '-') ;?></td>
									</tr>
									<tr>
										<td>Tempat/Tanggal Lahir</td>
										<td>: <?php echo (isset($patient->sd_place_of_birth)) ? $patient->sd_place_of_birth : '-';?>, <?php echo (isset($patient->sd_date_of_birth)) ? pretty_date($patient->sd_date_of_birth,false) : '-';?></td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>: <?php echo (isset($patient->sd_sex)) ? $patient->sd_sex : '-';?></td>
									</tr>
									<tr>
										<td>No. Rekam Medis</td>
										<td>: <?php echo (isset($patient->sd_rekmed)) ? $patient->sd_rekmed : '-';?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<hr style="border-bottom:double black;">
					<div class="row-fluid">
						<div class="span12">
							<table style="font-size:10px;width:100%;">
								<?php if(!empty($bill)) : ?>
									<?php $totaltotal_price=0; foreach($bill as $service_id => $bill_per_date) : ?>
										<?php foreach($bill_per_date as $date => $services) : ?>
											<?php $total_price = 0;?>
											<tr>
												<td colspan="4" style="font-weight:bold;text-align:left;">
													<label style="width:400px;float:left;text-align:left;padding-top:0px;padding-left:10px;">
														<?php
															switch(substr($service_id, 0,2)){
																case 'RJ' : $service_name = 'RAWAT JALAN (POLI)';
																	break;
																case 'RN' : $service_name = 'RAWAT INAP';
																	break;
																case 'IG' : $service_name = 'INSTALASI GAWAT DARURAT';
																	break;
																case 'LB' : $service_name = 'LABORATORIUM';
																	break;
																case 'RD' : $service_name = 'RADIOLOGI';
																	break;
																case 'PU' : $service_name = 'Pembelian Umum';
																	break;
															}
														?>
														<b><?= "Pemeriksaan : ".$service_name;?></b>
													</label>
													<span class="pull-right" style="margin-right:20px;"><?=pretty_date($date,false)?></span>
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<table style="font-size:10px;border:1px solid black;width:96%;">
														<?php foreach($services as $service_type => $service) : ?>
															<tr>
																<td colspan="4" style="font-weight:bold;">
																<?php foreach($mst_service->result() as $ms) : ?>
																	<?php if($ms->service_id == $service_type) : ?>
																		<?=$ms->service_name;?>
																	<?php endif;?>
																<?php endforeach;?>
																</td>
															</tr>
															<?php $no = 0;?>
															<?php foreach($service as $bill_details) : ?>
																<tr>
																	<td style="width:10px;"><?=++$no?></td>
																	<td><?=$bill_details->service_name?></td>
																	<td style="width:100px;text-align:right;"><?=number_format($bill_details->price, 0, ",", "."); ?></td>
																	<td class="total-price" style="width:100px;text-align:right;">
																		<?=number_format($bill_details->total_price, 0, ",", "."); ?>
																		<?php $total_price += $bill_details->total_price; ?>
																	</td>
																</tr>
															<?php endforeach;?>
														<?php endforeach;?>
														<tr style="border-top:1px solid black;">
															<td colspan="3" style="text-align:right;font-weight:bold;">Total</td>
															<td style="text-align:right;font-weight:bold;">
																<?=number_format($total_price, 0, ",", "."); ?>
																<?php $totaltotal_price = $totaltotal_price + $total_price; ?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										<?php endforeach;?>
									<?php endforeach;?>
								<?php endif;?>
											<tr>
												<td colspan="4">
													<table style="font-size:12px;border:1px solid black;width:96%;">														
														<tr style="border-top:1px solid black;">
															<td colspan="3" style="text-align:center;font-weight:bold;">Total Keseluruhan</td>
															<td style="text-align:right;font-weight:bold;">
																<?=number_format($totaltotal_price, 0, ",", "."); ?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
							</table>
						</div>
					</div>
					<div class="span4 offset8">
						<div class="text-body-surat" style="font-size:10px">
							<p>
								<?php echo pretty_date(date('Y-m-d'),false);?><br>
								Rumah Sakit Intan Husada<br>
								Petugas,
							</p>
							<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;">
								<?php
									echo get_user('sd_name');
								?>
							</p>
						</div>	
					</div>
				<br clear="all">
				</div>
				<br clear="all">
				<div class="footer-surat">
					
				</div>
			</div>
		</div>
	</div>
</div>