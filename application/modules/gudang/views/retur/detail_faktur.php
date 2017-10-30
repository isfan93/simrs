<table class="table table-bordered table-striped table_tr" style="margin-top:20px;">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Obat</th>
            <th>Jumlah Retur</th>
            <th>Harga Satuan</th>
            <th>Pajak Satuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
	    <?php if(isset($detail) && $detail->num_rows() >= 1) : ?>
	    	<?php foreach ($detail->result() as $key => $value) : ?>
                <?php 
                if($value->faktur_item_qty == 0)
                {
                    $faktur_item_price = $value->faktur_item_price;
                    $faktur_item_pajak = $value->faktur_item_pajak;
                }else{
                    $faktur_item_price = $value->faktur_item_price / $value->faktur_item_qty;
                    $faktur_item_pajak = $value->faktur_item_pajak / $value->faktur_item_qty;
                }
                ?>
	    		<tr>
	    			<td style="text-align:center;"><input type="checkbox" name="returDetail[ir_item][]" class="ir_item" id="" value="<?=$value->faktur_item?>"></td>
	    			<td><?=$value->im_name?></td>
	    			<td style="text-align:center;">
                        <div class="shows"><?=(float) $value->faktur_item_qty?></div>
                        <div class="hiddens">
                            <input type="text" class="input input-mini qty" style="text-align:center;" id="fakturItemQty" name="returDetail[ir_item_qty][<?=$value->faktur_item?>]" value="<?=(float) $value->faktur_item_qty?>">
                            <input type="hidden" class="input input-mini" style="text-align:center;" id="fakturItemPrice" name="returDetail[ir_item_price][<?=$value->faktur_item?>]" value="<?=(float) ($faktur_item_price)?>">
                            <input type="hidden" class="input input-mini" style="text-align:center;" id="fakturItemPajak" name="returDetail[ir_item_pajak][<?=$value->faktur_item?>]" value="<?=(float) ($faktur_item_pajak)?>">
                            <input type="hidden" class="input input-mini" style="text-align:center;" id="fakturItemTotal" name="returDetail[ir_item_total][<?=$value->faktur_item?>]" value="<?=(float) ($value->faktur_item_total)?>">
                        </div>
                    </td>
                    <td style="text-align:right;"><?=(float) ($faktur_item_price)?></td>
	    			<td style="text-align:right;"><?=(float) $faktur_item_pajak?></td>
	    			<td style="text-align:right;"><?=(float) $value->faktur_item_total?></td>
	    		</tr>
	    	<?php endforeach;?>
	    <?php endif;?>
    </tbody>
</table>
<table class="table" style="width:20%;float:right;">
    <tbody>
        <tr>
            <td style="border-top:none;">&nbsp;</td>
            <td style="border-top:none;font-weight:bold;">Total</td>
            <td style="border-top:none;">
                <input type="text" style="text-align:right;font-weight:bold;" readonly="readonly" id="total" name="ds[ir_total]" autocomplete="off" class="input-small" value="0">
            </td>
        </tr>
    </tbody>
</table>
<br clear="all">
<script type="text/javascript">
$(function(){
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
        $("#total").val(totalAll.toFixed(0));
    }
});
</script>