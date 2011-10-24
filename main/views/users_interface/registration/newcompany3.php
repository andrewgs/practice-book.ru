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
	<link rel="stylesheet" href="<?=$baseurl;?>css/jquery-ui.css?v=1.8.5">
	<link rel="stylesheet" href="<?=$baseurl;?>css/sexy-combo.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/sexy.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/custom.css">  
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('users_interface/header/header-logo'); ?>
		<div id="main">
			<section id="frmsignup">
				<div class="container_12">
					<h1 align="center">Регистрация новой компании </h1>
					<img src='<?=$baseurl;?>images/step3.png'>
					<?php $this->load->view('forms/frmsignupstep3'); ?>
				</div>
			</section>
		</div>
		<?php $this->load->view('users_interface/footer/footer-nomenu'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.bgiframe.min.js?v=1"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/script.js?v=1"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/contact.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/cufon-yui.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$(".number").keypress(function(e){
			if(e.which!=45 && e.which!=32 && e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
		});
		
		$("#next").click(function(event){
			var err = false;
			$(".inpval").css('border-color','#D0D0D0');
			$(".inpval").each(function(i,element){if($(this).val()===''){$(this).css('border-color','#ff0000');err = true;}});
			if($("#department").val() == 0){err = true;$("#department").css('border-color','#ff0000');}
			if(err){msgerror('Поле не может быть пустым');event.preventDefault();}
			var email = $("#email").val();
			if(email != '' && !email.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){
				msgerror('Не верный формат E-mail');$("#email").css('border-color','#ff0000');$("#email").focus();return false;}
			var pass = $("#password").val();
			var confirm = $("#confirm").val();
			if(pass != '' && pass.length<8){
			msgerror('Короткий пароль! Не менее 8 символов.');$("#password").css('border-color','#ff0000');$("#password").focus();return false;}
			if(pass != '' && confirm != '' && pass != confirm){
				msgerror('Пароли не совпадают');$(".pass").css('border-color','#ff0000');return false;}
			
		});
		function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}});
	</script>
</body>
</html>