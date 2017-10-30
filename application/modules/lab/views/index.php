<script type="text/javascript">
	var chart;
	$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			defaultSeriesType: 'column'
		},
		title: {
			text: '5 Tindakan Populer'
		},
		subtitle: {
			text: 'bulan oktober 2012'
		},
		xAxis: {
			categories: [
				'Tindakan'
			]
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Rainfall (mm)'
			}
		},
		legend: {
			layout: 'vertical',
			backgroundColor: '#FFFFFF',
			align: 'left',
			verticalAlign: 'top',
			x: 100,
			y: 70,
			floating: true,
			shadow: true
		},
		tooltip: {
			formatter: function() {
				return ''+
					this.x +': '+ this.y +'';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
			series: [{
			name: 'Amoxilin 90gr',
			data: [15.9]

		}, {
			name: 'Fenoprofen 800mg',
			data: [20.6]

		}, {
			name: 'BONESCO',
			data: [48.9]

		}, {
			name: 'CALSAN CHEW 500 MG',
			data: [42.4]

		},{
			name: 'DISFLATYL',
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
						<a href="<?=base_url()?>lab/antrian">
							<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/clipboard.png">
							<span> Antrian <br>Lab</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>lab/pemeriksaan">
							<img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/clipboard.png">
							<span> Data <br>Pemeriksaan</span>
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