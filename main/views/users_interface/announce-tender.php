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
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/style.css?v=1">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/960.css?v=1">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/jquery-ui.css?v=1.8.5">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/sexy-combo.css">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/sexy.css">
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/custom.css">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<link rel="stylesheet" href="<?=$baseurl;?>css/datepicker/jquery.ui.all.css" type="text/css" />
	<style type="text/css">
		.h20{min-height: 20px;}
		.nshNote{margin-bottom: 10px;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
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
			<div class="container_12">
				<div class="grid_12">
				<?= form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
					<div class="box">
						<div class="box-header w940">
							<h2>Для объявления тендера заполните форму и выберите учасников тендера</h2>
							<div class="box-search">
								<?php $link = 'activity-information/region/'.$this->uri->segment(3).'/activity/'.$this->uri->segment(5); ?>
								<?=anchor($link,'Вернуться назад',array('class'=>'lnk-submit'));?>
							</div>	
						</div>
						<div class="box-content-nolimit">
							
							<div class="grid_8">
								Тема <span class="necessarily" title="Обязательно нужно указать">*</span>
								<?= form_error('theme'); ?>
			<input class="edit-form-input inputValid" id="theme" name="theme" type="text" value="<?=set_value('theme');?>" maxlength="200"/>
								Описание <span class="necessarily" title="Обязательно нужно указать">*</span>
								<?= form_error('note'); ?>
			<textarea class="edit600-form-textarea inputValid" name="note" id="note" cols="25" rows="6"><?=set_value('note');?></textarea>
							</div>
							<div class="grid_3">
								Сумма контракта (тыс.руб.) <span class="necessarily" title="Обязательно нужно указать">*</span><br/>
								<?= form_error('summa'); ?>
			<input class="small100-form-input inputValid" type="text" id="summa" name="summa" value="<?=set_value('summa');?>" maxlength="10"/>
								<div class="clear"></div>
								Дата окончания тендера <span class="necessarily" title="Обязательно нужно указать">*</span><br/>
								<?= form_error('dateover'); ?>
<input class="date-form-input inputValid" type="text" id="dateover" name="dateover" value="<?=set_value('dateover');?>" readonly="readonly"/>
								<div class="clear"></div>
 								Форма оплаты <span class="necessarily" title="Обязательно нужно указать">*</span><br/>
								<?= form_error('payment'); ?>
	<input class="small200-form-input inputValid" type="text" id="payment" name="payment" value="<?=set_value('payment');?>" maxlength="100"/>
								<div class="clear"></div>
 								Срок выполнения работ<br/>
						<input class="small200-form-input" type="text" id="time" name="time" value="<?=set_value('time');?>" maxlength="100"/>
							</div>
							<div class="clear"></div>
							<div class="grid_12">
								Дополнительная информация<br/>
						<textarea class="edit600-form-textarea" name="info" id="info" cols="25" rows="3"><?=set_value('info');?></textarea>
							</div>
							<div class="clear"></div>
							<hr size="2px"/>
						<?php if(count($company)):?>
							<div class="box">
								<div class="box-header w358">
									Список компаний
									<div class="box-search" style="margin-top: -5px;">
										<button id="checkAll" title="Выбать все компании">
											<img src="<?=$baseurl;?>images/tick.png" style="margin-top:3px;">
										</button>
										<button id="checkNone" title="Отменить выбор">
											<img src="<?=$baseurl;?>images/tick-red.png" style="margin-top:3px;">
										</button>							
									</div>
								</div>
								<div class="box-content">
								<?php for($i=0;$i<count($company);$i++):?>
									<div class="content-separator">
										<div class="floated">
											<img src="<?=$baseurl;?>companythumb/viewimage/<?=$company[$i]['cmp_id'];?>" alt=""/>
											<div class="company-rate">авторитет: <?=$company[$i]['cmp_rating'];?></div>
										<?php if($company[$i]['cmp_graph'] <= $low_rating): ?>
										<div class="company-rate-bad" style="width:<?=$company[$i]['cmp_graph'];?>px;">&nbsp;</div>
										<?php else: ?>
										<div class="company-rate-graph" style="width:<?=$company[$i]['cmp_graph'];?>px;">&nbsp;</div>
										<?php endif; ?>
										</div>
										<div class="nsh-title">
	<input type="checkbox" name="cmp[]" checked="cheched" class="selectCompany" value="<?=$company[$i]['cmp_id'];?>"<?=set_checkbox('cmp[]',$company[$i]['cmp_id']);?>/>
											<?=$company[$i]['cmp_name'];?>
										</div>
										<div class="nshNote"><?=$company[$i]['cmp_description'];?></div>
										<div class="clear"></div>
									</div>
								<?php endfor; ?>
								</div>
								<div class="box-bottom-links h20">
									&nbsp;
									<div class="clear"></div>
								</div>
							</div>
							<div class="clear"></div>
							<hr size="2px"/>
							<input class="btn-action margin-1em" type="submit" id="btnSubmit" name="submit" value="Объявить тендер"/>
						<?php else: ?>
							<div class="grid_12">
								<br/><br/><b>Нет участников тендера.<br/> Объявить тендер не возможно.</b><br/><br/>
							</div>
						<?php endif; ?>
						</div>
						<div class="box-bottom-links h20">				
							<div class="clear"></div>
						</div>
					</div>
				<?= form_close(); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('users_interface/footer/footer-nomenu'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.bgiframe-2.1.1.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker-ru.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#dateover").datepicker($.datepicker.regional['ru']);
			
			$("#checkAll").click(function(event){
				event.preventDefault();
				$(".selectCompany").attr("checked","checked");
			});
			
			$("#checkNone").click(function(event){
				event.preventDefault();
				$(".selectCompany").removeAttr("checked");
			});
			
			$("#btnSubmit").click(function(event){
				var err = false;
				$(".inputValid").css('border-color','#D0D0D0');
				if(!$(".selectCompany").is(":checked")){
					event.preventDefault();
					msgerror('Не указаны участники тендера');
					return false;
				}
				$(".inputValid").each(function(i,element){
					if($(this).val()===''){
						$(this).css('border-color','#ff0000');
					err = true;}
				});
				if(err){
					event.preventDefault();
					msgerror('Пропущены обязательные поля');
				}
			});
			
			function msgerror(msg){
				$.blockUI({
					message: msg,
					css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}
				});
				window.setTimeout($.unblockUI,1000);
				return false;
			}
		});
	</script>
<!--[if lt IE 7 ]>
	<script src="<?=$baseurl;?>javascript/dd_belatedpng.js?v=1"></script>
<![endif]-->

<!--
	<script src="<?=$baseurl;?>javascript/profiling/yahoo-profiling.min.js?v=1"></script>
	<script src="<?=$baseurl;?>javascript/profiling/config.js?v=1"></script>
<script>
	var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']]; 
	(function(d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.async = true; g.src = '//www.google-analytics.com/ga.js'; s.parentNode.insertBefore(g, s);
	})(document, 'script');
</script>
-->
</body>
</html>