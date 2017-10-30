<div class="container-fluid" style="margin-top:30px;">
    <div class="row-fluid">
        <div class="span2">
        	<div>
				<img src="<?=base_url()?>assets/image-sistem/default-profil-picture.jpg" class="img-polaroid" style="border:1px solid #FB9337;">
        	</div>
        	<div style="text-align:right;margin-top:-25px;margin-right:-11px;">
        		<button class="btn btn-warning btn-small">Ubah Foto</button>
        	</div>
        </div>
        <div class="span3">
        	<div class="title" style="margin-top:-20px;margin-left:-10px;">
        		<h3><?=$user->sd_name?></h3>
        		<i><?=$user->sd_address?></i>
        	</div>
        	<p style="margin-left:-8px;">
        		<?=strtoupper($user->description)?> <br>
        		<b>NIP <?=strtoupper($user->sd_nip)?> </b><br>
        		<?=($user->sd_sex=='P') ? 'Perempuan' : 'Laki - Laki'?><br>
        		<?=$user->sd_age?> Tahun<br>
        		<?=strtoupper($user->sd_place_of_birth)?> (<?=(!empty($user->sd_date_of_birth)) ? pretty_date($user->sd_date_of_birth,false) : ''?>)<br>
        		<?=$user->sd_religion?><br>
        		Terdaftar sejak <b><?=(!empty($user->sd_reg_date)) ? pretty_date($user->sd_reg_date) : '' ?></b>
        	</p>
            <p style="margin-left:-8px;">
                <b>Username : <?=$user->user_name?></b><br>
                <b>Password : *******</b> <a href=""><u>ubah password</u></a>
            </p>
        </div>
        <div class="span7" style="">
        	<div class="title" style="margin-top:-20px;">
        		<h3>Aktifitas Terakhir</h3>
        	</div>
        	<div style="border-left:3px solid #FB9337;margin-left:20px;background:#EEEEEE;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Resep dan Racikan untuk pasien Sigit Hanafi</p>
        	</div>
        	<div style="margin-left:20px;background:#FFFFFF;padding:8px;">
        		<p><?=$user->sd_name?> Mengirim Resep dan Racikan pasien Sigit Hanafi ke Kasir</p>
        	</div>
        	<div style="border-left:3px solid #FB9337;margin-left:20px;background:#EEEEEE;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Resep dan Racikan untuk pasien Wawan A</p>
        	</div>
        	<div style="margin-left:20px;background:#FFFFFF;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Resep dan Racikan untuk pasien Wahyudi</p>
        	</div>
        	<div style="border-left:3px solid #FB9337;margin-left:20px;background:#EEEEEE;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Purchase Order untuk tanggal <?=pretty_date(date('Y-m-d'),false)?></p>
        	</div>
        	<div style="margin-left:20px;background:#FFFFFF;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Resep dan Racikan untuk pasien Wahyudi</p>
        	</div>
        	<div style="border-left:3px solid #FB9337;margin-left:20px;background:#EEEEEE;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Purchase Order untuk tanggal <?=pretty_date(date('Y-m-d'),false)?></p>
        	</div>
        	<div style="margin-left:20px;background:#FFFFFF;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Resep dan Racikan untuk pasien Wahyudi</p>
        	</div>
        	<div style="border-left:3px solid #FB9337;margin-left:20px;background:#EEEEEE;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Purchase Order untuk tanggal <?=pretty_date(date('Y-m-d'),false)?></p>
        	</div>
        	<div style="margin-left:20px;background:#FFFFFF;padding:8px;">
        		<p><?=$user->sd_name?> Membuat Resep dan Racikan untuk pasien Wahyudi</p>
        	</div>
        </div>
    </div>
</div>