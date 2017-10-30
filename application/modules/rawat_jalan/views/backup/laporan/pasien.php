<style type="text/css" media="screen">
	select{
		width:auto;
	}
</style>
<script type="text/javascript" charset="utf-8">
	$(function(){
		$("#frm_filter").submit(function(){
			$(".black_loader").show();
			var url  = $(this).attr('action');
			var data = $(this).serialize();
			$.post(url,data, function(data) {
				$("#lap_content").html(data);
				$(".black_loader").fadeOut();
			});
			return false;
		})
		$("#frm_filter").trigger('submit');
	})
</script>
<div class="pageheader notab">
    <h1 class="pagetitle"><?=(isset($title)) ? $title : '';?></h1>       
</div><!--pageheader-->
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="icon-align-justify"></i>									
					</span>
					<h5>10 Besar penyakit rawat jalan</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="filter">
						<?=form_open(base_url('rawat_jalan/laporan/get_ten'),array('id'=>'frm_filter'));?>
							<label>
								Unit
								<select name="unit">
									<option>Semua Unit</option>
									<option>Poli tulang</option>
									<option>Poli gigi</option>
								</select>
							</label>
							<label>
								Bulan
								<select name="bulan">
									<option>Januari</option><option>Februari</option><option>Maret</option><option>April</option><option>Mei</option><option>Juni</option>
									<option>Juli</option><option>Agustus</option><option>Setember</option><option>Oktober</option><option>November</option><option>Desember</option>
								</select>
							</label>
							<label>
								Tahun
								<select name="tahun">
									<option>2012</option><option>2013</option>
								</select>
							</label>
							<button type="submit" class="btn btn-primary">proses</button>
							<br clear="all">
						</form>
						<div class="black_loader" style="top:120px !important;margin-top:0px !important">
							<img src="<?=get_loader(11)?>">
						</div>
					</div>
					<div id="lap_content" class="widget-content" style="min-height:80px"></div>
				</div>
			</div>						
		</div>
	</div>
</div>