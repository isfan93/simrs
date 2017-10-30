  <script>
    $(function(){
    	 $('.tabel-masterX').dataTable( {
                "sPaginationType": "bootstrap",
                // "sScrollY": "400px",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
				      { "bSortable": true, "aTargets": [ 0 ],"sWidth":"3%"},
					    { "bSortable": true, "aTargets": [ 1 ],"sWidth":"7%"},
				      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"20%"},
					    { "bSortable": false, "aTargets": [ 3 ],"sWidth":"10%"},
					    { "bSortable": true, "aTargets": [ 4 ],"sWidth":"5%" },
					    { "bSortable": true, "aTargets": [ 5 ],"sWidth":"5%" },
					    { "bSortable": true, "aTargets": [ 6 ],"sWidth":"5%" },
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
	#list{
		
	}
	.no{
		width: 5px !important;
	}
	.ns{
		width: 10px !important;
	}
	table{
		width: 100% !important;
	}
 </style>
<table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
    <thead>
      <tr id="list">		
        <th class="no">No.</th>
        <th class="ns">Nama Sediaan</th>		
		<th class="ns">Satuan</th>
    <th class="ns">Stok</th>
		<th class="ns">Expired</th>
		<th class="ns">No. Batch</th>
    <th class="ns">Harga Jual</th>
        <th class="no">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php $i=1; foreach ($datas->result() as $list):?>
      <tr>        
        <td class="center"><?=$i++?></td> 
        <td><div class=''><?=$list->im_name?></div>
            <input type="hidden" class='dsim_id' value="<?=$list->istok_id?>" id="seq_<?=$i?>">
            <input type="hidden" class='dsim_item' value="<?=$list->istok_item?>" id="seq_<?=$i?>">
            </td>        
        <td><div class=''><?=$list->mtype_name?></div></td>
        <td><div class='shows'><?= number_format($list->istok_qty,0)?></div><input class="hiddens dsim_qty" name='' type="text" value="<?=number_format($list->istok_qty,0)?>" size="10px"></td>
		    <td><div class='shows'><?=$list->istok_exp?></div><input class="hiddens dsim_ed" name='' type="text" value="<?=$list->istok_exp?>" size="10px"></td>
		    <td><div class='shows'><?=$list->istok_batch?></div><input class="hiddens dsim_batch" name='' type="text" value="<?=$list->istok_batch?>" ></td>
		    <td><div class='shows'><?= 'Rp. '. number_format($list->istok_item_price,2,',','.')?></div><input class="hiddens dsim_price" name='' type="text" value="<?=$list->istok_item_price?>" ></td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>gudang/stok/edit_list/<?=$list->istok_id?>"></a>            
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