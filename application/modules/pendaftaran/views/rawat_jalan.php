<style>
    .widget-box>label{margin-left:5px;margin-right:5px;}
</style>
<div class="row-fluid">
    <div class="span9">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    </h5><i class="icon-th-list"></i></h5>
                </span>
                <h5>Rawat Jalan</h5>
            </div>
            <?php //echo form_open(base_url() . 'pendaftaran/antri_poli', array('class' => 'form-horizontal', 'id' => 'registrationFinal')); ?>
            <?= form_hidden('no_rekmed', $patient->sd_rekmed) ?>
            <?= form_hidden('is_new_patient', $is_new_patient) ?>
            <?= form_hidden('request_new_card', $is_new_patient ? 1 : 0) ?>
            <label class="control-label">No.Rekam Medis</label>
            <div class="controls">
                <label style="margin-top:3px"><?= $patient->sd_rekmed ?></label>
            </div>
            <label class="control-label">Nama Pasien</label>
            <div class="controls">
                <label style="margin-top:3px"><?= $patient->sd_name ?></label>
            </div>
            <label class="control-label">Poli</label>
            <div class="controls">
                <select id="poli1" name="poli[]" class="chosen-select input-large">
                    <option value="" selected="selected">-- Pilih Poli --</option>
                    <?php foreach ($poly as $key) : ?>
                        <option value="<?= $key->pl_id ?>"><?= $key->pl_name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <label class="control-label">Dokter Jaga</label>
            <div class="controls">
                <select id="physician1" name="physician[]" class="chosen-select input-large">
                    <option value="" selected="selected">-- Pilih Dokter --</option>
                    <?php if (!empty($physicians)) : ?>
                        <?php foreach ($physicians as $physician) : ?>
                            <option value="<?= $physician->id_employe ?>"><?= $physician->sd_name ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
            <div id="morePoli">
                
            </div>
            <div class="controls">
                <button type="button" class="btn btn-warning btn-small add"><i class='icon-plus icon-white icon-small'></i></button>
            </div>
           <!--  <div class="form-actions">
                <input type='button' id="regFinish" class=" btn btn-primary pull-right" value="Selesai" disabled="">
            </div> -->
        </div>
    </div>
    <div class="span3">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    </h5><i class="icon-th-list"></i></h5>
                </span>
                <h5>Keterangan Biaya</h5>
            </div>
            <?php if ($is_new_patient) : ?>
                <label class="registrationFee">
                    <i class="icon-ok"></i> &nbsp;
                    Biaya Pendaftaran
                </label>
            <?php endif; ?>
            <label class="memberCard">
                <?php if ($is_new_patient) : ?>
                    <i class="icon-ok"></i> &nbsp;
                <?php else : ?>
                    <input type="checkbox" name="memberCard" id="memberCard" value="1">
                <?php endif; ?>
                Biaya Kartu
            </label>
            <label class="physicianFee">
                <i class="icon-ok"></i> &nbsp;
                Biaya Jasa Dokter
            </label>
        </div>        
    </div>
</div>

<script>
    var poli, physician;
    var countPoli = 1;
    var poliOption = '';
        <?php foreach ($poly as $key) : ?>
            poliOption += '<option value="<?= $key->pl_id ?>"><?=$key->pl_name ?></option>';
        <?php endforeach ?>;
     var dokterOption = '';
        <?php if (!empty($physicians)) : ?>
            <?php foreach ($physicians as $physician) : ?>
                dokterOption += '<option value="<?= $physician->id_employe ?>"><?= $physician->sd_name ?></option>';
            <?php endforeach ?>
        <?php endif; ?>
    $(document).ready(function() {
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $('#memberCard').click(function() {
            if ($('#memberCard').is(':checked')) {
                $('input[name=request_new_card]').val(1);
            } else {
                $('input[name=request_new_card]').val(0);
            }
        });

        $("#poli1").change(function() {
            poli = ($("#poli1").val());
            if (poli !== "") {
                $.get("<?= base_url() ?>pendaftaran/getPhysician/" + poli, function(result) {
                    result = JSON.parse(result);
                    $('#physician').val(result.physician.id).trigger("liszt:updated");
                });

                $.get("<?= base_url() ?>pendaftaran/getSchedule/" + poli, function(result) {
                    $('#addOnContainer').html(result);
                });
            }else{
                $('#addOnContainer').html("");
            }
            allowToFinish();
        });

        $('#physician1').change(function() {
            allowToFinish();
        });

        $(".add").click(function(){
            countPoli++;
            var text = '<hr><label class="control-label">Poli</label><div class="controls">' +
                            '<select id="poli'+countPoli+'" name="poli[]" class="chosen-select input-large">'+
                                '<option value="" selected="selected">-- Pilih Poli --</option>'+
                                    poliOption+
                            '</select>'+
                        '</div>';
                text += '<label class="control-label">Dokter Jaga</label><div class="controls">' +
                            '<select id="physician'+countPoli+'" name="physician[]" class="chosen-select input-large">'+
                                '<option value="" selected="selected">-- Pilih Dokter --</option>'+
                                dokterOption+
                            '</select>'+
                        '</div>';

            $("#morePoli").append(text);
            $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        });
        
    });
</script>