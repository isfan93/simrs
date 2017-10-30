<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cetak Barcode | SIMRS IH</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/NOTTB___.css">
        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    </head>
    <body>
        <style>
            table{font-family: 'NOTTB';font-size : 9px;text-align: center}
        </style>
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
        <script>
            $(function() {window.print();});
        </script>
    </body>
</html>