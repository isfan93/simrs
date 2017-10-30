<table style="width:100%" class="table table-bordered tb_scrol" id="table1">
	<tr>
		<td style="width:30%">Tanggal & Jam Masuk</td>
		<td>

			<?php if(isset($medical)){
				foreach ($medical->result() as $key => $value) {
					echo "<div class='pull-right alert alert-danger'><b>Status kunjungan : ".$visit_status->vs_name."</b></div>";
					echo pretty_date($value->visit_in,false);
					echo " Jam :  ".date('H:i:s',strtotime($value->visit_in));
					echo "<br>";
					echo " <b>Keterangan :  ".$value->service_note."</b>";
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
					if( substr($value->service_id,0,2) == 'RJ'){
						echo "<b>Rawat Jalan (";echo (isset($value->pl_name)) ? $value->pl_name : '-'; echo ")</b>";
					}
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
		<td style="width:30%">Vital Signs</td>
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
					echo "SpO2 : ";
					echo $ptn_now->ptn_medical_spo2;
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
			<?php if(isset($anamnesa)) : ?>
				<?php if($anamnesa->num_rows() >= 1){
					foreach ($anamnesa->result() as $key => $value) {
						echo "<b>Subjective :</b> ".$value->ma_desc;
						echo "<br>";
					}
				}else{
					echo "-";
				}?>
			<?php endif;?>
			
			<?php if(isset($objective)) : ?>
				<?php if($objective->num_rows() >= 1){
					foreach ($objective->result() as $key => $value) {
						echo "<b>Objective :</b> ".$value->mo_desc;
						echo "<br>";
					}
				}else{
					echo "-";
				}?>
			<?php endif;?>
			
		</td>
	</tr>
	<tr id="diagnose">
		<td>
			Assessment
		</td>
		<td>
			<?php if(isset($diagnosa)) : ?>
				<?php if($diagnosa->num_rows() >= 1){
					foreach ($diagnosa->result() as $key => $value) {
						echo "<b>Diagnosa : </b>".$value->diag_name." (".$value->description.")    <b><br>Catatan :</b>".$value->dat_note;
						echo "<br>";
					}
				}else{
					echo "-";
				}?>
			<?php endif;?>
		</td>
	</tr>
	<tr id="diagnose">
		<td>Plan</td>
		<td>
			<b>Procedures : </b><br>
			<?php if(isset($detail_diagnosa)) : ?>
				<?php if($detail_diagnosa->num_rows() >= 1){
					foreach ($detail_diagnosa->result() as $key => $value) {
						echo   "-".$value->treat_name;
						echo "<br>";
					}
				}else{
					echo "-";
				}?>
			<?php endif;?>
			<br>
			<b>Labs & Radiology :</b><br>
			<?php if(isset($penunjang)) : ?>
				<?php if($penunjang->num_rows() >= 1){
					foreach ($penunjang->result() as $key => $value) {
						echo "Penunjang : ".$value->ds_name;
						$ekspertise = '';
						$lab_queue_id = $value->lab_queue_id;
						if( (isset($penunjang_detail)) && ($penunjang_detail->num_rows() >= 1) )
						{
							foreach ($penunjang_detail->result() as $k => $v) {
								if( $v->lab_queue_id == $value->lab_queue_id)
									$ekspertise .= $v->dsupport_ekspertise_note;
							}
							echo "<br>";
						}
						if(substr($lab_queue_id, 0,2) == 'LB')
							echo " <b>(<a href='".base_url()."lab/cetak_hasil_pemeriksaan/".$lab_queue_id."' target='_blank'>Lihat Hasil</a>)</b>";
						else
							echo " <b>(<a href='".base_url()."rad/cetak_hasil_pemeriksaan/".$lab_queue_id."' target='_blank'>Lihat Hasil</a>)</b>";
						echo "<br>";
					}
					// echo "<br><b>Catatan Ekspertise :</b> ".$ekspertise;
				}else{
					echo "-";
				}?>
			<?php endif;?>
			<br>
			<b>Medications :</b><br>
			<?php if(isset($obat)) : ?>
				<?php
				if($obat->num_rows() >= 1){
					foreach ($obat->result() as $key => $value) {
						 echo $value->im_name."&nbsp;&nbsp;&nbsp;&nbsp;".(float)$value->recipe_qty."&nbsp;&nbsp;&nbsp;".$value->recipe_rule;
						 echo "<br>";
					}
				}
				if($racikan->num_rows() >= 1){
					foreach ($racikan->result() as $key => $value) {
						echo $value->racikan_name."&nbsp;&nbsp;&nbsp;&nbsp;".$value->racikan_rule;
					}
				}
				?>
			<?php endif;?>
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