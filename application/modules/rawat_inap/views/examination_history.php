<style type="text/css">
    .tree {
        min-height:20px;
        padding:0px 19px 19px 19px;
        margin-bottom:20px;
    }
    .tree li {
        list-style-type:none;
        margin:0;
        padding:10px 5px 0 5px;
        position:relative
    }
    .tree li::before, .tree li::after {
        content:'';
        left:-20px;
        position:absolute;
        right:auto
    }
    .tree li::before {
        border-left:1px solid #999;
        bottom:50px;
        height:100%;
        top:0;
        width:1px
    }
    .tree li::after {
        border-top:1px solid #999;
        height:20px;
        top:25px;
        width:25px
    }
    .tree li span {
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border:1px solid #999;
        border-radius:5px;
        display:inline-block;
        padding:3px 8px;
        text-decoration:none
    }
    .tree li.parent_li>span {
        cursor:pointer
    }
    .tree>ul>li::before, .tree>ul>li::after {
        border:0
    }
    .tree li:last-child::before {
        height:30px
    }
    .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
        background:#eee;
        border:1px solid #94a0b4;
        color:#000
    }
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span6" style="padding:0px 10px 10px 10px">
            <div class="title" style="margin-left:0px"><h3>Lini Masa Pemeriksaan</h3></div>
            <?php if($history != null) : ?>
                <div class="tree">
                    <ul>
                        <?php foreach($history as $h) : ?>
                            <li>
                                <span><i class="icon-calendar"></i> <?=$h['name']?></span>
                                <ul>
                                    <?php foreach($h['details'] as $day) : ?>
                                        <li>
                                            <span class="badge badge-success"><i class="icon-minus-sign"></i> <?=$day['name']?></span>
                                            <ul>
                                                <?php foreach($day['details'] as $time) : ?>
                                                    <li>
                                                        <?php
                                                        $url = $time['id'] == '' ? "javascript:void()" : base_url()."rawat_inap/detail_pemeriksaan/".$time['id'];
                                                        ?>
                                                        <a href="<?=$url?>" class="examination-details"><span><i class="icon-time"></i> <?=$time['time']?></span> &ndash; <?=$time['action']?></a>
                                                    </li>
                                                <?php endforeach;?>
                                            </ul>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            <?php endif;?>
        </div>
        <div class="span6" style="display:none">
            <div class="title" style="margin-left:0px"><h3>Detail Pemeriksaan</h3></div>
            <div id="examinationDetails"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Lihat Detail').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Sembunyikan Detail').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
        $('.examination-details').click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function(result) {
              $('#examinationDetails').closest('div.span6').fadeIn('fast',function(){
                $('#examinationDetails').html(result);
              });
            });
        });
    });
</script>