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
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Biodata</a></li>
                        <li><a data-toggle="tab" href="#tab2">Curiculum Vitae</a></li>
                    </ul>
                </div>
                <?=form_open(cur_url().'create',array('class' => 'form-horizontal','id' => 'form')); ?>
                <div class="widget-content tab-content" style="overflow:hidden">
                    <div id="tab1" class="tab-pane active">
                        <div class="span6"> 
                            <label class="control-label">NID</label>
                            <div class="controls">
                                <input class="small" type="text" readonly>
                            </div>
                            <input class="small" type="text" style="display:none" id="rm" >
                            <label class="control-label">Nama Dokter</label>
                            <div class="controls">
                                <input type="text"  placeholder="Nama Dokter" id="sd_name" name="ds[sd_name]" autofocus>
                            </div>
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <table>
                                    <tr>
                                        <td style="width:100px"><label><input type="radio" name="ds[sd_sex]" value="L" checked="checked" /> Laki-laki</label></td>
                                        <td style="width:100px"><label><input type="radio" name="ds[sd_sex]" value="P" /> Perempuan</label></td>
                                    </tr>
                                </table>
                            </div>
                            <label class="control-label">Tempat Lahir</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_place_of_birth]"  placeholder="Tempat Lahir">
                            </div>
                            <label class="control-label">Tgl Lahir</label>
                            <div class="controls">
                                <select  name="tgl[0]" style="min-width:30px;width:90px" style="float:left" id="tgl">
                                    <option value="" >-- tgl --</option>
                                    <?=get_hari()?>
                                </select>
                                <select name="tgl[1]" style="width:90px" id="bln">
                                    <option value="">-- bulan --</option>
                                    <?=get_bulan()?>
                                </select>
                                <select name="tgl[2]" style="width:90px" id="thn">
                                    <option value="">-- tahun --</option>
                                    <?=get_tahun()?>
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
                                        <td style="width:100px"><label><input type="radio" name="ds[sd_blood_tp]" value="-" checked="checked" /> -</label></td>
                                        <td style="width:100px"><label><input type="radio" name="ds[sd_blood_tp]" value="A" /> A</label></td>
                                        <td style="width:100px"><label><input type="radio" name="ds[sd_blood_tp]" value="B" /> B</label></td>
                                    </tr>
                                    <tr>
                                        <td style="width:100px"><label><input type="radio" name="ds[sd_blood_tp]" value="AB" /> AB</label></td>
                                        <td style="width:100px"><label><input type="radio" name="ds[sd_blood_tp]" value="O" /> O</label></td>
                                    </tr>
                                </table>
                            </div>
                            <label class="control-label">Dusun/Kampung/Jln</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_reg_street]" id="street" placeholder="Dusun/Kampung/Jln">
                            </div>
                            <label class="control-label">&nbsp;</label>
                            <div class="controls">
                                <table style="width:156px">
                                    <tr>
                                        <td style="width:4%">
                                            <label>RT</label>
                                        </td>
                                        <td style="width:10px">
                                            <label style="width:40px"><input type="text" id="rt" name="rt[0]" placeholder="RT"></label>
                                        </td>
                                        <td style="width:4%">
                                            <label>RW</label>
                                        </td>
                                        <td style="width:10px">
                                            <label style="width:40px"><input type="text" id="rw" name="rt[1]" placeholder="RT"></label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <label class="control-label">Kelurahan/Desa</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_reg_desa]" id="desa" placeholder="Kelurahan/Desa">
                            </div>
                            <label class="control-label">Kecamatan</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_reg_kec]" id="kec" placeholder="Kecamatan">
                            </div>
                            <label class="control-label">Kabupaten/Kotamadya</label>
                            <div class="controls">
                                <select style="width:140px"  name="ds[sd_reg_kab]">
                                    <?foreach ($regency->result() as $key): ?>
                                        <option value="<?=$key->mre_id?>"><?=$key->mre_name?></option>
                                    <?endforeach ?>
                                </select>
                            </div>
                            <label class="control-label">Provinsi</label>
                            <div class="controls">
                                <select style="width:140px" name="ds[sd_reg_prov]">
                                    <?foreach ($province->result() as $key): ?>
                                        <option value="<?=$key->mpr_id?>"><?=$key->mpr_name?></option>
                                    <?endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="span6">
                            <label class="control-label">Warga Negara</label>
                            <div class="controls">
                                 <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?foreach ($nationality->result() as $key): ?>
                                        <li class="list"><input type="radio" name="ds[sd_citizen]" value="<?=$key->mna_name?>" />  <?=$key->mna_name?></li>
                                    <?endforeach?>
                                </ul>
                            </div>
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <li class="list"><input type="radio" name="ds[sd_marital_st]" value="belum kawin" />  Belum Kawin</li>
                                    <li class="list"><input type="radio" name="ds[sd_marital_st]" value="kawin" />  Kawin</li>
                                    <li class="list"><input type="radio" name="ds[sd_marital_st]" value="duda/janda" />  Duda/Janda</li>
                                    <li class="list"><input type="radio" name="ds[sd_marital_st]" value="tidak kawin" />  Tidak Kawin</li>
                                </ul>
                            </div>
                            <label class="control-label">Agama</label>
                            <div class="controls">
                                <ul class="thumbnails" style="margin-bottom:0px" >
                                    <?foreach ($religi->result() as $key): ?>
                                        <li class="list"><input type="radio" name="ds[sd_religion]" value="<?=$key->mr_name?>" />  <?=$key->mr_name?></li>
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
                                <textarea name="ds[sd_address]" id="address" rows="3"></textarea>
                            </div>
                            <label class="control-label">No.Telp</label>
                            <div class="controls">
                                <input type="text" name="ds[sd_telp]" placeholder="No.Telp">
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane">
                            <div class="widget-content">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="widget-box">
                                            <div class="widget-title">
                                                <span class="icon">
                                                    <i class="icon-th-list"></i>
                                                </span>
                                                <h5>Tambah Keluarga</h5>
                                            </div>
                                            <div class="widget-content">
                                                <label class="control-label" style="width:100px">Nama Keluarga</label>
                                                <div class="controls" style="margin-left:110px">
                                                    <input type="text"  placeholder="Nama Keluarga" name="namaKeluarga" id="namaKeluarga">
                                                </div>
                                                <label class="control-label" style="width:100px">Jenis Kelamin</label>
                                                <div class="controls" style="margin-left:110px">
                                                    <table>
                                                        <tr>
                                                            <td style="width:89px"><label><input type="radio" name="jk2" value="laki-laki" /> Laki-laki</label></td>
                                                            <td style="width:89 px"><label><input type="radio" name="jk2" value="perempuan"/> Perempuan</label></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <label class="control-label" style="width:100px">Hubungan Keluarga</label>
                                                <div class="controls" style="margin-left:110px">
                                                    <table>
                                                        <tr>
                                                            <td style="width:100px"><label><input type="radio" name="hub" id="o" value="Orang Tua"/> OrangTua</label></td>
                                                            <td style="width:100px"><label><input type="radio" name="hub" id="s" value="Saudara"/> Saudara</label></td>
                                                            <td style="width:100px"><label><input type="radio" name="hub" id="t" value="Teman"/> Teman</label></td>
                                                            <td style="width:100px"><label><input type="radio" name="hub" id="p" value="Pengantar"/> Pengantar</label></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <br clear="all">
                                                <label class="control-label" style="width:100px">Alamat</label>
                                                <div class="controls" style="margin-left:110px">
                                                    <textarea rows="3" class="medium" cols="2" id="alamat"></textarea>
                                                </div>
                                                <label class="control-label" style="width:100px" >No.Telp</label>
                                                <div class="controls" style="margin-left:110px">
                                                    <input type="text" class="medium" placeholder="No.Telp" id="noTelp">
                                                </div>
                                                <label class="control-label" style="width:100px">No.Hp</label>
                                                <div class="controls" style="margin-left:110px">
                                                    <input type="text" class="medium" placeholder="No.Hp" id="noPhone">
                                                </div>
                                                <div class="form-actions" style="margin-top: 12px;margin-bottom: -17px;margin-left: -15px;margin-right: -15px;">
                                                    <button type="submit" style="margin-left:60%" class="btn btn-success" id="tambah">Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="widget-box">
                                            <div class="widget-title">
                                                <span class="icon">
                                                    <i class="icon-th-list"></i>
                                                </span>
                                                <h5>Data Keluarga</h5>
                                            </div>
                                            <div class="widget-content-no-padding">
                                                <table class="table table-striped" id="tbKel">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>Hub.Keluarga</th>
                                                            <th>Alamat</th>
                                                            <th colspan="2">No.Telp</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
