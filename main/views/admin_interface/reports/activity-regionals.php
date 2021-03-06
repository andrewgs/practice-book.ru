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
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.h960{max-height: none; min-height: 470px;}
		.w918{width: 918px;}
		.AucBegin{cursor: pointer; padding-right:5px;}
		.AucEnd{cursor: pointer; padding-left:5px;}
		.btnHidden{display:none;}
		.activity,.region{font: bold normal 110% serif;margin: 0px;}
		#search-result,#region-result{margin-top:10px;}
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
						<h2>Поиск отрасли:</h2>
						от 3-х символов
						<input class="edit450-form-input" id="ActivityName" type="text" value=""/>
						<div class="clear"></div>
						<div id="ASV" class="btnHidden"></div>
						<div id="search-result"></div>
					</div>
					<div class="grid_2">
						<h2>&nbsp;</h2>
						<h2>&nbsp;</h2>
						<input class="btn-action" style="margin-top:0" id="setSearch" type="button" name="submit" value="Сформировать список"/>
					</div>
					<div class="clear"></div>
					<hr size="2"/>
					<?php if($setActivity):?>
						<?php $this->load->view("admin_interface/reports/activity-regionals-content");?>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div><!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#ActivityName").val('');
		$("#ActivityName").keyup(function(){
			var SearchVal = $(this).val();
			if(SearchVal.length > 2){
				$("#search-result").load("<?=$baseurl;?>admin/search-activity/<?=$userinfo['uconfirmation'];?>",{'search':SearchVal},
				function(){
					$("#SearchAct").die();
					$("#SearchAct").live('change',function(){
						var valID = $(this.options[this.selectedIndex]).val();
						var valTitle = $(this.options[this.selectedIndex]).text();
						var valProduct = $(this.options[this.selectedIndex]).attr("PR");
						$("#ASV").text(valID);
						$("#PSV").text(valProduct);
						$('#ActivityName').val(valTitle);
					});
				}
			);
			}else{
				$("#SearchAct").die();
				$("#search-result").text('');
			}
		});
			
		$("#setSearch").click(function(){
			var actID = $("#ASV").text();
			if(actID != '') window.setTimeout("window.location='<?=$baseurl;?>admin/reports/<?=$userinfo['uconfirmation'];?>/regionals/activity/"+actID+"'",1000);
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