<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<link rel="stylesheet" href="<?= $baseurl; ?>css/sexy-combo.css">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/sexy.css">
	<link rel="stylesheet" href="<?= $baseurl; ?>css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<style type="text/css">
		.w575{width: 575px;}
		.h20{min-height: 20px;}
		.h365{height: 365px;}
		.FontRed{color:#FF0000; font: bold 120% serif;}
		.btnHidden{display:none;}
	</style>
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]--> 
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
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
					<?= validation_errors(); ?>
					<div class="box wide">
						<div class="box-header">
							<h2>Список возможных консультаций</h2>
							<div class="box-search"></div>
						</div>
						<div class="box-content">
							<table class="price-table">
								<thead>
									<tr>
										<th style="width: 40px">№ п\п</th>
										<th style="width: 250px">Название</th>
										<th style="width: 500px">Описание</th>
										<th style="width: 120px">Стоимость (руб.)</th>
										<th style="width: 150px">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								<?php for($i=0;$i<count($consult);$i++):?>
									<tr>
										<td id=""><?=$i+1;?></td>
										<td id="tt<?=$i;?>"><?=$consult[$i]['cnsl_title'];?></td>
										<td id="tn<?=$i;?>"><?=$consult[$i]['cnsl_note'];?></td>
										<td class="col-price-company" id="tp<?=$i;?>"><?=$consult[$i]['cnsl_price'];?></td>
										<td>
											<button class="Execution" pN="<?=$consult[$i]['cnsl_period'];?>" cID="<?=$i;?>">
												<font size="2">Подать заявку</font>
											</button>
										</td>
									</tr>
								<?php endfor;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div id="consultations-modal-content">
				<?php $this->load->view('forms/frmapplyconsult'); ?>
			</div>
		</div>
		<?php $this->load->view('users_interface/footer/footer'); ?>
	</div> <!-- end of #container -->
<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script src="<?= $baseurl; ?>javascript/jquery.bgiframe.min.js?v=1"></script>
	<script src="<?= $baseurl; ?>javascript/jquery.sexy-combo.pack.js?v=1"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/cufon-yui.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script src="<?= $baseurl; ?>javascript/script.js?v=1"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$(".Execution").click(function(){
				var curID = $(this).attr("cID");
				var price = $("#tp"+curID).text();
				var period = $(this).attr("pN");
				$("#PriceVal").val(price);
				$("#userPeriod").text(period);
				$("#userPrice").text(price);
				$("#period option:hidden").show();
				for(var i=1;i<period;i++) $("#op"+i).hide();
				$("#period").val(period);
				$("#consultations-modal-content").modal();
				return false;
			});
		$("#period").change(function(){
			var price =  $("#userPrice").text();
			var period = $("#userPeriod").text();
			var curPeriod = $(this).val();
			var subperiod = curPeriod-period;
			if(subperiod > 0){
				subprice = subperiod*0.2;
				newprice = price - (price*subprice);
				$("#PriceVal").val(Math.round(newprice));
			}else{
				$("#PriceVal").val(price);
			}
		});
		$("#SendApply").click(function(event){
			var err = false;
			 $("#formRep .inpvalue").css('border-color','#D0D0D0');
			 var name = $("#name").val();
			 var email = $("#email").val();
			 var phone = $("#phone").val();
			 var period = $("#period").val();
			 var price = $("#PriceVal").val();
			 var message = $("#message").val();
			if(name == ''){
				err = true;
				$("#name").css('border-color','#ff0000');
			}
			if(email == ''){
				err = true;
				$("#email").css('border-color','#ff0000');
			}
			if(phone == ''){
				err = true;
				$("#phone").css('border-color','#ff0000');
			}
			if(message == ''){
				err = true;
				$("#message").css('border-color','#ff0000');
			}
			if(err){
				event.preventDefault();
				$("#error").html('<font size="3" color="#FF0000"><b>Пропущены обязательные поля</b></font>');
			}else if(!isValidEmailAddress(email)){
				event.preventDefault();
				$("#error").html('<font size="3" color="#FF0000"><b>Не верный E-mail</b></font>');
			}
		});
		function isValidEmailAddress(emailAddress){
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
		};
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