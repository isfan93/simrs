<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<script>
var i = 0;
$(function(){
	
	$(".tbh").click(function(){
		add();					
		
	});

	function add(){
		i++;
			var str = ("<tr>");
			str += ("<td style='text-align:center;border-left:none;'><b>"+i+"</b></td>");
			str += ("<td style='width:20%;'><div id='"+i+"_fx_resep' class='fx_resep' style='width:98%;border-bottom:1px dotted gray;''></div><input type='hidden' id='"+i+"_harga' name='harga[]' class='harga input' ><input type='hidden' id='"+i+"_batch' name='batch[]' class='batch input' ><input type='hidden' id='"+i+"_id_edit' name='id_edit[]' class='id_edit input' ></td>");
			str += ("<td style='width:10%;'><input type='text' class='input' name='qty[]' id='"+i+"_jumlah' style='width:30px;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'><span id='"+i+"_satuan' class='satuan'></span></td>");
			str += ("</tr>");
			$("#rsp tbody").append(str);

			$('#'+i+'_fx_resep').flexbox(BASE+'apotek/get_resep',{
				paging: false,
				showArrow: false ,
				maxVisibleRows : 0,
				width : 300,
				// resultTemplate: '{id} - {name} - {harga}',
				resultTemplate: '{name} - {stok}',
				onSelect: function() {
					var hv = $(this).parent().find('input:eq(0)').val();
					var id_harga = $(this).parent().parent().find('input:eq(2)').attr('id');
					var id_batch = $(this).parent().parent().find('input:eq(3)').attr('id');
					var id_satuan = $(this).parent().parent().parent().find('.satuan').attr('id');
					$.getJSON(BASE+"apotek/resep_pasien/getMedicineDetail/"+hv, function(json) {
						if( (json.istok_item_price != null) )
	      					harga = json.istok_item_price;
	      				else
	      					harga = json.im_item_price;
						$("#"+id_harga).val(harga);
						$("#"+id_batch).val(json.istok_batch);
						$("#"+id_satuan).html(json.mtype_name);
					})
				}
			});
			$(".fx_resep").find('input[type=hidden]:eq(0)').attr('name','resep[]');
			$(".fx_resep").find('input:eq(1)').attr('name','');

	}

	isvalid = $("#form_resep").validate({
		rules: {
            
        },
        submitHandler: function(form) {
        	$.blockUI({
                message: '<div class="black_loader"><img src="<?=get_loader(11)?>"></div>',
                overlayCSS:  {
                    backgroundColor: '#000',
                    opacity: 0.5,
                    cursor: 'wait',
                },
                css:{
                    border: 'none',
                }
            });
            var url  = "<?=base_url()?><?=$url_poli?>/simpan_resep";
            var data = jQuery(form).serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                			$("#tab_obat").trigger('click'); 
                            // $("#save").trigger('click'); 
                        });
                    }
                });
            });
            return false;
        }
    });
    // $("#save").click(function(){})
    $("#lihat_antrian").click(function(){
        window.location = "<?=base_url()?>igd";
    });
});
</script>
<script type="text/javascript">
	$(function(){
		for(var j = i+1; j <= 3; j++) {
			$(".tbh").trigger('click');
		};
	});
</script>

<?php
	$i = 0;
	if (isset($resep)){
		foreach ($resep->result() as $key => $value) {
			$i++;
			$aturan = explode(' ', $value->recipe_rule);
			// $aturan1 = $aturan[0];
			// $aturan2 = $aturan[2];
			$aturan3 = '';
			for ($j=3; $j < sizeof($aturan) ; $j++) { 
				$aturan3 .= $aturan[$j];
				if(($j+1) < sizeof($aturan)){
					$aturan3 .= ' ';
				}
			}
			?>
			<script>

				$(".tbh").trigger('click');
				$("#"+<?=$i?>+"_fx_resep_hidden").val('<?=$value->recipe_medicine?>');
				$("#"+<?=$i?>+"_id_edit").val('1');
				$("#"+<?=$i?>+"_fx_resep_input").val('<?=$value->im_name?>');
				$("#"+<?=$i?>+"_fx_resep_input").removeAttr('autocomplete').attr('readonly','true');
				$("#"+<?=$i?>+"_fx_resep_input").removeAttr('name');
				 $("#"+<?=$i?>+"_jumlah").attr('readonly','true');
				 // $("#"+<?=$i?>+"_jumlah").removeAttr('name');
				 $("#"+<?=$i?>+"_jumlah").val('<?=$value->recipe_qty?>');
				$("#"+<?=$i?>+"_harga").val('<?=$value->recipe_price?>');
				$("#"+<?=$i?>+"_batch").val('<?=$value->recipe_batch?>');
				$("#"+<?=$i?>+"_satuan").html('<?=$value->mtype_name?>');
				// $("#"+<?=$i?>+"_fx_resep_hidden").remove();
			</script>
			<?php
		}
	}else{
		
	}
?>

<style type="text/css">
	.tables thead tr th{
		height:28px;
		font-size:13px;
		vertical-align: middle;
	}

	#resep[]_ctr.ffb{
		width:300px !important;
		top: 28px !important;
	}

	#resep[]_ctr .row .col1{
		float:left;
		width:100px;
	}
	#resep[]_ctr .row .col2{
		float:left;
		width:200px;
	}
	.ffb-input{
		background: transparent;
		border: none;
		width: 98% !important;
	}
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    .input:focus{
    	background: #efefef !important;
    }
    .ffb-input:focus{
    	background: #efefef !important;
	}
    .black_loader{
        display: block;
        opacity: 0.6;
    }
    .ffb{
    	width: 600px !important;
    }
</style>

<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed">
    <div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" style="display: none; width:50px "></div>
            <img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
            <div class="gritter-with-image" style="width:448px">
                <span class="gritter-title" style="margin-left:36px">Message</span>
                <p>Data Berhasil Disimpan   </p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="gritter-bottom"></div>
    </div>
</div>

<div class="container-fluid">
	<div class="row-fluid" style="width: 700px; margin: auto;">
		<div class="span12">
			<?=form_open(base_url().'igd/simpan_resep',array('class' => 'form-horizontal','id' => 'form_resep')); ?>
			<input type="hidden" name="mdc_id" value=<?=$mdc_id?> > 
			<div class="widget-box">
				<div class="widget-content nopadding">
				<table id="rsp" class="table table-bordered def_table_y dataTable table_tr" align="center" style="margin-left:0px;width:100%;border-left:none;" id="table1">
				<thead>
					<tr role="row">
						<th style="width:2%;border-left:none;">No.</th>
						<th style="width:40%;">Obat & Alat Kesehatan</th>
						 	
						<th style="width:20%;">Jumlah</th>	
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" style="border-left:none;">
							<button type="button" id="" class="btn btn-warning btn-small tbh" style="margin-left:45%;">Tambah Obat</button>
						</td>
					</tr>
				</tfoot>
				</table>
				</div>
				<div class="form-actions" style="margin-bottom:0px;">
					<input type="submit"  class="btn btn-primary pull-right" value="Simpan">
                    <button type="button" id="lihat_antrian" class="btn pull-right" style="margin-right:10px;">Lihat Antrian</button>
				</div>
			</div>
			<?=form_close()?> 
		</div>
	</div>
</div>	


<!-- <input type='text' name='use3[]' id='"+i+"_aturan3' placeholder='Keterangan' style='width:50%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'> -->