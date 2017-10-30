<?php $this->load->view('shared_css') ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=$title?></h1>
        </div>
    </div>
    <div class="row-fluid">
         
        <div class="span5" style="float:right;">
            <div class="widgetbox" style="margin-top:20px;">
                <?= form_open('#', array('class' => 'search-input')); ?>
                <div id="basic">
                    <div id="rekmedSearch" class="chatsearch">
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
            <table class="table table-bordered table-striped table_tr tb_scrol dynamic-table" id="rekamMedis">
                <thead>
                    <tr>
                        <th style="width:7%">No. Rekmed</th>
                        <th style="width:20%">Nama Pasien</th>
                        <th style="width:20%">Alamat</th>
                        <th style="width:7%">Status</th>
                        <th style="width:10%">Tanggal diretensi</th>
                        <th style="width:20%">Keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="visitTableContainer"></div>
</div>

<script type="text/javascript" charset="utf-8">    
    $(document).ready(function () {
        $('#rekamMedis').dataTable({
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bPaginate": true,
            "bFilter": true,
            "aoColumns": [null, null, null, null,null,null],
            "sAjaxSource": "<?= base_url() ?>rekam_medis/get_retensi/",
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
                $("#rekamMedis tbody td:nth-child(1)").addClass('center');
                $("#rekamMedis tbody td:nth-child(2)").addClass('left');
                $("#rekamMedis tbody td:nth-child(3)").addClass('left');
                $("#rekamMedis tbody td:nth-child(4)").addClass('center');
                $("#rekamMedis tbody td:nth-child(5)").addClass('center');
                $("#rekamMedis tbody td:nth-child(6)").addClass('left');
            }
        });

        $("#rekmedSearch input").keyup(function (e) {
            $("#rekamMedis_filter input").val($(this).val()).trigger('keyup');
        });
    });
</script>

