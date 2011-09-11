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
					<span class="category">статьи</span>
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
								<h3>продажи</h3>
							</div>
							<div class="right-text">
								<div class="add_events">
									<a href="#" title="добавить статью"><img src="<?=$baseurl;?>images/add_article.png" alt="добавить статью" /></a>
									<span class="sort">
										Сортировать: <a href="#">по дате</a> / <a href="#">по количеству просмотров</a>
									</span>
								</div>
								<div class="right-post">
									<h2>"Топ-книга" избавится от непопулярных изданий</h2>
									<span class="date">30.08.2011</span>
									<p>Книготорговая сеть "Топ-книга" 26 сентября закроет все свои магазины, а в начале октября откроет их в новом формате и под другим названием. Количество магазинов сократится с 450 до 350, а сеть будет работать под названием "КнигоМир". Компания оставит только популярную художественную литературу.</p>
									<span class="view">просмотров: 32</span>
									<span class="green"><a href="#">читать полностью</a> <a href="#">комментарии (251)</a></span>
									<div class="clear">&nbsp;</div>
									
									<div class="right-post-option">
										<table cellspacing="0" class="post-option">
											<tr>
												<td class="right-option">
													<div class="opt-bg">
										<a href="#" title="Редактировать"><img src="<?=$baseurl;?>images/edit2.png" alt="Редактировать" /></a>
										<a href="#" title="Отслеживать"><img src="<?=$baseurl;?>images/otsl.png" alt="Отслеживать" /></a>
										<a href="#" title="Поделиться"><img src="<?=$baseurl;?>images/podel.png" alt="Поделиться" /></a>
										<a href="#" title="Удалить"><img src="<?=$baseurl;?>images/delete.png" alt="Удалить" /></a>
													</div>
												</td>
												<td class="right-avtor">
													<table cellspacing="0" cellpadding="0">
														<tr>
															<td><img src="<?=$baseurl;?>images/avatar4.png" alt="" align="left" /></td>
															<td>Олег Литвинов юрисконсульт ООО «Лесторг»</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="right-post">
									<h2>"Евросеть" отказалась открывать новые магазины на Украине</h2>
									<span class="date">30.08.2011</span>
									<p>В отличие от оптовой торговли, товар, купленный в системе розничной торговли, не подлежит дальнейшей перепродаже (согласно действующему законодательству, пункту 1 статьи 492 Гражданского кодекса Российской Федерации), а предназначен для непосредственного использования.<br /> 
			В отличие от оптовой торговли, товар, купленный в системе розничной торговли, не подлежит дальнейшей перепродаже (согласно действующему законодательству, пункту 1 статьи 492 Гражданского кодекса Российской Федерации), а предназначен для непосредственного использования. </p>
									<span class="view">просмотров: 32</span>
									<span class="green"><a href="#">читать полностью</a> <a href="#">комментарии (251)</a></span>
									<div class="clear">&nbsp;</div>
									<div class="right-post-option">
										<table cellspacing="0" class="post-option">
											<tr>
												<td class="right-option">
													<div class="opt-bg">
										<a href="#" title="Комментировать"><img src="<?=$baseurl;?>images/comm.png" alt="Комментировать" /></a>
										<a href="#" title="Отслеживать"><img src="<?=$baseurl;?>images/otsl.png" alt="Отслеживать" /></a>
										<a href="#" title="Поделиться"><img src="<?=$baseurl;?>images/podel.png" alt="Поделиться" /></a>
										<a href="#" title="Удалить"><img src="<?=$baseurl;?>images/delete.png" alt="Удалить" /></a>
													</div>
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