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
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 5px 0 0;}
		.h150{min-height: 150px;}
		.w918{width: 918px;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
		.chackForAll{float:right;margin: 10px 10px 0 0;font: normal bold 125% normal;}
		.msgForAll{float:right;margin: 30px -155px 0 0;}
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
			<div class="container_12">
				<?php $this->load->view('forms/frmproductedit'); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>ckfinder/ckfinder.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var config = {
				skin : 'v2',
				removePlugins : 'scayt',
				resize_enabled: false,
				height: '200px',
				toolbar:
				[
					['Source','-','Preview','-','Templates'],
					['Cut','Copy','Paste','PasteText'],
					['Undo','Redo','-','SelectAll','RemoveFormat'],
					'/',
					['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
					['NumberedList','BulletedList','-','Outdent','Indent'],
					['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					['Link','Unlink'],
					'/',
					['Format','-'],
					['Image','Table','HorizontalRule','SpecialChar','-'],
					['Maximize', 'ShowBlocks']
				]
			};
			$('#prNote').ckeditor(config);
			var editor = $('#prNote').ckeditorGet();
			CKFinder.setupCKEditor(editor,"<?= $baseurl.'ckfinder/'; ?>");
			$("#forAllRegion").click(function(){
			if(this.checked)
				$("#msgAllRegion").text("Вся информация о продуктах в других регионах будет перезаписана");
			else
				$("#msgAllRegion").html("&nbsp;");
				
		});
		});
	</script>
</body>
</html>