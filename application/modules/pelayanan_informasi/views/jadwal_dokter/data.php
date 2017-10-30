  <script>
    $(function(){
      
        var tblmaster = $('.tabel-master').dataTable( {
              
                "sPaginationType": "bootstrap",
                "sScrollY": "400px",
                "bPaginate": false,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": false,
                "oLanguage": {
                  "sEmptyTable": "Jadwal tidak tersedia"
                }
            });
		/*
		$("#list-data tr").on("dblclick",function (event){
			var number=$('#list-data tr').index(this);
			var value=$('#seq_'+number).val();
			//alert(number);
			url = "<?=base_url()?>master/data_tindakan/get_pop_update/"+value;
			   $.get(url,function(data){

				  $('.modal-body').children().remove();
				  $('.modal-body').append(data);
					$('#myModalUpt').modal('show');
			   });
		})
		*/
    })

 </script>
 <table cellpadding="0" cellspacing="0" border="0" class="tabel-master table table-bordered def_table_y dataTable tb_scrol">
         
            <thead>
                <tr  role="row">
                    <th class="head0">No.</th>
					<th class="head0">Nama Dokter</th>
                    <th class="head1">Hari</th>
					<th class="head1">Jam</th>
                    <th class="head0">Poli</th>                   
                </tr>
            </thead>
            
            <tbody id="list-data">

                <?php $i=1; foreach ($datas->result() as $list):?>
                <tr>
                    <?php echo '<td>'.$i.'</td>'?>                    
                    <?php echo '<td>'.$list->sd_name.'<input type="hidden" value="'.$list->sch_id.'" id="seq_'.($i-1).'"></td>'?>
                    <?php echo '<td>'.$list->day.'</td>'?>
					<?php echo '<td>'.$list->shift_start.'-'.$list->shift_end.'</td>'?>
                    <?php echo '<td>'.$list->pl_name.'</td>'?>					
                </tr>
                <?php $i++; endforeach?>               
            </tbody>
            <tfoot>
            </tfoot>
        </table>
<div id="myModalUpt" class="modal hide">
	<div class="modal-header">
	  <button data-dismiss="modal" class="close" type="button">x</button>
	  <h3>Tambah Tindakan</h3>
	</div>
	<div class="modal-body">
	  

	</div>
</div>
