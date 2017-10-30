<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css">
	.tables thead tr th{
		height:28px;
		font-size:13px;
		vertical-align: middle;
	}

	.ffb-input{
		background: transparent;
		border: none;
		width: 100% !important;
		/*border-bottom: 1px dotted gray;*/
	}
	textarea{
		background: transparent;
		border: none;
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
    .img{
    	max-width: 200px;
    }
    .linkimg{
    	float: right;
    }
</style>

<script>
	var ags = 0;
	var i = 0;
	$(function(){
		$(".tbh").click(function(){
			add();					
		})
		function add(){
			i++;
			var str = ("<tr>");
				str += ("<td style='text-align:center;vertical-align:top;width:10px !important;border-left:none;'><b>"+i+"</b></td>");
				str += ("<td style='width:20%;vertical-align:top;'><div id='"+i+"_fx_penunjang' class='fx_penunjang' style='width:98%;border-bottom:1px dotted gray;''></div><input type='hidden' id='"+i+"_harga' name='harga[]' class='harga' ><input type='hidden' id='"+i+"_nama_penunjang' name='nama_penunjang[]' class='nama_penunjang' ></td>");
				str += ("<td style='width:30%;'><div id='' class='' style='width:98%;'><span id='"+i+"_hasil' readonly='true' style='width:100%;' cols='80' rows='5' placeholder='Hasil tes tindakan penunjang'></span></div></td>");
				str += ("</tr>");
				$("#penunjang tbody").append(str);
				$('#'+i+'_fx_penunjang').flexbox(BASE+'rawat_jalan/<?=$url_poli?>/get_penunjang',{
					paging: false,
					showArrow: false ,
					maxVisibleRows : 0,
					width : 300,
					resultTemplate: '{id} - {name} - {harga}',
					onSelect: function() {
						var id = $(this).parent().find('input:eq(0)').val();
						var id_harga = $(this).parent().parent().find('input:eq(2)').attr('id');
						var id_nama_penunjang = $(this).parent().parent().find('input:eq(3)').attr('id');
						$.getJSON(BASE+"rawat_jalan/<?=$url_poli?>/json_get_penunjang/"+id, function(json) {
							$("#"+id_harga).val(json.harga);
							$("#"+id_nama_penunjang).val(json.name);
						})
					}
				});
			$(".fx_penunjang").find('input:eq(0)').attr('name','penunjang[]');
		}

		isvalid = $("#form_penunjang").validate({
			rules: {
	            
	        },
	        submitHandler: function(form) {
	            var url  = "<?=base_url()?>rawat_jalan/<?=$url_poli?>/simpan_penunjang";
	            var data = jQuery(form).serialize();
	            $.post(url,data, function(data){
	                $(".alert").fadeIn().delay(500).fadeOut(function(){
	                    $("#tab_penunjang").trigger('click'); 
	                });     
	            }); 
	            return false;
	        }
	    });

	    $("#save").click(function(){});

	    $("#lihat_antrian").click(function(){
            window.location = "<?=base_url()?>igd";
    	});
	});
</script>
<?php
	$i = 0;
	if (!empty($penunjang)){
		foreach ($penunjang->result() as $key => $value) {
			$i++;
			?>
			<script>
				$(".tbh").trigger('click');
				$("#"+<?=$i?>+"_fx_penunjang_hidden").val('<?=$value->ds_id?>');
				$("#"+<?=$i?>+"_fx_penunjang_input").val('<?=$value->ds_name?>');
				$("#"+<?=$i?>+"_harga").val('<?=$value->ds_price?>');
				$("#"+<?=$i?>+"_nama_penunjang").val('<?=$value->ds_name?>');
			</script>
			<?php
			if($penunjang_detail->num_rows() >= 1){
				$hasil = '';
				foreach ($penunjang_detail->result() as $k => $v) {
					if( $value->trx_ds_id == $v->trx_ds_id ){
	                    $link 	= "<br><a class=linkimg target=_blank href=".$v->dsupport_value_image."><img class=img src=".$v->dsupport_value_image."></a>";
	                    $hasil .= (!empty($v->dsupport_value_image)) ? $link : '-' ;
						$hasil .= $v->dsupport_name;
	                    $hasil .= "<br>Nilai Rujukan : ";
	                    $hasil .= $v->dsupport_standart_value;
	                    $hasil .= " ";
	                    $hasil .= $v->dsupport_satuan;
	                    $hasil .= "<br><b>Hasil Lab : ";
	                    $hasil .= (!empty($v->dsupport_value)) ? $v->dsupport_value : '-' ;
	                    $hasil .= "</b><br>";
						?>
						<script>
							var hasil = "<?php echo $hasil;?>";
							$("#"+<?=$i?>+"_hasil").html(hasil);
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
			<div class="widget-box">
				<?=form_open(base_url().'rawat_jalan/<?=$url_poli?>/simpan_penunjang',array('class' => 'form-horizontal','id' => 'form_penunjang')); ?>
				<input type="hidden" name="mdc_id" value=<?=$mdc_id?> >
				<input type="hidden" name="sd_rekmed" value=<?=$sd_rekmed?> >
				<div class="widget-content nopadding">
					<table id="penunjang" cellpadding="0" cellspacing="0" border="0" class="tabel-dokter table table-bordered table_tr" style="border-left:none;">
						<thead>
							<tr role="row">
								<th class="" style="border-left:none;width:2%;">No.</th>
								<th class="" style="width:20%;">Labs / Radiology</th>
								<th class="" style="width:40%;">Hasil</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" style="border-left:none;">
									<button type="button" class="btn btn-warning btn-small tbh" style="margin-left:45%;">Tambah</button>
								</td>
							</tr>
						</tfoot>
					</table>							
				</div>
				<div class="form-actions" style="margin-bottom:0px;margin-top:0px;">
					<?php
					$status = (isset($visit) && ($visit->visit_status == '5')) ? 'disabled' : '';
					?>
					<button type="submit" class="btn btn-primary pull-right" <?php echo $status;?> >Simpan</button>
                    <button type="button" id="lihat_antrian" class="btn pull-right" style="margin-right:10px;">Lihat Antrian</button>
				</div>
				<?=form_close()?> 
			</div>
		</div>
	</div>
</div>