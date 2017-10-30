<!DOCTYPE html>
<html lang="en">
      
    <head>
        <?$this->load->view("include/script")?>
    </head>
    <body>
        <div class="topheader" Style="margin-bottom:-14px">
            <div class="left">
                <?$this->load->view("include/left_header")?>
            <br clear="all" />
            </div> 
            <div class="right">
                <?$this->load->view("include/right_header")?>
            </div>
        </div>
        <?$this->load->view("include/header")?>
        <div id="sidebar">
            <?$this->load->view("include/left_menu")?>
        </div>

        <div id="content">
            <?=(isset($main_view)) ? $this->load->view($main_view) : 'Anda belum menset main view';?>
        </div>
    </body>
</html>