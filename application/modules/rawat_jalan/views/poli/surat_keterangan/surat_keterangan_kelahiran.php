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
								SURAT KETERANGAN ISTIRAHAT SAKIT
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
									<td>No. Rekam Medis</td>
									<td>: <?php echo $surat->sd_rekmed;?></td>
								</tr>
								<tr>
									<td>No. Pegawai/ NIM Siswa</td>
									<td>: .....................</td>
								</tr>
							</table>
							<p>
								yang berobat di poliklinik / dirawat di rumah sakit, perlu diberi istirahat sakit selama <b><?php echo $surat->ref_date;?></b> hari,<br>
								terhitung mulai tanggal <b><?php echo pretty_date($surat->ref_date_start,false);?></b> sampai tanggal <b><?php echo pretty_date($surat->ref_date_end,false);?></b><br>
								Pasien perlu / tidak perlu mendapatkan keterangan khusus sebelum diperbolehkan bekerja kembali.<br>
							</p>
						</div>
					</div>
					<div class="span4 offset8">
						<div class="text-body-surat">
							<p>
								<?php echo pretty_date(date('Y-m-d'),false);?><br>
								Rumah Sakit Intan Husada<br>
								Dokter yang merawat,
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