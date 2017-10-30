<div class="pageheader notab">
	    <h1 class="pagetitle"><?=$title?></h1>
	</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12 center" style="text-align: center;">
			<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all;" style="background-color:white;padding-left:0px;margin-left:0px;" >
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding-left:0px;margin-left:0px;">
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("master/tab_obat/")?>' id="tab_rekmed">Master Obat</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("master/tab_user/")?>' id="tab_kajian">Master User</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("master/tab_tindakan/")?>' id="tab_objective">Master Tindakan</a></li>
					<li class="ui-state-default ui-corner-top"><a href="#" surl='<?=base_url("master/tab_service/")?>' id="tab_objective">Master Service</a></li>
                </ul>
                <div id="page" style="padding-bottom:25px;">
                </div>
            </div>
			<!--ul class="quickstats">				
				<li>
					<a href="master/data_obat">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Obat</span>
					</a>
				</li>
				<li>
					<a href="master/data_satuan_obat">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Satuan <br>Obat</span>
					</a>
				</li>
				<li>
					<a href="master/data_diagnosa">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/ecg.png">
						<span> Data Diagnosa</span>
					</a>
				</li>
				<li>
					<a href="master/data_tindakan">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/sthetoscope.png">
						<span> Data Tindakan</span>
					</a>
				</li>
				<li>
					<a href="master/data_pegawai">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/manager.png" width="64" height="64">
						<span> Data Pegawai</span>
					</a>
				</li>
				<li>
					<a href="master/jadwal_dokter">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/clipboard.png">
						<span> Jadwal Dokter</span>
					</a>
				</li>
				<li>
					<a href="master/data_poli">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Poli</span>
					</a>
				</li>
				<li>
					<a href="master/data_tindakan_lab">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Tindakan <br>Lab</span>
					</a>
				</li>
				<li>
					<a href="master/data_askes">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data ASKES</span>
					</a>
				</li>
				<li>
					<a href="master/data_user">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/user-group.png" width="64" height="64">
						<span> Data User</span>
					</a>
				</li>
				<li>
					<a href="master/data_jasa_dokter">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Biaya <br>Jasa Dokter</span>
					</a>
				</li>
				<li>
					<a href="master/data_type_user">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Type User</span>
					</a>
				</li>
				<li>
					<a href="master/data_user_group">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data User <br> Group</span>
					</a>
				</li>
				<li>
					<a href="master/data_room">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Room</span>
					</a>
				</li>
				<li>
					<a href="master/data_class">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Kelas <br>Ruangan</span>
					</a>
				</li>
				<li>
					<a href="master/data_pavillion">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Pavillion</span>
					</a>
				</li>
				<li>
					<a href="master/data_bed">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Bed</span>
					</a>
				</li>
				<li>
					<a href="master/data_supplier">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Supplier</span>
					</a>
				</li>
				<li>
					<a href="master/data_service">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data <br> Pelayanan</span>
					</a>
				</li>
				<li>
					<a href="master/data_adm_fee">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Tarif <br> Administrasi</span>
					</a>
				</li>
				<li>
					<a href="master/data_lab_treathment_detail">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Detail <br> Tindakan Laboratorium</span>
					</a>
				</li>
				<li>
					<a href="master/data_koefisien_fee">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Koefisien <br> Tarif Tindakan</span>
					</a>
				</li>
				<li>
					<a href="master/data_mcu_detail">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Detail <br> MCU</span>
					</a>
				</li>
				<li>
					<a href="master/data_treat_pack">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Paket <br> Tindakan</span>
					</a>
				</li>
				<li>
					<a href="master/data_lab_treathment_gol">
						<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/medkit.png">
						<span> Data Golongan <br> LAB</span>
					</a>
				</li>
			</ul-->
 		</div> 
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(function(){
		//$(".tab-master").hide();
        $("#tabs ul li a").click(function(){
			var surl =  $(this).attr("surl");
			$("#page").load(surl);
            $("#tabs ul li").each(function(){
                $(this).removeClass('ui-state-active ui-tabs-selected');
            })
            $(this).parent().addClass("ui-state-active ui-tabs-selected");
			//$(".tab-master").parent().show();
            return false;
        })
        $("#tabs ul li:eq(0) a").trigger('click');
    });
</script>