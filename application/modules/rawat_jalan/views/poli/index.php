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
		var otb;
		otb = $('#dyntable').dataTable( {
			"bLengthChange": false,
			"bFilter": true,
			"sPaginationType": "full_numbers",
			"sPaginationType": "bootstrap",
			// "sScrollY": "400px",
			"bPaginate": true,
            "aoColumnDefs": [
			      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"20%"  },
			      { "bSortable": false, "aTargets": [ 1 ],"sWidth":"20%" },
			      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"20%" },
			      { "bSortable": false, "aTargets": [ 3 ] }
			],
            "sAjaxSource": "<?=base_url()?>rawat_jalan/<?=$url_poli?>/get_antrian/",
            "fnServerData": function ( sSource, aoData, fnCallback ) {
				var newArray = $.merge(aoData, [{ "name": "<?=$this->security->get_csrf_token_name()?>", "value": "<?=$this->security->get_csrf_hash()?>" }]);
				$.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData, 
					"success": fnCallback
				} );
			},
			"fnDrawCallback": function() {
				$("#dyntable tbody td:nth-child(1)").addClass('center');
				$("#dyntable tbody td:nth-child(2)").addClass('center');
				$("#dyntable tbody td:nth-child(3)").addClass('center');
				$("#dyntable tbody td:nth-child(4)").addClass('left');
			}
	    });
		$("#dyntable tbody tr").live('click', function () {
			rm = $(this).children().eq(2).text();
			mdc_id = $(this).children().eq(1).text();
			$("#dyntable tbody tr.active").removeClass('active');
			var url = '<?=cur_url()?>data_diri/'+rm+'/'+mdc_id;
			$("#data_diri").load(url);
			$(this).addClass('active');
		})
		$(".chatsearch input").keyup(function (e) {
            $(".dataTables_filter input").val($(".chatsearch input").val()).trigger('keyup');
        });
		setInterval(function () {
            otb.fnReloadAjax("<?=base_url()?>rawat_jalan/<?=$url_poli?>/get_antrian/");
        }, 60000);
		// $("#dyntable tbody tr:eq(0)").trigger('click');
	});
</script>
 <div class="pageheader notab">
    <h1 class="pagetitle"><?=(isset($title)) ? $title : '';?></h1>       
</div> <!--pageheader -->
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span7">
			<div id="basic" style="float:right;width:300px;margin-bottom:10px;">
				<div class="chatsearch">
					<input type="text" name="" placeholder="Search" style="width:85%;margin:auto;">
				</div>
			</div>
			<table style="width:100% !important" id="dyntable" class="table table-bordered def_table_y dataTable tb_scrol table_tr" align="center">
				<thead>
					<tr role="row">
						<th>Tanggal</th>
						<th>Kunjungan</th>
						<th>No. Rekmed</th>
						<th>Pasien</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
		<div class="span5">
			<div id="data_diri">
				
			</div>
		</div>
	</div>
</div>
