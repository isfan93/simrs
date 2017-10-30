<style type="text/css">
    #diagnosis thead tr th{height:28px;font-size:13px;vertical-align: middle;}
    .nopadding .table-bordered{border:1px solid #dddddd;}
    .ffb-input{
        background: transparent;
        border: none;
    }

    .input:focus{
        background: #efefef !important;
    }
    .ffb-input:focus{
        background: #efefef !important;
    }
</style>

<?= form_open('#', array('id' => 'nursingDiagnosisForm','class' => 'form-horizontal')); ?>
<div class="widget-box" style='padding: 10px;min-height:250px;'>
    <div class="widget-content nopadding">
        <div class="control-group">
            <label class="control-label" style="vertical-align:top">Waktu Pemeriksaan</label>
            <div class="controls">
                <input type="text" name="datetime" class='datetime hasDatepicker'>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" style="vertical-align:top">Perawat/Gizi/Bidan  </label>
            <div class="controls">
                <select id="nurse" name="nurse" class="chosen-select">
                    <option value="" selected="selected">-- Pilih Perawat --</option>
                    <?php if (!empty($nurses)) : ?>
                        <?php foreach ($nurses as $nurse) : ?>
                            <option value="<?= $nurse['id_employe'] ?>"><?= $nurse['sd_name'] ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <br />

        <table id="diagnosis" class="table table-bordered">
            <thead>
                <tr role="row">
                    <th style="border-left:none;width:2%;">No.</th>
                    <th style="width:20%;">Diagnosa</th>
                    <th style="width:40%;">NOC</th>
                    <th style="width:40%;">NIC</th>
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
    <!--div class='page_footer row-fluid'>
        <?//= form_button(array('data-url' => base_url().'rawat_inap/simpan_perencanaan_keperawatan/'.$this->uri->segment(3),'class' => 'btn btn-primary', 'id' => 'submitNP' , 'type' => 'submit', 'content' => 'Simpan')) ?>
    </div-->
</div>
<?= form_close() ?>

<script>
    var diagnoseIndex = 0;

    function addDiagnose() {
        diagnoseIndex++;
        var str = ("<tr>");
        str += ("<td style='text-align:center;vertical-align:top;width:10px !important;border-left:none;'><b>" + diagnoseIndex + "</b></td>");
        str += ("<td style='width:20%;'><div id='" + diagnoseIndex + "_fx_diagnosa' class='fx_diagnosa' style='width:98%;border-bottom:1px dotted gray;'></div></td>");
        str += ("<td style='width:40%;' id='" + diagnoseIndex + "_fx_noc'></td>");
        str += ("<td style='width:40%;' id='" + diagnoseIndex + "_fx_nic'></td>");
        str += ("</tr>");
        $("#diagnosis tbody:eq(0)").append(str);
        $('#' + diagnoseIndex + '_fx_diagnosa').flexbox('<?= base_url() ?>' + 'rawat_inap/get_nursing_diagnosis', {
            paging: false,
            showArrow: false,
            maxVisibleRows: 0,
            width: 300,
            resultTemplate: '{name}',
            onSelect : function(){
                $.get('<?= base_url() ?>' + 'rawat_inap/get_nursing_nic/' + $(this).prev().val(),function(result){
                    result = JSON.parse(result);
                    if(result.length > 0){
                        var html = '<table style="width:100%;border:1px solid #dddddd">';
                        $(result).each(function(index,value){
                            html += '<tr>';
                            html += '<td style="width:50%;vertical-align:middle"><input type="checkbox" name="nic['+diagnoseIndex+'][]" value="'+ value.treat_id +'" checked/><label style="position:relative;top:2px;">'+ value.treat_name +'</label></td>';
                            html += '<td style="width:50%;text-align:center;"><textarea name="nic_note['+diagnoseIndex+'][]" class="nic-note" style="width:96%;height:96%"></textarea></td>';
                            html += '</tr>';

                        });
                        html += '</table>';
                    }
                    $('#' + diagnoseIndex + '_fx_nic').html(html);
                    $(".fx_diagnosa").find('input:eq(0)').attr('name', 'diag_id[]');
                    $(".fx_diagnosa").find('input:eq(1)').attr('name', '');
                });
}
});
$('#' + diagnoseIndex + '_fx_diagnosa_input').focus();
}

$(document).ready(function() {
    $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
    addDiagnose();
    $("#addDiagnose").click(function () {
        addDiagnose();
    });
});
</script>
