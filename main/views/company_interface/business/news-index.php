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
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
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
					<h1>Business Environment (Бизнес-Среда): Новости</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>Темы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
									<li><?=anchor('business-environment/activity-news/'.$userinfo['uconfirmation'],'Новости отрасли');?></li>
									<li><?=anchor('business-environment/company-news/'.$userinfo['uconfirmation'],'Новости компаний');?></li>
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
								<div class="add_events">
							<?php if($type_news == 'activity-news'):?>
<?=anchor('business-environment/activity-news/'.$userinfo['uconfirmation'].'/create-news','<img src="'.$baseurl.'images/add_news.png" alt="добавить новость"/>',array('title'=>'добавить новость'));?>
							<?php endif; ?>
								<?php if(count($topics)):?>
									<span class="sort">
										Сортировать:
								<?php if($bysort == 'ben_date'):?><strong><?php endif;?>
						<?=anchor('business-environment/'.$type_news.'/'.$userinfo['uconfirmation'].'/sort-date','по дате');?> / 
								<?php if($bysort == 'ben_date'):?></strong><?php endif;?>
								<?php if($bysort == 'ben_views'):?><strong><?php endif;?>
						<?=anchor('business-environment/'.$type_news.'/'.$userinfo['uconfirmation'].'/sort-views','по количеству просмотров');?>
								<?php if($bysort == 'ben_views'):?></strong><?php endif;?>
									</span>
							<?php endif; ?>
								</div>
							<?php for($i=0;$i<count($topics);$i++):?>
								<div class="right-post">
									<span class="news-pic">
			<img src="<?=$baseurl.$type_news;?>/viewimage/<?=$topics[$i]['ben_id'];?>"class="floated" alt="" style="height:74px; width:74px;"/>
									</span>
									<h2><?=$topics[$i]['ben_title'];?></h2>
									<p><?=$topics[$i]['ben_note'];?></p>
									<span class="date"><?=$topics[$i]['ben_date'];?></span>
									<span class="view">просмотров: <?=$topics[$i]['ben_views'];?></span>
									<div class="clear"></div>
									<span class="green">
<?=anchor('business-environment/'.$type_news.'/'.$userinfo['uconfirmation'].'/news/'.$topics[$i]['ben_id'],'читать полностью');?>
<?=anchor('business-environment/'.$type_news.'/'.$userinfo['uconfirmation'].'/news/'.$topics[$i]['ben_id'].'#comments','комментарии ('.$topics[$i]['ben_comments'].')');?>
									</span>
									<div class="clear"></div>
									<div class="right-post-option">
										<table cellspacing="0" class="post-option">
											<tr>
												<td class="right-option">
													<div class="opt-bg">
												<?php if($topics[$i]['ben_userid'] == $userinfo['uid']):?>
														<div class="opt-bgg">
<?=anchor('business-environment/'.$type_news.'/'.$userinfo['uconfirmation'].'/edit-news/'.$topics[$i]['ben_id'],'Редактировать',array('class'=>'first','title'=>'Редактировать'));?>
<?=anchor('business-environment/'.$type_news.'/'.$userinfo['uconfirmation'].'/share-news/'.$topics[$i]['ben_id'],'Поделиться',array('title'=>'Поделиться'));?>
<?=anchor('business-environment/'.$type_news.'/'.$userinfo['uconfirmation'].'/delete-news/'.$topics[$i]['ben_id'],'Удалить',array('title'=>'Удалить'));?>
														</div>
												<?php endif; ?>
													</div>
												</td>
												<td class="right-avtor">
												<?php if($topics[$i]['ben_userid']):?>
													<table cellspacing="0" cellpadding="0">
														<tr>
			<td><img src="<?=$baseurl;?>cravatar/viewimage/<?=$topics[$i]['ben_userid'];?>" alt="" align="left" width="42" height="42"/></td>
			<td><?=$topics[$i]['usubname'].' '.$topics[$i]['uname'].'<br/>'.$topics[$i]['uposition'].'<br/>'.$topics[$i]['cmp_name']?></td>
														</tr>
													</table>
												<?php endif;?>
												</td>
											</tr>
										</table>
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
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			$("#select-category").change(function(){change_category($(this));});
			function change_category(obj){if(obj.val() != 'empty')window.location='<?=$baseurl;?>'+'business-environment/'+obj.val()+'/<?=$userinfo['uconfirmation'];?>';};
		});
</script>
</body>
</html>