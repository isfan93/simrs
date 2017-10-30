<style type="text/css" media="screen">
	.frm_search input{margin-top:-1px;float:right;margin-left:2px}
	.frm_search .btn{float:right;margin-left:5px}
	.frm_search .btn span{padding:2px 10px;}
	.search_choice a{font-weight:bold}
	.search_choice a.active{color:#fb9338}
	.search_choice {float:right;margin-right:95px}
	#advance{display:none}
	#filter{border-bottom: 1px dashed #DDD;}
	#body_search{margin-top:10px}
	.tname{font-size:110%}
	#dyntable tbody tr td{border-right:none}
	#dyntable tbody tr td + td + td{border-right:1px solid #DDD}
	#dyntable tr:nth-child(even){
		background:#F7F7F7;
	}
	.dataTables_scrollHead{
		margin-bottom: -22px;
	}
	.dataTables_info{
		margin-top: 20px;
	}
</style>
<script type="text/javascript" charset="utf-8">
	$(function(){
		$('.def_table_y').dataTable( {
			"sPaginationType": "full_numbers",
			"bLengthChange": false,
			// "sScrollY": "350px",
			"bPaginate": true,
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              var settings = this.fnSettings();
              var str = settings.oPreviousSearch.sSearch;
              $('td', nRow).each( function (i) {
                  this.innerHTML = aData[i].replace( new RegExp( str, 'i'), function(matched) { return "<span class='highlight'>"+matched+"</span>";} );
              } );
              return nRow;
          },
            "aoColumnDefs": [
			      { "bSortable": true, "aTargets": [ 0 ],"sWidth":"5%"  },
			      { "bSortable": true, "aTargets": [ 1 ],"sWidth":"20%" },
			      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"15%" },
			      { "bSortable": true, "aTargets": [ 3 ],"sWidth":"20%" },
			      { "bSortable": true, "aTargets": [ 4 ],"sWidth":"10%" },
			      // { "bSortable": true, "aTargets": [ 4 ],"sWidth":"15%" },
			      // { "bSortable": true, "aTargets": [ 3 ],"sWidth":"30%" },
			      // { "bSortable": true, "aTargets": [ 4 ],"sWidth":"15%" },
			      // { "bSortable": true, "aTargets": [ 5 ],"sWidth":"15%" }
			],
	    });

	    $(".chatsearch input").keyup(function(e){
			$(".dataTables_filter input").val($(".chatsearch input").val()).trigger('keyup');
		})
	})
</script>
<div class="container-fluid">
    <div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span7">
            <div class="widgetbox" style="float:left;padding-top:20px;padding-left:20px;">
				<a href="<?php echo(cur_url())?>add_pembelian_umum" class="btn btn-primary">
					<i class="icon-plus-sign icon-white"></i>Tambah
				</a>
            </div>
        </div>
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
				<table style="width:100%" cellpadding="0" cellspacing="0" border="0" class="table table-bordered def_table_y tb_scrol" id="dyntable">
					    <thead>
					        <tr>
					        	<th>No</th>
					        	<th>Tanggal Pembelian</th>
					            <th>No Kunjungan</th>
					            <th>Status</th>
					            <th style="width:70px"class="head0">Aksi</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php $no = 0; if(isset($pembelian_umum)) : ?>
					    		<?php foreach ($pembelian_umum->result() as $key => $value) : ?>
					    			<?php $no++; ?>
					    				<tr>
					    					<td style="text-align:center;"><?=$no?></td>
					    					<td style="text-align:center;"><?=pretty_date($value->service_in,false)?></td>
					    					<td style="text-align:left;"><?=$value->service_id?> <br><?=$value->visit_desc?></td>
					    					<td style="text-align:center;font-weight:bold;">
					    						<?php switch ($value->service_status) {
					    							case '3':
					    								echo "Menunggu Bayar";
					    								break;
					    							case '4':
					    								echo "Lunas";
					    								break;
					    							case '5':
					    								echo "Lunas";
					    								break;
					    							default:
					    								echo "Menunggu Bayar";
					    								break;
					    						}?>
					    					</td>
					    					<td style="text-align:center;">
								            	<a href="<?=base_url('apotek/pembelian_umum/select')?>/<?=$value->visit_id?>/<?=$value->tdb_number?>" class="btn btn-small btn-primary">Detail</a>
								            </td>
					    				</tr>
					    		<?php endforeach; ?>
					    	<?php endif;?>
					    </tbody>
					</table>
			</div>
		</div>
	</div>
</div>
