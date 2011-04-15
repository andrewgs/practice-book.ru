<header role="contentinfo">
	<div class="container_12 highlight" id="loginstatus">
		<div class="other-nav">
		<?php $link = 'manager/set-cpanel/'.$userinfo['uconfirmation']; ?>
		<form id="ManActData" method="post" action="<?=$baseurl.$link;?>">
			<select name="activity" id="select-activity" class="mixed-combo" size="1" style="width: 200px;">
				<option value="0">Выберите отросль</option>
			<?php for($i = 0; $i < count($activity); $i++): ?>
				<?php if($activity[$i]['act_final'] == 0): ?>
					<optgroup label="<?=$activity[$i]['act_title'];?>">
					<?php $i++; $j = $i;?>
					<?php while($activity[$j]['act_final'] == 1 && $activity[$j]['act_parentid'] == $activity[$i]['act_parentid']): ?>
				<option value="<?=$activity[$j]['act_id'];?>" pID="<?=$activity[$j]['act_parentid'];?>"><?=$activity[$j]['act_title'];?></option>
					<?php $j++; ?>
					<?php endwhile; ?>
					<?php $i = $j-1;?>
					</optgroup>
				<?php else: ?>
				<option value="<?=$activity[$i]['act_id'];?>" pID="<?=$activity[$i]['act_parentid'];?>"><?=$activity[$i]['act_title']?></option>
				<? endif; ?>
			<?php endfor; ?>
			</select>
			<select name="region" id="select-region" class="mixed-combo" size="1" style="width: 200px;">
				<option value="0">Выберите город</option>
			<?php for($i = 0; $i < count($regions); $i++):?>
				<option value="<?=$regions[$i]['reg_id'];?>"><?=$regions[$i]['reg_name'];?></option>
			<?php endfor; ?>
			</select>
		</form>
	</div>
		<section id="auth">
			<span class="welcome-message"><?= $userinfo['ufullname']; ?></span>
			<?= anchor('manager/cabinet/'.$userinfo['uconfirmation'],'Личный кабинет',array('class'=>'lnk-submit','id'=>'lnk-sign-in','type'=>'button'));?>&nbsp;
			<input type="button" class="lnk-submit" id="lnk-logout" value="Выход"/>
		</section>
		<div class="clear"></div>
	</div>
	<div class="container_12">
		<div id="company-logo">	</div>
		<nav role="main">
			<ul class="header-nav">
				<li><?= anchor('','Главная'); ?></li>
				<li><div id="contact-form"><?= anchor('#','Техподдержка',array('class'=>'contact')); ?></div></li>
				<li><?= anchor('ideas','Идеи'); ?></li>
				<li><?= anchor('job','Работа'); ?></li>
				<li><?= anchor('about','О проекте'); ?></li>
				<li><?= anchor('contacts','Контакты'); ?></li>
			</ul>
		</nav>
		<br><br>
		<ul class="header-nav2">
			<li><?= $manager['activitypath'];?></li>
		</ul>
		<div class="clear"></div>
	</div>
</header>