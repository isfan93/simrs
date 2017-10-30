<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style>
	tr#penunjang a,tr#subjstudy a,tr#objstudy a,tr#diagnose a,tr#medicine a,tr#rujukan a,tr#keterangan a{display: none;}
	tr#penunjang:hover a,tr#subjstudy:hover a,tr#objstudy:hover a,tr#diagnose:hover a,tr#medicine:hover a,tr#rujukan:hover a,tr#keterangan:hover a{display: inline;}
	.btn-mini{margin:0px;line-height: 15px !important;}
</style>
<style type="text/css">
	.alert{
		background-color: transparent;
		border: 0px;
	}
	
	#gritter-notice-wrapper{
		right: 13%;
		top: 100px;
	}
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>

<script type="text/javascript">
$(function(){
	$("#lihat_antrian").click(function(){
            window.location = "<?=base_url()?><?=$url_poli?>";
    });
	$('#table1 a').click(function(){
		id = $(this).attr('href');
		$('#tab_'+id).click();
		return false;
	});

	isvalid = $("#form_finish").validate({
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
            var url  = "<?=base_url()?><?=$url_poli?>/finish_pemeriksaan";
            var data = jQuery(form).serialize();
            $.post(url,data, function(data){
                $.unblockUI({ 
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                        	$("#save").trigger('click'); 
                           	window.location = "<?=base_url()?><?=$url_poli?>";
                        });
                    } 
                }); 
            });
        }
    });

	$('.simpan').click(function(){
		if (confirm('Apakah pasien sudah selesai dalam menjalani proses pemeriksaan?')){
    		$("#form_finish").submit();
		}
		return false;
    });

	$("#service_note").bind('input propertychange',function(){
		cek_service_note();
	});

	function cek_service_note()
	{
		var service_note = $("#service_note").val();
		if(service_note.length <= 0)
		{
			$(".simpan").attr('disabled','disabled');
		}else{
			$(".simpan").removeAttr('disabled');
		}
	}

    $("#save").click(function(){});
})
</script>

<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed;right:13%;top:100px">
	<div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
		<div class="gritter-top"></div>
		<div class="gritter-item">
			<div class="gritter-close" style="display: none; width:50px "></div>
			<img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
			<div class="gritter-with-image" style="width:448px">
				<span class="gritter-title" style="margin-left:36px">Message</span>
				<p>Data Berhasil Disimpan 	</p>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="gritter-bottom"></div>
	</div>
</div>

