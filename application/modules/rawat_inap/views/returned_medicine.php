<style type="text/css" media="screen">
	#dyntable .center{text-align:center;}
	#dyntable thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.title{margin-bottom:0px;}
</style>
<div class="container-fluid">
	<div class="widget-box" style='padding: 10px;min-height:250px;'>
	<div class="widget-content">
			<div class="row-fluid">
				<div class="span5" style="float:right;">
					<div class="widgetbox" style="margin-top:20px;">
						<?=form_open('',array('class'=>'frm_search'));?>
						<div>
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
					<?=form_open('rawat_inap/retur_obat',array('id' => 'retur'))?>
					<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="dyntable">
						<thead>
							<tr>
								<th style="width:5%">No</th>
								<th style="width:30%">No Resep</th>
								<th style="width:30%">Nama Obat</th>
								<th style="width:15%">Jumlah</th>
								<th style="width:20%">Jumlah Retur</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							if(!empty($list_of_medicine)){
								foreach ($list_of_medicine as $key => $value) {
									$no++;
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?=$value['recipe_id']?></td>
										<td><?=$value['im_name']?></td>
										<td class="qty"><?=$value['recipe_qty']?></td>
										<td>
											<input type="text" name="returned_medicine[]" class="retur-qty" style="width:10%"/>
											<input type="hidden" name="medicine_id[]" value="<?=$value['recipe_medicine']?>" />
											<input type="hidden" name="prescription_id[]" value="<?=$value['recipe_id']?>" />
										</td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
						<tfoot>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<?=form_close()?>
	</div>
</div>
</div>

<?php $this->load->view('notice') ?>

<script type="text/javascript" charset="utf-8">
	$(function(){
		$('#dyntable').dataTable( {
			"sPaginationType": "bootstrap",
			"bPaginate": true,
			"fnDrawCallback": function(){
				$("#dyntable tbody td:nth-child(1)").addClass('center');
				$("#dyntable tbody td:nth-child(2)").addClass('center');
				$("#dyntable tbody td:nth-child(3)").addClass('center');
				$("#dyntable tbody td:nth-child(4)").addClass('center');
				$("#dyntable tbody td:nth-child(5)").addClass('center');
			}
		});

		$('#dyntable_length,#dyntable_filter').hide();

		$(".chatsearch input").keyup(function(e){
			$(".dataTables_filter input").val($(".chatsearch input").val()).trigger('keyup');
		});

		$('.retur-qty').keyup(function(){
			var qty = parseInt($(this).parent().prev().text());
			var retur = parseInt($(this).val());

			if(retur > qty || isNaN(retur)){
				$(this).val('');
			}
		});

		$('#submit').click(function(e){
			e.preventDefault();
			var data = $('#retur').serialize();
			var url = $('#retur').attr('action');
			$.post(url, data, function (response) {
				response = JSON.parse(response);
				if ("success" === response.success) {
					$("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function () {
						location.reload(true);
					});
				}
			});
		});

	})
</script>