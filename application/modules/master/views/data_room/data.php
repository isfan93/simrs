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
				      { "bSortable": true, "aTargets": [ 1 ],"sWidth":"5%" },
				      { "bSortable": true, "aTargets": [ 2  ],"sWidth":"10%" },
				      { "bSortable": true, "aTargets": [ 3 ],"sWidth":"20%" },
				      { "bSortable": true, "aTargets": [ 4 ],"sWidth":"20%" },				      
				      { "bSortable": false, "aTargets": [ 5],"sWidth":"10%" },
              { "bSortable": false, "aTargets": [ 6],"sWidth":"20%" }
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
					<th class="head0" width="20px;"><i class="icon-trash"></i></th>
          <th class="head0" width="40px;">No.</th>
          <th class="head1">Nomor Ruang</th>
					<th class="head1">Pavillion</th>
					<th class="head1">Kelas</th>
					<th class="head1" width="60px;">Harga</th>
					<th class="head1" width="60px;">Action</th>
					 
                </tr>
            </thead>
            
            <tbody id="list-data">

                <?php $i=1; foreach ($datas->result() as $list):?>
                <tr>
				 <td><input type="hidden" class='im_id' value="<?=$list->room_id?>" id="seq_<?=$i?>">
				 <input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->room_id?>" class="chk"></td> 
                  <td class="center"><?=$i++?><input type="hidden" class='' value="<?=$list->room_id?>" id="seq_<?=$i?>"></td>
					<td><div class='shows'><?=$list->room_number?></div>
						<input class="dsim_room" name='' type="hidden" value="<?=$list->room_id?>" >
            <input class="hiddens dsim_rn" name='' type="text" value="<?=$list->room_number?>" >
					</td>
                    <td><div class='shows'><?=$list->pavillion_name?></div>
						<div class='hiddens'><select class='dsim_pav' name='dsim_pav'  style="width:140px">
                          <?foreach ($pav as $keys) :?>
                                <option value="<?=$keys->pavillion_id?>" <?php if($keys->pavillion_id===$list->pavillion_id) echo 'selected="selected"';?> ><?=$keys->pavillion_name?></option>                                
                          <?endforeach?>
						</select>
						</div>
					</td>
            <td><div class='shows'><?=$list->class_name?></div>
						<!--input  class="hiddens dsim_class" name=''  type="text" style='width:30px' value="<?=$list->class_name?>"  -->
						<div class='hiddens'>
                <select class='dsim_class' name='dsim_class'  style="width:140px">
                  <?foreach ($class as $keys) :?>
                        <option value="<?=$keys->class_id?>" <?php if($keys->class_id===$list->class_id) echo 'selected="selected"';?> ><?=$keys->class_name?></option>                                
                  <?endforeach?>
						    </select>
						</div>
					   </td>
             <td><?= int_to_money($list->price) ?></td>
            <td><div class='shows'>
                <?php if($list->room_status == 1):?> 
                  <a class="buttons btn_trash" href="<?=base_url()?>master/data_room/delete_list/<?=$list->room_id?>"></a>
                <?php else: ?>
                  <a class="btn btn-small btn-success btn_aktif" href="<?=base_url()?>master/data_room/aktifkan/<?=$list->room_id?>">Aktifkan</a>
                <?php endif; ?>
                  <a class="buttons btn_pencil" href="<?=base_url()?>master/data_user/edit_list/<?=$list->room_id?>"></a></div> 
                <div class="hiddens"><input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> </div> 
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