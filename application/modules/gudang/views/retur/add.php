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
    .hiddens{
        display: none;
    }
</style>
<script type="text/javascript">
    $(function(){
        $('.datepicker').datepicker({
            minDate: '0',
        });
    });
    </script>
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
                    <h5>Langkah 1 : Masukkan Data Retur</h5>
                </div>
                <div class="widget-content nopadding">
                    <?=form_open(cur_url(-1).'add_retur',array('class' => 'form-horizontal form','id' => 'form_retur')); ?>
                        <div class="control-group">
                            <label class="control-label">No Retur *</label>
                            <div class="controls">
                                <input type="text" style="width:15%" id="ir_id" readonly="readonly" name="ds[ir_id]" value="<?php echo $ir_id;?>" >
                            </div>
                            <label class="control-label">Nomor Faktur *</label>
                            <div class="controls">
                                <input type="hidden" name="ds[faktur_id]" id="faktur_id" class="faktur_id" value="">
                            </div>
                            <!-- <label class="control-label">Supplier *</label>
                            <div class="controls">
                                <input type="hidden" name="ir_supplier" id="ir_supplier" class="ir_supplier" value="">
                            </div> -->
                            <label class="control-label">Tanggal Retur *</label>
                            <div class="controls">
                                <input type="text" class="mini datepicker" name="ds[ir_date]" id="ir_date" data-date-format="dd-mm-yyyy">
                            </div>
                            <label class="control-label">Catatan</label>
                            <div class="controls">
                                <textarea  class="medium" style="width:40%" id="ir_note" name="ds[ir_note]"></textarea>
                            </div>
                            <label class="control-label">Petugas *</label>
                            <div class="controls">
                                <input type="text" placeholder="Petugas" class="mini" id="" value="<?=get_user('sd_name')?>" name="" readonly="true">
                                <input type="hidden" placeholder="Petugas" class="mini" id="ir_operator" value="<?=get_user('emp_id')?>" name="ds[ir_operator]" readonly="true">
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
                    <h5 style="width:94%"><span>Langkah 2 : Masukkan Detail Retur</span></h5>
                </div>
                    <?=form_open(cur_url(-1).'save_retur',array('class' => 'form-horizontal form','id'=>'form_det')); ?>
                        <div id="fakturDetail" style="padding:10px;">
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                            <button style="margin-right:10px;" class="btn pull-right back" type="button">Kemballi</button>
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
var count = 0;
    $(function(){
        $("#next").click(function(){
            $("#field1").fadeOut(function(){
                $("#field2").fadeIn();
                $("#fx_item_input").focus();
            })
            return false;
        })
        $(".back").click(function(){
            $("#field2").fadeOut(function(){
                $("#field1").fadeIn();
            })
            return false;
        })

        $(".deletes").die('click').live('click',function(){
            $(this).parent().parent().fadeOut(function(){
                $(this).remove();
                calculate();
            })
            return false;
        })  

        $(".form").submit(function(){
            var url  = $(this).attr('action');
            var data = $("#form_retur").serialize()+"&"+$("#form_det").serialize();
            $.post(url,data, function(data) {
                $(".alert").fadeIn().delay(200).fadeOut(function(){
                    window.history.back();
                }); 
            }); 
            return false;
        }) 

        $("#tambah").click(function(){
            count += 1;
                var nama    = $("#item").select2('data').text;
                var item    = $("#item").select2('data').id;
                var harga   = $("#harga_beli_total_ppn").val();
                var qty     = $("#qty").val();
                subtot = harga*qty;
                $("<tr><td>"+item+"</td><td>"+nama+"</td><td style='text-align:center;width:40px'>"+qty+"</td><td style='text-align:right;width:70px'>"+harga+"</td><td style='text-align:right;width:100px'>"+subtot+"</td><td style='width:5px;text-align:center' class='del'><a href='' class='deletes' style=''><b class='icon-remove'></b></a></td><input id='rows"+count+"' name='rows[]' value='"+item+"|"+qty+"' type='hidden'>").appendTo('#tbTambah tbody');
                $("#item").select2('val','');
                $("#qty").val("");
                $("#harga_beli_total_ppn").val("");
                calculate();
                return false;
        })   

        function calculate(){
            var total = 0;
            $("#tbTambah tbody tr").each(function(){
                total += parseInt( $(this).find('td:eq(4)').html());
            })
            $("#grand").val(total);
            $("#grandText").html(formatCurrency(total));
        }

        $("#faktur_id").select2({
            minimumInputLength: 2,
            width:'21.5%',
            placeholder : 'Nomor Faktur',
            ajax: {
                url: BASE+"gudang/retur/get_faktur",
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

        $('#faktur_id').on("select2-selecting", function(e) {
            var url = "<?=base_url()?>gudang/retur/get_faktur_detail/"+(e.val);
            $("#fakturDetail").load(url,(function(result){

            }));
        });

        $("#item").select2({
            minimumInputLength: 2,
            width:'30%',
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

        // $("#item").on('change',function(){
        //     $.getJSON(BASE+"gudang/get_item_harga/"+$("#item").select2('data').id, function(json) {
        //         if(json.harga_beli > 0){
        //             $("#harga_beli_total_ppn").val( parseFloat(json.harga_beli).toFixed(0) );
        //         }else{
        //             $("#harga_beli_total_ppn").val(0);
        //         }
        //         $("#unit").html(json.unit);
        //     })
        //     $("#qty").focus();
        // });

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
        $("#ir_date").val(tanggal);
    })
</script>