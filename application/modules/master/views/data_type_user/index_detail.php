<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<script type="text/javascript">
  function reloadTable(){
      var url_hasil="<?php echo base_url()?>master/data_type_user/loaddata_detail/"+$('#pt_id').val();
      $(".list_type_user").load(url_hasil);
  }

  function resetInput(){
      $('#im_name').val('');
      $("select[name='ds[im_unit]']").val('');
      $('#im_min_stock').val('');
      $('#im_max_stock').val('');
  }
  $(function(){
		//autocomplete obat
		
 		$('#treat_name').autocomplete({
				source:BASE+'master/data_type_user/list_treat', 
				minLength:2,
				focus: function( event, ui ) {
			        $( "#treat_name" ).val( ui.item.value );
			        return false;
			      },
				select:function(evt, ui)
				{
					$('#treat_id').val(ui.item.treat_id);
					$('#treat_group').val(ui.item.group);
					$('#treat_price').val(ui.item.price);
					//$('#nm_fornas').text(ui.item.nf);
					//$( "#satuanbesar option:selected" ).text(ui.item.kemasan).attr('value', ui.item.kemasan);
					
					return false;
				}
			})
 		
 		.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			      return $( "<li>" )
			        //.append("<a>"+ item.value +" "+item.pwr + " " + item.desc + "<br><small>" + item.pbf+ "</small></a>")
			        .append("<a>"+ item.value +"<br>"+item.group+"<br><small>" + item.price+ "</small></a>")
			        .appendTo( ul );
			    };
	//end autocomplete
	
      jQuery('.tgl_frm').val(getDateRaw(0)); 
      datas = getDateRaw(0);
      crsf = $('.crsf').val();
		  //=========== del button
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
                        url: "<?php echo base_url()?>master/data_type_user/delete_list",
                        data: "kode="+id_array+"&csrf_jike_2012="+crsf,
                        type: "POST",
                        success: function(){
                          reloadTable();
                        }
                      })
                  });
                
         };
  			}else {alert("Silahkan memilih data yang akan dihapus.")}
        return false;
  		})
		  //=========== end del
	
      $('.modals').click(function(){
        $('.tambahData').slideDown();
      })
      
      $('#gap').val('0');

      $('.searchname').keyup(function(){
        var search = $('.searchname').val();
         $('.dataTables_filter input').val(search).trigger('keyup');
      })

      jQuery('.tgl_frm').val(getDateRaw(0)); 
      datas = getDateRaw(0);
      crsf = $('.crsf').val();
         
      $('.list_type_user').children().remove();
      $.ajax({
        url: '<?php echo base_url()?>master/data_type_user/loaddata_detail/'+$('#pt_id').val(),
        type: "POST",
        crossDomain: true,
        data: "csrf_jike_2012="+crsf+"&tgl="+datas,
        dataType: "html",
        success: function( data ) {
           
          $('.list_type_user').append(data);
        }
      });

         
      $('.submit').click(function(){
          isvalid = $("form.tambahData").validate({
            rules: {
                'ds[ins_name]': "required",              
            },
            submitHandler: function(form) {                
                formdata = $('form.tambahData').serialize();

                $(".black_loader").fadeIn(300).fadeOut(function(){
                  $.post( "<?=base_url()?>master/data_type_user/create_detail",formdata).done(function(){
                     
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
        t = this;
        var r = confirm("Anda yakin akan menghapus data ini ?");
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
          $(this).parent().parent().parent().find('.shows').hide();
          $(this).parent().parent().parent().find('.hiddens').show();
        return false;

      })

      $('.submitEdit').live("click",function(){
          t = this;
          ins_id =  $(this).parent().parent().parent().find('.ins_id').val();
          ins_name =  $(this).parent().parent().parent().find('.dsim_name').val();
          
          crsf = $('.crsf').val();
          url = "<?=base_url()?>master/data_type_user/update";
          datapost = "csrf_jike_2012="+crsf+"&ds[ins_name]="+ins_name+"&ds[ins_id]="+ins_id;
          
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
          <h1 class="pagetitle"><?=$konten['pt_name']?><br><small><?=$konten['pt_desc']?></small></h1>
          <a class="btn btn-primary" style="float:right;" href="<?=base_url()?>master/data_type_user">back</a>
      </div>
  </div>
  <br clear="all">
  <div class="page-content row-fluid">
    <form class="stdform form-horizontal tambahData" style="display:none" method="post" >
      <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
	  <input type="hidden" name="ds[pt_id]" id="pt_id" value="<?= $konten['pt_id']?>">
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
            <input type="text" autofocus="" name="" id="treat_name" placeholder="Nama Tindakan">
			<input type="hidden" name="ds[treat_id]" id="treat_id">
          </div>
		  <label class="control-label">Jenis Kelompok</label>
          <div class="controls">
            <input type="text" name="" id="treat_group" placeholder="Jenis Kelompok" readonly>
			<!--label id="treat_group"></label-->
          </div>
		  <label class="control-label">Harga</label>
          <div class="controls">
            <input type="text" name="" id="treat_price" placeholder="Harga" readonly>
			<!--label id="treat_price"></label-->
          </div>
          <div class="clearfix"></div>
          <div class="controls">
              <p class="stdformbutton">
                  <input type="submit" value="Simpan" class="submit radius2 btn btn-primary"> 
                  <input type="reset" value="Reset" class="reset radius2 btn btn-warning ">
              </p>
          </div>
        </div>
      </div>
    </form>        
   </div>
  <div class="row-fluid">
    <div class="span7">
        <div class="widgetbox" style="float:left;padding-top:20px;padding-left:10px;">
  	<a href="" data-toggle="modal" class="modals btn btn-success">
  			<i class="icon-plus-sign icon-white"></i>Tambah</a>
  	<a href="" class="btn btn-danger delete_data">
  			<i class="icon-trash icon-white"></i> Hapus</a>
        </div>
    </div>

    <!--div class="span5" style="float:right;">
        <div class="widgetbox">
            <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
            <?=form_open(cur_url().'search',array('class' => 'form-horizontal frm_search stdform','id' => 'form')); ?>
              <div class="chatsearch" >
                  <input type="text" class='searchname' name="nama_dokter" placeholder="Cari Data Paket" style="wi dth:91%;margin:auto;">
              </div>
              <div style='display:none;' id="basic">
                  <input type="text" class="mediuminput" placeholder="masukkan nama dokter" autofocus="autofocus">
              </div>
              <div class="clearall"></div>
            <?=form_close()?>
        </div>
    </div-->
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div style="margin:10px;">
      <div class="black_loader">
          <img src="<?=get_loader(9)?>">
        </div>
        <div class="row-fluid list_type_user">
           
        </div>
      </div>
    </div>
  </div>
</div>