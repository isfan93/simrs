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
	/*#dyntable tbody tr td + td + td{border-right:1px solid #DDD}*/
	#dyntable tr:nth-child(even){
		background:#F7F7F7;
	}
	.dataTables_scrollHead{
		margin-bottom: -22px;
	}
	.dataTables_info{
		margin-top: 20px;
	}
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.table_tr tbody th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
</style>
<script type="text/javascript" charset="utf-8">
	var oTb;
	$(function(){
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
		var d_uri = "<?=base_url()?>gudang/faktur/get_faktur";
		oTb = $('#dyntable').dataTable( {
			/*"bProcessing": true,
			"bServerSide": true,*/
			// "sPaginationType": "full_numbers",
			/*"sScrollY": "350px",
			"bPaginate": false,
			*/
			
			"bLengthChange": false,
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"bFilter": true,
			"aoColumns": [null,null,null,null,null,null,null,null],//,
			"sAjaxSource": d_uri,
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
				// $("#dyntable tbody td:nth-child(1)").wrapInner('<i />');
				$("#dyntable tbody td:nth-child(3)").addClass('left');
				$("#dyntable tbody td:nth-child(4)").addClass('left');
				$("#dyntable tbody td:nth-child(5)").addClass('left');
				$("#dyntable tbody td:nth-child(6)").addClass('left');
				$("#dyntable tbody td:nth-child(7)").addClass('right');
				$("#dyntable tbody td:nth-child(8)").addClass('center');
			}
		});
		$(".chatsearch input").keyup(function(e){
			$("#dyntable_filter input").val($(this).val()).trigger('keyup');
		})
	})
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span7">
            <div class="widgetbox" style="float:left;padding-top:20px;padding-left:20px;">
				<a href="<?php echo(cur_url())?>add_faktur" class="btn btn-primary">
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
				<style>
					table#dyntable .center{
						text-align:center;
						font-size: 12px;
					}
					table#dyntable .right{
						text-align:right;
					}
				</style>
				<table class="table table-bordered table-striped table_tr tb_scrol" id="dyntable">
				    <thead>
				        <tr>
				        	<th style="width:10% !important;">No.</th>
				        	<th style="width:10% !important;">No. Faktur</th>
				            <th style="width:13% !important;">Tanggal</th>
				            <th style="width:13% !important;">Jatuh Tempo</th>
				            <th style="width:15% !important;">Supplier</th>
				            <th style="width:13% !important;">Petugas</th>
				            <th style="width:10% !important;">Total</th>
				            <th style="width:10% !important;">Aksi</th>
				        </tr>
				    </thead>
				</table>
			</div>
		</div>
	</div>
</div>
