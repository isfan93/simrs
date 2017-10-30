<style type="text/css">
    #diag thead tr th{height:28px;font-size:13px;vertical-align: middle;}
    .nopadding .table-bordered{border:1px solid #dddddd;}

    .ffb{
        width: 600px !important;
    }
    #fx_item.ffb{
        width:350px !important;
        top: 28px !important;
    }
    #fx_item_ctr .row .col1{
        float:left;
        width:10px;
    }
    #fx_item_ctr .row .col2{
        float:left;
        margin-left: 15px;
        width:220px;
    }
    .ffb-input{
        width: 305px !important;
    }
</style>

<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'diagnoseForm')); ?>
<div class="widget-box" style='padding: 10px;min-height:400px;'>
    <div class="widget-content nopadding">
        <table id="diag" class="table table-bordered">
            <thead>
                <tr role="row">
                    <th style="border-left:none;width:2%;">No.</th>
                    <th style="width:20%;">Diagnosa</th>
                    <th style="width:20%;">Tindakan</th>
                    <th style="width:58%;">Instruksi Dokter</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="border-left:none;">
                        <button type="button" id="addDiagnose" class="btn btn-warning btn-small" style="margin-left:45%;"><i class='icon-plus icon-white icon-small'></i> Diagnosa</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?= form_close() ?>

<script>
    var diagnoseIndex = 0;
    var treatmentIndex = 0;

    function addTreatment(id_diagnosa) {
        treatmentIndex++;
        var str = ("<div id='" + treatmentIndex + "_fx_tindakan' class='fx_tindakan' style='width:98%;border-bottom:1px dotted gray;''></div>");
        $("#diag_" + id_diagnosa).append(str);
        $('#' + treatmentIndex + '_fx_tindakan').flexbox('<?= base_url() ?>' + 'rawat_inap/get_treatment/' + <?=$class_id?>, {
            paging: false,
            showArrow: false,
            maxVisibleRows: 10,
            width: 300,
            resultTemplate: '{name}',
            onSelect: function () {
                var id = $(this).parent().find('input:eq(0)').val();
            }
        });
        $("#" + treatmentIndex + "_fx_tindakan").find('input:eq(0)').attr('name', 'treat_id[' + id_diagnosa + '][]');
        $("#" + treatmentIndex + "_fx_tindakan").find('input:eq(1)').attr('name', '');
        $("#" + treatmentIndex + "_fx_tindakan_input").focus();
    }

    function addDiagnose() {
        diagnoseIndex++;
        var str = ("<tr>");
        str += ("<td style='text-align:center;vertical-align:top;width:10px !important;border-left:none;'><b>" + diagnoseIndex + "</b></td>");
        str += ("<td style='width:20%;'><div id='" + diagnoseIndex + "_fx_diagnosa' data-diagnose-id='" + diagnoseIndex + "' class='fx_diagnosa' style='width:98%;border-bottom:1px dotted gray;''></div></td>");
        str += ("<td style='width:20%;'><div id='diag_" + diagnoseIndex + "'></div><button type='button' style='display:block;margin:10px auto;' class='btn btn-small btn-warning tbh_tindakan' data-diagnose-id='" + diagnoseIndex + "'><i class='icon-plus icon-white icon-small'></i> Tindakan</button></td>");
        str += ("<td style='padding:5px;width:20%;'><textarea id='" + diagnoseIndex + "_instructions' name='instructions[]' style='width:96%;height:96%;' placeholder='Instruksi Dokter'></textarea></td>");
        str += ("</tr>");
        $("#diag tbody").append(str);
        $('#' + diagnoseIndex + '_fx_diagnosa').flexbox('<?= base_url() ?>' + 'rawat_jalan/poli_umum/get_diagnosa', {
            paging: false,
            showArrow: false,
            maxVisibleRows: 0,
            width: 300,
            resultTemplate: '{indonesian} ({desc})',
        });
        $(".fx_diagnosa").find('input:eq(0)').attr('name', 'diag_id[]');
        $(".fx_diagnosa").find('input:eq(1)').attr('name', '');
        $('#' + diagnoseIndex + '_fx_diagnosa_input').focus();
    }

    $(document).ready(function () {
        addDiagnose();
        addTreatment(diagnoseIndex);

        $("#addDiagnose").click(function () {
            addDiagnose();
            addTreatment(diagnoseIndex);
        });

        $(".tbh_tindakan").live('click', function (event, diagnoseId) {
            if (diagnoseId == '' || diagnoseId == 'undefined' || diagnoseId == null){
                var diagnoseId = $(this).attr('data-diagnose-id');
            }
            addTreatment(diagnoseId);
        });
    });
</script>
