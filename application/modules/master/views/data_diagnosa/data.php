  <script>
    $(function(){
	
    	 $('.tabel-master').dataTable( {
				"bProcessing": true,
				"bServerSide": true,				
				"sAjaxSource": "../master/data_diagnosa/server_side",
                "sPaginationType": "bootstrap",
                // "sScrollY": "400px",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
				      { "fnRender": function(objdel){
						return "<center><input type=checkbox name=chk[] value="+objdel.aData[0]+" class=chk></center>"
					  }, "aTargets": [ 0 ],"sWidth":"2%"  },
					  { "bSortable": true, "aTargets": [ 1 ],"sWidth":"3%" },
				      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"20%" },
					  { "bSortable": false, "aTargets": [3 ],"sWidth":"20%" },
					  { "bSortable": false, "aTargets": [ 4 ],"sWidth":"20%" },
					  { "fnRender": function(obj){
						return "<center><a href=\"../master/data_diagnosa/get_update/"+obj.aData[5]+"\" class=btn btn-small btn-info><i class=icon-pencil></i></a></center>"
						}, "aTargets": [ 5 ],"sWidth":"3%"}
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
				<th class="head0" width="20px;"><i class="icon-trash"></i></th>
        <!--th class="head0" width="40px;">No.</th-->
        <th class="head1">Kode</th>
		<th class="head1">Diagnosa Name</th>
		<th class="head1">Deskripsi</th>
		<th class="head1">Nama Diagnosa</th>
        <th class="head1">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php //$i=1; foreach ($datas->result() as $list):?>
      <!--tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->diag_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='diag_id' value="<?=$list->diag_id?>" id="seq_<?=$i?>"></td> 
		<td><div class='shows'><?=$list->diag_kode?></div><input class="hiddens dsim_kode" name='' type="text" value="<?=$list->diag_kode?>" ></td>
        <td><div class='shows'><?=$list->diag_name?></div><input class="hiddens dsim_name" name='' type="text" value="<?=$list->diag_name?>" ></td>
        <td><div class='shows'><?=$list->description?></div><input class="hiddens dsim_desc" name='' type="text" value="<?=$list->description?>" ></td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_diagnosa/edit_list/<?=$list->diag_id?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_diagnosa/delete_list/<?=$list->diag_id?>"></a>
          </div>
          <div class="hiddens">
            <input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> 
            </div>
          </td> 
      </tr-->
    <?php //endforeach?>               
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