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
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		div#centered {
			border: 1px dotted #FF4500;
			background-color: white;
			height: 50%;
			width: 40%;
			position: absolute;
			left: 30%;
			top: 25%;
			color: black;
			vertical-align: middle;
			padding-top: 40px;
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 16px;
		}
		a {
			color: #435867;
			font-weight: bold;
			font-size: 10px;
		}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<div id="main">
			<div id="centered">
				<div style="text-align: center;">
					<center><img src="<?= $baseurl; ?>/images/logo.png" vspace="10" border="0"></center><br><br>
					<b>Ошибка при выполнении скрипта</b><br>
					<br>
					<b>Поробуйте выполнить последние действие заново. Приносим свои извенения.</b>
					<br>
					<a href="/">Переход на главную страницу</a>
				</div>
			</div>
		</div>
	</div> <!-- end of #container -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
</body>
</html>