<div class="row-fluid">
    <div class="span9">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    </h5><i class="icon-th-list"></i></h5>
                </span>
                <h5>Rawat Jalan</h5>
            </div>
            <?php if(get_user('group_id') == '9') :?>
                <?= form_open(base_url() . 'pendaftaran/daftar_igd', array('class' => 'form-horizontal', 'id' => 'registrationFinal')); ?>
			<?php endif;?>
                <?= form_hidden('no_rekmed', $patient->sd_rekmed) ?>
                <?= form_hidden('is_new_patient', $is_new_patient ? 1 : 0) ?>
                <?= form_hidden('request_new_card', 0) ?>
                <label class="control-label">Jam Masuk</label>
                <div class="controls">
                   <input type='text' id='jam_masuk_igd' name="jam_masuk_igd">	
                </div>
     
                <label class="control-label">Dokter Jaga</label>
                <div class="controls">
                   <select id="physician" name="physician" class="chosen-select input-large">
                        <option value="" selected="selected">-- Pilih Dokter --</option>
                        <?php if (!empty($dokter_jaga_igd)) : ?>
                            <?php foreach ($dokter_jaga_igd as $physician) : ?>
                                <option value="<?= $physician->id_employe ?>"><?= $physician->sd_name ?></option>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
              <!--  <div class="form-actions">
                    <input type='button' id="regFinish" class=" btn btn-primary pull-right" value="Selesai" disabled="true">
                </div> -->

            <?php if(get_user('group_id') == '9') :?>
                <?= form_close() ?>
            <?php endif;?>

<script src="<?=base_url()?>assets/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">
<script type="text/javascript">
	
$(function(){
	$('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
	$('#regFinish').removeAttr('disabled');
	$('#jam_masuk_igd').datetimepicker({
		format:'Y-m-d H:i'
	});
    $('#regFinish').attr('disabled','disabled');

    $('#physician').change(function(){
        allowToFinish();
    })
    $('#jam_masuk_igd').change(function(){
        allowToFinish();
    })
});

</script>
