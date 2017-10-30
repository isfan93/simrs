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
				      { "bSortable": true, "aTargets": [ 0 ],"sWidth":"3%"},
						{ "bSortable": false, "aTargets": [ 1 ],"sWidth":"3%" },
						{ "bSortable": false, "aTargets": [ 2 ],"sWidth":"10%" },
						{ "bSortable": false, "aTargets": [ 3 ],"sWidth":"7%" },
						{ "bSortable": false, "aTargets": [ 4 ],"sWidth":"5%" },
						{ "bSortable": false, "aTargets": [ 5 ],"sWidth":"7%" },
				      { "bSortable": false, "aTargets": [ 6 ],"sWidth":"7%" }
					  //{ "bSortable": false, "aTargets": [ 7 ],"sWidth":"10%" },
					  //{ "bSortable": false, "aTargets": [ 8 ],"sWidth":"10%" },
					  //{ "bSortable": false, "aTargets": [ 9 ],"sWidth":"10%" }
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
        <th class="head1">Nama supplier</th>
        <th class="head1">Alamat</th> 
		<!--th class="head1">Kabupaten/Kota</th> 
		<th class="head1">Provinsi</th--> 
		<th class="head1">Telp</th>
		<th class="head1">E-mail</th>
		<!--th class="head1">NPWP</th-->
		<th class="head1">Action</th>		
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->msup_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='msup_id' value="<?=$list->msup_id?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->msup_name?></div><input class="hiddens dsim_name" name='' type="text" value="<?=$list->msup_name?>" ></td>
		<td><div class='shows'>
			<?=$list->msup_address?><br><small>
			<?=$list->mre_name?>-
			<?=$list->mpr_name?></small>
			</div>
			<input class="hiddens dsim_address" name='' type="text" value="<?=$list->msup_address?>" >
			<select class="hiddens dsim_kab" name=''>
				<?php foreach ($kab as $keys) :?>
                  <option value="<?=$keys->mre_id?>" <?php if($keys->mre_id===$list->mre_id) echo 'selected="selected"';?> ><?=$keys->mre_name?></option>
                <?php endforeach;?>
			</select>
			<select class="hiddens dsim_prop" name=''>
				<?php foreach ($prop as $keys) :?>
                  <option value="<?=$keys->mpr_id?>" <?php if($keys->mpr_id===$list->mpr_id) echo 'selected="selected"';?> ><?=$keys->mpr_name?></option>
                <?php endforeach;?>
			</select>
		</td>		
        <!--td><div class='shows'><?=$list->mci_name?></div></td>
		<td><div class='shows'><?=$list->mpr_name?></div></td-->
		<td><div class='shows'><?=$list->msup_telp?></div><input class="hiddens dsim_telp" name='' type="text" value="<?=$list->msup_telp?>" ></td>
		<td><div class='shows'><?=$list->msup_email?></div><input class="hiddens dsim_email" name='' type="text" value="<?=$list->msup_email?>" ></td>
		<!--td><div class='shows'><?=$list->msup_npwp?></div><input class="hiddens dsim_npwp" name='' type="text" value="<?=$list->msup_npwp?>" ></td-->
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_supplier/edit_list/<?=$list->msup_id?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_supplier/delete_list/<?=$list->msup_id?>"></a>
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