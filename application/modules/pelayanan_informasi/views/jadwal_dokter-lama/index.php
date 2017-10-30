<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<script type="text/javascript">
    jQuery(document).ready(function() {
         // jQuery( "#datepicker" ).datepicker();
        $('.modals').click(function(){
           url = "<?=base_url()?>pelayanan_informasi/jadwal_dokter/get_pop";
           $.get(url,function(data){

              $('.modal-body').children().remove();
              $('.modal-body').append(data);
            
           });
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
           
           $('.jadwal-dokter').children().remove();
           $.ajax({
                          url: 'jadwal_dokter/loaddata',
                          type: "POST",
                          crossDomain: true,
                          data: {"csrf_jike_2012":crsf,"tgl":datas},
                          dataType: "html",
                          success: function( data ) {
                             
                            $('.jadwal-dokter').append(data);
                          }
                        });

         $('.submit_search').click(function(){
             $('.jadwal-dokter').children().remove();
            $.ajax({
                  url: 'jadwal_dokter/search',
                  type: "POST",
                  crossDomain: true,
                  data: $('.frm_search').serialize(),
                  dataType: "html",
                  success: function( data ) {
                    $('.jadwal-dokter').append(data);
                  }
                });
            return false;
         })

        

/*$("#add_schdl2").validate({
    rules:{
      nama_:{
        required:true,
      },
      poli:{
        required:true,
        
      },
      ruang:{
        required:true,
        
      },
      jam2:{
        required:true,
        
      }
    },
    errorClass: "help-inline",
    errorElement: "span",
    highlight:function(element, errorClass, validClass) {
      $(element).parents('.control-group').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).parents('.control-group').removeClass('error');
      $(element).parents('.control-group').addClass('success');
    }
  });*/

         $('.add_schdl').click(function(){
          return false;
         });
			//$('#DataTables_Table_0_filter').hide();
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
    position: absolute;
    top: -20px;
}
    
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=$title?>  <a href="#myModal" data-toggle="modal" style='float:right' class="modals btn btn-success"><i class="icon-plus-sign icon-white"></i>Tambah Jadwal</a></h1>
           
                 
                  <div id="myModal" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">x</button>
                      <h3>Tambah Jadwal Dokter</h3>
                    </div>
                    <div class="modal-body">
                      

                    </div>
                  </div>
        </div>
    </div>
    <br clear="all">
    <div class="row-fluid">
        <div class="span7">
            <div class="widgetbox">
                <div class="title"><h3 style="float:left;">Jadwal Dokter </h3><h3 style="float:left;" class="tgl-sekarang">Tabel Jadwal  </h3></div>
              
               

            </div>
        </div>
        <div class="span5">
            <div class="widgetbox">
              <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
                 <?//=form_open(cur_url().'create',array('class' => 'form-horizontal frm_search stdform','id' => 'form')); ?> 
				 <?=form_open(cur_url().'search',array('class' => 'form-horizontal frm_search stdform','id' => 'form')); ?> 
                    <!--input type='hidden' name='tgl_frm' class='tgl_frm'-->
                    <div class="chatsearch" >
                        <input type="text" class='searchname' name="nama_dokter" placeholder="Docter name" style="wi dth:91%;margin:auto;">
                    </div>
                    <div style='display:none;' id="basic">
                        <input type="text" class="mediuminput" placeholder="masukkan nama dokter" autofocus="autofocus">
                    </div>
                      
                    <div id="advance" style="margin-top:10px;">
                        <div class='span12' style='background:#fff;border:1px solid #ccc'>
                            <div class="title" style="margin-bottom:3px;"><h3>Pencarian Lanjut</h3></div>
                            <br clear="all">
                            <div class="control-group" style="border:none;">
                                <label class="control-label" style="width:20%;">Nama</label>
                                <div class="controls" >
                                    <input name='nama' type="text" style="float:left;">
                                </div>
                            </div>
                            <div class="control-group" style="border:none;">    
                                <label class="control-label" style="width:20%;">Poli</label>
                                 <div class="controls">
                                    <select name='poli' style="width:140px;float:left;" >
                                        <option value="">-- Poli --</option>
                                        <?php foreach($poli as $poli):?>
                                        <option value="<?=$poli->pl_id?>"><?=$poli->pl_name?></option>
                                        
                                        <?php endforeach;?>
                                        
                                    </select>
                                </div>
                            </div>
                            
                              
                            <div class=" " style="border:none;">
                                <label class="control-label" style="width:20%;">Jam </label>
                                <div class="controls">
                                <table>
                                    <tr>
                                         <label><input type="radio" value='' name="jam" />-</label> 
                                    </tr>  
                                     <?php foreach($jam as $jam):?>
                                        <tr>
                                         <label><input type="radio" value='<?=$jam->shift_id?>' name="jam" /><?php echo $jam->shift_start.' - '.$jam->shift_end?></label> 
                                        </tr>
                                        
                                      <?php endforeach;?>
                                </table>
                            </div>
                            </div> 
                            <br clear="all">   
                            <button class="btn btn-primary submit_search" style="float:left;margin-left:35%;margin-bottom:10px;margin-top:-20px;"><i class="icon-search icon-white"></i>Search</button>
                        </div>
                    </div>
                    <div class="clearall"></div>
                    <div class="search_choice">
                        <a class="active" atr="bsc" href="#">sederhana</a> | <a atr="adv" href="#">pencarian lanjut</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br clear="all">
    <div class="row-fluid">
       <div class='nav-date span12' style='margin-left:-5px;'>
        <div class="span6" style="float:left;">
            <div class='nav left-nav-date'><a class='btn btn-primary' style="color:white;" href='#'></a></div>
        </div>
        <div class="span6" style="float:right;">
            <div class='nav right-nav-date'><a class='btn btn-primary' style="color:white;" href='#'></a></div>
        </div>
        <input type='hidden' id='gap' value='1'>
        </div> 
    </div>
    <br clear='all'>
    <div class="row-fluid jadwal-dokter">
       
    </div>
</div>