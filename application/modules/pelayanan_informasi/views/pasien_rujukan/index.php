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
                    <div id="pasien_search" class="chatsearch">
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
            <table class="table table-bordered table-striped table_tr tb_scrol dynamic-table" id="pasien_r">
                <thead>
                    <tr>                        
                        <th style="width:15%">Tanggal Kunjungan</th>
                        <th style="width:15%">Nama Pasien/Alamat</th>
                        <th style="width:5%">Layanan</th>
                        <th style="width:20%">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="visitTableContainer"></div>
</div>

<script type="text/javascript" charset="utf-8">
    $('.visit-list').live('click', function (e) {
        e.preventDefault();
        $('#visitTableContainer').load($(this).attr('href'));
        // $('#patientHistorySearch').focus();
    });

    $('.cancel_trans').live('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        //alert(url);
        var konfirmasi = confirm('Apakah anda yakin akan membatalkan transaksi ini?');
        if(konfirmasi){           
            var csrf = '<?php echo $this->security->get_csrf_hash()?>';            
            $.post(url,function(result){
                var result = JSON.parse(result);
                if(result.success===true){
                    alert('Transaksi berhasil dibatalkan');
                    location.reload();
                }else{
                    alert('Transaksi belum berhasil dibatalkan');
                }
            })           
        }
    });

    $(document).ready(function () {
        $('#pasien_r').dataTable({
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bPaginate": true,
            "bFilter": true,
            "aoColumns": [null, null, null, null],
            "sAjaxSource": "<?= base_url() ?>pelayanan_informasi/pasien_rujukan/get_rujukan/",
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
                $("#pasien_r tbody td:nth-child(1)").addClass('center');
                $("#pasien_r tbody td:nth-child(2)").addClass('center');
                $("#pasien_r tbody td:nth-child(3)").addClass('center');
                $("#pasien_r tbody td:nth-child(4)").addClass('center');                
            }
        });

        $("#pasien_search input").keyup(function (e) {
            $("#pasien_r_filter input").val($(this).val()).trigger('keyup');
        });
    });
</script>

