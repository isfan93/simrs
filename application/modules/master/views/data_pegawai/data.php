<script type="text/javascript">
	$(function(){
		$('.tabel-dokter').dataTable( {
              
                "sPaginationType": "bootstrap",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
				      { "bSortable": true, "aTargets": [ 0 ],"sWidth":"5%"  },
				      { "bSortable": true, "aTargets": [ 1 ],"sWidth":"5%"  },
				      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"20%"  },
				      { "bSortable": true, "aTargets": [ 3 ],"sWidth":"20%"  },
				      { "bSortable": true, "aTargets": [ 4 ],"sWidth":"5%"  },
				      { "bSortable": true, "aTargets": [ 5 ],"sWidth":"3%"  },
				      { "bSortable": true, "aTargets": [ 6 ],"sWidth":"30%"  },
				      { "bSortable": true, "aTargets": [ 7 ],"sWidth":"10%"  }
					  //{ "bSortable": true, "aTargets": [ 8 ],"sWidth":"7%"  },
				   ],
                "oLanguage": {
                  "sEmptyTable": "Data pegawai atau dokter tidak ditemukan"
                }
            });
		  $(".dataTables_filter").hide();
		$('.dataTables_length').hide();

	})

</script>
<div class="span12" style="padding:5px 10px">
			
<table cellpadding="0" cellspacing="0" border="0" class="tabel-dokter table table-bordered def_table_y dataTable tb_scrol">

    <thead>
        <tr  role="row">
			<th class="head1"><i class="icon-trash"></i></th>
            <th class="head1" style="width:10% important !;">No.</th>
			<!--th class="head1">NIP</th-->
            <th class="head1">Nama Pegawai</th>
            <th class="head1">Jabatan</th>	                   
            <th class="head1" style="width:5% important !;">Sex</th>	                   
            <th class="head1">Gol. Darah</th>	                   
            <th class="head1">Alamat</th>	                   
            <th class="head1" style="width:10% important !;">Action</th>	                   
        </tr>
    </thead>

    <tbody>
		<?php
			$i = 0;
			foreach ($list as $key => $value) {
				$i++;
				?>
				<tr>
					<td><center><input type="checkbox" name="chk[]" id="cek_del_detail_faktur" value="<?=$value->id_employe?>" class="chk">
		
					<td class="center">
						<b><?=$i?></b>
					</td>
					<!--td style="">
						<b><?=$value->sd_nip?></b>									
					</td-->
					<td style="">
						<i><?=$value->sd_name?></i>
					</td>
					<td style="">
						<i><?=$value->description//$value->sd_type_user?></i>
					</td>
					<td style="">
						<i><?=$value->sd_sex?></i>
					</td>
					<td style="">
						<i><?=$value->sd_blood_tp?></i>
					</td>
					<td style="">
						<i><?=$value->sd_address?>, <?=$value->sd_rt_rw?>, <?=$value->sd_reg_desa?>, <?=$value->sd_reg_kec?></i>
					</td>
					 
					<td style="">
						<i><a class="buttons btn_pencil" href="<?=base_url()?>master/data_pegawai/edit/<?=$value->id_employe?>"></a></i>
						<a class="buttons btn_trash" style="margin-left:10px;" href="<?=base_url()?>master/data_pegawai/delete_list/<?=$value->id_employe?>"></a>
					</td>								
				</tr>
				<?php
			}
		?>
        
    </tbody>
    <tfoot>
    </tfoot>
</table>
</div>