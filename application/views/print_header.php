<head> 
	<?php $this->load->view("include/script");?>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/print.css"/>
	<style type="text/css">
		table td{  
			padding: 5px;
		}
		table th{
			padding: 5px;
		}
		.rincian{
			border-top: 1px solid black;
		}
		.text-kop-surat{
			text-align: right;
		}
	</style>
	<script type="text/javascript">
		$(function(){
			window.print();
		});
	</script>
</head>
<div class="container-fluid" style="border-bottom:double black;" >
	<div class="row-fluid" >
		<div class="span4">
			<img src="<?php echo base_url();?>assets/image-sistem/logo.png" style="width:150px;margin:5px;">
		</div>
		<div class="span8">
			<div class="text-kop-surat" style="padding:10px;">
				<p>
					Jalan Mayor Suherman 72 Tarogong Garut Jawa Barat 44151
					<br>
					Telp. (0262) 2247760, 243499 
					Fax (0262) 2247760
				</p>
			</div>
		</div>
	</div>
</div>