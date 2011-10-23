<header role="contentinfo">
	<div class="container_12">
		<div id="company-logo">	</div>
		<nav role="main">
			<ul class="header-nav">
				<li><?= anchor('','Главная'); ?></li>
				<li><?= anchor('about','О проекте'); ?></li>
				<li><?= anchor('information','Партнерам'); ?></li>
				<li><?= anchor('job','Работа'); ?></li>
				<li><?= anchor('for-dealers','Дилерам'); ?></li>
				<li><?= anchor('contacts','Контакты'); ?></li>
			</ul>
		</nav>
		<?php if(isset($activitypath)): ?>
		<br><br>
		<ul class="header-nav2">
			<li><?=$activitypath;?></li>
		</ul>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
</header>