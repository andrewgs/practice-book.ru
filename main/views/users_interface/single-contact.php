<?php if(count($contact)):?>
	<div class="manager-container">
	<?php for($i=0;$i<count($contact);$i++):?>
		<img src="<?=$baseurl;?>mavatar/viewimage/<?=$contact[$i]['uid'];?>"class="floated" alt=""/>
		<div class="rep-name">
			<?=$contact[$i]['uname'].' '.$contact[$i]['usubname'].' '.$contact[$i]['uthname'];?>
		</div>
		<div class="rep-phone"><span class="text">Тел.:</span><?= $contact[$i]['uphone']; ?></div>
		<div class="rep-email"><span class="text">E-mail:</span><?=$contact[$i]['uemail']; ?></div>
		<?php if($contact[$i]['uskype']): ?>
			<div class="federal-skype-icq">
				<img src="<?=$baseurl;?>images/skype.png" border="0" title="skype" alt=""/>
				<span class="text"><?=$contact[$i]['uskype'];?></span>
			</div>
		<?php endif; ?>
		<?php if($contact[$i]['uicq']): ?>
			<div class="federal-skype-icq">
				<img src="<?=$baseurl;?>images/icq.png" border="0" title="icq" alt=""/>
				<span class="text"><?=$contact[$i]['uicq'];?></span>
			</div>
		<?php endif; ?>
		<div class="clear"></div>
		<?php if($contact[$i]['uactive']):?>
		<img src="<?=$baseurl;?>images/online.gif" class="online" border="0" title="Пользователь в сети" alt=""/>
		<?php endif; ?>
	<?php endfor; ?>
	</div>
<?php else: ?>
	<div class="manager-container">
		Информация отсутствует
	</div>
<?php endif;?>