<script>
	// $(function(){
		$('#fx_diagnosa').flexbox(BASE+'rawat_jalan/poli_tulang/get_diagnosa', {
			paging: false,
			showArrow: false ,
			maxVisibleRows : 10,
			width : 250,
			resultTemplate: '<div class="col1">{id}</div><div class="col2">{name}</div>',
			// onSelect: function() {
			// 	$.getJSON(BASE+"master/jasa/get_jasa_json/"+$("#fx_jasas_hidden").val(), function(json) {
			// 		$("#hd_harga").val(json.total);
			// 	})
			// }
		// });
	})
</script>