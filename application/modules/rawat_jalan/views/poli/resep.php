<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css">
	/*.tables thead tr th{
		height:28px;
		font-size:13px;
		vertical-align: middle;
	}*/

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
	}
	.ffb{
		width: 600px !important;
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
</style>
<script>
var i = 0;
$(function(){
	$('.ui-state-default-two').click(function(){
        $('.ui-state-default-two').removeClass('ui-state-active');
        $(this).addClass('ui-state-active');
    });

    $('.btn_trash').live("click",function(){
        var r = confirm("Anda yakin akan menghapus data obat ini ?");
        var racikan_id = $(this).attr('racikan_id');
        if (r == true) {
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
            if(racikan_id != 0){
                var t = ($(this).parent().parent().parent());
                t.find('.detail_'+racikan_id).remove();
                $(this).parent().parent().remove();
            }else{
                $(this).parent().parent().remove();
            }
            $.unblockUI();
        }
        return false;
    });

    $('.btn_reset').live('click',function(){
        var racikan_medicine = $(this).attr('select2_id');
        $("#"+racikan_medicine).select2("val", "");
        htmlQty = $(this).parent().parent();
        htmlQty.find('.qty').val("");

        htmlSummary = htmlQty.parent().find('.recipe_summary');
        $(htmlSummary).attr("recipe_price",0);
        $(htmlSummary).attr("recipe_qty",0);
        $(htmlSummary).attr("recipe_medicine",0);
        $(htmlSummary).attr("recipe_adm",0);

        return false;
    });

	$(".tbh").click(function(){
		add();					
	});

	function add(){
		i++;
			var str = ("<tr>");
			str += ("<td style='text-align:center;'><b>"+i+"</b></td>");
			str += ("<td style='width:20%;'><div id='"+i+"_fx_resep' class='fx_resep' style='width:98%;border-bottom:1px dotted gray;''></div><input type='hidden' id='"+i+"_harga' name='harga[]' class='harga input' ><input type='hidden' id='"+i+"_batch' name='batch[]' class='batch input' ><input type='hidden' id='"+i+"_item_name' name='item_name[]' class='item_name input' ><input type='hidden' id='"+i+"_tuslah' name='tuslah[]' class='tuslah input' ></td>");
			str += ("<td style='width:60%;'><input type='text' class='input' name='use1[]' id='"+i+"_aturan1' style='width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'> X <input type='text' class='input' name='use2[]' id='"+i+"_aturan2' style='width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'> &nbsp;<select class='input input-medium' name='use3[]' id='"+i+"_aturan3'><option value='-'>-</option><option value='Setelah Makan'>Setelah Makan</option><option value='Sebelum Makan'>Sebelum Makan</option><option value='Lainnya'>Lainnya</option></select><input type='text' class='input' name='catatan[]' id='"+i+"_aturan4' style='width:40%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:left' placeholder='keterangan tambahan'></td>");
			str += ("<td style='width:10%;'><input type='text' class='input' name='qty[]' id='"+i+"_jumlah' style='width:20%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'><span id='"+i+"_satuan' class='satuan'></span></td>");
			str += ("</tr>");
			$("#rsp tbody").append(str);

			$('#'+i+'_fx_resep').flexbox(BASE+'apotek/get_resep',{
				paging: false,
				showArrow: false ,
				maxVisibleRows : 0,
				width : 300,
				resultTemplate: '{name} - {stok}',
				onSelect: function() {
					var hv = $(this).parent().find('input:eq(0)').val();
					var id_harga = $(this).parent().parent().find('input:eq(2)').attr('id');
                    var id_batch = $(this).parent().parent().find('input:eq(3)').attr('id');
                    var id_item_name = $(this).parent().parent().find('input:eq(4)').attr('id');
					var id_tuslah = $(this).parent().parent().find('input:eq(5)').attr('id');
					var id_satuan = $(this).parent().parent().parent().find('.satuan').attr('id');
					$.getJSON(BASE+"apotek/resep_pasien/getMedicineDetail/"+hv, function(json) {
						if( (json.istok_item_price != null) )
	      					harga = json.istok_item_price;
	      				else
	      					harga = json.im_item_price;
						$("#"+id_harga).val(harga);
                        $("#"+id_batch).val(json.istok_batch);
                        $("#"+id_item_name).val(json.im_name);
						$("#"+id_tuslah).val('1000');
						$("#"+id_satuan).html(json.mtype_name);
					})
				}
			});
			$(".fx_resep").find('input:eq(0)').attr('name','resep[]');
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
            var url  = "<?=base_url()?>rawat_jalan/<?=$url_poli?>/simpan_resep";
            var data = jQuery(form).serialize();
            $.post(url,data, function(data){
                $.unblockUI({ 
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            $("#save").trigger('click'); 
                        });
                    } 
                }); 
            }); 
            return false;
        }
    });
    $("#lihat_antrian").click(function(){
    	window.location = "<?=base_url()?>rawat_jalan/<?=$url_poli?>";
    });

    function calculateAll(){
        var total_medicine = 0;
        var total_all = 0;
        var total_administrasi = 0;
        $('tr').each(function(){
            var tr = $(this).find('.recipe_summary');
            if( (tr.attr('recipe_price') !== undefined) && (tr.attr('recipe_price') != null) && (tr.attr('recipe_price') != "") )
            {
                total_administrasi = total_administrasi + (parseFloat(tr.attr('recipe_adm')));
                total_medicine = total_medicine + (parseFloat(tr.attr('recipe_price') * parseFloat(tr.attr('recipe_qty'))) );
            }
            if( (tr.attr('recipe_tuslah_price') !== undefined) && (tr.attr('recipe_tuslah_price') != null) )
            {
                total_administrasi = total_administrasi + (parseFloat(tr.attr('recipe_tuslah_price')));
            }
        });
        total_all = total_medicine + total_administrasi;
        $("#recipe_summary_administrasi").val(formatCurrency(total_administrasi));
        $("#recipe_summary_total").val(formatCurrency(total_medicine));
        $("#recipe_summary_all").val(formatCurrency(total_all));
    }
});
</script>

