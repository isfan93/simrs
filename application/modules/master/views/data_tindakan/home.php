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
        <div class="span5 center" style="text-align: center;">                 
			<ul class="quickstats">
				<li>
					<a href="<?=base_url()?>master/data_tindakan/add"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/add2.png" width="64" height="64"><span>Tambah<br>Tindakan</span></a>
				</li>
			</ul>
        </div>  
		<div class="span7" style="padding:5px 10px">
			<div class="title" style="padding:0px"><h3>Daftar Tindakan</h3></div>
			<table cellpadding="0" cellspacing="0" border="0" class="tabel-dokter table table-bordered def_table_y dataTable tb_scrol">

	            <thead>
	                <tr  role="row">
	                    <th class="head0">No.</th>
						<th class="head0">Kode</th>
	                    <th class="head1">Jenis Tindakan</th>
	                    <th class="head0">Deskripsi</th> 
						<th class="head0">Poli</th>
						<th class="head0">Tarif Dasar</th>
	                </tr>
	            </thead>

	            <tbody>
					<?php
						/*$i = 0;
						foreach ($list as $key => $value) {
							$i++;
							?>
							<tr>
								<td class="center" style="width:10%;">
									<b><?=$i?></b>
								</td>
								<td style="">
									<b><?=$value->sd_nip?></b>									
								</td>
								<td style="">
									<i><?=$value->sd_name?></i>
								</td>
								<td style="">
									<i><?=$value->sd_type_user?></i>
								</td>								
							</tr>
							<?php
						}*/
					?>
	                
	            </tbody>
	            <tfoot>
	            </tfoot>
	        </table>
		</div>
    </div>
</div>