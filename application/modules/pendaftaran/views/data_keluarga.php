<style>
    .widget-box{margin-left:5px;margin-right:5px;}
</style>
<div class="page-content row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-th-list"></i>
                </span>
                <h5>Penanggung Jawab</h5>
            </div>
            <div class="widget-content">
                <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'familyForm')); ?>
                <?= form_hidden('sd_rekmed', $no_rekmed) ?>
                <label class="control-label">Nama Penanggung Jawab</label>
                <div class="controls">
                    <?php $value = !empty($family_data) ? $family_data['fm_name'] : '' ?>
                    <input type="text"  placeholder="Nama Penanggung Jawab" name="fm_name" value='<?= $value ?>'>
                </div>
                <label class="control-label">Jenis Kelamin</label>
                <?php
                $male_checked = $female_checked = '';
                if (!empty($family_data)) {
                    if ($family_data['fm_sex'] == 'L') {
                        $male_checked = 'checked';
                    } else if ($family_data['fm_sex'] == 'P') {
                        $female_checked = 'checked';
                    }
                }
                ?>
                <div class="controls">
                    <table>
                        <tr>
                            <td><label><input type="radio" name="fm_sex" value="L" <?= $male_checked ?>/> Laki-laki</label></td>
                            <td><label><input type="radio" name="fm_sex" value="P" <?= $female_checked ?>/> Perempuan</label></td>
                        </tr>
                    </table>
                </div>
                <label class="control-label">Hubungan Keluarga</label>
                <div class="controls">
                    <table>
                        <?php foreach ($family_rel as $index => $fmr) : ?>
                            <?php
                            if ($index == 0) {
                                echo "<tr>";
                            }
                            ?>
                            <?php
                            if ($index % 3 == 0 && $index != count($family_rel)) {
                                echo "</tr><tr>";
                            }
                            ?>
                            <?php
                            $checked = '';
                            if (!empty($family_data)) {
                                if ($family_data['fm_relation'] == $fmr->mfr_id) {
                                    $checked = 'checked';
                                }
                            }
                            ?>
                            <td><label><input type="radio" name="fm_relation" value="<?= $fmr->mfr_id ?>" <?= $checked ?>/> <?= $fmr->mfr_name ?></label></td>
                            <?php
                            if ($index == count($family_rel)) {
                                echo "</tr>";
                            }
                            ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <label class="control-label">Pendidikan</label>
                <div class="controls">
                    <table>
                        <?php foreach ($education as $index => $edu) : ?>
                            <?php
                            if ($index == 0) {
                                echo "<tr>";
                            }
                            ?>
                            <?php
                            if ($index % 3 == 0 && $index != count($education)) {
                                echo "</tr><tr>";
                            }
                            ?>
                            <?php
                            $checked = '';
                            if (!empty($family_data)) {
                                if ($family_data['fm_education'] == $edu->med_id) {
                                    $checked = 'checked';
                                }
                            }
                            ?>
                            <td><label><input type="radio" name="fm_education" value="<?= $edu->med_id ?>" <?= $checked ?>/> <?= $edu->med_name ?></label></td>
                            <?php
                            if ($index == count($education)) {
                                echo "</tr>";
                            }
                            ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <label class="control-label">Pekerjaan</label>
                <div class="controls">
                    <table>
                        <?php foreach ($occupation as $index => $ocu) : ?>
                            <?php
                            if ($index == 0) {
                                echo "<tr>";
                            }
                            ?>
                            <?php
                            if ($index % 3 == 0 && $index != count($occupation)) {
                                echo "</tr><tr>";
                            }
                            ?>
                            <?php
                            $checked = '';
                            if (!empty($family_data)) {
                                if ($family_data['fm_occupation'] == $ocu->oc_id) {
                                    $checked = 'checked';
                                }
                            }
                            ?>
                            <td><label><input type="radio" name="fm_occupation" value="<?= $ocu->oc_id ?>" <?= $checked ?>/> <?= $ocu->mo_name ?></label></td>
                            <?php
                            if ($index == count($occupation)) {
                                echo "</tr>";
                            }
                            ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php
                $value = !empty($family_data) ? $family_data['fm_address'] : '';
                $placeholder = $value == '' ? $patient_address : '';
                $checked = !empty($family_data) ? TRUE : FALSE;
                ?>
                <div id="address">
                    <label class="control-label">Alamat</label>
                    <div class="controls">
                        <textarea name="fm_address" id="fmAddress" rows="3" cols="2" placeholder="<?= $placeholder ?>"><?= $value ?></textarea>
                    </div>
                </div>
                <label class="control-label">No.Telp</label>
                <?php
                $value = !empty($family_data) ? $family_data['fm_phone'] : '';
                $placeholder = $value == '' ? $patient_phone : '';
                ?>
                <div class="controls">
                    <input name="fm_phone" type="text" placeholder="<?= $placeholder ?>" value='<?= $value ?>'>
                </div>                    
                <?= form_close() ?>
            </div>
        </div>
    </div>    
</div>
<div class='page_footer row-fluid'>
    <?= form_button(array('id' => 'fm_submit', 'class' => 'btn btn-primary', 'type' => 'submit', 'content' => 'Simpan')) ?>
</div>
<?= form_close() ?>

<?php $this->load->view('alert') ?>

<script>
    $(document).ready(function () {
        $('#no_rekmed').prop('disabled', true);
        $('#tabs>ul>li:eq(0)').removeClass('ui-state-active ui-tabs-selected');
        $('#tabs>ul>li:eq(1)').addClass('ui-state-active ui-tabs-selected');

        $('#fm_submit').die().live('click', function (e) {
            e.preventDefault();
<?php if (empty($family_data)) : ?>
                var url = "<?= base_url() ?>pendaftaran/tambah_data_keluarga";
<?php else : ?>
                var url = "<?= base_url() ?>pendaftaran/ubah_data_keluarga/" + <?= $no_rekmed ?>;
<?php endif ?>
            var data = $('#familyForm').serialize();
            $.post(url, data, function (response) {
                response = JSON.parse(response);
                if ("success" === response.success) {
                    $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function () {
<?php if ($is_edit) : ?>
                            location.href = "<?= base_url() ?>pendaftaran/";
<?php else : ?>
                            $('#page').load('<?= base_url() ?>pendaftaran/pilih_layanan/' + '<?= $no_rekmed ?>');
<?php endif ?>

                    });
                }
            });
        });
    });
</script>