<?php
	$i = 0;
	if (isset($resep)){
		foreach ($resep->result() as $key => $value) {
			$i++;
			$aturan = explode(' ', $value->recipe_rule);
			if(is_array($aturan)){
				$aturan1 = isset($aturan[0]) ? $aturan[0] : '';
				$aturan2 = isset($aturan[2]) ? $aturan[2] : '';
				$aturan3 = '';
				for ($j=3; $j < sizeof($aturan) ; $j++) { 
					$aturan3 .= $aturan[$j];
					if(($j+1) < sizeof($aturan)){
						$aturan3 .= ' ';
					}
				}
			}else{
				$aturan1 = '';
				$aturan2 = '';
				$aturan3 = '';
			}
			?>
			<script>
				$(".tbh").trigger('click');
				$("#"+<?=$i?>+"_fx_resep_hidden").val('<?=$value->recipe_medicine?>');
				$("#"+<?=$i?>+"_fx_resep_input").val('<?=$value->im_name?>');
				$("#"+<?=$i?>+"_aturan1").val('<?=$aturan1?>');
				$("#"+<?=$i?>+"_aturan2").val('<?=$aturan2?>');
				$("#"+<?=$i?>+"_aturan3").val('<?=$aturan3?>');
				$("#"+<?=$i?>+"_aturan4").val('<?=$value->recipe_note?>');
				$("#"+<?=$i?>+"_jumlah").val('<?=(float) $value->recipe_qty?>');
				$("#"+<?=$i?>+"_harga").val('<?=$value->recipe_price?>');
                $("#"+<?=$i?>+"_batch").val('<?=$value->recipe_batch?>');
                $("#"+<?=$i?>+"_satuan").html('<?=$value->mtype_name?>');
				$("#"+<?=$i?>+"_tuslah").val('1000');
			</script>
			<?php
		}
	}else{
		
	}
?>
<script type="text/javascript">
	$(function(){
		for(var j = i+1; j <= 5; j++) {
			$(".tbh").trigger('click');
		};
	});
</script>

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
	<div class="row-fluid">
		<div class="span12">
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all tabbable" style="background-color:white;padding-left:0px;margin-left:0px;" >
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding-left:0px;margin-left:0px;">
                    <!-- <li class="ui-state-default ui-corner-top"><a href="#" surl='' id="" data-toggle="tab">Obat dan Alkes</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='' id="" data-toggle="tab">Racikan</a></li> -->
                    <li class="ui-state-default-two ui-corner-top ui-state-active"><a href="#obat" data-toggle="tab">Obat dan Alkes</a></li>
                    <li class="ui-state-default-two ui-corner-top"><a href="#racikan" data-toggle="tab">Racikan</a></li>
                    <li class="ui-state-default-two ui-corner-top"><a href="#riwayat" data-toggle="tab">Riwayat Racikan</a></li>
                </ul>
				<?=form_open(base_url().'rawat_jalan/<?=$url_poli?>/simpan_resep',array('class' => 'form-horizontal','id' => 'form_resep')); ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="obat">
                        <!-- OBAT -->
						<?php $this->load->view('rawat_jalan/poli/detail_obat');?>
                    </div>
                    <div class="tab-pane" id="racikan">
                        <!-- RACIKAN -->
						<?php $this->load->view('rawat_jalan/poli/detail_racikan');?>
                    </div>
                    <div class="tab-pane" id="riwayat">
                        <!-- RACIKAN -->
                        <?php $this->load->view('rawat_jalan/poli/riwayat_racikan');?>
                    </div>
                </div>
            	<div class="form-actions" style="margin-bottom:0px;">
					<input type="submit"  class="btn btn-primary pull-right" value="Simpan">
		            <button type="button" id="lihat_antrian" class="btn pull-right" style="margin-right:10px;">Lihat Antrian</button>
				</div>
				<?=form_close()?> 
            </div>
        </div>
	</div>
</div>	


<!-- <input type='text' name='use3[]' id='"+i+"_aturan3' placeholder='Keterangan' style='width:50%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'> -->