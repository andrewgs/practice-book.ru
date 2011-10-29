<section id="info-boxes">
	<div class="container_12">
		<h2 style="text-align:right;"><?=$manager['activitypath'];?></h2>
		<div class="grid_4 alpha">
			<div class="box">
				<div class="box-header w278">
					<h2><?= $othertext[0]['otxt_note']; ?></h2> 
					<div class="box-search">
	<input type="button" id="product" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
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
				<?php else: ?>
					<?= $othertext[0]['otxt_content']; ?>
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
					<?php else: ?>
						<?= $othertext[0]['otxt_content']; ?>
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
	<input type="button" id="pitfalls" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
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
				<?php else: ?>
					<?= $othertext[1]['otxt_content']; ?>
				<?php endif; ?>
				</div>
				<div class="box-bottom-links brighted h20">
					<div class="right">&nbsp;</div>
					<div class="clear"></div>
				</div>
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
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<div class="box">
				<div class="box-header w278">
					<h2><?= $othertext[2]['otxt_note']; ?></h2>
					<div class="box-search">
	<input type="button" id="questions" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
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
				<?php else: ?>
					<?= $othertext[2]['otxt_content']; ?>
				<?php endif; ?>
				</div>
				<div class="box-bottom-links h20">
					&nbsp;
					<div class="clear"></div>
				</div>
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
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<div class="box">
				<div class="box-header w278">
					<h2><?= $othertext[18]['otxt_note']; ?></h2>
					<div class="box-search">
	<input type="button" id="tips" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
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
							<a href="#" id="winTips" TPS="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>
						</div>
					</div>	
					<?php endfor; ?>
				<?php else: ?>
					<?= $othertext[18]['otxt_content']; ?>
				<?php endif; ?>
				</div>
				<div class="box-bottom-links h20">
					<div class="right">&nbsp;</div>
					<div class="clear"></div>
				</div>
			</div>
			<?php for($i=0;$i<count($tips);$i++):?>
				<div id="tips-modal-content" TPS="<?=$i;?>">
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
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
		</div>
		<div class="grid_5">
		<?php if($units):?>
			<div id="unit-modal-note-content">
				<div class="box">
					<div class="box-header">
						<div id="UnitTitle">
							<?=$units[0]['pri_title'];?>
						</div>
						<div class="box-search">&nbsp;</div>
					</div>
					<div class="box-content h365 w575">
						<div class="unitImage">
							<img src="<?=$baseurl;?>puravatar/viewimage/<?=$units[0]['pri_id'];?>"class="floated" alt=""/>
						</div>
						<div id="UnitNote">
							<?=$units[0]['full_note'];?>
						</div>
					</div>
					<div class="box-bottom-links h20">&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php endif; ?>
			<div class="box">
				<div class="box-header w358">
					<h2><?= $othertext[3]['otxt_note']; ?></h2>
					<div class="box-search">
