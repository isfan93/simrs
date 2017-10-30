<script type="text/javascript">
	var chart;
	$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			defaultSeriesType: 'column'
		},
		title: {
			text: 'Kunjungan Teropuler'
		},
		subtitle: {
			text: 'bulan November 2014'
		},
		xAxis: {
			categories: [
				'Kunjungan',
			]
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kunjungan'
			}
		},
		legend: {
			layout: 'vertical',
			backgroundColor: '#FFFFFF',
			align: 'left',
			verticalAlign: 'top',
			x: 50,
			y: 40,
			floating: true,
			shadow: true
		},
		tooltip: {
			formatter: function() {
				return ''+
					this.series.name +': '+ this.y +' kunjungan';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
			series: [{
			name: 'Rawat Jalan',
			data: [15.9]

				}, {
					name: 'Rawat Inap',
					data: [20.6]

				}, {
					name: 'IGD',
					data: [48.9]

				}, {
					name: 'Radiologi',
					data: [42.4]

				},{
					name: 'Laboratorium',
					data: [30]
				}]
		});
	});
	
</script>
<div class="pageheader notab">
	<h1 class="pagetitle"><?=$title?></h1>
</div>
<div class="container-fluid">
    <div class="row-fluid">
    	<div id="field1">
	        <div class="span5 center" style="text-align: center;">                 
				<ul class="quickstats">
					<li>
						<a href="<?=base_url()?>pelaporan/kunjungan">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> Kunjungan</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>pelaporan/keuangan/cashflow">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span>Cash Flow</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>pelaporan/keuangan">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> Keuangan</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>pelaporan/keuangan/jasadokter">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> Jasa Dokter</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>pelaporan/farmasi">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> Farmasi</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>pelaporan/keuangan/jatuhTempo">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> Jatuh Tempo</span>
						</a>
					</li>
				</ul>
	 		</div> 
	 		<div class="span7" style="padding:20px 10px">
	  			<div id="container"></div>
	  		</div>
  		</div>
  		
    </div>
</div>