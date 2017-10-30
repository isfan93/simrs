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
              { "bSortable": false, "aTargets": [ 3 ],"sWidth":"10%" },
					  { "bSortable": false, "aTargets": [ 4 ],"sWidth":"10%" },
					  { "bSortable": false, "aTargets": [ 5 ],"sWidth":"5%" },
					  { "bSortable": true, "aTargets": [ 6 ],"sWidth":"20%" }
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
        <th class="head1">Golongan</th>
        <th class="head1">Harga</th>
		<th class="head1" width="60px;">Tipe</th>
		<th class="head1" width="60px;">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->ds_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='ds_id' value="<?=$list->ds_id?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->ds_name?></div><input class="hiddens ds_name" name='' type="text" value="<?=$list->ds_name?>" ></td>
        <td><div class='shows'><?=$list->golongan_name?></div>
      <div class="hiddens">
      <select class='hiddens dsim_gol'>
        <?php foreach ($golongan as $keys) :?>
          <option value="<?=$keys->id?>" <?php if($keys->id===$list->id) echo 'selected="selected"';?> ><?=$keys->golongan_name?></option>
          
        <?php endforeach?>
      </select>
      </div>
    </td>
        <td class="center"><div class='shows'><?= int_to_money($list->ds_price)?></div><input  class="hiddens ds_price" name='ds_price'  type="text" style='width:80px' value="<?=$list->ds_price?>"  ></td>
        <td class="center"><div class='shows'><?=$list->ds_type?></div>
			<select class="hiddens ds_type" name='ds_type'>
				<option value="<?=$list->ds_type?>">
					<?php if($list->ds_type=="RAD") {echo "Radiologi";} else {echo "Laboratorium";} ?>
				</option>
				<option value="LAB">Laboratorium</option>
				<option value="RAD">Radiologi</option>
			</select>
		</td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_tindakan_lab/edit_list/<?=$list->ds_id?>"></a>
            <a class="buttons btn_trash" style="" href="<?=base_url()?>master/data_tindakan_lab/delete_list/<?=$list->ds_id?>"></a>
			       <a class="buttons btn_book" style="margin-left:10px;" href="<?=base_url()?>master/data_tindakan_lab/detail_list/<?=$list->ds_id?>"></a>
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