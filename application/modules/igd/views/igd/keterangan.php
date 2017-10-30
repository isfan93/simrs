<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style>
	.bg_widget{
		background-color: #efefef;
		background-image: -webkit-gradient(linear, 0 0%, 0 100%, from(#fdfdfd), to(#eaeaea));
		background-image: -webkit-linear-gradient(top, #fdfdfd 0%, #eaeaea 100%);
	    background-image: -moz-linear-gradient(top, #fdfdfd 0%, #eaeaea 100%);
	    background-image: -ms-linear-gradient(top, #fdfdfd 0%, #eaeaea 100%);
	    background-image: -o-linear-gradient(top, #fdfdfd 0%, #eaeaea 100%);
	    background-image: -linear-gradient(top, #fdfdfd 0%, #eaeaea 100%);
	}
	.label_surat{
		width:100px;
		float:left;
	}
	.input_surat{
		width:auto;
		float:left;
		padding:0px;
	}
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.select:focus{
		background: #efefef;
	}
	.alert{
        background-color: transparent;
        border: 0px;
    }
    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>

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
    	<div class="span6">
    		<div class="widget-box">
				<div class="title"><h3>Surat Keterangan</h3></div>
				<br clear ="all">
				<?=form_open(base_url().'igd/sk_pengantar',array('class' => 'form-horizontal','id' => 'form')); ?>	
				<input type="hidden" name="ds[mdc_id]" value=<?=$mdc_id?> > 
				<div style="margin-left:20px;">
					<div class="label_surat">
						Nomor Surat
					</div>
					<div class="input_surat">
						<input class="small" type="text" name="ds[ref_number]" style="width:190px;border:none;border-bottom:1px dotted gray;text-align:left;" value="<?php echo $ref_number;?>" readonly>
						
					</div>
				</div>
				<br clear="all">
				<div style="margin-left:20px;margin-top:10px;">
					<div class="label_surat">
						Surat Keterangan
					</div>
					<div class="input_surat">
						<select  name="ds[ref_category]" style="min-width:100px;width:200px" style="" class="select ref_category">
		                    <option value="Surat Keterangan Sakit" >Sakit</option>
		                    <option value="Surat Keterangan Sehat" >Sehat</option>
		                    <option value="Surat Keterangan Buta Warna" >Buta Warna</option>
		                    <option value="Surat Keterangan Kelahiran" >Kelahiran</option>
		                    <option value="Surat Keterangan Kematian" >Kematian</option>
		                </select>
					</div>
				</div>
				<div class="inputDate">
				<br clear="all">
					<div style="margin-left:20px;margin-top:10px;">
						<div class="label_surat">
							Jumlah hari
						</div>
						<div class="input_surat">
							<input class="small ref_date" type="text" name="ds[ref_date]" style="width:100px;border:none;border-bottom:1px dotted gray;text-align:left;" value="">
							Hari,
						</div>
					</div>
					<br clear="all">
					<div style="margin-left:20px;margin-top:10px;">
						<div class="label_surat">
							Mulai
						</div>
						<div class="input_surat">
							<select  name="dt[tgl_start]" style="min-width:30px;width:90px" style="" class="tgl tgl_start select">
			                    <option value="" >-- tgl --</option>
			                    <?=get_hari()?>
			                </select>
			                <select name="dt[bln_start]" style="width:90px" class="bln bln_start select">
			                    <option value="">-- bulan --</option>
			                    <?=get_bulan()?>
			                </select>
			                <select name="dt[thn_start]" style="width:90px" class="thn thn_start select">
			                    <option value="">-- tahun --</option>
			                    <?=get_tahun()?>
			                </select>
							<!-- <input class="small" type="text" name="ds[ref_date_start]" style="width:100px;border:none;border-bottom:1px dotted gray;text-align:left;" value=""> -->
						</div>
					</div>
					<br clear="all">
					<div style="margin-left:20px;margin-top:10px;">
						<div class="label_surat">
							sampai dengan
						</div>
						<div class="input_surat">
							<select  name="dt[tgl_end]" style="min-width:30px;width:90px" style="" class="tgl tgl_end select">
			                    <option value="" >-- tgl --</option>
			                    <?=get_hari()?>
			                </select>
			                <select name="dt[bln_end]" style="width:90px" class="bln bln_end select">
			                    <option value="">-- bulan --</option>
			                    <?=get_bulan()?>
			                </select>
			                <select name="dt[thn_end]" style="width:90px" class="thn thn_end select">
			                    <option value="">-- tahun --</option>
			                    <?=get_tahun()?>
			                </select>
							<!-- <input class="small" type="text" name="ds[ref_date_end]" style="width:100px;border:none;border-bottom:1px dotted gray;text-align:left;" value=""> -->
					
						</div>
					</div>
				</div>
				<br clear="all">
				<div style="margin-left:20px;margin-top:10px;">
					<div class="label_surat">
						Keterangan
					</div>
					<div class="input_surat">
						<textarea rows="3" name="ds[ref_description]" class="input-xlarge"></textarea>
					</div>
				</div>
				<br clear="all">
				<div class="form-actions" style="margin-top:10px;">
					<button style="float:right;" class="btn btn-primary save" type="submit">Simpan</button>
				</div>
				<?=form_close()?>
			</div>
		</div>
    	<div class="span6">
    		<!-- <div class="widget-box"> -->
    			<table class="table table table-strip table-bordered table_tr">
    				<thead>
    					<tr>
    						<th>No. Surat</th>
    						<th>Surat</th>
    						<th>Pilihan</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    						if( $surat->num_rows() >= 1 ){
    							foreach ($surat->result() as $key => $value) {
    								?>
    								<tr>
    									<td><?php echo $value->ref_number;?></td>
    									<td><?php echo $value->ref_category;?></td>
    									<td style="text-align:center;">
    										<a href="<?php echo cur_url(-2)?>cetak_surat/<?php echo $value->ref_id;?>" target="_blank" class="btn btn-info btn-small">Cetak</a>
    									</td>
    								</tr>
    								<?php
    							}
    						}
    					?>
    				</tbody>
    			</table>
    		<!-- </div> -->
    	</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
    $(function(){
        $("#form").submit(function(){
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
            var url  = $(this).attr('action');
            var data = $("#form").serialize();
            $.post(url,data, function(data){
            	$.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                			$("#tab_keterangan").trigger('click'); 
                        });
                    }
                }); 
            }); 
            return false;
        });

        $('.ref_category').change(function(){
        	if($(this).val() == 'Surat Keterangan Sakit')
        	{
        		$('.inputDate').show();
        	}else{
        		$('.inputDate').hide();
        	}
        });

        $('.ref_date').change(function(){
        	tgl = $('.tgl_start').val();
        	bln = $('.bln_start').val();
        	thn = $('.thn_start').val();
        	var today = new Date(thn+'/'+bln+'/'+tgl);
			var nwdate = new Date();
			nwdate.setDate(today.getDate()+parseInt($(this).val()));
			tgl = nwdate.getDate();
			bln = nwdate.getMonth()+1;
			thn = nwdate.getFullYear();
			$('.tgl_end').val(tgl);
			$('.bln_end').val(bln);
			$('.thn_end').val(thn);
        });

        var tgl = <?php echo date('d')?>;
        var bln = <?php echo date('m')?>;
        var thn = <?php echo date('Y')?>;
        $(".tgl").val(tgl);
        $(".bln").val(bln);
        $(".thn").val(thn);
    })
</script>
