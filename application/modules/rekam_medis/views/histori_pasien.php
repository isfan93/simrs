<?php $this->load->view('shared_css') ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span5" >
            <div class="title"><h3>Histori Kunjungan Pasien : <?= $no_rekmed ?></h3></div>
        </div>
        <div class="span5" style="float:right;">
            <div class="widgetbox" style="margin-top:20px;">
                <?= form_open('#', array('class' => 'search-input')); ?>
                <div id="basic">
                    <div id="patientHistorySearch" class="chatsearch">
                        <input type="text" name="" placeholder="Search" style="margin:auto;">
                        <br class="clear"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <br clear="all">
    <div class="row-fluid">
        <div class="span12">
            <table class="table table-bordered table-striped table_tr tb_scrol dynamic-table" id="patientHistory">
                <thead>
                    <tr>
                        <th style="width:15%">Tanggal Masuk</th>
                        <th style="width:15%">Tanggal Keluar</th>
                        <!-- <th style="width:15%">Tipe Kunjungan</th> -->
                        <th style="width:20%">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#patientHistory').dataTable({
            "sPaginationType": "bootstrap",
            "bLengthChange": false,
            "bPaginate": true,
            "bFilter": true,
            "aoColumns": [null, null, null],
            "sAjaxSource": "<?= base_url() ?>rekam_medis/histori_pasien/" + '<?= $no_rekmed ?>',
            "fnServerData": function(sSource, aoData, fnCallback) {
                var newArray = $.merge(aoData, [{"name": "<?= $this->security->get_csrf_token_name() ?>", "value": "<?= $this->security->get_csrf_hash() ?>"}]);
                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success": fnCallback
                });
            },
            "fnDrawCallback": function() {
                $("#patientHistory tbody td:nth-child(1)").addClass('center');
                $("#patientHistory tbody td:nth-child(2)").addClass('center');
                $("#patientHistory tbody td:nth-child(3)").addClass('center');
                $("#patientHistory tbody td:nth-child(4)").addClass('center');
            }
        });

        $("#patientHistorySearch input").keyup(function(e) {
            $("#patientHistory_filter input").val($(this).val()).trigger('keyup');
        });
    });
</script>

