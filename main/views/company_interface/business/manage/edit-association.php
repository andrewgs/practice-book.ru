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
					<h1>Business Environment (Бизнес-Среда): Объединения для закупок</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>Темы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
							<?php for($i=0;$i<count($sections);$i++): ?>		
<li><?=anchor('business-environment/associations/'.$userinfo['uconfirmation'].'/section/'.$sections[$i]['asp_id'],$sections[$i]['asp_title'],array('id'=>'link'.$sections[$i]['asp_id']));?></li>
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
								<div class="right-post">
								<?=form_open_multipart($this->uri->uri_string(),array('id'=>'formAddSection','class'=>'formular')); ?>
								<?=validation_errors(); ?>
					<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
									<?=form_error('title');?>
				<input class="edit450-form-input inpv" id="title" maxlength="150" name="title" type="text" value="<?=$topic['ast_title'];?>"/>
									<div class="clear"></div>
									<span class="news-pic">
				<img src="<?=$baseurl;?>associations/viewimage/<?=$topic['ast_id'];?>"class="floated" style="width:74px; height:74px;" alt=""/>
									</span>
					<label class="label-input">Изображение:</label>
									<?=form_error('userfile');?>
					<input class="reg-form-input" type="file" id="userfile" name="userfile" size="30"/>
									<div class="form-reqs" style="margin-left:95px; width:250px;">Поддерживаемые форматы: JPG, GIF, PNG</div>
									<div class="clear"></div>
					<label class="label-input">Цена: <span class="necessarily" title="Поля не можут быть пустыми">*</span> (Пример заполнения: 5000 руб.)</label>
									<?=form_error('price');?>
				<input class="small150-form-input inpv" id="price" maxlength="50" name="price" type="text" value="<?=$topic['ast_price'];?>"/>
									<div class="clear"></div>
					<label class="label-input">Нужно: <span class="necessarily" title="Поля не можут быть пустыми">*</span> (Пример заполнения: 236 шт/20%)</label>
									<?=form_error('must1');?><?=form_error('must2');?><?=form_error('must3');?>
				<input class="small150-form-input inpv" id="must1" maxlength="50" name="must1" type="text" value="<?=$topic['ast_must1'];?>"/>
				<input class="small150-form-input inpv" id="must2" maxlength="50" name="must2" type="text" value="<?=$topic['ast_must2'];?>"/>
				<input class="small150-form-input inpv" id="must3" maxlength="50" name="must3" type="text" value="<?=$topic['ast_must3'];?>"/>
									<div class="clear"></div>
					<label class="label-input">Содержание: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
									<?=form_error('note');?>
			<textarea class="edit700-form-textarea inpv" name="note" id="note" cols="50" rows="10"><?=$topic['ast_note'];?></textarea>
									<div class="clear"></div>
						<input class="btn-action margin-1em" id="editAssociation" type="submit" name="submit" value="Добавить"/>
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
			$("#editAssociation").click(function(event){
				var err = false;
				$(".inpv").css('border-color','#D0D0D0');
				$(".inpv").each(function(i,element){if($(this).val()===''){$(this).css('border-color','#ff0000');err = true;}});
				if(err){
					msgerror("Пропущены обязательные поля!");
					event.preventDefault();
				}
			});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}
		});
</script>
</body>
</html>