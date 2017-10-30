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
                    <td><?=pretty_date($tracer['medical']->visit_in,false)?></td>
                </tr>
                <tr>
                    <td>No Rekam Medis</td>
                    <td>:</td>
                    <td><?=$tracer['medical']->visit_rekmed?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td><?=$tracer['medical']->sd_name?></td>
                </tr>
                <tr>
                    <td>Nama Dokter</td>
                    <td>:</td>
                    <td>
                        <?php 
                        if(is_array($tracer['service']))
                        {
                            foreach ($tracer['service'] as $key => $value) {
                               echo (!empty($value['dokter'])) ? $value['dokter'].'<br>' : '';
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Kunjungan</td>
                    <td>:</td>
                    <td>
                        <?php 
                        if(is_array($tracer['service']))
                        {
                            foreach ($tracer['service'] as $key => $value) {
                                echo $value['type'];
                                echo (!empty($value['poly'])) ? '('.$value['poly'].')' : '';
                                echo "<br>";
                            }
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <script>
            $(function() {window.print();});
        </script>
    </body>
</html>