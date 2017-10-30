  <script>
    $(function(){
    	 $('.tabel-pelaporan').dataTable( {
                "sPaginationType": "bootstrap",
                // "sScrollY": "400px",
                "sPaginationType": "full_numbers",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
				      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"3%"},
              			{ "bSortable": true, "aTargets": [ 1 ],"sWidth":"10%" },
				      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"30%" },
					  { "bSortable": false, "aTargets": [ 3 ],"sWidth":"30%" },
					  { "bSortable": false, "aTargets": [ 4 ],"sWidth":"10%" }
				   ],
                "oLanguage": {
                  "sEmptyTable": "<center>Data tidak tersedia</center>"
                }
      });
    	$(".dataTables_filter").hide();
		  $('.dataTables_length').hide();
    })
 </script>
 <style type="text/css">
	.table tr th{
		line-height: 35px;
		font-size: 13px;
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12" style="text-align:center;">
			<div class="title">
				<h3>
					<?=$title?>
				</h3>
				<h5>
					<?=pretty_date($dateStart,false)?> - <?=pretty_date($dateEnd,false)?>
				</h5>
			</div>
			<table class="table table-bordered tabel-pelaporan">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Pasien / Alamat</th>
						<th>Layanan / Dokter</th>
						<th>Pemasukan</th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($kunjungan) && ($kunjungan->num_rows() >= 1) ) : ?>
						<?php $total = 0; foreach ($kunjungan->result() as $key => $value) : ?>
							<tr>
								<td style="text-align:center;"><?=($key + 1)?></td>
								<td style="text-align:left;"><?=pretty_date($value->visit_in,false)?></td>
								<td>
									<b><?=$value->sd_rekmed?></b><br>
									<?=$value->sd_name?><br>
									<i><?=$value->sd_address?></i>
								</td>
								<td style="text-align:center;font-weight:bold;">
									<?=$value->pl_name?> / <?=$value->dr_name?>
								</td>
								<td style="text-align:right;font-weight:bold;">
									<?=isset($bill[$value->visit_id]) ? number_format($bill[$value->visit_id]->total_price,0,',','.') : '0'?>
									<?php $total += isset($bill[$value->visit_id]) ? $bill[$value->visit_id]->total_price : 0;?>
								</td>
							</tr>
						<?php endforeach;?>
						<!--tr>
							<td colspan="4" style="text-align:right;font-weight:bold;">
								Total Pemasukan
							</td>
							<td style="text-align:right;font-weight:bold;">
								<?//=number_format($total,0,',','.')?>
							</td>
						</tr-->
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>