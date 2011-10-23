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
	<link rel="stylesheet" href="<?= $baseurl; ?>css/admin.css">
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.h960{max-height: 960px; min-height: 470px;}
		.w918{width: 918px;}
		div.ButtonOperation{min-height:30px;}
		.NewsSave{float: right;padding: 5px;cursor: pointer;}
		.AdvansedParam{font: bold italic 110% serif;;border: 1px solid #D8D8D8;margin:20px 0; padding: 15px; width:830px; height:200px}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('dealer_interface/header-nomenu'); ?>
		<div id="main">
			<section id="frmlogin"><br/>
				<div class="container_12">
					<?php $this->load->view("dealer_interface/get-code-content");?>
				</div>
			</section>
		</div>
	</div><!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$(" :checkbox").removeAttr("checked");
		$('#advanced').click(function(){$('#Param').fadeToggle('slow');});		
		$('#check1').click(function(){$('#email').fadeToggle('slow');});
		$("#generate").click(function(){
			if(!confirm('Процес может занять несколько секунд.\n\nПродолжить?')) return false;
			var txtObj = $("#code");
			var check1 = $("#check1").attr("checked");
			var email = '';
			if(check1){
				var email = $("#email").val();
				if(email == ''){
					msgerror('Поле не может быть пустым');$("#email").css('border-color','#ff0000');
					$("#email").focus();
				}
				if(email != '' && !email.match(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i)){
					msgerror('Не верный формат E-mail');$("#email").css('border-color','#ff0000');
					$("#email").focus();
					return false;};
			}
			$.ajax({
				url:"<?=$baseurl;?>dealer/generate-code/<?=$userinfo['uconfirmation'];?>",
				type: "POST",
				data: ({email:email}),
				dataType: "JSON",
				beforeSend: function(){
					$("#generate").hide();
					$("#generate").after('<img id="loading" src="<?=$baseurl;?>images/loading.gif"/>');},
				success: function(data){
					if(data.status){
						txtObj.css('border-color','#00ff00');
						txtObj.val(data.retvalue);
					}else{
						msgerror(data.message);
					}
					$("#loading").remove();
					$("#generate").show();
				},
				error: function(){
					$("#loading").remove();
					$("#generate").show();
					txtObj.css('border-color','#ff0000');
					msgerror("Возникла ошибка при получении кода!");
				}
			});
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