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
	<link rel="stylesheet" href="<?=$baseurl;?>css/new.css">
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
	<?php $this->load->view('company_interface/business/header'); ?>
		<div id="main" class="whitebg">
			<div class="contentblock">
				<div class="content-top">
					<span class="category">вопрос-ответ</span>
					<h1>Business Environment (Бизнес-Среда)</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>Темы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
									<li><a href="#">Продажи</a></li>
									<li><a href="#">Начальство</a></li>
									<li><a href="#">УСНО</a></li>
									<li><a href="#">Клиенты</a></li>
									<li><a href="#">Зарплата</a></li>
									<li><a href="#">Отпуск</a></li>
									<li><a href="#">Конфликты</a></li>
								</ul>
								<br />
								<a href="#" title="Создать тему"><img src="<?=$baseurl;?>images/add_events.png" alt="Создать тему" /></a>
							</div>
						</div>
					</div>
				</div>
				<div class="content-right">
					<div class="content-right-top">
						<div class="content-right-bot">
							<div class="right-title">
								<h3>ВОПРОС-ОТВЕТ</h3>
							</div>
							<div class="right-text">
								<div class="right-post">
									<h2>Как лучше вывести рентабельность продукта?</h2>
									<div class="clear">&nbsp;</div>
									<div class="right-post-option">
										<table cellspacing="0" class="post-option">
											<tr>
												<td class="right-option">
													<div class="opt-bg"><div class="opt-bgg">
														<a class="first" href="#" title="Ответить">Ответить</a>
														<a href="#" title="Отслеживать">Отслеживать</a>
														<a href="#" title="Поделиться">Поделиться</a>
														<a href="#" title="Удалить">Удалить</a>
													</div></div>
												</td>
												<td class="right-avtor">
													<table cellspacing="0" cellpadding="0">
														<tr>
															<td><img src="<?=$baseurl;?>images/avatar3.png" alt="" align="left" /></td>
															<td>Алексей Иванов директор ООО «Дело»</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="right-comment">
									<div class="right-comment-title right-comment-titlenone">
										ответы(28):
									</div>
									<div class="commentblock">
										<div class="right-post-option">
											<table cellspacing="0" class="post-option">
												<tr>
													<td class="right-avtor">
														<table cellspacing="0" cellpadding="0">
															<tr>
																<td><img src="<?=$baseurl;?>images/avatar3.png" alt="" align="left" /></td>
																<td>Алексей Иванов директор ООО «Дело»</td>
															</tr>
														</table>
													</td>
													<td class="date-comment">
														30.08.2011, 18:15
													</td>
												</tr>
											</table>
										</div>
										<div class="commentbox">
											<p>Юридические лица РФ имеют сложную организационно-правовую структуру (директор назначается и может быть сменен собранием учредителей компании, кроме того, не всегда может осуществлять те или иные действия в системе WebMoney и вынужден делегировать их другим лицам). По правилам системы WebMoney обычная регистрация в системе WebMoney осуществляется на конкретное физическое лицо и передача WMID другому лицу запрещена.</p>
											<div class="commentbox-option">
												<a href="#">Ответить</a> <a href="#">Удалить</a>
											</div>
										</div>
									</div>
									<div class="commentblock">
										<div class="right-post-option">
											<table cellspacing="0" class="post-option">
												<tr>
													<td class="right-avtor">
														<table cellspacing="0" cellpadding="0">
															<tr>
																<td><img src="<?=$baseurl;?>images/avatar3.png" alt="" align="left" /></td>
																<td>Алексей Иванов директор ООО «Дело»</td>
															</tr>
														</table>
													</td>
													<td class="date-comment">
														30.08.2011, 18:15
													</td>
												</tr>
											</table>
										</div>
										<div class="commentbox">
											<p>Юридические лица РФ имеют сложную организационно-правовую структуру (директор назначается и может быть сменен собранием учредителей компании, кроме того, не всегда может осуществлять те или иные действия в системе WebMoney и вынужден делегировать их другим лицам). По правилам системы WebMoney обычная регистрация в системе WebMoney осуществляется на конкретное физическое лицо и передача WMID другому лицу запрещена.</p>
										</div>
									</div>
									<div class="commentblock">
										<div class="right-post-option">
											<table cellspacing="0" class="post-option">
												<tr>
													<td class="right-avtor">
														<table cellspacing="0" cellpadding="0">
															<tr>
																<td><img src="<?=$baseurl;?>images/avatar3.png" alt="" align="left" /></td>
																<td>Алексей Иванов директор ООО «Дело»</td>
															</tr>
														</table>
													</td>
													<td class="date-comment">
														30.08.2011, 18:15
													</td>
												</tr>
											</table>
										</div>
										<div class="commentbox">
											<p>Юридические лица РФ имеют сложную организационно-правовую структуру (директор назначается и может быть сменен собранием учредителей компании, кроме того, не всегда может осуществлять те или иные действия в системе WebMoney и вынужден делегировать их другим лицам). По правилам системы WebMoney обычная регистрация в системе WebMoney осуществляется на конкретное физическое лицо и передача WMID другому лицу запрещена.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('company_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script src="<?=$baseurl;?>javascript/plugins.js?v=1"></script>
	<script src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script src="<?=$baseurl;?>javascript/jquery.bgiframe.min.js?v=1"></script>
	<script src="<?=$baseurl;?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script src="<?=$baseurl;?>javascript/cufon-yui.js"></script>
	<script src="<?=$baseurl;?>javascript/myriad-pro.cufonfonts.js"></script>
	<script src="<?=$baseurl;?>javascript/jquery.easing.js"></script>
	<script src="<?=$baseurl;?>javascript/script.js?v=1"></script>
	<!--[if lt IE 7 ]>
	<script src="<?=$baseurl;?>javascript/dd_belatedpng.js?v=1"></script>
	<![endif]-->
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){window.setTimeout("window.location='<?= $baseurl; ?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
		});
</script>
</body>
</html>