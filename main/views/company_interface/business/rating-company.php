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
					<span class="category"><?php $this->load->view('company_interface/business/choise-category'); ?></span>
					<h1>Business Environment (Бизнес-Среда): Рейтинг</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>Разделы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
								<li><?=anchor('business-environment/rating-representatives/'.$userinfo['uconfirmation'],'Сотрудники');?></li>
								<li><?=anchor('business-environment/rating-company/'.$userinfo['uconfirmation'],'Компании');?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="content-right">
					<div class="content-right-top">
						<div class="content-right-bot">
							<div class="right-title">
								<h3><?=$section_name;?></h3>
							</div>
							<div class="right-text">
								<div class="add_events add_marg">
										<?php if(count($topics)):?>
									<span class="sort sortleft">
										Сортировать:
								<?php if($bysort == 'rating'):?><strong><?php endif;?>
				<?=anchor('business-environment/'.$type_rating.'/'.$userinfo['uconfirmation'].'/sort-rating','по рейтингу');?> / 
								<?php if($bysort == 'rating'):?></strong><?php endif;?>
								<?php if($bysort == 'cmp_name'):?><strong><?php endif;?>
				<?=anchor('business-environment/'.$type_rating.'/'.$userinfo['uconfirmation'].'/sort-cmpname','по компании');?>
								<?php if($bysort == 'cmp_name'):?></strong><?php endif;?>
									</span>
							<?php endif; ?>
									<div class="searchblock">
										<div class="searchtext">
											<input type="text" name="" />
										</div>
										<div class="searchsubmit">
											<input type="image" src="<?=$baseurl;?>images/searchsubmit.png" name="" />
										</div>
									</div>
								</div>
							<?php for($i=0;$i<count($topics);$i++):?>
								<div class="rtdblock">
									<div class="rtblockbg">
										<div class="rtdblockwrap">
											<span class="rtd-num"><?=$this->uri->segment(5)+$i+1;?></span>
											<span class="news-pic">
						<img src="<?=$baseurl;?>companythumb/viewimage/<?=$topics[$i]['cmp_id'];?>" alt="" align="left" width="74" height="74"/>
											</span>
											<div class="rtd-autor-info">
												<h3><?=$topics[$i]['cmp_name'];?></h3>
												<span>Юридический адрес: <?=$topics[$i]['cmp_uraddress'];?><br/>
													Фактический адрес: <?=$topics[$i]['cmp_realaddress'];?><br/>
												</span>
											</div>
											<div class="rtd-info">
												<div class="green">Рейтинг: <span><?=$topics[$i]['cmp_rating'];?></span></div>
												<div class="silver">Месяцев на сайте: <span><?=$topics[$i]['months'];?></span></div>
											</div>
											<div class="clear">&nbsp;</div>
											<div class="rtd-text">
												<p><?=$topics[$i]['cmp_description'];?></p>
											</div>
											<div class="clear">&nbsp;</div>
											<div class="rtd-contact">
							<span class="site"><?=anchor($topics[$i]['cmp_site'],$topics[$i]['cmp_site'],array('target'=>'_blank'));?></span>
												<span class="mail"><?=$topics[$i]['cmp_email'];?></span>
												<span class="phone"><?=$topics[$i]['cmp_phone'];?></span>
											</div>
										</div>
									</div>
								</div>
							<?php endfor; ?>
							<?php if($pages): ?>
								<?=$pages;?>
							<?php endif;?>
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
			$("#select-category").change(function(){change_category($(this));});
			function change_category(obj){if(obj.val() != 'empty')window.location='<?=$baseurl;?>'+'business-environment/'+obj.val()+'/<?=$userinfo['uconfirmation'];?>';};
		});
</script>
</body>
</html>