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
	<link rel="stylesheet" href="<?=$baseurl;?>css/admin.css">
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<!--[if lt IE 7]>
	<link type="text/css" href="<?=$baseurl;?>css/modal/mwindow_ie.css" rel="stylesheet" media="screen" />
	<![endif]-->
	<style type="text/css">
		.h960{max-height: none; min-height: 470px;}
		.w918{width: 918px;}
		.w960{width: 960px;}
		.h365{height: 365px;}
		.w575{width: 575px;}
		div.ButtonOperation{min-height:30px;}
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
			<section id="frmlogin"><br/>
				<div class="container_12">
					<?php $this->load->view("admin_interface/company-list-content");?>
				</div>
				<div id="offer-modal-content">
					<div class="box">
						<div class="box-header"><div id="mdTitle">&nbsp;</div>
							<div class="box-search">&nbsp;</div>
						</div>
						<div class="box-content h365 w575">
							<div id="mdList">&nbsp;</div>
							<?php $this->load->view("forms/add-company-activity");?>
						</div>
						<div class="box-bottom-links h20">&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div><!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		var curID = 0;
		
		$(".parentid").keypress(function(e){
			if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
		});
		$(".final").keypress(function(e){
			if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>49))return false;
			if($(this).val().length > 0){$(this).val('');}
		});
		$(".digital").keypress(function(e){
				if($(this).val() == '' && e.which == 48) return false;
				if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
				if($(this).val().length > 3) {$(this).val('')}
			});
		$("#addActivity").click(function(){
			var cID = $("td[rID='"+curID+"']").text();
			var actID =$("#AddActivity").val();
			if(cID && actID){
				$.post("<?=$baseurl;?>admin/add-company-activity/<?=$userinfo['uconfirmation'];?>",
					{'id':cID,'activity':actID},
					function(data){
						if(data.status){
							$(".region-table > tbody").append("<tr><td>"+data.actid+"</td><td style='text-align:left;'>"+data.acttitle+"</td><td><span style='color:#00FF00'>Открыта</span></td><td>&nbsp;</td></tr>");
						}else{
							msgerror(data.message);
						}
					},"json");
			}
		});
		
		$(".btnSave").click(function(){
			var err = false;
			curID = $(this).attr("rID");
			var cID = $("td[rID='"+curID+"']").text();
			var objRating = $("#vRating"+curID);
			var valRating = $(objRating).val();
			var objOffers = $("#vOffers"+curID);
			var valOffers = $(objOffers).val();
			var objStatus = $("#vStatus"+curID);
			var valStatus = $(objStatus).val();
			$(objRating).css('border-color','#D0D0D0');
			$(objOffers).css('border-color','#D0D0D0');
			$(objStatus).css('border-color','#D0D0D0');
			if(valRating == "" && valRating != 0){$(objActivity).css('border-color','#ff0000');err = true;}
			if(valOffers == ""){$(objOffers).css('border-color','#ff0000');err = true;}
			if(valStatus == ""){$(objStatus).css('border-color','#ff0000');err = true;}
			if(err){
				msgerror('Пропущены обязательные поля');
				return false;
			}else{
				$.post("<?=$baseurl;?>admin/save-company/<?=$userinfo['uconfirmation'];?>",
				{'id':cID,'rating':valRating,'offers':valOffers,'status':valStatus},
				function(data){
					if(data.status){
						$(objRating).val(data.rating);
						$(objOffers).val(data.offers);
						$(objStatus).val(data.statuscmp);
						$(objRating).css('border-color','#00ff00');
						$(objOffers).css('border-color','#00ff00');
						$(objStatus).css('border-color','#00ff00');
					}else{
						msgerror(data.message);
					}
				},"json");
			};
		});	
		$(".btnDel").click(function(){
			if(!confirm('Закрыть компанию?')) return false;
			curID = $(this).attr("rID");
			var uID = $("td[rID='"+curID+"']").text();
			var btnID = this.id;
			$.post(
				"<?=$baseurl;?>admin/delete-company/<?=$userinfo['uconfirmation'];?>",
				{'id':uID},
				function(data){
					$('#'+btnID).fadeOut("slow");
					$("#vStatus"+curID).val('0');
					msgerror(data.message);
				},"json");
		});
		$(".StatusOff").click(function(){
			if(!confirm('Восстановить компанию?')) return false;
			curID = $(this).attr("rID");
			var uID = $("td[rID='"+curID+"']").text();
			var btnID = this.id;
			$.post(
				"<?=$baseurl;?>admin/restore-company/<?=$userinfo['uconfirmation'];?>",
				{'id':uID},
				function(data){
					$('#'+btnID).fadeOut("slow");
					$("#vStatus"+curID).val('0');
					msgerror(data.message);
				},"json");
		});
		
		$(".btnActivity").click(function(e){
			curID = $(this).attr("rID");
			var cmpID = $("td[rID='"+curID+"']").text();
			var title = $("#cn"+curID).text();
			$("#mdTitle").html(title);
			$("#mdList").load("<?=$baseurl;?>admin/activity-company/<?=$userinfo['uconfirmation'];?>",{'id':cmpID},function(){$("#offer-modal-content").modal();});
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