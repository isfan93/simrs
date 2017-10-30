
 <script src="<?=base_url()?>assets/js/valid.js"></script>
 <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
 <script type="text/javascript" src='<?=base_url()?>assets/js/jquery.gritter.min.js'></script> 
 <script>
                          $(function(){

                            $('input[name="tanggal"]').val(getDateRaw2(0));
                            $('input[name="tanggal2"]').val(getDateRaw2(0));
                            $('.jam:eq(0)').prop('checked',true);
                             if($('.jam:eq(0)').is(":checked")){
                               id = $('.jam:eq(0)').val();
                              url = BASE+'master/jadwal_dokter/get_jam/'+id;
                              $.getJSON(url,function(data,v){
                                  $('.jam_hide').val('');
                                  $('.jam_hide').val(data.shift_start+' '+data.shift_end);
                              })
                             }
                            $('.jam').change(function(){
                              id = $(this).val();
                              url = BASE+'master/jadwal_dokter/get_jam/'+id;
                              $.getJSON(url,function(data,v){
                                  $('.jam_hide').val('');
                                  $('.jam_hide').val(data.shift_start+' '+data.shift_end);
                              })
                            })

                            $('.nama_fx').flexbox(BASE+'master/jadwal_dokter/get_dokter',{
                              paging: false,
                              showArrow: false ,
                              maxVisibleRows : 10,
                              width : 250,
                              resultTemplate: '{name}',

                            });

                            $(".add_schdl").validate({
                               rules: {
                                  'nama_input':"required",
                                  'nama': "required",     
                                  'poli' : "required",
                                  'tanggal' : "required"
                              },
                              Message:{
                                'poli' : "Pilih poli terlebih dulu",
                              },
                              submitHandler: function(form) {
                                 $.ajax({
                                    url: 'jadwal_dokter/add_schdl',
                                    type: "POST",
                                    crossDomain: true,
                                    data: $('.add_schdl').serialize(),
                                    dataType: "json",
                                    success: function( data ) {
                                        $('.close').click();
                                         $.gritter.add({
                                            title:  'Success',
                                            text: 'Data berhasil didimpan',
                                            sticky: true
                                          });   
                                         //tbldokter.fnDraw();
                                        
                                    },
                                    error:function(){
                                      $('.error_submit').html('terjadi kesalahan saat menyimpan data, mohon ulangi sekali lagi ');
                                    }
                                  });
                                return false;
                            },
                            
                            errorPlacement: function(error, element) {
                               error.appendTo( element.parents(".controls"));
                             }
                            });

                              now = new Date();
                              $('.datepicker').datepicker({
                                minDate: 0,
								dateFormat : 'dd/mm/yy'
                              });
                          })

</script>
<style type="text/css" media="screen">
    .alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    .form-horizontal .controls {
      margin-left: 125px;
      padding: 5px 0;
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

<?=form_open(cur_url().'add_schdl',array('class' => 'form-horizontal add_schdl stdform','id' => 'add_schdl2 form basic_validate','name' =>'add_schdl2','novalidate'=>"novalidate")); ?>
                            <div id="advances" style="margin-top:10px;">
                        <div class='span12' >

                            <div class="control-group" style="border:none;">
                                <label class="control-label" style="width:20%;">Nama</label>
                                <div class="controls" >
                                    <div class='nama_fx' name="nama" id="nama"></div>
									<input type="hidden" id="employ_id" name="mst[employ_id]" required>
                                </div>
                            </div>
                            <div class="control-group" style="border:none;">    
                                <label class="control-label" style="width:20%;">Poli</label>
                                 <div class="controls">
                                     <select name='mst[pl_id]' required id='poli' style="width:140px;float:left;" >
                                        <option value="">-- Poli --</option>
                                        <?php foreach($poli2 as $poli2):?>
                                        <option value="<?=$poli2->pl_id?>"><?=$poli2->pl_name?></option>
                                        
                                        <?php endforeach;?>
                                        
                                    </select>
                                </div>
                            </div>
                            
                             <div class="control-group" style="border:none;">
                                <label class="control-label" style="width:20%;">Hari</label>
                                <div class="controls" >
									<select name='mst[day]' required id='day' style="width:140px;float:left;" >
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
                                <label class="control-label" style="width:20%;">Jam</label>
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

                            
                            
                            <br clear="all">   
                            <label class='error_submit' style='background: url("../assets/img/caution.png") no-repeat 2px 4px;
padding-left: 19px;
font-weight: bold;
color: #C00 !important;
clear: both;'></label>
                            <input type="submit" value="Simpan" style='float:right' class="btn tambah_schdl btn-success">
                        </div>
                    </div>
</form>