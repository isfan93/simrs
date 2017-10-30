<style type="text/css">
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
</style>
<div class="pageheader notab">
    <h1 class="pagetitle"><?=$title?></h1>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span5 center" style="text-align: center;">                 
			<ul class="quickstats">
				<li>
					<a href="<?=base_url()?>gudang/faktur">
						<img alt="" src="<?=base_url()?>assets/img/icons/32/DefinedParameters.png">
						<span> Faktur<br> Pembelian</span>
					</a>
				</li>
				<li>
					<a href="<?=base_url()?>gudang/retur">
						<img alt="" src="<?=base_url()?>assets/img/icons/32/download.png">
						<span>Retur</span>
					</a>
				</li>
				<li>
					<a href="<?=base_url()?>gudang/stok">
						<img alt="" src="<?=base_url()?>assets/img/icons/32/Prescription.png">
						<span>Stok</span>
					</a>
				</li>
			</ul>
 		</div>  
		<div class="span7 center">
			<div class="row-fluid">
				<div class="span12">
					<br>
					<div class="title" style="padding:0px"><h3>Stok Hampir Habis</h3></div>
					<br>
					<table class="table table-striped table-bordered table_tr">
		                <thead>
		                    <tr>
		                        <th style="width:10%;">No</th>
		                        <th>Nama Obat</th>
		                        <th style="width:15%;">Stok</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	<?php
		                	if( $critical_stok->num_rows() >= 1)
		                	{
		                		foreach ($critical_stok->result() as $key => $value) {
		                			?>
		                			<tr>
		                				<td style="text-align:center;"><?=($key + 1)?></td>
		                				<td><?=$value->im_name?></td>
		                				<td style="text-align:center;"><?=$value->istok_qty?> <?=$value->mtype_name?></td>
		                			</tr>
		                			<?php
		                		}
		                	}else
		                	{
		                		?>
		                		<tr>
			                        <td colspan="4" style="text-align:center;">Tidak ada stok yang hampir habis</td>
			                    </tr>
		                		<?php
		                	}
		                	?>
		                </tbody>
		            </table>	
		            <br>
					<div class="title" style="padding:0px"><h3>Expired Item</h3></div>
					<br>
					<table class="table table-striped table-bordered table_tr">
		                <thead>
		                    <tr>
		                        <th style="width:10%;">No</th>
		                        <th>Nama Obat</th>
		                        <th style="width:15%;">Stok</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	<?php
		                	if( $critical_exp->num_rows() >= 1)
		                	{
		                		foreach ($critical_exp->result() as $key => $value) {
		                			?>
		                			<tr>
		                				<td style="text-align:center;"><?=($key + 1)?></td>
		                				<td><?=$value->im_name?></td>
		                				<td style="text-align:center;"><?=pretty_date($value->istok_exp,false)?></td>
		                			</tr>
		                			<?php
		                		}
		                	}else
		                	{
		                		?>
		                		<tr>
			                        <td colspan="4" style="text-align:center;">Tidak ada stok yang Expired</td>
			                    </tr>
		                		<?php
		                	}
		                	?>
		                </tbody>
		            </table>
				</div>
			</div>
		</div>
    </div>
</div>