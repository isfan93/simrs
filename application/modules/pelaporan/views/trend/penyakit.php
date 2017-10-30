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
						<th>Kode ICD</th>
						<th>Diagnosa</th>
						<th>Jumlah</th>						
					</tr>
				</thead>
				<tbody>
					<?php if(isset($diagnosa) && ($diagnosa->num_rows() >= 1) ) : ?>
						<?php $total = 0; foreach ($diagnosa->result() as $key => $value) : ?>
							<tr>
								<td style="text-align:center;"><?=($key + 1)?></td>
								<td style="text-align:left;"><?=$value->diag_kode?></td>
								<td><?=$value->diag_name?><br>(<?=$value->indonesian?>)
									<!--a href="<?//=base_url()?>pelaporan/diagnosa/detail/<?//=$value->visit_id?>" target="_blank" >
										<b><?//=$value->sd_rekmed?></b><br>
										<?//=$value->sd_name?><br>
										<i><?//=$value->sd_address?></i>
									</a-->
								</td>
								<td style="text-align:center;font-weight:bold;">
									<?=$value->jumlah?>
									<?php $total += $value->jumlah?>
								</td>								
							</tr>
						<?php endforeach;?>
						<!--tr>
							<td colspan="4" style="text-align:right;font-weight:bold;">
								Total Kasus
							</td>
							<td style="text-align:right;font-weight:bold;">
								<?//=$total?>
							</td>
						</tr-->
					<?php elseif($diagnosa->num_rows() <= 0) :?>
						<tr>
							<td colspan="5" style="text-align:center;">
								Maaf, Tidak Ada data diagnosa asien
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>