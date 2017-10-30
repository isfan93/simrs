<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<script src="<?=base_url()?>assets/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">

<script src="<?=base_url()?>assets/js/jquery.chosen.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/chosen.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>

<script type="text/javascript">
    $(function(){
        url = "<?=base_url()?>rawat_jalan/poli_umum/get_all_dokter";
        datadokter ='<option value=""> --- </option>';
        $.getJSON(url,function(data){
            $(data).each(function(i,dokter){
                datadokter += "<option class='' value='"+dokter.id_employe+"'>"+dokter.sd_name+"</option>";
            })
            $(datadokter).appendTo('#dokterigd');
            $('#dokterigd').chosen({no_results_text: "data tidak ditemukan!"});
            $('.jamigd').datetimepicker({
                format:'Y-m-d H:i'
            });
        })

        $('.confirmdaftarigd').click(function(){
            mdc_id = '<?=$mdc_id?>';
            visit_id = mdc_id.substring(3, 8);

            physicianigd = $('#dokterigd').val();
            jam_masuk_igd = $('.jamigd').val();
            
            url = "<?=base_url()?>pendaftaran/transferIgd/<?=$mdc_id?>";
            data = $('#form_daftar_igd').serialize();
            
            if(physicianigd != '' && jam_masuk_igd != ''){
                     $.post(url,data,function(response){
                        console.log(response);
                        response = JSON.parse(response);
                        if ("success" === response.success) {
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran IGD berhasil. Silahkan akhiri (selesaikan) pemeriksaan poli.').fadeIn().delay(2000).fadeOut(function(){
                                    window.location = "<?=cur_url(-1)?>";
                                    // $('.row-fluid:eq(0),#warning').hide('fast');
                                });

                            });
                            $('#modalregister').modal('hide');
                        }else{
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(2000).fadeOut(function(){
                                    $('.row-fluid:eq(0),#warning').hide('fast');
                                });
                            });
                            $('.warning_igd').html('<b>Pasien telah terdaftar di IGD</b>').fadeIn();
                        }
                    });
            }else{
                $('.warning_igd').html('<b>Lengkapi data isian.</b>');
              
            }
            return false;
        });
        $('.confirmdaftarranap').click(function(){
            mdc_id = '<?=$mdc_id?>';
            visit_id = mdc_id.substring(3, 8);

            rooms = $('#rooms').val();
            
            url = "<?=base_url()?>pendaftaran/transferRanap/<?=$mdc_id?>";
            data = $('#form_daftar_ranap').serialize();
            
            if(rooms != ''){
                     $.post(url,data,function(response){
                        console.log(response);
                        response = JSON.parse(response);
                        if ("success" === response.success) {
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran Rawat Inap berhasil. Silahkan akhiri (selesaikan) pemeriksaan poli.').fadeIn().delay(2000).fadeOut(function(){
                                    // $('.row-fluid:eq(0),#warning').hide('fast');
                                    window.location = "<?=cur_url(-1)?>";
                                });
                            });
                            $('#modalregisterRanap').modal('hide');
                        }else{
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(2000).fadeOut(function(){
                                    $('.row-fluid:eq(0),#warning').hide('fast');
                                });
                            });
                            $('.warning_ranap').html('<b>Pasien telah terdaftar di Rawat Inap</b>').fadeIn();
                        }
                    });
            }else{
                $('.warning_ranap').html('<b>Lengkapi data isian.</b>');
              
            }
            return false;
        });
        $('.confirmdaftarlab').click(function(){
            mdc_id = '<?=$mdc_id?>';
            visit_id = mdc_id.substring(3, 8);
            var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/'+mdc_id+'/LB';
            data = $('#form_daftar_lab').serialize();
            // if(rooms != ''){
                     $.post(url,data,function(response){
                        console.log(response);
                        response = JSON.parse(response);
                        if ("success" === response.success) {
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran Laboratorium berhasil.').fadeIn().delay(3000).fadeOut(function(){
                                    $('.row-fluid:eq(0),#warning').hide('fast');
                                });
                            });
                            $('#modalregisterLab').modal('hide');
                        }else{
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(3000).fadeOut(function(){
                                    $('.row-fluid:eq(0),#warning').hide('fast');
                                });
                            });
                            $('.warning_lab').html('<b>Pasien telah terdaftar di Laboratorium</b>').fadeIn();
                        }
                    });
            // }else{
                // $('.warning_lab').html('<b>Lengkapi data isian.</b>'); 
            // }
            return false;
        });

        $('.confirmdaftarrad').click(function(){
            mdc_id = '<?=$mdc_id?>';
            visit_id = mdc_id.substring(3, 8);
            var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/'+mdc_id+'/RD';
            data = $('#form_daftar_rad').serialize();
            // if(rooms != ''){
                     $.post(url,data,function(response){
                        console.log(response);
                        response = JSON.parse(response);
                        if ("success" === response.success) {
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran Radiologi berhasil.').fadeIn().delay(3000).fadeOut(function(){
                                    $('.row-fluid:eq(0),#warning').hide('fast');
                                });
                            });
                            $('#modalregisterRad').modal('hide');
                        }else{
                            $('.row-fluid:eq(0)').show('fast',function(){
                                $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(3000).fadeOut(function(){
                                    $('.row-fluid:eq(0),#warning').hide('fast');
                                });
                            });
                            $('.warning_rad').html('<b>Pasien telah terdaftar di Radiologi</b>').fadeIn();
                        }
                    });
            // }else{
                // $('.warning_rad').html('<b>Lengkapi data isian.</b>'); 
            // }
            return false;
        });
    })
