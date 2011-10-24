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
	<style type="text/css">
		div#centered {border: 1px dotted #FF4500;background-color: white;height: 50%;width: 40%;position: absolute;left: 30%;top: 25%;color: black;vertical-align: middle;padding-top: 40px;font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;font-size: 16px;}
		a {color: #435867;font-weight: bold;font-size: 10px;}
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
					<?php if($logo == "default"): ?>
							<center><img src="<?=$baseurl;?>images/logo.png" vspace="10" border="0"></center>
					<?php else: ?>
					<center><img src="<?=$baseurl;?>/companylogo/viewimage/<?=$cmpid;?>" vspace="10" border="0" alt="<?=$cmpname;?>"/></center>
					<?php endif; ?>
					<br/><br/><b><?= $text; ?></b>
					<?php if($timer): ?>
						<script>
							<?php if($uri): ?>
								window.setTimeout("window.location='<?= $baseurl.$uri;?>'",<?= $timer ?>);
							<?php else: ?>
								window.setTimeout("window.location='<?=$baseurl;?>'",<?= $timer ?>);
							<?php endif; ?>
						</script>
						<br>
						<?php if($uri): ?>
							<br/><br/><font size="2">Через несколько секунд, Вас автоматически<br>перенаправит на предыдущую страницу</font>
						<?php else: ?>
							<br/><br/><font size="2">Через несколько секунд, Вас автоматически<br>перенаправит на главную страницу</font>
						<?php endif; ?>
					<?php endif; ?>
					<br>
					<?php if($uri): ?>
						<a href="<?= $baseurl.$uri; ?>">Переход на предыдущую страницу</a>
					<?php else: ?>
						<a href="<?=$baseurl;?>">Переход на главную страницу</a>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
	</div> <!-- end of #container -->
</body>
</html>