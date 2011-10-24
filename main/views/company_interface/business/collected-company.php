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
					<h1>Business Environment (Бизнес-Среда): Обсуждения</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>ТЕМЫ</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
								<?php for($i=0;$i<count($sections);$i++): ?>		
<li><?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/section/'.$sections[$i]['asp_id'],$sections[$i]['asp_title']);?></li>
								<?php endfor; ?>
								</ul>
								<br />
<?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/create-section','<img src="'.$baseurl.'images/add_events.png" alt="Создать тему"/>',array('title'=>'Создать тему'));?>
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
							<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
								<hr size="2"/>
								<div class="right-post zakup">
									<span class="news-pic">
										<img src="<?=$baseurl;?>associations/viewimage/<?=$topic['ast_id'];?>"class="floated" alt=""/>
									</span>
									<div class="zakup-box">
										<h2><?=$topic['ast_title'];?></h2>
										<span class="date"><?=$topic['ast_date'];?></span>
										<p><?=$topic['ast_note'];?></p>
										<div class="tablebg"><div class="tablebgbg"><div class="tablebgbg2">
											<table cellspacing="0" cellpadding="0" class="table">
											<tr>
												<th class="top-first">цена</th>
												<th class="top-center">собрано</th>
												<th class="top-last" colspan="3">нужно</th>
											</tr>
											<tr>
												<td class="first"><?=$topic['ast_price'];?></td>
												<td class="td2"><?=$topic['ast_apply'];?></td>
												<td class="td3"><?=$topic['ast_must1'];?></td>
												<td class="td4"><?=$topic['ast_must2'];?></td>
												<td class="last"><?=$topic['ast_must3'];?></td>
											</tr>
										</table>
										</div></div></div>
										<span class="green">
									<?php if(!$cmpexist):?>
										<a href="" id="SetPurchase">подать заявку</a>
									<?php endif;?>
<?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/association/'.$topic['ast_id'],'читать полностью');?>
<?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/association/'.$topic['ast_id'].'#comments','комментарии ('.$topic['ast_comments'].')');?>
										</span>
										<div class="clear"></div>
									<?php if(!$cmpexist):?>
										<div id="FormPurchase" style="display:none;">
										<?=form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
							<label class="label-input">Количество: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
									<?= form_error('count'); ?>
							<input class="edit60-form-input" id="count" maxlength="5" name="count" type="text" value="<?=set_value('count');?>">
							<input class="btn-action margin-1em" id="addPurchase" type="submit" name="submit" value="Добавить"/>
							<input class="btn-action margin-1em" id="Cancel" type="button" value="Отменить"/>
										<?= form_close(); ?>
										</div>
										<div class="clear"></div>
									<?php endif;?>
									</div>
									<div class="right-post-option">
										<table cellspacing="0" class="post-option">
											<tr>
												<td class="right-option">
													<div class="opt-bg">
													<?php if($topic['ast_usrid'] == $userinfo['uid'] && $topic['ast_collected'] == 0):?>
														<div class="opt-bgg">
<?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/edit-association/'.$topic['ast_id'],'Редактировать',array('class'=>'first','title'=>'Редактировать'));?>
<?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/delete-association/'.$topic['ast_id'],'Удалить',array('title'=>'Удалить'));?>
														</div>
												<?php endif; ?>
													</div>
												</td>
												<td class="right-avtor">
													<table cellspacing="0" cellpadding="0">
														<tr>
				<td><img src="<?=$baseurl;?>cravatar/viewimage/<?=$topic['ast_usrid'];?>" alt="" align="left" width="42" height="42"/></td>
				<td><?=$topic['usubname'].' '.$topic['uname'].'<br/>'.$topic['uposition'].'<br/>'.$topic['cmp_name']?></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="right-comment">
									<a name="company"></a>
									<div class="right-comment-title">Компаний (<?=$topic['ast_collected'];?>):</div>
								<?php for($i=0;$i<count($companylist);$i++): ?>
									<div class="commentblock">
										<div class="right-post-option">
											<table cellspacing="0" class="post-option">
												<tr>
													<td class="right-avtor">
														<table cellspacing="0" cellpadding="0">
															<tr>
	<td><img src="<?=$baseurl;?>companythumb/viewimage/<?=$companylist[$i]['cll_cmpid'];?>" alt="" align="left" height="42"/></td>
	<td><?=anchor('company-info/'.$companylist[$i]['cll_cmpid'],$companylist[$i]['cll_cmpname'],array('target'=>'_blank')).'<br/>Произвел заказ: '.$companylist[$i]['cll_username'];?><br/>Заказано: <?=$companylist[$i]['cll_count'];?></td>
															</tr>
														</table>
													</td>
													<td class="date-comment"><?=$companylist[$i]['cll_date'];?></td>
												</tr>
											</table>
										</div>
										<div class="commentbox">
										<?php if($companylist[$i]['cll_cmpid'] == $userinfo['cid']):?>
											<div class="commentbox-option">
<?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/association/'.$this->uri->segment(5).'/delete-company/'.$companylist[$i]['cll_id'],'Удалить');?>
											</div>
										<?php endif;?>
										</div>
									</div>
								<?php endfor; ?>
								</div>
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
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			$("#select-category").change(function(){change_category($(this));});
			function change_category(obj){if(obj.val() != 'empty')window.location='<?=$baseurl;?>'+'business-environment/'+obj.val()+'/<?=$userinfo['uconfirmation'];?>';};
		<?php if(!$cmpexist): ?>
			$("#count").keypress(function(e){
				if($(this).val() == '' && e.which == 48) return false;
				if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
			$('#SetPurchase').click(function(){$('#FormPurchase').fadeToggle('slow');$('html, body').animate({scrollTop:'400px'},"slow");$("#count").focus();return false;});
			$("#Cancel").click(function(){$('#FormPurchase').fadeToggle('slow',function(){$("#count").val('');});$('html, body').animate({scrollTop:'400px'},"slow");});
			$("#addPurchase").click(function(event){$("#count").css('border-color','#D0D0D0');if($("#count").val() == ''){$("#count").css('border-color','#ff0000');msgerror("Пропущены обязательные поля!");event.preventDefault();}});
		<?php endif;?>
		function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}
		});
</script>
</body>
</html>