</script>

<div class="container-fluid">
     <div class="row-fluid" style="display:none">
        <div class="span12">
            <div id="warning"></div>
        </div>
    </div>
    <!-- <button id="igdRegistration" >show</button> -->
    <div class="row-fluid">
        <div class="span12" style="background:#E5E5E5;padding-bottom:10px">
            <div class="title pull-left" style="margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;"><h3>Data Pasien</h3></div>
            <!-- <div class="title" style="float:right;margin-bottom:-5px;margin-top:-10px;padding-top:0px;padding-bottom:0px;margin-right:20px;"><h3><?php echo pretty_date(date('Y-m-d'),false);?></h3></div> -->
            <div class="pull-right">
                <div class="btn-group" style="position: relative; top: 10px; left: -10px;">
                <button data-toggle="dropdown" class="btn btn-small btn-warning dropdown-toggle">
                    <i class="icon-tasks"></i> Transfer pasien
                </button>
                <ul class="dropdown-menu">
                  <li><a id="labRegistration" ><i class="icon-filter"></i> Daftar Lab</a></li>
                  <li><a id="radRegistration" ><i class="icon-eye-open"></i> Daftar Radiologi</a></li>
                  <li><a id="igdRegistration" ><i class="icon-briefcase"></i> Daftar IGD</a></li>
                  <li><a id="ranapRegistration" ><i class="icon-list-alt"></i> Daftar Rawat Inap</a></li>
                </ul>
              </div>
            </div>
            


            <br clear="all">
            <div class="row-fluid">
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:20px;">
                        <div style="float:left;">
                            <b>No.RM</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>: <?=$prev['sd_rekmed']?> / <?=$prev['sd_name']?></b>
                        </div>
                    </div>
                </div>
                <div class="span2">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                        <div style="float:left;">
                            <b>JK</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <?php if($prev['sd_sex'] == 'L'){ $sex = 'Laki-laki';}else{ $sex = 'Perempuan';} ?>
                            <b>: <?=$sex?> / <?=$prev['sd_age']?> Tahun</b>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;">
                        <div style="float:left;">
                            <b>Alergi</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>: <?php echo $pasien->sd_alergi;?></b>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div style="padding:10px;float:left;width:100%;padding-bottom:0px;padding-left:0px;padding-right: 0px;">
                        <div style="float:left;">
                            <b>Riwayat</b>
                        </div>
                        <div style="float:left;margin-left:10px;">
                            <b>: <?php echo $pasien->sd_riwayat_penyakit;?></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Register IGD -->
<div id="modalregister" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Pendaftaran Transfer IGD</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid" style="display:none">
            <div class="span12">
                <div id="warning_igd"></div>
            </div>
        </div>
        <?=form_open(base_url(),array('class' => 'form-horizontal','id' => 'form_daftar_igd')); ?>
            <label class="control-label">Waktu</label>
            <div class="controls">
                <input type="text" name="jam_masuk_igd" class='hasDatepicker jamigd'>
                <input type="hidden" name="service_id" value="<?=$mdc_id?>">
                <input type="hidden" name="visit_id" value="<?=substr($mdc_id,3,8)?>">
                <input type="hidden" name="igd" value="yes">
                <input type="hidden" name="no_rekmed" value="<?=$prev['sd_rekmed']?>">
                <input type="hidden" name="transfer_pasien" value="yes">
                
            </div>

            <label class="control-label">Dokter Jaga</label>
            <div class="controls">
                <select id="dokterigd"  name='physician'></select>
            </div>
        <?=form_close()?> 
    </div>
    <div class="modal-footer">
       <span class="warning_igd alert alert-error" style="display:none;float: left; margin-bottom: 0px;"></span>
        <a href="#" class="btn btn-primary confirmdaftarigd">Transfer Pesien ke IGD</a>
        <a href="#" class="btn" data-dismiss="modal">Batal</a>
    </div>
