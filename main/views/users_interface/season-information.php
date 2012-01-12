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
	<link rel="stylesheet" href="<?=$baseurl;?>css/jqplot/jquery.jqplot.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/jqplot/shCoreDefault.min.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/jqplot/shThemejqPlot.min.css">
<!--[if lt IE 9]>
	<script language="javascript" type="text/javascript" src="<?=$baseurl;?>css/jqplot/excanvas.js"></script>
<![endif]-->
	<style type="text/css">
		.h450{min-height: 450px; max-height:none;}
		.w918{width: 918px;}
		.jqplot-point-label {white-space: nowrap;}
		div.jqplot-target{height: 400px;width: 750px;margin: 10px 0 10px 70px;}
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
					<div class="box">
						<div class="box-header">
							<h2>Сезонное изменение цен</h2>
							<div class="box-search">
					<?=anchor("activity-information/region/$curregion/activity/$curactivity",'Вернуться назад',array('class'=>'lnk-submit'));?>
							</div>
						</div>
						<div class="box-content h450 w918">
					<?php if($graph):?>
							<div id="diagramma"></div>
							<div class="clear"></div>
							<hr size="2"/>
							<div class="grid_6 alpha">
						<?php for($i=0;$i<6;$i++):?>
							<?php if(!empty($graph[$i]['snp_title'])):?>
								<?='<b>'.$graph[$i]['snp_month'].'</b> - '.$graph[$i]['snp_title'].'<br/>';?>
							<?php endif;?>
						<?php endfor;?>
							</div>
						<?php for($i=6;$i<12;$i++):?>
							<?php if(!empty($graph[$i]['snp_title'])):?>
								<?='<b>'.$graph[$i]['snp_month'].'</b> - '.$graph[$i]['snp_title'].'<br/>';?>
							<?php endif;?>
						<?php endfor;?>
							<div class="clear"></div>
							<label class="label-input">Комментарий</label>
							<?=$comment;?>
					<?php else:?>
							<div style="text-align:center;margin-top:50px;">Информация отсутствует</div>
					<?php endif;?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('manager_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/shCore.min.js"></script>
    <script type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/shBrushXml.min.js"></script>
	<script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.logAxisRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.canvasTextRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.canvasAxisLabelRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.canvasAxisTickRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.dateAxisRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.categoryAxisRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.barRenderer.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);}});});
		var data1 = [];
		var data2 = [];
		<?php for($i=0;$i<count($graph);$i++):?>
			data1[<?=$i;?>] = ["<?=$graph[$i]['snp_month'];?>",<?=$graph[$i]['snp_percent'];?>]
			data2[<?=$i;?>] = ["<?=$graph[$i]['snp_month'];?>",100]
		<?php endfor;?>
			var plot = $.jqplot('diagramma',[data1,data2,data1],{animate: !$.jqplot.use_excanvas,animateReplot: true,seriesColors: ["#00c4c4", "#ff0000","#0000ff"],seriesDefaults: {rendererOptions: {smooth: true,animation: {show: true}},showMarker: false},series:[{renderer:$.jqplot.BarRenderer,rendererOptions: {animation:{speed: 2500},barWidth: 40,highlightMouseOver: false}}],axes:{xaxis:{renderer: $.jqplot.CategoryAxisRenderer,label: 'Месяцы года',labelRenderer: $.jqplot.CanvasAxisLabelRenderer,tickRenderer: $.jqplot.CanvasAxisTickRenderer,tickOptions:{angle: -45,fontFamily: 'Courier New',fontSize: '10pt'}},yaxis: {label: 'Cтоимость, %',labelRenderer: $.jqplot.CanvasAxisLabelRenderer,tickOptions:{fontFamily: 'Courier New',fontSize: '10pt'},min: 0,max: <?=$axismax;?>,tickInterval: 10,}}});
		});
	</script>
</body>
</html>