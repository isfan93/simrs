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
					  { "bSortable": false, "aTargets": [ 1 ],"sWidth":"7%"},
				      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"20%"},
					  { "bSortable": false, "aTargets": [ 3 ],"sWidth":"10%"},
					 { "bSortable": false, "aTargets": [ 4 ],"sWidth":"5%" },
					  { "bSortable": false, "aTargets": [ 5 ],"sWidth":"5%" },
					  { "bSortable": false, "aTargets": [ 6 ],"sWidth":"5%" },
					  { "bSortable": false, "aTargets": [ 7 ],"sWidth":"7%" },
				   ],
                "oLanguage": {
                  "sEmptyTable": "Data tidak tersedia"
                }
      });
    	$(".dataTables_filter").hide();
		  $('.dataTables_length').hide();
    })
 </script>
 <style>
	#list_lab_detail{
		
	}
	.no_lab_detail{
		width: 5px !important;
	}
	.ns_lab_detail{
		width: 10px !important;
	}
	table{
		width: 100% !important;
	}
 </style>
<table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
    <thead>
      <tr id="list_lab_detail">
		<th class="no_lab_detail"><i class="icon-trash"></i></th>
        <th class="no_lab_detail">No.</th>
        <th class="ns_lab_detail">Nama Tindakan</th>
		<th class="ns_lab_detail">NS Laki-laki</th>
		<th class="ns_lab_detail">NS Wanita</th>
		<th class="ns_lab_detail">Satuan</th>
		<th class="ns_lab_detail">Golongan</th>
        <th class="no_lab_detail">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->dsd_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='dsim_id' value="<?=$list->dsd_id?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->dsd_name?></div><input class="hiddens dsim_name" name='' type="text" value="<?=$list->dsd_name?>" ></td>
        <td><div class='shows'><?=$list->dsd_standart_value_male?></div><input class="hiddens dsim_svm" name='' type="text" value="<?=$list->dsd_standart_value_male?>" size="10px"></td>
		<td><div class='shows'><?=$list->dsd_standart_value_female?></div><input class="hiddens dsim_svf" name='' type="text" value="<?=$list->dsd_standart_value_female?>" size="10px"></td>
		<td><div class='shows'><?=$list->dsd_satuan?></div><input class="hiddens dsim_sat" name='' type="text" value="<?=$list->dsd_satuan?>" ></td>
		<td><div class='shows'><?=$list->golongan_name?></div>
			<div class="hiddens">
			<select class='hiddens dsim_gol'>
				<?php foreach ($golongan as $keys) :?>
					<option value="<?=$keys->id?>" <?php if($keys->id===$list->id) echo 'selected="selected"';?> ><?=$keys->golongan_name?></option>
					
				<?php endforeach?>
			</select>
			</div>
		</td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_lab_treathment_detail/edit_list/<?=$list->dsd_id?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_lab_treathment_detail/delete_list/<?=$list->dsd_id?>"></a>
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
    	line-height: 0px;
      /*padding: 6px;*/
    }

    #list-data .hiddens{
      display: none;
	  width: 120px !important;
    }
</style>