<input type="button" id="coordinator" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
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
							<h2>Группа: <?=$groupname;?></h2>
							<div id="pulist">
								<select name="productlist" id="single-select-products" class="mixed-combo" size="1" style="width:345px;">
								<?php for($i=0;$i<count($units);$i++):?>
									<option value="<?=$units[$i]['pri_id'];?>"><?=$units[$i]['pri_title'];?></option>
								<?php endfor; ?>
								</select>
							</div>
						<?php endif;?>
						</div>
						<div class="unitImage">
							<img src="<?=$baseurl;?>puravatar/viewimage/<?=$units[0]['pri_id'];?>"class="floated" alt=""/>
						</div>
						<div id="formUnit">
							<?=$units[0]['pri_note'];?>
						</div> 
					<?php if($long_note): ?>
						<div style="text-align:right;margin-top:10px;" id="divNote">
					<?php else: ?>
						<div style="text-align:right;margin-top:10px;" id="divNote" class="btnHidden">
					<?php endif; ?>
							<a href="#" id="winUnitNote" class="window"><nobr>Читать полностью</nobr></a>
						</div>
					<?php else: ?>
					<?= $othertext[3]['otxt_content']; ?>
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
									1000
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
								<input type="button" id="lowOfferList" class="goog-button" tabindex="0" value="Список предложений">
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
									5000
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
							<input type="button" id="optimumOfferList" class="goog-button" tabindex="0" value="Список предложений">
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
									10000
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
							<input type="button" id="topOfferList" class="goog-button" tabindex="0" value="Список предложений">
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
					<div class="box-header"><b><?=$manager['activitypath'];?></b>
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
					<div class="box-bottom-links h20">
						&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div id="offer-modal-content">
				<div class="box">
					<div class="box-header"><div id="offerTitle">&nbsp;</div>
						<div class="box-search">&nbsp;</div>
					</div>
					<div class="box-content h365 w575">
						<div id="offerList">&nbsp;</div>
					</div>
					<div class="box-bottom-links h20">&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div id="advantage-modal-content">
				<div class="box">
					<div class="box-header"><b><?=$manager['activitypath'];?></b>
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
					<div class="box-bottom-links h20">
						&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
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
					<?php else: ?>
						<?= $othertext[6]['otxt_content']; ?>
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
					<?php else: ?>
						<?= $othertext[7]['otxt_content']; ?>
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
					<?php else: ?>
						<?= $othertext[9]['otxt_content']; ?>
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
						<div class="box-header"><b><?=$manager['activitypath'];?></b>
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
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div id="company-modal-content">
					<div class="box">
						<div class="box-header"><b><?=$manager['activitypath'];?></b>
							<div class="box-search">&nbsp;</div>
						</div>
						<div class="box-content h365 w575">
							<span class="text">Список пуст</span>
							<div class="clear"></div>
						</div>
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="box">
				<div class="box-header w358">
					<h2><?= $othertext[9]['otxt_note'];?></h2>
					<div class="box-search">
		<input type="button" id="news" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
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
								<div class="nshNote">
									<?=$activitynews[$i]['an_note'];?>
									<a href="#" id="winActNews" AN="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>
								</div>
								<div class="clear"></div>
							</div>
						<?php endfor; ?>
					<?php else: ?>
						<?= $othertext[10]['otxt_content']; ?>
					<?php endif; ?>
					</div>
					<h3><a href="#"><?= $othertext[11]['otxt_note'];?></a></h3>
					<div class="box-content">
						<?php if($companynews): ?>
						<?php for($i=0;$i<count($companynews);$i++):?>
							<div class="content-separator">
						<img src="<?=$baseurl;?>companynews/viewimage/<?=$companynews[$i]['cn_id'];?>" class="floated" alt=""/>
								<div class="nsh-title"><?=$companynews[$i]['cn_title'];?></div>
								<div class="nshNote">
									<?=$companynews[$i]['cn_note'];?>
									<a href="#" id="winCmpNews" CN="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>	
								</div>
								<div class="clear"></div>
							</div>
						<?php endfor; ?>
					<?php else: ?>
						<?= $othertext[11]['otxt_content']; ?>
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
		<?php for($i=0;$i<count($activitynews);$i++):?>
			<div id="single-news-modal-content" AN="<?=$i;?>">
				<div class="box">
					<div class="box-header">&nbsp;
						<div class="box-search"><b><?=$activitynews[$i]['an_date'];?></b></div>
					</div>
					<div class="box-content h365 w575">
						<img src="<?=$baseurl;?>activitynews/viewimage/<?=$activitynews[$i]['an_id'];?>" class="floated" alt=""/>
						<div class="nsh-title"><?=$activitynews[$i]['an_title'];?></div>
						<div class="nshNote"><?=$activitynews[$i]['full_note'];?></div>
					<?php if(!empty($activitynews[$i]['an_source'])):?>
						<div class="RightLink">
							<?=anchor($activitynews[$i]['an_source'],'Источник',array('TARGET'=>'_blank'));?>
						</div>
					<?php endif; ?>
						<div class="clear"></div>
					</div>
					<div class="box-bottom-links h20">&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php endfor; ?>
		<?php for($i=0;$i<count($companynews);$i++):?>
			<div id="single-cmpnews-modal-content" CN="<?=$i;?>">
				<div class="box">
					<div class="box-header">&nbsp;
						<div class="box-search"><b><?=$companynews[$i]['cn_pdatebegin'];?></b></div>
					</div>
					<div class="box-content h365 w575">
						<div class="floated">
								<img src="<?=$baseurl;?>companythumb/viewimage/<?=$companynews[$i]['cmp_id'];?>" alt=""/>
								<div class="company-rate">рейтинг: <?=$companynews[$i]['cmp_rating'];?></div>
							<?php if($companynews[$i]['cmp_graph'] <= $low_rating): ?>
							<div class="company-rate-bad" style="width:<?=$companynews[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php else: ?>
							<div class="company-rate-graph" style="width:<?=$companynews[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php endif; ?>
						</div>
						<div class="nsh-title"><?=$companynews[$i]['cmp_name'];?></div>
						<img src="<?=$baseurl;?>companynews/viewimage/<?=$companynews[$i]['cn_id'];?>" class="floated" alt=""/>
						<div class="nsh-title"><?=$companynews[$i]['cn_title'];?></div>
						<div class="nshNote"><?=$companynews[$i]['full_note'];?></div>
						<div class="RightLink">
							<?= anchor('company-info/'.$companynews[$i]['cmp_id'],'На страницу компании');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="box-bottom-links h20">&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php endfor; ?>
		<?php if(count($activitynews) || count($companynews)): ?>
			<div id="news-modal-content">
				<div class="box">
					<div class="box-header"><b><?=$manager['activitypath'];?></b>
						<div class="box-search">&nbsp;</div>
					</div>
					<div class="box-content h365 w575">
				<?php if(count($activitynews)): ?>
					<h3>Новости отрасли</h3><hr/>
					<?php for($i=0;$i<count($activitynews);$i++):?>
						<div class="content-separator">
							<div class="nshDate"><?=$activitynews[$i]['an_date'];?></div>
					<img src="<?=$baseurl;?>activitynews/viewimage/<?=$activitynews[$i]['an_id'];?>" class="floated" alt=""/>
							<div class="nsh-title"><?=$activitynews[$i]['an_title'];?></div>
							<div class="nshNote"><?=$activitynews[$i]['full_note'];?></div>
						<?php if(!empty($activitynews[$i]['an_source'])):?>
							<div class="RightLink">
								<?=anchor($activitynews[$i]['an_source'],'Источник',array('TARGET'=>'_blank'));?>
							</div>
						<?php endif; ?>
							<div class="clear"></div>
						</div>
					<?php endfor; ?>
				<?php endif; ?>
				<?php if(count($companynews)): ?>
					<h3>Новости компаний отрасли</h3><hr/>
					<?php for($i=0;$i<count($companynews);$i++):?>
						<div class="content-separator">
							<div class="nshDate"><?=$companynews[$i]['cn_pdatebegin'];?></div>
							<div class="floated">
								<img src="<?=$baseurl;?>companythumb/viewimage/<?=$companynews[$i]['cmp_id'];?>" alt=""/>
								<div class="company-rate">рейтинг: <?=$companynews[$i]['cmp_rating'];?></div>
							<?php if($companynews[$i]['cmp_graph'] <= $low_rating): ?>
							<div class="company-rate-bad" style="width:<?=$companynews[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php else: ?>
							<div class="company-rate-graph" style="width:<?=$companynews[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php endif; ?>
							</div>
							<div class="nsh-title"><?=$companynews[$i]['cmp_name'];?></div>
					<img src="<?=$baseurl;?>companynews/viewimage/<?=$companynews[$i]['cn_id'];?>" class="floated" alt=""/>
							<div class="nsh-title"><?=$companynews[$i]['cn_title'];?></div>
							<div class="nshNote"><?=$companynews[$i]['full_note'];?></div>
							<div class="RightLink">
								<?= anchor('company-info/'.$companynews[$i]['cmp_id'],'На страницу компании');?>
							</div>
							<div class="clear"></div>
						</div>
					<?php endfor; ?>
				<?php endif; ?>
					</div>
					<div class="box-bottom-links h20">
						&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div id="news-modal-content">
				<div class="box">
					<div class="box-header"><b><?=$manager['activitypath'];?></b>
						<div class="box-search">&nbsp;</div>
					</div>
					<div class="box-content h365 w575">
						<span class="text">Список пуст</span>
						<div class="clear"></div>
					</div>
					<div class="box-bottom-links h20">
						&nbsp;
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
				<div class="box-content h150 mw220">
					<img src="<?=$baseurl;?>mavatar/viewimage/<?=$manager['uid'];?>" class="floated" alt="">
					<strong><?=$manager['uname'].' '.$manager['usubname'].' '.$manager['uthname']; ?></strong>
					<div class="clear"></div>
					<?php if($manager['uachievement']): ?>
						<?=$manager['uachievement'];?>
					<?php endif; ?>
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
					<div class="clear"></div>
				</div>
			</div>
			<div class="box">
				<div class="box-header w220">
					<h2><?= $othertext[13]['otxt_note'];?></h2>
					<div class="box-search">
	<input type="button" id="persona" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
						<a class="tooltip" href="">
							<img src="<?=$baseurl;?>images/ask_transparent.png"/>
							<span class="classic"><?=$othertext[13]['otxt_help'];?></span>
						</a>
					</div>
				</div>
				<div class="box-content mw220">
				<?php if($persona && !empty($persona['prs_note'])): ?>
					<img src="<?=$baseurl;?>prsavatar/viewimage/<?=$persona['prs_id'];?>" class="floated" alt=""/>
					<div class="nsh-title"><?=$persona['prs_title'];?></div>
					<div class="nshNote"><?=$persona['prs_note'];?></div>
				<?php else: ?>
					<?= $othertext[13]['otxt_content']; ?>
				<?php endif; ?>
				</div>
				<div class="box-bottom-links h20">
				<?php if(!empty($persona['prs_source'])):?>
					<div class="left">
						<?=anchor($persona['prs_source'],'Источник',array('TARGET'=>'_blank'));?>
					</div>
				<?php endif; ?>
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
					<?php else: ?>
						<?= $othertext[13]['otxt_content']; ?>
					<?php endif; ?>
					</div>
					<div class="box-bottom-links h20">
						&nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-header w220">
					<h2><?= $othertext[19]['otxt_note'];?></h2>
					<div class="box-search">
	<input type="button" id="whomain" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
						<a class="tooltip" href="">
							<img src="<?=$baseurl;?>images/ask_transparent.png"/>
							<span class="classic"><?=$othertext[19]['otxt_help'];?></span>
						</a>
					</div>
				</div>
				<div class="box-content mw220">
					<?php if($banner): ?>
						<?=$banner;?>
					<?php else: ?>
						<?= $othertext[19]['otxt_content']; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="box">
				<div class="box-header w220">
					<h2><?= $othertext[14]['otxt_note'];?></h2>
					<div class="box-search">
