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
            <label class="control-label">Kelas</label>
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
          <!--   <div class="form-actions">
                <input type='button' id="regFinish" class=" btn btn-primary pull-right" value="Selesai" disabled="">
            </div> -->
            <!--            <label class="control-label">Tipe Rujukan : </label>
                        <div class="controls">
                            <div id="refferalType">
                                <table>
                                    <tr>
                                        <td style="width:70px">
                                            <label>
            <?= form_radio(array('name' => 'refferal_type', 'value' => 'I')) ?> Internal
                                            </label>
                                        </td>
                                        <td style="width:70px">
                                            <label>
            <?= form_radio(array('name' => 'refferal_type', 'value' => 'E')) ?> External
                                            </label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="refferalContainer"></div>-->
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
        </div>
    </div>
</div>

<script>
    var rooms, roomClass, room;
    $(document).ready(function() {
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $('#memberCard').click(function() {
            if ($('#memberCard').is(':checked')) {
                $('input[name=request_new_card]').val(1);
            } else {
                $('input[name=request_new_card]').val(0);
            }
        });

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

//        $('#refferalType input[type=radio]').change(function() {
//            $('#refferalContainer').empty();
//            if ($(this).val() === 'I') {
//
//            } else if ($(this).val() === 'E') {
//                var html = '<label class="control-label">Asal Rujukan : </label><div class="controls">\n\
//                            ' + '<?= form_input(array('name' => 'refferal')) ?>' + '\n\
//                            </div>';
//                $('#refferalContainer').html(html);
//            }
//        });
    });
</script>