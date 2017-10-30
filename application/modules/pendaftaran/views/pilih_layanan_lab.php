<style>
    .widget-box{margin-left:5px;margin-right:5px}
    .widget-box form{padding:5px;}
    legend{font-size:16px;margin-bottom:10px;}
</style>
<div class="page-content row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <div class="span2">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            </h5><i class="icon-plus-sign"></i></h5>
                        </span>
                        <h5>Pilih Layanan</h5>
                    </div>
                    <?= form_open('#', array('id' => 'chooseServices')) ?>
                    <div class="controls">
                        <table>
                           <tr><td><label for="lab"><input type="radio"  <?php  if($this->session->userdata('group_id')==6){echo "checked";} ?> name="serviceOptions" id="lab" value="lab">Laboratorium</label></td></tr>
                           <tr><td><label for="rad"><input type="radio"  <?php  if($this->session->userdata('group_id')==12){echo "checked";} ?> name="serviceOptions" id="rad" value="rad">Radiologi</label></td></tr>
                        </table>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="span10">
                <div id="servicesContainer"></div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span10 offset2">
                <div id="addOnContainer"></div>
            </div>
        </div>
    </div>
</div>
<div class='page_footer row-fluid'>
    <?= form_button(array('id' => 'regFinish', 'class' => 'btn btn-primary', 'type' => 'submit', 'content' => 'Selesai', 'disabled' => 'disabled')) ?>
</div>

<?php $this->load->view('alert') ?>

<script>
    function openInNewTab(url)
    {
        var win = window.open(url, '_blank');
        win.focus();
    }

    $(document).ready(function() {

        var sessionUser = "<?=$this->session->userdata('group_id')?>";
        var no_rekmed = "<?=$no_rekmed?>";

        $('#tabs>ul>li:eq(1)').removeClass('ui-state-active ui-tabs-selected');
        $('#tabs>ul>li:eq(2)').addClass('ui-state-active ui-tabs-selected');
        $('#chooseServices input[type=radio]').change(function() {
            $('#addOnContainer').empty();
            switch ($(this).val()) {
                case 'lab':
                    $('#servicesContainer').load('<?= base_url() ?>pendaftaran/lab/'+no_rekmed);
                    tracerURL = '<?= base_url() ?>pendaftaran/cetak_tracer/lab/';
                    break;
                case 'rad':
                    $('#servicesContainer').load('<?= base_url() ?>pendaftaran/rad/'+no_rekmed);
                    tracerURL = '<?= base_url() ?>pendaftaran/cetak_tracer/rad/';
                    break;
            }
        });  
        $('#regFinish').click(function(e) {
            e.preventDefault();
            if ($(this).attr('disabled') !== 'disabled') {
                var url = $('#registrationFinal').attr('action');
                var data = $('#registrationFinal').serialize();
                $.post(url, data, function(response) {
                    response = JSON.parse(response);
                    if ('success' === response.success) {
                        openInNewTab(tracerURL+response.visit_id);
                        $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function() {
                            location.href = "<?= base_url() ?>pendaftaran/";
                        });
                    }
                });
            }
        });
        if( sessionUser == '6'){
            $("#lab").trigger('change');
        }else if( sessionUser == '12')
        {
            $("#rad").trigger('change');
        }
    });
</script>