<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<script type="text/javascript">

function reloadTable(){
            var url_hasil="data_mcu_detail/loaddata"
            $(".list_mcu_detail").load(url_hasil);
}

function resetInput(){
          $('#im_name').val('');
          $("select[name='ds[im_unit]']").val('');
          $('#im_min_stock').val('');
          $('#im_max_stock').val('');
}

    jQuery(document).ready(function() {

        
 jQuery('.tgl_frm').val(getDateRaw(0)); 
          datas = getDateRaw(0);
          crsf = $('.crsf').val();
    //=========== del button
    // $(".black_loader").fadeIn().delay(5000).fadeOut(400);
    $(".delete_data").on("click",function(e){
      //alert("debug");
      id_array= new Array();
      i=0;
      $("input.chk:checked").each(function(){
        id_array[i] = $(this).val();
        i++;

      })
 

      if(id_array!=0){
       var r = confirm("Anda yakin akan menghapus data Tindakan ini ?");
          if (r == true) {
        
                $(".black_loader").fadeIn(300).fadeOut(function(){
                  // console.log($(t).attr('href'));
                   $.ajax({
                      url: "data_mcu_detail/delete_list",
                      data: "kode="+id_array+"&csrf_jike_2012="+crsf,
                      type: "POST",
                      success: function(){
                        alert("data berhasil dihapus");
                        reloadTable();
                      }
                    })
                });
              
       };
      }else {alert("pilih data dulu")}
      return false;
    })
    //=========== end del
  
         // jQuery( "#datepicker" ).datepicker();
      $('.tutup').click(function(){
        event.preventDefault();
        $('.tambahData').slideUp();
        $('.btn_utility').show();
      })

      $('.modals').click(function(){
        $('.tambahData').slideDown();
        $('.btn_utility').hide();
      })

         $('#gap').val('0');

         $('.searchname').keyup(function(){
            var search = $('.searchname').val();
             $('.dataTables_filter input').val(search).trigger('keyup');
            //tbldokter.fnDraw();
         })

        jQuery('.tgl_frm').val(getDateRaw(0)); 
          datas = getDateRaw(0);
          crsf = $('.crsf').val();
           
           $('.list_mcu_detail').children().remove();
           $.ajax({
                          url: 'data_mcu_detail/loaddata',
                          type: "POST",
                          crossDomain: true,
                          data: "csrf_jike_2012="+crsf+"&tgl="+datas,
                          dataType: "html",
                          success: function( data ) {
                             
                            $('.list_mcu_detail').append(data);
                          }
                        });

         $('.submit_search').click(function(){
             $('.list_mcu_detail').children().remove();
            $.ajax({
                  url: 'jadwal_dokter/search',
                  type: "POST",
                  crossDomain: true,
                  data: $('.frm_search').serialize(),
                  dataType: "html",
                  success: function( data ) {
                    $('.list_mcu_detail').append(data);
                  }
                });
            return false;
         })

          $('.submit').click(function(){

          isvalid = $("form.tambahData").validate({
            rules: {              
                'mst[description]': {"required": true},                
				'mst[mcu_id]': "required",                 
            },
            submitHandler: function(form) {
                //var url = "<?=base_url()?>pendaftaran/pendaftaran_rawat_jalan/data_sosial";
                //var data = $("#form_pendaftaran_baru").serialize();
                var formdata = $('form.tambahData').serialize();

                $(".black_loader").fadeIn(300).fadeOut(function(){
                  $.post( "<?=base_url()?>master/data_mcu_detail/create",formdata).done(function(){
                     
                      reloadTable();
                      resetInput();
                  });
                });
                return false;
            }
        });

        
           
         })

        $('.reset').click(function(){
          resetInput();
        })
        

         $('.add_schdl').click(function(){
          return false;
         });

           $('.btn_trash').live("click",function(){
            // alert('asd');
            t = this;
           var r = confirm("Anda yakin akan menghapus data Tindakan ini ?");
              if (r == true) {
                $(".black_loader").fadeIn(300).fadeOut(function(){
                  // console.log($(t).attr('href'));
                  $.get($(t).attr('href')).done(function(){
                    reloadTable();
                  });
                });
              } 
            return false;
      })

              $('.btn_pencil').live("click",function(){
                  $(this).parent().parent().parent().find('.shows').hide();
                  $(this).parent().parent().parent().find('.hiddens').show();
                return false;

              })

              $('.submitEdit').live("click",function(){
                  t = this;
                  id =  $(this).parent().parent().parent().find('.dsdmcu_id').val();
                  //name =  $(this).parent().parent().parent().find('.dstreatment_name').val();
                  description =  $(this).parent().parent().parent().find('.dsdescription_mcu').val();
				  kategori =  $(this).parent().parent().parent().find('.dsjenis_tindakan').val();
                  crsf = $('.crsf').val();
                  url = "<?=base_url()?>master/data_mcu_detail/update";
                  datapost = "csrf_jike_2012="+crsf+"&ds[description]="+description+"&ds[mcu_id]="+kategori+"&ds[dmcu_id]="+id;
                  
                  $(".black_loader").fadeIn(300).fadeOut(function(){
                      $.post(url,datapost).done(function(){
                        reloadTable();
                        

                      })
                  })

                  $(this).parent().parent().parent().find('.shows').show();
                  $(this).parent().parent().parent().find('.hiddens').hide();
              })

      // $('#DataTables_Table_0_filter').hide();
});
</script>


