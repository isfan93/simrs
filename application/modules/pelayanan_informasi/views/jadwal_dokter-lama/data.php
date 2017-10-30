<script>
$(function(){
  
    var tbldokter = $('.tabel-dokter').dataTable( {
          
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
})
</script>
<table cellpadding="0" cellspacing="0" border="0" class="tabel-dokter table table-bordered def_table_y dataTable tb_scrol">
<thead>
    <tr  role="row">
        <th class="head0">No.</th>
        <th class="head1">Nama Dokter</th>
        <th class="head0">Poli</th>
        <th class="head1">Jam</th>
    </tr>
</thead>
<tbody>
    <?php $i=1; foreach ($datas->result() as $doctor):?>
    <tr>
        <?php echo '<td style="text-align:center;">'.$i++.'</td>'?>
        <?php echo '<td>'.$doctor->dr_name.'</td>'?>
        <?php echo '<td>'.$doctor->pl_name.'</td>'?>
        <?
            $jam1 =  explode(' ',$doctor->shift_start);
            $jam2 =  explode(' ',$doctor->shift_end);
        ?>
        <?php echo '<td style="text-align:center;">'.$doctor->shift_start.' - '.$doctor->shift_end.'</td>'?>
        
    </tr>
    <?php endforeach?>               
</tbody>
<tfoot>
</tfoot>
</table>