<?php $this->load->view('shared_css') ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <!-- <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" style="background-color:white;padding-left:0px;margin-left:0px;" > -->
               <!--  <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding-left:0px;margin-left:0px;">
                    <li class="ui-state-default ui-corner-top ui-state-active ui-tabs-selected"><a href="javascript:void(0);">Rawat Jalan</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="javascript:void(0);">Rawat Inap</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="javascript:void(0);">IGD</a></li>
                </ul> -->
                <div id="page">
                <div class="row-fluid">
                    <div class="pageheader notab">
                        <h1 class="pagetitle"><?=$title?></h1>
                    </div>
                </div>
                    <div class="row-fluid">

                        <div class="span5" style="float:right;">
                            <div class="widgetbox" style="margin-top:20px;">
                                <?= form_open('#',array('class' => 'search-input')); ?>
                                <div id="basic">
                                    <div id="todayVisitSearch" class="chatsearch">
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
                        <div class="widgetbox">
                            <div class="span12">
                                <table class="table table-bordered table-striped table_tr tb_scrol dynamic-table" id="todayVisit">
                                    <thead>
                                        <tr>
                                            <!--th>Kunjungan</th>
                                            <th>Layanan</th-->
                                            <th>Pasien</th>
                                            <!--th>Status</th-->
                                            <th>Aksi</th>
                                            <!-- <th style="width:20%">Aksi</th> -->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#todayVisit').dataTable({
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bPaginate": true,
            "bFilter": true,
            "aoColumns": [null, null],
            "aoColumnDefs": [
                  { "bSortable": true, "aTargets": [ 0 ], "sWidth": "50%"},
                  //{ "bSortable": false, "aTargets": [ 1 ], "sWidth": "15%"},
                  { "bSortable": false, "aTargets": [ 1 ], "sWidth": "10%"} /*,
                  { "bSortable": false, "aTargets": [ 3 ], "sWidth": "10%"},
                  { "bSortable": false, "aTargets": [ 4 ], "sWidth": "30%"}*/
            ],
            "sAjaxSource": "<?= base_url() ?>igd/igd/get_kunjungan/",
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
                //$("#todayVisit tbody td:nth-child(1)").addClass('center');
                //$("#todayVisit tbody td:nth-child(2)").addClass('left');
                $("#todayVisit tbody td:nth-child(1)").addClass('left');
                $("#todayVisit tbody td:nth-child(2)").addClass('center');
                //$("#todayVisit tbody td:nth-child(2)").wrapInner('<i />');
                //$("#todayVisit tbody td:nth-child(3)").addClass('center');
                //$("#todayVisit tbody td:nth-child(5)").addClass('center');
            }
        });
        setInterval(function () {
            oTable.fnReloadAjax("<?= base_url() ?>igd/igd/get_kunjungan/");
        }, 30000);

        $("#todayVisitSearch input").keyup(function(e) {
            $("#todayVisit_filter input").val($(this).val()).trigger('keyup');
        });

        $('.btn-finish').live('click',function(){
            if(confirm('Apakah kunjungan pasien benar - benar sudah berakhir?'))
            {
                $.blockUI({
                    message: '<div class="black_loader"><img src="<?=get_loader(11)?>"></div>',
                    overlayCSS:  {
                        backgroundColor: '#000',
                        opacity: 0.5,
                        cursor: 'wait',
                    },
                    css:{
                        border: 'none',
                    }
                });
                url = $(this).attr('href');
                data = null;
                $.post(url,data, function(result){
                    var result = JSON.parse(result);
                    $.unblockUI({
                        onUnblock: function(){
                            if (result.success === true) {
                                $(".alert").fadeIn().delay(500).fadeOut(function(){
                                    oTable.fnReloadAjax("<?= base_url() ?>rekam_medis/get_kunjungan/");
                                });
                            } else {
                                alert('Kunjungan tidak dapat diakhiri karena pasien masih dalam pelayanan.');
                            }
                        }
                    });
                });
            }
            return false;
        });
    });
</script>