<style>
    .dataTables_scrollHead{
        margin-bottom: -22px;
    }
    .dataTables_info{
        margin-top: 20px;
    }

.dataTables_filters  input {
    /*position: absolute;*/
    display: block;
    /*top: -20px;*/
}

</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=$title?>  </h1>
           
                 
                  <div id="myModal" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">x</button>
                      <h3>Tambah Diagnosa</h3>
                    </div>
                    <div class="modal-body">
                      

                    </div>
                  </div>
        </div>
    </div>
    <br clear="all">
    <div class="page-content row-fluid">
         
            <form class="stdform form-horizontal tambahData" style="display:none" method="post" >

            <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
              <div class="span11">
              <div class="widget-box">
                  <div class="widget-title">
                      <span class="icon">
                          <i class="icon-th-list"></i>
                      </span>
                      <h5>Tambah Data</h5>
                  </div>
          
                <label class="control-label">Nama Tindakan</label>
                <div class="controls">
                  <textarea name="mst[description]" id="im_name" placeholder="Description"></textarea>
                </div>

                <!--label class="control-label">Deskripsi Tindakan</label>
                <div class="controls">
                  <textarea name="mst[description]" placeholder="Deskripsi Tindakan"></textarea>
                </div-->
				<label class="control-label">MCU Paket</label>
                <div class="controls">
                  <select name='mst[mcu_id]' required id='kategori' >
                          <option value="">-- Nama Paket --</option>
                            <?php foreach($tindakan as $tindakan): ?>
                            <option value="<?=$tindakan->treat_id?>"><?=$tindakan->treat_name?></option>
                            
                            <?php endforeach;?>
                          
                      </select>
                </div>              
               <div class="clearfix"></div>
               <div class="controls">
                    <p class="stdformbutton">
                        <input type="submit" value="Simpan" class="submit radius2 btn btn-primary"> 
                        <input type="reset" value="Reset" class="reset radius2 btn btn-warning ">
                        <input type="submit" value="Tutup" class="tutup radius2 btn btn-danger ">
                    </p>
               </div>
             </div>
              </div>
 
            </form>  
       
     </div>
    <div class="row-fluid btn_utility">
        <div class="span7">
            <div class="widgetbox" style="float:left;padding-top:20px;padding-left:20px;">
				<a href="" data-toggle="modal" class="modals btn btn-success">
						<i class="icon-plus-sign icon-white"></i>Tambah</a>
				<a href="#" class="btn btn-danger delete_data">
						<i class="icon-trash icon-white"></i> Hapus</a>
            </div>
        </div>
        <div class="span5" style="float:right;">
            <div class="widgetbox">
              <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >                 
				        <?=form_open(cur_url().'search',array('class' => 'form-horizontal frm_search stdform','id' => 'form')); ?> 
                    <!--input type='hidden' name='tgl_frm' class='tgl_frm'-->
                    <div class="chatsearch" >
                        <input type="text" class='searchname' name="nama_dokter" placeholder="Jenis Tindakan" style="wi dth:91%;margin:auto;">
                    </div>
                    <div class="clearall"></div>
                    
                </form>
            </div>
        </div>
    </div>
    <br clear="all">
    
    <br clear='all'>
    <div class="row-fluid list-tindakan">
    <div class="black_loader">
          <img src="<?=get_loader(9)?>">
        </div>
    <div class="row-fluid list_mcu_detail">
       
    </div>
</div>