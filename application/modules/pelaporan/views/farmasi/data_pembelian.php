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
						<th>Tanggal Masuk</th>
						<th>Nama Obat</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($medicine) && ($medicine->num_rows() >= 1) ) : ?>
						<?php $total=0;$i=0;foreach ($medicine->result() as $key =>$value) : ?>
							<tr>
								<td style="text-align:center;"><?= ++$i ?></td>
								<td><?= pretty_date($value->faktur_date,false) ?></td>
								<td><?= $value->im_name ?></td>
								<td style="text-align:center;"><?= (float) $value->faktur_item_qty ?> <?=isset($value->mtype_name) ? $value->mtype_name : '' ?></td>
								<td style="text-align:right;"><?= number_format(($value->faktur_item_price + $value->faktur_item_pajak),0,',','.') ?></td>
							</tr>
							<?php $total += ($value->faktur_item_price + $value->faktur_item_pajak);?>
						<?php endforeach;?>
						<tr>
							<td colspan="4" style="text-align:right;font-weight:bold;">
								Total
							</td>
							<td style="text-align:right;font-weight:bold;">
								<?=number_format($total,0,',','.')?>
							</td>
						</tr>
					<?php else :?>
						<tr>
							<td colspan="6" style="text-align:center;">
								Maaf, tidak ada data pembelian
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>