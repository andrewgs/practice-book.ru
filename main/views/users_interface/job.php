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
	<link rel="stylesheet" href="<?=$baseurl;?>css/style.css?v=1">
	<link rel="stylesheet" href="<?=$baseurl;?>css/960.css?v=1">
	<link rel="stylesheet" href="<?=$baseurl;?>css/sexy-combo.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/sexy.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/custom.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/new.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/acc.css">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container" class="main-wrap">
		<?php if($userinfo['status']): ?>
			<?php $this->load->view('users_interface/header/header-login'); ?>
		<?php else: ?>
			<?php $this->load->view('users_interface/header/header-logout'); ?>
		<?php endif; ?>
		<div id="main" class="whitebg">
			<div class="contentblock">
				<div class="work">
					<div class="work-title"><h3>Работа</h3></div>
					<div class="work-text">
						<?=$text;?>
						<div class="accordion">
							<ul class="acc" id="acc">
								<li class="accordionblock">
									<h2><img src="<?=$baseurl;?>images/work01.png" alt="" />как стать консультантом PB?</h2>
									<div class="acc-section"><div class="accordionopen"><div class="accordionopenbg">
										<ul class="listbg">
											<li><table><tr><td class="td"><span>1</span></td><td>Вы регистрируетесь за направлением бизнеса, в котором у Вас есть опыт продаж или  его ведения.</td></tr></table></li>
											<li><table><tr><td class="td"><span>2</span></td><td>Вы проходите проверку на компетентность,ответив на некоторые  вопросы, касающиеся данной отрасли. Тем самым подтверждая свои профессиональные качества и необходимые знания.</td></tr></table></li>
											<li><table><tr><td class="td"><span>3</span></td><td>Все Ваши ответы проверяются специалистами проекта и федеральным руководителем данного направления, по следующим критериям: колличество и  качество информации, необходимое оформление раздела.</td></tr></table></li>
											<li><table><tr><td class="td"><span>4</span></td><td>После проверки Вашей квалификации мы переводим Вас на рабочую версию PB и закрепляем вас на проекте в должности специалиста-консультанта.</td></tr></table></li>
										</ul>
									</div></div></div>
								</li>
								<li class="accordionblock">
									<h2><img src="<?=$baseurl;?>images/work02.png" alt="" />В чем заключается работа?</h2>
									<div class="acc-section"><div class="accordionopen"><div class="accordionopenbg">
										<ul class="listbg">
											<li><table><tr><td class="td"><span>1</span></td><td>Наши дилеры со всех регионов РФ привлекают компании и рекламу в Вашу отрасль. Так же идет привлечение потенциальных клиентов на оказание консультаций по данной тематике.</td></tr></table></li>
											<li><table><tr><td class="td"><span>2</span></td><td>Вы оказываете консультации по поступившим заявкам и получаете пассивный доход от размещенных компаний и рекламы по оговоренным усолвиям. Продолжаете дальше вести профессиональный блог данного направления бизнеса.</td></tr></table></li>
											<li><table><tr><td class="td"><span>3</span></td><td>И все это в свободное от основной работы время. Мы просто конвертируем Ваш накопленный опыт в бизнесе в реальные деньги.</td></tr></table></li>
										</ul>
									</div></div></div>
								</li>
								<li class="accordionblock">
									<h2><img src="<?=$baseurl;?>images/work03.png" alt="" />ЧТО ПРЕДЛАГАЕМ?</h2>
									<div class="acc-section"><div class="accordionopen"><div class="accordionopenbg">
										<div class="title_marg">
											<h3>Теория</h3>
										</div>
										<ul class="listbg">
											<li><table><tr><td class="td"><span>1</span></td><td>Платное консультирование – 40 % (если консультируете Вы)</td></tr></table></li>
											<li><table><tr><td class="td"><span>2</span></td><td>Платное размещение рекламных материалов в вашей подотрасли <br />(если рекламодателя находите Вы) – 30 %</td></tr></table></li>
											<li><table><tr><td class="td"><span>3</span></td><td>Платное размещение рекламных материалов в вашей подотрасли <br />(рекламодатели привлекаются нашими менеджерами) – 10 %</td></tr></table></li>
											<li><table><tr><td class="td"><span>4</span></td><td>Платное размещение компаний в каталоге вашей подотрасли <br />(компании привлекаются нашими менеджерами) – 5 %</td></tr></table></li>
										</ul>
										
										<div class="title_marg">
											<h3>Практика</h3>
										</div>
										<div class="textblock">
											<p>Регион - Россия<br />
											За месяц Вами было обработано минимум 100 заявок <br />
											100 заявок * 300 руб. = 30000 руб. * 0,4 = 12000 руб.<br />
											За месяц (в вашей подотрасли) Вами было размещено минимум 5 рекламных баннеров 240*120 в разных регионах.<br />
											5*10000 руб. = 50000 руб. 0,3 (30%) = 15000<br />
											За месяц (в вашей подотрасли) Нашими менеджерами было размещено минимум 10 рекламных баннеров 240*120 в разных регионах.<br />
											10*10000 руб. = 100000 руб. 0,1 (10%) = 10000<br />
											За месяц в каталоге Вашей подотрасли нашими менеджерами было размещено 20 компаний*<br />
											20 * 2000 руб. = 40000  руб. * 0.05(5%) = 2000 руб.</p>
											<p>Общий ежемесячный доход может составить:<br />
											12000 руб. + 15000 руб. + 10000 руб. + 2000 руб. = 39000 руб.</p>
										</div>
									</div></div></div>
								</li>
								<li class="accordionblock">
									<h2><img src="<?=$baseurl;?>images/work04.png" alt="" />Какие перспективы развития?</h2>
									<div class="acc-section"><div class="accordionopen"><div class="accordionopenbg">
										<ul class="listbg">
											<li><table><tr><td class="td"><span>1</span></td><td>Получение аттестата аккредитации для нашего ресурса позволит выдавать сертификаты соответствия для наших специалистов.</td></tr></table></li>
											<li><table><tr><td class="td"><span>2</span></td><td>Выдача сертификата соответствия всем зарекомендовавшим себя  специалистам, подтверждающим их высокий уровень профессионального развития</td></tr></table></li>
											<li><table><tr><td class="td"><span>3</span></td><td>Создание территориально-распределенной автоматизированной экспертной системы для экспертизы и оценки эффективности различных проектов (экология, энергетика, социальная сфера, лесные пожары… и т.д.). Региональные администрации нуждаются в  такой экспертной системы для обоснования своих проектов</td></tr></table></li>
											<li><table><tr><td class="td"><span>4</span></td><td>Активное участие наших проверенных специалистов в территориально-распределенной автоматизированной экспертной системе.</td></tr></table></li>
										</ul>
									</div></div></div>
								</li>
								<li class="accordionblock">
									<h2><img src="<?=$baseurl;?>images/work05.png" alt="" />когда требуется?</h2>
									<div class="acc-section"><div class="accordionopen"><div class="accordionopenbg">
										<div class="textblock">
											<p>Данная работа не имеет территориальной привязки, заполнение блоков может происходить в любое время, как  свободное, так и  рабочее. Консультирование осуществляется посредством специальной формы сайта, если Вам поступила заявка на консультирование,  Вы тут же будете получать уведомление на свой телефон. Единственное, что от Вас требуется быть профессионалом в своем деле.</p>
										</div>
									</div></div></div>
								</li>
								<li class="accordionblock">
									<h2><img src="<?=$baseurl;?>images/work06.png" alt="" />Что не требуется?</h2>
									<div class="acc-section"><div class="accordionopen"><div class="accordionopenbg">
										<ul class="listbg">
											<li><table><tr><td class="td"><span>1</span></td><td>Делать денежные взносы для участия в проекте.</td></tr></table></li>
											<li><table><tr><td class="td"><span>2</span></td><td>Привлекать знакомых, родственников, друзей, людей и т.д.</td></tr></table></li>
											<li><table><tr><td class="td"><span>3</span></td><td>Что либо покупать или продавать.</td></tr></table></li>
										</ul>
									</div></div></div>
								</li>
							</ul>
						</div>
					</div>
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
<script type="text/javascript" src="<?=$baseurl;?>javascript/linkedselect.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/cufon-yui.js"></script>
<script type="text/javascript" src="<?= $baseurl; ?>javascript/script.js?v=1"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/script2.js"></script> 	
<!--LiveInternet counter--><script type="text/javascript"><!--
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random();//--></script><!--/LiveInternet-->
 
