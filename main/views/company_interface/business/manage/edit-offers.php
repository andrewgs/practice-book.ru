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
						<h3>Регионы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
									<?php for($i=0;$i<count($regions);$i++): ?>		
<li><?=anchor('business-environment/offers/'.$userinfo['uconfirmation'].'/region/'.$regions[$i]['reg_id'],$regions[$i]['reg_name'],array('id'=>'link'.$regions[$i]['reg_id']));?></li>
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
								<?=form_open_multipart($this->uri->uri_string(),array('id'=>'formAddSection','class'=>'formular')); ?>
					<label class="label-input">Название новости: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
									<?= form_error('title'); ?>
					<input class="edit450-form-input" id="title" maxlength="50" name="title" type="text" value="<?=$topic['oft_title'];?>"/>
									<div class="clear"></div>
									<span class="news-pic">
					<img src="<?=$baseurl;?>offers/viewimage/<?=$topic['oft_id'];?>"class="floated" width="74" height="74" alt=""/>
									</span>
					<label class="label-input">Изображение:</label>
									<?= form_error('userfile'); ?>
					<input class="reg-form-input inpvalue" type="file" id="userfile" name="userfile" size="30"/>
									<div class="form-reqs" style="margin-left:95px; width:250px;">Поддерживаемые форматы: JPG, GIF, PNG</div>
									<div class="clear"></div>
					<label class="label-input">Содержание: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
									<?= form_error('note'); ?>
			<textarea class="edit700-form-textarea" name="note" id="note" cols="50" rows="10"><?=$topic['oft_note'];?></textarea>
									<div class="clear"></div>
						<input class="btn-action margin-1em" id="addDiscussion" type="submit" name="submit" value="Сохранить"/>
								<?= form_close(); ?>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			$("#select-category").change(function(){change_category($(this));});
			$("#link<?=$section_id;?>").addClass("activeTheme");
			function change_category(obj){if(obj.val() != 'empty')window.location='<?=$baseurl;?>'+'business-environment/'+obj.val()+'/<?=$userinfo['uconfirmation'];?>';};
			$("#addDiscussion").click(function(event){
				$("#title").css('border-color','#D0D0D0');
				$("#note").css('border-color','#D0D0D0');
				if($("#title").val() == ''){
					$("#title").css('border-color','#ff0000');
					msgerror("Пропущены обязательные поля!");
					event.preventDefault();
				}
				if($("#note").val() == ''){
					$("#note").css('border-color','#ff0000');
					msgerror("Пропущены обязательные поля!");
					event.preventDefault();
				}
			});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}
		});
</script>
</body>
</html>