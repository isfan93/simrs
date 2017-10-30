<ul class="thumbnails" style="margin-bottom:0px">
<?php
  $i = 0;
    foreach ($anamnesa->result() as $key => $value) {
       ?>
            <li>
              <label>
              <input  type="checkbox" name="anamnesa[]" value="<?=$value->ma_indication?>" class="tbh_kajian"/>&nbsp;&nbsp;<?=$value->ma_indication?>
            </li>
       <?php
       $i++;
    }

    $ma_desc = $ma_value = $ma_subjective = $ma_objective ='';
    if($trx_anamnesa->num_rows() > 0){
      foreach ($trx_anamnesa->result() as $key => $value) {
        $ma_desc .= $value->ma_desc;
      }
    }
?>
</ul>
<script>
   $(function(){
        $(".tbh_kajian").click(function(){
            if($(this).is(":checked")){
                var text =  $(this).val()+', ';
                var old_des = $("#des_kajian_am").html();
                var new_des = old_des.replace(text,'');
                $("#des_kajian_am").html(new_des);
                var text =  $("#des_kajian_am").html(); 
                $("#des_kajian_am").html(text+$(this).val()+', ');    
            }else{
              var text =  $(this).val()+', ';
              var old_des = $("#des_kajian_am").html();
              var new_des = old_des.replace(text,'');
              $("#des_kajian_am").html(new_des);
            }
            
        });
        var ma_desc = "<?php echo $ma_desc;?>";
        $("#des_kajian_am").html(ma_desc);
      })
</script>

