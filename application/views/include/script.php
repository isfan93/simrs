<title><?=(isset($title)) ? $title : '';?> | SIMRS IH</title>
<!--script css-->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-responsive.min.css" />
    <!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/fullcalendar.css" />    -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/unicorn.main.css" />
    <!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/unicorn.grey.css" class="skin-color" /> -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/flexbox.css"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.default.css"/>
	<!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/style.default.css"/> -->

<!--script js-->
    <script src="<?=base_url()?>assets/js/excanvas.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.ui.custom.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
     <script src="<?=base_url()?>assets/js/jquery.peity.min.js"></script>
    <script src="<?=base_url()?>assets/js/fullcalendar.min.js"></script>
    <script src="<?=base_url()?>assets/js/unicorn.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url()?>assets/js/jquerydatatablebootstrap.js"></script>
	<script src="<?=base_url()?>assets/js/plugins/hicharts.js"></script>
    <script src="<?=base_url()?>assets/js/flexbox.js"></script>
    <script src="<?=base_url()?>assets/js/valid.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.blockUI.js"></script>
	<script src="<?=base_url()?>assets/js/script.js"></script>

	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/plugins/excanvas.min.js"></script><![endif]-->
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<script type="text/javascript" charset="utf-8">
	var BASE = "<?=base_url()?>";
	var CUR  = "<?=cur_url()?>";
</script>


        <style type="text/css">
        .hide-sidebar{
            /*width:30px;*/
            font-size: 10px;
            height:20px;
            background:#40526b;
            position: absolute;
            z-index: 20;
            left: -50px;
            top:0px;
            padding-left: 10px;
            padding-right: 10px;
            color: #fff;
            cursor: pointer;

            -webkit-border-bottom-right-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-radius-bottomright: 5px;
            -moz-border-radius-bottomleft: 5px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        #content{
            background-position: right bottom;
            background-repeat: no-repeat;
            background-size: 700px;
        }
        </style>

        <script type="text/javascript">
        $(function(){
            $('.hide-sidebar').toggle(function(){
                // alert('heloo');
                // $('#sidebar ul').toggle(
                    // function(){
                        $('#sidebar').hide();
                        $('#content').css('margin-left','0');
                        $(this).css('left','5px');
                        $(this).html('Show Menu');
                     },
                    function(){ 
                        $('#sidebar').show();
                        $('#content').css('margin-left','235px');
                        $(this).css('left','-50px');
                        $(this).html('Hide');
                     });
            
            imageUrl = "<?=$this->config->item('wallpaper_source');?>"; 
            $('#content').css('background-image', 'url(' + imageUrl + ')'); 
            // alert(wallpaper);

        })
        </script>