<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />

<style>
	.harga-input{
		box-shadow: 0px 0px 3px 3px rgba(0, 0, 0.075, 0.075) inset;
	}
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.table_tr tbody th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}
	.alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
</style>

<div class='container-fluid'>
	<div class='row-fluid'>
		<div class='span12'>
			<div class="widget-box">
				<div class="widget-content nopadding">
					<?=form_open(base_url().'rawat_jalan/<?=$url_poli?>/simpan_harga',array('class' => 'form-horizontal','id' => 'form_harga')); ?>	
					<input type="hidden" name="mdc_id" value="<?=$mdc_id?>">				
					<table class="table table-bordered table-striped table_tr" style="border-left:none;margin-bottom:0px;">
						<thead>
							<tr>
								<th style="border-left:none;">No.</th>
								<th>Jenis</th>
								<!-- <th>Harga Item</th> -->
								<!-- <th>Harga Jasa</th> -->
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
								// $total_jasa = $total_item = $total = $jasa = 0;
								$total = 0;
								if( $dokter_fee->num_rows() >= 1 )
								{
									$i = 0;
									$dokter_fee = $dokter_fee->row();
									$i++;
									?>
									<tr>
										<td colspan="5" style="text-align:left;font-weight:bold;border-left:0px;">Jasa Dokter</td>
									</tr>
									<tr>
										<td style="border-left:0px;text-align:center;width:20px;"><?=$i?></td>
										<td style="text-align:left;">Jasa pemeriksaan dokter</td>
										<!-- <td style="text-align:right;">0</td> -->
										<!-- <td style="text-align:right;"><?php echo number_format($dokter_fee->dr_fee, 0, ",", ".");?></td> -->
										<td style="text-align:right;"><?php echo number_format($dokter_fee->dr_fee, 0, ",", ".");?></td>
									</tr>
									<?php
									$total += $dokter_fee->dr_fee;
								}
								?>
								<?php if( (isset($visite)) && ($visite->num_rows()) ) : ?>
									<tr>
										<td colspan="5" style="text-align:left;font-weight:bold;border-left:0px;">Konsultasi Dokter</td>
									</tr>
									<?php foreach ($visite->result() as $key => $value) : ?>
										<tr>
											<td style="border-left:0px;text-align:center;width:20px;"><?=$i?></td>
											<td style="text-align:left;"><?=$value->treat_name?></td>
											<td style="text-align:right;"><?php echo number_format($value->treat_item_price, 0, ",", ".");?></td>
										</tr>
										<?php 
										$total += $value->treat_item_price;
										?>
									<?php endforeach;?>
								<?php endif;?>
								<?
								if( ($adm_fee->num_rows()) >= 1 ){
									?>
									<tr>
										<td colspan="5" style="text-align:left;font-weight:bold;border-left:0px;">Biaya Administrasi Umum</td>
									</tr>
									<?php
									$i = 1;
									foreach ($adm_fee->result() as $key => $value) {
										?>
											<tr>
												<td style="border-left:0px;text-align:center;width:20px;"><?=$i?></td>
												<td>
													<?=$value->adm_name?>
												</td>
												<!-- <td style="text-align:right;"><?=number_format($value->adm_fee, 0, ",", ".")?></td> -->
												<!-- <td style="text-align:right;">0</td> -->
												<td style="text-align:right;"><?=number_format(($value->adm_fee), 0, ",", ".")?></td>
											</tr>
										<?php
										$i++;
										$total += $value->adm_fee;
									}
								}

								if( ($resep->num_rows()) >= 1 ){
									?>
									<tr>
										<td colspan="5" style="text-align:left;font-weight:bold;border-left:0px;">Pembelian Obat & Alkes</td>
									</tr>
									<?php
									$i = 1;
									foreach ($resep->result() as $key => $value) {
										?>
											<tr>
												<td style="border-left:0px;text-align:center;width:20px;"><?=$i?></td>
												<td>
													<!-- <input type="hidden" name="id_obat[]" value="<?=$value->recipe_medicine?>" > -->
													<?=$value->recipe_medicine."/".$value->im_name?> &nbsp;&nbsp;(<?=$value->recipe_rule?>)  &nbsp;&nbsp;qty : <?=$value->recipe_qty?> <?=$value->mtype_name?>
												</td>
												<!-- <td style="text-align:right;"><?=number_format($value->im_item_price, 0, ",", ".")?></td> -->
												<!-- <td style="text-align:right;">0</td> -->
												<!-- <td style="text-align:right;"><input type="text" name="resep_dokter_price[]" style="border:none;border-bottom:1px dotted gray;text-align:right" value="<?=$value->dokter_price?>" ></td> -->
												<?php $harga_sementara=$value->recipe_price * $value->recipe_qty; ?>
												<td style="text-align:right;"><?=number_format(($harga_sementara), 0, ",", ".")?></td>
											</tr>
										<?php
										$i++;
										$total += $harga_sementara;//$total += $value->recipe_price;
									}
								}

								if( ($tindakan->num_rows()) >= 1 ){
									?>
										<tr>
											<td colspan="5" style="text-align:left;font-weight:bold;border-left:0px;">Tindakan</td>
										</tr>
									<?php
									$i = 1;
									foreach ($tindakan->result() as $key => $value) {
										?>
											<tr>
												<td style="border-left:0px;text-align:center;width:20px;"><?=$i?></td>
												<td style="text-align:left;">
													<?=$value->treat_name?>
												</td>
												<!-- <td style="text-align:right;"><?=number_format(($value->treat_item_price), 0, ",", ".")?></td> -->
												<!-- <td style="text-align:right;">0</td> -->
												<td style="text-align:right;"><?=number_format($value->treat_item_price, 0, ",", ".")?></td>
											</tr>
										<?php
										$i++;
										$total += $value->treat_item_price;
									}
								}
							?>
							<?php if( ($total == 0) ){
								?>
								<tr>
									<th colspan="5" style="text-align:left;border-left:none;">Belum terdapat jasa atau item dalam pemeriksaan</th>
								</tr>
								<?php
							}else{
							?>
								<tr>
									<th colspan="2" style="text-align:left;">Total</th>
									<th style="text-align:right;"><?=number_format(($total), 0, ",", ".")?></th>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
				
						</tfoot>
					</table>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</div>
</div>
