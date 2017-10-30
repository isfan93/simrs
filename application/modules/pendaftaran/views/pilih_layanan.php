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
                <?php echo form_open('#', array('id' => 'chooseServices')) ?>
                <div class="controls">
                    <table>
                        <tr><td><label for="rajal"><input type="checkbox" name="rajal" id="rajal" value="rajal" > Rawat Jalan</label></td></tr>
                        <tr><td><label for="ranap"><input type="checkbox" name="ranap" id="ranap" value="ranap"> Rawat Inap</label></td></tr>
                        <tr><td><label for="igd"><input type="checkbox" name="igd" id="igd" value="igd"> IGD</label></td></tr>
                        <tr><td><label for="lab"><input type="checkbox" name="lab" id="lab" value="lab" > Lab</label></td></tr>
                        <tr><td><label for="rad"><input type="checkbox" name="rad" id="rad" value="rad"> Radiologi</label></td></tr>
                    </table>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                    </h5><i class="icon-print"></i></h5>
                </span>
                <h5>Cetak Dokumen</h5>
            </div>
            <button id="printGeneralConsent" class="btn btn-link btn-small"> Persetujuan Umum General Consent (A2)</button>
            <button id="printPatientForm" class="btn btn-link btn-small"> Formulir Pengkajian Umum Pasien (A4)</button>
        </div>
    </div>
    <div class="span10">
        <?php
        if (!$patient_availability['is_available']): ?>
        <div class="row-fluid">
            <div class="span9">
                <div class="alert alert-danger">
                    <?php
                    // debug_array($patient_availability['patient_data']);
                    switch (substr($patient_availability['patient_data']['service_id'], 0,2)) {
                        case 'RJ':
                        $service = 'rawat jalan';
                        break;

                        case 'RN':
                        $service = 'rawat inap';
                        break;

                        case 'IG':
                        $service = 'igd';
                        break;
                    }
                    $visit_id = $patient_availability['patient_data']['visit_id'];
                    $service_id = $patient_availability['patient_data']['service_id'];
                    ?>
                    <p style="font-size:14px;font-weight:bold;text-align:center">Pasien dengan nomor rekam medis <?php echo $no_rekmed ?> sedang menjalani pelayanan <?php echo $service ?>.</p>
                </div>  
            </div>
        </div>
        <?php else : ?>
            <?php $visit_id = 0; ?>
            <?php $service_id = 0; ?>
        <?php endif; ?>
        <?php echo form_open(base_url() . 'pendaftaran/daftarAll', array('class' => 'form-horizontal', 'id' => 'registrationFinal')); ?>
        <?php if (!$patient_availability['is_available']): ?>
            <input type="hidden" name="service_id" value="<?=$service_id?>">
            <input type="hidden" name="visit_id" value="<?=$visit_id?>">
        <?php endif;?>
        <div class="row-fluid">
            <div class="span12" id="servicesContainer"></div>
        </div>
        <div class="row-fluid">
            <div class="span9" id="servicesLabContainer"></div>
        </div>
        <div class="row-fluid">
            <div class="span9" id="servicesRadContainer"></div>
        </div>
        <?php echo form_close() ?>
        <div class="row-fluid">
            <div class="span9">
                <div id="addOnContainer"></div>
            </div>
        </div>
    </div>
</div>
    <div class="form-actions">
        <input type='button' id="regFinish" class=" btn btn-primary pull-right" value="Selesai" disabled="true">
    </div>
 
<?php
$this->load->view('alert') ?>

<script>
function allowToFinish()
{
    if( $("#rajal").is(':checked') || $("#ranap").is(':checked') || $("#igd").is(':checked') )
    {
        if( $("#rajal").is(':checked') )
        {
            poli = ($("#poli1").val());
            physician = ($("#physician1").val());
            if ((poli !== undefined && physician !== undefined) && (poli !== '' && physician !== '')) {
                $('#regFinish').prop('disabled', false);
            }else{
                $('#regFinish').prop('disabled', true);
            }
        }else if( $("#ranap").is(':checked') )
        {
            roomClass = $("#class").val();
            room = $("#rooms").val();
            if ((roomClass !== undefined && room !== undefined) && (roomClass !== '' && room !== '')) {
                $('#regFinish').prop('disabled', false);
            }else{
                $('#regFinish').prop('disabled', true);
            }
        }else if( $("#igd").is(':checked') )
        {
             jam = $("#jam_masuk_igd").val();
             physician = $("#physician").val();
            if ((jam !== undefined && physician !== undefined) && (jam !== '' && physician !== '')) {
                $('#regFinish').prop('disabled', false);
                }else{
                    $('#regFinish').prop('disabled', true);
                }
        }
    }else if( $("#lab").is(':checked') || $("#rad").is(':checked') ) {
        $("#regFinish").prop('disabled',false);
    }
}

