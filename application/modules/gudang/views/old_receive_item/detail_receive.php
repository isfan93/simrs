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
			<div class="title"><h3><?php echo $title;?></h3></div>
		</div>
	</div>
	<br clear="all">
	<div class="row-fluid">
		<div class="widget-box">
			<div class="span12">
				<table class="table noborder" style="width:30%;float:left;">
				    <tbody>
					    <tr>
					    	<td style="width:100px;">No. Penerimaan</td>
					    	<td>: <b><?php echo $receive_item->iri_id;?></b></td>
					    </tr>
					    <tr>
					    	<td>Jatuh Tempo</td>
					    	<td>: <b><?php echo pretty_date($receive_item->iri_date_maturity,false);?></b></td>
					    </tr>
					    <tr>
					    	<td>Tanggal Penerimaan</td>
					    	<td>: <?php echo pretty_date($receive_item->iri_date_accept,false);?></td>
					    </tr>
					    <tr>
					    	<td>petugas Penerima</td>
					    	<td>: <?php echo $receive_item->sd_name;?></td>
					    </tr>
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
					   		<th>Kode Item</th>
					   		<th>Nama Item</th>
					   		<th>Jumlah</th>
					   		<th>Harga Satuan</th>
					   		<th>Sub Total</th>
					   </tr>
				    </thead>
				    <tbody>
				    	<?php
				    	if( !empty($detail) ){
				    		$total 	= $grandTotal = $PPN = 0;
					    	foreach ($detail->result() as $key => $value):
					    		$subTotal = ($value->iri_qty * $value->iri_item_price);
					    		$total += ($value->iri_qty * $value->iri_item_price);
					    		$grandTotal = ($total);
					    		?>
					    		<tr>
					    			<td><?php echo $value->im_id;?></td>
					    			<td><?php echo $value->im_name;?></td>
					    			<td style="text-align:center;"><?php echo $value->iri_qty;?> <?php echo $value->mtype_name;?></td>
					    			<td style="text-align:right;"><?php echo number_format(($value->iri_item_price), 2, ",", ".");?></td>
					    			<td style="text-align:right;"><?php echo number_format(($subTotal), 2, ",", ".");?></td>
					    		</tr>
					    		<?php
					    	endforeach;
					    	?>
					    	<tr>
					    		<td colspan="4" style="text-align:right;font-weight:bold;">Total</td>
					    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($total), 2, ",", ".");?></td>
					    	</tr>
					    	<tr>
					    		<td colspan="4" style="text-align:right;font-weight:bold;">Discount</td>
					    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($receive_item->iri_discount), 2, ",", ".");?></td>
					    	</tr>
					    	<tr>
					    		<td colspan="4" style="text-align:right;font-weight:bold;">Grand Total</td>
					    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($receive_item->iri_total), 2, ",", ".");?></td>
					    	</tr>
					    	<?php
					    }
				    	?>
				    </tbody>
				</table>
			</div>
			<br clear="all">
            <div class="form-actions" style="margin-bottom:0px;">
                <a id="cetak" href="<?=base_url()?>gudang/receive_item/cetak_receive/<?=$receive_item->iri_id?>" target="_blank" class="btn btn-primary pull-right">Cetak</a>
                <button id="back" class="btn pull-right" type="reset" style="margin-right:10px;">Kembali</button>
            </div>
		</div>
	</div>
</div>
