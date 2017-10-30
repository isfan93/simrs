<style type="text/css">
	.table tr th{
		line-height: 35px;
		font-size: 13px;
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12" style="text-align:center;">
			<div class="title">
				<h3>
					<?=$title?>
				</h3>
				<h5>
					<?=pretty_date($dateStart,false)?> - <?=pretty_date($dateEnd,false)?>					
				</h5>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Layanan</th>						
						<th>Tanggal</th>
						<th>Pasien</th>						
					</tr>
				</thead>
				<tbody>
					<?php if(isset($detail_jasa) && ($detail_jasa->num_rows() >= 1) ) : ?>
						<?php $total=0;foreach ($detail_jasa->result() as $key => $value) : ?>							
							<tr>
								<td><?=($key+1)?></td>
								<td>
									<?php $service_type = substr($value->service_id,0,2);?>
										<?php
										switch ($service_type) {
											case 'RJ':
												echo 'Rawat Jalan';
												break;
											case 'RN':
												echo 'Rawat Inap';
												break;
											case 'IG':
												echo 'IGD';
												break;
											case 'LB':
												echo 'Laboratorium';
												break;
											case 'RD':
												echo 'Radiologi';
												break;
											default:
												echo "-";
												break;
										}
									?>
								</td>
								<td><?=pretty_date($value->service_in)?></td>
								<td><?=$value->norkm?></td>								
							</tr>
						<?php endforeach;?>						
					<?php elseif($detail_jasa->num_rows() <= 0) :?>
						<tr>
							<td colspan="4" style="text-align:center;">
								Maaf, Data belum ada
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	
</script>