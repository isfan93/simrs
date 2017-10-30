<style>
	#examinationTable{width: 100%;}
</style>
<table id="examinationTable" class="table table-bordered table-collapsed">
	<tr>
		<td>Waktu Pemeriksaan</td>
		<?php $datetime = pretty_date($examination_details['patient_status']['datetime'])?>
		<td><?=$datetime?></td>
	</tr>
	<tr>
		<td>Penanggung Jawab</td>
		<?php $physician = $examination_details['patient_status']['physician'] == null ? '-' : $examination_details['patient_status']['physician']?>
		<?php $nurse = $examination_details['patient_status']['nurse'] == null ? '-' : $examination_details['patient_status']['nurse']?>
		<td>Dokter : <?=$physician?> <br /> Perawat : <?=$nurse?></td>
	</tr>
	<tr>
		<td>Vital Sign</td>
		<?php $blood_type = $examination_details['patient_status']['sd_blood_tp'] == null ? '-' : $examination_details['patient_status']['sd_blood_tp']?>
		<?php $weight = $examination_details['patient_status']['ptn_medical_weight'] == null ? '-' : $examination_details['patient_status']['ptn_medical_weight']?>
		<?php $height = $examination_details['patient_status']['ptn_medical_height'] == null ? '-' : $examination_details['patient_status']['ptn_medical_height']?>
		<?php $consciousness = $examination_details['patient_status']['ptn_medical_kesadaran'] == null ? '-' : $examination_details['patient_status']['ptn_medical_kesadaran']?>
		<?php $systole = $examination_details['patient_status']['ptn_medical_blod_sy'] == null ? '-' : $examination_details['patient_status']['ptn_medical_blod_sy']?>
		<?php $diastole = $examination_details['patient_status']['ptn_medical_blod_ds'] == null ? '-' : $examination_details['patient_status']['ptn_medical_blod_ds']?>
		<?php $pulse = $examination_details['patient_status']['ptn_medical_nadi'] == null ? '-' : $examination_details['patient_status']['ptn_medical_nadi']?>
		<?php $respiration_rate = $examination_details['patient_status']['ptn_medical_respirationrate'] == null ? '-' : $examination_details['patient_status']['ptn_medical_respirationrate']?>
		<?php $temperature = $examination_details['patient_status']['ptn_medical_temperatur'] == null ? '-' : $examination_details['patient_status']['ptn_medical_temperatur']?>
		<td>
			Golongan Darah : <?=$blood_type?> <br />
			Berat Badan / Tinggi Badan : <?=$weight?> Kg / <?=$height?> Cm <br />
			Kesadaran : <?=$consciousness?> <br />
			Tekanan Darah : <?=$systole?> Mm / <?=$diastole?> Hg <br />
			Nadi : <?=$pulse?> BPM <br />
			Respiration Rate : <?=$respiration_rate?> BPM <br />
			Temperatur : <?=$temperature?> &deg;C
		</td>
	</tr>
	<tr>
		<td>Subjective & Objective</td>
		<?php $subjective = $examination_details['patient_status']['ma_desc'] == null ? '-' : $examination_details['patient_status']['ma_desc']?>
		<?php $objective = $examination_details['patient_status']['mo_desc'] == null ? '-' : $examination_details['patient_status']['mo_desc']?>
		<td class="colon">
			Subjective : <?=$subjective?> <br />
			Objective : <?=$objective?>
		</td>
	</tr>
	<tr>
		<td>Assessment & Procedures</td>
		<td>
			<?php if (!empty($examination_details['patient_diagnose'])) : ?>
				<ul style="circle">
					<?php $diagnose_id = '';?>
					<?php foreach($examination_details['patient_diagnose'] as $dt) : ?>
						<?php if($dt['dat_id'] != $diagnose_id) : ?>
							<li>
								<?=$dt['indonesian']?><br />
								<?php $diagnose_note = $dt['dat_note'] != '' ? $dt['dat_note'] : '-';?>
								Instruksi Dokter : <?=$diagnose_note?>
							</li>
							Tindakan :
						<?php $diagnose_id = $dt['dat_id'];?>
						<?php endif;?>
						<?php if ($dt['treat_name'] != null) : ?>
							<ul>
								<li><?=$dt['treat_name']?></li>
							</ul>
						<?php else : ?>
							-
						<?php endif;?>
					<?php endforeach;?>
				</ul>
			<?php else : ?>
				-
			<?php endif;?>
		</td>
	</tr>
	<tr>
		<td>Medication</td>
		<td>
			<?php if (!empty($examination_details['patient_medication'])) : ?>
				<ul style="circle">
				<li>No. Resep : <?=$examination_details['patient_medication'][0]['recipe_id'] ?></li>
				<ul>
				<?php foreach($examination_details['patient_medication'] as $m) : ?>
					<li>
						<?=$m['im_name']?><br />
						Aturan Pakai : <?=$m['recipe_rule']?> <br />
						Satuan : <?=$m['recipe_qty']?>
					</li>
				<?php endforeach ;?>
				</ul>
				</ul>
			<?php else	 : ?>
				-
			<?php endif;?>

			<?php if (!empty($examination_details['patient_concoction'])) : ?>
				<ul style="circle">
					<?php foreach($examination_details['patient_concoction'] as $c) : ?>
						<li>
							<?=$c['racikan_name']?><br />
							Sediaan : <?=$c['racikan_sediaan']?> <br />
							Aturan Pakai : <?=$c['racikan_rule']?> <br />
							<?php $medication_note = $c['racikan_note'] != '' ? $c['racikan_note'] : '-';?>
							Satuan : <?=$c['racikan_qty']?>
							Catatan : <?=$medication_note?>
						</li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>
		</td>
	</tr>
</table>