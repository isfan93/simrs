<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />

<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>

<style type="text/css">
	.hides{
		display: none;
	}
	.shows{
		display: block;
	}
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

<table style="width:100%" class="table table-bordered tb_scrol" id="table1">
	<tr>
		<td style="width:30%">Tanggal & Jam Masuk</td>
		<td>

			<?php if(isset($medical)){
				foreach ($medical->result() as $key => $value) {
					echo "<div class='pull-right alert alert-danger'><b>Status layanan : ".$visit_status->vs_name."</b></div>";
					echo pretty_date($value->visit_in,false);
					echo " Jam :  ".date('H:i:s',strtotime($value->visit_in));
					echo "<br>";
					echo " <b>Keterangan :  ".$value->service_note."</b>";
				}
			}else{
				echo "-";
			}
			?>
			<br clear="all">
			<?php
				if((get_user('group_id')=='19')||(get_user('group_id')=='1')){
					if(isset($medical)){
						$temp = $medical->row_array();
						if($temp['service_status'] != 7){
							$visit_id = $temp['visit_id'];
							$service_id = $temp['service_id'];
							echo '<button style="margin-right:5px;" class="btn btn-small pull-right btn-warning btn-cancel-service" href="'.base_url().'rekam_medis/cancel_layanan/'.$service_id.'">Batalkan Layanan</button>';						
							echo '<button style="margin-right:5px;" class="btn btn-small pull-right btn-danger btn-finish-service" href="'.base_url().'rekam_medis/akhiri_layanan/'.$service_id.'">Akhiri Layanan</button>';						
							echo '<button style="margin-right:5px;" class="btn btn-small pull-right btn-primary btn-start-service" href="'.base_url().'rekam_medis/aktifkan_layanan/'.$service_id.'">Aktifkan Layanan</button>';						
						}
					}
					
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
	<tr class="btn-hide">
		<td style="width:30%">Vital Signs</td>
		<td>
			<div class="shows">
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
				}else{
					echo "-";
				}
				?>
			</div>
			<div class="hides">
				<?=form_open(base_url()."rekam_medis/updateVitalSign",array('class' => 'form-horizontal form','id' => 'formVitalSign','method'=>'POST')); ?>
					<input type="hidden" name="mdc_id" value="<?=isset($service_id) ? $service_id : '0'?>">
					<div style="width:100%;padding-left:30px;">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Kesadaran</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dp[ptn_medical_kesadaran]" value="<?php echo (isset($ptn_now->ptn_medical_kesadaran)) ? $ptn_now->ptn_medical_kesadaran : 'CM';?>" class="input input-small" placeholder="Kesadaran Pasien" autocomplete="off"> 
						</div>
					</div>
					<br clear="all">
					<div style="width:100%;padding-left:30px;">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Tekanan Darah</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dp[ptn_medical_blod_sy]" value="<?php echo (isset($ptn_now->ptn_medical_blod_sy)) ? $ptn_now->ptn_medical_blod_sy : '120';?>" class="input input-mini" placeholder="Sy" style="width:20px;" autocomplete="off"> / 
							<input type="text" name="dp[ptn_medical_blod_ds]" value="<?php echo (isset($ptn_now->ptn_medical_blod_ds)) ? $ptn_now->ptn_medical_blod_ds : '80';?>" class="input input-mini" placeholder="Ds" style="width:20px;" autocomplete="off">mm/Hg
						</div>
					</div>
					<br clear="all">
					<div style="width:100%;padding-left:30px;">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Tinggi Badan</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dp[ptn_medical_height]" value="<?php echo (isset($ptn_now->ptn_medical_height)) ? $ptn_now->ptn_medical_height : '';?>" class="input input-mini" placeholder="Tb" style="width:20px;" autocomplete="off"> Cm 
						</div>
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Berat Badan</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dp[ptn_medical_weight]" value="<?php echo (isset($ptn_now->ptn_medical_weight)) ? $ptn_now->ptn_medical_weight : '';?>" class="input input-mini" placeholder="Bb" style="width:20px;" autocomplete="off"> Kg 
						</div>
					</div>
					<br clear="all">
					<div style="width:100%;padding-left:30px;">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Nadi</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dp[ptn_medical_nadi]" value="<?php echo (isset($ptn_now->ptn_medical_nadi)) ? $ptn_now->ptn_medical_nadi : '80';?>" class="input input-mini" style="width:20px;" placeholder="Nadi" autocomplete="off"> BPM
						</div>
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Respiration Rate</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dp[ptn_medical_respirationrate]" value="<?php echo (isset($ptn_now->ptn_medical_respirationrate)) ? $ptn_now->ptn_medical_respirationrate : '80';?>" class="input input-mini" style="width:20px;" placeholder="Heart rate" autocomplete="off"> BPM
						</div>
					</div>
					<br clear="all">
					<div style="width:100%;padding-left:30px;">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Temperatur</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dp[ptn_medical_temperatur]" value="<?php echo (isset($ptn_now->ptn_medical_temperatur)) ? $ptn_now->ptn_medical_temperatur : '37';?>" class="input input-mini" style="width:20px;" placeholder="Temperatur" autocomplete="off"> Celcius
						</div>
					</div>
				<?=form_close()?>
			</div>
			<button class="btn btn-mini btn-warning pull-right hide edit">edit</button>
			<button class="btn btn-mini btn-primary pull-right hide simpan">simpan</button>
		</td>
	</tr>
	<tr class="btn-hide">
		<td>Dokter</td>
		<td>
			<div class="shows">
				<?php if(! empty($dokter)){
					echo $dokter->dr_name;
				}else{
					echo "-";
				}?>
			</div>
			<div class="hides">
				<?=form_open(base_url()."rekam_medis/updateDokter",array('class' => 'form-horizontal form','id' => 'formDokter','method'=>'POST')); ?>
					<input type="hidden" name="mdc_id" value="<?=isset($service_id) ? $service_id : '0'?>">
					<div style="">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Dokter</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<input type="text" name="dokter[dr_id]" id="dokter" class="input input-small" placeholder="Dokter" autocomplete="off"> 
						</div>
					</div>
				<?=form_close()?>
			</div>
			<button class="btn btn-mini btn-warning pull-right hide edit">edit</button>
			<button class="btn btn-mini btn-primary pull-right hide simpan">simpan</button>
		</td>
	</tr>
	<tr id="subjstudy" class="btn-hide">
		<td>Subjective & Objective</td>
		<td>
			<div class="shows">
				<?php
				$anamnesaValue = $objectiveValue = '';
				?>
				<?php if(isset($anamnesa)) : ?>
					<?php if($anamnesa->num_rows() >= 1){
						foreach ($anamnesa->result() as $key => $value) {
							echo "<b>Subjective :</b> ".$value->ma_desc;
							echo "<br>";
							$anamnesaValue .= $value->ma_desc;
						}
					}else{
						echo "-";
					}?>
				<?php endif;?>
				
				<?php if(isset($objective)) : ?>
					<?php if($objective->num_rows() >= 1){
						foreach ($objective->result() as $key => $value) {
							echo "<b>Objective :</b> ".$value->mo_desc;
							echo "<br>";
							$objectiveValue .= $value->mo_desc;
						}
					}else{
						echo "-";
					}?>
				<?php endif;?>
			</div>
			<div class="hides">
				<?=form_open(base_url()."rekam_medis/updateAnamnesa",array('class' => 'form-horizontal form','id' => 'formSubjecttive','method'=>'POST')); ?>
					<input type="hidden" name="mdc_id" value="<?=isset($service_id) ? $service_id : '0'?>">
					<div style="">
						<div style="float:left;">
							<textarea name="anamnesa" id="anamnesa" class="input input-xlarge" placeholder="Keluhan Pasien"><?=(isset($anamnesaValue)) ? $anamnesaValue : ''?></textarea>
						</div>
					</div>
					<br clear="all">
					<div style="margin-top:10px;">
						<div style="float:left;">
							<textarea name="objective" id="objective" class="input input-xlarge" placeholder="Temuan Pemeriksaan"><?=(isset($objectiveValue)) ? $objectiveValue : ''?></textarea>
						</div>
					</div>
				<?=form_close()?>
			</div>
			<button class="btn btn-mini btn-warning pull-right hide edit">edit</button>
			<button class="btn btn-mini btn-primary pull-right hide simpan">simpan</button>
		</td>
	</tr>
	<tr id="diagnose" class="btn-hide">
		<td>
			Assessment
		</td>
		<td>
			<div class="shows">
				<?php if(isset($diagnosa)) : ?>
					<?php if($diagnosa->num_rows() >= 1){
						foreach ($diagnosa->result() as $key => $value) {
							echo "<b>Diagnosa : </b>".$value->diag_name." (".$value->description.")<br><b>Kode ICD-IX: </b>".$value->diag_kode."    <b><br>Catatan :</b>".$value->dat_note;
							echo "<br>";
						}
					}else{
						echo "-";
					}?>
				<?php endif;?>
			</div>
			<div class="hides">
				<?=form_open(base_url()."rekam_medis/updateDiagnosa",array('class' => 'form-horizontal form','id' => 'formDiagnosa','method'=>'POST')); ?>
					<input type="hidden" name="mdc_id" value="<?=isset($service_id) ? $service_id : '0'?>">
					<div id="diagnosa-box">
						
					</div>
					<button class="btn btn-warning btn-mini add-diagnosa">Tambah Diagnosa</button>
				<?=form_close()?>
			</div>
			<button class="btn btn-mini btn-warning pull-right hide edit">edit</button>
			<button class="btn btn-mini btn-primary pull-right hide simpan">simpan</button>
		</td>
	</tr>
	<tr id="diagnose" class="btn-hide">
		<td>Plan</td>
		<td>
			<b>Procedures : </b><br>
			<?php if(isset($detail_diagnosa)) : ?>
				<?php if($detail_diagnosa->num_rows() >= 1){
					foreach ($detail_diagnosa->result() as $key => $value) {
						echo   "-".$value->treat_name;
						echo "<br>";
					}
				}else{
					echo "-";
				}?>
			<?php endif;?>
			<br>
			<b>Labs & Radiology :</b><br>
			<?php if(isset($penunjang)) : ?>
				<?php if($penunjang->num_rows() >= 1){
					foreach ($penunjang->result() as $key => $value) {
						echo "Penunjang : ".$value->ds_name;
						$ekspertise = '';
						$lab_queue_id = $value->lab_queue_id;
						if( (isset($penunjang_detail)) && ($penunjang_detail->num_rows() >= 1) )
						{
							foreach ($penunjang_detail->result() as $k => $v) {
								if( $v->lab_queue_id == $value->lab_queue_id)
									$ekspertise .= $v->dsupport_ekspertise_note;
							}
							echo "<br>";
						}
						if(substr($lab_queue_id, 0,2) == 'LB')
							echo " <b>(<a href='".base_url()."lab/cetak_hasil_pemeriksaan/".$lab_queue_id."' target='_blank'>Lihat Hasil</a>)</b>";
						else
							echo " <b>(<a href='".base_url()."rad/cetak_hasil_pemeriksaan/".$lab_queue_id."' target='_blank'>Lihat Hasil</a>)</b>";
						echo "<br>";
					}
					// echo "<br><b>Catatan Ekspertise :</b> ".$ekspertise;
				}else{
					echo "-";
				}?>
			<?php endif;?>
			<br>
			<b>Medications :</b><br>
			<?php if(isset($obat)) : ?>
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
			<?php endif;?>
			<!-- <button class="btn btn-mini btn-warning pull-right hide edit">edit</button> -->
		</td>
	</tr>
	<tr class="btn-hide">
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
			<!-- <button class="btn btn-mini btn-warning pull-right hide edit">edit</button> -->
		</td>
	</tr>

	<tr id="keterangan" class="btn-hide">
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
		<!-- <button class="btn btn-mini btn-warning pull-right hide edit">edit</button> -->
		</td>
	</tr>
