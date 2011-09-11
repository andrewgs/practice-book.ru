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
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
	<?php $this->load->view('company_interface/business/header-business'); ?>
		<div id="main">
			<div class="container_12 boxes-bg clearfix">
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Обсуждения</h2></div>
						<h3 class="font-replace">Обсуждения</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
			<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Вопрос-ответ</h2></div>
						<h3 class="font-replace">Вопрос-ответ</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
		<?=anchor('business-environment/question-answer/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Рейтинг</h2></div>
						<h3 class="font-replace">Рейтинг</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
				<?=anchor('business-environment/rating/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Статьи</h2></div>
						<h3 class="font-replace">Статьи</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
			<?=anchor('business-environment/articles/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Обмен документами</h2></div>
						<h3 class="font-replace">Обмен документами</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
		<?=anchor('business-environment/documentation/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Опрос</h2></div>
						<h3 class="font-replace">Опрос</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
				<?=anchor('business-environment/survey/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>			
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Объединения для закупок</h2></div>
						<h3 class="font-replace">Объединения для закупок</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
			<?=anchor('business-environment/association/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Предложения контрагентов</h2></div>
						<h3 class="font-replace">Предложения контрагентов</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
				<?=anchor('business-environment/offers/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Новости</h2></div>
						<h3 class="font-replace">Новости</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
				<?=anchor('business-environment/news/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Новинки и скидки</h2></div>
						<h3 class="font-replace">Новинки и скидки</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
			<?=anchor('business-environment/discounts/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
					</div>
				</div>
				<div class="grid_4">
					<div class="business-nav-box">
						<div class="new-bg"><h2 class="font-replace">Кто главный?</h2></div>
						<h3 class="font-replace">Кто главный?</h3>
						<p class="bnb-description">
							В постсоветское время стали рассматривать и другие версии события. 
							Этому способствовало недоверие к советской пропаганде, наличие 
							альтернативных средств борьбы.
						</p>
			<?=anchor('business-environment/who-main/'.$userinfo['uconfirmation'],'Перейти в раздел &raquo;',array('class'=>'bnb-action'));?>
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
			$("#select-activity").change(function(){change_activity($(this));});
			function change_activity(obj){
				$("#change-activity").remove();
				if(obj.val()>0){
					$("#select-activity").after('<input type="button" class="lnk-submit" id="change-activity" value="ОК"/>');
					$("#change-activity").css({'float':'right','margin': '-1px 10px 2px 5px'});
					$("#change-activity").live('click',function(){$("#ManActData").submit()});}}
		});
</script>
</body>
</html>