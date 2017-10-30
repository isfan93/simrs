<style>
	#examinationTable{width: 100%;}
</style>
<table id="examinationTable" class="table table-bordered table-collapsed">
	<tr>
		<td>Waktu Pemeriksaan</td>
		<td><?= (isset($examination_details['pic']['datetime'])) ? pretty_date($examination_details['pic']['datetime']) : '-' ?></td>
	</tr>
	<tr>
		<td>Penanggung Jawab</td>
		<?php $nurse = ((!isset($examination_details['pic']['sd_name'])) || ($examination_details['pic']['sd_name'] == null)) ? '-' : $examination_details['pic']['sd_name'];?>
		<td><?=$nurse?></td>
	</tr>
	<tr>
		<td>Diagnosis & NIC</td>
		<td>
			<?php if(!empty($examination_details['nic'])) : ?>
				<ul style="circle">
					<?php $diagnosis_id = ''?>
					<?php foreach($examination_details['nic'] as $nic) : ?>
						<?php if($diagnosis_id != $nic['nurse_diag_id']) : ?>
							<li><?=$nic['diagnosis_name']?></li>
						<?php endif;?>
						<?php $diagnosis_id = $nic['nurse_diag_id']?>
						<?php if($nic['treat_name'] != null) : ?>
							<ul>
								<li>
									<?=$nic['treat_name']?>
									<br />
									Catatan : <?=$nic['nic_notes']?>
								</li>
							</ul>
						<?php endif;?>
					<?php endforeach;?>
				</ul>
			<?php else:?>
				-
			<?php endif;?>
		</td>
	</tr>
	<tr>
		<td>Treatment</td>
		<td>
			<?php if(!empty($examination_details['treatment'])) : ?>
			<ul style="circle">
				<?php foreach($examination_details['treatment'] as $treat) : ?>
					<li>
						<?=$treat['treat_name']?>
						<br />
						Catatan : <?=$treat['notes']?>
					</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>
		</td>
	</tr>
</tr>
</table>