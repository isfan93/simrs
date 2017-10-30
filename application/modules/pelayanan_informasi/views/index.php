<script type="text/javascript" charset="utf-8">
	$(function(){
		$('.tabel-dokter').dataTable( {
             
               "sPaginationType": "bootstrap",
               "sScrollY": "300px",
               "bPaginate": false
               
           });
			$('#DataTables_Table_0_filter').hide();
	})
</script>
<style>
    .dataTables_scrollHead{
        margin-bottom: -22px;
    }
    .dataTables_info{
        margin-top: 20px;
    }
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
	<div class="row-fluid">
        <div class="span12 center" style="text-align: center;">                 
			<ul class="quickstats">
				<li>
					<a href="<?=base_url()?>pelayanan_informasi/informasi_pasien"><img alt="" src="<?=base_url()?>assets/img/icons/32/people.png" width="64" height="64"><span>informasi<br> pasien</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>pelayanan_informasi/jadwal_dokter"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/nurse.png"><span>jadwal<br>dokter</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>pelayanan_informasi/data_bed"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/clipboard.png"><span>Ketersediaan <br>Bed</span></a>
				</li>
				<!-- <li>
					<a href="<?=base_url()?>pelayanan_informasi/informasi_paket"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/clipboard.png"><span>informasi<br>paket</span></a>
				</li -->
			</ul>
        </div>  
		 
    </div>
</div>