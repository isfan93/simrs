<?php $a = $this->session->flashdata('message');?>
<?php if(!empty($a)):?>
<div class="<?=$a[0]?>">
	<div class="loginmsg ">
		<a class="close" href="">x</a>
		<?=$a[1]?>
	</div>
</div><!--nousername-->
<?php endif;?>

