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
		.NewsDel{float: right;padding: 5px;margin-right: 10px;cursor: pointer;}
		.NewsSave{float: right;padding: 5px;cursor: pointer;}
		.NewsExc{cursor:help;}
		.h150{min-height: 150px;}
		.w918{width: 918px;}
		.rep-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;}
		.repData{margin: 15px 0 0 0;}
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 10px 10px 0;cursor:help;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
		.nshNote{margin-bottom: 10px;text-align:justify;min-height: 100px;}
		.btnHidden,.newsID{display:none;}
		.chackForAll{float:right;margin: 10px 10px 0 0;font: normal bold 100% normal;}
		.msgForAll{float:right;margin: 30px -300px 0 0;}
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
						<?php $this->load->view('forms/frmconsultationlist'); ?>
						<div id="frmInsConsult" style="display:none;">
							<?php $this->load->view('forms/frminsconsultation');?>
						</div>
						<button id="insConsult" style="height:2.5em; margin-top:15px; min-width: 130px;">
							<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>
						</button>
						<div class="chackForAll">
							<input type="checkbox" name="close" value="1" id="CloseConsult" <?php if($close_consult) echo 'checked="checked"';?> title="Отметьте, если хотите приостановить консультирование"> Приостановить консультирование
						</div>
						<div class="msgForAll fvalid_error" id="msgCloseConsult">&nbsp;</div>
					</div>
				</div>
			</div>
			<div class="push"></div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('manager_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select-region").change(function(){$("#change-region").remove();if($(this).val()>0){$(this).css('float','left');$(this).after('<input type="button" class="lnk-submit" id="change-region" value="Продолжить"/>');$("#change-region").live('click',function(){$("#regionview").submit();});};});
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			
			$("#insConsult").click(function(){
				$("#validError").text('');
				if($("#frmInsConsult").is(":hidden")){
					$("#insConsult").html('<img src="<?=$baseurl;?>images/arrow-curve.png"><font size="3"> Отменить</font>');
					$("#frmInsConsult").slideDown("slow");
					var height = ($(window).height()*$(".box").size())/2;
					$("html, body").animate({scrollTop:height+'px'},"slow");
				}else{
					$("#frmInsConsult").slideUp("slow",function(){
						$("#frmInsConsult").hide();
						$("#insConsult").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>');
						$("#formRep .inpvalue").val('');
						$("#formRep .inpvalue").css('border-color','#D0D0D0');
					 });
				}
			});
			$(".NewsDel").click(function(){
				var curID = $(this).attr("nID");
				var newsID = $("#id"+curID).text();
				$.post(
					"<?=$baseurl;?>manager/delete-consultation/<?=$userinfo['uconfirmation'];?>",
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
				var objPriceID = $("#pr"+curID);
				var objPeriodID = $("#pd"+curID);
				var objDescID = $("#td"+curID);
				var valTitle = $(objTitleID).val();
				var valPrice = $(objPriceID).val();
				var valPeriod = $(objPeriodID).val();
				var valDesc = $(objDescID).val();
				$(objTitleID).css('border-color','#D0D0D0');
				$(objPriceID).css('border-color','#D0D0D0');
				$(objDescID).css('border-color','#D0D0D0');
				if(valTitle == ''){
					$(objTitleID).css('border-color','#ff0000');
					err = true;
				}
				if(objPriceID == ''){
					$(objPriceID).css('border-color','#ff0000');
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
					$.post("<?=$baseurl;?>manager/save-consultation/<?=$userinfo['uconfirmation'];?>",
					{'id':newsID,'title':valTitle,'price':valPrice,'period':valPeriod,'desc':valDesc},
					function(data){
						if(data.status){
							$(objTitleID).css('border-color','#00ff00');
							$(objPriceID).css('border-color','#00ff00');
							$(objPeriodID).css('border-color','#00ff00');
							$(objDescID).css('border-color','#00ff00');
						}else{
							msgerror(data.message);
						}
					},"json");
				};
			});
			
			$("#CloseConsult").click(function(){
				var check = 0;
				if(this.checked) check = 1;
				else check = 0;
				
				$.post("<?=$baseurl;?>manager/close-consultation/<?=$userinfo['uconfirmation'];?>",{'check':check},
					function(data){
						if(data.status){
							$("#msgCloseConsult").text(data.message);
						}
					},"json");
				
			});
			
			$(".digital").keypress(function(e){
				if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
			
			$("#addConsult").click(function(event){
				var err = false;
				 $("#formRep .inpvalue").css('border-color','#D0D0D0');
				if($("#title").val() == ''){
					err = true;
					$("#title").css('border-color','#ff0000');
				}
				if($("#price").val() == ''){
					err = true;
					$("#price").css('border-color','#ff0000');
				}
				if($("#note").val() == ''){
					err = true;
					$("#note").css('border-color','#ff0000');
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