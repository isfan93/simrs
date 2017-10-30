<style type="text/css" media="screen">
    .dataTable thead th{
        height: 28px;
        vertical-align: middle;
        font-size: 13px;
    }   
    .dataTable .header{
        width: 0;
    }

    .dataTable td{
        text-align: center;
    }
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <button class='add-patient btn btn-small btn-primary pull-right'><i class="icon-plus icon-white"></i> Tambah Pasien Baru</button>
        </div
    </div>
    <div class="row-fluid">
        <div class="span12">
            <table class="table table-bordered dataTable">
                <thead>
                    <tr>
                        <th>No Kartu</th>
                        <th>No Rekam Medis</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $key => $res) : ?>
                        <?php
                        $dob_explode = explode('-', $res['sd_date_of_birth']);
                        $date = strlen($dob_explode[2]) == 1 ? '0' . $dob_explode[2] : $dob_explode[2];
                        $month = strlen($dob_explode[1]) == 1 ? '0' . $dob_explode[1] : $dob_explode[1];
                        $year = $dob_explode[0];
                        $birthdate = $date . '/' . $month . '/' . $year;
                        ?>
                        <tr>
                            <td><?= $res['sd_card_number'] ?></td>
                            <td><?= $res['sd_rekmed'] ?></td>
                            <td><?= $res['sd_name'] ?></td>
                            <td><?= $birthdate ?></td>
                            <td><?= $res['sd_address'] ?></td>
                            <td>
                                <button class='select-patient btn btn-small btn-success' style="width:48%">Pilih</button>
                                <button class='edit-patient btn btn-small btn-warning' style="width:48%">Edit</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>            
    </div>        
</div>

<script>
    $(document).ready(function () {
        $('.select-patient').on('click', function () {
            $('.pendaftaran-content').load('<?= base_url() ?>pendaftaran/pilih_layanan/' + $(this).parent().closest('tr').children().eq(1).text());
        });

        $('.add-patient').on('click', function () {
            $('.pendaftaran-content').load('<?= base_url() ?>pendaftaran/pendaftaran_baru', function () {
                $('#alertContainer').hide();
                $('#registrationContainer').show();
            });
        });

        $('.edit-patient').on('click', function () {
            $('.pendaftaran-content').load('<?= base_url() ?>pendaftaran/edit_data_pasien/' + $(this).parent().closest('tr').children().eq(1).text());
        });

        $('.dataTable').dataTable({
            "bAutoWidth": false,
            "bFilter": false,
            "bLengthChange": false
        });
    });
</script>