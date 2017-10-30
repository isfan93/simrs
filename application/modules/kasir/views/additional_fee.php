<table id='table_transaksi' class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width:10px;">No.</th>
			<th>Keterangan</th>
			<th style="width:100px;">Harga</th>
			<th style="width:100px;">Tanggungan</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($additional_fee) && ($additional_fee->num_rows() >= 1) ) : ?>
			<?php foreach ($additional_fee->result() as $key => $value) : ?>
				<tr>
					<td style="text-align:center;"><?=($key+1)?></td>
					<td><?=$value->service_name?></td>
					<td style="text-align:right;"><?=number_format($value->price,0,',','.')?></td>
					<td style="text-align:right;"><?=number_format($value->total_price,0,',','.')?></td>
				</tr>
			<?php endforeach;?>
		<?php else : ?>
			<tr>
				<td colspan="4" style="text-align:center;">Tidak ada tambahan biaya administrasi lain</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>