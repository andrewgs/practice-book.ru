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
					<h1>Business Environment (Бизнес-Среда): Кто главный?</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>Разделы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
								<?php for($i=0;$i<count($regions);$i++): ?>		
<li><?=anchor('business-environment/who-main/'.$userinfo['uconfirmation'].'/region/'.$regions[$i]['reg_id'],$regions[$i]['reg_name']);?></li>
								<?php endfor; ?>
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
								<div class="timeout"><?=$auc_title;?></div>
								<div class="right-post whois">
									<span class="whois-pic"><img src="<?=$baseurl;?>images/whois.png" alt="" /></span>
									<div class="whois-timer">
										<ul class="clock">
											<li id="whois-d"><?=$days;?></li>
											<li id="whois-h"><?=$hours;?></li>
											<li id="whois-m"><?=$minutes;?></li>
										</ul>
										<div class="clear"></div>
										<p><?=$auc_text;?></p>
										<div class="clear"> </div>
									</div>
								</div>
							<?php if(!$auc_close):?>
								<div class="add_events left">
									<a href="#" id="SetParticipate" title="Сделать ставку">Сделать ставку</a>
								</div>
								<div class="clear"></div>
								<div id="FormParticipate" style="display:none;">
									<?=form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
									<hr size="2"/>
						<label class="label-input">Сумма (рубли): <span class="necessarily" title="Поле не может быть пустым">*</span></label>
								<?= form_error('summa'); ?>
						<input class="edit60-form-input" id="summa" maxlength="7" name="summa" type="text" value="<?=set_value('summa');?>">
						<input class="btn-action margin-1em" id="addParticipate" type="submit" name="submit" value="Поставить"/>
						<input class="btn-action margin-1em" id="Cancel" type="button" value="Отменить"/>
									<div class="clear"></div>
									ВНИМАНИЕ: Ставка меньше за предыдущую будет проигнорирована!
									<hr size="2"/>
									<?= form_close(); ?>
								</div>
								<div class="clear"></div>
							<?php else:?>
								<hr size="2"/>
								<h3>ПОБЕДИТЕЛЬ АУКЦИОНА:</h3>
							<?php endif;?>
							<?php for($i=0;$i<count($companylist);$i++):?>
								<div class="right-post whois">
									<?php $number = $this->uri->segment(5)+$i+1;?>
									<?php if($auc_close && $number == 1):?>
									<div class="whois-box" style="border-color:#FF0000;border-style:solid;">
									<?php else:?>
									<div class="whois-box">
									<?php endif;?>
										<div class="current-position leader"><?=$number;?></div>
										<div class="company-info">
											<span class="whois-pic">
							<img src="<?=$baseurl;?>companythumb/viewimage/<?=$companylist[$i]['cmp_id'];?>" alt="" align="left" height="80"/>
											</span>
											<div class="company-title"><?=$companylist[$i]['cmp_name'];?></div>
											<div class="company-address">Юридический адрес: <?=$companylist[$i]['cmp_uraddress'];?></div>
											<div class="company-address">Фактический адрес: <?=$companylist[$i]['cmp_realaddress'];?></div>
											<div class="clear"></div>
										</div>
										<div class="company-rates">
											<div class="company-rating"><?=$companylist[$i]['cmp_rating'];?></div>
											<div class="company-age">Месяцев на сайте: <span><?=$companylist[$i]['months'];?></span></div>
										</div>
										<div class="clear"></div>
										<div class="company-description">
										Направления деятельности: 
										<?php for($j=0;$j<count($companylist[$i]['activity']);$j++):?>
											<?=$companylist[$i]['activity'][$j]['act_title'];?>;
										<?php endfor; ?>
										</div>
										<div class="company-contacts">
										<?php if($companylist[$i]['cmp_site']):?>
		<div class="contact site"><?=anchor($companylist[$i]['cmp_site'],'Сайт компании',array('target'=>'_blank'));?></div>
										<?php endif;?>
		<div class="contact male"><img src="<?=$baseurl;?>images/mail-icon.png" alt=""/><?=$companylist[$i]['cmp_email'];?></div>
		<div class="contact phone"><img src="<?=$baseurl;?>images/phone-icon.png" alt=""/><?=$companylist[$i]['cmp_phone'];?></div>
										</div>
										<div class="clear"> </div>
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
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){window.setTimeout("window.location='<?= $baseurl; ?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			$("#select-category").change(function(){change_category($(this));});
			function change_category(obj){if(obj.val() != 'empty')window.location='<?=$baseurl;?>'+'business-environment/'+obj.val()+'/<?=$userinfo['uconfirmation'];?>';};
			<?php if(!$auc_close): ?>
			$("#summa").keypress(function(e){
				if($(this).val() == '' && e.which == 48) return false;
				if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
			$('#SetParticipate').click(function(){$('#FormParticipate').fadeToggle('slow');$('html, body').animate({scrollTop:'400px'},"slow");$("#count").focus();return false;});
			$("#Cancel").click(function(){$('#FormParticipate').fadeToggle('slow',function(){$("#summa").val('');});$('html, body').animate({scrollTop:'400px'},"slow");});
			$("#addParticipate").click(function(event){$("#summa").css('border-color','#D0D0D0');if($("#summa").val() == ''){$("#summa").css('border-color','#ff0000');msgerror("Пропущены обязательные поля!");event.preventDefault();}});
		<?php endif;?>
		function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}
		});
</script>
</body>
</html>