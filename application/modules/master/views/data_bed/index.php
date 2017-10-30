<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<script type="text/javascript">
  function reloadTable(){
    var url_hasil="<?php echo base_url()?>master/data_bed/loaddata"
    $(".list_obat").load(url_hasil);
  }

  function resetInput(){
            $('#bed_status').val('');
            $("select[name='mst[room_id]']").val('');
			//$("select[name='mst[class_id]']").val('');
			$("select[name='mst[bed_status]']").val('');
            //$('#b').val('');
            //$('#im_max_stock').val('');
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
       var r = confirm("Anda yakin akan menghapus data ini ?");
          if (r == true) {
        
                $(".black_loader").fadeIn(300).fadeOut(function(){
                  // console.log($(t).attr('href'));
                   $.ajax({
                      url: "<?php echo base_url()?>data_bed/delete_list",
                      data: "kode="+id_array+"&csrf_jike_2012="+crsf,
                      type: "POST",
                      success: function(){
                        alert("");
                        reloadTable();
                      }
                    })
                });
              
       };
      }else {alert("Silahkan memilih data yang akan dihapus.")}
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
           
           $('.list_obat').children().remove();
           $.ajax({
                          url: '<?php echo base_url()?>master/data_bed/loaddata',
                          type: "POST",
                          crossDomain: true,
                          data: "csrf_jike_2012="+crsf+"&tgl="+datas,
                          dataType: "html",
                          success: function( data ) {
                             
                            $('.list_obat').append(data);
                          }
                        });

         
          $('.submit').click(function(){

          isvalid = $("form.tambahData").validate({
            rules: {
                'ds[room_id]': {"required": true, "number": true},
                //'ds[pavillion_id]': {"required": true, "number": true},
				//'ds[class_id]': {"required": true, "number": true},
                //'ds[im_name]': "required",
                //'ds[im_unit]': {"required": true},
                 
            },
            submitHandler: function(form) {
                //var url = "<?= base_url() ?>pendaftaran/pendaftaran_rawat_jalan/data_sosial";
              //  var data = $("#form_pendaftaran_baru").serialize();
                formdata = $('form.tambahData').serialize();

                //$(".black_loader").fadeIn(300).fadeOut(function(){
                  $.post( "<?= base_url()?>master/data_bed/create",formdata).done(function(){
                      $(".alert").fadeIn().delay(800).fadeOut(function(){})
                      reloadTable();
                      resetInput();
                  });
                //});
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
           var r = confirm("Anda yakin akan menonaktifkan bed ini ?");
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

     $('.btn_aktif').live("click",function(){
      // alert('asd');
      t = this;
     var r = confirm("Anda yakin akan mengaktifkan bed ini ?");
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
                  // reloadTable();
                  $(this).parent().parent().parent().parent().find('.shows').hide();
                  $(this).parent().parent().parent().parent().find('.hiddens').show();
                return false;

              })

              $('.submitEdit').live("click",function(){
                  t = this;
                  im_bed =  $(this).parent().parent().parent().find('.dsim_bed').val();
                  im_pav =  $(this).parent().parent().parent().find('.dsim_pav').val();
                  im_class =  $(this).parent().parent().parent().find('.dsim_class').val();
                  //im_max_stock =  $(this).parent().parent().parent().find('.dsim_max_stock').val();
                  //im_min_stock =  $(this).parent().parent().parent().find('.dsim_min_stock').val();
                  crsf = $('.crsf').val();
                  url = "<?=base_url()?>master/data_bed/update";
                  datapost = "csrf_jike_2012="+crsf+"&ds[room_id]="+im_bed+"&ds[class_id]="+im_class+"&ds[pavillion_id]="+im_pav;
                  
                  $(".black_loader").fadeIn(300).fadeOut(function(){
                      $.post(url,datapost).done(function(){
                        reloadTable();
                        $(t).parent().parent().parent().find('.shows').show();
                        $(t).parent().parent().parent().find('.hiddens').hide();

                      })
                  })

                  $(this).parent().parent().parent().find('.shows').show();
                  $(this).parent().parent().parent().find('.hiddens').hide();
              })

      // $('#DataTables_Table_0_filter').hide();
});
</script>


<style>
  .alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }

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

<div class="container-fluid" style="padding:0px;">
  <div class="row-fluid">
      <div class="pageheader notab">
          <h1 class="pagetitle"><?=$title?></h1>            
      </div>
  </div>
  <br clear="all">
  <div class="page-content row-fluid">
    <form class="stdform form-horizontal tambahData" style="display:none" method="post" >
      <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
      <div class="span5">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon">
                <i class="icon-th-list"></i>
            </span>
            <h5>Tambah Bed</h5>
          </div>
				<!--label class="control-label" >Nomor Bed</label>
				<div class="controls" >					
					<select name="mst[bed_id]" id="bed_id">
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div-->
				 <label class="control-label" >Nomor Ruangan</label>
				 <div class="controls">
					 <select name='mst[room_id]' required id='tipe_room' >
						<option value="">-- Pilih --</option>
						<?php foreach($tipe_room as $rows):?>
						<option value="<?=$rows->room_id?>"><?=$rows->pavillion_name?> No. <?=$rows->room_number?></option>
						
						<?php endforeach;?>						
					</select>
				</div>
				<label class="control-label" >Status</label>
				 <div class="controls">
					 <select name='mst[status]' required id='bed_status' >
						<option value="">-- Pilih --</option>						
						<option value="0">Available</option>
						<option value="1">Not Available</option>
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
        <div class="widgetbox" style="float:left;padding-top:20px;padding-left:10px;">
    <a href="" data-toggle="modal" class="modals btn btn-success">
        <i class="icon-plus-sign icon-white"></i>Tambah</a>
    <a href="" class="btn btn-danger delete_data">
        <i class="icon-trash icon-white"></i> Hapus</a>
        </div>
    </div>

    <div class="span5" style="float:right;">
        <div class="widgetbox">
            <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
            <?=form_open(cur_url().'search',array('class' => 'form-horizontal frm_search stdform','id' => 'form')); ?>
              <div class="chatsearch" >
                  <input type="text" class='searchname' name="nama_dokter" placeholder="Cari Room" style="wi dth:91%;margin:auto;">
              </div>
              <div style='display:none;' id="basic">
                  <input type="text" class="mediuminput" placeholder="masukkan nama dokter" autofocus="autofocus">
              </div>
              <div class="clearall"></div>
            <?=form_close()?>
        </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div style="margin:10px;">
      <div class="black_loader">
          <img src="<?=get_loader(9)?>">
        </div>
        <div class="row-fluid list_obat">
           
        </div>
      </div>
    </div>
  </div>
</div>