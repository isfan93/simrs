<style type="text/css" media="screen">
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	#dyntable .center{text-align:center;}
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
                        	<input type="text" name="" placeholder="Search" style="width:91%;margin:auto;">
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
				<table id="dyntable" class="table table-bordered table_tr">
					<thead>
						<th style="width:10%">No</th>
						<th style="width:20%;">Tanggal Registrasi</th>
						<th style="width:50%;">Informasi Pasien</th>
						<th style="width:20%;">Kelas / Kamar / Paviliun</th>
					</thead>
					<tbody>
						<?php if(!empty($hospitalized_patients)) : ?>
							<?php foreach($hospitalized_patients as $key => $hp) : ?>
								<tr>
									<td><?=$key+1?></td>
									<td><?=pretty_date($hp->visit_in)?></td>
									<td>
										<span style="font-weight:bold;">
											<?=strtoupper($hp->sd_name)?>
											(<?=$hp->sd_age?> Th)
										</span>
										<br />
										<span><?=$hp->sd_address?></span>
									</td>
									<td>
										<span><?=$hp->class_name?> / <?=$hp->room_id?> / <?=$hp->pavillion_name?></span>
									</td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function(){
		oTb = $('#dyntable').dataTable( {
			"bLengthChange": false,
			"bFilter": true,
			"sPaginationType": "full_numbers",
			"aoColumns": [null,null,null,null],
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              var settings = this.fnSettings();
              var str = settings.oPreviousSearch.sSearch;
              $('td', nRow).each( function (i) {
	                  this.innerHTML = aData[i].replace( new RegExp( str, 'i'), function(matched) { return "<span class='highlight'>"+matched+"</span>";} );
	              } );
	              return nRow;
	          },
			"fnDrawCallback": function() {
				$("#dyntable tbody td:nth-child(1)").addClass('center');
				$("#dyntable tbody td:nth-child(2)").addClass('center');
				$("#dyntable tbody td:nth-child(3)").addClass('left');
				$("#dyntable tbody td:nth-child(4)").addClass('center');
			}
		});

		$("#dyntable_filter").hide();
		$(".chatsearch input").keyup(function(e){
			$("#dyntable_filter input").val($(".chatsearch input").val()).trigger('keyup');
		})
	})
</script>