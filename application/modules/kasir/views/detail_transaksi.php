<style>
	.summary{cursor:pointer;}
	td.curr{text-align:right;}
	#table_transaksi thead th{height: 28px;vertical-align: middle;font-size: 13px;}
	.money{text-align: right;}
	.black_loader{display: block;opacity: 0.6;}
    #harga{margin-top:26px;}
	#harga td{vertical-align: middle;padding:4px;}
	#harga input{margin:0px;width:150px;}
	.alert{
        background-color: transparent;
        border: 0px;
    }
    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
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
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12" style="background:#E5E5E5;">
         	<div class="title" style="margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;"><h3>Data Pasien</h3></div>
            <div class="title" style="float:right;margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;margin-right:20px;"><h3><?php echo pretty_date(date('Y-m-d'),false);?></h3></div>
            <br clear="all">
            <div class="row-fluid">
	            <div class="span2">
	                <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:20px;">
	                    <div style="float:left;">
	                        <b>Nomor RM</b>
	                    </div>
	                    <div style="float:left;margin-left:10px;">
	                        <b>: <?=(isset($patient->sd_rekmed))? $patient->sd_rekmed : '-'?></b>
	                    </div>
	                </div>
	            </div>
	            <div class="span2">
	                <div style="padding:10px;float:left;width:100%;">
	                    <div style="float:left;">
	                        <b>Nama</b>
	                    </div>
	                    <div style="float:left;margin-left:10px;">
	                        <b>: <?=(isset($patient->sd_name))? $patient->sd_name : '-'?></b>
	                    </div>
	                </div>
	            </div>
	            <div class="span2">
	                <div style="padding:10px;float:left;width:100%;">
	                    <div style="float:left;">
	                        <b>JK</b>
	                    </div>
	                    <div style="float:left;margin-left:10px;">
	                        <b>: <?=(isset($patient->sd_sex)) ? (($patient->sd_sex == 'L' ) ? 'laki-laki' : 'perempuan') : '-' ?></b>
	                    </div>
	                </div>
	            </div>

	            <div class="span2">
	                <div style="padding:10px;float:left;width:100%;">
	                    <div style="float:left;">
	                        <b>Umur</b>
	                    </div>
	                    <div style="float:left;margin-left:10px;">
	                        <b>: <?=(isset($patient->sd_age)) ? $patient->sd_age : '-'?> Tahun</b>
	                    </div>
	                </div>
	            </div>
	            <div class="span2">
	                <div style="padding:10px;float:left;width:100%;">
	                    <div style="float:left;">
	                        <b>Gol. Darah</b>
	                    </div>
	                    <div style="float:left;margin-left:10px;">
	                        <b>: <?=isset($patient->sd_blood_tp) ? $patient->sd_blood_tp : '-' ?></b>
	                    </div>
	                </div>
	            </div>
            </div>
        </div>
    </div>

    <div class='row-fluid' style="min-height:416px">
    	<div style="margin-top:20px;">
			<?=form_open(base_url().'kasir/bayar',array('class' => 'form-horizontal','id' => 'form')); ?>
	    	<div class="span7">
				<div style="float:right;">
                    <a href="" class="btn btn-link" id="checkAll" style="font-size:12px"><i class="icon-ok"></i> Check all</a>
                    <a href="" class="btn btn-link" id="uncheckAll" style="font-size:12px"><i class="icon-remove"></i> Uncheck all</a>
                </div>
                <br />
				<table id='table_transaksi' class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width:10px;">No.</th>
							<th>Penggunaan</th>
							<th style="width:100px;">Harga</th>
							<th style="width:100px;">Tanggungan</th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($bill)) : ?>
						<?php foreach($bill as $service_id => $bill_per_date) : ?>
							<?php foreach($bill_per_date as $date => $services) : ?>
								<tr>
									<td colspan="4" style="font-weight:bold;text-align:left;">
										<input class="bill-per-date" style="float:left;" type="checkbox" name="bill_per_date[]" value="<?=$service_id?>_<?=$date?>">
										<label class="summary" style="width:250px;float:left;text-align:left;padding-top:0px;padding-left:10px;">
											<?php
												switch(substr($service_id, 0,2)){
													case 'RJ' : $service_name = 'RAWAT JALAN (POLI)';
														break;
													case 'RN' : $service_name = 'RAWAT INAP';
														break;
													case 'IG' : $service_name = 'INSTALASI GAWAT DARURAT';
														break;
													case 'LB' : $service_name = 'LABORATORIUM';
														break;
													case 'RD' : $service_name = 'RADIOLOGI';
														break;
													case 'PU' : $service_name = 'Pembelian Umum';
														break;
												}
											?>
											<i class="icon-chevron-down"></i> <?= "Pemeriksaan : ".$service_name;?>
										</label>
										<span class="pull-right"><?=pretty_date($date,false)?></span>
									</td>
								</tr>
								<tr class="collapsible">
									<td colspan="4">
										<table id="paymentDetails_<?=$service_id?>_<?=$date?>" class="table table-bordered">
											<?php foreach($services as $service_type => $service) : ?>
												<tr>
													<td colspan="4" style="font-weight:bold;">
													<?php foreach($mst_service->result() as $ms) : ?>
														<?php if($ms->service_id == $service_type) : ?>
															<?=$ms->service_name;?>
														<?php endif;?>
													<?php endforeach;?>
													</td>
												</tr>
												<?php $no = 0;?>
												<?php foreach($service as $bill_details) : ?>
													<tr>
														<td style="width:10px;"><?=++$no?></td>
														<td><?=$bill_details->service_name?></td>
														<td style="width:100px;text-align:right;"><?=number_format($bill_details->price, 0, ",", "."); ?></td>
														<td class="total-price" style="width:100px;text-align:right;">
															<?=number_format($bill_details->total_price, 0, ",", "."); ?>
														</td>
														<?php if($bill_details->service_type == 8) :?>
															<input type="hidden" name="room_service" value="<?=$service_id?>_<?=$date?>">
															<input type="hidden" name="room_service_name" value="<?=$bill_details->service_name?>">
															<input type="hidden" name="room_service_price" value="<?=$bill_details->total_price?>">
														<?php endif;?>
													</tr>
												<?php endforeach;?>
											<?php endforeach;?>
										</table>
									</td>
								</tr>
							<?php endforeach;?>
						<?php endforeach;?>
					<?php else : ?>
						<tr>
							<td colspan="4">Belum ada tagihan untuk pasien ini</td>
						</tr>
					<?php endif;?>
					</tbody>
				</table>
			</div>

			<div class="span4" style="border:1px solid #DDD;">
				<div style="padding-left:20px;padding-right:20px;padding-bottom:20px;">
					<table id="harga">
						<tr>
							<td style="text-align:right;font-weight:bold;">Discount</td> 
							<td  style="text-align:right;font-weight:bold;">
								<input name="discount" type="text" class="money" onClick="this.select();" id="discountPayment" value="0" style="width:70%;" />
							</td>
						</tr>
						<!-- <tr> -->
							<!-- <td style="text-align:right;font-weight:bold;">Tambahan Biaya</td>  -->
							<!-- <td  style="text-align:right;font-weight:bold;"> -->
								<input name="additional" type="hidden" class="money" onClick="this.select();" id="additionalPayment" value="0" style="width:70%;" />
							<!-- </td> -->
						<!-- </tr> -->
						<tr>
							<td style="text-align:right;font-weight:bold;">Total Tanggungan : </td> 
							<td  style="text-align:right;font-weight:bold;">
								<input type="hidden" class="money" id="totalPayment" readonly="readonly" value="0" style="width:94%;" />
								<span id="totalPaymentText">0</span>
							</td>
						</tr>
					</table>
				</div>
				<div class="form-actions" style="padding-left:0px;">
					<button type="button" id="simpan" href="" class="btn btn-primary pull-right" >Bayar</button>
					<a href="<?=cur_url(-3)?>pelaporan/kunjungan/detail/<?=$visit_id?>" target="_blank" class="btn btn-info pull-right" style="margin-right:20px;">Cetak Nota</a>
					<!-- cetak resume: hendri, 11 februari 2015 -->
				</div>
			</div>
			<?=form_close()?>
			<div class="span7">
				<caption><b>Tambahan Biaya Administrasi Lain : </b></caption>
				<?=form_open(base_url().'kasir/saveAdditionalFee',array('class' => 'form-horizontal','id' => 'formAdditionalfee')); ?>
					<input type="hidden" name="sd_rekmed" value="<?=$patient->sd_rekmed?>">
					<table style="margin-top:10px;margin-bottom:10px;">
						<tr>
							<td style="width:100px;"><b>Keterangan</b></td>
							<td>
								<textarea name="keterangan" id="additional_fee_keterangan" placeholder="Keterangan"></textarea>
							</td>
						</tr>
						<tr>
							<td><b>Harga</b></td>
							<td>
								<input type="text" name="harga" id="additional_fee_harga" placeholder="Total Price">
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<button type="button" class="btn btn-small btn-warning additional_fee">Tambah</button>
							</td>
						</tr>
					</table>
				<?=form_close()?>
				<div id="additionalFee"></div>
			</div>
		</div>
    </div>
