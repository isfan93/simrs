  <script>
    $(function(){
    	$('.tabel-master').dataTable( {
              
                "sPaginationType": "bootstrap",
                 "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
				      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"2%" },
				      { "bSortable": false, "aTargets": [ 1 ],"sWidth":"5%" },
				      { "bSortable": false, "aTargets": [ 2  ],"sWidth":"10%" },
				      { "bSortable": false, "aTargets": [ 3 ],"sWidth":"20%" },
				      //{ "bSortable": false, "aTargets": [ 4 ],"sWidth":"20%" },				      
				      { "bSortable": false, "aTargets": [ 4],"sWidth":"3%" }
				   ],
                "oLanguage": {
                  "sEmptyTable": "Data user tidak ditemukan"
                }
            });
    	  $(".dataTables_filter").hide();
		$('.dataTables_length').hide();
 	 	$("#list-data tr").on("dblclick",function (event){
			var number=$('#list-data tr').index(this);
			var value=$('#seq_'+number).val();
			alert(number);
		})


    })

 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
 <!--table class="tabel-master table-bordered"-->        
            <thead>
                <tr  role="row">
					<!--th class="head0" width="20px;"><i class="icon-trash"></i></th-->
                    <th class="head0" width="40px;">No.</th>
                    <th class="head1">Nomor Bed</th>
					<th class="head1">Nomor Ruang</th>
					<th class="head1">Pavillion</th>
					<!--th class="head1" width="60px;">Status</th-->
					<th class="head1" width="60px;">Action</th>
					 
                </tr>
            </thead>
            
            <tbody id="list-data">

                <?php $i=1; foreach ($datas->result() as $list):?>
                <tr>
				 <!--td><input type="hidden" class='im_id' value="<?=$list->bed_id?>" id="seq_<?=$i?>">
				 <input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->room_id?>" class="chk"></td--> 
                  <td class="center"><?=$i++?></td>
					<td><?=$list->bed_id?>
						<input class="hiddens dsim_bed" name='' type="text" value="<?=$list->bed_id?>" >						
					</td>
                    <td><div class='shows'><?=$list->room_number?></div>
						<div class='hiddens'><select class='dsim_room' name='dsim_room'  style="width:140px">
                          <?foreach ($room as $keys) :?>
                                <option value="<?=$keys->room_id?>" <?php if($keys->room_id===$list->room_id) echo 'selected="selected"';?> ><?=$keys->room_number?></option>                                
                          <?endforeach?>
						</select>
						</div>
					</td>
					<td><?=$list->pavillion_name?></td>
                    <!--td><div class='shows'><?=$list->status?></div>
						<input class="hiddens dsim_status" name='' type="text" value="<?=$list->status?>" >
						<select class="hiddens dsim_status" id="bed_status">
							<?php /*if($list->status==0){
									echo '<option value="0">Available</option>';
									echo '<option value="1">Not Available</option>';
									}else{
									echo '<option value="1">Not Available</option>';
									echo '<option value="0">Available</option>';									
									}*/
							?>
						</select>	
					</td-->
                    <td> 
                    	<?php if($list->status !=1):?>                    		
                    		<a class="btn btn-small btn-success btn_aktif" href="<?=base_url()?>master/data_bed/aktifkan_bed/<?=$list->bed_id?>">Aktifkan</a>
                    	<?php else: ?>
                    		<div class='shows'><a class="buttons btn_trash" href="<?=base_url()?>master/data_bed/delete_list/<?=$list->bed_id?>"></a></div>
                    	<?php endif; ?>
					<!--a class="buttons btn_pencil" href="<?=base_url()?>master/data_user/edit_list/<?=$list->room_id?>"></a></div> <div class="hiddens"><input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> </div--> 
					</td>
                   
                </tr>
                <?php endforeach?>               
            </tbody>
            <tfoot>
            </tfoot>
        </table>

        <style type="text/css">
        .tabel-master #list-data td{
        	line-height: 10px;
		    padding: 6px;
		        }

		#list-data .hiddens{
			display: none;
		}
        </style>