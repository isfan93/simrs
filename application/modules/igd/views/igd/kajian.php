<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style>
	.box-kajian{
		height:180px;
		background-color:#DDDDDD;
		padding:5px;
		overflow-y:scroll;
	}
	.table-kajian td{
		padding-left: 10px;
	}
    .check{
        margin-right: 2px;
    }

    .alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    label{
        display: inline-block;
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
        <div class="span12">
            <div class="widget-box">
                <div class="box-kajian" id="box_anamnesa">
                        
                </div>
                <div style="padding:10px;">
                    <span>
                        <?=form_open(cur_url().'add_anamnesa',array('class' => 'form-horizontal','id' => 'form_add_anamnesa')); ?>
                           <label style="float:left">Keluhan Pasien :  </label>
                            <input type="text" id="ma_indication" name="ds[ma_indication]" style="width:200px;margin:0px"/> 
                            <input type="hidden" name="ds[pl_id]" value="<?php echo $pl_id;?>">
                            <input type="radio" name="ds[ma_filter]" style="margin-top:-2px;" value="S"/>&nbsp;  S
                            <input type="radio" name="ds[ma_filter]" style="margin-top:-2px;" value="N"/>&nbsp;  N
                            <input type="radio" name="ds[ma_filter]" style="margin-top:-2px;" value="J"/>&nbsp;  J
                            <input type="submit" class="btn btn-warning btn-small" style="float:right" value="Tambah Keluhan"></input>
                        <?=form_close()?> 
                    </span>
                </div>
                <?=form_open(cur_url(),array('class' => 'form-horizontal','id' => 'form_anamnesa')); ?>
                <input type="hidden" name="ds[mdc_id]" value="<?=$mdc_id?>">
                <div style="padding:10px;">
                    <textarea name="ds[ma_desc]"style="width:98%;" class="input" rows="4" placeholder="Keluhan pasien" id="des_kajian_am" ></textarea>
                </div>
                 <?=form_close()?> 
                <br clear="all"/>
                <div class="form-actions" style="margin-bottom:0px;margin-top:0px;">
                    <button type="submit" class="btn btn-primary simpan pull-right">Simpan</button>
                    <button type="button" id="lihat_antrian" class="btn pull-right" style="margin-right:10px;">Lihat Antrian</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){

        isvalid = $("#form_add_anamnesa").validate({
            rules: {
                'ds[ma_indication]': "required"
            },
            submitHandler: function(form) {
                var url  = "<?=cur_url(-2)?>add_anamnesa/<?=$mdc_id?>";
                var data = jQuery(form).serialize();
                $.post(url,data, function(data){
                    $(".alert").fadeIn().delay(300).fadeOut(function(){
                        $("#save").trigger('click'); 
                        var url = '<?=cur_url(-2)?>anamnesa/<?=$mdc_id?>';
                        $("#box_anamnesa").load(url);
                        $("#ma_indication").val('');
                    });     
                }); 
                return false;
            }
        });

        $(".simpan").click(function(){
            var url  = "<?=cur_url(-2)?>simpan_kajian";
            var data = $('#form_anamnesa').serialize();
            $.post(url,data, function(data){
                $(".alert").fadeIn().delay(500).fadeOut(function(){
                    $("#save").trigger('click'); 
                });     
            }); 
            return false;
        });

        $("#lihat_antrian").click(function(){
            window.location = "<?=base_url()?>igd";
        });

        var url = '<?=cur_url(-2)?>anamnesa/<?=$mdc_id?>';
        $("#box_anamnesa").load(url);
        $("#save").click(function(){})

    })
</script>