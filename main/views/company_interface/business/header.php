<header role="contentinfo">
	<div class="container_12 highlight" id="loginstatus">
		<div class="other-nav">
		<?php if($envirenment == 'full'):?>	
			<?php $link = 'company/full-business-environment/'.$userinfo['uconfirmation']; ?>
			<?= anchor($link,'К разделам общей среды',array('class'=>'lnk-submit','id'=>'lnk-sign-in','type'=>'button'));?>
		<?php else: ?>
			<?php $link = 'company/overall-business-environment/'.$userinfo['uconfirmation']; ?>
			<?= anchor($link,'К разделам полноценной среды',array('class'=>'lnk-submit','id'=>'lnk-sign-in','type'=>'button'));?>
		<?php endif; ?>
		</div>
		<section id="auth">
			<span class="welcome-message"><?= $userinfo['ufullname']; ?></span>
			<?= anchor('representative/cabinet/'.$userinfo['uconfirmation'],'Личный кабинет',array('class'=>'lnk-submit','id'=>'lnk-sign-in','type'=>'button'));?>&nbsp;
			<input type="button" class="lnk-submit" id="lnk-logout" value="Выход"/>
		</section>
		<div class="clear"></div>
	</div>
	<div class="container_12">
		<div id="company-logo">	</div>
		<nav role="main">
			<ul class="header-nav">
				<li><?= anchor('','Главная'); ?></li>
				<li><?= anchor('about','О проекте'); ?></li>
				<li><?= anchor('information','Партнерам'); ?></li>
				<li><?= anchor('job','Работа'); ?></li>
				<li><?= anchor('dilers','Дилерам'); ?></li>
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