</div>

<!-- Modal Register Rawat Inap -->
<div id="modalregisterRanap" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Pendaftaran Transfer Rawat Inap</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid" style="display:none">
            <div class="span12">
                <div id="warning_ranap"></div>
            </div>
        </div>
        <?=form_open(base_url(),array('class' => 'form-horizontal','id' => 'form_daftar_ranap')); ?>
            
            <input type="hidden" name="service_id" value="<?=$mdc_id?>">
            <input type="hidden" name="visit_id" value="<?=substr($mdc_id,3,8)?>">
            <input type="hidden" name="ranap" value="yes">
            <input type="hidden" name="no_rekmed" value="<?=$prev['sd_rekmed']?>">
            <input type="hidden" name="transfer_pasien" value="yes">

            <label class="control-label">No.Rekam Medis</label>
            <div class="controls">
                <label style="margin-top:3px"><?= $prev['sd_rekmed'] ?></label>
            </div>
            <label class="control-label">Nama Pasien</label>
            <div class="controls">
                <label style="margin-top:3px"><?= $prev['sd_name'] ?></label>
            </div>
            <label class="control-label">Kelas</label>
            <div class="controls">
                <select id="class" name="class" class="chosen-select input-large">
                    <option value="" selected="selected">-- Pilih Kelas --</option>
                    <?php if (!empty($classes)) : ?>
                        <?php foreach ($classes as $class) : ?>
                            <option value="<?= $class->class_id ?>"><?= $class->class_name ?> - <?php echo int_to_money($class->price) ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
            <label class="control-label">Kamar : </label>
            <div class="controls">
                <select id="rooms" name="rooms" class="chosen-select input-large">
                    <option value="" selected="selected">-- Pilih Kamar --</option>
                </select>
            </div>
            <label class="control-label">Paviliun : </label>
            <div class="controls">
                <label style="margin-top:3px"><span id='pavillion'>-</span></label>
            </div>
            <label class="control-label">Keterangan</label>
            <div class="controls">
                <textarea name="service_note" id="service_note" class="span3" rows="4" placeholder="Pasien Pulang (Meninggal/Penyembuhan) / Pasien Ke Rawat Inap (Isolasi/Tidak)"></textarea>
            </div>
        <?=form_close()?> 
    </div>
    <div class="modal-footer">
       <span class="warning_ranap alert alert-error" style="display:none;float: left; margin-bottom: 0px;"></span>
        <a href="#" class="btn btn-primary confirmdaftarranap" disabled="disabled">Transfer Pesien ke Rawat Inap</a>
        <a href="#" class="btn" data-dismiss="modal">Batal</a>
    </div>
</div>

