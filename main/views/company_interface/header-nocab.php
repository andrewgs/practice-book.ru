<header role="contentinfo">
	<div class="container_12 highlight" id="loginstatus">
		<div class="other-nav">
			<?php $link = 'company/control-panel/'.$userinfo['uconfirmation'];?>
			<?= anchor($link,'Управление',array('class'=>'lnk-submit','id'=>'lnk-sign-in','type'=>'button'));?>
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