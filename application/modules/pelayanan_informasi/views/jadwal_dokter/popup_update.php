
 <script src="<?=base_url()?>assets/js/valid.js"></script>
 <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
 <script type="text/javascript" src='<?=base_url()?>assets/js/jquery.gritter.min.js'></script> 
 <script>
	  $(function(){
		
		$(".update_master").validate({
		   rules: {
			  'kode':"required",
			  'jenis_tindakan': "required",     
			  'poli' : "required",
			  'tarif' : "required"
			  //'tanggal' : "required"
		  },
		  Message:{
			'poli' : "Pilih poli terlebih dulu",
		  },
		  submitHandler: function(form) {
			 $.ajax({
				url: 'data_tindakan/update_master',
				type: "POST",
				//crossDomain: true,
				data: $('.update_master').serialize(),
				dataType: "json",
				success: function() {
					//alert(data);
					/*$('.close').click();
					 $.gritter.add({
						title:  'Success',
						text: 'Data berhasil disimpan',
						sticky: true
					  }); */
					 //tbldokter.fnDraw();
					$('#myModalUpt').modal('togle');
					$('.list_tindakan').load('master/data_tindakan/loaddata');
					
				},
				/*error:function(){
				  $('.error_submit').html('terjadi kesalahan saat menyimpan data, mohon ulangi sekali lagi ');
				}*/
			  });
			return false;
		},
		
		errorPlacement: function(error, element) {
		   error.appendTo( element.parents(".controls"));
		 }
		});

		  now = new Date();
		  $('.datepicker').datepicker({
			minDate: 0,
			dateFormat : 'dd/mm/yy'
		  });
	  })


</script>
<style type="text/css" media="screen">
    .alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    .form-horizontal .controls {
      margin-left: 125px;
      padding: 5px 0;
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

<?=form_open(cur_url().'update_master',array('class' => 'form-horizontal update_master stdform','id' => 'add_schdl2 form basic_validate','name' =>'add_schdl2','novalidate'=>"novalidate")); ?>
                            <div id="advances" style="margin-top:10px;">
                        <div class='span12' >

                            <div class="control-group" style="border:none;">
                                <label class="control-label" style="width:20%;">Kode</label>
                                <div class="controls input-medium" >
                                    <input type="text" class='' required name="mst[treat_id]" id="kode" value="<?php echo $result['treat_id']; ?>">
                                </div>
                            </div>
							<div class="control-group" style="border:none;">
                                <label class="control-label" style="width:20%;">Jenis Tindakan</label>
                                <div class="controls" >
                                    <input type="text" class='' required name="mst[treat_name]" id="jenis_tindakan" value="<?php echo $result['treat_name']; ?>">
                                </div>
                            </div>
							<div class="control-group" style="border:none;">
                                <label class="control-label" style="width:20%;">Deskripsi</label>
                                <div class="controls" >
                                    <textarea name="mst[description]" id="deskripsi" value="<?php echo $result['description']; ?>"></textarea>
                                </div>
                            </div>
                            <div class="control-group" style="border:none;">    
                                <label class="control-label" style="width:20%;">Poli</label>
                                 <div class="controls">
                                     <select name='mst[poli]' required id='poli' style="width:140px;float:left;" >
                                        <option value="<?php echo $result['pl_id']; ?>"><?php echo $result['pl_name']; ?></option>
                                        <?php foreach($poli2 as $poli2):?>
                                        <option value="<?=$poli2->pl_id?>"><?=$poli2->pl_name?></option>
                                        
                                        <?php endforeach;?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" style="border:none;">
                                <label class="control-label" style="width:20%;">Tarif Dasar</label>
                                <div class="controls input-medium" >
                                    <input type="text" name="mst[treat_item_price]" id="tarif" class="" value="<?php echo $result['treat_item_price']; ?>" required>
                                </div>
                            </div>
                            
                            <br clear="all">   
                            <label class='error_submit' style='background: url("../assets/img/caution.png") no-repeat 2px 4px;
padding-left: 19px;
font-weight: bold;
color: #C00 !important;
clear: both;'></label>
                            <input type="submit" value="Update" style='float:right' class="btn tambah_schdl btn-success">
                        </div>
                    </div>
</form>