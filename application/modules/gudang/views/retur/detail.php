<style type="text/css" media="screen">
	.noborder tr td{
		border: 0px !important;
	}
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.table_tr tbody th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
</style>
<script type="text/javascript" charset="utf-8">
	$(function(){
		$('#back').click(function(){
			window.history.back();
		});
	});
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
	<br clear="all">
	<div class="row-fluid">
		<div class="widget-box">
			<div class="span12">
				<table class="table noborder" style="width:30%;float:left;">
				    <tbody>
					    <tr>
					    	<td style="width:100px;">No. Retur</td>
					    	<td>: <?php echo $retur->ir_id;?></td>
					    </tr>
					    <tr>
					    	<td>No. Faktur</td>
					    	<td>: <?php echo $retur->faktur_id;?></td>
					    </tr>
					    <tr>
					    	<td>Faktur Supplier</td>
					    	<td>: <?php echo $retur->faktur_number;?></td>
					    </tr>
					    <tr>
					    	<td>Supplier</td>
					    	<td>: <?php echo $retur->msup_name;?></td>
					    </tr>
					    <tr>
					    	<td>Tanggal Retur</td>
					    	<td>: <?php echo pretty_date($retur->ir_date,false);?></td>
					    </tr>
					    <tr>
					    	<td>PPN</td>
					    	<td>: <?php echo number_format($retur->ir_pajak,0,',','.');?></td>
					    </tr>
					    <tr>
					    	<td>Total Tagihan</td>
					    	<td>: <?php echo number_format($retur->ir_total,0,',','.');?></td>
					    </tr>
					    <tr>
					    	<td>Petugas</td>
					    	<td>: <?php echo $retur->sd_name;?></td>
					    </tr>
					    <tr>
					    	<td>Catatan</td>
					    	<td>: <?php echo $retur->ir_note;?></td>
					    </tr>
				    </tbody>
				</table>
				<table class="table table-bordered table-stripped table_tr" style="width:68%;float:left;margin:10px;">
				    <thead>
					   <tr>
					   		<th>Kode Item</th>
					   		<th>Nama Item</th>
					   		<th>Jumlah</th>
					   		<th>Harga</th>
					   		<th>Pajak</th>
					   		<th>Sub Total</th>
					   </tr>
				    </thead>
				    <tbody>
				    	<?php
				    	if( !empty($detail) ){
					    	foreach ($detail->result() as $key => $value): ?>
					    		<tr>
					    			<td><?php echo $value->im_id;?></td>
					    			<td><?php echo $value->im_name;?></td>
					    			<td style="text-align:center;"><?php echo $value->ir_item_qty;?> <?php echo $value->mtype_name;?></td>
					    			<td style="text-align:right;"><?php echo number_format(($value->ir_item_price), 0, ",", ".");?></td>
					    			<td style="text-align:right;"><?php echo number_format(($value->ir_item_pajak), 0, ",", ".");?></td>
					    			<td style="text-align:right;"><?php echo number_format(($value->ir_item_total), 0, ",", ".");?></td>
					    		</tr>
					    		<?php
					    	endforeach;
					    	?>
					    	<tr>
					    		<td colspan="4" style="text-align:right;font-weight:bold;">Total</td>
					    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($retur->ir_total), 0, ",", ".");?></td>
					    	</tr>
					    	<?php
					    }
				    	?>
				    </tbody>
				</table>
			</div>
			<br clear="all">
            <div class="form-actions" style="margin-bottom:0px;">
                <a id="cetak" href="<?=base_url()?>gudang/retur/cetak/<?=$retur->ir_id?>" target="_blank" class="btn btn-primary pull-right">Cetak</a>
                <button id="back" class="btn pull-right" type="reset" style="margin-right:10px;">Kembali</button>
            </div>
		</div>
	</div>
</div>
