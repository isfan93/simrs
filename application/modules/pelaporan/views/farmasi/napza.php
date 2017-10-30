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

<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed">
    <div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" style="display: none; width:50px "></div>
            <img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
            <div class="gritter-with-image" style="width:448px">
                <span class="gritter-title" style="margin-left:36px">Message</span>
                <p>Berhasil</p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="gritter-bottom"></div>
    </div>
</div>

<div class="pageheader notab">
    <div class="row-fluid">
        <div class="span6">
            <h1 class="pagetitle" style=""><?=$title?>
            </h1>
        </div>
        <div class="span6">
            <form class="form-inline" id="getNapza" action="<?=base_url()?>pelaporan/farmasi/getPenggunaanNapza" method="POST">
                <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
                <div  style="margin-top:10px;float:right;margin-right:20px;">
                    <label class="control-label">Tanggal : </label> <input type="text" name="date_start" class="input input-small datepick date_start">    
                    <label class="control-label"> s/d </label> <input type="text" name="date_end" class="input input-small datepick date_end">
                    <button type="submit" class="btn btn-small btn-primary">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="data_result">
    
</div>
<script type="text/javascript">
    $(function(){
        $("#getNapza").on('submit',function(){
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
            var data = $(this).serialize();
            $.post(url,data, function(data){
                setTimeout(function() { 
                    $.unblockUI({
                        onUnblock: function(){
                            $("#data_result").html(data);
                            $(".alert").fadeIn().delay(500).fadeOut(function(){
                            });
                        }
                    });
                }, 1000);  
            });
            return false;
        });

        $('.datepick').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true
        });

        var nowDate = new Date();
        var bln = nowDate.getMonth() + 1;
        var year = "<?php echo date('Y')?>";
        $(".date_start").val(bln+"/01/"+year);
        $(".date_end").val(bln+"/30/"+year);
        setTimeout(function(){
            $("#getNapza").trigger('submit');
        },500);
    });
</script>