<!-- Modal Register Lab -->
<div id="modalregisterLab" class="modal hide fade" style="width:80%;left:30%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Pendaftaran Laboratorium</h3>
    </div>
    <div class="modal-body row" style="overflow-y:auto;overflow-x:hidden;">
        <div class="row-fluid" style="display:none">
            <div class="span12">
                <div id="warning_lab"></div>
            </div>
        </div>
            <div class="span12">
            <?=form_open(base_url(),array('class' => 'form-horizontal','id' => 'form_daftar_lab')); ?>
                <input type="hidden" name="service_id" value="<?=$mdc_id?>">
                <input type="hidden" name="visit_id" value="<?=substr($mdc_id,3,8)?>">
                <input type="hidden" name="lab" value="yes">
                <input type="hidden" name="no_rekmed" value="<?=$prev['sd_rekmed']?>">
                <input type="hidden" name="transfer_pasien" value="yes">
                <div class="row-fluid">
                    <div style="padding:12px;">
                        <?php $repeat=true;$row=1;foreach ($penunjang_lab->result() as $key => $value) :  ?>
                        <?php if(($value->ds_gol==1)&&($repeat==true)){
                                    echo '<b>'.$value->golongan_name.'</b>';
                                    $repeat=false;
                                }
                        ?>
                        <?php if($value->ds_gol!=$row): ?>
                            <hr><b><?=$value->golongan_name?></b>
                        <?php $row=$value->ds_gol;endif; ?>
                        <div class="<?//= $kolom ?>">
                            <input type="checkbox" class="checkbox penunjang_lab" name="penunjang[]" value="<?=$value->ds_id?>" id="penunjang_<?=$value->ds_id?>" /><label for="penunjang_<?=$value->ds_id?>" style="margin-left:5px;"> <?=$value->ds_name?></label>
                            <input type="hidden" name="nama_penunjang[<?=$value->ds_id?>]" value="<?=$value->ds_name?>" id="nama_penunjang_<?=$value->ds_id?>" />
                            <input type="hidden" name="harga[<?=$value->ds_id?>]" value="<?=$value->ds_price?>" id="harga_<?=$value->ds_id?>" />
                            <input type="hidden" name="type[<?=$value->ds_id?>]" value="lab" id="type_<?=$value->ds_id?>" />
                        </div>

                        <?php endforeach; ?>
                        <?php /*if( (isset($penunjang_lab)) && ($penunjang_lab->num_rows() >= 1) ) : ?>
                            <?php $countPenunjang = round($penunjang_lab->num_rows() / 2); $count = 1;?>
                            <?php foreach ($penunjang_lab->result() as $key => $value) :  ?>
                                <?php if($count == 1) :  ?>
                                    <div class="row-fluid">
                                <?php endif;?>
                                    <div class="span4">
                                        <input type="checkbox" class="checkbox penunjang_lab" name="penunjang[]" value="<?=$value->ds_id?>" id="penunjang_<?=$value->ds_id?>" /><label for="penunjang_<?=$value->ds_id?>" style="margin-left:5px;"> <?=$value->ds_name?></label>
                                        <input type="hidden" name="nama_penunjang[<?=$value->ds_id?>]" value="<?=$value->ds_name?>" id="nama_penunjang_<?=$value->ds_id?>" />
                                        <input type="hidden" name="harga[<?=$value->ds_id?>]" value="<?=$value->ds_price?>" id="harga_<?=$value->ds_id?>" />
                                        <input type="hidden" name="type[<?=$value->ds_id?>]" value="lab" id="type_<?=$value->ds_id?>" />
                                    </div>
                                <?php if($count == 3) :?>
                                    </div>
                                    <?php $count = 0;?>
                                <?php endif;?>
                                <?php $count++;?>
                            <?php endforeach; ?>
                            <?php if($count <= 3) :?>
                                </div>
                            <?php endif;?>
                        <?php endif;*/?>
                    </div>
                </div>
            <?=form_close()?> 
            </div>
    </div>
    <div class="modal-footer">
       <span class="warning_lab alert alert-error" style="display:none;float: left; margin-bottom: 0px;"></span>
        <button class="btn btn-primary confirmdaftarlab">Daftarkan Pasien ke Laboratorium</button>
        <button class="btn" data-dismiss="modal">Batal</button>
    </div>
</div>

