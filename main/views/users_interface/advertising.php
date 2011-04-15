<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="<?= $description; ?>"/>
	<meta name="author" content="<?= $author; ?>"/>
	<meta name="keywords" content="<?= $keywords; ?>"/>
	<title><?= $title; ?></title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/style.css?v=1">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/960.css?v=1">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/sexy-combo.css">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/sexy.css">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/custom.css">  
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php if($userinfo['status']): ?>
			<?php $this->load->view('users_interface/header/header-login'); ?>
		<?php else: ?>
			<?php $this->load->view('users_interface/header/header-logout'); ?>
		<?php endif; ?>
		<div id="main">
			<div class="container_12">
				<div class="grid_12">
					<div class="box wide">
						<div class="box-header">
							<h2>Новости</h2>
							<div class="box-search"></div>
						</div>
						<div class="box-content">
							<?=$text;?>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php $this->load->view('users_interface/footer/footer'); ?>
	</div> <!-- end of #container -->
<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script src="<?= $baseurl; ?>javascript/jquery.bgiframe.min.js?v=1"></script>
	<script src="<?= $baseurl; ?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script src="<?= $baseurl; ?>javascript/script.js?v=1"></script>	
	<script type="text/javascript">
		$(document).ready(function(){$(".btn-user-action").click(function(){location.href='<?= $baseurl; ?>registering/step-1';});$(".imaging").click(function(){location.href='<?= $baseurl; ?>begin-work';});$("#lnk-login").click(function(event){autorized(event);});$("#lnk-logout").click(function(){shotduwn();});$("#select-region").change(function(){change_region($(this));});$("#select-activity").change(function(){change_activity($(this));});function change_activity(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-region").val() > 0){$("#select-region").after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}function change_region(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-activity").val() > 0){obj.after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}function shotduwn(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){$("#loginstatus").load("<?= $baseurl; ?>views/logout");$("#lnk-login").live('click',function(event){autorized(event);});}});};function autorized(event){event.preventDefault();var login = $("#npt-login-name").val();var pass = $("#npt-login-pass").val();if(login === '' || pass === ''){msgerror('Введите логин и пароль');}else if(!login.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){msgerror('Не верный формат E-mail');}else{$.post("<?= $baseurl; ?>authorization",{'login':login,'password':pass},function(data){if(data.status){$("#loginstatus").load("<?= $baseurl; ?>views/login");$("#lnk-logout").live('click',function(){shotduwn();});$("#select-region").live('change',function(){change_region($(this));});$("#select-activity").live('change',function(){change_activity($(this));});}else msgerror(data.message);},"json");}};function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000', color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;}});
	</script>
<!--[if lt IE 7 ]>
	<script src="<?= $baseurl; ?>javascript/dd_belatedpng.js?v=1"></script>
<![endif]-->

<!--
	<script src="<?= $baseurl; ?>javascript/profiling/yahoo-profiling.min.js?v=1"></script>
	<script src="<?= $baseurl; ?>javascript/profiling/config.js?v=1"></script>
<script>
	var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']]; 
	(function(d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.async = true; g.src = '//www.google-analytics.com/ga.js'; s.parentNode.insertBefore(g, s);
	})(document, 'script');
</script>
-->
</body>
</html>