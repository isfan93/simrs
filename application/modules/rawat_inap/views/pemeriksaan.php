<style>
    .patient-data-container .title{cursor:pointer;}
    #patientData table td{padding:3px;}
    #patientData table .colon{width:5px}
    #warning{font-size:14px;font-weight:bold}
    .page_footer {
        background-color: #cdcdcd;
        margin-top: 20px;
    }
    .page_footer button {
        float: right;
        margin: 10px;
    }
    .dropdown-menu{left:auto;right:0;}
</style>
<div class="container-fluid">
    <!--div untuk data pasien-->
    <div class="row-fluid" style="display:none">
        <div class="span12">
            <div id="warning"></div>
        </div>
    </div>
    <div class="patient-data-container row-fluid">
        <div class="span12" style="background:#E5E5E5;padding:0px 10px 10px 10px">
            <div class="pull-right">
                <div class="btn-group" style="position:relative;top:15px">
                <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-print"></i>
                </button>
                <ul class="dropdown-menu">

                </ul>
              </div>
              <div class="btn-group" style="position:relative;top:15px">
                <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-wrench"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)" id="labRegistration"><i class="icon-filter"></i> Daftar Lab</a></li>
                    <li><a href="javascript:void(0)" id="radRegistration"><i class="icon-eye-open"></i> Daftar Radiologi</a></li>
                    <li><a href="javascript:void(0)" id="roomOptions"><i class="icon-th-large"></i> Pemindahan Kamar</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)" id="checkOut"><i class="icon-remove"></i> Check Out</a></li>
                </ul>
              </div>
            </div>
            <div class="title" style="margin:0px;border:0px"><h3>Data Pasien <span style="position:relative;top:-2px" class="label label-warning"><i class="icon-chevron-down"></i></span></h3></div>
            <div id="patientData">
                <table style="width:100%;font-weight:bold">
                <tr>
                    <td style="width:10%">No Rekam Medis</td>
                    <td class="colon">:</td>
                    <td style="width:40%"><?php echo $patient_data['sd_rekmed'];$sd_rekmed=$patient_data['sd_rekmed']; ?></td>
                    <td rowspan="3" style="width:10%;vertical-align:top">Riwayat Alergi</td>
                    <td rowspan="3" class="colon" style="vertical-align:top">:</td>
                    <?php $allergy = $patient_data['sd_alergi'] != NULL ? $patient_data['sd_alergi'] : '-' ?>
                    <td rowspan="3" style="vertical-align:top"><?= $allergy ?></td>
                </tr>
                <tr>
                    <td style="width:10%">Nama</td>
                    <td class="colon">:</td>
                    <td style="width:40%"><?= $patient_data['sd_name'] ?></td>
                </tr>
                <tr>
                    <td style="width:10%">Tanggal Masuk</td>
                    <td class="colon">:</td>
                    <?php $visit_date = pretty_date($patient_data['visit_in'], true) ?>
                    <td style="width:40%"><?= $visit_date ?></td>

                </tr>
                <tr>
                    <td style="width:10%">Jenis Kelamin / Usia</td>
                    <td class="colon">:</td>
                    <?php $sex = $patient_data['sd_sex'] == 'L' ? 'Laki - Laki' : 'Perempuan' ?>
                    <td style="width:40%"><?= $sex ?> / <?= $patient_data['sd_age'] ?> tahun</td>
                    <td rowspan="3" style="width:10%;vertical-align:top">Riwayat Penyakit</td>
                    <td rowspan="3" class="colon" style="vertical-align:top">:</td>
                    <?php $disease = $patient_data['sd_riwayat_penyakit'] != NULL ? $patient_data['sd_riwayat_penyakit'] : '-' ?>
                    <td rowspan="3" style="vertical-align:top"><?= $disease ?></td>
                </tr>
                <tr>
                    <td style="width:10%">Kelas / No Kamar</td>
                    <td class="colon">:</td>
                    <td style="width:40%"><?= $patient_data['class_name'] ?> / <?= $patient_data['room_id'] ?></td>
                </tr>
                <tr>
                    <td style="width:10%">Alamat</td>
                    <td class="colon">:</td>
                    <td style="width:40%"><?= $patient_data['sd_address'] ?></td>
                </tr>
                </table>
            </div>
        </div>
    </div>
    <!--div untuk menu utama-->
    <div class="row-fluid" style="margin-top:10px">
        <div class="span12">
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" style="background-color:white;padding-left:0px;margin-left:0px;" >
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding-left:0px;margin-left:0px;">
                    <li id="vitalSign" class="ui-state-default ui-corner-top ui-state-active ui-tabs-selected"><a href="javascript:void(0)">Vital Sign</a></li>
                    <li id="tab_rekmed" class="ui-state-default ui-corner-top"><a href="javascript:void(0)">Rekam Medis</a></li>
                    <li id="physicianVisit" class="ui-state-default ui-corner-top"><a href="javascript:void(0)">Visite Dokter</a></li>
                    <li id="nursingPlan" class="ui-state-default ui-corner-top"><a href="javascript:void(0)">Keperawatan</a></li>
                    <li id="returnedMedicine" class="ui-state-default ui-corner-top"><a href="javascript:void(0)">Retur Obat</a></li>
                    <li id="examinationHistory" class="ui-state-default ui-corner-top"><a href="javascript:void(0)">Riwayat Pemeriksaan</a></li>
                </ul>
                <div id="page" style="padding:5px;"></div>
            </div>
        </div>
    </div>
