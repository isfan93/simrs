<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css" media="screen">
    .alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }

    #form{
        margin-bottom: 17px !important;
    }

    td.del{opacity: 0}
    tr:hover td.del{opacity: 100}

    li{display:inline}
    .list{margin-bottom: 10px !important;
            margin-left: 10px !important;
            min-width: 78px !important;
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

<div id="field1">
<div class="pageheader notab">
    <h1 class="pagetitle"><?=(isset($title)) ? $title : '';?></h1>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box" style="margin-top:0px">
                <div class="widget-title">
                </div>
                <?=form_open(cur_url(-2).'update',array('class' => 'form-horizontal','id' => 'form')); ?>				
                <div class="widget-content tab-content" style="overflow:hidden">
                   
						<div class="span6"> 
                            <label class="control-label">NIP</label>
                            <div class="controls">
                                <input type="hidden" value="<?php echo $employer[0]->id_employe ?>"  id="sd_id" name="ds[id_employe]" autofocus>
								<input type="text" value="<?php echo $employer[0]->sd_nip ?>"  placeholder="NIP" id="sd_nip" name="ds[sd_nip]" autofocus>
                                <!--input class="small" type="text" value="<?//=$rekmed?>"-->
                            </div>
                            <input class="small" type="text" style="display:none" id="rm"  value="<?//=$rekmed?>">
                            <label class="control-label">Kategori</label>
                            <div class="controls">
                                <select style="width:140px"  name="ds[sd_employe_tp]" class="chosen-select">
                                    <option value="">--- Pilih ---</option>
                                    <option <?php if(1==$employer[0]->sd_employe_tp) echo 'selected="selected"';?>   value="1">Dokter</option>                                    
                                    <option <?php if(2==$employer[0]->sd_employe_tp) echo 'selected="selected"';?>  value="2">Pegawai</option>
                                </select>
                            </div>
                            <label class="control-label">Jabatan</label>
							<div class="controls">
                                <select style="width:350px"  name="ds[sd_type_user]" class="chosen-select">
									<option value="">--- Pilih ---</option>
                                    <?foreach ($user_type->result() as $key): ?>
                                        <option  <?php if($key->id_type_user===$employer[0]->sd_type_user) echo 'selected="selected"';?>   value="<?=$key->id_type_user?>"><?=$key->description?></option>
                                    <?endforeach ?>
                                </select>
                            </div>
							<label class="control-label">Nama</label>
                            <div class="controls">
                                <input type="text"  placeholder="Nama" value="<?php echo $employer[0]->sd_name ?>" id="sd_name" name="ds[sd_name]" style="width:330px">
                            </div>
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <table>
                                    <tr>
                                        <td style="width:100px"><label><input <?php if("L"===$employer[0]->sd_sex) echo 'checked';?>   type="radio" name="ds[sd_sex]" value="L" checked="checked" /> Laki-laki</label></td>
                                        <td style="width:100px"><label><input <?php if("P"===$employer[0]->sd_sex) echo 'checked';?>   type="radio" name="ds[sd_sex]" value="P" /> Perempuan</label></td>
                                    </tr>
                                </table>
                            </div>
                            <label class="control-label">Tempat Lahir</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_place_of_birth]" value="<?php echo $employer[0]->sd_place_of_birth ?>"  placeholder="Tempat Lahir">
                            </div>
                            <label class="control-label">Tgl Lahir</label>
                            <?php 
                                $dob = explode('-',$employer[0]->sd_date_of_birth);
                                $rtrw = explode('/',$employer[0]->sd_rt_rw)
                            ?>
                            <div class="controls">
                                <select  name="tgl[0]" style="min-width:30px;width:90px" style="float:left" id="tgl" class="chosen-select">
                                    <option value="" >-- tgl --</option>
                                    <?=get_hari($dob[2])?>
                                </select>
                                <select name="tgl[1]" style="width:90px" id="bln" class="chosen-select">
                                    <option value="">-- bulan --</option>
                                    <?=get_bulan($dob[1])?>
                                </select>
                                <select name="tgl[2]" style="width:90px" id="thn" class="chosen-select">
                                    <option value="">-- tahun --</option>
                                    <?=get_tahun($dob[0])?>
                                </select>
                                <label for="tgl" generated="true" class="error"></label>
                            </div>
                            <!--label class="control-label">Umur</label>
                            <div class="controls">
                                <input type="text" style="width:40px" id="umur" name="ds[sd_age]" placeholder="0"> Tahun
                            </div-->
                            <label class="control-label">Gol.Darah</label>
                            <div class="controls">
                                <table>
                                    <tr>
                                        <td style="width:100px"><label><input <?php if("-"===$employer[0]->sd_blood_tp) echo 'checked';?>   type="radio" name="ds[sd_blood_tp]" value="-" checked="checked" /> -</label></td>
                                        <td style="width:100px"><label><input <?php if("A"===$employer[0]->sd_blood_tp) echo 'checked';?>   type="radio" name="ds[sd_blood_tp]" value="A" /> A</label></td>
                                        <td style="width:100px"><label><input <?php if("B"===$employer[0]->sd_blood_tp) echo 'checked';?>   type="radio" name="ds[sd_blood_tp]" value="B" /> B</label></td>
                                    </tr>
                                    <tr>
                                        <td style="width:100px"><label><input <?php if("AB"===$employer[0]->sd_blood_tp) echo 'checked';?>   type="radio" name="ds[sd_blood_tp]" value="AB" /> AB</label></td>
                                        <td style="width:100px"><label><input <?php if("O"===$employer[0]->sd_blood_tp) echo 'checked';?>   type="radio" name="ds[sd_blood_tp]" value="O" /> O</label></td>
                                    </tr>
                                </table>
                            </div>
                            <label class="control-label">Dusun/Kampung/Jln</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_reg_street]" id="street" value="<?php echo $employer[0]->sd_address ?>" placeholder="Dusun/Kampung/Jln">
                            </div>
                            <label class="control-label">&nbsp;</label>
                            <div class="controls">
                                <table style="width:156px">
                                    <tr>
                                        <td style="width:4%">
                                            <label>RT</label>
                                        </td>
                                        <td style="width:10px">
                                            <label for="rt"><input type="text" id="rt" value="<?php echo $rtrw[0] ?>" name="rt[0]" placeholder="RT" value="" style="width:40px"></label>
                                        </td>
                                        <td style="width:4%">
                                            <label>RW</label>
                                        </td>
                                        <td style="width:10px">
                                            <label for="rw"><input type="text" id="rw" value="<?php echo $rtrw[1] ?>" name="rt[1]" placeholder="RW" value="" style="width:40px"></label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <label class="control-label">Kelurahan/Desa</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_reg_desa]" id="desa" value="<?php echo $employer[0]->sd_reg_desa ?>" placeholder="Kelurahan/Desa">
                            </div>
                            <label class="control-label">Kecamatan</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_reg_kec]" id="kec" value="<?php echo $employer[0]->sd_reg_kec ?>" placeholder="Kecamatan">
                            </div>
                            <label class="control-label">Kabupaten/Kotamadya</label>
                            <div class="controls">
                                <select style=""  name="ds[sd_reg_kab]" class="chosen-select" id="sd_reg_kab">
                                    <?foreach ($regency->result() as $key): ?>
                                        <option  <?php if($key->mre_id===$employer[0]->sd_reg_kab) echo 'selected="selected"';?>  value="<?=$key->mre_id?>"><?=$key->mre_name?></option>
                                    <?endforeach ?>
                                </select>
                            </div>
                            <label class="control-label">Provinsi</label>
                            <div class="controls">
                                <!--input type="text" id="sd_reg_prov" value='<?//= $province_name ?>' placeholder="Provinsi" readonly-->
                                <select style="" name="ds[sd_reg_prov]" class="chosen-select">
                                    <?foreach ($province->result() as $key): ?>
                                        <option  <?php if($key->mpr_id===$employer[0]->sd_reg_prov) echo 'selected="selected"';?>  value="<?=$key->mpr_id?>"><?=$key->mpr_name?></option>
                                    <?endforeach ?>
                                </select>
                                <!--input type="hidden" id="kode_prov" name="ds[sd_reg_prov]" value="<?= $employer[0]->sd_reg_prov ?>"-->
                            </div>
                        </div>
                        <div class="span6">
                            <label class="control-label">Warga Negara</label>
                            <div class="controls">
                                 <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?foreach ($nationality->result() as $key): ?>
                                        <li class="list"><input  <?php if($key->mna_name===$employer[0]->sd_citizen) echo 'checked';?>   type="radio" name="ds[sd_citizen]" value="<?=$key->mna_name?>" />  <?=$key->mna_name?></li>
                                    <?endforeach?>
                                </ul>
                            </div>
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <li class="list"><label><input type="radio"  <?php if("belum kawin"===$employer[0]->sd_marital_st) echo 'checked';?>  name="ds[sd_marital_st]" value="belum kawin" />  Belum Kawin</label></li>
                                    <li class="list"><label><input type="radio" <?php if("kawin"===$employer[0]->sd_marital_st) echo 'checked';?>  name="ds[sd_marital_st]" value="kawin" />  Kawin</label></li>
                                    <li class="list"><label><input type="radio"  <?php if("duda/janda"===$employer[0]->sd_marital_st) echo 'checked';?> name="ds[sd_marital_st]" value="duda/janda" />  Duda/Janda</label></li>
                                    <li class="list"><label><input type="radio" <?php if("tidak kawin"===$employer[0]->sd_marital_st) echo 'checked';?>  name="ds[sd_marital_st]" value="tidak kawin" />  Tidak Kawin</label></li>
                                </ul>
                            </div>
                            <label class="control-label">Agama</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?foreach ($religi->result() as $key): ?>
                                        <li class="list"><label><input <?php if($key->mr_name===$employer[0]->sd_religion) echo 'checked';?>  type="radio" name="ds[sd_religion]" value="<?=$key->mr_name?>" />  <?=$key->mr_name?></label></li>
                                    <?endforeach?>
                                </ul>
                            </div>
                            <!--label class="control-label">Pendidikan</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?foreach ($education->result() as $key): ?>
                                        <li class="list"><input type="radio" name="ds[sd_education]" value="<?=$key->med_name?>" />  <?=$key->med_name?></li>
                                    <?endforeach?>
                                </ul>
                            </div>
                            <label class="control-label">Pekerjaan</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?foreach ($occupation->result() as $key): ?>
                                        <li class="list"><input type="radio" name="ds[sd_occupation]" value="<?=$key->mo_name?>" />  <?=$key->mo_name?></li>
                                    <?endforeach?>
                                </ul>
                            </div-->
                            <label class="control-label">Alamat</label>
                            <div class="controls">
                                <textarea name="ds[sd_address]" value="<?php echo $employer[0]->sd_address ?>" id="address" rows="3"></textarea>
                            </div>
                            <label class="control-label">No.Telp</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_telp]" value="<?php echo $employer[0]->sd_telp ?>" placeholder="No.Telp">
                            </div>
                        </div>
                    </div>                   
					</div>
				</div>
                <div class="form-actions" style="margin-top: 12px;margin-bottom: -17px;">
                    <a class="btn btn-primary hide" style="margin-left:90%" id="save" >Simpan</a>
                    <button type="submit" style="margin-left:90%" class="btn btn-primary">Simpan</button>
                    <a href="#myModal" id="cetak" role="button" class="btn hide" data-toggle="modal">Launch demo modal</a>
                </div> 
                <?=form_close()?>                           
           
        </div>
    </div>