<script type="text/javascript"> 
	var parentAccordion=new TINY.accordion.slider("parentAccordion");
	parentAccordion.init("acc","h2",false,40000000,"acc-selected");
</script> 

	<script type="text/javascript">
		$(document).ready(function(){$(".btn-user-action").click(function(){location.href='<?= $baseurl; ?>registering/step-1';});$(".imaging").click(function(){location.href='<?= $baseurl; ?>begin-work';});$("#lnk-login").click(function(event){autorized(event);});$("#lnk-logout").click(function(){shotduwn();});$("#select-region").change(function(){change_region($(this));});$("#select-activity").change(function(){change_activity($(this));});function change_activity(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-region").val() > 0){$("#select-region").after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}function change_region(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-activity").val() > 0){obj.after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}function shotduwn(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){$("#loginstatus").load("<?= $baseurl; ?>views/logout");$("#lnk-login").live('click',function(event){autorized(event);});}});};function autorized(event){event.preventDefault();var login = $("#npt-login-name").val();var pass = $("#npt-login-pass").val();if(login === '' || pass === ''){msgerror('Введите логин и пароль');}else if(!login.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){msgerror('Не верный формат E-mail');}else{$.post("<?= $baseurl; ?>authorization",{'login':login,'password':pass},function(data){if(data.status){$("#loginstatus").load("<?= $baseurl; ?>views/login");$("#lnk-logout").live('click',function(){shotduwn();});$("#select-region").live('change',function(){change_region($(this));});$("#select-activity").live('change',function(){change_activity($(this));});}else msgerror(data.message);},"json");}};function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000', color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;}$("a#Support").click(function(e){
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
		};});
	</script>
<!--[if lt IE 7 ]>
	<script src="<?=$baseurl;?>javascript/dd_belatedpng.js?v=1"></script>
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