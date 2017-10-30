<div class="widget-box" style='padding: 10px;min-height:320px;'>
    <div class="widget-content nopadding">
        <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'picForm')); ?>
        <div class="control-group">
            <label class="control-label" style="vertical-align:top">Waktu Pemeriksaan </label>
            <div class="controls">
            <input type="text" name="datetime" class='datetime hasDatepicker'>
            </div>
        </div>
        <div class="control-group">
            <label class='control-label' style="vertical-align:top">Dokter  </label>
            <div class="controls">
            <select id="physician" name="physician" class="chosen-select">
                <option value="" selected="selected">-- Pilih Dokter --</option>
                <?php if (!empty($physicians)) : ?>
                    <?php foreach ($physicians as $physician) : ?>
                        <option value="<?= $physician['id_employe'] ?>"><?= $physician['sd_name'] ?></option>
                    <?php endforeach ?>
                <?php endif; ?>
            </select>
            </div>
        </div>
        <div class="control-group">

            <label class="control-label" style="vertical-align:top">Perawat  </label>
            <div class="controls">
            <select id="nurse" name="nurse" class="chosen-select">
                <option value="" selected="selected">-- Pilih Perawat --</option>
                <?php if (!empty($nurses)) : ?>
                    <?php foreach ($nurses as $nurse) : ?>
                        <option value="<?= $nurse['id_employe'] ?>"><?= $nurse['sd_name'] ?></option>
                    <?php endforeach ?>
                <?php endif; ?>
            </select>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.datetime').datetimepicker({
            format:'Y-m-d H:i',
            minDate:'<?=$service_in?>',
        });
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
    });
</script>