</div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.css" />
<script src="<?= base_url() ?>assets/js/jquery.chosen.js"></script>
<script type="text/javascript" charset="utf-8">
    var count = 0;
    function getAge(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
    var isvalid;
    $(function(){
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $('#sd_reg_kab').chosen().change(function() {
            if ("" !== $('#sd_reg_kab').val()) {
                var url = "<?= base_url() ?>pendaftaran/getProvinsi";
                $.post(url, {
                    "<?= $this->security->get_csrf_token_name() ?>": "<?= $this->security->get_csrf_hash() ?>",
                    'id_regency': $('#sd_reg_kab').val()
                }).done(function(result) {
                    result = JSON.parse(result);
                    $('#sd_reg_prov').val(result.mpr_name);
                    //$('input[name=ds\\[sd_reg_prov\\]]').val(result.mpr_id);
                    $('#kode_prov').val(result.mpr_id)
                });
            } else {
                $('#sd_reg_prov').val('Provinsi');
                $('input[name=ds\\[sd_reg_prov\\]]').val('');
            }
        });
        isvalid = $("#form").validate({
            rules: {
                'ds[sd_name]': "required",     
                'ds[sd_employe_tp]' : "required",
                'ds[sd_type_user]' : "required",
            },
            submitHandler: function(form) {
                var url  = "<?=base_url()?>master/data_pegawai/update";
                var data = jQuery(form).serialize();
                //$('form').submit();
                 $.post(url,data, function(data){
                    $(".alert").fadeIn().delay(500).fadeOut(function(){
						location.reload();
                        /*
						$("#field2").fadeOut(function(){
                            $("#field1").fadeIn("fast",function(){
                                $("#cetak").trigger('click');
                                $("#ifr").attr('src',data);
                                $("#save").trigger('click');
                            });
                        });
						*/
                    });
                }); 
                // return false;
            }
        });

        $("#save").click(function(){})


        $("#thn").change(function(){
            var tgl = $("#tgl").val();
            var bln = $("#bln").val();
            var thn = $("#thn").val();
            var birth = [thn,bln,tgl].join("/");
             $("#umur").val(getAge(birth));
        })

        $("#tambah").click(function(){
            if(isvalid.checkForm()){
                count += 1;
                var nama    = $("#namaKeluarga").val();
                var jk      = $("input[name=jk2]").val();
                var hub     = $("input[name=hub]").val();
                var alamat  = $("#alamat").val();
                var noTelp  = $("#noTelp").val();
                var noPhone = $("#noPhone").val();
                $("<tr><td>"+count+"</td><td>"+nama+"</td><td>"+hub+"</td><td>"+alamat+"</td><td>"+noTelp+"</td><td style='width:5px' class='del'><a href='' class='deletes'><b class='icon-remove'></b></a></td><input id='rows"+count+"' name='rows[]' value='"+nama+"|"+jk+"|"+hub+"|"+alamat+"|"+noTelp+"|"+noPhone+"' type='hidden'>").appendTo('#tbKel tbody');
                $("#namaKeluarga").val("");
                $("input[name=jk2]").val("");
                $("input[name=hub]").val("");
                $("#alamat").val("");
                $("#noTelp").val("");
                $("#noPhone").val("");
                return false;
            }
        })

        $(".deletes").die('click').live('click',function(){
            $(this).parent().parent().fadeOut(function(){
                $(this).remove();
            })
            return false;
        })

        $("#cetakIframe").click(function(){
            var rm   = $("#rm").val();
            ifr.print();
            window.location = "<?=base_url()?>pendaftaran/pendaftaran_baru/proses/"+rm;
        })

        $("#street, #desa, #rt, #rw, #kec").keyup(function(){
          var jln   = $("#street").val();
          var rt    = $("#rt").val();
          var rw    = $("#rw").val();
          var kec   = $("#kec").val();
          var desa  = $("#desa").val();
          $("#address").text(jln+" "+rt+"/"+rw+" "+desa+" "+kec);
        });

        $("input[name='ds[sd_type_user]']").val('2');
    })

    
</script>