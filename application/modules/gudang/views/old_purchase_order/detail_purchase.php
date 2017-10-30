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
		<div class="span3" >
			<div class="title"><h3>PURCHASE ORDER : <?php echo $purchase->ipo_id;?></h3></div>
		</div>
	</div>
	<br clear="all">
	<div class="row-fluid">
		<div class="widget-box">
			<div class="span12">
				<table class="table noborder" style="width:30%;float:left;">
				    <tbody>
					    <tr>
					    	<td style="width:100px;">No. PO</td>
					    	<td>: <?php echo $purchase->ipo_id;?></td>
					    </tr>
					    <tr>
					    	<td>Tanggal PO</td>
					    	<td>: <?php echo pretty_date($purchase->ipo_date_req,false);?></td>
					    </tr>
					    <tr>
					    	<td>Supplier</td>
					    	<td>: <?php echo $purchase->msup_name;?></td>
					    </tr>
					    <tr>
					    	<td>Petugas</td>
					    	<td>: <?php echo $purchase->sd_name;?></td>
					    </tr>
					    <tr>
					    	<td>Catatan</td>
					    	<td>: <?php echo $purchase->ipo_note;?></td>
					    </tr>
				    </tbody>
				</table>
				<table class="table table-bordered table-stripped table_tr" style="width:68%;float:left;margin:10px;">
				    <thead>
					   <tr>
					   		<th style="width:10%;">No.</th>
					   		<th style="width:10%;">Kode Item</th>
					   		<th style="width:40%;">Nama Item</th>
					   		<th style="width:20%;">Jumlah</th>
					   		<th style="width:20%;">Total</th>
					   </tr>
				    </thead>
				    <tbody>
				    	<?php
				    	$total 	= 0;
				    	if( !empty($detail) ){
					    	foreach ($detail->result() as $key => $value):
					    		?>
					    		<tr>
					    			<td style="text-align:center;"><?php echo ($key + 1);?></td>
					    			<td><?php echo $value->im_id;?></td>
					    			<td><?php echo $value->im_name;?></td>
					    			<td style="text-align:center;"><?php echo $value->ipod_qty;?> <?php echo $value->mtype_name;?></td>
					    			<td style="text-align:right;"><?php echo number_format(($value->ipod_qty * $value->ipod_harga_beli), 0, ",", ".");?></td>
					    		</tr>
					    		<?php
					    		$total += $value->ipod_qty * $value->ipod_harga_beli;
					    	endforeach;
					    }
				    	?>
				    	<tr>
				    		<td colspan="4" style="font-weight:bold;text-align:right;">Total</td>
				    		<td style="font-weight:bold;text-align:right;"><?php echo number_format(($total), 0, ",", ".");?></td>
				    	</tr>
				    </tbody>
				</table>
			</div>
			<br clear="all">
            <div class="form-actions" style="margin-bottom:0px;">
                <a id="cetak" href="<?=base_url()?>gudang/purchase_order/cetak_purchase/<?=$purchase->ipo_id?>" target="_blank" class="btn btn-primary pull-right">Cetak</a>
                <button id="back" class="btn pull-right" type="reset" style="margin-right:10px;">Kembali</button>
            </div>
		</div>
	</div>
</div>