<input type="button" id="documents" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
						<a class="tooltip" href="">
							<img src="<?=$baseurl;?>images/ask_transparent.png"/>
							<span class="classic"><?=$othertext[14]['otxt_help'];?></span>
						</a>
					</div>
				</div>
				<div class="box-content mw220">
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
					<?php else: ?>
						<?= $othertext[14]['otxt_content']; ?>
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
						<div class="box-header"><b><?=$manager['activitypath'];?></b>
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
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div id="document-modal-content">
					<div class="box">
						<div class="box-header"><b><?=$manager['activitypath'];?></b>
							<div class="box-search">&nbsp;</div>
						</div>
						<div class="box-content h365 w575">
							<span class="text">Список пуст</span>
							<div class="clear"></div>
						</div>
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="box">
				<div class="box-header w220">
					<h2><?= $othertext[15]['otxt_note'];?></h2>
					<div class="box-search h10">
	<input type="button" id="specials" title="Редактировать" class="box-controls edit" style="width:10px;height:16px;border:none">
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
								<div class="nshNote">
									<?=$specials[$i]['spc_note'];?>
									<a href="#" id="winSpecialModel" SM="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>
								</div>
								<div class="clear"></div>
							</div>
						<?php endfor; ?>
					<?php else: ?>
						<?= $othertext[16]['otxt_content']; ?>
					<?php endif; ?>
					</div>
					<h3><a href="#"><?= $othertext[17]['otxt_note'];?></a></h3>
					<div class="box-content">
					<?php if($shares): ?>
						<?php for($i=0;$i<count($shares);$i++):?>
							<div class="content-separator">
						<img src="<?=$baseurl;?>shares/viewimage/<?=$shares[$i]['sh_id'];?>" class="floated" alt=""/>
								<div class="nsh-title"><?=$shares[$i]['sh_title'];?></div>
								<div class="nshNote">
									<?=$shares[$i]['sh_note'];?>
									<a href="#" id="winSharesModel" ShM="<?=$i;?>" class="window"><nobr>Читать полностью</nobr></a>
								</div>
								<div class="clear"></div>
							</div>
						<?php endfor; ?>
					<?php else: ?>
						<?= $othertext[17]['otxt_content']; ?>
					<?php endif; ?>
					</div>
				</div>
				<div class="box-bottom-links h20">
					<div class="right">
						<a href="#" id="winSpecials" class="window">Полный список</a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<?php for($i=0;$i<count($specials);$i++):?>
				<div id="single-specials-modal-content" SM="<?=$i;?>">
					<div class="box">
						<div class="box-header">&nbsp;
							<div class="box-search"><b><?=$specials[$i]['spc_date'];?></b></div>
						</div>
						<div class="box-content h365 w575">
						<img src="<?=$baseurl;?>specials/viewimage/<?=$specials[$i]['spc_id'];?>" class="floated" alt=""/>
							<div class="nsh-title"><?=$specials[$i]['spc_title'];?></div>
							<div class="nshNote"><?=$specials[$i]['full_note'];?></div>
						<?php if(!empty($specials[$i]['spc_source'])):?>
							<div class="RightLink">
								<?=anchor($specials[$i]['spc_source'],'Источник',array('TARGET'=>'_blank'));?>
							</div>
						<?php endif; ?>
							<div class="clear"></div>
						</div>
						<div class="box-bottom-links h20">&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<?php for($i=0;$i<count($shares);$i++):?>
				<div id="single-shares-modal-content" ShM="<?=$i;?>">
					<div class="box">
						<div class="box-header">&nbsp;
							<div class="box-search"><b><?=$shares[$i]['sh_pdatebegin'];?></b></div>
						</div>
						<div class="box-content h365 w575">
							<div class="floated">
								<img src="<?=$baseurl;?>companythumb/viewimage/<?=$shares[$i]['cmp_id'];?>" alt=""/>
								<div class="company-rate">рейтинг: <?=$shares[$i]['cmp_rating'];?></div>
							<?php if($shares[$i]['cmp_graph'] <= $low_rating): ?>
								<div class="company-rate-bad" style="width:<?=$shares[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php else: ?>
								<div class="company-rate-graph" style="width:<?=$shares[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php endif; ?>
							</div>
							<div class="nsh-title"><?=$shares[$i]['cmp_name'];?></div>
					<img src="<?=$baseurl;?>shares/viewimage/<?=$shares[$i]['sh_id'];?>" class="floated" alt=""/>
							<div class="nsh-title"><?=$shares[$i]['sh_title'];?></div>
							<div class="nshNote"><?=$shares[$i]['full_note'];?></div>
							<div class="RightLink">
								<?= anchor('company-info/'.$shares[$i]['cmp_id'],'На страницу компании');?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="box-bottom-links h20">&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<?php if(count($specials) || count($shares)): ?>
				<div id="specials-modal-content">
					<div class="box">
						<div class="box-header"><b><?=$manager['activitypath'];?></b>
							<div class="box-search">&nbsp;</div>
						</div>
						<div class="box-content h365 w575">
					<?php if(count($specials)):?>
						<h3>Новинки отрасли</h3><hr/>
						<?php for($i=0;$i<count($specials);$i++):?>
							<div class="content-separator">
								<div class="nshDate"><?=$specials[$i]['spc_date'];?></div>
						<img src="<?=$baseurl;?>specials/viewimage/<?=$specials[$i]['spc_id'];?>" class="floated" alt=""/>
								<div class="nsh-title"><?=$specials[$i]['spc_title'];?></div>
								<div class="nshNote"><?=$specials[$i]['full_note'];?></div>
							<?php if(!empty($specials[$i]['spc_source'])):?>
								<div class="RightLink">
									<?=anchor($specials[$i]['spc_source'],'Источник',array('TARGET'=>'_blank'));?>
								</div>
							<?php endif; ?>
								<div class="clear"></div>
							</div>
						<?php endfor; ?>
					<?php endif; ?>
						<div class="clear"></div><br/>
					<?php if(count($shares)):?>
						<h3>Скидки и акции отрасли</h3><hr/>
						<?php for($i=0;$i<count($shares);$i++):?>
							<div class="content-separator">
								<div class="nshDate"><?=$shares[$i]['sh_pdatebegin'];?></div>
								<div class="floated">
									<img src="<?=$baseurl;?>companythumb/viewimage/<?=$shares[$i]['cmp_id'];?>" alt=""/>
									<div class="company-rate">рейтинг: <?=$shares[$i]['cmp_rating'];?></div>
							<?php if($shares[$i]['cmp_graph'] <= $low_rating): ?>
								<div class="company-rate-bad" style="width:<?=$shares[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php else: ?>
								<div class="company-rate-graph" style="width:<?=$shares[$i]['cmp_graph'];?>px;">&nbsp;</div>
							<?php endif; ?>
								</div>
								<div class="nsh-title"><?=$shares[$i]['cmp_name'];?></div>
						<img src="<?=$baseurl;?>shares/viewimage/<?=$shares[$i]['sh_id'];?>" class="floated" alt=""/>
								<div class="nsh-title"><?=$shares[$i]['sh_title'];?></div>
								<div class="nshNote"><?=$shares[$i]['full_note'];?></div>
								<div class="RightLink">
									<?= anchor('company-info/'.$shares[$i]['cmp_id'],'На страницу компании');?>
								</div>
								<div class="clear"></div>
							</div>
						<?php endfor; ?>
					<?php endif; ?>
						</div>
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div id="specials-modal-content">
					<div class="box">
						<div class="box-header"><b><?=$manager['activitypath'];?></b>
							<div class="box-search">&nbsp;</div>
						</div>
						<div class="box-content h365 w575">
							<span class="text">Список пуст</span>
							<div class="clear"></div>
						</div>
						<div class="box-bottom-links h20">
							&nbsp;
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="clear"></div>
		</div>
	</div>
</section>