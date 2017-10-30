<?php
	$i = 0;
	foreach ($antrian->result() as $key => $value) {
		$i++;
		$background = '';
		if( $value->visit_status == 2)
			$background = '#cfeaf9';
		?>
		<tr style="background:<?=$background?>;" >
			<input type="hidden" id="rm" name="rm" value="<?=$value->sd_rekmed?>">
			<input type="hidden" id="mdc_id" name="mdc_id" value="<?=$value->queo_id?>">
			
			<td class="center">
				<b><?=$value->queo_no?></b>
			</td>
			<td>
				<b><?=$value->sd_name?></b>
				<br>
				<b><i><?=$value->sd_rekmed?></b>
			</td>
			<td>
				<i><?=$value->sd_address?></i>
			</td>
		</tr>
		<?php
	}
?>