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
                      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"7px"  },
                       { "bSortable": true, "aTargets": [ 1 ],"sWidth":"7px" },
                      { "bSortable": false, "aTargets": [ 2 ] },
					  { "bSortable": false, "aTargets": [ 3 ] }
                   ],
                "oLanguage": {
                  "sEmptyTable": "Poli tidak tersedia"
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
                     <th class="head1" width="40px;">No.</th>
					 <th class="head1" width="80px;">Nama Rute</th>
                      <th class="head1" width="80px;">Action</th>                    
                                     
                </tr>
            </thead>
            
            <tbody id="list-data">

                <?php $i=1; foreach ($datas->result() as $list):?>
                <tr>
                    <td><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->rute_id?>" class="chk"><input type="hidden" value="<?=$list->rute_id?>" class="mstpl_id">
                                </td>
                     <td><?=$i?><input class="mstpl_id"   type="hidden" value="<?=$list->rute_id ?>" ></td>
                      <td><div class='shows'><?=$list->rute_name?></div><input class="hiddens mstpl_name"   type="text" value="<?=$list->rute_name?>" ></td>
                      <td> 
							<div class='shows'>
								<a class="buttons btn_pencil" href="<?=base_url()?>master/data_rute_obat/edit_list/<?=$list->rute_id?>"></a>
								<a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_rute_obat/delete_list/<?=$list->rute_id?>"></a>
							</div>
							<div class="hiddens">
								<input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> 
							</div> 
					  
					  </td>
                   
                </tr>
                <?php $i++; endforeach?>               
            </tbody>
            <tfoot>
            </tfoot>
        </table>

<style type="text/css">
    #list-data .hiddens{
            display: none;
        }
</style>