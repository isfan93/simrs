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
					{ "bSortable": true, "aTargets": [ 1 ],"sWidth":"5%" },
				      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"40%" },				  
					  { "bSortable": true, "aTargets": [ 3 ],"sWidth":"20%" }
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
        <th class="head1">Nama Tindakan</th>        
		<th class="head1" width="60px;">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->diagnosis_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='ds_id' value="<?=$list->diagnosis_id?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->diagnosis_name?></div><input class="hiddens ds_name" name='' type="text" value="<?=$list->diagnosis_name?>" ></td>
		</td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_tindakan_perawat/edit_list/<?=$list->diagnosis_id?>"></a>
            <a class="buttons btn_trash" style="" href="<?=base_url()?>master/data_tindakan_perawat/delete_list/<?=$list->diagnosis_id?>"></a>
			       <a class="buttons btn_book" style="margin-left:10px;" href="<?=base_url()?>master/data_tindakan_perawat/detail_list/<?=$list->diagnosis_id?>"></a>
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