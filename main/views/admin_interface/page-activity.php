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
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/style.css?v=1">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/960.css?v=1">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/jquery-ui.css?v=1.8.5">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/sexy-combo.css">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/sexy.css">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/custom.css">
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 5px 0 0;}
		.w278{width: 278px;}
		.w358{width: 358px;}
		.w575{width: 575px;}
		.w220{width: 220px;}
		.mw220{max-width: 220px;}
		.online{margin-left: 20px;}
		.h20{min-height: 20px;}
		.h150{min-height: 150px;}
		.h365{height: 365px;}
		.nshNote{margin-bottom: 10px;}
		.nshNote ul{list-style: disc outside; padding-left: 20px; margin-bottom: 5px;}
		.nshDate{font: normal bold 90% serif;text-align: right;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
		.existAnswer{font: normal bold 90% serif;text-align: right;}
		.RightLink{float:right;}
		#lists select{margin-right: 10px;font: bold normal 125% serif;}
		#formUnit,.unitImage{margin-top:20px;}
		#pulist{margin-top:10px;}
		.btnHidden{display:none;}
		.activity,.region{font: bold normal 110% serif;margin: 0px;}
		#search-result,#region-result{margin-top:10px;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
	<?php $this->load->view('admin_interface/header-nomenu');?>
		<div id="main">
			<div class="container_12">
				<div class="grid_12" style="margin:0">
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
					<div class="grid_4">
						<h2>Поиск города:</h2>
						от 3-х символов
						<input class="edit265-form-input" id="RegionName" type="text" value=""/>
						<div class="clear"></div>
						<div id="RSV" class="btnHidden"></div>
						<div id="region-result"></div>
					</div>
					<div class="grid_2">
						<h2>&nbsp;</h2>
						<h2>&nbsp;</h2>
						<input class="btn-action" style="margin-top:0" id="setSearch" type="button" name="submit" value="Получить информацию"/>
					</div>
					<div class="clear"></div>
					<hr size="2"/>
				</div>
			</div>
			<div class="clear"></div>
			<?php if($act_empty):?>
				<div class="container_12">
					<h2>Отрасль на регионе не создана, редактирование не возможно!</h2>
					<h2>Необходимо зайти федеральным менеджером на отрасль или назначить регионального менеджера.</h2>
				</div>
				<div class="clear"></div>
			<?php else: ?>
				<?php if($fulluri):?>
					<?=$this->load->view('admin_interface/activity-box-content');?>
				<?php endif;?>
			<?php endif;?>
		</div>
		<div class="clear"></div>
	</div> <!-- end of #container -->
<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	
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
	
			$("#RegionName").keyup(function(){
				var SearchVal = $(this).val();
				if(SearchVal.length > 2){
					$("#region-result").load("<?=$baseurl;?>admin/search-region/<?=$userinfo['uconfirmation'];?>",{'search':SearchVal},
					function(){
						$("#SearchReg").die();
						$("#SearchReg").live('change',function(){
							var valID = $(this.options[this.selectedIndex]).val();
							var valTitle = $(this.options[this.selectedIndex]).text();
							$("#RSV").text(valID);
							$('#RegionName').val(valTitle);
						});
					}
				);
				}else{
					$("#SearchReg").die();
					$("#region-result").text('');
				}
			});
	
			$("#setSearch").click(function(){
				var actID = $("#ASV").text();
				var regID = $("#RSV").text();
				if(actID != '' && regID != '')
					window.setTimeout("window.location='<?=$baseurl;?>admin/edit-activity/<?=$userinfo['uconfirmation'];?>/region/"+regID+"/activity/"+actID+"'",1000);
			});
		
		$(".tooltip").click(function(event){event.preventDefault();})
		$(".edit").click(function(){
			window.location.href="<?=$baseurl;?>admin/edit-"+this.id+"/<?=$userinfo['uconfirmation']?>";
		});
		
		$("#select-group").change(function(){
			$("#select-products").die();
			$("#select-products").remove();
			$("#pulist").text('');
			if($("#select-group").val()>0){
				$("#pulist").text('Ждите идет построение списка...');
				$("#pulist").load("<?=$baseurl;?>admin-listbox/product-unit-list/<?=$userinfo['uconfirmation'];?>",
					{'group':$("#select-group").val()},
					function(){
						$("#select-products").live('change',function(){
							if($("#select-products").val()>0){
								$.post(
									"<?=$baseurl;?>admin/product-unit-info/<?=$userinfo['uconfirmation'];?>",
									{'group':$("#select-group").val(),'unit':$("#select-products").val()},
									function(data){
										$(".unitImage").html(data.image);
										$("#formUnit").html(data.note);
										if(data.longnote) $("#divNote").show();
										else $("#divNote").hide();
										$("#UnitNote").html(data.full);
										$("#UnitTitle").html(data.title);
										$("#lowprice").html(data.lowprice);
										$("#lowpricecode").html(data.lowpricecode);
										$("#optimumprice").html(data.optimumprice);
										$("#optimumpricecode").html(data.optimumpricecode);
										$("#topprice").html(data.topprice);
										$("#toppricecode").html(data.toppricecode);
										$("#risks").html(data.risks);
										$("#advantage").html(data.advantage);
									},"json");
							}
						});
					}
				);
			}
		});
		
		$("#single-select-products").change(function(){
			if($(this).val()>0){
				$.post(
					"<?=$baseurl;?>admin/product-unit-info/<?=$userinfo['uconfirmation'];?>",
					{'group':$("#hdngroup").text(),'unit':$(this).val()},
					function(data){
						$(".unitImage").html(data.image);
						$("#formUnit").html(data.note);
						if(data.longnote) $("#divNote").show();
						else $("#divNote").hide();
						$("#UnitNote").html(data.full);
						$("#UnitTitle").html(data.title);
						$("#lowprice").html(data.lowprice);
						$("#lowpricecode").html(data.lowpricecode);
						$("#optimumprice").html(data.optimumprice);
						$("#optimumpricecode").html(data.optimumpricecode);
						$("#topprice").html(data.topprice);
						$("#toppricecode").html(data.toppricecode);
						$("#risks").html(data.risks);
						$("#advantage").html(data.advantage);
					},"json");
			}
		});
		
		$("a#winProduct").click(function(e){
			$('#product-modal-content').modal();
			return false;
		});
		$("a#winPitFalls").click(function(e){
			var PF = $(this).attr("PF");
			$("#pitfalls-modal-content[PF='"+PF+"']").modal();
			return false;
		});
		$("a#winActNews").click(function(e){
			var AN = $(this).attr("AN");
			$("#single-news-modal-content[AN='"+AN+"']").modal();
			return false;
		});
		$("a#winCmpNews").click(function(e){
			var CN = $(this).attr("CN");
			$("#single-cmpnews-modal-content[CN='"+CN+"']").modal();
			return false;
		});
		$("a#winSharesModel").click(function(e){
			var ShM = $(this).attr("ShM");
			$("#single-shares-modal-content[ShM='"+ShM+"']").modal();
			return false;
		});
		$("a#winSpecialModel").click(function(e){
			var SM = $(this).attr("SM");
			$("#single-specials-modal-content[SM='"+SM+"']").modal();
			return false;
		});
		$("a#winQuestion").click(function(e){
			var quest = $(this).attr("Quest");
			$("#questions-modal-content[Quest='"+quest+"']").modal();
			return false;
		});
		$("a#winCompanyList").click(function(e){
			$("#company-modal-content").modal();
			return false;
		});
		$("a#winNews").click(function(e){
			$("#news-modal-content").modal();
			return false;
		});
		$("a#winPersona").click(function(e){
			$("#persona-modal-content").modal();
			return false;
		});
		$("a#winDocuments").click(function(e){
			$("#document-modal-content").modal();
			return false;
		});
		$("a#winSpecials").click(function(e){
			$("#specials-modal-content").modal();
			return false;
		});
		$("a#winTips").click(function(e){
			var tip = $(this).attr("TPS");
			$("#tips-modal-content[TPS='"+tip+"']").modal();
			return false;
		});
		$("input#winRisks").click(function(e){
			$("#risks-modal-content").modal();
			return false;
		});
		$("input#winAdvantage").click(function(e){
			$("#advantage-modal-content").modal();
			return false;
		});
		$("a#winUnitNote").click(function(e){
			$("#unit-modal-note-content").modal();
			return false;
		});
		$("input#lowOfferList").click(function(e){
			var product = $("#UnitTitle").text();
			var eprice = parseFloat($("#lowprice").text());
			offer_list(product,0,eprice);
		});
		$("input#optimumOfferList").click(function(e){
			var product = $("#UnitTitle").text();
			var lprice = parseFloat($("#lowprice").text());
			var oprice = parseFloat($("#optimumprice").text());
			var tprice = parseFloat($("#topprice").text());
			offer_list(product,lprice,tprice);
		});
		$("input#topOfferList").click(function(e){
			var product = $("#UnitTitle").text();
			var oprice = parseFloat($("#optimumprice").text());
			var tprice = parseFloat($("#topprice").text());
			offer_list(product,tprice,0);
		});
		
		function offer_list(product,bprice,eprice){
			$("#offerTitle").html(product);
			$("#offerList").load("<?=$baseurl;?>admin/offer-list/<?=$userinfo['uconfirmation'];?>",{'product':product,'bprice':bprice,'eprice':eprice},function(){$("#offer-modal-content").modal();});
		}
		$("#accordion").accordion({animated: false,autoHeight: false});$("#accordion-1").accordion({animated: false,autoHeight: false});$("#accordion-2").accordion({animated: false,autoHeight: false});$("#slider-range-price").slider({range: true,min: 3200,max: 15000,values: [4500, 9000],slide: function(event, ui){$("#price-amount").val(ui.values[0] + ' - ' + ui.values[1]);}});$("#slider-range-rate").slider({range: true,min: 0,max: 100,values: [15, 70],slide: function(event, ui){$("#rate-amount").val(ui.values[0] + ' - ' + ui.values[1]);}});});
	</script>
</body>
</html>