<head>
	<?php $this->load->view("include/script");?>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/print.css"/>
	<style type="text/css">
	table td{
		padding: 5px;
	}
	</style>
</head>
<style type="text/css"></style>
<div class="container-fluid" style="margin-top:20px;">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<?php $this->load->view('print_header');?>
				<div class="body-surat">
					<div class="span12">
						<div class="text-body-surat">
							<h5 style="text-align:center;">
								<u>
								RESEP 
								</u>
							</h5>
							<table style="font-size:12px;width:40%;float:left;">
								<tr>
									<td>Nama</td>
									<td>: <?php echo $data_pasien->sd_name;?></td>
								</tr>
								<tr>
									<td>Umur</td>
									<td>: <?php echo $data_pasien->sd_age;?> Tahun</td>
								</tr>
								<tr>
									<td>Berat Badan</td>
									<td>: <?php echo $data_pasien->ptn_medical_weight;?> Kg</td>
								</tr>
							</table>
							<table style="font-size:12px;width:40%;float:right;">
								<tr>
									<td>No. Rekam Medis</td>
									<td>: <?php echo $data_pasien->sd_rekmed;?></td>
								</tr>
								<tr>
									<td>Dokter</td>
									<td>: <?php echo $data_pasien->dr_name?></td>
								</tr>
							</table>
							<br clear="all">
							<br clear="all">
							<h5><i>R/</i></h5>

							<table style="font-size:12px;width:96%;">
								<thead>
									<tr>
										<th style="text-align:left;">No</th>
										<th style="text-align:left;" colspan="2">Obat/ Racikan/ Alkes</th>
										<th style="text-align:left;">Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<?
										$i = 0;
										if( $resep_pasien->num_rows() >= 1){
											foreach ($resep_pasien->result() as $key => $value) {
												$i++;
												?>
													<tr>
														<td style="text-align:center;"><?=$i?></td>
														<td style="width:40%;"><?=$value->im_name?></td>
														<td style="text-align:left;"><?=$value->recipe_rule?></td>
														<td style="text-align:left;"><?php echo (float)$value->recipe_qty?> <?=isset($value->mtype_name) ? $value->mtype_name : '-'?></td>
													</tr>
												<?
											}
										}
										if( $racikan->num_rows() >= 1){
											foreach ($racikan->result() as $key => $value) {
												$i++;
												?>
													<tr>
														<td style="text-align:center;"><?=$i?></td>
														<td style="width:40%;"><?=$value->racikan_name?></td>
														<td style="text-align:left;"><?=$value->racikan_rule?></td>
														<td style="text-align:left;"><?=$value->description?></td>
													</tr>
												<?
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="span4 offset8" style="margin-top:20px;">
						<div class="text-body-surat">
							<p>
								<?php echo pretty_date(date('Y-m-d'),false);?><br>
								Rumah Sakit Intan Husada<br>
								Dokter ,
							</p>
							<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;">
								<?php
									echo $data_pasien->dr_name;
								?>
							</p>
						</div>	
					</div>
				</div>
				<br clear="all">
				<div class="footer-surat">
					
				</div>
			</div>
		</div>
	</div>
</div>