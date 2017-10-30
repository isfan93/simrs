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
            { "bSortable": true, "aTargets": [ 1 ],"sWidth":"10%" },
            { "bSortable": true, "aTargets": [ 2  ],"sWidth":"10%" },
            { "bSortable": true, "aTargets": [ 3 ],"sWidth":"10%" },
            { "bSortable": true, "aTargets": [ 4 ],"sWidth":"20%" },
            { "bSortable": false, "aTargets": [ 5 ],"sWidth":"10%" }
            ],
            "oLanguage": {
              "sEmptyTable": "Data user tidak ditemukan"
          }
      });
       $(".dataTables_filter").hide();
       $('.dataTables_length').hide();
       $("#list-data tr").on("dblclick",function (event){
         var number=$('#list-data tr').index(this);
         var value=$('#seq_'+number).val();
     })

        $('.reset').click(function(){
            var status = confirm('Anda yakin mereset password user?');
            if(status)
            {
                $.blockUI({
                    message: '<div class="black_loader"><img src="<?=get_loader(11)?>"></div>',
                    overlayCSS:  {
                        backgroundColor: '#000',
                        opacity: 0.5,
                        cursor: 'wait',
                    },
                    css:{
                        border: 'none',
                    }
                });
                crsf = $('.crsf').val();
                csrf_name = $('.crsf').attr('name');
                var url  = "<?=base_url()?>master/data_user/reset_password";
                var data =  csrf_name+"="+crsf+"&user_id="+$(this).attr('user_id');
                $.post(url,data, function(data){
                    setTimeout(function() { 
                        $.unblockUI({
                            onUnblock: function(){
                                $(".alert").fadeIn().delay(500).fadeOut(function(){
                                    $("#save").trigger('click'); 
                                });
                            }
                        });
                    }, 1000);  
                });
            }
            return false;
        });
   });
</script>
<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed">
    <div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" style="display: none; width:50px "></div>
            <img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
            <div class="gritter-with-image" style="width:448px">
                <span class="gritter-title" style="margin-left:36px">Message</span>
                <p>Data Berhasil Disimpan   </p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="gritter-bottom"></div>
    </div>
</div>
<table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
   <!--table class="tabel-master table-bordered"-->        
   <thead>
      <tr  role="row">
         <th class="head0" width="20px;"><i class="icon-trash"></i></th>
         <!-- <th class="head0" width="40px;">Kode</th> -->
         <th class="head1">Username</th>
         <th class="head1">Group</th>
         <th class="head1" width="60px;">NIP</th>
         <th class="head1" width="60px;">Nama Lengkap</th>
         <!--th class="head1" width="60px;">Status</th-->
         <th class="head1" width="60px;">Action</th>

     </tr>
 </thead>

 <tbody id="list-data">

  <?php $i=1; foreach ($datas->result() as $list):?>
  <tr>
     <td><input type="hidden" class='im_id' value="<?=$list->user_id?>" id="seq_<?=$i?>">
       <input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$list->user_id?>" class="chk"></td> 

       <td><div class='shows'><?=$list->user_name?></div><input class="hiddens dsim_name" name='' type="text" value="<?=$list->user_name?>" >
          <input type="hidden" name="" class="dsim_id" value="<?=$list->user_id?>"</td>
          <td><div class='shows'><?=$list->group_name?></div>
             <div class='hiddens'><select class='dsim_group' name='dsim_group'  style="width:140px">
                <?foreach ($group as $keys) :?>
                <option value="<?=$keys->group_id?>" <?php if($keys->group_id===$list->group_id) echo 'selected="selected"';?> ><?=$keys->group_name?></option>

                <?endforeach?>
            </select></div>
        </td>

        <td><div class=''><?=$list->sd_nip?></div><!--input  class="hiddens dsim_min_stock" name='dsim_min_stock'  type="text" style='width:30px' value="<?=$list->sd_nip?>" --></td>
        <td><div class='shows'><?=$list->sd_name?></div>
          <!--input class="hiddens dsim_max_stock" name='dsim_max_stock'  type="text" style='width:30px' value="<?=$list->sd_name?>" -->
          <div class='hiddens'><select class='dsim_user' name='dsim_unit'  style="width:140px">
             <?foreach ($employer as $keys) :?>
             <option value="<?=$keys->id_employe?>" <?php if($keys->id_employe===$list->id_employe) echo 'selected="selected"';?> ><?=$keys->sd_name?></option>

             <?endforeach?>
         </select>
     </div>
 </td>
 <!--td><div class='shows'><?=$list->user_status?></div><input class="hiddens dsim_max_stock" name='dsim_max_stock'  type="text" style='width:30px' value="<?=$list->user_status?>" ></td-->
 <td> 
      <div class='shows'><a class="buttons btn_trash" href="<?=base_url()?>master/data_user/delete_list/<?=$list->user_id?>"></a>
      <a class="buttons btn_pencil" href="<?=base_url()?>master/data_user/edit_list/<?=$list->user_id?>"></a>
      <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
      <button class='btn btn-small btn-danger reset' user_id="<?=$list->user_id?>">Reset</button>
      </div> 
      <div class="hiddens"><input type="submit" value="Simpan" class="submitEdit radius2 btn btn-primary"> </div> 
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

    .black_loader{
        display: none;
        opacity: 0.6;
    }
    .alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
</style>