</div>

 
<!-- Modal -->
<div id="myModal" style="height:500px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Cetak Kartu Pendaftaran</h3>
  </div>
  <div class="modal-body">
    <iframe src="" name="ifr" id="ifr" style="margin:0px;padding:0px;border:none;width:100%;height:104%"></iframe>
  </div>
  <div class="modal-footer">
    <a href="<?=base_url()?>pendaftaran/pendaftaran_baru/proses/<?=$rekmed?>" class="btn" >Keluar</a>
    <button id="cetakIframe" class="btn btn-primary">Cetak</button>
  </div>
</div>

<div class="hide" id="field2">
    <div class="pageheader notab">
        <h1 class="pagetitle">PILIH LAYANAN</h1>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12 center" style="text-align: center;">
                <ul class="quickstats">
                    <li>
                        <a href="<?=base_url()?>pendaftaran/pendaftaran_rawat_jalan">
                            <img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
                            <span> pendaftaran<br>rawat jalan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>pendaftaran/pendaftaran_rawat_inap">
                            <img alt="" src="<?=base_url()?>assets/img/icons/32/Hospital.png">
                            <span> pendaftaran <br>rawat inap</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>pendaftaran/IGD">
                            <img alt="" src="<?=base_url()?>assets/img/icons/32/IGD.png">
                            <span> IGD</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


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
        isvalid = $("#form").validate({
            rules: {
                'ds[sd_name]': "required",     
                'ds[sd_age]' : "required",
                'namaKeluarga' : "required",
            },
            submitHandler: function(form) {
                var url  = "<?=base_url()?>pendaftaran/pendaftaran_baru/create";
                var data = jQuery(form).serialize();
                $.post(url,data, function(data){
                    $(".alert").fadeIn().delay(500).fadeOut(function(){
                        $("#field2").fadeOut(function(){
                            $("#field1").fadeIn("fast",function(){
                                $("#cetak").trigger('click');
                                $("#ifr").attr('src',data);
                                $("#save").trigger('click');
                            });
                        });
                    });
                }); 
                return false;
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
    })

    
</script>