<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-te-1.4.0.css" />
<script type="text/javascript" src='<?=base_url()?>assets/js/jquery-te-1.4.0.js'></script>
<style>
    .widget-box{margin-left:5px;margin-right:5px}
    .widget-box form{padding:5px;}
    legend{font-size:16px;margin-bottom:10px;}
    .jqte {
        margin: 0px;
    /* border: #000 1px solid; */
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
    /* overflow: hidden; */
    }
    .jqte_focused{
        border-color: #ffffff;
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
                        <tr><td><label for="lab"><input type="checkbox" name="lab" id="lab" value="lab" > Lab</label></td></tr>
                        <tr><td><label for="rad"><input type="checkbox" name="rad" id="rad" value="rad"> Radiologi</label></td></tr>
                    </table>
                </div>
                <?php echo form_close() ?>
            </div>
    </div>
    <div class="span10">
        <?php echo form_open(base_url() . 'pendaftaran/daftarAll', array('class' => 'form-horizontal', 'id' => 'registrationFinal')); ?>
        <input type="hidden" name="service_id" value="0">
        <input type="hidden" name="visit_id" value="0">
        <input type="hidden" name="pasien_umum" value="yes">
        <div class="row-fluid">
            <div class="span9">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    </h5><i class="icon-ok"></i></h5>
                                </span>
                                <h5>Keterangan * <i>(Nama Pasien / Alamat / Asal Rujukan)</i></h5>
                            </div>
                            <div class="" style="padding:0px;">
                                <div class="form-group">
                                    <textarea class="span12 editor" id="visit_desc" name="visit_desc" placeholder="Nama Pasien / Alamat / Asal rujukan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<script type="text/javascript">
    function allowToFinish()
    {
        var status = true;
        if( $("#lab").is(':checked') || $("#rad").is(':checked') ) {

        }else{
            status = false;
        }
        
        if( $(".jqte_editor").html().length <= 0 )
        {
            status = false;
        }

        if(status == false)
        {
            $("#regFinish").prop('disabled','disabled');
        }else{
            $("#regFinish").prop('disabled',false);
        }
    }

    $(document).ready(function () {
        //=============== hendri, 26 April 2015
        $('.editor').jqte({br: false,center: false,color: false,fsize: false,format: false,
            link: false,left: false,p: false,remove: false,right: false,rule: false,source: false,sub: false,
            strike: false,sup: false,u: false,unlink: false});
        //=====================================
        var tracerURL;
        var sessionUser = "<?php echo $this->session->userdata('group_id') ?>";

        function openInNewTab(url)
        {
            var win = window.open(url, '_blank');
            win.focus();
            win.print();
        }
        
        $(".jqte_editor").bind('input propertychange',function(){
            allowToFinish();
        });

        $('#tabs>ul>li:eq(1)').removeClass('ui-state-active ui-tabs-selected');
        $('#tabs>ul>li:eq(2)').addClass('ui-state-active ui-tabs-selected');
        tracerURL = "<?php echo base_url() ?>pendaftaran/cetak_tracer/";

        $("#lab").change(function () {
            allowToFinish();
            if ($(this).is(':checked')) {
                $('#servicesLabContainer').load('<?php echo base_url() ?>pendaftaran/lab/');
            } else {
                $("#servicesLabContainer").html('');
            }
        });

        $("#rad").change(function () {
            allowToFinish();
            if ($(this).is(':checked')) {
                $('#servicesRadContainer').load('<?php echo base_url() ?>pendaftaran/rad/');
            } else {
                $("#servicesRadContainer").html('');
            }
        });

        $('#regFinish').live('click', function (e) {
           
            if ($(this).attr('disabled') !== 'disabled') {
                var dataRajal = '&rajal=no';
                var dataRanap = '&ranap=no';
                var dataIgd = '&igd=no';
                var dataRad = '&rad=no';
                var dataLab = '&lab=no';
                if ($("#lab").is(':checked')) {
                    var dataLab = '&lab=yes';
                }
                if ($("#rad").is(':checked')) {
                    var dataRad = '&rad=yes';
                }
                var url = "<?php echo base_url() ?>pendaftaran/daftarAll";
                var data = $('#registrationFinal').serialize() + dataLab + dataRad;
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
    });
</script>