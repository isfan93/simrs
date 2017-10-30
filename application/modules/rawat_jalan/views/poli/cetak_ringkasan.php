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
								Ringkasan Pemeriksaan
							</h4>
							<table style="font-size:12px;margin-top:20px;">
								<tr>
									<td>Nama Pasien</td>
									<td>: <?php echo (isset($patient->sd_name))? $patient->sd_name : '-';?></td>
								</tr>
								<tr>
									<td>Tempat/Tanggal Lahir</td>
									<td>: <?php echo (isset($patient->sd_place_of_birth))? $patient->sd_place_of_birth : '-';?>, <?php echo (isset($patient->sd_date_of_birth)) ? pretty_date($patient->sd_date_of_birth,false) : '-';?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>: <?php echo isset($patient->sd_sex) ? $patient->sd_sex : '-';?></td>
								</tr>
								<tr>
									<td>No. Rekam Medis</td>
									<td>: <?php echo isset($sd_rekmed) ? $sd_rekmed : '-';?></td>
								</tr>
							</table>
							<div>
								<table style="font-size:12px;margin-top:10px;width:98%;" class="rincian">
									<tr>
										<td style="width:30%">Tanggal & Jam Masuk</td>
										<td>

											<?php if(isset($medical)){
												foreach ($medical->result() as $key => $value) {
													echo pretty_date($value->visit_in,false);
													echo " Jam :  ".date('H:i:s',strtotime($value->visit_in));
												}
											}else{
												echo "-";
											}
											?>
										</td>
									</tr>
									<tr>
										<td style="width:30%">Jenis Pemeriksaan</td>
										<td>
											<?php if(isset($medical)){
												foreach ($medical->result() as $key => $value) {
													if( substr($value->service_id,0,2) == 'RJ')
														echo "<b>Rawat Jalan (Poli)</b>";
													else if( substr($value->service_id,0,2) == 'RN')
														echo "<b>Rawat Inap</b>";
													else if( substr($value->service_id,0,2) == 'IG')
														echo "<b>IGD</b>";
													else if( substr($value->service_id,0,2) == 'LB')
														echo "<b>Laboratorium</b>";
													else if( substr($value->service_id,0,2) == 'RD')
														echo "<b>Radiologi</b>";
												}
											}else{
												echo "-";
											}
											?>
										</td>
									</tr>
									<tr>
										<td style="width:20%">Vital Signs</td>
										<td>

											<?php if( !empty($ptn_now) ){
													echo "Kesadaran : ";
													echo $ptn_now->ptn_medical_kesadaran;
													echo "<br>";
													echo "Tekanan Darah : ";
													echo $ptn_now->ptn_medical_blod_sy;
													echo "/";
													echo $ptn_now->ptn_medical_blod_ds;
													echo " mm/Hg";
													echo "<br>";
													echo "Tinggi Badan : ";
													echo $ptn_now->ptn_medical_height;
													echo " cm";
													echo "<br>";
													echo "Berat badan : ";
													echo $ptn_now->ptn_medical_weight;
													echo " Kg";
													echo "<br>";
													echo "Nadi : ";
													echo $ptn_now->ptn_medical_nadi;
													echo "<br>";
													echo "Respiration rate : ";
													echo $ptn_now->ptn_medical_respirationrate;
													echo "<br>";
													echo "Temperatur : ";
													echo $ptn_now->ptn_medical_temperatur;
													echo "<br>";
											}else{
												echo "-";
											}
											?>
										</td>
									</tr>
									<tr>
										<td>Dokter</td>
										<td>
											<?php if(! empty($dokter)){
												echo $dokter->dr_name;
											}else{
												echo "-";
											}?>
											
										</td>
									</tr>
									<tr id="subjstudy">
										<td>Subjective & Objective</td>
										<td>
											<?php if($anamnesa->num_rows() >= 1){
												foreach ($anamnesa->result() as $key => $value) {
													echo "<b>Subjective :</b> ".$value->ma_desc;
													echo "<br>";
												}
											}else{
												echo "-";
											}?>

											<?php if($objective->num_rows() >= 1){
												foreach ($objective->result() as $key => $value) {
													echo "<b>Objective :</b> ".$value->mo_desc;
													echo "<br>";
												}
											}else{
												echo "-";
											}?>
											
										</td>
									</tr>
									<tr id="diagnose">
										<td>
											Assessment
										</td>
										<td>
											<?php if($diagnosa->num_rows() >= 1){
												foreach ($diagnosa->result() as $key => $value) {
													echo "<b>Diagnosa : </b>".$value->diag_name." (".$value->description.")  <b><br>Catatan :</b>".$value->dat_note;
													echo "<br>";
												}
											}else{
												echo "-";
											}?>
										</td>
									</tr>
									<tr id="diagnose">
										<td>Plan</td>
										<td>
											<b>Procedures : </b><br>
											<?php if($detail_diagnosa->num_rows() >= 1){
												foreach ($detail_diagnosa->result() as $key => $value) {
													echo   "- ".$value->treat_name;
													echo "<br>";
												}
											}else{
												echo "-";
											}?>
											<br>
											<b>Labs & Radiology :</b><br>
											<?php if($penunjang->num_rows() >= 1){
												foreach ($penunjang->result() as $key => $value) {
													echo "Penunjang : ".$value->ds_name;
													echo "<br>";
												}
											}else{
												echo "-";
											}?>
											<br>
											<b>Medications :</b><br>
											<?php
											if($obat->num_rows() >= 1){
												foreach ($obat->result() as $key => $value) {
													 echo $value->im_name."&nbsp;&nbsp;&nbsp;&nbsp;".$value->recipe_qty."&nbsp;&nbsp;&nbsp;".$value->recipe_rule;
													 echo "<br>";
												}
											}
											if($racikan->num_rows() >= 1){
												foreach ($racikan->result() as $key => $value) {
													echo $value->racikan_name."&nbsp;&nbsp;&nbsp;&nbsp;".$value->racikan_rule;
												}
											}
											?>
										</td>
									</tr>
									<tr>
										<td>
											Visite / Konsul
										</td>
										<td>
											<?php if( (isset($visite)) && ($visite->num_rows() >= 1) ) : ?>
												<?php foreach ($visite->result() as $key => $value) : ?>
													<b><?=$value->sd_name?></b> : <?=$value->treat_name?><br>
												<?php endforeach;?>
											<?php else :?>
												-
											<?php endif;?>
										</td>
									</tr>
									<tr id="keterangan">
										<td>Surat keterangan yang dikeluarkan</td>
										<td>
										<?php
										if($surat_keterangan->num_rows() >= 1){
											foreach ($surat_keterangan->result() as $key => $value) {
												 echo $value->ref_number." - ".$value->ref_category;
												 echo "<br>";
											}
										}else{
											echo "-";
										}?>
										</td>
									</tr>
								</table>
							</div>
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
									echo $dokter->dr_name;
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