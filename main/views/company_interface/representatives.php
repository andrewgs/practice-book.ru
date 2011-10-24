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
		.ajaxdel{float: right;padding: 5px;margin-right: 50px;cursor: pointer;}
		.rep-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;border-top: 2px solid #D0D0D0;border-bottom: 2px solid #D0D0D0;}
		.w918{width: 918px;}
		.online{margin-left: 20px;}
		.repData{margin: 15px 0 0 0;}
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 10px 10px 0;}
		.federal-skype-icq img{margin:5px 5px 0 10px;cursor: pointer;}
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
					<div id="validError" style="text-align:center; margin-top:20px;"><?= validation_errors(); ?></div>
					<?php $this->load->view('forms/frmrepresentatives'); ?>
					<div class="clear"></div>
					<div id="frmNewRep" style="display:none;">
						<?php $this->load->view('forms/frmregrepsentative');?>
					</div>
					<?php if($userinfo['priority']): ?>
						<button id="regman" style="height:2.5em; margin:15px 0; width: 130px;">
							<img src="<?=$baseurl;?>images/user-plus.png"><font size="3"> Добавить</font>
						</button>
					<?php endif; ?>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			$("#regman").click(function(){
				$("#validError").text('');
				if($("#frmNewRep").is(":hidden")){
					$("#regman").html('<img src="<?=$baseurl;?>images/arrow-curve.png"><font size="3"> Отменить</font>');
					$("#frmNewRep").slideDown("slow");
					var height = $(window).height()*2;
					$("html, body").animate({scrollTop:height+'px'},"slow");
				}else{
					$("#frmNewRep").slideUp("slow",function(){
				       $("#frmNewRep").hide();
					   $("#regman").html('<img src="<?=$baseurl;?>images/user-plus.png"><font size="3"> Добавить</font>');
					   $(".reg-form-input").val('');
					   $(".reg-form-input").css('border-color','#D0D0D0');
					 });
				}
			});
			$("#addRep").click(function(event){
				var err = false;
				$(".reg-form-input").css('border-color','#D0D0D0');
				$("#select-department").css('border-color','#D0D0D0');
				if($("#select-department").val() == ''){
					$("#select-department").css('border-color','#ff0000');
					err = true;
				}
				$(".reg-form-input").each(
					function(i,element){
						if($(element).val()===''){
							$(element).css('border-color','#ff0000');
							err = true;
						}
					});
				if(err){
					msgerror('Пропущены обязательные поля');
					event.preventDefault();
					return false;
				};
				var email = $("#email").val();
				if(!email.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){
					msgerror('Не верный формат E-mail');
					$("#email").css('border-color','#ff0000');
					$("#email").focus();
					event.preventDefault();
					return false;
				};
				if($("#password").val() != $("#confpassword").val()){
					$("#password").css('border-color','#ff0000');
					$("#confpassword").css('border-color','#ff0000');
					msgerror('Пароли не вовпадают');
					event.preventDefault();
					return false;
				};
				if($("#password").val().length < 6){
					$("#password").css('border-color','#ff0000');
					$("#password").focus();
					msgerror('Короткий пароль');
					event.preventDefault();
					return false;
				};
			});
			
			$(".ajaxdel").click(function(){
				var btnRep = $(this).attr("rep");
				var repID = $("#drep"+btnRep).attr("rID");
				$.post("<?=$baseurl;?>company/delete-representatives/<?=$userinfo['uconfirmation'];?>",
					{'id':repID},
					function(data){
						if(data.status)
							$("#drep"+btnRep).remove();
						else
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