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
<div id="his">
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
                    <h5>Langkah 1 : Data Faktur</h5>
                </div>
                <div class="widget-content nopadding">
                    <?=form_open(cur_url(-1).'save_faktur',array('class' => 'form-horizontal form','id' => 'form_faktur')); ?>
                        <div class="control-group">
                            <label class="control-label">No Faktur (Sistem) *</label>
                            <div class="controls">
                                <input type="text" class="mini" id="faktur_id" name="ds[faktur_id]" value="<?php echo $faktur_id;?>" readonly="readonly">
                            </div>
                            <label class="control-label">Nomor Faktur (Supplier) *</label>
                            <div class="controls">
                                <input type="text" placeholder="No Faktur" class="mini" id="" value="" name="ds[faktur_number]">
                            </div>
                            <label class="control-label">Supplier *</label>
                            <div class="controls">
                                <input type="hidden" name="ds[faktur_sup]" id="faktur_sup" class="faktur_sup" value="">
                            </div>
                            <label class="control-label">Tanggal Faktur *</label>
                            <div class="controls">
                                <input type="text" class="mini datepicker" name="faktur_date" id="faktur_date" data-date-format="dd-mm-yyyy">
                            </div>
                            <label class="control-label">Jatuh Tempo *</label>
                            <div class="controls">
                                <input type="text" class="mini datepicker" id="faktur_date_maturity" name="faktur_date_maturity" data-date-format="dd-mm-yyyy">
                            </div>
                            <label class="control-label">Catatan</label>
                            <div class="controls">
                                <textarea  class="medium" style="width:40%" id="faktur_note" name="ds[faktur_note]"></textarea>
                            </div>
                            <label class="control-label">Petugas *</label>
                            <div class="controls">
                                <input type="text" placeholder="Petugas" class="mini" id="" value="<?=get_user('sd_name')?>" name="" readonly>
                                <input type="hidden" placeholder="Petugas" class="mini" id="faktur_operator" value="<?=get_user('emp_id')?>" name="ds[faktur_operator]" readonly>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button id="back" class="hide">Kembali</button>
                            <button id="next" class="btn btn-primary pull-right">Lanjut</button>
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
                    <h5 style="width:94%"><span>Langkah 2 : Data Detail Faaktur</span></h5>
                </div>
                    <?=form_open(cur_url(-1).'save_faktur',array('class' => 'form-horizontal form','id'=>'form_det')); ?>
                        <div class="frm_trx" style="width:96%;padding:10px;height:270px;margin:0 auto;margin-top:20px;margin-bottom:20px;border:1px dashed #969696;color:#AAA">
                            <div class="control-group" style="width:50%;float:left;border-bottom:none;">
                                <label class="control-label" style="width:160px;">Item *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="hidden" name="" id="item" class="item" value="">
                                </div>
                                <label class="control-label" style="width:160px;">Harga Beli (Total) *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" onClick="this.select();" class="input-small" id="harga_beli_total" autocomplete="off">
                                    <input type="checkbox" class="checkbox" name="" id="include_ppn" style="margin-left:20px;"><label for="include_ppn" class="">Termasuk PPN</label>
                                </div>
                                <label class="control-label" style="width:160px;">Diskon *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" onClick="this.select();" class="input-small" id="diskon_per_item" autocomplete="off">
                                </div>
                                <label class="control-label" style="width:160px;">PPN *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" onClick="this.select();" class="input-small" id="ppn_per_item" autocomplete="off">
                                </div>
                                <label class="control-label" style="width:160px;">Jumlah *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" name="" onClick="this.select();" class="input-small" id="qty" autocomplete="off"><b id="unit" style="color:#000;"></b>
                                </div>
                                <label class="control-label" style="width:160px;">Harga Satuan *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" id="harga_beli_satuan_ppn" class="input-small" autocomplete="off" readonly="true">
                                </div>
                                <label class="control-label" style="width:160px;">Harga Beli + PPN *</label>
                                <div class="controls" style="margin-left:170px;">
                                    <input type="text" class="input-small" id="harga_beli_total_ppn" autocomplete="off" readonly="true">
                                </div>
                            </div>
                            <div class="control-group" style="width:50%;float:right;">
                                <!-- <label class="control-label" style="width:130px;">Expired Date *</label>
                                <div class="controls" style="margin-left:140px;">
                                    <input type="text" name="" class="input-small datepicker" id="exp" autocomplete="off" placeholder="Expired Date" data-date-format="dd-mm-yyyy">
                                </div>
                                <br clear="all"> -->
                                <label class="control-label" style="width:130px;">Batch *</label>
                                <div class="controls" style="margin-left:140px;">
                                    <input type="text" name="" onClick="this.select();" class="input-small" id="batch" autocomplete="off"><b id="unit"></b>
                                </div>
                                <label class="control-label" style="width:130px;">Expired Date *</label>
                                <div class="controls" style="margin-left:140px;">
                                    <select  name="tgl[0]" style="min-width:90px;width:90px" style="float:left" id="tgl" class="chosen-select">
                                        <option value="" >-- tgl --</option>
                                        <?= get_hari() ?>
                                    </select>
                                    <br>
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
                                    <button class="btn btn-small btn-warning" id="tambah" disabled="disabled" >Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-box" style="margin:10px;">
                            <div class="widget-content" style="border:0">
                                <table class="table table-bordered table-striped table_tr" id="tbTambah">
                                    <thead>
                                        <tr>
                                            <!-- <th>Kode</th> -->
                                            <th>Nama Obat</th>
                                            <th>Jumlah</th>
                                            <th>Expired Date</th>
                                            <th>Harga Supplier</th>
                                            <th>Diskon</th>
                                            <th>PPN</th>
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
                                        <tr>
                                            <td style="width:60%;border-top:none;">&nbsp;</td>
                                            <td style="width:10%;border-top:none;font-weight:bold;">Sub Total</td>
                                            <td style="width:20%;border-top:none;">
                                                <div id="subtotalText" style="font-weight:bold;width:100px;text-align:right;"></div>
                                                <input type="hidden" style="text-align:right;font-weight:bold;" readonly="readonly" id="subtotal" name="ds[faktur_price]" autocomplete="off" class="input-small" value="0">
                                                <input type="checkbox" class="checkbox" name="total_include_ppn" id="total_include_ppn" style="margin-left:20px;"><label for="total_include_ppn" class="">Termasuk PPN</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:60%;border-top:none;">&nbsp;</td>
                                            <td style="width:15%;border-top:none;font-weight:bold;">Diskon</td>
                                            <td style="border-top:none;">
                                                <input type="text" style="text-align:right;font-weight:bold;" id="diskon" name="ds[faktur_discount]" autocomplete="off" class="input-small" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:60%;border-top:none;">&nbsp;</td>
                                            <td style="width:15%;border-top:none;font-weight:bold;">PPN 10%</td>
                                            <td style="border-top:none;">
                                                <div id="pajakText" style="font-weight:bold;width:100px;text-align:right;"></div>
                                                <input type="hidden" style="text-align:right;font-weight:bold;" readonly="readonly" id="pajak" name="ds[faktur_pajak]" autocomplete="off" class="input-small" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:60%;border-top:none;">&nbsp;</td>
                                            <td style="width:15%;border-top:none;font-weight:bold;">Total</td>
                                            <td style="border-top:none;">
                                                <div id="totalText" style="font-weight:bold;width:100px;text-align:right;"></div>
                                                <input type="hidden" style="text-align:right;font-weight:bold;" readonly="readonly" id="total" name="ds[faktur_total]" autocomplete="off" class="input-small" value="0">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                            
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right simpan">Simpan</button>
                            <button style="margin-right:10px;" class="btn pull-right back" type="">Kembali</button>
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

        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $('.datepicker').datepicker({
            // minDate: '0',
        });

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

        $(".form").submit(function(){
            var url  = $(this).attr('action');
            var data = $("#form_faktur").serialize()+"&"+$("#form_det").serialize();
            $.post(url,data, function(data) {
                $(".alert").fadeIn().delay(200).fadeOut(function(){
                    window.history.back();
                });     
            }); 
            return false;
        });

        $("#harga_beli_total, #diskon_per_item, #ppn_per_item, #qty").change(function(){
            calculate_ppn_per_item();
            calculate_harga_beli_satuan_ppn();
            calculate_harga_beli_total_ppn();
            add_button_validate();
        });

        $("#diskon, #total_include_ppn").change(function(){
            calculate();
        });

        $("#tambah").click(function(){
            count += 1;
                var nama    = $("#item").select2('data').text;
                var item    = $("#item").select2('data').id;
                var harga_beli_total   = parseFloat($("#harga_beli_total").val()).toFixed(0);
                var diskon_per_item   = parseFloat($("#diskon_per_item").val()).toFixed(0);
                var ppn_per_item   = parseFloat($("#ppn_per_item").val()).toFixed(0);
                var harga_beli_satuan_ppn   = parseFloat($("#harga_beli_satuan_ppn").val()).toFixed(0);
                var harga_beli_total_ppn   = parseFloat($("#harga_beli_total_ppn").val()).toFixed(0);
                var tgl     = $("#tgl").val();
                var bln     = $("#bln").val();
                var thn     = $("#thn").val();
                var exp     = thn+"-"+bln+"-"+tgl;
                var batch     = $("#batch").val();
                var qty     = $("#qty").val();
                $(".default").hide();
                // <td>"+item+"</td>
                $("<tr><td>"+nama+"</td><td style='text-align:center;width:40px'>"+qty+"</td><td style='text-align:center;width:90px;'>"+exp+"</td><td style='text-align:right;width:90px;'>"+harga_beli_total+"</td><td style='text-align:right;width:90px;'>"+diskon_per_item+"</td><td style='text-align:right;width:90px;'>"+ppn_per_item+"</td><td style='text-align:right;width:90px;'>"+harga_beli_satuan_ppn+"</td><td style='text-align:right;width:90px;'>"+harga_beli_total_ppn+"</td><td style='width:5px;text-align:center' class='del'><a href='' class='deletes' style=''><b class='icon-remove'></b></a></td><input id='rows"+count+"' name='rows[]' value='"+item+"|"+qty+"|"+exp+"|"+harga_beli_satuan_ppn+"|"+batch+"|"+harga_beli_total+"|"+harga_beli_satuan_ppn+"|"+harga_beli_total_ppn+"|"+diskon_per_item+"|"+ppn_per_item+"' type='hidden'>").appendTo('#tbTambah tbody');
                $("#qty").val("");
                $("#satuan").val("");
                $("#harga_beli_satuan_ppn").val("");
                $("#harga_beli_total_ppn").val("");
                $("#harga_beli_total").val("");
                $("#diskon_per_item").val("");
                $("#ppn_per_item").val("");
                $("#tgl").val("").trigger('liszt:updated');
                $("#bln").val("").trigger('liszt:updated');
                $("#thn").val("").trigger('liszt:updated');
                $("#batch").val("");
                $("#item").select2('val','');
                $("#tambah").attr('disabled','disabled');
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

        $("#faktur_sup").select2({
            minimumInputLength: 2,
            width:'21.5%',
            placeholder : 'Supplier',
            ajax: {
                url: BASE+"gudang/faktur/get_supplier",
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
            $("#harga_beli_total").focus();
            $.getJSON(BASE+"gudang/get_item_harga/"+$("#item").select2('data').id, function(json) {
                $("#unit").html(json.unit);
                $("#qty").val("1");
            })
        });

        $("#include_ppn").click(function(){
            var harga_beli_total = parseFloat($("#harga_beli_total").val());
            var qty = parseFloat()
            var ppn = (0.1/ 1.1) * harga_beli_total;
            $("#ppn_per_item").val(ppn.toFixed(0));
            $("#ppn_per_item").trigger('change');
        });

        function calculate(){
            var subtotal = 0;
            var pajak = 0;
            var diskon = 0;
            var total = 0;
            var ppn = 0;
            $("#subtotalText").html("0");
            $("#pajakText").html("0");
            $("#totalText").html("0");
            $("#tbTambah tbody tr").each(function(){
                subtotal += parseFloat( ($(this).find('td:eq(7)') ) .html());
                ppn += parseFloat( ($(this).find('td:eq(5)') ) .html());
            });
            diskon = $('#diskon').val();
            if(diskon == '' || diskon == null){
                diskon = 0;
                pajak = ppn;
            }else{
                diskon = parseFloat(diskon);
                pajak = (subtotal - diskon) * 0.1;
            }
            if( $("#total_include_ppn").is(":checked") )
            {
                total = subtotal - diskon
            }else{
                total = subtotal - diskon + pajak
            }
            
            // pajak = (subtotal - ((parseFloat(subtotal) * 100) / 110)).toFixed(0);
            $("#subtotal").val( (subtotal) );
            $("#pajak").val(pajak);
            $("#total").val(total);
            $("#subtotalText").html( formatCurrency(subtotal) );
            $("#pajakText").html(formatCurrency(pajak));
            $("#totalText").html(formatCurrency(total));
        }

        function calculate_ppn_per_item()
        {
            var harga_beli_total = parseFloat($("#harga_beli_total").val());
            var diskon_per_item = parseFloat($("#diskon_per_item").val());
            var ppn_per_item = 0;
            if( $("#include_ppn").is(":checked") )
            {
                var harga_beli_total = parseFloat($("#harga_beli_total").val());
                ppn_per_item = ((0.1/ 1.1) * harga_beli_total).toFixed(0);
            }else{
                ppn_per_item = parseFloat((harga_beli_total - diskon_per_item) * 0.10).toFixed(0);
            }
            $("#ppn_per_item").val(ppn_per_item);
        }

        function calculate_harga_beli_satuan_ppn()
        {
            var harga_beli_total = parseFloat($("#harga_beli_total").val());
            var diskon_per_item = parseFloat($("#diskon_per_item").val());
            if( $("#include_ppn").is(":checked") )
            {
                var ppn_per_item = 0;
            }else{
                var ppn_per_item = parseFloat($("#ppn_per_item").val());
            }
            var qty     = parseFloat($("#qty").val());
            var harga_beli_satuan_ppn = parseFloat(((harga_beli_total - diskon_per_item) + ppn_per_item) / qty).toFixed(0);
            $("#harga_beli_satuan_ppn").val(harga_beli_satuan_ppn);
        }

        function calculate_harga_beli_total_ppn()
        {
            var harga_beli_total = parseFloat($("#harga_beli_total").val());
            var diskon_per_item = parseFloat($("#diskon_per_item").val());
            if( $("#include_ppn").is(":checked") )
            {
                var ppn_per_item = 0;
            }else{
                // var ppn_per_item = parseFloat($("#ppn_per_item").val());
                var ppn_per_item = 0; // karena bakalan dihitung di akhir setelah diskon
            }
            var harga_beli_total_ppn = parseFloat((harga_beli_total - diskon_per_item) + ppn_per_item).toFixed(0);
            $("#harga_beli_total_ppn").val(harga_beli_total_ppn);
        }

        function add_button_validate()
        {
            var harga_beli_total = parseFloat($("#harga_beli_total").val());
            var diskon_per_item = parseFloat($("#diskon_per_item").val());
            var ppn_per_item = parseFloat($("#ppn_per_item").val());
            var qty = parseFloat($("#qty").val());
            var harga_beli_satuan_ppn = parseFloat($("#harga_beli_satuan_ppn").val());
            var status = true;

            if(isNaN(harga_beli_total) || isNaN(diskon_per_item) || isNaN(ppn_per_item) || isNaN(qty) || isNaN(harga_beli_satuan_ppn))
            {
                status = false;
            }

            // if( (! isNumeric(harga_beli_total)) || (! isNumeric(diskon_per_item)) || (! isNumeric(ppn_per_item)) || (! isNumeric(qty)) )
            // {
            //     status = false;
            // }

            if ( harga_beli_total.length <= 0 || diskon_per_item.length <= 0 || ppn_per_item.length <= 0 || qty.length <= 0 || harga_beli_satuan_ppn.length <= 0 ) 
            {
                status = false;
            }

            if(harga_beli_satuan_ppn == 'Infinity')
            {
                status = false;
            }

            if (status == true) {
                $("#tambah").removeAttr('disabled');
            }else{
                $("#tambah").attr('disabled','disabled');
            }
        }

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