<div>
	<div style="padding:10px;">
		<?=form_open(base_url().$url_poli.'/finish_pemeriksaan',array('class' => 'form-horizontal','id' => 'form_finish')); ?>
		<input type="hidden" name="mdc_id" value=<?=$mdc_id?> >
		<table style="width:100%" class="table table-bordered tb_scrol" id="table1">
			<tr>
				<td style="width:30%">Tanggal & Jam Masuk</td>
				<td>

					<?php if(isset($medical)){
						foreach ($medical->result() as $key => $value) {
							echo pretty_date($value->visit_in,false);
							echo " Jam :  ".date('H:i:s',strtotime($value->visit_in));
						}
					}else{
						echo "-";
					}
					?>
				</td>
			</tr>
			<tr>
				<td style="width:30%">Jenis Pemeriksaan</td>
				<td>
					<?php if(isset($medical)){
						foreach ($medical->result() as $key => $value) {
							if( substr($value->service_id,0,2) == 'RJ'){
								echo "<b>Rawat Jalan (";echo (isset($value->pl_name)) ? $value->pl_name : '-'; echo ")</b>";
							}
							else if( substr($value->service_id,0,2) == 'RN')
								echo "<b>Rawat Inap</b>";
							else if( substr($value->service_id,0,2) == 'IG')
								echo "<b>IGD</b>";
							else if( substr($value->service_id,0,2) == 'LB')
								echo "<b>Laboratorium</b>";
							else if( substr($value->service_id,0,2) == 'RD')
								echo "<b>Radiologi</b>";
						}
					}else{
						echo "-";
					}
					?>
				</td>
			</tr>
			<tr>
				<td style="width:30%">Vital Signs</td>
				<td>

					<?php if( !empty($ptn_now) ){
							echo "Kesadaran : ";
							echo $ptn_now->ptn_medical_kesadaran;
							echo "<br>";
							echo "Tekanan Darah : ";
							echo $ptn_now->ptn_medical_blod_sy;
							echo "/";
							echo $ptn_now->ptn_medical_blod_ds;
							echo " mm/Hg";
							echo "<br>";
							echo "Tinggi Badan : ";
							echo $ptn_now->ptn_medical_height;
							echo " cm";
							echo "<br>";
							echo "Berat badan : ";
							echo $ptn_now->ptn_medical_weight;
							echo " Kg";
							echo "<br>";
							echo "Nadi : ";
							echo $ptn_now->ptn_medical_nadi;
							echo "<br>";
							echo "Respiration rate : ";
							echo $ptn_now->ptn_medical_respirationrate;
							echo "<br>";
							echo "Temperatur : ";
							echo $ptn_now->ptn_medical_temperatur;
							echo "<br>";
							echo "SpO2 : ";
							echo $ptn_now->ptn_medical_spo2;
							echo "<br>";
					}else{
						echo "-";
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Dokter</td>
				<td>
					<?php if(! empty($dokter)){
						echo $dokter->dr_name;
					}else{
						echo "-";
					}?>
					
				</td>
			</tr>
			<tr id="subjstudy">
				<td>Subjective & Objective</td>
				<td>
					<?php if($anamnesa->num_rows() >= 1){
						foreach ($anamnesa->result() as $key => $value) {
							echo "<b>Subjective :</b> ".$value->ma_desc;
							echo "<br>";
						}
					}else{
						echo "-";
					}?>

					<?php if($objective->num_rows() >= 1){
						foreach ($objective->result() as $key => $value) {
							echo "<b>Objective :</b> ".$value->mo_desc;
							echo "<br>";
						}
					}else{
						echo "-";
					}?>
					
				</td>
			</tr>
			<tr id="diagnose">
				<td>
					Assessment
				</td>
				<td>
					<?php if($diagnosa->num_rows() >= 1){
						foreach ($diagnosa->result() as $key => $value) {
							echo "<b>Diagnosa : </b>".$value->diag_name." (".$value->description.")  <b><br>Catatan :</b>".$value->dat_note;
							echo "<br>";
						}
					}else{
						echo "-";
					}?>
				</td>
			</tr>
			<tr id="diagnose">
				<td>Plan</td>
				<td>
					<b>Procedures : </b><br>
					<?php if($detail_diagnosa->num_rows() >= 1){
						foreach ($detail_diagnosa->result() as $key => $value) {
							echo   "- ".$value->treat_name;
							echo "<br>";
						}
					}else{
						echo "-";
					}?>
					<br>
					<b>Labs & Radiology :</b><br>
					<?php if($penunjang->num_rows() >= 1){
						foreach ($penunjang->result() as $key => $value) {
							echo "Penunjang : ".$value->ds_name;
							echo "<br>";
						}
					}else{
						echo "-";
					}?>
					<br>
					<b>Medications :</b><br>
					<?php
					if($obat->num_rows() >= 1){
						foreach ($obat->result() as $key => $value) {
							 echo $value->im_name."&nbsp;&nbsp;&nbsp;&nbsp;".(float)$value->recipe_qty."&nbsp;&nbsp;&nbsp;".$value->recipe_rule;
							 echo "<br>";
						}
					}
					if($racikan->num_rows() >= 1){
						foreach ($racikan->result() as $key => $value) {
							echo $value->racikan_name."&nbsp;&nbsp;&nbsp;&nbsp;".$value->racikan_rule;
						}
					}
					?>
				</td>
			</tr>
			<tr>
				<td>
					Visite / Konsul
				</td>
				<td>
					<?php if( (isset($visite)) && ($visite->num_rows() >= 1) ) : ?>
						<?php foreach ($visite->result() as $key => $value) : ?>
							<b><?=$value->sd_name?></b> : <?=$value->treat_name?><br>
						<?php endforeach;?>
					<?php else :?>
						-
					<?php endif;?>
				</td>
			</tr>

			<tr id="keterangan">
				<td>Surat keterangan yang dikeluarkan</td>
				<td>
				<?php
				if($surat_keterangan->num_rows() >= 1){
					foreach ($surat_keterangan->result() as $key => $value) {
						 echo $value->ref_number." - ".$value->ref_category;
						 echo "<br>";
					}
				}else{
					echo "-";
				}?>
				</td>
			</tr>
		</table>
		<div class="span12">
			<label class="span2 offset6"><b>Keterangan :* </b><br> Pasien Pulang (Meninggal/Penyembuhan) / Pasien Ke Rawat Inap (Isolasi/Tidak)</label>
			<textarea name="service_note" class="span4" rows="4" id="service_note" placeholder="Pasien Pulang (Meninggal/Penyembuhan) / Pasien Ke Rawat Inap (Isolasi/Tidak)"></textarea>
		</div>
		<br clear="all">
	</div>
	<div class="form-actions" style="margin-bottom:0px;">
		<button type="button"  class="btn btn-primary simpan pull-right" value="" disabled="disabled">Selesai</button>
        <a target="_blank" href="<?=cur_url(-2)?>cetak_ringkasan/<?=$mdc_id?>" id="cetak_ringkasan" class="btn  btn-info pull-right" style="margin-right:10px;">Cetak Ringkasan</a>
        <button type="button" id="lihat_antrian" class="btn pull-right" style="margin-right:10px;">Lihat Antrian</button>
	</div>
	<?=form_close()?>
</div>
