<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<script type="text/javascript">
  function reloadTable(){
      $(".alert").fadeIn().delay(800).fadeOut(function(){});
      var url_hasil="<?php echo base_url()?>gudang/stok/loaddata";
      $(".list_obat").load(url_hasil);
  }

  $(function(){
        
      jQuery('.tgl_frm').val(getDateRaw(0)); 
      datas = getDateRaw(0);
      crsf = $('.crsf').val();
		        
      $('#gap').val('0');

      $('.searchname').keyup(function(){
        var search = $('.searchname').val();
         $('.dataTables_filter input').val(search).trigger('keyup');
      })
   
      $('.list_obat').children().remove();
      $(".alert").fadeIn().delay(3000).fadeOut(function(){
          $.ajax({
            url: '<?php echo base_url()?>gudang/stok/loaddata',
            type: "POST",
            crossDomain: true,
            data: "csrf_jike_2012="+crsf+"&tgl="+datas,
            dataType: "html",
            success: function( data ) {
              
              $('.list_obat').append(data);
            }
          });         
      });

      $('.btn_pencil').live("click",function(){
          // reloadTable();
          $(this).parent().parent().parent().find('.shows').hide();
          $(this).parent().parent().parent().find('.hiddens').show();
        return false;

      })

      $('.submitEdit').live("click",function(){
          t = this;
          ins_id =  $(this).parent().parent().parent().find('.dsim_id').val();
          ins_qty =  $(this).parent().parent().parent().find('.dsim_qty').val();
  		    ins_ed =  $(this).parent().parent().parent().find('.dsim_ed').val();
  		    ins_batch =  $(this).parent().parent().parent().find('.dsim_batch').val();
  		    ins_price =  $(this).parent().parent().parent().find('.dsim_price').val();
          ins_item =  $(this).parent().parent().parent().find('.dsim_item').val();
          
          crsf = $('.crsf').val();
          url = "<?=base_url()?>gudang/stok/update";
          datapost = "csrf_jike_2012="+crsf+"&ds[istok_item]="+ins_item+"&ds[istok_id]="+ins_id+"&ds[istok_qty]="+ins_qty+
						"&ds[istok_item_price]="+ins_price+"&ds[istok_exp]="+ins_ed+"&ds[istok_batch]="+ins_batch;
          
          $(".black_loader").fadeIn(800).fadeOut(function(){
              $.post(url,datapost).done(function(){
                //$(".black_loader").fadeIn(300).fadeOut(function(){
                  reloadTable();  
                //});
                
                //$(t).parent().parent().parent().find('.shows').show();
                //$(t).parent().parent().parent().find('.hiddens').hide();

              })
          })

          $(this).parent().parent().parent().find('.shows').show();
          $(this).parent().parent().parent().find('.hiddens').hide();
      })
});
</script>
<style>
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
        <p>Loading...   </p>
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="gritter-bottom"></div>
  </div>
</div>

<div class="container-fluid" style="padding:0px;">  
  <br clear="all">
  <div class="page-content row-fluid">
            
  </div>
  <div class="row-fluid btn_utility">
    <div class="span5" style="float:right;">
        <div class="widgetbox">
            <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
            <?=form_open(cur_url().'search',array('class' => 'form-horizontal frm_search stdform','id' => 'form')); ?>
              <div class="chatsearch" >
                  <input type="text" class='searchname' name="nama_dokter" placeholder="" value="Tekan Ctrl+F untuk mencari nama obat" style="wi dth:91%;margin:auto;" readonly="readonly">                  
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