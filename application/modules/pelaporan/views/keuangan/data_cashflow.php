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
			            <th>Tanggal</th>
			            <th>Kategori</th>
			            <th>Keterangan</th>
			            <th>Debet</th>
			            <th>Kredit</th>
			        </tr>
				</thead>
				<tbody>
					<?php if(isset($cashflow) && ($cashflow->num_rows() >= 1) ) : ?>
						<?php foreach ($cashflow->result() as $key => $value) : ?>
							<tr>
								<td style="text-align:center;"><?=($key + 1)?></td>
								<td style="text-align:center;"><?=pretty_date($value->date,false)?></td>
								<td><?=$value->type_name?></td>
								<td><?=$value->note?></td>
								<td style="text-align:right;font-weight:bold;"><?=number_format($value->debet,0,',','.')?></td>
								<td style="text-align:right;font-weight:bold;"><?=number_format($value->kredit,0,',','.')?></td>
							</tr>
						<?php endforeach;?>
					<?php elseif($cashflow->num_rows() < 1) :?>
						<tr>
							<td colspan="6" style="text-align:center;">
								Maaf, Tidak Ada data Kunjungan Pasien
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>