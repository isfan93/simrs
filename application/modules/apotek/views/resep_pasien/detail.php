<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>
<style>
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
    .hiddens{
        display: none;
    }
    .active{
        background: #FFF;
    }
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>

<script type="text/javascript" charset="utf-8">
    $(function(){

        function openInNewTab(url)
        {
            var win = window.open(url, '_blank');
            win.focus();
            win.print();
        }

        $('.ui-state-default').click(function(){
            $('.ui-state-default').removeClass('ui-state-active');
            $(this).addClass('ui-state-active');
        });

        $('.simpan').click(function(){
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
            var url  = "<?=base_url()?>apotek/resep_pasien/simpanAll";
            var data = $("#frmResep").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            window.location = "<?=base_url()?>apotek/resep_pasien";
                        });
                    }
                });
            });
            return false;
        });

        $('.simpan_cetak').click(function(){
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
            var url  = "<?=base_url()?>apotek/resep_pasien/simpanAll";
            var data = $("#frmResep").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            openInNewTab("<?=base_url()?>apotek/resep_pasien/cetak_resep/<?=$recipe_id?>");
                            window.location = "<?=base_url()?>apotek/resep_pasien";
                        });
                    }
                });
            });
            return false;
        });

        $('.kurangiStok').click(function(){
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
            var url  = "<?=base_url()?>apotek/resep_pasien/kurangi_stok";
            var data = $("#frmResep").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            window.location = "<?=base_url()?>apotek/resep_pasien";
                        });
                    }
                });
            });
            return false;
        });

        $('.kurangiStokCetak').click(function(){
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
            var url  = "<?=base_url()?>apotek/resep_pasien/kurangi_stok";
            var data = $("#frmResep").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            openInNewTab("<?=base_url()?>apotek/resep_pasien/cetak_resep/<?=$recipe_id?>");
                            window.location = "<?=base_url()?>apotek/resep_pasien";
                        });
                    }
                });
            });
            return false;
        });

        $('.btn_trash').live("click",function(){
            var r = confirm("Anda yakin akan menghapus data obat ini ?");
            var racikan_id = $(this).attr('racikan_id');
            if (r == true) {
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
                if(racikan_id != 0){
                    var t = ($(this).parent().parent().parent());
                    t.find('.detail_'+racikan_id).remove();
                    $(this).parent().parent().remove();
                }else{
                    $(this).parent().parent().remove();
                }
                $.unblockUI();
            }
            calculateAll();
            return false;
        });

        $('.btn_reset').live('click',function(){
            var racikan_medicine = $(this).attr('select2_id');
            $("#"+racikan_medicine).select2("val", "");
            htmlQty = $(this).parent().parent();
            htmlQty.find('.qty').val("");

            htmlSummary = htmlQty.parent().find('.recipe_summary');
            $(htmlSummary).attr("recipe_price",0);
            $(htmlSummary).attr("recipe_qty",0);
            $(htmlSummary).attr("recipe_medicine",0);
            $(htmlSummary).attr("recipe_adm",0);

            calculateAll();
            return false;
        });
        $('.btn_reset_item').live('click',function(){
            var medicine = $(this).attr('select2_id');
            $("#"+medicine).select2("val", "");
            htmlQty = $(this).parent().parent();
            htmlQty.find('.qty').val("");
            htmlQty.find('.aturan').val("");
            htmlQty.find('.note').val("");
            calculateAll();
            return false;
        });

        calculateAll();
    });

    function calculateAll(){
        var total_medicine = 0;
        var total_all = 0;
        var total_administrasi = 0;
        $('tr').each(function(){
            var tr = $(this).find('.recipe_summary');
            if( (tr.attr('recipe_price') !== undefined) && (tr.attr('recipe_price') != null) && (tr.attr('recipe_price') != "") )
            {
                total_administrasi = total_administrasi + (parseFloat(tr.attr('recipe_adm')));
                total_medicine = total_medicine + (parseFloat(tr.attr('recipe_price') * parseFloat(tr.attr('recipe_qty'))) );
            }
            if( (tr.attr('recipe_tuslah_price') !== undefined) && (tr.attr('recipe_tuslah_price') != null) )
            {
                total_administrasi = total_administrasi + (parseFloat(tr.attr('recipe_tuslah_price')));
            }
        });
        total_all = total_medicine + total_administrasi;
        $("#recipe_summary_administrasi").val(formatCurrency(total_administrasi));
        $("#recipe_summary_total").val(formatCurrency(total_medicine));
        $("#recipe_summary_all").val(formatCurrency(total_all));
    }

    function formatCurrency(num) {
        num = num.toString().replace(/\$|\,/g, '');
        if (isNaN(num)) num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        // cents = num % 100;
        num = Math.floor(num / 100).toString();
        // if (cents < 10) cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
        // return (((sign) ? '' : '-') + num + '.' + cents);
        return (((sign) ? '' : '-') + num);
    }
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
        <div class="span12" style="background:#E5E5E5;padding-bottom:10px">
            <div class="title" style="margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;"><h3>Data Pasien</h3></div>
            <br clear="all">
            <div class="row-fluid">
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:20px;">
                        <div style="float:left;">
                            <b>No.RM</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>: <?=$data_pasien->sd_rekmed?> / <?=$data_pasien->sd_name?></b>
                        </div>
                    </div>
                </div>
                <div class="span2">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                        <div style="float:left;">
                            <b>JK</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <?php if($data_pasien->sd_sex == 'L'){ $sex = 'Laki-laki';}else{ $sex = 'Perempuan';} ?>
                            <b>: <?=$sex?> / <?=$data_pasien->sd_age?> Tahun</b>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                        <div style="float:left;">
                            <b>Gol. Darah</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>:  <?=$data_pasien->sd_blood_tp?> / <?php echo $data_pasien->ptn_medical_blod_sy;?> mm/Hg / <?php echo $data_pasien->ptn_medical_blod_ds;?> mm/Hg</b>
                        </div>
                    </div>
                </div>
                <div class="span2">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;padding-right: 0px;">
                        <div style="float:left;">
                            <b>
                            Tinggi <?php echo $data_pasien->ptn_medical_height;?> cm/ Berat <?php echo $data_pasien->ptn_medical_weight;?> Kg
                            </b>
                        </div>
                    </div>
                </div>
                <div class="span2">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;padding-right: 0px;">
                        <div style="float:left;">
                            <b>
                            Dokter :  <?php echo ((!empty($data_pasien->dr_name)) ? $data_pasien->dr_name : '-');?>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="frmResep">
        <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
        <input type="hidden" name="mdc_id" value="<?=$mdc_id?>">
        <input type="hidden" name="recipe_id" value="<?=$recipe_id?>">
        <div class="row-fluid" style="margin-top:10px;">
            <div class="span12">
                <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all tabbable" style="background-color:white;padding-left:0px;margin-left:0px;" >
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding-left:0px;margin-left:0px;">
                        <!-- <li class="ui-state-default ui-corner-top"><a href="#" surl='' id="" data-toggle="tab">Obat dan Alkes</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#" surl='' id="" data-toggle="tab">Racikan</a></li> -->
                        <li class="ui-state-default ui-corner-top ui-state-active"><a href="#obat" data-toggle="tab">Obat dan Alkes</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#racikan" data-toggle="tab">Racikan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="obat">
                            <?php $this->load->view('resep_pasien/detail_obat');?>
                        </div>
                        <div class="tab-pane" id="racikan">
                            <?php $this->load->view('resep_pasien/detail_racikan');?>
                        </div>
                    </div>
                    <div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td style="width:75%;font-weight:bold;text-align:right;">Administrasi</td>
                                <td style="width:25%;font-weight:bold;text-align:right;padding-right:180px;">
                                    <input type="text" name="total_administrasi" readonly="readonly" class="input input-small" style="text-align:right;font-weight:bold;" id="recipe_summary_administrasi" />
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;text-align:right;">Obat dan Alkses</td>
                                <td style="font-weight:bold;text-align:right;padding-right:180px;">
                                    <input type="text" name="total_obat" readonly="readonly" class="input input-small" style="text-align:right;font-weight:bold;" id="recipe_summary_total" />
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;text-align:right;">Total</td>
                                <td style="font-weight:bold;text-align:right;padding-right:180px;">
                                    <input type="text" name="total_all" readonly="readonly" class="input input-small" style="text-align:right;font-weight:bold;" id="recipe_summary_all" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-actions" style="margin-bottom:0px;margin-top:0px;">
                        <?php $service_type = substr($mdc_id,0,2);?>
                        <?php if($status_bayar_resep == 1 || $service_type == "RN") : ?>
                            <button type="button" class="btn btn-primary kurangiStok pull-right">Kurangi Stok</button>
                            <button type="button" class="btn btn-info kurangiStokCetak pull-right" style="margin-right:10px;">Kurangi Stok & Cetak</button>
                            <a type="button" href="<?=base_url()?>apotek/resep_pasien" class="btn btn-default pull-right" style="margin-right:10px;">Kembali</a>
                        <?php elseif($status_bayar_resep == 0 && $service_type != "RN") : ?>
                            <button type="button" class="btn btn-primary simpan pull-right">Simpan</button>
                            <button type="button" class="btn btn-info simpan_cetak pull-right" style="margin-right:10px;">Simpan & Cetak</button>
                            <a type="button" href="<?=base_url()?>apotek/resep_pasien" class="btn btn-default pull-right" style="margin-right:10px;">Kembali</a>
                        <?php else : ?>
                            <a href="<?=Base_url()?>apotek/resep_pasien/cetak_resep/<?=$recipe_id?>" target="_blank" type="button" class="btn btn-info cetak pull-right">Cetak</a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
