<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pengkajian Umum Pasien (A4) | SIMRS IH</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/NOTTB___.css">
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <style>
        @page{margin:15px auto;}
        .printPage{margin: 0px;padding: 5px;width: 670px; /* width: 7in; */ clear: both;page-break-after: always;}
        .patientForm td{padding: 2px;}
    </style>
</head>
<body>
    <div class="container-fluid printPage" style="border:1px solid">
        <div id="header" class="row-fluid" style="border-bottom:1px solid">
            <div class="span12">
                <div class="pull-left">
                    <img src="<?php echo base_url(); ?>assets/image-sistem/logo.png" style="width:120px;margin:5px;">
                    <p style="font-size:9px">
                        Jalan Mayor Suherman 72 Tarogong Garut Jawa Barat 44151
                        <br>
                        Telp. (0262) 2247760, 243499 Fax (0262) 2247760
                    </p>
                </div>
                <div class="pull-left" style="border:2px solid;padding: 10px;margin-left: 70px;">
                    <h1 style="text-align:center;font-size:34px">A4</h1>
                </div>
                <div class="pull-left" style="margin-left: 120px;">
                    <table id="barcode">
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
            </div>
        </div>
        <div id="body" class="row-fluid">
            <h5 style="text-align:center;text-decoration:underline">FORMULIR PENGKAJIAN UMUM PASIEN</h5>
                <?php $unchecked = '<img src="' . base_url() . 'assets/images/unchecked.png">' ?>
                <?php $checked = '<img src="' . base_url() . 'assets/images/checked.png">' ?>
                <table class="patientForm">
                    <tr>
                        <td colspan="3" class="cell-title">DATA SOSIAL PASIEN</td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?= $social_data['sd_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Tempat & Tanggal Lahir</td>
                        <td>:</td>
                        <?php $dob = date('d-m-Y', strtotime($social_data['sd_date_of_birth'])) ?>
                        <td><?= $social_data['sd_place_of_birth'] ?>, <?= $dob ?></td>
                    </tr>
                    <tr>
                        <td>Alamat Lengkap</td>
                        <td>:</td>
                        <td><?= $social_data['sd_address'] ?></td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>:</td>
                        <td><?= $social_data['sd_telp'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                            <table class="checkbox-table">
                                <tr>
                                    <?php $box = $social_data['sd_sex'] == 'L' ? $checked : $unchecked ?>
                                    <td><?= $box ?>  Laki - Laki</td>
                                    <?php $box = $social_data['sd_sex'] == 'P' ? $checked : $unchecked ?>
                                    <td><?= $box ?>  Perempuan</td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Status Perkawinan</td>
                        <td>:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($marital_status as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($marital_status)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($social_data)) {
                                        $box = $social_data['sd_marital_st'] == $value->mms_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?>  <?= $value->mms_name ?></td>
                                    <?php
                                    if ($index == (count($marital_status) - 1)) {
                                        echo "<td></td></tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($nationality as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($nationality)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($social_data)) {
                                        $box = $social_data['sd_citizen'] == $value->mna_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?>  <?= $value->mna_name ?></td>
                                    <?php
                                    if ($index == (count($nationality) - 1)) {
                                        echo "<td></td></tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Agama</td>
                        <td style="vertical-align:top">:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($religion as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($religion)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($social_data)) {
                                        $box = $social_data['sd_religion'] == $value->mr_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?>  <?= $value->mr_name ?></td>
                                    <?php
                                    if ($index == (count($religion) - 1)) {
                                        echo "</tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Pekerjaan</td>
                        <td style="vertical-align:top">:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($occupation as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($occupation)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($social_data)) {
                                        $box = $social_data['sd_occupation'] == $value->oc_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?>  <?= $value->mo_name ?></td>
                                    <?php
                                    if ($index == (count($occupation) - 1)) {
                                        echo "</tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Pendidikan</td>
                        <td style="vertical-align:top">:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($education as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($education)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($social_data)) {
                                        $box = $social_data['sd_education'] == $value->med_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?>  <?= $value->med_name ?></td>
                                    <?php
                                    if ($index == (count($education) - 1)) {
                                        echo "</tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Dokter Tujuan</td>
                        <td style="vertical-align:top">:</td>
                        <td><div style="height:20px;width:40%;border-bottom:1px dotted"></div></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="cell-title">DATA PENANGGUNG JAWAB</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <?php $fm_name = isset($family_data['fm_name']) ? $family_data['fm_name'] : ""?>
                        <td><?= $fm_name ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Hubungan dengan Pasien</td>
                        <td style="vertical-align:top">:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($family_relation as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($family_relation)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($family_data)) {
                                        $box = $family_data['fm_relation'] == $value->mfr_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?> <?= $value->mfr_name ?></td>
                                    <?php
                                    if ($index == (count($family_relation) - 1)) {
                                        echo "</tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <?php $fm_address = isset($family_data['fm_address']) ? $family_data['fm_address'] : ""?>
                        <td><?= $fm_address ?></td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>:</td>
                        <?php $fm_phone = isset($family_data['fm_phone']) ? $family_data['fm_phone'] : ""?>
                        <td><?= $fm_phone ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Pekerjaan</td>
                        <td style="vertical-align:top">:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($occupation as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($occupation)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($family_data)) {
                                        $box = $family_data['fm_occupation'] == $value->oc_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?> <?= $value->mo_name ?></td>
                                    <?php
                                    if ($index == (count($occupation) - 1)) {
                                        echo "</tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Pendidikan</td>
                        <td style="vertical-align:top">:</td>
                        <td>
                            <table class="checkbox-table">
                                <?php foreach ($education as $index => $value) : ?>
                                    <?php
                                    if ($index == 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <?php
                                    if ($index != 0 && $index % 4 == 0 && $index != count($education)) {
                                        echo "</tr><tr>";
                                    }
                                    ?>
                                    <?php
                                    if (!empty($family_data)) {
                                        $box = $family_data['fm_education'] == $value->med_id ? $checked : $unchecked;
                                    }
                                    ?>
                                    <td><?= $box ?> <?= $value->med_name ?></td>
                                    <?php
                                    if ($index == (count($education) - 1)) {
                                        echo "</tr>";
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="footer" class="row-fluid">
                <table style="width: 100%;">
                    <tr>
                        <td colspan="2">Dengan ini saya menyatakan bahwa data isian diatas adalah sesuai kondisi yang sebenar-benarnya.</td>
                    </tr>
                    <tr>
                        <?php //$now = pretty_date(date('Y-m-d'), 'date_only') 
                                $datevisit = strtotime($firstvisit['visit_in']);
                                $now = date('d-m-Y',$datevisit);
                            ?>
                        <td></td>
                        <td style="text-align:center">Garut, <?= $now ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:center">Petugas Administrasi</td>
                        <td style="text-align:center">Pasien / Wali</td>
                    </tr>
                    <tr>
                        <td style="text-align:center"><br /><br /><br /></td>
                        <td style="text-align:center"><br /><br /><br /></td>
                    </tr>
                    <tr>
                        <td style="text-align:center">(.............................................................)</td>
                        <td style="text-align:center">(.............................................................)</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
    </html>