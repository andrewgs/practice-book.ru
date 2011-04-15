<header role="contentinfo">
	<div class="container_12 highlight" id="loginstatus">
		<div class="other-nav">
			<?php $link = 'company/control-panel/'.$userinfo['uconfirmation'];?>
			<?= anchor($link,'Управление',array('class'=>'lnk-submit','id'=>'lnk-sign-in','type'=>'button'));?>
		</div>
		<div class="other-nav">
			<form id="regionview" method="post" action="<?= $baseurl; ?>settings">
				<select name="region" id="select-region" class="mixed-combo" size="1" style="width: 200px;">
					<option value="0">Выберите город</option>
				<?php for($i = 0;$i < count($regions);$i++): ?>
					<option value="<?=$regions[$i]['reg_id'];?>"><?=$regions[$i]['reg_name'];?></option>
				<?php endfor; ?>
				</select>
			</form>
		</div>
		<section id="auth">
			<span class="welcome-message"><?= $userinfo['ufullname']; ?></span>
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
			<li><?=$company['cmp_name'];?></li>
		</ul>
		<div class="clear"></div>
	</div>
</header>