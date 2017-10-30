<script type="text/javascript">
	var chart;
	$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			defaultSeriesType: 'column'
		},
		title: {
			text: '5 Penyakit Terbanyak'
		},
		subtitle: {
			text: 'Januari 2015'
		},
		xAxis: {
			categories: [
				'penyakit'
			]
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Persen Penyakit'
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
			name: 'Influenza',
			data: [49.9]

		}, {
			name: 'Kolera',
			data: [83.6]

		}, {
			name: 'Malaria',
			data: [48.9]

		}, {
			name: 'Demam Berdarah',
			data: [42.4]

		},{
			name: 'Gigi berlubang',
			data: [30]

		}]
	});
	});
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>
	<div class="row-fluid">
        <div class="span5 center" style="text-align: center;">                 
			<ul class="quickstats">
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_umum"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/sthetoscope.png"><span>poli umum</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_anak"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/user-group.png"><span>poli <br> anak</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_gigi"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/tooth.png"><span>poli Gigi</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_bidan"><img alt="" src="<?=base_url()?>assets/img/icons/32/PatientFemale.png" style="max-width:65px;min-width:65px;"><span>poli kebidanan <br> dan kandungan</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_saraf"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/virus.png"><span>poli syaraf<br> </span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_bedah"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/surgeon.png"><span>poli bedah <br></span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_mata"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/cross 1.png"><span>poli mata</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_kulit"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/manager.png" style="max-width:65px;min-width:65px;"><span>poli kulit<br>dan Kelamin</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_dalam"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/x-ray.png" style="max-width:65px;min-width:65px;"><span>poli Dalam</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>rawat_jalan/poli_tulang"><img alt="" src="<?=base_url()?>assets/img/icons/medicoicons/x-ray.png" style="max-width:65px;min-width:65px;"><span>poli tulang</span></a>
				</li>
			</ul>
        </div>
  		<div class="span7" style="padding:20px 10px">
  			<div id="container"></div>
  		</div>
    </div>
</div>