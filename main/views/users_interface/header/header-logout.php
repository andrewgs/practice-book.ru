<header role="contentinfo">
	<div class="container_12 highlight" id="loginstatus">
		<?php $this->load->view('forms/frmlogin');?>
	</div>
	<div class="container_12">
		<div id="company-logo">	</div>
		<nav role="main">
			<ul class="header-nav">
				<li><?= anchor('','Главная'); ?></li>
				<li><div id="contact-form"><?=anchor('#','Техподдержка',array('class'=>'contact'));?></div></li>
				<li><?= anchor('ideas','Идеи'); ?></li>
				<li><?= anchor('job','Работа'); ?></li>
				<li><?= anchor('about','О проекте'); ?></li>
				<li><?= anchor('contacts','Контакты'); ?></li>
			</ul>
		</nav>
		<div class="clear"></div>
	</div>
</header>