<style type="text/css">
    #prescriptionTable thead tr th{height:28px;font-size:13px;vertical-align: middle;}

    #resep\[\]_ctr.ffb{
        width:300px !important;
        top: 28px !important;
    }

    #resep\[\]_ctr .row .col1{
        float:left;
        width:100px;
    }
    #resep\[\]_ctr .row .col2{
        float:left;
        width:200px;
    }
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

<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'prescriptionForm')); ?>
<div class="widget-box" style='padding: 10px;min-height:250px;'>
    <div class="widget-content nopadding">
        <table id="prescriptionTable" class="table table-bordered" align="center">
            <thead>
                <tr role="row">
                    <th style="border-left:none;">No.</th>
                    <th>Obat & Alat Kesehatan</th>
                    <th>Tipe Obat</th>
                    <th>Aturan Pakai</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="border-left:none;">
                        <button type="button" id="addPrescription" class="btn btn-warning btn-small" style="margin-left:45%;"><i class='icon-plus icon-white icon-small'></i> Obat</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?= form_close() ?>

<script>
    var prescriptionIndex = 0;
    function addPrescription() {
        prescriptionIndex++;
        var str = ("<tr>");
        str += ("<td style='text-align:center;border-left:none;'><b>" + prescriptionIndex + "</b></td>");
        str += ("<td style='width:20%;'><div id='" + prescriptionIndex + "_fx_resep' class='fx_resep' style='width:98%;border-bottom:1px dotted gray;''></div></td>");
        //str += ("<td style='width:15%;'><select class='input input-medium' name='type[]'><option value='oral'>Oral</option><option value='parental'>Parental</option></select></td>");
        str += ("<td style='width:15%;'><select class='input input-medium' name='type[]'><?= $rute_obat ?></select></td>");
        str += ("<td style='width:50%;'><textarea name='rule[]' style='width:96%;height:96%;'></textarea></td>");
        str += ("<td style='width:15%;'><input type='text' class='input' name='quantity[]' id='" + prescriptionIndex + "_jumlah' style='width:20%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center' /><input type='hidden' class='input price' name='price[]' id='" + prescriptionIndex + "_price' /><input type='hidden' class='input batch' name='batch[]' id='" + prescriptionIndex + "_batch' /><span id='" + prescriptionIndex + "_satuan' class='satuan'></span></td>");
        str += ("</tr>");
        $("#prescriptionTable tbody").append(str);

        $('#' + prescriptionIndex + '_fx_resep').flexbox('<?= base_url() ?>' + 'apotek/get_resep', {
            paging: false,
            showArrow: false,
            maxVisibleRows: 0,
            width: 300,
            resultTemplate: '{name} - {stok}',
            onSelect: function () {
                var hv = $(this).parent().find('input:eq(0)').val();
                // var id_harga = $(this).parent().parent().find('input:eq(2)').attr('id');
                var id_satuan = $(this).parent().parent().parent().find('.satuan').attr('id');
                var id_batch = $(this).parent().parent().parent().find('.batch').attr('id');
                var id_harga = $(this).parent().parent().parent().find('.price').attr('id');
                $.getJSON('<?= base_url() ?>' + "apotek/resep_pasien/getMedicineDetail/" + hv, function (json) {
                    if( (json.istok_item_price != null) )
                            harga = json.istok_item_price;
                        else
                            harga = json.im_item_price;
                    $("#" + id_harga).val(harga);
                    $("#" + id_batch).val(json.istok_batch);
                    $("#" + id_satuan).html(json.mtype_name);
                });
            }
        });
        $(".fx_resep").find('input:eq(0)').attr('name', 'med_id[]');
        $(".fx_resep").find('input:eq(1)').attr('name', '');
    }

    $(document).ready(function () {
        addPrescription();
        $("#addPrescription").click(function () {
            addPrescription();
        });
    });
</script>