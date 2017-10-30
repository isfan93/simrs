<style type="text/css" media="screen">
	.dataTables_scrollHead{
		margin-bottom: -22px;
	}
	.dataTables_info{
		margin-top: 20px;
	}
	.dataTables_filter{
		display:none;
	}
</style>
<script type="text/javascript" charset="utf-8">
	$(function(){

		//table scrol Yalert();
		var otb;
		otb = $('.def_table_y').dataTable( {
			"sPaginationType": "full_numbers",
			"bLengthChange": false,
			// "sScrollY": "400px",
			"bPaginate": true,
            "aoColumnDefs": [
			      { "bSortable": true, "aTargets": [ 0 ],"sWidth":"7%"  },
			      { "bSortable": true, "aTargets": [ 1 ],"sWidth":"12%" },
			      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"15%" },
			      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"7%" },
			      { "bSortable": false, "aTargets": [ 3 ],"sWidth":"7%" },
			],
	    });
		$(".search_choice a").click(function(){
			$(".active").removeClass('active');
			$(this).addClass('active');
			if($(this).attr('atr') == 'bsc'){
				$("#advance").hide();
				$("#basic").show();
				$(".mediuminput").focus();
			}else{
				$("#advance").show();
				$("#basic").hide();
				$(".smallinput").focus();
			}
			return false;
		})
		//$(".tb_scrol tbody tr").click(function(){
		$(".tb_scrol tbody tr").live("click",function(){
			var rm = $(this).find('#rm').val();
			var mdc_id = $(this).find('#mdc_id').val();
			$(".tb_scrol tbody tr.active").removeClass('active');
			var url = '<?=cur_url(-1)?>data_diri/'+rm+'/'+mdc_id;
			$("#data_diri").load(url);
			$(this).addClass('active');
		})
		$(".chatsearch input").keyup(function(e){
			$(".dataTables_filter input").val($(".chatsearch input").val()).trigger('keyup');
		})
		<?php if ($antrian->num_rows() >= 1) : ?>
		$(".tb_scrol tbody tr:eq(0)").trigger('click');
		<?php endif; ?>

	})
</script>
<!-- <div class="pageheader notab">
    <h1 class="pagetitle"><?=(isset($title)) ? $title : '';?></h1>       
</div> --><!--pageheader-->
<div class="container-fluid">
	<div class="row-fluid">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=$title?></h1>
        </div>
    </div>
	<div class="row-fluid">
		<div class="span7">
			 
			<div id="basic" style="float:right;width:300px">
				<div class="chatsearch">
					<input type="text" name="" placeholder="Search" style="width:85%;margin:auto;">
				</div>
			</div>
			<table class="table table-bordered def_table_y dataTable tb_scrol" align="center" style="margin-left:0px;width:100%; ">
			<thead>
				<tr role="row">
					<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:15%" aria-label="Nama: activate to sort column ascending">No.</th>
					<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:15%" aria-label="Nama: activate to sort column ascending">Tanggal</th>
					<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:40%" aria-label="Harga: activate to sort column ascending">Nama Pasien/ No. RM</th>
					<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:30%" aria-label="Aksi: activate to sort column ascending">Alamat</th>
					<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:20%" aria-label="Aksi: activate to sort column ascending">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					foreach ($antrian->result() as $key => $value) {
						$i++;
						?>
						<tr>
							<input type="hidden" id="rm" name="rm" value="<?=isset($value->sd_rekmed) ? $value->sd_rekmed : '0'?>">
							<input type="hidden" id="mdc_id" name="mdc_id" value="<?=$value->lab_queue_id?>">
							
							<td class="center" style="width:5%;">
								<b><?=$i?></b>
							</td>
							<td class="center" style="width:30%;">
								<b><?= pretty_date($value->lab_queue_datetime,false)?></b>
							</td>
							<td style="width:30%;">
								<b><?=isset($value->sd_name) ? $value->sd_name : $value->visit_desc;?></b>
								<br>
								<b><i><?=isset($value->sd_rekmed) ? $value->sd_rekmed : '';?></i></b>
							</td>
							<td style="width:40%;">
								<i><?=$value->sd_address?></i>
							</td>
							<td style="width:20%;">
								<?php
								switch ($value->lab_queue_status) {
									case '1':
										echo "Proses Pendaftaran";
										break;
									case '2':
										echo "Menungu Proses";
										break;
									case '3':
										echo "Menunggu Bayar";
										break;
									case '4':
										echo "Lunas";
										break;
									case '5':
										echo "Selesain";
										break;
								}
								?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
			<tfoot>
			</tfoot>
			</table>
		</div>
		<div class="span5">
			<div id="data_diri">
				
			</div>
		</div>
	</div>
</div>
