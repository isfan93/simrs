<!DOCTYPE html>
<html lang="en">    
    <head>
        <?=$this->load->view("include/script")?>
		<script type="text/javascript">
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'body-chart',
						defaultSeriesType: 'area'
					},
					title: {
						text: 'KUNJUNGAN PASIEN LAYANAN RUMAH SAKIT'
					},
					subtitle: {
						text: 'Juli 2014'
					},
					xAxis: {
						labels: {
							formatter: function() {
								return this.value; // clean, unformatted number for year
							}
						}
					},
					yAxis: {
						title: {
							text: 'Kunjungan pasien'
						},
						labels: {
							formatter: function() {
								return this.value / 1000 +'k';
							}
						}
					},
					tooltip: {
						formatter: function() {
							return this.series.name +' produced <b>'+
								Highcharts.numberFormat(this.y, 0) +'</b><br/>warheads in '+ this.x;
						}
					},
					plotOptions: {
						area: {
							pointStart: 1,
							marker: {
								enabled: false,
								symbol: 'circle',
								radius: 2,
								states: {
									hover: {
										enabled: true
									}
								}
							}
						}
					},
					series: [
					{
						name: 'IGD',
						data: [15915, 17385, 19055, 21205, 23044, 25393, 27935, 30062, 32049,
						33952, 35804, 37431, 39197, 45000, 43000, 41000, 39000, 37000,
						35000, 33000, 31000, 29000, 27000, 25000, 24000, 23000, 22000,
						21000, 20000, 19000, 18000, 18000]
					},{
						name: 'RAWAT JALAN',
						data: [
						1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468, 20434, 24126,
						27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342, 26662,
						26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
						24605,23464, 23708,23464]
					},{
						name: 'RAWAT INAP',
						data: [5, 25, 50, 120, 150, 200, 426, 660, 869, 1060, 1605, 2471, 3322,
						4238, 5221, 6129, 7089, 8339, 9399, 10538, 11643, 13092, 14478,
						15915, 17385, 19055, 21205, 23044, 25393, 27935, 30062, 32049]
					}]
				});
			});
		</script>
    </head>
    <body>
		<div class="topheader" Style="margin-bottom:-26px">
                <div class="left">
                    <?=$this->load->view("include/left_header")?>
                <br clear="all" />
                </div> 
                <div class="right">
                    <?=$this->load->view("include/right_header")?>
                </div>
            </div>
            <?=$this->load->view("include/header")?>

        <div id="content" style="margin-left:0px">
			<div class="pageheader notab">
				<h1 class="pagetitle">Selamat Datang <?php echo get_user('user_name');?>,</h1>
			</div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span5 center" style="text-align: center;">                                          
                        <ul class="quickstats">
							<li>
								<a href="<?=base_url()?>pelayanan_informasi"><img alt="" src="<?=base_url()?>assets/img/icons/32/info.ico"><span>pelayanan<br>informasi</span></a>
							</li>
							<li>
								<a href="<?=base_url()?>pendaftaran"><img alt="" src="<?=base_url()?>assets/img/icons/32/PatientData.png"><span>pendaftaran</span></a>
							</li>
							<li>
								<a href="<?=base_url()?>rawat_jalan"><img alt="" src="<?=base_url()?>assets/img/icons/32/rajal.png"><span>rawat jalan</span></a>
							</li>
							<li>
								<a href="<?=base_url()?>kasir"><img alt="" src="<?=base_url()?>assets/img/icons/32/kasir.png"><span>kasir</span></a>
							</li>
							<li>
								<a href="<?=base_url()?>apotek"><img alt="" src="<?=base_url()?>assets/img/icons/32/apotek.png"><span>apotek</span></a>
							</li>
							<li>
								<a href="<?=base_url()?>gudang"><img alt="" src="<?=base_url()?>assets/img/icons/32/gudang_farmasi.png"><span>gudang<br>farmasi</span></a>
							</li>
                        </ul>
                    </div>  
					<div class="span7">
						<div class="title" style="padding:0px"><h3>Grafik kunjungan pasien</h3></div>
						<div style="padding:10px">
							<div id="body-chart"></div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </body>
</html>
