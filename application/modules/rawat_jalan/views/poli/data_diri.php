<script>
	$(function(){
		$(".black_loader").fadeIn(300).delay(50).fadeOut(300);

		$("#simpan").click(function(){
			var url = BASE + "rawat_jalan/<?=$url_poli?>/proses_simpan";
			data = $("form").serialize();
			$.post(url,data, function(data){
                $(".alert").fadeIn().delay(500).fadeOut(function(){
                    
                });     
            }); 
            return false;
		});
	})
</script>

<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css">
	.alert{
        /*background-color: transparent;*/
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
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

<?php
if(isset($pasien)){
	?>
		<div class="title">
			<h3>Data Diri Pasien <?=$pasien->sd_name?>  
				<span class="tgl-sekarang"></span>
			</h3>
		</div>
		<div style="width:100%;border:1px solid #DDD;position:relative;">
			<div class="black_loader">
				<img src="<?=get_loader(11)?>">
			</div>
			<?=form_open(cur_url(-3).'proses',array('class' => 'stdform','id' => 'form')); ?>
				<input type="hidden" id="queo_id" name="ds[queo_id]" value="<?=$pasien->queo_id?>">
				<input type="hidden" id="pl_id" name="ds[pl_id]" value="<?=$pasien->pl_id?>">
				<input type="hidden" id="dr_id" name="ds[dr_id]" value="<?=$pasien->dr_id?>">
				<input type="hidden" id="mdc_id" name="dp[mdc_id]" value="<?=$pasien->queo_id?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value = "<?=$this->security->get_csrf_hash()?>" >
				<br clear="all">
				<div style="width:100%;padding-left:30px;">
					<div style="width:100px;height:40px;float:left;text-align:right;">
						<label>Nomor RM </label>
					</div>
					<div style="margin-left:30px;float:left;">
						<b><?=$pasien->sd_rekmed?></b>
					</div>
					<input type="hidden" name="ds[sd_rekmed]" value="<?=$pasien->sd_rekmed?>">
				</div>
				<br clear="all">
				<div style="width:100%;padding-left:30px;">
					<div style="width:100px;height:40px;float:left;text-align:right;">
						<label>Nama Lengkap</label>
					</div>
					<div style="margin-left:30px;float:left;">
						<b><?=$pasien->sd_name?></b>
					</div>
					<input type="hidden" name="ds[sd_name]" value="<?=$pasien->sd_name?>">
				</div> 
				<br clear="all">
				<div style="width:100%;padding-left:30px;">
					<div style="width:100px;float:left;height:40px;text-align:right;">
						<label>Jenis Kelamin</label>
					</div>
					<div style="margin-left:30px;float:left;">
						<b><?=$pasien->sd_sex?></b>
					</div>
					<input type="hidden" name="ds[sd_sex]" value="<?=$pasien->sd_sex?>">
				</div> 
				<br clear="all">
				<div style="width:100%;padding-left:30px;">
					<div style="width:100px;float:left;height:40px;text-align:right;">
						<label>Alamat</label>
					</div>
					<div style="width:200px;margin-left:30px;float:left;">
						<b><?=$pasien->sd_address?></b>
					</div>
					<input type="hidden" name="ds[sd_address]" value="<?=$pasien->sd_address?>">
				</div> 
				<br clear="all">
				<div style="width:100%;padding-left:30px;">
					<div style="width:100px;height:40px;float:left;text-align:right;">
						<label>Umur</label>
					</div>
					<div style="margin-left:30px;float:left;">
						<b><?=$pasien->sd_age?></b>
					</div>
					<input type="hidden" name="ds[sd_age]" value="<?=$pasien->sd_age?>">
				</div> 
				<br clear="all">
				<div style="width:100%;padding-left:30px;">
					<div style="width:100px;float:left;height:40px;text-align:right;">
						<label>Gol. Darah</label>
					</div>
					<div style="margin-left:30px;float:left;">
						<b><?=$pasien->sd_blood_tp?></b>
					</div>
					<input type="hidden" name="ds[sd_blood_tp]" value="<?=$pasien->sd_blood_tp?>">
				</div>
				<br clear="all">
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
				<?php
					if ( $pasien->sd_alergi == '' )
					{
					?>
					<br clear="all">
					<div style="width:100%;padding-left:30px;">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Alergi</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<textarea name="sd[sd_alergi]" placeholder="Alergi"></textarea>
						</div>
					</div>
					<?php
					}
				?>
				<?php
					if ( $pasien->sd_riwayat_penyakit == '' )
					{
					?>
					<br clear="all">
					<div style="width:100%;padding-left:30px;">
						<div style="width:100px;float:left;height:40px;text-align:right;">
							<label>Riwayat Penyakit</label>
						</div>
						<div style="margin-left:30px;float:left;">
							<textarea name="sd[sd_riwayat_penyakit]" placeholder="Riwayat penyakit"></textarea>
						</div>
					</div>
					<?php
					}
				?>
				<br clear="all">
				<div class="form-actions" style="margin:0px;vertical-align:bottom;">
				<?php if ( in_array(get_user('group_id'), array('1','2','5','6','9')) ) : ?>
					<button type="submit" class="btn btn-primary" style="float:right">Pemeriksaan</button>
				<?php else : ?>
					<button type="button" id="simpan" class="btn btn-primary" style="float:right">Simpan</button>
				<?php endif; ?>
				</div>
			</form>
		</div>
	<?php
}else{
	?>
	<div class="alert alert-info" style="position:relative">
		<div class="black_loader">
			<img src="<?=get_loader(11)?>">
		</div>
		<button class="close" data-dismiss="alert">×</button>
		<div class="title" style="border-bottom:none">
			<h3>Data Diri Pasien Tidak tersedia</h3>
		</div>
	</div>
	<?php
}
?>
