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
	<link rel="stylesheet" href="<?=$baseurl;?>css/jqplot/jquery.jqplot.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/jqplot/shCoreDefault.min.css">
	<link rel="stylesheet" href="<?=$baseurl;?>css/jqplot/shThemejqPlot.min.css">
<!--[if lt IE 9]>
	<script language="javascript" type="text/javascript" src="<?=$baseurl;?>css/jqplot/excanvas.js"></script>
<![endif]-->
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.hedden{display: none;}
		.h150{min-height: 150px; max-height:none;}
		.w918{width: 918px;}
		.chackForAll{float:right;margin: 10px 0 0 0;font: normal bold 125% normal;}
		.msgForAll{float:right;margin: 5px 0 0 0;}
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
	<?php $this->load->view('manager_interface/header-noregion'); ?>
		<div id="main">
			<div class="container_12">
			<?php $this->load->view('forms/frmseasonedit'); ?>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('manager_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
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
		$(document).ready(function(){
		$("#forAllRegion").removeAttr("checked");
		var data1 = [];
		var data2 = [];
		<?php for($i=0;$i<count($graph);$i++):?>
			data1[<?=$i;?>] = ["<?=$graph[$i]['snp_month'];?>",<?=$graph[$i]['snp_percent'];?>]
			data2[<?=$i;?>] = ["<?=$graph[$i]['snp_month'];?>",100]
		<?php endfor;?>
			
			var plot = $.jqplot('diagramma',[data1,data2,data1],{animate: !$.jqplot.use_excanvas,animateReplot: true,seriesColors: ["#00c4c4", "#ff0000","#0000ff"],seriesDefaults: {rendererOptions: {smooth: true,animation: {show: true}},showMarker: false},series:[{renderer:$.jqplot.BarRenderer,rendererOptions: {animation:{speed: 2500},barWidth: 40,highlightMouseOver: false}}],axes:{xaxis:{renderer: $.jqplot.CategoryAxisRenderer,label: 'Месяцы года',labelRenderer: $.jqplot.CanvasAxisLabelRenderer,tickRenderer: $.jqplot.CanvasAxisTickRenderer,tickOptions:{angle: -45,fontFamily: 'Courier New',fontSize: '10pt'}},yaxis: {label: 'Cтоимость, %',labelRenderer: $.jqplot.CanvasAxisLabelRenderer,tickOptions:{fontFamily: 'Courier New',fontSize: '10pt'},min: 0,max: <?=$axismax;?>,tickInterval: 10,}}});
			
			$(".digital").keypress(function(e){
				if($(this).val() == '' && e.which == 48) return false;
				if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
				if($(this).val().length > 2) {$(this).val('')}
			});
			$("#forAllRegion").click(function(){if(this.checked)$("#msgAllRegion").text("Информация в других регионах будет перезаписана");else $("#msgAllRegion").html("&nbsp;");});
			
			$("#saveSeason").click(function(event){
				var err = false;
				$(".inpval").css('border-color','#C0C0C0 #D9D9D9 #D9D9D9');
				$(".inpval").each(function(i,element){if($(this).val()==''){$(this).css('border-color','#FF0000');err = true;}});
				if(err){
					event.preventDefault();
					msgerror("Пропущены обязательные поля!");
					return false;
				}
				$(".digital").each(function(i,element){if(isNaN($(this).val())){$(this).css('border-color','#FF0000');err = true;}});
				if(err){
					event.preventDefault();
					msgerror("Проценты должны быть указаны цифрами!");
					return false;
				}
			});
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);}});});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;};
		});
	</script>
</body>
</html>