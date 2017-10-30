
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

		$('#dyntable').dataTable( {
			"sPaginationType": "bootstrap",
			"sScrollY": "350px",
			  "bFilter": false,
			"bPaginate": false,
	    });
	})
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span5" >
			<div class="title"><h3>Data Bangsal dan Kamar</h3></div>
		</div>
		<div class="span5" style="float:right;">
			<div class="widgetbox" style="margin-top:20px;">
				<?=form_open('',array('class'=>'frm_search'));?>
					<!-- <a href="" class="btn btn_orange btn_search radius50"><span>Search</span></a> -->
					<div id="basic">
						<div class="chatsearch" >
                        	<input type="text" name="" placeholder="Search" style="width:91%;margin:auto;">
                    	</div>
					</div>
					<!-- <div id="advance">
						<input type="text" class="smallinput" placeholder="masukkan alamat">
						<input type="text" class="smallinput" placeholder="masukkan nama pasien">
					</div>
					<br clear="all">
					<div class="search_choice">
						<a class="active" atr="bsc" href="#">sederhana</a> | <a atr="adv" href="#">pencarian lanjut</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	<br clear="all">
	<div class="row-fluid">
		<div class="widgetbox">
			<div class="span12">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered def_table_y dataTable tb_scrol" id="dyntable">
					    <thead>
					        <tr>
					            <th>Nama Bangsal/ Kamar</th>
					            <th>Kelas</th>
					            <th>Harga</th>
					            <th>Kamar Terisi</th>
					            <th>Kamar Kosong</th>
					            <th>Detail</th>
					        </tr>
					    </thead>
					    <tbody>
							<?for ($i=0;$i<100;$i++): ?>
								<tr>
						            <td>
										Melati I
									</td>
									<td>
										VIP
									</td>
									<td style="text-align:right;">
										Rp. 300000,- /hari
									</td>
						            <td style="text-align:center;">
						            	20
									</td>
									<td style="text-align:center;">
						            	10
									</td>
						            <td style="text-align:center;">
						            	<a href="" class="btn btn_info"><span>Info</span></a>
						            </td>
						        </tr>
							<?endfor ?>
					    </tbody>
					    <tfoot>
					    </tfoot>
					</table>
			</div>
		</div>
	</div>
</div>