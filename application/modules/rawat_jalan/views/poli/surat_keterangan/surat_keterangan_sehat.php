<div class="container-fluid" style="margin-top:20px;">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<?php $this->load->view('print_header');?>
				<br clear="all">
				<div class="body-surat">
					<div class="span12">
						<div class="text-body-surat">
							<h4 style="text-align:center;">
								SURAT KETERANGAN SEHAT
							</h4>
							<h6 style="text-align:center;">
								<?php echo $surat->ref_number;?>
							</h6>
							<p>
								Kami yang bertanda tangan dibawah ini, Doktor Rumah Sakit Intan Husada, <br>
								Menerangkan bahwa kepada : <br>
							</p>
							<table style="font-size:12px;">
								<tr>
									<td>Nama</td>
									<td>: <?php echo $surat->sd_name;?></td>
								</tr>
								<tr>
									<td>Tempat/Tanggal Lahir</td>
									<td>: <?php echo $surat->sd_place_of_birth;?>, <?php echo pretty_date($surat->sd_date_of_birth,false);?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>: <?php echo $surat->sd_sex;?></td>
								</tr>
								<tr>
									<td>No. Rekam Medis</td>
									<td>: <?php echo $surat->sd_rekmed;?></td>
								</tr>
							</table>
							<p>
								Telah kami periksa dengan hasil yang menjelaskan bahwa yang bersangkutan dalam keadaan <b>SEHAT</b>
							</p>
							<p>
								Surat keterangan ini digunakan untuk <br>
								....................................................................................................................................................................
								....................................................................................................................................................................
								....................................................................................................................................................................
							</p>
						</div>
					</div>
					<div class="span4 offset8">
						<div class="text-body-surat">
							<p>
								<?php echo pretty_date(date('Y-m-d'),false);?><br>
								Rumah Sakit Intan Husada<br>
								Dokter yang memeriksa,
							</p>
							<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;">
								Doktor. 
								<?php
									echo $surat->dr_name;
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