<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>

<script type="text/javascript">
  function reloadTable(){
      var url_hasil="<?php echo base_url()?>master/jadwal_dokter/loaddata"
      $(".list_obat").load(url_hasil);
  }

  function resetInput(){
      $('#im_name').val('');
      $("select[name='ds[im_unit]']").val('');
      $('#im_min_stock').val('');
      $('#im_max_stock').val('');
  }
  $(function(){
    $('#form_additional').submit(function(){
        formdata = $('#form_additional').serialize();
        $.post( "<?=base_url()?>master/jadwal_dokter/additional_dr",formdata).done(function(){
             window.reload();
          });
      })

    $('#add_dokter').click(function(){
      $('#myModal').modal('show')
    })
    //select2
    $("#poli_name").select2({
            minimumInputLength: 0,
            width:'30%',
            placeholder : 'Nama Poli',
            ajax: {
                url: BASE+"master/jadwal_dokter/get_poli",
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

    $("#dr_name").select2({
            minimumInputLength: 0,
            width:'30%',
            placeholder : 'Nama Dokter',
            ajax: {
                url: BASE+"master/jadwal_dokter/get_dokter",
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
          //$('#dr_id').val(data.id)
                }
            }
        });
    $('#dr_name').change(function(){
      var thisID=$('#dr_name').select2('data').id;
      $('#dr_id').val(thisID);
    })
        
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
         var r = confirm("Anda yakin akan menghapus data obat ini ?");
            if (r == true) {
          
                  $(".black_loader").fadeIn(300).fadeOut(function(){
                    // console.log($(t).attr('href'));
                     $.ajax({
                        url: "<?php echo base_url()?>master/jadwal_dokter/delete_list",
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
      })

      jQuery('.tgl_frm').val(getDateRaw(0)); 
      datas = getDateRaw(0);
      crsf = $('.crsf').val();
         
      $('.list_obat').children().remove();
      $.ajax({
        url: '<?php echo base_url()?>master/jadwal_dokter/loaddata',
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
                'ds[im_min_stock]': {"required": true, "number": true},
                'ds[im_max_stock]': {"required": true, "number": true},
                'ds[im_name]': "required",
                'ds[im_unit]': {"required": true},
                 
            },
            submitHandler: function(form) {
                var url = "<?= base_url() ?>pendaftaran/pendaftaran_rawat_jalan/data_sosial";
                var data = $("#form_pendaftaran_baru").serialize();
                formdata = $('form.tambahData').serialize();

                $(".black_loader").fadeIn(300).fadeOut(function(){
                  $.post( "<?=base_url()?>master/jadwal_dokter/create",formdata).done(function(){
                     
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
        var r = confirm("Anda yakin akan menghapus data obat ini ?");
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
          sch_id =  $(this).parent().parent().parent().find('.sch_id').val();
          //im_name =  $(this).parent().parent().parent().find('.dsim_name').val();
          sch_day =  $(this).parent().parent().parent().find('.sch_day').val();
          sch_shift =  $(this).parent().parent().parent().find('.sch_shift').val();
          sch_pl =  $(this).parent().parent().parent().find('.sch_pl').val();
          crsf = $('.crsf').val();
          url = "<?=base_url()?>master/jadwal_dokter/update";
          datapost = "csrf_jike_2012="+crsf+"&sch[sch_id]="+sch_id+"&sch[day]="+sch_day+"&sch[sch_shift]="+sch_shift+"&sch[pl_id]="+sch_pl;
          
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
          <h1 class="pagetitle"><?=$title?></h1>
            <div id="myModalX" class="modal hide">
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
            <h5>Tambah Jadwal Dokter</h5>
          </div>
          
             <div class="control-group" style="border:none;">
                                <label class="control-label" >Nama</label>
                                <div class="controls" >
                                  <input type="hidden" name="" id="dr_name" class="" value="">
                                  <input type="hidden" name="mst[employe_id]" id="dr_id" class="" value="">
								   <!--select name='mst[employe_id]' required id='nama'  >
										<option value="">-- Nama Dokter --</option>
										<?php foreach($listdokter as $dokter):?>
										<option value="<?=$dokter->id_employe?>"><?=$dokter->sd_name?></option>
										
										<?php endforeach;?>
										
									</select-->
                                    <a href="#"class="btn btn-mini btn-success" id="add_dokter"><i class="icon-plus icon-white"></i></a>
                                </div>
                            </div>
                            <div class="control-group" style="border:none;">    
                                <label class="control-label" >Poli</label>
                                 <div class="controls">
                                     <!--select name='mst[pl_id]' required id='poli'  >
                                        <option value="">-- Poli --</option>
                                        <?php foreach($poli2 as $poli2):?>
                                        <option value="<?=$poli2->pl_id?>"><?=$poli2->pl_name?></option>
                                        
                                        <?php endforeach;?>
                                        
                                    </select-->
                                    <input type="hidden" name="" id="poli_name" class="" value="">
                                    <input type="hidden" name="mst[pl_id]" id="poli_id" class="" value="">
                                </div>
                            </div>
                            
                             <div class="control-group" style="border:none;">
                                <label class="control-label" >Hari</label>
                                <div class="controls" >
                  <select name='mst[day]' required id='day'  >
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Ahad">Ahad</option>
                                    </select>             
                                </div>
                            </div>                             
                            <div class="control-group" style="border:none;">
                                <label class="control-label" >Jam</label>
                                <div class="controls">
                                <table>
                                    <?php foreach($jam2 as $jams):?>
                                        <tr>
                                         <label><input required class='jam' type="radio" value='<?=$jams->shift_id?>' name="mst[sch_shift]"><?php echo $jams->shift_start.' - '.$jams->shift_end?></label> 
                                        </tr>
                                        
                                      <?php endforeach;?>
                                    
                                </table>
                            </div>
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
                  <input type="text" class='searchname' name="nama_dokter" placeholder="Cari Dokter" style="wi dth:91%;margin:auto;">
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

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h3 id="myModalLabel">Tambah Dokter</h3>
  </div>
  <form method="post" id="form_additional">
  <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
  <div class="modal-body">
    <!--label class="control-label">NIP</label>
    <div class="controls">
      <input type="text" autofocus="" name="add[sd_nip]" id="" class="" placeholder="N.I.P">
    </div-->    
    <label class="control-label">Nama Dokter</label>
    <div class="controls">
      <input type="text" autofocus="" name="add[sd_name]" id="" class="" placeholder="Nama Dokter">
      <input type="hidden" autofocus="" name="add[sd_employe_tp]" value="1">
    </div>
    <label class="control-label">Spesialisasi</label>
    <div class="controls">
      <select style="width:350px"  name="add[sd_type_user]" class="">
        <option value="">--- Pilih ---</option>
            <?foreach ($user_type->result() as $key): ?>
                <option value="<?=$key->id_type_user?>"><?=$key->description?></option>
            <?endforeach ?>
        </select>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
  </form>
</div>