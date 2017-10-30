<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css">
    .tables thead tr th{
        height:28px;
        font-size:13px;
        vertical-align: middle;
    }

    .ffb-input{
        background: transparent;
        border: none;
        width: 100% !important;
        /*border-bottom: 1px dotted gray;*/
    }
    textarea{
        background: transparent;
        border: none;
    }
    .table_tr thead th{
        height: 28px;
        vertical-align: middle;
        font-size: 13px;
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

<script>
    $(function(){
        var lab_queue_id = "<?php echo $prev['lab_queue_id'];?>";
        var surl = "<?=base_url()?>lab/load_form/"+lab_queue_id;
       
        $("#data").load(surl);
    });
</script>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12" style="background:#E5E5E5;padding-bottom:10px">
            <div class="title" style="margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;"><h3>Data Pasien</h3></div>
            <!--div class="title" style="float:right;margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;margin-right:20px;"><h3><?php //echo pretty_date(date('Y-m-d'),false);?></h3></div-->
            <br clear="all">
            <div class="row-fluid">
                <div class="span2">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:20px;">
                        <div style="float:left;">
                            <b>No. Pemeriksaan</b>
                        </div>
                        <div style="float:left;">
                            <b>: <?=$prev['lab_queue_id']?></b>
                        </div>
                    </div>
                </div>
                <?php if($prev['sd_rekmed'] == 0) : ?>
                    <div class="span4">
                        <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                            <div style="float:left;">
                                <b>Keterangan</b>
                            </div>
                            <div style="float:left;margin-left:10px;">
                                <b>: <?=$prev['visit_desc']?></b>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="span3">
                        <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                            <div style="float:left;">
                                <b>No.RM</b>
                            </div>
                            <div style="float:left;margin-left:10px;">
                                <b>: <?=$prev['sd_rekmed']?> / <?=$prev['sd_name']?></b>
                            </div>
                        </div>
                    </div>
                    <div class="span2">
                        <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                            <div style="float:left;">
                                <b>JK</b>
                            </div>
                            <div style="float:left;margin-left:10px;">
                                <?php if($prev['sd_sex'] == 'L'){ $sex = 'Laki-laki';}else{ $sex = 'Perempuan';} ?>
                                <b>: <?=$sex?> / <?=$prev['sd_age']?> Tahun</b>
                            </div>
                        </div>
                    </div>
                    <div class="span3">
                        <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                            <div style="float:left;">
                                <b>Gol. Darah</b>
                            </div>
                            <div style="float:left;margin-left:10px;">
                                <b>:  <?=$prev['sd_blood_tp']?></b>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

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
            <div class="widget-box" id="data">
                
            </div>
        </div>
    </div>
</div>