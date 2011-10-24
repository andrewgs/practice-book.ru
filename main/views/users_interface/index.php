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
	<link rel="stylesheet" href="<?=$baseurl;?>css/sexy-combo.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/sexy.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/custom.css"> 
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.w575{width: 575px;}
		.h20{min-height: 20px;}
	</style>
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
			<section id="info-advert">
				<div id="slide-browser" class="container_12 clearfix"> 
					<div id="slide-1" class="grid_12 alpha slides">
						<img alt="Три системы Practice Book" src="<?=$baseurl;?>images/slide-1.png" />
						<button id="btn-sign-in" class="btn-user-action registering">Добавить свою компанию в наш каталог</button><br/>
						<button id="btn-sign-in" class="btn-user-action imaging">Начать работу</button>
					</div>
					<div id="slide-2" class="grid_12 alpha slides">
						<img alt="Бизнес-справочник Practice Book" src="<?=$baseurl;?>images/slide-2.png" />
						<button id="btn-sign-in" class="btn-user-action registering">Добавить свою компанию в наш каталог</button><br/>
						<button id="btn-sign-in" class="btn-user-action imaging">Начать работу</button>
					</div>
					<div id="slide-3" class="grid_12 alpha slides">
						<img alt="Бизнес-среда Practice Book" src="<?=$baseurl;?>images/slide-3.png" />
						<button id="btn-sign-in" class="btn-user-action registering">Добавить свою компанию в наш каталог</button><br/>
						<button id="btn-sign-in" class="btn-user-action imaging">Начать работу</button>
					</div>
					<div id="slide-4" class="grid_12 alpha slides">
						<img alt="B2B Practice Book" src="<?=$baseurl;?>images/slide-4.png" />
						<button id="btn-sign-in" class="btn-user-action registering">Добавить свою компанию в наш каталог</button><br/>
						<button id="btn-sign-in" class="btn-user-action imaging">Начать работу</button>
					</div>
				</div>
			</section>
			<div class="container_12">
				<div class="grid_12 alpha omega prelog">
					<div class="text-notation">
						<?=$text;?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div id="support-modal-content">
			<?php $this->load->view('forms/frmsupport'); ?>
		</div>
		<div id="registering-modal-content">
			<?php $this->load->view('forms/frmregvalidcode'); ?>
		</div>
		<?php $this->load->view('users_interface/footer/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script src="<?=$baseurl;?>javascript/jquery.bgiframe.min.js?v=1"></script>
	<script src="<?=$baseurl;?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.cycle.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/cufon-yui.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.easing.js"></script>
	<script src="<?=$baseurl;?>javascript/script.js?v=1"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			<?php if(!$userinfo['status']) $userinfo['status'] = 0;?>
			<?php if(!$userinfo['regstatus']) $userinfo['regstatus'] = 0;?>
			
			var status = <?=$userinfo['status'];?>;
			var regstatus = <?=$userinfo['regstatus'];?>;
			$(".registering").click(function(){
				if(regstatus){location.href='<?=$baseurl;?>registering/step-1';return true;}if(status){msgerror("Вы авторизованый пользователь.<br/>Регистрация невозможна!");return false;}$("#registering-modal-content").modal({containerCss:{height:137}});});
			$("#next").click(function(event){
				var code = $("#code").val();
				if(code == ''){
					$("#code").css('border-color','#ff0000');
					msgerror("Поле не может быть пустым!");
					event.preventDefault()
				}else $("#formValidCode").submit();
			});
			$(".imaging").click(function(){location.href='<?=$baseurl;?>started';});$("#lnk-login").click(function(event){autorized(event);});$("#lnk-logout").click(function(){shotduwn();});$("#select-region").change(function(){change_region($(this));});$("#select-activity").change(function(){change_activity($(this));});function change_activity(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-region").val() > 0){$("#select-region").after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}function change_region(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-activity").val() > 0){obj.after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}function shotduwn(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){$("#loginstatus").load("<?=$baseurl;?>views/logout");status=0;$("#lnk-login").live('click',function(event){autorized(event);});}});};function autorized(event){event.preventDefault();var login = $("#npt-login-name").val();var pass = $("#npt-login-pass").val();if(login === '' || pass === ''){msgerror('Введите логин и пароль');}else if(!login.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){msgerror('Не верный формат E-mail');}else{$.post("<?=$baseurl;?>authorization",{'login':login,'password':pass},function(data){if(data.status){$("#loginstatus").load("<?=$baseurl;?>views/login");status=1;$("#lnk-logout").live('click',function(){shotduwn();});$("#select-region").live('change',function(){change_region($(this));});$("#select-activity").live('change',function(){change_activity($(this));});}else msgerror(data.message);},"json");}};
		
		$("a#Support").click(function(e){
			$("#support-modal-content").modal();
			return false;
		});
		$("#SendSupport").click(function(event){
			var err = false;
			 $("#formRep .inpvalue").css('border-color','#D0D0D0');
			 var name = $("#name").val();
			 var email = $("#email").val();
			 var theme = $("#theme").val();
			 var message = $("#message").val();
			if(name == ''){
				err = true;
				$("#name").css('border-color','#ff0000');
			}
			if(email == ''){
				err = true;
				$("#email").css('border-color','#ff0000');
			}
			if(theme == ''){
				err = true;
				$("#theme").css('border-color','#ff0000');
			}
			if(message == ''){
				err = true;
				$("#message").css('border-color','#ff0000');
			}
			if(err){
				event.preventDefault();
				$("#error").html('<font size="3" color="#FF0000"><b>Пропущены обязательные поля</b></font>');
			}else if(!isValidEmailAddress(email)){
				event.preventDefault();
				$("#error").html('<font size="3" color="#FF0000"><b>Не верный E-mail</b></font>');
			}
		});
		function isValidEmailAddress(emailAddress){
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
		};
		function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000', color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;}
		});
	</script>
	<script>
	  $(function(){
		$('#slide-browser').cycle({
			fx: 'scrollUp',
			speed: '2000',
			easing: 'easeInOutExpo',
			timeout: 14000,
			width: 960,
			fit: 1
		});
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