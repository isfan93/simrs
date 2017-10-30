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
				      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"20px"  },
				      { "bSortable": false, "aTargets": [ 3 ],"sWidth":"30%"  },
				      { "bSortable": false, "aTargets": [ 1 ] },
				      { "bSortable": false, "aTargets": [ 2 ] }
				   ],
                "oLanguage": {
                  "sEmptyTable": "Tindakan tidak tersedia"
                }
            });
		$(".dataTables_filter").hide();
		$('.dataTables_length').hide();
		$("#list-data tr").on("dblclick",function (event){
			var number=$('#list-data tr').index(this);
			var value=$('#seq_'+number).val();
			//alert(number);
			url = "<?=base_url()?>master/data_tindakan/get_pop_update/"+value;
			   $.get(url,function(data){

				  $('.modal-body').children().remove();
				  $('.modal-body').append(data);
					$('#myModalUpt').modal('show');
			   });
		})
    })

 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
            <thead>
                <tr  role="row">
					<th class="head0" width="20px;"><i class="icon-trash"></i></th>
                    <!-- <th class="head0" width="20px;">No.</th> -->
					<th class="head0" width="40px;">Kode</th>
                    <th class="head1" width="80px;">Paket MCU</th>
					<th class="head1">Detail Paket</th>					
                    <th class="head1" width="80px;">Action</th>
                </tr>
            </thead>
            
            <tbody id="list-data">

                <?php $i=1; foreach ($datas->result() as $list):?>
                <tr>
					<td><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->dmcu_id?>" class="chk">
								</td>
                     <!-- <td><?=$i?></td> -->
                     <td><?=$list->mcu_id?><input type="hidden" class="dsdmcu_id" value="<?=$list->dmcu_id?>" id="seq_<?=($i-1)?>"></td>
                     <td><div class='shows'><?=$list->treat_name?></div>					 
						<div class="hiddens ">
					  	<select class='dsjenis_tindakan'>
					  		<?php foreach ($tindakan as $keys) :?>
                                <option value="<?=$keys->treat_id?>" <?php if($keys->treat_id===$list->treat_id) echo 'selected="selected"';?> ><?=$keys->treat_name?></option>
                                
                          	<?php endforeach?>
					  	</select>

					  	</div>
					</td>					 
					<td><div class='shows'><?=$list->description?></div>
						<input style="width:180px;" class="hiddens dsdescription_mcu" name='' type="text" value="<?=$list->description?>" >
					</td>					 
					 <td> 
					 <div class='shows'><a class="buttons btn_trash" href="<?=base_url()?>master/data_mcu_detail/delete_list/<?=$list->dmcu_id?>"></a>
						<a class="buttons btn_pencil" href="<?=base_url()?>master/data_mcu_detail/edit_list/<?=$list->dmcu_id?>"></a></div> 
					 <div class="hiddens"><input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> </div> 
					 </td>
                   
                </tr>
                <?php $i++; endforeach?>               
            </tbody>
            <tfoot>
            </tfoot>
        </table>
<div id="myModalUpt" class="modal hide">
	<div class="modal-header">
	  <button data-dismiss="modal" class="close" type="button">x</button>
	  <h3>Tambah Tindakan</h3>
	</div>
	<div class="modal-body">
	  

	</div>
</div>

<style type="text/css">
	#list-data .hiddens{
			display: none;
		}
</style>