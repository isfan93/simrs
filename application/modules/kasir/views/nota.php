<div class="container-fluid" style="margin-top:20px;">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<?php $this->load->view('print_header');?>
				<div class="body-surat">
					<div class="span12">
						<div class="text-body-surat">
							<h5 style="text-align:center;">
								<?php echo strtoupper($title); ?>
							</h5>
							<table style="font-size:12px;width:50%;float:left;">
								<tr>
									<td>Nama Pasien</td>
									<td>: <?php echo (isset($patient->sd_name))? $patient->sd_name : '-';?></td>
								</tr>
								<tr>
									<td>Tempat Lahir</td>
									<td>: <?php echo (isset($patient->sd_place_of_birth))? $patient->sd_place_of_birth : '-';?></td>
								</tr>
								<tr>
									<td>Tanggal Lahir</td>
									<td>: <?php echo (isset($patient->sd_date_of_birth)) ? pretty_date($patient->sd_date_of_birth,false) : '-';?></td>
								</tr>
							</table>
							<table style="font-size:12px;width:50%;float:left;">
								<tr>
									<td style="width:30%;">Jenis Kelamin</td>
									<td>: <?php echo isset($patient->sd_sex) ? $patient->sd_sex : '-';?></td>
								</tr>
								<tr>
									<td style="width:30%;">No. Rekam Medis</td>
									<td>: <?php echo isset($patient->sd_rekmed) ? $patient->sd_rekmed : '-';?></td>
								</tr>
							</table>
							<br clear="all">
							<h6>Rincian Pemeriksaan :</h6>
							<table style="font-size:12px;margin-top:10px;width:98%;" class="rincian">
								<thead>
									<tr>
										<th style="text-align:left;">Penggunaan</th>
										<th style="text-align:right;width:100px;">Harga</th>
										<th style="text-align:right;width:100px;">Tanggungan</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$total = $tertanggung = 0;
								?>
								<?php if( $service->num_rows() >= 1) : ?>
									<?php foreach ($service->result() as $k => $v) : ?>
										<?php if(isset($bill[$v->service_id])) : ?>
											<tr class="rincian">
												<td colspan="4" style="font-weight:bold;text-align:left;">
													<?php echo "Pemeriksaan : ".strtoupper($v->service_id)." ".pretty_date($v->visit_in,false);?></label>
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<table style="font-size:12px;margin-top:10px;width:98%;" class="">
													<?php foreach ($mst_bill->result() as $key => $value) : ?>
														<?php if( isset($bill[$v->service_id][$value->service_id]) ) : ?>
															<tr>
																<td colspan="4" style="font-weight:bold;">
																	<?php echo $value->service_name;?>
																</td>
															</tr>
															<?php $no = 0; ?>
															<?php foreach ($bill[$v->service_id][$value->service_id] as $kun => $has) : ?>
																<?php $no++; ?>
																<tr class="">
																	<td class="" style="text-align:center;width:15px;"><?php echo $no;?></td>
																	<td style=""><?php echo $has->service_name;?></td>
																	<td style="text-align:right;width:100px;"><?php echo number_format($has->price, 0, ",", "."); ?></td>
																	<td style="text-align:right;width:100px;">
																		<?php echo number_format($has->total_price, 0, ",", "."); ?>
																	</td>
																</tr>
																<?php
																	$total 	+= $has->price;
																	$tertanggung 	+= $has->total_price;
																?>
															<?php endforeach;?>
														<?php endif; ?>
													<?php endforeach; ?>
													</table>
												</td>
											</tr>
										<?php endif;?>
									<?php endforeach;?>
								<?php endif;?>
								<tr style="border-top:1px solid black;">
									<th colspan="2" style="text-align:right;">Total Tanggungan</th>
									<th style="text-align:right;padding-right:20px;"><?php echo number_format($tertanggung, 2, ",", ".");?></th>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="span4 offset8" style="margin-top:20px;">
						<div class="text-body-surat">
							<p>
								<?php echo pretty_date(date('Y-m-d'),false);?><br>
								Rumah Sakit Intan Husada<br>
								Petugas Kasir,
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