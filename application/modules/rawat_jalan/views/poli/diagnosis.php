<style type="text/css">
	.tables thead tr th{
		height:28px;
		font-size:13px;
		vertical-align: middle;
	}

	.ffb-input{
		background: transparent;
		border: none;
		/*border-bottom: 1px dotted gray;*/
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
    .ffb{
        width: 600px !important;
    }
    #fx_item.ffb{
        width:350px !important;
        top: 28px !important;
    }
    #fx_item_ctr .row .col1{
        float:left;
        width:10px;
    }
    #fx_item_ctr .row .col2{
        float:left;
        margin-left: 15px;
        width:220px;
    }
    .ffb-input{
        width: 305px !important;
    }
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>
<script>
var ags = 0;
var j = 0;
var i = 0;
$(function(){
	$(".tbh").click(function(){
		add();					
	});
	$(".tbh_tindakan").die().live('click',function(event,id_diagnosa){
		if(id_diagnosa == '' || id_diagnosa == 'undefined' || id_diagnosa == null)
			var id_diagnosa = $(this).attr('id_diagnosa');
		add_tindakan(id_diagnosa);
	});

	function add_tindakan(id_diagnosa){
		j++;
		var str = ("<div id='"+j+"_fx_tindakan' class='fx_tindakan' style='width:98%;border-bottom:1px dotted gray;''></div>");
		$("#diag_"+id_diagnosa).append(str);
		$('#'+j+'_fx_tindakan').flexbox(BASE+'rawat_jalan/<?=$url_poli?>/get_tindakan',{
			paging: false,
			showArrow: false ,
			maxVisibleRows : 0,
			width : 300,
			resultTemplate: '{name}',
			onSelect: function() {
				var id = $(this).parent().find('input:eq(0)').val();
			}
		});
		$("#"+j+"_fx_tindakan").find('input:eq(0)').attr('name','tindakan['+id_diagnosa+'][]');
		$("#"+j+"_fx_tindakan").find('input:eq(1)').attr('name','');
		$("#"+j+"_fx_tindakan_input").focus();
	}

	function add(){
		i++;
		var str = ("<tr>");
			str += ("<td style='text-align:center;vertical-align:top;width:10px !important;border-left:none;'><b>"+i+"</b></td>");
			str += ("<td style='width:20%;'><div id='"+i+"_fx_diagnosa' id_diagnosa='"+i+"' class='fx_diagnosa' style='width:98%;border-bottom:1px dotted gray;''></div></td>");
			str += ("<td style='width:20%;'><div id='diag_"+i+"'></div><button type='button' style='margin:auto;margin-top:10px;' class='btn btn-small btn-warning tbh_tindakan' id_diagnosa='"+i+"'><i class='icon-plus icon-white icon-small'></i></button></td>");
			str += ("<td style='padding:5px;width:20%;'><input type='radio' id='"+i+"_case_new' name='rj_case_"+(i-1)+"' value='new' style='float:left;'  ><label for='"+i+"_case_new' style='cursor:pointer;float:left;margin-left:10px;'>Kasus Baru</label><br clear='all'/><input type='radio' id='"+i+"_case_old' name='rj_case_"+(i-1)+"' value='old' style='float:left;'  > &nbsp;<label for='"+i+"_case_old' style='cursor:pointer;float:left;margin-left:10px;'>Kasus Lama</label></td>");
			str += ("<td style='padding:5px;width:20%;'><textarea id='"+i+"_note' name='note[]' cols='4' rows='2' placeholder='Catatan'></textarea></td>");
			str += ("</tr>");
			$("#diag tbody").append(str);
		$('#'+i+'_fx_diagnosa').flexbox(BASE+'rawat_jalan/<?=$url_poli?>/get_diagnosa',{
			paging: false,
			showArrow: false ,
			maxVisibleRows : 7,
			width : 300,
			resultTemplate: '{indonesian} ({desc})',
		});
		$(".fx_diagnosa").find('input:eq(0)').attr('name','diagnosa[]');
		$(".fx_diagnosa").find('input:eq(1)').attr('name','');
		<?php if($detail_diagnosa->num_rows() <= 0) :?>
			var tombol = $('#'+i+'_fx_diagnosa').parent().parent().find('.tbh_tindakan');
			for (var k = 0 ; k < 3; k++) {
				tombol.trigger('click', [i] );
			};
		<?php endif;?>
		$('#'+i+'_fx_diagnosa_input').focus();
	}

	isvalid = $("#form_diagnosa").validate({
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
            var url  = "<?=base_url()?>rawat_jalan/<?=$url_poli?>/simpan_diagnosis";
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
});
</script>
<?php
	$i = 0;
	$j = 0;
	if (isset($diagnosa)){
		foreach ($diagnosa->result() as $key => $value) {
			$i++;
			?>
			<script>
				$(".tbh").trigger('click');
				$("#"+<?=$i?>+"_fx_diagnosa_hidden").val('<?=$value->dat_diag?>');
				$("#"+<?=$i?>+"_fx_diagnosa_input").val('<?=$value->indonesian?>');
				$("#"+<?=$i?>+"_note").val('<?=$value->dat_note?>');
			</script>
			<?php
			if(($value->dat_case) == 'new'){
				?>
					<script>
						$("#"+<?=$i?>+"_case_new").attr('checked','checked');
					</script>
				<?php
			}else{
				?>
					<script>
						$("#"+<?=$i?>+"_case_old").attr('checked','checked');
					</script>
				<?php
			}
			if(isset($detail_diagnosa)){
				foreach ($detail_diagnosa->result() as $k => $v) {
					if($v->dat_id == $value->dat_id){
						$j++;
						?>
						<script>
							var tombol = $("#"+<?=$i?>+"_fx_diagnosa").parent().parent().find(".tbh_tindakan");
							tombol.trigger('click',<?=$i?>);
							$("#"+<?=$j?>+"_fx_tindakan_hidden").val('<?=$v->dat_treat?>');
							$("#"+<?=$j?>+"_fx_tindakan_input").val('<?=$v->treat_name?>');
						</script>
						<?php
					}
				}
			}
		}
	}
?>
<script type="text/javascript">
	$(function(){
	    for(var k = i+1; k <= 1; k++) {
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
			<div class="widget-box">
				<?=form_open(base_url().'rawat_jalan/<?=$url_poli?>/simpan_diagnosis',array('class' => 'form-horizontal','id' => 'form_diagnosa')); ?>
				<input type="hidden" name="mdc_id" value=<?=$mdc_id?> >
				<div class="widget-content nopadding">
					<table id="diag" cellpadding="0" cellspacing="0" border="0" class="tabel-dokter table table-bordered table_tr" style="border-left:none;">
						<thead>
							<tr role="row">
								<th class="" style="border-left:none;width:2%;">No.</th>
								<th class="" style="width:20%;">Diagnose</th>
								<th class="" style="width:20%;">Procedures</th>
								<th class="" style="width:20%;">Jenis kasus</th>
								<th class="" style="width:20%;">Catatan</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" style="border-left:none;">
									<button type="button" class="btn btn-warning btn-small tbh" style="margin-left:45%;">Tambah Diagnosa</button>
								</td>
							</tr>
						</tfoot>
					</table>							
				</div>
				<div class="form-actions" style="margin-bottom:0px;margin-top:0px;">
					<button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    <button type="button" id="lihat_antrian" class="btn pull-right" style="margin-right:10px;">Lihat Antrian</button>
				</div>
				<?=form_close()?> 
			</div>
		</div>
	</div>
</div>
