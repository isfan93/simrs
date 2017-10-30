<?php 
// if get view from module rekam medis
if(isset($cf['modul_id']) && ($cf['modul_id'] == '12')) : ?>
    <div class="container-fluid">
    <div class="row-fluid">
        <div class="span12" style="background:#E5E5E5;padding-bottom:10px">
            <div class="title" style="margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;"><h3>Data Pasien</h3></div>
            <div class="title" style="float:right;margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;margin-right:20px;"><h3><?php echo pretty_date(date('Y-m-d'),false);?></h3></div>
            <br clear="all">
            <div class="row-fluid">
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:20px;">
                        <div style="float:left;">
                            <b>No.RM</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>: <?=$patient->sd_rekmed?> / <?=$patient->sd_name?></b>
                        </div>
                    </div>
                </div>
                <div class="span2">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                        <div style="float:left;">
                            <b>JK</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <?php if($patient->sd_sex == 'L'){ $sex = 'Laki-laki';}else{ $sex = 'Perempuan';} ?>
                            <b>: <?=$sex?> / <?=$patient->sd_age?> Tahun</b>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                        <div style="float:left;">
                            <b>Alergi</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>: <?php echo $patient->sd_alergi;?></b>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;padding-right: 0px;">
                        <div style="float:left;">
                            <b>Riwayat</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>: <?php echo $patient->sd_riwayat_penyakit;?></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs" id="list_rekmed">
                <?php
                if($med_recs->num_rows() >= 1){
                    foreach($med_recs->result() as $key => $value):
                        ?>
                        <li class="pilih">
                            <a href="#<?=$key+1?>" visit_rekmed="<?=$value->visit_rekmed?>" data-toggle="tab" service_id="<?php echo $value->service_id;?>">
                                <?=pretty_date($value->visit_in,false)?>
                            </a>
                        </li>
                        <?php
                    endforeach;
                }
                ?>
                <!-- <li class="pilih"><a href="#0" sd_rekmed="" data-toggle="tab">load more...</a></li> -->
            </ul>
            <div class="tab-content" id="detail_rekmed">
                <?php
                if($med_recs->num_rows() >= 1){
                    foreach($med_recs->result() as $key => $value):
                        ?>
                        <div class="tab-pane" id="<?=$key+1?>">...</div>
                        <?php
                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.btn-finish').live('click',function(){
            if(confirm('Apakah kunjungan pasien benar - benar sudah berakhir?'))
            {
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
                url = $(this).attr('href');
                data = null;
                $.post(url,data, function(result){
                    var result = JSON.parse(result);
                    $.unblockUI({
                        onUnblock: function(){
                            if (result.success === true) {
                                $(".alert").fadeIn().delay(500).fadeOut(function(){
                                    //oTable.fnReloadAjax("<?= base_url() ?>rekam_medis/get_kunjungan/");
                                    $('ul#list_rekmed a[data-toggle="tab"]:eq(0)').trigger('click');
                                });
                            } else {
                                alert('Kunjungan tidak dapat diakhiri karena masih ada pelayanan yang belum selesai.');
                            }
                        }
                    });
                });
            }
            return false;
        });
        $('.btn-finish-service').live('click',function(){
            // alert($(this).parent().html());
            if(confirm('Apakah layanan pasien benar - benar akan diakhir?'))
            {
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
                url = $(this).attr('href');
                data = null;
                $.post(url,data, function(result){
                    var result = JSON.parse(result);
                    $.unblockUI({
                        onUnblock: function(){
                            if (result.success === true) {
                                $(".alert").fadeIn().delay(500).fadeOut(function(){
                                    $(".active").children().trigger('click');
                                });
                            } else {
                                alert('Layanan tidak dapat diakhiri karena pasien masih dalam pelayanan.');
                            }
                        }
                    });
                });
            }
            return false;
        });
        $('.btn-start-service').live('click',function(){
            // alert($(this).parent().html());
            if(confirm('Apakah layanan pasien akan diaktifkan?'))
            {
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
                url = $(this).attr('href');
                data = null;
                $.post(url,data, function(result){
                    var result = JSON.parse(result);
                    $.unblockUI({
                        onUnblock: function(){
                            if (result.success === true) {
                                $(".alert").fadeIn().delay(500).fadeOut(function(){
                                    $(".active").children().trigger('click');
                                });
                            } else {
                                alert('Layanan tidak dapat diaktifkan.');
                            }
                        }
                    });
                });
            }
            return false;
        });

        //combine ajax.get data from controller and tab
        $('ul#list_rekmed a[data-toggle="tab"]').click(function(e)
        {
            href = $(this).attr('href');
            var visit_rekmed = $(this).attr('visit_rekmed');
            var service_id = $(this).attr('service_id');
            if(href != '#0'){
                $.get('<?=base_url()?>rawat_inap/single_rekmed/'+service_id, function(data) {
                    $(href).html(data);
                });
            }else{
                // load_more = $("ul#list_rekmed li").eq(-1).html();
                // $('ul#list_rekmed li').eq(-1).remove();
                // //if load more
                // $.get('<?=base_url()?>rawat_jalan/poli_tulang/rekam_medis/load_more/'+sd_rekmed, function(data) {
                //     batas = 0;
                //     $(data).each(function(d){
                //         $("ul#list_rekmed").append("<li><a href='#"+data[d].medical_id+"' data-toggle='tab' >"+data[d].medical_date_time+"</a></li>");
                //         $('#detail_rekmed').append('<div class="tab-pane" id="'+data[d].medical_id+'">...</div>')
                //         batas++;
                //     })
                //     $("ul#list_rekmed").append("<li>"+load_more+"</li>");
                // },'json');
            }
            // return false;
        });
        
        $('ul#list_rekmed a[data-toggle="tab"]:eq(0)').trigger('click');
    })
</script>