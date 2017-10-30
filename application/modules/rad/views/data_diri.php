<script>
	$(function(){
		$(".black_loader").fadeIn(300).delay(50).fadeOut(300);
	})
</script>
<?php
if((isset($pasien)) && ($pasien->sd_rekmed != 0)){
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
				<input type="hidden" id="lab_queue_id" name="ds[lab_queue_id]" value="<?=$pasien->lab_queue_id?>">
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
				<div class="form-actions" style="margin:0px;vertical-align:bottom;">
					<button type="submit" class="btn btn-primary" style="float:right">Tindakan</button>
				</div>
			</form>
		</div>
	<?php
}else if( (isset($pasien)) && ($pasien->sd_rekmed == 0) ){
		?>
		<div class="title">
			<h3>Data Diri Pasien Rujukan
				<span class="tgl-sekarang"></span> 
			</h3>
		</div>
		<div style="width:100%;border:1px solid #DDD;position:relative;">
			<div class="black_loader">
				<img src="<?=get_loader(11)?>">
			</div>
			<?=form_open(cur_url(-3).'proses',array('class' => 'stdform','id' => 'form')); ?>
				<input type="hidden" id="lab_queue_id" name="ds[lab_queue_id]" value="<?=$pasien->lab_queue_id?>">
				<input type="hidden" name="ds[sd_rekmed]" value="<?=$pasien->sd_rekmed?>">
				<input type="hidden" name="ds[visit_desc]" value="<?=$pasien->visit_desc?>">
				<br clear="all">
				<br clear="all">
				<div style="width:100%;padding-left:30px;">
					<div style="width:100px;float:left;height:40px;text-align:right;">
						<label>Keterangan</label>
					</div>
					<div style="margin-left:30px;float:left;">
						<b><?=$pasien->visit_desc?></b>
					</div>
				</div>
				<br clear="all">
				<div class="form-actions" style="margin:0px;vertical-align:bottom;">
					<button type="submit" class="btn btn-primary" style="float:right">Tindakan</button>
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
