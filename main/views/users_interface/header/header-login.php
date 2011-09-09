<header role="contentinfo">
	<div class="container_12 highlight" id="loginstatus">
		<?php $this->load->view('users_interface/header/userinfo');?>
	</div>
	<div class="container_12">
		<div id="company-logo">	</div>
		<nav role="main">
			<ul class="header-nav">
				<li><?= anchor('','Главная'); ?></li>
				<li><?= anchor('about','О проекте'); ?></li>
				<li><div id="contact-form"><?= anchor('#','Техподдержка',array('id'=>'Support')); ?></div></li>
				<li><?= anchor('information','Партнерам'); ?></li>
				<li><?= anchor('job','Работа'); ?></li>
				<li><?= anchor('dilers','Дилерам'); ?></li>
				<li><?= anchor('contacts','Контакты'); ?></li>
			</ul>
		</nav>
		<div class="clear"></div>
	</div>
</header>