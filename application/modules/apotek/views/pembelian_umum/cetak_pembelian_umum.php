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
								Pembelian Umum 
								</u>
							</h5>
							<table style="font-size:12px;width:96%;">
								<thead>
									<tr>
										<th style="text-align:left;">No</th>
										<th style="text-align:left;" colspan="2">Obat/ Racikan/ Alkes</th>
										<th style="text-align:left;">Jumlah</th>
										<!-- <th style="text-align:right;">Harga</th> -->
									</tr>
								</thead>
								<tbody>
									<?
										$i = 0;
										if( $pembelian_umum_medicine->num_rows() >= 1 || $racikan->num_rows() >= 1)
										{
											if( $pembelian_umum_medicine->num_rows() >= 1){
												foreach ($pembelian_umum_medicine->result() as $key => $value) {
													$i++;
													?>
														<tr>
															<td style="text-align:center;"><?=$i?></td>
															<td style="width:40%;"><?=$value->im_name?></td>
															<td style="text-align:left;"><?=$value->tdb_rule?></td>
															<td style="text-align:left;"><?=$value->tdb_qty?> <?=isset($value->mtype_name) ? $value->mtype_name : '-'?></td>
															<!-- <td style="text-align:right;"><?=number_format($value->tdb_price,0,',','.')?></td> -->
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
										}else{
											?>
											<tr>
												<td colspan="5" style="text-align:center;">Tidak ada data obat dan racikan</td>
											</tr>
											<?php
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
								Petugas ,
							</p>
							<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;">
								<?php
									echo get_user('sd_name');
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