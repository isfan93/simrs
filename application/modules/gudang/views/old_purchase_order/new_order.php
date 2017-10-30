<script>
	var medicine = {};
	medicine.results = [
		{id:'1',name:'A-B VASK TABLET 10 MG'},
		{id:'2',name:'3TC-HBV TABLET'},
		{id:'3',name:'A-B VASK TABLET 5 MG'},
		{id:'4',name:'ABBOTIC XL'},
		{id:'5',name:'ACCOLATE TABLET'},
		{id:'6',name:'ACCUPRIL TABLET 10 MG'},
		{id:'7',name:'ACCUPRIL TABLET 20 MG'},
		{id:'8',name:'ACCUPRIL TABLET 5 MG'},
		{id:'9',name:'ACEPRESS TABLET 12,5 MG'},
		{id:'10',name:'ACEPRESS TABLET 25 MG'},
		{id:'11',name:'ACETENSA TABLET'},
		{id:'12',name:'ACIFAR CAPLET 200 MG'},
		{id:'13',name:'ACIFAR CAPLET 400 MG'},
		{id:'14',name:'ACIFAR CREAM'},
		{id:'15',name:'ACITRAL TABLET'},
	];
	medicine.total = medicine.results.length;
	var supplier = {};
		supplier.results = [
			{id:'1',name:'PT Jaya Banda'},
			{id:'2',name:'Stationary Budaya'},
			{id:'3',name:'Dental 2012'},
			{id:'4',name:'Dental Jaya'},
			{id:'5',name:'PT Tulang Bersinar'},
			{id:'6',name:'PT Tulang Kering'},
		];
		supplier.total = supplier.results.length;
	var petugas = {};
		petugas.results = [
			{id:'1',name:'Aya Suahaya'},
			{id:'2',name:'Budi Darmawan'},
			{id:'3',name:'Lilik Sukaesih'},
			{id:'4',name:'Darmadi Muhammad Samudra'},
			{id:'5',name:'Joko Widodo'},
			{id:'6',name:'Alek'},
		];
		petugas.total = petugas.results.length;
	$(function(){
		max = 7;
		$('.medicine').flexbox(medicine);
		$('.supplier').flexbox(supplier);
		$('.petugas').flexbox(petugas);
		$('.dyntable').dataTable( {
			"sPaginationType": "bootstrap",
			"sScrollY": "330px",
			  "bFilter": false,
			"bPaginate": false,
	    });

		$('.medicine:eq('+max+')').change(function(){
			//tr = $(this).parent().parent().html();
			tr = $('#table1 tbody tr').eq(-1).html();
			$('#table1 tbody').append("<tr>"+tr+"</tr>");
			$('#table1 tbody tr:eq('+(max+1)+') td:eq(0)').html(max+2);
			$('#table1 tbody tr:eq('+(max+1)+') td:eq(1)').html('<div class="medicine"></div>');
			max++;
			//$('.medicine:eq('+max+')').flexbox(medicine);
		})
	})
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
    <div class='row-fluid' style="padding:10px">
    	<div class="widget-content nopadding">
    		<div class="span5" style="margin-left:1%">
				<table>
					<tr>
						<td><label>Nomor Order</label></td><td><input type="text" name="order_number"></td>
					</tr>
					<tr>
						<td><label>Invoice</label></td><td><input type="text" name="invoice"></td>
					</tr>
					<tr>
						<td><label>Supplier</label></td><td><div id="supplier" class="supplier"></td>
					</tr>
					<tr>
						<td><label>Tanggal Order</label></td><td><input type="text" name="order_date" placeholder="dd/mm/yyyy"></td>
					</tr>
					<tr>
						<td><label>Mata Uang</label></td><td><select name="order_curr"><option value="IDR">RP</option></select></td>
					</tr>
					<tr>
						<td><label>Vat Status</label></td><td><select name="order_vat"><option>No Vat</option></select></td>
					</tr>
					<tr>
						<td><label>Ppn</label></td><td><select name="order_vat"><option>No Vat</option></select></td>
					</tr>
					<tr>
						<td><label>Alamat Pengiriman</label></td><td><textarea name="deliver_address"></textarea></td>
					</tr>
					<tr>
						<td><label>Tanggal Pengiriman</label></td><td><select name="deliver_date"><option>No Vat</option></select></td>
					</tr>
					<tr>
						<td><label>Petugas</label></td><td><div class="petugas" id="petugas"></div></td>
					</tr>
				</table>
			</div>
	    	<div class="span6" style="margin-left:0px">
				<style>
					td.curr{
						text-align:right;
					}
					td.curr input{
						width: 50px;
						margin:0px;
					}
					.dyntable input{
						margin:0px;
						;
					}
				</style>
				<table class="table table-bordered table-striped dyntable" id="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Kemasan</th>
							<th>Jumlah</th>
							<th>Harga</th>
						</tr>
					</thead>
					<tbody>
						<?for($i=1;$i<=8;$i++):?>
							<tr>
								<td><?=$i?></td>
								<td><div class="medicine" id="medicine[]"></div><!-- the flexbox!--></td>
								<td><!-- from flexbox--></td>
								<td class="curr"><input type="text" name="obat[1]" value="<?=number_format(0,2)?>"></td>
								<td class="curr"></td>
							</tr>
						<?endfor;?>
					</tbody>
				</table>
				<div class='row-fluid'>
					<div class='form-actions span12' style="text-align:right;margin-top:20px">
						<button class="btn btn-warning">Batal</button>
						<button class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</div><!--#span7-->
		</div>
    </div><!--#row-fluid-->
</div><!--#container-fluid-->