</table>
<script type="text/javascript" charset="utf-8">
    $(function(){
    	var i = 0;
    	<?php if((get_user('group_id')=='19')||(get_user('group_id')=='1')) : ?>
	    	$(".btn-hide").hover(function(){
	    		$(this).find('.edit').removeClass('hide');
	    	},function(){
	    		$(this).find('.edit').addClass('hide');
	    	});
	    	$(".edit").click(function(){
	    		$(this).parent().find('.shows').fadeOut("fast",function(){
	    			$(this).parent().find('.hides').fadeIn("fast");
	    		});
	    		$(this).addClass('hide');
	    		$(this).addClass('temp-edit');
	    		$(this).removeClass('edit');
	    		$(this).parent().find('.simpan').removeClass('hide');
	    	});

	    	$(".simpan").click(function(){
	    		var formId = $(this).parent().find('.form').attr('id');
	    		var url = $(this).parent().find('.form').attr('action');
	    		var data = $("#"+formId).serialize();
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
                $.post(url,data, function(result){
                    var result = JSON.parse(result);
                    $.unblockUI({
                        onUnblock: function(){
                            if (result.success === true) {
                                $(".alert").fadeIn().delay(500).fadeOut(function(){
                                    $(this).addClass('hide');
						    		$(this).parent().find('.temp-edit').addClass('edit');
						    		$(this).parent().find('.temp-edit').addClass('hide');
						    		$(this).parent().find('.temp-edit').removeClass('temp-edit');
						    		$('body').find('.active').children().trigger('click');
                                });
                            } else {
                                alert('Update data vital sign Gagal, silahkan hubungi administrator.');
                            }
                        }
                    });
                });
	    	});
			$('#dokter').select2({
	            width : '300px',
	            placeholder: "Pilih Obat / Alkes",
	            minimumInputLength : 3,
	            ajax: {
			        url:  BASE + "master/data_pegawai/getDokter",
			        dataType: 'json',
			        type: "POST",
			        quietMillis: 50,
			        data: function (term) {
			            return {
			                term: term,
			                "<?php echo $this->security->get_csrf_token_name()?>" : "<?php echo $this->security->get_csrf_hash()?>",
			            };
			        },
			        results: function (data) {
			            return {
			                results: $.map(data, function (item) {
			                    return {
			                        text: item.name,
			                        id: item.id
			                    }
			                })
			            };
			        }
			    },
	            createSearchChoice:function(term, data) {
	                if ( $(data).filter( function() {
	                   return this.text.localeCompare(term)===0;
	                }).length===0) {
	                   return {id:term, text:term};
	                }
	            },
	        });

			$(".add-diagnosa").click(function(){
				var diagnosabox = '<div class="control-group">'
						+'<label class="control-label" style="width:60px;">Diagnosa</label>'
						+'<div class="controls" style="margin-left:80px;">'
							+'<input type="text" name="diagnosa[]" id="diagnosa'+i+'" class="input input-small" placeholder="Diagnosa" autocomplete="off">'
						+'</div>'
					+'</div>';
				$("#diagnosa-box").append(diagnosabox);

				$('#diagnosa'+i).select2({
		            width : '300px',
		            placeholder: "Diagnosa",
		            minimumInputLength : 3,
		            ajax: {
				        url:  BASE + "master/data_diagnosa/getDiagnosa",
				        dataType: 'json',
				        type: "POST",
				        quietMillis: 50,
				        data: function (term) {
				            return {
				                term: term,
				                "<?php echo $this->security->get_csrf_token_name()?>" : "<?php echo $this->security->get_csrf_hash()?>",
				            };
				        },
				        results: function (data) {
				            return {
				                results: $.map(data, function (item) {
				                    return {
				                        text: item.diag_name+' ('+item.description+')',
				                        id: item.diag_id
				                    }
				                })
				            };
				        }
				    },
		            createSearchChoice:function(term, data) {
		                if ( $(data).filter( function() {
		                   return this.text.localeCompare(term)===0;
		                }).length===0) {
		                   return {id:term, text:term};
		                }
		            },
		        });
				i = i+1;
				return false;
			});
	    <?php endif;?>
    });
</script>