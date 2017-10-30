<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>
<script type="text/javascript">
	$(function(){
		$("#finance_type").select2({
	        minimumInputLength: 0,
            width:'82.5%',
	        placeholder : 'Kategori',
	        ajax: {
	            url: BASE+"keuangan/expenses/getType",
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
	    $('.datepick').datepicker({
	        format: "dd-mm-yyyy",
	        autoclose: true,
	        todayHighlight: true
	    });

	    $("#formExpense").submit(function(){
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
	    	var url = $(this).attr('action');
	        var data = $(this).serialize();
	        $.post(url,data, function(data){
	            setTimeout(function() { 
	                $.unblockUI({
	                    onUnblock: function(){
	                        $(".alert").fadeIn().delay(500).fadeOut(function(){
	                        	resetInput();
	                        	reloadTable();
	                        	// window.history.back();
	                        });
	                    }
	                });
	            }, 1000);  
	        });
	        return false;
        });

        function resetInput(){
		    $('#date').val('');
		    $('#note').val('');
		    $('#none').html("");
		    $('#nominal').val('');
		    $('#finance_type').select2("val","");
		}
		function reloadTable()
		{
			var url = "<?=base_url()?>keuangan/expenses/getDataExpenses"
			$("#dataExpenses").load(url)
		}
		reloadTable();
	});
</script>

<style type="text/css">
    .alert{
        background-color: transparent;
        border: 0px;
    }
    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    .table tr th{
    	line-height: 30px;
    	font-size: 12px;
    }
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>
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

<div class="pageheader notab">
	<h1 class="pagetitle"><?=$title?></h1>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span5">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>                                  
                    </span>
                    <h5>Data Pengeluaran</h5>
                </div>
                <div class="widget-content nopadding">
					<form class="form-horizontal" style="" method="post" id="formExpense" action="<?=base_url()?>keuangan/expenses/saveExpenses">
					    <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
		      			<label class="control-label">Tanggal Transaksi</label>
				        <div class="controls">
				            <input type="text" name="ds[date]" placeholder="mm/dd/yyyy" class="input datepick" id="date">
				        </div>
		          		<label class="control-label">Kategori</label>
				        <div class="controls">
				            <input type="hidden" name="ds[finance_type]" id="finance_type" class="input input-small">
				        </div>
				      	<label class="control-label">Keterangan</label>
				        <div class="controls">
				        	<textarea style="" cols="10" rows="4" name="ds[note]" id="note"></textarea>
				        </div>
				        <label class="control-label">Nominal</label>
			          	<div class="controls">
			            	<input type="text" name="ds[nominal]" id="nominal" placeholder="Rp. 00,00">
			          	</div>
		          		<div class="clearfix"></div>
		          		<div class="form-actions">
		          			<input type="submit" value="Simpan" class="btn btn-primary pull-right">
                        </div>
					</form>
				</div>
			</div>
    	</div>
    	<div class="span7" id="dataExpenses">
    		
    	</div>
	</div>
</div>