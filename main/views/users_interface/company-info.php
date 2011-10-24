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
	<link rel="stylesheet" type="text/css" href="<?=$baseurl;?>css/modal/mwindow.css" media="screen">
	<link rel="stylesheet" media="handheld" href="<?=$baseurl;?>css/handheld.css?v=1">
	<script src="<?=$baseurl;?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		#info-boxes{margin-top: 25px;}
		.company-name{margin-top: 10px;	font: normal bold 140% serif;}
		.company-text{text-align: justify;margin: 10px 0 10px 0;}
		span.text{font: bold 12px/14px "Trebuchet MS",Arial,Helvetica,sans-serif; margin: 0 5px 0 0;}
		.company-data{	margin-top: 0.3em;}
		.rep-name,news-title{font: normal bold 140% serif;}
		.w278{width: 278px;}
		.h365{height: 365px;}
		.w575{width: 575px;}
		.w600{width: 600px;}
		.h150{min-height: 150px;}
		.online{margin-left: 20px;}
		.nshDate{font: normal bold 90% serif;text-align: right;}
		.nshNote{margin-bottom: 10px;text-align:justify;}
		.nsh-title{font: normal bold 120% normal;margin: 5px 0 15px 3px;}
		.h20{min-height: 20px;}
		#lists select{margin-right: 10px;font: bold normal 125% serif;}
		#formUnit,#unitImage{margin-top:20px;}
		#pulist,#gulist{margin-top:10px;}
		.btnHidden{display:none;}
	</style>
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div id="container" class="main-wrap">
	<?php $this->load->view('users_interface/header/header-noauth'); ?>
		<div id="main">
			<section id="info-boxes">
				<div class="container_12">
					<div class="grid_8">
						<div class="box">
							<div class="box-header w600">
								<h2>Данные о компании</h2>
								<div class="box-search">
									<br/>
								</div>	
							</div>
							<div style="padding: 15px"> 
								<div class="floated">
									<img src="<?=$baseurl;?>companylogo/viewimage/<?=$company['cmp_id'];?>" alt=""/>
									<div class="company-rate">рейтинг: <?=$company['cmp_rating'];?></div>
									<div class="company-rate-graph" style="width:<?=$company['cmp_graph'];?>px;">&nbsp;</div>
								</div>
								<div class="company-name"><?=$company['cmp_name'];?></div>
								<div class="company-text"><?=$company['cmp_description'];?></div>
								<div style="clear:both"></div>
								<div class="company-data"><span class="text">Юридическое лицо: </span><?=$company['cmp_urface'];?></div>
								<div class="company-data"><span class="text">Юридический адрес: </span><?=$company['cmp_uraddress'];?></div>
								<div class="company-data"><span class="text">Фактический адрес: </span><?=$company['cmp_realaddress'];?></div>
								<div class="company-text">
									<span class="text">Реквизиты компании: </span>
									<div style="margin: 5px 20px;"><?=$company['cmp_details'];?></div>
								</div>
								<div class="company-data"><span class="text">Сайт компании: </span>
									<?=anchor($company['cmp_site'],$company['cmp_site'],array('target'=>'_blank'));?>
								</div>
								<div class="company-data"><span class="text">E-Mail компании: </span>
									<?=safe_mailto($company['cmp_email'],$company['cmp_email']);?>
								</div>
								<div class="company-data"><span class="text">Контактный телефон: </span><?=$company['cmp_phone'];?></div>
								<div class="company-data"><span class="text">Телефон/факс: </span><?=$company['cmp_telfax'];?></div>
								<!--<div class="company-data"><span class="text">Ассоциация :</span>В ассоциации не стоит</div>-->
							</div>
							<div class="box-bottom-links h20">
								<div class="right">&nbsp;</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="box">
							<div class="box-header w600">
								<h2>Прайс компании</h2>
								<div class="box-search"></div>
							</div>
							<div class="box-content h150">
							<?php if($unitgroups || $units): ?>
								<div id="lists">
								<?php if($unitgroups): ?>
									<select name="grouplist" id="select-group" class="mixed-combo" size="1" style="width: 250px;">
										<option value="0">Выберите группу</option>
									<?php for($i=0;$i<count($unitgroups);$i++):?>
										<option value="<?=$unitgroups[$i]['prg_id'];?>"><?=$unitgroups[$i]['prg_title'];?></option>
									<?php endfor; ?>
									</select>
									<div id="pulist"></div>
								<?php else: ?>
									<div id="hdngroup" class="btnHidden"><?=$group;?></div>
									<div id="pulist"></div>
								<?php endif;?>
								</div>
							<?php endif; ?>
								<div class="clear"></div>
								<div id="formUnit">
									<table class="price-table">
										<thead>
											<tr>
												<th style="width: 100px">Фото</th>
												<th style="width: 400px">Позиция</th>
												<th style="width: 150px">Цена</th>
												<th style="width: 120px">Единицы</th>
											</tr>
										</thead>
										<tbody>
										<?php for($i=0;$i<count($units);$i++):?>
											<tr>
												<td>
												<img src="<?=$baseurl;?>curavatar/viewimage/<?=$units[$i]['cu_id'];?>"class="floated" alt=""/>
												</td>
												<td>
													<p><strong><?=$units[$i]['cu_title'];?></strong></p>
													<p><?=$units[$i]['cu_note'];?></p>
												</td>
												<td class="col-price-company"><?=$units[$i]['cu_price'];?></td>
												<td class=""><strong><?=$units[$i]['cu_priceunit'];?><?php if($units[$i]['cu_unitscode']):?>/<?=$units[$i]['cu_unitscode'];?><?php endif;?></strong></td>
											</tr>
										<?php endfor;?>
										</tbody>
									</table>
								</div>
								<div class="clear"></div>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">&nbsp;</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<div class="grid_4">
						<div class="box">
							<div class="box-header w278">
								<h2>Представитель компании</h2>
								<div class="box-search"></div>	
							</div>
							<div class="box-content">
								<img src="<?=$baseurl;?>cravatar/viewimage/<?=$representative['uid'];?>" class="floated" alt=""/>
								<div class="rep-name">
									<?=$representative['uname'].' '.$representative['usubname'].' '.$representative['uthname'];?>
								</div>
								<div class="company-data"><span class="text">Должность: </span><?=$representative['uposition'];?></div>
								<div class="company-data"><span class="text">Tелефон: </span><?=$representative['uphone'];?></div>
								<div class="company-data"><span class="text">E-Mail: </span>
									<?=safe_mailto($representative['uemail'],$representative['uemail']);?>
								</div>
								<div style="clear:both"></div>
								<?php if($representative['uactive'] and $representative['uid'] != $userinfo['uid']): ?>
									<img src="<?=$baseurl;?>images/online.gif" class="online" border="0" title="Пользователь в сети" alt=""/>
								<?php endif; ?>
							</div>
							<div class="box-bottom-links">
								<div class="right">
							<?=anchor('representatives/company/'.$company['cmp_id'],'Все представители');?>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="box">
							<div class="box-header w278">
								<h2>Новости компании</h2>
								<div class="box-search"></div>
							</div>
							<div class="box-content">
							<?php if(count($news)): ?>
								<?php for($i=0;$i<count($news);$i++): ?>
								<div class="content-separator">
									<div class="nshDate"><?=$news[$i]['cn_pdatebegin'];?></div>
									<img src="<?=$baseurl;?>cnavatar/viewimage/<?=$news[$i]['cn_id'];?>" class="floated" alt=""/>
									<div class="nsh-title"><?=$news[$i]['cn_title'];?></div>
									<div class="nshNote"><?=$news[$i]['cn_note'];?></div>
								</div> 
								<?php endfor; ?>
							<?php else: ?>
								<span class="text">Новости отсутствуют</span>
							<?endif; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<a href="#" id="winNews" class="window">Полный список</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					<?php if(count($news)): ?>
						<div id="news-modal-content">
							<div class="box">
								<div class="box-header"><b>Новости компании</b>
									<div class="box-search">&nbsp;</div>
								</div>
								<div class="box-content h365 w575">
								<?php for($i=0;$i<count($news);$i++): ?>
									<div class="content-separator">
										<div class="nshDate"><?=$news[$i]['cn_pdatebegin'];?></div>
										<img src="<?=$baseurl;?>cnavatar/viewimage/<?=$news[$i]['cn_id'];?>" class="floated" alt=""/>
										<div class="nsh-title"><?=$news[$i]['cn_title'];?></div>
										<div class="nshNote"><?=$news[$i]['full_note'];?></div>
									</div> 
								<?php endfor; ?>
								</div>
								<div class="box-bottom-links h20">&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
					<?php else: ?>
						<div id="news-modal-content">
							<div class="box">
								<div class="box-header"><b>Новости компании</b>
									<div class="box-search">&nbsp;</div>
								</div>
								<div class="box-content h365 w575">
									<span class="text">Список пуст</span>
									<div class="clear"></div>
								</div>
								<div class="box-bottom-links h20">&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
					<?php endif; ?>
						<div class="box">
							<div class="box-header w278">
								<h2>Акции компании</h2>
								<div class="box-search"></div>
							</div>
							<div class="box-content">
							<?php if(count($shares)): ?>
								<?php for($i=0;$i<count($shares);$i++): ?>
								<div class="content-separator">
									<div class="nshDate"><?=$shares[$i]['sh_pdatebegin'];?></div>
									<img src="<?=$baseurl;?>cshavatar/viewimage/<?=$shares[$i]['sh_id'];?>" class="floated" alt=""/>
									<div class="nsh-title"><?=$shares[$i]['sh_title'];?></div>
									<div class="nshNote"><?=$shares[$i]['sh_note'];?></div>
								</div> 
								<?php endfor; ?>	
							<?php else: ?>
								<span class="text">Акции отсутствуют</span>
							<?endif; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<a href="#" id="winSpecials" class="window">Полный список</a>
								</div>
							</div>
						</div>
						<?php if(count($shares)): ?>
						<div id="specials-modal-content">
							<div class="box">
								<div class="box-header"><b>Акции компании</b>
									<div class="box-search">&nbsp;</div>
								</div>
								<div class="box-content h365 w575">
								<?php for($i=0;$i<count($shares);$i++): ?>
									<div class="content-separator">
										<div class="nshDate"><?=$shares[$i]['sh_pdatebegin'];?></div>
										<img src="<?=$baseurl;?>cshavatar/viewimage/<?=$shares[$i]['sh_id'];?>" class="floated" alt=""/>
										<div class="nsh-title"><?=$shares[$i]['sh_title'];?></div>
										<div class="nshNote"><?=$shares[$i]['full_note'];?></div>
									</div> 
								<?php endfor; ?>	
								</div>
								<div class="box-bottom-links h20">&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
					<?php else: ?>
						<div id="specials-modal-content">
							<div class="box">
								<div class="box-header"><b>Акции компании</b>
									<div class="box-search">&nbsp;</div>
								</div>
								<div class="box-content h365 w575">
									<span class="text">Список пуст</span>
									<div class="clear"></div>
								</div>
								<div class="box-bottom-links h20">&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('users_interface/footer/footer-nomenu'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?=$baseurl;?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#select-group").change(function(){
				$("#pulist").text('');
				if($("#select-group").val()>0){
					$("#select-group").css('float','left');
					$("#pulist").text('Ждите идет построение списка...');
					$("#formUnit").load("<?=$baseurl;?>company/products-group-list",
						{'group':$("#select-group").val(),'company':<?=$company['cmp_id'];?>},
						function(data){$("#pulist").text('');},"json");
				}
			});
			$("a#winNews").click(function(e){
				$("#news-modal-content").modal();
				return false;
			});
			$("a#winSpecials").click(function(e){
				$("#specials-modal-content").modal();
				return false;
			});
		});
	</script>
</body>
</html>