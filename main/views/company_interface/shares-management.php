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
	<link rel="stylesheet" href="<?=$baseurl;?>css/datepicker/jquery.ui.all.css" type="text/css" />
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		div.ButtonOperation{min-height:30px;}
		.NewsDel, .NewsCancel, .EraserInput{float: right;padding: 5px;margin-right: 10px;cursor: pointer;}
		.NewsExc, .NewsEdit, .NewsSave{float: right;padding: 5px;cursor: pointer;}
		.NewsExc{cursor:help;}
		.rep-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;border-top: 2px solid #D0D0D0;border-bottom: 2px solid #D0D0D0;}
		.repData{margin: 15px 0 0 0;}
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 10px 10px 0;cursor:help;}
		.online{margin-left: 20px;}
		.nshDate{font: normal bold 90% serif;text-align: right;}
		.nshNote{margin-bottom: 10px;text-align:justify;min-height: 60px;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
		.btnHidden{display:none;}
		.ExtendDay{padding: 5px;margin-left: 10px;cursor: pointer;}
		.tmpTitle,.tmpDesc,.newsID{display:none;}
		.h250{min-height: 250px;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('company_interface/header-noregion'); ?>
		<div id="main">
			<div class="container_12 framing">
				<div class="grid_12">
					<div id="validError" style="text-align:center; margin-top:20px;">
					<?= validation_errors(); ?>
					</div>
					<?php $this->load->view('forms/frmnshlist'); ?>
					<div class="clear"></div>
					<div id="frmInsNews" style="display:none;">
						<?php $this->load->view('forms/frminsnsh');?>
					</div>
					<button id="insNews" style="height:2.5em; margin:15px 0; min-width: 130px;">
						<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>
					</button>
				</div>
			</div>
			<div class="push"></div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('company_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.bgiframe-2.1.1.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker-ru.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.widget.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			
			if($("input#end-date").val() != '') $(".EraserInput").show();
			
			$("#insNews").click(function(){
				$("#validError").text('');
				if($("#frmInsNews").is(":hidden")){
					$("#insNews").html('<img src="<?=$baseurl;?>images/arrow-curve.png"><font size="3"> Отменить</font>');
					$("#frmInsNews").slideDown("slow");
					var height = $(window).height()+50;
					$('html, body').animate({scrollTop:height+'px'},"slow");
				}else{
					$("#frmInsNews").slideUp("slow",function(){
				       $("#frmInsNews").hide();
					   $("#insNews").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>');
					   $("#formRep .inpvalue").val('');
					   $("#chOffers").removeAttr("checked");
					   $("#dActOffers").hide();
					    $("#formRep .inpvalue").css('border-color','#D0D0D0');
					   if($(".EraserInput").is(":hidden")) $(".EraserInput").hide();
					 });
				}
			});
		<?php if($offers):?>
			$("#chOffers").removeAttr("checked");
			$("#chOffers").click(function(){
				$("#sActOffers").val(null)
				$("#sActOffers").css('border-color','#D0D0D0');
				$("#sRegOffers").val(null);
				$("#sRegOffers").css('border-color','#D0D0D0');
				$("#dRegActOffers").toggle();
			});
		<?php endif;?>
			$(".ExtendDay").click(function(){
				var curID = $(this).attr("nID");
				var objExtendID = $("#vex"+curID);
				$(objExtendID).css('border-color','#D0D0D0');
				var valExtend = objExtendID.val();
				var newsID = $("#id"+curID).text();
				if(valExtend == ''){
					$(objExtendID).css('border-color','#ff0000');
					msgerror('Пропущены обязательные поля');
					return false;
				}else{
					$.post(
					"<?=$baseurl;?>company/shares-extend-day/<?=$userinfo['uconfirmation'];?>",
					{'id':newsID, 'day':valExtend},
					function(data){
						if(data.status){
							$("span#sped"+curID).text(data.date);
							$("span#sped"+curID).css('color','#00ff00');
							$(objExtendID).val('');
						}else
							msgerror(data.message);
					},"json");
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
				$(objDescID).html("<textarea class=\"edit-form-textarea mbottom\" name=\"description\" id=\"ads"+curID+"\" cols=\"50\" rows=\"5\">"+valDesc+"</textarea>");
				$("#dl"+curID).slideUp("slow",function(){$("#c"+curID).slideDown("slow");});
				$("#e"+curID).slideUp("slow",function(){$("#s"+curID).slideDown("slow");});
			});
			$(".reg-form-small").keypress(function(e){
				if($(this).val() == '' && e.which == 48) return false;
				if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
			$(".reg-form-small").keyup(function(e){
				var dayValue = $(this).val();
				if(parseInt(dayValue) > 365 && dayValue.length == 3) $(this).val('365');
				var curID = $(this).attr("nID");
				$("span#sped"+curID).css('color','#444444');
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
				$("#c"+curID).slideUp("slow",function(){$("#dl"+curID).slideDown("slow");});
				$("#s"+curID).slideUp("slow",function(){$("#e"+curID).slideDown("slow");});
			});
			$(".NewsDel").click(function(){
				var curID = $(this).attr("nID");
				var newsID = $("#id"+curID).text();
				$.post(
					"<?=$baseurl;?>company/shares-delete/<?=$userinfo['uconfirmation'];?>",
					{'id':newsID},
					function(data){
						if(data.status){
							$("#cs"+curID).fadeOut("slow",function(){
								$("#cs"+curID).remove();
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
					$.post("<?=$baseurl;?>company/shares-save/<?=$userinfo['uconfirmation'];?>",
					{'id':newsID,'title':valTitle,'desc':valDesc},
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
							$("#c"+curID).slideUp("slow",function(){$("#dl"+curID).slideDown("slow");});
							$("#s"+curID).slideUp("slow",function(){$("#e"+curID).slideDown("slow");});
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
				if($("#activity").val() == 0){
					err = true;
					$("#activity").css('border-color','#ff0000');
				}
				if($("#chOffers").attr("checked")){
					if($("#sActOffers").val() == null){
						err = true;
						$("#sActOffers").css('border-color','#ff0000');
					}
					if($("#sRegOffers").val() == null){
						err = true;
						$("#sRegOffers").css('border-color','#ff0000');
					}
				}
				if(err){
					event.preventDefault();
					msgerror('Пропущены обязательные поля');
					return false;
				}else{
					if($("#chOffers").attr("checked")){
						var actoff = $("#sActOffers option:selected").size();
						var regoff = $("#sRegOffers option:selected").size();
						if(!confirm("Предложение будет размещено в "+regoff+" городах\nпо "+actoff+" отраслям. Продолжить?"))
							event.preventDefault();
					}
					$("#formAddNews").submit();
				}
			});
			
			$("input#begin-date").datepicker($.datepicker.regional['ru']);
			$("input#end-date").datepicker($.datepicker.regional['ru']);
			$("input#end-date").change(function(){
				if($(".EraserInput").is(":hidden")){
					$(".EraserInput").fadeIn("slow");
				}
			});
			$(".EraserInput").click(function(event){
				$("input#end-date").val('');
				$(this).fadeOut("slow");
				return false;
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