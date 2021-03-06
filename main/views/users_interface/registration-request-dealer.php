<!DOCTYPE html> 
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="<?=$description;?>"/>
	<meta name="author" content="<?=$author;?>"/>
	<meta name="keywords" content="<?=$keywords;?>"/>
	<title><?=$title;?></title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="stylesheet" href="<?=$baseurl;?>css/style.css?v=1">
	<link rel="stylesheet" href="<?=$baseurl;?>css/960.css?v=1">
	<link rel="stylesheet" href="<?=$baseurl;?>css/chosen.css" />
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.w575{width: 575px;}
		.h20{min-height: 20px;}
		.w265{width: 265px;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('users_interface/header/header-noauth'); ?>
		<div id="main">
			<div class="container_12">
				<div class="grid_12">
					<?php $this->load->view('forms/frmrequesregdealer'); ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('users_interface/footer/footer-nomenu'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/chosen.jquery.js" ></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#regions").chosen();
			$(".number").keypress(function(e){
				if(e.which!=45 && e.which!=32 && e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
			$("#sentRequest").click(function(event){
				var err = false;
				$(".inputValid").css('border-color','#D0D0D0');
				$("#newactivity").css('border-color','#D0D0D0');
				$(".inputValid").each(function(i,element){if($(this).val()===''){$(this).css('border-color','#ff0000');err = true;}});
				if(err){event.preventDefault();msgerror('Пропущены обязательные поля'); return false;}
				var email = $("#email").val();
				if(email != '' && !email.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){
				msgerror('Не верный формат E-mail');$("#email").css('border-color','#ff0000');$("#email").focus();return false;}
			});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;};
		});
	</script>
<!--[if lt IE 7 ]>
	<script src="<?=$baseurl;?>javascript/dd_belatedpng.js?v=1"></script>
<![endif]-->
<!--
	<script src="<?=$baseurl;?>javascript/profiling/yahoo-profiling.min.js?v=1"></script>
	<script src="<?=$baseurl;?>javascript/profiling/config.js?v=1"></script>
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