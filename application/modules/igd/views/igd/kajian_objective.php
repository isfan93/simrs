<ul class="thumbnails" style="margin-bottom:0px">
<?php
	$i = 0;
    foreach ($ko->result() as $key => $value) {
       ?>
            <li><label><input  type="checkbox" name="ko[]" value="<?=$value->mo_indication?>" class="tbh_kajian"/>&nbsp;&nbsp;<?=$value->mo_indication?></li>
       <?
       $i++;
    }

    $mo_desc = $mo_value = '';
    if($trx_ko->num_rows() > 0){
      foreach ($trx_ko->result() as $key => $value) {
        $mo_desc .= $value->mo_desc;
        $mo_value .= $value->mo_value;
      }
    }
?>
</ul>
<script>
	 $(function(){
        $(".tbh_kajian").click(function(){
            if($(this).is(":checked")){
                var text =  $("#des_kajian_ob").html(); 
                $("#des_kajian_ob").html(" "+$(this).val()+text);    
            }else{
              var text =  $(this).val();
              var old_des = $("#des_kajian_ob").html();
              var new_des = old_des.replace(text,'');
              $("#des_kajian_ob").html(new_des);
            }
            
        });
        var mo_desc = "<?php echo $mo_desc;?>";
        var mo_value = "<?php echo $mo_value;?>";
        $("#des_kajian_ob").html(mo_desc);
        $("#mo_value").html(mo_value);
      })
</script>

