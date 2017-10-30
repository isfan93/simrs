<style type="text/css">
    textarea{
        border: 1px solid #CCCCCC;
    }
    .ffb-input{
        background: transparent;
        border: none;
        width: 96% !important;
        border-bottom: 1px dotted gray;
    }
    .ffb{
        width: 450px !important;
    }
    .row .col1{
        float:left;
        width:10px;
    }
    .row .col2{
        float:left;
        width:400px;
    }
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>
<script>
    $(function(){
        var i = 0;
        var lab_queue_id = "<?php echo $prev['lab_queue_id'];?>";
        var surl = "<?=base_url()?>lab/load_form/"+lab_queue_id;
        var urlGetTindakan = 'lab/get_tindakan_lab';
        $(".finish").click(function(){
            var url  = "<?=base_url()?>lab/finish_pemeriksaan";
            var data = $("#form_penunjang").serialize();
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
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            window.location.href = (document.referrer);
                        });
                    }
                });
            });
            return false;
        })

        $('.tbh').click(function(){
            add();
        });

        function add(){
            i++;
            var str = ("<tr>");
                str += ("<td style='padding-left:20px;'>");
                str += ("<div id='"+i+"_fx_penunjang' class='fx_penunjang'><input type='hidden' id='"+i+"_harga' name='harga[]' class='harga' ><input type='hidden' id='"+i+"_nama_penunjang' name='nama_penunjang[]' class='nama_penunjang' >");
                str += ("</td>");
                $("#penunjang tbody").append(str);
                $('#'+i+'_fx_penunjang').flexbox(BASE+urlGetTindakan,{
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
                        $('#regFinish').removeAttr('disabled');
                    }
                });
            $(".fx_penunjang").find('input:eq(2)').attr('name','penunjang[]');
            $('#'+i+'_fx_penunjang_input').focus();
        }
        <?php if(in_array($visit->lab_queue_status, array(1,2,3))) : ?>
            for(var j = i+1; j <= 1; j++) {
                add();
            };
        <?php endif;?>

        $(".kirimkasir").click(function(){
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
            var url  = "<?=base_url()?>lab/kirim_kasir";
            var data = $("#form_penunjang").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                            window.location.href = (document.referrer);
                        });
                    }
                });
            });
            return false;
        })

        $('.btn-trash').live("click",function(){
            t = this;
            var r = confirm("Anda yakin akan menghapus data obat ini ?");
            if (r == true) {
                crsf = $('.crsf').val();
                csrf_name = $('.crsf').attr('name');
                var lab_queue_id = $(this).attr('lab_queue_id');
                var trx_ds_id = $(this).attr('trx_ds_id');
                var ds_id = $(this).attr('ds_id');
                var ds_name = $(this).attr('ds_name');
                var url  = $(this).attr('href');
                var data = csrf_name+"="+crsf+'&lab_queue_id='+lab_queue_id+'&trx_ds_id='+trx_ds_id+'&ds_id='+ds_id+'&ds_name='+ds_name;
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
                $.post(url,data, function(data){
                    $.unblockUI({
                        onUnblock: function(){
                            $(".alert").fadeIn().delay(500).fadeOut(function(){
                                $("#"+ds_id).parent().parent().remove();
                            });
                        }
                    });
                });
                return false;
            }
            return false;
        })

    });
</script>
<?php
    $readonly = '';
    if(in_array($visit->lab_queue_id, array(1,2,3)))
        $readonly = 'readonly';
