  <script>  
    $(function(){
    	 $('#table').dataTable( {
                "sPaginationType": "bootstrap",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
				      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"3%"},
              { "bSortable": false, "aTargets": [ 1 ],"sWidth":"20%" },
              { "bSortable": false, "aTargets": [ 2 ],"sWidth":"30%" },
				      { "bSortable": false, "aTargets": [ 3 ],"sWidth":"15%" },
				   ],
                "oLanguage": {
                  "sEmptyTable": "Data tidak tersedia"
                }
      });
    	$(".dataTables_filter").hide();
		  $('.dataTables_length').hide();
    })
 </script>
 <table class="table table-bordered" id="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php if($expenses->num_rows() >= 1) : ?>
            <?php foreach ($expenses->result() as $key => $value) : ?>
                <tr>
                    <td><?=($key+1)?></td>
                    <td><?=pretty_date($value->date,false)?></td>
                    <td><?=$value->note?></td>
                    <td style="text-align:right;font-weight:bold;"><?=number_format($value->nominal,0,',','.')?></td>
                </tr>
            <?php endforeach;?>
        <?php else : ?>

        <?php endif;?>
    </tbody>
</table>