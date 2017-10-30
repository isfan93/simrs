<div class="container-fluid">
    <div class="row-fluid">
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs" id="list_rekmed">
                <?php
                if($med_recs->num_rows() >= 1){
                    foreach($med_recs->result() as $key => $value):
                        ?>
                        <li class="pilih">
                            <a href="#<?=$key+1?>" visit_rekmed="<?=$value->visit_rekmed?>" data-toggle="tab" service_id="<?php echo $value->service_id;?>">
                                <?=pretty_date($value->visit_in,false)?>
                            </a>
                        </li>
                        <?php
                    endforeach;
                }
                ?>
                <!-- <li class="pilih"><a href="#0" sd_rekmed="" data-toggle="tab">load more...</a></li> -->
            </ul>
            <div class="tab-content" id="detail_rekmed">
                <?php
                if($med_recs->num_rows() >= 1){
                    foreach($med_recs->result() as $key => $value):
                        ?>
                        <div class="tab-pane" id="<?=$key+1?>">...</div>
                        <?php
                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        //combine ajax.get data from controller and tab
        $('ul#list_rekmed a[data-toggle="tab"]').click(function(e)
        {
            href = $(this).attr('href');
            var visit_rekmed = $(this).attr('visit_rekmed');
            var service_id = $(this).attr('service_id');
            if(href != '#0'){
                $.get('<?=base_url()?>igd/single_rekmed/'+service_id, function(data) {
                    $(href).html(data);
                });
            }else{
                // load_more = $("ul#list_rekmed li").eq(-1).html();
                // $('ul#list_rekmed li').eq(-1).remove();
                // //if load more
                // $.get('<?=base_url()?>rawat_jalan/poli_tulang/rekam_medis/load_more/'+sd_rekmed, function(data) {
                //     batas = 0;
                //     $(data).each(function(d){
                //         $("ul#list_rekmed").append("<li><a href='#"+data[d].medical_id+"' data-toggle='tab' >"+data[d].medical_date_time+"</a></li>");
                //         $('#detail_rekmed').append('<div class="tab-pane" id="'+data[d].medical_id+'">...</div>')
                //         batas++;
                //     })
                //     $("ul#list_rekmed").append("<li>"+load_more+"</li>");
                // },'json');
            }
            // return false;
        });
        
        $('ul#list_rekmed a[data-toggle="tab"]:eq(0)').trigger('click');
    })
</script>