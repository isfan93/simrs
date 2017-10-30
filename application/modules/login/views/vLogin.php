<!DOCTYPE html>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?=(isset($title)) ? $title : '';?> SIMRS IH</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.default.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.ie8.css" type="text/css" />
	<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/custom/general.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/custom/index.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/custom/css3-mediaqueries.js"></script>
	</head>
	<style type="text/css">
	.loginpage{
		background-image: url('assets/images/garut2.png');
		background-size:cover;
	}
	</style>
	<body class="loginpage">
		<div class="loginbox">
	    	<div class="loginboxinner">
	            <div class="logo">
	            	<h1><span>SIMRS.</span>IH</h1>
	                <p>Rumah Sakit Intan Husada</p>
	            </div><!--logo-->
	            <br clear="all" />
	            <?php $this->load->view("include/msg");?>
				<?=form_open(base_url('login/cek'));?>
	                <div class="username">
	                	<div class="usernameinner">
	                    	<input type="text" name="username" id="username" autocomplete="off" placeholder="Username" />
	                    </div>
	                </div>
	                <div class="password">
	                	<div class="passwordinner">
	                    	<input type="password" name="password" id="password" placeholder="Password" />
	                    </div>
	                </div>
	                <button>Sign In</button>
	                <!-- <div class="keep"><input type="checkbox" /> Keep me logged in</div> -->
					<br clear="all"><br>
	            </form>
	        </div><!--loginboxinner-->
	    </div><!--loginbox-->
	</body>
</html>