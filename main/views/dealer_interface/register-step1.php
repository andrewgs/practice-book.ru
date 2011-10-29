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
	<link rel="stylesheet" href="<?=$baseurl;?>css/admin.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/chosen.css" />
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('dealer_interface/header-nomenu'); ?>
		<div id="main">
			<section id="frmlogin"><br/>
				<div class="container_12">
					<h1 align="center">Регистрация новой компании </h1>
					<img src='<?=$baseurl;?>images/step1.png'>
					<?php $this->load->view('forms/frmsignupstep1'); ?>
				</div>
			</section>
		</div>
	</div><!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/chosen.jquery.js" ></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$(".number").keypress(function(e){
			if(e.which!=45 && e.which!=32 && e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
		});
		
		$("#btnReturn").click(function(){
			window.location="<?=$baseurl;?>dealer/control-panel/<?=$userinfo['uconfirmation'];?>";
		});
		$("#regions").chosen();
		$("#next").click(function(event){
			var err = false;
			$(".inpval").css('border-color','#D0D0D0');
			$("#fax").css('border-color','#D0D0D0');
			$(".inpval").each(function(i,element){if($(this).val()===''){$(this).css('border-color','#ff0000');err = true;}});
			if($("#regions").val() == 0){err = true;$("#regions").css('border-color','#ff0000');}
			if(err){msgerror('Поле не может быть пустым');event.preventDefault();}
			var email = $("#email").val();
			if(email != '' && !email.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){
				msgerror('Не верный формат E-mail');$("#email").css('border-color','#ff0000');$("#email").focus();return false;}
			var phone = $("#phone").val();
			if(phone != '' && phone.length<7){
				msgerror('Не верный телефонный номер');$("#phone").css('border-color','#ff0000');$("#phone").focus();return false;}
			var fax = $("#fax").val();
			if(fax != '' && fax.length<7){
				msgerror('Не верный номер факса');$("#fax").css('border-color','#ff0000');$("#fax").focus();return false;}
				
		});
		function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}});
	</script>
</body>
</html>