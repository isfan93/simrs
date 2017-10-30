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
				      { "bSortable": false, "aTargets": [ 6 ],"sWidth":"20%" }
				   ],
                "oLanguage": {
                  "sEmptyTable": "Jadwal tidak tersedia"
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
        <th class="head1">Nama Dokter</th>
				<th class="head1">Hari</th>
				<th class="head1" width="60px;">Shift</th>
				<!--th class="head1" width="60px;">Jam Selesai</th-->
				<th class="head1" width="60px;">Nama Poli</th> 
				<th class="head1" width="60px;">Action</th> 
      </tr>

    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->sch_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='sch_id' value="<?=$list->sch_id?>" id="seq_<?=$i?>"></td> 
        <td><?=$list->sd_name?><div class='shows'></div>
			<!--input class="hiddens dssch_name" name='' type="text" value="<?=$list->sd_name?>" -->
		</td>
        <td class="center">
            <div class='shows'><?=$list->day?></div>
            <div class='hiddens'>
             <select name='mst[day]' required id='day' style="width:140px;float:left;"  class="sch_day">
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
										<option value="Rabu">Rabu</option>
										<option value="Kamis">Kamis</option>
										<option value="Jumat">Jumat</option>
										<option value="Sabtu">Sabtu</option>
										<option value="Ahad">Ahad</option>
                                    </select>				
			</div>
        </td>
        <td class="center">
			<div class='shows'><?=$list->shift_start?> - <?=$list->shift_end?></div>
			<!--input  class="hiddens dssch_min_stock" name='dssch_min_stock'  type="text" style='width:30px' value="<?=$list->shift_start?>" -->
			<div class='hiddens'>
             <select class='sch_shift' name='sch_shift'  style="width:140px">
                <?php foreach ($shift as $keys) :?>
                  <option value="<?=$keys->shift_id?>" <?php if($keys->shift_id===$list->sch_shift) echo 'selected="selected"';?> ><?=$keys->shift_start?> - <?=$keys->shift_end?></option>
                <?php endforeach;?>
              </select>				
			</div>
		</td>
        <!--td class="center">
			<div class='shows'><?=$list->shift_end?></div>
			<input class="hiddens dssch_max_stock" name='dssch_max_stock'  type="text" style='width:30px' value="<?=$list->shift_end?>" >
		</td-->
         <td class="center">
            <div class='shows'><?=$list->pl_name?></div>
            <div class='hiddens'>
             <select class='sch_pl' name='sch_pl'  style="width:140px">
                <?php foreach ($poli2 as $keys) :?>
                  <option value="<?=$keys->pl_id?>" <?php if($keys->pl_id===$list->poli_id) echo 'selected="selected"';?> ><?=$keys->pl_name?></option>
                <?php endforeach;?>
              </select>				
			</div>
        </td>

        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/jadwal_dokter/edit_list/<?=$list->sch_id?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/jadwal_dokter/delete/<?=$list->sch_id?>"></a>
          </div>
          <div class="hiddens">
            <input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> 
            </div>
          </td> 
      </tr>
    <?php endforeach;?>               
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