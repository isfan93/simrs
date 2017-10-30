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
						<th>Stok Awal</th>
						<th>Pengurangan</th>
						<th>Penambahan</th>
						<th>Stok Tersedia</th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($medicine) && (count($medicine) >= 1) ) : ?>
						
					<?php else :?>
						<tr>
							<td colspan="6" style="text-align:center;">
								Maaf, tidak ada data obat napza
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>