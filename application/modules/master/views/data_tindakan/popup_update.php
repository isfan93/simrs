<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<script type="text/javascript">

function reloadTable(){
            var url_hasil="data_tindakan/loaddata"
            $(".list_tindakan").load(url_hasil);
}

function resetInput(){
          $('#treat_name').val('');
          $("select[name='mst[koef_id]']").val('');
		  $("select[name='mst[poli]']").val('');
          $('#master_fee').val('');
          //$('#im_max_stock').val('');
}

    jQuery(document).ready(function() {
//$(".black_loader").show();
$(".msg_wait").show();
        
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
				//alert(id_array);
                $(".black_loader").fadeIn(300).fadeOut(function(){
                  // console.log($(t).attr('href'));
                   $.ajax({
                      url: "data_tindakan/delete_list",
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
        $('.modals').click(function(){
     
          $('.tambahData').slideDown();
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
           
           /*$('.list_tindakan').children().remove();
           $.ajax({
                          url: 'data_tindakan/loaddata',
                          type: "POST",
                          crossDomain: true,
                          data: "csrf_jike_2012="+crsf+"&tgl="+datas,
                          dataType: "html",
                          success: function( data ) {
                            $(".msg_wait").hide();
                            $('.list_tindakan').append(data);
                          }
                        });*/

         $('.submit_search').click(function(){
             $('.list_tindakan').children().remove();
            $.ajax({
                  url: 'jadwal_dokter/search',
                  type: "POST",
                  crossDomain: true,
                  data: $('.frm_search').serialize(),
                  dataType: "html",
                  success: function( data ) {
                    $('.list_tindakan').append(data);
                  }
                });
            return false;
         })

          $('.submit').click(function(){

          isvalid = $("form.ubahData").validate({
            rules: {
                'mst[treat_name]': {"required": true},
                'mst[description]': {"required": true},
                'mst[poli]': "required",
				'mst[koef_id]': "required",
                'mst[treat_item_price]': {"required": true},
                 
            },
            submitHandler: function(form) {
                //var url = "<?=base_url()?>pendaftaran/pendaftaran_rawat_jalan/data_sosial";
                //var data = $("#form_pendaftaran_baru").serialize();
                var formdata = $('form.ubahData').serialize();

                $(".alert").fadeIn().delay(800).fadeOut(function(){
                  $.post( "<?=base_url()?>master/data_tindakan/update",formdata).done(function(){
                     window.open("<?=base_url()?>master/data_tindakan","_self");
                      //reloadTable();
                      //resetInput();
                  });
                });
                return false;
            }
        });

        
           
         })

        $('.reset').click(function(){
          resetInput();
        })
    $('.cancel2').click(function(){
          window.history.back();
    })
        
		$('.cancel').click(function(){
          $.get('<?=base_url()?>master/data_tindakan');
        })        

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
<div class="container-fluid">
    <div class="row-fluid">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=$title?>  </h1>
        </div>
    </div>
    <br clear="all">
    <div class="page-content row-fluid">
         
            <form class="stdform form-horizontal ubahData" style="" method="post" >

            <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
              <div class="span6">
              <div class="widget-box">
                  <div class="widget-title">
                      <span class="icon">
                          <i class="icon-th-list"></i>
                      </span>
                      <h5></h5>
                  </div>
				<label class="control-label">Kode</label>
				<div class="controls" >
					<input type="text" class='' required name="mst[treat_id]" id="kode" value="<?php echo $result['treat_id']; ?>" readonly>
				</div>
                <label class="control-label">Nama Tindakan</label>
                <div class="controls">
                  <input type="text" autofocus="" name="mst[treat_name]" id="treat_name" value="<?php echo $result['treat_name']; ?>">
                </div>
				<label class="control-label">Jenis Kategori</label>
                <div class="controls">
                  <select name='mst[koef_id]' required id='koef_id' >
                          <option value="">-- Jenis Kategori --</option>
                            <?php foreach ($kategori as $keys) :?>
                                <option value="<?=$keys->koef_id?>" <?php if($keys->koef_id===$result['koef_id']) echo 'selected="selected"';?> ><?=$keys->koef_treathment?></option>
                                
                          	<?php endforeach?>
                          
                      </select>
                </div>
                <label class="control-label">Poli</label>
                <div class="controls">
                  <select name='mst[poli]' required id='poli' >
                          <option value="">-- Poli --</option>
                            <?php foreach ($poli2 as $keys) :?>
                                <option value="<?=$keys->pl_id?>" <?php if($keys->pl_id===$result['poli']) echo 'selected="selected"';?> ><?=$keys->pl_name?></option>
                                
                          	<?php endforeach?>
                          
                      </select>
                </div>

                <label class="control-label">Tarif Dasar</label>
                <div class="controls">
                  <input type="text" autofocus="" name="mst[treat_master_fee]" id="master_fee" value="<?=$result['treat_master_fee']?>">
                </div>
              
              <div class="clearfix"></div>
               <div class="controls">
                    <p class="stdformbutton">
                        <input type="submit" value="Simpan" class="submit radius2 btn btn-primary"> 
                        <input type="button" value="Batal" class="cancel2 radius2 btn btn-default ">
                    </p>
               </div>
             </div>
              </div>
 
            </form>  
       
     </div>
    <!--div class="row-fluid">
         
       
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
                    <!--input type='hidden' name='tgl_frm' class='tgl_frm'>
                    <div class="chatsearch" >
                        <input type="text" class='searchname' name="nama_dokter" placeholder="Jenis Tindakan" style="wi dth:91%;margin:auto;">
                    </div>
                    <div style='display:none;' id="basic">
                        <input type="text" class="mediuminput" placeholder="masukkan nama dokter" autofocus="autofocus">
                    </div>
                    <div class="clearall"></div>
                    
                </form>
            </div>
        </div>
    </div-->
    <br clear="all">
    <div class="row-fluid list_tindakan">
       
    </div>
    <div class="black_loader">
          <img src="<?=get_loader(9)?>">
        </div>
    <!--div class="row-fluid list-tindakan">
    
	<div class="msg_wait"><center>Please wait for a minute...</center></div>
    
</div-->