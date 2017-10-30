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
				      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"30%" },
					  { "bSortable": true, "aTargets": [ 3 ],"sWidth":"7%" }
				   ],
                "oLanguage": {
                  "sEmptyTable": "Data tidak tersedia"
                }
      });
    	$(".dataTables_filter").hide();
		  $('.dataTables_length').hide();
    })
 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
    <thead>
      <tr  role="row">
		<th><i class="icon-trash"></i></th>
        <th>No.</th>
        <th>Tipe User</th>
        <th>Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->id_type_user?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='ins_id' value="<?=$list->id_type_user?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->description?></div><input class="hiddens dsim_name" name='' type="text" value="<?=$list->description?>" ></td>
        
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_type_user/edit_list/<?=$list->id_type_user?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_type_user/delete_list/<?=$list->id_type_user?>"></a>
			<!-- <a class="btn btn-default" style="margin-left:10px;" href="<?=base_url()?>master/data_type_user/detail_list/<?=$list->id_type_user?>">detail</a> -->
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