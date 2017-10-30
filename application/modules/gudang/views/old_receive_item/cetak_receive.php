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
							    	<td style="width:100px;">No. Penerimaan</td>
							    	<td>: <b><?php echo $receive_item->iri_id;?></b></td>
							    </tr>
							    <tr>
							    	<td>Jatuh Tempo</td>
							    	<td>: <b><?php echo pretty_date($receive_item->iri_date_maturity,false);?></b></td>
							    </tr>
							    <tr>
							    	<td>Tanggal Penerimaan</td>
							    	<td>: <?php echo pretty_date($receive_item->iri_date_accept,false);?></td>
							    </tr>
							    <tr>
							    	<td>petugas Penerima</td>
							    	<td>: <?php echo $receive_item->sd_name;?></td>
							    </tr>
							</table>
							<table style="font-size:12px;width:45%;float:right;">
							    <tr>
							    	<td style="width:100px;">No. PO</td>
							    	<td>: <?php echo $purchase->ipo_id;?></td>
							    </tr>
							    <tr>
							    	<td>Tanggal PO</td>
							    	<td>: <?php echo pretty_date($purchase->ipo_date_req,false);?></td>
							    </tr>
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
										<th style="text-align:left;">Kode Item</th>
								   		<th style="text-align:left;">Nama Item</th>
								   		<th style="text-align:center;">Jumlah</th>
								   		<th style="text-align:right;">Harga Satuan</th>
								   		<th style="text-align:right;">Sub Total</th>
									</tr>
								</thead>
								<tbody>
								<?php
						    	if( $detail->num_rows() >= 1 ){
						    		$total 	= $grandTotal = $PPN = 0;
							    	foreach ($detail->result() as $key => $value):
							    		$subTotal = ($value->iri_qty * $value->iri_item_price);
							    		$total += ($value->iri_qty * $value->iri_item_price);
							    		$PPN 	= ($total * ($purchase->ipo_ppn * 0.01));
							    		$grandTotal = ($total + $PPN);
							    		?>
							    		<tr>
							    			<td><?php echo $value->im_id;?></td>
							    			<td><?php echo $value->im_name;?></td>
							    			<td style="text-align:center;"><?php echo $value->iri_qty;?> <?php echo $value->im_unit;?></td>
							    			<td style="text-align:right;"><?php echo number_format(($value->iri_item_price), 2, ",", ".");?></td>
							    			<td style="text-align:right;"><?php echo number_format(($subTotal), 2, ",", ".");?></td>
							    		</tr>
							    		<?php
							    	endforeach;
							    	?>
							    	<tr>
							    		<td colspan="4" style="text-align:right;font-weight:bold;">Total</td>
							    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($total), 2, ",", ".");?></td>
							    	</tr>
							    	<tr>
							    		<td colspan="4" style="text-align:right;font-weight:bold;">Discount</td>
							    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($receive_item->iri_discount), 2, ",", ".");?></td>
							    	</tr>
							    	<tr>
							    		<td colspan="4" style="text-align:right;font-weight:bold;">Grand Total</td>
							    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($receive_item->iri_total), 2, ",", ".");?></td>
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