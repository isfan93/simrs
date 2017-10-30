<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style>
	.box-kajian{
		/*height:205px;*/
		background-color:#DDDDDD;
		padding:5px;
		/*overflow-y:scroll;*/
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
        <div class="span12">
            <div class="widget-box">

                <div class="box-kajian" id="box_anamnesa" style="padding:10px;">
                    <?php if( !empty($ptn_now) ){
                            echo "Kesadaran : ";
                            echo $ptn_now->ptn_medical_kesadaran;
                            echo "<br>";
                            echo "Tekanan Darah : ";
                            echo $ptn_now->ptn_medical_blod_sy;
                            echo "/";
                            echo $ptn_now->ptn_medical_blod_ds;
                            echo " mm/Hg";
                            echo "<br>";
                            echo "Tinggi Badan : ";
                            echo $ptn_now->ptn_medical_height;
                            echo " cm";
                            echo "<br>";
                            echo "Berat badan : ";
                            echo $ptn_now->ptn_medical_weight;
                            echo " Kg";
                            echo "<br>";
                            echo "Nadi : ";
                            echo $ptn_now->ptn_medical_nadi;
                            echo " BPM";
                            echo "<br>";
                            echo "Respiration rate : ";
                            echo $ptn_now->ptn_medical_respirationrate;
                            echo " BPM";
                            echo "<br>";
                            echo "Temperatur : ";
                            echo $ptn_now->ptn_medical_temperatur;
                            echo " Celcius";
                            echo "<br>";
                    }else{
                        echo "-";
                    }
                    ?>
                </div>
                <?=form_open(cur_url(),array('class' => 'form-horizontal','id' => 'form_objective')); ?>
                <input type="hidden" name="ds[mdc_id]" value="<?=$mdc_id?>">
                <div style="padding:10px;">
                    <textarea name="ds[mo_desc]"style="width:98%" rows="4" placeholder="Temuan pemeriksaan" id="desc_objective" ></textarea>
                </div>
                 <?=form_close()?> 

                <div class="form-actions" style="margin-bottom: 0px;">
                    <button type="submit" class="btn btn-primary simpan pull-right">Simpan</button>
                    <button type="button" id="lihat_antrian" class="btn pull-right" style="margin-right:10px;">Lihat Antrian</button>
                </div>
            </div>
        </div>
    </div><!-- #div kajian objektif -->
</div>


<script>
    $(function(){

        var objective = "<?php
            if( $objective->num_rows() >= 1)
            {
                foreach ($objective->result() as $key => $value) {
                    echo $value->mo_desc;
                
                }
            }
        ?>";
        $("#desc_objective").val(objective);

        $(".simpan").click(function(){
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
            var url  = "<?=cur_url(-2)?>simpan_objective";
            var data = $('#form_objective').serialize();
            $.post(url,data, function(data){
                $.unblockUI({ 
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            $("#save").trigger('click'); 
                        });
                    } 
                }); 
            }); 
            return false;
        });

        $("#lihat_antrian").click(function(){
            window.location = "<?=base_url()?>rawat_jalan/<?=$url_poli?>";
        });
        
        $("#save").click(function(){})
    })
</script>