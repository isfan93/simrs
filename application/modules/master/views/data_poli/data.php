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
                      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"10%"  },
                       { "bSortable": true, "aTargets": [ 1 ],"sWidth":"80%" },
                      { "bSortable": false, "aTargets": [ 2 ],"sWidth":"10%" }
                   ],
                "oLanguage": {
                  "sEmptyTable": "Poli tidak tersedia"
                }
            });
       

        $(".dataTables_filter").hide();
        $('.dataTables_length').hide();
        $("#list-data tr").on("dblclick",function (event){
            var number=$('#list-data tr').index(this);
            var value=$('#seq_'+number).val();
            //alert(number);
            url = "<?=base_url()?>master/data_tindakan/get_pop_update/"+value;
               $.get(url,function(data){

                  $('.modal-body').children().remove();
                  $('.modal-body').append(data);
                    $('#myModalUpt').modal('show');
               });
        })
    })

 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
         
            <thead>
                <tr  role="row">
                    <th class="head0"><i class="icon-trash"></i></th>
                     <th class="head1">Nama Poli</th>
                      <th class="head1">Action</th>                    
                                     
                </tr>
            </thead>
            
            <tbody id="list-data">

                <?php $i=1; foreach ($datas->result() as $list):?>
                <tr>
                    <td><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->pl_id?>" class="chk"><input type="hidden" value="<?=$list->pl_id?>" class="mstpl_id">
                                </td>
                     <!-- <td><?=$i?></td> -->
                      <td><div class='shows'><?=$list->pl_name?></div><input class="hiddens mstpl_name"   type="text" value="<?=$list->pl_name?>" ></td>
                      <td> 
							<div class='shows'>
								<a class="buttons btn_pencil" href="<?=base_url()?>master/data_poli/edit_list/<?=$list->pl_id?>"></a>
								<a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_poli/delete_list/<?=$list->pl_id?>"></a>
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
<div id="myModalUpt" class="modal hide">
    <div class="modal-header">
      <button data-dismiss="modal" class="close" type="button">x</button>
      <h3>Tambah Tindakan</h3>
    </div>
    <div class="modal-body">
      

    </div>
</div>

<style type="text/css">
    #list-data .hiddens{
            display: none;
        }
</style>