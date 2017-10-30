<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.css" />
<script src="<?= base_url() ?>assets/js/jquery.chosen.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.price_format.js"></script>
<script type="text/javascript">

function reloadTable(){
            var url_hasil="data_tindakan/loaddata"
            $(".list_tindakan").load(url_hasil);
}

function resetInput(){
          $('#treat_name').val('');
		  $('#koef_name').select2('val','');
		  $('#koef_id').val('');
		  $('#poli_name').select2('val','');
		  $('#poli_id').val('');
          //$("select[name='mst[koef_id]']").val('');
		  //$("select[name='mst[poli]']").val('');
          $('#master_fee').val('');
          //$('#im_max_stock').val('');
}

function RemoveRougeChar(convertString){
    
    
    if(convertString.substring(0,1) == ","){
        
        return convertString.substring(1, convertString.length)            
        
    }
    return convertString;
    
}


jQuery(document).ready(function() {
   $('#master_feeY').keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
      
      var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
      
      console.log(num2);
      
      
      // the following line has been simplified. Revision history contains original.
      $this.val(num2);
  });

  $('#master_fee').priceFormat({
    prefix: 'Rp ',
    centsSeparator: '',
    thousandsSeparator: '.',
    centsLimit: 0,
    clearPrefix: true
  });
//select2
		$("#koef_name").select2({
            minimumInputLength: 0,
            width:'80%',
            placeholder : 'Kategori',
            ajax: {
                url: BASE+"master/data_tindakan/get_kategori",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
								
                            }
							//
                        })
                    };
					//$('#koef_id').val(data.id)
                }
            }
        });
		$('#koef_name').change(function(){
			var thisID=$('#koef_name').select2('data').id;
			$('#koef_id').val(thisID);
		})
		
		//select2
		$("#poli_name").select2({
            minimumInputLength: 0,
            width:'80%',
            placeholder : 'Nama Poli',
            ajax: {
                url: BASE+"master/data_tindakan/get_poli",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
								
                            }
							//
                        })
                    };
					//$('#koef_id').val(data.id)
                }
            }
        });
		$('#poli_name').change(function(){
			var thisID=$('#poli_name').select2('data').id;
			$('#poli_id').val(thisID);
		})
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
      $('.tutup').click(function(){
        event.preventDefault();
        $('.tambahData').slideUp();
        $('.btn_utility').show();
      })
  
         // jQuery( "#datepicker" ).datepicker();
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
           
           $('.list_tindakan').children().remove();
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
                        });

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

          isvalid = $("form.tambahData").validate({
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
                var formdata = $('form.tambahData').serialize();

                //$(".black_loader").fadeIn(300).fadeOut(function(){
                $(".alert").fadeIn().delay(800).fadeOut(function(){
                  $.post( "<?=base_url()?>master/data_tindakan/create",formdata).done(function(){
                      //$(".alert").fadeIn().delay(800).fadeOut(function(){})
                      $('.tambahData').slideUp();
                      $('.btn_utility').show();
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
                  id =  $(this).parent().parent().parent().find('.dstreat_id').val();
                  name =  $(this).parent().parent().parent().find('.dstreatment_name').val();
                  description =  $(this).parent().parent().parent().find('.dsdescription').val();
				  kategori =  $(this).parent().parent().parent().find('.dsjenis_tindakan').val();
                  poli =  $(this).parent().parent().parent().find('.dspoli').val();
                  item_price =  $(this).parent().parent().parent().find('.dstreat_price_master').val();
                  // im_min_stock =  $(this).parent().parent().parent().find('.dsim_min_stock').val();
                  crsf = $('.crsf').val();
                  url = "<?=base_url()?>master/data_tindakan/update";
                  datapost = "csrf_jike_2012="+crsf+"&ds[treat_name]="+name+"&ds[description]="+description+"&ds[poli]="+poli+"&ds[treat_master_fee]="+item_price+"&ds[treat_id]="+id+"&ds[koef_id]="+kategori;
                  
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
              <div class="span5">
              <div class="widget-box">
                  <div class="widget-title">
                      <span class="icon">
                          <i class="icon-th-list"></i>
                      </span>
                      <h5>Tambah Data Tindakan</h5>
                  </div>
          
                <label class="control-label">Nama Tindakan</label>
                <div class="controls">
                  <input type="text" autofocus="" name="mst[treat_name]" id="treat_name" placeholder="Nama Tindakan">
                </div>

                <!--label class="control-label">Deskripsi Tindakan</label>
                <div class="controls">
                  <textarea name="mst[description]" placeholder="Deskripsi Tindakan"></textarea>
                </div-->
				<label class="control-label">Jenis Kategori</label>
                <div class="controls">
					<input type="hidden" name="" id="koef_name" class="" value="">
					<input type="hidden" name="mst[koef_id]" id="koef_id" class="" value="">
                  <!--select name='mst[koef_id]' required id='koef_idX' >
                          <option value="">-- Jenis Kategori --</option>
                            <?php foreach($kategori as $kategori): ?>
                            <option value="<?=$kategori->koef_id?>"><?=$kategori->koef_treathment?></option>
                            
                            <?php endforeach;?>
                          
                      </select-->
                </div>
                <label class="control-label">Poli</label>
                <div class="controls">
				<input type="hidden" name="" id="poli_name" class="" value="">
				<input type="hidden" name="mst[poli]" id="poli_id" class="" value="">
                  <!--select name='mst[poli]' required id='poli' >
                          <option value="">-- Poli --</option>
                            <?php foreach($poli2 as $poli): ?>
                            <option value="<?=$poli->pl_id?>"><?=$poli->pl_name?></option>
                            
                            <?php endforeach;?>
                          
                      </select-->
                </div>

                <label class="control-label">Tarif Dasar</label>
                <div class="controls">
                  <input type="text" autofocus="" name="mst[treat_master_fee]" id="master_fee" placeholder="Tarif Dasar">
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
                    <div style='display:none;' id="basic">
                        <input type="text" class="mediuminput" placeholder="masukkan nama dokter" autofocus="autofocus">
                    </div>
                    <div class="clearall"></div>
                    
                </form>
            </div>
        </div>
    </div>
    <br clear="all">
    <div class="row-fluid list_tindakan">
       
    </div>
    <div class="black_loader">
          <img src="<?=get_loader(9)?>">
        </div>
    <!--div class="row-fluid list-tindakan">
    
	<div class="msg_wait"><center>Please wait for a minute...</center></div>
    
</div-->
</div>