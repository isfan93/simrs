<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.css" />
<script src="<?= base_url() ?>assets/js/jquery.chosen.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>
<style type="text/css" media="screen">
    .frm_search input{margin-top:-1px;float:right;margin-left:2px}
    .frm_search .btn{float:right;margin-left:5px}
    .frm_search .btn span{padding:2px 10px;}
    .search_choice a{font-weight:bold}
    .search_choice a.active{color:#fb9338}
    .search_choice {float:right;margin-right:95px}
    #advance{display:none}
    #filter{border-bottom: 1px dashed #DDD;}
    #body_search{margin-top:10px}
    .tname{font-size:110%}
    #dyntable tbody tr td{border-right:none}
    #dyntable tbody tr td + td + td {border-right:1px solid #DDD}
    #dyntable tr:nth-child(even){
        background:#F7F7F7;
    }
    .dataTables_scrollHead{
        margin-bottom: -22px;
    }
    .dataTables_info{
        margin-top: 20px;
    }
    .table_tr thead th{
        height: 28px;
        vertical-align: middle;
        font-size: 13px;
    }
    .table_tr tbody th{
        height: 28px;
        vertical-align: middle;
        font-size: 13px;
    }
    .alert{
        background-color: transparent;
        border: 0px;
    }
    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
</style>
<script type="text/javascript">
    $(function(){
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $('.datepicker').datepicker({
            minDate: '0',
        });

        var d_uri = "<?=base_url()?>gudang_farmasi/purchase_order/data_order";
        oTb = $('#tb_dokter').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "bLengthChange": false,     
            "bFilter": true,
            "sPaginationType": "full_numbers",
            "aoColumns": [null,null,null,null,{ "bSortable": false }],
            "sAjaxSource": d_uri,
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                var newArray = $.merge(aoData, [{ "name": "<?=$this->security->get_csrf_token_name()?>", "value": "<?=$this->security->get_csrf_hash()?>" }]);
                $.ajax( {
                    "dataType": 'json',
                    "type": "POST", 
                    "url": sSource, 
                    "data": aoData, 
                    "success": fnCallback
                } );
            }
        });
        $("#tb_dokter_filter").hide();  
        $(".chatsearch input").keyup(function(e){
            $("#tb_dokter_filter input").val($(".chatsearch input").val()).trigger('keyup');
        })

    });
    </script>
<div id="his">
<!-- <div class="pageheader notab">
    <h1 class="pagetitle">Tambah <?=$title?></h1>
</div> -->
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3" >
            <div class="title"><h3><?=$title?></h3></div>
        </div>
    </div>
</div>
<div id="field1">
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>                                  
                    </span>
                    <h5>Langkah 1 : Masukkan Nomor Purchase Order</h5>
                </div>
                <div class="widget-content nopadding">
                    <?=form_open(cur_url(-1).'save_receive_item',array('class' => 'form-horizontal form','id' => 'form_sup')); ?>
                        <div class="control-group">
                            <label class="control-label">No Order *</label>
                            <div class="controls">
                                <input type="text" style="width:15%" id="iri_id" readonly="readonly" name="ds[iri_id]" value="<?php echo $ipo_id;?>" >
                            </div>
                            <label class="control-label">Nomor Purchase Order *</label>
                            <div class="controls">
                                <input type="hidden" name="ipo_id" id="ipo_id" class="ipo_id" value="">
                            </div>
                            <label class="control-label">Supplier *</label>
                            <div class="controls">
                                <input type="hidden" name="" id="ipo_supplier" class="ipo_supplier" value="">
                            </div>
                            <label class="control-label">Tanggal Order *</label>
                            <div class="controls">
                                <input type="text" class="mini datepicker" name="ipo_date_req" id="ipo_date_req" data-date-format="dd-mm-yyyy" disabled>
                            </div>
                           <!--  <label class="control-label">Petugas *</label>
                            <div class="controls">
                                <input type="text" placeholder="Petugas" class="mini" id="ipo_operator" value="" name="ds[ipo_operator]" disabled>
                            </div> -->
                            <label class="control-label">Catatan</label>
                            <div class="controls">
                                <textarea  class="medium" style="width:40%" id="ipo_note" name="ds[ipo_note]" disabled></textarea>
                            </div>
                            <label class="control-label">Tanggal Penerimaan *</label>
                            <div class="controls">
                                <input type="text" class="mini datepicker" name="iri_date_acept" id="iri_date_acept" data-date-format="dd-mm-yyyy">
                            </div>
                            <label class="control-label">Tanggal Jatuh Tempo *</label>
                            <div class="controls">
                                <input type="text" class="mini datepicker" id="iri_date_maturity" name="iri_date_maturity" data-date-format="dd-mm-yyyy">
                            </div>
                            <label class="control-label">Petugas Penerima *</label>
                            <div class="controls">
                                <input type="text" placeholder="Petugas Penerima" class="mini" id="" value="<?=get_user('sd_name')?>" name="" readonly>
                                <input type="hidden" placeholder="Petugas Penerima" class="mini" id="iri_operator" value="<?=get_user('user_id')?>" name="ds[iri_operator]" readonly>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button id="back" class="hide">Kembali</button>
                            <button id="next" class="btn btn-primary pull-right" disabled="disabled">Lanjut</button>
                            <button  style="margin-right:10px;" id="reset" class="btn btn-default pull-right" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>                      
        </div>
    </div>
