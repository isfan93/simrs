<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css" media="screen">
    .ffb{
        width: 600px !important;
    }
    #fx_item.ffb{
        width:350px !important;
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
        width: 305px !important;
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    </h5><i class="icon-ok"></i></h5>
                </span>
                <h5>Layanan Radiologi</h5>
            </div>
            <?php echo form_hidden('no_rekmed', $patient->sd_rekmed) ?>
            <?php echo form_hidden('is_new_patient', $is_new_patient ? 1 : 0) ?>
            <?php echo form_hidden('request_new_card', 0) ?>
            <?php if( in_array(get_user('group_id'),array(6,12)) ): ?>
            <div class="widget-content">
                <table>
                    <tr><td>No. Rekam medis</td><td> : <?=$patient->sd_rekmed?></td></tr>
                    <tr><td>Nama Pasien</td><td> : <?=$patient->sd_name?></td></tr>
                </table>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
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
});
</script>
