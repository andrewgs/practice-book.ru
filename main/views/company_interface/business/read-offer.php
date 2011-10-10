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
					<h1>Business Environment (Бизнес-Среда): Предложения контрагентов</h1>
				</div>
				<div class="content-left">
					<div class="content-left-box">
						<h3>Регионы</h3>
						<div class="content-left-text">
							<div class="left-menu">
								<ul>
									<?php for($i=0;$i<count($regions);$i++): ?>		
<li><?=anchor('business-environment/offers/'.$userinfo['uconfirmation'].'/region/'.$regions[$i]['reg_id'],$regions[$i]['reg_name']);?></li>
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
								<div class="right-post zakup zakup2">
									<span class="news-pic">
										<img src="<?=$baseurl;?>offers/viewimage/<?=$topic['oft_id'];?>"class="floated" alt=""/>
									</span>
									<h2><?=$topic['oft_title'];?></h2>
									<span class="date"><?=$topic['oft_date'];?></span>
									<p><?=$topic['oft_note'];?></p>
									<span class="green"><a href="" id="SetComment">комментировать</a></span>
									<div class="clear"></div>
									<div id="FormComment" style="display:none;">
										<?=form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
					<label class="label-input">Текст комментария: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
									<?= form_error('note'); ?>
					<textarea class="edit700-form-textarea" name="note" id="note" cols="50" rows="10"><?=set_value('note');?></textarea>
									<div class="clear"></div>
						<input class="btn-action margin-1em" id="addComment" type="submit" name="submit" value="Добавить"/>
						<input class="btn-action margin-1em" id="Cancel" type="button" value="Отменить"/>
										<?= form_close(); ?>
									</div>
									<div class="clear"></div>
									<div class="right-post-option">
										<table cellspacing="0" class="post-option">
											<tr>
												<td class="right-option">
													<div class="opt-bg">
													<?php if($topic['oft_userid'] == $userinfo['uid']):?>
														<div class="opt-bgg">
	<?=anchor('business-environment/offers/'.$userinfo['uconfirmation'].'/edit-offer/'.$topic['oft_id'],'Редактировать',array('class'=>'first','title'=>'Редактировать'));?>
	<?=anchor('business-environment/offers/'.$userinfo['uconfirmation'].'/delete-offer/'.$topic['oft_id'],'Удалить',array('title'=>'Удалить'));?>
														</div>
													<?php endif; ?>
													</div>
												</td>
												<td class="right-avtor">
													<table cellspacing="0" cellpadding="0">
														<tr>
				<td><img src="<?=$baseurl;?>cravatar/viewimage/<?=$topic['oft_userid'];?>" alt="" align="left" width="42" height="42"/></td>
				<td><?=$topic['usubname'].' '.$topic['uname'].' '.$topic['uposition'].' '.$topic['oft_cmpname']?></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="right-comment">
									<a name="comments"></a>
									<div class="right-comment-title">комментарии (<?=$topic['oft_comments'];?>):</div>
								<?php for($i=0;$i<count($comments);$i++): ?>
									<div class="commentblock">
										<div class="right-post-option">
											<table cellspacing="0" class="post-option">
												<tr>
													<td class="right-avtor">
														<table cellspacing="0" cellpadding="0">
															<tr>
			<td><img src="<?=$baseurl;?>cravatar/viewimage/<?=$comments[$i]['cmn_usrid'];?>" alt="" align="left" width="42" height="42"/></td>
			<td><?=$comments[$i]['usubname'].' '.$comments[$i]['uname'].' '.$comments[$i]['uposition'].' '.$comments[$i]['cmp_name']?></td>
															</tr>
														</table>
													</td>
													<td class="date-comment"><?=$comments[$i]['cmn_date'];?></td>
												</tr>
											</table>
										</div>
										<div class="commentbox">
											<p id="p<?=$i;?>"><?=$comments[$i]['cmn_note'];?></p>
										<?php if($comments[$i]['cmn_usrid'] == $userinfo['uid']):?>
											<div class="commentbox-option">
											<a href="" class="EditComment" FC="<?=$i;?>">Редактировать</a>
<?=anchor('business-environment/offers/'.$userinfo['uconfirmation'].'/offer/'.$this->uri->segment(5).'/delete-comment/'.$comments[$i]['cmn_id'],'Удалить');?>
												<div class="clear"></div>
												<div class="FormEditComment" id="FEC<?=$i;?>" style="display:none;">
										<?=form_open($this->uri->uri_string(),array('class'=>'formular','id'=>'form'.$i)); ?>
										<?=form_hidden('comments',$comments[$i]['cmn_id']);?>
				<label class="label-input" style="text-align:left;">Текст комментария: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<textarea class="edit680-form-textarea txtinput" name="note" id="note<?=$i;?>" cols="50" rows="10"></textarea>
												<div class="clear"></div>
				<input class="btn-action margin-1em SEC" FC="<?=$i;?>" id="EditComment<?=$i;?>" type="submit" name="ssubmit" value="Сохранить"/>
				<input class="btn-action margin-1em CEC" FC="<?=$i;?>" id="EditCancel<?=$i;?>" type="button" value="Отменить"/>
										<?= form_close(); ?>
												</div>
												<div class="clear"></div>
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
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){window.setTimeout("window.location='<?= $baseurl; ?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			$("#select-category").change(function(){change_category($(this));});
			function change_category(obj){if(obj.val() != 'empty')window.location='<?=$baseurl;?>'+'business-environment/'+obj.val()+'/<?=$userinfo['uconfirmation'];?>';};
			$('#SetComment').click(function(){$('#FormComment').fadeToggle('slow');$('html, body').animate({scrollTop:'400px'},"slow");return false;});
			$("#Cancel").click(function(){$('#FormComment').fadeToggle('slow',function(){$("#note").val('');});$('html, body').animate({scrollTop:'400px'},"slow");});
			$("#addComment").click(function(event){$("#note").css('border-color','#D0D0D0');if($("#note").val() == ''){$("#note").css('border-color','#ff0000');msgerror("Пропущены обязательные поля!");event.preventDefault();}});
			$(".EditComment").click(function(){var fc = $(this).attr('FC');var text = $('#p'+fc).text();$(".FormEditComment").hide();$(".txtinput").val('');$("#FEC"+fc).fadeIn('slow',function(){$("#note"+fc).val(text);});return false;});
			$(".CEC").click(function(){var fc=$(this).attr('FC');$("#note"+fc).css('border-color','#D0D0D0');$("#FEC"+fc).fadeOut('slow',function(){$("#note"+fc).val('');});return false;});
			$(".SEC").click(function(event){var fc=$(this).attr('FC');$("#note"+fc).css('border-color','#D0D0D0');if($("#note"+fc).val() == ''){$("#note"+fc).css('border-color','#ff0000');msgerror("Пропущены обязательные поля!");event.preventDefault();}else $("#form"+fc).submit();});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}
		});
</script>
</body>
</html>