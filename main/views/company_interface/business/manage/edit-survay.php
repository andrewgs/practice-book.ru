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
	<style type="text/css">
		#btnDelSurvay{display: none;}
	</style>
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
					<h1>Business Environment (Бизнес-Среда): Опрос</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>ТЕМЫ</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
								<?php for($i=0;$i<count($sections);$i++): ?>		
									<li><?=anchor('business-environment/surveys/'.$userinfo['uconfirmation'].'/section/'.$sections[$i]['sur_id'],$sections[$i]['sur_title']);?></li>
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
							<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
								<hr size="2"/>
								<div class="right-post">
								<?=form_open($this->uri->uri_string(),array('id'=>'formAddSection','class'=>'formular')); ?>
					<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
									<?= form_error('title'); ?>
					<textarea class="edit700-form-textarea" name="title" id="title" cols="50" rows="1"><?=$topic['stp_title'];?></textarea>
									<div class="clear"></div>
									<input class="btn-action margin-1em" id="addSurvay" type="submit" name="submit" value="Сохранить"/>
								<?= form_close(); ?>
									<hr size="2px"/>
									<h2>Варианты ответов</h2>
									<div id="exp">
										<div list="Survay">
										<?php for($i=0;$i<count($vote);$i++):?>
											<label class="label-input left w100">Текст ответа</label>
<input class="edit450-form-input surval" id="inp<?=$i;?>" vtid="<?=$vote[$i]['vt_id'];?>" name="sur[]" type="text" maxlength="100" value="<?=$vote[$i]['vt_title'];?>"/>
			<input type="image" title="Сохранить" class="ajaxsave" id="save<?=$i;?>" SUR="<?=$i;?>" src="<?=$baseurl;?>images/save.png"/>
											<div class="clear"></div>
										<?php endfor;?>
										</div>
									</div>
									<hr size="2px"/>
								</div>
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
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.maxlength-min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			$("#select-category").change(function(){change_category($(this));});
			function change_category(obj){if(obj.val() != 'empty')window.location='<?=$baseurl;?>'+'business-environment/'+obj.val()+'/<?=$userinfo['uconfirmation'];?>';};
			$("#addSurvay").click(function(event){$("#title").css('border-color','#D0D0D0');if($("#title").val() == ''){$("#title").css('border-color','#ff0000');msgerror("Пропущены обязательные поля!");event.preventDefault();};});
			$(".ajaxsave").click(function(){var SUR = $(this).attr('SUR');var btnID = this.id;var txtObj = $("#inp"+SUR);$(txtObj).css('border-color','#D0D0D0');var inputVal = $(txtObj).val();var avtID = txtObj.attr('vtid');if(inputVal == ""){msgerror('Поле не может быть пустым');txtObj.css('border-color','#ff0000');txtObj.focus();}else{$.ajax({url:"<?=$baseurl;?>business-environment/surveys/<?=$userinfo['uconfirmation'];?>/save-vote",type: "POST",data: ({id:avtID,value:inputVal,stp:<?=$topic['stp_id'];?>}),dataType: "JSON",beforeSend: function(){$("#"+btnID).hide();$("#"+btnID).after('<img id="loading" src="<?=$baseurl;?>images/progress.gif"/>');},success: function(data){if(data.status){txtObj.css('border-color','#00ff00');$('#d'+btnID).text(data.retvalue);}else{msgerror(data.message);txtObj.css('border-color','#ff0000');}$("#"+btnID).show();$("#loading").remove();},error: function(){$("#"+btnID).show();$("#loading").remove();txtObj.css('border-color','#ff0000');msgerror("Ошибка при сохранении!");}})}});
			$('#title').maxlength({maxCharacters:400,status:true,statusClass:"lenghtstatus",statusText:" символов осталось.",notificationClass:"lenghtnotifi",slider:true});
			$("#btnAddSurvay").click(function(){var lastObj = $("div[list='Survay']:last");$(lastObj).after('<div list="Survay"></div>');lastObj = $("div[list='Survay']:last");$(lastObj).load("<?=$baseurl;?>views/survey-list/<?=$userinfo['uconfirmation'];?>",function(){var cnt = $("div[list='Survay']").size();if(cnt > 1) $("#btnDelSurvay").show();if(cnt >= 9) $("#btnAddSurvay").hide();});});
			$("#btnDelSurvay").click(function(){$("div[list='Survay']:last").remove();var cnt = $("div[list='Survay']").size();if(cnt <= 1) $("#btnDelSurvay").hide();if(cnt <= 9) $("#btnAddSurvay").show()});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}
		});
</script>
</body>
</html>