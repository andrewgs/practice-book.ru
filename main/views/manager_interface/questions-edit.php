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
	<link rel="stylesheet" href="<?= $baseurl; ?>css/datepicker/jquery.ui.all.css" type="text/css" />
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		div.ButtonOperation{min-height:30px;}
		.NewsDel, .NewsCancel, .EraserInput{float: right;padding: 5px;margin-right: 10px;cursor: pointer;}
		.NewsExc, .NewsEdit, .NewsSave{float: right;padding: 5px;cursor: pointer;}
		.NewsExc{cursor:help;}
		.h150{min-height: 150px;}
		.w918{width: 918px;}
		.rep-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;}
		.repData{margin: 15px 0 0 0;}
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 10px 10px 0;cursor:help;}
		.nshNote{margin-bottom: 10px;text-align:justify;min-height: 100px;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
		.btnHidden{display:none;}
		.tmpTitle,.tmpDesc,.newsID,.tmpCheckBox{display:none;}
		.chackForAll{float:right;margin: 10px 10px 0 0;font: normal bold 125% normal;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('manager_interface/header-noregion'); ?>
		<div id="main">
			<div class="container_12 framing">
				<div class="grid_12">
					<div id="validError" style="text-align:center; margin-top:20px;">
					<?= validation_errors(); ?>
					</div>
					<div class="rep-container">
						<?php $this->load->view('forms/frmquestionslist'); ?>
						<div id="frmInsPitFalls" style="display:none;">
							<?php $this->load->view('forms/frminsquestion');?>
						</div>
						<button id="insPitFalls" style="height:2.5em; margin-top:15px; min-width: 130px;">
							<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>
						</button>
					</div>
				</div>
			</div>
			<div class="push"></div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('manager_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select-region").change(function(){$("#change-region").remove();if($(this).val()>0){$(this).css('float','left');$(this).after('<input type="button" class="lnk-submit" id="change-region" value="Продолжить"/>');$("#change-region").live('click',function(){$("#regionview").submit();});};});
			$("#lnk-logout").click(function(){$.ajax({url:"<?= $baseurl; ?>shutdown",success: function(data){window.setTimeout("window.location='<?= $baseurl; ?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			
			$("#insPitFalls").click(function(){
				$("#validError").text('');
				if($("#frmInsPitFalls").is(":hidden")){
					$("#insPitFalls").html('<img src="<?=$baseurl;?>images/arrow-curve.png"><font size="3"> Отменить</font>');
					$("#frmInsPitFalls").slideDown("slow");
					var height = ($(window).height()*$(".box").size())/2;
					$("html, body").animate({scrollTop:height+'px'},"slow");
				}else{
					$("#frmInsPitFalls").slideUp("slow",function(){
						$("#frmInsPitFalls").hide();
						$("#insPitFalls").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>');
						$("#formRep .inpvalue").val('');
						$("#formRep .inpvalue").css('border-color','#D0D0D0');
					 });
				}
			});
			
			$(".NewsEdit").click(function(){
				var curID = $(this).attr("nID");
				var objTitleID = $("#t"+curID);
				var valTitle = objTitleID.text();
				$("#img"+curID).hide();
				$(objTitleID).after('<div class="tmpTitle" id="tt'+curID+'">'+valTitle+'</div>');
				valTitle = valTitle.replace(/["]/g,"&quot;");
				$(objTitleID).html("<input class=\"edit-form-input\" name=\"fname\" type=\"text\" id=\"it"+curID+"\" value=\""+valTitle+"\"/>");
				var objDescID = $("#ds"+curID);
				var valDesc = objDescID.text();
				$(objDescID).after('<div class="tmpDesc" id="tds'+curID+'">&nbsp;</div>');
				$("#tds"+curID).text(objDescID.html());
				$(objDescID).html("<textarea class=\"edit-form-textarea mbottom\" name=\"note\" id=\"ads"+curID+"\" cols=\"50\" rows=\"12\">"+valDesc+"</textarea>");
				
				var objCheckBox = $("#pr"+curID);
				var valCheckBox = objCheckBox.attr("checked");
				$(objDescID).after('<div class="tmpCheckBox" id="tcb'+curID+'"></div>');
				if(valCheckBox) $("#tcb"+curID).text('checked');

				$("#dl"+curID).slideUp("slow",function(){$("#c"+curID).slideDown("slow");});
				$("#e"+curID).slideUp("slow",function(){$("#s"+curID).slideDown("slow");});
				$("#pr"+curID).removeAttr("disabled");
			});
			
			$(".NewsCancel").click(function(){
				var curID = $(this).attr("nID");
				var objTitleID = $("#tt"+curID);
				$("#it"+curID).fadeOut("slow",function(){
						$("#it"+curID).remove();
						$("#tt"+curID).remove();
						$("#img"+curID).show();
						$("#t"+curID).html(objTitleID.text());
					});
				var objDescID = $("#tds"+curID);
				$("#ads"+curID).fadeOut("slow",function(){
					$("#ads"+curID).remove();
					$("#tds"+curID).remove();
					$("#ds"+curID).html(objDescID.text());
				});
				var valCheckBox = $("#tcb"+curID).text();
				if(valCheckBox=='checked') $("#pr"+curID).attr("checked","checked");
				else $("#pr"+curID).removeAttr("checked");
				
				$("#c"+curID).slideUp("slow",function(){$("#dl"+curID).slideDown("slow");});
				$("#s"+curID).slideUp("slow",function(){$("#e"+curID).slideDown("slow");});
				$("#pr"+curID).attr("disabled","disabled");
			});
			$(".NewsDel").click(function(){
				var curID = $(this).attr("nID");
				var newsID = $("#id"+curID).text();
				$.post(
					"<?=$baseurl;?>manager/delete-question/<?=$userinfo['uconfirmation'];?>",
					{'id':newsID},
					function(data){
						if(data.status){
							$("#cs"+curID).fadeOut("slow",function(){
								$("#cs"+curID).remove();
								if($(".box").size() == 0) window.location="<?=$baseurl.$this->uri->uri_string();?>";
							});
						}else
							msgerror(data.message);
					},"json");
			});
			$(".NewsSave").click(function(){
				var err = false;
				var curID = $(this).attr("nID");
				var newsID = $("#id"+curID).text();
				var objTitleID = $("#it"+curID);
				var objDescID = $("#ads"+curID);
				var valTitle = $(objTitleID).val();
				var valDesc = $(objDescID).val();
				var valPriority = 0;
				if($("#pr"+curID).is(":checked"))valPriority = 1;
				$(objTitleID).css('border-color','#D0D0D0');
				$(objDescID).css('border-color','#D0D0D0');
				if(valTitle == ''){
					$(objTitleID).css('border-color','#ff0000');
					err = true;
				}
				if(valDesc == ''){
					$(objDescID).css('border-color','#ff0000');
					err = true;
				}
				if(err){
					msgerror('Пропущены обязательные поля');
					return false;
				}else{
					$.post("<?=$baseurl;?>manager/save-question/<?=$userinfo['uconfirmation'];?>",
					{'id':newsID,'title':valTitle,'desc':valDesc,'priority':valPriority},
					function(data){
						if(data.status){
							var objTitleID = $("#tt"+curID);
							$("#it"+curID).fadeOut("slow",function(){
									$("#it"+curID).remove();
									$("#tt"+curID).remove();
									$("#img"+curID).show();
									$("#t"+curID).html(data.title);
								});
							var objDescID = $("#tds"+curID);
							$("#ads"+curID).fadeOut("slow",function(){
								$("#ads"+curID).remove();
								$("#tds"+curID).remove();
								$("#ds"+curID).html(data.desc);
							});
							$("#tcb"+curID).remove();
							$("#c"+curID).slideUp("slow",function(){$("#dl"+curID).slideDown("slow");});
							$("#s"+curID).slideUp("slow",function(){$("#e"+curID).slideDown("slow");});
							$("#pr"+curID).attr("disabled","disabled");
							$("#ex"+curID).remove();
						}else{
							msgerror(data.message);
						}
					},"json");
				};
			});
			
			$("#addNews").click(function(event){
				var err = false;
				 $("#formRep .inpvalue").css('border-color','#D0D0D0');
				if($("#title").val() == ''){
					err = true;
					$("#title").css('border-color','#ff0000');
				}
				if($("#begin-date").val() == ''){
					err = true;
					$("#begin-date").css('border-color','#ff0000');
				}
				if($("#description").val() == ''){
					err = true;
					$("#description").css('border-color','#ff0000');
				}
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
</body>
</html>