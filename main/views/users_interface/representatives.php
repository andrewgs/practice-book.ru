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
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.rep-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;border-top: 2px solid #D0D0D0;border-bottom: 2px solid #D0D0D0;}
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 10px 10px 0;}
		.w918{width: 918px;}
		.manager-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;}
		.online{margin-left: 20px;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('users_interface/header/header-noauth'); ?>
		<div id="main">
			<div class="container_12 framing">
				<div class="grid_12">
				
					<div class="box">
						<div class="box-header w918">
							<h2>Представители компании</h2>
							<div class="box-search">
							<?=anchor('company-info/'.$company['cmp_id'],'Вернуться назад',array('class'=>'lnk-submit'));?>
							</div>
						</div>
						<div class="box-content">
							<div class="manager-container">
							<?php for($i = 0; $i <count($representative); $i++):?>
								<img src="<?=$baseurl;?>cravatar/viewimage/<?=$representative[$i]['uid'];?>" class="floated" alt=""/>
								<div class="rep-name">
									<?=$representative[$i]['uname'].' '.$representative[$i]['usubname'].' '.$representative[$i]['uthname'];?>
								</div>
								<div class="rep-phone"><span class="text">Тел.:</span><?= $representative[$i]['uphone']; ?></div>
								<div class="rep-email"><span class="text">E-mail:</span><?=$representative[$i]['uemail']; ?></div>
								<div class="rep-posiotion"><span class="text">Должность:</span><?=$representative[$i]['uposition']; ?></div>
								<div class="clear"></div>
								<?php if($representative[$i]['uactive']): ?>
									<img src="<?=$baseurl;?>images/online.gif" class="online" border="0" title="Пользователь в сети" alt=""/>
									<div class="clear"></div>
								<?php endif; ?>
							<?php endfor; ?>
							</div>
						</div>
						<div class="box-bottom-links h20">&nbsp;</div>
					</div>
				</div>
			</div>
			<div class="push"></div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('users_interface/footer/footer-nomenu'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
</body>
</html>