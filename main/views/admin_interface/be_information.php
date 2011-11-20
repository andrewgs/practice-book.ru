<?php if($information['title']):?>
	<h2>Название:</h2>
	<?=$information['title'];?>
<?php endif;?>
<?php if($information['note']):?>
	<h2>Содержание:</h2>
	<?=$information['note'];?>
<?php endif;?>
<hr size="2"/>
<h2>Материал разместил:</h2>
<div style="padding: 15px 0 0 30px;">
	<div class="rtdblock">
		<div class="rtblockbg">
			<div class="rtdblockwrap">
				<span class="news-pic">
					<img src="<?=$baseurl;?>cravatar/viewimage/<?=$information['uid'];?>" alt="" align="left" width="74" height="74"/>
				</span>
				<div class="rtd-autor-info">
					<h3><?=$information['uname'].' '.$information['usubname'].' '.$information['uthname'];?></h3>
					<span>
						<?=$information['uposition'];?><br />
					</span>
					<hr size="2"/>
		<div class="company-name"><?=anchor('company-info/'.$information['cmp_id'],$information['cmp_name'],array('target'=>'_blank'));?></div>
		<div class="company-rate">авторитет: <?=$information['cmp_rating'];?></div>
		<div class="company-rate-graph" style="width:<?=$information['cmp_graph'];?>px;">&nbsp;</div>
				</div>
				<div class="rtd-info">
					<div class="green">Авторитет: <span><?=$information['urating'];?></span></div>
				</div>
				<div class="clear">&nbsp;</div>
				<div class="rtd-contact">
				<?php if($information['uskype']):?>
					<span class="skype"><?=$information['uskype'];?></span>
				<?php endif; ?>
				<?php if($information['uicq']):?>
					<span class="icq"><?=$information['uicq'];?></span>
				<?php endif; ?>
					<span class="mail"><?=$information['uemail'];?></span>
				<?php if($information['uphone']):?>
					<span class="phone"><?=$information['uphone'];?></span>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>