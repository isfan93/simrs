<style type="text/css" media="screen">
	#dyntable .center{text-align:center;}
	#dyntable tbody tr td{border-right:none}
	#dyntable tbody tr td + td + td{border-right:1px solid #DDD}
	#dyntable tr:nth-child(even){
		background:#F7F7F7;
	}
	#dyntable thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	#dyntable .btn {
		margin-left: 2px;
		margin-right: 2px;
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span5" style="float:right;">
			<div class="widgetbox" style="margin-top:20px;">
				<?=form_open('',array('class'=>'frm_search'));?>
					<div id="basic">
						<div class="chatsearch" >
                        	<input type="text" name="" placeholder="Search" style="margin:auto;">
                        	<br class="clear"/>
                    	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<br clear="all">
	<div class="row-fluid">
		<div class="widgetbox">
			<div class="span12">
				<table class="table table-bordered" id="dyntable">
				    <thead>
				        <tr>
				        	<th style="width:25%">Pasien</th>
				        	<th style="width:25%">Nama Obat</th>
				            <th style="width:5%">Jumlah</th>
				            <th style="width:20%">Tanggal</th>
				            <th style="width:15%">Aksi</th>
				        </tr>
				    </thead>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="confirmModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Peringatan</h3>
  </div>
  <div class="modal-body">
    <p>Retur <b><span class="medicine-name"></span></b> ke dalam inventori?</p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary">Yes</button>
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
</div>

<div id="cancelModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="cancelModal" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Peringatan</h3>
  </div>
  <div class="modal-body">
    <p>Batalkan retur <b><span class="medicine-name"></span></b> ke dalam inventori?</p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary">Yes</button>
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
</div>


<?php $this->load->view('notice') ?>

<script type="text/javascript" charset="utf-8">
	var oTb;
	var ajaxSource = '<?=base_url()?>gudang/retur_ranap/get_returned_medicine/';
	$(document).ready(function(){
		oTb = $('#dyntable').dataTable({
			"bServerSide": true,
			"sPaginationType": "bootstrap",
			"bLengthChange": false,
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"bFilter": true,
			"aoColumns": [null,null,null,null, null],
			"sAjaxSource": ajaxSource,
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				var newArray = $.merge(aoData,[
					{
						"name": "<?=$this->security->get_csrf_token_name()?>",
						"value": "<?=$this->security->get_csrf_hash()?>"
					}
				]);
				$.ajax({
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
					"success": fnCallback
				});
			},
			"fnDrawCallback": function() {
				$("#dyntable tbody td:nth-child(1)").addClass('center');
				$("#dyntable tbody td:nth-child(2)").addClass('center');
				$("#dyntable tbody td:nth-child(3)").addClass('center');
				$("#dyntable tbody td:nth-child(4)").addClass('center');
				$("#dyntable tbody td:nth-child(5)").addClass('center');
			}
		});

		$(".chatsearch input").keyup(function(e){
			$("#dyntable_filter input").val($(this).val()).trigger('keyup');
		});

		setInterval(function () {
            oTb.fnReloadAjax(ajaxSource);
        }, 60000);

		$('.confirm').live('click',function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			var medicineName = $(this).closest('tr').children().eq(0).text();
			var quantity = $(this).closest('tr').children().eq(1).text();
			$('#confirmModal').modal();
			$('#confirmModal').one('shown', function () {
				$('#confirmModal .medicine-name').html(medicineName + ' (' + quantity + ')');
				$(this).find('.modal-footer > button:eq(0)').one('click',function(){
					var data = {};
					$.post(url, data, function (response) {
		                response = JSON.parse(response);
		                if ("success" === response.success) {
		                	$('#confirmModal').modal('hide');
		                    $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function () {
		                        location.reload(true);
		                    });
		                }
		            });
				});
			});
		});

		$('.cancel').live('click',function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			var medicineName = $(this).closest('tr').children().eq(0).text();
			var quantity = $(this).closest('tr').children().eq(1).text();
			$('#cancelModal').modal();
			$('#cancelModal').one('shown', function () {
				$('#cancelModal .medicine-name').html(medicineName + ' (' + quantity + ')');
				$(this).find('.modal-footer > button:eq(0)').one('click',function(){
					var data = {};
					$.post(url, data, function (response) {
		                response = JSON.parse(response);
		                if ("success" === response.success) {
		                	$('#cancelModal').modal('hide');
		                    $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function () {
		                        location.reload(true);
		                    });
		                }
		            });
				});
			});
		});
	})
</script>