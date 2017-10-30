  <script>
  function reloadcurrent(){
    $('tabel-master').dataTable()._fnAjaxUpdate();
  }
    $(function(){
    	 $('.tabel-master').dataTable( {
				"bProcessing": true,
				"bServerSide": true,
        "bStatSave"  : true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            reloadcurrent();
            return JSON.parse(localStorage.getItem('offersDataTables'));
        },
				"sAjaxSource": "../master/data_obat/server_side",
        "sPaginationType": "bootstrap",
        // "sScrollY": "400px",
        "bPaginate": true,        
        "bFilter": true,
        "bRetrieve": true,
         "bDestroy": true,
        "bSort": true,
        "aoColumnDefs": [
				      { "fnRender": function(objdel){
						return "<input type=checkbox name=chk[] value="+objdel.aData[0]+" class=chk>"
					  }, "aTargets": [ 0 ],"sWidth":"3%"  },
              { "bSortable": true, "aTargets": [ 1 ],"sWidth":"5%" },
			  { "bSortable": true, "aTargets": [ 2 ],"sWidth":"20%" },
			  { "bSortable": true, "aTargets": [ 3 ],"sWidth":"5%" },
			  { "bSortable": true, "aTargets": [ 4 ],"sWidth":"7%" },
			  { "bSortable": true, "aTargets": [ 5 ],"sWidth":"10%" },
			  { "bSortable": true, "aTargets": [ 6 ],"sWidth":"10%" },
			  { "bSortable": true, "aTargets": [ 7 ],"sWidth":"5%" },
			  { "bSortable": true, "aTargets": [ 8 ],"sWidth":"5%" },
	      { "bSortable": false, "aTargets": [ 9 ],"sWidth":"5%" },
					  { "fnRender": function(obj){
						return "<center><a href=\"../master/data_obat/get_update/"+obj.aData[10]+"\" class=btn btn-default><i class=\"icon-pencil\"></i></a></center>"
						}, "aTargets": [10],"sWidth":"5%"}
				   ],
                "oLanguage": {
                  "sEmptyTable": "Obat tidak tersedia"
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
      <tr  role="row">
				<th class="head0" width="20px;"><i class="icon-trash"></i></th>
        <th class="head0" width="40px;">No.</th>
        <th class="head1">Sediaan Farmasi</th>
        <th class="head1 ns_lab_detail">Sediaan</th>
        <th class="head1">Golongan</th>
        <th class="head1">Harga Beli + PPN</th>
        <th class="head1">Harga Jual</th>
				<th class="head1">Harga Kemasan</th>
				<th class="head1" width="60px;">Min stok</th>
				<th class="head1" width="60px;">Max stok</th>
				<th class="head1" width="60px;">Action</th> 
      </tr>
    </thead>
    <tbody id="list-data">
    <?php //$i=1; foreach ($datas->result() as $list):?>
      <!--tr>
        <td class="center"><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->im_id?>" class="chk"></td> 
        <td class="center"><?=$i++?><input type="hidden" class='im_id' value="<?=$list->im_id?>" id="seq_<?=$i?>"></td> 
        <td><div class='shows'><?=$list->im_name?></div><input class="hiddens dsim_name" name='' type="text" value="<?=$list->im_name?>" ></td>
        <td class="center">
            <div class='shows'><?=$list->mtype_name//$list->im_unit//?></div>
            <div class='hiddens'>
              <select class='dsim_unit' name='dsim_unit'  style="width:60px">
                <?php foreach ($tipeobat as $keys) :?>
                  <option value="<?=$keys->mtype_id?>" <?php if($keys->mtype_id===$list->im_unit) echo 'selected="selected"';?> ><?=$keys->mtype_name?></option>
                <?php endforeach;?>
              </select></div>
        </td>
        <td class="center"><div class='shows'><?=$list->im_item_price_buy?></div><input  class="hiddens im_item_price_buy" name='im_item_price_buy'  type="text" style='width:30px' value="<?=$list->im_item_price_buy?>"  ></td>
        <td class="center"><div class='shows'><?=$list->im_item_price?></div><input  class="hiddens im_item_price" name='im_item_price'  type="text" style='width:30px' value="<?=$list->im_item_price?>"  ></td>
        <td class="center"><div class='shows'><?=$list->im_item_price_package?></div><input  class="hiddens im_item_price_package" name='im_item_price_package'  type="text" style='width:30px' value="<?=$list->im_item_price_package?>"  ></td>
        <td class="center"><div class='shows'><?=$list->im_min_stock?></div><input  class="hiddens dsim_min_stock" name='dsim_min_stock'  type="text" style='width:30px' value="<?=$list->im_min_stock?>"  ></td>
        <td class="center"><div class='shows'><?=$list->im_max_stock?></div><input class="hiddens dsim_max_stock" name='dsim_max_stock'  type="text" style='width:30px' value="<?=$list->im_max_stock?>" ></td>
        <td class="center"> 
          <div class='shows'>
            <a class="buttons btn_pencil" style="" href="<?=base_url()?>master/data_obat/edit_list/<?=$list->im_id?>"></a>
            <a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_obat/delete_list/<?=$list->im_id?>"></a>
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
	  /*width: 120px !important;*/
    }
</style>