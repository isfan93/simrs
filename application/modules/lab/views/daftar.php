<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css" media="screen">
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.table_tr tbody th{
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
    .ffb{
        width: 400px !important;
    }
    #fx_item.ffb{
        width:320px !important;
        top: 28px !important;
    }
    #fx_item_ctr .row .col1{
        float:left;
        width:10px;
    }
    #fx_item_ctr .row .col2{
        float:left;
        margin-left: 15px;
        width:220px;
    }
    .ffb-input{
        width: 205px !important;
    }
</style>
<script type="text/javascript">
$(function(){
    var i = 0;
    $('.datepicker').datepicker({
        minDate: '0',
    });

    function add(){
        i++;
        var str = ("<label class='control-label'>Pemeriksaan "+i+"</label>");
            str += ("<div class='controls'>");
            str += ("<div id='"+i+"_fx_penunjang' class='fx_penunjang'><input type='hidden' id='"+i+"_harga' name='harga[]' class='harga' ><input type='hidden' id='"+i+"_nama_penunjang' name='nama_penunjang[]' class='nama_penunjang' >");
            str += ("</div");
            $("#penunjang").append(str);
            $('#'+i+'_fx_penunjang').flexbox(BASE+'lab/get_penunjang',{
                paging: false,
                showArrow: false ,
                maxVisibleRows : 0,
                width : 300,
                resultTemplate: '{id} - {name} - {harga}',
                onSelect: function() {
                    var id = $(this).parent().find('input:eq(2)').val();
                    var id_harga = $(this).parent().find('input:eq(0)').attr('id');
                    var id_nama_penunjang = $(this).parent().find('input:eq(1)').attr('id');
                    $.getJSON(BASE+"lab/json_get_penunjang/"+id, function(json) {
                        $("#"+id_harga).val(json.harga);
                        $("#"+id_nama_penunjang).val(json.name);
                    })
                }
            });
        $(".fx_penunjang").find('input:eq(2)').attr('name','penunjang[]');
    }

    $("#noKartu").keyup(function(){
        var noKartu = $(this).val();
        var crsf = $('.crsf').val();
        var crsfName = $('.crsf').attr('name');
        if( noKartu.length == 8 )
        {
            $.ajax({
                url: "<?= base_url() ?>lab/getPatientData",
                type: 'post',
                dataType: "json",
                data: crsfName+"="+crsf+'&noKartu='+noKartu,
                success: function(result) {
                    if( result.success == 1)
                    {
                        $("#sd_rekmed").val(result.sd_rekmed);
                        $("#sd_name").val(result.sd_name);
                        $("#sd_address").val(result.sd_address);
                        $("#simpan").removeAttr('disabled');
                    }else{
                        $("#sd_rekmed").val('');
                        $("#sd_name").val('');
                        $("#sd_address").val('');
                        $("#simpan").attr('disabled','disabled');
                    }
                }
            });
        }
    });

    isvalid = $("#form_penunjang").validate({
        rules: {
            
        },
        submitHandler: function(form) {
            var url  = "<?=base_url()?>lab/simpan_daftar";
            var data = jQuery(form).serialize();
            $.post(url,data, function(data){
                $(".alert").fadeIn().delay(500).fadeOut(function(){
                    // $("#tab_penunjang").trigger('click'); 
                });     
            }); 
            return false;
        }
    });

    for(var j = i+1; j <= 5; j++) {
        add();
    };

});
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
		<div class="span6" >
			<div class="title">
                <h3>
                    Tambah Antrian Lab        
                </h3>
            </div>
		</div>
	</div>
    <?=form_open(base_url() . 'lab/', array('class' => 'form-horizontal', 'id' => 'form_penunjang')); ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>                                  
                    </span>
                    <h5>Data Pasien , Pemeriksaan Lab & Radiologi </h5>
                </div>
                <div class="widget-content">
                    <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
                    <div class="row-fluid">
                        <div class="span4">
                            <label class="control-label">No.Kartu Pasien</label>
                            <div class="controls">
                                <input type="text" name="" id="noKartu">
                            </div>
                            <label class="control-label">No.Rekam Medis</label>
                            <div class="controls">
                                <input type="text" name="sd_rekmed" id="sd_rekmed" readonly="true">
                            </div>
                            <label class="control-label">Nama</label>
                            <div class="controls">
                                <input type="text" name="" id="sd_name" readonly="true">
                            </div>
                            <label class="control-label">Alamat</label>
                            <div class="controls">
                                <input type="text" name="" id="sd_address" readonly="true">
                            </div>
                        </div>
                        <div class="span8" id="penunjang">
                            <!-- <label class="control-label">Pemeriksaan</label>
                            <div class="controls">
                                <div id="1_fx_penunjang" class="1_fx_penunjang" style=""></div>
                            </div>   -->
                        </div>
                    </div>
                </div>
                <div class="form-actions" style="margin-bottom:0px;">
                    <button id="simpan" type="submit" class="btn btn-primary pull-right" disabled="disabled">Simpan</button>
                    <button  style="margin-right:10px;" id="reset" class="btn pull-right" type="reset">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <?=form_close()?>
</div>

<script type="text/javascript">
    $(function(){

    });
</script>