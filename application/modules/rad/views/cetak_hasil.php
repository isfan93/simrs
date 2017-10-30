<style type="text/css">    
    blockquote { 
    font-size: 16px; font-family: Georgia, "Times New Roman", Times, serif; background: none ! important;
    font-style: normal; line-height: 24px; padding-left: 30px; margin: 10px 0;
    }
    blockquote.alignleft { width: 300px; float: left; margin: 10px 10px 5px 0; }
    blockquote.alignright { width: 300px; float: right; margin: 10px 0 5px 10px; text-align: left; }
</style>
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
								<table style="font-size:16px;margin-top:20px;width:40%;float:left;">
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
								<table style="font-size:16px;margin-top:20px;width:58%;float:right;">
									<!-- <tr>
										<td>Dokter</td>
										<td>:  -->
											<?php
											// if(isset($dr_penanggung_jawab)){
											// 	$dr_penanggung_jawab 	= $dr_penanggung_jawab->row();
											// 	echo $dr_penanggung_jawab->sd_name;
											// }
											?>
											<?php
											// if(isset($op_penanggung_jawab)){
											// 	$op_penanggung_jawab 	= $op_penanggung_jawab->row();
											// 	echo $op_penanggung_jawab->sd_name;
											// }
											?>
										<!-- </td>
									</tr> -->
									<tr>
										<td style="text-weight:bold;">Jenis Pemeriksaan</td>
										<td style="text-weight:bold;">:
										<?php
										if( $penunjang->num_rows() >= 1)
										{
											foreach ($penunjang->result() as $key => $value) {
												echo "<b>";
												echo ($key + 1).".";
												echo $value->ds_name;
												echo "</b>";
												echo "<br>";
											}
										}
										?>
										</td>
									</tr>
									<tr>
										<td style="text-weight:bold;">Dokter Pengirim</td>
										<td style="text-weight:bold;">: 
											<?php
											 if(isset($dr_penanggung_jawab)){
											 	$dr_penanggung_jawab 	= $dr_penanggung_jawab->row();
											 	echo $dr_penanggung_jawab->dr_sender;
											 	//print_r($dr_penanggung_jawab);
											 }
											?>
										</td>
									</tr>
								</table>
								<br clear="all">
								<h5>Rincian Pemeriksaan :</h5>
								<table style="font-size:20px;margin-top:10px;width:98%;" class="rincian">
									<thead>
										<tr>
											<th style="text-align:center;">No</th>
											<th style="text-align:left;">Pemeriksaan</th>
											<th style="text-align:left;width:50%;">Hasil</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if( $penunjang_detail->num_rows() >= 1)
										{
											foreach ($penunjang_detail->result() as $key => $value) {
												?>
												<tr>
													<td style="text-align:center;"><?php echo ($key + 1);?></td>
													<td><?php echo $value->dsupport_name;?></td>
													<td><?php echo $value->dsupport_value;?> <?php echo $value->dsupport_satuan;?></td>
												</tr>
												<?php
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- <div class="row-fluid">
						<div class="span4 offset8" style="margin-top:20px;">
							<div class="text-body-surat">
								<p>
									<?php echo pretty_date(date('Y-m-d'),false);?><br>
									Rumah Sakit Intan Husada<br>
							</div>	
						</div>
					</div>
					<div class="row-fluid">
						<div class="span4 offset8">
							<div class="text-body-surat">
								<p>
									Dokter Penanggung Jawab,
								</p>
								<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;">
									<?php
									if(isset($dr_penanggung_jawab)){
										$dr_penanggung_jawab 	= $dr_penanggung_jawab->row();
										echo $dr_penanggung_jawab->sd_name;
									}
									?>
								</p>
							</div>	
						</div>
					</div> -->
				<br clear="all">
				</div>
				<br clear="all">
				<div class="footer-surat">
					
				</div>
			</div>
		</div>
	</div>
</div>