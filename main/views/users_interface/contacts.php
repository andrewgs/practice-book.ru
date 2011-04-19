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
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.accordion {
			width: 940px;
			border-bottom: solid 1px #c4c4c4;
		}
		.accordion h3 {
			background: #e9e7e7 url(<?=$baseurl;?>images/arrow-square.gif) no-repeat right -51px;
			padding: 7px 15px;
			margin: 0;
			font: bold 120%/100% Arial, Helvetica, sans-serif;
			border: solid 1px #c4c4c4;
			border-bottom: none;
			cursor: pointer;
		}
		.accordion h3:hover {
			background-color: #e3e2e2;
		}
		.accordion h3.active {
			background-position: right 5px;
		}
		.accordion .accordion-content {
			background: #f7f7f7;
			margin: 0px auto;
			padding:  10px 15px 20px;
			border-left: solid 1px #c4c4c4;
			border-right: solid 1px #c4c4c4;
		}
		.loadData{
			margin: 10px 520px 0px 420px;
		}
		.federal-container{
			font: bold italic 125% serif;
			margin: 10px 0 10px 0;
			padding: 5px 0 5px 0;
			border-top: 2px solid #D0D0D0;
			border-bottom: 2px solid #D0D0D0;
		}
		.single-federal{
			height:150px;
		}
		.single-regional{
			width: 320px;
		}
		.manager-container{
			font: bold italic 125% serif;
			margin: 10px 0 10px 0;
			padding: 5px 0 5px 0;
			border-top: 2px solid #D0D0D0;
			border-bottom: 2px solid #D0D0D0;
		}
		.multi-federals{
			margin: 10px 0 10px 0;
			border-top: 2px dashed #D0D0D0;
		}
		.federal-region{
			font: normal small-caps 14px/16px fantasy;
			margin: 10px 0 5px 0;
		}
		span.text{
			font: normal small-caps 14px/16px fantasy;
			margin: 0 10px 10px 0;
		}
		.federal-skype-icq img{
			margin:5px 5px 0 10px;
			cursor: pointer;
		}
		.online{
			position:relative;
			left: 25px;
		}
		.activityLink{
			
		}
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
			<div class="container_12 framing">
				<div class="grid_12">
					<h1 align="center">На данной странице Вы можете ознакомится с полным списком отрослей<br/> и получить подробную информацию о сотрудниках нашей компании</h1>
					
					<div class="accordion">
						<?php for($i = 0;$i < count($activitylist); $i++): ?>
						<h3 aSelect="<?= $activitylist[$i]['act_id']; ?>" cLoad="0">
							&diams;&nbsp;&nbsp;<?= $activitylist[$i]['act_fulltitle']; ?>
						</h3> 
						<div class="accordion-content">&nbsp;</div>
						<?php endfor; ?>
					</div> 
					
					
					<!--<div class="content-separator">
						<img class="floated" src=""><strong></strong>
						<a title="Отправить личное сообщение менеджеру" href="#" ><img src="<?= $baseurl; ?>images/email.png" /></a>
						тел.:<br>e-mail:<br>
						<div style="clear:both"></div>
					</div>-->
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div id="support-modal-content">
			<?php $this->load->view('forms/frmsupport'); ?>
		</div>
		<?php $this->load->view('users_interface/footer/footer'); ?>
	</div> <!-- end of #container -->
<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script src="<?= $baseurl; ?>javascript/jquery.bgiframe.min.js?v=1"></script>
	<script src="<?= $baseurl; ?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script src="<?= $baseurl; ?>javascript/script.js?v=1"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-login").click(function(event){autorized(event);});
			$("#lnk-logout").click(function(){shotduwn();});
			$("#select-region").change(function(){change_region($(this));});
			$("#select-activity").change(function(){change_activity($(this));});
			
			$(".accordion h3:first").addClass("active");
			$(".accordion .accordion-content").hide();
			$(".accordion h3").click(function(){
				$(this).next(".accordion-content").slideToggle("slow").siblings(".accordion-content:visible").slideUp("slow");
				$(this).toggleClass("active");$(this).siblings("h3").removeClass("active");
				var actLoad = $(this).attr("cLoad");
				if(parseInt(actLoad) == 0){
					$(this).attr("cLoad","1");
					var actVal = $(this).attr("aSelect");
					$(this).next(".accordion-content").html('<img id="loading" class="loadData" src="<?=$baseurl;?>images/loading.gif"/>');
					$(this).next(".accordion-content").load("<?=$baseurl;?>show/contact/"+actVal,
						{'activity':actVal},
						function(){
//							alert("Данные загружены");
						});
				}
			});
			
			function change_activity(obj){
				$("#change-region").remove();
				if(obj.val() > 0 && $("#select-region").val() > 0){
					$("#select-region").after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');
					$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});
					$("#change-region").live('click',function(){$("#ManActData").submit()});
				}	
			}
			
			function change_region(obj){
				$("#change-region").remove();
					if(obj.val() > 0 && $("#select-activity").val() > 0){
						obj.after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');
						$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});
						$("#change-region").live('click',function(){$("#ManActData").submit()});
					}
			}
				
			function shotduwn(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){$("#loginstatus").load("<?= $baseurl; ?>views/logout");$("#lnk-login").live('click',function(event){autorized(event);});}});};
				
			function autorized(event){event.preventDefault();var login = $("#npt-login-name").val();var pass = $("#npt-login-pass").val();if(login === '' || pass === ''){msgerror('Введите логин и пароль');}else if(!login.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){msgerror('Не верный формат E-mail');}else{$.post("<?= $baseurl; ?>authorization",{'login':login,'password':pass},function(data){if(data.status){$("#loginstatus").load("<?= $baseurl; ?>views/login");$("#lnk-logout").live('click',function(){shotduwn();});$("#select-region").live('change',function(){change_region($(this));});}else msgerror(data.message);},"json");}};
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