</div>
</div>
</div>

<div id="field2" class="hide">
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>                                  
                    </span>
                    <h5 style="width:94%"><span>Langkah 2 : Masukkan Detail Inventori</span></h5>
                </div>
                    <?=form_open(cur_url(-1).'save_receive_item',array('class' => 'form-horizontal form','id'=>'form_det')); ?>
                        <div class="frm_trx" style="width:96%;padding:10px;height:195px;margin:0 auto;margin-top:20px;margin-bottom:20px;border:1px dashed #969696;color:#AAA">
                            <div class="control-group" style="width:50%;float:left;border-bottom:none;">
                                <label class="control-label" style="width:160px;">Item *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="hidden" name="" id="item" class="item" value="">
                                </div>
                                <label class="control-label" style="width:160px;">Harga Beli (Total) + PPN *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" class="input-small" id="harga_beli_total_ppn" autocomplete="off">
                                </div>
                                <label class="control-label" style="width:160px;">Jumlah *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" name="" class="input-small" id="qty" autocomplete="off"><b id="unit"></b>
                                </div>
                                <!-- <label class="control-label" style="width:160px;">Harga Beli (Satuan) *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" id="harga_beli_satuan" class="input-small" autocomplete="off" readonly="true">
                                </div> -->
                                <label class="control-label" style="width:160px;">Harga Beli (Satuan) + PPN *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" id="harga_beli_satuan_ppn" class="input-small" autocomplete="off" readonly="true">
                                </div>
                                <!-- </div> -->
                            </div>
                            <div class="control-group" style="width:50%;float:right;">
                                <!-- <label class="control-label" style="width:130px;">Expired Date *</label>
                                <div class="controls" style="margin-left:140px;">
                                    <input type="text" name="" class="input-small datepicker" id="exp" autocomplete="off" placeholder="Expired Date" data-date-format="dd-mm-yyyy">
                                </div>
                                <br clear="all"> -->
                                <label class="control-label" style="width:130px;">Batch *</label>
                                <div class="controls" style="margin-left:140px;">
                                    <input type="text" name="" class="input-small" id="batch" autocomplete="off"><b id="unit"></b>
                                </div>
                                <label class="control-label" style="width:130px;">Expired Date *</label>
                                <div class="controls" style="margin-left:140px;">
                                    <select  name="tgl[0]" style="min-width:90px;width:90px" style="float:left" id="tgl" class="chosen-select">
                                        <option value="" >-- tgl --</option>
                                        <?= get_hari() ?>
                                    </select>
                                    <select name="tgl[1]" style="width:90px" id="bln" class="chosen-select">
                                        <option value="">-- bln --</option>
                                        <?= get_bulan() ?>
                                    </select>
                                    <br>
                                    <select name="tgl[2]" style="width:90px" id="thn" class="chosen-select">
                                        <option value="">-- thn --</option>
                                        <?= get_tahun_next() ?>
                                    </select>
                                    <label for="tgl" generated="true" class="error"></label>
                                </div>
                                <br clear="all">
                                <!-- <div class="section"> -->
                                <label class="control-label" style="width:130px;"></label>
                                <div class="controls" style="margin-left:140px;">
                                    <a class="btn btn-small btn-warning" id="tambah">Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget-box" style="margin:10px;">
                            <div class="widget-content" style="border:0">
                                <table class="table table-bordered table-striped table_tr" id="tbTambah">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Obat</th>
                                            <th>Jumlah</th>
                                            <th>Expired Date</th>
                                            <th>Harga Beli (Satuan)</th>
                                            <th>Total</th>
                                            <th style="width:75px">Aksi</th>
                                        </tr>
                                        <tr class="default">
                                            <td colspan="7" style="text-align:center;">Detaill item kosong</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table> 
                            </br>
                                <table class="table">
                                    <tbody>
                                        <!-- <tr>
                                            <td style="width:70%"></td>
                                            <td style="width:10%">Sub Total</td>
                                            <td><input type="text" readonly="readonly" id="tot" name="tot" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>PPn</td>
                                            <td><input type="text" readonly="readonly" id="ppn" name="ppn" autocomplete="off"></td>
                                        </tr> -->
                                        <tr>
                                            <td style="width:70%;border-top:none;">&nbsp;</td>
                                            <td style="width:20%;border-top:none;">Total (+ PPN 10%)</td>
                                            <td style="border-top:none;">
                                                <span id="totalText" style="font-weight:bold;text-align:right;"></span>
                                                <input type="hidden" readonly="readonly" id="total" name="total" autocomplete="off" class="input-small">
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td style="width:70%;border-top:none;">&nbsp;</td>
                                            <td style="width:20%;border-top:none;">Diskon</td>
                                            <td style="border-top:none;">
                                                <input type="text" id="discount" name="discount" autocomplete="off" class="input-small">
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td style="width:70%;border-top:none;">&nbsp;</td>
                                            <td style="width:20%;border-top:none;">Total </td>
                                            <td style="border-top:none;">
                                                <span id="grandText" style="font-weight:bold;text-align:right;"></span>
                                                <input type="hidden" readonly="readonly" id="grand" name="grand" autocomplete="off" class="input-small">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                            
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                            <button style="margin-right:10px;" id="" class="btn pull-right back" type="">Kembali</button>
                        </div>
                    </form>
            </div>                      
        </div>
    </div>
