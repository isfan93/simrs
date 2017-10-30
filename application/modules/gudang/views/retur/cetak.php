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
								RETUR FAKTUR
							</h5>
							<table style="font-size:12px;margin-top:20px;width:45%;float:left;">
								<tr>
							    	<td style="width:100px;">No. Retur</td>
							    	<td>: <?php echo $retur->ir_id;?></td>
							    </tr>
							    <tr>
							    	<td>No. Faktur</td>
							    	<td>: <?php echo $retur->faktur_id;?></td>
							    </tr>
							    <tr>
							    	<td>Faktur Supplier</td>
							    	<td>: <?php echo $retur->faktur_number;?></td>
							    </tr>
							    <tr>
							    	<td>Supplier</td>
							    	<td>: <?php echo $retur->msup_name;?></td>
							    </tr>
							</table>
							<table style="font-size:12px;margin-top:20px;width:45%;float:left;">
							    <tr>
							    	<td>Tanggal Retur</td>
							    	<td>: <?php echo pretty_date($retur->ir_date,false);?></td>
							    </tr>
							    <tr>
							    	<td>Petugas</td>
							    	<td>: <?php echo $retur->sd_name;?></td>
							    </tr>
							    <tr>
							    	<td>Catatan</td>
							    	<td>: <?php echo $retur->ir_note;?></td>
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
							    	foreach ($detail->result() as $key => $value): ?>
							    		<tr>
							    			<td><?php echo $value->im_id;?></td>
							    			<td><?php echo $value->im_name;?></td>
							    			<td style="text-align:center;"><?php echo $value->ir_item_qty;?> <?php echo $value->im_unit;?></td>
							    			<td style="text-align:right;"><?php echo number_format(($value->ir_item_price), 0, ",", ".");?></td>
							    			<td style="text-align:right;"><?php echo number_format(($value->ir_item_pajak), 0, ",", ".");?></td>
							    			<td style="text-align:right;"><?php echo number_format(($value->ir_item_total), 0, ",", ".");?></td>
							    		</tr>
							    		<?php
							    	endforeach;
							    	?>
							    	<tr>
							    		<td colspan="4" style="text-align:right;font-weight:bold;">Total</td>
							    		<td colspan="4" style="text-align:right;font-weight:bold;"><?php echo number_format(($retur->ir_total), 0, ",", ".");?></td>
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