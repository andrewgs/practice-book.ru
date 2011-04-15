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
	<link rel="stylesheet" href="<?= $baseurl; ?>css/validationEngine.css" type="text/css" media="screen" title="no title" charset="utf-8" />
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('users_interface/header/header-noauth'); ?>
		<div id="main">
			<section id="frmsignup">
				<div class="container_12 framing">
					<h1 align="center">Регистрация новой компании </h1>
					<img src='<?= $baseurl; ?>images/step1.png'>
					<?php $this->load->view('forms/frmsignupstep1'); ?>
				</div>
			</section>
		</div>
		<?php $this->load->view('users_interface/footer/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.bgiframe.min.js?v=1"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/script.js?v=1"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.megaselectlist.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.validationEngine.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/contact.js"></script>
</body>
</html>