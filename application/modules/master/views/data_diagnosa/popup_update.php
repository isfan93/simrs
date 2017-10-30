<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<script type="text/javascript">

jQuery(document).ready(function() {
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

                $(".black_loader").fadeIn(300).fadeOut(function(){
                  $.post( "<?=base_url()?>master/data_diagnosa/update",formdata).done(function(){
                     window.open("<?=base_url()?>master/data_diagnosa","_self");
                      //reloadTable();
                      //resetInput();
                  });
                });
                return false;
            }
        });
    })

		$('.cancel').click(function(){
          window.history.back();
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
					<input type="text" class='' required name="mst[diag_kode]" id="kode" value="<?php echo $result['diag_kode']; ?>" readonly>
					<input type="hidden" class='' name="mst[diag_id]" id="id" value="<?php echo $result['diag_id']; ?>" >
				</div>
                <label class="control-label">Diagnosa Name</label>
                <div class="controls">
                  <input type="text" autofocus="" name="mst[diag_name]" id="" value="<?php echo $result['diag_name']; ?>">
                </div>
				<label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="mst[description]"><?php echo $result['description']; ?></textarea>
                </div>
                <label class="control-label">Deskripsi</label>
                <div class="controls">
                  <textarea name="mst[indonesian]"><?php echo $result['indonesian']; ?>
                  </textarea>
                  
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
    <br clear="all">
    <div class="row-fluid list_tindakan">
       
    </div>
    <div class="black_loader">
          <img src="<?=get_loader(9)?>">
        </div>
    