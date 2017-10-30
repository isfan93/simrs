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
						<th>Nama Obat</th>
						<th>Jumlah</th>
						<th>Batch</th>
						<th>HPP</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($medicine) && (count($medicine) >= 1) ) : ?>
						<?php $total=0;$i=0;foreach ($medicine as $key =>$value) : ?>
							<?php foreach ($value as $k =>$v) : ?>
								<tr>
									<td style="text-align:center;"><?= ++$i ?></td>
									<td><?= $v['im_name'] ?></td>
									<td style="text-align:center;"><?= (float) $v['qty'] ?> <?=$v['mtype_name']?></td>
									<td><?= $v['batch'] ?></td>
									<td style="text-align:right;"><?= number_format($v['im_item_price'],0,',','.') ?></td>
									<td style="text-align:right;"><?= number_format(($v['qty'] * $v['im_item_price']),0,',','.') ?></td>
								</tr>
								<?php
								$total += ($v['qty'] * $v['im_item_price']);
								?>
							<?php endforeach;?>
						<?php endforeach;?>
						<tr>
							<td colspan="5" style="text-align:right;font-weight:bold;">
								Total
							</td>
							<td style="text-align:right;font-weight:bold;">
								<?=number_format($total,0,',','.')?>
							</td>
						</tr>
					<?php else :?>
						<tr>
							<td colspan="6" style="text-align:center;">
								Maaf, tidak ada data penjualan
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>