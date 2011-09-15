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
	<?php $this->load->view('company_interface/business/header-business'); ?>
		<div id="main" class="silverbg">
			<div class="silvercontent">
				<div class="biznesbanner">
					<a href="#"><img src="<?=$baseurl;?>images/biznesbaner.png" alt="" /></a>
				</div>
				<div class="biznesblock">
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz01.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Обсуждения</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz02.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Вопрос-ответ</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
		<?=anchor('business-environment/question-answer/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz03.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>взаимодеЙствие с Госструктурами</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/interactions/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz04.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Статьи</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
				<?=anchor('business-environment/articles/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz05.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Обмен документами</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/documentation/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz06.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>опрос</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/survey/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
				<?php if(!$envirenment):?>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz07.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Объединения для закупок</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/association/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz08.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Предложения контрагентов</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/offers/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz09.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Новости</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/news/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz10.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Новинки и скидки</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/discounts/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz11.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Кто главный?</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/who-main/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
					<div class="biznesbox lastbiznesbox"><div class="biznesboxbg">
						<div class="biznesphoto"><a href="#"><img src="<?=$baseurl;?>images/biz12.png" alt="" /></a></div>
						<div class="biznestext">
							<h2>Рейтинг</h2>
							<p>В постсоветское время стали рассматривать и другие версии события. Этому способствовало недоверие к советской пропаганде, наличие альтернативных средств борьбы.</p>
							<div class="biznesmore">
			<?=anchor('business-environment/rating/'.$userinfo['uconfirmation'],'<img src="'.$baseurl.'images/vrazdel.png" alt="" />');?>
							</div>
						</div>
					</div></div>
				<?php endif;?>
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