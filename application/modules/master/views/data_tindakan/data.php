  <script>
    $(function(){
      
      $('.tabel-master').dataTable( {
				"bProcessing": true,
				"bServerSide": true,
				//"sAjaxSource": "../master/data_server_side.php",
				//"language": {"thousands": "'"},
				"sAjaxSource": "../master/data_tindakan/server_side",
                "sPaginationType": "bootstrap",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
				"aoColumns":[null,null,null,null,null,null,null,null],
                "aoColumnDefs": [
				      { "fnRender": function(objdel){
						return "<input type=checkbox name=chk[] value="+objdel.aData[0]+" class=chk>"
					  }, "aTargets": [ 0 ],"sWidth":"3%"  },
					  { "bSortable": false, "aTargets": [ 1 ],"sWidth":"5%"  },
				      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"20%"  },
				      { "bSortable": false, "aTargets": [ 3 ],"sWidth":"10%" },
				      { "bSortable": false, "aTargets": [ 4 ],"sWidth":"10%" },
					  { "bSortable": false, "aTargets": [ 5 ],"sWidth":"7%" },//int_to_money()<i class="icon-plus-sign icon-white"></i>
					  { "bSortable": false, "aTargets": [ 6 ],"sWidth":"7%" },
					  { "fnRender": function(obj){
						return "<center><a href=\"../master/data_tindakan/get_update/"+obj.aData[7]+"\" class=\"btn btn-default btn-mini\"><i class=\"icon-pencil\"></i></a></center>"
						}, "aTargets": [ 7 ],"sWidth":"10%"}
					  //{ "bSortable": false, "aTargets": [ 7 ],"sWidth":"7%" }
				   ],
                "oLanguage": {
                  "sEmptyTable": "Tindakan tidak tersedia"
                }
            });
			//.makeEditable();
       
		$(".dataTables_filter").hide();
		$('.dataTables_length').hide();
		$("#list-data tr").on("dblclick",function (event){
			//var number=$('#list-data tr').index(this);
			//var value=$('#seq_'+number).val();
			alert("test");
			/*url = "<?=base_url()?>master/data_tindakan/get_pop_update/"+value;
			   $.get(url,function(data){

				  $('.modal-body').children().remove();
				  $('.modal-body').append(data);
					$('#myModalUpt').modal('show');
			   });*/
		})
    })

 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
         
            <thead>
                <tr  role="row">
					<th class="head0" width="20px;"><i class="icon-trash"></i></th>
                    <!-- <th class="head0" width="20px;">No.</th> -->
					<th class="head0" width="40px;">Kode</th>
                    <th class="head1" width="80px;">Jenis Tindakan</th>
					<th class="head1">Kategori</th>
					<th class="head0">Poli</th>
					<th class="head1" width="80px;">Tarif Dasar</th>
                    <th class="head1" width="80px;">Tarif</th>                    
                    <th class="head1" width="80px;">Action</th>
                                     
                </tr>
            </thead>
            
            <tbody id="list-data">

                <?php //$i=1; foreach ($datas->result() as $list):?>
                <!--tr>
					<td><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->treat_id?>" class="chk">
								</td>
                     <!--<td><?=$i?></td>>
                     <td><?=$list->treat_id?><input type="hidden" class="dstreat_id" value="<?=$list->treat_id?>" id="seq_<?=($i-1)?>"></td>
                     <td><div class='shows'><?=$list->treat_name?></div><input class="hiddens dstreatment_name" name='ds[treat_name]' type="text" value="<?=$list->treat_name?>" ></td>
                     <td><div class='shows'><?=$list->koef_treathment?></div>
						<div class="hiddens ">
					  	<select class='dsjenis_tindakan'>
					  		<?php foreach ($kategori as $keys) :?>
                                <option value="<?=$keys->koef_id?>" <?php if($keys->koef_id===$list->koef_id) echo 'selected="selected"';?> ><?=$keys->koef_treathment?></option>
                                
                          	<?php endforeach?>
					  	</select>

					  	</div>
					</td>
					  <td><div class='shows'><?=$list->pl_name?></div>
					  	<div class="hiddens "   type="text" value="<?=$list->poli?>" >
					  	<select class='dspoli'>
					  		<?php foreach ($poli2 as $keys) :?>
                                <option value="<?=$keys->pl_id?>" <?php if($keys->pl_id===$list->poli) echo 'selected="selected"';?> ><?=$keys->pl_name?></option>
                                
                          	<?php endforeach?>
					  	</select>

					  	</div></td>
					<td><div class='shows'><?=int_to_money($list->treat_master_fee)?></div>
						<input style="width:80px;" class="hiddens dstreat_price_master" name='ds[treat_master_fee]' type="text" value="<?=$list->treat_master_fee?>" >
					</td>
					 <td><div class=''><?=int_to_money($list->treat_item_price)?></div><!--input style="width:80px;" class="hiddens dstreat_item_price" name='ds[treat_item_price]' type="text" value="<?=$list->treat_item_price?>" ></td>
					 <td> 
						<div class='shows'><a class="buttons btn_trash" href="<?=base_url()?>master/data_tindakan/delete_list/<?=$list->treat_id?>"></a>
						<a class="buttons btn_pencil" href="<?=base_url()?>master/data_tindakan/edit_list/<?=$list->treat_id?>"></a></div>
						<div class="hiddens"><input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> </div> 
					</td>
                   
                </tr-->
                <?php //$i++; endforeach?>               
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