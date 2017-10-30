<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>
<!-- JQTE -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-te-1.4.0.css" />
<script type="text/javascript" src='<?=base_url()?>assets/js/jquery-te-1.4.0.js'></script>
<style>
    .widget-box{margin-left:5px;margin-right:5px}
    .widget-box form{padding:5px;}
    legend{font-size:16px;margin-bottom:10px;}
    .jqte {
        margin: 0px;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border: 1px solid #ccc;
    }
    .jqte_focused{
        border: 1px solid #ccc;
        box-shadow: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
    }
    blockquote { 
    font-size: 16px; font-family: Georgia, "Times New Roman", Times, serif; background: none ! important;
    font-style: normal; line-height: 24px; padding-left: 30px; margin: 10px 0;
    }
    blockquote.alignleft { width: 300px; float: left; margin: 10px 10px 5px 0; }
    blockquote.alignright { width: 300px; float: right; margin: 10px 0 5px 10px; text-align: left; }
</style>
<!-- END JQTE -->
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
        // JQTE
         $('.editor').jqte({br: false,center: false,color: false,fsize: false,format: false,
            link: false,left: false,p: false,remove: false,right: false,rule: false,source: false,sub: false,
            strike: false,sup: false,u: false,unlink: false});
        // END JQTE
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
            var url  = "<?=base_url()?>apotek/pembelian_umum/simpanPembelianUmum";
            var data = $("#frmResep").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            window.location = "<?=base_url()?>apotek/pembelian_umum";
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
            var url  = "<?=base_url()?>apotek/pembelian_umum/simpanPembelianUmum";
            var data = $("#frmResep").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            <?php if(isset($visit_id)) : ?>
                                openInNewTab("<?=base_url()?>apotek/pembelian_umum/cetak/<?=isset($visit_id) ? $visit_id : '' ?>/<?=isset($tdb_number) ? $tdb_number : '' ?>");
                                window.location = "<?=base_url()?>apotek/pembelian_umum";
                            <?php else : ?>
                                window.location = "<?=base_url()?>apotek/pembelian_umum";
                            <?php endif;?>
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
                            window.location = "<?=base_url()?>apotek/pembelian_umum";
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
                            openInNewTab("<?=base_url()?>apotek/pembelian_umum/cetak/<?=isset($visit_id) ? $visit_id : '' ?>/<?=isset($tdb_number) ? $tdb_number : '' ?>");
                            window.location = "<?=base_url()?>apotek/pembelian_umum";
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

            htmlSummary = htmlQty.find('.recipe_summary');
            $(htmlSummary).attr("recipe_price",0);
            $(htmlSummary).attr("recipe_qty",0);
            $(htmlSummary).attr("recipe_medicine",0);
            $(htmlSummary).attr("recipe_adm",0);
            calculateAll();
            return false;
        });

        $('#visit_desc').bind('input propertychange', function() {
            cek_visit_desc();
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
        cek_visit_desc();
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
    

    function cek_visit_desc()
    {
        var visit_desc = $("#visit_desc").val();
        if(visit_desc.length >= 1)
        {
            $(".simpan").removeAttr('disabled');
            $(".simpan_cetak").removeAttr('disabled');
        }else{
            $(".simpan").attr('disabled','disabled');
            $(".simpan_cetak").attr('disabled','disabled');
        }
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
    <form id="frmResep">
        <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
        <input type="hidden" name="visit_id" value="<?=isset($visit_id) ? $visit_id : '' ?>">
        <input type="hidden" name="bill_id" value="<?=isset($bill_id) ? $bill_id : '' ?>">
        <input type="hidden" name="tdb_number" value="<?=isset($tdb_number) ? $tdb_number : '' ?>">
        <input type="hidden" name="mdc_id" value="<?=isset($tdb_number) ? $tdb_number : '' ?>">
        <input type="hidden" name="recipe_id" value="<?=isset($tdb_number) ? $tdb_number : '' ?>">
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
                            <div class="pull-right span9" style="margin:10px;">
                                <label class="span4">Keterangan :* <br><i>(Isikan nama / Alamat / Asal Rujukan)</i></label>
                                <textarea name="visit_desc" id="visit_desc" class="span8 editor" cols="" rows="3"><?php echo isset($visit->visit_desc) ? $visit->visit_desc : '';?></textarea>
                            </div>
                            <?php $this->load->view('/pembelian_umum/detail_obat');?>
                        </div>
                        <div class="tab-pane" id="racikan">
                            <?php $this->load->view('/pembelian_umum/detail_racikan');?>
                        </div>
                    </div>
                    <div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td style="width:75%;font-weight:bold;text-align:right;">Administrasi</td>
                                <td style="width:25%;font-weight:bold;text-align:right;padding-right:180px;">
                                    <input type="text" name="total_administrasi" class="input input-small" style="text-align:right;font-weight:bold;" id="recipe_summary_administrasi"></input>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;text-align:right;">Obat dan Alkses</td>
                                <td style="font-weight:bold;text-align:right;padding-right:180px;">
                                    <input type="text" name="total_obat" readonly="readonly" class="input input-small" style="text-align:right;font-weight:bold;" id="recipe_summary_total"></input>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;text-align:right;">Total</td>
                                <td style="font-weight:bold;text-align:right;padding-right:180px;">
                                    <input type="text" name="total_all" readonly="readonly" class="input input-small" style="text-align:right;font-weight:bold;" id="recipe_summary_all"></input>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-actions" style="margin-bottom:0px;margin-top:0px;">
                        <?php if($status_bayar_resep == 1) : ?>
                            <button type="button" class="btn btn-primary kurangiStok pull-right">Kurangi Stok</button>
                            <button type="button" class="btn btn-info kurangiStokCetak pull-right" style="margin-right:10px;">Kurangi Stok & Cetak</button>
                            <a type="button" href="<?=base_url()?>apotek/resep_pasien" class="btn btn-default pull-right" style="margin-right:10px;">Kembali</a>
                        <?php elseif($status_bayar_resep == 0) : ?>
                            <button type="button" class="btn btn-primary simpan pull-right" disabled="disabled">Simpan</button>
                            <button type="button" class="btn btn-info simpan_cetak pull-right" style="margin-right:10px;" disabled="disabled">Simpan & Cetak</button>
                            <a type="button" href="<?=base_url()?>apotek/resep_pasien" class="btn btn-default pull-right" style="margin-right:10px;">Kembali</a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
