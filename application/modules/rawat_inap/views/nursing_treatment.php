<style type="text/css">
    #treatment thead tr th,#medication thead tr th{height:28px;font-size:13px;vertical-align: middle;}
    .hasDatepicker{width:auto;}
</style>

<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'nursingTreatmentForm')); ?>
<div class="widget-box" style='padding: 10px;min-height:250px;'>
    <div class="widget-content nopadding">
        <div>
            <table id="treatment" class="table table-bordered">
                <thead>
                    <tr role="row">
                        <th style="border-left:none;width:2%;">No.</th>
                        <!--th style="width:10%;">Waktu</th>
                        <th style="width:10%;">Pelaksana</th-->
                        <th style="width:30%;">Tindakan</th>
                        <th style="width:46%;">Keterangan</th>
                        <th style="width:2%;">Obat</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="border-left:none;">
                            <button type="button" id="addTreatment" class="btn btn-warning btn-small" style="margin-left:45%;"><i class='icon-plus icon-white icon-small'></i> Tindakan</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="listOfMedicines">
            <div class="title" style="margin-left:0px;display:none;"><h3>Obat dan Alat Kesehatan</h3></div>
        </div>
    </div>
    <!--div class='page_footer row-fluid' style="margin-top:50px">
        <?//= form_button(array('data-url' => base_url().'rawat_inap/simpan_perencanaan_keperawatan/'.$this->uri->segment(3),'class' => 'btn btn-primary', 'id' => 'submitNP' , 'type' => 'submit', 'content' => 'Simpan')) ?>
    </div-->
</div>
<?= form_close() ?>

<script>
    var treatmentIndex = 0;
    function addTreatment() {
        treatmentIndex++;
        var nurseSelection = '<select name="nurse[]" class="chosen-select"><option value="" selected="selected">-- Pilih Perawat --</option>';
                <?php if (!empty($nurses)) : ?>
                    <?php foreach ($nurses as $nurse) : ?>
                    nurseSelection += '<option value="<?= $nurse['id_employe'] ?>"><?= $nurse['sd_name'] ?></option>'
                <?php endforeach ?>
            <?php endif; ?>
            nurseSelection += '</select>';
        var str = "<tr>";
            str += "<td style='text-align:center;vertical-align:middle;width:10px !important;border-left:none;'><b>" + treatmentIndex + "</b></td>";
            //str += "<td style='width:10%;'><input type='text' name='datetime_nurse[]' class='datetime hasDatepicker' /></div></td>";
            //str += "<td style='width:10%;'>"+nurseSelection+"</td>";
            str += "<td style='width:30%;'><div id='"+treatmentIndex+"_fx_treatment' class='fx_treatment' style='width:96%;border-bottom:1px dotted gray;'></div></td>";
            str += "<td style='width:46%;text-align:center;vertical-align:middle;'><textarea name='treat_note[]' style='width:96%;'></textarea></td>";
            str += "<td style='width:2%;text-align:center;vertical-align:middle;'><button id='"+treatmentIndex+"_fx_medication' class='fx-medication btn btn-small btn-warning'><i class='icon-plus-sign icon-white'></i></button></td>";
            str += "</tr>";
            str += "<tr><td colspan='6' style='display:none;background:#efefef'>";
            str += '<table id="medication_'+treatmentIndex+'" class="table table-bordered" style="background:#ffffff">';
            str += '<thead><tr>\n\
                        <th style="border-left:none;width:2%;">No.</th>\n\
                        <th>Obat dan Alat Kesehatan</th>\n\
                        <th>Tipe</th>\n\
                        <th>Aturan Pakai</th>\n\
                        <th>Jumlah</th>\n\
                    </tr></thead>';
            str += '<tbody></tbody>\n\
                    <tfoot><tr>\n\
                        <td colspan="6" style="border-left:none;">\n\
                            <button type="button" class="btn btn-warning btn-small add-prescription" style="margin-left:45%;"><i class="icon-plus icon-white icon-small"></i> Obat</button>\n\
                        </td>\n\
                    </tr></tfoot>';
            str += '</table>';
            str += "</td></tr>";
        $("#treatment").append(str);
        $('.datetime').datetimepicker({
            format:'Y-m-d H:i',
            minDate:'<?=$service_in?>'
        });
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $('#' + treatmentIndex + '_fx_treatment').flexbox('<?= base_url() ?>' + 'rawat_inap/get_treatment/' + <?=$patient_data['class_id']?>, {
            paging: false,
            showArrow: false,
            maxVisibleRows: 0,
            width: 300,
            resultTemplate: '{name}',
        });
        $(".fx_treatment").find('input:eq(0)').attr('name', 'treat_id[]');
        $(".fx_treatment").find('input:eq(1)').attr('name', '');
    }

    var tableID;
    function addPrescription(tableID) {
        var prescriptionIndex = parseInt($('#'+tableID).find('tr').length) - 1;
        var str = "<tr>";
            str += "<td style='text-align:center;border-left:none;'><b>" + prescriptionIndex + "</b></td>";
            str += "<td style='width:20%;'><div id='" + prescriptionIndex + "_fx_resep' class='fx_resep' style='width:98%;border-bottom:1px dotted gray;''></div></td>";
            str += "<td style='width:15%;'><select class='input input-medium' name='type[]'><option value='oral'>Oral</option><option value='parental'>Parental</option></select></td>";
            str += "<td style='width:50%;'><textarea name='rule[]' style='width:96%;height:96%;'></textarea></td>";
            str += "<td style='width:15%;'><input type='text' class='input' name='quantity[]' id='" + prescriptionIndex + "_jumlah' style='width:20%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'><span id='" + prescriptionIndex + "_satuan' class='satuan'></span></td>";
            str += "</tr>";
        $('#'+tableID).append(str);
        $('#'+tableID).find('#' + prescriptionIndex + '_fx_resep').flexbox('<?= base_url() ?>' + 'apotek/get_resep', {
            paging: false,
            showArrow: false,
            maxVisibleRows: 0,
            width: 300,
            resultTemplate: '{id} - {name} - {harga}',
            onSelect: function () {
                var hv = $(this).parent().find('input:eq(0)').val();
                var id_harga = $(this).parent().parent().find('input:eq(2)').attr('id');
                var id_satuan = $(this).parent().parent().parent().find('.satuan').attr('id');
                $.getJSON('<?= base_url() ?>' + "apotek/json_get_resep/" + hv, function (json) {
                    $("#" + id_harga).val(json.harga);
                    $("#" + id_satuan).html(json.satuan);
                });
            }
        });
        $(".fx_resep").find('input:eq(0)').attr('name', 'med_id[]');
        $(".fx_resep").find('input:eq(1)').attr('name', '');
    }

    $(document).ready(function () {
        addTreatment();
        $("#addTreatment").click(function(){
            addTreatment();
        });

        $(".add-prescription").die().live('click',function () {
            var tableID = $(this).closest('table').attr('id');
            addPrescription(tableID);
        });

        $('.fx-medication').die().live('click',function(e){
            e.preventDefault();
            $(this).button('toggle');
            var id = $(this).attr('id').split('_');
            tableID = 'medication_'+id[0];
            var hiddenRow = $(this).closest('tr').next().children().eq(0);
            if(hiddenRow.is(':visible')){
                hiddenRow.hide();
            }else{
                hiddenRow.show();
                if($('#'+tableID).find('tr').length == 2){
                    addPrescription(tableID);
                }
            }
        });
    });
</script>
