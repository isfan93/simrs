<!-- <style>.modal-body{max-height:none;min-height:300px}</style> -->
<div class="row-fluid">
    <div class="span12">
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
    </div>
</div>
<?=form_close()?>


<script>
    // var rooms, roomClass, room;
    $(document).ready(function() {
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $("#class").change(function() {
            roomClass = $(this).val();
            if ($(this).val() !== '') {
                $('#pavillion').html('-');
                $('#rooms').children().not(':first').remove();
                $('input[name=bed_id],input[name=pavillion_id]').val('');
                var $class = ($("#class").val());
                $.get("<?= base_url() ?>pendaftaran/getRoom/" + $class, function(result) {
                    rooms = JSON.parse(result);
                    var roomOptions = '';
                    var roomNumber = 0;
                    $(rooms).each(function(index, value) {
                        if (value.room_id !== roomNumber) {
                            roomOptions += '<option value="' + index + '-' + value.pavillion_id + '-' + value.room_id + '-' + value.bed_id + '">Kamar No. ' + value.room_id + '<option>';
                            roomNumber = value.room_id;
                        }
                    });
                    $('#rooms').append(roomOptions).trigger("liszt:updated");
                });
            }
            allowToFinish();
        });

        $('#rooms').change(function() {
            room = $(this).val();
            if ($(this).val() !== '') {
                var selected = $(this).val().split('-');
                var pavillionName = rooms[parseInt(selected[0])].pavillion_name;
                $('#pavillion').html(pavillionName);
            } else {
                $('#pavillion').html('-');
            }
            allowToFinish();
        });
});
</script>