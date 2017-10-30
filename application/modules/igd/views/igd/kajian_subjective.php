<ul class="thumbnails" style="margin-bottom:0px">
<?
    foreach ($ks->result() as $key => $value) {
       ?>
            <li><label><input type="checkbox" name="ks[]" value="<?=$value->ms_indication?>" class="tambah_kajian"/>&nbsp;&nbsp;<?=$value->ms_indication?></li>
       <?
    }

    $ms_desc = $ms_value = '';
    if($trx_ks->num_rows() > 0){
      foreach ($trx_ks->result() as $key => $value) {
        $ms_desc .= $value->ms_desc;
        $ms_value .= $value->ms_value;
      }
    }
?>
</ul>

<script>
	 $(function(){

        $(".tambah_kajian").click(function(){
            if ($(this).is(":checked")){
              var text =  $("#des_kajian").html();
              $("#des_kajian").html(" "+$(this).val()+text);  
            }else{
            	var text =  $(this).val();
              var old_des = $("#des_kajian").html();
              var new_des = old_des.replace(text,'');
              $("#des_kajian").html(new_des);
            }
            
        });
      
        var ms_desc = "<?php echo $ms_desc;?>";
        var ms_value = "<?php echo $ms_value;?>";
        $("#des_kajian").html(ms_desc);
        $("#ms_value").html(ms_value);

      })
</script>