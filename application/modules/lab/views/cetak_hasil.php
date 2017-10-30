<div class="container-fluid" style="margin-top:20px;">
	<div class="row">
		<div class="span12">
			<div class="widget-box" style="border:none !important;">
				<?php $this->load->view('print_header');?>
				<br clear="all">
				<div class="body-surat">
					<div class="row">
						<div class="span12">
							<div class="text-body-surat" style="margin-top:-30px;">
								<h4 style="text-align:center;">
									<?php echo strtoupper($title); ?>
								</h4>
								<table style="font-size:14px;margin-top:20px;width:40%;float:left;">
									<tr>
										<td>Nama Pasien</td>
										<td>: <?php echo (isset($patient->sd_name))? $patient->sd_name : ((isset($patient->visit_desc)) ? $patient->visit_desc : '-') ;?></td>
									</tr>
									<tr>
										<td>No. Rekam Medis</td>
										<td>: <?php echo isset($patient->sd_rekmed) ? $patient->sd_rekmed : '-';?></td>
									</tr>
									<tr>
										<td>Tempat/Tanggal Lahir</td>
										<td>: <?php echo (isset($patient->sd_place_of_birth))? $patient->sd_place_of_birth : '-';?>, <?php echo (isset($patient->sd_date_of_birth)) ? pretty_date($patient->sd_date_of_birth,false) : '-';?></td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>: <?php echo isset($patient->sd_sex) ? $patient->sd_sex : '-';?></td>
									</tr>
								</table>
								<table style="font-size:14px;margin-top:20px;width:58%;float:right;">
									<tr>
										<td>Tanggal Periksa</td>
										<td>: <?php echo isset($patient->service_in) ? pretty_date($patient->service_in,false) : '-';?>
										</td>
									</tr>
									<tr>
										<td>No. Registrasi Lab</td>
										<td>:  <?php
											 if(isset($dr_penanggung_jawab)){
											 	//$dr_penanggung_jawab 	= $dr_penanggung_jawab->row();
											 	echo $dr_penanggung_jawab->no_reg;
											 }
											?>
										</td>
									</tr>
									<tr>
										<td>Dokter Pengirim</td>
										<td>: <?php
											 if(isset($dr_penanggung_jawab)){
											 	//$dr_penanggung_jawab 	= $dr_penanggung_jawab->row();
											 	echo $dr_penanggung_jawab->dr_sender;
											 }
											?>
										</td>
									</tr>
									<tr>
										<td>Penanggung Jawab Lab</td>
										<td>: <?php
											if(isset($dr_penanggung_jawab)){
												//$dr_penanggung_jawab 	= $dr_penanggung_jawab->row();
												echo $dr_penanggung_jawab->sd_name;
											}
											?>
										</td>
									</tr>
									<!--tr>
										<td style="text-weight:bold;">Nama Pemeriksaan</td>
										<td style="text-weight:bold;">
										<br>
										<?php
										/*if( $penunjang->num_rows() >= 1)
										{
											foreach ($penunjang->result() as $key => $value) {
												echo "<b>";
												echo ($key + 1).".";
												echo $value->ds_name;
												echo "</b>";
												echo "<br>";
											}
										}*/
										?>
										</td>
									</tr-->
								</table>
								<br clear="all">
								<!--h6>Rincian Pemeriksaan :</h6-->
								<table style="font-size:14px;margin-top:10px;width:98%;" class="rincian">
									<thead>
										<tr style="border-bottom:thin solid black;">
											<!--th style="text-align:center;">No</th-->
											<th style="text-align:left;">Pemeriksaan</th>
											<th style="text-align:left;">Hasil</th>
											<th style="text-align:left;">Nilai Rujukan</th>
											<th style="text-align:left;">Satuan</th>
											<th style="text-align:left;">Keterangan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if( $penunjang->num_rows() >= 1)
										{											
											$current = 0;
											foreach ($penunjang->result() as $key => $value) {

												?>
												<tr>
													<!--td colspan="5" style="font-weight:bold;border-top:thin solid black;"-->
													<?php if($value->ds_gol!=$current): ?>
													<td colspan="5" style="font-weight:bold;">
													<?=$value->golongan_name//=$value->ds_name?>	
													</td>
													<?php $current=$value->ds_gol; endif ?>
												</tr>
												<?php
												if( $penunjang_detail->num_rows() >= 1)
												{
													$no = 0;
													foreach ($penunjang_detail->result() as $k => $v) {
														if($value->trx_ds_id == $v->trx_ds_id){
														$no++;
															?>
															<tr>
																<!--td style="text-align:center;"><?php //echo ($no);?></td-->
																<td><?php echo $v->dsupport_name;?></td>
																<td><?php echo $v->dsupport_value;?></td>
																<td><?php echo $v->dsupport_standart_value;?></td>
																<td><?php echo $v->dsupport_satuan;?></td>
																<td><?php echo $v->dsupport_ekspertise_note;?></td>
															</tr>
															<?php
														}
													}
												}
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span4 offset8" style="margin-top:20px; font-size:16px;">
							<div class="text-body-surat">
								<p>
									
							</div>	
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<div class="text-body-surat" style="font-size:16px;">
							<br><br>
								<p>
									Dokter Penanggung Jawab
								</p>
								<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;font-size:16px;">
									<?php
										if(isset($dr_penanggung_jawab)){
											//$dr_penanggung_jawab 	= $dr_penanggung_jawab->row();
											echo $dr_penanggung_jawab->sd_name;
										}
									?>
								</p>
							</div>	
						</div>
						<div class="span6">
							<div class="text-body-surat" style="font-size:16px;">
								<?php //echo pretty_date(date('Y-m-d'),false);?><br>
									Rumah Sakit Intan Husada<br>
								<p>
									Operator Lab,
								</p>
								<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;font-size:16px;">
									<?php
									if(isset($op_penanggung_jawab)){
										$op_penanggung_jawab 	= $op_penanggung_jawab->row();
										echo $op_penanggung_jawab->sd_name;
									}
									?>
								</p>
							</div>	
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