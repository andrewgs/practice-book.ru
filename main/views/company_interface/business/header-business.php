<header role="contentinfo">
	<div class="container_12 highlight" id="loginstatus">
		<div class="other-nav">
			<?php $link = 'company/control-panel/'.$userinfo['uconfirmation'];?>
			<?= anchor($link,'Управление',array('class'=>'lnk-submit','type'=>'button'));?>
	<?php if($actenvironment): ?>
		<?php $segm = $this->uri->segment(2);?>
		<?php if($segm == 'full-business-environment'):?>
			<?php $link = 'company/private-business-environment/'.$userinfo['uconfirmation']; ?>
			<?= anchor($link,'Частная бизнес среда',array('class'=>'lnk-submit','type'=>'button'));?>
		<?php else: ?>
			<?php $link = 'company/full-business-environment/'.$userinfo['uconfirmation']; ?>
			<?= anchor($link,'Общая бизнес среда',array('class'=>'lnk-submit','type'=>'button'));?>
		<?php endif; ?>
	<?php endif; ?>
	<?php if(count($activity) > 1):?>
		<form id="ManActData" method="post" action="<?=$baseurl;?><?=$this->uri->uri_string();?>" style="float:right; margin-left:10px;">
			<select name="activity" id="select-activity" class="mixed-combo" size="1" style="font: 12px trebuchet MS,sans-serif; padding: 1px 0;">
				<option value="0">Выберите отрасль</option>
			<?php for($i=0;$i<count($activity);$i++): ?>
				<option value="<?=$activity[$i]['act_id'];?>"><?=$activity[$i]['act_title'];?></option>
			<?php endfor; ?>
			</select>
		</form>
	<?php endif;?>
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
				<li><?= anchor('for-dealers','Дилерам'); ?></li>
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