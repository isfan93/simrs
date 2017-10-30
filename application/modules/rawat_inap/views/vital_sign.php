<div class="widget-box" style='padding: 10px;min-height:250px;'>
    <div class="widget-content nopadding">
        <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'vitalSignForm')) ?>
        <div class="control-group">
            <label class="control-label" for="bloodType">Waktu Pemeriksaan</label>
            <div class="controls">
                <input type="text" name="vs[datetime]" id="dateTime" class="hasDatepicker" style="width:20px">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="bloodType">Golongan Darah</label>
            <div class="controls">
                <input type="text" name="vs[blood_type]" id="bloodType" style="width:20px" value="<?= $vital_sign['blood_type'] ?>" disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Berat / Tinggi Badan</label>
            <div class="controls">
                <label>
                    <?php $value = isset($vital_sign['ptn_medical_weight']) ? $vital_sign['ptn_medical_weight'] : ''?>
                    <input type="text" name="vs[weight]" id="weight" style="width:20px" value="<?=$value?>">
                    <?php $value = isset($vital_sign['ptn_medical_height']) ? $vital_sign['ptn_medical_height'] : ''?>
                    <input type="text" name="vs[height]" id="height" style="width:20px" value="<?=$value?>"> Kg / Cm
                </label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="consciousness">Kesadaran</label>
            <div class="controls">
                <?php $value = isset($vital_sign['ptn_medical_kesadaran']) ? $vital_sign['ptn_medical_kesadaran'] : ''?>
                <input type="text" name="vs[consciousness]" id="consciousness" style="width:20px" value="<?=$value?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="bloodPressure">Tekanan Darah</label>
            <div class="controls">
                <label>
                    <?php $value = isset($vital_sign['ptn_medical_blod_sy']) ? $vital_sign['ptn_medical_blod_sy'] : ''?>
                    <input type="text" name="vs[blood_pressure][systole]" id="bloodPressure" style="width:30px" value="<?=$value?>">
                    <?php $value = isset($vital_sign['ptn_medical_blod_ds']) ? $vital_sign['ptn_medical_blod_ds'] : ''?>
                    <input type="text" name="vs[blood_pressure][diastole]" style="width:30px" value="<?=$value?>"> mm/Hg
                </label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="pulse">Nadi</label>
            <div class="controls">
                <?php $value = isset($vital_sign['ptn_medical_nadi']) ? $vital_sign['ptn_medical_nadi'] : ''?>
                <label><input type="text" name="vs[pulse]" id="pulse" style="width:30px" value="<?=$value?>"> BPM</label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="respirationRate">Respiration Rate</label>
            <div class="controls">
                <?php $value = isset($vital_sign['ptn_medical_respirationrate']) ? $vital_sign['ptn_medical_respirationrate'] : ''?>
                <label><input type="text" name="vs[respiration_rate]" id="respirationRate" style="width:30px" value="<?=$value?>"> BPM</label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="temperature">Temperature</label>
            <div class="controls">
                <?php $value = isset($vital_sign['ptn_medical_temperatur']) ? $vital_sign['ptn_medical_temperatur'] : ''?>
                <label><input type="text" name="vs[temperature]" id="temperature" style="width:30px" value="<?=$value?>"> &deg;C</label>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<div class='page_footer row-fluid'>
    <?= form_button(array('data-url' => base_url().'rawat_inap/simpan_vital_sign/'.$this->uri->segment(3),'class' => 'btn btn-primary', 'id' => 'submitVS' , 'type' => 'submit', 'content' => 'Simpan')) ?>
</div>

<script>
    $(document).ready(function(){
        $('#dateTime').datetimepicker({
            format:'Y-m-d H:i',
            minDate:'<?=$service_in?>',
        });
    });
    $('#submitVS').die().live('click', function (e) {
        e.preventDefault();
        var data = $('#vitalSignForm').serialize();
        //data += '&' + $('#subObjForm').serialize();
        //data += '&' + $('#diagnoseForm').serialize();
        //data += '&' + $('#prescriptionForm').serialize();
        var url = $(this).attr('data-url');
        $.post(url, data, function (response) {
            response = JSON.parse(response);
            if ("success" === response.success) {
                $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function () {
                    location.reload(true);
                });
            }
        });
    });
</script>