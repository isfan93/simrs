<!DOCTYPE html>
<html lang="en">
    <head>  
        <?$this->load->view("include/script")?>
    </head>
    <body>
		<div style="margin:5px 10px">
			<?=(isset($main_view)) ? $this->load->view($main_view) : 'Anda belum menset main view';?>
			<br clear="all" />
		</div>
    </body>
</html>

<!-- Localized -->