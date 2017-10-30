<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<script type="text/javascript">

function reloadTable(){
            var url_hasil="data_obat/loaddata"
            $(".list_obat").load(url_hasil);
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
                      url: "data_obat/delete_list",
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

         

        jQuery('.tgl_frm').val(getDateRaw(0)); 
          datas = getDateRaw(0);
          crsf = $('.crsf').val();
           

          $('.submit').click(function(){

          isvalid = $("form.ubahData").validate({
            rules: {
                'mst[im_name]': {"required": true},
                'mst[mtype_id]': {"required": true},                
            },
            submitHandler: function(form) {               
                var formdata = $('form.ubahData').serialize();

                $(".black_loader").fadeIn(300).fadeOut(function(){
                  $.post( "<?=base_url()?>master/data_obat/update",formdata).done(function(){
                     //window.open("<?=base_url()?>master/data_obat","_self");
                     window.history.back();
                  });
                });
                return false;
            }
        });

        
           
         })

        $('.reset').click(function(){
          resetInput();
        })
        
		$('.cancel').click(function(){
          window.history.back();
          //var bctable = $('.tabel-master').dataTable();
          //bctable.fnPageChange(8);
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
              <div class="span11">
              <div class="widget-box">
                  <div class="widget-title">
                      <span class="icon">
                          <i class="icon-th-list"></i>
                      </span>
                      <h5></h5>
                  </div>
				<label class="control-label">Kode</label>
				<div class="controls" >
					<input type="text" class='' required name="mst[im_id]" id="kode" value="<?php echo $result['im_id']; ?>" readonly>
				</div>
                <label class="control-label">Nama Obat</label>
                <div class="controls">
                  <input type="text" autofocus="" onClick="this.select();" name="mst[im_name]" id="im_name" value="<?php echo $result['im_name']; ?>">
                </div>
				<label class="control-label">Sediaan</label>
                <div class="controls">
                  <select name='mst[im_unit]' required id='' >
                          <!--option value="">-- Jenis Kategori --</option-->
                            <?php foreach ($sediaan as $keys) :?>
                                <option value="<?=$keys->mtype_id?>" <?php if($keys->mtype_id===$result['mtype_id']) echo 'selected="selected"';?> ><?=$keys->mtype_name?></option>
                                
                          	<?php endforeach?>
                          
                      </select>
                </div>
        <label class="control-label">Golongan</label>
          <div class="controls">
            <select name="mst[im_golongan]" style="width:140px">
                    <option value="">--- Pilih ---</option>
                    <?php foreach ($gol_obat as $key) :?>
                          <option value="<?=$key->gol_id?>" <?php if($key->gol_id===$result['im_golongan']) echo 'selected="selected"';?>><?=$key->gol_name?></option>
                          
                    <?php endforeach;?>
                   
                 
            </select>
          </div>
                <label class="control-label">Harga Beli + PPN</label>
                <div class="controls">
                  <input type="text" autofocus="" onClick="this.select();" name="mst[im_item_price_buy]" id="" value="<?=$result['im_item_price_buy']?>">
                </div>

				<label class="control-label">Harga Jual</label>
                <div class="controls">
                  <input type="text" autofocus="" onClick="this.select();" name="mst[im_item_price]" id="" value="<?=$result['im_item_price']?>">
                </div>
				<label class="control-label">Harga Kemasan</label>
                <div class="controls">
                  <input type="text" autofocus="" onClick="this.select();" name="mst[im_item_price_package]" id="" value="<?=$result['im_item_price_package']?>">
                </div>
				<label class="control-label">Stok Minimal</label>
                <div class="controls">
                  <input type="text" autofocus="" onClick="this.select();" name="mst[im_min_stock]" id="" value="<?=$result['im_min_stock']?>">
                </div>
				<label class="control-label">Stok Maximal</label>
                <div class="controls">
                  <input type="text" autofocus="" onClick="this.select();" name="mst[im_max_stock]" id="" value="<?=$result['im_max_stock']?>">
                </div>
              
              <div class="clearfix"></div>
               <div class="controls">
                    <p class="stdformbutton">
                        <input type="submit" value="Simpan" class="submit radius2 btn btn-primary"> 
                        <input type="button" value="Batal" class="cancel radius2 btn btn-default ">
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
    <div class="row-fluid list_obat">
       
    </div>
    <div class="black_loader">
          <img src="<?=get_loader(9)?>">
        </div>
    <!--div class="row-fluid list-tindakan">
    
	<div class="msg_wait"><center>Please wait for a minute...</center></div>
    
</div-->