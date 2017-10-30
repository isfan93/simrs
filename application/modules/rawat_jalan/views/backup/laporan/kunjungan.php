<div class="row-fluid">
	<div class="span11" style="margin:20px">
		<style type="text/css">
			.table td,th{
				border:1px solid #DDDDDD;
			}
			.table th{
				border-top: 1px solid #DDDDDD;
			}
		</style>
		<table class='table'>
		<thead>
			<th>No</th>
			<th>No. Rekmed</th>
			<th>Nama</th>
			<th>Umur</th>
			<th>Alamat</th>
		</thead>
		<tbody>
			<?foreach($data->result() as $i => $dd):?>
				<tr>
					<td><?=$i+1?>.</td>
					<td><?=$dd->sd_rekmed?></td>
					<td><?=$dd->sd_name?></td>
					<td><?=$dd->sd_age?></td>
					<td><?=$dd->sd_address?></td>
				</tr>
			<?endforeach;?>
		</tbody>
	</table>
	</div>
</div>
