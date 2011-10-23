<!DOCTYPE html> 
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
	<style type="text/css">
		#btnDelJobLine{display: none;}
		#select-region{float: left;margin-right: 20px;}
		#area, #actinfo{font: bold normal 130% serif;}
		.h20{min-height: 20px;}
		.h250{min-height: 250px;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container" class="main-wrap">
		<?php $this->load->view('admin_interface/header-nomenu'); ?>
		<div id="main">
			<section id="auth1">
				<div class="container_12 framing">
					<div class="grid_12">
						<h1>Регистрация дилера</h1>
						<?php $this->load->view('forms/frmsignupdealer');?>
					</div>
					<div class="clear"></div>
				</div>	
			</section>
			<div class="clear"></div>
		</div>
		<?php $this->load->view('admin_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.megaselectlist.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#btnSubmit").click(function(event){
				var err = false;
				$(".inputValid").css('border-color','#D0D0D0');
				$(".inputValid").each(function(i,element){if($(this).val()===''){$(this).css('border-color','#ff0000');err = true;}});
				var regObj = $("#select-region");
				if($(regObj).val() == null){$(regObj).css('border-color','#ff0000');}else $(regObj).css('border-color','#D0D0D0');
				if(err){event.preventDefault();msgerror('Пропущены обязательные поля');}
				var email = $("#email").val();
				if(email != '' && !email.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){
					msgerror('Не верный формат E-mail');$("#email").css('border-color','#ff0000');
					$("#email").focus();event.preventDefault();return false;};
			});
			$("#btnReturn").click(function(){
				window.location="<?=$baseurl;?>admin/control-panel/<?=$userinfo['uconfirmation'];?>";
			});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;}});
	</script>
</body>
</html>