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
	<link rel="stylesheet" href="<?=$baseurl;?>css/admin.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/new.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/datepicker/jquery.ui.all.css" type="text/css" />
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.h960{max-height: none; min-height: 470px;}
		.w918{width: 918px;}
		.btnHidden{display:none;}
		.w960{width: 960px;}
		.w935{width: 935px;}
		.h400{min-height: 400px;}
		div.ButtonOperation{padding:5px 0px;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('admin_interface/header-nomenu'); ?>
		<div id="main">
			<section id="frmlogin"><br/>
				<div class="container_12">
					<hr size="2"/>
					<div class="">
						<?=anchor('admin','Панель администрирования',array('class'=>'lnk-submit'));?>
					</div>
					<hr size="2"/>
					<div class="grid_6" style="margin:0">
					<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formSetDate','class'=>'formular')); ?>
						<label class="label-input">Укажите дату: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
						<input class="date-form-input" id="setDate" name="date" type="text" readonly="readonly" value="<?=$setdate;?>"/>
						<input class="btn-action" style="margin-top:0" id="btnSetDate" type="submit" name="submit" value="Показать лог"/>
						<div class="clear"></div>
					<?= form_close(); ?>
					</div>
					<div class="clear"></div>
					<hr size="2"/>
					<?php if($setdate):?>
						<?php $this->load->view("admin_interface/manage-be-content");?>
					<?php endif; ?>
					<div id="be-information-modal-content">
						<div class="box">
							<div class="box-header">&nbsp;
								<div class="box-search">&nbsp;</div>
							</div>
							<div class="box-content h400 w935">
								<div id="info">&nbsp;</div>
							</div>
							<div class="box-bottom-links h20">&nbsp;
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<div id="be-edit-modal-content">
						<div class="box">
							<div class="box-header">&nbsp;
								<div class="box-search">&nbsp;</div>
							</div>
							<div class="box-content h400 w935">
								<div id="edit">&nbsp;</div>
							</div>
							<div class="box-bottom-links h20">&nbsp;
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div><!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.bgiframe-2.1.1.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker-ru.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.widget.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$("input#setDate").datepicker($.datepicker.regional['ru']);
		$("#btnSetDate").click(function(event){
			$("#setDate").css('border-color','#D0D0D0');
			if($("#setDate").val() == ''){
				$("#setDate").css('border-color','#ff0000');
				msgerror("Пропущены обязательные поля!");
				event.preventDefault();
				return false;
			}
		});
		
		$(".RecView").click(function(){
			
			var curID = $(this).attr("rID");
			var rID = $("td[rID='"+curID+"']").text();
			$("#info").load("<?=$baseurl;?>admin/manage-be-information/<?=$userinfo['uconfirmation'];?>",{'id':rID},function(){$("#be-information-modal-content").modal({containerCss:{width:960,height:500}});});
		});
		
		$(".RecEdit").click(function(){
			var curID = $(this).attr("rID");
			var rID = $("td[rID='"+curID+"']").text();
			$("#edit").load("<?=$baseurl;?>admin/manage-be-edit/<?=$userinfo['uconfirmation'];?>",{'id':rID},function(){$("#be-edit-modal-content").modal({containerCss:{width:960,height:500}});});
		});
		
		$(".LogDel").click(function(){
			if(!confirm('Удалить запись лога?')) return false;
			curID = $(this).attr("rID");
			var rID = $("td[rID='"+curID+"']").text();
			$.post(
				"<?=$baseurl;?>admin/manage-log-delete/<?=$userinfo['uconfirmation'];?>",
				{'id':rID},
				function(data){
					if(data.status){
						$("tr[rID='"+curID+"']").fadeOut("slow",function(){
							$("tr[rID='"+curID+"']").remove();
						});
					}else
						msgerror(data.message);
				},"json");
		});
		
		$(".RecDel").click(function(){
			if(!confirm('Удалить запись?')) return false;
			curID = $(this).attr("rID");
			var rID = $("td[rID='"+curID+"']").text();
			$.post(
				"<?=$baseurl;?>admin/manage-be-delete/<?=$userinfo['uconfirmation'];?>",
				{'id':rID},
				function(data){
					if(data.status){
						$("tr[rID='"+curID+"']").fadeOut("slow",function(){
							$("tr[rID='"+curID+"']").remove();
						});
					}else
						msgerror(data.message);
				},"json");
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
</body>
</html>