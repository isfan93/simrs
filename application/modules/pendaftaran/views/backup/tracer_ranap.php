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
                    <td><?=$tracer['visit_time']?></td>
                </tr>
                <tr>
                    <td>No Rekam Medis</td>
                    <td>:</td>
                    <td><?=$tracer['medical_record']?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td><?=$tracer['patient']?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?=$tracer['class']?></td>
                </tr>
                <tr>
                    <td>Nomor Ruang</td>
                    <td>:</td>
                    <td><?=$tracer['room']?></td>
                </tr>
            </tbody>
        </table>
        <script>
            $(function() {window.print();});
        </script>
    </body>
</html>