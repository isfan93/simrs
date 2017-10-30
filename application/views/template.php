<!DOCTYPE html>
<html lang="en">
    <head> 
        <?php $this->load->config("wallpaper"); ?>
        <?php $this->load->view("include/script"); ?>
        <style type="text/css">
            html, body {
               margin:0;
               padding:0;
               height:100%;
            }
        </style>
        <script type="text/javascript">
        $(function(){
            urlmenu = document.URL;
            // alert(urlmenu); 
            $('.vernav2 li a.list-menu').each(function(i, data){
                url = $(this).attr('href');
                if(url==urlmenu){
                    $(this).parent().addClass('current');
                    $(this).parents('li.submenu').addClass('current');
                    // console.log($(this));
                }
            });
        })
        </script>
    </head>
    <body>
        <div class="topheader" style="margin-bottom:-26px;">
            <div class="left">
                <?php $this->load->view("include/left_header"); ?>
                <br clear="all" />
            </div> 
            <div class="right">
                <?php $this->load->view("include/right_header"); ?>
            </div>
        </div>
        <?php $this->load->view("include/header"); ?>
        <?php if (!isset($is_fullpage)) : ?>
            <div class="vernav2 iconmenu">
                <?php $this->load->view("include/left_menu"); ?>
            </div>
        <?php else : ?>
            <style>
                #content{margin-left: 0px;border-left: 0 none;}
            </style>
        <?php endif; ?>

        <div id="content">
                <div class="hide-sidebar" style="">Hide</div>
                <div  style="clear:both"></div>
            <?= (isset($main_view)) ? $this->load->view($main_view) : 'Anda belum menset main view'; ?>
        </div>
        <div id="sistem_footer">
            &copy; Copyright 2014 -  <?=date('Y')?> | Powered By Techno Medica Indonesia.
        </div>
    </body>
</html>