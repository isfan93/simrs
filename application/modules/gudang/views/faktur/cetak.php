<div class="container-fluid" style="margin-top:20px;">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<?php $this->load->view('print_header');?>
				<br clear="all">
				<div class="body-surat">
					<div class="span12">
						<div class="text-body-surat">
							<h5 style="text-align:center;">
								FAKTUR PEMBELIAN
							</h5>
							<table style="font-size:12px;width:45%;float:left;">
								<tr>
							    	<td style="width:100px;">No. Faktur</td>
							    	<td>: <b><?php echo $faktur->faktur_id;?></b></td>
							    </tr>
							    <tr>
							    	<td style="width:100px;">Faktur Supplier</td>
							    	<td>: <b><?php echo $faktur->faktur_number;?></b></td>
							    </tr>
							    <tr>
							    	<td>petugas Penerima</td>
							    	<td>: <?php echo $faktur->sd_name;?></td>
							    </tr>
							</table>
							<table style="font-size:12px;width:45%;float:left;">
							    <tr>
							    	<td>Tanggal Faktur</td>
							    	<td>: <?php echo pretty_date($faktur->faktur_date,false);?></td>
							    </tr>
							    <tr>
							    	<td>Jatuh Tempo</td>
							    	<td>: <b><?php echo pretty_date($faktur->faktur_date_maturity,false);?></b></td>
							    </tr>
							</table>
							<br clear="all">
							<h6>Rincian :</h6>
							<table style="font-size:12px;margin-top:10px;width:98%;" class="rincian">
								<thead>
									<tr>
										<th style="text-align:left;">Kode Item</th>
								   		<th style="text-align:left;">Nama Item</th>
								   		<th style="text-align:center;">Jumlah</th>
								   		<th style="text-align:right;">Harga</th>
								   		<th style="text-align:right;">Pajak</th>
								   		<th style="text-align:right;">Sub Total</th>
									</tr>
								</thead>
								<tbody>
								<?php
						    	if( $detail->num_rows() >= 1 ){
						    		$total 	= $grandTotal = $PPN = 0;
							    	foreach ($detail->result() as $key => $value): ?>
							    		<tr>
							    			<td><?php echo $value->faktur_item;?></td>
							    			<td><?php echo $value->im_name;?></td>
							    			<td style="text-align:center;"><?php echo (float) $value->faktur_item_qty;?> <?php echo $value->mtype_name;?></td>
							    			<td style="text-align:right;"><?php echo number_format(($value->faktur_item_price), 0, ",", ".");?></td>
							    			<td style="text-align:right;"><?php echo number_format(($value->faktur_item_pajak), 0, ",", ".");?></td>
							    			<td style="text-align:right;"><?php echo number_format(($value->faktur_item_total), 0, ",", ".");?></td>
							    		</tr>
							    		<?php
							    	endforeach;
							    	?>
							    	<tr>
							    		<td colspan="5" style="text-align:right;font-weight:bold;">PPN 10%</td>
							    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_pajak), 0, ",", ".");?></td>
							    	</tr>
							    	<tr>
							    		<td colspan="5" style="text-align:right;font-weight:bold;">Subtotal</td>
							    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_price), 0, ",", ".");?></td>
							    	</tr>
							    	<tr>
							    		<td colspan="5" style="text-align:right;font-weight:bold;">Diskon</td>
							    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_discount), 0, ",", ".");?></td>
							    	</tr>
							    	<tr>
							    		<td colspan="5" style="text-align:right;font-weight:bold;">Total</td>
							    		<td colspan="" style="text-align:right;font-weight:bold;"><?php echo number_format(($faktur->faktur_total), 0, ",", ".");?></td>
							    	</tr>
							    	<?php
							    }else
							    {
							    	?>
									<tr style="border-top:1px solid black;">
										<td colspan="5" style="text-align:center;">Tidak ada data detail</td>
									</tr>
							    	<?php
							    }
						    	?>
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