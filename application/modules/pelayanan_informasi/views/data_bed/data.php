  <script>
    $(function(){
    	$('.tabel-master').dataTable( {
            "sPaginationType": "bootstrap",
             "bPaginate": true,
            "bFilter": true,
            "bRetrieve": true,
             "bDestroy": true,
            "bSort": true,
            "aoColumnDefs": [
			      { "bSortable": true, "aTargets": [ 0 ],"sWidth":"2%" },
			      { "bSortable": true, "aTargets": [ 1 ],"sWidth":"5%" },
			      { "bSortable": true, "aTargets": [ 2  ],"sWidth":"10%" },
			      { "bSortable": true, "aTargets": [ 3 ],"sWidth":"20%" },
			      { "bSortable": true, "aTargets": [ 4 ],"sWidth":"20%" },
				{ "bSortable": true, "aTargets": [ 5 ],"sWidth":"20%" }
			      //{ "bSortable": false, "aTargets": [ 6],"sWidth":"3%" }
			   ],
            "oLanguage": {
              "sEmptyTable": "Data tidak ditemukan"
            }
        });
    	$(".dataTables_filter").hide();
		$('.dataTables_length').hide();
 	 	$("#list-data tr").on("dblclick",function (event){
			var number=$('#list-data tr').index(this);
			var value=$('#seq_'+number).val();
			alert(number);
		})
    });
 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
    <thead>
        <tr  role="row">
			<!--th class="head0" width="20px;"><i class="icon-trash"></i></th-->
            <th class="head0" width="40px;">No.</th>
            <th class="head1">Nomor Bed</th>
			<th class="head1">Nomor Ruang</th>
			<th class="head1">Pavillion</th>
			<th class="head1">Kelas</th>
			<th class="head1" width="60px;">Status</th>
			<!--th class="head1" width="60px;">Action</th-->
			 
        </tr>
    </thead>
    
    <tbody id="list-data">

        <?php $i=1; foreach ($datas->result() as $list):?>
        <tr>
        	<td class="center"><?=$i++?></td>
			<td><?=$list->bed_id?>
				<input class="hiddens dsim_bed" name='' type="text" value="<?=$list->bed_id?>" >						
			</td>
            <td><div class='shows'><?=$list->room_id?></div>
				<div class='hiddens'><select class='dsim_room' name='dsim_room'  style="width:140px">
                  <?foreach ($room as $keys) :?>
                        <option value="<?=$keys->room_id?>" <?php if($keys->room_id===$list->room_id) echo 'selected="selected"';?> ><?=$keys->room_id?></option>                                
                  <?endforeach?>
				</select>
				</div>
			</td>
			<td><?=$list->pavillion_name?></td>
			<td><?=$list->class_name?></td>
            <td><div class='shows'><?php
				if($list->status_bed!=1){
					echo '<b style="color:green">Kosong</b>';
				}else{
					echo '<b style="color:red">Isi</b>';
				}
				?></div>						
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
.tabel-master{
	width: 100% !important;
}
</style>