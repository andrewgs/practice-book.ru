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
		.h470{min-height: 470px;}
		.w918{width: 918px;}
		div.ButtonOperation{min-height:30px;}
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
					<?php $this->load->view("admin_interface/users-list-content");?>
				</div>
			</section>
		</div>
	</div><!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$(".parentid").keypress(function(e){
			if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
		});
		$(".final").keypress(function(e){
			if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>49))return false;
			if($(this).val().length > 0){$(this).val('');}
		});
		
		$(".btnSave").click(function(){
			var err = false;
			var curID = $(this).attr("rID");
			var uID = $("td[rID='"+curID+"']").text();
			var objDate = $("#vDate"+curID);
			var objPriority = $("#vPriority"+curID);
			var objActivity = $("#vActivity"+curID);
			var valDate = $(objDate).val();
			var valPriority = $(objPriority).val();
			var valActivity = $(objActivity).val();
			if(valActivity == undefined) valActivity = 0;
			$(objDate).css('border-color','#D0D0D0');
			$(objPriority).css('border-color','#D0D0D0');
			$(objActivity).css('border-color','#D0D0D0');
			if(valDate == ""){
				$(objDate).css('border-color','#ff0000');
				err = true;
			}
			if(valPriority == ""){
				$(objPriority).css('border-color','#ff0000');
				err = true;
			}
			if(valActivity == "" && valActivity != 0){
				$(objActivity).css('border-color','#ff0000');
				err = true;
			}
			if(err){
				msgerror('Пропущены обязательные поля');
				return false;
			}else{
				$.post("<?=$baseurl;?>admin/save-user/<?=$userinfo['uconfirmation'];?>",
				{'id':uID,'date':valDate,'priority':valPriority,'activity':valActivity},
				function(data){
					if(data.status){
						$(objDate).val(data.date);
						$(objPriority).val(data.priority);
						$(objActivity).val(data.activity);
						$(objDate).css('border-color','#00ff00');
						$(objPriority).css('border-color','#00ff00');
						$(objActivity).css('border-color','#00ff00');
					}else{
						msgerror(data.message);
					}
				},"json");
			};
		});	
		
		$(".btnDel").click(function(){
			var curID = $(this).attr("rID");
			var uID = $("td[rID='"+curID+"']").text();
			$.post(
				"<?=$baseurl;?>admin/delete-user/<?=$userinfo['uconfirmation'];?>",
				{'id':uID},
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