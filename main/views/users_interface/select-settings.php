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
		.w575{width: 575px;}
		.h20{min-height: 20px;}
		#dregion {padding: 10px 0 20px 10px;}
		.activity,.region{font: bold normal 125% serif;margin: 0px;}
		.activityList,.regionList{margin-top: 10px;margin-left: -20px;}
		.btnHidden{display:none;}
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
					<div class="grid_8 prefix_2">
						<img usemap="#rusmap" src="<?=$baseurl;?>images/rusmap_b.png" border="0" height="413" width="640">
					</div>
					<div class="clear"></div>
				</div>
				<div class="grid_12">
					<h2>Укажите отросль <span class="necessarily" title="Выбор отросли обязателен">*</span></h2>
					<div class="clear"></div>
					<input type="hidden" name="activity" value="" id="activityValue" />
					<div class="activityList" aSelect="1">
						<?php $this->load->view('users_interface/activity-box-select'); ?>
					</div>
				</div>
				<div class="clear"></div>
				<div class="grid_12">
					<div id="divHidden" style="display:none">
						<h2>Укажите регион <span class="necessarily" title="Выбор региона обязателен">*</span></h2>
						<div class="clear"></div>
						<input type="hidden" name="region" value="" id="regionValue" />
						<div class="regionList" lSelect="1">
							<?php $this->load->view('users_interface/region-box-select'); ?>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<input class="btn-action margin-1em btnHidden" id="setParam" type="button" name="submit" value="Получить информацию"/>
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
			
			$(".region").change(function(){
				changeRegionList(this);
			});
			
			$(".activity").change(function(){
				changeActivityList(this);
			});
			
			function changeRegionList(object){
			
				var lSelectNext = 0;
				$("#regionValue").val('');
				if($("#setParam").is(":visible")){$("#setParam").hide();}
				var regTitle = object.options[object.selectedIndex].text;
				var curDiv = $(object).parents(".regionList");
				var lSelectCurDiv = curDiv.attr("lSelect");
				if(lSelectCurDiv == 3){
					var regID = $(object).val();
					$("#regionValue").val(regID);
				}
				var firstDiv = $("div[class='regionList']:first");
				var lSelect = parseInt(firstDiv.attr("lSelect"));
				var lSelectCnt = $("div[class='regionList']").size();
				lSelectNext = lSelect + 1;
				if(lSelectCurDiv < lSelectCnt){
					$(curDiv).prevAll(".regionList").fadeOut(1000);
					$(curDiv).stop().animate({marginLeft:"0px"},500);
					if(lSelectCurDiv == 1){
						$("div[lSelect='2'] select").die();
						$("div[lSelect='3'] select").die();
					}
					if(lSelectCurDiv == 2) $("div[lSelect='3'] select").die();
					$(curDiv).prevAll(".regionList").remove();
					changeRegionList(object);
				}
				if(lSelectCurDiv == 3){$("#setParam").show(); return false;}
				$(firstDiv).before('<div class="regionList" lSelect="'+lSelectNext+'" style="display:none"></div>');
				$("div[lSelect='"+lSelectNext+"']").load("<?=$baseurl;?>users/select-region",
					{'rtitle':regTitle,'lselect':lSelect},
					function(){
						$("div[lSelect='"+lSelectNext+"']").nextAll(".regionList").stop().animate({marginLeft:"300px"},1000,
							function(){
								$("div[lSelect='"+lSelectNext+"']").fadeIn(1000);
								$("div[lSelect='"+lSelectNext+"'] select").live('change',function(){changeRegionList(this)});
							}
						);
					}
				);
			}
			
			function changeActivityList(object){
			
				var lSelectNext = 0;
				var valFinal = 0;
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
					$("#divHidden").fadeIn(500);
					var rID = $("#regionValue").val();
					if(rID) $("#setParam").show();
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
			
			$("#setParam").click(function(event){
			
				var actID = $("#activityValue").val();
				var regID = $("#regionValue").val();
				if(actID == '' || regID == ''){
					$(this).css('float','left');
					$(this).after('<div class="valid_error">Ошибка! Повторите выбор снова</div>');
					$(".valid_error").fadeOut(3000,function(){$(this).remove();});
				}else
					window.setTimeout("window.location='<?=$baseurl;?>activity-information/region/"+regID+"/activity/"+actID+"'",1000);
			});
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