</div>

<div id="modalRoomOptions" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3></h3>
    </div>
    <div class="modal-body" style="max-height:none;min-height:250px">
        <?=form_open('',array('class' => 'form form-horizontal'))?>
        <label class="control-label">Nama Pasien : </label>
        <div class="controls">
            <label style="margin-top:3px"><?= $patient->sd_name ?>,<?= $patient->sd_title ?></label>
        </div>
        <label class="control-label">Kelas : </label>
        <div class="controls">
            <select id="class" name="class" class="chosen-select input-large">
                <option value="" selected="selected">-- Pilih Kelas --</option>
                <?php if (!empty($classes)) : ?>
                    <?php foreach ($classes as $class) : ?>
                        <option value="<?= $class->class_id ?>"><?= $class->class_name ?> - <?php echo int_to_money($class->price) ?></option>
                    <?php endforeach ?>
                <?php endif; ?>
            </select>
        </div>
        <label class="control-label">Kamar : </label>
        <div class="controls">
            <select id="rooms" name="rooms" class="chosen-select input-large">
                <option value="" selected="selected">-- Pilih Kamar --</option>
            </select>
        </div>
        <label class="control-label">Paviliun : </label>
        <div class="controls">
            <label style="margin-top:3px"><span id='pavillion'>-</span></label>
        </div>
        <?=form_close()?>
    </div>
    <div class="modal-footer">
        <a href="#" id="modalRoomOptionsConfirm" class="btn btn-primary">Confirm</a>
        <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>

