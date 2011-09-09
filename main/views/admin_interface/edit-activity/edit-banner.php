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
	<link rel="stylesheet" href="<?= $baseurl; ?>css/jquery-ui.css?v=1.8.5">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/sexy-combo.css">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/sexy.css">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/custom.css">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/datepicker/jquery.ui.all.css" type="text/css" />
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.h150{min-height: 150px;}
		.w918{width: 918px;}
		.chackForAll{float:right;margin: 10px 10px 0 0;font: normal bold 125% normal;}
		.msgForAll{float:right;margin: 30px -155px 0 0;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('admin_interface/header-nomenu'); ?>
		<div id="main">
			<div class="container_12 framing">
				<div class="grid_12">
					<?= form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
						<div id="formRep" style="margin-top:15px;">
							<div class="box">
								<div class="box-header"><h2 class="special">Баннер:</h2>
									<div class="box-search">
										<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
									</div>
								</div>
								<div class="box-content h150 w918">
								<label class="label-input">Код баннера:</label>
								<textarea class="edit-form-textarea" name="banner" id="banner" cols="40" rows="7"><?=$banner;?></textarea>
									<div class="clear"></div>
									<input class="btn-action margin-1em" id="saveBanner" type="submit" name="submit" value="Сохранить"/>
									<?php if($userinfo['priority']): ?>
										<div class="chackForAll">
									<input type="checkbox" name="all" value="1" id="forAllRegion" title="Отметьте, если нужно показывать баннер на все регионы"> Для всех регионов
										</div>
										<div class="msgForAll fvalid_error" id="msgAllRegion">&nbsp;</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="clear"></div>
						<?= form_close(); ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="push"></div>
		</div>
		<div class="clear"></div>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		$("#forAllRegion").click(function(){
			if(this.checked) $("#msgAllRegion").text("Все баннеры в других регионах будет перезаписаны");
			else $("#msgAllRegion").html("&nbsp;");
		});
	});
	</script>
</body>
</html>