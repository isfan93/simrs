<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
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
                    <h5>Langkah 1 : Masukkan Supplier</h5>
                </div>
                <div class="widget-content nopadding">
                    <?=form_open(cur_url(-1).'add_order',array('class' => 'form-horizontal form','id' => 'form_sup')); ?>
                        <div class="control-group">
                            <label class="control-label">No Order *</label>
                            <div class="controls">
                                <input type="text" style="width:15%" id="ipo_id" readonly="readonly" name="ds[ipo_id]" value="<?php echo $ipo_id;?>" >
                            </div>
                            <label class="control-label">Supplier *</label>
                            <div class="controls">
                                <input type="hidden" name="ds[ipo_supplier]" id="supplier" class="supplier" value="">
                            </div>
                            <label class="control-label">Tanggal Order *</label>
                            <div class="controls">
                                <input type="text" class="mini datepicker" id="ipo_date_req" name="ipo_date_req" data-date-format="dd-mm-yyyy">
                            </div>
                            <div class="controls">
                                <input type="hidden" placeholder="PPn" class="input input-mini" id="ipo_ppn" value="10" name="ds[ipo_ppn]" readonly="true">
                            </div>
                            <label class="control-label">Petugas *</label>
                            <div class="controls">
                                <input type="text" placeholder="Petugas" class="mini" id="" value="<?=get_user('sd_name')?>" name="" readonly="true">
                                <input type="hidden" placeholder="Petugas" class="mini" id="ipo_operator" value="<?=get_user('user_id')?>" name="ds[ipo_operator]" readonly="true">
                            </div>
                            <label class="control-label">Catatan</label>
                            <div class="controls">
                                <textarea  class="input input-xlarge" cols="" rows="5" style="" id="ipo_note" name="ds[ipo_note]"></textarea>
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
                    <h5 style="width:94%"><span>Langkah 2 : Masukkan Detail Item</span></h5>
                </div>
                <?=form_open(cur_url(-1).'add_order',array('class' => 'form-horizontal form','id'=>'form_det')); ?>
                    <div class="frm_trx" style="width:96%;padding:10px;height:195px;margin:0 auto;margin-top:20px;margin-bottom:20px;border:1px dashed #969696;color:#AAA">
                        <div class="control-group" style="border-bottom:none;">
                            <label class="control-label" style="width:130px;">Item *</label>
                            <div class="controls" style="margin-left:140px;">
                                <input type="hidden" name="" id="item" class="item" value="">
                            </div>
                            <label class="control-label" style="width:130px;">Jumlah *</label>
                            <div class="controls" style="margin-left:140px;">
                                <input type="text" name="" class="input-small" id="qty" autocomplete="off"> <b id="unit"></b>
                            </div>
                            <label class="control-label" style="width:130px;">Harga Beli (Satuan)</label>
                            <div class="controls" style="margin-left:140px;">
                                <input type="text" id="harga_beli" class="input-small" autocomplete="off">
                            </div>
                            <label class="control-label" style="width:130px;">Harga Beli (Total) *</label>
                            <div class="controls" style="margin-left:140px;">
                                <input type="text" class="input-small" id="harga_beli_total" autocomplete="off" readonly="true">
                            </div>
                            <label class="control-label" style="width:130px;"></label>
                            <div class="controls" style="margin-left:140px;">
                                <a class="btn btn-small btn-warning" id="tambah" disabled="disabled">tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-box" style="margin:10px;">
                        <div class="widget-content" style="border:0">
                            <table class="table table-bordered table-striped table_tr" id="tbTambah">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th style="width:150px;">Harga Beli (Satuan)</th>
                                        <th style="width:150px;">Harga Beli (Total)</th>
                                        <th style="width:75px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="default">
                                        <td colspan="6" style="text-align:center;">Detaill item kosong</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align:right;font-weight:bold;">Total</td>
                                        <td id="total" style="text-align:right;"></td>
                                        <td style="text-align:right;"></td>
                                    </tr>
                                </tfoot>
                            </table> 
                        </br>           
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        <!-- <button style="margin-right:10px;" id="reset" class="btn pull-right" type="reset">Reset</button> -->
                            <button style="margin-right:10px;" type="button" id="" class="btn pull-right back" type="">Kembali</button>
                    </div>
                <?=form_close()?>
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
var count = 0;
    $(function(){
        $("#next").click(function(){
            $("#field1").fadeOut(function(){
                $("#field2").fadeIn();
            })
            return false;
        });
        $("#back").click(function(){
            // $("#field2").fadeOut(function(){
            //     $("#field1").fadeIn();
            // })
            // return false;
            window.history.back(); 
        })
        $(".form").submit(function(){
            var url  = $(this).attr('action');
            var data = $("#form_sup").serialize()+"&"+$("#form_det").serialize();
            $.post(url,data, function(data) {
                $(".alert").fadeIn().delay(500).fadeOut(function(){
                    // $("#reset").trigger('click');
                    $("#back").trigger('click');
                });     
            }); 
            return false;
        }) 
        $(".back").click(function(){
            $("#field2").fadeOut(function(){
                $("#field1").fadeIn();
            })
            return false;
        }) 

        $("#tambah").click(function(){
                count += 1;
                $('.default').hide();
                var nama = $("#item").select2('data').text;
                var item = $("#item").select2('data').id;
                var qty     = $("#qty").val();
                var harga_beli     = $("#harga_beli").val();
                var harga_beli_total     = $("#harga_beli_total").val();
                $("<tr><td style='text-align:center;width:10%;'>"+item+"</td><td>"+nama+"</td><td style='text-align:center;width:10%;'>"+qty+"</td><td style='text-align:right;width:10%;'>"+harga_beli+"</td><td style='text-align:right;width:10%;'>"+harga_beli_total+"</td><td style='width:5px;text-align:center' class='del'><a href='' class='deletes' style=''><b class='icon-remove'></b></a></td><input id='rows"+count+"' name='rows[]' value='"+item+"|"+qty+"|"+harga_beli+"|"+harga_beli_total+"' type='hidden'>").appendTo('#tbTambah tbody');
                $("#item").select2("val","");
                $("#qty").val("");
                $("#harga_beli").val("");
                $("#harga_beli_total").val("");
                $(this).attr('disabled','disabled');
                calculate();
                return false;
        })  

        $("#qty").change(function(){
            var qty = $(this).val();
            if(qty != 0){
                var harga_beli  = $("#harga_beli").val();
                var harga_beli_total    = qty * harga_beli;
                $("#harga_beli_total").val(parseFloat(harga_beli_total).toFixed(0));
                $("#tambah").removeAttr('disabled');
            }else{
                $("#tambah").attr('disabled','disabled');
            }
        });

        $("#harga_beli").change(function(){
            var qty = $("#qty").val();
            var harga_beli  = $(this).val();
            var harga_beli_total    = qty * harga_beli;
            $("#harga_beli_total").val(harga_beli_total);
        });

        $(".deletes").die('click').live('click',function(){
            $(this).parent().parent().fadeOut(function(){
                $(this).remove();
                calculate();
            })
            return false;
        })

        function calculate(){
            var total = 0;
            $("#tbTambah tbody tr").each(function(){
                if( parseFloat($(this).find('td:eq(4)').html()) >= parseFloat(0) )
                    total += parseFloat($(this).find('td:eq(4)').html());
            })
            $("#total").html( formatCurrency(parseFloat(total).toFixed(0)) );
        }
        
        $("#supplier").change(function(){
            if( $(this).val() == '' )
                $("#next").attr('disabled','disabled');
            else
                $("#next").removeAttr('disabled');
        })

        $("#supplier").select2({
            minimumInputLength: 2,
            width:'21.5%',
            placeholder : 'Pilih Supplier',
            ajax: {
                url: BASE+"gudang/purchase_order/get_supplier",
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
            width:'21.5%',
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
            $.getJSON(BASE+"gudang/get_item_harga/"+$("#item").val(), function(json) {
                if( json.harga_beli == null)
                    harga_beli = 0;
                else{
                    harga_beli = json.harga_beli;
                    var harga_beli_baru = parseFloat(harga_beli).toFixed(0);
                }
                $("#harga_beli").val(harga_beli_baru);
                $("#unit").html(json.unit);
            })
            $("#qty").focus();
            $("#qty").trigger("change");
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

        var tanggal = "<?php echo date('m/d/Y')?>";
        $("#ipo_date_req").val(tanggal);
        $("#ipo_date_maturity").val(tanggal);
    })
</script>