<!-- Modal Register Rad -->
<div id="modalregisterRad" class="modal hide fade" style="width:80%;left:30%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Pendaftaran Radiologi</h3>
    </div>
    <div class="modal-body row" style="overflow-y:auto;overflow-x:hidden;">
        <div class="row-fluid" style="display:none">
            <div class="span12">
                <div id="warning_rad"></div>
            </div>
        </div>
        <div class="span12">
        <?=form_open(base_url(),array('class' => 'form-horizontal','id' => 'form_daftar_rad')); ?>
            <input type="hidden" name="service_id" value="<?= $patient_data['service_id'] ?>">
            <input type="hidden" name="visit_id" value="<?=substr($patient_data['service_id'],3,8)?>">
            <input type="hidden" name="rad" value="yes">
            <input type="hidden" name="no_rekmed" value="<?= $patient_data['sd_rekmed'] ?>">
            <div class="row-fluid">
                <div style="padding:12px;">
                    <?php if( (isset($penunjang_rad)) && ($penunjang_rad->num_rows() >= 1) ) : ?>
                        <?php $countPenunjang = round($penunjang_rad->num_rows() / 2); $count = 1;?>
                        <?php foreach ($penunjang_rad->result() as $key => $value) :  ?>
                            <?php if($count == 1) :  ?>
                                <div class="row-fluid">
                            <?php endif;?>
                                <div class="span4">
                                    <input type="checkbox" class="checkbox penunjang_rad" name="penunjang[]" value="<?=$value->ds_id?>" id="penunjang_<?=$value->ds_id?>" /><label for="penunjang_<?=$value->ds_id?>" style="margin-left:5px;"> <?=$value->ds_name?></label>
                                    <input type="hidden" name="nama_penunjang[<?=$value->ds_id?>]" value="<?=$value->ds_name?>" id="nama_penunjang_<?=$value->ds_id?>" />
                                    <input type="hidden" name="harga[<?=$value->ds_id?>]" value="<?=$value->ds_price?>" id="harga_<?=$value->ds_id?>" />
                                    <input type="hidden" name="type[<?=$value->ds_id?>]" value="rad" id="type_<?=$value->ds_id?>" />
                                </div>
                            <?php if($count == 3) :?>
                                </div>
                                <?php $count = 0;?>
                            <?php endif;?>
                            <?php $count++;?>
                        <?php endforeach; ?>
                        <?php if($count <= 3) :?>
                            </div>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        <?=form_close()?>
        <!--/div></div-->
    </div>
    <div class="modal-footer">
       <span class="warning_rad alert alert-error" style="display:none;float: left; margin-bottom: 0px;"></span>
        <button class="btn btn-primary confirmdaftarrad">Daftarkan Pasien ke Radiologi</button>
        <button class="btn" data-dismiss="modal">Batal</button>
    </div>
</div>
<!-- Modal Register Lab -->
<div id="modalregisterLab" class="modal hide fade" style="width:80%;left:30%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Pendaftaran Laboratorium</h3>
    </div>
    <div class="modal-body row" style="overflow-y:auto;overflow-x:hidden;">
        <div class="row-fluid" style="display:none">
            <div class="span12">
                <div id="warning_rad"></div>
            </div>
        </div>
        <div class="span12">
            <?=form_open(base_url(),array('class' => 'form-horizontal','id' => 'form_daftar_lab')); ?>
                <input type="hidden" name="service_id" value="<?= $patient_data['service_id'] ?>">
                <input type="hidden" name="visit_id" value="<?=substr($patient_data['service_id'],3,8)?>">
                <input type="hidden" name="lab" value="yes">
                <input type="hidden" name="no_rekmed" value="<?= $patient_data['sd_rekmed'] ?>">
                <div class="row-fluid">
                    <div style="padding:12px;">
                        <?php if( (isset($penunjang_lab)) && ($penunjang_lab->num_rows() >= 1) ) : ?>
                            <?php $countPenunjang = round($penunjang_lab->num_rows() / 2); $count = 1;?>
                            <?php foreach ($penunjang_lab->result() as $key => $value) :  ?>
                                <?php if($count == 1) :  ?>
                                    <div class="row-fluid">
                                <?php endif;?>
                                    <div class="span4">
                                        <input type="checkbox" class="checkbox penunjang_lab" name="penunjang[]" value="<?=$value->ds_id?>" id="penunjang_<?=$value->ds_id?>" /><label for="penunjang_<?=$value->ds_id?>" style="margin-left:5px;"> <?=$value->ds_name?></label>
                                        <input type="hidden" name="nama_penunjang[<?=$value->ds_id?>]" value="<?=$value->ds_name?>" id="nama_penunjang_<?=$value->ds_id?>" />
                                        <input type="hidden" name="harga[<?=$value->ds_id?>]" value="<?=$value->ds_price?>" id="harga_<?=$value->ds_id?>" />
                                        <input type="hidden" name="type[<?=$value->ds_id?>]" value="lab" id="type_<?=$value->ds_id?>" />
                                    </div>
                                <?php if($count == 3) :?>
                                    </div>
                                    <?php $count = 0;?>
                                <?php endif;?>
                                <?php $count++;?>
                            <?php endforeach; ?>
                            <?php if($count <= 3) :?>
                                </div>
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                </div>
            <?=form_close()?>
            <!--/div-->
    </div>
    <div class="modal-footer">
       <span class="warning_lab alert alert-error" style="display:none;float: left; margin-bottom: 0px;"></span>
        <button class="btn btn-primary confirmdaftarlab">Daftarkan Pasien ke Laboratorium</button>
        <button class="btn" data-dismiss="modal">Batal</button>
    </div>
