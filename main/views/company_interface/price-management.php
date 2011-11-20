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
	<style type="text/css">
		div.ButtonOperation{min-height:30px;}
		.NewsDel{float: right;padding: 5px;margin-right: 10px;cursor: pointer;}
		.NewsSave{float: right;padding: 5px;cursor: pointer;}
		.h150{min-height: 150px;}
		.w918{width: 918px;}
		.rep-container{font: bold normal 125% serif;margin: 10px 0 10px 0;padding: 5px 0 5px 0;}
		#lists select{margin-right: 10px;font: bold normal 125% serif;}
		#formUnit,#gulist{margin-top:10px;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container">
		<?php $this->load->view('company_interface/header-noregion'); ?>
		<div id="main">
			<div class="container_12 framing">
				<div class="grid_12">
					<div id="validError" style="text-align:center; margin-top:20px;">
					<?= validation_errors(); ?>
					</div>
					<?php $this->load->view('company_interface/select-lists'); ?>
					<div id="frmInsProductUnit" style="display:none;">
						<?php $this->load->view('company_interface/insproductunit');?>
					</div>
					<button id="InsProductUnit" style="height:2.5em; margin-top:15px; min-width: 130px; display:none;">
						<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить позицию</font>
					</button>
					<div class="clear"></div>
					<div id="frmInsProductGroup" style="display:none;">
						<?php $this->load->view('company_interface/insproductgroup');?>
					</div>
					<button id="InsProductGroup" style="height:2.5em; margin:15px 0 15px 0; min-width: 130px; display:none;">
						<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить группу</font>
					</button>
					<div class="clear"></div>
				</div>
			</div>
			<div class="push"></div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('company_interface/footer'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lnk-logout").click(function(){$.ajax({url:"<?=$baseurl;?>shutdown",success: function(data){window.setTimeout("window.location='<?=$baseurl;?>'",1000);},error: function(){msgerror("Выход не выполнен!");}});});
			
			$("#select-activity").change(function(){
				$("#UnitSave").die();
				$("#UnitDel").die();
				$("#select-unit").die();
				$("#select-unit").remove();
				$(".digital").die();
				$("#pulist").text('');
				$("#gulist").text('');
				$("#formUnit").text('');
				if($("#frmInsProductUnit").is(":visible")){
					$("#frmInsProductUnit").slideUp("slow",function(){
						$("#frmInsProductUnit").hide();
						$("#InsProductUnit").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить позицию</font>');
					});
				}
				$("#InsProductUnit").hide();
				if($("#frmInsProductGroup").is(":visible")){
					$("#frmInsProductGroup").slideUp("slow",function(){
						$("#frmInsProductGroup").hide();
						$("#InsProductGroup").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить группу</font>');
					});
				}
				$("#InsProductGroup").hide();
				$("#select-groups").die();
				$("#select-groups").remove();
				
				$("input:hidden[name='groupvalue']").val(0);
				$("input:hidden[name='activityvalue']").val(0);
				if($(this).val()>0){
					$("#InsProductGroup").show();
					$("input:hidden[name='activityvalue']").val($(this).val());
					$("#gulist").text('Ждите идет построение списка...');
					$("#gulist").load("<?=$baseurl;?>listbox/group-unit-list/<?=$userinfo['uconfirmation'];?>",
						{'activity':$(this).val()},
						function(){
							$("#select-groups").live('change',function(){
								$("#UnitSave").die();
								$("#UnitDel").die();
								$(".digital").die();
								$("#select-unit").die();
								$("#select-unit").remove();
								$("input:hidden[name='groupvalue']").val(0);
								if($("#frmInsProductUnit").is(":visible")){
									$("#frmInsProductUnit").slideUp("slow",function(){
										$("#frmInsProductUnit").hide();
										$("#InsProductUnit").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить позицию</font>');
									});
								}
								$("#InsProductUnit").hide();
								$("#select-products").die();
								$("#formUnit").text('');
								$("#select-products").remove();
								if($("#select-groups").val()>0){
									$("#select-groups").css('float','left');
									$("input:hidden[name='groupvalue']").val($("#select-groups").val());
									$("#InsProductUnit").show();
									$("#pulist").text('Ждите идет построение списка...');
									$("#pulist").load("<?=$baseurl;?>listbox/product-cmpunit-list/<?=$userinfo['uconfirmation'];?>",
										{'group':$("#select-groups").val()},
											function(){
												$("#select-products").live('change',function(){
													$("#select-unit").die();
													$("#select-unit").remove();
													$(".digital").die();
													$("#UnitSave").die();
													$("#UnitDel").die();
													$("#formUnit").text('');
													if($("#select-products").val()>0){
														$("#select-products").css('float','left');
														$("#select-products").after('<input type="button" class="lnk-submit" id="select-unit" value="ОК"/>');
														$("#select-unit").live('click',function(){
															$("#formUnit").load("<?=$baseurl;?>company/product-cmpunit-form/<?=$userinfo['uconfirmation'];?>",
																{'group':$("#select-groups").val(),'unit':$("#select-products").val()},
																function(){
																	$(".digital").live('keypress',function(e){
																		if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
																	});
																	$("#UnitSave").live('click',function(event){
																		var title = $("#uptitle").val();
																		$("#uptitle").css('border-color','#D0D0D0');
																		if(title == ''){
																			$("#uptitle").css('border-color','#FF0000');
																			event.preventDefault();
																			msgerror('Пропущены обязательные поля');
																		}
																	});
																	$("#UnitDel").live('click',function(event){
																		event.preventDefault();
																		$.post(
																			"<?=$baseurl;?>company/product-unit-dalete/<?=$userinfo['uconfirmation'];?>",
																			{'group':$("#select-groups").val(),'unit':$("#select-products").val()},
																			function(data){
																				if(data.status){
																					$("#select-unit").die();
																					$(".digital").die();
																					$("#UnitSave").die();
																					$("#UnitDel").die();
																					$("#select-unit").remove();
																					$("#pulist").text('');
																					$("#formUnit").text('');
																					$("#gulist").text('');
																					if($("#frmInsProductUnit").is(":visible")){
																						$("#frmInsProductUnit").slideUp("slow",function(){
																							$("#frmInsProductUnit").hide();
																							$("#InsProductUnit").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить позицию</font>');
																						});
																					}
																					if($("#frmInsProductUnit").is(":visible")){
																						$("#frmInsProductUnit").slideUp("slow",function(){
																							$("#frmInsProductUnit").hide();
																							$("#InsProductUnit").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить позицию</font>');
																						});
																					}
																					$("#select-groups").die();
																					$("#select-groups").remove();
																					$("#InsProductUnit").hide();
																					$("input:hidden[name='groupvalue']").val(0);
																					$("#select-products").die();
																					$("#select-products").remove();
																					$("#select-activity").val(0);
																				}else msgerror(data.message);
																			},"json");
																						
																		});
																	}
															)
														});
													}
												});
										});
								}
							});
						}
					);
				}
			});
			
			$("#InsProductGroup").click(function(){
				$("#validError").text('');
				if($("#frmInsProductUnit").is(":visible")){
					$("#frmInsProductUnit").slideUp("slow",function(){
						$("#frmInsProductUnit").hide();
						$("#InsProductUnit").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить позицию</font>');
					});
				}
				if($("#frmInsProductGroup").is(":hidden")){
					$("#InsProductGroup").html('<img src="<?=$baseurl;?>images/arrow-curve.png"><font size="3"> Отменить</font>');
					$("#frmInsProductGroup").slideDown("slow");
					var height = $(window).height();
					$("html, body").animate({scrollTop:height+'px'},"slow");
				}else{
					$("#frmInsProductGroup").slideUp("slow",function(){
						$("#frmInsProductGroup").hide();
						$("#InsProductGroup").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить группу</font>');
						$("#formRep .inppgvalue").val('');
						$("#formRep .inppgvalue").css('border-color','#D0D0D0');
					 });
				}
			});
			
			$("#InsProductUnit").click(function(){
				$("#validError").text('');
				if($("#frmInsProductGroup").is(":visible")){
					$("#frmInsProductUnit").slideUp("slow",function(){
						$("#frmInsProductGroup").hide();
						$("#InsProductGroup").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить группу</font>');	
					});
				}
				if($("#frmInsProductUnit").is(":hidden")){
					$("#InsProductUnit").html('<img src="<?=$baseurl;?>images/arrow-curve.png"><font size="3"> Отменить</font>');
					$("#frmInsProductUnit").slideDown("slow");
					var height = $(window).height();
					$("html, body").animate({scrollTop:height+'px'},"slow");
				}else{
					$("#frmInsProductUnit").slideUp("slow",function(){
						$("#frmInsProductUnit").hide();
						$("#InsProductUnit").html('<img src="<?=$baseurl;?>images/news-plus.png"><font size="3"> Добавить позицию</font>');
						$("#formRep .inpvalue").val('');
						$("#formRep .inpvalue").css('border-color','#D0D0D0');
					 });
				}
			});
			
			$("#addProductGroup").click(function(event){
				var err = false;
				 $("#formRep .inpvalue").css('border-color','#D0D0D0');
				if($("#pgtitle").val() == ''){
					$("#pgtitle").css('border-color','#ff0000');
					event.preventDefault();
					msgerror('Пропущены обязательные поля');
				}
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