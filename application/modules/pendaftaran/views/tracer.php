<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cetak Tracer | SIMRS IH</title>
        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    </head>
    <body>
        <style>
            table{border:1px solid;padding:5px;width:292px;font-size:14px;}
            th{text-align:center;font-size:16px;font-weight:bold}
            td{margin:0px;padding:5px;height:100%}
        </style>

        <table>
            <thead>
            <tr>
                <th colspan="3" style>Tracer</td>
            </tr>
            <thead>
            <tbody>
                <tr>
                    <td>Tanggal / Waktu</td>
                    <td>:</td>
                    <td><?=pretty_date($tracer['medical']->visit_in)?></td>
                </tr>
                <tr>
                    <td>No Rekam Medis</td>
                    <td>:</td>
                    <td><?=isset($tracer['medical']->visit_rekmed) ? (($tracer['medical']->visit_rekmed != 0) ? $tracer['medical']->visit_rekmed.$tracer['st_pasien'] : '(Pasien Rujukan)') : '-' ?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td><?=isset($tracer['medical']->sd_name) ? $tracer['medical']->sd_name : $tracer['medical']->visit_desc ?></td>
                </tr>
                <?php

                    $queue = $dokter = $visit = $previous_type = '';
                    $type = array();
                    if(is_array($tracer['service'])){
                      foreach($tracer['service'] as $key => $value){

                        if($previous_type != $value['type']){
                            $type[] = $value['type'];
                            $previous_type = $value['type'];
                        }

                        if($value['type'] == "Rawat Jalan"){

                            if(!empty($queue)) $queue .= '<br />';
                            $queue .= $value['queue'];

                            if(!empty($dokter)) $dokter .= '<br />';
                            $dokter .= $value['dokter'];

                            if(!empty($visit)) $visit .= '<br />';
                            $visit .= $value['type'].'('.$value['poly'].')';

                        }elseif($value['type'] == "Rawat Inap"){

                            if(!empty($visit)) $visit .= '<br />';
                            $visit .= $value['type'];

                            $room      = $value['room'];
                            $class     = $value['class'];
                            $pavillion = $value['pavillion'];

                        } else {
                            if(!empty($visit)) $visit .= '<br />';
                            $visit .= $value['type'];
                        }
                      }
                    }
                ?>

                <?php foreach ($type as $key => $value) : ?>
                    <?php if($value == "Rawat Jalan") : ?>

                        <tr>
                            <td>No Antrian</td>
                            <td>:</td>
                            <td><?=$queue?></td>
                        </tr>

                        <tr>
                            <td>Nama Dokter</td>
                            <td>:</td>
                            <td><?=$dokter?></td>
                        </tr>

                    <?php elseif($value == "Rawat Inap") : ?>

                        <tr>
                            <td>Kelas / No Kamar</td>
                            <td>:</td>
                            <td><?=$class.'/'.$room?></td>
                        </tr>

                        <tr>
                            <td>Paviliun</td>
                            <td>:</td>
                            <td><?=$pavillion?></td>
                        </tr>
                    <?php endif;?>
                <?php endforeach;?>

                 <tr>
                    <td>Kunjungan</td>
                    <td>:</td>
                    <td><?=$visit?></td>
                </tr>
            </tbody>
        </table>
        <script>
            $(function() {window.print();});
        </script>
    </body>
</html>