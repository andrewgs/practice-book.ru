<div class="box wide">
	<div class="box-header"><h2>Представители компании</h2>
		<div class="box-search">
			<?=anchor('company/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content">
	<?php for($i=0;$i<count($representative); $i++):?>
		<div class="content-separator" id="drep<?=$i;?>" rID="<?=$representative[$i]['uid'];?>">
			<img src="<?=$baseurl;?>cravatar/viewimage/<?=$representative[$i]['uid'];?>" vspace="10" border="0" class="floated" alt=""/>
			<div class="rep-name">
				<?=$representative[$i]['uname'].' '.$representative[$i]['usubname'].' '.$representative[$i]['uthname'];?>
			</div>
			<div class="rep-phone"><span class="text">Тел.:</span><?= $representative[$i]['uphone']; ?></div>
			<div class="rep-email"><span class="text">E-mail:</span><?=$representative[$i]['uemail']; ?></div>
			<div class="rep-posiotion"><span class="text">Должность:</span><?=$representative[$i]['uposition']; ?></div>
			<?php if($representative[$i]['uskype']): ?>
				<div class="federal-skype-icq">
					<img src="<?=$baseurl;?>images/skype.png" border="0" title="skype" alt=""/>
					<span class="text"><?=$representative[$i]['uskype'];?></span>
				</div>
			<?php endif; ?>
			<?php if($representative[$i]['uicq']): ?>
				<div class="federal-skype-icq">
					<img src="<?=$baseurl;?>images/icq.png" border="0" title="icq" alt=""/>
					<span class="text"><?=$representative[$i]['uicq'];?></span>
				</div>
			<?php endif; ?>
			<?php if($userinfo['priority'] and !$representative[$i]['upriority']): ?>
				<input type="image" title="Удалить" class="ajaxdel" rep="<?=$i;?>" src="<?= $baseurl; ?>images/delete.png" />
			<?php endif; ?>
			<?php if($representative[$i]['ustatus'] == 'disabled'): ?>
			<input type="image" title="Не активирован" class="ajaxdel" style="margin-right: 5px;" src="<?= $baseurl; ?>images/exclamation.png" />
			<?php endif; ?>
			<div class="clear"></div>
			<?php if($representative[$i]['uactive'] and $representative[$i]['uid'] != $userinfo['uid']): ?>
				<img src="<?=$baseurl;?>images/online.gif" class="online" border="0" title="Пользователь в сети" alt=""/>
			<?php endif; ?>
		</div>
	<?php endfor; ?>
	</div>
	<div class="clear"></div>
</div>