<!-- Modal Register Rad -->
<div id="modalregisterRad" class="modal hide fade" style="width:80%;left:30%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Pendaftaran Radiologi</h3>
    </div>
    <div class="modal-body row" style="overflow-y:auto;overflow-x:hidden;">
        <div class="row-fluid" style="display:none">
            <div class="span12">
                <div id="warning_rad"></div>
            </div>
        </div>
            <div class="span12">
            <?=form_open(base_url(),array('class' => 'form-horizontal','id' => 'form_daftar_rad')); ?>
                <input type="hidden" name="service_id" value="<?=$mdc_id?>">
                <input type="hidden" name="visit_id" value="<?=substr($mdc_id,3,8)?>">
                <input type="hidden" name="rad" value="yes">
                <input type="hidden" name="no_rekmed" value="<?=$prev['sd_rekmed']?>">
                <input type="hidden" name="transfer_pasien" value="yes">
                <div class="row-fluid">
                    <div style="padding:12px;">
                        <?php $repeat=true;$row=11;foreach ($penunjang_rad->result() as $key => $value) :  ?>
                        <?php if(($value->ds_gol==11)&&($repeat==true)){
                                    echo '<b>'.$value->golongan_name.'</b>';
                                    $repeat=false;
                                }
                                //11 = id pertama untuk golongan radiologi
                        ?>
                        <?php if($value->ds_gol!=$row): ?>
                            <hr><b><?=$value->golongan_name?></b>
                        <?php $row=$value->ds_gol;endif; ?>
                        <div class="<?//= $kolom ?>">
                            <input type="checkbox" class="checkbox penunjang_rad" name="penunjang[]" value="<?=$value->ds_id?>" id="penunjang_<?=$value->ds_id?>" /><label for="penunjang_<?=$value->ds_id?>" style="margin-left:5px;"> <?=$value->ds_name?></label>
                            <input type="hidden" name="nama_penunjang[<?=$value->ds_id?>]" value="<?=$value->ds_name?>" id="nama_penunjang_<?=$value->ds_id?>" />
                            <input type="hidden" name="harga[<?=$value->ds_id?>]" value="<?=$value->ds_price?>" id="harga_<?=$value->ds_id?>" />
                            <input type="hidden" name="type[<?=$value->ds_id?>]" value="rad" id="type_<?=$value->ds_id?>" />
                        </div>

                        <?php endforeach; ?>
                        <?php /*if( (isset($penunjang_rad)) && ($penunjang_rad->num_rows() >= 1) ) : ?>
                            <?php $countPenunjang = round($penunjang_rad->num_rows() / 2); $count = 1;?>
                            <?php foreach ($penunjang_rad->result() as $key => $value) :  ?>
                                <?php if($count == 1) :  ?>
                                    <div class="row-fluid">
                                <?php endif;?>
                                    <div class="span4">
                                        <input type="checkbox" class="checkbox penunjang_rad" name="penunjang[]" value="<?=$value->ds_id?>" id="penunjang_<?=$value->ds_id?>" /><label for="penunjang_<?=$value->ds_id?>" style="margin-left:5px;"> <?=$value->ds_name?></label>
                                        <input type="hidden" name="nama_penunjang[<?=$value->ds_id?>]" value="<?=$value->ds_name?>" id="nama_penunjang_<?=$value->ds_id?>" />
                                        <input type="hidden" name="harga[<?=$value->ds_id?>]" value="<?=$value->ds_price?>" id="harga_<?=$value->ds_id?>" />
                                        <input type="hidden" name="type[<?=$value->ds_id?>]" value="rad" id="type_<?=$value->ds_id?>" />
                                    </div>
                                <?php if($count == 3) :?>
                                    </div>
                                    <?php $count = 0;?>
                                <?php endif;?>
                                <?php $count++;?>
                            <?php endforeach; ?>
                            <?php if($count <= 3) :?>
                                </div>
                            <?php endif;?>
                        <?php endif;*/?>
                    </div>
                </div>
            <?=form_close()?> 
            </div>
    </div>
    <div class="modal-footer">
       <span class="warning_rad alert alert-error" style="display:none;float: left; margin-bottom: 0px;"></span>
        <button class="btn btn-primary confirmdaftarrad">Daftarkan Pasien ke Radiologi</button>
        <button class="btn" data-dismiss="modal">Batal</button>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all;" style="background-color:white;padding-left:0px;margin-left:0px;" >
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding-left:0px;margin-left:0px;">
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/rekam_medis/$sd_rekmed")?>' id="tab_rekmed">Rekam Medis</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/kajian/$mdc_id")?>' id="tab_kajian">Subjective</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/objective/$mdc_id")?>' id="tab_objective">Objective</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/diagnosis/$mdc_id")?>' id="tab_diagnosis">Assessment & Procedures</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/poli_umum/konsul/$mdc_id")?>' id="tab_diagnosis">Konsul & Visite</a></li>
                    <!-- <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/penunjang/$mdc_id/$sd_rekmed")?>' id="tab_penunjang">Plan : Labs & Radiology</a></li> -->
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/resep/$mdc_id")?>' id="tab_obat">Plan : Medications</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/keterangan/$mdc_id")?>' id="tab_keterangan">Keterangan</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/harga/$mdc_id")?>' id="tab_harga">Harga</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("rawat_jalan/$url_poli/ringkasan/$mdc_id")?>' id="tab_ringkasan">Ringkasan</a></li>
                </ul>
                <div id="page">
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .xdsoft_noselect{
        display: none;
    }
    .dropdown-menu {
        margin: 2px -30px 0;
    }
    #warning{font-size:14px;font-weight:bold;text-align: center;}

</style>

