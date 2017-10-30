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
                    { "bSortable": true, "aTargets": [ 2 ],"sWidth":"25%" },
                    { "bSortable": true, "aTargets": [ 3 ],"sWidth":"25%" },
                    { "bSortable": true, "aTargets": [ 4 ],"sWidth":"20%" },
                    { "bSortable": true, "aTargets": [ 5 ],"sWidth":"10%" },
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
				<th class=""><i class="icon-trash"></i></th>
        <th class="">No.</th>
        <th class="head1">Nama Dokter</th>
				<th class="head1">Spesialis Bidang</th>
				<th class="head1">Harga Jasa</th>
				<th class="head1">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php if($datas->num_rows() >= 1 ) :?>
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="" value="<?=$list->tdf_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='tdf_id' value="<?=$list->tdf_id?>" id="seq_<?=$i?>"></td>
        <td class="left">
            <div class=''><?=$list->sd_name?></div>
        </td>
        <td class="left">
            <div class=''><?=$list->description?></div>
        </td>
        <td class="" style="text-align:right;">
          <div class='shows'>
            <?=int_to_money($list->dr_fee)?>
          </div>
          <input  class="hiddens dr_fee input-small" name='dr_fee' type="text" style="text-align:right;" value="<?=$list->dr_fee?>"  >
        </td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_jasa_dokter/edit_list/<?=$list->tdf_id?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_jasa_dokter/delete_list/<?=$list->tdf_id?>"></a>
          </div>
          <div class="hiddens">
            <input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> 
            </div>
          </td> 
      </tr>
    <?php endforeach;?>  
    <?php endif;?>             
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