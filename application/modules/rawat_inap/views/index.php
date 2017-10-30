<style type="text/css" media="screen">
    .dataTables_scrollHead{
        margin-bottom: -22px;
    }
    .dataTables_info{
        margin-top: 20px;
    }
    .dataTables_filter{
        display:none;
    }
    #dyntable tr{cursor:pointer;}
    #dyntable .center{text-align:center;}
    #dyntable thead th{
        height: 28px;
        vertical-align: middle;
        font-size: 13px;
    }
</style>
<div class="container-fluid">

    <div class="row-fluid">
        <div class="pageheader notab ">
            <h1 class="pagetitle"><?=$desc;?>
                <span class="tgl-sekarang"></span>
            </h1>
        </div>
    </div>
    <div class="row-fluid">
        <div id="basic" style="float:right;width:300px">
            <div class="chatsearch">
                <input type="text" name="" placeholder="Search" style="width:85%;margin:auto;">
            </div>
        </div>
        <br clear="all">
    </div>

    <div class="row-fluid">
    <div class="widgetbox">

        <div class="span12">
            <table class="table table-bordered tb_scrol" id="dyntable">
                <thead>
                    <tr role="row">
                        <th style="width:20%">Tanggal Masuk</th>
                        <th style="width:20%">No Kunjungan</th>
                        <th style="width:20%">No. Rekmed</th>
                        <th style="width:20%">Nama Pasien</th>
                        <th style="width:20%">Kelas</th>
                        <th style="width:20%">No Kamar</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
    </div>
</div>
<div id="confirmation" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Konfirmasi</h3>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary confirm">Yes</a>
        <a href="#" class="btn" data-dismiss="modal">No</a>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    var oTable, serviceId;
    $(function () {
        oTable = $('#dyntable').dataTable({
            "sPaginationType": "bootstrap",
            "bPaginate": true,
            "aoColumns": [null, null, null, null, null, null],
            "aoColumnDefs": [
                {"bSortable": true, "aTargets": [0], "sWidth": "20%"},
                {"bSortable": true, "aTargets": [1], "sWidth": "10%"},
                {"bSortable": true, "aTargets": [2], "sWidth": "10%"},
                {"bSortable": true, "aTargets": [3], "sWidth": "40%"},
                {"bSortable": true, "aTargets": [4], "sWidth": "10%"},
                {"bSortable": true, "aTargets": [5], "sWidth": "10%"}
            ],
            "sAjaxSource": "<?= base_url() ?>rawat_inap/pasien_ranap/",
            "fnServerData": function (sSource, aoData, fnCallback) {
                var newArray = $.merge(aoData, [{"name": "<?= $this->security->get_csrf_token_name() ?>", "value": "<?= $this->security->get_csrf_hash() ?>"}]);
                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success": fnCallback
                });
            },
            "fnDrawCallback": function () {
                $("#dyntable tbody td:nth-child(1)").addClass('center');
                $("#dyntable tbody td:nth-child(2)").addClass('center');
                $("#dyntable tbody td:nth-child(3)").addClass('center');
                $("#dyntable tbody td:nth-child(4)").addClass('center');
                $("#dyntable tbody td:nth-child(5)").addClass('center');
                $("#dyntable tbody td:nth-child(6)").addClass('center');
            }
        });

        $('#dyntable_length').hide();

        setInterval(function () {
            oTable.fnReloadAjax("<?= base_url() ?>rawat_inap/pasien_ranap/");
        }, 60000);

        $("#dyntable tbody tr").live('click', function () {
            serviceId = $(this).children().eq(1).text();
            if (serviceId.length !== 0) {
                $("#dyntable tbody tr.active").removeClass('active');
                $(this).addClass('active');

                var patientName = $(this).children().eq(3).text();
                $('.modal-body').html('<p>Pilih pasien dengan nama : <b>' + patientName + '</b> ?</p>');
                $('#confirmation').modal();
            }
        });

        $('.confirm').click(function () {
            location.href = '<?= base_url() ?>rawat_inap/pemeriksaan/' + serviceId;
        });

        $(".chatsearch input").keyup(function (e) {
            $(".dataTables_filter input").val($(".chatsearch input").val()).trigger('keyup');
        });

    });
</script>
