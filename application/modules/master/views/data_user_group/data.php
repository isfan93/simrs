  <script>
    $(function(){
    	 $('.tabel-master').dataTable( {
                "sPaginationType": "bootstrap",
                // "sScrollY": "400px",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
      				      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"3%"},
      					    { "bSortable": false, "aTargets": [ 1 ],"sWidth":"5%" },
      				      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"40%" },
      					    { "bSortable": false, "aTargets": [ 3 ],"sWidth":"20%" },
      					    { "bSortable": false, "aTargets": [ 4 ],"sWidth":"10%" }
      				   ],
                "oLanguage": {
                  "sEmptyTable": "Obat tidak tersedia"
                }
      });
    	$(".dataTables_filter").hide();
		  $('.dataTables_length').hide();
    })
 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
    <thead>
      <tr  role="row">
		<th class="head0" width="20px;"><i class="icon-trash"></i></th>
        <th class="head0" width="40px;">No.</th>
        <th class="head1">Nama Group</th>        
		<th class="head1">Home Base</th>        
		<th class="head1" width="60px;">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->group_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='ds_id' value="<?=$list->group_id?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->group_name?></div><input class="hiddens ds_name" name='' type="text" value="<?=$list->group_name?>" ></td>               
        <td class="center"><div class='shows'><?=$list->group_homebase ?></div>
			<select class="hiddens ds_type" name='ds_type'>				
				<?php foreach ($home_base as $keys) :?>
                  <option value="<?=$keys->module_url?>" <?php if($keys->module_url===$list->group_homebase) echo 'selected="selected"';?> ><?=$keys->module_name?></option>
                <?php endforeach;?>
			</select>
		</td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_user_group/edit_list/<?=$list->group_id?>"></a>
            <a class="buttons btn_trash" style="" href="<?=base_url()?>master/data_user_group/delete_list/<?=$list->group_id?>"></a>
			<a class="buttons" style="margin-left:10px;" href="<?=base_url()?>master/data_user_group/detail_list/<?=$list->group_id?>"><i class="icon-th-list"></i></a>
          </div>
          <div class="hiddens">
            <input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> 
            </div>
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