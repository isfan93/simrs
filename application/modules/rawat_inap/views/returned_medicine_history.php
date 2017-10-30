<div class="widget-box" style='padding: 10px;min-height:250px;'>
	<div class="widget-content">
		<div class="title" style="position:relative;top:-20px;margin-left:0px;margin-bottom:0px"><h3>Riwayat Retur Obat</h3></div>
		<?php if(!empty($returned_medicine_history)) : ?>
		<ul">
		<?php foreach($returned_medicine_history as $rmh) : ?>
			<li>
				<?=$rmh['date']?>
				<ul>
					<?php foreach($rmh['prescriptions'] as $p) : ?>
						<li>
							No Resep : <?=$p['prescription_id']?>
							<ul>
								<?php foreach($p['medicines'] as $m) : ?>
								<li>
									Nama Obat : <?=$m['medicine']?> | Jumlah : <?=$m['quantity']?> |
									Penanggung Jawab : <?=$m['pic']?> | Status : <strong><?=$m['status']?></strong>
								</li>
								<?php endforeach;?>
							</ul>
						</li>
					<?php endforeach;?>
				</ul>
			</li>
		<?php endforeach;?>
		</ul>
		<?php else:?>
			<ul>
				<li>Riwayat retur obat tidak ditemukan.</li>
			</ul>
		<?php endif;?>
	</div>
</div>