</div>

<?php $this->load->view('notice') ?>

<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">
<script src="<?= base_url() ?>assets/js/jquery.chosen.js"></script>
<script src="<?=base_url()?>assets/js/jquery.datetimepicker.js"></script>
<script>
    $(document).ready(function () {
        $('.row-fluid:eq(0),#warning,#patientData').hide();
        $('.ui-state-default').click(function () {
            $('.ui-state-default').removeClass('ui-state-active ui-tabs-selected');
            $(this).addClass('ui-state-active ui-tabs-selected');
        });
        //hendri, 18 februari 2015
        $('#tab_rekmed').click(function () {
            $('#page').load('<?=base_url("rawat_inap/rekam_medis/$sd_rekmed")?>');
        });
        //======================
        $('#vitalSign').click(function () {
            $('#page').load('<?= base_url() ?>rawat_inap/vital_sign/' + '<?= $patient_data['service_id'] ?>');
        });

        $('#physicianVisit').click(function () {
            $('#page').load('<?= base_url() ?>rawat_inap/visite_dokter/' + '<?= $patient_data['service_id'] ?>');
        });

        $('#nursingPlan').click(function () {
            $('#page').load('<?= base_url() ?>rawat_inap/perencanaan_keperawatan/' + '<?= $patient_data['service_id'] ?>');
        });

        $('#examinationHistory').click(function () {
            $('#page').load('<?= base_url() ?>rawat_inap/riwayat_pemeriksaan/' + '<?= $patient_data['service_id'] ?>');
        });

        $('#returnedMedicine').click(function () {
            $('#page').load('<?= base_url() ?>rawat_inap/daftar_obat/' + '<?= $patient_data['service_id'] ?>');
        });

        $("#vitalSign").trigger('click');

        $('.patient-data-container .title').click(function(){
            if($('#patientData').is(':visible')){
                $('.title').find('i').removeClass('icon-chevron-up').addClass('icon-chevron-down');
            }else{
                $('.title').find('i').removeClass('icon-chevron-down').addClass('icon-chevron-up');
            }
            $('#patientData').toggle({'drop': 'down'});
        });

        $('#checkOut').live('click',function(e){
            e.preventDefault();
            var url = '<?=base_url()?>rawat_inap/checkout/<?= $patient_data['service_id'] ?>'
            $.post(url,function(response){
                response = JSON.parse(response);
                if ("success" === response.success) {
                    $('.row-fluid:eq(0)').show('fast',function(){
                        $('#warning').removeClass().addClass('alert alert-success').html('Proses checkout berhasil').fadeIn().delay(2000).fadeOut(function(){
                            $('.row-fluid:eq(0),#warning').hide('fast',function(){
                                location.href = '<?=base_url()?>rawat_inap/';
                            });
                        });
                    });
                }else{
                    $('.row-fluid:eq(0)').show('fast',function(){
                        $('#warning').removeClass().addClass('alert alert-error').html('Proses checkout gagal. Pasien masih memiliki tanggungan pembayaran.').fadeIn().delay(2000).fadeOut(function(){
                            $('.row-fluid:eq(0),#warning').hide('fast');
                        });
                    });
                }
            });
        });

        $("#labRegistration").click(function(){
            $("#modalregisterLab").modal();
        });
        $("#radRegistration").click(function(){
            $("#modalregisterRad").modal();
        });

        $('.confirmdaftarlab').click(function(){
            mdc_id = '<?= $patient_data['service_id'] ?>';
            visit_id = mdc_id.substring(3, 8);
            var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/'+mdc_id+'/LB';
            data = $('#form_daftar_lab').serialize();
            $.post(url,data,function(response){
                console.log(response);
                response = JSON.parse(response);
                if ("success" === response.success) {
                    $('.row-fluid:eq(0)').show('fast',function(){
                        $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran Laboratorium berhasil.').fadeIn().delay(3000).fadeOut(function(){
                            $('.row-fluid:eq(0),#warning').hide('fast');
                        });
                    });
                    $('#modalregisterLab').modal('hide');
                }else{
                    $('.row-fluid:eq(0)').show('fast',function(){
                        $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(3000).fadeOut(function(){
                            $('.row-fluid:eq(0),#warning').hide('fast');
                        });
                    });
                    $('.warning_lab').html('<b>Pasien telah terdaftar di Laboratorium</b>').fadeIn();
                }
            });
            return false;
        });

        $('.confirmdaftarrad').click(function(){
            mdc_id = '<?= $patient_data['service_id'] ?>';
            visit_id = mdc_id.substring(3, 8);
            var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/'+mdc_id+'/RD';
            data = $('#form_daftar_rad').serialize();
            $.post(url,data,function(response){
                console.log(response);
                response = JSON.parse(response);
                if ("success" === response.success) {
                    $('.row-fluid:eq(0)').show('fast',function(){
                        $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran Radiologi berhasil.').fadeIn().delay(3000).fadeOut(function(){
                            $('.row-fluid:eq(0),#warning').hide('fast');
                        });
                    });
                    $('#modalregisterRad').modal('hide');
                }else{
                    $('.row-fluid:eq(0)').show('fast',function(){
                        $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(3000).fadeOut(function(){
                            $('.row-fluid:eq(0),#warning').hide('fast');
                        });
                    });
                    $('.warning_rad').html('<b>Pasien telah terdaftar di Radiologi</b>').fadeIn();
                }
            });
            return false;
        });

        // $('#labRegistration').live('click',function(e){
        //     e.preventDefault();
            // var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/<?= $patient_data['service_id'] ?>/LB'
        //     $.post(url,function(response){
        //         response = JSON.parse(response);
        //         if ("success" === response.success) {
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran laboratorium berhasil').fadeIn().delay(2000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });
        //         }else{
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(2000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });
        //         }
        //     });
        // });

        // $('#radRegistration').live('click',function(e){
        //     e.preventDefault();
        //     var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/<?= $patient_data['service_id'] ?>/RD'
        //     $.post(url,function(response){
        //         response = JSON.parse(response);
        //         if ("success" === response.success) {
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran radiologi berhasil').fadeIn().delay(2000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });
        //         }else{
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(2000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });
        //         }
        //     });
        // });

        /* Fungsi untuk pemindahan kamar */

        $('#roomOptions').live('click',function(e){
            e.preventDefault();
            $.post('<?=base_url()?>rawat_inap/room_options',
                {
                    '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash();?>',
                    'service_id' : '<?=$patient_data['service_id']?>',
                    //'class_id' : '<?=$patient_data['class_id']?>',
                    'patient_medrec' : '<?=$patient_data['sd_rekmed']?>'
                },
            function(result){
                    $('#modalRoomOptions .modal-header h3').empty().html('Pemindahan Kamar');
                    $('#modalRoomOptions .modal-body').empty().html(result);
            });

            $('#modalRoomOptions').modal({
                backdrop : 'static'
            });
        });

        $('#modalRoomOptionsConfirm').click(function() {
            $.post('<?=base_url()?>rawat_inap/change_room',
              {
                '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash();?>',
                'service_id' : '<?=$patient_data['service_id']?>',
                'room' : $('#rooms').val()
              },
              function (result) {
                $('#modalRoomOptions').hide();
              }
            )
        });

        /* Akhir fungsi untuk pemindahan kamar */
    });
</script>