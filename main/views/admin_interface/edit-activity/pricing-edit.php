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
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		.hedden{display: none;}
		.h150{min-height: 150px; max-height:none;}
		.w918{width: 918px;}
		.chackForAll{float:right;margin: 10px 0 0 0;font: normal bold 125% normal;}
		.msgForAll{float:right;margin: 5px 0 0 0;}
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
			<?php $this->load->view('forms/frmpricingedit'); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/shCore.min.js"></script>
    <script type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/shBrushXml.min.js"></script>
	<script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.pieRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?=$baseurl;?>javascript/jqplot/jqplot.donutRenderer.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		<?php if(count($graph)<2):?>
			$("#btnDelPosition").addClass("hedden");
		<?php endif;?>
		$("#forAllRegion").removeAttr("checked");
		var data = [];
		<?php for($i=0;$i<count($graph);$i++):?>
			data[<?=$i;?>] = ["<?=$graph[$i]['prn_title'];?>",<?=$graph[$i]['prn_percent'];?>]
		<?php endfor;?>
			var plot = jQuery.jqplot('diagramma',[data],{seriesDefaults:{renderer: jQuery.jqplot.PieRenderer,rendererOptions:{showDataLabels: true}},legend:{show:true,location:'e'}});
			$("#forAllRegion").click(function(){if(this.checked)$("#msgAllRegion").text("Информация в других регионах будет перезаписана");else $("#msgAllRegion").html("&nbsp;");});
			$("#savePricing").click(function(event){
				var err = false;
				$(".inpval").css('border-color','#C0C0C0 #D9D9D9 #D9D9D9');
				$(".inpval").each(function(i,element){if($(this).val()===''){$(this).css('border-color','#FF0000');err = true;}});
				if(err){
					event.preventDefault();
					msgerror("Пропущены обязательные поля!");
					return false;
				}
				$(".percent").each(function(i,element){if(isNaN($(this).val())){$(this).css('border-color','#FF0000');err = true;}});
				if(err){
					event.preventDefault();
					msgerror("Проценты должны быть указаны цифрами!");
					return false;
				}
				var total = 0;
				$(".percent").each(function(i,element){total += parseInt($(this).val());});
				if(!err && total != 100){
					event.preventDefault();
					$(".percent").css('border-color','#FF0000');
					msgerror("Сумма не равна 100%!");
					return false;
				}
			});
			$("#btnAddPosition").click(function(){var lastObj = $("div[list='jobLine']:last");$(lastObj).after('<div list="jobLine"></div>');lastObj = $("div[list='jobLine']:last");$(lastObj).load("<?=$baseurl;?>admin/form-prnposition/<?=$userinfo['uconfirmation'];?>",function(){var cnt = $("div[list='jobLine']").size();if(cnt > 1) $("#btnDelPosition").show();});});
			$("#btnDelPosition").click(function(){$("div[list='jobLine']:last").remove();var cnt = $("div[list='jobLine']").size();if(cnt <= 1) $("#btnDelPosition").hide();});
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);}});});
			function msgerror(msg){$.blockUI({message: msg,css:{border:'none', padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}});window.setTimeout($.unblockUI,2000);return false;};
		});
	</script>
</body>
</html>