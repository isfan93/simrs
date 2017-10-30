<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="row-fluid">
					<div class="span12">
						<div class="tabbable tabs-left" style="margin:10px;">
						  	<ul class="nav nav-tabs">
		    					<?php if(isset($riwayat_racikan) && ($riwayat_racikan->num_rows() >= 1)) : ?>
		    						<?php foreach ($riwayat_racikan->result() as $key => $value) : ?>
		    							<li><a href="#<?=$value->racikan_id?>" data-toggle="tab"><?=$value->racikan_name?></a></li>
		    						<?php endforeach;?>
		    					<?php endif;?>
						  	</ul>
						  	<div class="tab-content">
						  		<?php if(isset($riwayat_racikan) && ($riwayat_racikan->num_rows() >= 1)) : ?>
		    						<?php foreach ($riwayat_racikan->result() as $key => $value) : ?>
		    							<div class="tab-pane" id="<?=$value->racikan_id?>">
		    								<b>aturan pakai : <?=$value->racikan_rule?></b>
		    								<br>
		    								<b>detail obat :</b>
		    								<br>
		    								<?php if(isset($detail_riwayat_racikan[$value->racikan_id]) && ($detail_riwayat_racikan[$value->racikan_id]->num_rows() >= 1)) : ?>
		    									<?php foreach ($detail_riwayat_racikan[$value->racikan_id]->result() as $k => $v) : ?>
		    										<?=$v->im_name?> (<?=(float)$v->racikan_medicine_qty?> <?=$v->mtype_name?>)
		    										<br>
		    									<?php endforeach;?>
		    								<?php endif;?>
									    </div>
		    						<?php endforeach;?>
		    					<?php endif;?>
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>