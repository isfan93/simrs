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
			      { "bSortable": true, "aTargets": [ 0 ],"sWidth":"5%"  },
			      { "bSortable": true, "aTargets": [ 1 ],"sWidth":"15%"  },
			      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"20%" },
			      { "bSortable": true, "aTargets": [ 3 ] }
			],
			"fnDrawCallback": function() {
				$(".dataTable tbody td:nth-child(1)").addClass('center');
				$(".dataTable tbody td:nth-child(2)").addClass('center');
				$(".dataTable tbody td:nth-child(3)").addClass('center');
			}
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
			var url = '<?=cur_url()?>data_diri/'+rm+'/'+mdc_id;
			$("#data_diri").load(url);
			$(this).addClass('active');
		})
		$(".chatsearch input").keyup(function(e){
			$(".dataTables_filter input").val($(".chatsearch input").val()).trigger('keyup');
		})
		$(".tb_scrol tbody tr:eq(0)").trigger('click');

	})
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$desc?>
				<span class="tgl-sekarang"></span> 
		    </h1>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span6 widgetbox">
			<div id="basic" style="float:right;width:300px">
				<div class="chatsearch">
					<input type="text" name="" placeholder="Search" style="width:85%;margin:auto;">
				</div>
			</div>
			<table class="table table-bordered def_table_y dataTable tb_scrol" align="center">
			<thead>
				<tr role="row">
					<th>Nomor</th>
					<th>Tanggal</th>
					<th>Nama Pasien</th>
					<th>Alamat</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					foreach ($list_igd->result() as $key => $value) : ?>
						<?php $i++; ?>
						<tr>
							<input type="hidden" id="rm" name="rm" value="<?=$value->sd_rekmed?>">
							<input type="hidden" id="mdc_id" name="mdc_id" value="<?=$value->service_id?>">
							
						 	<td>
						 		<?=$i?>
						 	</td>
						 	<td>
						 		<?php echo pretty_date($value->service_in,false);
						 			echo '<br>'.substr($value->service_in,11,8);?>
						 	</td>
							<td>
								<b><?=$value->sd_name?></b>
								<br>
								<b><i><?=$value->sd_rekmed?></b>
							</td>
							<td>
								<i><?=$value->sd_address?></i>
							</td>
						</tr>
					<?php endforeach; ?>
			</tbody>
			</table>
		</div>
		<div class="span6 widgetbox">
			<div id="data_diri" style="margin-top:10px;">
				
			</div>
		</div>
	</div>
	</div>
</div>
