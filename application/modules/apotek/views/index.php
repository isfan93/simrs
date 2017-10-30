<script type="text/javascript">
	var chart;
	$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			defaultSeriesType: 'column'
		},
		title: {
			text: '5 Obat Populer'
		},
		subtitle: {
			text: 'Juli 2014'
		},
		xAxis: {
			categories: [
				'Obat'
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

	$(function(){
		$("#history").click(function(){
	        $("#field1").fadeOut(function(){
	            $("#field2").fadeIn();
	        })
	        return false;
	    });

	    $(".detail").click(function(){
            var url  = $(this).attr('href');
            $("#cetak").trigger('click');
			$("#ifr").attr('src',url);
            return false;
        });

        $("#cetakIframe").click(function(){
            ifr.print();
            window.location = "<?=base_url()?>apotek/resep_pasien";
        });
	})
	
</script>
<div class="pageheader notab">
<!-- <a id="history" style="float:right;margin-right:10px;" class="btn btn-success"><i class="icon-plus-sign icon-white"></i>History</a> -->
    <h1 class="pagetitle"><?=$title?></h1>
</div>
<div class="container-fluid">
    <div class="row-fluid">
    	<div id="field1">
	        <div class="span5 center" style="text-align: center;">                 
				<ul class="quickstats">
					<li>
						<a href="<?=base_url()?>apotek/resep_pasien">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> resep<br> pasien</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>apotek/pembelian_umum">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> pembelian<br>langsung</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>apotek/resep_pasien/riwayat_resep">
							<img alt="" src="<?=base_url()?>assets/img/icons/32/Pills.png">
							<span> Data Pembelian<br>Resep</span>
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