</div>

<?php $this->load->view('notice') ?>

<script type="text/javascript">

	function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g, '');
		if (isNaN(num)) num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num * 100 + 0.50000000001);
		// cents = num % 100;
		num = Math.floor(num / 100).toString();
		// if (cents < 10) cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
		num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
		// return (((sign) ? '' : '-') + num + '.' + cents);
		return (((sign) ? '' : '-') + num);
	}

	$(document).ready(function(){
		var total_price = 0;
		var service_id_count = 0;

		$('input[type=checkbox]').prop('checked', false);
		$("#simpan").attr("disabled","disabled");
		$(".collapsible").hide();
		$('.summary').click(function () {
            if ($(this).closest('tr').next(".collapsible").is(':visible')) {
            	$(this).find("i").removeClass('icon-chevron-up').addClass('icon-chevron-down');
                $(this).closest('tr').next(".collapsible").hide();
            } else {
            	$(this).find("i").removeClass('icon-chevron-down').addClass('icon-chevron-up');
                $(this).closest('tr').next(".collapsible").show();
            }
        });

        $('#checkAll').click(function (e) {
            e.preventDefault();
            $(".bill-per-date").each(function (i, v) {
                if (!($(v).is(':checked'))) {
                    $(v).prop('checked', true).trigger('change');
                }
            });
            $('#simpan').prop('disabled', false);
        });

        $('#uncheckAll').click(function (e) {
            e.preventDefault();
            $(".bill-per-date").each(function (i, v) {
                if ($(v).is(':checked')) {
                    $(v).prop('checked', false).trigger('change');
                }
            });
            $('#simpan').prop('disabled', true);
        });

		var liability = 0;
        $(".bill-per-date").change(function () {
            $('#simpan').prop('disabled', true);
            var billPerDate = $(this).val();
            if ($(this).is(':checked')) {
            	$('#paymentDetails_' + billPerDate + ' .total-price').each(function (i, v) {
            		liability += parseFloat($(v).text().replace(/\./g, ''));
                });
            } else {
                $('#paymentDetails_' + billPerDate + ' .total-price').each(function (i, v) {
                    liability -= parseFloat($(v).text().replace(/\./g, ''));
                });
            }
            $(".bill-per-date").each(function (i, v) {
                if ($(v).is(':checked')) {
                    $('#simpan').prop('disabled', false);
                }
            });

            $("#totalPayment").val(liability);
            $("#totalPaymentText").html(formatCurrency(liability));
            $("#liability").val(formatCurrency(liability));
            calculatePayment();
        });

        $("#discountPayment").change(function(){
        	calculatePayment();
        });
        $("#additionalPayment").change(function(){
        	calculatePayment();
        });

        function calculatePayment()
        {
        	var totalPayment = parseFloat($("#totalPayment").val());
        	var discountPayment = parseFloat($("#discountPayment").val());
        	var additionalPayment = parseFloat($("#additionalPayment").val());
        	if( !(isNaN(discountPayment)) && !(isNaN(additionalPayment)) ){
        		totalPayment = totalPayment - discountPayment + additionalPayment;
	        	$("#totalPaymentText").html(formatCurrency(totalPayment));
	        	$("#liability").val(formatCurrency(totalPayment));
        	}
        }

		$("#simpan").click(function(){
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
            var url  = $("#form").attr('action');
			var data = $("#form").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
			    			window.location = "<?=base_url()?>kasir";
                        });
                    }
                });
            });
            return false;
		});

		$(".additional_fee").click(function(){
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
            var url  = $("#formAdditionalfee").attr('action');
			var data = $("#formAdditionalfee").serialize();
            $.post(url,data, function(data){
                $.unblockUI({
                    onUnblock: function(){
                        $(".alert").fadeIn().delay(500).fadeOut(function(){
                        	$("#additional_fee_keterangan").val("");
                        	$("#additional_fee_harga").val("");
			    			var url_additionalfee = "<?=base_url()?>kasir/additionalFee/<?=$visit_id?>";
							$("#additionalFee").load(url_additionalfee);
                        });
                    }
                });
            });
            return false;
		});
		var url_additionalfee = "<?=base_url()?>kasir/additionalFee/<?=$visit_id?>";
		$("#additionalFee").load(url_additionalfee);
	})
</script>