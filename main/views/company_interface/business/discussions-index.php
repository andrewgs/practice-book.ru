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
					<span class="category">Обсуждения</span>
					<h1>Business Environment (Бизнес-Среда)</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>Разделы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
								<?php for($i=0;$i<count($sections);$i++): ?>		
									<li><?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/section/'.$sections[$i]['dsc_id'],$sections[$i]['dsc_title']);?></li>
								<?php endfor; ?>
								</ul>
								<br />
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/create-section','<img src="'.$baseurl.'images/add_events.png" alt="Создать тему"/>',array('title'=>'Создать тему'));?>
							</div>
						</div>
					</div>
				</div>
			<?php if(count($sections)):?>
				<div class="content-right">
					<div class="content-right-top">
						<div class="content-right-bot">
							<div class="right-title">
								<h3><?=$section_name;?></h3>
							</div>
							<div class="right-text">
								<div class="add_events">
									<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/create-discussion','<img src="'.$baseurl.'images/add_events2.png" alt="Создать обсуждение"/>',array('title'=>'Создать обсуждение'));?>
								</div>
							<?php for($i=0;$i<count($topics);$i++):?>
								<div class="right-post">
									<h2><?=$topics[$i]['top_title'];?></h2>
									<span class="date"><?=$topics[$i]['top_date'];?></span>
									<p><?=$topics[$i]['top_note'];?></p>
									<span class="green">
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/discussion/'.$topics[$i]['top_id'],'читать полностью');?>
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/discussion/'.$topics[$i]['top_id'].'/comment','ответить');?>
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/discussion/'.$topics[$i]['top_id'].'#comments','комментарии ('.$topics[$i]['top_comments'].')');?>
									</span>
									<div class="clear">&nbsp;</div>
									<div class="right-post-option">
										<table cellspacing="0" class="post-option">
											<tr>
												<td class="right-option">
													<div class="opt-bg">
												<?php if($topics[$i]['top_usrid'] == $userinfo['uid']):?>
													<div class="opt-bgg">
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/edit-discussion/'.$topics[$i]['top_id'],'Редактировать',array('class'=>'first','title'=>'Редактировать'));?>
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/track-discussion/'.$topics[$i]['top_id'],'Отслеживать',array('title'=>'Отслеживать'));?>
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/share-discussion/'.$topics[$i]['top_id'],'Поделиться',array('title'=>'Поделиться'));?>
<?=anchor('business-environment/discussions/'.$userinfo['uconfirmation'].'/delete-discussion/'.$topics[$i]['top_id'],'Удалить',array('title'=>'Удалить'));?>
														</div>
													<?php endif; ?>
													</div>
												</td>
												<td class="right-avtor">
													<table cellspacing="0" cellpadding="0">
														<tr>
				<td><img src="<?=$baseurl;?>cravatar/viewimage/<?=$topics[$i]['top_usrid'];?>" alt="" align="left" width="42" height="42"/></td>
				<td><?=$topics[$i]['usubname'].' '.$topics[$i]['uname'].' '.$topics[$i]['uposition'].' '.$topics[$i]['cmp_name']?></td>
														</tr>
													</table>
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
			<?php endif; ?>
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