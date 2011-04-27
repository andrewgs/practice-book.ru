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
	<link rel="stylesheet" type='text/css' href="<?=$baseurl;?>css/custom.css">
	
	<link rel="stylesheet" media="handheld" href="<?= $baseurl; ?>css/handheld.css?v=1">
	<script src="<?= $baseurl; ?>javascript/modernizr-1.5.min.js"></script>
	<style type="text/css">
		span.text{
			font: bold small-caps 12px/14px sans-serif;
			margin: 0 5px 0 0;
		}
		.w278{
			width: 278px;
		}
		.w358{
			width: 358px;
		}
		.w575{
			width: 575px;
		}
		.w220{
			width: 220;
		}
		.online{
			margin-left: 20px;
		}
		.h20{
			min-height: 20px;
		}
		.h150{
			min-height: 150px;
		}
		.h365{
			height: 365px;
		}
		.nshNote{
			margin-bottom: 10px;
		}
		.nshDate{
			font: italic bold 90% serif;
			text-align: right;
		}
		.nsh-title{
			font: normal bold 120% normal;
			margin: 5px 0 15px 3px;
		}
		.existAnswer{
			font: italic bold 90% serif;
			text-align: right;
		}
		.RightLink{
			float:right;
		}
		#lists select{
			margin-right: 10px;
			font: bold italic 125% serif;
		}
		#formUnit,#unitImage{
			margin-top:20px;
		}
		#pulist{
			margin-top:10px;
		}
		.btnHidden,#addPitfallsForm,#AskQuestionForm{
			display:none;
		}
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
			<section id="info-boxes">
				<div class="container_12">
					<div class="grid_4 alpha">
						<div class="box">
							<div class="box-header w278">
								<h2><?= $othertext[0]['otxt_note']; ?></h2> 
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[0]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content">
							<?php if($product && !empty($product['pr_note'])): ?>
								<img src="<?=$baseurl;?>mpavatar/viewimage/<?=$product['pr_id'];?>" class="floated" alt=""/>
								<div class="nsh-title"><?=$product['pr_title'];?></div>
								<div class="nshNote"><?=$product['pr_note'];?></div>
							<?php endif; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<a href="#" id="winProduct" class="window"><nobr>Читать полностью</nobr></a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div id="product-modal-content">
							<div class="box">
								<div class="box-header">
									<h2><?= $othertext[0]['otxt_note']; ?></h2> 
								</div>
								<div class="box-content h365 w575">
								<?php if($product && !empty($product['pr_note'])): ?>
									<img src="<?=$baseurl;?>mpavatar/viewimage/<?=$product['pr_id'];?>" class="floated" alt=""/>
									<div class="nsh-title"><?=$product['pr_title'];?></div>
									<div class="nshNote"><?=$product['full_note'];?></div>
								<?php endif; ?>
								</div>
								<div class="box-bottom-links h20">
									&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<div class="box">
							<div class="box-header brighted w278">
								<h2><?= $othertext[1]['otxt_note']; ?></h2>
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[1]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content">
							<?php if($pitfalls): ?>
								<?php for($i=0;$i<count($pitfalls);$i++):?>
								<div class="content-separator">
									<div class="nsh-title"><?=($i+1).'. '.$pitfalls[$i]['pf_title'];?></div>
									<div class="nshNote">
										<?=$pitfalls[$i]['pf_note'];?>
										<a href="#" id="winPitFalls" PF="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>
									</div>
								</div>	
								<?php endfor; ?>
							<?php endif; ?>
							</div>
							<div class="box-bottom-links brighted h20">
								<div class="left">
									<a href="#" id="addPitfalls" class="window">Добавить</a>
								</div>
								<div class="right" id="PFStatus"></div>
								<div class="clear"></div>
							</div>
						</div>
						<div id="addPitfallsForm">
							Название <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
							<input class="edit285-form-input" id="TitlePF" type="text" value="" maxlength="200"/>
							<div class="clear"></div>
							Описание: <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
							<textarea class="edit285-form-textarea" id="TextPF" cols="20" rows="4"></textarea>
							<div class="clear"></div>
							<input type="button" class="lnk-submit" id="addPF" value="Добавить"/>
						</div>
						<?php for($i=0;$i<count($pitfalls);$i++):?>
							<div id="pitfalls-modal-content" PF="<?=$i;?>">
								<div class="box">
									<div class="box-header">&nbsp;
										<div class="box-search">
											<b><?=$pitfalls[$i]['pf_date'];?></b>
										</div>
									</div>
									<div class="box-content h365 w575">
										<div class="nsh-title"><?=$pitfalls[$i]['pf_title'];?></div>
										<div class="nshNote"><?=$pitfalls[$i]['full_note'];?></div>
									</div>
									<div class="box-bottom-links h20">&nbsp;
										<div class="clear"></div>
									</div>
								</div>
							</div>
						<?php endfor; ?>
						<div class="box">
							<div class="box-header w278">
								<h2><?= $othertext[2]['otxt_note']; ?></h2>
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[2]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content">
							<?php if($questions): ?>
								<?php for($i=0;$i<count($questions);$i++):?>
								<div class="content-separator">
									<div class="nsh-title"><?=($i+1).'. '.$questions[$i]['mraq_title'];?></div>
									<div class="nshNote">
										<?=$questions[$i]['mraq_note'];?>
										<a href="#" id="winQuestion" Quest="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>
									</div>
								</div>	
								<?php endfor; ?>
							<?php endif; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="left">
									<a href="#" id="AskQuestion" class="window">Задать вопрос</a>
								</div>
								<div class="right" id="AQStatus"></div>
								<div class="clear"></div>
							</div>
						</div>
						<div id="AskQuestionForm">
							Вопрос: <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
							<input class="edit285-form-input" id="TextAQ" type="text" value="" maxlength="200"/>
							<div class="clear"></div><br/>
							<input type="button" class="lnk-submit" id="addQ" value="Добавить"/>
						</div>
						<?php for($i=0;$i<count($questions);$i++):?>
							<div id="questions-modal-content" Quest="<?=$i;?>">
								<div class="box">
									<div class="box-header">&nbsp;
										<div class="box-search">
											<b><?=$questions[$i]['mraq_date'];?></b>
										</div>
									</div>
									<div class="box-content h365 w575">
										<span class="text">Вопрос:</span>
										<div class="nsh-title"><?=$questions[$i]['mraq_title'];?></div>
										<span class="text">Ответ:</span>
										<div class="nshNote"><?=$questions[$i]['full_note'];?></div>
									</div>
									<div class="box-bottom-links h20">&nbsp;
										<div class="clear"></div>
									</div>
								</div>
							</div>
						<?php endfor; ?>
						<div class="box">
							<div class="box-header w278">
								<h2><?= $othertext[18]['otxt_note']; ?></h2>
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[18]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content">
							<?php if($tips): ?>
								<?php for($i=0;$i<count($tips);$i++):?>
								<div class="content-separator">
									<div class="nsh-title"><?=($i+1).'. '.$tips[$i]['tps_title'];?></div>
									<div class="nshNote">
										<?=$tips[$i]['tps_note'];?>
										<a href="#" id="winTips" PF="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>
									</div>
								</div>	
								<?php endfor; ?>
							<?php endif; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">&nbsp;</div>
								<div class="clear"></div>
							</div>
						</div>
						<?php for($i=0;$i<count($tips);$i++):?>
							<div id="tips-modal-content" PF="<?=$i;?>">
								<div class="box">
									<div class="box-header">&nbsp;
										<div class="box-search">
											<b><?=$tips[$i]['tps_date'];?></b>
										</div>
									</div>
									<div class="box-content h365 w575">
										<div class="nsh-title"><?=$tips[$i]['tps_title'];?></div>
										<div class="nshNote"><?=$tips[$i]['full_note'];?></div>
									</div>
									<div class="box-bottom-links h20">&nbsp;
										<div class="clear"></div>
									</div>
								</div>
							</div>
						<?php endfor; ?>
					</div>
					<div class="grid_5">
						<div class="box">
							<div class="box-header w358">
								<h2><?= $othertext[3]['otxt_note']; ?></h2>
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[3]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content exception">
								<div style="min-height:160px">
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
										<div id="pulist">
											<select name="productlist" id="single-select-products" class="mixed-combo" size="1" style="width: 250px;">
											<?php for($i=0;$i<count($units);$i++):?>
												<option value="<?=$units[$i]['pri_id'];?>"><?=$units[$i]['pri_title'];?></option>
											<?php endfor; ?>
											</select>
										</div>
									<?php endif;?>
									</div>
									<div id="unitImage">
										<img src="<?=$baseurl;?>puravatar/viewimage/<?=$units[0]['pri_id'];?>"class="floated" alt=""/>
									</div>
									<div id="formUnit">
										<?=$units[0]['pri_note'];?>
									</div>
								<?php endif; ?>
								</div>
								<div style="clear:both"></div>
								<div class="price-content-separator">
									<h3 class="mt5">Низкая цена <span class="desc">[Верхний предел]</span></h3>
									<div class="price-border">
										<div class="price-pos">
											<div class="price-pos1" id="lowprice">
											<?php if($unitgroups || $units): ?>
												<?=$units[0]['pri_lowprice'];?>
											<?php else: ?>
												&mdash;
											<?php endif; ?>
											</div>
											<div class="price-pos2" id="lowpricecode">
											<?php if($unitgroups || $units): ?>
												<?=$units[0]['pri_lowpricecode'];?><?php if($units[0]['pri_unitscode']):?>/<?=$units[0]['pri_unitscode'];?><?php endif;?>
											<?php else: ?>
												руб.
											<?php endif; ?>
											</div>
										</div>
										<div class="price-actions">
											<input type="button" class="goog-button window" tabindex="0" value="Список предложений">
											<input type="button" id="winRisks" class="goog-button window" tabindex="1" value="Возможные риски">
										</div>
										<div class="price-schema">
											<img alt="" title="Перейти к графику изменения цены" src="<?=$baseurl;?>images/diagram.png" />
										</div>
										<div class="clear"></div>
									</div>
								</div>
								<div class="price-content-separator">
									<h3 class="mt5">Оптимальная цена <span class="desc">[Усред. значение]</span></h3>
									<div class="price-border">
										<div class="price-pos">
											<div class="price-pos1" id="optimumprice">
											<?php if($unitgroups || $units): ?>
												<?=$units[0]['pri_optimumprice'];?>
											<?php else: ?>
												&mdash;
											<?php endif; ?>
											</div>
											<div class="price-pos2" id="optimumpricecode">
											<?php if($unitgroups || $units): ?>
												<?=$units[0]['pri_optimumpricecode'];?><?php if($units[0]['pri_unitscode']):?>/<?=$units[0]['pri_unitscode'];?><?php endif;?>
											<?php else: ?>
												руб.
											<?php endif; ?>
											</div>
										</div>
										<div class="price-actions">
											<input type="button" class="goog-button" tabindex="0" value="Список предложений">
										</div>
										<div class="price-schema">
											<img alt="" title="" src="<?=$baseurl;?>images/diagram.png" />
										</div>
										<div class="clear"></div>
									</div>
								</div>
								<div class="price-content-separator last">
									<h3 class="mt5">Высокая цена <span class="desc">[Нижний предел]</span></h3>
									<div class="price-border">
										<div class="price-pos">
											<div class="price-pos1" id="topprice">
											<?php if($unitgroups || $units): ?>
												<?=$units[0]['pri_topprice'];?>
											<?php else: ?>
												&mdash;
											<?php endif; ?>
											</div>
											<div class="price-pos2" id="toppricecode">
											<?php if($unitgroups || $units): ?>
												<?=$units[0]['pri_toppricecode'];?><?php if($units[0]['pri_unitscode']):?>/<?=$units[0]['pri_unitscode'];?><?php endif;?>
											<?php else: ?>
												руб.
											<?php endif; ?>
											</div>
										</div>
										<div class="price-actions">
										<input type="button" class="goog-button" tabindex="0" value="Список предложений">
										<input type="button" id="winAdvantage" class="goog-button window" tabindex="1" value="Преимущества">
										</div>
										<div class="price-schema">
											<img alt="" title="" src="<?=$baseurl;?>images/diagram.png" />
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="box-bottom-links h20">
								<span class="box-footer-text"></span>
								<div class="clear"></div>
							</div>
						</div>
						<div id="risks-modal-content">
							<div class="box">
								<div class="box-header"><b><?=$activitypath;?></b>
									<div class="box-search">&nbsp;</div>
								</div>
								<div class="box-content h365 w575">
								<h3>Возможные риски</h3>
									<div id="risks">
									<?php if($unitgroups || $units): ?>
										<?=$units[0]['pri_riskslowprice'];?>
									<?php endif; ?>
									</div>
								</div>
								<div class="box-bottom-links h20">&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<div id="advantage-modal-content">
							<div class="box">
								<div class="box-header"><b><?=$activitypath;?></b>
									<div class="box-search">&nbsp;</div>
								</div>
								<div class="box-content h365 w575">
								<h3>Преимущества высокой цены</h3>
									<div id="advantage">
									<?php if($unitgroups || $units): ?>
										<?=$units[0]['pri_advantages'];?>
									<?php endif; ?>
									</div>
								</div>
								<div class="box-bottom-links h20">&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<?php if($userinfo['status']): ?>
							<?php if($userinfo['cid']): ?>
								<div class="box-tender">
									<div class="box-header w358">
										<h2 style="text-align:center">
											<?php $link = 'announce-tender/region/'.$this->uri->segment(3).'/activity/'.$this->uri->segment(5);?>
											<?= anchor($link,'&nbsp;&nbsp;&nbsp;Объявить тендер &nbsp;&nbsp;&nbsp;',array('class'=>'lnk-submit','id'=>'lnk-sign-in','type'=>'button','style'=>'font-size: 120%;'));?>
										</h2>
										<div class="box-search h20">
											<a class="tooltip" href="">
												<img src="<?=$baseurl;?>images/ask_transparent.png"/>
												<span class="classic"><?=$othertext[4]['otxt_help'];?></span>
											</a>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<? endif; ?>
						<div class="box">
							<div class="box-header w358">
								<h2><?= $othertext[5]['otxt_note'];?></h2>
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[5]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div id="accordion">
								<h3><a href="#"><?= $othertext[6]['otxt_note'];?></a></h3>
								<div class="box-content">
								<?php if(count($company['all'])): ?>
									<?php for($i=0;$i<count($company['all']);$i++):?>
									<div class="content-separator">
										<div class="floated">
											<img src="<?=$baseurl;?>companythumb/viewimage/<?=$company['all'][$i]['cmp_id'];?>" alt=""/>
											<div class="company-rate">рейтинг: <?=$company['all'][$i]['cmp_rating'];?></div>
											<?php if($company['all'][$i]['cmp_graph'] <= $low_rating): ?>
											<div class="company-rate-bad" style="width:<?=$company['all'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php else: ?>
											<div class="company-rate-graph" style="width:<?=$company['all'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php endif; ?>
										</div>
										<div class="nsh-title"><?=$company['all'][$i]['cmp_name'];?></div>
										<div class="nshNote"><?=$company['all'][$i]['cmp_description'];?></div>
										<div class="clear"></div>
									</div>
									<?php endfor; ?>
								<?php endif; ?>
								</div>
								<h3><a href="#"><?= $othertext[7]['otxt_note'];?></a></h3>
								<div class="box-content">
								<?php if(count($company['trustee'])): ?>
									<?php for($i=0;$i<count($company['trustee']);$i++):?>
									<div class="content-separator">
										<div class="floated">
											<img src="<?=$baseurl;?>companythumb/viewimage/<?=$company['trustee'][$i]['cmp_id'];?>" alt=""/>
											<div class="company-rate">рейтинг: <?=$company['trustee'][$i]['cmp_rating'];?></div>
											<?php if($company['trustee'][$i]['cmp_graph'] <= $low_rating): ?>
										<div class="company-rate-bad" style="width:<?=$company['trustee'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php else: ?>
										<div class="company-rate-graph" style="width:<?=$company['trustee'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php endif; ?>
										</div>
										<div class="nsh-title"><?=$company['trustee'][$i]['cmp_name'];?></div>
										<div class="nshNote"><?=$company['trustee'][$i]['cmp_description'];?></div>
										<div class="clear"></div>
									</div>
									<?php endfor; ?>
								<?php endif; ?>
								</div>
								<h3><a href="#"><?= $othertext[8]['otxt_note'];?></a></h3>
								<div class="box-content">
								<?php if(count($company['blacklist'])): ?>
									<?php for($i=0;$i<count($company['blacklist']);$i++):?>
									<div class="content-separator">
										<div class="floated">
											<img src="<?=$baseurl;?>companythumb/viewimage/<?=$company['blacklist'][$i]['cmp_id'];?>" alt=""/>
											<div class="company-rate">рейтинг: <?=$company['blacklist'][$i]['cmp_rating'];?></div>
											<?php if($company['blacklist'][$i]['cmp_graph'] <= $low_rating): ?>
									<div class="company-rate-bad" style="width:<?=$company['blacklist'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php else: ?>
									<div class="company-rate-graph" style="width:<?=$company['blacklist'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php endif; ?>
										</div>
										<div class="nsh-title"><?=$company['blacklist'][$i]['cmp_name'];?></div>
										<div class="nshNote"><?=$company['blacklist'][$i]['cmp_description'];?></div>
										<div class="clear"></div>
									</div>
									<?php endfor; ?>
								<?php endif; ?>
								</div>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<a href="#" id="winCompanyList" class="window">Полный список</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<?php if(count($company['all'])): ?>
							<div id="company-modal-content">
								<div class="box">
									<div class="box-header"><b><?=$activitypath;?></b>
										<div class="box-search">&nbsp;</div>
									</div>
									<div class="box-content h365 w575">
									<?php for($i=0;$i<count($company['all']);$i++):?>
										<div class="content-separator">
											<div class="floated">
												<img src="<?=$baseurl;?>companythumb/viewimage/<?=$company['all'][$i]['cmp_id'];?>" alt=""/>
												<div class="company-rate">рейтинг: <?=$company['all'][$i]['cmp_rating'];?></div>
											<?php if($company['all'][$i]['cmp_graph'] <= $low_rating): ?>
											<div class="company-rate-bad" style="width:<?=$company['all'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php else: ?>
											<div class="company-rate-graph" style="width:<?=$company['all'][$i]['cmp_graph'];?>px;">&nbsp;</div>
											<?php endif; ?>
											</div>
											<div class="nsh-title"><?=$company['all'][$i]['cmp_name'];?></div>
											<div class="nshNote"><?=$company['all'][$i]['full_description'];?></div>
											<div class="RightLink">
												<?= anchor('company-info/'.$company['all'][$i]['cmp_id'],'На страницу компании');?>
											</div>
											<div class="clear"></div>
										</div>
									<?php endfor; ?>
									</div>
									<div class="box-bottom-links h20">&nbsp;
										<div class="clear"></div>
									</div>
								</div>
							</div>
						<?php else: ?>
							<div id="company-modal-content">
								<div class="box">
									<div class="box-header"><b><?=$activitypath;?></b>
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
							<div class="box-header w358">
								<h2><?= $othertext[9]['otxt_note'];?></h2>
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[9]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div id="accordion-1">
								<h3><a href="#"><?= $othertext[10]['otxt_note'];?></a></h3>
								<div class="box-content">
								<?php if($activitynews): ?>
									<?php for($i=0;$i<count($activitynews);$i++):?>
										<div class="content-separator">
									<img src="<?=$baseurl;?>activitynews/viewimage/<?=$activitynews[$i]['an_id'];?>" class="floated" alt=""/>
											<div class="nsh-title"><?=$activitynews[$i]['an_title'];?></div>
											<div class="nshNote"><?=$activitynews[$i]['an_note'];?></div>
											<div class="clear"></div>
										</div>
									<?php endfor; ?>
								<?php endif; ?>
								</div>
								<h3><a href="#"><?= $othertext[11]['otxt_note'];?></a></h3>
								<div class="box-content">
									<?php if($companynews): ?>
									<?php for($i=0;$i<count($companynews);$i++):?>
										<div class="content-separator">
									<img src="<?=$baseurl;?>companynews/viewimage/<?=$companynews[$i]['cn_id'];?>" class="floated" alt=""/>
											<div class="nsh-title"><?=$companynews[$i]['cn_title'];?></div>
											<div class="nshNote"><?=$companynews[$i]['cn_note'];?></div>
											<div class="clear"></div>
										</div>
									<?php endfor; ?>
								<?php endif; ?>
								</div>
							</div>
							<div class="box-bottom-links">
								<div class="right">
									<a href="#" id="winNews" class="window">Полный список</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<?php if(count($activitynews) || count($companynews)): ?>
						<div id="news-modal-content">
							<div class="box">
								<div class="box-header"><b><?=$activitypath;?></b>
									<div class="box-search">&nbsp;</div>
								</div>
								<div class="box-content h365 w575">
								<h3>Новости отросли</h3><hr/>
								<?php for($i=0;$i<count($activitynews);$i++):?>
									<div class="content-separator">
										<div class="nshDate"><?=$activitynews[$i]['an_date'];?></div>
								<img src="<?=$baseurl;?>activitynews/viewimage/<?=$activitynews[$i]['an_id'];?>" class="floated" alt=""/>
										<div class="nsh-title"><?=$activitynews[$i]['an_title'];?></div>
										<div class="nshNote"><?=$activitynews[$i]['full_note'];?></div>
										<div class="clear"></div>
									</div>
								<?php endfor; ?>
								<h3>Новости компаний отросли</h3><hr/>
								<?php for($i=0;$i<count($companynews);$i++):?>
									<div class="content-separator">
										<div class="nshDate"><?=$companynews[$i]['cn_pdatebegin'];?></div>
										<div class="floated">
											<img src="<?=$baseurl;?>companythumb/viewimage/<?=$companynews[$i]['cmp_id'];?>" alt=""/>
											<div class="company-rate">рейтинг: <?=$companynews[$i]['cmp_rating'];?></div>
										<?php if($company['all'][$i]['cmp_graph'] <= $low_rating): ?>
										<div class="company-rate-bad" style="width:<?=$companynews[$i]['cmp_graph'];?>px;">&nbsp;</div>
										<?php else: ?>
										<div class="company-rate-graph" style="width:<?=$companynews[$i]['cmp_graph'];?>px;">&nbsp;</div>
										<?php endif; ?>
										</div>
										<div class="nsh-title"><?=$companynews[$i]['cmp_name'];?></div>
								<img src="<?=$baseurl;?>companynews/viewimage/<?=$companynews[$i]['cn_id'];?>" class="floated" alt=""/>
										<div class="nsh-title"><?=$companynews[$i]['cn_title'];?></div>
										<div class="nshNote"><?=$companynews[$i]['full_note'];?></div>
										<div class="clear"></div>
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
								<div class="box-header"><b><?=$activitypath;?></b>
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
					<div class="grid_3 omega w240"> 
						<div class="box">
							<div class="box-header w220">
								<h2><?= $othertext[12]['otxt_note'];?></h2>
								<div class="box-search">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[12]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content h150">
								<img src="<?=$baseurl;?>mavatar/viewimage/<?=$manager['uid'];?>" class="floated" alt="">
								<strong><?=$manager['uname'].' '.$manager['usubname'].' '.$manager['uthname']; ?></strong>
								<div class="clear"></div>
								<?php for($i = 0; $i <count($manager['jobs']); $i++):?>
									<?php if(count($manager['jobs'])>1 && $i>0 && $i<count($manager['jobs'])): ?>
									<br/>
									<?php endif; ?>
									<br/><b><?=$manager['jobs'][$i]['job_position'];?></b>
									<div class="years-list">
										<?php if($manager['jobs'][$i]['job_dbegin']): ?>
											<b><?=$manager['jobs'][$i]['job_dbegin'];?> - 
										<?php else: ?>
											<b>н/у -
										<?php endif; ?>
										<?php if($manager['jobs'][$i]['job_dend']): ?>
											<?=$manager['jobs'][$i]['job_dend'];?> гг.</b>
										<?php else: ?>
											н/в</b>
										<?php endif; ?>
									</div>
									<?= $manager['jobs'][$i]['job_cname']; ?>
								<?php endfor; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<?= anchor("manager-list/region/$curregion/activity/$curactivity",'Менеджеры');?>
								</div>
								<div class="left">
									<a href="#" id="winEmail" class="window" title="Отправить менеджеру личное сообщение">
										<img src="<?=$baseurl?>images/email.png"/>
									</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="box">
							<div class="box-header w220">
								<h2><?= $othertext[13]['otxt_note'];?></h2>
								<div class="box-search h150">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[13]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content">
							<?php if($persona && !empty($persona['prs_note'])): ?>
								<img src="<?=$baseurl;?>prsavatar/viewimage/<?=$persona['prs_id'];?>" class="floated" alt=""/>
								<div class="nsh-title"><?=$persona['prs_title'];?></div>
								<div class="nshNote"><?=$persona['prs_note'];?></div>
							<?php endif; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<a href="#" id="winPersona" class="window"><nobr>Читать полностью</nobr></a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div id="persona-modal-content">
							<div class="box">
								<div class="box-header">
									<h2><?= $othertext[13]['otxt_note']; ?></h2> 
								</div>
								<div class="box-content h365 w575">
								<?php if($persona && !empty($persona['prs_note'])): ?>
									<img src="<?=$baseurl;?>prsavatar/viewimage/<?=$persona['prs_id'];?>" class="floated" alt=""/>
									<div class="nsh-title"><?=$persona['prs_title'];?></div>
									<div class="nshNote"><?=$persona['full_note'];?></div>
								<?php endif; ?>
								</div>
								<div class="box-bottom-links h20">&nbsp;
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<?php if($banner): ?>
						<div class="box">
							<div class="box-header w220">
								<h2><?= $othertext[19]['otxt_note'];?></h2>
								<div class="box-search h150">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[19]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content">
								<?=$banner;?>
							</div>
						</div>
						<?php endif; ?>
						<div class="box">
							<div class="box-header w220">
								<h2><?= $othertext[14]['otxt_note'];?></h2>
								<div class="box-search h150">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[14]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div class="box-content">
								<?php if($documents): ?>
									<?php for($i=0;$i<count($documents);$i++):?>
									<div class="content-separator">
										<img src="<?=$baseurl;?>docavatar/viewimage/<?=$documents[$i]['doc_id'];?>" class="floated" alt=""/>
										<div class="nsh-title">
											<?=anchor($baseurl.$documents[$i]['doc_link'],$documents[$i]['doc_title'])?>
										</div>
										<div class="clear"></div>
									</div>	
									<?php endfor; ?>
								<?php endif; ?>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<a href="#" id="winDocuments" class="window">Все документы</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<?php if(count($documents)): ?>
							<div id="document-modal-content">
								<div class="box">
									<div class="box-header"><b><?=$activitypath;?></b>
										<div class="box-search">&nbsp;</div>
									</div>
									<div class="box-content h365 w575">
									<?php for($i=0;$i<count($documents);$i++):?>
										<div class="content-separator">
									<img src="<?=$baseurl;?>docavatar/viewimage/<?=$documents[$i]['doc_id'];?>" class="floated" alt=""/>
									<div class="nsh-title"><?=anchor($baseurl.$documents[$i]['doc_link'],$documents[$i]['doc_title'])?></div>
									<div class="nshNote" id="ds<?=$i?>"><?=$documents[$i]['doc_note'];?></div>
										<div class="clear"></div>
										</div>
									<?php endfor; ?>
									</div>
									<div class="box-bottom-links h20">&nbsp;
										<div class="clear"></div>
									</div>
								</div>
							</div>
						<?php else: ?>
							<div id="document-modal-content">
								<div class="box">
									<div class="box-header"><b><?=$activitypath;?></b>
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
							<div class="box-header w220">
								<h2><?= $othertext[15]['otxt_note'];?></h2>
								<div class="box-search h10">
									<a class="tooltip" href="">
										<img src="<?=$baseurl;?>images/ask_transparent.png"/>
										<span class="classic"><?=$othertext[15]['otxt_help'];?></span>
									</a>
								</div>
							</div>
							<div id="accordion-2">
								<h3><a href="#"><?= $othertext[16]['otxt_note'];?></a></h3>
								<div class="box-content">
									<?php if($specials): ?>
									<?php for($i=0;$i<count($specials);$i++):?>
										<div class="content-separator">
									<img src="<?=$baseurl;?>specials/viewimage/<?=$specials[$i]['spc_id'];?>" class="floated" alt=""/>
											<div class="nsh-title"><?=$specials[$i]['spc_title'];?></div>
											<div class="nshNote"><?=$specials[$i]['spc_note'];?></div>
											<div class="clear"></div>
										</div>
									<?php endfor; ?>
								<?php endif; ?>
								</div>
								<h3><a href="#"><?= $othertext[17]['otxt_note'];?></a></h3>
								<div class="box-content">&nbsp;</div>
							</div>
							<div class="box-bottom-links h20">
								<div class="right">
									<a href="#" id="winSpecials" class="window">Полный список</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<?php if(count($specials)): ?>
							<div id="specials-modal-content">
								<div class="box">
									<div class="box-header"><b><?=$activitypath;?></b>
										<div class="box-search">&nbsp;</div>
									</div>
									<div class="box-content h365 w575">
									<h3>Новинки отросли</h3><hr/>
									<?php for($i=0;$i<count($specials);$i++):?>
										<div class="content-separator">
											<div class="nshDate"><?=$specials[$i]['spc_date'];?></div>
									<img src="<?=$baseurl;?>specials/viewimage/<?=$specials[$i]['spc_id'];?>" class="floated" alt=""/>
											<div class="nsh-title"><?=$specials[$i]['spc_title'];?></div>
											<div class="nshNote"><?=$specials[$i]['full_note'];?></div>
											<div class="clear"></div>
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
									<div class="box-header"><b><?=$activitypath;?></b>
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
						<div class="clear"></div>
					</div>
				</div>
			</section>
		</div>
		<div id="email-modal-content">
			<?php $this->load->view('forms/frmsendmail'); ?>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('users_interface/footer/footer-nomenu'); ?>
	</div> <!-- end of #container -->
	<script src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?= $baseurl; ?>javascript/jquery-1.5.1.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/jquery-ui.min.js?v=1.8.5"></script>
	<script type="text/javascript" src="<?=$baseurl;?>javascript/modal/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="<?= $baseurl; ?>javascript/jquery.blockUI.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

		$("#select-group").change(function(){
			$("#select-products").die();
			$("#select-products").remove();
			$("#pulist").text('');
			if($("#select-group").val()>0){
				$("#pulist").text('Ждите идет построение списка...');
				$("#pulist").load("<?=$baseurl;?>product-unit/region/<?=$curregion;?>/activity/<?=$curactivity;?>",
					{'group':$("#select-group").val()},
					function(){
						$("#select-products").live('change',function(){
							if($("#select-products").val()>0){
								$.post(
									"<?=$baseurl;?>product-info/region/<?=$curregion;?>/activity/<?=$curactivity;?>",
									{'group':$("#select-group").val(),'unit':$("#select-products").val()},
									function(data){
										$("#unitImage").html(data.image);
										$("#formUnit").html(data.note);
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
		
		$("#addPitfalls").click(function(event){
			event.preventDefault();
			$("#PFStatus").text('');
			$("#addPitfallsForm").toggle(500,function(){
				if($("#addPitfallsForm").is(":hidden")) $("#addPitfalls").text("Добавить");
				else $("#addPitfalls").text("Отменить");
			});
			$("#TextPF").css('border-color','#D0D0D0');
			$("#TitlePF").css('border-color','#D0D0D0');
			$("#TextPF").val('');$("#TitlePF").val('');
		});
		
		$("#AskQuestion").click(function(event){
			event.preventDefault();
			$("#AQStatus").text('');
			$("#AskQuestionForm").toggle(500,function(){
				if($("#AskQuestionForm").is(":hidden")) $("#AskQuestion").text("Задать вопрос");
				else $("#AskQuestion").text("Отменить");
			});
			$("#TextAQ").css('border-color','#D0D0D0');
			$("#TextAQ").val('');
		});
		
		$("#addPF").click(function(){
			var err = false;
			var title = $("#TitlePF").val();
			if(title==""){
				$("#TitlePF").css('border-color','#ff0000');
				err = true;
			}
			var text = $("#TextPF").val();
			if(text==""){
				$("#TextPF").css('border-color','#ff0000');
				err = true;
			}
			if(err){
				msgerror('Пропущены обязательные поля');
			}else
				$.post(
					"<?=$baseurl;?>add-pitfall",
					{'title':$("#TitlePF").val(),'note':$("#TextPF").val(),'activity':<?=$this->uri->segment(5);?>,'region':<?=$this->uri->segment(3);?>},
					function(data){
						if(data.status){
							$("#addPitfallsForm").hide(500,function(){$("#addPitfalls").text("Добавить");});
							$("#PFStatus").css('color','#008000');
							$("#PFStatus").text(data.message);
						}else msgerror(data.message);
					},"json");
		});
		
		$("#addQ").click(function(){
			var title = $("#TextAQ").val();
			if(title==""){
				$("#TextAQ").css('border-color','#ff0000');
				msgerror('Пропущены обязательные поля');
				return false;
			}else
				$.post(
					"<?=$baseurl;?>add-question",
					{'title':title,'activity':<?=$this->uri->segment(5);?>,'region':<?=$this->uri->segment(3);?>},
					function(data){
						if(data.status){
							$("#AskQuestionForm").hide(500,function(){$("#AskQuestion").text("Задать вопрос");});
							$("#AQStatus").css('color','#008000');
							$("#AQStatus").text(data.message);
						}else msgerror(data.message);
					},"json");
		});
		
		$("#single-select-products").change(function(){
			if($(this).val()>0){
				$.post(
					"<?=$baseurl;?>product-info/region/<?=$curregion;?>/activity/<?=$curactivity;?>",
					{'group':$("#hdngroup").text(),'unit':$(this).val()},
					function(data){
						$("#unitImage").html(data.image);
						$("#formUnit").html(data.note);
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
		
		$("a#winEmail").click(function(e){
			$("#email-modal-content").modal();
			return false;
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
			$("#tips-modal-content").modal();
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
		
		$("#SendEmail").click(function(event){
			var err = false;
			 $("#formRep .inpvalue").css('border-color','#D0D0D0');
			 var name = $("#name").val();
			 var email = $("#email").val();
			 var theme = $("#theme").val();
			 var message = $("#message").val();
			if(name == ''){
				err = true;
				$("#name").css('border-color','#ff0000');
			}
			if(email == ''){
				err = true;
				$("#email").css('border-color','#ff0000');
			}
			if(theme == ''){
				err = true;
				$("#theme").css('border-color','#ff0000');
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
		
		function msgerror(msg){
				$.blockUI({
					message: msg,
					css:{border:'none',padding:'15px', size:'12.0pt',backgroundColor:'#000',color:'#fff',opacity:'.8','-webkit-border-radius': '10px','-moz-border-radius': '10px'}
				});
				window.setTimeout($.unblockUI,1000);
				return false;
			}
		
		$("#accordion").accordion({animated: false,autoHeight: false});$("#accordion-1").accordion({animated: false,autoHeight: false});$("#accordion-2").accordion({animated: false,autoHeight: false});$("#slider-range-price").slider({range: true,min: 3200,max: 15000,values: [4500, 9000],slide: function(event, ui){$("#price-amount").val(ui.values[0] + ' - ' + ui.values[1]);}});$("#slider-range-rate").slider({range: true,min: 0,max: 100,values: [15, 70],slide: function(event, ui){$("#rate-amount").val(ui.values[0] + ' - ' + ui.values[1]);}});});
	</script>
</body>
</html>