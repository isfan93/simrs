<div class="pageheader notab">
    <h1 class="pagetitle"><?=(isset($title)) ? $title : '';?></h1>       
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper widgetpage">
    <div class="widgetbox">
        <div class="widgetcontent">
			<div id="contentwrapper" class="contentwrapper widgetpage">
				<div class="contenttitle2">
					<h3>Modal</h3>
				</div>
				<h4>iFrame based modal</h4><br>
				<p>Untuk default iframe, pake class .defiframe dan href di isi dengan alamat iframe. <br>
					Secara default class .defiframe memanggil iframe dengan ukuran width:"80%", height:"90%",<br>
					Kalau mau pake ukuran yang beda, silahkan definisikan class lain di local view anda. contoh :
				</p>
				<a href="<?=base_url()?>pelayanan_informasi/contoh/contoh_iframe" class="btn btn_link defiframe"><span>iframe</span></a><br><br>
				<h4>inline modal</h4><br>
				<p>Untuk default inline modal, pake class .defcolor dan href di isi dengan nama div elemen. Jangan lupa div elemen di apit dengan class hide, lihat soure halaman ini untuk contoh<br>
					Secara default class .defcolor memanggil elemen dengan ukuran yang sesuai elemen tersebut,<br>
				</p>
				<a href="#basicform" class="btn btn_link defcolor"><span>inline</span></a><br><br>
				<br>

				<a id="fade" class="btn btn_link"><span>inline</span></a><br><br>
				<b>Keep 'DRY'nes your code</b>
			</div>
		</div>
    </div>
</div>

<div class="hide" id="fadeout"> 
	<div id="basicform" class="subcontent" style="width:800px;padding:5px 10px;height:300px">
		<div class="contenttitle2">
			<h3>Form Style 1</h3>
		</div><!--contenttitle-->
		<form class="stdform" action="" method="post">
			<p>
				<label>Small Input</label>
				<span class="field"><input type="text" name="input1" class="smallinput" /></span>
				<small class="desc">Small description of this field.</small>
			</p>
			<p>
				<label>Medium Input</label>
				<span class="field"><input type="text" name="input2" class="mediuminput" /></span>
			</p>
			<p>
				<label>Long Input</label>
				<span class="field"><input type="text" name="input3" class="longinput" /></span>
			</p>
			<p>
				<label>Textarea</label>
				<span class="field"><textarea cols="80" rows="5" class="longinput"></textarea></span> 
			</p>
			<p>
				<label>Textarea with Character Count</label>
				<span class="field">
					<textarea cols="80" rows="5" id="textarea2" class="longinput"></textarea>
				</span> 
			</p>
			<p>
				<label>Select</label>
				<span class="field">
					<select name="select">
						<option value="">Choose One</option>
						<option value="">Selection One</option>
						<option value="">Selection Two</option>
						<option value="">Selection Three</option>
						<option value="">Selection Four</option>
					</select>
	         	</span>
			</p>
			<p>
				<label>Disabled Select</label>
				<span class="field">
					<select name="select" disabled="disabled">
						<option value="">Choose One</option>
						<option value="">Selection One</option>
						<option value="">Selection Two</option>
						<option value="">Selection Three</option>
						<option value="">Selection Four</option>
					</select>
				</span>
			</p>
			<p>
				<label>Multiple Select</label>
				<span class="field">
					<select name="select2" multiple="multiple" size="5">
						<option value="">Selection One</option>
						<option value="">Selection Two</option>
						<option value="">Selection Three</option>
						<option value="">Selection Four</option>
						<option value="">Selection Five</option>
						<option value="">Selection Six</option>
						<option value="">Selection Seven</option>
						<option value="">Selection Eight</option>
					</select>
				</span>
			</p>
		</form>
	</div>
</div>


<script type="text/javascript" charset="utf-8">
	$(function(){
		$("#fade").click(function(){
			$("#contentwrapper").fadeOut(function(){
				$("#fadeout").fadeIn();
			})
		})
	})
</script>