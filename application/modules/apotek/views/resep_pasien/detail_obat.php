<script type="text/javascript">
	var incMedicine = 0;
	$(function(){
		$('.btn_add').click(function(){
			var text = '';
			text    += '<tr>';
            text    += '<td style="text-align:center;vertical-align:middle;"><a class="buttons btn_reset_item" select2_id="medicine_'+incMedicine+'" style="background-position: -53px -15px;height:19px;" href="#" racikan_id="0"></a>'+
									'<input type="text" id="medicine_'+incMedicine+'" name="medicine[recipe_medicine][]" class="recipe_medicine" /></td>';
            text    += '<td style="text-align:center;vertical-align:middle;n:center;">'+
            	'<input type="text" class="input aturan" name="medicine[use1][]" id="aturan1_'+incMedicine+'" style="width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center">'+
									'X'+
									'<input type="text" class="input aturan" name="medicine[use2][]" id="aturan2_'+incMedicine+'" style="width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center">'+
									'&nbsp;'+
									'<select class="input input-medium aturan" name="medicine[use3][]" id="aturan3_'+incMedicine+'" style="background:transparent;">'+
										'<option value="Setelah Makan">-</option>'+
										'<option value="Setelah Makan">Setelah Makan</option>'+
										'<option value="Sebelum Makan">Sebelum Makan</option>'+
										'<option value="Sebelum Makan">Lainnya</option>'+
									'</select>'+
            '</td>';
            text    += '<td style="text-align:center;vertical-align:middle;">'+
            		'<input type="text" class="input qty" name="medicine[qty][]" id="jumlah_'+incMedicine+'" style="width:20%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center">'+
            		'<input type="hidden" class="input price" name="medicine[price][]" id="price_'+incMedicine+'">'+
            		'<input type="hidden" class="input batch" name="medicine[batch][]" id="batch_'+incMedicine+'">'+
								'<span id="satuan_'+incMedicine+'" class="satuan"></span>'+
								'<input type="hidden" name="recipe_summary[]" class="recipe_summary" id="recipe_summary_'+incMedicine+'"></input>'+
            		'</td>';
            text    += '<td style="text-align:center;vertical-align:middle;"><input type="text" name="medicine[note][]" class="input note" id="note_'+incMedicine+'" style="background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center"></input></td>';
            text    += '</tr>';
            $("#listObat").append(text);
			$('#medicine_'+incMedicine).select2({
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
	        $('#medicine_'+incMedicine).on("select2-selecting", function(e) {
	          	var url = "<?=base_url()?>apotek/resep_pasien/getMedicineDetail/"+(e.val);
	          	$.getJSON(url,(function(result){
	          		for (var i = 0; i < incMedicine; i++) {
	          			if( $('#medicine_'+i).select2('data') != null )
	          			{
		          			if( e.val == $('#medicine_'+i).select2('data').id )
		          			{
		          				if( (result.istok_item_price != null) )
		          					harga = result.istok_item_price;
		          				else
		          					harga = result.im_item_price;
	          					$("#price_"+i).val(harga);	
	          					$("#batch_"+i).val(result.istok_batch);	
	          					$("#satuan_"+i).html(result.mtype_name);	
	          					$("#jumlah_"+i).val();	
	          					$("#recipe_summary_"+i).attr("recipe_price",harga);	
	          					$("#recipe_summary_"+i).attr("recipe_qty",0);	
	          					$("#recipe_summary_"+i).attr("recipe_medicine",e.val);	
	          					$("#recipe_summary_"+i).attr("recipe_adm",1000);	
	          					calculateAll();
		          			}
		          		}
	          		};
                }));
	        });
			incMedicine++;
			$(".qty").on('change',function(){
				$(this).parent().find('.recipe_summary').attr('recipe_qty',$(this).val());
				calculateAll();
			});
		});

		<?php if(($resep_medicine->num_rows() >= 1)) : ?>
			
		<?php else : ?>
			for (var i = 0; i < 5; i++) {
				$('.btn_add').trigger('click');
			};
		<?php endif;?>
	})
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table table-bordered table-striped table_tr">
				<thead>
					<tr>
						<th style="width:300px;">Obat</th>
						<th style="width:200px;">Aturan Pakai</th>
                        <th style="width:80px;">Jumlah</th>
                        <th style="width:200px;">Catatan</th>
					</tr>
				</thead>
				<tbody id="listObat">
					<?php if(isset($resep_medicine)) : ?>
						<?php $readonly = '';?>
						<?php if($status_bayar_resep != 0) : ?>
							<?php $readonly = 'readonly="readonly"'; ?>
						<?php endif;?>
						<?php foreach ($resep_medicine->result() as $key => $value) : ?>
							<?php
							$aturan = explode(' ', $value->recipe_rule);
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
							<tr>
								<td style="text-align:center;">
									<?php if($status_bayar_resep == 0) : ?>
										<a class="buttons btn_trash" style="background-position: -53px -15px;height:19px;" href="#" racikan_id="0"></a>
									<?php endif;?>
									<input type="text" id="medicine_<?=$key?>" name="medicine[recipe_medicine][]" class="recipe_medicine" value="<?=$value->recipe_medicine?>" <?=$readonly?>/>
								</td>
								<td style="text-align:center;vertical-align:middle;">
									<input type='text' class='input' name='medicine[use1][]' id='aturan1_<?=$key?>' style='width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center' value="<?=$aturan1?>" <?=$readonly?> >
									X
									<input type='text' class='input' name='medicine[use2][]' id='aturan2_<?=$key?>' style='width:5%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center'  value="<?=$aturan2?>" <?=$readonly?> >
									&nbsp;
									<select class='input input-medium' name='medicine[use3][]' id='aturan3_<?=$key?>' style="background:transparent;"  value="<?=$aturan3?>" <?=$readonly?> >
										<option value='-'>-</option>
										<option value='Setelah Makan'>Setelah Makan</option>
										<option value='Sebelum Makan'>Sebelum Makan</option>
										<option value='Lainnya'>Lainnya</option>
									</select>
								</td>
								<td style="text-align:center;">
									<input type='text' class='input qty' name='medicine[qty][]' id='jumlah_<?=$key?>' style='width:20%;background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center' value="<?=(float) $value->recipe_qty?>" <?=$readonly?> >
									<input type="hidden" class="input price" name="medicine[price][]" id="price_<?=$key?>" value="<?=$value->recipe_price?>">
									<input type="hidden" class="input batch" name="medicine[batch][]" id="batch_<?=$key?>" value="<?=$value->recipe_batch?>">
									<span id='satuan_<?=$key?>' class='satuan'><?=$value->mtype_name?></span>
									<input type="hidden" name="recipe_summary[]" class="recipe_summary" id="recipe_summary_<?=$key?>" recipe_price="<?=$value->recipe_price?>" recipe_qty="<?=(float) $value->recipe_qty?>" recipe_medicine="<?=$value->recipe_medicine?>" recipe_adm="1000" ></input>
								</td>
								<td style="text-align:center;">
									<input type="text" class="input" name="medicine[note][]" id="note_<?=$key?>" style='background:transparent;border: none;border-bottom: 1px dotted gray;text-align:center' value="<?=$value->recipe_note?>" <?=$readonly?> ></input>
								</td>
							</tr>
							<script type="text/javascript">
								$(function(){
									var i = incMedicine;
									$('#medicine_'+i).select2({
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
									        var data = {id: '<?=$value->recipe_medicine?>', text: '<?=$value->im_name?>'};
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
							        $('#medicine_'+i).on("select2-selecting", function(e) {
							          	var url = "<?=base_url()?>apotek/resep_pasien/getMedicineDetail/"+(e.val);
							          	$.getJSON(url,(function(result){
							          		// for (var j = 0; j < i; j++) {
							          			if( $('#medicine_'+i).select2('data') != null )
							          			{
								          			if( e.val == $('#medicine_'+i).select2('data').id )
								          			{
							          					if( (result.istok_item_price != null) )
								          					harga = result.istok_item_price;
								          				else
								          					harga = result.im_item_price;
							          					$("#price_"+i).val(harga);	
							          					$("#batch_"+i).val(result.istok_batch);	
							          					$("#satuan_"+i).html(result.mtype_name);	
							          					$("#jumlah_"+i).val();
							          					$("#recipe_summary_"+i).attr("recipe_price",harga);	
							          					$("#recipe_summary_"+i).attr("recipe_qty",0);	
							          					$("#recipe_summary_"+i).attr("recipe_medicine",e.val);	
							          					$("#recipe_summary_"+i).attr("recipe_adm",1000);	
							          					calculateAll();
							          					$(".qty").trigger('change');
								          			}
								          		}
							          		// };
						                }));
							        });

									$(".qty").on('change',function(){
										$(this).parent().find('.recipe_summary').attr('recipe_qty',$(this).val());
										calculateAll();
									});

									incMedicine++;
								});
							</script>
						<?php endforeach;?>
					<?php endif;?>
				</tbody>
                <tfoot>
                	<?php if($status_bayar_resep == 0) : ?>
                        <tr>
	                    	<td colspan="4">
	                    		<button class="btn btn-warning btn-small btn_add" type="button">Tambah Obat</button>
	                    	</td>
	                    </tr>
                    <?php endif;?>
                </tfoot>
			</table>
		</div>
	</div>
</div>
