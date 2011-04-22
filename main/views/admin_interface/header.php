<header role="contentinfo">
	<div class="container_12">
		<div id="company-logo">	</div>
		<div class="clear"></div>
		<ul id="admin-navigation">
			<li>
				<a href="#">Содержание страниц</a>
				<ul>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/main','Страница "Главная"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/ideas','Страница "Идеи"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/jobs','Страница "Работа"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/about','Страница "О проекте"');?></li>
			<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/conditions-cooperation','Страница "Условия сотрудничества"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/no-activity','Страница "Отсутствие услуги"');?></li>
				</ul>
			</li>
			<li>
				<a href="#">Страница отросли</a>
				<ul>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/product','Продукт отросли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/pitfalls','Подводные камни');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/questions','Вопросы по отросли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/tips','Советы по отросли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/price','Прайс-координатор');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/tender','Тендер');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/company','Компании отросли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/news','Новости');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/manager','Прайс-менеджер');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/persona','Персона');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/whomain','Кто главный?');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/documents','Документооборот');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/specials','Новинки и скидки');?></li>
				</ul>
			</li>
			<li>
				<a href="#">Информационные списки</a>
				<ul>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/regions','Список регионов');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/activity','Список отрослей');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/users','Список пользователей');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/company','Список компаний');?></li>
				</ul>
			</li>
			<li>
				<a href="#">Администрирование</a>
				<ul>
					<li><?=anchor('admin/registration/'.$userinfo['uconfirmation'].'/manager','Добавление федерального менеджера');?></li>
					<li><?=anchor('admin/registration/'.$userinfo['uconfirmation'].'/administrator','Добавление администратора');?></li>
					<li><?=anchor('admin/cabinet/'.$userinfo['uconfirmation'],'Личный кабинет');?></li>
					<li><?=anchor('admin/shutdown/'.$userinfo['uconfirmation'],'Завершить сеанс');?></li>
				</ul>
			</li>
		</ul>
	</div>
</header>