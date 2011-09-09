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
					<?php $this->load->view("admin_interface/department-list-content");?>
					<div class="clear"></div>
					<div id="frmInsert" style="display:none;">
						<?php $this->load->view('forms/frminsdepartment');?>
					</div>
					<button id="btnInsert" style="height:2.5em; margin-top:15px; min-width: 130px;">
						<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>
					</button>
				</div>
			</section>
		</div>
	</div><!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$("#btnInsert").click(function(){
			if($("#frmInsert").is(":hidden")){
				$("#btnInsert").html('<img src="<?=$baseurl;?>images/arrow-curve.png"><font size="3"> Отменить</font>');
				$("#frmInsert").slideDown("slow");
				var height = $(window).height();
				$("html, body").animate({scrollTop:height+'px'},"slow");
			}else{
				$("#frmInsert").slideUp("slow",function(){
					$("#frmInsert").hide();
					$(".flvalid_error").text('');
					$("#btnInsert").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить</font>');
					$("#formRep .inpvalue").val('');
					$("#formRep .inpvalue").css('border-color','#D0D0D0');
				 });
			}
		});
		
		$("#addItem").click(function(event){
			var err = false;
			 $("#formRep .inpvalue").css('border-color','#D0D0D0');
			if($("#name").val() == ''){
				err = true;
				$("#name").css('border-color','#ff0000');
			}
			if($("#area").val() == ''){
				err = true;
				$("#area").css('border-color','#ff0000');
			}
			if($("#district").val() == ''){
				err = true;
				$("#district").css('border-color','#ff0000');
			}
			if(err){
				event.preventDefault();
				msgerror('Пропущены обязательные поля');
			}
		});
		
		$(".NewsSave").click(function(){
			var err = false;
			var curID = $(this).attr("dID");
			var depID = $("td[dID='"+curID+"']").text();
			var objName = $("#vName"+curID);
			var valName = $(objName).val();
			$(objName).css('border-color','#D0D0D0');
			if(valName == ""){
				$(objName).css('border-color','#ff0000');
				err = true;
			}
			if(err){
				msgerror('Пропущены обязательные поля');
				return false;
			}else{
				$.post("<?=$baseurl;?>admin/save-department/<?=$userinfo['uconfirmation'];?>",
				{'id':depID,'name':valName},
				function(data){
					if(data.status){
						$(objName).val(data.name);
						$(objName).css('border-color','#00ff00');
					}else{
						msgerror(data.message);
					}
				},"json");
			};
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