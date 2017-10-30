<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<style type="text/css" media="screen">
    .search_input input{margin-top:-1px;float:right;margin-left:2px}
    .search_input .btn{float:right;margin-left:5px}
    .search_input .btn span{padding:2px 10px;}
    .search_choice a{font-weight:bold}
    .search_choice a.active{color:#fb9338}
    .search_choice {float:right;margin-right:95px}
    .dataTables_filter{display:none}
    #advance{display:none}
    #filter{border-bottom: 1px dashed #DDD;}
    #body_search{margin-top:10px}
    .tname{font-size:110%}
    .dynamic-table .btn {margin-left:2px;margin-right:2px}
    .dynamic-table{width:98%;margin-left:auto;margin-right:auto;margin-bottom:10px;}
    .dynamic-table tbody tr td{border-right:none}
    .dynamic-table .btn {margin-left:2px;margin-right:2px}
    .dynamic-table tr:nth-child(even){
        background:#F7F7F7;
    }
    .dataTables_scrollHead{
        margin-bottom: -22px;
    }
    .dataTables_info{
        margin-bottom: 20px;
    }
    .table_tr thead th{
        height: 28px;
        vertical-align: middle;
        font-size: 13px;
    }
    .table_tr tbody th{
        height: 28px;
        vertical-align: middle;
        font-size: 13px;
    }
    table.dynamic-table .center{
        text-align:center;
        font-size: 12px;
    }
    table.dynamic-table .right{
        text-align:right;
    }
    .alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>
<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed">
    <div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" style="display: none; width:50px "></div>
            <img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
            <div class="gritter-with-image" style="width:448px">
                <span class="gritter-title" style="margin-left:36px">Message</span>
                <p>Data Berhasil Disimpan   </p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="gritter-bottom"></div>
    </div>
</div>
