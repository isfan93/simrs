<style type="text/css">
	.table tr th{
		line-height: 35px;
		font-size: 13px;
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12" style="text-align:center;">
			<div class="title">
				<h3>
					<?=$title?>
				</h3>
				<h5>
					<?=pretty_date($dateStart,false)?> - <?=pretty_date($dateEnd,false)?>
					<form id="filter_form">
						<input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
						<input type="hidden" value="<?= $dateStart ?>" id="date_startX" name="date_startX"><input type="hidden" value="<?= $dateEnd ?>" id="date_endX" name="date_endX">
					</form>
				</h5>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Dokter</th>
						<!--th>Poli</th>
						<th>Tindakan</th>
						<th>Visite</th-->
						<th>Spesialisasi</th>
						<th>Pasien</th>
						<th>Jumlah</th>
						<!--th>Pajak</th>
						<th>Setelah Pajak</th>
						<th>Keterangan</th-->
					</tr>
				</thead>
				<tbody>
					<?php if(isset($jasaDokter) && ($jasaDokter->num_rows() >= 1) ) : ?>
						<?php $total=0;foreach ($jasaDokter->result() as $key => $value) : ?>
							<?php
							$total+=$value->rupiah;
							/*
							$poli = $tindakan = $visite = 0;
							?>
							<?php if($jasaDokterDetail->num_rows() >= 1) : ?>
								<?php foreach ($jasaDokterDetail->result() as $k => $v) : ?>
									<?php if($v->dr_id == $value->dr_id) : ?>
										<?php
										switch ($v->service_type) {
											case '1':
												$poli += $v->nominal;
												break;
											case '6':
												$tindakan += $v->nominal;
												break;
											case '11':
												$visite += $v->nominal;
												break;
											default:
	
												break;
										}
										?>
									<?php endif;?>
								<?php endforeach;?>
							<?php endif;?>
							<?php
								$data['jasaDokter'][$value->dr_id]['poli'] = $poli;
								$data['jasaDokter'][$value->dr_id]['tindakan'] = $tindakan;
								$data['jasaDokter'][$value->dr_id]['visite'] = $visite;
								$jumlah = $poli + $visite + $tindakan;
								$pajak = ($jumlah * 0.05);
								$total = $jumlah - $pajak;
							*/
							?>
							<tr>
								<td><?=($key+1)?></td>
								<td>
									<a href="<?=base_url()?>pelaporan/keuangan/detail_jd/<?=$value->dr_id?>" target="" class="detail_jd">
										<?=$value->dr_name?>
									</a>
								</td>
								<td><?=$value->description?></td>
								<td><?=$value->banyak_kunjungan?></td>
								<td style="text-align:right;font-weight:bold;">Rp. <?=number_format($value->rupiah,0,',','.')//number_format($data['jasaDokter'][$value->dr_id]['poli'],0,',','.')?></td>
								<!--td style="text-align:right;font-weight:bold;"><?//=number_format($data['jasaDokter'][$value->dr_id]['tindakan'],0,',','.')?></td>
								<td style="text-align:right;font-weight:bold;"><?//=number_format($data['jasaDokter'][$value->dr_id]['visite'],0,',','.')?></td>
								<td style="text-align:right;font-weight:bold;"><?//=number_format($jumlah,0,',','.')?></td>
								<td style="text-align:right;font-weight:bold;"><?//=number_format($pajak,0,',','.')?></td>
								<td style="text-align:right;font-weight:bold;"><?//=number_format($total,0,',','.')?></td>
								<td>-</td-->
							</tr>
						<?php endforeach;?>
						<tr>
							<td colspan="4" style="text-align:center;">
								<b>TOTAL:</b>
							</td>
							<td style="text-align:right;font-weight:bold;"><?=number_format($total,0,',','.')?></td>
						</tr>
					<?php elseif($jasaDokter->num_rows() <= 0) :?>
						<tr>
							<td colspan="4" style="text-align:center;">
								Maaf, Data belum ada
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.detail_jd').click(function(e){
			e.preventDefault();
			var url=$(this).attr('href');
			var datax=$('#filter_form').serialize()
				//alert(datax);
			/*$.post(url,datax,function(e){
				$("#jasadokter").html(e);
			})
			*/
			$.ajax({
				type:'POST',
				url:url,
				data:datax,
				success:function(e){
					$("#jasadokter").html(e);	
				}
			})
		})
	})
</script>