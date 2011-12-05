<header role="contentinfo">
	<div class="container_12">
		<div id="company-logo">	</div>
		<div class="clear"></div>
		<ul id="admin-navigation">
			<li>
				<a href="javascript:void(0);">Управление</a>
				<ul>
					<li><?=anchor('dealer/get-code/'.$userinfo['uconfirmation'],'Получить код для регистрации');?></li>
					<li><?=anchor('dealer/register-company/'.$userinfo['uconfirmation'],'Зарегистрировать компанию');?></li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0);">Администрирование</a>
				<ul>
					<li><?=anchor('dealer/cabinet/'.$userinfo['uconfirmation'],'Личный кабинет');?></li>
					<li><?=anchor('dealer/applications-received/'.$userinfo['uconfirmation'],'Заявки на регистрацию');?></li>
					<li><?=anchor('dealer/shutdown/'.$userinfo['uconfirmation'],'Завершить сеанс');?></li>
				</ul>
			</li>
		</ul>
	</div>
</header>