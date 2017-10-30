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
					    	<td style="width:100px;">No. Faktur</td>
					    	<td>: <b><?php echo $faktur->faktur_id;?></b></td>
					    </tr>
					    <tr>
					    	<td style="width:100px;">Faktur Supplier</td>
					    	<td>: <b><?php echo $faktur->faktur_number;?></b></td>
					    </tr>
					    <tr>
					    	<td>Tanggal Faktur</td>
					    	<td>: <?php echo pretty_date($faktur->faktur_date,false);?></td>
					    </tr>
					    <tr>
					    	<td>Jatuh Tempo</td>
					    	<td>: <b><?php echo pretty_date($faktur->faktur_date_maturity,false);?></b></td>
					    </tr>
					    <tr>
					    	<td>petugas Penerima</td>
					    	<td>: <?php echo $faktur->sd_name;?></td>
					    </tr>
				    </tbody>
				</table>
				<table class="table table-bordered table-stripped table_tr" style="width:68%;float:left;margin:10px;">
				    <thead>
					   <tr>
					   		<th>#</th>
					   		<!--th>Kode Item</th-->
					   		<th>No. Batch</th>
					   		<th>Nama Item</th>
					   		<th>Expired</th>
					   		<th>Jumlah</th>
					   		<th style="width:90px;">Harga Satuan (Tanpa PPN)</th>
					   		<th>PPN / Item</th>
					   		<th>Sub Total</th>
					   </tr>
				    </thead>
				    <tbody>
				    	<?php
				    	if( !empty($detail) ){
					    	foreach ($detail->result() as $key => $value): ?>
					    		<tr>
					    			<td style="text-align:center;">
					    				<!--input type="checkbox" name="returDetail[ir_item][]" class="ir_item" id="" value="<?//=$value->faktur_item?>"-->
					    				<a href="#" class="btn btn-default btn_edit shows btn-mini"><i class="icon-list"></i></a>
					    				<a href="#" class="btn btn-danger btn_cancel hiddens btn-mini"><i class="icon-remove icon-white"></i></a>
					    				<a href="<?=base_url()?>gudang/faktur/update_data/<?=$value->ifd_id?>" class="btn btn-success btn_save hiddens btn-mini"><i class="icon-ok icon-white"></i></a>
					    			</td>
					    			<td>
					    				<label class="shows"><?php echo $value->faktur_item_batch;?></label>
					    				<input type="text" class="input input-mini fi_batch hiddens" value="<?php echo $value->faktur_item_batch;?>" width="10">
					    				<input type="hidden" class="fi_dfi" value="<?php echo $value->ifd_id;?>">
					    				<input type="hidden" class="faktur_id" value="<?php echo $value->faktur_id;?>">
					    			</td>
					    			<td><?php echo $value->im_name;?></td>
					    			<td style="text-align:center;">
					    				<label class="shows"><?php echo $value->faktur_item_exp;?></label>
					    				<input type="text" class="input input-mini fi_exp hiddens" value="<?php echo $value->faktur_item_exp;?>" width="10">
					    			</td>
					    			<td style="text-align:center;">
					    				<?php echo (float) $value->faktur_item_qty;?> <?php echo $value->mtype_name;?>
					    				<input type="hidden" class="input input-mini fi_qty" value="<?php echo $value->faktur_item_qty;?>" >
					    			</td>
					    			<td style="text-align:right;">
					    				<?php 
					    				if( $value->faktur_item_qty == 0)
					    					$faktur_item_price = $value->faktur_item_price;
					    				else
					    					$faktur_item_price = $value->faktur_item_price / $value->faktur_item_qty;
					    				?>
					    				<label class="shows"><?php echo number_format(($faktur_item_price), 0, ",", ".");?></label>
					    				<input type="text" class="input input-mini fi_price hiddens" value="<?php echo (float) ($faktur_item_price);?>">
					    			</td>
						    			<?php 
					    				if( $value->faktur_item_qty == 0)
					    					$faktur_item_pajak = $value->faktur_item_pajak;
					    				else
					    					$faktur_item_pajak = $value->faktur_item_pajak / $value->faktur_item_qty;
					    				?>
					    			<td style="text-align:right;"><?php echo number_format(($faktur_item_pajak), 0, ",", ".");?></td>
					    			<td style="text-align:right;"><?php echo number_format(($value->faktur_item_total), 0, ",", ".");?></td>
					    		</tr>
					    		<?php
					    	endforeach;
					    	?>

					    	
					    	<tr>
					    		<td colspan="7" style="text-align:right;font-weight:bold;">
					    		<?php if($faktur->ppn==1): ?>
					    			Sub Total + PPN
					    		<?php else: ?>
					    			Sub Total Tanpa PPN
					    		<?php endif; ?>
					    		</td>
					    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_price), 0, ",", ".");?></td>
					    	</tr>
					    	<tr>
					    		<td colspan="7" style="text-align:right;font-weight:bold;">Diskon</td>
					    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_discount), 0, ",", ".");?></td>
					    	</tr>
					    	<tr>
					    		<td colspan="7" style="text-align:right;font-weight:bold;">PPN 10%</td>
					    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_pajak), 0, ",", ".");?></td>
					    	</tr>
					    	<tr>
					    		<td colspan="7" style="text-align:right;font-weight:bold;">Total</td>
					    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_total), 0, ",", ".");?></td>
					    	</tr>
					    	<?php
					    }
				    	?>
				    </tbody>
				</table>
			</div>
			<br clear="all">
            <div class="form-actions" style="margin-bottom:0px;">
                <a id="cetak" href="<?=base_url()?>gudang/faktur/cetak/<?=$faktur->faktur_id?>" target="_blank" class="btn btn-primary pull-right">Cetak</a>
                <button id="back" class="btn pull-right" type="reset" style="margin-right:10px;">Kembali</button>
            </div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(".hiddens").hide();
	$(".btn_edit").click(function(){
		$(this).parent().parent().find('.hiddens').show();
		$(this).parent().parent().find('.shows').hide();
		return false;
	})
	$(".btn_cancel").click(function(){
		$(this).parent().parent().find('.hiddens').hide();
		$(this).parent().parent().find('.shows').show();
		return false;
	})

	$(".btn_save").click(function(){
		event.preventDefault();
		var faktur_id = $(this).parent().parent().find('.faktur_id').val();		
		crsf = "<?php echo $this->security->get_csrf_hash()?>"; //$('.crsf').val();
		var nobatch = $(this).parent().parent().find('.fi_batch').val();
		var exp = $(this).parent().parent().find('.fi_exp').val();
		var price = $(this).parent().parent().find('.fi_price').val();
		var qty = $(this).parent().parent().find('.fi_qty').val();
		var urlx = $(this).attr("href");
		var format_data = {csrf_jike_2012:crsf,nobatch:nobatch,exp:exp,price:price,qty:qty,faktur_id:faktur_id};
		//datapost = "upt[faktur_item_batch]="+nobatch+"&upt[faktur_item_exp]="+exp+"&upt[faktur_item_price]="+price;
		//$.post(urlx,datapost);
		//alert(format_data.nobatch);
		
		$.ajax({
			url:urlx,
			data:format_data,
			type:"POST",
			success:function(e){
				// alert(e);
				//reloadTable();
                //$(t).parent().parent().parent().find('.shows').show();
                //$(t).parent().parent().parent().find('.hiddens').hide();
                location.reload();
			}
		})
	})
    $(".ir_item").change(function(){
        if($(this).is(':checked')){
            var hiddens = ($(this).parent().parent().find('.hiddens'));
            var shows = ($(this).parent().parent().find('.shows'));
            hiddens.show();
            shows.hide();
        }else{
            var hiddens = ($(this).parent().parent().find('.hiddens'));
            var shows = ($(this).parent().parent().find('.shows'));
            hiddens.hide();
            shows.show();
        }
        calculateAll();
    });

    $(".qty").change(function(){
        calculateAll();
    });

    function calculateAll()
    {   
        var totalAll = 0;
        $('tr').each(function(){
            var checkbox = $(this).find(".ir_item");
            if(checkbox.is(':checked'))
            {
                var qty = parseFloat($(this).find("#fakturItemQty").val());
                var pajak = parseFloat($(this).find("#fakturItemPajak").val());
                var price = parseFloat($(this).find("#fakturItemPrice").val());
                var total = parseFloat($(this).find("#fakturItemTotal").val());
                $(this).find("#fakturItemTotal").val(qty * (pajak + price));
                totalAll = totalAll + parseFloat(qty * (pajak + price));
            }
        });
        $("#total").val(totalAll.toFixed(2));
    }
});
</script>