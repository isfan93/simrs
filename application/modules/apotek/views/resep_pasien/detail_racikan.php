<script type="text/javascript">
	var incRacikan = 0;
	var incRacikanMedicine = 0;
	$(function(){
		$('.btn_add_racikan').click(function(){
			text    = '<tr style="background-color:#f9f9f9 !important;">';
            text    += '<td style="text-align:left;vertical-align:middle;background-color:#f9f9f9 !important;border-bottom:1px solid #dddddd !important;border-top:10px solid #dddddd;"><a class="buttons btn_trash" style="background-position: -53px -15px;height:19px;" href="#" racikan_id="'+incRacikan+'"></a>'+
						'<input type="text" id="racikan_'+incRacikan+'" name="racikan[racikan_name]['+incRacikan+']" class="racikan_name input-xlarge" placeholder="Nama Racikan" /></td>';
            text    += '<td style="text-align:center;vertical-align:middle;background-color:#f9f9f9 !important;border-bottom:1px solid #dddddd !important;border-top:10px solid #dddddd;">'+
            	'<input type="text" class="input" name="racikan[racikan_use1]['+incRacikan+']" id="aturan1_'+incRacikan+'" style="width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center">'+
									'X'+
									'<input type="text" class="input" name="racikan[racikan_use2]['+incRacikan+']" id="aturan2_'+incRacikan+'" style="width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center">'+
									'&nbsp;'+
									'<select class="input input-medium" name="racikan[racikan_use3]['+incRacikan+']" id="aturan3_'+incRacikan+'" style="background:transparent;">'+
										'<option value="-">-</option>'+
										'<option value="Setelah Makan">Setelah Makan</option>'+
										'<option value="Sebelum Makan">Sebelum Makan</option>'+
										'<option value="Lainnya">Lainnya</option>'+
									'</select>'+
            '</td>';
            text    += '<td style="text-align:center;vertical-align:middle;background-color:#f9f9f9 !important;border-bottom:1px solid #dddddd !important;border-top:10px solid #dddddd;">'+
            		'<input type="hidden" name="racikan[racikan_sediaan]['+incRacikan+']" id="racikan_sediaan_'+incRacikan+'" class="racikan_sediaan">'+
					'<input type="hidden" name="racikan[racikan_tuslah_type]['+incRacikan+']" id="racikan_tuslah_type_'+incRacikan+'" class="racikan_tuslah_type" />'+
					'<input type="hidden" name="racikan_summary[]" id="racikan_summary_'+incRacikan+'" class="recipe_summary"></input>'+
            		'</td>';
            text    += '</tr>';
			for (var i = 0; i <= 7; i++) {
	            text    += '<tr style="background-color:#FFFFFF !important;" class="detail_'+incRacikan+'">';
	            text    += '<td colspan="3" style="background-color:#FFFFFF !important;border-top:none;">'+
	            		'<div class="racikanMedicine" style="width:38%;float:left;margin-left:50px;"><a class="buttons btn_reset" style="background-position: -53px -15px;height:19px;" href="#" select2_id="racikan_medicine_'+incRacikan+'_'+i+'"></a>Obat '+(i+1)+' <input type="hidden" name="racikan_medicine[racikan_medicine]['+incRacikan+'][]" id="racikan_medicine_'+incRacikan+'_'+i+'"></div>'+
	            		'<div class="racikanMedicineQty" style="width:7%;float:left;margin-left:10px;"><input type="text" id="racikanMedicineQty_'+incRacikan+'_'+i+'" name="racikan_medicine[racikan_medicine_qty]['+incRacikan+'][]" class="input input-mini qty" placeholder="Jumlah"></div>'+
	            		'<div class="racikanMedicineSatuan" id="racikanMedicineSatuan_'+incRacikan+'_'+i+'" style="width:5%;float:left;margin-left:10px;"></div>'+
	            		'<input type="hidden" class="input price" name="racikan_medicine[racikan_medicine_price]['+incRacikan+'][]" id="racikanMedicinePrice_'+incRacikan+'_'+i+'">'+
	            		'<input type="hidden" class="input batch" name="racikan_medicine[racikan_medicine_batch]['+incRacikan+'][]" id="racikanMedicineBatch_'+incRacikan+'_'+i+'">'+
						'<input type="hidden" name="racikan_medicine_summary[]" class="recipe_summary" id="racikan_medicine_summary_'+incRacikan+'_'+i+'"></input>';
	            text    += '</td>';
	            text    += '</tr>';
            };
			$("#listRacikan").append(text);
            for (var i =  0; i <= 7; i++) {
            	$('#racikan_medicine_'+incRacikan+'_'+i).select2({
		            width : '300px',
		            placeholder: "Pilih Obat / Alkes",
		            minimumInputLength : 3,
		            ajax: {
				        url:  BASE + "apotek/resep_pasien/getMedicineAjax",
				        dataType: 'json',
				        type: "POST",
				        quietMillis: 50,
				        data: function (term) {
				            return {
				                term: term,
				                "<?php echo $this->security->get_csrf_token_name()?>" : "<?php echo $this->security->get_csrf_hash()?>",
				            };
				        },
				        results: function (data) {
				            return {
				                results: $.map(data, function (item) {
				                    return {
				                        text: item.im_name,
				                        id: item.im_id
				                    }
				                })
				            };
				        }
				    },
		            createSearchChoice:function(term, data) {
		                if ( $(data).filter( function() {
		                   return this.text.localeCompare(term)===0;
		                }).length===0) {
		                   return {id:term, text:term};
		                }
		            },
		        });
		        $('#racikan_medicine_'+incRacikan+'_'+i).on("select2-selecting", function(e) {
		          	var url = "<?=base_url()?>apotek/resep_pasien/getMedicineDetail/"+(e.val);
		          	$.getJSON(url,(function(result){
		          		for (var j = 0; j < incRacikan; j++) {
		          			for (var k = 0; k <= 2; k++) {
			          			if( $('#racikan_medicine_'+j+'_'+k).select2('data') != null )
			          			{
				          			if( e.val == $('#racikan_medicine_'+j+'_'+k).select2('data').id )
				          			{
				          				if( (result.istok_item_price != null) )
				          					harga = result.istok_item_price;
				          				else
				          					harga = result.im_item_price;

				          				if( ((result.kel_name) != null) && (result.kel_name == 'Tuslah') )
				          					recipe_adm = 0;
				          				else
				          					recipe_adm = 1000;
			          					$("#racikanMedicineSatuan_"+j+'_'+k).html(result.mtype_name);	
			          					$("#racikanMedicinePrice_"+j+'_'+k).val(harga);	
			          					$("#racikanMedicineBatch_"+j+'_'+k).val(result.istok_batch);	
			          					$("#racikanMedicineQty_"+j+'_'+k).val();	
			          					$("#racikan_medicine_summary_"+j+'_'+k).attr("recipe_price",harga);	
			          					$("#racikan_medicine_summary_"+j+'_'+k).attr("recipe_qty",0);	
			          					$("#racikan_medicine_summary_"+j+'_'+k).attr("recipe_medicine",e.val);	
			          					$("#racikan_medicine_summary_"+j+'_'+k).attr("recipe_adm",recipe_adm);	
			          					$("#racikanMedicineQty_"+j+'_'+k).focus();
			          					calculateAll();
				          			}
				          		}
		          			};
		          		};
	                }));
		        });
            };
			$('#racikan_sediaan_'+incRacikan).select2({
	            width : '30%',
	            placeholder: "Sediaan",
	            data : [
	                {id:'serbuk',text:'serbuk'},
	                {id:'kapsul',text:'kapsul'},
	                {id:'salep',text:'salep'},
	            ],
	        });
	        $('#racikan_tuslah_type_'+incRacikan).select2({
	            width : '60%',
	            placeholder: "Tipe Tuslah",
	            data : [
	                <?php foreach ($racikan_fee->result() as $k => $v) : ?>
	                    <?php echo '{id:'.$v->id.',text:"'.$v->description.'"},';?>
	                <?php endforeach;?>
	            ],
	        });
	        $('#racikan_tuslah_type_'+incRacikan).on("select2-selecting", function(e) {
	          	var url = "<?=base_url()?>apotek/resep_pasien/getTuslahType/"+(e.val);
	          	$.getJSON(url,(function(result){
	          		for (var j = 0; j < incRacikan; j++) {
	          			if( $('#racikan_tuslah_type_'+j).select2('data') != null )
	          			{
		          			if( e.val == $('#racikan_tuslah_type_'+j).select2('data').id )
		          			{
	          					$("#racikan_summary_"+j).attr("recipe_tuslah_price",result.fee);	
	          					calculateAll();
		          			}
		          		}
	          		};
                }));
	        });
			incRacikan++;

			$(".qty").on('change',function(){
				$(this).parent().parent().find('.recipe_summary').attr('recipe_qty',$(this).val());
				calculateAll();
			});
		});
        <?php if(($racikan_medicine->num_rows() >= 1)) : ?>
        
		<?php else : ?>
			for (var i = 0; i < 2; i++) {
				$('.btn_add_racikan').trigger('click');
			};
		<?php endif;?>
	});
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table table-bordered table-striped table_tr">
				<thead>
                    <tr>
                        <th style="width:300px;">Nama Racikan</th>
                        <th style="width:150px;">Aturan Pakai</th>
                        <th style="width:270px;">Sediaan / Biaya Tusla</th>
                    </tr>
                </thead>
				<tbody id="listRacikan">
					<?php if(isset($racikan_medicine)) : ?>
						<?php $readonly = '';?>
						<?php if($status_bayar_resep != 0) : ?>
							<?php $readonly = 'readonly="readonly"'; ?>
						<?php endif;?>
						<?php foreach ($racikan_medicine->result() as $key => $value) : ?>
							<?php
							$aturan = explode(' ', $value->racikan_rule);
							if(is_array($aturan)){
								$aturan1 = isset($aturan[0]) ? $aturan[0] : '';
								$aturan2 = isset($aturan[2]) ? $aturan[2] : '';
								$aturan3 = '';
								for ($j=3; $j < sizeof($aturan) ; $j++) { 
									$aturan3 .= $aturan[$j];
									if(($j+1) < sizeof($aturan)){
										$aturan3 .= ' ';
									}
								}
							}else{
								$aturan1 = '';
								$aturan2 = '';
								$aturan3 = '';
							}
							?>
							<tr style="background-color:#f9f9f9 !important;">
								<td style="text-align:left;vertical-align:middle;background-color:#f9f9f9 !important;border-bottom:1px solid #dddddd !important;border-top:10px solid #dddddd;">
									<?php if($status_bayar_resep == 0) : ?>
										<a class="buttons btn_trash" style="background-position: -53px -15px;height:19px;" href="#" racikan_id="<?=$value->racikan_id?>"></a>
									<?php endif;?>
									<input type="text" name="racikan[racikan_name][<?=$key?>]" class="input-xlarge" value="<?=$value->racikan_name?>" <?=$readonly?> />
									<input type="hidden" name="racikan[racikan_id][<?=$key?>]" class="input-xlarge" value="<?=$value->racikan_id?>" <?=$readonly?> />
								</td>
								<td style="text-align:center;vertical-align:middle;background-color:#f9f9f9 !important;border-bottom:1px solid #dddddd !important;border-top:10px solid #dddddd;">
									<input type='text' class='input' name='racikan[racikan_use1][<?=$key?>]' id='aturan1_<?=$key?>' style='width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center' value="<?=$aturan1?>" <?=$readonly?> />
									X
									<input type='text' class='input' name='racikan[racikan_use2][<?=$key?>]' id='aturan2_<?=$key?>' style='width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center' value="<?=$aturan2?>" <?=$readonly?> />
									&nbsp;
									<select class='input input-medium' name='racikan[racikan_use3][<?=$key?>]' id='aturan3_<?=$key?>' style="background:transparent;" value="<?=$aturan3?>" <?=$readonly?> >
										<option value='-'>-</option>
										<option value='Setelah Makan'>Setelah Makan</option>
										<option value='Sebelum Makan'>Sebelum Makan</option>
										<option value='Lainnya'>Lainnya</option>
									</select>
								</td>
								<td style="text-align:center;vertical-align:middle;background-color:#f9f9f9 !important;border-bottom:1px solid #dddddd !important;border-top:10px solid #dddddd;">
									<input type="hidden" name="racikan[racikan_sediaan][<?=$key?>]" id="racikan_sediaan_<?=$key?>" class="racikan_sediaan" value="<?=$value->racikan_sediaan?>" <?=$readonly?> />
									<input type="hidden" name="racikan[racikan_tuslah_type][<?=$key?>]" id="racikan_tuslah_type_<?=$key?>" class="racikan_tuslah_type" value="<?=$value->racikan_tuslah_type?>" <?=$readonly?> />
									<input type="hidden" name="racikan_summary[]" id="racikan_summary_<?=$key?>" class="recipe_summary" recipe_tuslah_price="<?=$value->fee?>" />
								</td>
							</tr>
							<?php if(isset($racikan_medicine_detail[$value->racikan_id])) : ?>
								<?php foreach ($racikan_medicine_detail[$value->racikan_id] as $k => $v) : ?>
									<tr style="background-color:#FFFFFF !important;" class="detail_<?=$value->racikan_id?>">
										<td colspan="3" style="background-color:#FFFFFF !important;border-top:none;">
											<div class="racikanMedicine"  style="width:35%;float:left;margin-left:50px;">
												<?php if($status_bayar_resep == 0) : ?>
													<a class="buttons btn_reset" style="background-position: -53px -15px;height:19px;" href="#" select2_id="racikan_medicine_<?=$key?>_<?=$k?>"></a>
												<?php endif;?>
												Obat <?=($k+1)?>
												<input type="hidden" class="racikan_medicine" name="racikan_medicine[racikan_medicine][<?=$key?>][]" id="racikan_medicine_<?=$key?>_<?=$k?>" value="<?=$v->racikan_medicine?>" <?=$readonly?> />
											</div>
											<div class="racikanMedicineQty" style="width:7%;float:left;margin-left:10px;">
												<input type="text" id="racikanMedicineQty_<?=$key?>_<?=$k?>" name="racikan_medicine[racikan_medicine_qty][<?=$key?>][]" class="input input-mini qty" placeholder="Jumlah" value="<?=(float) $v->racikan_medicine_qty?>" <?=$readonly?> />
											</div>
											<div class="racikanMedicineSatuan" id="racikanMedicineSatuan_<?=$key?>_<?=$k?>" style="width:5%;float:left;margin-left:10px;">
												<?=$v->mtype_name?>
											</div>
											<input type="hidden" class="input price" name="racikan_medicine[racikan_medicine_price][<?=$key?>][]" id="racikanMedicinePrice_<?=$key?>_<?=$k?>" value="<?=$v->racikan_medicine_price?>" />
											<input type="hidden" class="input batch" name="racikan_medicine[racikan_medicine_batch][<?=$key?>][]" id="racikanMedicineBatch_<?=$key?>_<?=$k?>" value="<?=$v->racikan_medicine_batch?>" />
											<input type="hidden" name="racikan_medicine_summary[]" class="recipe_summary" id="racikan_medicine_summary_<?=$key?>_<?=$k?>" recipe_price="<?=$v->racikan_medicine_price?>" recipe_qty="<?=(float) $v->racikan_medicine_qty?>" recipe_medicine="<?=$v->racikan_medicine?>" recipe_adm="1000" />
										</td>
									</tr>
									<script type="text/javascript">
										var i = "<?=$k?>";
										$('#racikan_medicine_'+incRacikan+'_'+i).select2({
								            width : '300px',
								            placeholder: "Pilih Obat / Alkes",
								            minimumInputLength : 3,
								            ajax: {
										        url:  BASE + "apotek/resep_pasien/getMedicineAjax",
										        dataType: 'json',
										        type: "POST",
										        quietMillis: 50,
										        data: function (term) {
										            return {
										                term: term,
										                "<?php echo $this->security->get_csrf_token_name()?>" : "<?php echo $this->security->get_csrf_hash()?>",
										            };
										        },
										        results: function (data) {
										            return {
										                results: $.map(data, function (item) {
										                    return {
										                        text: item.im_name,
										                        id: item.im_id
										                    }
										                })
										            };
										        }
										    },
										    initSelection : function (element, callback) {
										        var data = {id: '<?=$v->racikan_medicine?>', text: '<?=$v->im_name?>'};
										        callback(data);
										    },
								            createSearchChoice:function(term, data) {
								                if ( $(data).filter( function() {
								                   return this.text.localeCompare(term)===0;
								                }).length===0) {
								                   return {id:term, text:term};
								                }
								            },
								        });
								        $('#racikan_medicine_'+incRacikan+'_'+i).on("select2-selecting", function(e) {
								          	var url = "<?=base_url()?>apotek/resep_pasien/getMedicineDetail/"+(e.val);
								          	$.getJSON(url,(function(result){
							          			if( $('#racikan_medicine_'+incRacikan+'_'+i).select2('data') != null )
							          			{
								          			if( e.val == $('#racikan_medicine_'+incRacikan+'_'+i).select2('data').id )
								          			{
								          				harga = 0;
							          					if( (result.istok_item_price != null) )
								          					harga = result.istok_item_price;
								          				else
								          					harga = result.im_item_price;

								          				if( ((result.kel_name) != null) && (result.kel_name == 'Tuslah') )
								          					recipe_adm = 0;
								          				else
								          					recipe_adm = 1000;
							          					$("#racikanMedicineSatuan_"+incRacikan+'_'+i).html(result.mtype_name);	
							          					$("#racikanMedicinePrice_"+incRacikan+'_'+i).val(harga);	
							          					$("#racikanMedicineBatch_"+incRacikan+'_'+i).val(result.istok_batch);	
							          					$("#racikanMedicineQty_"+incRacikan+'_'+i).val();	
							          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_price",harga);	
							          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_qty",0);	
							          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_medicine",e.val);	
							          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_adm",recipe_adm);	
							          					$("#racikanMedicineQty_"+incRacikan+'_'+i).focus();	
							          					calculateAll();
								          			}
								          		}
							                }));
								        });
									</script>
								<?php endforeach;?>
							<?php endif;?>
							<?php for ($k= $k+1; $k <= 7 ; $k++) : ?>
								<tr style="background-color:#FFFFFF !important;" class="detail_<?=$value->racikan_id?>">
									<td colspan="3" style="background-color:#FFFFFF !important;border-top:none;">
										<div class="racikanMedicine"  style="width:35%;float:left;margin-left:50px;">
											<?php if($status_bayar_resep == 0) : ?>
												<a class="buttons btn_reset" style="background-position: -53px -15px;height:19px;" href="#" select2_id="racikan_medicine_<?=$key?>_<?=$k?>"></a>
											<?php endif;?>
											Obat <?=($k+1)?>
											<input type="hidden" class="racikan_medicine" name="racikan_medicine[racikan_medicine][<?=$key?>][]" id="racikan_medicine_<?=$key?>_<?=$k?>" value="" <?=$readonly?> />
										</div>
										<div class="racikanMedicineQty" style="width:7%;float:left;margin-left:10px;">
											<input type="text" id="racikanMedicineQty_<?=$key?>_<?=$k?>" name="racikan_medicine[racikan_medicine_qty][<?=$key?>][]" class="input input-mini qty" placeholder="Jumlah" value="" <?=$readonly?> />
										</div>
										<div class="racikanMedicineSatuan" id="racikanMedicineSatuan_<?=$key?>_<?=$k?>" style="width:5%;float:left;margin-left:10px;">
											
										</div>
										<input type="hidden" class="input price" name="racikan_medicine[racikan_medicine_price][<?=$key?>][]" id="racikanMedicinePrice_<?=$key?>_<?=$k?>" value="" />
										<input type="hidden" class="input batch" name="racikan_medicine[racikan_medicine_batch][<?=$key?>][]" id="racikanMedicineBatch_<?=$key?>_<?=$k?>" value="" />
										<input type="hidden" name="racikan_medicine_summary[]" class="recipe_summary" id="racikan_medicine_summary_<?=$key?>_<?=$k?>" recipe_price="" recipe_qty="" recipe_medicine="" recipe_adm="1000" />
									</td>
								</tr>
								<script type="text/javascript">
									var i = "<?=$k?>";
									$('#racikan_medicine_'+incRacikan+'_'+i).select2({
							            width : '300px',
							            placeholder: "Pilih Obat / Alkes",
							            minimumInputLength : 3,
							            ajax: {
									        url:  BASE + "apotek/resep_pasien/getMedicineAjax",
									        dataType: 'json',
									        type: "POST",
									        quietMillis: 50,
									        data: function (term) {
									            return {
									                term: term,
									                "<?php echo $this->security->get_csrf_token_name()?>" : "<?php echo $this->security->get_csrf_hash()?>",
									            };
									        },
									        results: function (data) {
									            return {
									                results: $.map(data, function (item) {
									                    return {
									                        text: item.im_name,
									                        id: item.im_id
									                    }
									                })
									            };
									        }
									    },
									    initSelection : function (element, callback) {
									        var data = {id: '<?=$v->racikan_medicine?>', text: '<?=$v->im_name?>'};
									        callback(data);
									    },
							            createSearchChoice:function(term, data) {
							                if ( $(data).filter( function() {
							                   return this.text.localeCompare(term)===0;
							                }).length===0) {
							                   return {id:term, text:term};
							                }
							            },
							        });
							        $('#racikan_medicine_'+incRacikan+'_'+i).on("select2-selecting", function(e) {
							          	var url = "<?=base_url()?>apotek/resep_pasien/getMedicineDetail/"+(e.val);
							          	$.getJSON(url,(function(result){
						          			if( $('#racikan_medicine_'+incRacikan+'_'+i).select2('data') != null )
						          			{
							          			if( e.val == $('#racikan_medicine_'+incRacikan+'_'+i).select2('data').id )
							          			{
							          				harga = 0;
						          					if( (result.istok_item_price != null) )
							          					harga = result.istok_item_price;
							          				else
							          					harga = result.im_item_price;

							          				if( ((result.kel_name) != null) && (result.kel_name == 'Tuslah') )
							          					recipe_adm = 0;
							          				else
							          					recipe_adm = 1000;
						          					$("#racikanMedicineSatuan_"+incRacikan+'_'+i).html(result.mtype_name);	
						          					$("#racikanMedicinePrice_"+incRacikan+'_'+i).val(harga);	
						          					$("#racikanMedicineBatch_"+incRacikan+'_'+i).val(result.istok_batch);	
						          					$("#racikanMedicineQty_"+incRacikan+'_'+i).val();	
						          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_price",harga);	
						          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_qty",0);	
						          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_medicine",e.val);	
						          					$("#racikan_medicine_summary_"+incRacikan+'_'+i).attr("recipe_adm",recipe_adm);	
						          					$("#racikanMedicineQty_"+incRacikan+'_'+i).focus();	
						          					calculateAll();
							          			}
							          		}
						                }));
							        });
								</script>
							<?php endfor;?>
							<script type="text/javascript">
								$('#racikan_sediaan_'+incRacikan).select2({
						            width : '30%',
						            placeholder: "Sediaan",
						            data : [
						                {id:'serbuk',text:'serbuk'},
						                {id:'kapsul',text:'kapsul'},
						                {id:'salep',text:'salep'},
						            ],
						        });
						        $('#racikan_tuslah_type_'+incRacikan).select2({
						            width : '60%',
						            placeholder: "Tipe Tuslah",
						            data : [
						                <?php foreach ($racikan_fee->result() as $k => $v) : ?>
						                    <?php echo '{id:'.$v->id.',text:"'.$v->description.'"},';?>
						                <?php endforeach;?>
						            ],
						        });
						        $('#racikan_tuslah_type_'+incRacikan).on("select2-selecting", function(e) {
						          	var url = "<?=base_url()?>apotek/resep_pasien/getTuslahType/"+(e.val);
						          	$.getJSON(url,(function(result){
						          		for (var k = 0; k < incRacikan; k++) {
						          			if( $('#racikan_tuslah_type_'+k).select2('data') != null )
						          			{
							          			if( e.val == $('#racikan_tuslah_type_'+k).select2('data').id )
							          			{
						          					$("#racikan_summary_"+k).attr("recipe_tuslah_price",result.fee);	
						          					calculateAll();
							          			}
							          		}
						          		};
					                }));
						        });
								incRacikan++;
							</script>
						<?php endforeach;?>
					<?php endif;?>
				</tbody>
                <tfoot>
                	<?php if($status_bayar_resep == 0) : ?>
                        <tr>
	                    	<td colspan="3">
	                    		<button class="btn btn-warning btn-small btn_add_racikan" type="button">Tambah Racikan</button>
	                    	</td>
	                    </tr>
                    <?php endif;?>
                </tfoot>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){

		$(".qty").on('change',function(){
			$(this).parent().parent().find('.recipe_summary').attr('recipe_qty',$(this).val());
			calculateAll();
		});

	});
</script>