<script type="text/javascript" charset="utf-8">
    $(function(){
        var rooms, roomClass, room;
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $("#tabs ul li a").click(function(){
            var surl =  $(this).attr("surl");
            $("#page").load(surl);
            $("#tabs ul li").each(function(){
                $(this).removeClass('ui-state-active ui-tabs-selected');
            })
            $(this).parent().addClass("ui-state-active ui-tabs-selected");
            return false;
        })
        $("#tabs ul li:eq(0) a").trigger('click');

        $("#lihat_antrian").click(function(){
            window.location("<?=cur_url(-1)?>");
        });

        // $('#').live('click',function(e){
        //     e.preventDefault();
        //     mdc_id = '<?=$mdc_id?>';
        //     visit_id = mdc_id.substring(3, 8);
        //     var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/'+mdc_id+'/LB';
        //     $.post(url,function(response){
        //         response = JSON.parse(response);
        //         if ("success" === response.success) {
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran laboratorium berhasil').fadeIn().delay(3000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });

        //         }else{
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(3000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });
        //         }
        //     });
        // });

        // $('#radRegistration').live('click',function(e){
        //    e.preventDefault();
        //     mdc_id = '<?=$mdc_id?>';
        //     visit_id = mdc_id.substring(3, 8);
        //     var url = '<?=base_url()?>rawat_inap/pendaftaran_lab_rad/'+mdc_id+'/RD';
        //     // data ="csrf_jike_2012=0c07b747c46618a36d334776b66a3b78&lab=yes&service_id="+mdc_id+"&visit_id="+visit_id ;
        //     $.post(url,function(response){
        //         response = JSON.parse(response);
        //         console.log(response);
        //         if ("success" === response.success) {
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-success').html('Proses pendaftaran radiologi berhasil').fadeIn().delay(2000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });
        //         }else{
        //             $('.row-fluid:eq(0)').show('fast',function(){
        //                 $('#warning').removeClass().addClass('alert alert-error').html(response.message).fadeIn().delay(2000).fadeOut(function(){
        //                     $('.row-fluid:eq(0),#warning').hide('fast');
        //                 });
        //             });
        //         }
        //     });
        // });

        $('#igdRegistration').click(function(){
            $('#modalregister').modal();
        });
        $('#ranapRegistration').click(function(){
            $('#modalregisterRanap').modal();
        });
        $("#labRegistration").click(function(){
            $("#modalregisterLab").modal();
        });
        $("#radRegistration").click(function(){
            $("#modalregisterRad").modal();
        });

        $("#class").change(function() {
            roomClass = $(this).val();
            if ($(this).val() !== '') {
                $('#pavillion').html('-');
                $('#rooms').children().not(':first').remove();
                $('input[name=bed_id],input[name=pavillion_id]').val('');
                var $class = ($("#class").val());
                $.get("<?= base_url() ?>pendaftaran/getRoom/" + $class, function(result) {
                    rooms = JSON.parse(result);
                    var roomOptions = '';
                    var roomNumber = 0;
                    $(rooms).each(function(index, value) {
                        if (value.room_id !== roomNumber) {
                            roomOptions += '<option value="' + index + '-' + value.pavillion_id + '-' + value.room_id + '-' + value.bed_id + '">Kamar No. ' + value.room_id + '<option>';
                            roomNumber = value.room_id;
                        }
                    });
                    $('#rooms').append(roomOptions).trigger("liszt:updated");
                });
            }
            allowTransfer();
        });

        $('#rooms').change(function() {
            room = $(this).val();
            if ($(this).val() !== '') {
                var selected = $(this).val().split('-');
                var pavillionName = rooms[parseInt(selected[0])].pavillion_name;
                $('#pavillion').html(pavillionName);
            } else {
                $('#pavillion').html('-');
            }
            allowTransfer();
        });

        $("#service_note").bind('input propertychange',function(){
            allowTransfer();
        });

        function allowTransfer()
        {
            var status = true;
            var service_note = $("#service_note").val();
            if(service_note.length <= 0)
            {
                status = false;
            }

            roomClass = $("#class").val();
            room = $("#rooms").val();
            if ((roomClass !== undefined && room !== undefined) && (roomClass !== '' && room !== '')) {
                
            }else{
                status = false;
            }

            if(status != true)
            {
                $(".confirmdaftarranap").attr('disabled','disabled');
            }else
            {
                $(".confirmdaftarranap").removeAttr('disabled');
            }
        }
    });
</script>

<style type="text/css">
    .modal-body{
        overflow-y: visible;
    }
    .xdsoft_datetimepicker,.xdsoft_noselect{
        z-index: 100000;
    } 
</style>
