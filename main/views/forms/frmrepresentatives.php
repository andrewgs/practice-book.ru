<?php for($i = 0; $i <count($representative); $i++):?>
	<div class="repData" id="vrep<?=$i;?>" repID="<?=$representative[$i]['uid'];?>">
		<img src="<?=$baseurl;?>cravatar/viewimage/<?=$representative[$i]['uid'];?>" vspace="10" border="0" class="floated" alt=""/>
		<div class="rep-name">
			<?=$representative[$i]['uname'].' '.$representative[$i]['usubname'].' '.$representative[$i]['uthname'];?>
		</div>
		<div class="rep-phone"><span class="text">Тел.:</span><?= $representative[$i]['uphone']; ?></div>
		<div class="rep-email"><span class="text">E-mail:</span><?=$representative[$i]['uemail']; ?></div>
		<div class="rep-posiotion"><span class="text">Должность:</span><?=$representative[$i]['uposition']; ?></div>
		<?php if($userinfo['priority'] and !$representative[$i]['upriority']): ?>
			<input type="image" title="Удалить" class="ajaxdel" id="rep<?=$i;?>" src="<?= $baseurl; ?>images/delete.png" />
		<?php endif; ?>
		<?php if($representative[$i]['ustatus'] == 'disabled'): ?>
		<input type="image" title="Не активирован" class="ajaxdel" id="rep<?=$i;?>" src="<?= $baseurl; ?>images/exclamation.png" />
		<?php endif; ?>
	</div>
	<div class="clear"></div>
	<?php if($representative[$i]['uactive'] and $representative[$i]['uid'] != $userinfo['uid']): ?>
		<img src="<?=$baseurl;?>images/online.gif" class="online" border="0" title="Пользователь в сети" alt=""/>
	<?php endif; ?>
<?php endfor; ?>
<div class="clear"></div>