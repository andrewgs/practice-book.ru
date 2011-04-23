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
	<link rel="stylesheet" href="<?=$baseurl;?>css/style.css?v=1">
	<link rel="stylesheet" href="<?=$baseurl;?>css/960.css?v=1">
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.w575{
			width: 575px;
		}
		.h20{
			min-height: 20px;
		}
		.w265{
			width: 265px;
		}
		.activity{
			font: bold italic 125% serif;
			margin: 0px;
		}
		.activityList{
			margin-left: -20px;
		}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('users_interface/header/header-noauth'); ?>
		<div id="main">
			<div class="container_12">
				<div class="grid_12">
					<?php $this->load->view('forms/frmrequesregregional'); ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('users_interface/footer/footer-nomenu'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$(".activity").change(function(){
				changeActivityList(this);
			});
			
			function changeActivityList(object){
			
				var lSelectNext = 0;
				var valFinal = 0;
				var actTitle = '';
				var actID = $(object).val();
				if($("#setParam").is(":visible")){$("#setParam").hide();}
				valFinal = $(object.options[object.selectedIndex]).attr("final");
				if(valFinal == 1) $("#activityValue").val(actID);
				var curDiv = $(object).parents(".activityList");
				var lSelectCurDiv = curDiv.attr("aSelect");
				var firstDiv = $("div[class='activityList']:first");
				var lSelect = parseInt(firstDiv.attr("aSelect"));
				var lSelectCnt = $("div[class='activityList']").size();
				lSelectNext = lSelect + 1;
				if(lSelectCurDiv < lSelectCnt){
					$(curDiv).prevAll(".activityList").fadeOut(1000);
					$(curDiv).stop().animate({marginLeft:"-20px"},500);
					if(lSelectCurDiv == 1){
						$("div[aSelect='2'] select").die();
						$("div[aSelect='3'] select").die();
					}
					if(lSelectCurDiv == 2){
						$("div[aSelect='3'] select").die();
						$(curDiv).next(".activityList").stop().animate({marginLeft:"200px"},500);
					}
					$(curDiv).prevAll(".activityList").remove();
					changeActivityList(object);
				}
				if(valFinal == 1){
					actTitle = $(object.options[object.selectedIndex]).text();
					$("#newactivity").val(actTitle);
					return false;
				 }
				$(firstDiv).before('<div class="activityList" aSelect="'+lSelectNext+'" style="display:none"></div>');
				$("div[aSelect='"+lSelectNext+"']").load("<?=$baseurl;?>users/select-activity",
					{'aid':actID,'final':valFinal},
					function(){
						$("div[aSelect='"+lSelectNext+"']").nextAll(".activityList").stop().animate({marginLeft:"300px"},1000,
							function(){
								$("div[aSelect='"+lSelectNext+"']").fadeIn(1000);
								$("div[aSelect='"+lSelectNext+"'] select").live('change',function(){changeActivityList(this)});
							}
						);
					}
				);
			}
			
			
			$("#sentRequest").click(function(event){
				var err = false;
				$(".inputValid").css('border-color','#D0D0D0');
				$("#newactivity").css('border-color','#D0D0D0');
				$(".inputValid").each(function(i,element){if($(this).val()===''){$(this).css('border-color','#ff0000');err = true;}});
				if(err){event.preventDefault();msgerror('Пропущены обязательные поля');}
			});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;};
		});
	</script>
<!--[if lt IE 7 ]>
	<script src="<?= $baseurl; ?>javascript/dd_belatedpng.js?v=1"></script>
<![endif]-->

<!--
	<script src="<?= $baseurl; ?>javascript/profiling/yahoo-profiling.min.js?v=1"></script>
	<script src="<?= $baseurl; ?>javascript/profiling/config.js?v=1"></script>
<script>
	var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']]; 
	(function(d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.async = true; g.src = '//www.google-analytics.com/ga.js'; s.parentNode.insertBefore(g, s);
	})(document, 'script');
</script>
-->
</body>
</html>