?>
<?=form_open(base_url().'lab/finish_pemeriksaan',array('class' => 'form-horizontal','id' => 'form_penunjang','enctype'=>'multipart/form-data','method'=>'POST')); ?>
<div class="widget-content">
    <input type="hidden" name="lab_queue_id" value=<?=$prev['lab_queue_id']?> >
    <label for="dr_id" class="control-label">Dokter Penanggung Jawab</label>
    <div class="controls">
        <select class="input-medium" name="dr_id" value="" readonly="<?=$readonly?>">
            <?php 
            if( $dokter->num_rows() >= 1 )
            {
                foreach ($dokter->result() as $key => $value) {
                    $selected = '';
                    if($visit->dr_id == $value->id_employe)
                        $selected = 'selected';
                    ?>
                        <option value="<?php echo $value->id_employe;?>" <?=$selected?> ><?php echo $value->dr_name;?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <label for="operator_id" class="control-label">Operator</label>
    <div class="controls">
       <select class="input-medium" name="operator_id" value="" readonly="<?=$readonly?>" id="operator_id">
            <?php
            if( $operator->num_rows() >= 1 )
            {
                foreach ($operator->result() as $key => $value) {
                    $selected = '';
                    if($visit->operator_id == $value->id_employe)
                        $selected = 'selected';
                    ?>
                        <option value="<?php echo $value->id_employe;?>" <?=$selected?> ><?php echo $value->sd_name;?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <label for="dr_sender" class="control-label">Dokter Pengirim</label>
    <div class="controls">
       <input type="text" class="input-medium" name="dr_sender" id="dr_sender">            
    </div>
    <label for="no_reg" class="control-label">No. Registrasi</label>
    <div class="controls">
       <input type="text" class="input-medium" name="no_reg" id="no_reg">            
    </div>
    <table id="penunjang" cellpadding="0" cellspacing="0" border="0" class="tabel-dokter table table-bordered table_tr">
        <thead>
            <tr role="row">
                <!-- <th class="" style="width:2%;">Nomor</th> -->
                <th class="" style="width:30%;">Nama Pemeriksaan</th>
                <th class="" style="width:40%;">Hasil</th>
            </tr>
        </thead>
        <?php $i = 0;?>
        <?php if( $penunjang->num_rows() >= 1 ) : ?>
                <?php foreach ($penunjang->result() as $key => $value) : ?>
                    <?php $i++; ?>
                    <tr>
                        <td style="padding-left:20px;">
                            <?=$value->ds_name?>
                            <?php if(in_array($visit->lab_queue_status, array(1,2,3))) : ?>
                                <a href="<?=base_url()?>lab/delete_list/" id="<?=$value->ds_id?>" lab_queue_id="<?=$visit->lab_queue_id?>" trx_ds_id="<?=$value->trx_ds_id?>" ds_id="<?=$value->ds_id?>" ds_name="<?=$value->ds_name?>" class="btn-trash"><i class="icon-trash"></i></a>
                                <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if( ($penunjang_detail->num_rows() >= 1) ) : ?>
                                <?php foreach ($penunjang_detail->result() as $k => $v) : ?>
                                    <?php if( $v->trx_ds_id == $value->trx_ds_id ) : ?>
                                        <div style='float:left;width:30%;'>
                                        <?php echo $v->dsupport_name; ?>
                                        <br>
                                        Nilai Rujukan :
                                        <?php echo $v->dsupport_standart_value; ?>
                                        <?php echo $v->dsupport_satuan; ?>
                                        <br>
                                        </div>
                                        <div style='float:left;width:40%;'>
                                        <input type="text" style="width:100%" name='hasil[<?php echo $v->dsupport_code; ?>]' class='input input-small' id='' placeholder='Hasil' ><?php echo $v->dsupport_value; ?></textarea>
                                        <textarea rows="4" style="width:100%" name='noted[<?php echo $v->dsupport_code; ?>]' class='input input-small' id='' placeholder='Keterangan' ><?php echo $v->dsupport_ekspertise_note; ?></textarea>
                                        </div>
                                        <!-- <div style='float:left;width:20%;'>
                                        <input type='file' name='image[<?php echo $v->dsupport_code; ?>]' class='input input-small'>
                                        </div> -->
                                        <br clear='all'>
                                        <br clear='all'>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else : ?>
                <tbody>
                    
                </tbody>
            <?php endif;?>
            <?php if(in_array($visit->lab_queue_status, array(1,2,3))) : ?>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <button type="button" class="btn btn-warning btn-small tbh" style="margin-left:45%;">Tambah</button>
                        </td>
                    </tr>
                </tfoot>
            <?php endif;?>
    </table>                            
</div>
<div class="form-actions" style="margin-bottom:0px;margin-top:0px;">
    <?php if( (in_array($visit->lab_queue_status, array(1,2,3))) && (($visit->service_reference == '') || (in_array((substr($visit->service_reference,0,2)), array('RJ')))) ) : ?>
        <button type="button" class="btn btn-primary pull-right kirimkasir" >Simpan</button>
    <?php elseif($visit->lab_queue_status == 4 || (in_array((substr($visit->service_reference,0,2)), array('IG','RN'))) ) : ?>
        <button type="button" class="btn btn-primary pull-right finish" >Simpan & Selesai</button>
        <button type="button" class="btn btn-primary pull-right kirimkasir" style="margin-right:10px;" >Simpan</button>
    <?php endif;?>
    <!-- <button type="button" class="btn btn-primary pull-right finish" style="margin-left:10px;" >Finish Pemeriksaan Lab</button> -->
</div>
<?=form_close()?> 