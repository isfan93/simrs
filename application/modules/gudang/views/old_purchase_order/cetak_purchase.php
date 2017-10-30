<div class="container-fluid" style="margin-top:20px;">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<?php $this->load->view('print_header');?>
				<br clear="all">
				<div class="body-surat">
					<div class="span12">
						<div class="text-body-surat">
							<table style="font-size:12px;width:45%;float:left;">
								<tr>
							    	<td style="width:100px;">No. PO</td>
							    	<td>: <?php echo $purchase->ipo_id;?></td>
							    </tr>
							    <tr>
							    	<td>Tanggal PO</td>
							    	<td>: <?php echo pretty_date($purchase->ipo_date_req,false);?></td>
							    </tr>
							</table>
							<table style="font-size:12px;width:45%;float:right;">
							    <tr>
							    	<td>Supplier</td>
							    	<td>: <?php echo $purchase->msup_name;?></td>
							    </tr>
							    <tr>
							    	<td>Petugas</td>
							    	<td>: <?php echo $purchase->sd_name;?></td>
							    </tr>
							    <tr>
							    	<td>Catatan</td>
							    	<td>: <?php echo $purchase->ipo_note;?></td>
							    </tr>
							</table>
							<br clear="all">
							<h6>Rincian Purchase Order :</h6>
							<table style="font-size:12px;margin-top:10px;width:98%;" class="rincian">
								<thead>
									<tr>
										<th style="text-align:left;">No.</th>
										<th style="text-align:left;">Kode Item</th>
								   		<th style="text-align:left;">Nama Item</th>
								   		<th style="text-align:center;">Jumlah</th>
								   		<th style="text-align:right;">Total</th>
									</tr>
								</thead>
								<tbody>
							    	<?php
							    	$total 	= 0;
							    	if( !empty($detail) ){
								    	foreach ($detail->result() as $key => $value):
								    		?>
								    		<tr>
								    			<td style="text-align:center;"><?php echo ($key + 1);?></td>
								    			<td><?php echo $value->im_id;?></td>
								    			<td><?php echo $value->im_name;?></td>
								    			<td style="text-align:center;"><?php echo $value->ipod_qty;?> <?php echo $value->mtype_name;?></td>
								    			<td style="text-align:right;"><?php echo number_format(($value->ipod_qty * $value->ipod_harga_beli), 0, ",", ".");?></td>
								    		</tr>
								    		<?php
								    		$total += $value->ipod_qty * $value->ipod_harga_beli;
								    	endforeach;
								    }
							    	?>
							    	<tr>
							    		<td colspan="4" style="font-weight:bold;text-align:right;">Total Purchase Order</td>
							    		<td style="font-weight:bold;text-align:right;"><?php echo number_format(($total), 0, ",", ".");?></td>
							    	</tr>
							    </tbody>
							</table>
						</div>
					</div>
					<div class="span4 offset8" style="margin-top:20px;">
						<div class="text-body-surat">
							<p>
								<?php echo pretty_date(date('Y-m-d'),false);?><br>
								Rumah Sakit Intan Husada<br>
								Petugas,
							</p>
							<p style="margin-top:80px;margin-bottom:20px;font-weight:bold;">
								<?php
								echo get_user('sd_name');
								?>
							</p>
						</div>	
					</div>
				<br clear="all">
				</div>
				<br clear="all">
				<div class="footer-surat">
					
				</div>
			</div>
		</div>
	</div>
</div>