</div>
</div>

<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed">
    <div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" style="display: none; width:50px "></div>
            <img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
            <div class="gritter-with-image" style="width:448px">
                <span class="gritter-title" style="margin-left:36px">Message</span>
                <p>Data Berhasil Disimpan   </p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="gritter-bottom"></div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var count = 0;
        $("#discount").val(0);
        $("#grandText").html(0);
        $("#grand").val(0);
        $("#totalText").html(0);
        $("#total").val(0);
        $("#next").click(function(){
            $("#field1").fadeOut(function(){
                $("#field2").fadeIn();
            })
            return false;
        })
        $(".back").click(function(){
            $("#field2").fadeOut(function(){
                $("#field1").fadeIn();
            })
            return false;
        }) 
        $("#back").click(function(){
            window.history.back(); 
        })
        $("#history").click(function(){
            $("#his").fadeOut(function(){
                $("#history1").fadeIn();
            })
            return false;
        })
        $("#add").click(function(){
            $("#history1").fadeOut(function(){
                $("#his").fadeIn();
            })
            return false;
        })
        $(".form").submit(function(){
            var url  = $(this).attr('action');
            var data = $("#form_sup").serialize()+"&"+$("#form_det").serialize();
            $.post(url,data, function(data) {
                $(".alert").fadeIn().delay(200).fadeOut(function(){
                    $("#back").trigger('click');
                });     
            }); 
            return false;
        });

        $("#harga_beli_total_ppn").change(function(){
            var qty = $("#qty").val();
            var harga_beli_total_ppn    = $(this).val();
            var harga_beli_satuan_ppn   = parseFloat(harga_beli_total_ppn) / parseFloat(qty);
            $("#harga_beli_satuan_ppn").val(harga_beli_satuan_ppn);
        });

        $("#qty").change(function(){
            var qty = $(this).val();
            var harga_beli_total_ppn    = $("#harga_beli_total_ppn").val();
            var harga_beli_satuan_ppn   = parseFloat(harga_beli_total_ppn) / parseFloat(qty);
            $("#harga_beli_satuan_ppn").val(harga_beli_satuan_ppn.toFixed(0));
        });

        // $("#discount").change(function(){
        //     var discount    = $(this).val();
        //     var total       = $("#total").val();
        //     var grandTotal  = total - discount;
        //     $("#grand").val(grandTotal);
        //     $("#grandText").html(grandTotal);
        // });

        $("#tambah").click(function(){
            count += 1;
                var nama    = $("#item").select2('data').text;
                var item    = $("#item").select2('data').id;
                var harga_beli_satuan_ppn   = parseFloat($("#harga_beli_satuan_ppn").val()).toFixed(0);
                var harga_beli_total_ppn   = parseFloat($("#harga_beli_total_ppn").val()).toFixed(0);
                var tgl     = $("#tgl").val();
                var bln     = $("#bln").val();
                var thn     = $("#thn").val();
                var exp     = thn+"-"+bln+"-"+tgl;
                var batch     = $("#batch").val();
                var qty     = $("#qty").val();
                $(".default").hide();
                $("<tr><td>"+item+"</td><td>"+nama+"</td><td style='text-align:center;width:40px'>"+qty+"</td><td style='text-align:center;width:100px'>"+exp+"</td><td style='text-align:right;width:100px'>"+harga_beli_satuan_ppn+"</td><td style='text-align:right;width:100px'>"+harga_beli_total_ppn+"</td><td style='width:5px;text-align:center' class='del'><a href='' class='deletes' style=''><b class='icon-remove'></b></a></td><input id='rows"+count+"' name='rows[]' value='"+item+"|"+qty+"|"+exp+"|"+harga_beli_satuan_ppn+"|"+batch+"' type='hidden'>").appendTo('#tbTambah tbody');
                $("#qty").val("");
                $("#satuan").val("");
                $("#harga_beli_satuan_ppn").val("");
                $("#harga_beli_total_ppn").val("");
                $("#tgl").val("").trigger('liszt:updated');
                $("#bln").val("").trigger('liszt:updated');
                $("#thn").val("").trigger('liszt:updated');
                $("#batch").val("");
                $("#item").select2('val','');
                calculate();
                return false;
        })  


        $(".deletes").die('click').live('click',function(){
            $(this).parent().parent().fadeOut(function(){
                $(this).remove();
                calculate();
            })
            return false;
        });

        function calculate(){
            var total = 0;
            $("#tbTambah tbody tr").each(function(){
                total += parseFloat( ($(this).find('td:eq(5)') ) .html());
            })
            $("#total").val(total);
            $("#totalText").html(formatCurrency(total));
            var discount   = 0;
            var grandTotal = total  - discount;

            $("#grand").val(grandTotal);
            $("#grandText").html(formatCurrency(grandTotal));
        }

        $("#ipo_id").select2({
            minimumInputLength: 2,
            width:'21.5%',
            placeholder : 'Nomor PO',
            ajax: {
                url: BASE+"gudang/receive_item/get_purchase_order",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $("#ipo_supplier").select2({
            minimumInputLength: 2,
            width:'21.5%',
            placeholder : 'Supplier',
            ajax: {
                url: BASE+"gudang/receive_item/get_supplier",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });


        $("#ipo_id").on('change',function(){
            $.getJSON(BASE+"gudang/receive_item/get_detail_purchase_order/"+$("#ipo_id").val(), function(json) {
                $("#ipo_supplier").select2({
                    width:'21.5%',
                    data:[],
                    initSelection : function (element, callback) {
                        var data = {id:json.ipo_supplier,text:json.ipo_supplier_name};
                        callback(data);
                    }
                }).select2("val",json.ipo_supplier);

                $("#ipo_date_req").val(json.ipo_date_req);
                $("#ipo_date_shipping").val(json.ipo_date_shipping);
                var tanggal = "<?php echo date('m/d/Y')?>";
                $("#iri_date_acept").val(tanggal);
                $("#ipo_operator").val(json.ipo_operator);
                $("#ipo_note").html(json.ipo_note);
            })
            cek_po_id();
        });

        function cek_po_id(){
            if( ($("#ipo_id").select2('data').id).substring(0,3) == 'PO-' && ($("#ipo_id").select2('data').id).length == 11 )
                $("#next").removeAttr('disabled');
            else
                $("#next").attr('disabled','disabled');
        }

        $("#item").select2({
            minimumInputLength: 2,
            width:'100%',
            placeholder : 'Pilih Item',
            ajax: {
                url: BASE+"gudang/get_item",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $("#item").on('change',function(){
            $("#harga_beli_total_ppn").focus();
            $.getJSON(BASE+"gudang/get_item_harga/"+$("#item").select2('data').id, function(json) {
                $("#unit").html(json.unit);
                $("#qty").val(1);
            })
        });

        function formatCurrency(num) {
            num = num.toString().replace(/\$|\,/g, '');
            if (isNaN(num)) num = "0";
            sign = (num == (num = Math.abs(num)));
            num = Math.floor(num * 100 + 0.50000000001);
            // cents = num % 100;
            num = Math.floor(num / 100).toString();
            // if (cents < 10) cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
            num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
            // return (((sign) ? '' : '-') + num + '.' + cents);
            return (((sign) ? '' : '-') + num);
        }
        
    })
</script>