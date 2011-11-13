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
	<style type="text/css">
		.h150{min-height: 150px; max-height:none;}
		.w918{width: 918px;}
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
							<h2>Формирование стоимости</h2>
							<div class="box-search">
					<?=anchor("activity-information/region/$curregion/activity/$curactivity",'Вернуться назад',array('class'=>'lnk-submit'));?>
							</div>
						</div>
						<div class="box-content h150 w918">
							<div id="diagramma" class="grid_6"></div>
							<div class="grid_5">
								<label class="label-input">Комментарий</label>
								<?=$comment;?>
							</div>
							<div class="clear"></div>
						</div>
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
	<script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.pieRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.donutRenderer.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);}});});
		var data = [];
		<?php for($i=0;$i<count($graph);$i++):?>
			data[<?=$i;?>] = ["<?=$graph[$i]['prn_title'];?>",<?=$graph[$i]['prn_percent'];?>]
		<?php endfor;?>
			var plot = jQuery.jqplot('diagramma',[data],{seriesDefaults:{renderer: jQuery.jqplot.PieRenderer,rendererOptions:{showDataLabels: true}},legend:{show:true,location:'e'}});
		});
	</script>
</body>
</html>