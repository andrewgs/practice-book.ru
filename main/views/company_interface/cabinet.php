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
		.ajaxsave,.ajaxdel,.ajaxSaveFile {
			float: right;
			padding: 5px;
			margin-right: 50px;
			cursor: pointer;
		}
		.mbottom{
			margin-bottom: 10px;
		}
		.vRight{
			font: bold italic 120% serif;
			float: right;
			color: #00ff00;
			margin-right: 95px;
		}
		#loading{
			float: right;
			padding: 5px;
			cursor: pointer;
			margin: 0px 50px -2px 0;
		}
		.box-controls {
			display:block;
			float:right;
			height:16px;
			margin:10px 20px 0 5px;
			text-indent:-9999px;
			width:16px;
		}
		.messageBox{
			margin: 10px 0 0px 0px;
			font: bold italic 125% serif;
			color: #808080;
		}
		#company-data{
			margin: 10px 0 10px 0;
		}
		.box-controls.ask { background: url("<?= $baseurl; ?>/images/ask_transparent.png") no-repeat scroll 0 0 transparent; }
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('company_interface/header'); ?>
		<div id="main">
			<?php $this->load->view('forms/frmcmpsprofile'); ?>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('company_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){window.setTimeout("window.location='<?= $baseurl; ?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			
			
			$("#select-region").change(function(){$("#change-region").remove();if($(this).val()>0){$(this).css('float','left');$(this).after('<input type="button" class="lnk-submit" id="change-region" value="Продолжить"/>');$("#change-region").live('click',function(){$("#regionview").submit();});};});
			
			$("#scavatar").click(function(){var vObj = $("#vcavatar").val();if(vObj === ''){msgerror('Поле не может быть пустым');$("#vcavatar").css('border-color','#ff0000');$("#vcavatar").focus();}else $("#formAvatar").submit();});
			
			$(".ajaxsave").click(function(){var btnID = this.id;saveSingleData(btnID);});
			
			$("#regman").click(function(){window.location="<?= $baseurl; ?>company/representatives/<?=$userinfo['uconfirmation'];?>";});
			
			function saveSingleData(btnID){
				var txtObj = $("#v"+btnID);
				var objValue = txtObj.val();
				var objID = txtObj.attr('id');
				if(btnID === 'prod'){
					txtObj = $(btnID);
					objValue = $(":radio[name='maker']").filter(":checked").val();
					objID = 'producer';
				}
				if(objValue === '' && (objID == 'vcname' || objID == 'vemail')){
					msgerror('Поле не может быть пустым');
					txtObj.css('border-color','#ff0000');
					txtObj.focus();
				}else{
					$.ajax({
						url:"<?=$baseurl;?>company/save-profile/<?=$userinfo['uconfirmation'];?>",
						type: "POST",
						data: ({id:objID,value:objValue}),
						dataType: "JSON",
						beforeSend: function(){
							$("#"+btnID).hide();
							$("#"+btnID).after('<img id="loading" src="<?=$baseurl;?>images/progress.gif"/>');
							},
						success: function(data){
								if(data.status){
									$('#d'+btnID).text("Сохранено");
									txtObj.val(data.retvalue);
									txtObj.css('border-color','#D0D0D0');
								}
								else{
									msgerror(data.message);
									txtObj.css('border-color','#ff0000');
								}
								$("#"+btnID).show();$("#loading").remove();
							},
						error: function(){
								$("#"+btnID).show();
								$("#loading").remove();
								txtObj.css('border-color','#ff0000');
								msgerror("Ошибка при сохранении!");
							}
					});
				}
				return true;
			};
			
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