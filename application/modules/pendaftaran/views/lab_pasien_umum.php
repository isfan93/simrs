<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css" media="screen">
    .ffb{
        width: 600px !important;
    }
    #fx_item.ffb{
        width:350px !important;
        top: 28px !important;
    }
    #fx_item_ctr .row .col1{
        float:left;
        width:10px;
    }
    #fx_item_ctr .row .col2{
        float:left;
        margin-left: 15px;
        width:220px;
    }
    .ffb-input{
        width: 305px !important;
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    </h5><i class="icon-ok"></i></h5>
                </span>
                <h5>Layanan Laboratorium</h5>
            </div>
            <?php echo form_hidden('no_rekmed', 0) ?>
            <?php echo form_hidden('is_new_patient', 0) ?>
            <?php echo form_hidden('request_new_card', 0) ?>
            <div class="row-fluid">
                <div style="padding:12px;">
                    <?php if( (isset($penunjang)) && ($penunjang->num_rows() >= 1) ) : ?>
                        <?php $countPenunjang = round($penunjang->num_rows() / 2); $count = 1;?>
                        <?php foreach ($penunjang->result() as $key => $value) :  ?>
                            <?php if($count == 1) :  ?>
                                <div class="row-fluid">
                            <?php endif;?>
                                <div class="span4">
                                    <input type="checkbox" class="checkbox penunjang_lab" name="penunjang[]" value="<?=$value->ds_id?>" id="penunjang_<?=$value->ds_id?>" /><label for="penunjang_<?=$value->ds_id?>" style="margin-left:5px;"> <?=$value->ds_name?></label>
                                    <input type="hidden" name="nama_penunjang[<?=$value->ds_id?>]" value="<?=$value->ds_name?>" id="nama_penunjang_<?=$value->ds_id?>" />
                                    <input type="hidden" name="harga[<?=$value->ds_id?>]" value="<?=$value->ds_price?>" id="harga_<?=$value->ds_id?>" />
                                    <input type="hidden" name="type[<?=$value->ds_id?>]" value="lab" id="type_<?=$value->ds_id?>" />
                                </div>
                            <?php if($count == 3) :?>
                                </div>
                                <?php $count = 0;?>
                            <?php endif;?>
                            <?php $count++;?>
                        <?php endforeach; ?>
                        <?php if($count <= 3) :?>
                            </div>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>