$(document).ready(function () {
        var tracerURL;
        var sessionUser = "<?php echo $this->session->userdata('group_id') ?>";

        function openInNewTab(url)
        {
            var win = window.open(url, '_blank');
            win.focus();
            win.print();
        }
        
        <?php
        if (!$patient_availability['is_available']): ?>
            $("#rajal").prop('disabled', true);
            $("#ranap").prop('disabled', true);
            $("#igd").prop('disabled', true);
        <?php
        endif; ?>

        $('#tabs>ul>li:eq(1)').removeClass('ui-state-active ui-tabs-selected');
        $('#tabs>ul>li:eq(2)').addClass('ui-state-active ui-tabs-selected');
        tracerURL = "<?php echo base_url() ?>pendaftaran/cetak_tracer/";
        if (sessionUser != '9') {
            // $('#chooseServices input[type=radio]').change(function () {
            //     $('#addOnContainer').empty();
            //     switch ($(this).val()) {
            //         case 'outpatient':
            //             $('#servicesContainer').load('<?php echo base_url() ?>pendaftaran/rawat_jalan/' + '<?php echo $no_rekmed ?>');
            //             tracerURL = '<?php echo base_url() ?>pendaftaran/cetak_tracer/';
            //             break;
            //         case 'hospitalization':
            //             $('#servicesContainer').load('<?php echo base_url() ?>pendaftaran/rawat_inap/' + '<?php echo $no_rekmed ?>');
            //             tracerURL = '<?php echo base_url() ?>pendaftaran/cetak_tracer/';
            //             break;
            //     }
            // });
        } else {
            $('#servicesContainer').load('<?php echo base_url() ?>pendaftaran/igd/' + '<?php echo $no_rekmed ?>');
            tracerURL = '<?php echo base_url() ?>pendaftaran/cetak_tracer/igd/';
        }

        $("#rajal").change(function () {
            allowToFinish();
            if ($(this).is(':checked')) {
                $('#servicesContainer').load('<?php echo base_url() ?>pendaftaran/rawat_jalan/' + '<?php echo $no_rekmed ?>');
                tracerURL = '<?php echo base_url() ?>pendaftaran/cetak_tracer/';
                $("#ranap").attr('disabled', 'disabled');
                $("#igd").attr('disabled', 'disabled');
            } else {
                $("#servicesContainer").html('');
                $("#addOnContainer").html('');
                $("#ranap").removeAttr('disabled');
                $("#igd").removeAttr('disabled');
            }
        });

        $("#ranap").change(function () {
            allowToFinish();
            if ($(this).is(':checked')) {
                $('#servicesContainer').load('<?php echo base_url() ?>pendaftaran/rawat_inap/' + '<?php echo $no_rekmed ?>');
                tracerURL = '<?php echo base_url() ?>pendaftaran/cetak_tracer/';
                $("#rajal").attr('disabled', 'disabled');
                $("#igd").attr('disabled', 'disabled');
            } else {
                $("#servicesContainer").html('');
                $("#rajal").removeAttr('disabled');
                $("#igd").removeAttr('disabled');
            }
        });

        $("#igd").change(function () {
            allowToFinish();
            if ($(this).is(':checked')) {
                $('#servicesContainer').load('<?php echo base_url() ?>pendaftaran/igd/' + '<?php echo $no_rekmed ?>');
                tracerURL = '<?php echo base_url() ?>pendaftaran/cetak_tracer/';
                $("#rajal").attr('disabled', 'disabled');
                $("#ranap").attr('disabled', 'disabled');
            } else {
                $(".xdsoft_noselect").hide();
                $("#servicesContainer").html('');
                $("#rajal").removeAttr('disabled');
                $("#ranap").removeAttr('disabled');
            }
        });

        $("#lab").change(function () {
            allowToFinish();
            if ($(this).is(':checked')) {
                $('#servicesLabContainer').load('<?php echo base_url() ?>pendaftaran/lab/' + '<?php echo $no_rekmed ?>');
            } else {
                $("#servicesLabContainer").html('');
            }
        });

        $("#rad").change(function () {
            allowToFinish();
            if ($(this).is(':checked')) {
                $('#servicesRadContainer').load('<?php echo base_url() ?>pendaftaran/rad/' + '<?php echo $no_rekmed ?>');
            } else {
                $("#servicesRadContainer").html('');
            }
        });

        $('#regFinish').live('click', function (e) {
           
            if ($(this).attr('disabled') !== 'disabled') {
                var dataRajal = '&rajal=no';
                var dataRanap = '&ranap=no';
                var dataRad = '&rad=no';
                var dataLab = '&lab=no';
                var dataIgd = '&igd=no';
                if ($("#rajal").is(':checked')) {
                    var dataRajal = '&rajal=yes';
                }
                if ($("#ranap").is(':checked')) {
                    var dataRanap = '&ranap=yes';
                }
                if ($("#lab").is(':checked')) {
                    var dataLab = '&lab=yes';
                }
                if ($("#rad").is(':checked')) {
                    var dataRad = '&rad=yes';
                }
                if ($("#igd").is(':checked')) {
                    var dataIgd = '&igd=yes';
                }
                var url = "<?php echo base_url() ?>pendaftaran/daftarAll";
                var data = $('#registrationFinal').serialize() + dataRanap + dataRajal + dataLab + dataRad + dataIgd;
                console.log(data);
                $.post(url, data, function (response) {
                    response = JSON.parse(response);
                    if ('success' === response.success) {
                        $('#regFinish').prop('disabled', true);
                        openInNewTab(tracerURL + response.visit_id);
                        $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function () {
                            location.href = "<?php echo base_url() ?>pendaftaran/";
                        });
                    }
                });
            }
        });

        $('#outpatient').trigger('click');

        $('#printPatientForm').click(function (e) {
            e.preventDefault();
            openInNewTab("<?php echo base_url() ?>pendaftaran/cetak_form_pasien/" + '<?php echo $no_rekmed ?>');
        });

        $('#printGeneralConsent').click(function (e) {
            e.preventDefault();
            openInNewTab("<?php echo base_url() ?>pendaftaran/cetak_general_consent/");
        });
});
</script>