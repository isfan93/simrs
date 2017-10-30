<table width="100%;margin-top:20px">
	<tr>
		<td style="width:60%">&nbsp;</td>
		<td style="width:40%">&nbsp;</td>
	</tr>
	<tr>
		<td>No.RM : <b><?=$ds->sd_rekmed?></b></td>
		<td>Umur : <?=$ds->sd_age?> Thn</td>
	</tr>
	<tr>
		<td>Nama Pasien : <?=$ds->sd_name?></td>
		<td>Gol.Darah : <?=$ds->sd_blood_tp?></td>
	</tr>
	<tr>
		<td>Alamat Pasien : <?=$ds->sd_address?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>

<table class="table table-bordered def_table_y dataTable tb_scrol" align="center" style="margin-left:0px;width:100%; ">
	<thead>
		<tr role="row">
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:15%" aria-label="Nama: activate to sort column ascending">Tanggal</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:25%" aria-label="Harga: activate to sort column ascending">Nama Dokter</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:20%" aria-label="Aksi: activate to sort column ascending">Poli / Ruang</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="src_table" rowspan="1" colspan="1" style="width:20%" aria-label="Aksi: activate to sort column ascending">Keluhan</th>
		</tr>
	</thead>
	<tbody>
		<?for($i=1;$i<=10;$i++):?>
		<tr>
			<td class="center">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<?endfor;?>
	</tbody>
</table>