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
	dokter = <?=$dokter?>;
	visite = <?=$visite?>;

	function add_tindakan(id_diagnosa){
		j++;
		
		
		// console.log(pj);
		
		var str = ("<select id='"+j+"_pj' name='penanggungjawab["+id_diagnosa+"][]' class='cRequired penanggungjawab'>"+pj+"</select></td> ");
		var waktu = ("<input class='jam_periksa cRequired' id='"+j+"_time' name='time["+id_diagnosa+"][]'  rows='2' placeholder=' Waktu'>");
		var pj = ("<select id='"+j+"_pj' name='penanggungjawab["+id_diagnosa+"][]' class='cRequired penanggungjawab'>"+pj+"</select>");
		
		$("#diag_"+id_diagnosa).append(str);
		$("#waktu_"+id_diagnosa).append(waktu);
		$("#pj_"+id_diagnosa).append(pj);
		
		$('#'+j+'_fx_tindakan').flexbox(BASE+'igd/get_tindakan',{
			paging: false,
			showArrow: false ,
			maxVisibleRows : 0,
			width : 300,
			resultTemplate: '{name}',
			onSelect: function() {
				var id = $(this).parent().find('input:eq(0)').val();
			}
		});

		$("#"+j+"_pj").chosen({no_results_text: "data tidak ditemukan!"});

		$('#'+j+"_time").datetimepicker({
			format:'Y-m-d H:i'
		});

		 $.validator.addMethod("cRequired", $.validator.methods.required,"Customer name required");

		$("#"+j+"_fx_tindakan").find('input:eq(0)').attr('name','tindakan['+id_diagnosa+'][]');
		$("#"+j+"_fx_tindakan").find('input:eq(1)').attr('name','');
		$("#"+j+"_fx_tindakan_input").focus();
	}

	function add(){
		i++;
		
		pj = "<option value=''> --- </option>";
		$(dokter).each(function(i,data){
			pj += "<option value='"+data.id_employe+"'>"+data.sd_name+"</option>";
		});

		konsul = "<option value=''> --- </option>";
		$(visite).each(function(i,data){
			konsul += "<option value='"+data.treat_id+"'>"+data.treat_name+"</option>";
		});		

		var str = ("<tr>");
		str += ("<td style='text-align:center;vertical-align:top;width:10px !important;border-left:none;'><b>"+i+"</b> </td>");
		str += ("<td style='width:20%;'><select id='"+i+"_dokter' name='dokter[]' class='cRequired dokter'>"+pj+"</select></td>");
		str += ("<td style='width:20%;'><select id='"+i+"_visite' name='visite[]'>"+konsul+"</select></td>");
		str += ("<td style='width:20%;'><input id='"+i+"_waktu' name='time[]' type='text' class=' hasDatepicker waktu'></td>");
		 
		// str += ("<td style='padding:5px;width:20%;'><textarea class='jam_periksa' id='"+i+"_time' name='time[]' cols='4' rows='2' placeholder=' Waktu'></textarea></td>");
		str += ("</tr>");
		$("#diag tbody").append(str);

		$('#'+i+'_fx_diagnosa').flexbox(BASE+'igd/get_diagnosa',{
			paging: false,
			showArrow: false ,
			maxVisibleRows : 0,
			width : 300,
			resultTemplate: '{indonesian}({desc})',
			// onSelect: function() {
			// 	var id_diagnosa = $(this).parent().parent().find('input:eq(2)').attr('id');
			// 	$.getJSON(BASE+"igd/json_get_diagnosa/"+id, function(json) {
			// 		var id = $(this).parent().parent().find('div').attr('id_diagnosa');
			// 		$("#"+id+"_fx_diagnosa_input").val(diagnosa);
			// 	})
			// }
		});
		// console.log('#'+i+"_pj");
		$('#'+i+"_dokter").chosen({no_results_text: "data tidak ditemukan!"});
		$('#'+i+"_visite").chosen({no_results_text: "data tidak ditemukan!"});

		$(".fx_diagnosa").find('input:eq(0)').attr('name','diagnosa[]');
		$(".fx_diagnosa").find('input:eq(1)').attr('name','');
		
		 
		$('#'+i+'_fx_diagnosa_input').focus();

		$('#'+i+"_waktu").datetimepicker({
			format:'Y-m-d H:i'
		});
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
            var url  = "<?=base_url()?><?=$url_poli?>/simpan_konsul";
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
        window.location = "<?=base_url()?>igd";
    });
});
</script>
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

<?php
	$i = 0;
	$j = 0;
	if (isset($konsul)){
		foreach ($konsul as $key => $value) {
			$i++;
			?>
			<script>
				$(".tbh").trigger('click');
				$("#"+<?=$i?>+"_dokter").val('<?=$value->dr_id?>');
				$("#"+<?=$i?>+"_visite").val('<?=$value->visite_tp?>');
				$("#"+<?=$i?>+"_waktu").val('<?=$value->time?>');
				$("#"+<?=$i?>+"_dokter").trigger("liszt:updated");
				$("#"+<?=$i?>+"_visite").trigger("liszt:updated");
			</script>
			<?php
			 
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
	<div class="row-fluid" style="width: 755px; margin: auto;">
		<div class="span12">
			<div class="widget-box">
				<?=form_open(base_url(),array('class' => 'form-horizontal','id' => 'form_diagnosa')); ?>
				<input type="hidden" name="mdc_id" value=<?=$mdc_id?> >
				<div class="widget-content nopadding">
					<table id="diag" cellpadding="0" cellspacing="0" border="0" class="tabel-dokter table table-bordered table_tr" style="border-left:none;">
						<thead>
							<tr role="row">
								<th class="" style="border-left:none;width:2%;">No.</th>
								<th class="" style="width:20%;">Nama Dokter</th>
								<th class="" style="width:50%;">Visite</th>
								<th class="" style="width:50%;">Waktu</th>
							 
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" style="border-left:none;">
									<button type="button" class="btn btn-warning btn-small tbh" style="margin-left:45%;">Tambah Visite</button>
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
<style type="text/css">
	.diag_container .fx_tindakan {
	    margin-bottom: 9px;
	}
	
	.waktu_container .jam_periksa {
	    	margin-bottom: 6px;
	    	background: url("../img/input-boxt.html") repeat-x scroll center top #ffffff;
		    border: 1px solid #eee;
		    border-radius: 4px;
		    color: #444444;
		    display: block;
		    height: 26px;
		    line-height: 26px;
		    overflow: hidden;
		    padding: 0 0 0 8px;
		    position: relative;
		    text-decoration: none;
		    white-space: nowrap;
	}

	.pj_container a.chzn-single{
		border: 1px solid #eee !important;	
	}

</style>