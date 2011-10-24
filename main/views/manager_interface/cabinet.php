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
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.ajaxsave,.ajaxdel,.ajaxSaveFile {float: right;padding: 5px;margin-right: 55px;cursor: pointer;}
		#period-jobs{float: right;padding-bottom: 10px;margin: 0 133px 0 0;}
		.job-sections h3{margin: 5px 10px 15px 0;float: left;}
		.jobs{margin: 5px 10px 5px 0;float: right;}
		.vRight{font: bold normal 120% serif;float: right;margin-right: 95px;}
		#loading{float: right; margin-right: 55px;}
		.jodData{margin: 0px;}
		.jobPosiotion{margin: 0px 0px 15px 10px;}
		.divDelJob{float: right;margin-right: 10px;}
		.btn-delete{-moz-border-radius: 3px 3px 3px 3px;background: none repeat scroll 0 0 #879042;border: 0 none;color: #FFFFFF;cursor: pointer;
			font: 12px/18px "Trebuchet MS",Arial,Helvetica,sans-serif;padding: 2px 8px;text-decoration: none;}
		#del-load{float: right;margin-right: 55px;}
		.box-controls {display:block;float:right;height:16px;margin:10px 130px 0 5px;text-indent:-9999px;width:16px;}
		.messageBox{margin: 10px 0 0px 0px;font: bold normal 125% serif;color: #808080;}
		.box-controls.ask { background: url("<?=$baseurl;?>/images/ask_transparent.png") no-repeat scroll 0 0 transparent; }
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
		<?php if($regstatus): ?>
			<div class="container_12
				<div class="grid_12">
					<div class="grid_8 prefix_3 messageBox">
						Менеджер <?= $managerFullName; ?> зарегистрирован
					</div>
					<div class="clear"></div>
					<div class="grid_8 prefix_3 messageBox">
						На e-mail: <?= $email; ?> выслано письмо для активации
					</div>
					<div class="clear"></div>
				</div>
			</div>
		<?php endif; ?>
			<?php $this->load->view('forms/frmsprofile'); ?>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('manager_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.maxlength-min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);}});});
			
			$("#select-region").change(function(){change_region($(this));});
			$("#select-activity").change(function(){change_activity($(this));});
			function change_activity(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-region").val() > 0){$("#select-region").after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}
			function change_region(obj){$("#change-region").remove();if(obj.val() > 0 && $("#select-activity").val() > 0){obj.after('<input type="button" class="lnk-submit" id="change-region" value="ОК"/>');$("#change-region").css({'float':'right','margin': '-1px 10px 2px 5px'});$("#change-region").live('click',function(){$("#ManActData").submit()});}}
			$('#vachi').maxlength({maxCharacters:150,status:true,statusClass:"lenghtstatus",statusText:" символов осталось.",notificationClass:"lenghtnotifi",slider:true});
			$("#savatar").click(function(){var vObj = $("#vavatar").val();if(vObj === ''){msgerror('Поле не может быть пустым');$("#vavatar").css('border-color','#ff0000');$("#vavatar").focus();}else $("#formAvatar").submit();});$("#instjob").click(function(){var oval = $("#organValue").val();var pval = $("#posValue").val();var ybegin = parseInt($("#yBegin").val());var yend = parseInt($("#yEnd").val());$("#yBegin").css('border-color','#D0D0D0');$(".jobs").css('border-color','#D0D0D0');if(oval === ''){msgerror('Поле не может быть пустым');$("#organValue").css('border-color','#ff0000');$("#organValue").focus();}else if(pval === ''){msgerror('Поле не может быть пустым');$("#posValue").css('border-color','#ff0000');$("#posValue").focus();}else if(ybegin > yend){msgerror('Не венно указан период');$("#yBegin").css('border-color','#ff0000');$("#yBegin").focus();}else $.post("<?=$baseurl;?>manager/add-job/<?=$userinfo['uconfirmation'];?>",{'cmp':oval,'pos':pval,'beg':ybegin,'end':yend},function(data){if(data.status){$("#jobList").load("<?=$baseurl;?>views/job-list/<?=$userinfo['uconfirmation'];?>");$(".ajaxdel").live('click',function(){deleteJobData(this.id);});$("#organValue").val('');$("#posValue").val('');}else{msgerror(data.message);}},"json");});$('.ajaxdel').click(function(){deleteJobData(this.id);});function deleteJobData(btnID){var divJob = $("#v"+btnID);var objID = divJob.attr('jobID');$("#"+btnID).hide();$.post("<?=$baseurl;?>manager/delete-job/<?=$userinfo['uconfirmation'];?>",{'id':objID,},function(data){if(data.status){$("#v"+btnID).remove();}else{msgerror(data.message);$("#"+btnID).show();}},"json");}$(".ajaxsave").click(function(){var btnID = this.id;saveSingleData(btnID);});$("#regman").click(function(){window.location="<?=$baseurl;?>manager/registration/<?=$userinfo['uconfirmation'];?>";});function saveSingleData(btnID){var txtObj = $("#v"+btnID);var objValue = txtObj.val();var objID = txtObj.attr('id');if(objValue === ''){msgerror('Поле не может быть пустым');txtObj.css('border-color','#ff0000');txtObj.focus();if(btnID === 'pass') $("#d"+btnID).text('');}else{$.ajax({url:"<?=$baseurl;?>manager/save-profile/<?=$userinfo['uconfirmation'];?>",type: "POST",data: ({id:objID,value:objValue}),dataType: "JSON",beforeSend: function(){$("#"+btnID).hide();$("#"+btnID).after('<img id="loading" src="<?=$baseurl;?>images/progress.gif"/>');},success: function(data){if(data.status){txtObj.css('border-color','#00ff00');$('#d'+btnID).text(data.retvalue);if($(txtObj).attr("id")!='vachi') txtObj.val('');}else{msgerror(data.message);txtObj.css('border-color','#ff0000');if(btnID === 'pass')$("#d"+btnID).text('');}$("#"+btnID).show();$("#loading").remove();},error: function(){$("#"+btnID).show();$("#loading").remove();txtObj.css('border-color','#ff0000');msgerror("Ошибка при сохранении!");}});}return true;};function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,1000);return false;}});
	</script>
</body>
</html>