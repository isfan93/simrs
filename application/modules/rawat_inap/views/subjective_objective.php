<style>
    textarea{width:500px;}
</style>
<div class="widget-box" style='padding: 10px;min-height:250px;'>
    <div class="widget-content">
        <?= form_open('#', array('id' => 'subObjForm')) ?>
        <div class="control-group">
            <label class="control-label" for="subjective">Subjective</label>
            <div class="controls">
                <textarea name="subjective" id="subjective" placeholder="Keluhan Pasien"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="objective">Objective</label>
            <div class="controls">
                <textarea name="objective" id="objective" placeholder="Hasil Pemeriksaan Fisik"></textarea>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>