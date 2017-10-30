<?php if (!isset($social_data) || empty($social_data)) : ?>
    <div id="alertContainer" class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="alert alert-info">
                    <p style="font-size:14px;">Pasien tidak ditemukan. Ulangi pencarian dengan memakai fitur pencarian spesifik atau <a href="javascript:void(0);" id="showRegistration" style="color:#3a87ad;text-decoration:underline"> daftarkan sebagai pasien baru.</a></p>
                </div>
            </div>            
        </div>        
        <script>
            $(document).ready(function() {
                $('#registrationContainer').hide();
                $('#showRegistration').click(function() {
                    $('#registrationContainer').toggle();
                });
            });
        </script>
    </div>
<?php endif; ?>
<div id="registrationContainer" class="container-fluid">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/NOTTB___.css">
    <style>
        li{display:inline}
        .list{margin-bottom: 10px !important;
              margin-left: 10px !important;
              min-width: 78px !important;
        }
        .barcode-container{
            font-family: 'NOTTB';
            font-size : 9px;
            text-align: center;
            padding:10px;
            border : 1px solid #cdcdcd;
            margin-bottom: 5px;
            width : 150px;
        }  
    </style>
    <div class="row-fluid">
        <div class="span12">
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" style="background-color:white;padding-left:0px;margin-left:0px;" >
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding-left:0px;margin-left:0px;">
                    <li class="ui-state-default ui-corner-top"><a href="javascript:void(0);">Data Sosial Pasien</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="javascript:void(0);">Data Penanggung Jawab</a></li>
                    <?php if (!isset($is_edit)) : ?>
                        <li class="ui-state-default ui-corner-top"><a href="javascript:void(0);">Pilih Layanan</a></li>
                    <?php endif; ?>
                </ul>
                <div id="page">
                    <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'newPatientForm')); ?>
                    <div class='page_content row-fluid'>
                        <div class="span5">
                            <label class="control-label">No. Kartu *)</label>
                            <?php $value = (isset($social_data) || !empty($social_data)) ? $social_data['sd_card_number'] : ""; ?>
                            <div class="controls">
                                <?= form_input(array('name' => 'ds[sd_card_number]', 'id' => 'sd_card_number', 'value' => $value, 'placeholder' => 'No. Kartu Pasien')) ?>
                            </div>
                            <label class="control-label">No. Rekam Medis</label>
                            <?php
                            $value = isset($social_data) || !empty($social_data) ? $social_data['sd_rekmed'] : $medical_record;
                            ?>
                            <div class="controls">
                                <input type="text" id="sd_rekmed" name="ds[sd_rekmed]" value="<?= $value ?>" readonly="readonly">
                            </div>
                            <label for="sd_name" class="control-label">Nama Pasien *)</label>
                            <div class="controls">
                                <table>
                                    <tr>
                                        <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_title'] : ""; ?>
                                        <td style="width:50px"><?= form_dropdown('ds[sd_title]', array('-' => '-', 'Tn' => 'Tn', 'Ny' => 'Ny', 'Nn' => 'Nn'), $value, 'style="width:50px"') ?></td>
                                        <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_name'] : ""; ?>
                                        <td><input type="text"  placeholder="Nama Pasien" id="sd_name" name="ds[sd_name]" value="<?= $value ?>"></td>
                                    </tr>
                                </table>
                            </div>
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <table>
                                    <tr>
                                        <?php
                                        $male_checked = $female_checked = '';
                                        if (isset($social_data) || !empty($social_data)) {
                                            if ($social_data['sd_sex'] == 'L') {
                                                $male_checked = 'checked';
                                            } else if ($social_data['sd_sex'] == 'P') {
                                                $female_checked = 'checked';
                                            }
                                        }
                                        ?>
                                        <td style="width:100px"><label for="sd_sex_m"><input type="radio" id="sd_sex_m" name="ds[sd_sex]" value="L" <?= $male_checked ?>/> Laki-laki</label></td>
                                        <td style="width:100px"><label for="sd_sex_f"><input type="radio" id="sd_sex_f" name="ds[sd_sex]" value="P" <?= $female_checked ?> /> Perempuan</label></td>
                                    </tr>
                                </table>
                            </div>
                            <label for="sd_place_of_birth" class="control-label">Tempat Lahir *)</label>
                            <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_place_of_birth'] : ""; ?>
                            <div class="controls">
                                <input type="text" id="sd_place_of_birth" name="ds[sd_place_of_birth]" value="<?= $value ?>"  placeholder="Tempat Lahir">
                            </div>
                            <label class="control-label">Tgl Lahir</label>
                            <?php
                            if (isset($social_data) || !empty($social_data)) {
                                $date_explode = explode('-', $social_data['sd_date_of_birth']);
                                $day = $date_explode[2];
                                $month = $date_explode[1];
                                $year = $date_explode[0];
                            } else {
                                $day = $month = $year = '';
                            }
                            ?>
                            <div class="controls">
                                <select  name="tgl[0]" style="min-width:30px;width:90px" style="float:left" id="tgl" class="chosen-select">
                                    <option value="" >-- tgl --</option>
                                    <?= get_hari($day) ?>
                                </select>
                                <select name="tgl[1]" style="width:90px" id="bln" class="chosen-select">
                                    <option value="">-- bln --</option>
                                    <?= get_bulan($month) ?>
                                </select>
                                <select name="tgl[2]" style="width:90px" id="thn" class="chosen-select">
                                    <option value="">-- thn --</option>
                                    <?= get_tahun($year) ?>
                                </select>
                                <label for="tgl" generated="true" class="error"></label>
                            </div>
                            <label for="sd_age" class="control-label">Usia *)</label>
                            <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_age'] : ""; ?>
                            <div class="controls">
                                <input type="text" style="width:40px" id="usia" value="<?= $value ?>" id="sd_age" name="ds[sd_age]" placeholder="0"> Tahun
                            </div>
                            <label class="control-label">Gol.Darah</label>
                            <?php
                            $none_checked = $a_checked = $b_checked = $ab_checked = $o_checked = '';
                            if (isset($social_data) || !empty($social_data)) {
                                switch ($social_data['sd_blood_tp']) {
                                    case '-' : $none_checked = 'checked';
                                        break;
                                    case 'A' : $a_checked = 'checked';
                                        break;
                                    case 'B' : $b_checked = 'checked';
                                        break;
                                    case 'AB' : $ab_checked = 'checked';
                                        break;
                                    case 'O' : $o_checked = 'checked';
                                        break;
                                }
                            }
                            ?>
                            <div class="controls">
                                <table>
                                    <tr>
                                        <td style="width:100px"><label for="sd_blood_tp_none"><input type="radio" id="sd_blood_tp_-" name="ds[sd_blood_tp]" value="-" <?= $none_checked ?>/> -</label></td>
                                        <td style="width:100px"><label for="sd_blood_tp_a"><input type="radio" id="sd_blood_tp_a" name="ds[sd_blood_tp]" value="A" <?= $a_checked ?> /> A</label></td>
                                        <td style="width:100px"><label for="sd_blood_tp_b"><input type="radio" id="sd_blood_tp_b" name="ds[sd_blood_tp]" value="B" <?= $b_checked ?>/> B</label></td>
                                    </tr>
                                    <tr>
                                        <td style="width:100px"><label for="sd_blood_tp_ab"><input type="radio" id="sd_blood_tp_ab" name="ds[sd_blood_tp]" value="AB" <?= $ab_checked ?>/> AB</label></td>
                                        <td style="width:100px"><label for="sd_blood_tp_o"><input type="radio" id="sd_blood_tp_o" name="ds[sd_blood_tp]" value="O" <?= $o_checked ?> /> O</label></td>
                                    </tr>
                                </table>
                            </div>
                            <label for="sd_reg_street" class="control-label">Dusun/Kampung/Jln</label>
                            <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_reg_street'] : ""; ?>
                            <div class="controls">
                                <input type="text" id="sd_reg_street" name="ds[sd_reg_street]" value="<?= $value ?>" placeholder="Dusun/Kampung/Jln">
                            </div>
                            <label class="control-label">&nbsp;</label>
                            <?php
                            $rt = $rw = '';
                            if (isset($social_data) || !empty($social_data)) {
                                if ($social_data['sd_rt_rw'] != NULL) {
                                    $area = explode('/', $social_data['sd_rt_rw']);
                                    $rt = $area[0];
                                    $rw = $area[1];
                                }
                            }
                            ?>
                            <div class="controls">
                                <table style="width:156px">
                                    <tr>
                                        <td style="width:4%">
                                            <label>RT</label>
                                        </td>
                                        <td style="width:10px">
                                            <label for="rt"><input type="text" id="rt" name="rt[0]" placeholder="RT" value="<?= $rt ?>" style="width:40px"></label>
                                        </td>
                                        <td style="width:4%">
                                            <label>RW</label>
                                        </td>
                                        <td style="width:10px">
                                            <label for="rw"><input type="text" id="rw" name="rt[1]" placeholder="RW" value="<?= $rw ?>" style="width:40px"></label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <label for="sd_reg_desa" class="control-label">Kelurahan/Desa</label>
                            <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_reg_desa'] : ""; ?>
                            <div class="controls">
                                <input type="text" id="sd_reg_desa" name="ds[sd_reg_desa]" value="<?= $value ?>" id="desa" placeholder="Kelurahan/Desa">
                            </div>
                            <label for="sd_reg_kec" class="control-label">Kecamatan</label>
                            <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_reg_kec'] : ""; ?>
                            <div class="controls">
                                <input type="text" id="sd_reg_kec" name="ds[sd_reg_kec]" value="<?= $value ?>" id="kec" placeholder="Kecamatan">
                            </div>
                            <label for="sd_reg_kab" class="control-label">Kabupaten/Kotamadya</label>
                            <div class="controls">
                                <select id="sd_reg_kab" name="ds[sd_reg_kab]" class="chosen-select">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    <?php foreach ($regency as $key) : ?>
                                        <?php if (isset($social_data) || !empty($social_data)) : ?>
                                            <?php if ($social_data['sd_reg_kab'] == $key->mre_id) : ?>
                                                <option value="<?= $key->mre_id ?>" selected='selected'><?= $key->mre_name ?></option>
                                            <?php else : ?>
                                                <option value="<?= $key->mre_id ?>"><?= $key->mre_name ?></option>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <option value="<?= $key->mre_id ?>"><?= $key->mre_name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <label for="sd_reg_prov" class="control-label">Provinsi</label>
                            <?php
                            $province_id = $province_name = '';
                            if (isset($social_data) || !empty($social_data)) {
                                $key = array_keys($province);
                                if ($province[$key[0]] !== FALSE) {
                                    $province_id = $province['mpr_id'];
                                    $province_name = $province['mpr_name'];
                                }
                            }
                            ?>
                            <div class="controls">
                                <input type="text" id="sd_reg_prov" value='<?= $province_name ?>' placeholder="Provinsi" readonly>
                                <?= form_hidden('ds[sd_reg_prov]', $province_id) ?>
                            </div>
                            <label for="sd_telp" class="control-label">No.Telp *)</label>
                            <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_telp'] : ""; ?>
                            <div class="controls">
                                <input type="text" id="sd_telp" name="ds[sd_telp]" value="<?= $value ?>" placeholder="No.Telp">
                            </div>
                        </div>
                        <div class="span4">
                            <label class="control-label">Warga Negara</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?php foreach ($nationality as $key): ?>
                                        <?php if (isset($social_data) || !empty($social_data)) : ?>
                                            <?php if ($social_data['sd_citizen'] == $key->mna_id) : ?>
                                                <li class='list'><label for="sd_citizen_<?= $key->mna_id ?>"><input type="radio" id="sd_citizen_<?= $key->mna_id ?>" name="ds[sd_citizen]" value="<?= $key->mna_id ?>" checked/><?= $key->mna_name ?></label></li>
                                            <?php else : ?>
                                                <li class='list'><label for="sd_citizen_<?= $key->mna_id ?>"><input type="radio" id="sd_citizen_<?= $key->mna_id ?>" name="ds[sd_citizen]" value="<?= $key->mna_id ?>" /><?= $key->mna_name ?></label></li>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <li class='list'><label for="sd_citizen_<?= $key->mna_id ?>"><input type="radio" id="sd_citizen_<?= $key->mna_id ?>" name="ds[sd_citizen]" value="<?= $key->mna_id ?>" /><?= $key->mna_name ?></label></li>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?php foreach ($marital_status as $key): ?>
                                        <?php if (isset($social_data) || !empty($social_data)) : ?>
                                            <?php if ($social_data['sd_marital_st'] == $key->mms_id) : ?>
                                                <li class='list'><label for="sd_marital_st_<?= $key->mms_id ?>"><input type="radio" id="sd_marital_st_<?= $key->mms_id ?>" name="ds[sd_marital_st]" value="<?= $key->mms_id ?>" checked/><?= $key->mms_name ?></label></li>
                                            <?php else : ?>
                                                <li class='list'><label for="sd_marital_st_<?= $key->mms_id ?>"><input type="radio" id="sd_marital_st_<?= $key->mms_id ?>" name="ds[sd_marital_st]" value="<?= $key->mms_id ?>" /><?= $key->mms_name ?></label></li>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <li class='list'><label for="sd_marital_st_<?= $key->mms_id ?>"><input type="radio" id="sd_marital_st_<?= $key->mms_id ?>" name="ds[sd_marital_st]" value="<?= $key->mms_id ?>" /><?= $key->mms_name ?></label></li>
                                        <?php endif; ?>
                                    <?php endforeach ?> 
                                </ul>
                            </div>
                            <label class="control-label">Agama</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?php foreach ($religi as $key): ?>
                                        <?php if (isset($social_data) || !empty($social_data)) : ?>
                                            <?php if ($social_data['sd_religion'] == $key->mr_id) : ?>
                                                <li class='list'><label for="sd_religion_<?= $key->mr_id ?>"><input type="radio" id="sd_religion_<?= $key->mr_id ?>" name="ds[sd_religion]" value="<?= $key->mr_id ?>" checked/><?= $key->mr_name ?></label></li>
                                            <?php else : ?>
                                                <li class='list'><label for="sd_religion_<?= $key->mr_id ?>"><input type="radio" id="sd_religion_<?= $key->mr_id ?>" name="ds[sd_religion]" value="<?= $key->mr_id ?>" /><?= $key->mr_name ?></label></li>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <li class='list'><label for="sd_religion_<?= $key->mr_id ?>"><input type="radio" id="sd_religion_<?= $key->mr_id ?>" name="ds[sd_religion]" value="<?= $key->mr_id ?>" /><?= $key->mr_name ?></label></li>
                                        <?php endif; ?>                                        
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <label class="control-label">Pendidikan</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?php foreach ($education as $key): ?>
                                        <?php if (isset($social_data) || !empty($social_data)) : ?>
                                            <?php if ($social_data['sd_education'] == $key->med_id) : ?>
                                                <li class='list'><label for="sd_education_<?= $key->med_id ?>"><input type="radio" id="sd_education_<?= $key->med_id ?>" name="ds[sd_education]" value="<?= $key->med_id ?>" checked/><?= $key->med_name ?></label></li>
                                            <?php else : ?>
                                                <li class='list'><label for="sd_education_<?= $key->med_id ?>"><input type="radio" id="sd_education_<?= $key->med_id ?>" name="ds[sd_education]" value="<?= $key->med_id ?>" /><?= $key->med_name ?></label></li>
                                            <?php endif ?>                        
                                        <?php else : ?>
                                            <li class='list'><label for="sd_education_<?= $key->med_id ?>"><input type="radio" id="sd_education_<?= $key->med_id ?>" name="ds[sd_education]" value="<?= $key->med_id ?>" /><?= $key->med_name ?></label></li>
                                        <?php endif; ?>                                                                                
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <label class="control-label">Pekerjaan</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?php foreach ($occupation as $key): ?>
                                        <?php if (isset($social_data) || !empty($social_data)) : ?>
                                            <?php if ($social_data['sd_occupation'] == $key->oc_id) : ?>
                                                <li class='list'><label for="sd_occupation_<?= $key->oc_id ?>"><input type="radio" id="sd_occupation_<?= $key->oc_id ?>" name="ds[sd_occupation]" value="<?= $key->oc_id ?>" checked/><?= $key->mo_name ?></label></li>
                                            <?php else : ?>
                                                <li class='list'><label for="sd_occupation_<?= $key->oc_id ?>"><input type="radio" id="sd_occupation_<?= $key->oc_id ?>" name="ds[sd_occupation]" value="<?= $key->oc_id ?>" /><?= $key->mo_name ?></label></li>
                                            <?php endif ?>                                       
                                        <?php else : ?>
                                            <li class='list'><label for="sd_occupation_<?= $key->oc_id ?>"><input type="radio" id="sd_occupation_<?= $key->oc_id ?>" name="ds[sd_occupation]" value="<?= $key->oc_id ?>" /><?= $key->mo_name ?></label></li>
                                        <?php endif; ?>                                                                                                                        
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <label for="sd_institute" class="control-label">Instansi</label>
                            <?php $value = isset($social_data) || !empty($social_data) ? $social_data['sd_institute'] : ""; ?>
                            <div class="controls">
                                <input type="text" id="sd_institute" name="ds[sd_institute]" value="<?= $value ?>" placeholder="Asal Instansi">
                            </div>
                        </div>
                        <div class="span3">
                            <?php if (isset($social_data) || !empty($social_data)) : ?>
                                <?php if ($social_data['sd_barcode'] != NULL) : ?>
                                    <div class="offset2"><h5>Barcode</h5></div>
                                    <div class="barcode-container">
                                        <table>
                                            <tr>
                                                <td colspan="3"><?= $social_data['sd_name'] ?>, <?= $social_data['sd_title'] ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="<?= base_url() . $social_data['sd_barcode'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?= $social_data['sd_rekmed'] ?></td>
                                                <td>RSIH</td>
                                                <?php
                                                $dob_explode = explode('-', $social_data['sd_date_of_birth']);
                                                $day = strlen($dob_explode[2]) == 1 ? '0' . $dob_explode[2] : $dob_explode[2];
                                                $month = strlen($dob_explode[1]) == 1 ? '0' . $dob_explode[1] : $dob_explode[1];
                                                $year = $dob_explode[0];
                                                $dob = $day . '-' . $month . '-' . $year;
                                                ?>
                                                <td><?= $dob ?></td>
                                            </tr>
                                        </table>
                                    </div>        
                                    <div class="offset1">
                                        <?php
                                        $name = str_replace(" ", 'nbsp', $social_data['sd_name']);
                                        ?>
                                        <button id="printBarcode" class="btn btn-small btn-warning" style="margin:auto" value="<?= base_url() ?>pendaftaran/cetak_barcode/<?= $social_data["sd_rekmed"] ?>">
                                            <i class="icon-print icon-white"></i> Cetak Barcode</button>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class='page_footer row-fluid'>
                        <?= form_button(array('id' => 'sd_submit', 'class' => 'btn btn-primary', 'type' => 'submit', 'content' => 'Simpan')) ?>
                    </div>
                    <?= form_close() ?>

                    <?php $this->load->view('alert') ?>

                    <script>
                        function openInNewTab(url)
                        {
                            var win = window.open(url, '_blank');
                            win.focus();
                        }

                        var count = 0;
                        function getAge(dateString) {
                            var today = new Date();
                            var birthDate = new Date(dateString);
                            var age = today.getFullYear() - birthDate.getFullYear();
                            var m = today.getMonth() - birthDate.getMonth();
                            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            return age;
                        }

                        var isvalid;
                        $(document).ready(function() {
                            $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
                            $('#tabs>ul>li:eq(0)').addClass('ui-state-active ui-tabs-selected');
                            $('#sd_reg_kab').chosen().change(function() {
                                if ("" !== $('#sd_reg_kab').val()) {
                                    var url = "<?= base_url() ?>pendaftaran/getProvinsi";
                                    $.post(url, {
                                        "<?= $this->security->get_csrf_token_name() ?>": "<?= $this->security->get_csrf_hash() ?>",
                                        'id_regency': $('#sd_reg_kab').val()
                                    }).done(function(result) {
                                        result = JSON.parse(result);
                                        $('#sd_reg_prov').val(result.mpr_name);
                                        $('input[name=ds\\[sd_reg_prov\\]]').val(result.mpr_id);
                                    });
                                } else {
                                    $('#sd_reg_prov').val('Provinsi');
                                    $('input[name=ds\\[sd_reg_prov\\]]').val('');
                                }
                            });

                            isvalid = $("#newPatientForm").validate({
                                rules: {
                                    'ds[sd_rekmed]': {"required": true, "number": true, "maxlength": 10},
                                    'ds[sd_card_number]': {"required": true, "number": true, "maxlength": 8},
                                    'ds[sd_name]': "required",
                                    'ds[sd_age]': {"required": true, "number": true},
                                    'ds[sd_telp]': {"required": true, "number": true},
                                    'ds[sd_place_of_birth]': "required",
                                    'ds[sd_sex]': "required"
                                },
                                submitHandler: function(form) {
<?php if (!isset($is_edit)) : ?>
                                        var url = "<?= base_url() ?>pendaftaran/tambah_data_pasien";
<?php else : ?>
                                        var url = "<?= base_url() ?>pendaftaran/ubah_data_pasien/" + $('#sd_rekmed').val();
<?php endif; ?>
                                    var data = $("#newPatientForm").serialize();
                                    $.post(url, data, function(response) {
                                        response = JSON.parse(response);
                                        if ("success" === response.success) {
                                            $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function() {
<?php if (!isset($is_edit)) : ?>
                                                    var url = $('#page').load('<?= base_url() ?>pendaftaran/form_data_keluarga/' + $('#sd_rekmed').val());
<?php else : ?>
                                                    var url = $('#page').load('<?= base_url() ?>pendaftaran/form_edit_keluarga/' + $('#sd_rekmed').val());
<?php endif; ?>

                                            });
                                        }
                                    });
                                    return false;
                                }
                            });

                            $('#printBarcode').click(function(e) {
                                e.preventDefault();
                                openInNewTab($(this).attr('value'));
                            });

                            $("#thn").change(function() {
                                var tgl = $("#tgl").val();
                                var bln = $("#bln").val();
                                var thn = $("#thn").val();
                                if ("" !== tgl && "" !== bln && "" !== thn) {
                                    var birth = [thn, bln, tgl].join("/");
                                    $("#usia").val(getAge(birth));
                                }
                            });

<?php if (!isset($is_edit)) : ?>
                                var cardNumber = parseInt($('input[name=searchInput]').val());
                                if (isNaN(cardNumber) === false) {
                                    $('#sd_card_number').val($('input[name=searchInput]').val());
                                }
<?php endif; ?>
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>                               
</div>

