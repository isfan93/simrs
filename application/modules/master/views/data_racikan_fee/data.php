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
              { "bSortable": true, "aTargets": [ 1 ],"sWidth":"7%" },
				      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"40%" },
					  { "bSortable": false, "aTargets": [ 3 ],"sWidth":"7%" },
					  { "bSortable": false, "aTargets": [ 4 ],"sWidth":"7%" }
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
        <th class="head0" width="40px;">No.</th>
        <th class="head1">Kemasan</th>
		<th class="head1">Tarif</th>
        <th class="head1">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='ins_id' value="<?=$list->id?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->description?></div><input class="hiddens dsim_name" name='' type="text" value="<?=$list->description?>" ></td>
        <td><div class='shows' style="float:right;"><?=int_to_money($list->fee)?></div><input class="hiddens dsim_fee" name='' type="text" value="<?=$list->fee?>" ></td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_racikan_fee/edit_list/<?=$list->id?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_racikan_fee/delete_list/<?=$list->id?>"></a>
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