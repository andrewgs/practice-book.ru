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
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		span.text{font: bold small-caps 12px/14px sans-serif;margin: 0 5px 0 0;}
		.online{margin-left: 20px;}
		.h150{min-height: 150px;}
		.w918{width: 918px;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
		.ajaxdel{float: right;padding: 5px;margin-right: 50px;cursor: pointer;}
		.manager-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;}
		.federal-skype-icq img{margin:5px 5px 0 10px;cursor: pointer;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
	<?php $this->load->view('manager_interface/header'); ?>
		<div id="main">
			<div class="container_12">
				<div class="grid_12">
					<div class="box">
						<div class="box-header">
							<h2>Федеральный менеджер отрасли</h2>
							<div class="box-search">
								<?=anchor('manager/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
							</div>
						</div>
						<div class="box-content h150 w918">
							<div class="manager-container">
								<img src="<?=$baseurl;?>mavatar/viewimage/<?=$federal['uid'];?>"class="floated" alt=""/>
								<div class="rep-name">
									<?=$federal['uname'].' '.$federal['usubname'].' '.$federal['uthname'];?>
								</div>
								<div class="rep-phone"><span class="text">Тел.:</span><?= $federal['uphone']; ?></div>
								<div class="rep-email"><span class="text">E-mail:</span><?=$federal['uemail']; ?></div>
							<?php if($federal['uskype']): ?>
								<div class="federal-skype-icq">
									<img src="<?=$baseurl;?>images/skype.png" border="0" title="skype" alt=""/>
									<span class="text"><?=$federal['uskype'];?></span>
								</div>
							<?php endif; ?>
							<?php if($federal['uicq']): ?>
								<div class="federal-skype-icq">
									<img src="<?=$baseurl;?>images/icq.png" border="0" title="icq" alt=""/>
									<span class="text"><?=$federal['uicq'];?></span>
								</div>
							<?php endif; ?>
								<div class="clear"></div>
								<?php if($federal['uactive'] and $federal['uid'] != $userinfo['uid']): ?>
								<img src="<?=$baseurl;?>images/online.gif" class="online" border="0" title="Пользователь в сети" alt=""/>
								<?php endif; ?>
							</div>
						</div>
					</div>отрасли
				</div>
				<div class="clear"></div>
					<div class="grid_12">
						<div class="box">
							<div class="box-header">
								<h2>Региональный менеджер отрасли</h2>
								<div class="box-search">
								<?php if($userinfo['priority'] && !isset($manager['uid'])): ?>
									<a class="lnk-submit" id="menSelect">Выбрать менеджера</a>
								<?php endif; ?>
								</div>
							</div>
							<div class="box-content h150 w918">
								<div class="manager-container">
								<?php if(isset($manager['uid'])): ?>
									<img src="<?=$baseurl;?>mavatar/viewimage/<?=$manager['uid'];?>"class="floated" alt=""/>
									<div class="rep-name">
										<?=$manager['uname'].' '.$manager['usubname'].' '.$manager['uthname'];?>
									</div>
									<div class="rep-phone"><span class="text">Тел.:</span><?= $manager['uphone']; ?></div>
									<div class="rep-email"><span class="text">E-mail:</span><?=$manager['uemail']; ?></div>
									<?php if($manager['uskype']): ?>
										<div class="federal-skype-icq">
											<img src="<?=$baseurl;?>images/skype.png" border="0" title="skype" alt=""/>
											<span class="text"><?=$manager['uskype'];?></span>
										</div>
									<?php endif; ?>
									<?php if($manager['uicq']): ?>
										<div class="federal-skype-icq">
											<img src="<?=$baseurl;?>images/icq.png" border="0" title="icq" alt=""/>
											<span class="text"><?=$manager['uicq'];?></span>
										</div>
									<?php endif; ?>
									<?php if($manager['ustatus'] == 'disabled'): ?>
									<input type="image" title="Не активирован" class="ajaxdel" src="<?=$baseurl;?>images/exclamation.png" />
									<?php endif; ?>
									<div class="clear"></div>
									<?php if($manager['uactive'] and $manager['uid'] != $userinfo['uid']): ?>
									<img src="<?=$baseurl;?>images/online.gif" class="online" border="0" title="Пользователь в сети" alt=""/>
									<?php endif; ?>
								<?php else: ?>
									<div id="insertManagerList">
										<div class="rep-name">
											За данным регином закреплен только фередальный менеджер.
										</div>
									</div>
								<?php endif; ?>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('manager_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){$("#lnk-logout").click(function(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){window.setTimeout("window.location='<?= $baseurl; ?>'",1000);}});});
		$("#menSelect").click(function(event){event.preventDefault();})
		$("#select-region").change(function(){change_region($(this));});
		$("#select-activity").change(function(){change_activity($(this));});
		function change_activity(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-region").val() > 0){$("#select-region").after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}
		function change_region(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-activity").val() > 0){obj.after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}
		
		$("#menSelect").click(function(){
			$("#insertManagerList").load("<?=$baseurl;?>views/manager-list/<?=$userinfo['uconfirmation'];?>");
			$("#btnSubmit").live('click',function(){
				var uID = $("input[name='manager']:checked").val();
				if(uID)$("#formSetManager").submit();
				else msgerror("Не выбран менеджер");
			});
		});
		function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;};
		});
	</script>
</body>
</html>