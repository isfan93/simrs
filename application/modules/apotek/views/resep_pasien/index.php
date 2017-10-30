<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
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
    .black_loader{
        display: block;
        opacity: 0.6;
    }
	.alert{
        background-color: transparent;
        border: 0px;
    }
    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
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
			      { "bSortable": true, "aTargets": [ 1 ],"sWidth":"12%" },
			      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"20%" },
			      { "bSortable": true, "aTargets": [ 3 ],"sWidth":"7%" },
			      { "bSortable": true, "aTargets": [ 4 ],"sWidth":"7%" },
			      { "bSortable": true, "aTargets": [ 5 ],"sWidth":"10%" }
			],
	    });

	    $(".chatsearch input").keyup(function(e){
			$(".dataTables_filter input").val($(".chatsearch input").val()).trigger('keyup');
		})

		$("#batal").click(function(){
			$.blockUI({
                message: '<div class="black_loader"><img src="<?=get_loader(11)?>"></div>',
                overlayCSS:  {
                    backgroundColor: '#000',
                    opacity: 0.5,
                    cursor: 'wait',
                },
                css:{
                    border: 'none',
                }
            });
            var url  = "<?=base_url()?>apotek/resep_pasien/batalBuatResep";
            var service_id = $(this).attr('service_id');
            var recipe_id = $(this).attr('recipe_id');
            var csrf_name = "<?php echo $this->security->get_csrf_token_name()?>";
            var csrf_hash = "<?php echo $this->security->get_csrf_hash()?>";

            var data = csrf_name+"="+csrf_hash+"&service_id="+service_id+"&recipe_id="+recipe_id;
            $.post(url,data, function(data){
                setTimeout(function() {
                    $.unblockUI({
                        onUnblock: function(){
                            $(".alert").fadeIn().delay(500).fadeOut(function(){
                                window.location = "<?=base_url()?>apotek/resep_pasien";
                            });
                        }
                    });
                }, 1000);
            });
            return false;
		});
	})
</script>

<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed">
    <div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" style="display: none; width:50px "></div>
            <img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
            <div class="gritter-with-image" style="width:448px">
                <span class="gritter-title" style="margin-left:36px">Message</span>
                <p>Data Berhasil Disimpan   </p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="gritter-bottom"></div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<!-- <div class="span7">
            <div class="widgetbox" style="float:left;padding-top:20px;padding-left:20px;">
				<a href="<?php echo(cur_url())?>add_purchase_order" class="btn btn-primary">
					<i class="icon-plus-sign icon-white"></i>Tambah
				</a>
            </div>
        </div> -->
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
					        	<th>Tanggal Pemeriksaan</th>
					            <th>Nama, alamat</th>
					            <th>Unit</th>
					            <th>Status</th>
					            <th style="width:70px"class="">Aksi</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    		$no = 0;
					    		foreach ($resep_pasien as $key => $value) {
					    			$no++;
					    			$recipe_id = (isset($value['recipe_id'])) ? $value['recipe_id'] : 'RS-'.substr($value['service_id'], 3,11);
					    			?>
					    				<tr>
					    					<td style="text-align:center;"><?php echo $no;?></td>
					    					<td><?=pretty_date($value['datetime'],false)?></td>
					    					<td><?=$value['sd_rekmed']?><br>
					    						<b><?=$value['sd_name']?></b><br>
					    						<?=$value['sd_address']?>
					    					</td>
					    					<td><?=strtoupper($value['service_type'])?></td>
					    					<td style="text-align:center;font-weight:bold;">
					    						<?php switch ($value['service_status']) {
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
					    						<!-- <button type="button" id="batal" class="btn btn-default btn-small" service_id="<?=$value['service_id']?>" recipe_id="<?=$recipe_id?>" >Batal</button> -->
								            	<a href="<?=base_url('apotek/resep_pasien/select')?>/<?=$recipe_id?>/<?=$value['service_id']?>" class="btn btn-small btn-primary">Detail</a>
								            </td>
					    				</tr>
					    			<?php
					    		}
					    	?>
					    </tbody>
					</table>
			</div>
		</div>
	</div>
</div>
